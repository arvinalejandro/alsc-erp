<?php
class model_account_payable_item
{    
    
    public function __construct()
    {
        $this->table_name        =    'account_payable_item';
        $this->message_insert    =    'A new item has been successfully added.';
    }
    
# Data Select

    public function select_all_item($id,$filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           select * from account_payable_item WHERE account_payable_id = {$id}
                        ";        
                                
        $rows                =    sql_select($query);        
        $template_row        =    'finance_disbursement/template/row.agent';
        $template_row        =    view_get_template($template_row);
        # Parse
        if(count($rows))
        {
            foreach($rows as $row)
            {        
                $list                                    .=    view_populate($row, $template_row);
            }            
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }
    
    public function get_item_row($id,$filter = '')
    {        
        $id            =    string_clean_number($id);
        
        $query         =    "
                           select * from account_payable_item WHERE account_payable_id = {$id}
                        ";        
        $query_sum     =    "
                           select SUM(account_payable_item_amount) AS total from account_payable_item WHERE account_payable_id = {$id}
                        ";                        
        $rows                =    sql_select($query);        
        $row_sum             =    sql_select($query_sum);        
        $list['total']       =    $row_sum[0]['total'];        
        $template_row        =    'finance_disbursement/template/row.items';
        $template_row        =    view_get_template($template_row);
        # Parse
        if(count($rows))
        {
            foreach($rows as $row)
            {        
                $row['account_payable_item_price']                =    string_amount($row['account_payable_item_price']);          
                $row['account_payable_item_amount']               =    string_amount($row['account_payable_item_amount']);          
                $list['rows']                                    .=    view_populate($row, $template_row);
            }            
        }
        else
        {
            $list['rows']    =    '';
        }
        return $list;
    }
    
    
    
    public function get_journal_entry_row($id,$filter = '')
    {        
        $id            =    string_clean_number($id);
        
        $query         =    "
                           select * from account_payable_item WHERE account_payable_id = {$id}
                        ";        
        $query_sum     =    "
                           select SUM(account_payable_item_amount) AS total from account_payable_item WHERE account_payable_id = {$id}
                        ";                        
        $rows                =    sql_select($query);        
        $row_sum             =    sql_select($query_sum);        
        $list['total']       =    $row_sum[0]['total'];        
        $template_row        =    'finance_accounting/template/row.items';
        $template_row        =    view_get_template($template_row);
        # Parse
        if(count($rows))
        {
            foreach($rows as $row)
            {        
                $row['parent_option']               		      =    $parent_option;          
                $row['account_payable_item_price']                =    string_amount($row['account_payable_item_price']);          
                $row['account_payable_item_amount']               =    string_amount($row['account_payable_item_amount']);          
                $list['rows']                                    .=    view_populate($row, $template_row);
            }            
        }
        else
        {
            $list['rows']    =    '';
        }
        return $list['rows'];
    }

# Modify

    public function insert($post,$id)
    {
        foreach($post as $row)
            {        
                 $data                                           =    sql_parse_input('account_payable_item', $row);
                 $data['account_payable_item_timestamp']         =    time();
                 $data['account_payable_id']                     =    $id;
                 $sql                                            =    sql_insert($this->table_name, $data);
            }        
        $return['result']                =    true;
        $return['data']                  =    $sql;
        $return['message']               =    $this->message_insert;        
    }
    
    
    public function liquidate_insert($post,$id,$detail_post,$particulars)
    {
        foreach($post as $row)
            {        
                //hash_dump($detail_post);echo 'haha<br>';
                 $parse_row['int']['account_payable_item_amount']    =   $row['int']['account_payable_item_amount'];			
                 $parse_row['int']['account_payable_item_price']	 =   $row['int']['account_payable_item_price'];			
                 $parse_row['int']['account_payable_item_qty']		 =   $row['int']['account_payable_item_qty'];			
                 $parse_row['str']['account_payable_item_desc']		 =   $row['str']['account_payable_item_desc'];			
                
                 $data                                           =    sql_parse_input('account_payable_item', $parse_row);
                 $data['account_payable_item_timestamp']         =    time();
                 $data['account_payable_id']                     =    $id;
                 $sql                                            =    sql_insert($this->table_name, $data,'account_payable_item_id');
                 $item_num										 =    $row['int']['item_number'];
                 $api_id										 =    $sql['data']['account_payable_item_id'];
				 mvc_model('model.account_payable_item_detail')->liquidate_insert($detail_post[$item_num],$id,$api_id,$particulars);
               
                 
                 
            }  
                
        $return['result']                =    true;
        $return['data']                  =    '';
        $return['message']               =    $this->message_insert;        
    }
    
    
    public function jv_insert($post,$id,$detail_post,$particulars,$transaction_id)
    {
        foreach($post as $row)
            {        
                //hash_dump($detail_post);echo 'haha<br>';
                 $parse_row['int']['account_payable_item_amount']    =   $row['int']['account_payable_item_amount'];			
                 $parse_row['int']['account_payable_item_price']	 =   $row['int']['account_payable_item_price'];			
                 $parse_row['int']['account_payable_item_qty']		 =   $row['int']['account_payable_item_qty'];			
                 $parse_row['str']['account_payable_item_desc']		 =   $row['str']['account_payable_item_desc'];			
                
                 $data                                           =    sql_parse_input('account_payable_item', $parse_row);
                 $data['account_payable_item_timestamp']         =    time();
                 $data['account_payable_id']                     =    $id;
                 $sql                                            =    sql_insert($this->table_name, $data,'account_payable_item_id');
                 $item_num										 =    $row['int']['item_number'];
                 $api_id										 =    $sql['data']['account_payable_item_id'];
				 mvc_model('model.account_payable_item_detail')->jv_insert($detail_post[$item_num],$id,$api_id,$particulars,$transaction_id);
            }  
                
        $return['result']                =    true;
        $return['data']                  =    '';
        $return['message']               =    $this->message_insert;        
    }
            
}
