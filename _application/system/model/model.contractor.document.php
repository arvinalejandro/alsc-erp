<?php
class model_contractor_document
{	
	
	public function __construct()
	{
		$this->table_name		=	'contractor_document';
		$this->message_insert	=	'A new laborer has been successfully added.';
	}
	
# Data Select

	
	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					contractor_document
					
					INNER JOIN contractor ON contractor.contractor_id = contractor_document.contractor_id
					INNER JOIN contractor_document_type ON contractor_document_type.contractor_document_type_id = contractor_document.contractor_document_type_id
					
					WHERE contractor_document_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	

	
	public function select_all_by_contractor($id,$filter = '')
	{		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					contractor_document
					
					INNER JOIN contractor ON contractor.contractor_id = contractor_document.contractor_id
					INNER JOIN contractor_document_type ON contractor_document_type.contractor_document_type_id = contractor_document.contractor_document_type_id
					
					WHERE contractor_document.contractor_id = {$id}
					
					";							
		$rows	=	sql_select($query);	
		$template_row		=	'engineering_contractor/template/row.contractor.document.list';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering_contractor/template/row.empty';
		$template_row_empty	=	view_get_template($template_row_empty);	
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$row['date_submit']    		 =  ($row['contractor_document_date_submit'] > 0) ?string_date($row['contractor_document_date_submit']) : 'N/A';
				$row['date_expire']    		 =  ($row['contractor_document_date_expire'] > 0) ?string_date($row['contractor_document_date_expire']) : 'N/A';
				$list					    .=	view_populate($row, $template_row);
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
		$data										=	sql_parse_input('contractor_document', $post);
		$data['contractor_document_timestamp']		=	time();			
		$sql										=	sql_insert($this->table_name, $data, 'contractor_document_id');				
		$return['result']							=	$sql['result'];
		$return['data']								=	$sql['data'];
		$return['message']							=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('contractor_document', $post);					
									sql_update($this->table_name, 'contractor_document_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
	
	
	 
	
}
 