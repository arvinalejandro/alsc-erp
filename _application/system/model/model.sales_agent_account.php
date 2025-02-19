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
                           AND option_availability_id = 'on_hold'
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
	     $data['option_availability_id']				 =   'on_hold';
	     $data['sales_agent_lot_timestamp']              =    time();
	     $sql                                            =    sql_insert($this->table_name, $data);
                   
        $return['result']                =    true;
        $return['data']                  =    $sql;
        $return['message']               =    $this->message_insert;        
    }
    
    public function update_by_lot($id)
	{
		$data['option_availability_id']				=   'available';	
		$data['sales_agent_lot_timestamp_end']      =   time();			
														sql_update($this->table_name, 'lot_id', $id, $data, " AND option_availability_id = 'on_hold'");		
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
                if($row['option_availability_id'] == 'on_hold')
                {
					$duration	       =    diff_date_to_current($row['sales_agent_lot_timestamp']);
					if($duration > 5 && $row['hold_standard'] == 1)
					{
						 $this->update($row['lot_id']);
						 
						  $lot['int']['agent_id']					=	0;
					      $lot['int']['sales_manager_id']			=	0;
					      $lot['int']['sales_director_id']		    =	0;
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
