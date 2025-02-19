<?php
class model_lot_construction_payment
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot_construction_payment';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_construction_payment
					
					WHERE lot_construction_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	

	public function select_all_by_construction($id,$filter ='')
	{		
		$id		=	string_clean_number($id);
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_construction_payment
					
					INNER JOIN lot_construction ON lot_construction.lot_construction_id = lot_construction_payment.lot_construction_id
					INNER JOIN contractor ON contractor.contractor_id = lot_construction.contractor_id
					
					WHERE lot_construction_payment.lot_construction_id = {$id}
					
					{$filter}
					";							
		$rows	=	sql_select($query);	
		//  hash_dump($query,true);
		$template_row		=	'engineering/template/row.construction.payment';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);	
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['lot_construction_payment_date_paid']    	 =   string_date($row['lot_construction_payment_date_paid']);
				$row['lot_construction_payment_amount']    		 =   string_amount($row['lot_construction_payment_amount']);
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
		$data														=	sql_parse_input('lot_construction_payment', $post);
		$data['lot_construction_payment_timestamp']					=	time();			
		$sql														=	sql_insert($this->table_name, $data, 'lot_construction_payment_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('lot_construction_payment', $post);					
									sql_update($this->table_name, 'lot_construction_payment_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
	
	
	 
	
}
 