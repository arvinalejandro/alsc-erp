<?php
class model_bank_jv
{    
    
    public function __construct()
    {
        $this->table_name        =    'bank_jv';
        $this->message_insert    =    'A new bank_jv has been successfully added.';
    }
    
# Data Select

    
    public function get_rows_by_jv_type($bank_id, $jv_type)
    {        
        $query     =    "
                           select * from bank_jv 
                           
                           WHERE
                           
                        ";        
        $rows      			 =    sql_select($query);  
     
    }
    
    
    
#modify    
 public function insert($post)
	{
		if($post)
		{
			$sql												 =	sql_insert($this->table_name, $post);		
			$return['result']									 =	true;
			$return['data']										 =	$sql;
			$return['message']									 =	$this->message_insert;	
		}
		
		return	$return;
	}
    
            
}
