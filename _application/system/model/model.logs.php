<?php
class model_logs 
{
	var $database	=	'logs';
	
	public function insert($post)
	{
		$columns 						=		sql_get_column($this->database);
		$data							=		sql_parse_input($post, $columns);		
		$data['logs_timestamp']			=		time();	
		sql_insert($this->database, $data);
	}		
	
	public function insert_log($user_id, $user_id, $description)
	{
		$data['logs_description']	=	$description;
		$data['user_id']			=	$user_id;
		$data['user_id']			=	$user_id;
		$this->insert($data);
	}
	
	public function select($id)
	{
		$id		=		string_clean_number($id);
		$rows							=	sql_select("		
															select * from user 																
															WHERE
																user_id	=	{$id}		
													 ");
		return $rows[0];											 
	}	
	
	
	
	public function delete($post)
	{
		if(count($post))
		{
			sql_delete($this->database, 'logs_id', $post);
		}
	}
	  
	public function get_list($template, $template_empty = '', $id = NULL)
	{
		$id								=	$id * 1;
		
		$filter							=	($id) ? "WHERE logs.user_id = {$id}" : '';
		
		$rows							=	sql_select("		
															select * 
																from logs														
															left join user on
																user.user_id =  logs.user_id	
															left join user on
																logs.user_id = user.user_id															
															
															{$filter}
															
															order by
																logs.logs_timestamp DESC															
													 ");		
		$format['logs_timestamp']		=	'string_date_time';
		
		if(count($rows))
		{
			$list	=	view_templatize($template, $rows, $format);
		}
		else
		{
			$list	=	$template_empty;
		}
		return $list;
	}	
	
}
?>
