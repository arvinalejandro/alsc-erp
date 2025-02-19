<?php
class model_user_payroll_loan
{	
	
	public function __construct()
	{
		$this->table_name		=	'user_payroll_loan';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_loan
					
						
					
					WHERE 
					
					user_payroll_loan_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	public function select_user_active($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_loan
					
						
					
					WHERE 
					
					user_id = {$id}
					
					AND
					
					user_payroll_loan_status = 'active'
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows; 
		return $list;
	}
	
	public function select_all($id,$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_loan 
					
					WHERE user_id = {$id}
					
						
					{$filter}	
					
					ORDER BY 	user_payroll_loan_id DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.payroll_loan';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.empty_loan';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
               
				$row['user_payroll_loan_date_approved']		=  string_date($row['user_payroll_loan_date_approved']);
				$row['user_payroll_loan_paid']				=  string_amount($row['user_payroll_loan_paid']);
				$row['user_payroll_loan_amount']			=  string_amount($row['user_payroll_loan_amount']);
				$list				   						.=	view_populate($row, $template_row);
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
		$data														=	sql_parse_input('user_payroll_loan', $post);
		$data['user_payroll_loan_timestamp']						=   time();
		$sql														=	sql_insert($this->table_name, $data, 'user_payroll_loan_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('user_payroll_loan', $post);					
									sql_update($this->table_name, 'user_payroll_loan_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function deactivate_by_user($id)
	{
		$data['user_payroll_loan_status']	= 'inactive';
									sql_update($this->table_name, 'user_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete_entry($id)
	{
		sql_delete('user_payroll_loan', 'user_id', $id);
	}
	
	 
	 
	
}
  