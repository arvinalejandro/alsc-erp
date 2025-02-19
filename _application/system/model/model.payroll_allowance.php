<?php
class model_payroll_allowance
{	
	
	public function __construct()
	{
		$this->table_name		=	'payroll_allowance';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					payroll_allowance
					
						
					
					WHERE 
					
					payroll_allowance_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	public function select_all($filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					payroll_allowance 
					
					INNER JOIN option_value_type ON option_value_type.option_value_type_id = payroll_allowance.option_value_type_id
						
						
						
					{$filter}	
					
					ORDER BY 	payroll_allowance_id DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.allowance';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
               
				$row['value_']			=   ($row['option_value_type_id'] == 'fixed') ? 'P '.string_amount($row['payroll_allowance_value']) : $row['payroll_allowance_value'] . ' %';
				$list				   .=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	
	public function select_all_check_box($array='',$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					payroll_allowance
					
					INNER JOIN option_value_type ON option_value_type.option_value_type_id = payroll_allowance.option_value_type_id
						
						
						
					{$filter}	
					
					ORDER BY 	payroll_allowance_id DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.allowance_check';
		$template_row		=	view_get_template($template_row);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				
				$row['checked']			=  (in_array($row['payroll_allowance_id'],$array)) ? 'checked="checked"' : '';
				$list				   .=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}
	

	
	

	
	
# Modify

	public function insert($post)
	{
		$data														=	sql_parse_input('payroll_allowance', $post);
		$sql														=	sql_insert($this->table_name, $data, 'payroll_allowance_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('payroll_allowance', $post);					
									sql_update($this->table_name, 'payroll_allowance_id', $id, $data);	 
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete_entry($id)
	{
		sql_delete('payroll_allowance', 'payroll_allowance_id', $id);
	} 
	
	
	 
	
}
 