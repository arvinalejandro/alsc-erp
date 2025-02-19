<?php
class model_sales_commission_scheme
{	
	
	public function __construct()
	{
		$this->table_name		=	'sales_commission_scheme';
		$this->message_insert	=	'A new Entry has been successfully added.';
	}
	
# Data Select

# Data Select

	public function select($id)
	{		
		$id		=	string_clean_number($id);
		$query	=	"select 
						* 
						
						FROM
						
						sales_commission_scheme
						
						WHERE sales_commission_scheme_id = {$id}
						";		
								
		$rows	=	sql_select($query);		
		if(count($rows))
		{
			$row	=	$rows[0];
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