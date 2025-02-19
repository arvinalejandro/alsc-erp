<?php
class model_sales_commission_scheme_trigger
{	
	
	public function __construct()
	{
		$this->table_name		=	'sales_commission_scheme_trigger';
		$this->message_insert	=	'A new Entry has been successfully added.';
	}
	
# Data Select

	public function select($commission_version,$finance_type)
	{		
		$id		=	string_clean_number($id);
		$query	=	   "select 
						* 
						
						FROM
						
						sales_commission_scheme_trigger
						
						WHERE option_commission_version_id = '{$commission_version}'
						
						AND finance_type = '{$finance_type}'
						
						ORDER BY sales_commission_scheme_trigger_id ASC
						";		
								
		$rows	=	sql_select($query);		
		if(count($rows))
		{
			$row	=	$rows;
		}
		else
		{
			$row	=	null;
		}
				
		return $row;
	}
	
	
# Modify

	public function insert($post)
	{
		$sql							=	sql_insert($this->table_name, $post);		
		$return['result']				=	true;
		$return['data']					=	$sql;
		$return['message']				=	$this->message_insert;		
	}
    
}
