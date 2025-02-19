<?php
class model_project_site_block
{	
	
	public function __construct()
	{
		$this->table_name		=	'project_site_block';
		$this->message_insert	=	'A new lot has been successfully added.';
	}
	
# Data Select

	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		
		$query	=	"select 
						* 
					from project 					
						inner join option_project_status ON option_project_status.option_project_status_id = project.option_project_status_id 				
					where project.project_id = {$id}";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
	public function select_row()
	{		
		$id		=	string_clean_number($id);		
		$query	=	"select 
						* 
					from project 					
						inner join option_project_status ON option_project_status.option_project_status_id = project.option_project_status_id 				
					where project.project_id = {$id}";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
# Get Ouput

	public function get_row()
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM project 
						inner join option_project_status ON option_project_status.option_project_status_id = project.option_project_status_id						
					
					ORDER BY project.project_name ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_inventory/template/row.project';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'edp_inventory/template/row.project.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$list	.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	 
	public function get_project_block_row($id)
	{
		$id	=	$id * 1;
		# DB
		$query	=	"
					SELECT 
						*,						
						(select count(lot_id) from lot where project_site_block_id = project_site_block.project_site_block_id) as lot_count,
						(select count(lot_id) from lot where project_site_block_id = project_site_block.project_site_block_id AND option_availability_id = 1) as count_available, 		
						(select count(lot_id) from lot where project_site_block_id = project_site_block.project_site_block_id AND option_availability_id = 2) as count_sold, 		
						(select count(lot_id) from lot where project_site_block_id = project_site_block.project_site_block_id AND option_availability_id = 3) as count_reserved, 		
						(select count(lot_id) from lot where project_site_block_id = project_site_block.project_site_block_id AND option_availability_id = 4) as count_hold, 		
						(select count(lot_id) from lot where project_site_block_id = project_site_block.project_site_block_id AND option_availability_id = 5) as count_earnest 			
						
					FROM project_site_block 
					
						inner join project ON project.project_id = project_site_block.project_id						
						inner join project_site ON project_site.project_site_id = project_site_block.project_site_id						
					
					where 
					
						project_site_block.project_id = '{$id}'
					
					ORDER BY project.project_name ASC, project_site.project_site_name ASC, project_site_block.project_site_block_name 
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_inventory/template/row.project.block';
		$template_row		=	view_get_template($template_row);
		#$template_row_empty	=	'edp_inventory/template/row.project.empty';
		#$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$list	.=	view_populate($row, $template_row);
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
		$data							=	sql_parse_input('project_site_block', $post);
		$data['project_site_block_timestamp']		=	time();			
		$sql							=	sql_insert($this->table_name, $data, 'project_site_block_id', array('project_id', 'project_site_id', 'project_site_block_name'));				
		$return['result']				=	$sql['result'];
		$return['data']					=	$sql['data'];
		$return['message']				=	$sql['message'];		
		return $return;
	}
	
	
	   
	
} 
