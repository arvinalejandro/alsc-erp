<?php
class model_contractor
{	
	
	public function __construct()
	{
		$this->table_name		=	'contractor';
		$this->message_insert	=	'A new lot has been successfully added.';
	}
	
# Data Select

	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		$query	=	"SELECT 
						
						*,
						(
							SELECT SUM(CASE WHEN lot_construction.option_unit_status_id IN ('for_approval', 'for_costing','ongoing') THEN  1 ELSE 0 END) 
					
							FROM lot_construction 
						
							WHERE lot_construction.contractor_id = contractor.contractor_id
							
							) as ongoing_count 	
						,
						(
							SELECT SUM(CASE WHEN lot_construction.option_unit_status_id IN ('ready') THEN  1 ELSE 0 END) 
					
							FROM lot_construction 
						
							WHERE lot_construction.contractor_id = contractor.contractor_id
							
							) as completed_count	
					
					FROM 
					
					contractor
					
					INNER JOIN option_contractor_status ON option_contractor_status.option_contractor_status_id = contractor.option_contractor_status_id
					INNER JOIN option_contractor_type ON option_contractor_type.option_contractor_type_id = contractor.option_contractor_type_id
					
					WHERE contractor_id = {$id}
					
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
	public function select_all($filter = '')
	{		
		$query	=	"SELECT 
						
						*,
						(
							SELECT SUM(CASE WHEN lot_construction.option_unit_status_id IN ('for_approval', 'for_costing','ongoing') THEN  1 ELSE 0 END) 
					
							FROM lot_construction 
						
							WHERE lot_construction.contractor_id = contractor.contractor_id
							
							) as ongoing_count 	
						,
						(
							SELECT SUM(CASE WHEN lot_construction.option_unit_status_id IN ('ready') THEN  1 ELSE 0 END) 
					
							FROM lot_construction 
						
							WHERE lot_construction.contractor_id = contractor.contractor_id
							
							) as completed_count	
					
					FROM 
					
					contractor
					
					INNER JOIN option_contractor_status ON option_contractor_status.option_contractor_status_id = contractor.option_contractor_status_id
					INNER JOIN option_contractor_type ON option_contractor_type.option_contractor_type_id = contractor.option_contractor_type_id
					
					
					
					";							
		$rows	=	sql_select($query);	
		$template_row		=	'engineering_contractor/template/row.contractors';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering_contractor/template/row.empty';
		$template_row_empty	=	view_get_template($template_row_empty);	
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$row['completed_count']							 =  ($row['completed_count'])? $row['completed_count'] : 0 ;
				$row['ongoing_count']							 =  ($row['ongoing_count'])? $row['ongoing_count'] : 0 ;
				$row['total_count']								 =  $row['completed_count'] + $row['ongoing_count'];
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
		$data										=	sql_parse_input('contractor', $post);
		$data['contractor_timestamp']				=	time();			
		$sql										=	sql_insert($this->table_name, $data, 'contractor_id');				
		$return['result']							=	$sql['result'];
		$return['data']								=	$sql['data'];
		$return['message']							=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('contractor', $post);					
									sql_update($this->table_name, 'contractor_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
	
	
	 
	
}
 