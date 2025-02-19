<?php
class model_account_letter
{	
	
	public function __construct()
	{
		$this->table_name		=	'account_letter';
		$this->message_insert	=	'A new lot has been successfully added.';
	}
	
# Data Select

	public function select($id)
	{		
		$id		=	string_clean_number($id);
		
		$query	=	"SELECT 
						* 		
					FROM account_letter 					
					
					where account_letter_id = {$id}";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
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
					FROM account_letter 
						inner join user on user.user_id = account_letter.user_id
											
					where account_letter.client_account_id = {$id}
					
					ORDER BY account_letter.account_letter_id DESC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'finance_billing/template/row.due.account_letter';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'finance_billing/template/row.due.account_letter.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{                
				$row['account_letter_timestamp']	=	string_date_time($row['account_letter_timestamp']);
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

	public function insert($post)
	{		
		$data										=	sql_parse_input('account_letter', $post);	
		$data['account_letter_year']				=	date('Y');
		$data['account_letter_month']				=	date('n');
		$data['account_letter_timestamp']			=	time();
		$sql										=	sql_insert($this->table_name, $data);			
		$return['result']							=	$sql['result'];
		$return['data']								=	$sql['data'];
		$return['message']							=	$sql['message'];		
		return $return;
	}
	
	
	
	
	 
	
}
