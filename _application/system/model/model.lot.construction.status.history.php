<?php
class model_lot_construction_status_history
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot_construction_status_history';
		$this->message_insert	=	'A new lot has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_construction_status_history
					
					WHERE lot_construction_status_history_id = {$id}
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
					
					lot_construction_status_history
					
					INNER JOIN option_unit_status ON option_unit_status.option_unit_status_id = lot_construction_status_history.option_unit_status_id
					INNER JOIN user ON user.user_id = lot_construction_status_history.user_id
					
					WHERE lot_construction_status_history.lot_construction_id = {$id}
					
					{$filter}
					";							
		$rows	=	sql_select($query);	
		$template_row		=	'engineering/template/row.construction.status.history';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);	
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['date_complete']    		 				 =  ($row['lot_construction_date_complete'] > 0) ?string_date($row['lot_construction_date_complete']) : 'N/A';
                $row['date_start']    		 				 	 =   string_date($row['lot_construction_date_start']);
                $row['date_change']    		 				 	 =   string_date($row['lot_construction_status_history_timestamp']);
                $row['user_']    		 				 	 	 =   $row['user_name'].' '.$row['user_surname'];
				$row['lot_construction_cost_estimate']    		 =   string_amount($row['lot_construction_cost_estimate']);
				$row['lot_construction_cost_actual']    		 =  ($row['lot_construction_cost_actual'] > 0) ? string_amount($row['lot_construction_cost_actual']) : 'N/A';
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
		$data														=	sql_parse_input('lot_construction_status_history', $post);
		$data['lot_construction_status_history_timestamp']			=	time();			
		$sql														=	sql_insert($this->table_name, $data, 'lot_construction_status_history_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('lot_construction_status_history', $post);					
									sql_update($this->table_name, 'lot_construction_status_history_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
	
	
	 
	
}
 