<?php
class model_message_group
{    
    
    public function __construct()
    {
        $this->table_name        =    'message_group';
        $this->message_insert    =    'A new entry has been successfully added.';
    }
    
# Data Select   
	 public function select($id, $filter='')
    {        
        $query     =    "
                           select * from message_group
                           
                           WHERE message_group_id = {$id}
                           
                           {$filter}
                           
                           
                        ";        
                                
        $rows                =    sql_select($query);        
        return $rows[0];
    }
    
     public function select_all_user_by_group_id($id,$filter='')
    {        
        $query     =    "
                           select 
                           
                           * ,(SELECT GROUP_CONCAT(DISTINCT concat(user_name,' ', user_surname) SEPARATOR  ', ') FROM user 
                           
                           		WHERE user_id IN(SELECT user_id FROM message_group_user WHERE 
                           							 message_group_id = {$id}
                           						)	
                              ) as con_label
                           
                           from message_group
                           
                           WHERE 
                           
                           message_group_id = {$id}
                           
                           {$filter}
                           
                           ORDER BY message_group_timestamp_latest DESC
                        ";        
                                
        $rows                =    sql_select($query);        
        return $rows[0];
    }

    public function select_all($filter='')
    {        
        $query     =    "
                           select * from message_group
                           
                           {$filter}
                           
                           ORDER BY message_group_timestamp ASC
                        ";        
                                
        $rows                =    sql_select($query);        
        return $rows;
    }
    
    
    public function select_all_group_user($user_id,$filter='')
    {        
        $query     =    "
                           select 
                           
                           * ,(SELECT GROUP_CONCAT(DISTINCT concat(user_name,' ', user_surname) SEPARATOR  ', ') FROM user 
                           
                           		WHERE user_id IN(SELECT user_id FROM message_group_user WHERE user_id  != {$user_id}
                           							AND message_group_id = message_group.message_group_id
                           						)	
                              ) as con_label
                           
                           from message_group
                           
                           WHERE 
                           
                           message_group_id IN(
                           				SELECT message_group_id FROM message_group_user WHERE user_id = {$user_id}
                           )
                           
                           
                           {$filter}
                           
                           ORDER BY message_group_timestamp_latest DESC
                        ";        
                                
        $rows                =    sql_select($query);        
        return $rows;
    }
    
    
    
    
# Modify

	public function insert($id,$name = null)
	{
		$data['user_id']						=   $id;								
		$data['message_group_timestamp_latest']	=	time();			
		$data['message_group_timestamp']		=	time();			
		$data['message_group_name']				=	$name;			
		$sql									=	sql_insert($this->table_name, $data, 'message_group_id');				
		$return['result']						=	$sql['result'];
		$return['data']							=	$sql['data'];
		$return['message']						=	$sql['message'];		
		return $return;
	}
	
	public function new_message_update($id)
	{
		$data['message_group_timestamp_latest']	=	time();				
		sql_update($this->table_name, 'message_group_id', $id, $data);	
		$return['result']						=	true;
		$return['data']							=	'';
		$return['message']						=	$this->message_update;
		
	}
    
            
}
