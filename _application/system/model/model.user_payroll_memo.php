<?php
class model_user_payroll_memo
{	
	
	public function __construct()
	{
		$this->table_name		=	'user_payroll_memo';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_memo
					
						
					
					WHERE 
					
					user_payroll_memo_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	public function select_user_active($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_memo
					
					INNER JOIN option_payroll_memo ON option_payroll_memo.option_payroll_memo_id = user_payroll_memo.option_payroll_memo_id
					
						
					
					WHERE 
					
					user_id = {$id}
					
					AND
					
					user_payroll_memo_status = 'active'
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows;
		return $list;
	}
	
	public function select_all($id,$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_memo 
					
					INNER JOIN option_payroll_memo ON option_payroll_memo.option_payroll_memo_id = user_payroll_memo.option_payroll_memo_id
					
					
					WHERE user_id = {$id}
					
						
					{$filter}	
					
					ORDER BY 	user_payroll_memo_id DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.payroll_memo';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.empty_memo';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
               
				$row['user_payroll_memo_date_late']			 =  string_date_day_enclosed($row['user_payroll_memo_date_late']);
				$row['user_payroll_memo_date_sent']			 =  string_date_day_enclosed($row['user_payroll_memo_date_sent']);
				$list				   						.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	public function get_summary($id,$option_id)
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						*,
						COUNT(user_payroll_memo_id) AS memo_count,
						(SELECT user_payroll_memo_date_sent FROM user_payroll_memo WHERE user_id = {$id} AND option_payroll_memo_id = '{$option_id}'ORDER BY user_payroll_memo_date_sent DESC LIMIT 1) as latest_memo
					
					FROM 
					
					user_payroll_memo
					
					
					WHERE 
					
					user_id = {$id}
					
					AND
					
					option_payroll_memo_id = '{$option_id}'
					
					ORDER BY user_payroll_memo_timestamp DESC
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	

	
# Modify

	public function insert($post)
	{
		$data														=	sql_parse_input('user_payroll_memo', $post);
		$data['user_payroll_memo_timestamp']						=   time();
		$sql														=	sql_insert($this->table_name, $data, 'user_payroll_memo_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('user_payroll_memo', $post);					
									sql_update($this->table_name, 'user_payroll_memo_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	

	
	public function delete_entry($id)
	{
		sql_delete('user_payroll_memo', 'user_id', $id);
	}
	
	 
	 
	
}
  