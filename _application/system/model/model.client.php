<?php
class model_client
{	
	
	public function __construct() 
	{
		$this->table_name		=	'client';
		$this->message_insert	=	'A new lot has been successfully added.';
	}
	
# Data Select

	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		
		$query	=	"select 
						*
					from client 					
						left join option_client_address on option_client_address.option_client_address_id = client.option_client_address_id
						left join option_gender on option_gender.option_gender_id = client.option_gender_id
						left join option_employment on option_employment.option_employment_id = client.option_employment_id
						left join option_civil_status on option_civil_status.option_civil_status_id = client.option_civil_status_id
						inner join user on user.user_id = client.user_id
					where client.client_id = {$id}";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	} 
	
	  
	 
# Get Ouput

	public function get_row($filter = '')
	{
		$query	=	"select
						
						*,
						(select count(client_account_id) from client_account where client_id = client.client_id and option_account_status_id != 'ejected') as client_account_count_active,
						(select count(client_account_id) from client_account where client_id = client.client_id  and option_account_status_id = 'ejected') as client_account_count_ejected
					
					from client	
						
						inner join user on user.user_id = client.user_id						
						inner join option_client_address on option_client_address.option_client_address_id = client.option_client_address_id
					
					ORDER BY 
						 
						 client.client_surname ASC";		
								
		$rows	=	sql_select($query);	
		# Template
		$template_row		=	'edp_client/template/row.manage';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'edp_client/template/row.manage.empty';
		$template_row_empty	=	view_get_template($template_row_empty);		
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['client_timestamp']    		=    string_date($row['client_timestamp']);				
                $row['client_account_date_sale']    =    string_date($row['client_account_date_sale']);				
				$list						.=	view_populate($row, $template_row);
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
		$data							=	sql_parse_input('client', $post);
		$data['client_timestamp']		=	time();			
		$data['client_birthday']		=	(strtotime($data['client_birthday']) > 0) ? strtotime($data['client_birthday']) : strtotime($data['client_birthday']) * -1 ;			
		$sql							=	sql_insert($this->table_name, $data, 'client_id');		
		$return['result']				=	$sql['result'];
		$return['data']					=	$sql['data'];
		$return['message']				=	$sql['message'];		
		return $return;
	}
	
	private function _insert_lot_price($post, $lot)
	{
		$data['lot_price_timestamp']	=	time();
		$data['lot_id']					=	$lot['lot_id'];
		$data['user_id']				=	$post['user_id'];
		$data['lot_price_value']		=	$lot['lot_price'];
		sql_insert('lot_price', $data);
	}
	  
	public function update($post, $id)
	{
		$data					=	sql_parse_input('lot', $post);					
									sql_update($this->table_name, 'lot_id', $id, $data);
		$data['lot_id']			=	$id;																
		$this->_insert_lot_price($post, $data);		
		
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function update_package($post, $id)
	{
		$id						=	string_clean_number($id);
		$data					=	sql_parse_input('lot', $post);
		sql_update($this->table_name, 'lot_id', $id, $data);
	}
	
	public function update_earnest($post, $id)
	{
		$data					=	sql_parse_input('lot', $post);					
									sql_update($this->table_name, 'lot_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
	 
	
}

