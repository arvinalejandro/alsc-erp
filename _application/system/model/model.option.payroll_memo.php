<?php
class model_option_payroll_memo
{	
	
	public function __construct()
	{
		$this->table_name		=	'option_payroll_memo';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					option_payroll_memo
					
					
					
					WHERE option_payroll_memo_id = '{$id}'
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	public function select_all()
	{		
		$query			=	"SELECT 
						
						* 		
					
					FROM 
					
					option_payroll_memo
					
					
					";							
		$rows	=	sql_select($query);	
		return $rows;
	}
	
	
	
	
# Modify

	public function insert($post)
	{
		$data														=	sql_parse_input('option_payroll_memo', $post);
		$sql														=	sql_insert($this->table_name, $data,'option_payroll_memo_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	
	
	public function delete_entry($id)
	{
		sql_delete('option_payroll_memo', 'option_payroll_memo_id', $id);
	}
	
	
	
	
	 
	
}
 