<?php
class model_user_payroll_backpay
{	
	
	public function __construct()
	{
		$this->table_name		=	'user_payroll_backpay';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select_by_cutoff_id_user($c_id,$id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_backpay
					
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
	
	
	public function select_all_by_fiscal_id_user($sp_id,$id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_backpay
					
					INNER JOIN payroll_backpay ON payroll_backpay.payroll_backpay_id = user_payroll_backpay.payroll_backpay_id
					
					
					WHERE 
					
					user_payroll_backpay.user_id = {$id}
					
					AND
					
					user_payroll_backpay.sysglobal_payroll_id = {$sp_id}
					
					
					";							
		$rows				=	sql_select($query);	
		$template_row		=	'payroll/template/row.backpay';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.empty_backpay';
		$template_row_empty	=	view_get_template($template_row_empty); 
		//hash_dump($query,1);
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['user_payroll_backpay_release_date']    	=  string_date_day($row['user_payroll_backpay_release_date']);
                $row['user_payroll_backpay_date_approved']    	=  string_date_day($row['user_payroll_backpay_date_approved']);
                $row['user_payroll_backpay_amount']    			=  string_amount($row['user_payroll_backpay_amount']);
                $row['user_payroll_backpay_amount_tax']    		=  string_amount($row['user_payroll_backpay_amount_tax']);
				$list				   						   .=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
# Modify

	public function insert($post)
	{
		$data														=	sql_parse_input('user_payroll_backpay', $post);	
		$sql														=	sql_insert('user_payroll_backpay', $data, 'user_payroll_backpay_id');			
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id) 
	{
		$data					=	sql_parse_input('user_payroll_backpay', $post);					
									sql_update($this->table_name, 'user_payroll_backpay_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete_entry($id)
	{
		sql_delete('user_payroll_backpay', 'user_payroll_backpay_id', $id);
	}
	
	
	  
	
}
 