<?php
class model_lot_wes_reading_other_fee
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot_wes_reading_other_fee';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select_all($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_wes_reading_other_fee
					
					inner join option_wes_charge on option_wes_charge.option_wes_charge_id = lot_wes_reading_other_fee.option_wes_charge_id
					
					WHERE lot_wes_reading_id = {$id}
					";							
		$rows	=	sql_select($query);	
		return $rows;
	}
	

	
	
# Modify

	public function insert($post)
	{
		$data														=	sql_parse_input('lot_wes_reading_other_fee', $post);
		$sql														=	sql_insert($this->table_name, $data, 'lot_wes_reading_other_fee_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	
	
}
 