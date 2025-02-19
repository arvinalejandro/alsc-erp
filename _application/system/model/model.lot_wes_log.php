<?php
class model_lot_wes_log
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot_wes_log';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_wes_log
					
						inner join lot_wes_status ON lot_wes_status.lot_wes_status_id = lot_wes_log.lot_wes_status_id
						INNER JOIN user ON user.user_id = lot_wes_log.user_id	
					
					WHERE lot_wes_id = {$id}
					
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	public function select_all($id,$type='')
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot_wes_log 
						
						inner join lot_wes_status ON lot_wes_status.lot_wes_status_id = lot_wes_log.lot_wes_status_id
						INNER JOIN user ON user.user_id = lot_wes_log.user_id				
						
					WHERE
					
					 lot_wes_id = {$id}
					 
					 ORDER BY lot_wes_log_timestamp DESC
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'engineering_wes/template/row.lot_wes_log_'.$type;
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering_wes/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['log_date']    		 =  string_date_time($row['lot_wes_log_timestamp']);
                $row['next_reading_date']    =  string_date($row['lot_wes_date_start']);
                $row['user_']    		     =   $row['user_name'].' '.$row['user_surname'];
				$list				   		.=	view_populate($row, $template_row);
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
		$data														=	sql_parse_input('lot_wes_log', $post);
		$data['lot_wes_log_timestamp']								=	time();			
		$sql														=	sql_insert($this->table_name, $data, 'lot_wes_log_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('lot_wes_log', $post);					
									sql_update($this->table_name, 'lot_wes_log_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
	
	
	 
	
}
 