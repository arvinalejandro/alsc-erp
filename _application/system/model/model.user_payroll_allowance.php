<?php
class model_user_payroll_allowance
{	
	
	public function __construct()
	{
		$this->table_name		=	'user_payroll_allowance';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_allowance
					
						
					
					WHERE 
					
					user_payroll_allowance_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	 
	public function select_all_by_user($id,$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_allowance 
					
					INNER JOIN payroll_allowance ON payroll_allowance.payroll_allowance_id = user_payroll_allowance.payroll_allowance_id
					
					WHERE user_id = {$id}	
						
						
					{$filter}	
					
					ORDER BY 	user_payroll_allowance_id DESC		
					
					";
		$rows	=	sql_select($query);
		return $rows;
	}
	

	
# Modify

	public function insert($post)
	{
		$sql														=	sql_insert($this->table_name, $post, 'user_payroll_allowance_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('user_payroll_allowance', $post);					
									sql_update($this->table_name, 'user_payroll_allowance_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	 
	public function delete_entry($id)
	{
		sql_delete('user_payroll_allowance', 'user_id', $id); 
	}
	
	
	 
	
}
 