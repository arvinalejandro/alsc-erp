<?php
class email 
{	
	//Public Function
	/*
	$to							=	Mail Recepient
	$email['subject']			=	Mail Subject
	$email['from']				=	Message Sender
	$email['name_first']		=	First Name
	$email['name_last']			=	Last Name
	$email['content']			=	Content (Html)
	
	*/
	function send_mail($to, $data) {
		$sHeaders 					= 	$this->fHeaders($data);	
		switch(EMAIL_MODE)
		{			
			case 'live' :
			{
				mail($to, $data['subject'], $data['content'], $sHeaders);				
				break;
			}
						
			case 'dump' :
			{
				echo $to;
				hash_dump($data);				
				break;
				die();
			}		
			default :
			{
				# do nothing
			}		
		}				
	}
	
	//Private Function
	function fHeaders($aArray) {		
		$headers 	.= "From: {$aArray['name_first']} {$aArray['name_last']}<{$aArray['from']}>\n";		
		$headers 	.= "MIME-Version: 1.0\n";
		$headers 	.= "Content-Type: text/html; charset=iso-8859-1\n";
				
		return $headers;
	}		
}

