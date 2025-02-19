<?php
class model_option_wes_charge_project
{	
	
	public function __construct()
	{
		$this->table_name		=	'option_wes_charge_project';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select_all($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					option_wes_charge_project
					
					LEFT join project on project.project_id = option_wes_charge_project.project_id
					
					WHERE option_wes_charge_id = {$id}
					";							
		$rows	=	sql_select($query);	
		return $rows;
	}
	
	
	public function select_all_by_project($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					option_wes_charge_project
					
					INNER JOIN option_wes_charge ON option_wes_charge.option_wes_charge_id = option_wes_charge_project.option_wes_charge_id
					
					LEFT join project on project.project_id = option_wes_charge_project.project_id
					
					WHERE option_wes_charge_project.project_id IN(0,{$id})
					";							
		$rows	=	sql_select($query);	
		return $rows;
	}

	
	
# Modify

	public function insert($post)
	{
		$sql														=	sql_insert($this->table_name, $post, 'option_wes_charge_project_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	
	public function delete_entry($id)
	{
		sql_delete('option_wes_charge_project', 'option_wes_charge_id', $id);
	}
	
	
	
}
 