<?php
class model_project
{	
	
	public function __construct()
	{
		$this->table_name		=	'project';
		$this->message_insert	=	'A new Project has been successfully added.';
	}
	
# Data Select

	public function select_all()
	{		
		$query	=	"select 
						* 
					   
					   from 
					   
					   project 					
						";		
								
		$rows	=	sql_select($query);		
		return $rows;
	}
	
	
	
	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		
		$query	=	"select 
						*,
						(select count(project_site_id) from project_site where project_id = '{$id}') as project_site_count,
						(select count(project_site_block_id) from project_site_block where project_id = '{$id}') as project_site_block_count,
						(select count(lot_id) from lot where project_id = '{$id}') as lot_count,
						(select count(lot_id) from lot where project_id = '{$id}' AND option_availability_id = 1) as lot_available_count
					from project 					
						left join option_project_status ON option_project_status.option_project_status_id = project.option_project_status_id 				
					where project.project_id = {$id}";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
	public function select_row()
	{		
		$id		=	string_clean_number($id);		
		$query	=	"select 
						* 
					from project 					
						left join option_project_status ON option_project_status.option_project_status_id = project.option_project_status_id 				
					where project.project_id = {$id}";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
# Get Ouput
 
	public function get_row()
	{
		# DB
		$query	=	"
					SELECT 
						*,
						(select count(project_site_id) from project_site where project_id = project.project_id) as project_site_count,
						(select count(project_site_block_id) from project_site_block where project_id = project.project_id) as project_site_block_count,
						(select count(lot_id) from lot where project_id = project.project_id) as lot_count,
						(select count(lot_id) from lot where project_id = project.project_id AND option_availability_id = 'available') as lot_available_count 		
					FROM project 
						left join option_project_status ON option_project_status.option_project_status_id = project.option_project_status_id						
					
					ORDER BY project.project_name ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_inventory/template/row.project';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'edp_inventory/template/row.project.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$list	.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	} 
	 
	public function get_project_price($id)
	{
		$id		=	$id * 1;
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM project_price 
						inner join user ON user.user_id = project_price.user_id									
						inner join project ON project.project_id = project_price.project_id	
						inner join project_site on project_site.project_id = project.project_id
					WHERE project_price.project_id = '{$id}'								
					ORDER BY project_site.project_site_name ASC, project_price.project_price_timestamp DESC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_inventory/template/row.project.price';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'edp_inventory/template/row.project.price.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		 
		if(count($rows))
		{
			foreach($rows as $row)
			{			
				
				$row['project_price_value']				=	string_amount($row['project_price_value']);
				$row['project_price_adjustment']		=	($row['project_price_adjustment']) ? "<span class=\"color_green\">Increase</span>" : "<span class=\"color_red\">Decrease</span>";
				$row['project_price_timestamp']			=	string_date_time($row['project_price_timestamp']);
				$list									.=	view_populate($row, $template_row);
			}			
		}	
		else
		{
			$list	=	$template_row_empty;
		}	
		return $list;
	}
	
// For Engineering

	public function get_projects_row()
	{
		# DB
		$query	=	"
					SELECT 
						*,
						(select count(project_site_id) from project_site where project_id = project.project_id) as project_site_count,
						(select count(project_site_block_id) from project_site_block where project_id = project.project_id) as project_site_block_count,
						(select count(lot_id) from lot where project_id = project.project_id) as lot_count,
						(select count(lot_id) from lot where project_id = project.project_id AND option_availability_id = 'available') as lot_available_count, 
						(select count(lot_id) from lot where project_id = project.project_id AND option_availability_id = 'sold') as lot_sold_count, 
						(select count(lot_id) from lot where project_id = project.project_id AND option_availability_id = 'on_hold') as lot_hold_count 
						,
						(
							SELECT SUM(CASE WHEN option_unit.option_unit_type='zone' THEN  1 ELSE 0 END) 
					
							FROM lot
							
							INNER JOIN option_unit ON option_unit.option_unit_id = lot.option_unit_id
						
							WHERE lot.project_id = project.project_id
							
						) as zone_count		
					
					FROM project 
						
					
					left join option_project_status ON option_project_status.option_project_status_id = project.option_project_status_id						
					
					ORDER BY project.project_name ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'engineering/template/row.project';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering/template/row.project.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$row['zone_count']  = ($row['zone_count']) ? $row['zone_count'] : 0;
				$list	.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	} 
	
// FOR Sales Report

	public function get_sales_distribution_per_transaction_type()
	{		
		
		# DB
		$query	=	"
					SELECT GROUP_CONCAT(client_account_id) AS c_a_id,
					project.project_name,project.project_acronym,project_site.project_site_name,project_site.project_id, project_site.project_site_id,  
					SUM(CASE WHEN client_account.option_transaction_type_id = 'regular' AND client_account.option_account_status_id != 'retention' THEN 1 ELSE 0 END) AS regular_count,
					SUM(CASE WHEN client_account.option_transaction_type_id = 'offset' AND client_account.option_account_status_id != 'retention' THEN 1 ELSE 0 END) AS offset_count,
					SUM(CASE WHEN client_account.option_transaction_type_id = 'lease_to_own' AND client_account.option_account_status_id != 'retention' THEN 1 ELSE 0 END) AS lease_to_own_count,
					SUM(CASE WHEN client_account.option_transaction_type_id = 'special_account' AND client_account.option_account_status_id != 'retention' THEN 1 ELSE 0 END) AS special_account_count,
					SUM(CASE WHEN client_account.option_transaction_type_id = 'thru_loan' AND client_account.option_account_status_id != 'retention' THEN 1 ELSE 0 END) AS thru_loan_count,
					SUM(CASE WHEN client_account.option_account_status_id   = 'retention' THEN 1 ELSE 0 END) AS retention_count,
					
					SUM(CASE WHEN client_account.option_transaction_type_id = 'regular' AND client_account.option_account_status_id != 'retention' THEN client_account.client_account_tcp_net ELSE 0 END) AS regular_sum,
					SUM(CASE WHEN client_account.option_transaction_type_id = 'offset' AND client_account.option_account_status_id != 'retention' THEN client_account.client_account_tcp_net ELSE 0 END) AS offset_sum,
					SUM(CASE WHEN client_account.option_transaction_type_id = 'lease_to_own' AND client_account.option_account_status_id != 'retention' THEN client_account.client_account_tcp_net ELSE 0 END) AS lease_to_own_sum,
					SUM(CASE WHEN client_account.option_transaction_type_id = 'special_account' AND client_account.option_account_status_id != 'retention' THEN client_account.client_account_tcp_net ELSE 0 END) AS special_account_sum,
					SUM(CASE WHEN client_account.option_transaction_type_id = 'thru_loan' AND client_account.option_account_status_id != 'retention' THEN client_account.client_account_tcp_net ELSE 0 END) AS thru_loan_sum,
					SUM(CASE WHEN client_account.option_account_status_id   = 'retention' THEN client_account.client_account_tcp_net ELSE 0 END) AS retention_sum,
					SUM(client_account_tcp_net) as project_total
						 
					
					FROM 

					project_site

					inner join project on project.project_id = project_site.project_id
					left join lot on lot.project_site_id = project_site.project_site_id
					left join client_account on client_account.lot_id = lot.lot_id  AND client_account.option_account_status_id NOT IN('ejected') 
					
					GROUP BY project_site_id					
					ORDER BY project_id,project_site_id ASC
					
					";
					
		$rows	            =	sql_select($query);
		# Template
	    $template_row		=	'sales/template/profile.report.transaction_type';
		$template_row		=	view_get_template($template_row);
		//hash_dump($rows,true);
		# Parse
		if(count($rows))
		{
			
			$list['total_regular_count']					=	0;
			$list['total_offset_count']						=	0;
			$list['total_lease_to_own_count']				=	0;
			$list['total_special_account_count']			=	0;
			$list['total_thru_loan_count']					=	0;
			$list['total_retention_count']					=	0;
			$list['total_project_count']					=	0;
			$list['total_regular_sum']						=	0;
			$list['total_offset_sum']						=	0;
			$list['total_lease_to_own_sum']					=	0;
			$list['total_special_account_sum']				=	0;
			$list['total_thru_loan_sum']					=	0;
			$list['total_retention_sum']					=	0;
			$list['total_regular_principal_paid']			=	0;
			$list['total_offset_principal_paid']			=	0;
			$list['total_lease_to_own_principal_paid']		=	0;
			$list['total_special_account_principal_paid']	=	0;
			$list['total_thru_loan_principal_paid']			=	0;
			$list['total_retention_principal_paid']			=	0;
			$list['total_takout']							=	0;
			//hash_dump($rows);
			foreach($rows as $row) 
			{  				
				
				$ca_id_string									 =  ($row['c_a_id']) ? $row['c_a_id'] : 0;
				$principal_row									 =  mvc_model('model.client_account_invoice')->select_paidup_per_transaction_type($ca_id_string);
				$row['proj_site']								 =    $row['project_acronym'] .'-'. $row['project_site_name']; 
				$row['takeout']									 =    0; 
				//hash_dump($row);
				//hash_dump($principal_row);
				$list['total_regular_count']					+=	$row['regular_count'];
				$list['total_offset_count']						+=	$row['offset_count'];
				$list['total_lease_to_own_count']				+=	$row['lease_to_own_count'];
				$list['total_special_account_count']			+=	$row['special_account_count'];
				$list['total_thru_loan_count']					+=	$row['thru_loan_count'];
				$list['total_retention_count']					+=	$row['retention_count'];
				$list['total_regular_sum']						+=	$row['regular_sum'];
				$list['total_offset_sum']						+=	$row['offset_sum'];
				$list['total_lease_to_own_sum']					+=	$row['lease_to_own_sum'];
				$list['total_special_account_sum']				+=	$row['special_account_sum'];
				$list['total_thru_loan_sum']					+=	$row['thru_loan_sum'];
				$list['total_retention_sum']					+=	$row['retention_sum'];
				$list['total_regular_principal_paid']			+=	$principal_row['regular_principal_paid'];
				$list['total_offset_principal_paid']			+=	$principal_row['offset_principal_paid'];
				$list['total_lease_to_own_principal_paid']		+=	$principal_row['lease_to_own_principal_paid'];
				$list['total_special_account_principal_paid']	+=	$principal_row['special_account_principal_paid'];
				$list['total_thru_loan_principal_paid']			+=	$principal_row['thru_loan_principal_paid'];
				$list['total_retention_principal_paid']			+=	$principal_row['retention_principal_paid'];
				
				$list['total_takeout']							+=	$row['takeout'];
				$row['project_count']							=    $row['regular_count']+$row['offset_count']+$row['lease_to_own_count']+$row['special_account_count']+$row['thru_loan_count']+$row['retention_count'];
				$row['regular_balance']		    				=    string_amount($row['regular_sum']-$principal_row['regular_principal_paid']);	
				$row['offset_balance']		    				=    string_amount($row['offset_sum']-$principal_row['offset_principal_paid']);	
				$row['lease_to_own_balance']					=    string_amount($row['lease_to_own_sum']-$principal_row['lease_to_own_principal_paid']);	
				$row['special_account_balance']					=    string_amount($row['special_account_sum']-$principal_row['special_account_principal_paid']);	
				$row['thru_loan_balance']		    			=    string_amount($row['thru_loan_sum']-$principal_row['thru_loan_principal_paid']);	
				$row['retention_balance']		    			=    string_amount($row['retention_sum']-$principal_row['retention_principal_paid']);	
				$row['project_balance']		    				=    string_amount(string_clean_number($row['regular_balance'])+string_clean_number($row['offset_balance'])+string_clean_number($row['lease_to_own_balance'])
																      +string_clean_number($row['special_account_balance'])+string_clean_number($row['thru_loan_balance'])+string_clean_number($row['retention_balance']));	
				$list['total_project_count']				   +=	 $row['project_count'];
				$list['rows']							   	   .=	 view_populate($row, $template_row);
				
			}
			//hash_dump($row,true);
				$list['total_regular_balance']		    		=    string_amount($list['total_regular_sum']-$list['total_regular_principal_paid']);	
				$list['total_offset_balance']		    		=    string_amount($list['total_offset_sum']-$list['total_offset_principal_paid']);	
				$list['total_lease_to_own_balance']				=    string_amount($list['total_lease_to_own_sum']-$list['total_lease_to_own_principal_paid']);	
				$list['total_special_account_balance']			=    string_amount($list['total_special_account_sum']-$list['total_special_account_principal_paid']);	
				$list['total_thru_loan_balance']		    	=    string_amount($list['total_thru_loan_sum']-$list['total_thru_loan_principal_paid']);	
				$list['total_retention_balance']		    	=    string_amount($list['total_retention_sum']-$list['total_retention_principal_paid']);
				
				$list['total_project_sum']		    			=    $list['total_regular_sum']+$list['total_offset_sum']+$list['total_lease_to_own_sum']+$list['total_special_account_sum']+$list['total_thru_loan_sum']+$list['total_retention_sum'];
				$list['total_project_balance']		    		=    string_amount(string_clean_number($list['total_regular_balance'])+string_clean_number($list['total_offset_balance'])
				                                                     +string_clean_number($list['total_lease_to_own_balance'])+string_clean_number($list['total_special_account_balance'])
				                                                     +string_clean_number($list['total_thru_loan_balance'])+string_clean_number($list['total_retention_balance']));
				
				$list['regular_percent']						=   round(( string_clean_number($list['total_regular_balance'])/$list['total_regular_sum'])*100,2);
				$list['offset_percent']							=   round(( string_clean_number($list['total_offset_balance'])/$list['total_offset_sum'])*100,2);
				$list['lease_to_own_percent']					=   round(( string_clean_number($list['total_lease_to_own_balance'])/$list['total_lease_to_own_sum'])*100,2);
				$list['special_account_percent']				=   round(( string_clean_number($list['total_special_account_balance'])/$list['total_special_account_sum'])*100,2);
				$list['thru_loan_percent']						=   round(( string_clean_number($list['total_thru_loan_balance'])/$list['total_thru_loan_sum'])*100,2);
				$list['retention_percent']						=   round(( string_clean_number($list['total_retention_balance'])/$list['total_retention_sum'])*100,2);
				$list['total_percent']						    =   round(( string_clean_number($list['total_project_balance'])/$list['total_project_sum'])*100,2);
			
				
		}
		else
		{
			$list	=	'';
		}
		//die();
		return $list;
	}// end get_sales_distribution_per_transaction_type
	
	
	public function get_sales_distribution_per_project()
	{		
		
		# DB
		$query	=	"
					SELECT 
					project.project_name,project.project_acronym,project_site.project_site_name,project_site.project_id, project_site.project_site_id, 
					COUNT(client_account_id)AS sale_count, 
					SUM(client_account_tcp_net) as project_total, 
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
					 
					project
					
					inner join project_site on project_site.project_id = project.project_id
					LEFT join lot on lot.project_site_id = project_site.project_site_id
					LEFT join client_account on client_account.lot_id = lot.lot_id AND client_account.client_account_id IN(SELECT DISTINCT client_account_id FROM sales_commission_account) AND client_account.option_account_status_id NOT IN('ejected','ejected') 

					GROUP BY project_site.project_site_id
										
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'sales/template/profile.report.project';
		$template_row		=	view_get_template($template_row);
		# Parse
		//hash_dump($rows,true);
		if(count($rows))
		{
			$list['total_paidup']					=	0;
			$list['total_tpv']						=	0;
			$list['total_lot_only']					=	0;
			$list['total_house_only']				=	0;
			$list['total_package']					=	0;
			$list['total_total']					=	0;
			$list['total_pv']						=	0;
			$list['total_uv']						=	0;
			foreach($rows as $row)
			{  				
				$row['tpv']							=    string_amount($row['project_total']); 
				$row['paidup']						=    string_amount($row['principal_paid']); 
				$row['lot']							=    $row['lot_only_count']; 
				$row['house']						=    $row['house_only_count']; 
				$row['package']		    			=    $row['package_count']; 
				$row['total_count']					=    $row['lot_only_count']+$row['package_count']+$row['house_only_count']; 
				$row['peso_val']					=    round(($row['principal_paid']/$row['project_total'])*100,2); 
				$row['unit_val']					=    $row['total_count'];//$row['project_acronym']; // ? where to get?
				$list['row.project']			   .=	 view_populate($row, $template_row);
				
				$list['total_paidup']			   +=	string_clean_number($row['paidup']);
				$list['total_tpv']			       +=	string_clean_number($row['tpv']);
				$list['total_lot_only']			   +=	$row['lot'];
				$list['total_house_only']		   +=	$row['house'];
				$list['total_package']			   +=	$row['package'];
				$list['total_total']			   +=	$row['total_count'];
				$list['total_pv']				   +=	$row['peso_val'];
				$list['total_uv']				   +=	$row['unit_val'];
			}
					
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}// end get_sales_distribution_per_project()
	
# Modify

	public function insert($post)
	{
		$data							=	sql_parse_input('project', $post);
		$data['project_timestamp']		=	time();			
		$sql							=	sql_insert($this->table_name, $data, 'project_id');		
		$return['result']				=	true;
		$return['data']					=	$sql;
		$return['message']				=	$this->message_insert;		
		return $sql['data'];
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('project', $post);					
									sql_update($this->table_name, 'project_id', $id, $data);		
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	 
	public function insert_project_price($post)
	{			
		$data								=	sql_parse_input('project_price', $post);	
		$data['project_price_timestamp']	=	time();	
		sql_insert('project_price', $data);
	}
	
	public function delete($id)
	{		
		$id	=	string_clean_number($id);
		$data['user_deleted']	=	1;
		sql_update($this->table_name, 'user_id', $id, $data);
	}
	 
	
}
