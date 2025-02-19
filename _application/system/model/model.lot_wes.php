<?php
class model_lot_wes
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot_wes';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	
	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_wes
					
						inner join lot ON lot.lot_id = lot_wes.lot_id
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id						
						inner join client_account ON client_account.lot_id = lot.lot_id	 AND 	client_account.option_account_status_id != 'ejected'				
						inner join client ON client.client_id = client_account.client_id						
						inner join lot_wes_status ON lot_wes_status.lot_wes_status_id = lot_wes.lot_wes_status_id
						inner join lot_wes_bill_duration ON lot_wes_bill_duration.lot_wes_bill_duration_id = lot_wes.lot_wes_bill_duration_id	
					
					WHERE lot_wes_id = {$id}
					
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	public function select_all_by_type($type = '',$dept='engineering',$filter='')
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot_wes 
						
						
						inner join lot ON lot.lot_id = lot_wes.lot_id
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id						
						inner join client_account ON client_account.lot_id = lot.lot_id	 AND 	client_account.option_account_status_id != 'ejected'				
						inner join client ON client.client_id = client_account.client_id						
						inner join lot_wes_status ON lot_wes_status.lot_wes_status_id = lot_wes.lot_wes_status_id						
						inner join lot_wes_bill_duration ON lot_wes_bill_duration.lot_wes_bill_duration_id = lot_wes.lot_wes_bill_duration_id						
						
					WHERE
					
					 lot_wes_type = '{$type}'
					 
					 {$filter}
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	$dept.'_wes/template/row.'.$type.'_account';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	$dept.'_wes/template/row.account.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $balance                     =  mvc_model('model.lot_wes_reading_invoice')->check_unsettled($row['lot_wes_id']); 
                $row['balance_status']    	 =  (empty($balance)) ? 'Settled' : 'Unsettled' ;
                $row['client_name']    		 =  $row['client_name'] .' '. $row['client_surname'] ;
                $row['next_reading_date']    =  string_date($row['lot_wes_date_start']);
				$list				   		.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	public function select_all_unsorted($type = '',$filter='')// for monthly insert
	{
		# DB
		if($type=='water')
		{
			$rate = " inner join option_wes_water_rate ON option_wes_water_rate.option_wes_water_rate_id = lot_wes.option_wes_water_rate_id ";
		}
		else
		{
			$rate = " inner join option_wes_electric_rate ON option_wes_electric_rate.option_wes_electric_rate_id = lot_wes.option_wes_electric_rate_id ";
		}
		
		$query	=	"
					SELECT 
						* 		
					FROM lot_wes 
						
						inner join lot ON lot.lot_id = lot_wes.lot_id
						inner join client_account ON client_account.lot_id = lot.lot_id	 AND 	client_account.option_account_status_id != 'ejected'
						{$rate}				
						
					WHERE
					
					 lot_wes_type = '{$type}'
					 
					 AND lot_wes_status_id = 'installed'
					 
					 {$filter}
					
					";
		$rows	=	sql_select($query);
		
		return $rows;
	}
	
	
	public function get_count_by_lot($id)
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						SUM(CASE WHEN lot_wes_type = 'water'  THEN 1 ELSE 0 END) AS w_count,
						SUM(CASE WHEN lot_wes_type = 'electric'   THEN 1 ELSE 0 END) AS e_count
					
					FROM 
					
					lot_wes
					
					WHERE lot_id = {$id}
					
					
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	

	
	

	
	
# Modify

	public function insert($post)
	{
		$data														=	sql_parse_input('lot_wes', $post);
		$data['lot_wes_timestamp']									=	time();			
		$sql														=	sql_insert($this->table_name, $data, 'lot_wes_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('lot_wes', $post);					
									sql_update($this->table_name, 'lot_wes_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
	
	
	 
	
}
 