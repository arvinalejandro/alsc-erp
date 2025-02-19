<?php
class model_lot_construction_document
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot_construction_document';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_construction_document
					
					INNER JOIN lot_construction ON lot_construction.lot_construction_id = lot_construction_document.lot_construction_id
					INNER JOIN lot_construction_document_type ON lot_construction_document_type.lot_construction_document_type_id = lot_construction_document.lot_construction_document_type_id
					
					WHERE lot_construction_document_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	

	
	public function select_all_by_construction($id,$filter = '')
	{		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_construction_document
					
					INNER JOIN lot_construction ON lot_construction.lot_construction_id = lot_construction_document.lot_construction_id
					INNER JOIN lot_construction_document_type ON lot_construction_document_type.lot_construction_document_type_id = lot_construction_document.lot_construction_document_type_id
					
					WHERE lot_construction_document.lot_construction_id = {$id}
					
					";							
		$rows	=	sql_select($query);	
		$template_row		=	'engineering/template/row.construction.document.list';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering/template/row.empty';
		$template_row_empty	=	view_get_template($template_row_empty);	
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$row['date_submit']    		 =  ($row['lot_construction_document_date_submit'] > 0) ?string_date($row['lot_construction_document_date_submit']) : 'N/A';
				$row['date_expire']    		 =  ($row['lot_construction_document_date_expire'] > 0) ?string_date($row['lot_construction_document_date_expire']) : 'N/A';
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
		$data												=	sql_parse_input('lot_construction_document', $post);
		$data['lot_construction_document_timestamp']		=	time();			
		$sql												=	sql_insert($this->table_name, $data, 'lot_construction_document_id');				
		$return['result']									=	$sql['result'];
		$return['data']										=	$sql['data'];
		$return['message']									=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('lot_construction_document', $post);					
									sql_update($this->table_name, 'lot_construction_document_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
	
	
	 
	
}
 