<?php
class model_user_payroll_bonus
{	
	
	public function __construct()
	{
		$this->table_name		=	'user_payroll_bonus';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select_by_cutoff_id_user($c_id,$id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_bonus
					
					INNER JOIN payroll_bonus ON payroll_bonus.payroll_bonus_id = user_payroll_bonus.payroll_bonus_id
					
						
					WHERE 
					
					user_id = {$id}
					
					AND
					
					user_payroll_bonus.payroll_cutoff_id = {$c_id}
					";							
		$rows	=	sql_select($query);	
		return $rows;
	}
	
	
	
	
	
		public function select_all_by_fiscal_id_user($sp_id,$id,$filter = '')
	{		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					user_payroll_bonus
					
					INNER JOIN payroll_bonus ON payroll_bonus.payroll_bonus_id = user_payroll_bonus.payroll_bonus_id
					INNER JOIN payroll_cutoff ON payroll_cutoff.payroll_cutoff_id = user_payroll_bonus.payroll_cutoff_id
					
					WHERE 
					
					user_id = {$id}
					
					AND
					
					user_payroll_bonus.sysglobal_payroll_id = {$sp_id}
					
					
					
					";							
		$rows				=	sql_select($query);	
		$template_row		=	'payroll/template/row.user_bonus';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.empty_user_bonus';
		$template_row_empty	=	view_get_template($template_row_empty); 
		//hash_dump($query,1);
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['payroll_cutoff_date_start']    			=  string_date_day($row['payroll_cutoff_date_start']);
                $row['payroll_cutoff_date_end']    				=  string_date_day($row['payroll_cutoff_date_end']);
                $row['user_payroll_bonus_date_approved']    	=  string_date_day($row['user_payroll_bonus_date_approved']);
                $row['user_payroll_bonus_amount']    			=  string_amount($row['user_payroll_bonus_amount']);
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
		$data														=	sql_parse_input('user_payroll_bonus', $post);	
		$sql														=	sql_insert('user_payroll_bonus', $data, 'user_payroll_bonus_id');			
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id) 
	{
		$data					=	sql_parse_input('user_payroll_bonus', $post);					
									sql_update($this->table_name, 'user_payroll_bonus_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete_entry($id)
	{
		sql_delete('user_payroll_bonus', 'user_payroll_bonus_id', $id);
	}
	
	
	  
	
}
 