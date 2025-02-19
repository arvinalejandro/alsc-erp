<?php
class model_user_payroll_cutoff_deduction
{	
	
	public function __construct()
	{
		$this->table_name		=	'user_payroll_cutoff_deduction';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select_by_cutoff_id_user($c_id,$id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_cutoff_deduction
					
					INNER JOIN payroll_backpay ON payroll_backpay.payroll_backpay_id = user_payroll_backpay.payroll_backpay_id
					
					INNER JOIN payroll_cutoff ON payroll_cutoff.payroll_cutoff_id = user_payroll_backpay.payroll_cutoff_id
					
						
					WHERE 
					
					user_id = {$id}
					
					AND
					
					user_payroll_backpay.payroll_cutoff_id = {$c_id}
					";							
		$rows	=	sql_select($query);	
		return $rows;
	}
	
	

	
	
# Modify

	public function insert($post)
	{
		$data														=	sql_parse_input('user_payroll_cutoff_deduction', $post);	
		$sql														=	sql_insert('user_payroll_cutoff_deduction', $data, 'user_payroll_cutoff_deduction_id');			
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id) 
	{
		$data					=	sql_parse_input('user_payroll_cutoff_deduction', $post);					
									sql_update($this->table_name, 'user_payroll_cutoff_deduction_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete_entry($id)
	{
		sql_delete('user_payroll_cutoff_deduction', 'user_payroll_cutoff_deduction_id', $id);
	}
	
	
	  
	
}
 