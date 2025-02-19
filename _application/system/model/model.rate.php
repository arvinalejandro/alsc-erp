<?php
class model_rate
{	
	
	public function __construct()
	{
		$this->table_name		=	'rate';
		$this->message_insert	=	'A new user has been successfully added.';
	}
	
# Data Select

	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		$query	=	"SELECT * FROM rate inner join rate_dp on rate.rate_dp_id = rate_dp.rate_dp_id where rate.rate_id = '{$id}'";
					
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
# Get Ouput

	public function get_row()
	{
		# DB
		$query	=	"SELECT * FROM rate inner join rate_dp on rate.rate_dp_id = rate_dp.rate_dp_id where rate.rate_deleted = 0 ORDER BY rate.rate_id DESC";	
		$rows	=	sql_select($query);		
		
		# Template
		$template_row		=	'edp_cms/template/row.rate';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'edp_cms/template/row.rate.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{				
				#$row['user_timestamp']	=	string_date($row['user_timestamp']);
				$list	.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	# User Module
	public function get_rate_interest($rate_id)
	{
		# DB
		$rate_id	=	string_clean_number($rate_id);
		$query	=	"SELECT * FROM 
						rate_interest 
					INNER JOIN rate on 
						rate.rate_id = rate_interest.rate_id
					INNER JOIN option_dp on
						rate_interest.option_dp_id = option_dp.option_dp_id 
					where rate_interest.rate_id = {$rate_id} AND rate.rate_deleted = 0 ORDER BY rate_interest.rate_interest_value ASC";
		$rows	=	sql_select($query);
		# Template
		$template_row			=	"edp_cms/template/row.rate.interest";		
		$template_row_empty		=	"edp_cms/template/row.rate.interest.empty";
		$template_row			=	view_get_template($template_row);
		$template_row_empty		=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			# Parse		
			foreach($rows as $row)
			{							
				$row['rate_interest_value']		=	string_amount($row['rate_interest_value']);
				$row['rate_interest_rebate']	=	string_amount($row['rate_interest_rebate']);				
				$list	.=	view_populate($row, $template_row);
			}	
		}
		else
		{
			$list =  $template_row_empty;
		}	
		return $list;
	}
	
# Modify

	public function insert($post)
	{
		$data					=	sql_parse_input('rate', $post);					
		$sql					=	sql_insert($this->table_name, $data);		
		$return['result']		=	true;
		$return['data']			=	$sql;
		$return['message']		=	$this->message_insert;		
	}
	 
	public function delete($id)
	{		
		$id	=	string_clean_number($id);
		$data['rate_deleted']	=	1;
		sql_update($this->table_name, 'rate_id', $id, $data);
	}
			
	public function delete_rate_interest($id)
	{		
		$id	=	string_clean_number($id);
		$data[]	=	$id;
		sql_delete('rate_interest', 'rate_interest_id', $data);
	}
	
	
	public function insert_rate_interest($post)
	{
		$data					=	sql_parse_input('rate_interest', $post);
		$data['rate_id']		=	$post['rate_id'] * 1;		
		$sql					=	sql_insert('rate_interest', $data);					
	}
	    
}
