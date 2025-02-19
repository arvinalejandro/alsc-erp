<?php
class model_commission_contingency
{    
    
    public function __construct()
    {
        $this->table_name        =    'commission_contingency';
        $this->message_insert    =    'A new document has been successfully added.';
    }
    
# Data Select

    public function select_all($id,$filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                        ";        
        $rows                =    sql_select($query);    
       
        # Parse
        if(count($rows))
        {
            foreach($rows as $row)
            {        
               
            }            
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }
    
    
 
# Modify

    public function insert($bt_id,$caa_id)
    {
        $data['client_account_agent_id']            =    $caa_id;
        $data['bank_transaction_id']            	=    $bt_id;
        $sql                                    	=    sql_insert($this->table_name, $data);
               
        $return['result']                			=    true;
        $return['data']                  			=    $sql;
        $return['message']               			=    $this->message_insert;        
    }
    
}
