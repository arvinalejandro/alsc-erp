<?php
class model_sales_agent_agent
{	
	
	public function __construct()
	{
		$this->table_name		=	'sales_agent_agent';
		$this->message_insert	=	'A new Entry has been successfully added.';
	}
	
# Data Select
    
     public function select_by_head($id)
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           SELECT * FROM sales_agent_agent WHERE sales_agent_head_id = {$id} AND is_deleted=0
                        ";        
                                
        $rows      =    sql_select($query);
        return $rows;
    }
    
    public function select_by_under($id)
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           SELECT * FROM sales_agent_agent WHERE sales_agent_id = {$id} AND is_deleted=0
                        ";        
                                
        $rows      =    sql_select($query);
        $row   	   =    $rows[0];
       
        return $row;
    }
    
    public function get_head_by_under($id)
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           SELECT 
                           
                           * 
                           
                           FROM 
                           
                           sales_agent_agent 
                           
                           inner join sales_agent on sales_agent.sales_agent_id = sales_agent_agent.sales_agent_head_id AND sales_agent_agent.is_deleted = 0
                           
                           WHERE 
                           
                           sales_agent_agent.sales_agent_id = {$id} 
                           
                           AND sales_agent_agent.is_deleted=0
                        ";        
                                
        $rows      =    sql_select($query);
        $row   	   =    $rows[0];
       
        return $row;
    }
    
    public function get_head_quota($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		$query	=	"select 
						*,
						(SELECT sales_agent_monthly_quota FROM sales_agent WHERE sales_agent_id = sales_agent_agent.sales_agent_id AND sales_agent.is_deleted = 0) AS agent_monthly_quota 
						
						from 
						
						sales_agent_agent 
						
						where 
						
						sales_agent_head_id = {$id}
						
						AND is_deleted = 0
						
						";		
								
		$rows	=	sql_select($query);	
		
		if(count($rows))
		{
			foreach($rows as $row)
			{
				
				$quota += $row['agent_monthly_quota'];
			}
			
		}
		else
		{
			$quota = 0;
		}	
		return $quota;
	}
	
	
//Sales Director Profile

public function select_managers_by_sales_director($id)
    {        
        $id        =    string_clean_number($id);
        $query     =    "
                           SELECT *
                           
                           FROM 
                           
                           sales_agent_agent 
                           
                           inner join sales_agent on sales_agent.sales_agent_id = sales_agent_agent.sales_agent_id
                           
                           
                           WHERE 
                           
                           sales_agent_head_id = {$id}
                           
                           AND sales_agent_agent.is_deleted = 0
                        ";        
                                
        $rows                =    sql_select($query);   
        $template_row		=	'sales/template/profile_row.sales_director';
		$template_row		=	view_get_template($template_row); 
		  //hash_dump($rows);
          //      die($query);
       if(count($rows))
        {
            foreach($rows as $row)
            {        
                $manager_agents						      =    $this->select_by_head($row['sales_agent_id']);
                $row['agent_count'] 					  =    count($agents);
                $row['sales_cost']  					  =    0;
                $row['sales_count'] 					  =    0;
                $row['backout_count'] 					  =    0;
                $row['backout_cost'] 					  =    0;
                $row['total_paidup'] 					  =    0;
                $ca_id[] 								  =    0;
                
                foreach($manager_agents as $agent_row)
                {
					$ca_id_string						=    implode(",",$ca_id);
					$sales							    =    mvc_model('model.sales_commission_account')->get_total_sales($agent_row['sales_agent_id'],"all" ," AND sales_commission_account.client_account_id NOT IN({$ca_id_string})");    
					$backout                            =    mvc_model('model.sales_commission_account')->get_total_sales($agent_row['sales_agent_id'],"ejected" , " AND sales_commission_account.client_account_id NOT IN({$ca_id_string})");     
					$row['total_paidup']			   +=    mvc_model('model.sales_commission_account')->get_total_paidup($agent_row['sales_agent_id'],"all" ," AND sales_commission_account.client_account_id NOT IN({$ca_id_string})");
					
					if($sales['ca_id'])
					{
						$ca_id[]						=  $sales['ca_id']  ; 
					}
					
					$row['backout_cost']			   +=    $backout['sum'];
                    $row['backout_count']			   +=    $backout['count'];
					$row['sales_cost']                 +=    $sales['sum'];
					$row['sales_count']                +=    $sales['count'];
                }
                $row['sales_cost']					    =    string_amount($row['sales_cost']);
                $row['backout_cost']					=    string_amount($row['backout_cost']);
                $row['total_paidup']					=    string_amount($row['total_paidup']);
                $list                                  .=    view_populate($row, $template_row);
            }            
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }  
    
//Sales Manager Profile

public function select_agents_by_manager($id)
    {        
        $id        =    string_clean_number($id);
        $query     =    "
                           SELECT *  ,
                        (select option_agent_status_name from option_agent_status where option_agent_status_id = sales_agent.option_agent_status_id) as option_agent_status_name
                           
                           FROM 
                           
                           sales_agent_agent 
                           
                           inner join sales_agent on sales_agent.sales_agent_id = sales_agent_agent.sales_agent_id
                           
                           WHERE 
                           
                           sales_agent_head_id = {$id}
                           
                           AND sales_agent_agent.is_deleted = 0
                        ";        
                                
        $rows                =    sql_select($query);   
        $template_row		=	'sales/template/profile_row.sales_manager';
		$template_row		=	view_get_template($template_row); 
		  //hash_dump($rows);
          //      die($query);
       if(count($rows))
        {
            foreach($rows as $row)
            {        
				 $backout_cost                            =    mvc_model('model.sales_commission_account')->get_total_sales($row['sales_agent_id'], "ejected");
                 $sales_cost                              =    mvc_model('model.sales_commission_account')->get_total_sales($row['sales_agent_id'], "all");
                 $fully_paid_cost                         =    mvc_model('model.sales_commission_account')->get_total_sales($row['sales_agent_id'], "fully_paid");
                 $row['fully_paid_count']                 =    $fully_paid_cost['count'];
                 $row['sales_cost']                       =    string_amount($sales_cost['sum']);
                 $row['backout_cost']					  =    string_amount($backout_cost['sum']);
        		 $row['backout_count']					  =    $backout_cost['count'];
                 $row['total_paidup']                     =    string_amount(mvc_model('model.sales_commission_account')->get_total_paidup($row['sales_agent_id'],'all'));
                 $row['backout_percent']                  =    round(($data['backout_cost'] / $data['sales_cost']) * 100,2); 
                $list                                    .=    view_populate($row, $template_row);
            }            
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }
    
// Counts
	public function count_agents_by_head($id)
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           SELECT COUNT(*) as total_count FROM sales_agent_agent WHERE sales_agent_head_id = {$id} AND is_deleted=0
                        ";        
                                
        $rows      =    sql_select($query);
        $row   	   =    $rows[0];
       
        return $row;
    }
    
    public function count_agents_by_director($id)
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                            SELECT 

							COUNT(*) AS total_count

							FROM 

							sales_agent_agent

							WHERE 

							sales_agent_head_id IN(SELECT DISTINCT sales_agent_id FROM sales_agent_agent WHERE sales_agent_head_id = {$id} AND is_deleted=0)    

							AND is_deleted=0
                        ";        
        $rows      =    sql_select($query);
        $row   	   =    $rows[0];
       
        return $row;
    }
    
# Modify

	public function insert($post)
	{
		$sql									=	sql_insert($this->table_name, $post);		
		$return['result']						=	true;
		$return['data']							=	$sql;
		$return['message']						=	$this->message_insert;		
	}
    
    
    public function update($post, $id)
	{
		$data					=	sql_parse_input('sales_manager', $post);					
									sql_update($this->table_name, 'sales_manager_id', $id, $data);		
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete($id,$column='sales_agent_id')
    {        
        $id                             =    string_clean_number($id);
        $data['is_deleted']             =    1;
        sql_update($this->table_name, $column, $id, $data);
        $return['result']               =    true;
        $return['data']                 =    '';
        $return['message']              =    $this->message_update;
    }

    
    
 
	
}
