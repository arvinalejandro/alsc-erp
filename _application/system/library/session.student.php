<?php
class session_student
{

	public function __construct()
	{
		$this->key		=	'student';		
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
			$username	=	string_clean_text($_SESSION[$this->key]['email_address']);
    		$password	=	string_clean_text($_SESSION[$this->key]['student_password']);
    		$data		=	sql_select("select * from student where email_address = '{$username}' AND student_password = '{$password}'");
    		
			if($data[0]['email_address'] == $_SESSION[$this->key]['email_address'] && $data[0]['student_password'] == $_SESSION[$this->key]['student_password'])
    		{
    			if(trim($data[0]['assessment_fee']))
				{
					$status		=	true;
					$message	=	'Passed';
					$data		=	$data[0];
					$this->set($data);		
				}
				else
				{
					$valid		=	false;
					$message	=	'Your account is inactive due to Assessment fee compliance issue.';	
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
