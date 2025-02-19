<?php
class model_sysglobal_wes
{
	var $database	=	'sysglobal_wes';
   
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
        $rows       	=   sql_select("select * from sysglobal_wes where sysglobal_wes_id = '{$id}' ");                                                         
        return $rows[0];                                             
    }
	
	
	
     
	public function update($post,$id = 'global')
	{
		$id						=		string_clean($id);       
		$data					=		sql_parse_input('sysglobal_wes', $post);       
										sql_update($this->database, 'sysglobal_wes_id', $id, $data);
        return $data;
	}
	
	public function update_textarea($post,$id = 'global')
	{
										sql_update($this->database, 'sysglobal_wes_id', $id, $post);
        return $data;
	}
    
	  
	
	
}

