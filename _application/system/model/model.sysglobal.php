<?php
class model_sysglobal
{
	var $database	=	'sysglobal';
   
	/*public function insert($post)
	{
		$columns 						=		sql_get_column($this->database);
		$data							=		sql_parse_input($post, $columns);		
		$data['cms_user_timestamp']		=		time();	
		sql_insert($this->database, $data);
	}*/	
	
	
	public function select($id = 'global')
    {        
    	$id				=	string_clean($id);
        $rows       	=   sql_select("select * from sysglobal where sysglobal_id = '{$id}' ");                                                         
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
		$id						=		string_clean($post['id']);       
		$data					=		sql_parse_input('sysglobal', $post);       
										sql_update($this->database, 'sysglobal_id', $id, $data);
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

