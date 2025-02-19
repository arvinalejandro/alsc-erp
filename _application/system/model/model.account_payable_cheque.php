<?php
class model_account_payable_cheque
{	
	
	public function __construct()
	{
		$this->table_name		=	'account_payable_cheque';
		$this->message_insert	=	'A new Cheque has been successfully added.';
	}
	
# Data Select

	 public function get_cheque_status_row()
    {        
        $query    			 =    "
        					       SELECT 
        					       * ,
                        		(select bank_name from bank where bank.bank_id = account_payable_cheque.bank_id) as account_payable_cheque_bank
        					       FROM 
        					       account_payable_cheque WHERE is_released = 1
        					       ORDER BY account_payable_cheque_id DESC
                                  "; 
        $rows      			 =    sql_select($query);  
        $template_row        =    'treasury/template/row.chq_status';
        $template_row        =    view_get_template($template_row);       
       # Parse
        if($rows)
        {
            foreach($rows as $row)
            {        
                $row['chq_status']					 	  =    ($row['is_encashed'] == 1 ? 'Encashed' : 'Pending')	;
                $row['account_payable_cheque_amount']     =    string_amount($row['account_payable_cheque_amount']);
                $row['account_payable_cheque_date']       =    string_date($row['account_payable_cheque_date']);
                $row['released_date']       			  =    string_date($row['released_date']);
                $list                                    .=    view_populate($row, $template_row);
            }            
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }	


     public function get_exec_row($id,$filter = '')
    {        
        $id                  =    string_clean_number($id);
        $rows				 =    $this->select_all_cheque($id);
        $template_row        =    'finance_accounting/template/row.account_payable_cheque_sign';
        $template_row        =    view_get_template($template_row);       
       # Parse
        if($rows)
        {
            foreach($rows as $row)
            {        
                
                $row['account_payable_cheque_amount']     =    string_amount($row['account_payable_cheque_amount']);
                $row['account_payable_cheque_date']       =    string_date($row['account_payable_cheque_date']);
                $list                                    .=    view_populate($row, $template_row);
            }            
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }
    
    
    public function get_details_row($id,$b_opt='',$filter = '')
    {        
        $id                  =    string_clean_number($id);
        $rows				 =    $this->select_all_cheque($id);
        $template_row        =    'treasury/template/row.account_payable_cheque';
        $template_row        =    view_get_template($template_row);       
       # Parse
        if($rows)
        {
            foreach($rows as $row)
            {        
                
                $row['bank_opt']     					  =     $b_opt;
                $row['account_payable_cheque_amount']     =    string_amount($row['account_payable_cheque_amount']);
                $row['account_payable_cheque_date']       =    string_date($row['account_payable_cheque_date']);
                $list                                    .=    view_populate($row, $template_row);
            }            
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }
    
    public function get_release_row($id,$filter = '')
    {        
        $id                  =    string_clean_number($id);
        $rows				 =    $this->select_all_cheque($id);
        $template_row        =    'treasury/template/row.account_payable_cheque_release';
        $template_row        =    view_get_template($template_row);       
       # Parse
       // hash_dump($rows,true);
        if($rows)
        {
            foreach($rows as $row)
            {        
                if($row['is_released'] == 1)
                {
                	$row['released_date']       =    string_date_time($row['released_date']);
				}
                else
                {
					$row['released_date']       =    ' 
														<select style="float:left;" name="account_payable_cheque['.$row['account_payable_cheque_id'].'][int][is_released]">
				                                            <option value="1">Released</option>
				                                            <option value="0" selected="selected">Hold</option>
				                                        </select>';
                }
                
                
                $row['account_payable_cheque_amount']     =    string_amount($row['account_payable_cheque_amount']);
                $row['account_payable_cheque_date']       =    string_date($row['account_payable_cheque_date']);
                $list                                    .=    view_populate($row, $template_row);
            }            
        }
        else
        {
            $list    =    '';
        }
        
        return $list;
    }
    
    
    public function select_all_cheque($id, $filter = '')
    {        
        $id        =    string_clean_number($id);
        $query     =    "
        					SELECT *,
                        		(select bank_name from bank where bank.bank_id = account_payable_cheque.bank_id) as account_payable_cheque_bank 
        					
        					FROM 
        					account_payable_cheque
        					 
        					 WHERE account_payable_id = {$id} {$filter}
                        "; 
        $rows      =    sql_select($query);        
        return $rows;
    }
    
    public function count_pending_cheque($id, $filter = '')
    {        
        $id        =    string_clean_number($id);
        $query     =    "
        					SELECT COUNT(account_payable_cheque_id) AS c_count FROM account_payable_cheque WHERE account_payable_id = {$id} {$filter}
                        "; 
        $rows      =    sql_select($query);  
        $row	   =    $rows[0];      
        return $row;
    }
    
    public function select_released_cheque($post,$id, $filter = '')
    {        
        $released_id;
         foreach($post as $row)
        {
			$data                    =    sql_parse_input('account_payable_cheque', $row); 
			if($data['is_released'] == 1)
			{
				$released_id[]   	 =    $data['account_payable_cheque_id'];
			}
			                
        }
        
        $chq_id	   =    implode(",",$released_id);
        $id        =    string_clean_number($id);
        $query     =    "
        					SELECT * FROM account_payable_cheque WHERE account_payable_id = {$id}  AND account_payable_cheque_id  IN({$chq_id})
                        "; 
        $rows      =    sql_select($query);  
             
        return $rows;
    }
    
    public function select_cheque($id, $filter = '')
    {        
        $id        =    string_clean_number($id);
        $query     =    "
        					SELECT 
        					*,
                        		(select bank_name from bank where bank.bank_id = account_payable_cheque.bank_id) as account_payable_cheque_bank 
        					FROM account_payable_cheque WHERE account_payable_cheque_id = {$id} 
                        "; 
        $rows      =    sql_select($query);   
        $row       =    $rows[0];     
        return $row;
    }

# Modify

	public function insert($post)
	{
		
		if($post['account_payable_cheque'])
		{
			
			foreach($post['account_payable_cheque'] as $row)
			{
				$data										    =	sql_parse_input('account_payable_cheque', $row);
				$data['account_payable_cheque_timestamp']		=   time();
				$data['account_payable_cheque_date']		    =   strtotime($data['account_payable_cheque_date']);
			    $data['account_payable_id']						=   $post['account_payable_id'];
			    $data['user_id']								=   $post['user_id'];
				$sql							                =	sql_insert($this->table_name, $data);
			}
			 
			$return['result']				=	true;
		    $return['data']					=	$sql;
		    $return['message']				=	$this->message_insert;
		
		}
		               
		return 		$return;
				
	}
	
	public function update_details($post)
    {
        
        foreach($post as $row)
        {
			$data                =    sql_parse_input('account_payable_cheque', $row);                    
                                      sql_update($this->table_name, 'account_payable_cheque_id', $data['account_payable_cheque_id'], $data); 
        }
               
        $return['result']        =    true;
        $return['data']          =    '';
        $return['message']       =    $this->message_update;
        return 		$return;
        
    }
    
    public function update_release($post,$id)
    {
        
        foreach($post as $row)
        {
			$data                    =    sql_parse_input('account_payable_cheque', $row); 
			$data['released_date']   =    time();                
                                          sql_update($this->table_name, 'account_payable_cheque_id', $data['account_payable_cheque_id'], $data); 
        }
        $return['result']        	 =    true;
        $return['data']          	 =    '';
        $return['message']       	 =    $this->message_update;
        return 		$return;
        
    }
    
     public function update_transaction_cheque($post)
    {
        if(count($post))
        {
			foreach($post as $row)
	        {
				$data['bank_transaction_id']   =    $row['tran_id'];                
	            sql_update($this->table_name, 'account_payable_cheque_id', $row['chq_id'], $data); 
	        }
        }
        
        $return['result']        	 =    true;
        $return['data']          	 =    '';
        $return['message']       	 =    $this->message_update;
        return 		$return;
        
    }
    
    public function update_chq_status($post,$id)
    {
        
       if($post['is_encashed'] == 1)
       {
		   $post['encashed_date']   =    strtotime($post['encashed_date']); 
       }
                                          sql_update($this->table_name, 'account_payable_cheque_id', $post['account_payable_cheque_id'], $post); 
        $return['result']        	 =    true;
        $return['data']          	 =    '';
        $return['message']       	 =    $this->message_update;
        return 		$return;
        
    }
    

    		
}
