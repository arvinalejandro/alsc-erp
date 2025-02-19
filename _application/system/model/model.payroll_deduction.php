<?php
class model_payroll_deduction
{	
	
	public function __construct()
	{
		$this->table_name		=	'payroll_deduction';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					payroll_deduction
					
						
					
					WHERE 
					
					payroll_deduction_id = {$id}
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
					
					payroll_deduction 
					
					INNER JOIN option_value_type ON option_value_type.option_value_type_id = payroll_deduction.option_value_type_id
						
						
						
					{$filter}	
					
					ORDER BY 	payroll_deduction_id DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.deduction';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
               
				$row['value_']			=   ($row['option_value_type_id'] == 'fixed') ? 'P '.string_amount($row['payroll_deduction_value']) : $row['payroll_deduction_value'] . ' %';
				$row['payroll_deduction_value_employer'] = string_amount($row['payroll_deduction_value_employer']);
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
					
					payroll_deduction 
					
					INNER JOIN option_value_type ON option_value_type.option_value_type_id = payroll_deduction.option_value_type_id
					
					
					INNER JOIN option_deduction_type ON option_deduction_type.option_deduction_type_id = payroll_deduction.option_deduction_type_id
					
					WHERE payroll_deduction.option_deduction_type_id NOT IN('sss','philhealth')
						
						
					{$filter}	
					
					ORDER BY 	payroll_deduction_id DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.deduction_check';
		$template_row		=	view_get_template($template_row);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				
				$row['checked']			=  (in_array($row['payroll_deduction_id'],$array)) ? 'checked="checked"' : ''; 
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
		$data														=	sql_parse_input('payroll_deduction', $post);
		$sql														=	sql_insert($this->table_name, $data, 'payroll_deduction_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('payroll_deduction', $post);					
									sql_update($this->table_name, 'payroll_deduction_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
	public function delete_entry($id)
	{
		sql_delete('payroll_deduction', 'payroll_deduction_id', $id);
	} 
	
	
	 
	
}
 