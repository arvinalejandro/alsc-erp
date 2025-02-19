<?php
class model_account_receive_invoice
{	
	
	public function __construct()
	{
		$this->table_name		=	'account_receive_invoice';
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
	
	public function select_aggregate($client_account_invoice_id)
	{
		$id			=	$client_account_invoice_id * 1;
		$query		=	"
						select
							sum(receive_amount) AS receive_amount,
							sum(receive_amount_surcharge) AS receive_amount_surcharge,
							sum(receive_amount_interest) AS receive_amount_interest,
							sum(receive_amount_principal) AS receive_amount_principal,
							sum(receive_amount_rebate) AS receive_amount_rebate
						FROM
							account_receive_invoice
						WHERE
							client_account_invoice_id = {$id}								
						";
		$rows		=	sql_select($query);
		return $rows[0];
	}
	
# Get Ouput

	public function get_transaction_invoice($id)
	{		
		$id		=	$id * 1;
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM 
						account_receive_invoice
						
					INNER JOIN
						client_account_invoice on client_account_invoice.client_account_invoice_id = account_receive_invoice.client_account_invoice_id
					INNER JOIN
						option_account_invoice_type on option_account_invoice_type.option_account_invoice_type_id = client_account_invoice.option_account_invoice_type_id
						
					WHERE
						account_receive_invoice.account_receive_id = {$id}				
																						
					ORDER BY account_receive_invoice.account_receive_invoice_id DESC
					
					";
		$rows	=	sql_select($query);
		
		# Template
		$template_row		=	'finance_cashier/template/row.transaction.invoice';
		$template_row		=	view_get_template($template_row);
		#$template_row_empty	=	'finance_cashier/template/row.transaction.empty';
		#$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{	               
				$row['client']							=	($row['client_id']) ? "{$row['client_surname']}, {$row['client_name']}"  :  'External';				
				$row['receive_amount']					=	string_amount($row['receive_amount']);
				$row['receive_amount_principal']		=	string_amount($row['receive_amount_principal']);
				$row['receive_amount_surcharge']		=	string_amount($row['receive_amount_surcharge']);
				$row['receive_amount_interest']			=	string_amount($row['receive_amount_interest']);
				$row['receive_amount_gross']			=	string_amount($row['receive_amount_gross']);
				$row['account_receive_net_amount']		=	string_amount($row['account_receive_net_amount']);				
				$list									.=	view_populate($row, $template_row);
			}			
		} 
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	
	}
	
	public function get_soa_invoice($id)
	{		
		$id		=	$id * 1;
		# DB
		$query	=	"
					
					SELECT 
						*, 		
						(select sum(receive_amount) from account_receive_invoice where client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount,
						(select sum(receive_amount_surcharge) from account_receive_invoice where client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount_surcharge,
						(select sum(receive_amount_interest) from account_receive_invoice where client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount_interest,
						(select sum(receive_amount_principal) from account_receive_invoice where client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount_principal,
						(select sum(receive_amount_rebate) from account_receive_invoice where client_account_invoice_id = client_account_invoice.client_account_invoice_id) AS receive_amount_rebate,
						(select account_receive_receipt from account_receive where account_receive_id = (select max(account_receive_id) from account_receive_invoice where client_account_invoice_id =  client_account_invoice.client_account_invoice_id) )as account_receive_receipt, 
						(select account_receive_timestamp from account_receive where account_receive_id = (select max(account_receive_id) from account_receive_invoice where client_account_invoice_id =  client_account_invoice.client_account_invoice_id) )as account_receive_timestamp
												
					FROM 
					
						client_account_invoice	
																
					WHERE
						client_account_id = {$id}	AND option_account_invoice_type_id IN ('dp', 'ma', 'cp')

					having 
						receive_amount > 0
																											
					ORDER BY 
						client_account_invoice_id ASC
					
					";
		$rows	=	sql_select($query);
		
		# Template 
		$template_row		=	'finance_cashier/template/row.soa.invoice';
		$template_row		=	view_get_template($template_row);
		#$template_row_empty	=	'finance_cashier/template/row.transaction.empty';
		#$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{	               
				# Date
				$row['account_receive_timestamp']				=	string_date($row['account_receive_timestamp']);
				$row['client_account_invoice_date_due']			=	string_date($row['client_account_invoice_date_due']);		
				# Amount
				$row['client_account_invoice_balance_amount']	=	$row['client_account_invoice_balance_amount'] - $row['receive_amount_principal'];
				$row['receive_amount_rebate']					=	string_amount($row['receive_amount_rebate']);
				$row['receive_amount_surcharge']				=	string_amount($row['receive_amount_surcharge']);
				$row['receive_amount_interest']					=	string_amount($row['receive_amount_interest']);
				$row['receive_amount']							=	string_amount($row['receive_amount']);
				$row['receive_amount_principal']				=	string_amount($row['receive_amount_principal']);
				$row['client_account_invoice_balance_amount']	=	string_amount($row['client_account_invoice_balance_amount']);
				
				if($row['option_account_invoice_type_id'] == 'dp') $row['term'] = 'PD';
				else if ($row['option_account_invoice_type_id'] == 'ma') $row['term'] = 'MA';
				else if ($row['option_account_invoice_type_id'] == 'cp') $row['term'] = 'CP';
				
					
				
				
				
				
				$list								.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	
	}
	
		
	
	
	
	
	
# Modify

	 

	public function insert($account_receive, $payment_invoice, $is_vat, $vat_base)  
	{	
		$account_receive_invoice	=	array();
		$budget_amount				=	$account_receive['account_receive_amount_gross'];
		
         #string_trail($account_receive, 'Receipt');
         #string_trail($payment_invoice, 'Invoice');
        # On Surcharge : need to update invoice surcharge discount before this process!!!
		foreach($payment_invoice as $row)
		{			
			# Previous Payment Summation
			$previous_payment								=	$this->select_aggregate($row['client_account_invoice_id']);
			# Already Paid
			$previous_payment['receive_amount'] 			= 	($previous_payment['receive_amount']) ? $previous_payment['receive_amount'] : 0;
   	 		$previous_payment['receive_amount_surcharge'] 	= 	($previous_payment['receive_amount_surcharge']) ? $previous_payment['receive_amount_surcharge'] : 0;
    		$previous_payment['receive_amount_interest'] 	=	($previous_payment['receive_amount_interest']) ? $previous_payment['receive_amount_interest'] : 0;
    		$previous_payment['receive_amount_principal'] 	= 	($previous_payment['receive_amount_principal']) ? $previous_payment['receive_amount_principal'] : 0;
    		$previous_payment['receive_amount_rebate'] 		=	($previous_payment['receive_amount_rebate']) ? $previous_payment['receive_amount_rebate'] : 0;
			# Remaining
			$remaining_surcharge	=	($row['client_account_invoice_surcharge_amount'] + $row['client_account_invoice_surcharge_previous_amount'])		-	$previous_payment['receive_amount_surcharge'];
			
			$remaining_interest		=	$row['client_account_invoice_interest_amount']		-	$previous_payment['receive_amount_interest'];
			$remaining_principal	=	$row['client_account_invoice_principal_amount']		-	$previous_payment['receive_amount_principal'];
			
			
			
			if($budget_amount > 0)
			{ 
				# Budget Allocation
				$data['receive_amount_surcharge']	=	$this->payment_allocation($budget_amount, $remaining_surcharge);
				$budget_amount						=	$budget_amount - $data['receive_amount_surcharge'];
				$data['receive_amount_interest']	=	$this->payment_allocation($budget_amount, $remaining_interest);
				$budget_amount						=	$budget_amount - $data['receive_amount_interest'];
				$data['receive_amount_principal']	=	$this->payment_allocation($budget_amount, $remaining_principal);
				$budget_amount						=	$budget_amount - $data['receive_amount_principal'];				
			
				# Parameters
				$data['account_receive_id']				=	$account_receive['account_receive_id'];
				$data['client_account_id']				=	$account_receive['client_account_id'];
				$data['client_account_invoice_id']		=	$row['client_account_invoice_id'];
				$data['receive_amount']					=	$data['receive_amount_surcharge'] + $data['receive_amount_interest'] + $data['receive_amount_principal'];
				$data['receive_timestamp']				=	$account_receive['account_receive_timestamp'];		
				
				if($is_vat)
				{
					$data['receive_net']				=	$data['receive_amount'] - ($data['receive_amount'] * $vat_base);				
					$data['receive_net_surcharge']		=	$data['receive_amount_surcharge'] - ($data['receive_amount_surcharge'] * $vat_base);				
					$data['receive_net_interest']		=	$data['receive_amount_interest'] - ($data['receive_amount_interest'] * $vat_base);				
					$data['receive_net_principal']		=	$data['receive_amount_principal'] - ($data['receive_amount_principal'] * $vat_base);			
				}
				else
				{
					$data['receive_net']				=	$data['receive_amount'];			
					$data['receive_net_surcharge']		=	$data['receive_amount_surcharge'];		
					$data['receive_net_interest']		=	$data['receive_amount_interest'];
					$data['receive_net_principal']		=	$data['receive_amount_principal'];
				}
							
				# Update status
				$remaining_principal	=	round($remaining_principal, 2);
				$interest_principal		=	round($remaining_principal + $remaining_interest + $previous_payment['receive_amount_interest'] + $previous_payment['receive_amount_principal'], 2);
			
                #string_trail($data, 'test');
            
				# SQl Query
				sql_insert('account_receive_invoice', $data);	
				
				if($remaining_principal == $data['receive_amount_principal'])
				{					
					mvc_model('model.client_account_invoice')->update_status($row['client_account_id'], $row['client_account_invoice_id'], 'settled');					
				}
				$budget_amount	=	round($budget_amount, 2); # clean the float issue
			}			
		}				
	}
	
	public function insert_other($account_receive, $invoice, $vat_base)
	{		
		# Parameters
		$data['client_account_invoice_id']		=	$invoice['client_account_invoice_id'];	
		$data['account_receive_id']				=	$account_receive['account_receive_id'];
		$data['client_account_id']				=	$account_receive['client_account_id'];
		# Amount
		$data['receive_amount']					=	$account_receive['account_receive_amount_gross'];
		$data['receive_amount_principal']		=	$account_receive['account_receive_amount_gross'];
		$data['receive_amount_surcharge']		=	0;
		$data['receive_amount_interest']		=	0;
		# Net Amount
		$data['receive_net']					=	$data['receive_amount'] - ($data['receive_amount'] * $vat_base);
		$data['receive_net_principal']			=	$data['receive_amount_principal'] - ($data['receive_amount_principal'] * $vat_base);					
		$data['receive_net_surcharge']			=	0;
		$data['receive_net_interest']			=	0;		
		# Insert
		$data['receive_timestamp']				=	$account_receive['account_receive_timestamp'];		
		sql_insert('account_receive_invoice', $data);	
	}
	
	
	
	
	public function insert_rsv_earnest_invoice($account_receive, $invoice, $vat_base)
	{
		# Parameters
		$data['client_account_invoice_id']		=	$invoice['client_account_invoice_id'];	
		$data['account_receive_id']				=	$account_receive['account_receive_id'];
		$data['client_account_id']				=	$account_receive['client_account_id'];
		# Amount
		$data['receive_amount']					=	$account_receive['account_receive_amount_gross'];
		$data['receive_amount_principal']		=	$account_receive['account_receive_amount_gross'];
		$data['receive_amount_surcharge']		=	0;
		$data['receive_amount_interest']		=	0;
		# Net Amount
		$data['receive_net']					=	$data['receive_amount'] - ($data['receive_amount'] * $vat_base);
		$data['receive_net_principal']			=	$data['receive_amount_principal'] - ($data['receive_amount_principal'] * $vat_base);					
		$data['receive_net_surcharge']			=	0;
		$data['receive_net_interest']			=	0;		
		# Insert
		$data['receive_timestamp']				=	$account_receive['account_receive_timestamp'];		
		sql_insert('account_receive_invoice', $data);	
	}
	
	
	
	public function insert_cp_invoice($account_receive, $invoice)
	{
		$data['receive_amount_surcharge']		=	0;
		$data['receive_amount_interest']		=	0;
		$data['client_account_invoice_id']		=	$invoice['client_account_invoice_id'];		
		# Parameters
		$data['account_receive_id']				=	$account_receive['account_receive_id'];
		$data['client_account_id']				=	$account_receive['client_account_id'];
		$data['receive_amount_principal']		=	$account_receive['account_receive_excess_amount'];
		$data['receive_amount']					=	$account_receive['account_receive_excess_amount'];
		$data['receive_timestamp']				=	$account_receive['account_receive_timestamp'];		
		sql_insert('account_receive_invoice', $data);	
	}
	
/*
	public function insert_invoice($account_receive_id, $invoice)
	{		
		$data									=	sql_parse_input('account_receive', $post);	
			
		$data['option_payment_status_id']		=	($data['option_payment_method_id'] == 0) ? 0 : 1; # option_payment_method_id : 0 - Check Payment | Subject for validation		
		$data['account_receive_timestamp']		=	time();		
		$sql									=	sql_insert($this->table_name, $data, 'account_receive_id');			
		$return['result']						=	$sql['result'];
		$return['data']							=	$sql['data'];
		$return['message']						=	$sql['message'];		
		return $return;	
	}
*/
	
	public function insert_batch($post, $client_id)
	{
		foreach($post as $member)
		{			
			$this->insert($member, $client_id);
		}
	}
	
	public function delete($id)
	{		
		$data[]							=	string_clean_number($id);
		sql_delete('client_member', 'client_member_id', $data);	
	}

# Helper
	
	private function payment_allocation($budget, $balance)
	{
		if($budget > 0)
		{
			$amount		=	($budget >= $balance) 	?	$balance : $budget;
		}
		else
		{
			$amount		=	0;
		}
		$amount		=	round($amount, 2);
		return $amount;
	}	
	 
	
}
