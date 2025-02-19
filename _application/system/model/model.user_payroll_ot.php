<?php
class model_user_payroll_ot
{	
	
	public function __construct()
	{
		$this->table_name		=	'user_payroll_ot';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_ot
					
					INNER JOIN user ON user.user_id = user_payroll_ot.user_id
					
						
					
					WHERE 
					
					user_payroll_ot_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
	public function select_approve_timestamp_id($user_id,$stamp_id)
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_ot
					
					WHERE 
					
					user_id = {$user_id}
					
					AND
					
					user_payroll_attendance_id = {$stamp_id}
					
					AND
					
					option_payroll_status_id = 'approved'
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	public function select_by_date($curr_date,$nxt_date,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_ot
					
						
					
					WHERE 
					
					user_payroll_ot_timestamp >= {$curr_date}
					
					AND
					
					user_payroll_ot_timestamp < {$nxt_date}
					
					";							
		$rows	=	sql_select($query);	
		return $rows;
	}
	
	public function select_all($filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_ot 
					
					INNER JOIN user ON user.user_id = user_payroll_ot.user_id
					
					INNER JOIN user_payroll_attendance ON user_payroll_attendance.user_payroll_attendance_id = user_payroll_ot.user_payroll_attendance_id
					
					INNER JOIN payroll_attendance ON payroll_attendance.payroll_attendance_id = user_payroll_attendance.payroll_attendance_id
					
					INNER JOIN payroll_cutoff ON payroll_cutoff.payroll_cutoff_id = payroll_attendance.payroll_cutoff_id
					
					INNER JOIN sysglobal_payroll ON sysglobal_payroll.sysglobal_payroll_id = payroll_cutoff.sysglobal_payroll_id
					
					INNER JOIN payroll_schedule ON payroll_schedule.payroll_schedule_id = user.payroll_schedule_id
					
					INNER JOIN option_payroll_status ON option_payroll_status.option_payroll_status_id = user_payroll_ot.option_payroll_status_id
					
					WHERE sysglobal_payroll.is_active = 1
						
					{$filter}	
					
					ORDER BY 	user_payroll_ot_id DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.ot';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.ot_empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['user_payroll_ot_date']    				=  string_date_day($row['user_payroll_ot_date']);
                 $row['date_approved']    						=  ($row['user_payroll_ot_date_approved'] > 1) ? string_date_day($row['user_payroll_ot_date_approved']) : 'N/A';
                $row['approved_by']    							=  ($row['user_payroll_ot_approved_by']) ? $row['user_payroll_ot_approved_by'] : 'N/A';
               
                $row['user_']    								=   $row['user_name'].' '.$row['user_surname'];
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
		$data														=	sql_parse_input('user_payroll_ot', $post);	
		$data['user_payroll_ot_timestamp']							=   time();
		$data['option_payroll_status_id']							=   'for_approval';		
		$sql														=	sql_insert($this->table_name, $data, 'user_payroll_ot_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('user_payroll_ot', $post);					
									sql_update($this->table_name, 'user_payroll_ot_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete_entry($id)
	{
		sql_delete('user_payroll_ot', 'user_id', $id);
	}
	
	
	  
	
}
 