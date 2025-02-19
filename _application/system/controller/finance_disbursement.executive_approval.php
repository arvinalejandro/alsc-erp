<?php
class finance_disbursement_executive_approval
{
    
     public function __construct()
    {        
       $this->controller_id = 'finance_disbursement_executive_approval';             
    }
    
    public function index($parent)
    {   
        # DB 
        $data['row.ticket']                                   =    mvc_model('model.account_payable')->select_all_ticket('exec_approve',0);
        # VIEW
        $parent->_view('pending_exec_approve', $data);
    }
    
     public function profile($parent)
    {          
        # DB
        $id                                                   =    $_GET['id']*1; 
        $data                                                 =    mvc_model('model.account_payable')->get_row($id);
        $ofv_data											  =    mvc_model('model.accounting_receive')->select_bank_balance(6);
        $data['ofv_balance_amount']							  =    $ofv_data['bank_balance'];
        $p_opt	     										  =    mvc_model('model.bank')->select_all();
        $data['bank_opt']	                                  =    hash_to_option($p_opt, 'bank_id', 'bank_name');
        $payment_option                                 	  =    mvc_model('model.option')->select_option('option_payment_method', "WHERE option_payment_method_id != 'bank_transfer'");      
        $data['payment_option']                               =    hash_to_option($payment_option, 'option_payment_method_id', 'option_payment_method_name',$data['option_payment_method_id']);
        ($data['option_payment_method_id'] == 'cash' ? $data['chq_payment_class'] = 'display_none' : $data['cash_payment_class'] = 'display_none');
        $item_row                                             =    '';
        if($data['request_type_id'] == 'rfp')
        {
            $fname       =    'exec_approve.profile_rfp';
            $item_row    =    mvc_model('model.account_payable_item')->get_item_row($id);
            $data['tba_class']  = 'display_none';
        }
        elseif($data['request_type_id'] == 'ofv')
        {
			$fname       =    'exec_approve.profile_ofv';
			$item_row    =    mvc_model('model.ofv_request')->get_profile_row($id);
			$data['tba_class']  = 'display_none';
			$data['ofv_class']  = 'display_none';
        }
        elseif($data['request_type_id'] == 'tax')
        {
			$fname       =    'exec_approve.profile_tax';
			$item_row    =    mvc_model('model.tax_request')->get_profile_row($id);
			$data['tba_class']  = 'display_none';
        }
        else
        {
            $fname       =    'exec_approve.profile_tba';
            $data['tba_class']  = '';
        }
       
        $data['profile.ticket']                               =    mvc_model('model.account_payable')->select_ticket($fname,$id,$data['request_approval_level_id'],$data['request_approval_status_id'],$item_row);
        # VIEW - side nav
        $side_nav['t_id']                                     =    $id;
        $side_nav['profile.class']                            =    'bold';
        $data['status_view']                                  =    ($data['request_approval_status_id'] == 'declined' ? 'display_none' : '');
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.pending_exec_approve', $side_nav);
        # VIEW
        $parent->_view('pending_exec_approve.profile', $data);        
    }
    
     public function remarks($parent)
    {          
       # DB
        $id                                                   =    $_GET['id'];
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row('account_payable', $id);
        $data['account_payable_id']                           =    $id;
        $data['remark.form.link']                             =    '/finance_disbursement/executive_approval/submit_remark';
        # VIEW - side nav
        $side_nav['t_id']                                     =    $id;
        $side_nav['remarks.class']                            =    'bold';             
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.pending_exec_approve', $side_nav);                       
        # VIEW
        $parent->_view('remarks', $data);        
    }
#----------------------- Form Actions    
     
     public function submit_update_ticket($parent)
    {
        $_POST['payable']['str']['request_approval_level_id']       = ($_POST['payable']['str']['request_approval_status_id'] == 'approved' ? 'journal_entry' : 'exec_approve');
        $_POST['payable']['str']['request_approval_level_id']       = ($_POST['payable']['str']['request_type_id']   == 'ofv' ? 'cheque_prep' :  $_POST['payable']['str']['request_approval_level_id']);
        $_POST['payable']['str']['request_approval_level_id']       = ($_POST['payable']['str']['request_type_id']   == 'tax' ? 'cheque_prep' :  $_POST['payable']['str']['request_approval_level_id']);
        $_POST['payable']['int']['user_id']                         =  $parent->user['user_id'];
        #insert ticket
      
        mvc_model('model.account_payable_ticket')->insert($_POST['payable']);
    
        if($_POST['payment']['str']['option_payment_method_id'] == 'check')
        {
			#insert cheque
	        $post_chq['user_id']                                    =  $parent->user['user_id']; 
	        $post_chq['account_payable_id']                         =  $_POST['payable']['int']['account_payable_id']; 
	        $post_chq['account_payable_cheque']                     =  $_POST['account_cheque']; 
	        $ret												    =  mvc_model('model.account_payable_cheque')->insert($post_chq);
        }
        
        #update account_payable
        $up_post['int']['request_approved_amount']                  =  (!empty($_POST['modified_amount']) ? $_POST['modified_amount'] : $_POST['request_amount']);
        $up_post['str']['option_payment_method_id']                 =  $_POST['payment']['str']['option_payment_method_id'];
        $up_post['str']['request_approval_level_id']                =  $_POST['payable']['str']['request_approval_level_id'];
        $up_post['str']['request_approval_status_id']               =  $_POST['payable']['str']['request_approval_status_id'];
        $up_post['str']['request_approved_by']                      =  $parent->user['user_name'].' '.$parent->user['user_surname'];
        $up_post['int']['request_approved_date']                    =  time();
        $update_ticket                                              =  mvc_model('model.account_payable')->update($up_post,$_POST['payable']['int']['account_payable_id']);
        
        #remark
        $remark                                                     =  $_POST['remark'];
        $remark['int']['user_id']                                   =  $parent->user['user_id'];
        $remark['int']['remark_key_id']                             =  $_POST['payable']['int']['account_payable_id'];
        mvc_model('model.remark')->insert($remark); 
        header_location("/finance_disbursement/executive_approval");
    }
    
    
    public function submit_remark($parent)
    {
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $_POST['account_payable_id'];
      // hash_dump($remark,true);
        mvc_model('model.remark')->insert($remark);                    
        header_location("/finance_disbursement/executive_approval/remarks/&id={$_POST['account_payable_id']}");
    }
    
  
}