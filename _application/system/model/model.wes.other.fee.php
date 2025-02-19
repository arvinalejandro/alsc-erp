<?php
class model_wes_other_fee
{	
	
	public function __construct()
	{
		$this->table_name		=	'wes_other_fee';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					wes_other_fee
					
					INNER JOIN user ON user.user_id = wes_other_fee.user_id
					
					WHERE wes_other_fee_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	

	public function select_all($id)
	{		
		$id		=	string_clean_number($id);
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					wes_other_fee
					
					INNER JOIN user ON user.user_id = wes_other_fee.user_id
					";							
		$rows	=	sql_select($query);	
		$template_row		=	'finance_wes/template/row.wes.other.fee';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'finance_wes/template/row.empty';
		$template_row_empty	=	view_get_template($template_row_empty);	
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$row['lot_wes_reading_id']    		 			 =   $id;          
				$row['wes_other_fee_price']    		 			 =   string_amount($row['wes_other_fee_price']);          
				$row['date_log']    		 				 	 =   string_date($row['date_logged']);
                $row['user_']    		 				 	 	 =   $row['user_name'].' '.$row['user_surname'];
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
		$data														=	sql_parse_input('wes_other_fee', $post);
		$data['date_logged']										=	time();			
		$sql														=	sql_insert($this->table_name, $data, 'wes_other_fee_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data													=	sql_parse_input('wes_other_fee', $post);	
		$data['date_logged']									=	time();						
																	sql_update($this->table_name, 'wes_other_fee_id', $id, $data);	
		$return['result']										=	true;
		$return['data']											=	'';
		$return['message']										=	$this->message_update;
		
	}
	
	
	
	
	 
	
}
 