<?php
class model_client_account_agent
{    
    
    public function __construct()
    {
        $this->table_name        =    'client_account_agent';
        $this->message_insert    =    'A new entry has been successfully added.';
    }
    
# Data Select

    public function check_commission_trigger($agent_id,$client_account_id,$sales_commission_trigger_id)
    {
    	$query  =  "
    					SELECT 
    					
    					*
    					
    					FROM 
    					
    					client_account_agent 
    					
    					WHERE  sales_agent_id = {$agent_id}
    					
    					AND    client_account_id = {$client_account_id}
    					
    					AND    sales_commission_scheme_trigger_id = {$sales_commission_trigger_id}
    	";
    	$rows                =    sql_select($query);
    	$row                 =    $rows[0];
    	if($row)
    	{
			return 1;
    	}
    	else
    	{
			return 0;
    	}
	}
	
	
	
	
	public function select($id, $filter = '')
    {
		$id		=	string_clean_number($id);
    	
		$query	=	"SELECT 
						*
					FROM 
					client_account_agent
					
					WHERE 
					
					client_account_agent_id = {$id}
						             
    	";
								
    	$rows                =    sql_select($query);
		$rows	=	$rows[0];
		return $rows;
	}
	


    public function select_by_ca_id($ca_id,$filter = '')
    {
    	$query  =  "
    					SELECT * FROM client_account_agent WHERE client_account_id = {$ca_id} {$filter}
    	";
    	$rows                =    sql_select($query);
    	$id	=	array();
    	foreach($rows as $row){
			$id[]	=	$row['commission_scheme_range_sequence'];
    	}
    	return $id;
	}
	
	public function select_total_commission_by_agent($agent_id,$filter = '')
    {
    	$query  =  "
    					SELECT SUM(client_account_agent_commission_amount_current) AS total_comm 
    					
    					FROM client_account_agent 
    					
    					WHERE  sales_agent_id = {$agent_id}
    	";
    	$rows                =    sql_select($query);
    	$row                 =    $rows[0];
    	$total				 =    $row['total_comm'];
    	return $total;
	}
	
	
	
	 public function get_total_consolidated_amount($id_string)
    {
    	$query  =  "
    					SELECT * FROM client_account_agent WHERE client_account_agent_id  IN({$id_string}) 
    	
    	";
    	$rows                		 =    sql_select($query);
        $total_amt['gross']			 =    0;
        $total_amt['tax']			 =    0;
        $total_amt['net']			 =    0;
    	foreach($rows as $row){
			$total_amt['gross']	    +=	$row['client_account_agent_commission_amount_current'];
			$total_amt['net']	    +=	$row['client_account_agent_commission_amount_net'];
			$total_amt['tax']	    +=	$row['client_account_agent_commission_tax_amount'];
    	}
    	return $total_amt;
	}
	
	
	public function select_commissions_by_agent($agent_id,$filter = '')
    {        
        $client_account_id			=	$client_account_id*1;
        $query     					=    "
		                           select *,
									(select option_unit_account_type_name from option_unit_account_type where option_unit_account_type.option_unit_account_type_id = client_account.option_unit_account_type_id ) AS option_unit_account_type_name
									
									FROM 

									client_account_agent 

									LEFT JOIN client_account
									ON client_account.client_account_id = client_account_agent.client_account_id

									LEFT JOIN lot
									ON lot.lot_id = client_account.lot_id
									
									LEFT JOIN sales_agent
									ON client_account_agent.sales_agent_id = sales_agent.sales_agent_id

									LEFT JOIN client
									ON client.client_id =  client_account.client_id

									LEFT JOIN project
									ON project.project_id = lot.project_id

									LEFT JOIN project_site
									ON project_site.project_site_id = lot.project_site_id

									LEFT JOIN project_site_block
									ON project_site_block.project_site_block_id = lot.project_site_block_id
		                           
                           			WHERE client_account_agent.sales_agent_id = {$agent_id}
		                           
                        ";        
                                
        $rows                =    sql_select($query); 
        $template_row        =    'sales/template/row.agent_commission_history';
    	$template_row        =    view_get_template($template_row);       
        # Parse
        //hash_dump($query,true);
        $list['total']		 =     0;
        if(count($rows))
        {
            foreach($rows as $row)
            {        
	                $list['total']					                          +=	$row['client_account_agent_commission_amount_current'];						
	                $row['client_account_agent_commission_amount_current']     =    string_amount($row['client_account_agent_commission_amount_current']); 
	                $row['client_account_agent_commission_amount_net']         =    string_amount($row['client_account_agent_commission_amount_net']); 
	                $row['client_account_agent_commission_tax_amount']         =    string_amount($row['client_account_agent_commission_tax_amount']); 
	                $row['approve_date']    				   				   =    ($row['approve_date'] > 0 ? string_date($row['approve_date']) : 'Pending');
	                $list['rows']                                    		  .=    view_populate($row, $template_row);
            }  
        }
        else
        {
            $list['rows']    =    '';
        }
        return $list;
    }
	
	
	public function select_account_history($client_account_id,$filter = '')
    {        
        $client_account_id			=	$client_account_id*1;
        $query     					=    "
		                           select *,
									 (select sales_agent_position_name from sales_agent_position where sales_agent_position_id = sales_agent.sales_agent_position_id) as sales_agent_position_name,
									(select count(*) from document_account where document_account.client_account_id = client_account_agent.client_account_id and document_account.document_type_id IN (1, 2, 3) AND document_account_status = 1) AS document_count,
									(select option_unit_account_type_name from option_unit_account_type where option_unit_account_type.option_unit_account_type_id = client_account.option_unit_account_type_id ) AS option_unit_account_type_name
	
									FROM 

									client_account_agent 

									LEFT JOIN client_account
									ON client_account.client_account_id = client_account_agent.client_account_id

									LEFT JOIN lot
									ON lot.lot_id = client_account.lot_id
									
									LEFT JOIN sales_agent
									ON client_account_agent.sales_agent_id = sales_agent.sales_agent_id

									LEFT JOIN client
									ON client.client_id =  client_account.client_id

									LEFT JOIN project
									ON project.project_id = lot.project_id

									LEFT JOIN project_site
									ON project_site.project_site_id = lot.project_site_id

									LEFT JOIN project_site_block
									ON project_site_block.project_site_block_id = lot.project_site_block_id
		                           
                           			WHERE client_account_agent.client_account_id = {$client_account_id}
		                           
                        ";        
                                
        $rows                =    sql_select($query); 
        $template_row        =    'sales/template/row.commission_account_history';
    	$template_row        =    view_get_template($template_row);       
        # Parse
        //hash_dump($query,true);
        if(count($rows))
        {
            foreach($rows as $row)
            {        
	                $row['client_account_agent_commission_amount_current']     =    string_amount($row['client_account_agent_commission_amount_current']); 
	                $row['client_account_agent_commission_amount_net']         =    string_amount($row['client_account_agent_commission_amount_net']); 
	                $row['client_account_agent_commission_tax_amount']         =    string_amount($row['client_account_agent_commission_tax_amount']); 
	                $row['client_account_agent_timestamp']    				   =    string_date($row['client_account_agent_timestamp']);
	                $list                                    		          .=    view_populate($row, $template_row);
            }  
            
            $template_row        =    'sales/template/profile.commission_account_history';
    		$template_row        =    view_get_template($template_row);      
    		$row['history_list'] =    $list; 
    		$list				 =    view_populate($row, $template_row);   
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }
	
	
    
    public function select_all_pending($filter = '')
    {        
       
        
        $query     =    "
                           select *,
							 (select sales_agent_position_name from sales_agent_position where sales_agent_position_id = sales_agent.sales_agent_position_id) as sales_agent_position_name,
							(select count(*) from document_account where document_account.client_account_id = client_account_agent.client_account_id and document_account.document_type_id IN (1, 2, 3) AND document_account_status = 1) AS document_count,
							(select option_unit_account_type_name from option_unit_account_type where option_unit_account_type.option_unit_account_type_id = client_account.option_unit_account_type_id ) AS option_unit_account_type_name
							
							FROM 

							client_account_agent 

							LEFT JOIN client_account
							ON client_account.client_account_id = client_account_agent.client_account_id

							LEFT JOIN sales_agent
							ON client_account_agent.sales_agent_id = sales_agent.sales_agent_id

							LEFT JOIN lot
							ON lot.lot_id = client_account.lot_id

							LEFT JOIN client
							ON client.client_id =  client_account.client_id

							LEFT JOIN project
							ON project.project_id = lot.project_id

							LEFT JOIN project_site
							ON project_site.project_site_id = lot.project_site_id

							LEFT JOIN project_site_block
							ON project_site_block.project_site_block_id = lot.project_site_block_id
                           
                           	WHERE client_account_agent.is_approved = 0
                           	AND client_account_agent.option_entry_type_id != 'consolidated'
                           	
                           	ORDER BY client_account_agent.client_account_agent_id DESC
                           	
                           	{$filter}
                        ";        
                                
        $rows                =    sql_select($query);        
        # Parse
        //hash_dump($rows,true);
        if(count($rows))
        {
            foreach($rows as $row)
            {        
                if($row['option_entry_type_id'] == 'single')
                {
				    $template_row        =    'sales/template/row.commission';
        			$template_row        =    view_get_template($template_row);
					$row['document_status']							   		   =    ($row['document_count'] == 3 ? 'Complete' : 'Incomplete');	 	
	                $row['class_status']							   		   =    ($row['document_count'] == 3 ? 'color_green' : 'color_red');	 	
	                $row['client_account_agent_commission_amount_current']     =    string_amount($row['client_account_agent_commission_amount_current']); 
	                $row['client_account_agent_commission_amount_net']         =    string_amount($row['client_account_agent_commission_amount_net']); 
	                $row['client_account_agent_commission_tax_amount']         =    string_amount($row['client_account_agent_commission_tax_amount']); 
	                $row['client_account_tcp_net']    				           =    string_amount($row['client_account_tcp_net']); 
	                $list                                    		          .=    view_populate($row, $template_row);
                }
                else
                {
					 $template_row        									   =    'sales/template/row.consolidated';
        			 $template_row        									   =    view_get_template($template_row);
        			 $entry_id										           =    mvc_model('model.client_account_agent_consolidate')->select_consolidated_entry($row['client_account_agent_id']);
        			 $row['entry_count']										=    count($entry_id);
        			 $row['total_account']										=    $this->select_total_account($entry_id);
        			 $row['client_account_agent_commission_amount_current']     =    string_amount($row['client_account_agent_commission_amount_current']);
        			 $row['client_account_agent_commission_amount_net']         =    string_amount($row['client_account_agent_commission_amount_net']); 
	                 $row['client_account_agent_commission_tax_amount']         =    string_amount($row['client_account_agent_commission_tax_amount']);
					 $list                                    		           .=    view_populate($row, $template_row);
                }
                
            }            
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }
    
    private function select_total_account($id_entry)
    {
    	$id					 =  implode(',',$id_entry);
    	
    	$query 		 		 = "SELECT * FROM client_account_agent WHERE client_account_agent_id IN({$id}) GROUP BY client_account_id ";
        $rows                =  sql_select($query);
        
        if(count($rows))
        {
			$total	=	count($rows);
        }
        else
        {
			$total  =   0;
        }
        
        return $total;
	}
    
   
    
    public function select_row($id,$filter = '')
    {        
        $query    			 =    "
                           			select *,
								(select sales_agent_position_name from sales_agent_position where sales_agent_position_id = sales_agent.sales_agent_position_id) as sales_agent_position_name, 
								(select count(*) from document_account where document_account.client_account_id = client_account_agent.client_account_id and document_account.document_type_id IN (1, 2, 3) AND document_account_status = 1) AS document_count
								 
								FROM 
								client_account_agent

								left join client_account on client_account.client_account_id = client_account_agent.client_account_id
								inner join client on client.client_id = client_account.client_id					
								inner join client_account_structure on client_account_structure.client_account_structure_id = client_account.client_account_structure_id 				

								inner join option_transaction_type on option_transaction_type.option_transaction_type_id = client_account.option_transaction_type_id
								inner join option_unit_account_type on option_unit_account_type.option_unit_account_type_id = client_account.option_unit_account_type_id
								left join option_account_type on option_account_type.option_account_type_id = client_account.option_account_type_id
								left join option_account_status on option_account_status.option_account_status_id = client_account.option_account_status_id
								left join option_buyer_type on option_buyer_type.option_buyer_type_id = client_account.option_buyer_type_id												
								inner join option_account_p1 on option_account_p1.option_account_p1_id = client_account.option_account_p1_id
								inner join option_account_p2 on option_account_p2.option_account_p2_id = client_account.option_account_p2_id						
								inner join option_account_misc on option_account_misc.option_account_misc_id = client_account.option_account_misc_id						

								inner join user on user.user_id = client_account.user_id


								left join sales_agent on sales_agent.sales_agent_id = client_account_agent.sales_agent_id						
								inner join lot on lot.lot_id = client_account.lot_id		
								left join house on house.house_id = lot.house_id
								left join option_house_classification on option_house_classification.option_house_classification_id = house.option_house_classification_id							
								left join project on project.project_id = lot.project_id						
								left join project_site on project_site.project_site_id = lot.project_site_id						
								left join project_site_block on project_site_block.project_site_block_id = lot.project_site_block_id

								WHERE 
								
								client_account_agent_id = {$id}
                        ";        
                                
        $rows                =    sql_select($query);        
        $template_row        =    'sales/template/profile.commission';
        $template_row        =    view_get_template($template_row);
        # Parse
        //hash_dump($query,true);
        if(count($rows))
        {
            foreach($rows as $row)
            {        
					$row['house_name']										   =    ($row['house_name'] ? $row['house_name'] . '-' . $row['house_code']: 'none'); 
					$row['client_account_vatable']							   =	($row['client_account_is_vat']) ? 'Yes' : 'No';
					$row['client_account_reservation_receipt']				   =    ($row['client_account_reservation_receipt'] ? $row['client_account_reservation_receipt'] : ''); 
					$row['option_house_classification_name']				   =    ($row['option_house_classification_name'] ? $row['option_house_classification_name'] : 'none'); 
					$row['document_status']							   		   =    ($row['document_count'] == 3 ? 'Complete' : 'Incomplete');	 	
	                $row['class_status']							   		   =    ($row['document_count'] == 3 ? 'color_green' : 'color_red');	
	                $row['client_account_agent_commission_amount_current']     =    string_amount($row['client_account_agent_commission_amount_current']); 
	                $row['client_account_agent_commission_tax_amount']         =    string_amount($row['client_account_agent_commission_tax_amount']); 
	                $row['client_account_tcp_net']    				           =    string_amount($row['client_account_tcp_net']); 
	                $row['client_account_date_sale']    				       =    string_date($row['client_account_date_sale']); 
	                $row['client_account_dp_due_date']    				       =    string_date($row['client_account_dp_due_date']); 
	                $row['client_account_ma_due_date']    				       =    string_date($row['client_account_ma_due_date']); 
	                $row['client_account_reservation_date']    				   =    string_date($row['client_account_reservation_date']); 
	                $row['client_account_discount_amount']    				   =    string_amount($row['client_account_discount_amount']); 
	                $row['house_area']    				          			   =    string_amount($row['house_area']); 
	                $row['client_account_hcp']    				          	   =    string_amount($row['client_account_hcp']); 
	                $row['house_price']    				          	           =    string_amount($row['house_price']); 
	                $row['client_account_soil_poison']    				       =    string_amount($row['client_account_soil_poison']); 
	                $row['client_account_added_cost']    				       =    string_amount($row['client_account_added_cost']); 
	                $row['client_account_dp_amount']    				       =    string_amount($row['client_account_dp_amount']); 
	                $row['client_account_misc_fee']    				           =    string_amount($row['client_account_misc_fee']); 
	                $row['client_account_dp_total']    				           =    string_amount($row['client_account_dp_total']); 
	                $row['client_account_dp_monthly']    				       =    string_amount($row['client_account_dp_monthly']); 
	                $row['client_account_reservation_paid']    				   =    string_amount($row['client_account_reservation_paid']); 
	                $row['client_account_dp_net']    				   	       =    string_amount($row['client_account_dp_net']); 
	                $row['client_account_tcp_net']    				   	       =    string_amount($row['client_account_tcp_net']); 
	                $row['client_account_ma_monthly']    				   	   =    string_amount($row['client_account_ma_monthly']); 
	                $row['client_account_ma_amount']    				   	   =    string_amount($row['client_account_ma_amount']); 
	                $row['lot_price']    				          			   =    string_amount($row['lot_price']); 
	                $row['client_account_misc_fee_monthly']    				   =    string_amount($row['client_account_misc_fee_monthly']); 
	                $row['lot_contract_price']    				          	   =    string_amount(string_clean_number($row['lot_price']) * $row['lot_area']);
	                $row['total_partial_dp']    				          	   =    string_amount(string_clean_number($row['client_account_dp_monthly']) + string_clean_number($row['client_account_misc_fee_monthly']));
	                $row['house_price_sqm']								       =	($row['house_area']) ? 'P ' .string_amount((string_clean_number($row['client_account_hcp']) / $row['house_area'])) . ' / sqm' : 'P 0.00'; 
	                //echo $row['client_account_hcp'] . ' / ' . $row['house_area'] . ' = ' .  $row['house_price_sqm'];
	               //echo $row['house_price_sqm'];
	               // die();
	                $list['profile.row']                                       =    view_populate($row, $template_row);
	                $list['client_account_id']                                 =    $row['client_account_id'];
               
            }            
        }
        else
        {
            $list    =    '';
        }
        return $list;
        
    }
    
    
    
    
    public function select_row_comm_slip($id,$filter = '')
    {        
        $query    			 =    "
                           select *,
                          (select sales_agent_position_name from sales_agent_position where sales_agent_position_id = sales_agent.sales_agent_position_id) as sales_agent_position_name,  
                            (select count(*) from document_account where document_account.client_account_id = client_account_agent.client_account_id and document_account.document_type_id IN (1, 2, 3) AND document_account_status = 1) AS document_count
							 
							FROM 
							client_account_agent
							
							left join client_account on client_account.client_account_id = client_account_agent.client_account_id
							inner join client on client.client_id = client_account.client_id					
							inner join client_account_structure on client_account_structure.client_account_structure_id = client_account.client_account_structure_id 				
							
							inner join option_transaction_type on option_transaction_type.option_transaction_type_id = client_account.option_transaction_type_id
							inner join option_unit_account_type on option_unit_account_type.option_unit_account_type_id = client_account.option_unit_account_type_id
							left join option_account_type on option_account_type.option_account_type_id = client_account.option_account_type_id
							left join option_account_status on option_account_status.option_account_status_id = client_account.option_account_status_id
							left join option_buyer_type on option_buyer_type.option_buyer_type_id = client_account.option_buyer_type_id												
							inner join option_account_p1 on option_account_p1.option_account_p1_id = client_account.option_account_p1_id
							inner join option_account_p2 on option_account_p2.option_account_p2_id = client_account.option_account_p2_id						
							inner join option_account_misc on option_account_misc.option_account_misc_id = client_account.option_account_misc_id						
							
							inner join user on user.user_id = client_account.user_id
							
							
							left join sales_agent on sales_agent.sales_agent_id = client_account_agent.sales_agent_id						
							inner join lot on lot.lot_id = client_account.lot_id		
							left join house on house.house_id = lot.house_id
							left join option_house_classification on option_house_classification.option_house_classification_id = house.option_house_classification_id							
							left join project on project.project_id = lot.project_id						
							left join project_site on project_site.project_site_id = lot.project_site_id						
							left join project_site_block on project_site_block.project_site_block_id = lot.project_site_block_id
                           
                           	WHERE 
                           	
                           	 client_account_agent_id = {$id}
                        ";        
                                
        $rows                =    sql_select($query);        
        $template_row        =    'sales/template/profile.commission_slip';
        $template_row        =    view_get_template($template_row);
        # Parse
        //hash_dump($rows,true);
        if(count($rows))
        {
            foreach($rows as $row)
            {        
					$row['house_name']										   =    ($row['house_name'] ? $row['house_name'] . '-' . $row['house_code']: 'none'); 
					$row['client_account_vatable']							   =	($row['client_account_is_vat']) ? 'Yes' : 'No';
					$row['client_account_reservation_receipt']				   =    ($row['client_account_reservation_receipt'] ? $row['client_account_reservation_receipt'] : ''); 
					$row['option_house_classification_name']				   =    ($row['option_house_classification_name'] ? $row['option_house_classification_name'] : 'none'); 
	                $row['client_account_agent_commission_amount_current']     =    string_amount($row['client_account_agent_commission_amount_current']); 
	                $row['client_account_agent_commission_tax_amount']         =    string_amount($row['client_account_agent_commission_tax_amount']); 
	                $row['client_account_agent_commission_contingency']        =    string_amount($row['client_account_agent_commission_contingency']); 
	                $row['client_account_agent_commission_amount_net']         =    string_amount($row['client_account_agent_commission_amount_net']); 
	                $row['client_account_tcp_net']    				           =    string_amount($row['client_account_tcp_net']); 
	                $row['client_account_date_sale']    				       =    string_date($row['client_account_date_sale']); 
	                $row['client_account_dp_due_date']    				       =    string_date($row['client_account_dp_due_date']); 
	                $row['client_account_ma_due_date']    				       =    string_date($row['client_account_ma_due_date']); 
	                $row['client_account_reservation_date']    				   =    string_date($row['client_account_reservation_date']); 
	                $row['client_account_discount_amount']    				   =    string_amount($row['client_account_discount_amount']); 
	                $row['house_area']    				          			   =    string_amount($row['house_area']); 
	                $row['client_account_hcp']    				          	   =    string_amount($row['client_account_hcp']); 
	                $row['house_price']    				          	           =    string_amount($row['house_price']); 
	                $row['client_account_soil_poison']    				       =    string_amount($row['client_account_soil_poison']); 
	                $row['client_account_added_cost']    				       =    string_amount($row['client_account_added_cost']); 
	                $row['client_account_dp_amount']    				       =    string_amount($row['client_account_dp_amount']); 
	                $row['client_account_misc_fee']    				           =    string_amount($row['client_account_misc_fee']); 
	                $row['client_account_dp_total']    				           =    string_amount($row['client_account_dp_total']); 
	                $row['client_account_dp_monthly']    				       =    string_amount($row['client_account_dp_monthly']); 
	                $row['client_account_reservation_paid']    				   =    string_amount($row['client_account_reservation_paid']); 
	                $row['client_account_dp_net']    				   	       =    string_amount($row['client_account_dp_net']); 
	                $row['client_account_tcp_net']    				   	       =    string_amount($row['client_account_tcp_net']); 
	                $row['client_account_ma_monthly']    				   	   =    string_amount($row['client_account_ma_monthly']); 
	                $row['client_account_ma_amount']    				   	   =    string_amount($row['client_account_ma_amount']); 
	                $row['lot_price']    				          			   =    string_amount($row['lot_price']); 
	                $row['client_account_misc_fee_monthly']    				   =    string_amount($row['client_account_misc_fee_monthly']); 
	                $row['lot_contract_price']    				          	   =    string_amount(string_clean_number($row['lot_price']) * $row['lot_area']);
	                $row['total_partial_dp']    				          	   =    string_amount(string_clean_number($row['client_account_dp_monthly']) + string_clean_number($row['client_account_misc_fee_monthly']));
	                $row['house_price_sqm']								       =	($row['house_area']) ? 'P ' .string_amount((string_clean_number($row['client_account_hcp']) / $row['house_area'])) . ' / sqm' : 'P 0.00'; 
	                //echo $row['client_account_hcp'] . ' / ' . $row['house_area'] . ' = ' .  $row['house_price_sqm'];
	               //echo $row['house_price_sqm'];
	               // die();
	                $list                                    		          .=    view_populate($row, $template_row);
               
            }            
        }
        else
        {
            $list    =    '';
        }
        return $list;
        
    }
    
    //==========Accounting Reports	

	public function select_monthly_commission_tax($date_month='2015-6')
    {        
        $query     =    "
                            SELECT 
							
							agent.agent_id,agent.agent_first_name,agent.agent_last_name,agent.option_agent_position_id, SUM(CASE WHEN client_account_agent_commission_tax_amount > 0 THEN client_account_agent_commission_tax_amount ELSE 0 END) AS tax_total

							FROM 

							client_account_agent

							INNER join account_payable ON account_payable.is_commission = client_account_agent.client_account_agent_id AND DATE_FORMAT(FROM_UNIXTIME(`request_release_date`), '%Y-%c') = '2015-6'

							INNER join agent ON agent.agent_id = client_account_agent.agent_id 

							WHERE 

							option_entry_type_id = 'single'

							GROUP BY agent.agent_id
                          
                        ";        
        $single_rows          	=    sql_select($query); 
        
        $disb_group_entry     	=    mvc_model('model.account_payable')->select_grouped_commission($date_month) ;
        foreach($disb_group_entry as $row)
        {        
            $commission_id[]    =    $row['is_commission'];
        }
        
        foreach($commission_id as $caa_group_id)
        {
			$consolidated_id    =    mvc_model('model.client_account_agent_consolidate')->select_consolidated_entry($caa_group_id);
			if(count($consolidated_id))
			{
				$id_string       =  implode(",",$consolidated_id);
				$group_query     =    "
		                            SELECT 
									
									agent.agent_id,agent.agent_first_name,agent.agent_last_name,agent.option_agent_position_id, SUM(CASE WHEN client_account_agent_commission_tax_amount > 0 THEN client_account_agent_commission_tax_amount ELSE 0 END) AS tax_total

									FROM 

									client_account_agent

									INNER join agent ON agent.agent_id = client_account_agent.agent_id 

									WHERE 

									client_account_agent IN({$id_string})

									GROUP BY agent.agent_id
									";
				 $group_rows     =    sql_select($group_query); 
			}
        }
        			     
      
        # Parse
        foreach($single_rows as $row1)
        {        
            $is_merged = 0;
            foreach($group_rows as $row2)
	        {        
            	if($row1['agent_id'] == $row2['agent_id'])
            	{
					$row2['tax_total']  	 = $row2['tax_total'] + $row1['tax_total'];
					$commission_rows[] 		 =  $row2;
            	}
            	else
            	{
					$commission_rows[]  	 =  $row2;
					
					if($is_merged == 0)
					{
						$commission_rows[]   =  $row1;
					}
					
					$is_merged 				 =  1;
            	}
	            
	        } 
            
        }            
       
        return $list;
    }
    
 

# Modify
	     
     public function insert_consolidate_commission($amt)//agent_id,client_account_id
    {
         $row['option_entry_type_id']							=    'group';  
         $row['client_account_agent_commission_amount_current']	=    $amt['gross'];  
         $row['client_account_agent_commission_amount_net']		=    $amt['net'];  
         $row['client_account_agent_commission_tax_amount']		=    $amt['tax'];  
	     $row['client_account_agent_timestamp']        			=    time();
	     $sql                                           		=    sql_insert($this->table_name, $row,'client_account_agent_id');
                   
         $return['result']                						=    true;
         $return['data']                  						=    $sql;
         $return['message']               						=    $this->message_insert;        
         
         return $return;
    }
    
    public function update_consolidated($post)
	{
		
		if(count($post))
		{
			foreach($post as $row)
			{
				$data['option_entry_type_id']					=    'consolidated';  
			    sql_update('client_account_agent', 'client_account_agent_id', $row, $data);	
			}
					
			$return['result']							    =	true;
		    $return['data']									=	$sql;
		    $return['message']								=	$this->message_insert;
		    
		    return $return;
		}
	}
	
	public function update_unconsolidate($post)
	{
		
		if(count($post))
		{
			foreach($post as $row)
			{
				$data['option_entry_type_id']				=    'single';  
			    sql_update('client_account_agent', 'client_account_agent_id', $row, $data);	
			}
					
			$return['result']							    =	true;
		    $return['data']									=	$sql;
		    $return['message']								=	$this->message_insert;
		    
		    return $return;
		}
	}
	
	public function delete_group_entry($id)
	{
		if(count($id))
		{
			sql_delete('client_account_agent', 'client_account_agent_id', $id);
		}
	}	
    
    public function update_approve($id)
	{
		$data['is_approved']	=	1;					
		$data['approve_date']	=	time();					
									sql_update('client_account_agent', 'client_account_agent_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
		return $return;
		
	}	
            
	
//===============================Commission Operations

	public function trigger_commission($client_account,$progress,$user_id)
    {
        $client_account_id				=    $client_account['client_account_id'];
        $commission_account        	    =    mvc_model('model.sales_commission_account')->select_by_client_account($client_account_id);
        $comm_scheme_id			        =    $commission_account['sales_commission_scheme_id'];
        $commission_scheme              =    mvc_model('model.sales_commission_scheme')->select($comm_scheme_id);
	    $finance_type					= ($client_account['option_transaction_type_id'] == 'thru_loan') ? 'bank' : 'in_house';
	    
        if($comm_scheme_id == 1)
	    {
	    	$triggers                   =    mvc_model('model.sales_commission_scheme_trigger')->select('old','in_house');
	    	foreach($triggers as $t_row)
	    	{
				if($t_row['sales_commission_scheme_trigger_value'] <= $progress)
				{
					$check_avp_comm   =    $this->check_commission_trigger($commission_account['old_sales_agent_id_avp'],$client_account_id,$t_row['sales_commission_scheme_trigger_id']);
					
					if($check_avp_comm == 0)
					{
						//insert commission
						$this->insert_pending_commission_new($commission_account['old_sales_agent_id_avp'],$client_account_id,$commission_account['old_sales_commission_account_amount_avp'],$t_row['sales_commission_scheme_trigger_release'],$user_id,$commission_scheme['old_sales_commission_scheme_value_avp'],$t_row['sales_commission_scheme_trigger_id'],$tax_percentage=10);
					}
				}
	    	}
	    	
	    }
	    elseif($comm_scheme_id == 2)
	    {
			$triggers                   =    mvc_model('model.sales_commission_scheme_trigger')->select('old','in_house');
	    	foreach($triggers as $t_row)
	    	{
				if($t_row['sales_commission_scheme_trigger_value'] <= $progress)
				{
					$check_avp_comm   =    $this->check_commission_trigger($commission_account['old_sales_agent_id_avp'],$client_account_id,$t_row['sales_commission_scheme_trigger_id']);
					$check_sm_comm    =    $this->check_commission_trigger($commission_account['old_sales_agent_id_sm'],$client_account_id,$t_row['sales_commission_scheme_trigger_id']);
					
					if($check_avp_comm == 0 && $check_sm_comm == 0)
					{
						//insert commission
						$this->insert_pending_commission_new($commission_account['old_sales_agent_id_avp'],$client_account_id,$commission_account['old_sales_commission_account_amount_avp'],$t_row['sales_commission_scheme_trigger_release'],$user_id,$commission_scheme['old_sales_commission_scheme_value_avp'],$t_row['sales_commission_scheme_trigger_id'],$tax_percentage=10);
						$this->insert_pending_commission_new($commission_account['old_sales_agent_id_sm'],$client_account_id,$commission_account['old_sales_commission_account_amount_sm'],$t_row['sales_commission_scheme_trigger_release'],$user_id,$commission_scheme['old_sales_commission_scheme_value_sm'],$t_row['sales_commission_scheme_trigger_id'],$tax_percentage=10);
					}
				}
	    	}
	    }
	    elseif($comm_scheme_id == 3)
	    {
			$triggers                   =    mvc_model('model.sales_commission_scheme_trigger')->select('old','in_house');
	    	foreach($triggers as $t_row)
	    	{
				if($t_row['sales_commission_scheme_trigger_value'] <= $progress)
				{
					$check_avp_comm   =    $this->check_commission_trigger($commission_account['old_sales_agent_id_avp'],$client_account_id,$t_row['sales_commission_scheme_trigger_id']);
					$check_ma_comm    =    $this->check_commission_trigger($commission_account['old_sales_agent_id_ma'],$client_account_id,$t_row['sales_commission_scheme_trigger_id']);
					
					if($check_avp_comm == 0 && $check_ma_comm == 0)
					{
						//insert commission
						$this->insert_pending_commission_new($commission_account['old_sales_agent_id_avp'],$client_account_id,$commission_account['old_sales_commission_account_amount_avp'],$t_row['sales_commission_scheme_trigger_release'],$user_id,$commission_scheme['old_sales_commission_scheme_value_avp'],$t_row['sales_commission_scheme_trigger_id'],$tax_percentage=10);
						$this->insert_pending_commission_new($commission_account['old_sales_agent_id_ma'],$client_account_id,$commission_account['old_sales_commission_account_amount_ma'],$t_row['sales_commission_scheme_trigger_release'],$user_id,$commission_scheme['old_sales_commission_scheme_value_ma'],$t_row['sales_commission_scheme_trigger_id'],$tax_percentage=10);
					}
				}
	    	}
	    }
	    elseif($comm_scheme_id == 4)
	    {
			$triggers                   =    mvc_model('model.sales_commission_scheme_trigger')->select('old','in_house');
	    	foreach($triggers as $t_row)
	    	{
				if($t_row['sales_commission_scheme_trigger_value'] <= $progress)
				{
					$check_avp_comm   =    $this->check_commission_trigger($commission_account['old_sales_agent_id_avp'],$client_account_id,$t_row['sales_commission_scheme_trigger_id']);
					$check_sm_comm    =    $this->check_commission_trigger($commission_account['old_sales_agent_id_sm'],$client_account_id,$t_row['sales_commission_scheme_trigger_id']);
					$check_ma_comm    =    $this->check_commission_trigger($commission_account['old_sales_agent_id_ma'],$client_account_id,$t_row['sales_commission_scheme_trigger_id']);
					
					if($check_avp_comm == 0 && $check_sm_comm == 0 && $check_ma_comm == 0)
					{
						//insert commission
						$this->insert_pending_commission_new($commission_account['old_sales_agent_id_avp'],$client_account_id,$commission_account['old_sales_commission_account_amount_avp'],$t_row['sales_commission_scheme_trigger_release'],$user_id,$commission_scheme['old_sales_commission_scheme_value_avp'],$t_row['sales_commission_scheme_trigger_id'],$tax_percentage=10);
						$this->insert_pending_commission_new($commission_account['old_sales_agent_id_sm'],$client_account_id,$commission_account['old_sales_commission_account_amount_sm'],$t_row['sales_commission_scheme_trigger_release'],$user_id,$commission_scheme['old_sales_commission_scheme_value_sm'],$t_row['sales_commission_scheme_trigger_id'],$tax_percentage=10);
						$this->insert_pending_commission_new($commission_account['old_sales_agent_id_ma'],$client_account_id,$commission_account['old_sales_commission_account_amount_ma'],$t_row['sales_commission_scheme_trigger_release'],$user_id,$commission_scheme['old_sales_commission_scheme_value_ma'],$t_row['sales_commission_scheme_trigger_id'],$tax_percentage=10);
					}
				}
	    	}
	    }
	    elseif($comm_scheme_id == 5)
	    {
	    	$triggers                   =    mvc_model('model.sales_commission_scheme_trigger')->select('old','in_house');
	    	foreach($triggers as $t_row)
	    	{
				if($t_row['sales_commission_scheme_trigger_value'] <= $progress)
				{
					$check_old_broker_comm   =    $this->check_commission_trigger($commission_account['old_sales_agent_id_broker'],$client_account_id,$t_row['sales_commission_scheme_trigger_id']);
					
					if($check_old_broker_comm == 0 )
					{
						//insert commission
						$this->insert_pending_commission_new($commission_account['old_sales_agent_id_broker'],$client_account_id,$commission_account['old_sales_commission_account_amount_broker'],$t_row['sales_commission_scheme_trigger_release'],$user_id,$commission_scheme['old_sales_commission_scheme_value_broker'],$t_row['sales_commission_scheme_trigger_id'],$tax_percentage=10);
					}
				}
	    	}
	    }
	    elseif($comm_scheme_id == 6)
	    {
			$triggers                   =    mvc_model('model.sales_commission_scheme_trigger')->select('new',$finance_type);
	    	 
	    	foreach($triggers as $t_row)
	    	{
				
				if($t_row['sales_commission_scheme_trigger_value'] <= $progress)
				{
					$check_vp_comm    =    $this->check_commission_trigger($commission_account['sales_agent_id_vp'],$client_account_id,$t_row['sales_commission_scheme_trigger_id']);
					$check_sm_comm    =    $this->check_commission_trigger($commission_account['sales_agent_id_sm'],$client_account_id,$t_row['sales_commission_scheme_trigger_id']);
					$check_sd_comm    =    $this->check_commission_trigger($commission_account['sales_agent_id_sd'],$client_account_id,$t_row['sales_commission_scheme_trigger_id']);
					$check_pc_comm    =    $this->check_commission_trigger($commission_account['sales_agent_id_pc'],$client_account_id,$t_row['sales_commission_scheme_trigger_id']);
					
					if($check_vp_comm == 0 && $check_sm_comm == 0 && $check_sd_comm == 0 && $check_pc_comm == 0)
					{
						//hash_dump($check_vp_comm,true);
						//insert commission
						$this->insert_pending_commission_new($commission_account['sales_agent_id_vp'],$client_account_id,$commission_account['sales_commission_account_amount_vp'],$t_row['sales_commission_scheme_trigger_release'],$user_id,$commission_scheme['sales_commission_scheme_value_vp'],$t_row['sales_commission_scheme_trigger_id'],$tax_percentage=10);
						$this->insert_pending_commission_new($commission_account['sales_agent_id_sm'],$client_account_id,$commission_account['sales_commission_account_amount_sm'],$t_row['sales_commission_scheme_trigger_release'],$user_id,$commission_scheme['sales_commission_scheme_value_sm'],$t_row['sales_commission_scheme_trigger_id'],$tax_percentage=10);
						$this->insert_pending_commission_new($commission_account['sales_agent_id_sd'],$client_account_id,$commission_account['sales_commission_account_amount_sd'],$t_row['sales_commission_scheme_trigger_release'],$user_id,$commission_scheme['sales_commission_scheme_value_sd'],$t_row['sales_commission_scheme_trigger_id'],$tax_percentage=10);
						$this->insert_pending_commission_new($commission_account['sales_agent_id_pc'],$client_account_id,$commission_account['sales_commission_account_amount_pc'],$t_row['sales_commission_scheme_trigger_release'],$user_id,$commission_scheme['sales_commission_scheme_value_pc'],$t_row['sales_commission_scheme_trigger_id'],$tax_percentage=10);
					}
				}
	    	}
	    }
	    elseif($comm_scheme_id == 7)
	    {
	    	$triggers                   =    mvc_model('model.sales_commission_scheme_trigger')->select('new',$finance_type);
	    	foreach($triggers as $t_row)
	    	{
				if($t_row['sales_commission_scheme_trigger_value'] <= $progress)
				{
					$check_broker_comm    =    $this->check_commission_trigger($commission_account['sales_agent_id_broker'],$client_account_id,$t_row['sales_commission_scheme_trigger_id']);
					
					if($check_broker_comm == 0 )
					{
						//insert commission
						$this->insert_pending_commission_new($commission_account['sales_agent_id_broker'],$client_account_id,$commission_account['sales_commission_account_amount_broker'],$t_row['sales_commission_scheme_trigger_release'],$user_id,$commission_scheme['sales_commission_scheme_value_broker'],$t_row['sales_commission_scheme_trigger_id'],$tax_percentage=10);
					}
				}
	    	}
	    }
	    else
	    {
	    }
    }
 
//private functions===============================================================================

  private function insert_pending_commission_new($sales_agent_id,$client_account_id,$commission_amout,$release_percentage,$user_id,$agent_commission_percent,$trigger_id,$tax_percentage=10)//agent_id,client_account_id
    {
         
			 $commission_amount 											=    string_clean_number($commission_amout) * (string_clean_number($release_percentage)/100);
			 $row['sales_agent_id']											=    $sales_agent_id;  
	         $row['client_account_id']								        =    $client_account_id; 
	         $row['user_id']								        		=    $user_id;  
	         $row['client_account_agent_commission_percent_current']		=    $release_percentage;
	         $row['client_account_agent_commission_amount_current']		    =    $commission_amount;  
	         $row['client_account_agent_commission_tax_percent']		    =    $tax_percentage;  
	         $row['client_account_agent_commission_tax_amount']		        =    ($row['client_account_agent_commission_tax_percent'] / 100) * $row['client_account_agent_commission_amount_current'];  
	         $row['client_account_agent_commission_amount_net']		        =     $row['client_account_agent_commission_amount_current'] - $row['client_account_agent_commission_tax_amount'];  
	         $whole															=    floor($row['client_account_agent_commission_amount_net']);
	         $contingency													=    $row['client_account_agent_commission_amount_net'] - $whole; //get contingency
	         $contingency													=    round($contingency, 2);
	         $row['client_account_agent_commission_contingency']            =    $contingency;
	         $row['client_account_agent_commission_amount_net']         	=    $row['client_account_agent_commission_amount_net'];
	         $row['sales_commission_scheme_trigger_id']		        		=    $trigger_id; 
		     $row['client_account_agent_timestamp']        				    =    time();
		     $row['commission_percentage']        				    		=    $agent_commission_percent;
		     $sql                                           				=    sql_insert($this->table_name, $row,'client_account_agent_id');
		     
			 
         $return['result']                								=    true;
         $return['data']                  								=    $sql;
         $return['message']               								=    $this->message_insert;      
         return $return;  
    }
            
}
