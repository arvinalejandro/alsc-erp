<?php
class model_user 
{
	var $database	=	'user';
	
	public function insert($post)
	{
		$columns 						=		sql_get_column($this->database);
		$data							=		sql_parse_input($post, $columns);		
		$data['user_timestamp']		=		time();	
		sql_insert($this->database, $data);
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
	
	
	public function update($post)
	{
		$columns 				=		sql_get_column($this->database);
		$data					=		sql_parse_input($post, $columns);		
		$id						=		$post['user_id'];unset($data['user_id']);
		sql_update($this->database, 'user_id', $id, $data);
	}
	
	public function delete($post)
	{
		if(count($post))
		{
			sql_delete($this->database, 'user_id', $post);
		}
	}
	
	public function get_list($template, $template_empty = '')
	{
		$rows							=	sql_select("		
															select * 
																from user														
															left join user_type on
																user.user_type_id =  user_type.user_type_id	
															left join user_status on
																user.user_status_id = user_status.user_status_id															
															order by 
																user.user_surname, user.user_name ASC																
													 ");		
		$include['user_id']['crc']	=	'string_crc';
		
		if(count($rows))
		{
			$list	=	view_templatize($template, $rows, $format, $include);
		}
		else
		{
			$list	=	$template_empty;
		}
		return $list;
	}	
	
} 
?>
