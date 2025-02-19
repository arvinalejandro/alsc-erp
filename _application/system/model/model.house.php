<?php
class model_house
{	
	
	public function __construct()
	{
		$this->table_name		=	'house';
		$this->message_insert	=	'A new lot has been successfully added.';
	}
	
# Data Select

	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"select	* 	
					
					FROM house	
					
						INNER JOIN project on project.project_id = house.project_id 
						INNER JOIN option_house_classification on option_house_classification.option_house_classification_id = house.option_house_classification_id 		
					where 
						house.house_id = {$id}";										
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows; 
	}
	
	public function select_row()
	{		
		$id		=	string_clean_number($id);		
		$query	=	"select 
						* 
					from project 					
						inner join option_project_status ON option_project_status.option_project_status_id = project.option_project_status_id 				
					where project.project_id = {$id}";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	  
# Get Ouput

	public function get_row($filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM house 
						inner join project ON project.project_id = house.project_id						
						inner join option_house_classification ON option_house_classification.option_house_classification_id = house.option_house_classification_id					
					{$filter}						
					ORDER BY house.house_name DESC
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'engineering/template/row.house';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering/template/row.house.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$row['option_availability_color']	=	($row['option_availability_id'] == 1) ? 'color_green' : 'color_red';
				$row['house_price']		=	string_amount($row['house_price']);
				$list								.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	public function get_lot_price_row($id)
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM house_price 
						inner join user ON user.user_id = house_price.user_id									
						inner join house ON house.house_id = house_price.house_id	
					WHERE house_price.house_id = '{$id}'								
					ORDER BY house_price.house_price_timestamp DESC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_inventory/template/row.house.price';
		$template_row		=	view_get_template($template_row);
		#$template_row_empty	=	'edp_inventory/template/row.lot.empty';
		#$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				
				$row['house_price_value']	=	string_amount($row['house_price_value']);
				$row['house_price_timestamp']	=	string_date_time($row['house_price_timestamp']);
				$list					.=	view_populate($row, $template_row);
			}			
		}		
		return $list;
	}
	
	
	
# Modify

	public function insert($post, $user_id)
	{
		$data							=	sql_parse_input($this->table_name, $post);
		$data['house_timestamp']		=	time();			
		$sql							=	sql_insert($this->table_name, $data, 'house_id');				
											$this->_insert_house_price($sql['data'], $user_id);											
		$return['result']				=	$sql['result'];
		$return['data']					=	$sql['data'];
		$return['message']				=	$sql['message'];		
		return $return;
	}
	
	private function _insert_house_price($post, $id)
	{		
		$data['house_price_timestamp']		=	time();
		$data['house_id']					=	$post['house_id'] * 1;		
		$data['user_id']					=	$id  * 1;
		$data['house_price_value']			=	$post['house_price']  * 1;
		sql_insert('house_price', $data);
	}
	 
	public function update($post, $id, $user_id)
	{
		$data					=	sql_parse_input('house', $post);							
									sql_update($this->table_name, 'house_id', $id, $data);	
		$data['house_id']		=	$id;										
		if($post['house_price'] != $data['house_price'])
		{
			$this->_insert_house_price($data, $user_id);		
		}
		
	}
	
	
	 
	
}
