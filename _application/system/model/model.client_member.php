<?php
class model_client_member
{	
	
	public function __construct()
	{
		$this->table_name		=	'client_member';
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
						left join network on network.network_id = lot.network_id		
						left join network_division on network_division.network_division_id = lot.network_division_id		
						left join house on house.house_id = lot.house_id	
						left join option_house_classification ON option_house_classification.option_house_classification_id = house.option_house_classification_id	
					where lot.lot_id = {$id}";		
								
		$rows	=	sql_select($query);		
		$rows	=	$rows[0];
		return $rows;
	}
	
	 
	
# Get Ouput

	public function get_row($id)
	{
		$id		=	$id * 1;
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM client_member where client_id = '{$id}' ORDER BY client_member_name DESC
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'edp_client/template/row.manage.member';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'edp_client/template/row.manage.member.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['option_availability_color']    =    ($row['option_availability_id'] == 1) ? 'color_green' : 'color_red';
				$row['lot_lcp']	=	string_amount($row['lot_price']  *        $row['lot_area'])     ;
				$list								.=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	}
	 
	
	
	
# Modify

	public function insert($post, $client_id)
	{
		$post['int']['client_id']			=	$client_id * 1;
		$data								=	sql_parse_input('client_member', $post);
		$data['client_member_timestamp']	=	time();		
		if($data['client_member_name'])
		{
			$sql								=	sql_insert($this->table_name, $data, 'client_member_id');			
			$return['result']					=	$sql['result'];
			$return['data']						=	$sql['data'];
			$return['message']					=	$sql['message'];		
			return $return;
		}	
		
	}
	
	public function insert_batch($post, $client_id)
	{
		foreach($post as $member)
		{			
			$this->insert($member, $client_id);
		}
	}
	
	public function delete($id)
	{		
		$data[]							=	string_clean_number($id);
		sql_delete('client_member', 'client_member_id', $data);	
	}
	
	
	
	 
	
}
