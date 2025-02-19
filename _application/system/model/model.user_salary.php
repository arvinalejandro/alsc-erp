<?php
class model_user_salary
{	
	
	public function __construct()
	{
		$this->table_name		=	'user_salary';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	public function select($id)
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_salary
					
						
					WHERE 
					
					user_salary_id = {$id}
					
				
					";							
		$rows	=	sql_select($query);	
		return $rows[0];
	}
	
	public function select_all_by_date($curr)
	{		
		$next	=   $curr+86400;
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_salary
					
						
					WHERE 
					
					user_salary_date_effect >= {$curr}
					
					AND
					
					user_salary_date_effect < {$next}
					
					ORDER BY user_salary_timestamp ASC
					
				
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
					
					user_salary
					
						
					WHERE 
					
					user_id = {$id}
					
				
					";							
		$rows	=	sql_select($query);	
		return $rows;
	}
	
	
	public function select_by_user_latest($id)
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_salary
					
						
					WHERE 
					
					user_id = {$id}
					
					ORDER BY user_salary_id DESC
					
					LIMIT 1
					
				
					";							
		$rows	=	sql_select($query);	
		return $rows[0];
	}
	
	
	
	
	
	
	
# Modify

	public function insert($post)
	{
		$data														=	sql_parse_input('user_salary', $post);	
		$sql														=	sql_insert('user_salary', $data);			
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id) 
	{
		$data					=	sql_parse_input('user_salary', $post);					
									sql_update($this->table_name, 'user_salary_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete_entry($id)
	{
		sql_delete('user_salary', 'user_salary_id', $id);
	}
	
	
	  
	
}
 