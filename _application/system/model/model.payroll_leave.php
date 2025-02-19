<?php
class model_payroll_leave
{	
	
	public function __construct()
	{
		$this->table_name		=	'payroll_leave';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id='leave',$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					payroll_leave
					
						
					
					WHERE 
					
					payroll_leave_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
  
	
	
# Modify
	
	public function update($post, $id='leave')
	{
		$data					=	sql_parse_input('payroll_leave', $post);			
									sql_update($this->table_name, 'payroll_leave_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	''; 
		$return['message']		=	$this->message_update; 
		 
	}
	
	
	 
	
}
 