<?php
class login
{
    
    public function __construct()
    {
       
    }
    
    public function index()
    {		
		session_kill(false);
		mvc_view('login');
    }
    
    public function enter()
    {	
		$result		=	mvc_model('model.user')->login($_POST['username'], $_POST['password']);	
		
		if($result['result'])
		{
			$_SESSION['alsc']['active'] 	= true;
			$_SESSION['alsc']['user'] 		= $result['data'];
			
			header_location('/user');
		}
		else
		{
			session_kill();
		}	
	
	}
	
	function logout()
	{
		session_kill();
	}
    
} 