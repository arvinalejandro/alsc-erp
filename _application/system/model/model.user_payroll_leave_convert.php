<?php
class model_user_payroll_leave_convert
{	
	
	public function __construct()
	{
		$this->table_name		=	'user_payroll_leave_convert';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select_by_cutoff_id_user($c_id,$id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_leave_convert
					
						
					
					WHERE 
					
					user_id = {$id}
					
					AND
					
					payroll_cutoff_id = {$c_id}
					";							
		$rows	=	sql_select($query);	
		return $rows;
	}
	
	
	public function select_by_fiscal_id_user($sp_id,$id,$type,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM  
					
					user_payroll_leave_convert
					
						
					
					WHERE 
					
					user_id = {$id}
					
					AND
					
					sysglobal_payroll_id = {$sp_id}
					
					AND 
					
					user_payroll_leave_type_id = '{$type}'
					
					";							
		$rows	=	sql_select($query);	
		//echo $query;
		return $rows[0];
	}
	
	
# Modify

	public function insert($post)
	{
		$sql														=	sql_insert($this->table_name, $post, 'user_payroll_leave_convert_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id) 
	{
		$data					=	sql_parse_input('user_payroll_leave_convert', $post);					
									sql_update($this->table_name, 'user_payroll_leave_convert_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete_entry($id)
	{
		sql_delete('user_payroll_leave_convert', 'user_payroll_leave_convert_id', $id);
	}
	
	
	  
	
}
 