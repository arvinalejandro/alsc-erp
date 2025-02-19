<?php
class model_account_payable
{    
    
    public function __construct()
    {
        $this->table_name        =    'account_payable';
        $this->message_insert    =    'A new Request has been successfully added.';
    }
    
# Data Select

     public function get_row($id)
    {        
        $id        =    string_clean_number($id);
      
        $query     =    "
                            select 
                            
                            *
                             
                            from 
                            
                            account_payable 
                            
                            
                            WHERE 
                            
                            account_payable.account_payable_id = {$id}
                        ";        
                                
        $rows                						    =    sql_select($query);
        $ticket_row         						    =    $rows[0];
        $ticket_row['ofv_balance_amount']               =    string_amount($ticket_row['ofv_balance_amount']);
        return $ticket_row;
    }
    
     public function get_unliquidated_amount($date_month='2014-6')
    {        
      
        $query     =    "
                            select 
                            
                            SUM(CASE WHEN request_approved_amount > 0 THEN request_approved_amount ELSE 0 END) AS item_total
                             
                            from 
                            
                            account_payable 
                            
                            
                            WHERE 
                            
                            is_liquidated = 0
                           
                            AND DATE_FORMAT(FROM_UNIXTIME(`request_release_date`), '%Y-%c') = '{$date_month}'
                            
                            AND request_type_id IN('rfp','tba')
                        ";        
                                
        $rows                						    =    sql_select($query);
        $ticket_row         						    =    $rows[0];
        return $ticket_row;
    }
    
    
    public function select_ticket($fname,$ticket_id,$level_id,$status_id,$item_row,$row_tab='finance_disbursement',$item_details,$filter = '')//$item_details for Completed Tab
    {        
        $ticket_id        =    string_clean_number($ticket_id);
        $query     		  =    "
        
                            select 
                        *,
                        (select request_approval_status_name from request_approval_status where request_approval_status_id = account_payable.request_approval_status_id) as request_approval_status_name,
                        (select request_type_name from request_type where request_type_id = account_payable.request_type_id) as request_type_name,
                        (select option_department_name from option_department where option_department_id = account_payable.option_department_id) as option_department_name,
                        (select option_payment_method_name from option_payment_method where option_payment_method_id = account_payable.option_payment_method_id) as option_payment_method_name
                       
                        
                            from account_payable                     
                                            
                            where account_payable.request_approval_level_id = '{$level_id}'
                            AND   account_payable.account_payable_id = {$ticket_id}
                            AND   account_payable.request_approval_status_id = '{$status_id}'
                            
        
                        ";        
                                
        $rows                                           =    sql_select($query);
        $ticket_row                                     =    $rows[0];
        $ticket_row['reimbursement_row']				=   '';
        if($ticket_row['is_reimbursement'] == 1)
        {
			 $template_reimburse                        =    'treasury/template/profile.reimbursement';
             $template_reimburse                        =    view_get_template($template_reimburse);
             $re_row['reimbursement_amount']            =    string_amount($ticket_row['reimbursement_amount']);
			 $ticket_row['reimbursement_row']           =    view_populate($re_row, $template_reimburse);
        }
        
        #for tax ticket
        if($ticket_row['request_type_id'] == 'tax')
        {
			$ticket_row['total_net']                    =    $item_row['total_net'];
			$ticket_row['total_tax']                    =    $item_row['total_tax'];
			$ticket_row['total_gross']                  =    $item_row['total_gross'];
			$ticket_row['tax_row']                      =    $item_row['row'];
			
        }
        else
        {
			 $ticket_row['items']                       =    $item_row['rows'];
       		 $ticket_row['total']                       =    string_amount($item_row['total']);
        }
        
        $ticket_row['item_details']                     =    $item_details; // for completed tab
        $ticket_row['request_amount']                   =    string_amount($ticket_row['request_amount']);
        $ticket_row['request_approved_amount']          =    string_amount($ticket_row['request_approved_amount']);
        $ticket_row['account_payable_timestamp']        =    string_date_time($ticket_row['account_payable_timestamp']);
        $ticket_row['request_date_needed']              =    string_date($ticket_row['request_date_needed']);
        $ticket_row['request_approved_date']            =    (empty($ticket_row['request_approved_date']) ? '' : string_date_time($ticket_row['request_approved_date']));
        $ticket_row['request_release_date']             =    (empty($ticket_row['request_release_date']) ? '' : string_date_time($ticket_row['request_release_date']));
        $template_row                                   =    $row_tab.'/template/'.$fname;
        $template_row                                   =    view_get_template($template_row);
       
        # Parse
        if(count($ticket_row))
        {
                  
                  $list       =    view_populate($ticket_row, $template_row);
                        
        }
        else
        {
            $list             =    '';
        }
        return $list;
    }
    
    public function select_all_ticket($level_id,$status_id,$row_tab='finance_disbursement',$filter = '')
    {        
       //AND account_payable.request_approval_status_id = '{$status_id}'
       // $append    =    ($status_id != 0 ? "" : "AND account_payable.request_approval_status_id NOT IN ('declined','revoked')") ; 
        $append    =    ($level_id == 'completed' ? "OR (account_payable.request_approval_status_id IN('declined','revoked'))" : $append) ; 
        $query     =    "
                            select 
                        *,
                        (select request_approval_status_name from request_approval_status where request_approval_status_id = account_payable.request_approval_status_id) as request_approval_status_name,
                        (select request_approval_level_name from request_approval_level where request_approval_level_id = account_payable.request_approval_level_id) as request_approval_level_name,
                        (select request_type_name from request_type where request_type_id = account_payable.request_type_id) as request_type_name
                        
                            from account_payable                     
                                            
                            where 
                             
                             ( account_payable.request_approval_level_id = '{$level_id}'
                            
                            AND request_type_id IN('rfp','ofv','tba'))
                           
                             
                            {$append}
                            
                          
                            
                            ORDER BY  account_payable.account_payable_timestamp DESC
                        ";        
                                
        $rows                =    sql_select($query);        
        $template_row        =    $row_tab.'/template/row.'.$level_id;
        $template_row        =    view_get_template($template_row);
        //hash_dump($row_tab,1);
        # Parse
        if(count($rows))
        {
            foreach($rows as $row)
            {        
				switch ($row['request_approval_status_id']) 
				{
				     case "declined":
				         $row['class_status'] = 'color_red';
				         break;
				     case "revoked":
				         $row['class_status'] = 'color_red';
				         break;
				     case "hold":
				         $row['class_status'] = 'color_red';
				         break;
				     case "reimbursement":
				         $row['class_status'] = 'color_red';
				         break;
                     case "approved":
                         $row['class_status'] = 'color_blue';
                         break;  
                     case "signed":
                         $row['class_status'] = 'color_green';
                         break;          
                     case "ready":
                         $row['class_status'] = 'color_blue';
                         break;    
                     case "released":
                         $row['class_status'] = 'color_green';
                         break;  
				     default:
				         $row['class_status'] = 'color_gray';
				}
                $row['request_amount']                    =    string_amount($row['request_amount']);
                $row['request_approved_amount']           =    string_amount($row['request_approved_amount']);
                $row['account_payable_timestamp']         =    string_date_time($row['account_payable_timestamp']);
                $row['request_release_date']              =    string_date_time($row['request_release_date']);
                $list                                    .=    view_populate($row, $template_row);
            }            
        }
        else
        {
            $template_row        =    'finance_disbursement/template/row.empty';
            $list    			 =   view_get_template($template_row);
           // $list    			 =    view_populate($row, $template_row);;
        }
        
         return $list;
       
    }
    
    
     public function select_ongoing_ticket($filter = '')
    {        
        $query     =    "
                            select 
                        *,
                        (select request_approval_status_name from request_approval_status where request_approval_status_id = account_payable.request_approval_status_id) as request_approval_status_name,
                        (select request_approval_level_name from request_approval_level where request_approval_level_id = account_payable.request_approval_level_id) as request_approval_level_name,
                        (select request_type_name from request_type where request_type_id = account_payable.request_type_id) as request_type_name
                        
                            from account_payable                     
                                            
                            where account_payable.request_approval_level_id != 'completed'
                            {$filter}
                            
                            AND account_payable.request_approval_status_id NOT IN ('declined','revoked')
                            
                            AND account_payable.request_approval_level_id NOT IN ('dept_head')
                            
                            ORDER BY  account_payable.account_payable_timestamp DESC
                        ";        
                                
        $rows                =    sql_select($query);        
        $template_row        =    'finance_disbursement/template/row.dept_head_ongoing';
        $template_row        =    view_get_template($template_row);
        # Parse
        if(count($rows))
        {
            foreach($rows as $row)
            {        
				switch ($row['request_approval_status_id']) 
				{
				     case "declined":
				         $row['class_status'] = 'color_red';
				         break;
				     case "revoked":
				         $row['class_status'] = 'color_red';
				         break;
				     case "hold":
				         $row['class_status'] = 'color_red';
				         break;
				     case "reimbursement":
				         $row['class_status'] = 'color_red';
				         break;
                     case "approved":
                         $row['class_status'] = 'color_blue';
                         break;  
                     case "signed":
                         $row['class_status'] = 'color_green';
                         break;          
                     case "ready":
                         $row['class_status'] = 'color_blue';
                         break;    
                     case "released":
                         $row['class_status'] = 'color_green';
                         break;  
				     default:
				         $row['class_status'] = 'color_gray';
				}
                $row['request_amount']                    =    string_amount($row['request_amount']);
                $row['request_approved_amount']           =    string_amount($row['request_approved_amount']);
                $row['account_payable_timestamp']         =    string_date_time($row['account_payable_timestamp']);
                $row['request_release_date']              =    string_date_time($row['request_release_date']);
                $list                                    .=    view_populate($row, $template_row);
            }            
        }
        else
        {
            $template_row        =    'finance_disbursement/template/row.empty';
            $list    			 =   view_get_template($template_row);
        }
        
         return $list;
       
    }
    
    //==========Accounting Reports	
	public function select_grouped_commission($date_month='2015-06')
    {        
        $query     =    "
                            SELECT 
        
        					is_commission

							FROM 

							account_payable

							WHERE DATE_FORMAT(FROM_UNIXTIME(`request_release_date`), '%Y-%m') = '{$date_month}'
							
							AND is_commission != 0 
							 
							AND is_commission_group = 1
                          
                        ";        
                                
        $rows           =    sql_select($query);        
      
        # Parse
       
        return $rows;
    }
	
	
	public function select_non_commission_tax($date_month='2015-06')
    {        
        $query     =    "
                            SELECT 
							account_payable.account_payable_id,account_payable.request_accounted_to,account_payable.request_amount
							,account_payable_cheque.account_payable_cheque_id
							,account_payable_cheque.released_date
							, SUM(account_payable_cheque_amount) AS cheque_amount
							FROM 

							account_payable

							inner join account_payable_cheque ON account_payable_cheque.account_payable_id = account_payable.account_payable_id  AND  DATE_FORMAT(FROM_UNIXTIME(`released_date`), '%Y-%c') = '{$date_month}'


							WHERE DATE_FORMAT(FROM_UNIXTIME(`request_release_date`), '%Y-%c') = '{$date_month}'

							AND is_commission = 0

							GROUP BY account_payable.account_payable_id

                          
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

    public function insert($post,$ofv=0)
    {
       
        $data                                                       =    sql_parse_input('account_payable', $post);
        $data['request_date_needed']                                =    strtotime($data['request_date_needed']);
        if($ofv == 1)
        {
			$data['request_approval_level_id']                      =    'exec_approve'; 
            $data['request_approval_status_id']                     =    'approved';
        }
        else
        {
			$data['request_approval_level_id']                      =    'dept_head'; 
            $data['request_approval_status_id']                     =    'recommended';
        } 
        
        $sql                                                        =    sql_insert($this->table_name, $data,'account_payable_id');      
        $return['result']                                           =    true;
        $return['data']                                             =    $sql;
        $return['message']                                          =    $this->message_insert; 
        return $return;       
    }
    
    
    public function insert_jv($post)
    {
       
        $data                                                       =    sql_parse_input('account_payable', $post);
        $data['request_date_needed']                                =    time();
        $data['request_release_date']                               =    time();
		$data['request_approval_level_id']                      	=    'completed'; 
        $data['request_approval_status_id']                     	=    'released';
        $sql                                                        =    sql_insert($this->table_name, $data,'account_payable_id');      
        $return['result']                                           =    true;
        $return['data']                                             =    $sql;
        $return['message']                                          =    $this->message_insert; 
        return $return;       
    }
        
    public function update($post, $id)
    {
       
        $data                    =    sql_parse_input('account_payable', $post);    
                                      sql_update($this->table_name, 'account_payable_id', $id, $data);        
        $return['result']        =    true;
        $return['data']          =    '';
        $return['message']       =    $this->message_update;
        return $return; 
        
    }
         
    
}
