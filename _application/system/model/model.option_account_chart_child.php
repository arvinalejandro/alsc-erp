<?php
class model_option_account_chart_child
{    
    
    public function __construct()
    {
        $this->table_name        =    'option_account_chart_child';
        $this->message_insert    =    'A new item has been successfully added.';
    }
    
# Data Select

   
     public function select_all_by_parent($id)
	{		
		$query	=	"select 
						
						* 
					   
					   from 
					   
					   option_account_chart_child
					   
					   WHERE
					   
					   option_account_chart_parent_id = {$id} 					
						";		
								
		$rows	=	sql_select($query);		
		return $rows;
	}
	
	
	 public function select_all_water_related()
	{		
		$query	=	"select 
						
						* 
					   
					   from 
					   
					   option_account_chart_child
					   
					   WHERE
					   
					   is_water_related = 1 					
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
