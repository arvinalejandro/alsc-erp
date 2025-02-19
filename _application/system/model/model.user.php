<?php
class model_user 
{	
	
	public function __construct()
	{
		$this->table_name		=	'user';
		$this->message_insert	=	'A new user has been successfully added.';
	}
	
# Data Select

	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		$query	=	"
					select * from user
					 	
					LEFT JOIN option_user_status ON
						user.option_user_status_id = option_user_status.option_user_status_id
					LEFT JOIN option_department ON
						user.option_department_id = option_department.option_department_id
						
					 INNER JOIN option_user_job_title ON option_user_job_title.option_user_job_title_id = user.option_user_job_title_id
					 
					  INNER JOIN option_user_level ON option_user_level.option_user_level_id = user.option_user_level_id
					  
					  INNER JOIN payroll_schedule ON
						payroll_schedule.payroll_schedule_id = user.payroll_schedule_id
					  						
					where user.user_id = '{$id}' AND user.user_deleted = 0 {$filter}"; 
					
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
	
//Payroll

	public function select_all_payroll($filter = '')
	{		
		$id		=	string_clean_number($id);
		$query	=	"
					select * from user
					 	
					INNER JOIN payroll_schedule ON
						payroll_schedule.payroll_schedule_id = user.payroll_schedule_id
					
						
					WHERE  user.user_deleted = 0 
					 
					AND  user.option_user_status_id = 'enabled'
					
					{$filter}
					
					";
					
		$rows	=	sql_select($query);		
		return $rows;
	}
	
	
	public function select_all_summary($filter = '')
	{		
		$id		=	string_clean_number($id);
		$query	=	"
					select 
					
					SUM(CASE WHEN option_user_status_id = 'enabled'  THEN 1 ELSE 0 END) AS active_count,
					SUM(CASE WHEN option_user_status_id = 'disabled'   THEN 1 ELSE 0 END) AS inactive_count
					
					
					from user
					 	
						
					WHERE  user.user_deleted = 0 
					
					{$filter}
					
					";
					
		$rows	=	sql_select($query);		
		return $rows[0];
	}
	
//for chat	
	public function select_user($filter = '',$user_id)
	{		
		$id		=	string_clean_number($id);
		$query	=	"
					select 
					
					* ,ROUND (   
						(
						    LENGTH(CONCAT_WS('',user_name,user_surname))
						    - LENGTH( REPLACE ( LOWER(CONCAT_WS('',user_name,user_surname)), '{$filter}', '') ) 
						) / LENGTH('{$filter}')        
					) AS s_count
					
					from
					
					 user
					
					INNER JOIN option_department ON option_department.option_department_id = user.option_department_id
					 	
					where CONCAT_WS('',user_name,user_surname) LIKE '%{$filter}%'
					
					AND user_id NOT IN({$user_id})
					
					ORDER BY s_count DESC
					
					";
		$rows	=	sql_select($query);		
		return $rows;
	}
	
	public function select_convo_label($user_id,$group_id)
	{		
		$id		=	string_clean_number($id);
		$query	=	"
					SELECT count(user_id) as participant_count, GROUP_CONCAT(DISTINCT concat(user_name,' ', user_surname) SEPARATOR  ', ') AS con_label FROM user 
                           
                    WHERE user_id IN(SELECT user_id FROM message_group_user WHERE user_id  != {$user_id}
                     AND message_group_id = {$group_id})
					
					";
		$rows	=	sql_select($query);		
		return $rows[0];
	}
	
	public function select_convo_users($group_id)
	{		
		$id		=	string_clean_number($id);
		$query	=	"
					SELECT  concat(user_name,' ', user_surname) user_full FROM user 
                           
                    WHERE user_id IN(SELECT user_id FROM message_group_user WHERE message_group_id = {$group_id})
					
					";
		$rows	=	sql_select($query);		
		return $rows;
	}
	
# Get Ouput

	public function get_row()
	{
		# DB
		$query	=	"SELECT 
		
					* 
					
					FROM
					
					 user 
					 
					 LEFT JOIN option_user_status ON
						user.option_user_status_id = option_user_status.option_user_status_id
		
						where user.user_deleted = 0 ORDER BY user.user_id DESC";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_cms/template/row.user';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'edp_cms/template/row.user.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{
				$row['time']			=	string_date(time());
				$row['user_timestamp']	=	string_date($row['user_timestamp']);
				$list	.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
//payroll	
	public function get_all_employee()
	{
		# DB
		$query	=	"SELECT 
		
						* 
		
		             FROM user 
		             
		             INNER JOIN option_department ON option_department.option_department_id = user.option_department_id
		             
		             INNER JOIN option_user_job_title ON option_user_job_title.option_user_job_title_id = user.option_user_job_title_id
		             
		             INNER JOIN option_user_status ON option_user_status.option_user_status_id = user.option_user_status_id
		             
		             INNER JOIN payroll_schedule ON payroll_schedule.payroll_schedule_id = user.payroll_schedule_id
						
					where 	
					
					user.user_deleted = 0 ORDER BY user.user_id DESC";
		
		
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.employee';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.employee_empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{
				
				if($row['user_hire_date'] > 500000)
    			{
    				$tenure					=  string_check_diff_date_current($row['user_hire_date']);
    				$row['user_hire_date']	= string_date_day_enclosed($row['user_hire_date']);
    				if($tenure['y'] > 0)
    				{
						if($tenure['m'] > 0)
						{
							$row['tenure']	 = $tenure['y'].' year/s & '.$tenure['m'].' month/s';
						}
						else
						{
							$row['tenure']	 = $tenure['y'].' year/s';
						}
    				}
    				else
    				{
							$row['tenure']	 = $tenure['m'].' month/s';
    				}
				}
				else
				{
					$row['user_hire_date'] 	= 'N/A';
					$row['tenure']			= 'N/A';
				}
				
				
				$active_fiscal						 			=	mvc_model('model.user_payroll_attendance')->check_if_active_fiscal($row['user_id']);
				$row['payroll_status']							=  ($active_fiscal) ? 'Payroll Ready' : 'No Daily Stamp Records';
				$list											.=	view_populate($row, $template_row);
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
		$data					=	sql_parse_input('user', $post);		
		$data['user_timestamp']	=	time();			
		$sql					=	sql_insert('user', $data,'user_id');		
		$return['result']		=	true;
		$return['data']			=	$sql;
		$return['message']		=	$this->message_insert;	
		return $return;	
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('user', $post);					
									sql_update($this->table_name, 'user_id', $id, $data);		
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	  
	public function delete($id)
	{		
		$id	=	string_clean_number($id);
		$data['user_deleted']	=	1;
		sql_update($this->table_name, 'user_id', $id, $data);
	} 
	 
	public function login($username, $password)
	{
		$username_c	=	string_clean($username);
		$password_c	=	string_clean($password);
		
		$query		=	"select * from user where user_username	= '{$username_c}'";		
		$row		=	sql_select($query);
		$row		=	$row[0];
		
		if(count($row))
		{
			if($row['user_username'] == $username_c && $row['user_password'] == $password)
			{
				$result		=	true;
				$message	=	'Success';
				$data		=	$row;
			}
			else
			{
				$result		=	false;
				$message	=	'Invalid Username or Password';
				$data		=	null;
			}
			
		}
		else
		{
			$result		=	false;
			$message	=	'Invalid Username or Password';
			$data		=	null;
		}
		
		$return['result']		=	$result;
		$return['data']			=	$data;
		$return['message']		=	$message;
		
		return $return;
	}
	 
	
}
