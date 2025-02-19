<?php
class model_sales_agent
{	
	
	public function __construct()
	{
		$this->table_name		=	'sales_agent';
		$this->message_insert	=	'A new Project has been successfully added.';
	}
	
# Data Select

	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		
		$query	=	"select 
						* from sales_agent where sales_agent_id = {$id}
						";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
	public function select_vp()
	{		
		$id		=	string_clean_number($id);
		
		$query	=	"select 
						* from sales_agent where sales_agent_position_id = 'vp_sales' AND is_deleted=0 AND option_agent_status_id='active'
						";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
	
	public function select_count()
	{		
		$id		=	string_clean_number($id);
		
		$query	=	"select 

							SUM(CASE WHEN option_agent_status_id = 'active' THEN 1 ELSE 0 END) AS active_count,
							SUM(CASE WHEN option_agent_status_id = 'inactive' THEN 1 ELSE 0 END) AS inactive_count

							FROM 

							sales_agent
					WHERE is_deleted = 0
						";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
	
	
	
	
	public function select_all_by_position_id($id)
	{		
		
		$query	=	"select 
						* 
						from 
						
						sales_agent 
						
						where sales_agent_position_id = '{$id}'
						
						AND    
						
						is_deleted = 0
						
						AND option_agent_status_id = 'active'
						";		
						
		$rows	=	sql_select($query);		
		
		return $rows;
	}
    
    public function select_agent($id,$form = 0, $filter = '')//if form is 0 return in template else return query row
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "select 
                        *,
                       (select option_agent_status_name from option_agent_status where option_agent_status.option_agent_status_id = sales_agent.option_agent_status_id) as option_agent_status_name,
                        (select option_civil_status_name from option_civil_status where option_civil_status_id = sales_agent.option_civil_status_id) as option_civil_status_name,
                        (select option_gender_name from option_gender where option_gender_id = sales_agent.option_gender_id) as option_gender_name,
                        (select sales_agent_position_name from sales_agent_position where sales_agent_position_id = sales_agent.sales_agent_position_id) as sales_agent_position_name,
                        (select sales_network_division_name from sales_network_division where sales_network_division_id = sales_agent.sales_network_division_id) as sales_network_division_name
                        
                    from sales_agent                     
                                    
                    where sales_agent_id = {$id}  
                    AND    is_deleted = 0
                    ";        
                                
        $rows                =    sql_select($query);
        $agent_row           =    $rows[0];        
        //hash_dump($agent_row,true);
        $template_row        =    'sales/template/profile.agent';
        $template_row        =    view_get_template($template_row);
        # Parse
        if(count($agent_row))
        {
                $agent_row['monthly_quota']		            = string_amount($agent_row['sales_agent_monthly_quota']);
                $agent_row['annual_quota']		            = string_amount($agent_row['sales_agent_monthly_quota']*12);
                $agent_row['agent_birthdate']		        = string_date($agent_row['sales_agent_birthdate']);
                $agent_row['agent_hire_date']		        = string_date($agent_row['sales_agent_hire_date']);
                $list        								=    view_populate($agent_row, $template_row);
        }
        else
        {
            $list            =    '';
        }
        if($form == 1)
        {
            $list            =    $agent_row; 
        }
        return $list;
    }
    
    public function select_all_agent($filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "select 
                        *,
                        (select option_agent_status_name from option_agent_status where option_agent_status_id = sales_agent.option_agent_status_id) as option_agent_status_name,
                        (select sales_agent_position_name from sales_agent_position where sales_agent_position_id = sales_agent.sales_agent_position_id) as sales_agent_position_name
                        
                    from sales_agent                     
                                    
                    where sales_agent.is_deleted = 0
                    
                    AND sales_agent.option_agent_status_id='active' 
                    
                    AND sales_agent_position_id != 'vp_sales'
                    
                    {$filter}
                    
                  
                    ";        
                                
        $rows                =    sql_select($query);        
        $template_row        =    'sales/template/row.agent';
        $template_row        =    view_get_template($template_row);
        # Parse
        if(count($rows))
        {
            foreach($rows as $row)
            {        
                 $column								  =   ($row['sales_agent_position_id'] == 'sales_manager') ? 'sales_agent_id_sm' : 'sales_agent_id_pc';
                 $column								  =   ($row['sales_agent_position_id'] == 'sales_director') ? 'sales_agent_id_sd' : $column;
                 $row['lot_hold']						  =    mvc_model('model.sales_agent_lot')->count_hold($row['sales_agent_id'],$column);
                 $row['total_commission']		   		  =    string_amount(mvc_model('model.client_account_agent')->select_total_commission_by_agent($row['sales_agent_id']));
                 $backout_cost                            =    mvc_model('model.sales_commission_account')->get_total_sales($row['sales_agent_id'], "ejected");
                 $sales_cost                              =    mvc_model('model.sales_commission_account')->get_total_sales($row['sales_agent_id'], "all");
                 $fully_paid_cost                         =    mvc_model('model.sales_commission_account')->get_total_sales($row['sales_agent_id'], "fully_paid");
                 $row['fully_paid_count']                 =    $fully_paid_cost['count'];
                 $row['monthly_quota']                     =    string_amount($row['sales_agent_monthly_quota']);
                 $row['annual_quota']                     =    string_amount($row['sales_agent_monthly_quota']*12);
                 $row['sales_cost']                       =    string_amount($sales_cost['sum']);
                 $row['backout_cost']					  =    string_amount($backout_cost['sum']);
        		 $row['backout_count']					  =    $backout_cost['count'];
                 $row['total_paidup']                     =    string_amount(mvc_model('model.sales_commission_account')->get_total_paidup($row['sales_agent_id']));
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
	 

	public function get_counts()
	{		
		$id		=	string_clean_number($id);		
		$query	=	"select 
		
						(count(*) FROM sales_agent WHERE option_agent_status_id = 'active' AND is_deleted = 0) AS active_count,
						(count(*) FROM sales_agent WHERE option_agent_status_id = 'inactive' AND is_deleted = 0) AS inactive_count,
						(count(*) FROM sales_agent WHERE sales_agent_position_id = 'property_consultant' AND is_deleted = 0) AS property_consultant_count,
						(count(*) FROM sales_agent WHERE sales_agent_position_id = 'sales_manager' AND is_deleted = 0) AS sales_manager_count,
						(count(*) FROM sales_agent WHERE sales_agent_position_id = 'sales_director' AND is_deleted = 0) AS sales_director_count
						
					from 
					
					sales_agent 					
					";
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
# Get Ouput

//==========for sales director
public function select_all_director($filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           SELECT * FROM sales_agent WHERE sales_agent_position_id = 'sales_director' AND is_deleted = 0 AND option_agent_status_id='active' 
                        ";        
                                
        $rows                =    sql_select($query);        
        $template_row        =    'sales/template/row.sales_director';
        $template_row        =    view_get_template($template_row);
        # Parse
        //  hash_dump($rows,true);
         if(count($rows))
        {
            $ca_id 									  	  =    array(0);
            foreach($rows as $row)
            {        
                
                $director_manager						  =    mvc_model('model.sales_agent_agent')->select_by_head($row['sales_agent_id']);
		        //hash_dump($director_manager,true);
		        $row['agent_count'] 					  =    0; 
		        $row['sales_cost']  					  =    0;
		        $row['sales_count'] 					  =    0;
		        $row['backout_count'] 					  =    0;
		        $row['backout_cost'] 					  =    0;
		        $row['total_paidup'] 					  =    0;    
		          foreach($director_manager as $sales_man)
		          {      
		                $agents									  =   mvc_model('model.sales_agent_agent')->select_by_head($sales_man['sales_agent_id']);
		                $row['agent_count'] 					 +=    count($agents);
		                
		                
		                foreach($agents as $agent_row)
		                {
							$ca_id_string						=    implode(",",$ca_id);
							$sales								=    mvc_model('model.sales_commission_account')->get_total_sales($agent_row['sales_agent_id'],"all" ," AND sales_commission_account.client_account_id NOT IN({$ca_id_string})",'new');    
							$backout                        	=    mvc_model('model.sales_commission_account')->get_total_sales($agent_row['sales_agent_id'],"ejected" , " AND sales_commission_account.client_account_id NOT IN({$ca_id_string})",'new');     
							$row['total_paidup']		   	   +=    mvc_model('model.sales_commission_account')->get_total_paidup($agent_row['sales_agent_id'],'' ," AND sales_commission_account.client_account_id NOT IN({$ca_id_string})",'new');
							if($sales['ca_id'])
							{
								$ca_id[]						=  $sales['ca_id']  ; 
							}
							$row['backout_cost']			   +=    $backout['sum'];
		                    $row['backout_count']			   +=    $backout['count'];
							$row['sales_cost']                 +=    $sales['sum'];
							$row['sales_count']                +=    $sales['count'];
		                }
		                
		            } //end manager loop 
		        $row['sales_cost']					    =    string_amount($row['sales_cost']);
		        $row['backout_cost']					=    string_amount($row['backout_cost']);
		        $row['total_paidup']					=    string_amount($row['total_paidup']);
		        $list                                  .=    view_populate($row, $template_row); 
		     }//end director loop         
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }
    
//==========for sales manager

    public function select_all_manager($filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           SELECT * FROM sales_agent WHERE sales_agent_position_id = 'sales_manager' AND is_deleted = 0 AND option_agent_status_id='active' 
                        ";        
                                
        $rows                =    sql_select($query);        
        $template_row        =    'sales/template/row.sales_manager';
        $template_row        =    view_get_template($template_row);
        # Parse
        if(count($rows))
        {
        	$ca_id[] 								  =    0;
            foreach($rows as $row)
            {        
                $agents									  =   mvc_model('model.sales_agent_agent')->select_by_head($row['sales_agent_id']);
                $row['agent_count'] 					  =    count($agents);
                $row['sales_cost']  					  =    0;
                $row['sales_count'] 					  =    0;
                $row['backout_count'] 					  =    0;
                $row['backout_cost'] 					  =    0;
                $row['total_paidup'] 					  =    0;
                
                
                foreach($agents as $agent_row)
                {
					$ca_id_string						  =    implode(",",$ca_id);
					$sales								  =    mvc_model('model.sales_commission_account')->get_total_sales($agent_row['sales_agent_id'],"all" ," AND sales_commission_account.client_account_id NOT IN({$ca_id_string})",'old');    
					$backout                       	      =    mvc_model('model.sales_commission_account')->get_total_sales($agent_row['sales_agent_id'],"ejected" , " AND sales_commission_account.client_account_id NOT IN({$ca_id_string})",'old');     
					$row['total_paidup']		   		 +=    mvc_model('model.sales_commission_account')->get_total_paidup($agent_row['sales_agent_id'],'' ," AND sales_commission_account.client_account_id NOT IN({$ca_id_string})",'old');
					if($sales['ca_id'])
					{
						$ca_id[]						  =  $sales['ca_id']  ; 
					}
					
					$row['backout_cost']			     +=    $backout['sum'];
                    $row['backout_count']			     +=    $backout['count'];
					$row['sales_cost']                   +=    $sales['sum'];
					$row['sales_count']                  +=    $sales['count'];
                }
                $row['sales_cost']					      =    string_amount($row['sales_cost']);
                $row['backout_cost']					  =    string_amount($row['backout_cost']);
                $row['total_paidup']					  =    string_amount($row['total_paidup']);
                $list                                    .=    view_populate($row, $template_row);
            }            
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }
    
    public function select_by_sales_manager($id,$filter = '')
    {        
        $id        =    string_clean_number($id);
        $query     =    "
                           SELECT * FROM agent WHERE sales_manager_id = {$id}
                        ";        
                                
        $rows                =    sql_select($query);   
        $template_row		=	'sales/template/profile_row.sales_manager';
		$template_row		=	view_get_template($template_row);     
        if(count($rows))
        {
            foreach($rows as $row)
            {        
                $row['sales_manager_id'] = $id;
                $list	.=	view_populate($row, $template_row);
            }            
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }
    
    
//==========for division tab -> agents

    public function select_all_agent_by_division($id, $filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           SELECT * FROM sales_agent WHERE is_deleted = 0 
                           AND sales_network_division_id = {$id}
                        ";        
                                
        $rows                =    sql_select($query);        
        $template_row        =    'sales/template/row.division_agents';
        $template_row        =    view_get_template($template_row);
        # Parse
        if(count($rows))
        {
            foreach($rows as $row)
            {        
                 $backout_cost                            =    mvc_model('model.sales_commission_account')->get_total_sales($row['sales_agent_id'], "ejected","","old");
                 $sales_cost                              =    mvc_model('model.sales_commission_account')->get_total_sales($row['sales_agent_id'], "all","","old");
                 $fully_paid_cost                         =    mvc_model('model.sales_commission_account')->get_total_sales($row['sales_agent_id'], "fully_paid","","old");
                 $row['fully_paid_count']                 =    $fully_paid_cost['count'];
                 $row['sales_cost']                       =    string_amount($sales_cost['sum']);
                 $row['backout_cost']					  =    string_amount($backout_cost['sum']);
        		 $row['backout_count']					  =    $backout_cost['count'];
                 $row['total_paidup']                     =    string_amount(mvc_model('model.sales_commission_account')->get_total_paidup($row['sales_agent_id'],'',"",'old')); 
                 $row['backout_percent']                  =    round(($data['backout_cost'] / $data['sales_cost']) * 100,2);
                 $list									 .=	view_populate($row, $template_row);
            }            
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }
    
    
    public function select_by_division($id,$filter = '')
	{		
		$id		=	string_clean_number($id);
		$query	=	"
						SELECT * FROM sales_agent WHERE is_deleted = 0 
                           AND sales_network_division_id = {$id}
						";		
								
		$rows	=	sql_select($query);		
		return $rows;
	}
	
	
	
//==========for network	

   public function select_all_agent_by_network($id, $filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           SELECT * FROM agent WHERE option_agent_position_id = 'marketing_associate' AND is_deleted = 0 
                           AND network_id = {$id}
                        ";        
                                
        $rows                =    sql_select($query);        
        $template_row        =    'sales/template/row.sales_manager';
        $template_row        =    view_get_template($template_row);
        # Parse
        if(count($rows))
        {
            foreach($rows as $row)
            {        
                
            }            
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }
    
// FOR Sales Report=================================================================

	public function get_production_report_per_marketing_associate()
	{		
		
		# DB
		$query	=	"
					SELECT *,
					COUNT(sales_commission_account_id)AS sale_count, 
					SUM(client_account.client_account_tcp_net) as project_total 

					FROM 

					sales_agent
										
					LEFT join sales_commission_account ON  sales_agent.sales_agent_id IN(sales_commission_account.old_sales_agent_id_ma) 
																				
					LEFT join client_account ON client_account.client_account_id = sales_commission_account.client_account_id
					
					LEFT join sales_network_division on  sales_network_division.sales_network_division_id = sales_agent.sales_network_division_id
					
					WHERE sales_agent.sales_agent_position_old_id = 'marketing_associate'

					GROUP BY sales_agent.sales_agent_id
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'sales/template/profile.report.marketing_associate';
		$template_row		=	view_get_template($template_row);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row) // for edit 
			{  				
				$row['network_division']			=    $row['sales_network_division_name']; 
				$row['tpv']							=    string_amount($row['project_total']); 
				$list['row.division']			   .=	 view_populate($row, $template_row);
				
				$list['total_paidup']			   +=	string_clean_number($row['paidup']);
				$list['total_tpv']			       +=	string_clean_number($row['tpv']);
			}
				
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}// end get_production_report_per_marketing_associate()
	

		public function get_production_report_per_manager($year_date='2015')
	{		
		# DB
		$filter	=   " AND DATE_FORMAT(FROM_UNIXTIME(`sales_commission_account_timestamp`), '%Y') = 
								'{$year_date}' ";
		$query	=	"
					SELECT DISTINCT *,
					 sales_commission_account.client_account_id AS client_account_id,

					COUNT(sales_commission_account_id)AS sale_count, 
					SUM(client_account.client_account_tcp_net) as project_total 

					FROM 

					sales_agent

					LEFT join sales_agent_agent on  sales_agent_agent.sales_agent_id = (SELECT GROUP_CONCAT(sales_agent_id)  FROM sales_agent_agent WHERE sales_agent_head_id  = sales_agent.sales_agent_id)

					LEFT join sales_commission_account ON  sales_agent_agent.sales_agent_id 
					IN(
					sales_commission_account.sales_agent_id_sm,								
					sales_commission_account.sales_agent_id_pc) 
					{$filter}
					LEFT join client_account ON client_account.client_account_id = sales_commission_account.client_account_id

					WHERE sales_agent.sales_agent_position_id = 'sales_manager'

					GROUP BY sales_agent.sales_agent_id
					";
		$rows	=	sql_select($query);
		//hash_dump($query,true);
		# Template
	    $template_row		=	'sales/template/profile.report.sales_manager';
		$template_row		=	view_get_template($template_row);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)  
			{  				
				$row['peso_variance']				 =    string_amount(($row['project_total'])-($row['sales_agent_monthly_quota']*12));
				$row['percent_variance']		     =    ($row['peso_variance'] /($row['sales_agent_monthly_quota']*12))*100;
				$row['percent_production']		     =    ($row['project_total'] /($row['sales_agent_monthly_quota']*12))*100;
				$row['percent_variance']		     =   round($row['percent_variance'],2);
				$row['percent_production']		     =   round($row['percent_production'],2);
				
				
				$list['total_quota']			   	+=    $row['sales_agent_monthly_quota']*12; 
				$list['sales']			   			+=    $row['project_total']; 
				$row['project_total']    			 =    string_amount($row['project_total']);			
				$row['agent_quota']    			     =    string_amount($row['sales_agent_monthly_quota']*12);
				$list['rows']						.=	view_populate($row, $template_row);
				
			}
			
				$list['total_peso_variance']	      =    $list['sales'] - ($list['total_quota']);
				$list['total_percent_variance']		  =    ($list['total_peso_variance'] /$list['total_quota'])*100;
				$list['total_percent_production']	  =    ($list['sales'] /$list['total_quota'])*100;
				$list['total_percent_production']	  =    round($list['total_percent_production'],2);
				$list['total_percent_variance']	  	  =    round($list['total_percent_variance'],2);
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}// end get_production_report_per_director()
	
	
		public function get_production_report_per_property_consultant($year_date='2015')
	{		
		$filter	=   " AND DATE_FORMAT(FROM_UNIXTIME(`sales_commission_account_timestamp`), '%Y') = 
								'{$year_date}' ";
		# DB
		$query	=	"
					SELECT DISTINCT *,
					 sales_commission_account.client_account_id AS client_account_id,

					COUNT(sales_commission_account_id)AS sale_count, 
					SUM(client_account.client_account_tcp_net) as project_total 

					FROM 

					sales_agent

					LEFT join sales_commission_account ON  sales_agent.sales_agent_id 
					IN(
					sales_commission_account.sales_agent_id_pc) 
					{$filter}
					LEFT join client_account ON client_account.client_account_id = sales_commission_account.client_account_id
					
					WHERE sales_agent.sales_agent_position_id = 'property_consultant'

					GROUP BY sales_agent.sales_agent_id
					";
		$rows	=	sql_select($query);
		# Template
	    $template_row		=	'sales/template/profile.report.prop_con';
		$template_row		=	view_get_template($template_row);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)  
			{  				
				$list['sales']			   			+=    $row['project_total']; 
				$list['total_quota']			   	+=    $row['sales_agent_monthly_quota']*12; 
				$row['project_total']    			 =    string_amount($row['project_total']);			
				$row['agent_quota']    			     =    string_amount($row['sales_agent_monthly_quota']*12);			
				$list['rows']						.=	view_populate($row, $template_row);
			}
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}// end get_production_report_per_property_consultant()
	
	
	public function get_production_report_daily_new_scheme($report_date='')
	{		
		//new query get profile of sales dir and sales man
		# DB
		if($report_date)
		{
			$filter	=  $filter	=   "'{$report_date}'";
		}
		else
		{
			$filter	=   "CURDATE()";
		}
		
		
		$query	=	"
						SELECT DISTINCT *,
						 sales_commission_account.client_account_id AS client_account_id,

						COUNT(sales_commission_account_id)AS sale_count, 
						SUM(client_account.client_account_tcp_net) as project_total 

						FROM 

						sales_agent

						LEFT join sales_commission_account ON  sales_agent.sales_agent_id 
						IN(
						sales_commission_account.sales_agent_id_pc) 
						
						AND	DATE_FORMAT(FROM_UNIXTIME(`sales_commission_account_timestamp`), '%Y-%m-%d') = 
						{$filter}				

						LEFT join client_account ON client_account.client_account_id = sales_commission_account.client_account_id

						WHERE sales_agent.sales_agent_position_id = 'property_consultant'

						GROUP BY sales_agent.sales_agent_id

					";
		//hash_dump($query,true);
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'sales/template/profile.report.new.daily';
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
		$post['int']['sales_agent_birthdate'] 	=   strtotime($post['int']['sales_agent_birthdate']); 
		$post['int']['sales_agent_hire_date'] 	=   strtotime($post['int']['sales_agent_hire_date']); 
		$data									=	sql_parse_input('sales_agent', $post);
		$data['sales_agent_timestamp']			=	time();			
		//hash_dump($data,true);
		$sql									=	sql_insert($this->table_name, $data,'sales_agent_id');		
		$return['result']						=	true;
		$return['data']							=	$sql;
		$return['message']						=	$this->message_insert;
		return $return;		
	}
    
    public function update_agent($post, $id)
    {
        $post['int']['sales_agent_birthdate'] 	=   strtotime($post['int']['sales_agent_birthdate']); 
		$post['int']['sales_agent_hire_date'] 	=   strtotime($post['int']['sales_agent_hire_date']);
        $data                          		    =    sql_parse_input('sales_agent', $post);                    
        sql_update($this->table_name, 'sales_agent_id', $id, $data);        
        $return['result']               =    true;
        $return['data']                 =    '';
        $return['message']              =    $this->message_update;
        
    }
    
    public function delete_agent($id)
    {        
        $id                             =    string_clean_number($id);
        $data['is_deleted']             =    1;
        sql_update($this->table_name, 'sales_agent_id', $id, $data);
        $return['result']               =    true;
        $return['data']                 =    '';
        $return['message']              =    $this->message_update;
    }
    
     
	public function update($post, $id)
	{
		$data                   =    sql_parse_input('sales_agent', $post);    
       // hash_dump($data,true);
        sql_update($this->table_name, 'sales_agent_id', $id, $data);  
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
	}
		 
	
}
