<?php
class model_option_wes_charge_group
{	
	
	public function __construct()
	{
		$this->table_name		=	'option_wes_charge_group';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					option_wes_charge_group
					
					
					
					WHERE option_wes_charge_group_id = '{$id}'
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	
# Modify

	public function insert($post)
	{
		$data														=	sql_parse_input('option_wes_charge_group', $post);
		$name_id													=   str_replace(' ','_',$data['option_wes_charge_group_name']);
		$data['option_wes_charge_group_id']							=   strtolower($name_id) . '_'. rand(1,999);
		$sql														=	sql_insert($this->table_name, $data);				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data													=	sql_parse_input('option_wes_charge_group', $post);	
																	sql_update($this->table_name, 'option_wes_charge_group_id', $id, $data);	
		$return['result']										=	true;
		$return['data']											=	'';
		$return['message']										=	$this->message_update;
		
	}
	
	
	
	
	 
	
}
 