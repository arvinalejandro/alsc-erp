<?php
class model_sales_network
{	
	
	public function __construct()
	{
		$this->table_name		=	'sales_network';
		$this->message_insert	=	'A new Network has been successfully added.';
	}
	
# Data Select
    public function select_network($id, $filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           SELECT * FROM sales_network WHERE sales_network_id = {$id}
                        ";        
                                
        $rows                =    sql_select($query);
        $list                =    $rows[0];        
       
        return $list;
    }
    // for main rows in sales network
    public function select_all_network($filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           SELECT * FROM sales_network
                        ";        
                                
        $rows                =    sql_select($query);        
        $template_row        =    'sales/template/row.network';
        $template_row        =    view_get_template($template_row);
        # Parse
        if(count($rows))
        {
            $ca_id 										=    array(0);
            foreach($rows as $row)
            {        
               
               	$divisions								=    mvc_model('model.sales_network_division')->select_division_by_network($row['sales_network_id']);
               	//hash_dump($divisions,true);
                $row['division_count'] 					=    count($divisions);
                $row['agent_count']  					=    0;
                $row['sales_cost']  					=    0;
                $row['sales_count'] 					=    0;
                $row['backout_count'] 					=    0;
                $row['backout_cost'] 					=    0;
                $row['total_paidup'] 					=    0;
                
                
                foreach($divisions as $div_row)
                {
					 $agents             			    =    mvc_model('model.sales_agent')->select_by_division($div_row['sales_network_division_id']);
					 $row['agent_count'] 			   +=    count($agents);
					 foreach($agents as $agent_row)
	                {
						$ca_id_string					=    implode(",",$ca_id);
						$sales							=    mvc_model('model.sales_commission_account')->get_total_sales($agent_row['sales_agent_id'],"all" ," AND sales_commission_account.client_account_id NOT IN({$ca_id_string})",'old');    
						$backout                        =    mvc_model('model.sales_commission_account')->get_total_sales($agent_row['sales_agent_id'],"ejected" , " AND sales_commission_account.client_account_id NOT IN({$ca_id_string})",'old');     
						$row['total_paidup']		   +=    mvc_model('model.sales_commission_account')->get_total_paidup($agent_row['sales_agent_id'],'' ," AND sales_commission_account.client_account_id NOT IN({$ca_id_string})",'old');    
						if($sales['ca_id'])
						{
							$ca_id[]				    =  $sales['ca_id']  ; 
						}
						 
						$row['backout_cost']		   +=    $backout['sum'];
	                    $row['backout_count']		   +=    $backout['count'];
						$row['sales_cost']             +=    $sales['sum'];
						$row['sales_count']            +=    $sales['count'];
	                }
                }
                // hash_dump($ca_id);
                $row['sales_cost']					    =    string_amount($row['sales_cost']);
                $row['backout_cost']					=    string_amount($row['backout_cost']);
                $row['total_paidup']					=    string_amount($row['total_paidup']);
                $list                                  .=    view_populate($row, $template_row);
            } //die();          
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }
    
    //for sales network profile
    public function select_all_network_counts($id,$filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           SELECT * FROM sales_network WHERE sales_network_id = {$id}
                        ";        
                                
        $rows                =    sql_select($query);        
        # Parse
        if(count($rows))
        {
           	$ca_id 										=    array(0);
            foreach($rows as $row)
            {        
               
               	$divisions								=    mvc_model('model.sales_network_division')->select_division_by_network($row['sales_network_id']);
                $row['division_count'] 					=    count($divisions);
                $row['agent_count']  					=    0;
                $row['sales_cost']  					=    0;
                $row['sales_count'] 					=    0;
                $row['backout_count'] 					=    0;
                $row['backout_cost'] 					=    0;
                $row['total_paidup'] 					=    0;
                $row['total_hold'] 						=    0;
                $row['total_sold'] 						=    0;
                
                foreach($divisions as $div_row)
                {
					 $agents             			    =    mvc_model('model.sales_agent')->select_by_division($div_row['sales_network_division_id']);
					 $row['agent_count'] 			   +=    count($agents);
					 foreach($agents as $agent_row)
	                {
						$ca_id_string					=    implode(",",$ca_id);
						$lot_counts				    	=    mvc_model('model.sales_agent_lot')->network_division_lot_count($agent_row['sales_agent_id']);
						$sales							=    mvc_model('model.sales_commission_account')->get_total_sales($agent_row['sales_agent_id'],"all" ," AND sales_commission_account.client_account_id NOT IN({$ca_id_string})",'old');    
						$backout                        =    mvc_model('model.sales_commission_account')->get_total_sales($agent_row['sales_agent_id'],"ejected" , " AND sales_commission_account.client_account_id NOT IN({$ca_id_string})",'old');     
						$row['total_paidup']		   +=    mvc_model('model.sales_commission_account')->get_total_paidup($agent_row['sales_agent_id'],'' ," AND sales_commission_account.client_account_id NOT IN({$ca_id_string})",'old');     
						if($sales['ca_id'])
						{
							$ca_id[]				    =  $sales['ca_id']  ; 
						}
						$row['backout_cost']		   +=    $backout['sum'];
	                    $row['backout_count']		   +=    $backout['count'];
						$row['sales_cost']             +=    $sales['sum'];
						$row['sales_count']            +=    $sales['count'];
						$row['total_hold']             +=    $lot_counts['hold_count'];
						$row['total_sold']             +=    $lot_counts['sold_count'];
	                }
                }
                
                $row['sales_cost']					    =    string_amount($row['sales_cost']);
                $row['backout_cost']					=    string_amount($row['backout_cost']);
                $row['total_paidup']					=    string_amount($row['total_paidup']);
            }  
            $list = $row;          
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }	
    
    
// For Sales Report-=========================================================
	public function get_production_report_per_network($month_date='2015-June')
	{		
		$filter	=   "AND DATE_FORMAT(FROM_UNIXTIME(`sales_commission_account_timestamp`), '%Y-%m') = 
								'{$month_date}' ";
		# DB
		$query	=	"
					SELECT DISTINCT sales_commission_account.client_account_id AS client_account_id,
					sales_network.sales_network_name, 
					COUNT(sales_commission_account_id)AS sale_count, 
					SUM(client_account.client_account_tcp_net) as project_total 

					FROM 

					sales_network
					
					LEFT join sales_network_division on  sales_network_division.sales_network_division_id = sales_network.sales_network_id
					LEFT join sales_agent on  sales_agent.sales_network_division_id = sales_network_division.sales_network_division_id
					
					LEFT join sales_commission_account ON  sales_agent.sales_agent_id IN(sales_commission_account.old_sales_agent_id_sm,
																				sales_commission_account.old_sales_agent_id_avp,								
																				sales_commission_account.old_sales_agent_id_ma) 
																				
					LEFT join client_account ON client_account.client_account_id = sales_commission_account.client_account_id

					GROUP BY sales_network.sales_network_id 
					";
		$rows	=	sql_select($query);
		# Template
	    $template_row		=	'sales/template/profile.report.network';
		$template_row		=	view_get_template($template_row);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)  
			{  				
				$list['sales']			   			+=    $row['project_total']; 
				$row['project_total']    			 =    string_amount($row['project_total']);			
				$list['rows']						.=	view_populate($row, $template_row);
			}
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}// end get_production_report_per_network()
	
	

	
# Modify

	public function insert($post)
	{
		$data							        =	sql_parse_input('sales_network', $post);
		$data['sales_network_timestamp']		=	time();			
		$sql									=	sql_insert($this->table_name, $data);		
		
		$return['result']				=	true;
		$return['data']					=	$sql;
		$return['message']				=	$this->message_insert;		
	}
	
	 public function update($post, $id)
	{
	    sql_update($this->table_name, 'sales_network_id', $id, $post);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}	
    

    
    
 
	
}
