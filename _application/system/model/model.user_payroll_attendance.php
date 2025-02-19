<?php
class model_user_payroll_attendance
{	
	
	public function __construct()
	{
		$this->table_name		=	'user_payroll_attendance';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_attendance
					
					INNER JOIN payroll_schedule ON payroll_schedule.payroll_schedule_id = user_payroll_attendance.payroll_schedule_id
					
					WHERE 
					
					user_payroll_attendance_id = {$id}
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
					
					user_payroll_attendance
					
						
					
					WHERE 
					
					user_payroll_attendance_timestamp >= {$curr_date}
					
					AND
					
					user_payroll_attendance_timestamp < {$nxt_date}
					
					";							
		$rows	=	sql_select($query);	
		return $rows;
	}
	
	
	public function select_by_cutoff($cutoff_id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_attendance
					
					INNER JOIN user ON user.user_id = user_payroll_attendance.user_id
					
						
					
					WHERE 
					
					payroll_cutoff_id = {$cutoff_id}
					
					
					";							
		$rows	=	sql_select($query);	
		return $rows;
	}
	
	
	public function select_by_user_cutoff($user_id,$cutoff_id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_attendance
					
					
					INNER JOIN payroll_schedule ON	payroll_schedule.payroll_schedule_id = user_payroll_attendance.payroll_schedule_id
					
					INNER JOIN payroll_attendance ON	payroll_attendance.payroll_attendance_id = user_payroll_attendance.payroll_attendance_id
										
					INNER JOIN option_payroll_attendance_type ON option_payroll_attendance_type.option_payroll_attendance_type_id = payroll_attendance.option_payroll_attendance_type_id
					
					WHERE 
					
					payroll_attendance.payroll_cutoff_id = {$cutoff_id}
					
					AND
					
					user_payroll_attendance.user_id = {$user_id}
					
					
					";							
		$rows	=	sql_select($query);	
		return $rows;
	}
	
	
	//for timestamp
	public function select_all($cutoff_id,$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_attendance 
					
					INNER JOIN user ON user.user_id = user_payroll_attendance.user_id
					
					INNER JOIN payroll_attendance ON payroll_attendance.payroll_attendance_id = user_payroll_attendance.payroll_attendance_id
					
					INNER JOIN option_user_job_title ON option_user_job_title.option_user_job_title_id = user.option_user_job_title_id
					
					INNER JOIN option_department ON option_department.option_department_id = user.option_department_id
					
					INNER JOIN payroll_schedule ON payroll_schedule.payroll_schedule_id = user_payroll_attendance.payroll_schedule_id
					
					
					WHERE payroll_attendance.payroll_cutoff_id = {$cutoff_id}	
					
					AND user.option_user_status_id = 'enabled'
					
						
					{$filter}	
					
					ORDER BY 	user_payroll_attendance_timestamp DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.attendance';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.empty_attendance';
		$template_row_empty	=	view_get_template($template_row_empty);
		
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                
                //compute late,ob,ut=========================================
				$year 											=	string_date_year($row['user_payroll_attendance_timestamp']); 
				$month 											=	string_date_month_numeric($row['user_payroll_attendance_timestamp']); 
				$day 											=	string_day($row['user_payroll_attendance_timestamp']);
	   			$filler											=  (strtotime($row['payroll_schedule_start']) > strtotime($row['payroll_schedule_end'])) ? " +1 day" : "";
				$string_sched_start								=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']); 
				$string_sched_end								=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_end'] . $filler); 
				$time_sched    									=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']);
				$seconds_late									=  ($row['timestamp_in'] > $string_sched_start) ? $row['timestamp_in'] - $string_sched_start : 0;
				$seconds_under_time								=  ($string_sched_end > $row['timestamp_out']) ?  $string_sched_end - $row['timestamp_out'] : 0;
				$break_duration									=  ($row['timestamp_break_in'] - $row['timestamp_break_out']); // for clarification
				$round_break_duration							=  round($break_duration/60);//minute
				$round_under_time								=  round($seconds_under_time/60);//minute
				$round_late										=  round($seconds_late/60);//minute
				$round_break_duration							=  ($round_break_duration > $row['payroll_schedule_break']) ? $round_break_duration - $row['payroll_schedule_break'] : 0;
				$row['late_class']								=  ($row['timestamp_in'] > $string_sched_start) ? 'style="background-color: #ff9999;"' : '';
				$row['ovbr_min']								=   $round_break_duration;
				$row['late_min']								=   $round_late;
				$row['untme_min']								=   $round_under_time;
				$row['user_excess_minutes']						=   $row['user_excess_minutes']+$row['user_excess_minutes_early'];
				$total_work_hours								=   $row['timestamp_out'] - $row['timestamp_in']-$break_duration;
				$total_work_minute								=   round($total_work_hours/60);
				$work_hour										=   round($total_work_minute/60);
				$work_minute									=   $total_work_minute%60;
				$row['work_hours']								=   ($work_minute > 0) ? $work_hour.':'.$work_minute : $work_hour.':00';
				
				//end compute====================================
                
                
                $leave											=  mvc_model('model.user_payroll_leave')->select_approve_timestamp_id($row['user_id'],$row['user_payroll_attendance_id']);
                $row['user_payroll_attendance_timestamp']    	=  string_date_day_enclosed($row['user_payroll_attendance_timestamp']);
                $row['timestamp_in']    						=  ($row['timestamp_in'] > 1) ? string_time_military($row['timestamp_in']) : 'N/A';
                $row['timestamp_out']    						=  ($row['timestamp_out'] > 1) ? string_time_military($row['timestamp_out']) : 'N/A';
                $row['timestamp_break_in']    					=  ($row['timestamp_break_in'] > 1) ? string_time_military($row['timestamp_break_in']) : 'N/A';
                $row['timestamp_break_out']    					=  ($row['timestamp_break_out'] > 1) ? string_time_military($row['timestamp_break_out']) : 'N/A';
                $timestamp_row									=  '<td align="center">'.$row['timestamp_in'].'</td> 
																    <td align="center">'.$row['timestamp_break_out'].'</td>
																    <td align="center">'.$row['timestamp_break_in'].'</td> 
																     <td align="center">'.$row['timestamp_out'].'</td>';
               
                if($leave)
                {
				     $leave_side_unit  					    =  ($leave['user_payroll_leave_whole'] == 1) ? '('.$row['payroll_schedule_work_hours'] . '.0)' : '('.$leave['user_payroll_leave_duration'] . '.0)';
                	 $leave_label								=  $leave['user_payroll_leave_type_name'];
                	 
                	 if($leave['user_payroll_leave_whole'] == 1)
                	 {
						  $timestamp_row								=  '<td align="center" colspan="4"><div class="details">
																				'.$leave_label.$leave_side_unit.' 
																			</div></td>';
                	 }
                	 else
                	 {
						  $timestamp_row									=  '<td align="center">'.$row['timestamp_in'].'</td> 
																			    <td align="center" colspan="2">'.$leave_label.$leave_side_unit.'</td>
																			     <td align="center">'.$row['timestamp_out'].'</td>';
                	 }
                	
                }
                $row['timestamp_row']							=  $timestamp_row;
                if($row['timestamp_in'] == 'N/A' || $leave)
                {
					$row['ovbr_min']								=   0;
					$row['late_min']								=   0;
					$row['untme_min']								=   0;
					$row['user_excess_minutes']						=   0;
                }
                
                $row['user_']    								=   $row['user_name'].' '.$row['user_surname'];
                $ot												=  mvc_model('model.user_payroll_ot')->select_approve_timestamp_id($row['user_id'],$row['user_payroll_attendance_id']);
				$row['ot_hour']									=   $ot['user_payroll_ot_hour']*1;
				$row['ot_min']									=   $ot['user_payroll_ot_minute']*1;
				$row['ot_min']									=   ($row['ot_min'] < 10) ? '0'.$row['ot_min'] : $row['ot_min'];
				$row['ot_label']								=   ($ot['user_payroll_ot_minute'] > 0) ? $row['ot_hour'].':'.$row['ot_min'] : $row['ot_hour'].':00';
				
				
				$list				   						   .=	view_populate($row, $template_row);
				
				
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	//employee daily stamp
	public function select_all_by_user($id,$cut_off_id_f,$cut_off_id_s,$sched_array,$filter = '')
	{
		# DB
		$curr	=  time();
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_attendance 
					
					INNER JOIN user ON user.user_id = user_payroll_attendance.user_id
					
					INNER JOIN payroll_attendance ON payroll_attendance.payroll_attendance_id = user_payroll_attendance.payroll_attendance_id
					
					INNER JOIN option_user_job_title ON option_user_job_title.option_user_job_title_id = user.option_user_job_title_id
					
					INNER JOIN option_department ON option_department.option_department_id = user.option_department_id
					
					INNER JOIN payroll_schedule ON payroll_schedule.payroll_schedule_id = user_payroll_attendance.payroll_schedule_id
					
					WHERE user_payroll_attendance.user_id = {$id}	
					
					AND payroll_attendance.payroll_cutoff_id >= {$cut_off_id_f}
					AND payroll_attendance.payroll_cutoff_id <= {$cut_off_id_s}
						
					{$filter}	
					
					ORDER BY 	user_payroll_attendance_id DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.user_attendance';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.empty_attendance';
		$template_row_empty	=	view_get_template($template_row_empty);
		
		if(count($rows))
		{
			//
			$list['min_late'] 						= 0;
			$list['count_late'] 					= 0;
			$list['count_absent'] 					= 0;
			foreach($rows as $row)
			{
				$leave									=  mvc_model('model.user_payroll_leave')->select_approve_timestamp_id($row['user_id'],$row['user_payroll_attendance_id']);
				$stamp_day								= date("l", $row['user_payroll_attendance_timestamp']);
				if(in_array($stamp_day,$sched_array))
				{	
						
						if($row['timestamp_in'] > 1)
						{
							   
							    $year 							=	string_date_year($row['user_payroll_attendance_timestamp']); 
								$month 							=	string_date_month_numeric($row['user_payroll_attendance_timestamp']); 
								$day 							=	string_day($row['user_payroll_attendance_timestamp']);
								$time_in						=  $row['payroll_schedule_start'];
	   							$filler							=  (strtotime($row['payroll_schedule_start']) > strtotime($row['payroll_schedule_end'])) ? " +1 day" : "";
							    $string_sched_start				=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']); 
							    $string_sched_end				=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_end'] . $filler); 
							    $time_sched    					=  strtotime($month.'/'.$day.'/'.$year . $time_in);
							    
							    $seconds_late					=  ($row['timestamp_in'] > $string_sched_start) ? $row['timestamp_in'] - $string_sched_start : 0;
							    $count_late						=  ($row['timestamp_in'] > $string_sched_start) ? 1 : 0;
								$seconds_under_time				=  ($string_sched_end > $row['timestamp_out']) ?  $string_sched_end - $row['timestamp_out'] : 0;
								
								$min_late						=   round($seconds_late/60);
								$list['min_late']			   +=   $min_late;
								$list['count_late'] 		   +=   $count_late;
								// echo $min_late.'g<br>';
							
						}
						elseif($leave)//get leaved if approve
						{
							
						}
						else
						{
							if($curr >= $row['user_payroll_attendance_timestamp'])
							{
								$list['count_absent'] 		   	   +=   1;
							}
						}
				
				}//end if withing working day
				
			}
			  
			foreach($rows as $row)
			{		
                //compute late,ob,ut==========================================
				$year 											=	string_date_year($row['user_payroll_attendance_timestamp']); 
				$month 											=	string_date_month_numeric($row['user_payroll_attendance_timestamp']); 
				$day 											=	string_day($row['user_payroll_attendance_timestamp']);
	   			$filler											=  (strtotime($row['payroll_schedule_start']) > strtotime($row['payroll_schedule_end'])) ? " +1 day" : "";
				$string_sched_start								=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']); 
				$string_sched_end								=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_end'] . $filler); 
				$time_sched    									=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']);
				
				$seconds_late									=  ($row['timestamp_in'] > $string_sched_start) ? $row['timestamp_in'] - $string_sched_start : 0;
				$seconds_under_time								=  ($string_sched_end > $row['timestamp_out']) ?  $string_sched_end - $row['timestamp_out'] : 0;
				$break_duration									=  ($row['timestamp_break_in'] - $row['timestamp_break_out']); // for clarification
				$round_break_duration							=  round($break_duration/60);//minute
				$round_under_time								=  round($seconds_under_time/60);//minute
				$round_late										=  round($seconds_late/60);//minute
				$round_break_duration							=  ($round_break_duration > $row['payroll_schedule_break']) ? $round_break_duration - $row['payroll_schedule_break'] : 0;
				$row['late_class']								=  ($row['timestamp_in'] > $string_sched_start) ? 'style="background-color: #ff9999;"' : '';
				$row['ovbr_min']								=   $round_break_duration;
				$row['late_min']								=   $round_late;
				$row['untme_min']								=   $round_under_time;
				$row['user_excess_minutes']						=   $row['user_excess_minutes']+$row['user_excess_minutes_early'];
				$total_work_hours								=   $row['timestamp_out'] - $row['timestamp_in']-$break_duration;
				$total_work_minute								=   round($total_work_hours/60);
				$work_hour										=   round($total_work_minute/60);
				$work_minute									=   $total_work_minute%60;
				$row['work_hours']								=   ($work_minute > 0) ? $work_hour.':'.$work_minute : $work_hour.':00';
				
				//end=================================================================
                $leave											=  mvc_model('model.user_payroll_leave')->select_approve_timestamp_id($row['user_id'],$row['user_payroll_attendance_id']);
                $row['user_payroll_attendance_timestamp']    	=  string_date_day_enclosed($row['user_payroll_attendance_timestamp']);
                $row['timestamp_in']    						=  ($row['timestamp_in'] > 1) ? string_time_military($row['timestamp_in']) : 'N/A';
                $row['timestamp_out']    						=  ($row['timestamp_out'] > 1) ? string_time_military($row['timestamp_out']) : 'N/A';
                $row['timestamp_break_in']    					=  ($row['timestamp_break_in'] > 1) ? string_time_military($row['timestamp_break_in']) : 'N/A';
                $row['timestamp_break_out']    					=  ($row['timestamp_break_out'] > 1) ? string_time_military($row['timestamp_break_out']) : 'N/A';
                $timestamp_row									=  '<td align="center">'.$row['timestamp_in'].'</td> 
																    <td align="center">'.$row['timestamp_break_out'].'</td>
																    <td align="center">'.$row['timestamp_break_in'].'</td> 
																     <td align="center">'.$row['timestamp_out'].'</td>';
               
                
                
                if($leave)
                {
					 $leave_side_unit  					    	=  ($leave['user_payroll_leave_whole'] == 1) ? '('.$row['payroll_schedule_work_hours'] . '.0)' : '('.$leave['user_payroll_leave_duration'] . '.0)';
                	 $leave_label								=  $leave['user_payroll_leave_type_name'];
                	 if($leave['user_payroll_leave_whole'] == 1)
                	 {
						  $timestamp_row								=  '<td align="center" colspan="4"><div class="details">
																				'.$leave_label.$leave_side_unit.' 
																			</div></td>';
                	 }
                	 else
                	 {
						  $timestamp_row									=  '<td align="center">'.$row['timestamp_in'].'</td> 
																			    <td align="center" colspan="2">'.$leave_label.$leave_side_unit.'</td>
																			     <td align="center">'.$row['timestamp_out'].'</td>';
                	 }
                }
                $row['timestamp_row']							=  $timestamp_row;
                if($row['timestamp_in'] == 'N/A' || $leave)
                {
					$row['ovbr_min']								=   0;
					$row['late_min']								=   0;
					$row['untme_min']								=   0;
					$row['user_excess_minutes']						=   0;
                }
               
               
                $row['user_']    								=   $row['user_name'].' '.$row['user_surname'];
                 $ot											=  mvc_model('model.user_payroll_ot')->select_approve_timestamp_id($row['user_id'],$row['user_payroll_attendance_id']);
				$row['ot_hour']									=   $ot['user_payroll_ot_hour']*1;
				$row['ot_min']									=   $ot['user_payroll_ot_minute']*1;
				$row['ot_min']									=   ($row['ot_min'] < 10) ? '0'.$row['ot_min'] : $row['ot_min'];
				$row['ot_label']								=   ($ot['user_payroll_ot_minute'] > 0) ? $row['ot_hour'].':'.$row['ot_min'] : $row['ot_hour'].':00';
				$list['rows']				   				   .=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list['min_late'] 						= 0;
			$list['count_late'] 					= 0;
			$list['count_absent'] 					= 0;
			$list['rows']							= $template_row_empty;
		}
		return $list;
	}
	
	
	public function select_all_by_user_payslip($id,$cut_off_id,$sched_array,$upid,$filter = '')
	{
		# DB
		$curr	=  time();
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_attendance 
					
					INNER JOIN user ON user.user_id = user_payroll_attendance.user_id
					
					INNER JOIN payroll_attendance ON payroll_attendance.payroll_attendance_id = user_payroll_attendance.payroll_attendance_id
					
					INNER JOIN option_user_job_title ON option_user_job_title.option_user_job_title_id = user.option_user_job_title_id
					
					INNER JOIN option_department ON option_department.option_department_id = user.option_department_id
					
					INNER JOIN payroll_schedule ON payroll_schedule.payroll_schedule_id = user_payroll_attendance.payroll_schedule_id
					
					WHERE user_payroll_attendance.user_id = {$id}	
					
					AND payroll_attendance.payroll_cutoff_id = {$cut_off_id}
						
					{$filter}	
					
					ORDER BY 	user_payroll_attendance_id DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.user_attendance_payslip';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.empty_attendance';
		$template_row_empty	=	view_get_template($template_row_empty);
		
		if(count($rows))
		{
			//
			$list['min_late'] 						= 0;
			$list['count_late'] 					= 0;
			$list['count_absent'] 					= 0;
			foreach($rows as $row)
			{
				$leave									=  mvc_model('model.user_payroll_leave')->select_approve_timestamp_id($row['user_id'],$row['user_payroll_attendance_id']);
				$stamp_day								= date("l", $row['user_payroll_attendance_timestamp']);
				if(in_array($stamp_day,$sched_array))
				{	
						
						if($row['timestamp_in'] > 1)
						{
							   
							    $year 							=	string_date_year($row['user_payroll_attendance_timestamp']); 
								$month 							=	string_date_month_numeric($row['user_payroll_attendance_timestamp']); 
								$day 							=	string_day($row['user_payroll_attendance_timestamp']);
								$time_in						=  $row['payroll_schedule_start'];
	   							$filler							=  (strtotime($row['payroll_schedule_start']) > strtotime($row['payroll_schedule_end'])) ? " +1 day" : "";
							    $string_sched_start				=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']); 
							    $string_sched_end				=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_end'] . $filler); 
							    $time_sched    					=  strtotime($month.'/'.$day.'/'.$year . $time_in);
							    
							    $seconds_late					=  ($row['timestamp_in'] > $string_sched_start) ? $row['timestamp_in'] - $string_sched_start : 0;
							    $count_late						=  ($row['timestamp_in'] > $string_sched_start) ? 1 : 0;
								$seconds_under_time				=  ($string_sched_end > $row['timestamp_out']) ?  $string_sched_end - $row['timestamp_out'] : 0;
								
								$min_late						=   round($seconds_late/60);
								$list['min_late']			   +=   $min_late;
								$list['count_late'] 		   +=   $count_late;
								// echo $min_late.'g<br>';
							
						}
						elseif($leave)//get leaved if approve
						{
							
						}
						else
						{
							if($curr >= $row['user_payroll_attendance_timestamp'])
							{
								$list['count_absent'] 		   	   +=   1;
							}
						}
						
				
				}//end if withing working day
				
				
			}
			 
			foreach($rows as $row)
			{		
                //compute late,ob,ut==========================================
				$year 											=	string_date_year($row['user_payroll_attendance_timestamp']); 
				$month 											=	string_date_month_numeric($row['user_payroll_attendance_timestamp']); 
				$day 											=	string_day($row['user_payroll_attendance_timestamp']);
	   			$filler											=  (strtotime($row['payroll_schedule_start']) > strtotime($row['payroll_schedule_end'])) ? " +1 day" : "";
				$string_sched_start								=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']); 
				$string_sched_end								=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_end'] . $filler); 
				$time_sched    									=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']);
				
				$seconds_late									=  ($row['timestamp_in'] > $string_sched_start) ? $row['timestamp_in'] - $string_sched_start : 0;
				$seconds_under_time								=  ($string_sched_end > $row['timestamp_out']) ?  $string_sched_end - $row['timestamp_out'] : 0;
				$break_duration									=  ($row['timestamp_break_in'] - $row['timestamp_break_out']); // for clarification
				$round_break_duration							=  round($break_duration/60);//minute
				$round_under_time								=  round($seconds_under_time/60);//minute
				$round_late										=  round($seconds_late/60);//minute
				$round_break_duration							=  ($round_break_duration > $row['payroll_schedule_break']) ? $round_break_duration - $row['payroll_schedule_break'] : 0;
				$row['late_class']								=  ($row['timestamp_in'] > $string_sched_start) ? 'style="background-color: #ff9999;"' : '';
				$row['late_class']								=  ($row['is_undertime'] == 1) ? 'style="background-color: #ED672D;"' : $row['late_class'];
				$row['ovbr_min']								=   $round_break_duration;
				$row['late_min']								=   $round_late;
				$row['untme_min']								=   $round_under_time;
				$row['user_excess_minutes']						=   $row['user_excess_minutes']+$row['user_excess_minutes_early'];
				$total_work_hours								=   $row['timestamp_out'] - $row['timestamp_in']-$break_duration;
				$total_work_minute								=   round($total_work_hours/60);
				$work_hour										=   round($total_work_minute/60);
				$work_minute									=   $total_work_minute%60;
				$row['work_hours']								=   ($work_minute > 0) ? $work_hour.':'.$work_minute : $work_hour.':00';
				
				//end=================================================================
                
                
                $curr_time										=  time();
                $leave											=  mvc_model('model.user_payroll_leave')->select_approve_timestamp_id($row['user_id'],$row['user_payroll_attendance_id']);
                $row['user_payroll_attendance_timestamp']    	=  string_date_day_enclosed($row['user_payroll_attendance_timestamp']);
                $row['timestamp_in']    						=  ($row['timestamp_in'] > 1) ? string_time_military($row['timestamp_in']) : 'N/A';
                $row['timestamp_out']    						=  ($row['timestamp_out'] > 1) ? string_time_military($row['timestamp_out']) : 'N/A';
                $row['timestamp_break_in']    					=  ($row['timestamp_break_in'] > 1) ? string_time_military($row['timestamp_break_in']) : 'N/A';
                $row['timestamp_break_out']    					=  ($row['timestamp_break_out'] > 1) ? string_time_military($row['timestamp_break_out']) : 'N/A';
                $timestamp_row									=  '<td align="center">'.$row['timestamp_in'].'</td> 
																    <td align="center">'.$row['timestamp_break_out'].'</td>
																    <td align="center">'.$row['timestamp_break_in'].'</td> 
																     <td align="center">'.$row['timestamp_out'].'</td>';
               	$stamp_data	                                    =   $this->select($row['user_payroll_attendance_id']);
             //  hash_dump($row,1);
               	$salary	    									=	mvc_model('model.option')->select_option('user_salary', ' WHERE user_id='.$row['user_id'].' AND user_salary_date_effect <='.$curr_time);
    			$salary_opt										=	hash_to_option($salary, 'user_salary_id', 'user_basic_salary',$stamp_data['user_salary_id']);
				$salary_row										=   '<form action="/payroll/employees/submit_update_salary" method="post" name="alsc_form_'.$row['user_payroll_attendance_id'].'">
                                                                         <input type="hidden"  name="timestamp_id" value="'.$row['user_payroll_attendance_id'].'" />
                                                                          <input type="hidden" value="'.$row['user_id'].'" name="id" />	
                                                                          <input type="hidden" value="'.$cut_off_id.'" name="cutoff" />	
                                                                          <input type="hidden" value="'.$upid.'" name="upid" />	
                														<td colspan=2 align="center"><select name="us[int][user_salary_id]" onchange="submit_form(\'alsc_form_'.$row['user_payroll_attendance_id'].'\')">
										                                  '.$salary_opt.'
										                                </select></form></td>';
									                                
			   $salary_empty									=   '<td align="center"></td><td align="center"></td>';
			   $row['salary_opt']								=  ($row['timestamp_in'] > 1) ? $salary_row : $salary_empty;
                
                
                if($leave)
                {
					 $row['salary_opt']							=  $salary_row.$salary_button;
					 $leave_side_unit  					    	=  ($leave['user_payroll_leave_whole'] == 1) ? '('.$row['payroll_schedule_work_hours'] . '.0)' : '('.$leave['user_payroll_leave_duration'] . '.0)';
                	 $leave_label								=  $leave['user_payroll_leave_type_name'];
                	 if($leave['user_payroll_leave_whole'] == 1)
                	 {
						  $timestamp_row								=  '<td align="center" colspan="4"><div class="details">
																				'.$leave_label.$leave_side_unit.' 
																			</div></td>';
                	 }
                	 else
                	 {
						  $timestamp_row									=  '<td align="center">'.$row['timestamp_in'].'</td> 
																			    <td align="center" colspan="2">'.$leave_label.$leave_side_unit.'</td>
																			     <td align="center">'.$row['timestamp_out'].'</td>';
                	 }
                }
                $row['timestamp_row']							=  $timestamp_row;
                if($row['timestamp_in'] == 'N/A' || $leave)
                {
					$row['ovbr_min']								=   0;
					$row['late_min']								=   0;
					$row['untme_min']								=   0;
					$row['user_excess_minutes']						=   0;
                }
               
               
                $row['user_']    								=   $row['user_name'].' '.$row['user_surname'];
                 $ot											=  mvc_model('model.user_payroll_ot')->select_approve_timestamp_id($row['user_id'],$row['user_payroll_attendance_id']);
				$row['ot_hour']									=   $ot['user_payroll_ot_hour']*1;
				$row['ot_min']									=   $ot['user_payroll_ot_minute']*1;
				$row['ot_min']									=   ($row['ot_min'] < 10) ? '0'.$row['ot_min'] : $row['ot_min'];
				$row['ot_label']								=   ($ot['user_payroll_ot_minute'] > 0) ? $row['ot_hour'].':'.$row['ot_min'] : $row['ot_hour'].':00';
				$list['rows']				   				   .=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list['min_late'] 						= 0;
			$list['count_late'] 					= 0;
			$list['count_absent'] 					= 0;
			$list['rows']							= $template_row_empty;
		}
		return $list;
	}
	
	
	
	//employee daily stamp
	public function select_all_by_stamp_id($id_array,$filter = '')
	{
		# DB
		$curr	=  time();
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_attendance 
					
					INNER JOIN user ON user.user_id = user_payroll_attendance.user_id
					
					INNER JOIN payroll_attendance ON payroll_attendance.payroll_attendance_id = user_payroll_attendance.payroll_attendance_id
					
					INNER JOIN option_user_job_title ON option_user_job_title.option_user_job_title_id = user.option_user_job_title_id
					
					INNER JOIN option_department ON option_department.option_department_id = user.option_department_id
					
					INNER JOIN payroll_schedule ON payroll_schedule.payroll_schedule_id = user_payroll_attendance.payroll_schedule_id
					
					WHERE user_payroll_attendance_id IN({$id_array}) 	
				
					{$filter}	
					
					ORDER BY 	user_payroll_attendance_id DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.user_attendance_late';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.empty_attendance_late';
		$template_row_empty	=	view_get_template($template_row_empty);
		
		if(count($rows))
		{
			//
			
			
			foreach($rows as $row)
			{		
                //compute late,ob,ut==========================================
				$year 											=	string_date_year($row['user_payroll_attendance_timestamp']); 
				$month 											=	string_date_month_numeric($row['user_payroll_attendance_timestamp']); 
				$day 											=	string_day($row['user_payroll_attendance_timestamp']);
	   			$filler											=  (strtotime($row['payroll_schedule_start']) > strtotime($row['payroll_schedule_end'])) ? " +1 day" : "";
				$string_sched_start								=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']); 
				$string_sched_end								=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_end'] . $filler); 
				$time_sched    									=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']);
				
				$seconds_late									=  ($row['timestamp_in'] > $string_sched_start) ? $row['timestamp_in'] - $string_sched_start : 0;
				$seconds_under_time								=  ($string_sched_end > $row['timestamp_out']) ?  $string_sched_end - $row['timestamp_out'] : 0;
				$break_duration									=  ($row['timestamp_break_in'] - $row['timestamp_break_out']); // for clarification
				$round_break_duration							=  round($break_duration/60);//minute
				$round_under_time								=  round($seconds_under_time/60);//minute
				$round_late										=  round($seconds_late/60);//minute
				$round_break_duration							=  ($round_break_duration > $row['payroll_schedule_break']) ? $round_break_duration - $row['payroll_schedule_break'] : 0;
				
				$row['ovbr_min']								=   $round_break_duration;
				$row['late_min']								=   $round_late;
				$row['untme_min']								=   $round_under_time;
				$row['user_excess_minutes']						=   $row['user_excess_minutes']+$row['user_excess_minutes_early'];
				$total_work_hours								=   $row['timestamp_out'] - $row['timestamp_in']-$break_duration;
				$total_work_minute								=   round($total_work_hours/60);
				$work_hour										=   round($total_work_minute/60);
				$work_minute									=   $total_work_minute%60;
				$row['work_hours']								=   ($work_minute > 0) ? $work_hour.':'.$work_minute : $work_hour.':00';
				
				//end=================================================================
                $leave											=  mvc_model('model.user_payroll_leave')->select_approve_timestamp_id($row['user_id'],$row['user_payroll_attendance_id']);
                $row['user_payroll_attendance_timestamp']    	=  string_date_day_enclosed($row['user_payroll_attendance_timestamp']);
                $row['timestamp_in']    						=  ($row['timestamp_in'] > 1) ? string_time_military($row['timestamp_in']) : 'N/A';
                $row['timestamp_out']    						=  ($row['timestamp_out'] > 1) ? string_time_military($row['timestamp_out']) : 'N/A';
                $row['timestamp_break_in']    					=  ($row['timestamp_break_in'] > 1) ? string_time_military($row['timestamp_break_in']) : 'N/A';
                $row['timestamp_break_out']    					=  ($row['timestamp_break_out'] > 1) ? string_time_military($row['timestamp_break_out']) : 'N/A';
                $timestamp_row									=  '<td align="center">'.$row['timestamp_in'].'</td> 
																    <td align="center">'.$row['timestamp_break_out'].'</td>
																    <td align="center">'.$row['timestamp_break_in'].'</td> 
																     <td align="center">'.$row['timestamp_out'].'</td>';
               
                $row['timestamp_row']							=  $timestamp_row;
                if($row['timestamp_in'] == 'N/A' )
                {
					$row['ovbr_min']								=   0;
					$row['late_min']								=   0;
					$row['untme_min']								=   0;
					$row['user_excess_minutes']						=   0;
                }
               
               
                $row['user_']    								=   $row['user_name'].' '.$row['user_surname'];
				$list				   				   			.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list							= $template_row_empty;
		}
		return $list;
	}
	
	
///employee	
	public function check_if_active_fiscal($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_attendance
					
						INNER JOIN payroll_attendance ON payroll_attendance.payroll_attendance_id = user_payroll_attendance.payroll_attendance_id	
						
						INNER JOIN payroll_cutoff ON payroll_cutoff.payroll_cutoff_id = payroll_attendance.payroll_cutoff_id	
						
						INNER JOIN sysglobal_payroll ON sysglobal_payroll.sysglobal_payroll_id = payroll_cutoff.sysglobal_payroll_id				
					WHERE 
					
					user_payroll_attendance.user_id = {$id}
					
					AND sysglobal_payroll.is_active = 1
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
	
	// summary
	public function select_user_summary($user_id,$sched_array,$filter = '')
	{
		# DB
		$curr	=  time();
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_attendance 
					
					INNER JOIN user ON user.user_id = user_payroll_attendance.user_id
					
					INNER JOIN payroll_attendance ON payroll_attendance.payroll_attendance_id = user_payroll_attendance.payroll_attendance_id
					
					INNER JOIN payroll_cutoff ON payroll_cutoff.payroll_cutoff_id = payroll_attendance.payroll_cutoff_id
					
					INNER JOIN sysglobal_payroll ON sysglobal_payroll.sysglobal_payroll_id = payroll_cutoff.sysglobal_payroll_id
					
					INNER JOIN payroll_schedule ON payroll_schedule.payroll_schedule_id = user_payroll_attendance.payroll_schedule_id
					
					WHERE sysglobal_payroll.is_active = 1	
					
					AND user_payroll_attendance.user_id = {$user_id}
					
					AND  user_payroll_attendance.user_payroll_attendance_timestamp <= {$curr}
					
						
					{$filter}	
					
					ORDER BY 	user_payroll_attendance_timestamp DESC		
					
					";
		$rows	=	sql_select($query);
		if(count($rows))
		{
			//
			$list['min_late'] 						= 0;
			$list['count_late'] 					= 0;
			$list['count_absent'] 					= 0;
			foreach($rows as $row)
			{
				$leave									=  mvc_model('model.user_payroll_leave')->select_approve_timestamp_id($row['user_id'],$row['user_payroll_attendance_id']);
				$stamp_day								= date("l", $row['user_payroll_attendance_timestamp']);
				if(in_array($stamp_day,$sched_array))
				{	
						
						if($row['timestamp_in'] > 1)
						{
							   
							    $year 							=	string_date_year($row['user_payroll_attendance_timestamp']); 
								$month 							=	string_date_month_numeric($row['user_payroll_attendance_timestamp']); 
								$day 							=	string_day($row['user_payroll_attendance_timestamp']);
								$time_in						=  $row['payroll_schedule_start'];
	   							$filler							=  (strtotime($row['payroll_schedule_start']) > strtotime($row['payroll_schedule_end'])) ? " +1 day" : "";
							    $string_sched_start				=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']); 
							    $string_sched_end				=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_end'] . $filler); 
							    $time_sched    					=  strtotime($month.'/'.$day.'/'.$year . $time_in);
							    
							    $seconds_late					=  ($row['timestamp_in'] > $string_sched_start) ? $row['timestamp_in'] - $string_sched_start : 0;
							    $count_late						=  ($row['timestamp_in'] > $string_sched_start) ? 1 : 0;
							    if($row['timestamp_in'] > $string_sched_start)
							    {
									$list['id_late'][] = $row['user_payroll_attendance_id'];
							    }
								$seconds_under_time				=  ($string_sched_end > $row['timestamp_out']) ?  $string_sched_end - $row['timestamp_out'] : 0;
								
								$min_late						=   round($seconds_late/60);
								$list['min_late']			   +=   $min_late;
								$list['count_late'] 		   +=   $count_late;
								// echo $min_late.'g<br>';
							
						}
						elseif($leave)//get leaved if approve
						{
							
						}
						else
						{
							if($curr >= $row['user_payroll_attendance_timestamp'])
							{
								$list['count_absent'] 		   	   +=   1;
							}
							
						}
				
				}//end if withing working day
				
			}
			
		}
		else
		{
				$list['min_late'] 	= 0;
				$list['count_late'] = 0;
				$list['count_absent'] = 0;
		}
		//die();
		return $list;
		
		
		
	}



	
	

	
/// user


	public function select_all_by_user_attendance_adjustment($id,$user_id,$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_attendance 
					
					INNER JOIN user ON user.user_id = user_payroll_attendance.user_id
					
					INNER JOIN payroll_attendance ON payroll_attendance.payroll_attendance_id = user_payroll_attendance.payroll_attendance_id
					
					INNER JOIN option_user_job_title ON option_user_job_title.option_user_job_title_id = user.option_user_job_title_id
					
					INNER JOIN option_department ON option_department.option_department_id = user.option_department_id
					
					INNER JOIN payroll_schedule ON payroll_schedule.payroll_schedule_id = user_payroll_attendance.payroll_schedule_id
					
					WHERE user_payroll_attendance.user_id = {$user_id}	
					
					AND payroll_attendance.payroll_cutoff_id = {$id}	
						
					{$filter}	
					
					ORDER BY 	user_payroll_attendance_id DESC		
					
					";
		//hash_dump($query,1);
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'user/template/row.attendance';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'user/template/row.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                //compute late,ob,ut======================================
				$year 											=	string_date_year($row['user_payroll_attendance_timestamp']); 
				$month 											=	string_date_month_numeric($row['user_payroll_attendance_timestamp']); 
				$day 											=	string_day($row['user_payroll_attendance_timestamp']);
	   			$filler											=  (strtotime($row['payroll_schedule_start']) > strtotime($row['payroll_schedule_end'])) ? " +1 day" : "";
				$string_sched_start								=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']); 
				$string_sched_end								=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_end'] . $filler); 
				$time_sched    									=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']);
				
				$seconds_late									=  ($row['timestamp_in'] > $string_sched_start) ? $row['timestamp_in'] - $string_sched_start : 0;
				$seconds_under_time								=  ($string_sched_end > $row['timestamp_out']) ?  $string_sched_end - $row['timestamp_out'] : 0;
				$break_duration									=  ($row['timestamp_break_in'] - $row['timestamp_break_out']); // for clarification
				$round_break_duration							=  round($break_duration/60);//minute
				$round_under_time								=  round($seconds_under_time/60);//minute
				$round_late										=  round($seconds_late/60);//minute
				$round_break_duration							=  ($round_break_duration > $row['payroll_schedule_break']) ? $round_break_duration - $row['payroll_schedule_break'] : 0;
				$row['late_class']								=  ($row['timestamp_in'] > $string_sched_start) ? 'style="background-color: #ff9999;"' : '';
				$row['ovbr_min']								=   $round_break_duration;
				$row['late_min']								=   $round_late;
				$row['untme_min']								=   $round_under_time;
				$row['user_excess_minutes']						=   $row['user_excess_minutes']+$row['user_excess_minutes_early'];
				$total_work_hours								=   $row['timestamp_out'] - $row['timestamp_in']-$break_duration;
				$total_work_minute								=   round($total_work_hours/60);
				$work_hour										=   round($total_work_minute/60);
				$work_minute									=   $total_work_minute%60;
				$row['work_hours']								=   ($work_minute > 0) ? $work_hour.':'.$work_minute : $work_hour.':00';
				//end=============================================================
                $leave											=  mvc_model('model.user_payroll_leave')->select_approve_timestamp_id($row['user_id'],$row['user_payroll_attendance_id']);
                $row['user_payroll_attendance_timestamp']    	=  string_date_day_enclosed($row['user_payroll_attendance_timestamp']);
                $row['timestamp_in']    						=  ($row['timestamp_in'] > 1) ? string_time_military($row['timestamp_in']) : 'N/A';
                $row['timestamp_out']    						=  ($row['timestamp_out'] > 1) ? string_time_military($row['timestamp_out']) : 'N/A';
                $row['timestamp_break_in']    					=  ($row['timestamp_break_in'] > 1) ? string_time_military($row['timestamp_break_in']) : 'N/A';
                $row['timestamp_break_out']    					=  ($row['timestamp_break_out'] > 1) ? string_time_military($row['timestamp_break_out']) : 'N/A';
                $row['user_']    								=  $row['user_name'].' '.$row['user_surname'];
                $ot											    =  mvc_model('model.user_payroll_ot')->select_approve_timestamp_id($row['user_id'],$row['user_payroll_attendance_id']);
				$row['ot_hour']									=  $ot['user_payroll_ot_hour']*1;
				$row['ot_min']									=   $ot['user_payroll_ot_minute']*1;
				$row['ot_min']									=   ($row['ot_min'] < 10) ? '0'.$row['ot_min'] : $row['ot_min'];
				$row['ot_label']								=   ($ot['user_payroll_ot_minute'] > 0) ? $row['ot_hour'].':'.$row['ot_min'] : $row['ot_hour'].':00';
				$timestamp_row									=  '<td align="center">'.$row['timestamp_in'].'</td> 
																    <td align="center">'.$row['timestamp_break_out'].'</td>
																    <td align="center">'.$row['timestamp_break_in'].'</td> 
																     <td align="center">'.$row['timestamp_out'].'</td>';
                if($leave)
                {
					 $leave_side_unit  					    	=  ($leave['user_payroll_leave_whole'] == 1) ? '('.$row['payroll_schedule_work_hours'] . '.0)' : '('.$leave['user_payroll_leave_duration'] . '.0)';
                	 $leave_label								=  $leave['user_payroll_leave_type_name'];
                	 if($leave['user_payroll_leave_whole'] == 1)
                	 {
						  $timestamp_row								=  '<td align="center" colspan="4"><div class="details">
																				'.$leave_label.$leave_side_unit.' 
																			</div></td>';
                	 }
                	 else
                	 {
						  $timestamp_row									=  '<td align="center">'.$row['timestamp_in'].'</td> 
																			    <td align="center" colspan="2">'.$leave_label.$leave_side_unit.'</td>
																			     <td align="center">'.$row['timestamp_out'].'</td>';
                	 }
                }
                $row['timestamp_row']							=  $timestamp_row;
				
				
                if($row['timestamp_in'] == 'N/A' || $leave)
                {
					$row['ovbr_min']								=   0;
					$row['late_min']								=   0;
					$row['untme_min']								=   0;
					$row['user_excess_minutes']						=   0;
                }
				
				$list				   							.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}




		//leaves
    public function select_all_by_cutoff_leave($id,$user_id,$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_attendance 
					
					INNER JOIN user ON user.user_id = user_payroll_attendance.user_id
					
					INNER JOIN payroll_attendance ON payroll_attendance.payroll_attendance_id = user_payroll_attendance.payroll_attendance_id
					
					INNER JOIN option_payroll_attendance_type ON option_payroll_attendance_type.option_payroll_attendance_type_id = payroll_attendance.option_payroll_attendance_type_id
					
					INNER JOIN payroll_schedule ON payroll_schedule.payroll_schedule_id = user_payroll_attendance.payroll_schedule_id
					
					WHERE payroll_attendance.payroll_cutoff_id = {$id}	
					
					AND user_payroll_attendance.user_id = {$user_id}
						
					{$filter}	
					
					ORDER BY 	user_payroll_attendance_id DESC	
					
					";
		$rows	=	sql_select($query);
		//hash_dump($rows,1);
		# Template
		$template_row		=	'user/template/row.daily_stamp_leave';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'user/template/row.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                //compute late,ob,ut======================================
				$year 											=	string_date_year($row['user_payroll_attendance_timestamp']); 
				$month 											=	string_date_month_numeric($row['user_payroll_attendance_timestamp']); 
				$day 											=	string_day($row['user_payroll_attendance_timestamp']);
	   			$filler											=  (strtotime($row['payroll_schedule_start']) > strtotime($row['payroll_schedule_end'])) ? " +1 day" : "";
				$string_sched_start								=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']); 
				$string_sched_end								=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_end'] . $filler); 
				$time_sched    									=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']);
				
				$seconds_late									=  ($row['timestamp_in'] > $string_sched_start) ? $row['timestamp_in'] - $string_sched_start : 0;
				$seconds_under_time								=  ($string_sched_end > $row['timestamp_out']) ?  $string_sched_end - $row['timestamp_out'] : 0;
				$break_duration									=  ($row['timestamp_break_in'] - $row['timestamp_break_out']); // for clarification
				$round_break_duration							=  round($break_duration/60);//minute
				$round_under_time								=  round($seconds_under_time/60);//minute
				$round_late										=  round($seconds_late/60);//minute
				$round_break_duration							=  ($round_break_duration > $row['payroll_schedule_break']) ? $round_break_duration - $row['payroll_schedule_break'] : 0;
				$row['late_class']								=  ($row['timestamp_in'] > $string_sched_start) ? 'style="background-color: #ff9999;"' : '';
				$row['ovbr_min']								=   $round_break_duration;
				$row['late_min']								=   $round_late;
				$row['untme_min']								=   $round_under_time;
				$row['user_excess_minutes']						=   $row['user_excess_minutes']+$row['user_excess_minutes_early'];
				$total_work_hours								=   $row['timestamp_out'] - $row['timestamp_in']-$break_duration;
				$total_work_minute								=   round($total_work_hours/60);
				$work_hour										=   round($total_work_minute/60);
				$work_minute									=   $total_work_minute%60;
				$row['work_hours']								=   ($work_minute > 0) ? $work_hour.':'.$work_minute : $work_hour.':00';
				//end=============================================================
                $leave											=  mvc_model('model.user_payroll_leave')->select_approve_timestamp_id($row['user_id'],$row['user_payroll_attendance_id']);
                $row['user_payroll_attendance_timestamp']    	=  string_date_day_enclosed($row['user_payroll_attendance_timestamp']);
                $row['timestamp_in']    						=  ($row['timestamp_in'] > 1) ? string_time_military($row['timestamp_in']) : 'N/A';
                $row['timestamp_out']    						=  ($row['timestamp_out'] > 1) ? string_time_military($row['timestamp_out']) : 'N/A';
                $row['timestamp_break_in']    					=  ($row['timestamp_break_in'] > 1) ? string_time_military($row['timestamp_break_in']) : 'N/A';
                $row['timestamp_break_out']    					=  ($row['timestamp_break_out'] > 1) ? string_time_military($row['timestamp_break_out']) : 'N/A';
                $row['user_']    								=  $row['user_name'].' '.$row['user_surname'];
                $ot											    =  mvc_model('model.user_payroll_ot')->select_approve_timestamp_id($row['user_id'],$row['user_payroll_attendance_id']);
				$row['ot_hour']									=  $ot['user_payroll_ot_hour']*1;
				$row['ot_min']									=   $ot['user_payroll_ot_minute']*1;
				$row['ot_min']									=   ($row['ot_min'] < 10) ? '0'.$row['ot_min'] : $row['ot_min'];
				$row['ot_label']								=   ($ot['user_payroll_ot_minute'] > 0) ? $row['ot_hour'].':'.$row['ot_min'] : $row['ot_hour'].':00';
				$timestamp_row									=  '<td align="center">'.$row['timestamp_in'].'</td> 
																    <td align="center">'.$row['timestamp_break_out'].'</td>
																    <td align="center">'.$row['timestamp_break_in'].'</td> 
																     <td align="center">'.$row['timestamp_out'].'</td>';
                if($leave)
                {
					 $leave_side_unit  					    	=  ($leave['user_payroll_leave_whole'] == 1) ? '('.$row['payroll_schedule_work_hours'] . '.0)' : '('.$leave['user_payroll_leave_duration'] . '.0)';
                	 $leave_label								=  $leave['user_payroll_leave_type_name'];
                	 if($leave['user_payroll_leave_whole'] == 1)
                	 {
						  $timestamp_row								=  '<td align="center" colspan="4"><div class="details">
																				'.$leave_label.$leave_side_unit.' 
																			</div></td>';
                	 }
                	 else
                	 {
						  $timestamp_row									=  '<td align="center">'.$row['timestamp_in'].'</td> 
																			    <td align="center" colspan="2">'.$leave_label.$leave_side_unit.'</td>
																			     <td align="center">'.$row['timestamp_out'].'</td>';
                	 }
                }
                $row['timestamp_row']							=  $timestamp_row;
				
				
                if($row['timestamp_in'] == 'N/A' || $leave)
                {
					$row['ovbr_min']								=   0;
					$row['late_min']								=   0;
					$row['untme_min']								=   0;
					$row['user_excess_minutes']						=   0;
                }
				
				$list				   							.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	//leaves
    public function select_all_by_cutoff_ot($id,$user_id,$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_attendance 
					
					INNER JOIN user ON user.user_id = user_payroll_attendance.user_id
					
					INNER JOIN payroll_attendance ON payroll_attendance.payroll_attendance_id = user_payroll_attendance.payroll_attendance_id
					
					INNER JOIN option_payroll_attendance_type ON option_payroll_attendance_type.option_payroll_attendance_type_id = payroll_attendance.option_payroll_attendance_type_id
					
					INNER JOIN payroll_schedule ON payroll_schedule.payroll_schedule_id = user_payroll_attendance.payroll_schedule_id
					
					WHERE payroll_attendance.payroll_cutoff_id = {$id}	
					
					AND user_payroll_attendance.user_id = {$user_id}
						
					{$filter}	
					
					ORDER BY 	user_payroll_attendance_id DESC	
					
					";
		$rows	=	sql_select($query);
		//hash_dump($rows,1);
		# Template
		$template_row		=	'user/template/row.daily_stamp_ot';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'user/template/row.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                //compute late,ob,ut======================================
				$year 											=	string_date_year($row['user_payroll_attendance_timestamp']); 
				$month 											=	string_date_month_numeric($row['user_payroll_attendance_timestamp']); 
				$day 											=	string_day($row['user_payroll_attendance_timestamp']);
	   			$filler											=  (strtotime($row['payroll_schedule_start']) > strtotime($row['payroll_schedule_end'])) ? " +1 day" : "";
				$string_sched_start								=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']); 
				$string_sched_end								=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_end'] . $filler); 
				$time_sched    									=  strtotime($month.'/'.$day.'/'.$year . $row['payroll_schedule_start']);
				
				$seconds_late									=  ($row['timestamp_in'] > $string_sched_start) ? $row['timestamp_in'] - $string_sched_start : 0;
				$seconds_under_time								=  ($string_sched_end > $row['timestamp_out']) ?  $string_sched_end - $row['timestamp_out'] : 0;
				$break_duration									=  ($row['timestamp_break_in'] - $row['timestamp_break_out']); // for clarification
				$round_break_duration							=  round($break_duration/60);//minute
				$round_under_time								=  round($seconds_under_time/60);//minute
				$round_late										=  round($seconds_late/60);//minute
				$round_break_duration							=  ($round_break_duration > $row['payroll_schedule_break']) ? $round_break_duration - $row['payroll_schedule_break'] : 0;
				$row['late_class']								=  ($row['timestamp_in'] > $string_sched_start) ? 'style="background-color: #ff9999;"' : '';
				$row['ovbr_min']								=   $round_break_duration;
				$row['late_min']								=   $round_late;
				$row['untme_min']								=   $round_under_time;
				$row['user_excess_minutes']						=   $row['user_excess_minutes']+$row['user_excess_minutes_early'];
				$total_work_hours								=   $row['timestamp_out'] - $row['timestamp_in']-$break_duration;
				$total_work_minute								=   round($total_work_hours/60);
				$work_hour										=   round($total_work_minute/60);
				$work_minute									=   $total_work_minute%60;
				$row['work_hours']								=   ($work_minute > 0) ? $work_hour.':'.$work_minute : $work_hour.':00';
				//end=============================================================
                $leave											=  mvc_model('model.user_payroll_leave')->select_approve_timestamp_id($row['user_id'],$row['user_payroll_attendance_id']);
                $row['user_payroll_attendance_timestamp']    	=  string_date_day_enclosed($row['user_payroll_attendance_timestamp']);
                $row['timestamp_in']    						=  ($row['timestamp_in'] > 1) ? string_time_military($row['timestamp_in']) : 'N/A';
                $row['timestamp_out']    						=  ($row['timestamp_out'] > 1) ? string_time_military($row['timestamp_out']) : 'N/A';
                $row['timestamp_break_in']    					=  ($row['timestamp_break_in'] > 1) ? string_time_military($row['timestamp_break_in']) : 'N/A';
                $row['timestamp_break_out']    					=  ($row['timestamp_break_out'] > 1) ? string_time_military($row['timestamp_break_out']) : 'N/A';
                $row['user_']    								=  $row['user_name'].' '.$row['user_surname'];
                $ot											    =  mvc_model('model.user_payroll_ot')->select_approve_timestamp_id($row['user_id'],$row['user_payroll_attendance_id']);
				$row['ot_hour']									=  $ot['user_payroll_ot_hour']*1;
				$row['ot_min']									=   $ot['user_payroll_ot_minute']*1;
				$row['ot_min']									=   ($row['ot_min'] < 10) ? '0'.$row['ot_min'] : $row['ot_min'];
				$row['ot_label']								=   ($ot['user_payroll_ot_minute'] > 0) ? $row['ot_hour'].':'.$row['ot_min'] : $row['ot_hour'].':00';
				$timestamp_row									=  '<td align="center">'.$row['timestamp_in'].'</td> 
																    <td align="center">'.$row['timestamp_break_out'].'</td>
																    <td align="center">'.$row['timestamp_break_in'].'</td> 
																     <td align="center">'.$row['timestamp_out'].'</td>';
                if($leave)
                {
					 $leave_side_unit  					    	=  ($leave['user_payroll_leave_whole'] == 1) ? '('.$row['payroll_schedule_work_hours'] . '.0)' : '('.$leave['user_payroll_leave_duration'] . '.0)';
                	 $leave_label								=  $leave['user_payroll_leave_type_name'];
                	 if($leave['user_payroll_leave_whole'] == 1)
                	 {
						  $timestamp_row								=  '<td align="center" colspan="4"><div class="details">
																				'.$leave_label.$leave_side_unit.' 
																			</div></td>';
                	 }
                	 else
                	 {
						  $timestamp_row									=  '<td align="center">'.$row['timestamp_in'].'</td> 
																			    <td align="center" colspan="2">'.$leave_label.$leave_side_unit.'</td>
																			     <td align="center">'.$row['timestamp_out'].'</td>';
                	 }
                }
                $row['timestamp_row']							=  $timestamp_row;
				
				
                if($row['timestamp_in'] == 'N/A' || $leave)
                {
					$row['ovbr_min']								=   0;
					$row['late_min']								=   0;
					$row['untme_min']								=   0;
					$row['user_excess_minutes']						=   0;
                }
				
				$list				   							.=	view_populate($row, $template_row);
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
		$sql														=	sql_insert($this->table_name, $post, 'user_payroll_attendance_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('user_payroll_attendance', $post);	
									sql_update($this->table_name, 'user_payroll_attendance_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete_entry($id_array, $user_id)
	{
		sql_delete('user_payroll_attendance', 'payroll_attendance_id', $id_array, " AND user_id=".$user_id);
	}
	
	
	  
	
}
 