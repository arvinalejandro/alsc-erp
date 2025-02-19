<?php
class model_option_account_chart_parent
{    
    
    public function __construct()
    {
        $this->table_name        =    'option_account_chart_parent';
        $this->message_insert    =    'A new item has been successfully added.';
    }
    
# Data Select

   
    public function select_all()
	{		
		$query	=	"select 
						
						* 
					   
					   from 
					   
					   option_account_chart_parent 					
						";		
								
		$rows	=	sql_select($query);		
		return $rows;
	}
 

# Modify
    public function insert($post)
    {
	   
	     $sql                                            =    sql_insert($this->table_name, $post);
        $return['result']                =    true;
        $return['data']                  =    $sql;
        $return['message']               =    $this->message_insert;        
    }
            
}
