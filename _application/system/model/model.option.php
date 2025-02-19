<?php
class model_option
{	
	
	public function __construct()
	{
		$this->table_name		=	'';
		$this->message_insert	=	'';
	}
	
# Data Select

	public function select_option($table, $sort = '')
	{			
		$query	=	"select * from {$table} {$sort}";
		$rows	=	sql_select($query);				
		return $rows;
	}
	    
} 