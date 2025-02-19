<?php
class model_notification
{
	var $database	=	'notification';
	
	/*public function insert($post)
	{
		$columns 						=		sql_get_column($this->database);
		$data							=		sql_parse_input($post, $columns);		
		$data['notification_timestamp']	=		time();	
		sql_insert($this->database, $data);
	}*/		
	
	public function insert_notification($user_id, $user_id, $description, $notification_status)
	{
		$data['notification_description']	=	$description;
		$data['user_id']			        =	$user_id;
        $data['user_id']                 =   $user_id;
		$data['notification_status']	    =	$notification_status;
		$data['notification_timestamp']    =        time();    
        sql_insert($this->database, $data);
	}
	
	
	/*public function delete($post)
	{
		if(count($post))
		{
			sql_delete($this->database, 'logs_id', $post);
		}
	}*/
	
	public function get_list_read($template, $template_empty = '', $id = NULL)
	{
		$id								=	$id * 1;
		
		$filter							=	($id) ? "WHERE notification.user_id = {$id}" : '';
		
		$rows							=	sql_select("		
															
                                                            select *,
                                                            ns.notification_status_name as notification_status
                                                            from notification 
                                                            left join user on user.user_id =  notification.user_id 
                                                            left join user on notification.user_id = user.user_id                                                            
                                                            left join notification_status ns on ns.notification_status_id = notification.notification_status
                                                           
															{$filter}
															and notification_status = 1
															order by
																notification.notification_timestamp DESC															
													 ");		
		$format['notification_timestamp']		=	'string_date_time';
		
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
    
    public function get_list_unread($template, $template_empty = '', $id = NULL)
    {
        $id                                =    $id * 1;
        
        $filter                            =    ($id) ? "WHERE notification.user_id = {$id}" : '';
        
        $rows                            =    sql_select("        
                                                            
                                                            select *,
                                                            ns.notification_status_name as notification_status
                                                            from notification 
                                                            left join user on user.user_id =  notification.user_id 
                                                            left join user on notification.user_id = user.user_id                                                            
                                                            left join notification_status ns on ns.notification_status_id = notification.notification_status
                                                           
                                                            {$filter}
                                                            and notification_status = 2
                                                            order by
                                                                notification.notification_timestamp DESC                                                            
                                                     ");        
        $format['notification_timestamp']        =    'string_date_time';
        
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
	
    public function count_unread($id = NULL)
    {
        $id       =    $id * 1;
        $filter   =    ($id) ? "WHERE notification.user_id = {$id}" : '';
        $rows     =    sql_select("select count(*) as count_unread_notification from notification
                       {$filter}
                       and notification_status = 2
                       ");
                       
        return $rows[0];    
    }
    
    public function delete($post)
    {
        if(count($post))
        {
            sql_delete($this->database, 'notification_id', $post);
        }
    }
}

