<?php
class model_lot_wes_account_receive
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot_wes_account_receive';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_wes_account_receive
					
					inner join lot_wes_reading ON lot_wes_account_receive.lot_wes_reading_id = lot_wes_reading.lot_wes_reading_id	
					inner join lot_wes ON lot_wes.lot_wes_id = lot_wes_reading.lot_wes_id	
					inner join client_account ON client_account.client_account_id = lot_wes_account_receive.client_account_id	 
					inner join client ON client.client_id = client_account.client_id
					inner join option_payment_status ON option_payment_status.option_payment_status_id = lot_wes_account_receive.option_payment_status_id
					inner join option_payment_method ON option_payment_method.option_payment_method_id = lot_wes_account_receive.option_payment_method_id
					inner join option_payment_receipt ON option_payment_receipt.option_payment_receipt_id = lot_wes_account_receive.option_payment_receipt_id
					inner join user ON user.user_id = lot_wes_account_receive.user_id
					
					inner join option_gender  ON client.option_gender_id = option_gender.option_gender_id
					inner join option_client_address  ON client.option_client_address_id = option_client_address.option_client_address_id
					inner join option_employment  ON client.option_employment_id = option_employment.option_employment_id
					inner join option_civil_status  ON client.option_civil_status_id = option_civil_status.option_civil_status_id
					
								
					
					WHERE 
					
					lot_wes_account_receive.lot_wes_reading_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		//echo $query;
		//hash_dump($list,1);
		return $list;
	}
	
	
	public function select_all($id,$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot_wes_account_receive 
						
						inner join lot_wes_reading ON lot_wes_account_receive.lot_wes_reading_id = lot_wes_reading.lot_wes_reading_id	
						inner join lot_wes ON lot_wes.lot_wes_id = lot_wes_reading.lot_wes_id	
						inner join lot ON lot.lot_id = lot_wes.lot_id
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id					
						inner join client_account ON client_account.lot_id = lot.lot_id	 AND 	client_account.option_account_status_id != 'ejected'
						inner join client ON client.client_id = client_account.client_id				
						inner join lot_wes_status ON lot_wes_status.lot_wes_status_id = lot_wes.lot_wes_status_id	
						inner join lot_wes_reading_status ON lot_wes_reading_status.lot_wes_reading_status_id = lot_wes_reading.lot_wes_reading_status_id
						inner join option_payment_status ON option_payment_status.option_payment_status_id = lot_wes_account_receive.option_payment_status_id
						inner join option_payment_method ON option_payment_method.option_payment_method_id = lot_wes_account_receive.option_payment_method_id
					    inner join option_payment_receipt ON option_payment_receipt.option_payment_receipt_id = lot_wes_account_receive.option_payment_receipt_id
						inner join user ON user.user_id = lot_wes_account_receive.user_id
						
					WHERE 	lot_wes_reading.lot_wes_id = {$id}
						
					{$filter}	
					
					ORDER BY 	lot_wes_account_receive_timestamp DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'finance_wes/template/row.transaction_history';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'finance_wes/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                 $row['user_']    		 			=  $row['user_name'] .' '. $row['user_surname'] ;
                $row['receive_date']    			=  string_date($row['lot_wes_account_receive_timestamp']);
                $row['amount_receive']    			=  'P '. string_amount($row['lot_wes_account_receive_amount_net']);
				$list				   			   .=  view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	public function get_cashier_transaction_row($payment_receipt_id = 'all')
	{		
			$filter		=	'';
			# Template
			$template_row		=	'finance_wes/template/row.transaction';
			$template_row		=	view_get_template($template_row);
			$template_row_empty	=	'finance_wes/template/row.transaction.empty';
			$template_row_empty	=	view_get_template($template_row_empty);		
			
		
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot_wes_account_receive
						
						
						inner join lot_wes_reading ON lot_wes_reading.lot_wes_reading_id = lot_wes_account_receive.lot_wes_reading_id	
						inner join lot_wes ON lot_wes.lot_wes_id = lot_wes_reading.lot_wes_id
						inner join lot on lot.lot_id = lot_wes.lot_id
						inner join user on user.user_id = lot_wes_account_receive.user_id						
						inner join option_payment_method on option_payment_method.option_payment_method_id = lot_wes_account_receive.option_payment_method_id
						inner join option_payment_receipt on option_payment_receipt.option_payment_receipt_id = lot_wes_account_receive.option_payment_receipt_id
						inner join option_payment_status on option_payment_status.option_payment_status_id = lot_wes_account_receive.option_payment_status_id
						
						inner join project_site on project_site.project_site_id = lot.project_site_id
						inner join project_site_block on project_site_block.project_site_block_id = lot.project_site_block_id
						
						left join client_account on client_account.client_account_id = lot_wes_account_receive.client_account_id
						left join client on client.client_id = client_account.client_id						
						
					
					WHERE 
					
						lot_wes_account_receive.lot_wes_account_receive_amount_gross > 0
					
					ORDER BY lot_wes_account_receive.lot_wes_account_receive_timestamp DESC
					
					";
		$rows	=	sql_select($query);
		
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{	               
				$row['lot_wes_account_receive_timestamp']	=	string_date_time($row['lot_wes_account_receive_timestamp']);
				$row['lot_wes_account_receive_amount_net']	=	string_amount($row['lot_wes_account_receive_amount_net']);
				$row['lot_wes_type']						=   ucfirst($row['lot_wes_type']);
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

	public function insert($post)
	{
		$data														=	sql_parse_input('lot_wes_account_receive', $post);
		$data['lot_wes_account_receive_timestamp']							=	time();			
		$sql														=	sql_insert($this->table_name, $data, 'lot_wes_account_receive_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('lot_wes_account_receive', $post);					
									sql_update($this->table_name, 'lot_wes_account_receive_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
	 
	
}
 