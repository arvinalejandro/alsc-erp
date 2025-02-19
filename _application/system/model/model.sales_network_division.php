<?php
class model_sales_network_division
{    
    
    public function __construct()
    {
        $this->table_name        =    'sales_network_division';
        $this->message_insert    =    'A new Network has been successfully added.';
    }
    
# Data Select
   
   
   
    public function select_division($id, $filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                                 SELECT 
                                
                                 *,
                                 (select sales_network_name from sales_network where sales_network_id = sales_network_division.sales_network_id) as sales_network_name, 
                                 (select COUNT(*) from sales_agent where sales_agent.sales_network_division_id = sales_network_division.sales_network_division_id ) as agent_count
                                 
                                 FROM 
                                
                                 sales_network_division  
                                 
                                 
                                 WHERE sales_network_division_id = {$id}
                        "; 
        $rows                =    sql_select($query);
        $list                =    $rows[0];        
                            
       
        return $list;
    }
    
    public function select_division_by_network($id, $filter = '')
    {        
        $id        =    string_clean_number($id);
        $query     =    "
                                 SELECT 
                                
                                 *
                                 
                                 FROM 
                                
                                 sales_network_division  
                                 
                                 WHERE sales_network_id = {$id}
                        "; 
        $rows                =    sql_select($query);
        return $rows;
    }
    
    public function select_all_division($filter = '')
    {        
        
        $query     =    "
                            SELECT 
                            
                            *
                             FROM sales_network_division
                        ";        
                                
        $rows                =    sql_select($query);        
        $template_row        =    'sales/template/row.division';
        $template_row        =    view_get_template($template_row);
        # Parse
        if(count($rows))
        {
            $ca_id 									=    array(0);
            foreach($rows as $row)
            {        
                $agents             					=    mvc_model('model.sales_agent')->select_by_division($row['sales_network_division_id']);
                $row['agent_count'] 					=    count($agents);
                $row['sales_cost']  					=    0;
                $row['sales_count'] 					=    0;
                $row['backout_count'] 					=    0;
                $row['backout_cost'] 					=    0;
                $row['total_paidup'] 					=    0;
                
                
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
    
    
    
    public function select_all_division_by_network_id($id,$filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                            SELECT 
                            
                            *
                             FROM sales_network_division
                             
                             WHERE sales_network_id = {$id}
                        ";        
                                
        $rows                =    sql_select($query);        
        $template_row        =    'sales/template/row.division';
        $template_row        =    view_get_template($template_row);
        # Parse
        if(count($rows))
        {
            $ca_id 									=    array(0);
            foreach($rows as $row)
            {        
                $agents             					=    mvc_model('model.sales_agent')->select_by_division($row['sales_network_division_id']);
                $row['agent_count'] 					=    count($agents);
                $row['sales_cost']  					=    0;
                $row['sales_count'] 					=    0;
                $row['backout_count'] 					=    0;
                $row['backout_cost'] 					=    0;
                $row['total_paidup'] 					=    0;
                
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
    
      //for sales division profile
    public function select_all_division_counts($id,$filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           SELECT * FROM sales_network_division WHERE sales_network_division_id = {$id}
                        ";        
                                
        $rows                =    sql_select($query);        
        # Parse
        if(count($rows))
        {
           $ca_id 									=    array(0);
            foreach($rows as $row)
            {        
				 $agents             			    =    mvc_model('model.sales_agent')->select_by_division($id);
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
    
    
    public function select_division_network($id, $filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           SELECT 
                           
                           * 
                           
                           FROM 
                           
                           sales_network_division
                           
                           inner join sales_network ON  sales_network.sales_network_id = sales_network_division.sales_network_id
                           
                           WHERE sales_network_division_id = {$id}
                        ";        
                                
        $rows                =    sql_select($query);
        $list                =    $rows[0];        
       
        return $list;
    }
    
    public function select_division_row($id, $filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           SELECT 
                           
                           * 
                           
                           FROM 
                           
                           sales_network_division
                           
                           WHERE sales_network_division_id = {$id}
                        ";        
                                
        $rows                =    sql_select($query);
        $list                =    $rows[0];        
       
        return $list;
    }
    
    
// ============FOR Sales Report
	public function get_production_report_per_division()
	{		
		
		# DB
		$query	=	"
					SELECT DISTINCT sales_commission_account.client_account_id AS client_account_id,
					sales_network_division.sales_network_division_name,sales_network.sales_network_name, 
					COUNT(client_account.client_account_id)AS sale_count, 
					SUM(client_account.client_account_tcp_net) as project_total, 
					SUM(CASE WHEN client_account.option_unit_account_type_id = 'package' THEN 1 ELSE 0 END) AS package_count,
					SUM(CASE WHEN client_account.option_unit_account_type_id = 'lot_only' THEN 1 ELSE 0 END) AS lot_only_count,
					SUM(CASE WHEN client_account.option_unit_account_type_id = 'house_only' THEN 1 ELSE 0 END) AS house_only_count,
							
							(
							SELECT SUM(CASE WHEN client_account_invoice.option_account_invoice_type_id IN ('monthly_dp', 'monthly_amortization') THEN  receive_amount_principal ELSE 0 END) 
					
							FROM account_receive_invoice 
							
							inner join client_account_invoice ON client_account_invoice.client_account_invoice_id = account_receive_invoice.client_account_invoice_id
						
							WHERE account_receive_invoice.client_account_id = client_account.client_account_id
							
							) as principal_paid

					FROM 

					sales_network_division

					INNER join sales_network ON sales_network.sales_network_id = sales_network_division.sales_network_id
					
					LEFT join sales_agent on  sales_agent.sales_network_division_id = sales_network_division.sales_network_division_id

					LEFT join sales_commission_account ON  sales_agent.sales_agent_id IN(
																				sales_commission_account.old_sales_agent_id_ma)
																				
					LEFT join client_account ON client_account.client_account_id = sales_commission_account.client_account_id

					GROUP BY sales_network_division.sales_network_division_id
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'sales/template/profile.report.division';
		$template_row		=	view_get_template($template_row);
		# Parse
		if(count($rows))
		{
			$list['total_paidup']					=	0;
			$list['total_tpv']						=	0;
			$list['total_lot_only']					=	0;
			$list['total_house_only']				=	0;
			$list['total_package']					=	0;
			$list['total_lease']					=	0;
			$list['total_total']					=	0;
			foreach($rows as $row)
			{  				
				//hash_dump($row,1);
				$row['network_division']			=    $row['sales_network_name'] .' - '.$row['sales_network_division_name']; 
				$row['tpv']							=    string_amount($row['project_total']); 
				$row['paidup']						=    string_amount($row['principal_paid']); 
				$row['lot']							=    $row['lot_only_count']; 
				$row['house']						=    $row['house_only_count']; 
				$row['package']		    			=    $row['package_count']; 
				$row['lease']		    			=    0; 
				$row['peso_variance']		    	=    'N/A'; 
				$row['percent_variance']		    =    'N/A'; 
				$row['prod_variance']		    	=    'N/A'; 
				$row['total_count']					=    $row['lot_only_count']+$row['package_count']+$row['house_only_count']; 
				$row['peso_val']					=    round(($row['principal_paid']/$row['project_total'])*100,2); 
				$list['row.division']			   .=	 view_populate($row, $template_row);
				
				$list['total_paidup']			   +=	string_clean_number($row['paidup']);
				$list['total_tpv']			       +=	string_clean_number($row['tpv']);
				$list['total_lot_only']			   +=	$row['lot'];
				$list['total_house_only']		   +=	$row['house'];
				$list['total_package']			   +=	$row['package'];
				$list['total_lease']			   +=	$row['lease'];
				$list['total_total']			   +=	$row['total_count'];
			}
					
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}// end get_sales_distribution_per_division()
	
	
	public function get_production_report_per_sales_manager_old()
	{		
		
		# DB
		$query	=	"
					SELECT DISTINCT  *,sales_commission_account.sales_commission_account_id, 
					COUNT(sales_commission_account_id)AS sale_count, 
					SUM(client_account.client_account_tcp_net) as project_total 

					FROM 

					sales_network_division
					
					LEFT join sales_agent on  sales_agent.sales_agent_id = sales_network_division.sales_agent_id 
					
					LEFT join sales_commission_account ON  sales_agent.sales_agent_id IN(
																				sales_commission_account.old_sales_agent_id_sm) 
																				
					LEFT join client_account ON client_account.client_account_id = sales_commission_account.client_account_id

					GROUP BY sales_network_division.sales_network_division_id
					";
		$rows	=	sql_select($query);
		//hash_dump($rows,1);
		# Template
		$template_row		=	'sales/template/profile.report.old.sales_manager';
		$template_row		=	view_get_template($template_row);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row) // for edit 
			{  				
				//$data				                =    mvc_model('model.sales_agent')->select_agent($row['sales_agent_id'],1);
				
				//hash_dump($data,1);
				//$row['sales_agent_first_name']		=    $data['sales_agent_first_name']; 
				//$row['sales_agent_last_name']		=    $data['sales_agent_last_name']; 
				//['sales_agent_middle_initial']  =    $data['sales_agent_middle_initial']; 
				$row['network_division']			=    $row['sales_network_division_name']; 
				$row['tpv']							=    string_amount($row['project_total']); 
				$row['paidup']						=    string_amount($row['principal_paid']); 
				$row['peso_variance']		    	=    'N/A'; 
				$row['percent_variance']		    =    'N/A'; 
				$row['prod_variance']		    	=    'N/A'; 
				$list['row.division']			   .=	 view_populate($row, $template_row);
				
				$list['total_paidup']			   +=	string_clean_number($row['paidup']);
				$list['total_tpv']			       +=	string_clean_number($row['tpv']);
				$list['total_prod_variance']	    =	 'N/A'; 
			}
				
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}// end get_production_report_per_sales_manager()
	
	
		public function get_production_report_daily_old_scheme($report_date='')
	   {		
		
		if($report_date)
		{
			$filter	=   "'{$report_date}'";
		}
		else
		{
			$filter	=   "CURDATE()";
		}
		  # DB
		$query	=	"
					
					
					SELECT DISTINCT sales_commission_account.client_account_id AS client_account_id,
					sales_network_division.sales_network_division_name,sales_network.sales_network_name, 
					SUM(client_account.client_account_tcp_net) as project_total 

					FROM 

					sales_network_division

					INNER join sales_network ON sales_network.sales_network_id = sales_network_division.sales_network_id
					
					LEFT join sales_agent on  sales_agent.sales_agent_id = sales_network_division.sales_agent_id

					LEFT join sales_commission_account ON  sales_agent.sales_agent_id IN(sales_commission_account.old_sales_agent_id_sm)
												AND	DATE_FORMAT(FROM_UNIXTIME(`sales_commission_account_timestamp`), '%Y-%m-%d') = 
					{$filter}							
					LEFT join client_account ON client_account.client_account_id = sales_commission_account.client_account_id

					GROUP BY sales_network_division.sales_network_division_id
					
					
					
					
					
					
				

					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'sales/template/profile.report.old.daily';
		$template_row		=	view_get_template($template_row);
		# Parse
		if(count($rows))
		{
			$list['total_tpv']						=	0;
			foreach($rows as $row)
			{  				
				//hash_dump($row,1);
				$row['network_division']			=    $row['sales_network_name'] .' - '.$row['sales_network_division_name']; 
				$row['tpv']							=    string_amount($row['project_total']); 
				$list['row.division']			   .=	 view_populate($row, $template_row);
				$list['total_tpv']			       +=	string_clean_number($row['tpv']);
			}
					
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}// end get_production_report_daily()


# Modify

    public function insert($post)
    {
        $data                                   =    sql_parse_input('sales_network_division', $post);
        $data['sales_network_division_timestamp']     =    time();            
        $sql                                    =    sql_insert($this->table_name, $data);        
        $return['result']                       =    true;
        $return['data']                         =    $sql;
        $return['message']                      =    $this->message_insert;        
    }
    
    public function update($post, $id)
	{
	    sql_update($this->table_name, 'sales_network_division_id', $id, $post);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}	
    

    
    
 
    
}
