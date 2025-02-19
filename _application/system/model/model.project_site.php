<?php
class model_project_site
{	
	
	public function __construct()
	{
		$this->table_name		=	'project_site';
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
	
	public function select_row($id) # project id
	{		
		$id		=	string_clean_number($id);	
			
		$query	=	"select 
						* 
					from project_site where project_id= '{$id}' order by project_site_name ASC";		
								
		$rows	=	sql_select($query);				
		return $rows;
	}
	
# Get Ouput
 
	public function get_row($id)
	{
		$id	=	$id * 1;
		# DB
		$query	=	"
					SELECT 
						*,
						(select count(project_site_block_id) from project_site_block where project_site_id = project_site.project_site_id) as project_site_block_count,
						(select count(lot_id) from lot where project_site_id = project_site.project_site_id) as lot_count,
						(select count(lot_id) from lot where project_site_id = project_site.project_site_id AND option_availability_id = 1) as count_available, 		
						(select count(lot_id) from lot where project_site_id = project_site.project_site_id AND option_availability_id = 2) as count_sold, 		
						(select count(lot_id) from lot where project_site_id = project_site.project_site_id AND option_availability_id = 3) as count_reserved, 		
						(select count(lot_id) from lot where project_site_id = project_site.project_site_id AND option_availability_id = 4) as count_hold, 		
						(select count(lot_id) from lot where project_site_id = project_site.project_site_id AND option_availability_id = 5) as count_earnest 		
					FROM project_site 
						inner join project ON project.project_id = project_site.project_id						
					
					where 
					
						project_site.project_id = '{$id}'
					
					ORDER BY project.project_name ASC, project_site.project_site_name ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_inventory/template/row.project.site';
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
	
	public function get_row_edit($id)
	{
		$id	=	$id * 1;
		# DB
		$query	=	"
					SELECT 
						*,
						(select count(project_site_block_id) from project_site_block where project_site_id = project_site.project_site_id) as project_site_block_count,
						(select count(lot_id) from lot where project_site_id = project_site.project_site_id) as lot_count,
						(select count(lot_id) from lot where project_site_id = project_site.project_site_id AND option_availability_id = 1) as lot_available_count 		
					FROM project_site 
						inner join project ON project.project_id = project_site.project_id						
					
					where 
					
						project_site.project_id = '{$id}'
					
					ORDER BY project_site.project_site_name DESC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_inventory/template/row.form.project.site';
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
		$data							=	sql_parse_input('project_site', $post);
		$data['project_site_timestamp']	=	time();			
		$sql							=	sql_insert($this->table_name, $data, 'project_site_id', array('project_site_name', 'project_id'));				
		$return['result']				=	$sql['result'];
		$return['data']					=	$sql['data'];
		$return['message']				=	$sql['message'];		
		return $return;
	} 
	
	public function update_code($post)
	{
		if(count($post))
		{
			foreach($post as $site_id => $site_code)
			{
				$site_id					=	trim($site_id) * 1;
				$data['project_site_code']	=	trim($site_code) * 1;
				sql_update('project_site', 'project_site_id', $site_id, $data);
			}
		}
				
	}
	 
	public function delete($id)
	{		
		$id	=	string_clean_number($id);
		$data['user_deleted']	=	1;
		sql_update($this->table_name, 'user_id', $id, $data);
	}
	 
	
}
