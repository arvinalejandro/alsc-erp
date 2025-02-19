<?php
class model_accounting_pay
{	
	
	public function __construct()
	{
		$this->table_name		=	'accounting_pay';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		
		$query	=	"";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
	  
	
# Get Ouput

	
	
	
	
	
	 
	
}
