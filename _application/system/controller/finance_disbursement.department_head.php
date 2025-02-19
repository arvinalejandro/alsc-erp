<?php
class finance_disbursement_department_head
{
    
     public function __construct()
    {        
       $this->controller_id = 'finance_disbursement_department_head';    
       /*
         if($data['option_payment_method_id'] == 1)
            {
                   $data['request_release_date']            =    string_date_time($data['request_release_date']);
                   $template_row                            =    view_get_template('finance_disbursement/template/row.cash');
                   $payment                                 =    view_populate($data, $template_row);
            }
            else
            {
                   $data['request_cheque_date']             =    string_date_time($row['request_cheque_date']);
                   $template_row                            =    view_get_template('finance_disbursement/template/row.chq');
                   $payment                                 =    view_populate($data, $template_row);
            }
       */         
    }
    
    public function index($parent)
    {   
        # DB 
        $data['row.ticket']                                   =    mvc_model('model.account_payable')->select_all_ticket('dept_head',0);
        $data['row.ongoing']                                  =    mvc_model('model.account_payable')->select_ongoing_ticket();
        # VIEW
        $parent->_view('pending_dept_head', $data);
    }
    
     public function profile($parent)
    {          
        # DB
        $id                                                   =    $_GET['id']*1; 
        $profile_type                                         =    $_GET['profile_type']; 
        $data                                                 =    mvc_model('model.account_payable')->get_row($id);
        $item_row                                             =    '';//for rfp.. 
        if($data['request_type_id'] == 'rfp')
        {
            $fname       =    'dept_head.profile_rfp';
            $item_row    =    mvc_model('model.account_payable_item')->get_item_row($id);
        }
         elseif($data['request_type_id'] == 'ofv')
        {
			$fname       =    'exec_approve.profile_ofv';
			$item_row    =    mvc_model('model.ofv_request')->get_profile_row($id);
        }
        elseif($data['request_type_id'] == 'tax')
        {
			$fname       =    'exec_approve.profile_tax';
			$item_row    =    mvc_model('model.tax_request')->get_profile_row($id);
        }
        else
        {
            $fname       =    'dept_head.profile_tba';
        }
        
        $data['profile.ticket']                               =    mvc_model('model.account_payable')->select_ticket($fname,$id,$data['request_approval_level_id'],$data['request_approval_status_id'],$item_row);
        # VIEW - side nav
        $side_nav['t_id']                                     =    $id;
        $side_nav['profile.class']                            =    'bold';
        $side_nav['dept_query']                           	  =    ($profile_type == 'dept_head' ? '&profile_type=dept_head' : '' );
        $data['status_view']                                  =    ($data['request_approval_status_id'] == 'declined' ? 'display_none' : '');
        $data['status_view']                                  =    ($profile_type == 'dept_head' ? 'display_none' : $data['status_view'] );
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.pending_dept_head', $side_nav);                       
        # VIEW      
        $parent->_view('pending_dept_head.profile', $data);        
    }
    
     public function remarks($parent)
    {          
        # DB
        $id                                                   =    $_GET['id'];
        $profile_type                                         =    $_GET['profile_type'];
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row('account_payable', $id);
        $data['account_payable_id']                           =    $id;
        $data['remark.form.link']                             =    '/finance_disbursement/department_head/submit_remark';
        # VIEW - side nav
        $side_nav['dept_query']                           	  =    ($profile_type == 'dept_head' ? '&profile_type=dept_head' : '' );
        $side_nav['t_id']                                     =    $id;
        $side_nav['remarks.class']                            =    'bold';             
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.pending_dept_head', $side_nav);                       
        # VIEW
        $parent->_view('remarks', $data);        
    }
#----------------------- Form Actions    
     
     public function submit_update_ticket($parent)
    {          
        $_POST['payable']['str']['request_approval_level_id']       = ($_POST['payable']['str']['request_approval_status_id'] == 'approved' ? 'exec_approve' : 'dept_head');
        $_POST['payable']['int']['user_id']                         =  $parent->user['user_id']; 

        #insert ticket
        mvc_model('model.account_payable_ticket')->insert($_POST['payable']);
        
        #update account_payable
        $up_post['str']['request_approval_level_id']                =  $_POST['payable']['str']['request_approval_level_id'];
        $up_post['str']['request_approval_status_id']               =  $_POST['payable']['str']['request_approval_status_id'];
        $update_ticket                                              =  mvc_model('model.account_payable')->update($up_post,$_POST['payable']['int']['account_payable_id']);
       
        #remark
        $remark                                                 =  $_POST['remark'];
        $remark['int']['user_id']                               =  $parent->user['user_id'];
        $remark['int']['remark_key_id']                         =  $_POST['payable']['int']['account_payable_id'];
        mvc_model('model.remark')->insert($remark); 
        header_location("/finance_disbursement/department_head");
    }
    
    
    public function submit_remark($parent)
    {
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $_POST['account_payable_id'];
      // hash_dump($remark,true);
        mvc_model('model.remark')->insert($remark);                    
        header_location("/finance_disbursement/department_head/remarks/&id={$_POST['account_payable_id']}");
    }

}