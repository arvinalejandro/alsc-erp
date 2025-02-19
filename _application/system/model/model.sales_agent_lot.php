<?php
class model_sales_agent_lot
{    
    
    public function __construct()
    {
        $this->table_name        =    'sales_agent_lot';
        $this->message_insert    =    'A new lot hold has been successfully added.';
    }
    
# Data Select

    public function check_active_hold($id,$filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           select * from sales_agent_lot WHERE lot_id = {$id}
                           AND hold_status = 'active' AND is_sold = 0
                        ";        
        $rows                =    sql_select($query);        
        $row                 =    $rows[0];        
        # Parse
        if(count($row))
        {
            $return  	= $row;        
        }
        else
        {
            $return     = 0;
        }
        return $return;
    }
    
    
    public function select_all_active_hold()
    {        
        $query     =    "
                           select * from sales_agent_lot WHERE hold_status = 'active'AND is_sold = 0
                        ";        
        $rows      =    sql_select($query);        
      
        return $rows;
    }
    
    public function select_lot_hold($id)
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           select * from sales_agent_lot WHERE  hold_status = 'active' AND lot_id = {$id} AND is_sold = 0
                        ";        
        $rows      =    sql_select($query);  
        $row       =    $rows[0];
        return $row;
    }
    
 //for sales dir/man
 
   public function count_hold($sales_agent_id=0,$column='sales_agent_id_pc')
    {
    	
    	if($sales_agent_id != 0)
    	{
			$id_filter       =  " AND {$column} = {$sales_agent_id}";
    	}
    	
    	$query  		     =  "
    					             SELECT 
    					             
    					             SUM(CASE WHEN sales_agent_lot.is_sold = 0 THEN 1 ELSE 0 END) AS hold_count
    					                 					             
    					             FROM 
    					             
    					             sales_agent_lot
    					             
    					             WHERE 
    					             
                                     hold_status = 'active'    					             
    					            
    					             {$id_filter}
    					             
    	";
    	//hash_dump($query,1);
    	$rows                		 =    sql_select($query);
    	$row                 		 =    $rows[0];
    	if($row['hold_count'] != NULL)
    	{
			return $row['hold_count'];
    	}
    	else
    	{
			return 0;
    	}
    	    
    	
	}
 
 
 
 public function count_hold_sold($sales_agent_id=0,$filter='')
    {
    	
    	if($sales_agent_id != 0)
    	{
			$id_filter       =  " AND (
			                  {$sales_agent_id} IN(sales_agent_id_sd,sales_agent_id_sm,sales_agent_id_pc)
								)
			";
    	}
    	
    	$query  		     =  "
    					             SELECT 
    					             
    					             SUM(CASE WHEN sales_agent_lot.is_sold = 0 THEN 1 ELSE 0 END) AS hold_count,
    					             SUM(CASE WHEN sales_agent_lot.is_sold = 1 THEN 1 ELSE 0 END) AS sold_count
    					             
    					             FROM 
    					             
    					             sales_agent_lot
    					             
    					             WHERE 
    					             
                                     hold_status = 'active'    					             
    					            
    					             {$id_filter}
    					             
    					             {$filter}
    	";
    	//hash_dump($query,1);
    	$rows                		 =    sql_select($query);
    	$row                 		 =    $rows[0];
    	$list['hold_count']			 =    0;
    	$list['sold_count']			 =    0;
    	if($row['hold_count'] != NULL || $row['sold_count'] != NULL)
    	{
			return $row;
    	}
    	else
    	{
			return $list;
    	}
    	    
    	
	}
	
 // FOR Network / Division

	public function network_division_lot_count($id,$filter = '')
    {        
        
        $query     =    "
                           select 
                           
                           SUM(CASE WHEN sales_agent_lot.is_sold = 0 THEN 1 ELSE 0 END) AS hold_count,
    					   SUM(CASE WHEN sales_agent_lot.is_sold = 1 THEN 1 ELSE 0 END) AS sold_count 
    					             
    					   from sales_agent_lot 
    					   
    					   WHERE
                           
                           hold_status = 'active'
                           
                           AND (
			                    {$id} IN(old_sales_agent_id_avp,old_sales_agent_id_sm,old_sales_agent_id_ma)
								)
						   
						   {$filter}
                           
                        ";        
                                
        $rows                =    sql_select($query);        
        $row                 =    $rows[0];        
        # Parse
        if(count($row))
        {
            $return  	= $row;        
        }
        else
        {
            $return     = 0;
        }
        return $return;
    }

# Modify

    public function insert($post)
    {

	     $data                                           =    sql_parse_input('sales_agent_lot', $post);
	     $data['hold_status']				 			 =   'active';
	     $data['sales_agent_lot_timestamp']              =    time();
	     $sql                                            =    sql_insert($this->table_name, $data);
                   
        $return['result']                =    true;
        $return['data']                  =    $sql;
        $return['message']               =    $this->message_insert;        
    }
    
    public function update_by_lot($id)
	{
		$data['hold_status']						=   'inactive';	
		$data['sales_agent_lot_timestamp_end']      =   time();			
														sql_update($this->table_name, 'lot_id', $id, $data, " AND hold_status = 'active'");		
		$return['result']							=	true;
		$return['data']								=	'';
		$return['message']							=	$this->message_update;
		return $return;
		
	}
	
	public function update_sold_lot($id)
	{
		$data['hold_status']						=   'active';	
		$data['is_sold']							=   1;	
		$data['sales_agent_lot_timestamp_end']      =   time();			
														sql_update($this->table_name, 'sales_agent_lot_id', $id, $data);		
		$return['result']							=	true;
		$return['data']								=	'';
		$return['message']							=	$this->message_update;
		return $return;
		
	}
	
	public function check_expiry($data)
	{
		foreach($data as $row)
			{		
                 //mvc_model('model.document_lot')->insert($row['lot_id']);
                if($row['hold_status'] == 'active')
                {
					$duration	       =    diff_date_to_current($row['sales_agent_lot_timestamp']);
					if($duration > 5 && $row['hold_standard'] == 1)
					{
						  $this->update_by_lot($row['lot_id']);
					      $lot['str']['option_availability_id']   	=	'available';
					      mvc_model('model.lot')->update($lot, $row['lot_id']);
					}
                }
			}
		$return['result']							=	true;
		$return['data']								=	'';
		$return['message']							=	$this->message_update;
		return $return;
		
	}
            
}
