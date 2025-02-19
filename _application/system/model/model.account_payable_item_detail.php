<?php
class model_account_payable_item_detail
{    
    
    public function __construct()
    {
        $this->table_name        =    'account_payable_item_detail';
        $this->message_insert    =    'A new item has been successfully added.';
    }
    
# Data Select

     
     public function get_taxable_items()//for deletion
    {        
          $id      =    string_clean_number($id);
        $query     =    "
        					SELECT 
        					
        					*,
        					(SELECT option_account_chart_child_name FROM option_account_chart_child WHERE option_account_chart_child_id = account_payable_item_detail.option_account_chart_child_id) AS option_account_chart_child_name,
        					(SELECT option_account_chart_parent_name FROM option_account_chart_parent WHERE option_account_chart_parent_id = account_payable_item_detail.option_account_chart_parent_id) AS option_account_chart_parent_name,
        					(SELECT project_name FROM project WHERE project_id = account_payable_item_detail.project_id) AS project_name,
        					(SELECT project_site_name FROM project_site WHERE project_site_id = account_payable_item_detail.project_site_id) AS project_site_name
        					 
        					FROM 
        					
        					account_payable_item_detail
        					
        					LEFT JOIN account_payable_item ON account_payable_item_detail.account_payable_item_id = account_payable_item.account_payable_item_id
        					
        					WHERE 
        					
        					tax_payed = 0
        					
        
                        ";        
                                
        $rows                =    sql_select($query);
        $template_row        =    'finance_disbursement/template/row.tax_item_details';
        $template_row        =    view_get_template($template_row);
       
        # Parse
        if(count($rows))
        {
                
               foreach($rows as $row)
               {
				    $row['item_net_amount']       	    =    string_amount($row['item_net_amount']);
	                $row['item_tax_amount']       	    =    string_amount($row['item_tax_amount']);
	                $row['item_gross_amount']       	=    string_amount($row['item_gross_amount']);
	                $list['row']                       .=    view_populate($row, $template_row);
	                $list['total_net']                 +=    string_clean_number($row['item_net_amount']);
	                $list['total_gross']               +=    string_clean_number($row['item_gross_amount']);
	                $list['total_tax']                 +=    string_clean_number($row['item_tax_amount']);
	                $list['row_id'][]                   =    $row['account_payable_item_detail_id'];
               }
               		$list['total_net']       	    	=    string_amount($list['total_net']);
	                $list['total_gross']       	    	=    string_amount($list['total_gross']);
	                $list['total_tax']       			=    string_amount($list['total_tax']);
                
                       
        }
        else
        {
            		
                    $template_row        			   =   'finance_disbursement/template/row.empty_tax';
                    $list['row']                       =    view_get_template($template_row);
	                $list['total_net']                 =    0.00;
	                $list['total_gross']               =    0.00;
	                $list['total_tax']                 =    0.00;
	                $list['row_id'][]                  =    '';
        }
       
        return $list;
    }
    
    
     public function select_item_details($id)
    {        
          $id      =    string_clean_number($id);
        $query     =    "
        					SELECT 
        					
        					*,
        					(SELECT option_account_chart_child_name FROM option_account_chart_child WHERE option_account_chart_child_id = account_payable_item_detail.option_account_chart_child_id) AS option_account_chart_child_name,
        					(SELECT option_account_chart_parent_name FROM option_account_chart_parent WHERE option_account_chart_parent_id = account_payable_item_detail.option_account_chart_parent_id) AS option_account_chart_parent_name,
        					(SELECT project_name FROM project WHERE project_id = account_payable_item_detail.project_id) AS project_name,
        					(SELECT project_site_name FROM project_site WHERE project_site_id = account_payable_item_detail.project_site_id) AS project_site_name
        					 
        					FROM 
        					
        					account_payable_item_detail
        					
        					LEFT JOIN account_payable_item ON account_payable_item_detail.account_payable_item_id = account_payable_item.account_payable_item_id
        					
        					WHERE account_payable_item_detail.account_payable_id = {$id} 
        					
        
                        ";        
                                
        $rows                =    sql_select($query);
        $template_row        =    'finance_disbursement/template/row.completed_item_details';
        $template_row        =    view_get_template($template_row);
       
        # Parse
        if(count($rows))
        {
                
               foreach($rows as $row)
               {
				    $row['item_net_amount']       	    =    string_amount($row['item_net_amount']);
	                $row['item_tax_amount']       	    =    string_amount($row['item_tax_amount']);
	                $row['item_gross_amount']       	=    string_amount($row['item_gross_amount']);
	                $list                              .=    view_populate($row, $template_row);
               }
                
                       
        }
        else
        {
            $list    =    '';
        }
       
        return $list;
    }
    
    
    
    public function select_cdv($id,$payment_method)
    {        
          $id      =    string_clean_number($id);
        $query     =    "
        					SELECT 
        					
        					*,
        					(SELECT option_account_chart_child_name FROM option_account_chart_child WHERE option_account_chart_child_id = account_payable_item_detail.option_account_chart_child_id) AS option_account_chart_child_name,
        					(SELECT option_account_chart_parent_name FROM option_account_chart_parent WHERE option_account_chart_parent_id = account_payable_item_detail.option_account_chart_parent_id) AS option_account_chart_parent_name,
        					(SELECT project_name FROM project WHERE project_id = account_payable_item_detail.project_id) AS project_name,
        					(SELECT project_site_name FROM project_site WHERE project_site_id = account_payable_item_detail.project_site_id) AS project_site_name
        					 
        					FROM 
        					
        					account_payable_item_detail
        					
        					LEFT JOIN account_payable_item ON account_payable_item_detail.account_payable_item_id = account_payable_item.account_payable_item_id
        					
        					WHERE account_payable_item_detail.account_payable_id = {$id} 
        					
        
                        ";        
                                
        $rows                =    sql_select($query);
        $template_row        =    'finance_disbursement/template/row.cdv';
        $template_row        =    view_get_template($template_row);
       
        # Parse
        if(count($rows))
        {
                $tax_amount = 0;
                $cash_amount = 0;
               foreach($rows as $row)
               {
				    $cash_amount	                   +=    $row['item_net_amount'];
				    $row['item_net_amount']       	    =    string_amount($row['item_net_amount']);
	                $row['item_gross_amount']       	=    string_amount($row['item_gross_amount']);
	                $tax_amount	                       +=    $row['item_tax_amount'];
	                $list                              .=    view_populate($row, $template_row);
               }
               $data['rows.cdv']	=     $list;
               $data['particulars']	=     $row['particulars'];
               $data['cash_desc']	=    ($payment_method == 'cash' ? 'Cash on Hand' : 'Cash in Bank');
               $data['tax_amt']		=    string_amount($tax_amount);
               $data['cash_amt']    =    string_amount($cash_amount);
               $template_row        =    'finance_disbursement/template/profile.cdv';
       		   $template_row        =    view_get_template($template_row);
       		   $list                =    view_populate($data, $template_row);
        }
        else
        {
            $list    =    '';
        }
       
        return $list;
    }
  
  
  
    //==========Accounting Reports	

	public function select_jv_summary($date_month='2015-6',$filter='')
    {        
        $projects  			 =     mvc_model('model.project')->select_all();
        $project_site  	   	 =     mvc_model('model.project_site')->select_row($project_id);
        $coc_parent  		 =     mvc_model('model.option_account_chart_parent')->select_all();
        $parent_template     =    'finance_accounting/template/row.trial_balance_parent';
        $parent_template     =    view_get_template($parent_template);
        $child_template      =    'finance_accounting/template/row.trial_balance_child';
        $child_template      =    view_get_template($child_template);
        $list				 =    '';
        $cr_total			 =    0;
        $dr_total			 =    0;
        foreach($coc_parent as $parent_row)
        {        
           
            $coc_child  	=     mvc_model('model.option_account_chart_child')->select_all_by_parent($parent_row['option_account_chart_parent_id']);
			if($parent_row['option_account_chart_parent_id'] == 11)
		    {
				foreach($projects as $project_row)
				{
					 $project_site  	=     mvc_model('model.project_site')->select_row($project_row['project_id']);
					 $parent_name		=     '';
					 foreach($project_site as $proj_s_row)
					 {
						 $parent_row['chart_parent'] =  $parent_row['option_account_chart_parent_name'].'-'.$project_row['project_name'].' '.$proj_s_row['project_site_name'] ; 
						 $temp_child_list	= '';
						 $parent_total	    = 0;
						 foreach($coc_child as $child_row)
          				 {
							  $query     	=    "
                            						SELECT 
                            						
                            						SUM(CASE WHEN item_net_amount > 0 THEN item_net_amount ELSE 0 END) AS item_total
                            						
                            						FROM account_payable_item_detail 
                            						
                            						INNER JOIN account_payable ON account_payable.account_payable_id = account_payable_item_detail.account_payable_id AND DATE_FORMAT(FROM_UNIXTIME(`request_release_date`), '%Y-%c') = '{$date_month}'
                            						
                         							WHERE
                         							 
                         							
                         							project_id = {$project_row['project_id']}
                          							AND
                          							project_site_id	= {$proj_s_row['project_site_id']}
                          							
                          							AND option_account_chart_child_id = {$child_row['option_account_chart_child_id']}
                          							
                          							AND option_account_chart_parent_id = {$parent_row['option_account_chart_parent_id']}
                          							
                          							
                        						 ";        
			                  // hash_dump($query,true);           
							 $rows           			=    sql_select($query);
							 $chart_row	     			=    $rows[0];
							 $parent_total   		   +=   $chart_row['item_total']; 
							 $child_row['child_dr']		=    '0.00';    
						     $child_row['child_cr']		=    string_amount($chart_row['item_total']); 
							 $temp_child_list          .=    view_populate($child_row, $child_template);
						 }//end child loop
						 $cr_total					   +=	$parent_total;			
						 $parent_row['parent_dr']		=    '0.00';    
						 $parent_row['parent_cr']		=    string_amount($parent_total); 
						 $list         				   .=    view_populate($parent_row, $parent_template);
						 $list                         .=    $temp_child_list;
						
					 }//end proj site loop
					
				}// end proj loop
		    }
		    else
		    {
				  $temp_child_list	= '';
			      $parent_total	    = 0;
			      $parent_row['chart_parent'] =  $parent_row['option_account_chart_parent_name'];
				 foreach($coc_child as $child_row)
          		 {
					  $query     	=    "
                            				SELECT 
                            				
                            				SUM(CASE WHEN item_net_amount > 0 THEN item_net_amount ELSE 0 END) AS item_total
                            				
                            				FROM 
                            				
                            				account_payable_item_detail
                            				
                            				INNER JOIN account_payable ON account_payable.account_payable_id = account_payable_item_detail.account_payable_id  AND DATE_FORMAT(FROM_UNIXTIME(`request_release_date`), '%Y-%c') = '{$date_month}'
                            				
                         					WHERE 
                         					
                         					option_account_chart_child_id = {$child_row['option_account_chart_child_id']}
                          					
                          					AND option_account_chart_parent_id = {$parent_row['option_account_chart_parent_id']}
                          					
                          					
                        				 ";        
			                
					 $rows           			=    sql_select($query);
					 $chart_row	     			=    $rows[0];
					 $parent_total   		   +=   $chart_row['item_total']; 
					 $child_row['child_dr']		=    '0.00';    
					 $child_row['child_cr']		=    string_amount($chart_row['item_total']); 
					 $temp_child_list          .=    view_populate($child_row, $child_template);
				 }//end child loop
				 $cr_total					   +=	$parent_total; 
				 $parent_row['parent_dr']		=    '0.00';    
				 $parent_row['parent_cr']		=    string_amount($parent_total); 
				 $list         				   .=    view_populate($parent_row, $parent_template);
				 $list         				   .=    $temp_child_list;
		    }//else
          
            
            
            
        }//end foreach Parent
        $unliquidated           			=  mvc_model('model.account_payable')->get_unliquidated_amount($date_month);
        $return['list']						= $list;
        $return['cr_total']					= $cr_total;
        $return['dr_total']					= $dr_total;
        $return['unliquidated_total']		= string_amount($unliquidated['item_total']);
        return $return;
    }
    
    
    
    public function select_water_summary($date_month='2015-5',$filter='')
    {        
        $projects  		=     mvc_model('model.project')->select_all();
        $project_site  	=     mvc_model('model.project_site')->select_row($project_id);
        $coc_child  	=     mvc_model('model.option_account_chart_child')->select_all_water_related();
       
          foreach($coc_child as $child_row)
          {
				foreach($projects as $project_row)
				{
					 $project_site  	=     mvc_model('model.project_site')->select_row($project_row['project_id']);
					 foreach($project_site as $proj_s_row)
					 {
						 $query     	=    "
                            					SELECT 
                            					
                            					* 
                            					
                            					FROM account_payable_item_details 
                            					
                         						WHERE 
                         						
                         						project_id = {$project_row['project_id']}
                          						AND
                          						project_site_id	= {$proj_s_row['project_site_id']}
                          						
                          						AND option_account_chart_child_id = {$child_row['option_account_chart_child_id']}
                          						
                          						AND DATE_FORMAT(FROM_UNIXTIME(`account_payable_item_details_timestamp`), '%Y-%c') = '{$date_month}'
                          						
                        					 ";        
		                  
						 $rows           =    sql_select($query);
						 if(count($rows))
						 {
							 
						 }
						 
					 }
					
				}
		           
          }
            
        return $list;
    }
    
    
    
    public function select_cash_flow_per_project_monthly($parent_id,$date_month='2014-6')
    {        
        $projects  		=     mvc_model('model.project')->select_all();
       
       
		foreach($projects as $project_row)
		{
			 $project_site  	=     mvc_model('model.project_site')->select_row($project_row['project_id']);
			 foreach($project_site as $proj_s_row)
			 {
				 $query     	=    "
                            			SELECT * 
                            			FROM account_payable_item_details 
                            			
                         				WHERE 
                         				
                         				project_id = {$project_row['project_id']}
                          				
                          				AND DATE_FORMAT(FROM_UNIXTIME(`account_payable_item_details_timestamp`), '%Y-%c') = '{$date_month}'
                          				
                          				AND option_account_chart_parent_id = {$parent_id}
                        			 ";        
		                
				 $rows           =    sql_select($query);
				 if(count($rows))
				 {
					 
				 }
				 
			 }
			
		}
		           
        return $list;
    }
    
    
    public function select_cash_flow_per_project_annual($parent_id,$year='2014')
    {        
        for($i=1;$i<=12;$i++)
        {
			   $list           .= $this->select_cash_flow_per_project_monthly($parent_id,$year.'-'.$i);
        }

        return $list;
    }
    
    
     
  
  
  
  
   //for liquidate/journal entry AJAX
    public function get_row($post,$parent_option,$project_option,$liquidate=0)
    {        
        
        $request_folder	             = ($liquidate == 0 ? 'finance_accounting' : 'finance_disbursement');
        # Parse
        if($post)
        {
           	if($post['row_exist']==1)
           	{
				$template_row        =    $request_folder.'/template/row.form.journal_entry';
           	}
           	else
           	{
				$template_row        =    $request_folder.'/template/row.form_table.journal_entry';
           	} 
             $template_row                  =    view_get_template($template_row);
            $row['request_count']			= $post['request_count'];   
            $row['item_id']					= $post['item_id'];   
            $row['parent_form']				= $parent_option;   
            $row['project_form']			= $project_option;   
            $list                           =    view_populate($row, $template_row);
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }
    
 

# Modify

    public function update_taxed($post)
    {
	   if($post)
		{
			foreach($post as $row)
			{
				$data['tax_payed']     =  1;
			    sql_update($this->table_name, 'account_payable_item_detail_id', $row, $data);		
			}
		}
        $return['result']        =    true;
        $return['data']          =    '';
        $return['message']       =    $this->message_update;
        return 		$return;
        
    }
    
    
    public function insert($post,$id,$particulars)
    {
        foreach($post as $row)
            {        
                 $row['str']['particulars']						 =   $particulars; 
                 $data                                           =    sql_parse_input('account_payable_item_detail', $row);
                 $data['account_payable_item_detail_timestamp']  =    time();
                 $data['account_payable_id']          			 =    $id;
                 $sql                                            =    sql_insert($this->table_name, $data);
            }        
        $return['result']                =    true;
        $return['data']                  =    $sql;
        $return['message']               =    $this->message_insert;        
    }
    
    
    public function jv_insert($post,$id,$api_id,$particulars,$bank_transaction_id)
    {
         
        foreach($post as $row)
            {        
                 //hash_dump($row);
                 $parse_row['str']['particulars']						 =    $particulars; 
                 $parse_row['int']['bank_transaction_id']				 =    $bank_transaction_id;
                 $parse_row['int']['jv_entry']				             =    1;
                 $parse_row['int']['item_gross_amount']				     =    $row['item_gross_amount'];
                 $parse_row['int']['project_id']						 =    $row['project_id'];
                 $parse_row['int']['project_site_id']					 =    $row['project_site_id'];
                 $parse_row['int']['item_tax_percent']					 =    $row['item_tax_percent'];
                 $parse_row['int']['item_tax_amount']					 =    $row['item_tax_amount'];
                 $parse_row['int']['item_net_amount']					 =    $row['item_net_amount'];
                 $parse_row['int']['option_account_chart_parent_id']	 =    $row['option_account_chart_parent_id'];
                 $parse_row['int']['option_account_chart_child_id']	     =    $row['option_account_chart_child_id'];
                 
                 $data                                           		 =    sql_parse_input('account_payable_item_detail', $parse_row);
                
                 $data['account_payable_item_detail_timestamp']  		 =    time();
                 $data['account_payable_item_id']  				 		 =    $api_id;
                 $data['account_payable_id']          					 =    $id;
                 $sql                                            		 =    sql_insert($this->table_name, $data);
            }        
        $return['result']                =    true;
        $return['data']                  =    $sql;
        $return['message']               =    $this->message_insert;        
    }
    
    public function liquidate_insert($post,$id,$api_id,$particulars)
    {
         
        foreach($post as $row)
            {        
                 //hash_dump($row);
                 $parse_row['str']['particulars']						 =   $particulars; 
                 $parse_row['int']['item_gross_amount']				     =    $row['item_gross_amount'];
                 $parse_row['int']['project_id']						 =    $row['project_id'];
                 $parse_row['int']['project_site_id']					 =    $row['project_site_id'];
                 $parse_row['int']['item_tax_percent']					 =    $row['item_tax_percent'];
                 $parse_row['int']['item_tax_amount']					 =    $row['item_tax_amount'];
                 $parse_row['int']['item_net_amount']					 =    $row['item_net_amount'];
                 $parse_row['int']['option_account_chart_parent_id']	 =    $row['option_account_chart_parent_id'];
                 $parse_row['int']['option_account_chart_child_id']	     =    $row['option_account_chart_child_id'];
                 
                 $data                                           		 =    sql_parse_input('account_payable_item_detail', $parse_row);
                
                 $data['account_payable_item_detail_timestamp']  		 =    time();
                 $data['account_payable_item_id']  				 		 =    $api_id;
                 $data['account_payable_id']          					 =    $id;
                 $sql                                            		 =    sql_insert($this->table_name, $data);
            }        
        $return['result']                =    true;
        $return['data']                  =    $sql;
        $return['message']               =    $this->message_insert;        
    }
            
}
