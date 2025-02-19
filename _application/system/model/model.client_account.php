<?php
class model_client_account
{	
	
	public function __construct()
	{
		$this->table_name		=	'client_account';
		$this->message_insert	=	'A new lot has been successfully added.';
	}
	
# Data Select

	public function select_account_($id)
	{		
		$id		=	string_clean_number($id);
		
		$query	=	"SELECT 
						
						*			
					FROM client_account
					
					where client_account_id = {$id}";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
	public function check_account_by_lot($id)
	{		
		$id		=	string_clean_number($id);
		
		$query	=	"SELECT 
						
						*			
					FROM client_account
					
					where lot_id = {$id}
					
					AND option_account_status_id != 'ejected'
					
					";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}

	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		
		$query	=	"SELECT 
						*
						
					FROM client_account 
						inner join client on client.client_id = client_account.client_id					
						inner join client_account_structure on client_account_structure.client_account_structure_id = client_account.client_account_structure_id AND client_account_structure.client_account_structure_active = 1			
						
						inner join option_transaction_type on option_transaction_type.option_transaction_type_id = client_account.option_transaction_type_id
						inner join option_unit_account_type on option_unit_account_type.option_unit_account_type_id = client_account.option_unit_account_type_id
						inner join option_account_type on option_account_type.option_account_type_id = client_account.option_account_type_id
						inner join option_account_status on option_account_status.option_account_status_id = client_account.option_account_status_id
						inner join option_buyer_type on option_buyer_type.option_buyer_type_id = client_account.option_buyer_type_id												
						inner join option_account_p1 on option_account_p1.option_account_p1_id = client_account.option_account_p1_id
						inner join option_account_p2 on option_account_p2.option_account_p2_id = client_account.option_account_p2_id						
						inner join option_account_misc on option_account_misc.option_account_misc_id = client_account.option_account_misc_id					
						inner join user on user.user_id = client_account.user_id						
						inner join lot on lot.lot_id = client_account.lot_id	
						inner join option_unit on lot.option_unit_id = option_unit.option_unit_id	
						
						left join house on house.house_id = lot.house_id
						left join option_house_classification on option_house_classification.option_house_classification_id = house.option_house_classification_id							
						left join project on project.project_id = lot.project_id						
						left join project_site on project_site.project_site_id = lot.project_site_id						
						left join project_site_block on project_site_block.project_site_block_id = lot.project_site_block_id				
					
					where client_account.client_account_id = {$id}";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		
		$rows['house_price_sqm']		=	($rows['house_area']) ? 'P ' .string_amount(($rows['client_account_hcp'] / $rows['house_area'])) . ' / sqm' : 'P 0.00';
		$rows['client_account_vatable']	=	($rows['client_account_is_vat']) ? 'Yes' : 'No';
		
		return $rows;
	}
	
	
	
	
# Get Ouput - 957096

	public function get_row($id)
	{
		$id		=	$id * 1;
		# DB
		$query	=	"
					SELECT 
						*,
						client_account.* 		
					FROM client_account 
						inner join client on client.client_id = client_account.client_id		
						inner join client_account_structure on client_account_structure.client_account_structure_id = client_account.client_account_structure_id 				
						inner join option_transaction_type on option_transaction_type.option_transaction_type_id = client_account.option_transaction_type_id
						inner join user on user.user_id = client_account.user_id
						
						inner join option_unit_account_type on option_unit_account_type.option_unit_account_type_id = client_account.option_unit_account_type_id
						inner join option_account_type on option_account_type.option_account_type_id = client_account.option_account_type_id
						inner join option_account_status on option_account_status.option_account_status_id = client_account.option_account_status_id
						inner join option_buyer_type on option_buyer_type.option_buyer_type_id = client_account.option_buyer_type_id												
						inner join option_account_p1 on option_account_p1.option_account_p1_id = client_account.option_account_p1_id
						inner join option_account_p2 on option_account_p2.option_account_p2_id = client_account.option_account_p2_id
						
						
						
						left join lot on lot.lot_id = client_account.lot_id
						left join client_account_construction on client_account.client_account_id = client_account_construction.client_account_id
						
					
					where client_account.client_id = {$id}
					
					ORDER BY client_account.client_account_timestamp DESC
					";
		
		$rows	=	sql_select($query);
		
		#hash_dump($rows, 1);
		
		# Template
		$template_row		=	'edp_client/template/row.manage.account';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'edp_client/template/row.manage.account.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		#hash_dump($rows, 1);
		if(count($rows))
		{
			foreach($rows as $row)
			{                
				$row['client_account_tcp_net']	=	string_amount($row['client_account_tcp_net']);
				$row['type']	=	($row['option_unit_account_type_id'] == 'package' || $row['option_unit_account_type_id'] == 'lot_only') ? '' : 'display_none';
				#$row['action']	=	() ? '<a class="link_button_inline green" href="/edp_client/edp_client_manage/add_client/&id={lot_id}">New Account</a>' : '';
				$list			.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	public function get_billing_row()
	{		
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM client_account 
						inner join option_transaction_type on option_transaction_type.option_transaction_type_id = client_account.option_transaction_type_id
						inner join user on user.user_id = client_account.user_id
						inner join option_account_type on option_account_type.option_account_type_id = client_account.option_account_type_id
						inner join option_account_status on option_account_status.option_account_status_id = client_account.option_account_status_id
						inner join option_buyer_type on option_buyer_type.option_buyer_type_id = client_account.option_buyer_type_id
						inner join client on client.client_id = client_account.client_id						
						inner join option_account_p1 on option_account_p1.option_account_p1_id = client_account.option_account_p1_id
						inner join option_account_p2 on option_account_p2.option_account_p2_id = client_account.option_account_p2_id
						left join lot on lot.lot_id = client_account.lot_id
						left join project_site on project_site.project_site_id = lot.project_site_id
						left join project_site_block on project_site_block.project_site_block_id = lot.project_site_block_id
						
					
					ORDER BY client_account.client_account_number ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'finance_billing/template/row.account';
		$template_row		=	view_get_template($template_row);
		#$template_row_empty	=	'edp_client/template/row.manage.account.empty';
		#$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{                
				$row['client_account_date_sale']	=	string_date($row['client_account_date_sale']);
				$list			.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	 
	public function get_billing_due($id)
	{	 	
		# DB
		$query	=	"
					SELECT 
						*,
						(select sum(client_account_invoice_amount) from client_account_invoice where client_account_invoice_is_late = 1 and client_account_id = client_account.client_account_id AND client_account_invoice.option_invoice_status_id != 1) AS due_sum,						
						(select count(client_account_invoice_id) from client_account_invoice where client_account_invoice_is_late = 1 and client_account_id = client_account.client_account_id AND client_account_invoice.option_invoice_status_id != 1) AS due_count,						
						(select account_letter_name from account_letter where account_letter_id  = (select max(account_letter_id) from account_letter where client_account_id = client_account.client_account_id)) as account_letter_name,
						(select account_letter_timestamp from account_letter where account_letter_id  = (select max(account_letter_id) from account_letter where client_account_id = client_account.client_account_id)) as account_letter_timestamp
					
					FROM client_account	
					
					inner join client on client.client_id = client_account.client_id				
					
					where client_account_id IN (select client_account_id from client_account_invoice where client_account_invoice_is_late = 1)	
					
					having
					
						due_count > 0
					
					ORDER BY  client_account.client_account_number ASC
									
					";
		$rows	=	sql_select($query);		
		# Template
		$template_row		=	'finance_billing/template/row.due';
		$template_row		=	view_get_template($template_row);
		#$template_row_empty	=	'finance_billing/template/row.manage.account_invoice.empty';
		#$template_row_empty	=	view_get_template($template_row_empty);
		
		
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{	
				$row['client_account_focus_overdue_date']		=		($row['client_account_focus_overdue']) ? string_date($row['client_account_overdue_date']) : string_date($row['client_account_focus_overdue_date']);		
				$row['due_sum']		=		string_amount($row['due_sum']);		
				$row['account_letter_timestamp']		=	($row['account_letter_timestamp']) ? 	string_date_time($row['account_letter_timestamp']) : '';		
				$row['bold']		=		($row['client_account_focus_overdue']) ? 'bold' : '';		
				$list				.=		view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	'<tr><td colspan="10">No overdue accounts.</td></tr>';
		}
		return $list;
	}
	
	public function get_cashier_row() # merge for get_billing_row
	{		
		# DB
		$query	=	"
					SELECT 
					
						*,						
						(select max(account_receive_timestamp) from account_receive where client_account_id = client_account.client_account_id) AS last_pay	
						
					FROM client_account 	
					
						inner join client on client.client_id = client_account.client_id
						inner join user on user.user_id = client_account.user_id							
						inner join option_transaction_type on option_transaction_type.option_transaction_type_id = client_account.option_transaction_type_id						
						inner join option_account_type on option_account_type.option_account_type_id = client_account.option_account_type_id
						inner join option_account_status on option_account_status.option_account_status_id = client_account.option_account_status_id
						inner join option_buyer_type on option_buyer_type.option_buyer_type_id = client_account.option_buyer_type_id												
						inner join option_account_p1 on option_account_p1.option_account_p1_id = client_account.option_account_p1_id
						inner join option_account_p2 on option_account_p2.option_account_p2_id = client_account.option_account_p2_id
						inner join option_unit_account_type on option_unit_account_type.option_unit_account_type_id = client_account.option_unit_account_type_id						
						
						left join lot on lot.lot_id = client_account.lot_id
						left join project on project.project_id = lot.project_id
						left join project_site on project_site.project_site_id = lot.project_site_id
						left join project_site_block on project_site_block.project_site_block_id = lot.project_site_block_id
						
					
					WHERE
						
						client_account.option_account_status_id !=	'ejected'
					
					ORDER BY 
					
						client_account.client_account_number ASC
					";
		$rows	=	sql_select($query); 
		# Template
		$template_row			=	'finance_cashier/template/row.account';
		$template_row			=	view_get_template($template_row);
		#$template_row_empty	=	'edp_client/template/row.manage.account.empty';
		#$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{  				
				$row['client_account_date_transaction']	=	($row['last_pay']) ? string_date_time($row['last_pay']) : 'n.a' ;				
				$list			.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	 
	
// ===========================================================================================================================
	public function get_backout_row($agent_id=0,$filter='') //FOR Sales Backout Account
	{		
		
		if($agent_id !=0)
		{
			$agent_filter = " AND client_account.client_account_id IN(SELECT DISTINCT client_account_id FROM sales_commission_account WHERE  
									{$agent_id}	IN(old_sales_agent_id_avp,old_sales_agent_id_sm,old_sales_agent_id_ma,old_sales_agent_id_broker,
										sales_agent_id_vp,sales_agent_id_sd,sales_agent_id_sm,sales_agent_id_pc,sales_agent_id_broker) )";
    	    $temp_file = 'row.agent_backout';
		}
		else
		{
			$temp_file = 'row.account';
			$agent_filter      = '';
		}
		
		# DB
		$query	=	"
					SELECT 
						
						*
						
						FROM client_account 	
					
						inner join client on client.client_id = client_account.client_id
						inner join user on user.user_id = client_account.user_id							
						inner join option_transaction_type on option_transaction_type.option_transaction_type_id = client_account.option_transaction_type_id						
						inner join option_account_type on option_account_type.option_account_type_id = client_account.option_account_type_id
						inner join option_account_status on option_account_status.option_account_status_id = client_account.option_account_status_id
						inner join option_buyer_type on option_buyer_type.option_buyer_type_id = client_account.option_buyer_type_id												
						inner join option_account_p1 on option_account_p1.option_account_p1_id = client_account.option_account_p1_id
						inner join option_account_p2 on option_account_p2.option_account_p2_id = client_account.option_account_p2_id
						inner join option_unit_account_type on option_unit_account_type.option_unit_account_type_id = client_account.option_unit_account_type_id
						
						INNER JOIN sales_commission_account on sales_commission_account.client_account_id = client_account.client_account_id {$agent_filter}
						
						
						left join lot on lot.lot_id = client_account.lot_id
						left join project on project.project_id = lot.project_id
						left join project_site on project_site.project_site_id = lot.project_site_id
						left join project_site_block on project_site_block.project_site_block_id = lot.project_site_block_id
						
						WHERE client_account.option_account_status_id = 'ejected'
						
						{$filter}
					
					   ORDER BY client_account.client_account_number ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row			=	'sales/template/'.$temp_file;
		$template_row			=	view_get_template($template_row);
		$template_row_empty		=	'sales/template/row.empty';
		$template_row_empty		=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{  				
						
				if($agent_id !=0)
				{
					$filter = " AND (client_account.agent_id = {$agent_id} OR client_account.sales_manager_id = {$agent_id}
    						   OR client_account.sales_director_id = {$agent_id} OR client_account.avp_id = {$agent_id})";
    			    $temp_file = 'row.agent_backout';
				}
				$row['client_account_date_sale']   =  string_date($row['client_account_date_sale']);
				$row['client_account_tcp_net']     =  string_amount($row['client_account_tcp_net']);   
				 
				$list['rows']			          .=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list['rows']			              =	view_populate($row, $template_row_empty);
		}
		return $list;
	}
	
	
	public function get_agent_sales_row($agent_id,$filter='') //FOR Sales Agent Accounts
	{		
		# DB
		$query	=	"
					SELECT 
						*,
						(SELECT option_account_status_name FROM option_account_status WHERE option_account_status.option_account_status_id = client_account.option_account_status_id) AS option_account_status_name
						
						FROM client_account 	
					
						inner join client on client.client_id = client_account.client_id
						inner join user on user.user_id = client_account.user_id							
						inner join option_transaction_type on option_transaction_type.option_transaction_type_id = client_account.option_transaction_type_id						
						inner join option_account_type on option_account_type.option_account_type_id = client_account.option_account_type_id
						inner join option_account_status on option_account_status.option_account_status_id = client_account.option_account_status_id
						inner join option_buyer_type on option_buyer_type.option_buyer_type_id = client_account.option_buyer_type_id												
						inner join option_account_p1 on option_account_p1.option_account_p1_id = client_account.option_account_p1_id
						inner join option_account_p2 on option_account_p2.option_account_p2_id = client_account.option_account_p2_id
						inner join option_unit_account_type on option_unit_account_type.option_unit_account_type_id = client_account.option_unit_account_type_id
						
					
						left join lot on lot.lot_id = client_account.lot_id
						left join project on project.project_id = lot.project_id
						left join project_site on project_site.project_site_id = lot.project_site_id
						left join project_site_block on project_site_block.project_site_block_id = lot.project_site_block_id
						
						WHERE 
						
						client_account.client_account_id IN(SELECT DISTINCT client_account_id FROM sales_commission_account WHERE  
									{$agent_id}	IN(old_sales_agent_id_avp,old_sales_agent_id_sm,old_sales_agent_id_ma,old_sales_agent_id_broker,
										sales_agent_id_vp,sales_agent_id_sd,sales_agent_id_sm,sales_agent_id_pc,sales_agent_id_broker) )
    					             
    					 {$filter}            
					
					   ORDER BY client_account.client_account_number ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row			=	'sales/template/row.agent_account_sales';
		$template_row			=	view_get_template($template_row);
		$template_row_empty		=	'sales/template/row.empty';
		$template_row_empty		=	view_get_template($template_row_empty);
		$list['total_paidup']   =   0;
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{  				
				switch ($row['option_account_status_id']) 
				{
				     case "fully_paid":
				         $row['class_status'] = 'color_blue';
				         break;
				     case "ejected":
				         $row['class_status'] = 'color_red';
				         break;
				     default:
				         $row['class_status'] = 'color_green';
				}
				$total_commission		   				 =   mvc_model('model.client_account_agent')->select_total_commission_by_agent($agent_id);		
				$row['paidup']							 =   mvc_model('model.client_account_invoice')->select_paidup_sales($row['client_account_id']);
				$list['total_paidup']		   		    +=	 $row['paidup']	;
				$row['paidup']							 =   string_amount($row['paidup']);
				$row['client_account_tcp_net']   		 =   string_amount($row['client_account_tcp_net']);
				$row['total_commission']   				 =   string_amount($total_commission);
				$row['client_account_date_sale']   		 =  string_date($row['client_account_date_sale']);
				$list['rows']							.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list['rows']	=	view_populate($row, $template_row_empty);
		}
		return $list;
	}
	
	

	
//For documentation	
	public function select_accounts_row() # for documentation
	{		
		# DB
		$query	=	"
					SELECT 
						*
					FROM client_account 	
					
						inner join client on client.client_id = client_account.client_id
						inner join user on user.user_id = client_account.user_id							
						inner join option_transaction_type on option_transaction_type.option_transaction_type_id = client_account.option_transaction_type_id						
						left join option_account_type on option_account_type.option_account_type_id = client_account.option_account_type_id
						left join option_account_status on option_account_status.option_account_status_id = client_account.option_account_status_id
						left join option_buyer_type on option_buyer_type.option_buyer_type_id = client_account.option_buyer_type_id												
						inner join option_account_p1 on option_account_p1.option_account_p1_id = client_account.option_account_p1_id
						inner join option_account_p2 on option_account_p2.option_account_p2_id = client_account.option_account_p2_id
						inner join option_unit_account_type on option_unit_account_type.option_unit_account_type_id = client_account.option_unit_account_type_id
						
						
						left join lot on lot.lot_id = client_account.lot_id
						left join project on project.project_id = lot.project_id
						left join project_site on project_site.project_site_id = lot.project_site_id
						left join project_site_block on project_site_block.project_site_block_id = lot.project_site_block_id
						
						
					
					ORDER BY client_account.client_account_number ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row			=	'documentation/template/row.account';
		$template_row			=	view_get_template($template_row);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{  				
			    
				$row['client_account_timestamp']	=	 string_date_time($row['client_account_timestamp']) ;				
				$list								.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}
	
	
	public function get_account($id) # for documentation
	{		
		$id		=  $id*1;
		# DB
		$query	=	"
					SELECT 
						*
					FROM client_account 	
					
						inner join client on client.client_id = client_account.client_id
						inner join user on user.user_id = client_account.user_id							
						inner join option_transaction_type on option_transaction_type.option_transaction_type_id = client_account.option_transaction_type_id						
						inner join option_account_type on option_account_type.option_account_type_id = client_account.option_account_type_id
						inner join option_account_status on option_account_status.option_account_status_id = client_account.option_account_status_id
						inner join option_buyer_type on option_buyer_type.option_buyer_type_id = client_account.option_buyer_type_id												
						inner join option_account_p1 on option_account_p1.option_account_p1_id = client_account.option_account_p1_id
						inner join option_account_p2 on option_account_p2.option_account_p2_id = client_account.option_account_p2_id
						inner join option_unit_account_type on option_unit_account_type.option_unit_account_type_id = client_account.option_unit_account_type_id
					
						left join lot on lot.lot_id = client_account.lot_id
						left join project on project.project_id = lot.project_id
						left join project_site on project_site.project_site_id = lot.project_site_id
						left join project_site_block on project_site_block.project_site_block_id = lot.project_site_block_id
						
					
					WHERE
					
					 client_account_id = {$id}
					";
		$rows	=	sql_select($query);
		# Template
		$template_row			=	'documentation/template/profile.account';
		$template_row			=	view_get_template($template_row);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{  				
				$row['client_account_timestamp']	=	 string_date_time($row['client_account_timestamp']) ;	
				$row['client_account_tcp_net']    	=    string_amount($row['client_account_tcp_net']);			
				$list							   .=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}
	
// FOR Sales Report================================================================

	public function get_year_to_date_report($year_start=2012) # for 2012 to date 
	{		
		$current_year     = string_date_year(time());
		
		$year_diff		  = $current_year - $year_start;  
		for($i=0;$i<=$year_diff;$i++)
		{
			$sd			  = 'Jan '.($year_start+$i);
			$ed			  = 'Jan '.($year_start+$i+1);
			$start_date   = strtotime($sd);
			$end_date     = strtotime($ed);
			
			
			$query	      =	"
							SELECT 
							
							*
							
							FROM 
							
							client_account 
							
							INNER JOIN sales_commission_account on sales_commission_account.client_account_id = client_account.client_account_id
							
							WHERE client_account.option_account_status_id != 'ejected'	
							
							AND client_account.client_account_date_sale >= {$start_date}
							
							AND client_account.client_account_date_sale < {$end_date}
					
					
					";
					
			$rows		 =	sql_select($query);
			
				//hash_dump($rows);
			$list['data'][$year_start+$i]['total']  = 0;	
				for($x=1;$x<=12;$x++)
				{
					switch ($x) 
					{
					     case 1:
					         $month  = 'January';
					         break;
					     case 2:
					         $month  = 'February';
					         break;
					     case 3:
					         $month  = 'March';
					         break;
					     case 4:
					         $month  = 'April';
					         break;
	                     case 5:
	                         $month  = 'May';
	                         break;  
	                     case 6:
	                         $month  = 'June';
	                         break;          
	                     case 7:
	                         $month  = 'July';
	                         break;    
	                     case 8:
	                         $month  = 'August';
	                         break;
	                     case 9:
	                         $month  = 'September';
	                         break;
	                     case 10:
	                         $month  = 'October';
	                         break;
	                     case 11:
	                         $month  = 'November';
	                         break;      
					     default:
					         $month  = 'December';
					}
					$list['data'][$year_start+$i][$month]   = 0;
					foreach($rows as $row)
					{  				
						//echo 'case Month: '.$month . '<br>';
						//echo 'row Month: '.string_date_month($row['client_account_date_sale']) . '<br>';
						if(string_date_month_full($row['client_account_date_sale'])== $month)
						{
							
							$list['data'][$year_start+$i][$month]   +=   $row['client_account_tcp_net'];
						}
					}
					$list['data'][$year_start+$i]['total'] +=	$list['data'][$year_start+$i][$month];
				}//end FOR loop Per Month Data
				
			
		}//end FOR loop of years difference
		
		$table_header 				= array('January','February','March','April','May','June','July','August','September','October','November','December','total');
		$list['monthly']			= '';
		$list['year']				= '';
		$list['total']				= '';
				
			foreach($list['data'] as $key => $value)
			{
				$list['year']	   .= '<td>'.$key.'</td>';
			}
			foreach($table_header as $row)
			{
				$list['monthly']		.= '<tr><td align="center"><div class="details">'.$row.'</div></td>';
				foreach($list['data'] as $key => $value)
				{
					if($row != 'total')
					{
						$amt				 = ($value[$row] > 0 ? string_amount($value[$row]) : '-');
						
						$list['monthly']	.= '<td><div class="details">'.$amt.'</div></td>';
					}
					else
					{
						$t_amt				 = ($value[$row] > 0 ? string_amount($value[$row]) : '-');
						$list['total']      .= ' <td>'.$t_amt.'</td>';
					}
					
				}
				$list['monthly']		.= '</tr>';
			}	
				
		//die();
		return $list;
	}   // end get_year_to_date_report()
	
	
	
	
# Modify
		

	public function insert($post, $client_id)
	{		
		$data										=	sql_parse_input('client_account', $post);
		$data['client_id']							=	$client_id * 1;
		$data['client_account_timestamp']			=	time();			
		$data['client_account_date_sale']			=	strtotime($data['client_account_date_sale']);			
		#$data['client_account_reservation_date']	=	strtotime($data['client_account_reservation_date']);
		#$data['client_account_dp_paid_date']		=	strtotime($data['client_account_dp_paid_date']); # client account creation, only reservation is paid
		$data['client_account_dp_due_date']			=	strtotime($data['client_account_dp_due_date']);		
		$sql									=	sql_insert($this->table_name, $data, 'client_account_id');	
		$return['result']						=	$sql['result'];
		$return['data']							=	$sql['data'];
		$return['message']						=	$sql['message'];		
		return $return;
	}
			
	public function update($post, $id)
	{
		$data					=	sql_parse_input('client_account', $post);					
									sql_update('client_account', 'client_account_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}				
	
	public function update_focus()
	{
		$client_account_id	=	$client_account_id * 1;
		$focus_in			=	strtotime(date("M d Y"));
		$focus_in			=	$focus_in + (86400 * 3);
		$now				=	time();
		$query				=	"UPDATE client_account SET client_account_focus_overdue = 1, client_account_focus_overdue_date = {$focus_in}, client_account_overdue_date = {$now} WHERE client_account_focus_overdue_date <= {$now} AND client_account_id IN (SELECT client_account_id FROM client_account_invoice where client_account_invoice_is_late = 1	AND client_account_invoice.option_invoice_status_id != 1)";
		#sql_query($query);
	}
	
	public function update_un_focus($id)
	{
		$id										=	$id * 1;
		$data['client_account_focus_overdue']	=	0;
		#sql_update('client_account', 'client_account_id',$id, $data);
	}
	
	
	public function update_account_status($account_id, $status)
	{
		# option_account_status_id = 0 : Foreclosed/Ejected
		# option_account_status_id = 1 : Partial Downpayment
		# option_account_status_id = 2 : Monthly Amortization
		# option_account_status_id = 3 : Fully Paid
		# option_account_status_id = 4 : Defferred Cash Payment
		# option_account_status_id = 5 : Reservation
		# option_account_status_id = 6 : Retention
		$data['option_account_status_id']	=	$status * 1;
		sql_update('client_account', 'client_account_id', $account_id, $data);
		
	}
	
	/* Arnie's */
	
	public function get_lot_account($lot_id)
	{
		$lot_id		=	$lot_id * 1;
		
		# DB
		$query	=	"						
						select
						 
						 	*,
						 	(
						 		select 
						 		
						 			sum(receive_amount) 
						 			
						 		from account_receive_invoice 
						 		
						 			inner join  client_account_invoice on client_account_invoice.client_account_invoice_id = account_receive_invoice.client_account_invoice_id
						 		
						 		where 
						 		
						 			account_receive_invoice.client_account_id = client_account.client_account_id AND
						 			client_account_invoice.option_account_invoice_type_id IN ('credit_to_principal', 'earnest', 'monthly_amortization', 'monthly_dp', 'reservation')
						 	
						 	) AS paid_up
						
						from client_account		
						
							inner join client on client.client_id	=	client_account.client_id
							inner join option_unit_account_type on 	client_account.option_unit_account_type_id = option_unit_account_type.option_unit_account_type_id
							inner join option_transaction_type on 	client_account.option_transaction_type_id = option_transaction_type.option_transaction_type_id
							inner join option_account_status on 	client_account.option_account_status_id = option_account_status.option_account_status_id
						
						WHERE	
						
							client_account.lot_id = {$lot_id}
							
						ORDER BY 
						
							client_account.client_account_id DESC
					
					";
		
		$rows	=	sql_select($query);		
		# Template
		$template_row			=	'edp_client/template/row.inventory.client';
		$template_row			=	view_get_template($template_row);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{  				
				$row['client_account_timestamp']	=	 string_date($row['client_account_timestamp']) ;	
				$row['paid_up']    					=    string_amount($row['paid_up']);			
				$row['client_account_tcp_net']    	=    string_amount($row['client_account_tcp_net']);			
				$list							   .=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	'<tr><td colspan="6">0 results found</td></tr>';
		}
		return $list;
	}
	
}

