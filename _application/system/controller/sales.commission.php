<?php
class sales_commission
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'sales_commission';
       	$this->user						=	mvc_model('model.user')->select($_SESSION['user_id']);     
         	
    }
    
    public function index($parent)
    {          
        # DB
        $data['row.commission']                               =    mvc_model('model.client_account_agent')->select_all_pending();
        # VIEW
        $parent->_view('commission', $data);        
    }
   
     public function profile($parent)
    {          
         $id                                                   =    $_GET['id']*1; // client account agent id
         $c_id                                                 =    $_GET['c_id']*1; //client account id
         $entry_type										   =    $_GET['entry_type']; // consolidated or single entry
         //echo $entry_type;
        // die();
        # DB 
		if($entry_type =='single')
		{
			$caa_data                             			   =    mvc_model('model.client_account_agent')->select_row($id);
			$data['acct.profile']                              =    $caa_data['profile.row'];;
		}
		else
		{
			$entry_id										   =    mvc_model('model.client_account_agent_consolidate')->select_consolidated_entry($id);
			$data['acct.profile']                              =   '';
			$caa_id											   =    array();
			foreach($entry_id as $row_id)
			{
				$caa_data								       =    mvc_model('model.client_account_agent')->select_row($row_id);//get client account id of entry
				if(!(in_array($caa_data['client_account_id'],$caa_id)))
				{
				$data['acct.profile']                         .=    $caa_data['profile.row'];
				$caa_id[]								   	   =    $caa_data['client_account_id'];	
				}
				//hash_dump($data,true);
			}
		}
		//hash_dump($data,true);     
		# VIEW - side nav
		$side_nav['entry_type']                                =    $entry_type;
		$side_nav['c_id']                                      =    $id;
		$side_nav['ca_id']                                     =    $c_id;
        $side_nav['profile.class']               			   =    'bold';             
        $data['side_nav']                        			   =    view_get_template($parent->controller_id.'/template/side.commission', $side_nav);                       
        # VIEW
        $parent->_view('commission.profile', $data);        
    }
    
    public function voucher($parent)
    {          
         $id                                                   =    $_GET['id']*1; // client account agent id
         $c_id                                                 =    $_GET['c_id']*1; //client account id
         $entry_type                                           =    $_GET['entry_type']; // consolidated or single entry
         //echo $entry_type;
        // die();
        # DB 
      	if($entry_type =='single')
		{
			$data['row.voucher']                              =    mvc_model('model.client_account_agent')->select_row_comm_slip($id);
		}
		else
		{
			$entry_id										   =    mvc_model('model.client_account_agent_consolidate')->select_consolidated_entry($id);
			//hash_dump($entry_id,true);
			foreach($entry_id as $row_id)
			{
				$data['row.voucher']                         .=    mvc_model('model.client_account_agent')->select_row_comm_slip($row_id);
			}
		}
           
        //hash_dump($data,true);     
        # VIEW - side nav
        $side_nav['entry_type']                                =    $entry_type;
        $side_nav['c_id']                                      =    $id;
        $side_nav['ca_id']                                     =    $c_id;
        $side_nav['voucher.class']                              =    'bold';             
        $data['side_nav']                                       =    view_get_template($parent->controller_id.'/template/side.commission', $side_nav);                       
        # VIEW
        $parent->_view('commission.voucher', $data);        
    }
    
    
    public function account_history($parent)
    {          
         $id                                                   =    $_GET['id']*1;//client account agent id
         $c_id                                                 =    $_GET['c_id']*1;//client account id
         $entry_type										   =    $_GET['entry_type']; // consolidated or single entry
        # DB
        if($entry_type =='single')
		{
			$data['row.history']                               =    mvc_model('model.client_account_agent')->select_account_history($c_id);
		}
		else
		{
			$entry_id										   =    mvc_model('model.client_account_agent_consolidate')->select_consolidated_entry($id);
			//hash_dump($entry_type,true);
			$caa_id											   =    array();
			foreach($entry_id as $row_id)
			{
				$caa_data								       =    mvc_model('model.client_account_agent')->select($row_id);//get client account id of entry
				if(!(in_array($caa_data['client_account_id'],$caa_id)))
				{
					$data['row.history']                      .=    mvc_model('model.client_account_agent')->select_account_history($caa_data['client_account_id']);
					$caa_id[]								   =    $caa_data['client_account_id'];	
				}
			}
		}
        # VIEW - side nav
        $side_nav['entry_type']                                =    $entry_type;
        $side_nav['c_id']                                      =    $id;
        $side_nav['ca_id']                                     =    $c_id;
        $side_nav['account_history.class']               	   =    'bold';             
        $data['side_nav']                                      =    view_get_template($parent->controller_id.'/template/side.commission', $side_nav);                       
        # VIEW
        $parent->_view('commission.account_history', $data);        
    }
    
    
     public function documents($parent)
    {          
         $id                                                   =    $_GET['id']*1;//entry id
         $c_id                                                 =    $_GET['c_id']*1;// client account id
         $entry_type										   =    $_GET['entry_type']; // consolidated or single entry
        # DB
        if($entry_type =='single')
		{
			$data['row.documents']              	   		   =    mvc_model('model.document_account')->select_docs($c_id);
		}
		else
		{
			$entry_id										   =    mvc_model('model.client_account_agent_consolidate')->select_consolidated_entry($id);
			//hash_dump($entry_type,true);
			$caa_id											   =    array();
			foreach($entry_id as $row_id)
			{
				$caa_data								       =    mvc_model('model.client_account_agent')->select($row_id);//get client account id of entry
				if(!(in_array($caa_data['client_account_id'],$caa_id)))
				{
					$data['row.documents']                    .=    mvc_model('model.document_account')->select_docs($caa_data['client_account_id']);
					$caa_id[]								   =    $caa_data['client_account_id'];	
				}
			}
		}
        
        # VIEW - side nav
        $side_nav['entry_type']                                =    $entry_type;
        $side_nav['c_id']                                      =    $id;
        $side_nav['ca_id']                                     =    $c_id;
        $side_nav['documents.class']                           =    'bold';             
        $data['side_nav']                                      =    view_get_template($parent->controller_id.'/template/side.commission', $side_nav);                       
        # VIEW
        $parent->_view('commission.documents', $data);        
    }
    
    
   
    
     public function remarks($parent)
    {          
        $id                                                   =    $_GET['id']*1;
        $c_id                                                 =    $_GET['c_id']*1;
        $entry_type										      =    $_GET['entry_type']; // consolidated or single entry
        
        $remark_key											  =    ($entry_type == 'single' ? 'client_account' : 'client_account_agent');
        $remark_file										  =    ($entry_type == 'single' ? '' : 'consolidated.');
        $key_id										  		  =    ($entry_type == 'single' ? $c_id : $id);
        
        # DB
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row($remark_key, $key_id);
        $data['client_account_id']                            =     $c_id;
        $data['client_account_agent_id']                      =     $id;
        # VIEW - side nav
        $side_nav['entry_type']                               =    $entry_type;
        $side_nav['c_id']                                     =    $id;
        $side_nav['ca_id']                                    =    $c_id;
        $side_nav['remarks.class']                            =    'bold';             
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.commission', $side_nav);                       
        # VIEW
        $parent->_view($remark_file.'commission.remark', $data);        
    }
    
   
#----------------------- Form Actions    

 	 public function submit_remark($parent)
    {
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $_POST['client_account_id'];
      // hash_dump($remark,true);
        mvc_model('model.remark')->insert($remark);                    
        header_location("/sales/commission/remarks/&id={$_POST['client_account_agent_id']}&c_id={$_POST['client_account_id']}&entry_type=single");
    } 
    
    
     public function submit_remark_consolidated($parent)
    {
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $_POST['client_account_agent_id'];
      // hash_dump($remark,true);
        mvc_model('model.remark')->insert($remark);                    
        header_location("/sales/commission/remarks/&id={$_POST['client_account_agent_id']}&entry_type=consolidated");
    }  
    
     public function approve_commission($parent)
    {          
         $id                                                      =    $_GET['id']*1;
         $cur_time											      =    time();
        # DB 
        $c_a                              					      =    mvc_model('model.client_account_agent')->select($id);
        //hash_dump($agent,true);
        $data['int']['account_payable_timestamp']			      =    $cur_time;
        $data['str']['request_type_id']                           =    'rfp';
        $data['str']['request_recommended_by']				      =    $parent->user['user_name'].' '.$parent->user['user_surname'];
        $data['str']['option_department_id']				      =    'finance'; // for questioning.. hardcoded value
        $data['str']['request_requestor']					      =    'Commission - Computer Generated';
        $data['str']['request_purpose']						      =    'sales commission';
        $data['int']['request_amount']						      =    $c_a['client_account_agent_commission_amount_net'];
        $data['str']['request_accounted_to']				      =    'ALSC - Sales';
        $data['str']['request_payable_to']				      	  =    'ALSC - Sales Commission';
        $data['str']['request_tin']							      =     'N/A';
        $data['str']['option_payment_method_id']				  =     'check';
        $data['str']['request_date_needed']					      =    string_date($cur_time + 604800); // date 1weeek from approval
        $data['str']['request_details']						   	  =    'Commission - Request';
        $data['int']['is_commission']						   	  =    $id;
        $data['int']['is_commission_group']						  =    ($c_a['option_entry_type_id'] == 'group' ? 1 : 0);
		//hash_dump($c_a,true);
		$insert                                                   =  mvc_model('model.account_payable')->insert($data);
		$item[0]['int']['account_payable_item_amount']		      =  $c_a['client_account_agent_commission_amount_current'];
		$item[0]['int']['account_payable_item_price']		      =  $c_a['client_account_agent_commission_amount_current'];
		$item[0]['int']['account_payable_item_qty']				  =  1;
		$item[0]['str']['account_payable_item_desc']			  =  'Sales Commission';
        $insert_item                                              =  mvc_model('model.account_payable_item')->insert($item,$insert['data']['data']['account_payable_id']);
       
        $post['int']['user_id']                                   = $parent->user['user_id']; 
        $post['str']['request_approval_level_id']                 = $insert['data']['data']['request_approval_level_id']; 
        $post['str']['request_approval_status_id']                = $insert['data']['data']['request_approval_status_id']; 
        $post['str']['request_type_id']                           = 'rfp'; 
        $post['int']['account_payable_ticket_timestamp']          = $insert['data']['data']['account_payable_timestamp']; 
        $post['int']['account_payable_id']                        = $insert['data']['data']['account_payable_id']; 
        mvc_model('model.account_payable_ticket')->insert($post);
        
        if($c_a['option_entry_type_id'] == 'group')
        {
			$consolidated_id									  =	 mvc_model('model.client_account_agent_consolidate')->select_consolidated_entry($id);
			foreach($consolidated_id as $single_id)
			{
				 mvc_model('model.client_account_agent')->update_approve($single_id);
			}
        }
       
	    mvc_model('model.client_account_agent')->update_approve($id);
		header_location("/sales/commission/");        
    } 
    
    public function group($parent)
    {          
         
        $total_amt			 = mvc_model('model.client_account_agent')->get_total_consolidated_amount(implode(",",$_POST['consolidate_row']));
        $data				 = mvc_model('model.client_account_agent')->insert_consolidate_commission($total_amt);
        $id  				 = $data['data']['data']['client_account_agent_id'];
        mvc_model('model.client_account_agent_consolidate')->insert($_POST['consolidate_row'],$id);
        $update_data				 = mvc_model('model.client_account_agent')->update_consolidated($_POST['consolidate_row']);
		header_location("/sales/commission/");        
    } 
    
    public function ungroup($parent)
    {          
       $id                                                   =    $_GET['id']*1;
       $entry_id										     =    mvc_model('model.client_account_agent_consolidate')->select_consolidated_entry($id);
       $update_data				 							 =    mvc_model('model.client_account_agent')->update_unconsolidate($entry_id);
       $delete_data				 							 =    mvc_model('model.client_account_agent')->delete_group_entry($id);
       $delete_con_data										 =    mvc_model('model.client_account_agent_consolidate')->delete_consolidated_entry($entry_id,$id);
	   header_location("/sales/commission/");        
    } 

    
    public function test($parent)
    {          
      
	   $data	= mvc_model('model.client_account')->select_account_(16);
       mvc_model('model.sales_commission_account')->add_sales_commission_account($data)   ; 
    }
    

    

    
//===============================AJAX Commission
	public function get_commission_seller($parent)
    {
       if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
        {
            $child_option                        =    mvc_model('model.option')->select_option('commission_scheme', " WHERE commission_scheme_type = '{$_POST['scheme_type']}'");
            $data								 =    '<option></option>';
            $data                      			 .=    hash_to_option($child_option, 'commission_scheme_id', 'commission_scheme_name');
           
            echo $data; 
        }
        else
        {
            echo '';
        }
        exit();
    }
    
    
    public function get_agent_list($parent)
    {
       if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
        {
            $data                        =    mvc_model('model.commission_percentage')->select_agents_by_commission_scheme_id($_POST['agent_id'],$_POST['commission_scheme_id']);
           
            echo $data; 
        }
        else
        {
            echo '';
        }
         exit();
    }
    
    
    public function get_agent_commission($parent)
    {
       if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
        {
            
            switch ($_POST['commission_scheme_id']) 
				{
				     case "new_property_consultant":
				         $condition = 'property_consultant';
				     break;
				     
				     case "new_sales_director":
				     $condition = 'sales_director';
				     break;
				     
				     case "new_sales_manager":
				     $condition = 'sales_manager';
				     break;
				     
				     case "new_vp_sales":
				     $condition = 'vp_sales';
				     break;
				     
				     case "old_avp":
				     $condition = 'avp';
				     break;
				     
				     case "old_avp_ma":
				     $condition = 'marketing_associate';
				     break; 
				     
				     case "old_avp_sm":
				     $condition = 'old_sales_manager';
				     break;
				     
				     case "old_avp_sm_ma":
				     $condition = 'marketing_associate';
				     break;
				     
				     case "old_broker":
				     $condition = 'broker';
				     break;
				      
				     default:
				     $condition = 'none';
				}
            
            
            $label[]										=    'agent_first_name';
            $label[]										=    'agent_last_name';
            $agent_position                                 =    mvc_model('model.option')->select_option('agent', "WHERE option_agent_position_id = '{$condition}'  ");
        	$data										    =    '<option></option>';
        	$data                       				   .=    hash_to_option($agent_position, 'agent_id', $label);
            
            echo $data; exit();
        }
        else
        {
            echo '';
        }
        exit();
    }
    
}