<?php
class model_option_wes_water_rate_child
{	
	
	public function __construct()
	{
		$this->table_name		=	'option_wes_water_rate_child';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					option_wes_water_rate_child
					
					
					
					WHERE option_wes_water_rate_child_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	public function select_by_range($id,$reading=0)
	{		
		$id				=	string_clean_number($id);	
		$reading		=	string_clean_number($reading);		
		$query			=	"SELECT 
						
						* 		
					
					FROM 
					
					option_wes_water_rate_child
					
					
					
					WHERE option_wes_water_rate_id = {$id}
					
					AND	  option_wes_water_rate_child_min <= {$reading}
					
					AND   option_wes_water_rate_child_max >= {$reading}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	public function select_by_rate_id($id)
	{		
		$id		=	string_clean_number($id);
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					option_wes_water_rate_child
					
					WHERE option_wes_water_rate_id = {$id}
					  
					";							
		$rows	=	sql_select($query);	
		$template_row		=	'finance_wes/template/row.rate_child';
		$template_row		=	view_get_template($template_row);
		
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$row['type']    		 			 	 		 =  'water';          
				$row['rate_id']    		 			 	 		 =  $row['option_wes_water_rate_child_id']*1;          
				$row['main_id']    		 			 	 		 =  $row['option_wes_water_rate_id']*1;         
				$row['max']    		 			 	 			 =  ($row['option_wes_water_rate_child_max'] == 999999999999) ? 'No Maximum' : $row['option_wes_water_rate_child_max']*1;          
				$row['min']    		 			 			 	 =  $row['option_wes_water_rate_child_min']*1;          
				$row['amount']    								 =  string_amount($row['option_wes_water_rate_child_amount']);          
				$list										    .=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}
	
	
	
	
# Modify

	public function insert($post)
	{
		$data														=	sql_parse_input('option_wes_water_rate_child', $post);
		$sql														=	sql_insert($this->table_name, $data,'option_wes_water_rate_child_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data													=	sql_parse_input('option_wes_water_rate_child', $post);	
																	sql_update($this->table_name, 'option_wes_water_rate_child_id', $id, $data);	
		$return['result']										=	true;
		$return['data']											=	'';
		$return['message']										=	$this->message_update;
		
	}
	
	public function delete_entry($id)
	{
		sql_delete('option_wes_water_rate_child', 'option_wes_water_rate_child_id', $id);
	}
	
	
	
	
	 
	
}
 