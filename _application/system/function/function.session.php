<?php

	function session_check()
	{
		if($_SESSION['alsc']['active'])
		{
			if(count($_SESSION['alsc']['user']))
			{
				return $_SESSION['alsc']['user'];
			}
			else
			{
				session_destroy();
				header_location('/login');
			}			 	
		}	
		else
		{
			session_kill();
		}	
	}  
	
	function session_kill($redirect = true)
	{
		session_destroy();
		if($redirect)
		{
			header_location('/login');	
		}
		
	}