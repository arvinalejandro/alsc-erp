<?php
class model_lot
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot';
		$this->message_insert	=	'A new lot has been successfully added.';
	}
	
# Data Select

	public function select($id, $filter = '')
	{		
		$id		=	string_clean_number($id);
		
		$query	=	"select 
						* 
					from lot 	
						
						inner join project ON project.project_id = lot.project_id 				
						inner join project_site ON project_site.project_site_id = lot.project_site_id 				
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id 				
						inner join option_availability ON option_availability.option_availability_id = lot.option_availability_id 				
						inner join option_unit ON option_unit.option_unit_id = lot.option_unit_id 
						
						left join house on house.house_id = lot.house_id	
						left join option_lot_property_status on option_lot_property_status.option_lot_property_status_id = lot.option_lot_property_status_id	
						left join option_house_classification ON option_house_classification.option_house_classification_id = house.option_house_classification_id					
					
						
						
					where lot.lot_id = {$id}";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
	public function select_this($id)
	{		
		$id		=	string_clean_number($id);		
		$query	=	"select 
						* 
					from lot 									
					where lot.lot_id = {$id}";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
	public function select_all_lot()
	{		
		$query	=	"SELECT 
						* 		
					FROM lot 
						inner join option_unit ON option_unit.option_unit_id = lot.option_unit_id			
						left join option_availability ON option_availability.option_availability_id = lot.option_availability_id			
					WHERE
					
					 option_unit.option_unit_type = 'lot'";		
								
		$rows	=	sql_select($query);		
		return $rows;
	}
	
	
# Get Ouput
 
	public function get_row($filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot 
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id
						inner join option_sold_status ON option_sold_status.option_sold_status_id = lot.option_sold_status_id							
						left join option_availability ON option_availability.option_availability_id = lot.option_availability_id			
						left join option_unit ON option_unit.option_unit_id = lot.option_unit_id
						
					
					{$filter}	
					
					ORDER BY 
						project.project_acronym ASC, project_site.project_site_name ASC, project_site_block.project_site_block_name ASC, lot.lot_name ASC
					";
		$rows	=	sql_select($query); 
		# Template
		$template_row		=	'edp_inventory/template/row.lot';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'edp_inventory/template/row.lot.empty'; 
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['option_availability_color']    =    ($row['option_availability_id'] == 'available') ? 'color_green' : 'color_red';
                $row['option_availability_name']     =    ($row['option_availability_id'] == 'sold') ? '<a class="details color_red" title="'.$row['option_sold_status_name'].'">Sold</a>' :  $row['option_availability_name'];
                $row['sold']    	=    ($row['option_availability_id'] == 'sold') ? 'display_none' : '';
				$row['lot_lcp']		=	string_amount($row['lot_price']  *  $row['lot_area']);
				$row['lot_price']	=	string_amount($row['lot_price']);
				$row['address']		=	$row['project_site_code'].'-'.str_pad($row['project_site_block_name'], 3, '0', STR_PAD_LEFT).'-'.str_pad($row['lot_name'], 3, '0', STR_PAD_LEFT);
				$list				.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	public function get_client_row($filter = '', $ajax = false)
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot 
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id						
						
						left join option_availability ON option_availability.option_availability_id = lot.option_availability_id			
						left join option_unit ON option_unit.option_unit_id = lot.option_unit_id
					
					{$filter}	
					
					ORDER BY project.project_acronym ASC, project_site.project_site_name ASC, project_site_block.project_site_block_name ASC, lot.lot_name ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	($ajax) ? 'edp_client/template/row.inventory.ajax' : 'edp_client/template/row.inventory';
		$template_row		=	view_get_template($template_row);
		#$template_row_empty	=	'edp_inventory/template/row.lot.empty';
		#$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$row['option_availability_color']    	=   ($row['option_availability_id'] == 'available') ? 'color_green' : 'color_red';							
				$row['sold']    						=   ($row['option_availability_id'] == 'sold') ? 'display_none' : '';
				$row['address']							=	$row['project_site_code'].'-'.str_pad($row['project_site_block_name'], 3, '0', STR_PAD_LEFT).'-'.str_pad($row['lot_name'], 3, '0', STR_PAD_LEFT);
				$row['lot_lcp']							=	string_amount($row['lot_price']  *  $row['lot_area']);	
				$row['lot_price']						=	string_amount($row['lot_price']);				
				$list									.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	  
	public function get_reservation_row($filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot 
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id						
						inner join option_availability ON option_availability.option_availability_id = lot.option_availability_id			
						inner join option_unit ON option_unit.option_unit_id = lot.option_unit_id
					
					{$filter}	
					
					ORDER BY project.project_acronym ASC, project_site.project_site_name ASC, project_site_block.project_site_block_name ASC, lot.lot_name ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'finance_cashier/template/row.reservation';
		$template_row		=	view_get_template($template_row);
		#$template_row_empty	=	'edp_inventory/template/row.lot.empty';
		#$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$row['option_availability_color']    	=    ($row['option_availability_id'] == 'available') ? 'color_green' : 'color_red';
				$row['lot_lcp']							=	string_amount($row['lot_price']  *        $row['lot_area'])     ;				
				
				$row['lot_price']						=	string_amount($row['lot_price']);
				$row['address']							=	$row['project_site_code'].'-'.str_pad($row['project_site_block_name'], 3, '0', STR_PAD_LEFT).'-'.str_pad($row['lot_name'], 3, '0', STR_PAD_LEFT);
				$list									.=	view_populate($row, $template_row);
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
					FROM lot_price 
						inner join user ON user.user_id = lot_price.user_id									
						inner join lot ON lot.lot_id = lot_price.lot_id	
					WHERE lot_price.lot_id = '{$id}'								
					ORDER BY lot_price.lot_price_timestamp DESC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_inventory/template/row.lot.price';
		$template_row		=	view_get_template($template_row);
		#$template_row_empty	=	'edp_inventory/template/row.lot.empty';
		#$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$row['lot_price_lcp']	=	$row['lot_price_value'] * $row['lot_area'];
				$row['lot_price_lcp']	=	string_amount($row['lot_price_lcp']);
				$row['lot_price_value']	=	string_amount($row['lot_price_value']);
				$row['lot_price_timestamp']	=	string_date_time($row['lot_price_timestamp']);
				$list					.=	view_populate($row, $template_row);
			}			
		}		
		return $list;
	}
	
	
// Engineering===============================================
	public function get_engineering_lot($filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot 
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id			
						inner join option_unit ON option_unit.option_unit_id = lot.option_unit_id			
						inner join option_sold_status ON option_sold_status.option_sold_status_id = lot.option_sold_status_id			
						left join option_availability ON option_availability.option_availability_id = lot.option_availability_id			
						
						
					WHERE
					
					 option_unit.option_unit_type = 'lot'
					
					{$filter}	
					
					ORDER BY 
						project.project_acronym ASC, project_site.project_site_name ASC, project_site_block.project_site_block_name ASC, lot.lot_name ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'engineering/template/row.lot';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['option_availability_color']    =    ($row['option_availability_id'] == 'available') ? 'color_green' : 'color_red';
                $row['option_availability_name']     =    ($row['option_availability_id'] == 'sold') ? '<a class="details color_red" title="'.$row['option_sold_status_name'].'">Sold</a>' :  $row['option_availability_name'];
                $row['sold']    	=    ($row['option_availability_id'] == 'sold') ? 'display_none' : '';
				$row['lot_lcp']		=	string_amount($row['lot_price']  *  $row['lot_area']);
				$row['lot_price']	=	string_amount($row['lot_price']);
				$row['address']		=	$row['project_site_code'].'-'.str_pad($row['project_site_block_name'], 3, '0', STR_PAD_LEFT).'-'.str_pad($row['lot_name'], 3, '0', STR_PAD_LEFT);
				$list				.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	public function get_engineering_zones($filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot 
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id
						inner join option_unit ON option_unit.option_unit_id = lot.option_unit_id						
						left join option_availability ON option_availability.option_availability_id = lot.option_availability_id			
						
						
						WHERE
					
					 	option_unit.option_unit_type = 'zone'
					
					{$filter}	
					
					ORDER BY 
						project.project_acronym ASC, project_site.project_site_name ASC, project_site_block.project_site_block_name ASC, lot.lot_name ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'engineering/template/row.lot.zones';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$row['address']		=	$row['lot_address'].', '.$row['lot_city'];
				$list				.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	public function get_engineering_construction($filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot 
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id						
						left join option_availability ON option_availability.option_availability_id = lot.option_availability_id			
						left join option_unit ON option_unit.option_unit_id = lot.option_unit_id
						
					
					{$filter}	
					
					ORDER BY 
						project.project_acronym ASC, project_site.project_site_name ASC, project_site_block.project_site_block_name ASC, lot.lot_name ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'engineering/template/row.lot.construction';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['option_availability_color']    =    ($row['option_availability_id'] == 'available') ? 'color_green' : 'color_red';
                $row['sold']    	=    ($row['option_availability_id'] == 'sold') ? 'display_none' : '';
				$row['lot_lcp']		=	string_amount($row['lot_price']  *  $row['lot_area']);
				$row['lot_price']	=	string_amount($row['lot_price']);
				$row['address']		=	$row['project_site_code'].'-'.str_pad($row['project_site_block_name'], 3, '0', STR_PAD_LEFT).'-'.str_pad($row['lot_name'], 3, '0', STR_PAD_LEFT);
				$list				.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	//RFO Report
	
	
	
	public function get_monthly_summary($date = '2015-September')
	{		
		
		# DB
		$query	=	"
					SELECT *,
					project.project_name,project.project_id,project.project_acronym,project_site.project_site_name,
					SUM(CASE WHEN lot.option_unit_id = 'package' AND lot.option_availability_id = 'available' THEN lot.lot_area*lot.lot_price+house.house_price ELSE 0 END) AS tcp,
					SUM(CASE WHEN lot.option_unit_id = 'package' AND lot.option_availability_id = 'available' THEN house.house_price ELSE 0 END) AS hcp,
					SUM(CASE WHEN lot.option_unit_id = 'package' AND lot.option_availability_id = 'available' THEN lot.lot_area*lot.lot_price ELSE 0 END) AS lcp

					FROM 

					lot

					INNER join project on project.project_id = lot.project_id
					
					INNER join project_site on project_site.project_site_id = lot.project_site_id
					
					INNER join option_unit ON option_unit.option_unit_id = lot.option_unit_id
					
					INNER join option_lot_property_status ON option_lot_property_status.option_lot_property_status_id = lot.option_lot_property_status_id
					
					INNER join house on house.house_id = lot.house_id 
					
					LEFT join lot_title on lot_title.lot_id = lot.lot_id
					
					LEFT join option_lot_title_status on  option_lot_title_status.option_lot_title_status_id = lot_title.option_lot_title_status_id
					
					LEFT join option_lot_title_name on  option_lot_title_name.option_lot_title_name_id = lot_title.option_lot_title_name_id
					
					WHERE option_unit.option_unit_type = 'lot'
					
					AND lot.option_unit_id = 'package'
					
					AND lot.option_availability_id = 'available'

					GROUP BY lot.lot_id
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'engineering/template/row.report.monthly';
		$template_row		=	view_get_template($template_row);
		# Parse
		if(count($rows))
		{
			$list['total_hcp']						=	0;
			$list['total_tcp']						=	0;
			$list['total_lcp']						=	0;
			$list['total_cons_cost']				=	0;
			$list['total_units']					=	count($rows);
			
			foreach($rows as $row)  
			{  				
				$lot_const							=   mvc_model('model.lot.construction')->select_latest_monthly($row['lot_id'],$date);
				$row['date_const']					=   'N/A';
				$row['cons_cost']                   =   'N/A';
				$row['const_type']                  =   'N/A';
				if(count($lot_const))
				{
					
					foreach($lot_const as $lot_row)
					{
						$row['date_const']			=  ($lot_row['lot_construction_date_complete']) ? string_date( $lot_row['lot_construction_date_complete']) :  $row['date_const'];
						$row['cons_cost']		   +=   $lot_row['lot_construction_cost_actual'];
						if(count($lot_const) > 1)
						{
							$row['const_type']      =   'Multiple';
						}
						else
						{
							$row['const_type']      =   $lot_row['option_unit_construction_name'];
						} 
					}
				}
				
				$list['total_hcp']				   +=	$row['hcp'];
				$list['total_tcp']		           +=	$row['tcp'];
				$list['total_lcp']				   +=	$row['lcp'];
				$list['total_cons_cost']		   +=	$row['cons_cost'];
				$markup								=   string_clean_number($row['hcp']) / string_clean_number($row['cons_cost']) ;
				$row['test_markup']					=   round($markup,2);	
				$row['house_psqm']					=   string_amount(round($row['house_price']/$row['house_area'],2));	
				$row['lot_price']					=   string_amount($row['lot_price']); 
				$row['tcp']							=   string_amount($row['tcp']); 
				$row['lcp']							=   string_amount($row['lcp']); 
				$row['hcp']		    				=   string_amount($row['hcp']); 
				$row['cons_cost']		    		=   string_amount($row['cons_cost']); 
				$list['row.lot']				   .=	view_populate($row, $template_row);
				
			}
			//die();
		}
		else
		{
			$list	=	'';
		}
		
		return $list;
	}// end get_monthly_summary()
	
	
	public function get_overall_summary()
	{		
		
		# DB
		$query	=	"
					SELECT
					SUM(CASE WHEN lot.option_sold_status_id = 'acc_occ'  	 	 THEN 1 ELSE 0 END) AS acc_occ,
					SUM(CASE WHEN lot.option_sold_status_id = 'acc_not_occ'  	 THEN 1 ELSE 0 END) AS acc_not_occ,
					SUM(CASE WHEN lot.option_sold_status_id = 'not_acc_not_occ'  THEN 1 ELSE 0 END) AS not_acc_not_occ,
					SUM(CASE WHEN lot.option_sold_status_id = 'not_acc_occ' 	 THEN 1 ELSE 0 END) AS not_acc_occ,
					SUM(CASE WHEN lot.option_lot_property_status_id = 'on_going_refurb' 	 THEN 1 ELSE 0 END) AS on_going_refurb

					FROM 

					lot
					
					INNER join option_unit ON option_unit.option_unit_id = lot.option_unit_id
					
					INNER join option_sold_status ON option_sold_status.option_sold_status_id = lot.option_sold_status_id
					
					INNER join option_lot_property_status ON option_lot_property_status.option_lot_property_status_id = lot.option_lot_property_status_id
					
					
					WHERE option_unit.option_unit_type = 'lot'
					
					AND lot.option_unit_id = 'package'
					
					AND lot.option_availability_id = 'sold'

					";
		$rows	=	sql_select($query);
		$list   =   $rows[0];
		# Parse
		
		
		return $list;
	}// end get_overall_summary()
	
	
	
//============= WES =============================================

public function get_wes_lot($filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot 
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id			
						inner join option_unit ON option_unit.option_unit_id = lot.option_unit_id			
						left join option_availability ON option_availability.option_availability_id = lot.option_availability_id			
						
						
					WHERE
					
					 option_unit.option_unit_type = 'lot'
					
					{$filter}	
					
					ORDER BY 
						project.project_acronym ASC, project_site.project_site_name ASC, project_site_block.project_site_block_name ASC, lot.lot_name ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'engineering_wes/template/row.lot';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering_wes/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                
                $count_row							 =	mvc_model('model.lot_wes')->get_count_by_lot($row['lot_id']); 
                $row['w_count']					 	 =  $count_row['w_count']*1;
                $row['e_count']					 	 =  $count_row['e_count']*1;
                $row['option_availability_color']    =  ($row['option_availability_id'] == 'available') ? 'color_green' : 'color_red';
                $row['sold']    					 =  ($row['option_availability_id'] == 'sold') ? 'display_none' : '';
				$row['lot_lcp']						 =	string_amount($row['lot_price']  *  $row['lot_area']);
				$row['lot_price']					 =	string_amount($row['lot_price']);
				$row['address']						 =	$row['project_site_code'].'-'.str_pad($row['project_site_block_name'], 3, '0', STR_PAD_LEFT).'-'.str_pad($row['lot_name'], 3, '0', STR_PAD_LEFT);
				$list								.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	
	
	public function get_wes_zones($filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot 
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id
						inner join option_unit ON option_unit.option_unit_id = lot.option_unit_id						
						left join option_availability ON option_availability.option_availability_id = lot.option_availability_id			
						
						
						WHERE
					
					 	option_unit.option_unit_type = 'zone'
					
					{$filter}	
					
					ORDER BY 
						project.project_acronym ASC, project_site.project_site_name ASC, project_site_block.project_site_block_name ASC, lot.lot_name ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'engineering_wes/template/row.lot.zones';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering_wes/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				$row['address']		=	$row['lot_address'].', '.$row['lot_city'];
				$list				.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}	
	

//===========Sales Module======================================
public function get_hold_row($filter = '')
	{
		# DB
		$query	=	"
					SELECT 
							*,
							coalesce(lot.lot_id,sales_agent_lot.lot_id) as lot_id,
							coalesce(sales_agent_lot.sales_agent_id_pc,sales_agent_lot.old_sales_agent_id_ma,sales_agent_lot.old_sales_agent_id_sm) as hold_agent_id
					FROM lot 
					    inner join option_availability ON option_availability.option_availability_id = lot.option_availability_id
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id
						left JOIN sales_agent_lot ON sales_agent_lot.lot_id = lot.lot_id	AND sales_agent_lot.hold_status = 'active'	
						left join option_unit ON option_unit.option_unit_id = lot.option_unit_id
						
					{$filter}	
					ORDER BY 
						project.project_acronym ASC, project_site.project_site_name ASC, project_site_block.project_site_block_name ASC, lot.lot_name ASC
					";
		$rows	=	sql_select($query);
		
		# Template
		$template_row		=	'sales/template/row.lot';
		$template_row		=	view_get_template($template_row);
		//hash_dump($rows,true);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                
                $agent_data             =    mvc_model('model.sales_agent')->select_agent($row['hold_agent_id'],1); 
                $row['agent_holder']    =    ($agent_data) ? $agent_data['sales_agent_first_name'].' '.$agent_data['sales_agent_last_name'] : 'N/A';
                $row['hold_class']      =    ($row['option_availability_id'] != 'available' ? 'color_red' : 'color_green');
               //hash_dump($row['option_availability_id']);
                $row['hold_status']     =    $row['option_availability_name'];
                if($row['option_availability_id'] == 'on_hold')
                {
			        //hash_dump($row,true);
					$duration	       =    diff_date_to_current(string_clean_number($row['sales_agent_lot_timestamp']));
					//hash_dump($duration,true);
					$row['duration']   =    $duration.' day/s'; 
					$row['duration']   =    ($row['is_sold'] == 1 ? 'N/A' : $row['duration']);
                }
                else
                {
					$row['duration']   =    'N/A'; 
                }
                $row['sold']    	   =    ($row['option_availability_id'] == 2) ? 'display_none' : '';
				$row['lot_lcp']		   =	string_amount($row['lot_price']  *  $row['lot_area']);
				$row['lot_price']	   =	string_amount($row['lot_price']);
				$row['address']		   =	$row['project_site_code'].'-'.str_pad($row['project_site_block_name'], 3, '0', STR_PAD_LEFT).'-'.str_pad($row['lot_name'], 3, '0', STR_PAD_LEFT);
				$list				  .=	view_populate($row, $template_row);
			}
			//die();
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}
	
	//sales report
	
	public function get_total_unsold_inventory()
	{		
		
		# DB
		$query	=	"
					SELECT 
					SUM(CASE WHEN option_unit_id = 'package' THEN lot_area*lot_price+house_price ELSE 0 END) AS package_total,
					SUM(CASE WHEN option_unit_id = 'lot_only' THEN lot_area*lot_price ELSE 0 END) AS lot_only_total

					FROM 

					lot

					LEFT join house on house.house_id = lot.house_id 
					
					WHERE option_availability_id = 'available'

					";
		$rows	=	sql_select($query);
		$row    =   $rows[0];
		
		return $row;
	}// end get_total_unsold_inventory()
	
	public function get_total_unsold_inventory_per_proj_site()
	{		
		
		# DB
		$query	=	"
					SELECT 
					project.project_name,project.project_id,project.project_acronym,project_site.project_site_name,
					SUM(CASE WHEN lot.option_unit_id = 'package' AND lot.option_availability_id = 'available' THEN lot.lot_area*lot.lot_price+house.house_price ELSE 0 END) AS package_total,
					SUM(CASE WHEN lot.option_unit_id = 'lot_only' AND lot.option_availability_id = 'available' THEN lot.lot_area*lot.lot_price ELSE 0 END) AS lot_only_total,
					SUM(CASE WHEN lot.option_unit_id = 'package' AND lot.option_availability_id = 'available' THEN 1 ELSE 0 END) AS package_uv,
					SUM(CASE WHEN lot.option_unit_id = 'lot_only' AND lot.option_availability_id = 'available' THEN 1 ELSE 0 END) AS lot_uv

					FROM 

					project

					INNER join project_site on project_site.project_id = project.project_id

					LEFT join lot on lot.project_site_id = project_site.project_site_id 

					LEFT join house on house.house_id = lot.house_id 

					GROUP BY project_site.project_site_id
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'sales/template/profile.report.unsold.inventory';
		$template_row		=	view_get_template($template_row);
		# Parse
		if(count($rows))
		{
			$list['grand_total_package_uv']			=	0;
			$list['grand_total_package_tcp']		=	0;
			$list['grand_total_lot_uv']				=	0;
			$list['grand_total_lot_tcp']			=	0;
			$list['grand_total_total_uv']			=	0;
			$list['grand_total_total_tcp']			=	0;
			
			foreach($rows as $row) // for edit 
			{  				
				$row['package_uv']					=    $row['package_uv']; 
				$row['lot_uv']						=    $row['lot_uv']; 
				$row['package_tcp']					=    string_amount($row['package_total']); 
				$row['lot_tcp']						=    string_amount($row['lot_only_total']); 
				$row['total_tcp']		    		=    string_amount($row['package_total']+$row['lot_only_total']); 
				$row['total_uv']					=    $row['lot_uv']+$row['package_uv']; 
				$list['row.unsold']				   .=	view_populate($row, $template_row);
				
				$list['grand_total_package_uv']			+=	$row['package_uv'];
				$list['grand_total_package_tcp']		+=	$row['package_total'];
				$list['grand_total_lot_uv']				+=	$row['lot_uv'];
				$list['grand_total_lot_tcp']			+=	$row['lot_only_total'];
				$list['grand_total_total_uv']			+=	$row['total_uv'];
				$list['grand_total_total_tcp']			+=	string_clean_number($row['total_tcp']);
			}
			
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}// end get_total_unsold_inventory()
//===========Network/Division Module===================================
	public function select_all_lot_row($filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						*
					FROM 
					
					lot 
						
					inner join project ON project.project_id = lot.project_id						
					inner join project_site ON project_site.project_site_id = lot.project_site_id						
					inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id						
					left join option_availability ON option_availability.option_availability_id = lot.option_availability_id			
					left join option_unit ON option_unit.option_unit_id = lot.option_unit_id
					
					WHERE lot.network_id < 1 AND lot.network_division_id < 1
					
					AND lot.option_availability_id = 'available'
					
					{$filter}	
					
					ORDER BY 
						project.project_acronym ASC, project_site.project_site_name ASC, project_site_block.project_site_block_name ASC, lot.lot_name ASC
					";
		$rows	=	sql_select($query);
		$rows	=	sql_select($query);
		$template_row		=	'sales/template/row.network_all_lots';
		$template_row		=	view_get_template($template_row);
		
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{
				$list			 .=	view_populate($row, $template_row);
			}
			
		}
		else
		{
			$list	=	'';
		}
		return $list;
	
	}
	
	
	public function select_network_lot_row($network_id,$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						*
					FROM 
					
					lot 
						
					inner join project ON project.project_id = lot.project_id						
					inner join project_site ON project_site.project_site_id = lot.project_site_id						
					inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id						
					left join option_availability ON option_availability.option_availability_id = lot.option_availability_id			
					left join option_unit ON option_unit.option_unit_id = lot.option_unit_id
					
					
					WHERE lot.network_id = {$network_id}
					
					{$filter}	
					
					ORDER BY 
						project.project_acronym ASC, project_site.project_site_name ASC, project_site_block.project_site_block_name ASC, lot.lot_name ASC
					";
		$rows	=	sql_select($query);
		$template_row		=	'sales/template/row.network_lots';
		$template_row		=	view_get_template($template_row);
		
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{
				if($row['network_division_id'] > 0)
				{
					$div_data = mvc_model('model.network_division')->select_division($row['network_division_id']);
					$row['division_link']	=	'<a href="/sales/division/profile/&id='.$div_data['network_division_id'].'">'.$div_data['network_division_name'].'</a>';
				}
				else
				{
					$row['division_link']	=	'Not Assigned';
				}
				
				
				$list			 .=	view_populate($row, $template_row);
			}
			
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}
	
	
	public function select_division_lot_row($division_id,$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						*
					FROM 
					
					lot 
						
					inner join project ON project.project_id = lot.project_id						
					inner join project_site ON project_site.project_site_id = lot.project_site_id						
					inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id						
					left join option_availability ON option_availability.option_availability_id = lot.option_availability_id			
					left join option_unit ON option_unit.option_unit_id = lot.option_unit_id
					
					WHERE lot.network_division_id = {$division_id}
					
					{$filter}	
					
					ORDER BY 
						project.project_acronym ASC, project_site.project_site_name ASC, project_site_block.project_site_block_name ASC, lot.lot_name ASC
					";
		$rows	=	sql_select($query);
		$template_row		=	'sales/template/row.division_lots';
		$template_row		=	view_get_template($template_row);
		
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{
				$list			 .=	view_populate($row, $template_row);
			}
			
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}
	
	
    public function select_agent_lot_row($agent_id,$filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						*
					FROM 
					
					lot 
						
					inner join project ON project.project_id = lot.project_id						
					inner join project_site ON project_site.project_site_id = lot.project_site_id						
					inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id						
					left join option_availability ON option_availability.option_availability_id = lot.option_availability_id			
					left join option_unit ON option_unit.option_unit_id = lot.option_unit_id
					
					WHERE lot.agent_id = {$agent_id}
					
					{$filter}	
					
					ORDER BY 
						project.project_acronym ASC, project_site.project_site_name ASC, project_site_block.project_site_block_name ASC, lot.lot_name ASC
					";
		$rows	=	sql_select($query);
		# Parse
		if(count($rows))
		{
			$list	=	$rows;
		}
		else
		{
			$list	=	null;
		}
		return $list;
	}




//===========Documentation Module======================================

	public function get_lots_row()
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot 
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id						
						left join option_availability ON option_availability.option_availability_id = lot.option_availability_id			
						left join option_unit ON option_unit.option_unit_id = lot.option_unit_id
					
						
					
					ORDER BY 
						project.project_acronym ASC, project_site.project_site_name ASC, project_site_block.project_site_block_name ASC, lot.lot_name ASC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'documentation/template/row.lot';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'documentation/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
			    
				$row['hold_status']    =    ($row['hold_active'] == 1) ? 'color_red' : 'color_green';
                $row['hold_class']     =    ($row['hold_active'] == 1) ? 'On Hold' : 'Available';
                $row['sold']    	   =    ($row['option_availability_id'] == 2) ? 'display_none' : '';
				$row['lot_lcp']		   =	string_amount($row['lot_price']  *  $row['lot_area']);
				$row['lot_price']	   =	string_amount($row['lot_price']);
				$row['address']		   =	$row['project_site_code'].'-'.str_pad($row['project_site_block_name'], 3, '0', STR_PAD_LEFT).'-'.str_pad($row['lot_name'], 3, '0', STR_PAD_LEFT);
				$list				  .=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}	
	
	public function get_lots_profile($id)
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot 
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id						
						left join option_availability ON option_availability.option_availability_id = lot.option_availability_id			
						left join option_unit ON option_unit.option_unit_id = lot.option_unit_id
					
					 WHERE lot_id =	{$id}
					
					ORDER BY 
						project.project_acronym ASC, project_site.project_site_name ASC, project_site_block.project_site_block_name ASC, lot.lot_name ASC
					";
		$rows	=	sql_select($query);
		
		# Parse
		if(count($rows))
		{
		 		$row = $rows[0];
                $row['option_availability_color']    =    ($row['option_availability_id'] == 1) ? 'color_green' : 'color_red';
                $row['sold']    	=    ($row['option_availability_id'] == 2) ? 'display_none' : '';
				$row['lot_lcp']		=	string_amount($row['lot_price']  *  $row['lot_area']);
				$row['lot_price']	=	string_amount($row['lot_price']);
				$row['address']		=	$row['project_site_code'].'-'.str_pad($row['project_site_block_name'], 3, '0', STR_PAD_LEFT).'-'.str_pad($row['lot_name'], 3, '0', STR_PAD_LEFT);
					
		}
		else
		{
			$row	=	'';
		}
		return $row;
	}
	
	
# Modify

	public function insert($post)
	{
		$data							=	sql_parse_input('lot', $post);
		$data['lot_timestamp']			=	time();			
		$sql							=	sql_insert($this->table_name, $data, 'lot_id', array('project_id', 'project_site_id', 'project_site_block_id', 'lot_name'));				
		$return['result']				=	$sql['result'];
		$return['data']					=	$sql['data'];
		$return['message']				=	$sql['message'];		
		return $return;
	}
	
	public function insert_lot_price($post, $user_id)
	{
		$data['lot_price_timestamp']	=	time();
		$data['lot_id']					=	$post['lot_id'];
		$data['user_id']				=	$user_id;
		$data['lot_price_value']		=	$post['lot_price'];
		sql_insert('lot_price', $data);
	} 
	
	public function price_adjust($post)
	{
		$project_price	=	sql_parse_input('project_price', $post);
        $operator       =   ($project_price['project_price_adjustment'] * 1) ? '+' : '-';
        $query			=	"update lot set lot_price = lot_price {$operator} {$project_price['project_price_value']} where option_availability_id != 2 AND project_site_id = {$project_price['project_site_id']}";	# option_availability_id = 2 = sold
		# Insert Lot Price # Please clean this and avobe
		sql_query($query);
		$lot_rows		=	sql_select("SELECT * from lot where option_availability_id != 2 AND project_site_id = {$project_price['project_site_id']}");
		foreach($lot_rows as $row)
		{			
			$data['lot_price_timestamp']	=	time();
			$data['lot_id']					=	$row['lot_id'];
			$data['user_id']				=	$project_price['user_id'];
			$data['lot_price_value']		=	$row['lot_price']; # The already updated price
			sql_insert('lot_price', $data);
		}	
		return $lot_rows;		
	}
	
	public function update($post, $id,$user_id)
	{
		
		$data					=	sql_parse_input('lot', $post);	
		if($data['option_availability_id'] != NUll)
		{
			$lot				=   $this->select_this($id);
			if($lot['option_availability_id'] != $data['option_availability_id'] || $lot['option_lot_property_status_id'] != $data['option_lot_property_status_id'])
			{
				$history_post['lot_id']								=	$id;
				$history_post['option_availability_id']				=	$data['option_availability_id'];
				mvc_model('model.lot.availability.history')->insert($history_post);
				$history_post['option_lot_property_status_id']		=	($data['option_lot_property_status_id']) ? $data['option_lot_property_status_id'] : $lot['option_lot_property_status_id'] ;
				$history_post['user_id']							=	$user_id;
				mvc_model('model.lot.status.history')->insert($history_post);
			}
		}
		
						
									sql_update($this->table_name, 'lot_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}	
	
	
	public function update_earnest($post, $id,$user_id)
	{
		$data					=	sql_parse_input('lot', $post);		
		if($data['option_availability_id'] != NUll)
		{
			$lot				=   $this->select_this($id);
			if($lot['option_availability_id'] != $data['option_availability_id'] || $lot['option_lot_property_status_id'] != $data['option_lot_property_status_id'])
			{
				$history_post['lot_id']								=	$id;
				$history_post['option_availability_id']				=	$data['option_availability_id'];
				mvc_model('model.lot.availability.history')->insert($history_post);
				$history_post['option_lot_property_status_id']		=	($data['option_lot_property_status_id']) ? $data['option_lot_property_status_id'] : $lot['option_lot_property_status_id'] ;
				$history_post['user_id']							=	$user_id;
				mvc_model('model.lot.status.history')->insert($history_post);
			}
		}			
									sql_update($this->table_name, 'lot_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
	 
	
}
