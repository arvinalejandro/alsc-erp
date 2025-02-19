<?php
class model_message_group_user
{    
    
    public function __construct()
    {
        $this->table_name        =    'message_group_user';
        $this->message_insert    =    'A new entry has been successfully added.';
    }
    
    
# Data Select   
    public function select_all($filter='')
    {        
        $query     =    "
                           select * from message_group_user 
                           
                           {$filter}
                           
                        ";        
                                
        $rows                =    sql_select($query);        
        return $rows;
    }
    
    public function select_by_user($user_id,$filter='')
    {        
        $query     =    "
                           select * from message_group_user WHERE user_id = {$user_id}
                           
                           {$filter}
                           
                        ";        
                                
        $rows                =    sql_select($query);        
        return $rows;
    }
    
    public function select_by_message_group($group_id,$filter='')
    {        
        $query     =    "
                           select * from message_group_user WHERE message_group_id = {$group_id}
                           
                           {$filter}
                           
                        ";        
                                
        $rows                =    sql_select($query);        
        return $rows;
    }
    
    public function select_row($user_id,$group_id,$filter='')
    {        
        $query     =    "
                           select * from message_group_user 
                           
                           WHERE user_id = {$user_id}
                           
                           AND message_group_id = {$group_id}
                           
                           {$filter}
                           
                        ";        
                                
        $rows                =    sql_select($query);        
        return $rows[0];
    }
    
    
    public function count_all_unread($group_id,$filter='')
    {        
        $query     =    "
                           select COUNT(*) as m_count from message_group_user 
                           
                           WHERE message_group_id = {$group_id}
                           
                           AND message_read = 0
                           
                           {$filter}
                           
                        ";        
                                
        $rows                =    sql_select($query);        
        return $rows[0]['m_count'];
    }
    
    
    
    
    
# Modify

	public function insert($user_id,$group_id,$read=0)
	{
		
		
		$data['user_id']						=	$user_id;
		$data['message_group_id']				=	$group_id;
		$data['message_read']					=	$read;
		$sql									=	sql_insert($this->table_name, $data, 'message_group_user_id');				
		$return['result']						=	$sql['result'];
		$return['data']							=	$sql['data'];
		$return['message']						=	$sql['message'];		
		return $return;
	}
	
	public function update_unread($message_group_id, $id)
	{
		$data['message_read']   =   0;									
		sql_update($this->table_name, 'message_group_id', $message_group_id, $data, 'AND user_id NOT IN('.$id.')');	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
	public function update_read($message_group_id, $id)
	{
		$data['message_read']   =   1;									
		$data['last_view_timestamp']   =   time();									
		sql_update($this->table_name, 'message_group_id', $message_group_id, $data, 'AND user_id='.$id);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}

    
            
}
