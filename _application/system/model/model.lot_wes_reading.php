<?php
class model_lot_wes_reading
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot_wes_reading';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_wes_reading
					
						inner join lot_wes ON lot_wes.lot_wes_id = lot_wes_reading.lot_wes_id	
						inner join lot ON lot.lot_id = lot_wes.lot_id
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id					
						inner join client_account ON client_account.lot_id = lot.lot_id	 AND 	client_account.option_account_status_id != 'ejected'
						inner join client ON client.client_id = client_account.client_id				
						inner join lot_wes_status ON lot_wes_status.lot_wes_status_id = lot_wes.lot_wes_status_id		
						inner join lot_wes_reading_status ON lot_wes_reading_status.lot_wes_reading_status_id = lot_wes_reading.lot_wes_reading_status_id	
						left join lot_wes_demand_letter_status ON lot_wes_demand_letter_status.lot_wes_demand_letter_status_id = lot_wes_reading.lot_wes_demand_letter_status_id	
						
					
					WHERE 
					
					lot_wes_reading.lot_wes_reading_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
	public function select_by_type($id,$type='',$filter = '')
	{		
		if($type == 'water')
		{
			$option_join = " inner join option_wes_water_rate ON option_wes_water_rate.option_wes_water_rate_id = lot_wes.option_wes_water_rate_id ";
		}
		else
		{
			$option_join = " inner join option_wes_electric_rate ON option_wes_electric_rate.option_wes_electric_rate_id = lot_wes.option_wes_electric_rate_id ";
		}
		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_wes_reading
					
						inner join lot_wes ON lot_wes.lot_wes_id = lot_wes_reading.lot_wes_id	
						inner join lot ON lot.lot_id = lot_wes.lot_id
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id					
						inner join client_account ON client_account.lot_id = lot.lot_id	 AND 	client_account.option_account_status_id != 'ejected'
						inner join client ON client.client_id = client_account.client_id				
						inner join lot_wes_status ON lot_wes_status.lot_wes_status_id = lot_wes.lot_wes_status_id		
						inner join lot_wes_reading_status ON lot_wes_reading_status.lot_wes_reading_status_id = lot_wes_reading.lot_wes_reading_status_id	
						{$option_join}	
						
					
					WHERE 
					
					lot_wes_reading.lot_wes_reading_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
	public function select_water_billing($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_wes_reading
					
						inner join lot_wes ON lot_wes.lot_wes_id = lot_wes_reading.lot_wes_id	
						inner join lot_wes_account_receive ON lot_wes_account_receive.lot_wes_reading_id = lot_wes_reading.lot_wes_reading_id	
						inner join lot ON lot.lot_id = lot_wes.lot_id
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id					
						inner join client_account ON client_account.lot_id = lot.lot_id	 AND 	client_account.option_account_status_id != 'ejected'
						inner join client ON client.client_id = client_account.client_id				
						inner join lot_wes_status ON lot_wes_status.lot_wes_status_id = lot_wes.lot_wes_status_id		
						inner join lot_wes_reading_status ON lot_wes_reading_status.lot_wes_reading_status_id = lot_wes_reading.lot_wes_reading_status_id		
						
						inner join option_wes_water_rate ON option_wes_water_rate.option_wes_water_rate_id = lot_wes.option_wes_water_rate_id		
							
						
					
					WHERE 
					
					lot_wes_reading.lot_wes_reading_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
	public function get_by_lot_wes_id($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_wes_reading
					
					WHERE 
					
					lot_wes_id = {$id}
					
					{$filter}
					
					ORDER BY lot_wes_reading_timestamp DESC
					
					LIMIT 1
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	public function select_all($type='',$dept='engineering',$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot_wes_reading 
						
						inner join lot_wes ON lot_wes.lot_wes_id = lot_wes_reading.lot_wes_id	
						inner join lot ON lot.lot_id = lot_wes.lot_id
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id					
						inner join client_account ON client_account.lot_id = lot.lot_id	 AND 	client_account.option_account_status_id != 'ejected'
						inner join client ON client.client_id = client_account.client_id				
						inner join lot_wes_status ON lot_wes_status.lot_wes_status_id = lot_wes.lot_wes_status_id	
						inner join lot_wes_reading_status ON lot_wes_reading_status.lot_wes_reading_status_id = lot_wes_reading.lot_wes_reading_status_id
						
					WHERE 	lot_wes_reading.lot_wes_type = '{$type}'	
						
					{$filter}	
					
					ORDER BY 	lot_wes_reading_timestamp DESC		
					
					";
		
		$rows	=	sql_select($query);
		# Template
		$template_row		=	$dept.'_wes/template/row.lot_wes_reading_'.$type;
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	$dept.'_wes/template/row.reading.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                 $row['client_name']    		 	=  $row['client_name'] .' '. $row['client_surname'] ;
                $row['log_date']    				=  string_date($row['lot_wes_reading_timestamp']);
                $row['lot_wes_reading_date']    	=  string_date($row['lot_wes_reading_date']);
                $row['lot_wes_curr_reading']    	=  ($row['lot_wes_curr_reading'] > 0) ?  $row['lot_wes_curr_reading'] : 'N/A';
				$list				   			   .=  view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	public function select_all_demand_letter($filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot_wes_reading 
						
						inner join lot_wes ON lot_wes.lot_wes_id = lot_wes_reading.lot_wes_id	
						inner join lot ON lot.lot_id = lot_wes.lot_id
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id					
						inner join client_account ON client_account.lot_id = lot.lot_id	 AND 	client_account.option_account_status_id != 'ejected'
						inner join client ON client.client_id = client_account.client_id				
						inner join lot_wes_status ON lot_wes_status.lot_wes_status_id = lot_wes.lot_wes_status_id	
						inner join lot_wes_reading_status ON lot_wes_reading_status.lot_wes_reading_status_id = lot_wes_reading.lot_wes_reading_status_id
						inner join lot_wes_demand_letter_status ON lot_wes_demand_letter_status.lot_wes_demand_letter_status_id = lot_wes_reading.lot_wes_demand_letter_status_id
						
					WHERE 	lot_wes_reading.lot_wes_demand_letter_status_id != '0'	
						
					{$filter}	
					
					ORDER BY 	lot_wes_reading_timestamp DESC		
					
					";
		
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'engineering_wes/template/row.demand_letter';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering_wes/template/row.reading.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                 $row['client_name']    		 	=  $row['client_name'] .' '. $row['client_surname'] ;
                $row['log_date']    				=  string_date($row['lot_wes_reading_timestamp']);
                $row['lot_wes_reading_date']    	=  string_date($row['lot_wes_reading_date']);
                $row['lot_wes_reading_due_date']    =  string_date($row['lot_wes_reading_due_date']);
                $row['lot_wes_curr_reading']    	=  ($row['lot_wes_curr_reading'] > 0) ?  $row['lot_wes_curr_reading'] : 'N/A';
				$list				   			   .=  view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	public function select_all_by_account($id,$type='water',$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot_wes_reading 
						
						inner join lot_wes ON lot_wes.lot_wes_id = lot_wes_reading.lot_wes_id	
						inner join lot ON lot.lot_id = lot_wes.lot_id
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id					
						inner join client_account ON client_account.lot_id = lot.lot_id	 AND 	client_account.option_account_status_id != 'ejected'
						inner join client ON client.client_id = client_account.client_id				
						inner join lot_wes_status ON lot_wes_status.lot_wes_status_id = lot_wes.lot_wes_status_id	
						inner join lot_wes_reading_status ON lot_wes_reading_status.lot_wes_reading_status_id = lot_wes_reading.lot_wes_reading_status_id
						
					WHERE 	lot_wes.lot_wes_id = {$id}	
						
					{$filter}	
					
					ORDER BY 	lot_wes_reading_timestamp DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'finance_wes/template/row.reading_history_'.$type;
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'finance_wes/template/row.reading.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                 $row['client_name']    		 	=  $row['client_name'] .' '. $row['client_surname'] ;
                $row['log_date']    				=  string_date($row['lot_wes_reading_timestamp']);
                $row['lot_wes_reading_date']    	=  string_date($row['lot_wes_reading_date']);
                $row['lot_wes_curr_reading']    	=  ($row['lot_wes_curr_reading'] > 0) ?  $row['lot_wes_curr_reading'] : 'N/A';
				$list				   			   .=  view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	public function select_all_overdue()
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot_wes_reading 
						
						inner join lot_wes ON lot_wes.lot_wes_id = lot_wes_reading.lot_wes_id	
						inner join lot ON lot.lot_id = lot_wes.lot_id
						
					WHERE 	lot_wes.lot_wes_id = {$id}	
						
					lot_wes_reading_status_id != 'paid'
					
					ORDER BY 	lot_wes_reading_timestamp DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		
		return $rows;
	}
	
//reports	
		public function select_reading_due_accounts($type='',$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot_wes_reading 
						
						inner join lot_wes ON lot_wes.lot_wes_id = lot_wes_reading.lot_wes_id	
						inner join lot ON lot.lot_id = lot_wes.lot_id
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id					
						inner join client_account ON client_account.lot_id = lot.lot_id	 AND 	client_account.option_account_status_id != 'ejected'
						inner join client ON client.client_id = client_account.client_id				
						
					WHERE 	lot_wes_reading.lot_wes_type = '{$type}'	
					
					AND lot_wes_reading.lot_wes_reading_status_id = 'pending'
						
					{$filter}	
					
					ORDER BY 	lot_wes_reading_timestamp DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'engineering_wes/template/row.lot_wes_reading_list_'.$type;
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering_wes/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			$i = 1;
			foreach($rows as $row)
			{		
                $row['client_name']    		 		=  $row['client_name'] .' '. $row['client_surname'] ;
                $row['i_count']						=  $i;
				$list				   			   .=  view_populate($row, $template_row);
				$i++;
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
		$data														=	sql_parse_input('lot_wes_reading', $post);
		$data['lot_wes_reading_timestamp']							=	time();			
		$sql														=	sql_insert($this->table_name, $data, 'lot_wes_reading_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('lot_wes_reading', $post);					
									sql_update($this->table_name, 'lot_wes_reading_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
	 
	
}
 