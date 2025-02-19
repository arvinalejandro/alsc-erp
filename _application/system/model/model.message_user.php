<?php
class model_message_user
{    
    
    public function __construct()
    {
        $this->table_name        =    'message_user';
        $this->message_insert    =    'A new entry has been successfully added.';
    }
    
    
# Data Select   
    public function select_all($filter='')
    {        
        $query     =    "
                           select * from message_user 
                           
                           INNER JOIN user ON user.user_id = message_use.user_id
                           
                           {$filter}
                           
                           ORDER BY message_user_timestamp ASC
                        ";        
                                
        $rows                =    sql_select($query);        
        return $rows;
    }
    
    public function select_all_message_group($message_group_id,$filter='',$limit='')
    {        
        $query     =    "
                           select * from message_user 
                           
                           INNER JOIN user ON user.user_id = message_user.user_id
                           
                           WHERE message_group_id = {$message_group_id}
                           
                           
                           {$filter}
                           
                           ORDER BY message_user_timestamp DESC
                           
                             {$limit}
                        ";        
        $rows                =    sql_select($query);        
        return $rows;
    }
    
    
    public function count_unread($message_group_id,$last_view_timestamp,$filter='')
    {        
        $query     =    "
                           
                           select  COUNT(message_user_id) AS msg_count ,(SELECT message_user_content FROM message_user WHERE  message_group_id = {$message_group_id} ORDER BY message_user_timestamp DESC LIMIT 1) AS message
										,(SELECT message_user_timestamp FROM message_user WHERE message_group_id = {$message_group_id} ORDER BY message_user_timestamp DESC LIMIT 1) AS message_time	
							from message_user 

							WHERE message_user_timestamp > {$last_view_timestamp}  AND message_group_id = {$message_group_id}
							
							 {$filter}

							ORDER BY message_user_timestamp DESC
                        ";        
                                
        $rows                =    sql_select($query);        
        return $rows[0];
    }
    
    
# Modify

	public function insert($post)
	{
		$data							=	sql_parse_input('message_user', $post);
		$data['message_user_timestamp']	=	time();			
		$sql							=	sql_insert($this->table_name, $data, 'message_user_id');				
		$return['result']				=	$sql['result'];
		$return['data']					=	$sql['data'];
		$return['message']				=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('message_user', $post);					
									sql_update($this->table_name, 'message_user_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function update_read($message_group_id, $id)
	{
		$data['message_read']   =   1;									
		sql_update($this->table_name, 'message_group_id', $message_group_id, $data, 'AND user_id='.$id);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
    
            
}
