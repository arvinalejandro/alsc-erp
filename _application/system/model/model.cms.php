<?php
class model_cms
{
	var $database	=	'cms_user';
   
	/*public function insert($post)
	{
		$columns 						=		sql_get_column($this->database);
		$data							=		sql_parse_input($post, $columns);		
		$data['cms_user_timestamp']		=		time();	
		sql_insert($this->database, $data);
	}*/	
	
	
	public function select_cms_user($data)
    {
        $username    =    string_clean_text($data['cms_user_name']);
        $password    =    string_clean_text($data['cms_user_password']);
        $rows        =    sql_select("select * from cms_user where cms_user_name = '{$username}' AND cms_user_password = '{$password}' ");
                                                         
        return $rows[0];                                             
    }
	
	/*public function select($id)
	{
		$id		=		string_clean_number($id);
		$rows							=	sql_select("		
															select * from user 	
															
																left join user_type on user_type.user_type_id = user.user_type_id
																														
															WHERE
																user_id	=	{$id}		
													 ");
		return $rows[0];											 
	}*/
	
      
	public function update($post)
	{
		
        $columns 				=		sql_get_column($this->database);
		$data					=		sql_parse_input($post, $columns);		
        #hash_dump($data);
		$id						=		$post['cms_user_id'];unset($data['cms_user_id']);
		$data = sql_update($this->database, 'cms_user_id', $id, $data); 
        return $data;
	}
    
	 
	/*public function delete($post)
	{
		if(count($post))
		{
			sql_delete($this->database, 'cms_user_id', $post);
		}
	}*/
	
	/*public function get_list($template, $template_empty = '')
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
	}*/	
	
}
?>
