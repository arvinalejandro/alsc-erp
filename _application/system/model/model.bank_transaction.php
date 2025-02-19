<?php
class model_bank_transaction
{	
	
	public function __construct()
	{
		$this->table_name		=	'bank_transaction';
		$this->message_insert	=	'A new transaction has been successfully added.';
	}
	
# Data Select

    
     public function get_transaction($id, $filter = '')// temporary single cheque
    {        
        $id        =    string_clean_number($id);
        $query     =    "
        					SELECT * FROM bank_transaction WHERE account_payable_id = {$id} AND is_pending = 1 AND (bank_id = 6 OR bank_pair_id = 6)
                        "; 
        $rows      =    sql_select($query);  
        $row	   =    $rows[0];  
        
        if($row['bank_transaction_id'] > 0)
        {
			return $row; 
        }    
        
    }
    
    
    public function get_jv_transaction($bank_id, $filter = '')// temporary single cheque
    {        
        $bank_id        =    string_clean_number($bank_id);
        $query     		=    "
        					 SELECT * FROM bank_transaction
        					
        					 WHERE
        					
        					 bank_transaction.bank_id = {$bank_id} 
        					 
        					 AND option_bank_transaction_category_id IN('jv_bank_charges_in','jv_bank_charges_out','payment','jv_cancelled_cheque_in','jv_cancelled_cheque_out','jv_commission_in','jv_commission_out','jv_tax_in','jv_tax_out')
                       		 "; 
        $rows      		=    sql_select($query);  
     
       
        
    }
    
    
    public function select_transaction($id,$bank,$filter = '')
    {        
          $id        =    string_clean_number($id);
        
        $query     =    "
        					SELECT 
        					
        					*,
        					(SELECT option_bank_transaction_type_name FROM  option_bank_transaction_type WHERE option_bank_transaction_type.option_bank_transaction_type_id  = bank_transaction.option_bank_transaction_type_id) AS option_bank_transaction_type_name,
        					(SELECT option_bank_transaction_category_name FROM  option_bank_transaction_category WHERE option_bank_transaction_category.option_bank_transaction_category_id  = bank_transaction.option_bank_transaction_category_id) AS option_bank_transaction_category_name
        					 
        					FROM 
        					
        					bank_transaction
        					
        					LEFT JOIN bank ON bank.bank_id = bank_transaction.bank_pair_id
        					
        					WHERE bank_transaction.bank_transaction_id = {$id} 
        					
        
                        ";        
                                
        $rows                =    sql_select($query);
        $row	             =    $rows[0];
        $template_row        =    'finance_accounting/template/profile.bank_transaction';
        $template_row        =    view_get_template($template_row);
       
        # Parse
        if(count($row))
        {
                  
                if($row['option_bank_transaction_category_id'] == 'fund_transfer_out')
                {
					$row['bank_destination'] =  '(To) '.$row['bank_name'].' - '.$row['bank_branch'];
					
                }
                elseif($row['option_bank_transaction_category_id'] == 'fund_transfer_in')
                {
					$row['bank_destination'] =  '(From) '.$row['bank_name'].' - '.$row['bank_branch'];
					
                }
                else
                {
					$row['bank_destination'] =   '-';
                }
                $row['bank_id']								=    $bank['bank_id'];		
                $row['bank_name']						    =    $bank['bank_name'];		
                $row['bank_branch']						    =    $bank['bank_branch'];		
                $row['transaction_status']					=    ($row['is_pending'] == 0 ? 'Completed' : 'Pending');
                $row['bank_transaction_depositor']			=    ($row['option_bank_transaction_type_id'] == 'in' ? $row['bank_transaction_depositor'] : 'N/A');
                $row['transaction_class']					=    ($row['option_bank_transaction_type_id'] == 'in' ? 'color_green' : 'color_red');
                $row['bank_transaction_timestamp']       	=    string_date_time($row['bank_transaction_timestamp']);
                $row['bank_transaction_amount']       	    =    string_amount($row['bank_transaction_amount']);
                $list                                       =    view_populate($row, $template_row);
                       
        }
        else
        {
            $list    =    '';
        }
       
        return $list;
    }
    
    public function select_transaction_by_bank($bank_id,$filter = '')
    {        
         $bank_id        =    string_clean_number($bank_id);
        
        $query     =    "
        					SELECT 
        					
        					*,
        					(SELECT option_bank_transaction_type_name FROM  option_bank_transaction_type WHERE option_bank_transaction_type.option_bank_transaction_type_id  = bank_transaction.option_bank_transaction_type_id) AS option_bank_transaction_type_name,
        					(SELECT option_bank_transaction_category_name FROM  option_bank_transaction_category WHERE option_bank_transaction_category.option_bank_transaction_category_id  = bank_transaction.option_bank_transaction_category_id) AS option_bank_transaction_category_name
        					 
        					FROM 
        					
        					bank_transaction
        					
        					LEFT JOIN bank ON bank.bank_id = bank_transaction.bank_pair_id
        					
        					WHERE bank_transaction.bank_id = {$bank_id} 
        					
        					ORDER BY bank_transaction_timestamp DESC
        
                        ";        
                                
        $rows                =    sql_select($query);
        $template_row        =    'finance_accounting/template/row.bank_transaction';
        $template_row        =    view_get_template($template_row);
       
        # Parse
        if(count($rows))
        {
            foreach($rows as $row)
            {        
                
                if($row['option_bank_transaction_category_id'] == 'fund_transfer_out')
                {
					$row['bank_destination'] 					    =  '(To) '.$row['bank_name'].' - '.$row['bank_branch'];
                }
                elseif($row['option_bank_transaction_category_id'] == 'fund_transfer_in')
                {
					$row['bank_destination'] 						=  '(From) '.$row['bank_name'].' - '.$row['bank_branch'];
                }
                else
                {
					$row['bank_destination'] =   '-';
                }
                
                if($row['option_bank_transaction_type_id'] == 'in')
                {
					$row['transaction_class']				=	'color_green';
					$row['bank_transaction_amount_in']      =    string_amount($row['bank_transaction_amount']);
					$row['bank_transaction_amount_out']     =    string_amount(0);
                }
                else
                {
					$row['transaction_class']				=    'color_red';
					$row['bank_transaction_amount_out']     =    string_amount($row['bank_transaction_amount']);
					$row['bank_transaction_amount_in']      =    string_amount(0);
                }
                $row['bank_id']								=    $bank_id;		
                $row['bank_transaction_timestamp']       	=    string_date_time($row['bank_transaction_timestamp']);
               
                $row['transaction_status']					=    ($row['is_pending'] == 0 ? 'Completed' : 'Pending');
                
                $list                                      .=    view_populate($row, $template_row);
            }            
        }
        else
        {
            $list    =    '';
        }
       
        return $list;
    }

# Modify

	public function insert($post)
	{
		$data												 =	sql_parse_input('bank_transaction', $post);                
		$sql												 =	sql_insert($this->table_name, $data,'bank_transaction_id');		
		$return['result']									 =	true;
		$return['data']										 =	$sql;
		$return['message']									 =	$this->message_insert;	
		return	$return;
	}
	
	public function insert_disbursement_ofv($post,$handler,$bank_id=6)
	{
		$data['bank_id']								     =  $bank_id;	
		$data['account_payable_id']						     =  $post['account_payable_id'];			
		$data['bank_transaction_amount']					 =  string_clean_number($post['account_payable_ofv_amount']);			
		$data['bank_transaction_timestamp']          		 =  time();			
		$data['handled_by']          		 				 =  $handler;			
		$data['option_bank_transaction_category_id']         =  'disbursement';			
		$data['option_bank_transaction_type_id']           	 =  'out';
		$data['bank_transaction_details']           	     =  'Computer Generated - Disbursement Entry';
		$sql    											 =	sql_insert($this->table_name, $data, 'bank_transaction_id');
		$return['result']									 =	true;
		$return['data']										 =	$sql;
		$return['message']									 =	$this->message_insert;	
		return	$return;
	}
	
	public function insert_collections($collection_amount,$account_receive_id,$bank_id=7)
	{
		$data['bank_id']								     =  $bank_id;	
		$data['account_payable_id']						     =  0;			
		$data['bank_transaction_amount']					 =  string_clean_number($collection_amount);			
		$data['bank_transaction_timestamp']          		 =  time();			
		$data['handled_by']          		 				 =  'Computer Genterated';			
		$data['option_bank_transaction_category_id']         =  'cashier';			
		$data['option_bank_transaction_type_id']           	 =  'in';
		$data['bank_transaction_details']           	     =  '<a target="_blank" class="link_button_inline blue" href="/finance_cashier/transaction/profile/&id='.$account_receive_id.'">View Account</a>';
		$sql    											 =	sql_insert($this->table_name, $data, 'bank_transaction_id');
		
		$return['result']									 =	true;
		$return['data']										 =	$sql;
		$return['message']									 =	$this->message_insert;	
		return	$return;
	}
	
	public function insert_contingency($contingency,$c_id,$caa_id,$bank_id=8)
	{
		$data['bank_id']								     =  $bank_id;	
		$data['account_payable_id']						     =  0;			
		$data['bank_transaction_amount']					 =  string_clean_number($contingency);			
		$data['bank_transaction_timestamp']          		 =  time();			
		$data['handled_by']          		 				 =  'Computer Genterated';			
		$data['option_bank_transaction_category_id']         =  'commission_contingency';			
		$data['option_bank_transaction_type_id']           	 =  'in';
		$data['bank_transaction_details']           	     =  '<a target="_blank" class="link_button_inline blue" href="http://alsc/sales/commission/profile/&id='.$caa_id.'&c_id='.$c_id.'&entry_type=single">View Commission Profile</a>';
		$sql    											 =	sql_insert($this->table_name, $data, 'bank_transaction_id');
		$return['result']									 =	true;
		$return['data']										 =	$sql;
		$return['message']									 =	$this->message_insert;	
		return	$return;
	}
	
	public function insert_disbursement_cheque($post,$handler)
	{
		$count=0;
		
		if(count($post))
		{
			
			foreach($post as $row)
			{
				//hash_dump($post,true);
				$data['bank_id']								     =  $row['bank_id'];			
				$data['account_payable_id']						     =  $row['account_payable_id'];			
				$data['bank_transaction_amount']					 =  string_clean_number($row['account_payable_cheque_amount']);			
				$data['bank_transaction_timestamp']          		 =  time();			
				$data['handled_by']          		 				 =  $handler;			
				$data['is_pending']          		 				 =  1;			
				$data['option_bank_transaction_category_id']         =  'disbursement';			
				$data['option_bank_transaction_type_id']           	 =  'out';
				$data['bank_transaction_details']           	     =  'Computer Generated - Disbursement Entry';
				$sql    =	sql_insert($this->table_name, $data, 'bank_transaction_id');
				$ret[$count]['chq_id']								 = $row['account_payable_cheque_id'];
				$ret[$count]['tran_id']								 = $sql['data']['bank_transaction_id'];
				$count++;
			}
			
		}
		$return['result']									 =	true;
		$return['data']										 =	$ret;
		$return['message']									 =	$this->message_insert;	
		return	$return;
	}
	
	
	
	public function insert_replenish($post,$handler,$bank_id=6)
	{
		$count=0;
		if(count($post))
		{
			foreach($post as $row)
			{
				$data['bank_id']								     =  $bank_id;			
				$data['bank_pair_id']								 =  $row['bank_id'];	
				$data['account_payable_id']						     =  $row['account_payable_id'];		
				$data['bank_transaction_amount']					 =  string_clean_number($row['account_payable_cheque_amount']);			
				$data['bank_transaction_timestamp']          		 =  time();			
				$data['handled_by']          		 				 =  $handler;			
				$data['is_pending']          		 				 =  1;			
				$data['option_bank_transaction_category_id']         =  'fund_transfer_in';			
				$data['option_bank_transaction_type_id']           	 =  'in';
				$data['bank_transaction_details']           	     =  'Computer Generated - Disbursement Entry';
				$sql    =	sql_insert($this->table_name, $data, 'bank_transaction_id');
				$ret[$count]['chq_id']								 = $row['account_payable_cheque_id'];
				$ret[$count]['tran_id']								 = $sql['data']['bank_transaction_id'];
				$count++;
			}
			
			foreach($post as $row)
			{
				$data2['bank_id']								     =  $row['bank_id'];	
				$data2['account_payable_id']						 =  $row['account_payable_id'];		
				$data2['bank_pair_id']								 =  $bank_id;			
				$data2['bank_transaction_amount']					 =  string_clean_number($row['account_payable_cheque_amount']);			
				$data2['bank_transaction_timestamp']          		 =  time();			
				$data2['handled_by']          		 				 =  $handler;			
				$data2['is_pending']          		 				 =  1;			
				$data2['option_bank_transaction_category_id']        =  'fund_transfer_out';			
				$data2['option_bank_transaction_type_id']            =  'out';
				$data2['bank_transaction_details']           	     =  'Computer Generated - Disbursement Entry';
				$sql    =	sql_insert($this->table_name, $data2);
			}
			
		}
		$return['result']									 =	true;
		$return['data']										 =	$ret;
		$return['message']									 =	$this->message_insert;	
		return	$return;
	}
	
	public function insert_transfer($post)
	{
		$data												 =	sql_parse_input('bank_transaction', $post);                
		$sql												 =	sql_insert($this->table_name, $data);		
		
		$new_bank_pair										 =  $data['bank_id'];
		$data['bank_id']								     =  $data['bank_pair_id'];			
		$data['bank_pair_id']								 =  $new_bank_pair;			
		$data['option_bank_transaction_category_id']         =  'fund_transfer_in';			
		$data['option_bank_transaction_type_id']           	 =  'in';			
		$sql												 =	sql_insert($this->table_name, $data);	
		
		$return['result']									 =	true;
		$return['data']										 =	$sql;
		$return['message']									 =	$this->message_insert;	
		return	$return;
	}
	
	public function update_status($id)
    {
		$data['is_pending']   	     =    0;                
	    sql_update($this->table_name, 'bank_transaction_id', $id, $data); 
        $return['result']        	 =    true;
        $return['data']          	 =    '';
        $return['message']       	 =    $this->message_update;
        return 		$return;
        
    }
    		
}
