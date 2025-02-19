<?php
class model_lot_wes_amount_log
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot_wes_amount_log';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select_by_reading_id($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_wes_amount_log
					
					WHERE 
					
					lot_wes_account_receive_id = {$id}
					
					LIMIT 1
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
# Modify

	public function insert($post)
	{
		$data														=	sql_parse_input('lot_wes_amount_log', $post);
		$data['lot_wes_amount_log_timestamp']						=   time();
		$sql														=	sql_insert($this->table_name, $data, 'lot_wes_amount_log_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	
	
}
 