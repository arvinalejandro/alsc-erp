<?php
class session_message 
{

	public function message($header = '', $message = '') 
	{
		if($message) 
		{
			$_SESSION['imessage']			=	$message;
			$_SESSION['imessage_header']	=	$header;
		}
		else 
		{
			$data['imessage']			=	$_SESSION['imessage'];
			$data['imessage_header']	=	$_SESSION['imessage_header'];
			if($data) 
			{
				unset($_SESSION['imessage']);				
				unset($_SESSION['imessage_header']);				
				return $data;
			}
				
		}
		
	}
	

}
