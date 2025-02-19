<?php
class model_client_account_structure
{	
	
	public function __construct()
	{
		$this->table_name		=	'client_account_structure';
		$this->message_insert	=	'A new lot has been successfully added.';
	}
	
# Data Select

	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		
		$query	=	"SELECT 
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
						left join network on network.network_id = client_account.network_id
						left join network_division on network_division.network_division_id = client_account.network_division_id
											
						left join lot on lot.lot_id = client_account.lot_id		
						left join house on house.house_id = lot.house_id
						left join option_house_classification on option_house_classification.option_house_classification_id = house.option_house_classification_id							
						left join project on project.project_id = lot.project_id						
						left join project_site on project_site.project_site_id = lot.project_site_id						
						left join project_site_block on project_site_block.project_site_block_id = lot.project_site_block_id				
					
					where client_account.client_account_id = {$id}";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		
		$rows['house_price_sqm']	=	($rows['house_area']) ? 'P ' .string_amount(($rows['client_account_hcp'] / $rows['house_area'])) . ' / sqm' : 'P 0.00';
		
		return $rows;
	}
	
	
	
	
# Get Ouput

	public function get_row($id)
	{
		$id		=	$id * 1;
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
						left join network on network.network_id = client_account.network_id
						left join network_division on network_division.network_division_id = client_account.network_division_id
						
					
					where client_account.client_id = {$id}
					
					ORDER BY lot.lot_id DESC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_client/template/row.manage.account';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'edp_client/template/row.manage.account.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{                
				$row['client_account_tcp_net']	=	string_amount($row['client_account_tcp_net']);
				$list			.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	
	   
	
	
# Modify
		

	public function insert($post, $client_id, $client_account_id)
	{			
		$data										=	sql_parse_input('client_account_structure', $post);
		$data['client_id']							=	$client_id * 1;
		$data['client_account_id']					=	$client_account_id * 1;
		$data['client_account_structure_timestamp']	=	time();		
		$data['client_account_ma_due_date']			=	($data['client_account_ma_due_date']) ? strtotime($data['client_account_ma_due_date']) : 0;		
		
		$sql										=	sql_insert($this->table_name, $data, 'client_account_structure_id');			
			
		$return['result']						=	$sql['result'];
		$return['data']							=	$sql['data'];
		$return['message']						=	$sql['message'];		
		return $return;
	}
	
	
	
	
}
