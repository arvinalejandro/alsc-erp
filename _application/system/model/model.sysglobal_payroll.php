<?php
class model_sysglobal_payroll
{	
	
	public function __construct()
	{
		$this->table_name		=	'sysglobal_payroll';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select_active($filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					sysglobal_payroll
					
						
					
					WHERE 
					
					is_active = 1
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
					
					sysglobal_payroll 
					
					
					{$filter}	
					
					ORDER BY 	sysglobal_payroll_id DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.sysglobal';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.sysglobal_empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['payroll_fiscal_year_start']    				=  string_date_day_enclosed($row['payroll_fiscal_year_start']);
                 $row['is_active']    								=  ($row['is_active']== 1) ? 'Active' : 'Inactive';
                 $row['a_button']    								=  ($row['is_active']== 'Active') ? '<a class="link_button_inline gray" href="#">' : '<a class="link_button_inline blue" href="/payroll/settings/activate/&id='.$row['sysglobal_payroll_id'].'">';
				$list				   						   		.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
  
	
	
# Modify
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('sysglobal_payroll', $post);			
									sql_update($this->table_name, 'sysglobal_payroll_id', $id, $data);	 
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function insert($post)
	{
		$data														=	sql_parse_input('sysglobal_payroll', $post);	
		$data['sysglobal_payroll_timestamp']					    =   time();
		$sql														=	sql_insert($this->table_name, $data, 'sysglobal_payroll_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	
	 
	
}
 