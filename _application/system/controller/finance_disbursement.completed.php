<?php
class finance_disbursement_completed
{
    
     public function __construct()
    {        
       $this->controller_id = 'finance_disbursement_completed';             
    }
    
    public function index($parent)
    {   
        # DB 
        $data['row.ticket']                                   =    mvc_model('model.account_payable')->select_all_ticket('completed',0);
        # VIEW
        $parent->_view('completed', $data);
    }
    
     public function profile($parent)
    {          
        # DB
        $id                                                   =    $_GET['id']*1; 
        $data                                                 =    mvc_model('model.account_payable')->get_row($id);
        $item_row                                             =    '';
        ($data['option_payment_method_id'] == 'cash' ? $data['chq_payment_class'] = 'display_none' : $data['cash_payment_class'] = 'display_none');
        if($data['request_type_id'] == 'rfp')
        {
            $fname       =    'completed.profile_rfp';
            $item_row    =    mvc_model('model.account_payable_item')->get_item_row($id);
        }
         elseif($data['request_type_id'] == 'ofv')
        {
			$fname       =    'completed.profile_ofv';
			$item_row    =    mvc_model('model.ofv_request')->get_profile_row($id);
        }
        elseif($data['request_type_id'] == 'tax')
        {
			$fname       =    'completed.profile_tax';
			$item_row    =    mvc_model('model.tax_request')->get_profile_row($id);
        }
        else
        {
            $fname       =    'completed.profile_tba';
            $item_row    =    mvc_model('model.account_payable_item')->get_item_row($id);
        }
        
        $item_details                         				  =    mvc_model('model.account_payable_item_detail')->select_item_details($id);
        $data['profile.cdv']                   		 	      =    mvc_model('model.account_payable_item_detail')->select_cdv($id,$data['option_payment_method_id']);
        $data['profile.ticket']                               =    mvc_model('model.account_payable')->select_ticket($fname,$id,$data['request_approval_level_id'],$data['request_approval_status_id'],$item_row,'finance_disbursement',$item_details);
        $data['row.account_cheque']                           =    mvc_model('model.account_payable_cheque')->get_exec_row($id);
        $data['row.ofv_account_payable']                      =    mvc_model('model.account_payable_ofv')->get_rows_by_account_payable($id);
        # VIEW - side nav
        $side_nav['t_id']                                     =    $id;
        $side_nav['profile.class']                            =    'bold';
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.completed', $side_nav);
        # VIEW
        $parent->_view('completed.profile', $data);        
    }
    
 public function remarks($parent)
    {          
         # DB
        $id                                                   =    $_GET['id'];
        $data                                                 =    mvc_model('model.project')->select($id);            
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row('account_payable', $id);
        $data['account_payable_id']                           =    $id;
        $data['remark.form.link']                             =    '/finance_disbursement/completed/submit_remark';
        # VIEW - side nav
        $side_nav['t_id']                                     =    $id;
        $side_nav['remarks.class']                            =    'bold';             
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.completed', $side_nav);                       
        # VIEW
        $parent->_view('remarks', $data);        
    }
#----------------------- Form Actions    
     
 
    
    public function submit_remark($parent)
    {
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $_POST['account_payable_id'];
      // hash_dump($remark,true);
        mvc_model('model.remark')->insert($remark);                    
        header_location("/finance_disbursement/completed/remarks/&id={$_POST['account_payable_id']}");
    } 
    


    
    
}