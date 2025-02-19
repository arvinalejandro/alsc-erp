<?php
class model_sales_commission_account
{    
    
    public function __construct()
    {
        $this->table_name        =    'sales_commission_account';
        $this->message_insert    =    'A new Entry hold has been successfully added.';
    }
    
# Data Select

    public function select($id,$filter = '')
    {        
        
        $query     =    "
                           select * from sales_commission_account WHERE sales_commission_account_id = {$id}
                           
                        ";        
                                
        $rows                =    sql_select($query);        
        $row                 =    $rows[0];        
        # Parse
        if(count($row))
        {
            $return  	= $row;        
        }
        else
        {
            $return     = 0;
        }
        return $return;
    }
    
    
    public function select_by_client_account($id,$filter = '')
    {        
        
        $query     =    "
                           select * from sales_commission_account WHERE client_account_id = {$id}
                           
                        ";        
                                
        $rows                =    sql_select($query);        
        $row                 =    $rows[0];        
        # Parse
        if(count($row))
        {
            $return  	= $row;        
        }
        else
        {
            $return     = 0;
        }
        return $return;
    }
    
    
    public function get_total_sales($sales_agent_id=0,$status_filter = '',$filter='',$scheme='new')
    {
    	
    	if($scheme == 'new')
    	{
			$columns         =  "sales_agent_id_sd,sales_agent_id_sm,sales_agent_id_pc";
    	}
    	else
    	{
			$columns         =  "old_sales_agent_id_avp,old_sales_agent_id_sm,old_sales_agent_id_ma";
    	}
    	
    	
    	if($sales_agent_id != 0)
    	{
			$id_filter       =  " AND (
			                            {$sales_agent_id} IN({$columns})
										)
			";
    	}
    	if($status_filter != 'all' && strlen($status_filter)<12 )
    	{
			$status_filter			 = " AND client_account.option_account_status_id = '{$status_filter}'";
    	}
    	elseif($status_filter == 'all')
    	{
			$status_filter			 = " AND client_account.option_account_status_id != 'ejected'";
    	}
    	elseif(strlen($status_filter)>12)
    	{
			$status_filter			 =  $status_filter;
    	}
    	else
    	{
			$status_filter			 =  "";
    	}
    	
    	
    	$query  		     =  "
    					             SELECT *, sales_commission_account.client_account_id, SUM(client_account_tcp_net) AS total_sum 
    					             ,COUNT(*) AS total_count
    					             
    					             
    					             FROM 
    					             
    					             sales_commission_account
    					             
    					             inner join client_account  on client_account.client_account_id = sales_commission_account.client_account_id {$status_filter}
    					             
    					             WHERE 
    					             
    					             sales_commission_account.client_account_id > 0 
    					             
    					             {$id_filter}
    					             
    					             {$filter}
    	";
    	//hash_dump($query);
    	$rows                =    sql_select($query);
    	//hash_dump($rows);
    	$row                 =    $rows[0];
    	$total['count']		 =    $row['total_count'];
    	$total['sum']		 =    $row['total_sum'];
    	$total['ca_id']		 =    $row['client_account_id'];
    	return $total;
	}
	
	
	public function get_total_paidup($sales_agent_id=0,$status_filter = '',$filter='',$scheme='new')
    {
    	
    	if($scheme == 'new')
    	{
			$columns         =  "sales_agent_id_sd,sales_agent_id_sm,sales_agent_id_pc";
    	}
    	else
    	{
			$columns         =  "old_sales_agent_id_avp,old_sales_agent_id_sm,old_sales_agent_id_ma";
    	}
    	
    	
    	if($sales_agent_id != 0)
    	{
			$id_filter       =  " AND (
			                            {$sales_agent_id} IN({$columns})
										)
			";
    	}
    	
    	if($status_filter != '')
    	{
			$status_filter			 = " AND client_account.option_account_status_id = '{$status_filter}'";
    	}
    	else
    	{
			$status_filter			 =  "";
    	}
    	
    	$query  		     =  "
    					             SELECT 
    					             
    					             *
    					             FROM
    					             
    					             sales_commission_account
    					             
    					             inner join client_account  on client_account.client_account_id = sales_commission_account.client_account_id {$status_filter}
    					             
    					             WHERE 
    					             
    					             sales_commission_account.client_account_id > 0 
    					             
    					             {$id_filter}
    					             
    					             {$filter}
    					             
    					             GROUP BY sales_commission_account.client_account_id
    	";
    	$rows                =    sql_select($query);
    	$total               =    0;
    	
    	//hash_dump($query);
    	foreach($rows as $row)
    	{
			//hash_dump($total);
			$total		   +=   mvc_model('model.client_account_invoice')->select_paidup_sales($row['client_account_id']);	
    	}
    	//hash_dump($total);
    	//die();
    	return $total;
	}
    
//=============FOR Sales Report

	public function get_production_report_per_director($year_date='2015')
	{		
		$list		=	'';
		$filter		=   " AND DATE_FORMAT(FROM_UNIXTIME(`sales_commission_account_timestamp`), '%Y') = 
								'{$year_date}' ";
		# DB
		$directors 	= mvc_model('model.sales_agent')->select_all_by_position_id('sales_director'); 
		foreach($directors as $dir_row)
		{
			$sm 	= mvc_model('model.sales_agent_agent')->select_by_head($dir_row['sales_agent_id']); 
			
			$pc		= array(0);
			foreach($sm as $sm_row)
			{
				$sm 	= mvc_model('model.sales_agent_agent')->select_by_head($sm_row['sales_agent_id']); 
				foreach($sm as $pc_row)
				{
					$pc[]	=	$pc_row['sales_agent_id'];
				}
			}
				$pc			=  implode(',',$pc);
				$query		=	"
							SELECT DISTINCT 
							 sales_commission_account.client_account_id AS client_account_id,
							COUNT(sales_commission_account_id)AS sale_count, 
							SUM(client_account.client_account_tcp_net) as project_total 

							FROM 

							sales_commission_account 
							
							LEFT join client_account ON client_account.client_account_id = sales_commission_account.client_account_id

							WHERE
							(
							sales_commission_account.sales_agent_id_pc IN({$pc})
							)
							{$filter} 

							
							";
				$rows	=	sql_select($query);
				# Template
			    $template_row		=	'sales/template/profile.report.sales_director';
				$template_row		=	view_get_template($template_row);
				if(count($rows))
				{
						foreach($rows as $row)  
						{  				
							$row['sales_agent_first_name']		 =    $dir_row['sales_agent_first_name'];
							$row['sales_agent_last_name']		 =    $dir_row['sales_agent_last_name'];
							$row['peso_variance']				 =    string_amount(($row['project_total'])-($dir_row['sales_agent_monthly_quota']*12));
							$row['percent_variance']		     =    ($row['peso_variance'] /($dir_row['sales_agent_monthly_quota']*12))*100;
							$row['percent_production']		     =    ($row['project_total'] /($dir_row['sales_agent_monthly_quota']*12))*100;
							$row['percent_variance']		     =   round($row['percent_variance'],2);
							$row['percent_production']		     =   round($row['percent_production'],2);
							
							
							$list['total_quota']			   	+=    $dir_row['sales_agent_monthly_quota']*12; 
							$list['sales']			   			+=    $row['project_total']; 
							$row['project_total']    			 =    string_amount($row['project_total']);			
							$row['agent_quota']    			     =    string_amount($dir_row['sales_agent_monthly_quota']*12);
							$list['rows']						.=	view_populate($row, $template_row);
						
						}
				}//end if
		}//dir loop
					$list['total_peso_variance']	      =    $list['sales'] - ($list['total_quota']);
					$list['total_percent_variance']		  =    ($list['total_peso_variance'] /$list['total_quota'])*100;
					$list['total_percent_production']	  =    ($list['sales'] /$list['total_quota'])*100;
					$list['total_percent_production']	  =    round($list['total_percent_production'],2);
					$list['total_percent_variance']	  	  =    round($list['total_percent_variance'],2);
		
		//hash_dump($query,true);
		return $list;
	}// end get_production_report_per_director()
	
// FOR COMMISSION========================
    public function add_sales_commission_account($client_account)
    {
        $get_hold_lot        	    	=    mvc_model('model.sales_agent_lot')->select_lot_hold($client_account['lot_id']);
        $comm_scheme_id			        =    $get_hold_lot['sales_commission_scheme_id'];
        $commission_scheme              =    mvc_model('model.sales_commission_scheme')->select($comm_scheme_id);
        if($comm_scheme_id == 1)
	    {
	    	$post['client_account_id'] 							= $client_account['client_account_id'];
	    	$post['sales_commission_scheme_id'] 				= $comm_scheme_id;
	    	$post['old_sales_commission_account_amount_avp'] 	= (string_clean_number($commission_scheme['old_sales_commission_scheme_value_avp'])/100) * string_clean_number($client_account['client_account_tcp_net']);
	    	$post['sales_commission_account_amount_total'] 		= $post['old_sales_commission_account_amount_avp'];
	    	$post['old_sales_agent_id_avp'] 					= $get_hold_lot['old_sales_agent_id_avp'];
	    	$this->insert($post);
	    	mvc_model('model.sales_agent_lot')->update_sold_lot($get_hold_lot['sales_agent_lot_id']);
	    	
	    }
	    elseif($comm_scheme_id == 2)
	    {
			$post['client_account_id'] 							= $client_account['client_account_id'];
	    	$post['sales_commission_scheme_id'] 				= $comm_scheme_id;
	    	$post['old_sales_commission_account_amount_avp'] 	= (string_clean_number($commission_scheme['old_sales_commission_scheme_value_avp'])/100) * string_clean_number($client_account['client_account_tcp_net']);
	    	$post['old_sales_commission_account_amount_sm'] 	= (string_clean_number($commission_scheme['old_sales_commission_scheme_value_sm'])/100) * string_clean_number($client_account['client_account_tcp_net']);
	    	$post['sales_commission_account_amount_total'] 		= $post['old_sales_commission_account_amount_avp'] + $post['old_sales_commission_account_amount_sm'];
	    	$post['old_sales_agent_id_avp'] 					= $get_hold_lot['old_sales_agent_id_avp'];
	    	$post['old_sales_agent_id_sm'] 						= $get_hold_lot['old_sales_agent_id_sm'];
	    	$this->insert($post);
	    	mvc_model('model.sales_agent_lot')->update_sold_lot($get_hold_lot['sales_agent_lot_id']);
	    }
	    elseif($comm_scheme_id == 3)
	    {
			$post['client_account_id'] 							= $client_account['client_account_id'];
	    	$post['sales_commission_scheme_id'] 				= $comm_scheme_id;
	    	$post['old_sales_commission_account_amount_avp'] 	= (string_clean_number($commission_scheme['old_sales_commission_scheme_value_avp'])/100) * string_clean_number($client_account['client_account_tcp_net']);
	    	$post['old_sales_commission_account_amount_ma'] 	= (string_clean_number($commission_scheme['old_sales_commission_scheme_value_ma'])/100) * string_clean_number($client_account['client_account_tcp_net']);
	    	$post['sales_commission_account_amount_total'] 		= $post['old_sales_commission_account_amount_avp'] + $post['old_sales_commission_account_amount_ma'];
	    	$post['old_sales_agent_id_avp'] 					= $get_hold_lot['old_sales_agent_id_avp'];
	    	$post['old_sales_agent_id_ma'] 						= $get_hold_lot['old_sales_agent_id_ma'];
	    	$this->insert($post);
	    	mvc_model('model.sales_agent_lot')->update_sold_lot($get_hold_lot['sales_agent_lot_id']);
	    }
	    elseif($comm_scheme_id == 4)
	    {
			$post['client_account_id'] 							= $client_account['client_account_id'];
	    	$post['sales_commission_scheme_id'] 				= $comm_scheme_id;
	    	$post['old_sales_commission_account_amount_avp'] 	= (string_clean_number($commission_scheme['old_sales_commission_scheme_value_avp'])/100) * string_clean_number($client_account['client_account_tcp_net']);
	    	$post['old_sales_commission_account_amount_ma'] 	= (string_clean_number($commission_scheme['old_sales_commission_scheme_value_ma'])/100) * string_clean_number($client_account['client_account_tcp_net']);
	    	$post['old_sales_commission_account_amount_sm'] 	= (string_clean_number($commission_scheme['old_sales_commission_scheme_value_sm'])/100) * string_clean_number($client_account['client_account_tcp_net']);
	    	$post['sales_commission_account_amount_total'] 		= $post['old_sales_commission_account_amount_avp'] + $post['old_sales_commission_account_amount_ma'] + $post['old_sales_commission_account_amount_sm'];
	    	$post['old_sales_agent_id_avp'] 					= $get_hold_lot['old_sales_agent_id_avp'];
	    	$post['old_sales_agent_id_ma'] 						= $get_hold_lot['old_sales_agent_id_ma'];
	    	$post['old_sales_agent_id_sm'] 						= $get_hold_lot['old_sales_agent_id_sm'];
	    	$this->insert($post);
	    	mvc_model('model.sales_agent_lot')->update_sold_lot($get_hold_lot['sales_agent_lot_id']);
	    }
	    elseif($comm_scheme_id == 5)
	    {
	    	$post['client_account_id'] 							= $client_account['client_account_id'];
	    	$post['sales_commission_scheme_id'] 				= $comm_scheme_id;
	    	$post['old_sales_commission_account_amount_broker'] = (string_clean_number($commission_scheme['old_sales_commission_scheme_value_broker'])/100) * string_clean_number($client_account['client_account_tcp_net']);
	    	$post['sales_commission_account_amount_total'] 		= $post['old_sales_commission_account_amount_broker'] ;
	    	$post['old_sales_agent_id_broker'] 					= $get_hold_lot['old_sales_agent_id_broker'];
	    	$this->insert($post);
	    	mvc_model('model.sales_agent_lot')->update_sold_lot($get_hold_lot['sales_agent_lot_id']);
	    }
	    elseif($comm_scheme_id == 6)
	    {
			$post['client_account_id'] 							= $client_account['client_account_id'];
	    	$post['sales_commission_scheme_id'] 				= $comm_scheme_id;
	    	$post['sales_commission_account_amount_vp'] 		= (string_clean_number($commission_scheme['sales_commission_scheme_value_vp'])/100) * string_clean_number($client_account['client_account_tcp_net']);
	    	$post['sales_commission_account_amount_sd'] 		= (string_clean_number($commission_scheme['sales_commission_scheme_value_sd'])/100) * string_clean_number($client_account['client_account_tcp_net']);
	    	$post['sales_commission_account_amount_sm'] 		= (string_clean_number($commission_scheme['sales_commission_scheme_value_sm'])/100) * string_clean_number($client_account['client_account_tcp_net']);
	    	$post['sales_commission_account_amount_pc'] 		= (string_clean_number($commission_scheme['sales_commission_scheme_value_pc'])/100) * string_clean_number($client_account['client_account_tcp_net']);
	    	$post['sales_commission_account_amount_total'] 		= $post['sales_commission_account_amount_vp'] + $post['sales_commission_account_amount_sd'] + $post['sales_commission_account_amount_sm'] + $post['sales_commission_account_amount_pc'];
	    	$post['sales_agent_id_vp'] 							= $get_hold_lot['sales_agent_id_vp'];
	    	$post['sales_agent_id_sd'] 							= $get_hold_lot['sales_agent_id_sd'];
	    	$post['sales_agent_id_sm'] 							= $get_hold_lot['sales_agent_id_sm'];
	    	$post['sales_agent_id_pc'] 							= $get_hold_lot['sales_agent_id_pc'];
	    	//hash_dump($post,true);
	    	$this->insert($post);
	    	mvc_model('model.sales_agent_lot')->update_sold_lot($get_hold_lot['sales_agent_lot_id']);
	    }
	    elseif($comm_scheme_id == 7)
	    {
	    	$post['client_account_id'] 							= $client_account['client_account_id'];
	    	$post['sales_commission_scheme_id'] 				= $comm_scheme_id;
	    	$post['sales_commission_account_amount_broker']	 	= (string_clean_number($commission_scheme['sales_commission_scheme_value_broker'])/100) * string_clean_number($client_account['client_account_tcp_net']);
	    	$post['sales_commission_account_amount_total'] 		= $post['sales_commission_account_amount_broker'] ;
	    	$post['sales_agent_id_broker'] 						= $get_hold_lot['sales_agent_id_broker'];
	    	$this->insert($post);
	    	mvc_model('model.sales_agent_lot')->update_sold_lot($get_hold_lot['sales_agent_lot_id']);
	    }
	    else
	    {
	    }
    }	
	

# Modify

    public function insert($post)
    {
	     $post['sales_commission_account_timestamp']     =    time();
	     $sql                                            =    sql_insert($this->table_name, $post);
        $return['result']                =    true;
        $return['data']                  =    $sql;
        $return['message']               =    $this->message_insert;        
    }
    
    public function update_by_lot($id)
	{
		$data['option_availability_id']				=   'available';	
		$data['sales_agent_lot_timestamp_end']      =   time();			
														sql_update($this->table_name, 'lot_id', $id, $data, " AND option_availability_id = 'on_hold'");		
		$return['result']							=	true;
		$return['data']								=	'';
		$return['message']							=	$this->message_update;
		return $return;
		
	}
	
	public function check_expiry($data)
	{
		foreach($data as $row)
			{		
                 //mvc_model('model.document_lot')->insert($row['lot_id']);
                if($row['option_availability_id'] == 'on_hold')
                {
					$duration	       =    diff_date_to_current($row['sales_agent_lot_timestamp']);
					if($duration > 5 && $row['hold_standard'] == 1)
					{
						 $this->update($row['lot_id']);
						 
						  $lot['int']['agent_id']					=	0;
					      $lot['int']['sales_manager_id']			=	0;
					      $lot['int']['sales_director_id']		    =	0;
					      $lot['str']['option_availability_id']   	=	'available';
					      mvc_model('model.lot')->update($lot, $row['lot_id']);
					}
                }
			}
		$return['result']							=	true;
		$return['data']								=	'';
		$return['message']							=	$this->message_update;
		return $return;
		
	}
            
}
