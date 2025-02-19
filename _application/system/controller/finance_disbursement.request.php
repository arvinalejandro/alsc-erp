<?php
class finance_disbursement_request
{
    
    public function __construct()
    {        
       $this->sub_method                  =    $_GET['_1'];
       $this->controller_id               = 'finance_disbursement_request';  
       $this->user                        =    mvc_model('model.user')->select($_SESSION['user_id']);           
    }
    
    public function index($parent)
    {   
        # VIEW
        $parent->_view('request', $data);
    }
    
    
    public function tba($parent)
    {   
        # DB
        $dept_option                                    =    mvc_model('model.option')->select_option('option_department', 'ORDER BY option_department_name ASC');
        $payment_option                                 =    mvc_model('model.option')->select_option('option_payment_method', "WHERE option_payment_method_id != 'bank_transfer'");
        # VIEW
         $data['payment_option']                         =    hash_to_option($payment_option, 'option_payment_method_id', 'option_payment_method_name');
        $data['dept_option']                            =    hash_to_option($dept_option, 'option_department_id', 'option_department_name');
        $parent->_view('request.tba', $data);

    }
    
    
    public function request_for_payment($parent)
    {   
       # DB
        $payment_option                                 =    mvc_model('model.option')->select_option('option_payment_method', "WHERE option_payment_method_id != 'bank_transfer'");
        $dept_option                                    =    mvc_model('model.option')->select_option('option_department', 'ORDER BY option_department_name ASC');
        
        # VIEW
        $data['payment_option']                         =    hash_to_option($payment_option, 'option_payment_method_id', 'option_payment_method_name');
        $data['dept_option']                            =    hash_to_option($dept_option, 'option_department_id', 'option_department_name');
        $parent->_view('request.rfp', $data);
    }
    
    
    public function ofv($parent)
    {   
        # DB
        $dept_option                                    =    mvc_model('model.option')->select_option('option_department', 'ORDER BY option_department_name ASC');
        $data                                           =    mvc_model('model.account_payable_ofv')->get_rows();
        
        # VIEW
        $data['dept_option']                            =    hash_to_option($dept_option, 'option_department_id', 'option_department_name');
        $parent->_view('request.ofv', $data);
    }
    
     public function tax($parent)
    {   
        # DB
        $data                                           =    mvc_model('model.account_payable_item_detail')->get_taxable_items();
        # VIEW
        $parent->_view('request.tax', $data);
    }
#----------------------- Form Actions

    public function submit_add_ticket($parent)
    {
        
        $req_type                                                   =  $_POST['payable']['str']['request_type_id'];
        $ofv_req													= ($req_type == 'ofv' ?  1 : 0);
        $ofv_req													= ($req_type == 'tax' ?  1 : $ofv_req);
       
		 $insert                                                    =  mvc_model('model.account_payable')->insert($_POST['payable'],$ofv_req);
	    if($req_type == 'rfp')
	    {
	         $insert_item                                           =  mvc_model('model.account_payable_item')->insert($_POST['ticket_item'],$insert['data']['data']['account_payable_id']);
	    }
	    if($req_type == 'ofv')
	    {
			 $insert_ofv_payable                                    =    mvc_model('model.ofv_request')->insert($_POST['ofv'],$insert['data']['data']['account_payable_id']);	    
			 $update_account_payable                                =    mvc_model('model.account_payable_ofv')->update_replenished($_POST['ofv']);	    
 		}
 		if($req_type == 'tax')
	    {
			 $insert_ofv_payable                                    =    mvc_model('model.tax_request')->insert($_POST['item_id'],$insert['data']['data']['account_payable_id']);	    
			 $update_account_payable                                =    mvc_model('model.account_payable_item_detail')->update_taxed($_POST['item_id']);	    
 		}
	    $post['int']['user_id']                                     = $parent->user['user_id']; 
	    $post['str']['request_approval_level_id']                   = $insert['data']['data']['request_approval_level_id']; 
	    $post['str']['request_approval_status_id']                  = $insert['data']['data']['request_approval_status_id']; 
	    $post['str']['request_type_id']                             = $req_type; 
	    $post['int']['account_payable_ticket_timestamp']            = $insert['data']['data']['account_payable_timestamp']; 
	    $post['int']['account_payable_id']                          = $insert['data']['data']['account_payable_id']; 
	    mvc_model('model.account_payable_ticket')->insert($post);
        header_location("/finance_disbursement/request");
    }
    
    
   
    
}