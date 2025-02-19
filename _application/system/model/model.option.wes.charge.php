<?php
class model_option_wes_charge
{	
	
	public function __construct()
	{
		$this->table_name		=	'option_wes_charge';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					option_wes_charge
					
					
					
					WHERE option_wes_charge_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	

	public function select_all()
	{		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					option_wes_charge
					
					INNER JOIN option_wes_charge_group ON option_wes_charge_group.option_wes_charge_group_id = option_wes_charge.option_wes_charge_group_id
					
					
					ORDER BY option_wes_charge.option_wes_charge_group_id ASC
					
					";							
		$rows	=	sql_select($query);	
		$template_row		=	'finance_wes/template/row.wes_charge';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'finance_wes/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		
		if(count($rows))
		{
			foreach($rows as $row)
			{		
			    $project_charge									 =	mvc_model('model.option_wes_charge_project')->select_all($row['option_wes_charge_id']);
				
				if(count($project_charge) > 1)
				{
					$row['project_name']	= 'Multiple';
					
				}
				elseif(count($project_charge) == 1)
				{
					$row['project_name']    =  ($project_charge[0]['project_id'] > 0) ? $project_charge[0]['project_name'] : 'All Projects';
				}
				else
				{
					$row['project_name']	= 'Nothing Selected';
				}
				
				
				$row['option_wes_charge_amount']    			 =  string_amount($row['option_wes_charge_amount']);          
				$list										    .=	view_populate($row, $template_row);
				
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
		$data														=	sql_parse_input('option_wes_charge', $post);
		$data['option_wes_charge_timestamp']						=	time();			
		$sql														=	sql_insert($this->table_name, $data, 'option_wes_charge_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data													=	sql_parse_input('option_wes_charge', $post);	
																	sql_update($this->table_name, 'option_wes_charge_id', $id, $data);	
		$return['result']										=	true;
		$return['data']											=	'';
		$return['message']										=	$this->message_update;
		
	}
	
	
	
	
	 
	
}
 