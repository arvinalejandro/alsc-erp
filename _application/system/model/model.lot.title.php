<?php
class model_lot_title
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot_title';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_title
					
					INNER JOIN option_lot_title_name ON option_lot_title_name.option_lot_title_name_id = lot_title.option_lot_title_name_id
					INNER JOIN option_lot_title_status ON option_lot_title_status.option_lot_title_status_id = lot_title.option_lot_title_status_id
					
					WHERE lot_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
	
# Modify

	public function insert($id)
	{
		$data['lot_id']										=	$id;
		$data['lot_title_timestamp']						=	time();			
		$sql												=	sql_insert($this->table_name, $data, 'lot_title_id');				
		$return['result']									=	$sql['result'];
		$return['data']										=	$sql['data'];
		$return['message']									=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('lot_title', $post);					
									sql_update($this->table_name, 'lot_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
}
 