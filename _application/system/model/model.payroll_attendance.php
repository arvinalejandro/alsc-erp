<?php
class model_payroll_attendance
{	
	
	public function __construct()
	{
		$this->table_name		=	'payroll_attendance';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					payroll_attendance
					
						INNER JOIN option_payroll_attendance_type ON option_payroll_attendance_type.option_payroll_attendance_type_id = payroll_attendance.option_payroll_attendance_type_id
					
					WHERE 
					
					payroll_attendance_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;  
	}
	
	
	
	
	
	public function select_all_by_cutoff($id,$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					payroll_attendance 
					
					INNER JOIN option_payroll_attendance_type ON option_payroll_attendance_type.option_payroll_attendance_type_id = payroll_attendance.option_payroll_attendance_type_id
					
					WHERE payroll_attendance.payroll_cutoff_id = {$id}	
						
					{$filter}	
					
					ORDER BY 	payroll_attendance_id ASC		 
					
					";
		$rows	=	sql_select($query);
		//hash_dump($rows,1);
		# Template
		$template_row		=	'payroll/template/row.daily_stamp';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['payroll_attendance_timestamp']    		 =  string_date_day($row['payroll_attendance_timestamp']);
				$list				   							.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	 
	public function select_all_by_fiscal($id,$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					payroll_attendance 
					
					INNER JOIN payroll_cutoff ON payroll_cutoff.payroll_cutoff_id = payroll_attendance.payroll_cutoff_id
					
					WHERE payroll_cutoff.sysglobal_payroll_id = {$id}	
						
					{$filter}	
					
					ORDER BY 	payroll_attendance_id ASC		
					
					";
		$rows	=	sql_select($query);
		
		return $rows;
	}
	
	
   
	
	
# Modify
	
	
	public function insert($post)
	{
		$data														=	sql_parse_input('payroll_attendance', $post);	
		$sql														=	sql_insert($this->table_name, $data, 'payroll_attendance_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('payroll_attendance', $post);			
									sql_update($this->table_name, 'payroll_attendance_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete_entry($id)
	{
		sql_delete('payroll_attendance', 'payroll_attendance_id', $id);
	}
	
	
	 
	
}
 