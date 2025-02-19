<?php
class model_option_wes_electric_rate
{	
	
	public function __construct()
	{
		$this->table_name		=	'option_wes_electric_rate';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					option_wes_electric_rate
					
					
					
					WHERE option_wes_electric_rate_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	

	public function select_all()
	{		
		$id		=	string_clean_number($id);
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					option_wes_electric_rate
					
					";							
		$rows	=	sql_select($query);	
		$template_row		=	'finance_wes/template/row.rate';
		$template_row		=	view_get_template($template_row);
		
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				
				$project_charge									 =	mvc_model('model.option.wes.electric.rate.project')->select_all($row['option_wes_electric_rate_id']);
				
				if(count($project_charge) > 1)
				{
					$row['project_name']	= 'Multiple';
					
				}
				elseif(count($project_charge) == 1)
				{
					$row['project_name']    =  ($project_charge[0]['project_id'] > 0) ? $project_charge[0]['project_name'] : 'All Projects';
				}
				else
				{
					$row['project_name']	= 'Nothing Selected';
				}
				
				
				$row['rate_id']    		    					 =  $row['option_wes_electric_rate_id'];          
				$row['wes_type']    		 			 		 =  'electric';          
				$row['days_due']    		 			 		 =  $row['option_wes_electric_rate_due_day']*1;  
				$row['days_due_disc']    		 			 	 =  $row['option_wes_electric_rate_day_limit']*1;  
				$row['name']    		 			 			 =  $row['option_wes_electric_rate_name'];         
				$row['amount']    								 =  string_amount($row['option_wes_electric_rate_amount']);          
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
		$data														=	sql_parse_input('option_wes_electric_rate', $post);
		$data['option_wes_electric_rate_timestamp']					=	time();			
		$sql														=	sql_insert($this->table_name, $data, 'option_wes_electric_rate_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data													=	sql_parse_input('option_wes_electric_rate', $post);	
																	sql_update($this->table_name, 'option_wes_electric_rate_id', $id, $data);	
		$return['result']										=	true;
		$return['data']											=	'';
		$return['message']										=	$this->message_update;
		
	}
	
	
	
	
	 
	
}
 