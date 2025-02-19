<?php
class treasury_cheque_release
{
    
     public function __construct()
    {        
       $this->controller_id = 'treasury_cheque_release';             
    }
    
    public function index($parent)
    {   
        # DB 
        $data['row.ticket']                                   =    mvc_model('model.account_payable')->select_all_ticket('cheque_release',1,'treasury');
        # VIEW
        $parent->_view('pending_treas_chq_release', $data);
    }
    
     public function profile($parent)
    {          
        # DB
        $id                                                   =    $_GET['id']; 
        $data                                                 =    mvc_model('model.account_payable')->get_row($id);
        $item_row                                             =    '';
        ($data['option_payment_method_id'] == 'cash' ? $data['chq_payment_class'] = 'display_none' : $data['cash_payment_class'] = 'display_none');
        if($data['request_type_id'] == 'rfp')
        {
            $fname       					=    'chq_release.profile_rfp';
            $item_row    					=    mvc_model('model.account_payable_item')->get_item_row($id);
            $data['profile.cdv']            =    mvc_model('model.account_payable_item_detail')->select_cdv($id,$data['option_payment_method_id']);
        }
        elseif($data['request_type_id'] == 'ofv')
        {
			$fname       =    'chq_release.profile_ofv';
			$item_row    =    mvc_model('model.ofv_request')->get_profile_row($id);
        }
         elseif($data['request_type_id'] == 'tax')
        {
			$fname       =    'chq_release.profile_tax';
			$item_row    =    mvc_model('model.tax_request')->get_profile_row($id);
			$data['tba_class']  = 'display_none';
        }
        else
        {
            $fname       					=    'chq_release.profile_tba';
            $data['profile.cdv']            = '';
        }
        
        $data['profile.ticket']                               =    mvc_model('model.account_payable')->select_ticket($fname,$id,$data['request_approval_level_id'],$data['request_approval_status_id'],$item_row,'treasury');
        $data['row.account_cheque']                           =    mvc_model('model.account_payable_cheque')->get_release_row($id);
        $data['row.ofv_account_payable']                      =    mvc_model('model.account_payable_ofv')->get_rows_by_account_payable($id, ' AND is_released=0');
        # VIEW - side nav
        $side_nav['t_id']                                     =    $id;
        $side_nav['profile.class']                            =    'bold';
  //      $data['status_view']                                  =    ($data['request_approval_status_id'] == 'declined' ? 'display_none' : '');
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.pending_treas_chq_release', $side_nav);
        # VIEW
        $parent->_view('pending_treas_chq_release.profile', $data);        
    }
    
    
    public function remarks($parent)
    {          
         # DB
        $id                                                   =    $_GET['id'];
        $data                                                 =    mvc_model('model.project')->select($id);            
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row('account_payable', $id);
        $data['account_payable_id']                           =    $id;
        $data['remark.form.link']                             =    '/treasury/cheque_release/submit_remark';
        # VIEW - side nav
        $side_nav['t_id']                                     =    $id;
        $side_nav['remarks.class']                            =    'bold';             
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.pending_treas_chq_release', $side_nav);                       
        # VIEW
        $parent->_view('remarks', $data);        
    }
#----------------------- Form Actions    
     
     public function submit_update_ticket($parent)
    {
         $_POST['payable']['int']['user_id']                         	=   $parent->user['user_id'];
         $level_id	                                                    =  ($_POST['payable']['str']['request_type_id'] == 'rfp' ? 'reconciliation' : 'liquidate');
         $level_id      												=  ($_POST['payable']['str']['request_type_id']   == 'ofv' ? 'completed' :  $level_id);
         $level_id      												=  ($_POST['payable']['str']['request_type_id']   == 'tax' ? 'completed' :  $level_id);
        //hash_dump($_POST,true);
         
         if($_POST['option_payment_method_id'] == 'cash')
         { 
		           if($_POST['cash_released'] == 'released')
		           {
			           $ofv_data										=  mvc_model('model.account_payable_ofv')->select_ofv( $_POST['account_payable_ofv_id']);
			           $insert_transaction                              =  mvc_model('model.bank_transaction')->insert_disbursement_ofv($ofv_data,$_POST['request_recommended_by']);
			           $update_ofv										=  mvc_model('model.account_payable_ofv')->update_released($_POST['account_payable_ofv_id'],$insert_transaction['data']['data']['bank_transaction_id']);
			           $chq_rows['c_count']           					=  0;
			           
			            if($_POST['is_reimbursement'] == 1)
				        {
							$level_id   								= 'completed';
				        }
				        
				        
				        //for commission contingency=================
				        if($_POST['caa_id'] > 0)
				        {
							if($_POST['caa_type'] == 1)
					        {
								$consolidated_id					       =	mvc_model('model.client_account_agent_consolidate')->select_consolidated_entry($_POST['caa_id']);
								foreach($consolidated_id as $single_id)
								{
									 $entry 							   =    mvc_model('model.client_account_agent')->select($single_id);
									 if($entry['contingency_released'] == 0)
									 {
										 $insert_transaction               =    mvc_model('model.bank_transaction')->insert_contingency($entry['client_account_agent_commission_contingency'],$entry['client_account_id'],$single_id);
		    							 $insert_commission_contingency    =    mvc_model('model.commission_contingency')->insert($insert_transaction['data']['data']['bank_transaction_id'], $single_id);
									 }
								}
					        }
					        else
							{
								         $entry 						   =    mvc_model('model.client_account_agent')->select($_POST['caa_id']);
								         $insert_transaction               =    mvc_model('model.bank_transaction')->insert_contingency($entry['client_account_agent_commission_contingency'],$entry['client_account_id'],$_POST['caa_id']);
		    							 $insert_commission_contingency    =    mvc_model('model.commission_contingency')->insert($insert_transaction['data']['data']['bank_transaction_id'], $_POST['caa_id']);
							}
				       	}
			           //===============================
				   }
		 }
		 else
		 {
			 
		     #update account_payable_cheque
	         $update_cheque                                             =  mvc_model('model.account_payable_cheque')->update_release($_POST['account_payable_cheque']);
	         $chq_rows												    =  mvc_model('model.account_payable_cheque')->count_pending_cheque($_POST['payable']['int']['account_payable_id'],' AND is_released = 0');
	         $released_cheque                                           =  mvc_model('model.account_payable_cheque')->select_released_cheque($_POST['account_payable_cheque'],$_POST['payable']['int']['account_payable_id']);
		     
		     if($_POST['payable']['str']['request_type_id'] == 'ofv')
		     {
			     $insert_transaction                                    =  mvc_model('model.bank_transaction')->insert_replenish($released_cheque,$_POST['request_recommended_by']);
	             $update_tran_cheque                                    =  mvc_model('model.account_payable_cheque')->update_transaction_cheque($insert_transaction['data']);
		     }
		     else
		     {
	             $insert_transaction                                    =  mvc_model('model.bank_transaction')->insert_disbursement_cheque($released_cheque,$_POST['request_recommended_by']);
	             $update_tran_cheque                                    =  mvc_model('model.account_payable_cheque')->update_transaction_cheque($insert_transaction['data']);
		     }
			 
		 }
		
        #insert ticket
        $_POST['payable']['str']['request_approval_level_id']           =  ($chq_rows['c_count'] == 0 ? $level_id : 'cheque_release');
        $_POST['payable']['str']['request_approval_status_id']          =  'released';
        mvc_model('model.account_payable_ticket')->insert($_POST['payable']);
        
        #update account_payable
        if($_POST['payable']['str']['request_approval_level_id'] == $level_id)
        {
			$up_post['str']['request_approval_level_id']                =  $_POST['payable']['str']['request_approval_level_id'];
	        $up_post['str']['request_approval_status_id']               =  'released';
	        $up_post['int']['request_release_date']                     =  time(); 
	        $update_ticket                                              =  mvc_model('model.account_payable')->update($up_post,$_POST['payable']['int']['account_payable_id']);
        }
        
        #remark
        $remark                                                     	=  $_POST['remark'];
        $remark['int']['user_id']                                   	=  $parent->user['user_id'];
        $remark['int']['remark_key_id']                             	=  $_POST['payable']['int']['account_payable_id'];
        mvc_model('model.remark')->insert($remark); 
        header_location("/treasury/cheque_release/");
    }
    
    
    public function submit_remark($parent)
    {
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $_POST['account_payable_id'];
      // hash_dump($remark,true);
        mvc_model('model.remark')->insert($remark);                    
        header_location("/treasury/cheque_release/remarks/&id={$_POST['account_payable_id']}");
    }      
}