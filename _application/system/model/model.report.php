<?php
class model_report
{	
	
	public function __construct()
	{
		$this->table_name		=	'report';
		$this->message_insert	=	'A new user has been successfully added.';
	}
	
# Data Select

	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		$query	=	"select * from report where report_id = '{$id}'";					
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
	# User Report
	public function select_avail_row($user_id)
	{
		# DB
		$user_id	=	string_clean_number($user_id);
		$query		=	"SELECT * FROM report where report_id NOT IN (select report_id from user_report where user_id = '{$user_id}')";
		$rows		=	sql_select($query);
		return $rows;
	}
	
# Get Ouput 

	public function get_row()
	{
		# DB
		$query	=	"SELECT 
						*, 
						(select (count('user_id')) from user_report where report_id = report.report_id) AS user_count 
		
					FROM report
										
					ORDER BY report.report_name ASC ";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_cms/template/row.report';
		$template_row		=	view_get_template($template_row);		
		# Parse		
		foreach($rows as $row)
		{			
			$list	.=	view_populate($row, $template_row);
		}	
		return $list;
	}
	
	# User Module
	public function get_user_report($user_id, $controller = 'edp_cms')
	{
		# DB
		$user_id	=	string_clean_number($user_id);
		$query	=	"SELECT * FROM 
						user_report 
					INNER JOIN report on 
						report.report_id = user_report.report_id 
					where user_report.user_id = {$user_id} ORDER BY report.report_name ASC";
		$rows	=	sql_select($query);
		# Template
		$template_row			=	"{$controller}/template/row.user.report";		
		$template_row_empty		=	"{$controller}/template/row.user.report.empty";
		$template_row			=	view_get_template($template_row);
		$template_row_empty		=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			# Parse		
			foreach($rows as $row)
			{								
				$row['user_report_timestamp']	=	string_date_time($row['user_report_timestamp']);				
				$list	.=	view_populate($row, $template_row);
			}	
		}
		else
		{
			$list = $template_row_empty;
		}	
		return $list;
	}  
	
	# User Report
	public function get_report_user($report_id)
	{
		# DB
		$report_id	=	string_clean_number($report_id);
		$query	=	"SELECT * FROM 
						user_report 
					INNER JOIN report on 
						report.report_id = user_report.report_id
					INNER JOIN user on
						user.user_id = user_report.user_id
					where user_report.report_id = {$report_id} ORDER BY user.user_surname ASC";
		$rows	=	sql_select($query);	
		# Template
		$template_row			=	'edp_cms/template/row.report.user';		
		$template_row_empty		=	'edp_cms/template/row.report.user.empty';
		$template_row			=	view_get_template($template_row);
		$template_row_empty		=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			# Parse		
			foreach($rows as $row)
			{								
				$row['user_report_timestamp']	=	string_date_time($row['user_report_timestamp']);				
				$list	.=	view_populate($row, $template_row);
			}	
		}
		else
		{
			$list = $template_row_empty;
		}	
		return $list;
	}
	
		
# Modify

	public function insert_user_report($post)
	{		
		$data['user_report_timestamp']	=	time();			
		$data['user_id']				=	string_clean_number($post['user_id']);			
		$data['report_id']				=	string_clean_number($post['report_id']);	
		sql_insert('user_report', $data);			
	}
	
	public function delete_user_report($id)
	{		
		$data[]							=	string_clean_number($id);
		sql_delete('user_report', 'user_report_id', $data);	
	}
	
}
  