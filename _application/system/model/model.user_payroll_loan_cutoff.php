<?php
class model_user_payroll_loan_cutoff
{	
	
	public function __construct()
	{
		$this->table_name		=	'user_payroll_loan_cutoff';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_loan_cutoff
					
						
					
					WHERE 
					
					user_payroll_loan_cutoff_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
	public function select_by_upcid_uplid($loan_id,$cutoff_id)
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_loan_cutoff
					
						
					
					WHERE 
					
					user_payroll_loan_id = {$loan_id}
					
					AND
					
					user_payroll_cutoff_id = {$cutoff_id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
	public function select_all_by_user_cutoff($c_id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_loan_cutoff
					
					INNER JOIN user_payroll_loan ON user_payroll_loan.user_payroll_loan_id = user_payroll_loan_cutoff.user_payroll_loan_id
					
					WHERE 
					
					user_payroll_cutoff_id = {$c_id}
					";							
		//echo $query;
		$rows	=	sql_select($query);	
		$list	=	$rows;
		return $list;
	}
	
public function select_by_user_loan_id($loan_id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						*, (SELECT COUNT(payroll_attendance_id) FROM payroll_attendance WHERE payroll_attendance.payroll_cutoff_id = payroll_cutoff.payroll_cutoff_id) AS stamp_count	  		
					
					FROM 
					
					user_payroll_loan_cutoff
					
					INNER JOIN user_payroll_cutoff ON user_payroll_cutoff.user_payroll_cutoff_id = user_payroll_loan_cutoff.user_payroll_cutoff_id
					
					INNER JOIN payroll_cutoff ON payroll_cutoff.payroll_cutoff_id = user_payroll_cutoff.payroll_cutoff_id
					
					INNER JOIN payroll_tax ON payroll_tax.payroll_tax_id = user_payroll_cutoff.payroll_tax_id
					
					INNER JOIN sysglobal_payroll ON sysglobal_payroll.sysglobal_payroll_id = payroll_cutoff.sysglobal_payroll_id
					
					INNER JOIN option_payroll_status ON option_payroll_status.option_payroll_status_id = payroll_cutoff.option_payroll_status_id
					
					WHERE 
					
					user_payroll_loan_cutoff.user_payroll_loan_id = {$loan_id}
					
					AND
					
					payroll_cutoff.option_payroll_status_id = 'ready'
					
					AND sysglobal_payroll.is_active = 1
					
					
					
					";							
		$rows	=	sql_select($query);
		//hash_dump($rows,1);	
		# Template
		$template_row		=	'payroll/template/row.loan_payslip';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.empty_cutoff';
		$template_row_empty	=	view_get_template($template_row_empty);
		
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['payroll_cutoff_date_start']    			=  string_date_day($row['payroll_cutoff_date_start']);
                $row['payroll_cutoff_date_end']    				=  string_date_day($row['payroll_cutoff_date_end']);
                $row['payroll_cutoff_approver']    				=  ($row['payroll_cutoff_approver']) ? $row['payroll_cutoff_approver'] : 'N/A';
                $row['days_count']    							=  ($row['stamp_count']) ? $row['stamp_count'] : 'N/A';
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
		$sql														=	sql_insert($this->table_name, $post, 'user_payroll_loan_cutoff_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id) 
	{
		$data					=	sql_parse_input('user_payroll_loan_cutoff', $post);					
									sql_update($this->table_name, 'user_payroll_loan_cutoff_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete_entry($id)
	{
		sql_delete('user_payroll_loan_cutoff', 'user_payroll_loan_cutoff_id', $id);
	}
	
	
	  
	
}
 