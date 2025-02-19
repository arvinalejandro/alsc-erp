<?php
class model_messaging 
{
	var $database	=	'messaging';
    
    public function get_list($template, $template_empty = '', $user_id = false)
    {
        $user_id                        =    $user_id * 1;
        $filter                         =    ($user_id) ? "AND b.messaging_staff_id = {$user_id} " : '';
        
        $raw                            =   sql_select("select b.messaging_id,
                                                            concat(a.first_name, ' ', a.last_name) as user_name, 
                                                            b.messaging_subject, 
                                                            b.messaging_text,
                                                            b.messaging_timestamp
                                                         
                                                        from user a, messaging b
                                                    
                                                        WHERE 
                                                            a.user_id = b.messaging_user_id
                                                        
                                                        {$filter}
                                                       
                                                        ORDER BY messaging_timestamp desc
                                                       
                                                        ");
        
        
        foreach($raw as $row)
        {
            $row['messaging_text'] = substr($row['messaging_text'],0,50) . "...";
            $rows[]    =    $row;
        }
        
        $format['messaging_timestamp']              =    'string_date_time';
        $include['messaging_id']['crc']            =    'string_crc';
         
    
         
        if(count($rows))
        {
            $list    =    view_templatize($template, $rows, $format, $include);
            #hash_dump ($list,true);
        }
        else
        {
            $list    =    $template_empty;
        }
        
        
        return $list;                                                
                                                        
        
                       
    }
    
    
    public function insert_batch_message($user_ids, $subject, $message, $staff_id = false)
    {   

        $user_ids    =   explode(',', $user_ids);
        $subject        =   string_clean_text($subject);
        $message        =   nl2br(string_clean_text($message));
        $staff_id       =   string_clean_number($staff_id);
        $timestamp      =   time();
        $message_status =   2;
           
        foreach($user_ids as $user_id)
        {
            $user_id =   string_clean_number($user_id);
            sql_query
            ("
                INSERT into messaging (messaging_staff_id, messaging_user_id, messaging_subject, messaging_text, messaging_timestamp, messaging_status)
                    select {$staff_id}, {$user_id}, '{$subject}', '{$message}', {$timestamp}, '{$message_status}'  from dual
            ");
        }
    }
    
    public function get_view($id)
    {
        $id              =        string_clean_number($id);
        $rows            =        sql_select("select b.messaging_id,
                                                            concat(a.first_name, ' ', a.last_name) as user_name, 
                                                            b.messaging_subject, 
                                                            b.messaging_text,
                                                            b.messaging_timestamp
                                                         
                                                        from user a, messaging b
                                                    
                                                        WHERE 
                                                            a.user_id = b.messaging_user_id
                                                        
                                                        and b.messaging_id = {$id}
                                                        ");
        #hash_dump($rows,true);
        
        return $rows[0];                 
    }
    
    
    public function get_list_for_user($template, $template_empty = '', $user_id = false)
    {  
        
        $user_id                     =    $user_id * 1;
        $filter                         =    ($user_id) ? "AND b.messaging_user_id = {$user_id} " : '';
        
        $raw                            =   sql_select("select b.messaging_id,
                                                            concat(a.user_name, ' ', a.user_surname) as user_name, 
                                                            b.messaging_subject, 
                                                            b.messaging_text,
                                                            b.messaging_timestamp
                                                         
                                                        from user a, messaging b
                                                    
                                                        WHERE 
                                                            a.user_id = b.messaging_staff_id
                                                        
                                                        {$filter}
                                                       
                                                        ORDER BY messaging_timestamp desc
                                                       
                                                        ");
        
        foreach($raw as $row)
        {
            $row['messaging_text'] = substr($row['messaging_text'],0,50) . "...";
            $rows[]    =    $row;
        }
        
        $format['messaging_timestamp']             =    'string_date_time';
        $include['messaging_id']['crc']            =    'string_crc';
         
        if(count($rows))
        {
            $list    =    view_templatize($template, $rows, $format, $include);
        }
        else
        {
            $list    =    $template_empty;
        }
        
        
        return $list;                                                
                                                        
        
                       
    }
    
    public function get_view_for_portal($id)
    {
        $id              =        string_clean_number($id);
        $rows            =        sql_select("select b.messaging_id,
                                                            concat(a.user_name, ' ', a.user_surname) as user_name, 
                                                            b.messaging_subject, 
                                                            b.messaging_text,
                                                            b.messaging_timestamp
                                                         
                                                        from user a, messaging b
                                                    
                                                        WHERE 
                                                            a.user_id = b.messaging_staff_id
                                                        
                                                        and b.messaging_id = {$id}
                                                        ");
        #hash_dump($rows,true);
        
        return $rows[0];                 
    }
    
    
	
	public function insert($post)
	{
		$columns 						=		sql_get_column($this->database);
		$data							=		sql_parse_input($post, $columns);		
		$data['task_timestamp']			=		time();	
		sql_insert($this->database, $data);
	}	
	
	public function insert_comment($post)
	{
		$columns 								=		sql_get_column('task_comment');
		$data									=		sql_parse_input($post, $columns);		
		$task['task_timestamp'] 				= 		time();
		$task['task_id']						=		$data['task_id'];
		
		$this->update($task);
		$data['task_comment_timestamp']			=		time();	
		sql_insert('task_comment', $data);
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
		$columns 						=		sql_get_column($this->database);
		$data							=		sql_parse_input($post, $columns);		
		$id								=		$data['task_id'];unset($data['task_id']);
		$data['task_timestamp']			=		time();	
		sql_update($this->database, 'task_id', $id, $data);
	}
	
	public function delete($post)
	{
		if(count($post))
		{
			sql_delete($this->database, 'messaging_id', $post);
		}
	}
	
	
	public function get_list_comment($template, $template_empty = '', $task_id)
	{
		$id		=	$task_id * 1;
		$rows							=	sql_select("		
															select * 
																
																from task_comment
																																	
															left join user on
																task_comment.user_id = user.user_id			
															where
																task_comment.task_id = {$id}												
															order by 
																task_comment.task_comment_timestamp ASC														
													 ");		
		
		$format['task_comment_timestamp']		  	=	'string_date_time';		
		
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
	
	public function count_open($id)
	{
		$rows	=	sql_select("select count(*) as count from task where user_id_assign = {$id} and status_task_id != 1");
		return $rows[0]['count'];
	}
	
    public function count_unread($id = NULL)
    {
        $id       =    $id * 1;
        $filter   =    ($id) ? "WHERE messaging.messaging_user_id = {$id}" : '';
        $rows     =    sql_select("select count(*) as count_unread_message from messaging
                       {$filter}
                       and messaging_status = 2
                       ");
                       
        return $rows[0];    
    }
    
    public function get_list_read($template, $template_empty = '', $id = NULL)
    {
        $id                                =    $id * 1;
        
        $filter                            =    ($id) ? "WHERE messaging.messaging_user_id = {$id}" : '';
        
        $rows                            =    sql_select("        
                                                            
                                                            select *,
                                                            ns.notification_status_name as notification_status
                                                            from messaging 
                                                            left join user on user.user_id =  messaging.messaging_staff_id 
                                                            left join user on messaging.messaging_user_id = user.user_id
                                                            
                                                            left join notification_status ns on ns.notification_status_id = messaging.messaging_status
                                                           
                                                            {$filter}
                                                            and messaging_status = 1
                                                            order by
                                                                messaging.messaging_timestamp DESC                                                             
                                                     ");        
        $format['messaging_timestamp']        =    'string_date_time';
        
        if(count($rows))
        {
            $list    =    view_templatize($template, $rows, $format);
        }
        else
        {
            $list    =    $template_empty;
        }
        return $list;
    }    
    
    public function get_list_unread($template, $template_empty = '', $id = NULL)
    {
        $id                                =    $id * 1;
        
        $filter                            =    ($id) ? "WHERE messaging.messaging_user_id = {$id}" : '';
        
        $rows                            =    sql_select("        
                                                            
                                                            select *,
                                                            ns.notification_status_name as notification_status
                                                            from  messaging
                                                            left join user on user.user_id =  messaging.messaging_staff_id 
                                                            left join user on messaging.messaging_user_id = user.user_id                                                            
                                                            left join notification_status ns on ns.notification_status_id = messaging.messaging_status
                                                           
                                                            {$filter}
                                                            and messaging_status = 2
                                                            order by
                                                                messaging.messaging_timestamp DESC                                                            
                                                     ");        
        $format['messaging_timestamp']        =    'string_date_time';
        
        if(count($rows))
        {
            $list    =    view_templatize($template, $rows, $format);
        }
        else
        {
            $list    =    $template_empty;
        }
        return $list;
    }
}
?>
