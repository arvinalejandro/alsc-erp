<?php
class model_payroll_schedule
{	
	
	public function __construct()
	{
		$this->table_name		=	'payroll_schedule';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					payroll_schedule
					
						
					
					WHERE 
					
					payroll_schedule_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	public function select_all($filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					payroll_schedule 
						
						
						
					{$filter}	
					
					ORDER BY 	payroll_schedule_id DESC		
					
					"; 
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.schedule';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
               
				$list				   .=	view_populate($row, $template_row);
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
		$data														=	sql_parse_input('payroll_schedule', $post);
		$sql														=	sql_insert($this->table_name, $data, 'payroll_schedule_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('payroll_schedule', $post);					
									sql_update($this->table_name, 'payroll_schedule_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete_entry($id)
	{
		sql_delete('payroll_schedule', 'payroll_schedule_id', $id);   
	}
	
	
	 
	
}
 