<?php
class model_client_account_agent_consolidate
{	
	
	public function __construct()
	{
		$this->table_name		=	'client_account_agent_consolidate';
		$this->message_insert	=	'A new Entry has been successfully added.';
	}
	
	
	
	public function select_consolidated_entry($id)
    {
    	$query 		 		 = "SELECT * FROM client_account_agent_consolidate WHERE group_client_account_agent_id = {$id}";
        $rows                =  sql_select($query);
        
        if(count($rows))
        {
			
			foreach($rows as $row)
			{
				$entry_id[] = $row['client_account_agent_id'];
				
			}
        }
        
        return $entry_id;
	}
	
	
	
	
# Modify

	public function insert($post,$id)
	{
		
		if(count($post))
		{
			foreach($post as $row)
			{
				$data['group_client_account_agent_id']			=   $id;
				$data['client_account_agent_id']				=   $row;
				$sql							                =	sql_insert($this->table_name, $data);
			}
			
			$return['result']							    =	true;
		    $return['data']									=	$sql;
		    $return['message']								=	$this->message_insert;
		}
		return 		$return;
				
	}
	
	public function delete_consolidated_entry($id_entry, $group_id)
	{
		if($id_entry && $group_id)
		{
			sql_delete('client_account_agent_consolidate', 'client_account_agent_id', $id_entry, " AND group_client_account_agent_id={$group_id}");
		}
		
	}
	
	
    
   
    

    		
}
