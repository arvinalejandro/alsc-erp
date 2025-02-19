<?php
class model_user_salary_deduction
{	
	
	public function __construct()
	{
		$this->table_name		=	'user_salary_deduction';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select
 

	public function select_by_cutoff_id_user($c_id,$id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_salary_deduction
					
						
					WHERE 
					
					user_id = {$id}
					
					AND
					
					user_salary_deduction.payroll_cutoff_id = {$c_id}
					";							
		$rows	=	sql_select($query);	
		return $rows;
	}

	
	public function select_by_user($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_salary_deduction
					
						
					WHERE 
					
					user_id = {$id}
					
				
					";							
		$rows	=	sql_select($query);	
		return $rows;
	}
	
	
	
	
	
# Modify

	public function insert($post)
	{
		$data														=	sql_parse_input('user_salary_deduction', $post);	
		$sql														=	sql_insert('user_salary_deduction', $data, 'user_salary_deduction_id');			
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id) 
	{
		$data					=	sql_parse_input('user_salary_deduction', $post);					
									sql_update($this->table_name, 'user_salary_deduction_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete_entry($id)
	{
		sql_delete('user_salary_deduction', 'user_salary_deduction_id', $id);
	}
	
	
	  
	
}
 