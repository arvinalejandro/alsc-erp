<?php
class model_contractor_laborer
{	
	
	public function __construct()
	{
		$this->table_name		=	'contractor_laborer';
		$this->message_insert	=	'A new laborer has been successfully added.';
	}
	
# Data Select

	
	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					contractor_laborer
					
					INNER JOIN contractor ON contractor.contractor_id = contractor_laborer.contractor_id
					INNER JOIN option_gender ON option_gender.option_gender_id = contractor_laborer.option_gender_id
					inner join option_contractor_laborer_status ON option_contractor_laborer_status.option_contractor_laborer_status_id = contractor_laborer.option_contractor_laborer_status_id
					
					WHERE contractor_laborer_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
	
	public function select_all($filter = '')
	{		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					contractor_laborer
					
					INNER JOIN contractor ON contractor.contractor_id = contractor_laborer.contractor_id
					INNER JOIN option_gender ON option_gender.option_gender_id = contractor_laborer.option_gender_id
					inner join option_contractor_laborer_status ON option_contractor_laborer_status.option_contractor_laborer_status_id = contractor_laborer.option_contractor_laborer_status_id
					
					";							
		$rows	=	sql_select($query);	
		$template_row		=	'engineering_contractor/template/row.laborer.list';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering_contractor/template/row.empty';
		$template_row_empty	=	view_get_template($template_row_empty);	
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$list										    .=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	public function select_all_by_contractor($id,$filter = '')
	{		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					contractor_laborer
					
					INNER JOIN contractor ON contractor.contractor_id = contractor_laborer.contractor_id
					INNER JOIN option_gender ON option_gender.option_gender_id = contractor_laborer.option_gender_id
					inner join option_contractor_laborer_status ON option_contractor_laborer_status.option_contractor_laborer_status_id = contractor_laborer.option_contractor_laborer_status_id
					
					
					WHERE contractor_laborer.contractor_id = {$id}
					
					";							
		$rows	=	sql_select($query);	
		$template_row		=	'engineering_contractor/template/row.contractor.laborer.list';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering_contractor/template/row.empty';
		$template_row_empty	=	view_get_template($template_row_empty);	
		if(count($rows))
		{
			foreach($rows as $row)
			{		
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
		$data										=	sql_parse_input('contractor_laborer', $post);
		$data['contractor_laborer_timestamp']		=	time();			
		$sql										=	sql_insert($this->table_name, $data, 'contractor_laborer_id');				
		$return['result']							=	$sql['result'];
		$return['data']								=	$sql['data'];
		$return['message']							=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('contractor_laborer', $post);					
									sql_update($this->table_name, 'contractor_laborer_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
	
	
	 
	
}
 