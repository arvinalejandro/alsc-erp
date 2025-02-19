<?php
class model_account_payable_ticket
{	
	
	public function __construct()
	{
		$this->table_name		=	'account_payable_ticket';
		$this->message_insert	=	'A new Ticket has been successfully added.';
	}
	
# Data Select

# Modify

	public function insert($post)
	{
		
		$data												 =	sql_parse_input('account_payable_ticket', $post);                
		$data['account_payable_ticket_timestamp']            =  time(); 
		$sql												 =	sql_insert($this->table_name, $data);		
		$return['result']									 =	true;
		$return['data']										 =	$sql;
		$return['message']									 =	$this->message_insert;	
		
		return	$return;
	}
    		
}
