<?php
class model_user_payroll_attendance_adjustment
{	
	
	public function __construct()
	{
		$this->table_name		=	'user_payroll_attendance_adjustment';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_attendance_adjustment
					
					INNER JOIN user ON user.user_id = user_payroll_attendance_adjustment.user_id
					
					INNER JOIN user_payroll_attendance ON user_payroll_attendance.user_payroll_attendance_id = user_payroll_attendance_adjustment.user_payroll_attendance_id
					
					INNER JOIN payroll_schedule ON payroll_schedule.payroll_schedule_id = user_payroll_attendance.payroll_schedule_id
					
					INNER JOIN option_payroll_status ON option_payroll_status.option_payroll_status_id = user_payroll_attendance_adjustment.option_payroll_status_id
					
					WHERE 
					
					user_payroll_attendance_adjustment_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
	
	public function select_all($curr_time,$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_attendance_adjustment 
					
					INNER JOIN user ON user.user_id = user_payroll_attendance_adjustment.user_id
					
					INNER JOIN user_payroll_attendance ON user_payroll_attendance.user_payroll_attendance_id = user_payroll_attendance_adjustment.user_payroll_attendance_id
					
					INNER JOIN payroll_attendance ON payroll_attendance.payroll_attendance_id = user_payroll_attendance.payroll_attendance_id
					
					INNER JOIN payroll_cutoff ON payroll_cutoff.payroll_cutoff_id = payroll_attendance.payroll_cutoff_id
					
					INNER JOIN sysglobal_payroll ON sysglobal_payroll.sysglobal_payroll_id = payroll_cutoff.sysglobal_payroll_id
					
					INNER JOIN payroll_schedule ON payroll_schedule.payroll_schedule_id = user_payroll_attendance.payroll_schedule_id
					
					INNER JOIN option_payroll_status ON option_payroll_status.option_payroll_status_id = user_payroll_attendance_adjustment.option_payroll_status_id
					
					
					WHERE sysglobal_payroll.is_active = 1
						
					{$filter}	
					
					ORDER BY 	user_payroll_attendance_adjustment_id DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.attendance_adjustment';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.attendance_adjustment_empty';  
		$template_row_empty	=	view_get_template($template_row_empty);
		
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['user_payroll_attendance_timestamp']    			=  string_date_day($row['user_payroll_attendance_timestamp']);
                $row['r_type']    										= ($row['is_official_business'] == 1) ?  'Official Business' :  'Default';
                $row['date_approved']    								=  ($row['user_payroll_attendance_adjustment_date_approved'] > 1) ? string_date_day($row['user_payroll_attendance_adjustment_date_approved']) : 'N/A';
                $row['approved_by']    									=  ($row['user_payroll_attendance_adjustment_approved_by']) ? $row['user_payroll_attendance_adjustment_approved_by'] : 'N/A';
                $row['user_payroll_attendance_adjustment_time_in']    	=  ($row['user_payroll_attendance_adjustment_time_in'] > 1) ? string_time_colon($row['user_payroll_attendance_adjustment_time_in']) : 'N/A';
                $row['user_payroll_attendance_adjustment_time_out']    	=  ($row['user_payroll_attendance_adjustment_time_out'] > 1) ? string_time_colon($row['user_payroll_attendance_adjustment_time_out']) : 'N/A';
                $row['user_payroll_attendance_adjustment_break_in']    	=  ($row['user_payroll_attendance_adjustment_break_in'] > 1) ? string_time_colon($row['user_payroll_attendance_adjustment_break_in']) : 'N/A';
                $row['user_payroll_attendance_adjustment_break_out']    =  ($row['user_payroll_attendance_adjustment_break_out'] > 1) ? string_time_colon($row['user_payroll_attendance_adjustment_break_out']) : 'N/A';
                $row['user_']    										=   $row['user_name'].' '.$row['user_surname'];
				$list				   						   		   .=	view_populate($row, $template_row);
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
		$data														=	sql_parse_input('user_payroll_attendance_adjustment', $post);
		$data['user_payroll_attendance_adjustment_timestamp']		=   time();
		$data['option_payroll_status_id']							=   'for_approval';
		
		$sql														=	sql_insert($this->table_name, $data, 'user_payroll_attendance_adjustment_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('user_payroll_attendance_adjustment', $post);					
									sql_update($this->table_name, 'user_payroll_attendance_adjustment_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete_entry($id)
	{
		sql_delete('user_payroll_attendance_adjustment', 'user_id', $id);
	}
	
	
	  
	
}
  