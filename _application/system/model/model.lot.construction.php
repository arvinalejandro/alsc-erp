<?php
class model_lot_construction
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot_construction';
		$this->message_insert	=	'A new lot has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_construction
					
					INNER JOIN lot ON lot.lot_id = lot_construction.lot_id
					inner join project ON project.project_id = lot.project_id
					inner join project_site ON project_site.project_site_id = lot.project_site_id 				
					inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id
					INNER JOIN contractor ON contractor.contractor_id = lot_construction.contractor_id
					INNER JOIN option_unit_status ON option_unit_status.option_unit_status_id = lot_construction.option_unit_status_id
					INNER JOIN option_unit_construction ON option_unit_construction.option_unit_construction_id = lot_construction.option_unit_construction_id
					
					WHERE lot_construction_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	public function select_accumulated_cost($lot_id)
	{
		$id		=	$lot_id * 1;
		$query	=	"SELECT sum(lot_construction_cost_actual) as construction_cost from lot_construction where lot_id = {$id}";
		$rows	=	sql_select($query);
		return $rows[0]['construction_cost'];
	}
	
	public function select_by_lot($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_construction
					
					INNER JOIN lot ON lot.lot_id = lot_construction.lot_id
					inner join project ON project.project_id = lot.project_id
					inner join project_site ON project_site.project_site_id = lot.project_site_id 				
					inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id
					INNER JOIN contractor ON contractor.contractor_id = lot_construction.contractor_id
					INNER JOIN option_unit_status ON option_unit_status.option_unit_status_id = lot_construction.option_unit_status_id
					INNER JOIN option_unit_construction ON option_unit_construction.option_unit_construction_id = lot_construction.option_unit_construction_id
					
					WHERE lot_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	public function select_latest_monthly($id,$date = '2015-September')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_construction
					
					INNER JOIN contractor ON contractor.contractor_id = lot_construction.contractor_id
					INNER JOIN option_unit_status ON option_unit_status.option_unit_status_id = lot_construction.option_unit_status_id
					INNER JOIN option_unit_construction ON option_unit_construction.option_unit_construction_id = lot_construction.option_unit_construction_id
					
					WHERE lot_id = {$id}
					
					AND DATE_FORMAT(FROM_UNIXTIME(`lot_construction_date_complete`), '%Y-%M') = '{$date}'
					
					ORDER BY lot_construction_date_complete ASC
					";							
		$rows	=	sql_select($query);	
		if(count($rows))
		{
			$rows = $rows;
		}
		else
		{
			$rows = NULL;
		}
		return $rows;
	}
	
	public function select_all($filter = '')
	{		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_construction
					
					INNER JOIN lot ON lot.lot_id = lot_construction.lot_id
					inner join project ON project.project_id = lot.project_id
					inner join project_site ON project_site.project_site_id = lot.project_site_id 				
					inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id
					INNER JOIN contractor ON contractor.contractor_id = lot_construction.contractor_id
					INNER JOIN option_unit_status ON option_unit_status.option_unit_status_id = lot_construction.option_unit_status_id
					INNER JOIN option_unit_construction ON option_unit_construction.option_unit_construction_id = lot_construction.option_unit_construction_id
					
					";							
		$rows	=	sql_select($query);	
		$template_row		=	'engineering/template/row.construction.list';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);	
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['date_complete']    		 				 =  ($row['lot_construction_date_complete'] > 0) ?string_date($row['lot_construction_date_complete']) : 'N/A';
                $row['date_start']    		 				 	 =   string_date($row['lot_construction_date_start']);
				$row['lot_construction_cost_estimate']    		 =   string_amount($row['lot_construction_cost_estimate']);
				$row['lot_construction_cost_actual']    		 =  ($row['lot_construction_cost_actual'] > 0) ? 'P '.string_amount($row['lot_construction_cost_actual']) : 'N/A';
				$list										    .=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	
	public function select_all_by_contractor($id,$filter = 0)
	{		
		$filter =   ($filter > 0) ? " AND lot_construction.house_id > 0" : " AND lot_construction.house_id = 0";
		$id		=	string_clean_number($id);
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_construction
					
					INNER JOIN lot ON lot.lot_id = lot_construction.lot_id
					inner join project ON project.project_id = lot.project_id
					inner join project_site ON project_site.project_site_id = lot.project_site_id 				
					inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id
					INNER JOIN contractor ON contractor.contractor_id = lot_construction.contractor_id
					INNER JOIN option_unit_status ON option_unit_status.option_unit_status_id = lot_construction.option_unit_status_id
					INNER JOIN option_unit_construction ON option_unit_construction.option_unit_construction_id = lot_construction.option_unit_construction_id
					
					WHERE lot_construction.contractor_id = {$id}
					
					{$filter}
					";							
		$rows	=	sql_select($query);	
		$template_row		=	'engineering_contractor/template/row.contractor.construction.list';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);	
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['date_complete']    		 				 =  ($row['lot_construction_date_complete'] > 0) ?string_date($row['lot_construction_date_complete']) : 'N/A';
                $row['date_start']    		 				 	 =   string_date($row['lot_construction_date_start']);
				$row['lot_construction_cost_estimate']    		 =   string_amount($row['lot_construction_cost_estimate']);
				$row['lot_construction_cost_actual']    		 =  ($row['lot_construction_cost_actual'] > 0) ? 'P '.string_amount($row['lot_construction_cost_actual']) : 'N/A';
				$list										    .=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	

	public function get($id, $filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_construction
					
					INNER JOIN contractor ON contractor.contractor_id = lot_construction.contractor_id
					INNER JOIN option_unit_status ON option_unit_status.option_unit_status_id = lot_construction.option_unit_status_id
					INNER JOIN option_unit_construction ON option_unit_construction.option_unit_construction_id = lot_construction.option_unit_construction_id
					
					WHERE lot_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$template_row		=	'engineering/template/row.lot.construction.list';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);	
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['date_complete']    		 				 =  ($row['lot_construction_date_complete'] > 0) ?string_date($row['lot_construction_date_complete']) : 'N/A';
                $row['date_start']    		 				 	 =   string_date($row['lot_construction_date_start']);
				$row['lot_construction_cost_estimate']    		 =   string_amount($row['lot_construction_cost_estimate']);
				$row['lot_construction_cost_actual']    		 =  ($row['lot_construction_cost_actual'] > 0) ? 'P '.string_amount($row['lot_construction_cost_actual']) : 'N/A';
				$list										    .=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	public function get_for_client_list($lot_id)
	{
		$lot_id	=	$lot_id * 1;
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_construction
					
					INNER JOIN contractor ON contractor.contractor_id = lot_construction.contractor_id
					INNER JOIN option_unit_status ON option_unit_status.option_unit_status_id = lot_construction.option_unit_status_id
					INNER JOIN option_unit_construction ON option_unit_construction.option_unit_construction_id = lot_construction.option_unit_construction_id
					INNER JOIN lot ON lot_construction.lot_id = lot.lot_id
					INNER JOIN project ON project.project_id = lot.project_id
					INNER JOIN project_site ON project_site.project_site_id = lot.project_site_id
					INNER JOIN project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id
					
					WHERE lot_construction_id NOT IN ( SELECT lot_construction_id FROM client_account_construction ) AND lot_construction.lot_id = {$lot_id} AND lot_construction.option_construction_account_id = 'new'";
		
		$rows	=	sql_select($query);
		
		$template_row		=	'edp_client/template/row.manage.construction.list';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);	
		
		#hash_dump($rows, 1);
		
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['lot_construction_date_start']    		 	=  ($row['lot_construction_date_start'] > 0) ?string_date($row['lot_construction_date_start']) : 'N/A';
                $row['lot_construction_date_complete']    		 =  ($row['lot_construction_date_complete'] > 0) ?string_date($row['lot_construction_date_complete']) : 'N/A';               
				$row['lot_construction_cost_estimate']    		 =   string_amount($row['lot_construction_cost_estimate']);
				$row['lot_construction_cost_actual']    		 =  ($row['lot_construction_cost_actual'] > 0) ? 'P '.string_amount($row['lot_construction_cost_actual']) : 'N/A';
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
		$data										=	sql_parse_input('lot_construction', $post);
		$data['lot_construction_timestamp']			=	time();			
		$sql										=	sql_insert($this->table_name, $data, 'lot_construction_id');				
		$return['result']							=	$sql['result'];
		$return['data']								=	$sql['data'];
		$return['message']							=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('lot_construction', $post);					
									sql_update($this->table_name, 'lot_construction_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}	 
	
}
 