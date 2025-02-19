<?php
class model_lot_wes_job_order
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot_wes_job_order';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select_job_order($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_wes_job_order
										
					WHERE 
					
					lot_wes_id = {$id}
					
					AND 
					
					lot_wes_job_order_status_id = 'pending'
					
					AND
					
					lot_wes_job_order_type_id   = 'for_disconnection'
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_wes_job_order
					
						inner join lot_wes ON lot_wes.lot_wes_id = lot_wes_job_order.lot_wes_id	
						inner join lot ON lot.lot_id = lot_wes.lot_id
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id					
						inner join client_account ON client_account.lot_id = lot.lot_id	 AND 	client_account.option_account_status_id != 'ejected'
						inner join client ON client.client_id = client_account.client_id				
						inner join lot_wes_job_order_status ON lot_wes_job_order_status.lot_wes_job_order_status_id = lot_wes_job_order.lot_wes_job_order_status_id
						inner join lot_wes_status ON lot_wes_status.lot_wes_status_id = lot_wes.lot_wes_status_id		
						inner join lot_wes_job_order_type ON lot_wes_job_order_type.lot_wes_job_order_type_id = lot_wes_job_order.lot_wes_job_order_type_id		
						INNER JOIN user ON user.user_id = lot_wes_job_order.user_id
					
					WHERE 
					
					lot_wes_job_order.lot_wes_job_order_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	public function select_all($filter = '')
	{
		# DB
		$query	=	"
					SELECT 
						* 		
					FROM lot_wes_job_order 
						
						inner join lot_wes ON lot_wes.lot_wes_id = lot_wes_job_order.lot_wes_id	
						inner join lot ON lot.lot_id = lot_wes.lot_id
						inner join project ON project.project_id = lot.project_id						
						inner join project_site ON project_site.project_site_id = lot.project_site_id						
						inner join project_site_block ON project_site_block.project_site_block_id = lot.project_site_block_id					
						inner join client_account ON client_account.lot_id = lot.lot_id	 AND 	client_account.option_account_status_id != 'ejected'
						inner join client ON client.client_id = client_account.client_id				
						inner join lot_wes_job_order_status ON lot_wes_job_order_status.lot_wes_job_order_status_id = lot_wes_job_order.lot_wes_job_order_status_id
						inner join lot_wes_status ON lot_wes_status.lot_wes_status_id = lot_wes.lot_wes_status_id		
						inner join lot_wes_job_order_type ON lot_wes_job_order_type.lot_wes_job_order_type_id = lot_wes_job_order.lot_wes_job_order_type_id		
						INNER JOIN user ON user.user_id = lot_wes_job_order.user_id
						
					{$filter}	
					
					ORDER BY 	lot_wes_job_order_timestamp DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'engineering_wes/template/row.job_order';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'engineering_wes/template/row.lot.empty';
		$template_row_empty	=	view_get_template($template_row_empty);
		# Parse
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['job_date']    	=  string_date($row['lot_wes_job_order_timestamp']);
                $row['user_']    		=   $row['user_name'].' '.$row['user_surname'];
				$list				   .=	view_populate($row, $template_row);
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
		$data														=	sql_parse_input('lot_wes_job_order', $post);
		$data['lot_wes_job_order_timestamp']						=	time();			
		$sql														=	sql_insert($this->table_name, $data, 'lot_wes_job_order_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('lot_wes_job_order', $post);					
									sql_update($this->table_name, 'lot_wes_job_order_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	
	 
	
}
 