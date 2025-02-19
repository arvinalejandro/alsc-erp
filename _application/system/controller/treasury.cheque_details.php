<?php
class treasury_cheque_details
{
    
     public function __construct()
    {        
       $this->controller_id = 'treasury_cheque_details';             
    }
    
    public function index($parent)
    {   
        # DB 
        $data['row.ticket']                                   =    mvc_model('model.account_payable')->select_all_ticket('cheque_prep',1,'treasury');
        # VIEW
        $parent->_view('pending_treas_chq_details', $data);
    }
    
     public function profile($parent)
    {          
        # DB
        $id                                                   =    $_GET['id']; 
        $data                                                 =    mvc_model('model.account_payable')->get_row($id);
        $item_row                                             =    '';
        $p_opt                                                =    '';
        if($data['request_type_id'] == 'rfp')
        {
            $fname       						=    'chq_details.profile_rfp';
            $item_row   				 		=    mvc_model('model.account_payable_item')->get_item_row($id);
            $data['profile.cdv']                =    mvc_model('model.account_payable_item_detail')->select_cdv($id,$data['option_payment_method_id']);
        }
        elseif($data['request_type_id'] == 'ofv')
        {
			$fname       =    'chq_details.profile_ofv';
			$item_row    =    mvc_model('model.ofv_request')->get_profile_row($id);
        }
        elseif($data['request_type_id'] == 'tax')
        {
			$fname       =    'chq_details.profile_tax';
			$item_row    =    mvc_model('model.tax_request')->get_profile_row($id);
			$data['tba_class']  = 'display_none';
        }
        else
        {
            $fname      			        =    'chq_details.profile_tba';
            $data['profile.cdv']            = '';
        }
       
        
        if($data['option_payment_method_id'] == 'cash')
        {
			 $data['row.account_cheque']                      =    '';
			 $data['chq_payment_class'] 					  = 'display_none';
        }
        else
        {
			 $data['row.account_cheque']                      =    mvc_model('model.account_payable_cheque')->get_details_row($id);
			 $data['cash_payment_class'] 				      = 'display_none';
        }
        $data['profile.ticket']                               =    mvc_model('model.account_payable')->select_ticket($fname,$id,$data['request_approval_level_id'],$data['request_approval_status_id'],$item_row,'treasury');
       
        # VIEW - side nav
        $side_nav['t_id']                                     =    $id;
        $side_nav['profile.class']                            =    'bold';
        $data['status_view']                                  =    ($data['request_approval_status_id'] == 'revoked' ? 'display_none' : '');
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.pending_treas_chq_details', $side_nav);
        
        # VIEW
        $parent->_view('pending_treas_chq_details.profile', $data);        
    }
    
     public function remarks($parent)
    {          
        # DB
        $id                                                   =    $_GET['id'];
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row('account_payable', $id);
        $data['account_payable_id']                           =    $id;
        $data['remark.form.link']                             =    '/treasury/cheque_details/submit_remark';
        # VIEW - side nav
        $side_nav['t_id']                                     =    $id;
        $side_nav['remarks.class']                            =    'bold';             
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.pending_treas_chq_details', $side_nav);                       
        # VIEW
        $parent->_view('remarks', $data);        
    }
#----------------------- Form Actions    
     
     public function submit_update_ticket($parent)
    {
        $_POST['payable_ticket']['str']['request_approval_level_id']       = ($_POST['payable_ticket']['str']['request_approval_status_id'] == 'ready' ? 'exec_sign' : 'cheque_prep');
        $_POST['payable_ticket']['int']['user_id']                         =  $parent->user['user_id'];
        
        
        
        #update account_payable_cheque / cash
       if($_POST['option_payment_method_id'] == 'cash' )
       {
	        #insert ofv	
	        $post_ofv['account_payable_ofv_release_date']     								= strtotime($_POST['request_release_date']);
			$post_ofv['user_id']                                    						=  $parent->user['user_id']; 
	        $post_ofv['account_payable_id']                         						=  $_POST['payable_ticket']['int']['account_payable_id']; 
	        $post_ofv['account_payable_ofv']                     							=  $_POST['account_payable_ofv']; 
	       
	        if($_POST['is_reimbursement'] == 1)
	        {
				$_POST['payable_ticket']['str']['request_approval_level_id']    		= ($_POST['payable_ticket']['str']['request_approval_status_id'] == 'ready' ? 'cheque_release' : 'cheque_prep');
				$_POST['payable_ticket']['str']['request_approval_status_id'] 			=  'reimbursement';
				$post_ofv['account_payable_ofv']['int']['account_payable_ofv_amount']   =   $_POST['reimbursement_amount'];
	        }
	        $ret												    			=  mvc_model('model.account_payable_ofv')->insert($post_ofv);
       }
       else
       {
	            $update_cheque                                      =  mvc_model('model.account_payable_cheque')->update_details($_POST['account_payable_cheque']);
       }
       
       #insert ticket
        mvc_model('model.account_payable_ticket')->insert($_POST['payable_ticket']);
       
        #update account_payable
        $up_post['str']['request_approval_level_id']                =  $_POST['payable_ticket']['str']['request_approval_level_id'];
        $up_post['str']['request_approval_status_id']               =  $_POST['payable_ticket']['str']['request_approval_status_id'];
        $update_ticket                                              =  mvc_model('model.account_payable')->update($up_post,$_POST['payable_ticket']['int']['account_payable_id']);
        
        #remark
        $remark                                                 	=  $_POST['remark'];
        $remark['int']['user_id']                               	=  $parent->user['user_id'];
        $remark['int']['remark_key_id']                         	=  $_POST['payable_ticket']['int']['account_payable_id'];
        mvc_model('model.remark')->insert($remark); 
         
        header_location("/treasury/cheque_details/");
    }
    
    
    public function submit_remark($parent)
    {
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $_POST['account_payable_id'];
      // hash_dump($remark,true);
        mvc_model('model.remark')->insert($remark);                    
        header_location("/treasury/cheque_details/remarks/&id={$_POST['account_payable_id']}");
    }
    
    
}