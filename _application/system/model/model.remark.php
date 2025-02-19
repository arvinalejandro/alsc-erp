<?php
class model_remark
{	
	
	public function __construct()
	{
		$this->table_name		=	'remark';
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

	public function get_row($remark_key, $remark_key_value)
	{
		$remark_key 		= string_clean($remark_key);
		$remark_key_value 	= string_clean_number($remark_key_value);
		# DB
		$query	=	"
					SELECT 	*
						
					FROM remark 
						inner join {$remark_key} ON {$remark_key}.{$remark_key}_id = remark.remark_key_id						
						inner join user ON user.user_id = remark.user_id						
					
					WHERE remark.remark_key_id = '{$remark_key_value}' AND remark.remark_key =  '{$remark_key}'
					
					ORDER BY remark.remark_timestamp DESC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_inventory/template/row.remark';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'edp_inventory/template/row.remark.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$row['remark_timestamp']	=	string_date_time($row['remark_timestamp']);
				$list	.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	public function get_employee_row($remark_key, $remark_key_value)
	{
		$remark_key 		= string_clean($remark_key);
		$remark_key_value 	= string_clean_number($remark_key_value);
		# DB
		$query	=	"
					SELECT 	
					
					*, (SELECT user_name FROM {$remark_key} WHERE user_id = {$remark_key_value}) AS this_user
						
					FROM remark 

						inner join user ON user.user_id = remark.user_id						
					
					WHERE remark.remark_key_id = '{$remark_key_value}' AND remark.remark_key =  '{$remark_key}'
					
					ORDER BY remark.remark_timestamp DESC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_inventory/template/row.remark';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'edp_inventory/template/row.remark.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$row['remark_timestamp']	=	string_date_time($row['remark_timestamp']);
				$list	.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	
	public function get_indep_row($remark_key, $remark_key_value)
	{
		$remark_key 		= string_clean($remark_key);
		$remark_key_value 	= string_clean_number($remark_key_value);
		# DB
		$query	=	"
					SELECT 	*
						
					FROM remark 
						inner join user ON user.user_id = remark.user_id						
					
					WHERE remark.remark_key_id = '{$remark_key_value}' AND remark.remark_key =  '{$remark_key}'
					
					ORDER BY remark.remark_timestamp DESC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_inventory/template/row.remark';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'edp_inventory/template/row.remark.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$row['remark_timestamp']	=	string_date_time($row['remark_timestamp']);
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
		$data							=	sql_parse_input('remark', $post);		
		if($data['remark_content'])
		{
			$data['remark_timestamp']		=	time();			
			$sql							=	sql_insert($this->table_name, $data);	
			$return['result']				=	true;
			$return['data']					=	$sql;
			$return['message']				=	$this->message_insert;	
		}
			
	}
	
	public function insert_no_parse($post)
	{
			$data							=	$post;		
			$data['remark_timestamp']		=	time();			
			$sql							=	sql_insert($this->table_name, $data);	
			$return['result']				=	true;
			$return['data']					=	$sql;
			$return['message']				=	$this->message_insert;	
		
			
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('project', $post);					
									sql_update($this->table_name, 'project_id', $id, $data);		
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}  
	
	public function delete($id)
	{		
		$id	=	string_clean_number($id);
		$data['user_deleted']	=	1;
		sql_update($this->table_name, 'user_id', $id, $data);
	}
	 
	
}
