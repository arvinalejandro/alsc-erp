<?php
class model_client_account_construction
{    
    
    public function __construct()
    {
        $this->table_name        =    'client_account_construction';
        $this->message_insert    =    'A new entry has been successfully added.';
    }
    
# Data Select

	public function insert($lot_construction_id, $client_account_id)
	{
		$data['lot_construction_id']	=	$lot_construction_id * 1;
		$data['client_account_id']			=	$client_account_id * 1;
		$data['client_account_construction_timestamp']			=	time();			
		$sql	=	sql_insert($this->table_name, $data);	
	}
    
}
