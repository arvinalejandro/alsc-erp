<?php
class model_account_receive
{	
	
	public function __construct()
	{
		$this->table_name		=	'account_receive';
		$this->message_insert	=	'A new lot has been successfully added.';
	}
	
# Data Select

	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		
		$query	=	"SELECT 
						*,
						( SELECT sum(receive_amount) FROM account_receive_invoice WHERE account_receive_id = account_receive.account_receive_id) AS receive_amount,
						( SELECT sum(receive_amount_surcharge) FROM account_receive_invoice WHERE account_receive_id = account_receive.account_receive_id) AS receive_amount_surcharge,
						( SELECT sum(receive_amount_interest) FROM account_receive_invoice WHERE account_receive_id = account_receive.account_receive_id) AS receive_amount_interest,
						( SELECT sum(receive_amount_principal) FROM account_receive_invoice WHERE account_receive_id = account_receive.account_receive_id) AS receive_amount_principal,
						( SELECT sum(receive_amount_rebate) FROM account_receive_invoice WHERE account_receive_id = account_receive.account_receive_id) AS receive_amount_rebate						
					
					FROM account_receive
					
						left join client_account on client_account.client_account_id = account_receive.client_account_id
						left join client on client.client_id = client_account.client_id
						left join lot on lot.lot_id = client_account.lot_id
						left join project_site on project_site.project_site_id = lot.project_site_id
						left join project_site_block on project_site_block.project_site_block_id = lot.project_site_block_id
						inner join user on user.user_id = account_receive.user_id						
						inner join option_payment_method on option_payment_method.option_payment_method_id = account_receive.option_payment_method_id
						inner join option_payment_receipt on option_payment_receipt.option_payment_receipt_id = account_receive.option_payment_receipt_id
						inner join option_payment_status on option_payment_status.option_payment_status_id = account_receive.option_payment_status_id
										
					where account_receive.account_receive_id = {$id}";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
	  
	
# Get Ouput
 
	
	public function get_cashier_transaction_row($payment_receipt_id = 'all')
	{		
		
		$template_row		=	'finance_cashier/template/row.collection';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'finance_cashier/template/row.collection.empty';
		$template_row_empty	=	view_get_template($template_row_empty);	
		
		
		if($payment_receipt_id === 'all')
		{			
			$filter		=	'';
			# Template
			$template_row		=	'finance_cashier/template/row.transaction';
			$template_row		=	view_get_template($template_row);
			$template_row_empty	=	'finance_cashier/template/row.transaction.empty';
			$template_row_empty	=	view_get_template($template_row_empty);		
		}		
		
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM account_receive
						inner join user on user.user_id = account_receive.user_id						
						inner join option_payment_method on option_payment_method.option_payment_method_id = account_receive.option_payment_method_id
						inner join option_payment_receipt on option_payment_receipt.option_payment_receipt_id = account_receive.option_payment_receipt_id
						inner join option_payment_status on option_payment_status.option_payment_status_id = account_receive.option_payment_status_id
						inner join lot on lot.lot_id = account_receive.lot_id
						inner join project_site on project_site.project_site_id = lot.project_site_id
						inner join project_site_block on project_site_block.project_site_block_id = lot.project_site_block_id
						
						left join client_account on client_account.client_account_id = account_receive.client_account_id
						left join client on client.client_id = client_account.client_id						
						
						
						
						
					
					WHERE 
					
						account_receive.account_receive_amount_gross > 0
					
					ORDER BY account_receive.account_receive_timestamp DESC
					
					";
		$rows	=	sql_select($query);
		
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{	               
				$row['client']						=	($row['client_id']) ? "{$row['client_surname']}, {$row['client_name']}"  :  'External';
				$row['account_receive_timestamp']	=	string_date_time($row['account_receive_timestamp']);
				$row['account_receive_net_amount']	=	string_amount($row['account_receive_net_amount']);
				$row['account_receive_amount_gross']	=	string_amount($row['account_receive_amount_gross']);
				$list								.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	} 
	
	
	public function get_cashier_account_row($client_account_id)
	{
		$id		=	$client_account_id * 1;
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM account_receive					
						
						inner join user on user.user_id = account_receive.user_id
						
						inner join option_payment_method on option_payment_method.option_payment_method_id = account_receive.option_payment_method_id
						inner join option_payment_receipt on option_payment_receipt.option_payment_receipt_id = account_receive.option_payment_receipt_id
						inner join option_payment_status on option_payment_status.option_payment_status_id = account_receive.option_payment_status_id
						inner join option_income_type on option_income_type.option_income_type_id = account_receive.option_income_type_id
						
						
					WHERE account_receive.client_account_id = {$id}
					ORDER BY account_receive.account_receive_timestamp DESC
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'finance_cashier/template/row.account.transaction';
		$template_row		=	view_get_template($template_row);
		#$template_row_empty	=	'edp_client/template/row.manage.member.empty';
		#$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{	               
				$row['account_receive_timestamp']	=	string_date_time($row['account_receive_timestamp']);
				$row['account_receive_net_amount']	=	string_amount($row['account_receive_net_amount']);
				$list								.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	
	
	
	
	public function get_client_manage_reservation($lot_id)
	{
		$lot_id		=	$lot_id * 1;
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM account_receive					
						
						inner join account_receive_invoice on account_receive_invoice.account_receive_id = account_receive.account_receive_id
						inner join client_account_invoice on client_account_invoice.client_account_invoice_id = account_receive_invoice.client_account_invoice_id
						inner join user on user.user_id = account_receive.user_id
						inner join option_payment_method on option_payment_method.option_payment_method_id = account_receive.option_payment_method_id
						inner join option_payment_receipt on option_payment_receipt.option_payment_receipt_id = account_receive.option_payment_receipt_id
						inner join option_payment_status on option_payment_status.option_payment_status_id = account_receive.option_payment_status_id	
						
						inner join lot on account_receive.lot_id = lot.lot_id
						inner join project_site_block on project_site_block.project_site_block_id = lot.project_site_block_id 					
						inner join project_site on project_site.project_site_id = project_site_block.project_site_id 					
						inner join project on project.project_id = project_site.project_id 					
						
					WHERE 
					
						account_receive.lot_id = {$lot_id} AND 
						client_account_invoice.option_account_invoice_type_id = 'reservation'
						
					ORDER BY 
					
						account_receive.account_receive_timestamp DESC
					
					";
		$rows	=	sql_select($query);		
				
		# Template
		$template_row		=	'edp_client/template/row.manage.reservation';
		$template_row		=	view_get_template($template_row);
		#$template_row_empty	=	'edp_client/template/row.manage.member.empty';
		#$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{	               
				$row['account_receive_timestamp']			=	string_date_time($row['account_receive_timestamp']);
				$row['account_receive_amount_gross']		=	string_amount($row['account_receive_amount_gross']);
				$list										.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	public function get_client_manage_earnest($lot_id)
	{
		$lot_id		=	$lot_id * 1;
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM account_receive					
						
						inner join account_receive_invoice on account_receive_invoice.account_receive_id = account_receive.account_receive_id
						inner join client_account_invoice on client_account_invoice.client_account_invoice_id = account_receive_invoice.client_account_invoice_id
						inner join user on user.user_id = account_receive.user_id
						inner join option_payment_method on option_payment_method.option_payment_method_id = account_receive.option_payment_method_id
						inner join option_payment_receipt on option_payment_receipt.option_payment_receipt_id = account_receive.option_payment_receipt_id
						inner join option_payment_status on option_payment_status.option_payment_status_id = account_receive.option_payment_status_id	
						
						inner join lot on account_receive.lot_id = lot.lot_id
						inner join project_site_block on project_site_block.project_site_block_id = lot.project_site_block_id 					
						inner join project_site on project_site.project_site_id = project_site_block.project_site_id 					
						inner join project on project.project_id = project_site.project_id 					
						
					WHERE 
					
						account_receive.lot_id = {$lot_id} AND 
						client_account_invoice.option_account_invoice_type_id = 'earnest'
						
					ORDER BY 
					
						account_receive.account_receive_timestamp DESC
					
					";
		$rows	=	sql_select($query);		
				
		# Template
		$template_row		=	'edp_client/template/row.manage.reservation';
		$template_row		=	view_get_template($template_row);
		#$template_row_empty	=	'edp_client/template/row.manage.member.empty';
		#$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{	               
				$row['account_receive_timestamp']			=	string_date_time($row['account_receive_timestamp']);
				$row['account_receive_amount_gross']		=	string_amount($row['account_receive_amount_gross']);
				$list										.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	
# Modify

	public function insert($post)
	{		
		$data											=	sql_parse_input('account_receive', $post);					
		$data['option_payment_status_id']				=	($data['option_payment_method_id'] == 'check') ? 'pending' : 'valid'; 		
		$data['account_receive_timestamp']				=	time();					
		$sql									=	sql_insert($this->table_name, $data, 'account_receive_id');			
		$return['result']						=	$sql['result'];
		$return['data']							=	$sql['data'];
		$return['message']						=	$sql['message'];		
		return $return['data'];	
	}
	
		
	
	
	public function update_to_client($client_account, $account_receive_ids)
	{
		echo $receipt_ids	=	$this->_account_receive_ids($account_receive_ids);
		if($receipt_ids)
		{
			$update_account				=	"UPDATE account_receive SET client_account_id = {$client_account['client_account_id']} WHERE account_receive_id IN ({$receipt_ids})";
			$update_receive_invoice		=	"UPDATE account_receive_invoice SET client_account_id = {$client_account['client_account_id']} WHERE account_receive_id IN ({$receipt_ids})";
			$update_client_invoice		=	"UPDATE client_account_invoice SET client_account_id = {$client_account['client_account_id']}, client_id = {$client_account['client_id']} WHERE client_account_invoice_id IN (select client_account_invoice_id from account_receive_invoice where account_receive_id IN ({$receipt_ids}))";
			sql_query($update_account);	sql_query($update_receive_invoice);	sql_query($update_client_invoice);
		}
		
	}
	
	public function insert_invoice($account_receive_id, $invoice)
	{		
		$invoice								=	explode(',', $invoice);		
		$data['account_receive_id']				=	$account_receive_id;	
		
		foreach($invoice as $id)
		{
			$data['client_account_invoice_id']		=	trim($id) * 1;
			$sql									=	sql_insert('account_receive_invoice', $data);
		}
	}
	
	private function _account_receive_ids($account_receive_ids)
	{
		if($account_receive_ids)
		{
			$account_receive_ids	=	explode(',', $account_receive_ids);
			foreach($account_receive_ids as $id)
			{
				$id			=	trim($id);
				$data[]		=	"'{$id}'";
			}
			$account_receive_ids	=	implode(',', $data);
			return $account_receive_ids;
		}	
		else
		{
			return false;
		}
	}
	
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
	
	
	
	 
	
}
