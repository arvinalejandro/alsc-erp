<?php
class model_lot_wes_reading_invoice
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot_wes_reading_invoice';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function check_unsettled($id)
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_wes_reading_invoice
					
					inner join client_account_invoice on client_account_invoice.client_account_invoice_id = lot_wes_reading_invoice.client_account_invoice_id
					inner join lot_wes_reading on lot_wes_reading.lot_wes_reading_id = lot_wes_reading_invoice.lot_wes_reading_id
						
					WHERE 
					
					lot_wes_reading.lot_wes_id = {$id}
					
					AND client_account_invoice.option_invoice_status_id = 'pending'
					
					LIMIT 1
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	public function select_by_reading_id($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_wes_reading_invoice
					
					inner join client_account_invoice on client_account_invoice.client_account_invoice_id = lot_wes_reading_invoice.client_account_invoice_id
						
					WHERE 
					
					lot_wes_reading_id = {$id}
					
					LIMIT 1
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
# Modify

	public function insert($post)
	{
		$data														=	sql_parse_input('lot_wes_reading_invoice', $post);
		$sql														=	sql_insert($this->table_name, $data, 'lot_wes_reading_invoice_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	
	
}
 