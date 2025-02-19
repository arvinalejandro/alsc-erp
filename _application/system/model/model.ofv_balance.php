<?php
class model_ofv_balance
{	
	
	public function __construct()
	{
		$this->table_name		=	'ofv_balance';
		$this->message_insert	=	'A new Request has been successfully added.';
	}
	
# Data Select

    public function select()
    {        
        
        $query     =    "
        						Select * FROM  ofv_balance
                        ";        
                                
        $rows                =    sql_select($query);
        $row           		 =    $rows[0];        
        # Parse
        $row['ofv_balance_amount'] = string_amount($row['ofv_balance_amount']);
        return $row;
    }
    
# Modify

	
	public function update($post,$id='amt')
    {
    	//hash_dump($post);
    	$up_post['ofv_balance_amount']     =    string_clean_number($post['ofv_request_amount']) + string_clean_number($post['ofv_current_amount']);
    	//hash_dump($up_post,true);
                                      sql_update($this->table_name, 'ofv_balance_id', $id, $up_post);        
        $return['result']        =    true;
        $return['data']          =    '';
        $return['message']       =    $this->message_update;
        return $return; 
        
    }
    
    public function update_less($post,$id='amt')
    {
    	//hash_dump($post);
    	$up_post['ofv_balance_amount']     =    string_clean_number($post['ofv_current_amount']) - string_clean_number($post['ofv_request_amount']);
    	//hash_dump($up_post,true);
                                      sql_update($this->table_name, 'ofv_balance_id', $id, $up_post);        
        $return['result']        =    true;
        $return['data']          =    '';
        $return['message']       =    $this->message_update;
        return $return; 
        
    }
    		
}
