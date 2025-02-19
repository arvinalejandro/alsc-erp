<?php
class model_module
{	
	
	public function __construct()
	{
		$this->table_name		=	'module';
		$this->message_insert	=	'A new user has been successfully added.';
	}
	
# Data Select

	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		$query	=	"select * from module where module_id = '{$id}'";					
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
	# User Module
	public function select_avail_row($user_id)
	{
		# DB
		$user_id	=	string_clean_number($user_id);
		$query		=	"SELECT * FROM module where module_id NOT IN (select module_id from user_module where user_id = '{$user_id}')";
		$rows		=	sql_select($query);
		return $rows;
	}
	
# Get Ouput

	public function get_row()
	{
		# DB
		$query	=	"SELECT 
						*, 
						(select (count('user_id')) from user_module where module_id = module.module_id) AS user_count 
		
					FROM module					
					
					ORDER BY module.module_name ASC ";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_cms/template/row.module';
		$template_row		=	view_get_template($template_row);		
		# Parse		
		foreach($rows as $row)
		{			
			$list	.=	view_populate($row, $template_row);
		}	
		return $list;
	}
	 
	# User Module
	public function get_user_module($user_id, $controller_id = 'edp_cms')
	{
		# DB
		$user_id	=	string_clean_number($user_id);
		$query	=	"SELECT * FROM 
						user_module 
					INNER JOIN module on 
						module.module_id = user_module.module_id 
					where user_module.user_id = {$user_id} ORDER BY module.module_name ASC";
		$rows	=	sql_select($query);
		# Template
		$template_row			=	"{$controller_id}/template/row.user.module";		
		$template_row_empty		=	"{$controller_id}/template/row.user.module.empty";
		$template_row			=	view_get_template($template_row);
		$template_row_empty		=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			# Parse		
			foreach($rows as $row)
			{								
				$row['user_module_timestamp']	=	string_date_time($row['user_module_timestamp']);				
				$list	.=	view_populate($row, $template_row);
			}	
		}
		else
		{
			$list =  $template_row_empty;
		}	
		return $list;
	}
	
	# User Module
	public function get_module_user($module_id)
	{
		# DB
		$module_id	=	string_clean_number($module_id);
		$query	=	"SELECT * FROM 
						user_module 
					INNER JOIN module on 
						module.module_id = user_module.module_id
					INNER JOIN user on
						user.user_id = user_module.user_id
					where user_module.module_id = {$module_id} ORDER BY user.user_surname ASC";
		$rows	=	sql_select($query);	
		# Template
		$template_row			=	'edp_cms/template/row.module.user';		
		$template_row_empty		=	'edp_cms/template/row.module.user.empty';
		$template_row			=	view_get_template($template_row);
		$template_row_empty		=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			# Parse		
			foreach($rows as $row)
			{								
				$row['user_module_timestamp']	=	string_date_time($row['user_module_timestamp']);				
				$list	.=	view_populate($row, $template_row);
			}	
		}
		else
		{
			$list = $template_row_empty;
		}	
		return $list;
	}
	
	
	
# Modify

	public function insert_user_module($post)
	{		
		$data['user_module_timestamp']	=	time();			
		$data['user_id']				=	string_clean_number($post['user_id']);			
		$data['module_id']				=	string_clean_number($post['module_id']);	
		sql_insert('user_module', $data);			
	}
	
	public function delete_user_module($id)
	{		
		$data[]							=	string_clean_number($id);
		sql_delete('user_module', 'user_module_id', $data);	
	}  
	
}
 