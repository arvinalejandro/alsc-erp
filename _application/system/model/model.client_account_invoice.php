<?php
class model_client_account_invoice
{	
	
	public function __construct()
	{
		$this->table_name		=	'client_account_invoice';
		$this->message_insert	=	'A new lot has been successfully added.';
	}
	
# Data Select

	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		
		$query	=	"select 
						* 
					from lot 					
						inner join project ON project.project_id = lot.project_id 				
						inner join project_site ON project_site.project_site_id = lot.project_site_id 				
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id 				
						inner join option_availability ON option_availability.option_availability_id = lot.option_availability_id 				
						inner join option_unit ON option_unit.option_unit_id = lot.option_unit_id 		
						left join network on network.network_id = lot.network_id		
						left join network_division on network_division.network_division_id = lot.network_division_id		
						left join house on house.house_id = lot.house_id	
						left join option_house_classification ON option_house_classification.option_house_classification_id = house.option_house_classification_id	
					where lot.lot_id = {$id}";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
	public function select_recent_due($id) #!! REplace due with overdue
	{
		$id		=	$id * 1;
		# DB
		$query	=	"select * from client_account_invoice where client_account_invoice_is_late = 1 AND (option_invoice_status_id = 0 OR option_invoice_status_id = 2) AND client_account_id = '{$id}' ORDER BY client_account_invoice_id DESC LIMIT 0, 1";
		$rows	=	sql_select($query);		
		return $rows[0];
	}
	
	public function select_sum_principal($id) #!! REplace due with overdue
	{
		$id		=	$id * 1;
		# DB
		$query	=	"
		select 
			(
				select sum(client_account_invoice_principal_amount) from client_account_invoice 
					where 
						option_invoice_status_id = 1 
						AND 
						option_account_invoice_type_id IN ('ma', 'cp') 
						AND 
						client_account_id = client_account.client_account_id
			) AS paid,
			client_account_ma_amount as amount
	
		from client_account 
		where client_account_id = {$id} ";
				
		$rows	=	sql_select($query);
		
		
		
		return $rows[0];
	}
	
	public function select_current_due($id)
	{
		$id		=	$id * 1;
		# DB
		$query	=	"select client_account_invoice_id from client_account_invoice where client_account_invoice_is_late = 1 AND (option_invoice_status_id = 0 OR option_invoice_status_id = 2) AND client_account_id = '{$id}' ORDER BY client_account_invoice_id";
		$rows	=	sql_select($query);				
		
		foreach($rows as $row)
		{
			$ids[]	=	$row['client_account_invoice_id'];
		}
		
		return implode(',', $ids);		
	}
	
	public function select_invoice_payment($invoice_id)
	{		
		$query	=	"
						SELECT * 
						
						FROM client_account_invoice
							/*INNER JOIN client_account ON client_account.client_account_id = client_account_invoice.client_account_id*/
						WHERE 
							client_account_invoice.client_account_invoice_id IN ({$invoice_id}) AND
							client_account_invoice.option_invoice_status_id != 'settled'	
							
						ORDER BY
							client_account_invoice.client_account_invoice_id ASC
					";
		$rows	=	sql_select($query);
		return $rows;
	}
	
	public function select_next_due($client_account_id, $invoice_type = 'ma')
	{
		$id		=	$client_account_id * 1;
		# DB
		$query	=	"select * from client_account_invoice 
					where 
						option_invoice_status_id = 0 
						AND 
						option_account_invoice_type_id = '{$invoice_type}'
						AND
						client_account_id = {$id}
					ORDER BY client_account_invoice_id ASC LIMIT 0, 1";
		$rows	=	sql_select($query);	
		return	 $rows[0];
	}
	
	function select_cashier_summary($id)
	{
		$id		=	$id * 1;		
		# DB
		$query	=	"
					SELECT 
						*,
						( SELECT sum(receive_amount) FROM account_receive_invoice WHERE client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount,
						( SELECT sum(receive_amount_surcharge) FROM account_receive_invoice WHERE client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount_surcharge,
						( SELECT sum(receive_amount_interest) FROM account_receive_invoice WHERE client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount_interest,
						( SELECT sum(receive_amount_principal) FROM account_receive_invoice WHERE client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount_principal,
						( SELECT sum(receive_amount_rebate) FROM account_receive_invoice WHERE client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount_rebate 		
					FROM client_account_invoice 						
					
					where 
						client_account_id = '{$id}' 
						AND 
						option_invoice_status_id  != 'settled' 
						AND 
						option_account_invoice_type_id IN ('monthly_dp', 'credit_to_principal', 'monthly_amortization', 'spot_cash', 'retention', 'deffered_cash') 
						AND 
						client_account_invoice_is_late = 1
					
					ORDER BY client_account_invoice.client_account_invoice_id 
					";
		$rows	=	sql_select($query);
		
		if(count($rows))
		{
			foreach($rows as $row)
			{							
				# Get Diffs
				$remaining_surcharge								=		($row['client_account_invoice_surcharge_amount'] + $row['client_account_invoice_surcharge_previous_amount']) - ($row['receive_amount_surcharge'] * 1);			
				$remaining_interest									=		$row['client_account_invoice_interest_amount'] - ($row['receive_amount_interest']* 1);			
				$remaining_principal								=		$row['client_account_invoice_principal_amount'] - ($row['receive_amount_principal'] * 1);					
				$remaining_amount									=		$remaining_surcharge + $remaining_interest + $remaining_principal;		
				
				# Declare and format
				$data['surcharge']									=		$data['surcharge'] + $remaining_surcharge;
				$data['interest']									=		$data['interest'] + $remaining_interest;
				$data['principal']									=		$data['principal'] + $remaining_principal;
				$data['amount']										=		$data['amount'] + $remaining_amount;		
				$data['count'] ++;
				
			}			
		}			
			
		return $data;
	} 
	
	public function select_payment_progress($client_account_id)
	{
		$id		=	$client_account_id * 1;		
		# DB
		$query	=	"
					SELECT 		
						client_account.client_account_tcp_net,				
						( SELECT sum(account_receive_invoice.receive_amount_principal) FROM account_receive_invoice 
							
							inner join client_account_invoice ON client_account_invoice.client_account_invoice_id = account_receive_invoice.client_account_invoice_id
													
							WHERE account_receive_invoice.client_account_id = client_account.client_account_id AND  client_account_invoice.option_account_invoice_type_id IN ('monthly_dp', 'credit_to_principal', 'monthly_amortization', 'spot_cash', 'retention', 'deffered_cash')
							
						) AS principal_paid
						
					FROM client_account		
									
					where 
						client_account_id = {$id} 						 
					";
					
		$rows	=	sql_select($query);
		
		$paid		=	$rows[0]['principal_paid'];
		$contract	=	$rows[0]['client_account_tcp_net'];
		
		$progress	=	($paid / $contract) * 100;
		
		
		return round($progress, 0);
					
	} 
	
	public function select_payment_balance($client_account_id)
	{
		
	}
	
	
	public function select_paidup_sales($client_account_id=0,$filter='')
	{
		$id		=	$client_account_id * 1;	
		if($id !=0)
		{
			$filter = " where 
						client_account_id = {$id} ";
		}	
		# DB
		$query	=	"
					SELECT 		
						client_account.client_account_tcp_net,				
						( SELECT sum(account_receive_invoice.receive_amount_principal) FROM account_receive_invoice 
							
							inner join client_account_invoice ON client_account_invoice.client_account_invoice_id = account_receive_invoice.client_account_invoice_id
													
							WHERE account_receive_invoice.client_account_id = client_account.client_account_id AND  client_account_invoice.option_account_invoice_type_id IN ('monthly_dp', 'credit_to_principal', 'monthly_amortization', 'spot_cash', 'retention', 'deffered_cash')
							
						) AS principal_paid
						
					FROM client_account		
									
										
					
						{$filter}					 
					";
					
		$rows	=	sql_select($query);
		//hash_dump($rows, 1);
		$paid		=	$rows[0]['principal_paid'];		
		
		return $paid;
					
	} 
	
	
	public function select_paidup_per_transaction_type($client_account_id=0,$filter='')
	{
		# DB
		$query	=	"
					
					SELECT
					SUM(CASE WHEN  client_account.option_transaction_type_id = 'regular' 		 AND client_account.option_account_status_id != 'retention'  THEN  account_receive_invoice.receive_amount_principal ELSE 0 END) 	AS regular_principal_paid,
					SUM(CASE WHEN  client_account.option_transaction_type_id = 'offset' 		 AND client_account.option_account_status_id != 'retention' THEN  account_receive_invoice.receive_amount_principal ELSE 0 END) AS offset_principal_paid,
					SUM(CASE WHEN  client_account.option_transaction_type_id = 'lease_to_own' 	 AND client_account.option_account_status_id != 'retention' THEN  account_receive_invoice.receive_amount_principal ELSE 0 END)	AS lease_to_own_principal_paid,
					SUM(CASE WHEN  client_account.option_transaction_type_id = 'special_account' AND client_account.option_account_status_id != 'retention' THEN  account_receive_invoice.receive_amount_principal ELSE 0 END) AS special_account_principal_paid,
					SUM(CASE WHEN  client_account.option_transaction_type_id = 'thru_loan'   	 AND client_account.option_account_status_id != 'retention' THEN  account_receive_invoice.receive_amount_principal ELSE 0 END)	AS thru_loan_principal_paid,
					SUM(CASE WHEN  client_account.option_account_status_id   = 'retention' THEN  account_receive_invoice.receive_amount_principal ELSE 0 END)	AS retention_principal_paid
						
						FROM account_receive_invoice
						
						inner join client_account on client_account.client_account_id = account_receive_invoice.client_account_id
						
						inner join client_account_invoice ON client_account_invoice.client_account_invoice_id = account_receive_invoice.client_account_invoice_id 
						
						AND client_account_invoice.option_account_invoice_type_id IN('monthly_dp', 'credit_to_principal', 'monthly_amortization', 'spot_cash', 'retention', 'deffered_cash','earnest')
						
						WHERE account_receive_invoice.client_account_id IN({$client_account_id})	
					
					";
					
		$rows	=	sql_select($query);
		//hash_dump($rows, 1);
		$paid		=	$rows[0];		
		
		return $paid;
					
	}
	
# Get Ouput

	public function get_client_row($id = '')
	{
		$id		=	$id * 1;		
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM client_account_invoice 	
					
					inner join option_account_invoice_type on 	option_account_invoice_type.option_account_invoice_type_id 		= 		client_account_invoice.option_account_invoice_type_id		
					
					where client_account_invoice.client_account_id = '{$id}' AND client_account_invoice.option_account_invoice_type_id IN ('monthly_dp', 'credit_to_principal', 'monthly_amortization', 'spot_cash', 'retention', 'deffered_cash')
					
					ORDER BY  client_account_invoice.client_account_invoice_id ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_client/template/row.manage.account_invoice';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'edp_client/template/row.manage.account_invoice.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{	         
				$row['client_account_invoice_date_paid']			=		($row['client_account_invoice_date_paid'] * 1) ? string_date($row['client_account_invoice_date_paid']) : '-';
				$row['client_account_invoice_date_due']				=		string_date($row['client_account_invoice_date_due']);
				$row['client_account_invoice_amount']				=		string_amount($row['client_account_invoice_amount']);
				$row['client_account_invoice_balance_amount']		=		string_amount($row['client_account_invoice_balance_amount']);
				$row['client_account_invoice_rebate_amount']		=		string_amount($row['client_account_invoice_rebate_amount']);
				$row['client_account_invoice_principal_amount']		=		string_amount($row['client_account_invoice_principal_amount']);
				$row['client_account_invoice_interest_amount']		=		string_amount($row['client_account_invoice_interest_amount']);
				
				if($row['option_account_invoice_type_id'] == 'credit_to_principal')
				{
					$row['overdue']	=	'color_blue';
				}
				else
				{
					if($row['option_invoice_status_id'] == 'settled')
					{
						$row['overdue']	=	'color_green';
					}
					else
					{				
						if($row['client_account_invoice_is_late'])					
							$row['overdue']	=	'color_red';
						else
							$row['overdue']	=	'';
					}
				}			
						
				$list										.=		view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	public function get_cashier_row($id = '')
	{
		$id		=	$id * 1;		
		# DB
		$query	=	"
					SELECT 
						*,
						( SELECT sum(receive_amount) FROM account_receive_invoice WHERE client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount,
						( SELECT sum(receive_amount_surcharge) FROM account_receive_invoice WHERE client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount_surcharge,
						( SELECT sum(receive_amount_interest) FROM account_receive_invoice WHERE client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount_interest,
						( SELECT sum(receive_amount_principal) FROM account_receive_invoice WHERE client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount_principal,
						( SELECT sum(receive_amount_rebate) FROM account_receive_invoice WHERE client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount_rebate 		
					FROM client_account_invoice 				
					
						left join option_account_invoice_type on option_account_invoice_type.option_account_invoice_type_id = 	client_account_invoice.option_account_invoice_type_id
					
					where 
						client_account_invoice.client_account_id = '{$id}' 
						AND 
						option_invoice_status_id != 'settled' 
						AND 
						client_account_invoice.option_account_invoice_type_id IN ('monthly_dp', 'monthly_amortization', 'spot_cash', 'retention', 'deffered_cash')
					
					ORDER BY client_account_invoice.client_account_invoice_id ASC LIMIT 0, 5
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'finance_cashier/template/row.account.invoice';
		$template_row		=	view_get_template($template_row);
		#$template_row_empty	=	'edp_client/template/row.manage.account_invoice.empty';
		#$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		#hash_dump($rows, 1);
		if(count($rows))
		{
			foreach($rows as $row)
			{	         
				$date												=		$row['client_account_invoice_date_due'];
				$row['client_account_invoice_date_due']				=		string_date($date);					
				# Get Diffs
				$remaining_surcharge								=		($row['client_account_invoice_surcharge_amount'] + $row['client_account_invoice_surcharge_previous_amount']) - ($row['receive_amount_surcharge'] * 1);			
				$remaining_interest									=		$row['client_account_invoice_interest_amount'] - ($row['receive_amount_interest']* 1);			
				$remaining_principal								=		$row['client_account_invoice_principal_amount'] - ($row['receive_amount_principal'] * 1);			
				$rebate												=		($row['client_account_invoice_date_rebate_limit'] > time()) ? $row['client_account_invoice_rebate_amount'] : 0;
				$remaining_amount									=		$remaining_surcharge + $remaining_interest + $remaining_principal;		
				
				# Declare and format
				$row['client_account_invoice_surcharge_amount']		=		string_amount($remaining_surcharge);
				$row['client_account_invoice_interest_amount']		=		string_amount($remaining_interest);
				$row['client_account_invoice_principal_amount']		=		string_amount($remaining_principal);
				$row['client_account_invoice_amount']				=		string_amount($remaining_amount);				
				$row['client_account_invoice_balance_amount']		=		string_amount($row['client_account_invoice_balance_amount']);				
				$row['client_account_invoice_rebate_amount']		=		string_amount($rebate);				
				
				if($row['option_invoice_status_id'] == 1)
				{
					$row['overdue']	=	'color_green';
				}
				else
				{				
					if($row['client_account_invoice_is_late'])					
						$row['overdue']	=	'color_red';
					else
						$row['overdue']	=	'';
				}		
						
				$list										.=		view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	
	function get_row_invoice_due($id, $letter = false, $status = 'pending')
	{
		$id			=	$id * 1; #client_account_id
		$option		=	($status == 'pending') ? '!=' : '=';
		# DB
		$query	=	"
					SELECT 
					
						*	
										
					FROM client_account_invoice	
					
						inner join client on client.client_id = client_account_invoice.client_id				
						inner join option_invoice_status on option_invoice_status.option_invoice_status_id = client_account_invoice.option_invoice_status_id				
						inner join option_account_invoice_type on 	option_account_invoice_type.option_account_invoice_type_id 		= 		client_account_invoice.option_account_invoice_type_id		
					
					where client_account_invoice.client_account_invoice_is_late = 1		
					
					AND client_account_invoice.client_account_id = {$id}
					AND client_account_invoice.option_invoice_status_id {$option} 1
					AND  client_account_invoice.option_account_invoice_type_id IN ('ma', 'dp')
										
					ORDER BY client_account_invoice.client_account_invoice_id ASC
					
					
								
					";
		$rows	=	sql_select($query);		
				
		# Template
		$template_row		=	"finance_billing/template/row.due.invoice.{$status}";
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	"finance_billing/template/row.due.invoice.{$status}.empty";
		$template_row_empty	=	view_get_template($template_row_empty);
		
		
		# Parse
		if(count($rows))
		{
			# Date Now
			$now		=	time();
			
			
			foreach($rows as $row)
			{	
								
				$surcharge									=		($row['client_account_invoice_surcharge_amount'] + $row['client_account_invoice_surcharge_previous_amount']) - ($row['receive_amount_surcharge'] * 1);
				$total										=		$surcharge + $row['client_account_invoice_balance_amount'];
				$surcharge_t								=		$surcharge + $surcharge_t;
				$amount_t									=		$row['client_account_invoice_amount'] + $amount_t;
				$total_t									=		$total + $total_t;				
				$row['days_due']							=		$this->get_days_due($row['client_account_invoice_date_due_limit'], true);			
				$row['total']								=		string_amount($total);		
				$row['surcharge']							=		string_amount($surcharge);
				$row['client_account_invoice_date_due']		=		string_date($row['client_account_invoice_date_due']);				
				$row['client_account_invoice_date_paid']		=		string_date($row['client_account_invoice_date_paid']);				
				$row['client_account_invoice_amount']		=		string_amount($row['client_account_invoice_amount']);							
				$row['client_account_invoice_principal_amount']		=		string_amount($row['client_account_invoice_principal_amount']);							
				$row['client_account_invoice_amount']		=		string_amount($row['client_account_invoice_amount']);							
				$row['client_account_invoice_balance_amount']		=		string_amount($row['client_account_invoice_balance_amount']);							
				$list										.=		view_populate($row, $template_row);
			}		
			
			if($status == 'pending')
			{
				$list .='
				<tr>   		    
					<td ><div class="details"></div></td>                         
					<td><div class="details"></div></td>					                  
					<td><div class="details"></div></td>					                  
					<td><div class="details"><b>Total : P '.string_amount($amount_t).'</b></td>					                              
					<td><div class="details"></div></td> 
					<td><div class="details"><b>Total : P '.string_amount($surcharge_t).' </b></td> 
					<td><div class="details"></div></td>  
					<td><div class="details"></div></td>  					  					                                          
					<td><div class="details"><b>Total : P '.string_amount($total_t).'</b></td>  
					<td><div class="details"></div></td> 					                                          
				</tr>';	
			}
	
			
			
			if($letter)
			{
				$list	=	array();
				$list['surcharge_t']	=	string_amount($surcharge_t);
				$list['amount_t']		=	string_amount($amount_t);
				$list['total_t']		=	string_amount($total_t);
			}
			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
# Modify
	/*
	client_account_invoice_id         bigint(20) unsigned    (NULL)     NO      PRI     (NULL)   auto_increment  select,insert,update,references         
	client_id                         bigint(20) unsigned    (NULL)     YES             (NULL)                   select,insert,update,references         
	client_account_id                 bigint(20) unsigned    (NULL)     YES             (NULL)                   select,insert,update,references         
	client_account_invoice_number     int(10) unsigned       (NULL)     YES             (NULL)                   select,insert,update,references         
	client_account_invoice_receipt
	client_account_invoice_is_paid    tinyint(1) unsigned    (NULL)     YES             0                        select,insert,update,references         
	client_account_invoice_type_id    tinyint(3) unsigned    (NULL)     YES             (NULL)                   select,insert,update,references         
	client_account_invoice_recurr     tinyint(1) unsigned    (NULL)     YES             1                        select,insert,update,references         
	client_account_invoice_amount     double(10,2) unsigned  (NULL)     YES             (NULL)                   select,insert,update,references         
	client_account_invoice_rebate     double(10,2) unsigned  (NULL)     YES             (NULL)                   select,insert,update,references         
	client_account_invoice_date_due   bigint(20) unsigned    (NULL)     YES             (NULL)                   select,insert,update,references 
	client_account_invoice_date_paid  bigint(20) unsigned    (NULL)     YES             (NULL)                   select,insert,update,references 
	*/
	

	
	
	public function insert($post)
	{
		$sql							=	sql_insert($this->table_name, $post);			
		$return['result']				=	$sql['result'];
		$return['data']					=	$sql['data'];
		$return['message']				=	$sql['message'];		
		return $return;		
	}
	
	public function insert_dp($client_account, $client_account_structure_id)
	{	
		$invoice_count			=	1;			
		$date_month				=	0;
		
		# Misc Fee payment type 
		if($client_account['option_account_misc_id'] == 'partial')
		{
			$outstanding_balance	=	$client_account['client_account_dp_net'] + $client_account['client_account_misc_fee'];
			$monthly_pay			=	$client_account['client_account_dp_monthly'] + $client_account['client_account_misc_fee_monthly'];
			$misc_monthly			=	$client_account['client_account_misc_fee_monthly'];
		}
		else
		{
			$outstanding_balance	=	$client_account['client_account_dp_net'];
			$monthly_pay			=	$client_account['client_account_dp_monthly'];
			$misc_monthly			=	0;
		}		
		
		
		$invoice_type_id	=	($client_account['option_account_p1_id'] == 'spot_cash') ? 'spot_cash' : 'monthly_dp';
						
		while($client_account['client_account_dp_term'] >= $invoice_count)		
		{
			$balance										=	$this->compute_balance($outstanding_balance, $monthly_pay);
			$dp['client_id']								=	$client_account['client_id'];
			$dp['client_account_id']						=	$client_account['client_account_id'];
			$dp['client_account_structure_id']				=	$client_account_structure_id;			
			$dp['client_account_invoice_number']			=	$invoice_count;			
			$dp['option_account_invoice_type_id']			=	$invoice_type_id;
			$dp['client_account_invoice_recurr']			=	'1';
			$dp['client_account_invoice_recurr_count']		=	$client_account['client_account_dp_term'];
			$dp['client_account_invoice_date_paid']			=	0;
			$dp['client_account_invoice_date_due']			=	strtotime("+{$date_month} month", $client_account['client_account_dp_due_date']);	
			$dp['client_account_invoice_date_due_surcharge']	=	strtotime("+{$date_month} month", $client_account['client_account_dp_due_date']) + 86400;	
			$dp['client_account_invoice_date_due_rebate']	=	0;
			
			# Balances		
			$dp['client_account_invoice_amount']			=	$balance['monthly']; # Actual Amount						
			$dp['client_account_invoice_balance_amount']	=	$outstanding_balance; # Remaining Actual Amount
			$dp['client_account_invoice_principal_amount']	=	$balance['principal']; # Remaining Principal Amount		
			$dp['client_account_invoice_interest_amount']	=	$balance['interest']; # Remaining Rebate Amount
			$dp['client_account_invoice_rebate_amount']		=	$balance['rebate']; # Remaining Rebate Amount
			
			# Calculations
			$outstanding_balance							=	$balance['balance'];
			$invoice_count++;	
			$date_month++;		
			$data[]										=	$dp;
			$pTotal										=	$dp['client_account_invoice_amount'] + $pTotal;
			$this->insert($dp);				
		}
				
	}
	
	public function insert_ma($client_account_data, $client_account_structure)
	{	
		$client_account			=	$client_account_structure;
		$invoice_count			=	1;			
		$date_month				=	0;	
		# Value Specifics
		$client_id				=	$client_account['client_id'];
		$client_account_id		=	$client_account['client_account_id'];
		$outstanding_balance	=	$client_account['client_account_ma_amount'];	
		$monthly_pay			=	$client_account['client_account_ma_monthly'];	
		$interest				=	$client_account['client_account_ma_interest'];
		$rebate					=	$client_account['client_account_ma_rebate'];
		$due_date				=	$client_account['client_account_ma_due_date'];
		$structure_id			=	$client_account['client_account_structure_id'];
		$term					=	$client_account['client_account_ma_term'];
		
		$invoice_type_id	=	($client_account_data['option_account_p2_id'] == 'deffered_cash') ? 'deffered_cash' : 'monthly_amortization';
		
		while($term >= $invoice_count)
		{			
			$balance										=	$this->compute_balance($outstanding_balance, $monthly_pay, $interest, $rebate);
			$data['client_id']								=	$client_id;
			$data['client_account_id']						=	$client_account_id;
			$data['client_account_structure_id']				=	$structure_id;
			$data['client_account_invoice_number']			=	$invoice_count;			
			$data['option_account_invoice_type_id']			=	$invoice_type_id;
			$data['client_account_invoice_recurr']			=	'1';
			$data['client_account_invoice_recurr_count']		=	$term;			
			$data['client_account_invoice_date_paid']			=	0;
			$data['client_account_invoice_date_due']			=	strtotime("+{$date_month} month", $due_date);
			$data['client_account_invoice_date_due_surcharge']	=	strtotime("+{$date_month} month", $due_date) + 86400;	
			$data['client_account_invoice_date_due_rebate']	=	strtotime("+{$date_month} month", $due_date) - (86400 + 86400);	
				
			# Balances		
			$data['client_account_invoice_amount']			=	$balance['monthly']; # Actual Amount						
			$data['client_account_invoice_balance_amount']	=	$outstanding_balance; # Remaining Actual Amount
			$data['client_account_invoice_principal_amount']	=	$balance['principal']; # Remaining Principal Amount		
			$data['client_account_invoice_interest_amount']	=	$balance['interest']; # Remaining Rebate Amount
			$data['client_account_invoice_rebate_amount']		=	$balance['rebate']; # Remaining Rebate Amount
			# Calculations		
			$outstanding_balance							=	$balance['balance'];	
			$invoice_count++;
			$date_month++;			
			
			# Insert							
			$this->insert($data);	
			# Reset
			$data = array();
		}
		
		
	}
	
	public function insert_credit_principal($client_account, $invoice_count, $principal_amount, $remaining_amount)
	{	
		$time											=	time();		
		$dp['client_id']								=	$client_account['client_id'];
		$dp['client_account_id']						=	$client_account['client_account_id'];
		$dp['client_account_invoice_number']			=	$invoice_count['client_account_invoice_number'] - 1;			
		$dp['client_account_invoice_type_id']			=	'cp';
		$dp['client_account_invoice_recurr']			=	'0';
		$dp['client_account_invoice_recurr_count']		=	$client_account['client_account_ma_term'];			
		$dp['client_account_invoice_date_paid']			=	$time;
		$dp['client_account_invoice_date_due']			=	$time;
		$dp['client_account_invoice_date_due_limit']	=	0;	
			
		# Balances		
		$dp['client_account_invoice_amount']			=	$principal_amount; # Actual Amount						
		$dp['client_account_invoice_balance_amount']	=	$remaining_amount; # Remaining Actual Amount
		$dp['client_account_invoice_principal_amount']	=	$principal_amount; # Remaining Principal Amount		
		$dp['client_account_invoice_interest_amount']	=	0; # Remaining Rebate Amount
		$dp['client_account_invoice_rebate_amount']		=	0; # Remaining Rebate Amount
		$dp['option_invoice_status_id']					=	1; # paid
		# Insert						
		$sql	=	sql_insert($this->table_name, $dp, 'client_account_invoice_id');
		return $sql['data'];
	}
	
	public function insert_other_payment($client_account, $account_receive, $option_account_invoice_type_id)
	{	
		$time											=	time();		
		$dp['client_id']								=	$client_account['client_id'];
		$dp['client_account_id']						=	$client_account['client_account_id'];
		$dp['client_account_invoice_number']			=	1;			
		$dp['option_account_invoice_type_id']			=	string_clean($option_account_invoice_type_id);
		$dp['client_account_invoice_recurr']			=	'0';
		$dp['client_account_invoice_recurr_count']		=	1;			
		$dp['client_account_invoice_date_paid']			=	$time;
		$dp['client_account_invoice_date_due']			=	$time;
		$dp['client_account_structure_id']				=	$client_account['client_account_structure_id'];
		
			
		# Balances		
		$dp['client_account_invoice_amount']			=	$account_receive['account_receive_amount_gross']; # Actual Amount		
		$dp['client_account_invoice_principal_amount']	=	$account_receive['account_receive_amount_gross']; # Remaining Principal Amount						
		$dp['client_account_invoice_balance_amount']	=	0;		
		$dp['client_account_invoice_interest_amount']	=	0; # Remaining Rebate Amount
		$dp['client_account_invoice_rebate_amount']		=	0; # Remaining Rebate Amount
		$dp['option_invoice_status_id']					=	'settled'; # paid
		# Insert						
		$sql	=	sql_insert($this->table_name, $dp, 'client_account_invoice_id');
		return $sql['data'];
		
	}
	
	
	public function insert_utilities($lot_wes_reading)
	{	
		$time											=	time();		
		$dp['client_id']								=	$lot_wes_reading['client_id'];
		$dp['client_account_id']						=	$lot_wes_reading['client_account_id'];
		$dp['client_account_invoice_number']			=	1;			
		$dp['option_account_invoice_type_id']			=	'utilities';
		$dp['client_account_invoice_recurr']			=	0;
		$dp['client_account_invoice_recurr_count']		=	1;			
		$dp['client_account_invoice_date_paid']			=	0;
		$dp['client_account_invoice_date_due']			=	$lot_wes_reading['lot_wes_reading_due_date'];
		$dp['client_account_structure_id']				=	0;
		
			
		# Balances		
		$dp['client_account_invoice_amount']			=	$lot_wes_reading['lot_wes_reading_current_total']; # Actual Amount		
		$dp['client_account_invoice_principal_amount']	=	0; # Remaining Principal Amount						
		$dp['client_account_invoice_balance_amount']	=	0;		
		$dp['client_account_invoice_interest_amount']	=	0; # Remaining Rebate Amount
		$dp['client_account_invoice_rebate_amount']		=	0; # Remaining Rebate Amount
		$dp['option_invoice_status_id']					=	'pending'; 
		# Insert						
		$sql	=	sql_insert($this->table_name, $dp, 'client_account_invoice_id');
		return $sql['data'];
		
	}
	
	public function insert_utilities_account($lot_wes)
	{	
		$time											=	time();		
		$dp['client_id']								=	$lot_wes_reading['client_id'];
		$dp['client_account_id']						=	$lot_wes_reading['client_account_id'];
		$dp['client_account_invoice_number']			=	1;			
		$dp['option_account_invoice_type_id']			=	$lot_wes['invoice_type_id'];
		$dp['client_account_invoice_recurr']			=	0;
		$dp['client_account_invoice_recurr_count']		=	1;			
		$dp['client_account_invoice_date_paid']			=	$time;
		$dp['client_account_invoice_date_due']			=	$time;
		$dp['client_account_structure_id']				=	0;
		
			
		# Balances		
		$dp['client_account_invoice_amount']			=	$lot_wes['amount_received']; # Actual Amount		
		$dp['client_account_invoice_principal_amount']	=	0; # Remaining Principal Amount						
		$dp['client_account_invoice_balance_amount']	=	0;		
		$dp['client_account_invoice_interest_amount']	=	0; # Remaining Rebate Amount
		$dp['client_account_invoice_rebate_amount']		=	0; # Remaining Rebate Amount
		$dp['option_invoice_status_id']					=	'settled'; 
		# Insert						
		$sql	=	sql_insert($this->table_name, $dp, 'client_account_invoice_id');
		return $sql['data'];
		
	}
	   
	public function insert_rsv_earnest($account_receive, $option_account_invoice_type_id)
	{	
		$time											=	time();		
		$dp['client_id']								=	0;
		$dp['client_account_id']						=	0;
		$dp['client_account_invoice_number']			=	1;			
		$dp['option_account_invoice_type_id']			=	string_clean($option_account_invoice_type_id);
		$dp['client_account_invoice_recurr']			=	'0';
		$dp['client_account_invoice_recurr_count']		=	1;			
		$dp['client_account_invoice_date_paid']			=	$time;
		$dp['client_account_invoice_date_due']			=	$time;
		$dp['client_account_structure_id']				=	0;
		
			
		# Balances		
		$dp['client_account_invoice_amount']			=	$account_receive['account_receive_amount_gross']; # Actual Amount		
		$dp['client_account_invoice_principal_amount']	=	$account_receive['account_receive_amount_gross']; # Remaining Principal Amount						
		$dp['client_account_invoice_balance_amount']	=	0;		
		$dp['client_account_invoice_interest_amount']	=	0; # Remaining Rebate Amount
		$dp['client_account_invoice_rebate_amount']		=	0; # Remaining Rebate Amount
		$dp['option_invoice_status_id']					=	'settled'; # paid
		# Insert						
		$sql	=	sql_insert($this->table_name, $dp, 'client_account_invoice_id');
		return $sql['data'];
	}
	
	public function restructure_credit_to_principal($client_account, $sum_paid_remaining, $excess, $next_invoice)
	{
		string_trail($sum_paid_remaining, 'Sum Remaining');
		string_trail($excess, 'Excess');
		$outstanding_balance							=	$sum_paid_remaining['amount'] - $sum_paid_remaining['paid'];
		string_trail($outstanding_balance, 'Remaining');
		$outstanding_balance							=	$outstanding_balance - $excess;		
		string_trail($outstanding_balance, 'Balance');
		$client_account['client_account_ma_amount']		=	$outstanding_balance;
		$this->insert_ma_partial($client_account, $next_invoice);
	}

	 
	
	public function update_due()
	{
		$now		=	time();
		$time		=	strtotime(date("M d Y", time()));	
		# Date Now
		$query	=	"
					SELECT 
					
						*,
						( SELECT sum(receive_amount_interest) FROM account_receive_invoice WHERE client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount_interest,
						( SELECT sum(receive_amount_principal) FROM account_receive_invoice WHERE client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount_principal,	
						( SELECT sum(receive_amount_surcharge) FROM account_receive_invoice WHERE client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount_surcharge	
										
					FROM client_account_invoice	
														
						inner join option_invoice_status on option_invoice_status.option_invoice_status_id = client_account_invoice.option_invoice_status_id				
					
					where 
						
					 	client_account_invoice.client_account_invoice_date_due_limit <= {$now} 
						AND 
						client_account_invoice.option_invoice_status_id != 1			
																		
		 								
					";
		$rows	=	sql_select($query);	
		
		#hash_dump($rows, 1);
		foreach($rows as $row)
		{			
			if($time > $row['client_account_invoice_date_update'])
			{
				$amount_paid		=	$row['receive_amount_interest'] + $row['receive_amount_principal'];
				$remaining			=	$row['client_account_invoice_amount'] - $amount_paid;									
				$surcharge			=	$this->compute_surcharge($row['client_account_invoice_date_due_limit'], $remaining);
				
				$data['client_account_invoice_is_late']					=	'1';			
				$data['client_account_invoice_date_update']				=	$time;			
				$data['client_account_invoice_surcharge_amount']		=	($row['client_account_invoice_amount'] == $remaining) ? $surcharge : $row['receive_amount_surcharge'] + $surcharge;
				#echo "({$row['client_account_invoice_amount']} > $remaining) ? $surcharge : $surcharge ;";die();
				sql_update('client_account_invoice', 'client_account_invoice_id', $row['client_account_invoice_id'], $data);
			}
			
		}				
		
	}
	
	public function update_account_credit_to_principal($client_account, $principal_amount)
	{
		$data['client_account_ma_amount']	=	$client_account['client_account_ma_amount'] - $principal_amount;
		sql_update('client_account', 'client_account_id', $client_account['client_account_id'], $data);
	}
	
	public function update_status($client_account_id, $invoice_id, $invoice_status)
	{
		# option_invoice_status_id : 0 - Pending
		# option_invoice_status_id : 1 - Setteled
		# option_invoice_status_id : 2 - Late : Demand Letter Sent
		$invoice_id = ($invoice_id) ? $invoice_id : 0;
        $client_account_id	=	$client_account_id * 1;
		$now	=	time();
		$query	=	"UPDATE client_account_invoice SET option_invoice_status_id = '{$invoice_status}', client_account_invoice_date_paid = {$now}  WHERE client_account_id = {$client_account_id} AND client_account_invoice_id IN ({$invoice_id})";
		sql_query($query);
	}
	
	public function update_surcharge_payment($client_account_invoice, $discount)
	{
		foreach($client_account_invoice as $row) # check if there is a surcharge discount
		{
			if($row['client_account_invoice_surcharge_amount'] > 0) #check if the invoice is overdue
			{
				$surcharge			=	$row['client_account_invoice_surcharge_amount'];
				$discount			=	($row['client_account_invoice_surcharge_amount'] * $discount) / 100;			
				
				$data['client_account_invoice_surcharge_amount']			=	0;
				$data['client_account_invoice_surcharge_discount']			=	$discount;
				$data['client_account_invoice_surcharge_previous_amount']	=	$discounted_amount;
				$data['client_account_invoice_date_due_limit']				=	time() + 86400;
				sql_update('client_account_invoice', 'client_account_invoice_id', $row['client_account_invoice_id'], $data);
			}			
		}			
	}
	
	public function delete_due($client_account_id, $filter = ' AND option_invoice_status_id = 0 ')
	{
		$query =	"delete from client_account_invoice where 
						
						option_account_invoice_type_id IN ('ma', 'cp') 	{$filter}	
					AND 
						client_account_id = {$client_account_id}";
		sql_query($query);
	}
	
	
	//update for Utilities
	
	public function update_utilities($post, $id)
	{
		$data					=	sql_parse_input('client_account_invoice', $post);					
									sql_update($this->table_name, 'client_account_invoice_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
# Helper

	public function compute_surcharge($date_due, $amount_due, $original_due = 0)
	{
		$days			=	$this->get_days_due($date_due);		
		$surcharge		=	(($amount_due * 60)/ 36000) * $days;
		$surcharge		=	round($surcharge, 2);
		$surcharge		=	($surcharge > 0) ? $surcharge : 0.00;		
		return $surcharge;
	}
	
	
	
	public function get_days_due($date_due, $is_string = false)
	{
		$now			=		time();
		$days			=		$now - ($date_due - 86400);
		$days			=		floor($days / 86400);
		if($is_string)
		{
			$days	=	($days > 1) ? $days . ' days' : $days . ' day';
		}		
		return $days;
	}
	
	public function compute_rebate($balance, $percent_rebate)
	{
		$rebate			=	($balance * $percent_rebate) / 100;
		$rebate			=	round($rebate, 2);
		
		return $rebate;
	} 
	
	public function compute_balance($outstanding_balance, $monthly_due, $interest_rate = 0, $rebate_percent = 0)
	{
		# Initialize
		$outstanding_balance		=	($outstanding_balance > 0) ? $outstanding_balance : 0.00;		
		# Computations
		$interest					=	($interest_rate /1200) * $outstanding_balance;
		$principal					=	$monthly_due - $interest;
		$remaining_balance			=	$outstanding_balance - $principal;
		# Rounding
		$interest					=	round($interest, 2);
		$principal					=	round($principal, 2);
		$remaining_balance			=	round($remaining_balance, 2);		
		
		if($principal > $outstanding_balance)
		{
			$principal		=	$outstanding_balance;
			$monthly_due	=	$interest + $principal;
			$monthly_due	=	round($monthly_due, 2);
		}
		
		# Assign
		$amount['interest']			=	($interest > 0) ? $interest : 0.00;		
		$amount['principal']		=	($principal > 0) ? $principal : 0.00;		
		$amount['balance']			=	($remaining_balance > 0) ? $remaining_balance : 0.00;			
		$amount['monthly']			=	$monthly_due;			
		$amount['rebate']			=	$this->compute_rebate($monthly_due, $rebate_percent);	
		return $amount;
	} 
	
}

/*

Rebate = 2%
Interest = 15
	 
 
*/