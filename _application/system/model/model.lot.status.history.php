<?php
class model_lot_status_history
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot_status_history';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_status_history
					
					WHERE lot_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	

	public function select_all_by_lot($id,$filter ='')
	{		
		$id		=	string_clean_number($id);
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_status_history
					
					INNER JOIN option_availability ON option_availability.option_availability_id = lot_status_history.option_availability_id
					INNER JOIN option_lot_property_status ON option_lot_property_status.option_lot_property_status_id = lot_status_history.option_lot_property_status_id
					INNER JOIN user ON user.user_id = lot_status_history.user_id
					
					WHERE lot_status_history.lot_id = {$id}
					
					{$filter}
					";							
		$rows	=	sql_select($query);	
		$template_row		=	'engineering/template/row.lot.status.history';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);	
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['date_change']    		 				 	 =   string_date($row['lot_status_history_timestamp']);
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
		$post['lot_status_history_timestamp']						=	time();			
		$sql														=	sql_insert($this->table_name, $post, 'lot_status_history_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('lot_status_history', $post);					
									sql_update($this->table_name, 'lot_status_history_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
	
	
	 
	
}
 