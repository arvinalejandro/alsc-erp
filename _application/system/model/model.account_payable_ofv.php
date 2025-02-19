<?php
class model_account_payable_ofv
{	
	
	public function __construct()
	{
		$this->table_name		=	'account_payable_ofv';
		$this->message_insert	=	'A new OFV has been successfully added.';
	}
	
# Data Select

	 public function get_rows()
    {        
        $query    			 =    "
        					       SELECT 
        					       * ,
                        		(select request_requestor from account_payable where account_payable_id = account_payable_ofv.account_payable_id) as request_requestor
        					       FROM 
        					       account_payable_ofv 
        					       
        					       WHERE is_replenished = 0
        					       AND is_released = 1
                                  "; 
        $rows      			 =    sql_select($query);  
        $template_row        =    'finance_disbursement/template/row.ofv';
        $template_row        =    view_get_template($template_row);       
       # Parse
        if($rows)
        {
            foreach($rows as $row)
            {        
                $row['account_payable_ofv_amount']        =    string_amount($row['account_payable_ofv_amount']);
                $row['account_payable_ofv_release_date']  =    string_date($row['account_payable_ofv_release_date']);
                $list['row_id'][]                         =    $row['account_payable_ofv_id'];
                $list['trans.row']                       .=    view_populate($row, $template_row);
                $list['trans.total']                     +=    string_clean_number($row['account_payable_ofv_amount']);
            }   
            $list['trans.total']                          =    string_amount($list['trans.total']);     
        }
        else
        {
            $template_row        			 =   'finance_disbursement/template/row.empty_replenish';
            $list['trans.row']    			 =   view_get_template($template_row);
            $list['trans.total']			 =   '0.00';
        }
        return $list;
    }
    
    
    
    public function get_rows_by_account_payable($id,$filter='')
    {        
        $id 				 =   $id*1;
        $query    			 =    "
        					       SELECT 
        					       
        					       *
        					       
        					       FROM 
        					       
        					       account_payable_ofv 
        					       
        					       WHERE account_payable_id = {$id}
        					       
        					       {$filter}
        					       
                                  "; 
        $rows      			 =    sql_select($query);  
        $template_row        =    'finance_disbursement/template/row.ofv_payable';
        $template_row        =    view_get_template($template_row);       
       # Parse
        if($rows)
        {
            foreach($rows as $row)
            {        
                $row['account_payable_ofv_amount']        =    string_amount($row['account_payable_ofv_amount']);
                $row['account_payable_ofv_release_date']  =    string_date($row['account_payable_ofv_release_date']);
                $list['row']            				 .=    view_populate($row, $template_row);
                $list['account_payable_ofv_id']           =    $row['account_payable_ofv_id'];
            }   
        }
        else
        {
           $list['row']            				          =    '';
           $list['account_payable_ofv_id']                =    '';
        }
        return $list;
    }
    
    
    public function select_ofv($id)
    {        
        $id					 =   $id*1;
        
        $query    			 =    "
        					       SELECT 
        					       * 
        					       FROM 
        					       account_payable_ofv 
        					       
        					       WHERE account_payable_ofv_id = {$id}
        					     
                                  "; 
        $rows      			 =    sql_select($query);  
        $row	             =    $rows[0];
        
        return $row;
    }	


 

# Modify

	public function insert($post)
	{
		if($post['account_payable_ofv'])
		{
			$data										    =	sql_parse_input('account_payable_ofv', $post['account_payable_ofv']);
			$data['account_payable_id']						=   $post['account_payable_id'];
			$data['user_id']								=   $post['user_id'];
			$data['account_payable_ofv_release_date']		=   $post['account_payable_ofv_release_date'];
			$sql							                =	sql_insert($this->table_name, $data);
			$return['result']							    =	true;
		    $return['data']									=	$sql;
		    $return['message']								=	$this->message_insert;
		
		}
		               
		return 		$return;
				
	}
	
	public function update_released($id,$tran_id=0)
    {
	    $data['is_released'] 	 		 =    1;                    
	    $data['bank_transaction_id'] 	 =    $tran_id;                    
        sql_update($this->table_name, 'account_payable_ofv_id', $id, $data); 
        $return['result']        =    true;
        $return['data']          =    '';
        $return['message']       =    $this->message_update;
        return 		$return;
        
    }
    
    public function update_replenished($post)
    {
	   if($post)
		{
			foreach($post as $row)
			{
				$data['is_replenished']     =  1;
			    sql_update($this->table_name, 'account_payable_ofv_id', $row, $data);		
			}
		}
        $return['result']        =    true;
        $return['data']          =    '';
        $return['message']       =    $this->message_update;
        return 		$return;
        
    }
    

    		
}
