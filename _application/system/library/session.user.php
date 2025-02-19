<?php
class session_user
{

	public function __construct()
	{
		$this->key		=	'user';
		$this->profile	=	'profile';
	}
	
	public function set($data) 
	{
		$_SESSION[$this->key]	=	$data;		
	}
	
	public function get($property	=  '')
	{
		$data		=	($property) ?  $_SESSION[$this->key][$property] : $_SESSION[$this->key];
		return $data;
	}
	
	public function check()
	{
		if($_SESSION[$this->key])
		{
			$username	=	string_clean_text($_SESSION[$this->key]['user_email']);
    		$password	=	string_clean_text($_SESSION[$this->key]['user_password']);
    		$data		=	sql_select("select * from user inner join user_type on user_type.user_type_id = user.user_type_id where user_email = '{$username}' AND user_password = '{$password}' ");
			if($data[0]['user_email'] == $_SESSION[$this->key]['user_email'] && $data[0]['user_password'] == $_SESSION[$this->key]['user_password'] && $data[0]['user_access'] == $_SESSION[$this->key]['user_access'])
    		{
    			if($data[0]['user_status_id'] == 1)
				{
					$status		=	true;
					$message	=	'Passed';
					$data		=	$data[0];	
				}
				else
				{
					$valid		=	false;
					$message	=	'Your account is currently disabled';	
					$data		=	NULL;	
				}    			
			}
			else
			{
				$valid		=	false;
				$message	=	'Your login details has been modified. <br/>Please login with your new details';	
				$data		=	NULL;
			}
				
		}
		else
		{
			$valid		=	false;
			$message	=	'Session Expired. Please Login';
			$data		=	NULL;
		}
		
		$return['status']		=	$status;
		$return['message']		=	$message;
		$return['data']			=	$data;		
		return $return;		
	}

} 
