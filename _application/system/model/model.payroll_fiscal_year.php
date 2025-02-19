<?php
class model_payroll_fiscal_year
{	
	
	public function __construct()
	{
		$this->table_name		=	'payroll_fiscal_year';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id='fiscal_year',$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					payroll_fiscal_year
					
						
					
					WHERE 
					
					payroll_fiscal_year_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	  

	
	
# Modify
	
	public function update($post, $id='fiscal_year')
	{
		$data					=	sql_parse_input('payroll_fiscal_year', $post);			
									sql_update($this->table_name, 'payroll_fiscal_year_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update; 
		
	}
	
	
	 
	
}
 