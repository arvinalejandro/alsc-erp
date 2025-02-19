<?php
class model_user_payroll_leave
{	
	
	public function __construct()
	{
		$this->table_name		=	'user_payroll_leave';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_leave
					
					INNER JOIN user ON user.user_id = user_payroll_leave.user_id
					
					INNER JOIN user_payroll_attendance ON user_payroll_attendance.user_payroll_attendance_id = user_payroll_leave.user_payroll_attendance_id
					
					INNER JOIN option_payroll_status ON option_payroll_status.option_payroll_status_id = user_payroll_leave.option_payroll_status_id
					
					INNER JOIN option_user_job_title ON option_user_job_title.option_user_job_title_id = user.option_user_job_title_id
					
					INNER JOIN option_department ON option_department.option_department_id = user.option_department_id
					
					INNER JOIN user_payroll_leave_type ON user_payroll_leave_type.user_payroll_leave_type_id = user_payroll_leave.user_payroll_leave_type_id
						
					
					WHERE 
					
					user_payroll_leave_id = {$id}
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
					
					user_payroll_leave
					
					INNER JOIN user_payroll_attendance ON user_payroll_attendance.user_payroll_attendance_id = user_payroll_leave.user_payroll_attendance_id
					
					INNER JOIN user_payroll_leave_type ON user_payroll_leave_type.user_payroll_leave_type_id = user_payroll_leave.user_payroll_leave_type_id
					
					WHERE 
					
					user_payroll_leave.user_id = {$user_id}
					
					AND
					
					user_payroll_leave.user_payroll_attendance_id = {$stamp_id}
					
					AND
					
					user_payroll_leave.option_payroll_status_id = 'approved'
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
	public function select_all_by_user($id,$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_leave 
					
					INNER JOIN user ON user.user_id = user_payroll_leave.user_id
					
					INNER JOIN user_payroll_attendance ON user_payroll_attendance.user_payroll_attendance_id = user_payroll_leave.user_payroll_attendance_id
					
					INNER JOIN payroll_attendance ON payroll_attendance.payroll_attendance_id = user_payroll_attendance.payroll_attendance_id
					
					INNER JOIN payroll_cutoff ON payroll_cutoff.payroll_cutoff_id = payroll_attendance.payroll_cutoff_id
					
					INNER JOIN sysglobal_payroll ON sysglobal_payroll.sysglobal_payroll_id = payroll_cutoff.sysglobal_payroll_id
					
					INNER JOIN option_payroll_status ON option_payroll_status.option_payroll_status_id = user_payroll_leave.option_payroll_status_id
					
					INNER JOIN payroll_schedule ON payroll_schedule.payroll_schedule_id = user_payroll_leave.payroll_schedule_id
					
					INNER JOIN option_user_job_title ON option_user_job_title.option_user_job_title_id = user.option_user_job_title_id
					
					INNER JOIN option_department ON option_department.option_department_id = user.option_department_id
					
					INNER JOIN user_payroll_leave_type ON user_payroll_leave_type.user_payroll_leave_type_id = user_payroll_leave.user_payroll_leave_type_id
					
					
					WHERE user_payroll_leave.user_id = {$id}
					
					AND user_payroll_leave.option_payroll_status_id != 'declined'
					
					AND sysglobal_payroll.is_active = 1
						
					{$filter}	
					
					ORDER BY 	user_payroll_leave_id DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'user/template/row.user_leave';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'user/template/row.leave_empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		//hash_dump($rows,1);
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['user_payroll_leave_date']    				=  string_date_day($row['user_payroll_attendance_timestamp']);
                $row['user_payroll_leave_date_approved']    	=  ($row['user_payroll_leave_date_approved'] > 1) ? string_date_day($row['user_payroll_leave_date_approved']) : 'N/A';
                 $row['user_payroll_leave_approved_by']    		=  ($row['user_payroll_leave_approved_by']) ? $row['user_payroll_leave_approved_by'] : 'N/A';
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
	
	
	public function select_all_by_hr($filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_leave 
					
					INNER JOIN user ON user.user_id = user_payroll_leave.user_id
					
					INNER JOIN user_payroll_attendance ON user_payroll_attendance.user_payroll_attendance_id = user_payroll_leave.user_payroll_attendance_id
					
					INNER JOIN payroll_attendance ON payroll_attendance.payroll_attendance_id = user_payroll_attendance.payroll_attendance_id
					
					INNER JOIN payroll_cutoff ON payroll_cutoff.payroll_cutoff_id = payroll_attendance.payroll_cutoff_id
					
					INNER JOIN sysglobal_payroll ON sysglobal_payroll.sysglobal_payroll_id = payroll_cutoff.sysglobal_payroll_id
					
					INNER JOIN option_payroll_status ON option_payroll_status.option_payroll_status_id = user_payroll_leave.option_payroll_status_id
					
					INNER JOIN option_user_job_title ON option_user_job_title.option_user_job_title_id = user.option_user_job_title_id
					
					INNER JOIN option_department ON option_department.option_department_id = user.option_department_id
					
					INNER JOIN payroll_schedule ON payroll_schedule.payroll_schedule_id = user_payroll_leave.payroll_schedule_id
					
					INNER JOIN user_payroll_leave_type ON user_payroll_leave_type.user_payroll_leave_type_id = user_payroll_leave.user_payroll_leave_type_id
					
					WHERE sysglobal_payroll.is_active = 1
					
					{$filter}	
					
					ORDER BY 	user_payroll_leave_id DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.leave';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.leave_empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['user_payroll_leave_date']    				=  string_date_day_enclosed($row['user_payroll_attendance_timestamp']);
                $row['user_payroll_leave_duration']    			=  ($row['user_payroll_leave_whole'] == 1) ? 'Whole Day' : $row['user_payroll_leave_duration'] . ' hr/s';
                $row['user_payroll_leave_date_approved']    	=  ($row['user_payroll_leave_date_approved'] > 1) ? string_date_day_enclosed($row['user_payroll_leave_date_approved']) : 'N/A';
                $row['user_payroll_leave_approved_by']    		=  ($row['user_payroll_leave_approved_by']) ? $row['user_payroll_leave_approved_by'] : 'N/A';
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
	
	
	
	public function get_count_user_type($id,$type,$schedule,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_leave
					
					INNER JOIN user_payroll_attendance ON user_payroll_attendance.user_payroll_attendance_id = user_payroll_leave.user_payroll_attendance_id
					
					INNER JOIN payroll_attendance ON payroll_attendance.payroll_attendance_id = user_payroll_attendance.payroll_attendance_id
					
					INNER JOIN payroll_cutoff ON payroll_cutoff.payroll_cutoff_id = payroll_attendance.payroll_cutoff_id
					
					INNER JOIN sysglobal_payroll ON sysglobal_payroll.sysglobal_payroll_id = payroll_cutoff.sysglobal_payroll_id
					
					WHERE 
					
					user_payroll_leave.user_id = {$id}
					
					AND
					
					user_payroll_leave.option_payroll_status_id = 'approved'
					
					AND
					
					user_payroll_leave.user_payroll_leave_type_id = '{$type}'
					
					
					AND 
					
					sysglobal_payroll.is_active = 1
					";							
		$rows					=	sql_select($query);	
		//hash_dump($query);
		$list['hour_count'] 	= 0;
		$list['whole_count'] 	= 0;
		if($rows)
		{
			
			foreach($rows as $row)
			{
				//hash_dump($list);
				if($row['user_payroll_leave_whole'] == 1)
				{
					$list['whole_count']   += 1;
				}
				else
				{
					$list['hour_count']    += $row['user_payroll_leave_duration'];
				}
				
				//hash_dump($schedule['payroll_schedule_work_hours']);
				if($list['hour_count'] >= $schedule['payroll_schedule_work_hours'])
				{
					
					$list['hour_count']		= $list['hour_count'] - $schedule['payroll_schedule_work_hours'];
					$list['whole_count']   += 1;
				}
			}
			
		}
		else
		{
			$list['hour_count'] = 0; 
			$list['whole_count'] = 0;
		}
		
		
		//hash_dump($list,1);
		return $list;
	}
	
	
	
	
# Modify

	public function insert($post)
	{
		$data														=	sql_parse_input('user_payroll_leave', $post);	
		$data['user_payroll_leave_timestamp']					    =   time();
		$data['option_payroll_status_id']							=   'for_approval';	
		$sql														=	sql_insert($this->table_name, $data, 'user_payroll_leave_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('user_payroll_leave', $post);					
									sql_update($this->table_name, 'user_payroll_leave_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete_entry($id)
	{
		sql_delete('user_payroll_leave', 'user_id', $id);
	}
	
	
	  
	
}
 