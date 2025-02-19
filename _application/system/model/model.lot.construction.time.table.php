<?php
class model_lot_construction_time_table
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot_construction_time_table';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_construction_time_table
					
					INNER JOIN user ON user.user_id = lot_construction_time_table.user_id
					
					WHERE lot_construction_time_table_id = {$id}
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
					
					lot_construction_time_table
					
					INNER JOIN lot_construction ON lot_construction.lot_construction_id = lot_construction_time_table.lot_construction_id
					INNER JOIN user ON user.user_id = lot_construction_time_table.user_id
					
					WHERE lot_construction_time_table.lot_construction_id = {$id}
					
					{$filter}
					";							
		$rows	=	sql_select($query);	
		$template_row		=	'engineering/template/row.construction.time.table';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering/template/row.empty';
		$template_row_empty	=	view_get_template($template_row_empty);	
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['date_complete']    		 				 =  ($row['lot_construction_time_table_date_complete'] > 0) ?string_date($row['lot_construction_time_table_date_complete']) : 'On-going';
                $row['date_start']    		 				 	 =   string_date($row['lot_construction_time_table_date_start']);
                $row['date_log']    		 				 	 =   string_date($row['lot_construction_time_table_timestamp']);
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
		$data														=	sql_parse_input('lot_construction_time_table', $post);
		$data['lot_construction_time_table_timestamp']			=	time();			
		$sql														=	sql_insert($this->table_name, $data, 'lot_construction_time_table_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data													=	sql_parse_input('lot_construction_time_table', $post);	
		$data['lot_construction_time_table_timestamp']			=	time();						
																	sql_update($this->table_name, 'lot_construction_time_table_id', $id, $data);	
		$return['result']										=	true;
		$return['data']											=	'';
		$return['message']										=	$this->message_update;
		
	}
	
	
	
	
	 
	
}
 