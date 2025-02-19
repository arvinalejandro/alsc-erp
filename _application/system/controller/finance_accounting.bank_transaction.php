<?php
class finance_accounting_bank_transaction
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'bank_transaction';
       	$this->user						=	mvc_model('model.user')->select($_SESSION['user_id']);     
         	
    }

    public function index($parent)
    {          
        # DB
        $data['row.bank']                                      =    mvc_model('model.bank')->get_rows();
        # VIEW
        $parent->_view('bank_transaction', $data);        
    }
    
     public function profile($parent)
    {          
        # DB
        $id                                                    =    $_GET['id']*1; 
        $data                                                  =    mvc_model('model.bank')->select_bank($id);
        $data['bank_balance']                             	   =    mvc_model('model.accounting_receive')->select_bank_balance($id);
        $data['transaction.row']                               =    mvc_model('model.bank_transaction')->select_transaction_by_bank($id);
        # VIEW - side nav
        $side_nav['profile.class']                             =    'bold';
        $side_nav['b_id']                                      =    $id;
        $data['side_nav']                                      =    view_get_template($parent->controller_id.'/template/side.bank_transaction', $side_nav);                 
        # VIEW
        $parent->_view('bank_transaction.profile', $data);        
    }
    
    public function transaction_profile($parent)
    {          
        # DB
        $id                                                    =    $_GET['id']*1; 
        $transaction_id                                        =    $_GET['t_id']*1; 
        $data                                                  =    mvc_model('model.bank')->select_bank($id);
        $data['profile.row']                                   =    mvc_model('model.bank_transaction')->select_transaction($transaction_id,$data);
        $data['row.remark']                                    =    mvc_model('model.remark')->get_row('bank_transaction', $transaction_id);
        $data['bank_id']                                   	   =    $id;
        $data['bank_transaction_id']                           =    $transaction_id;
        # VIEW - side nav
        $side_nav['profile.class']                             =    'bold';
        $side_nav['b_id']                                      =    $id;
        $data['side_nav']                                      =    view_get_template($parent->controller_id.'/template/side.bank_transaction', $side_nav);                 
        # VIEW
        $parent->_view('bank_transaction_profile.remarks', $data);        
    }
    
    public function jv_adjustment($parent)
    {          
        # DB
        $id                                                    =    $_GET['id']*1; 
        $data                                                  =    mvc_model('model.bank')->select_bank($id);
        $data['bank_balance']                             	   =    mvc_model('model.accounting_receive')->select_bank_balance($id);
        $cashflow_option                                       =    mvc_model('model.option')->select_option('option_bank_transaction_type');
        $source_option                                         =    mvc_model('model.option')->select_option('option_bank_transaction_category', " WHERE option_bank_transaction_type_id = 'in' AND option_bank_transaction_category_type_id = 'jv'");
        $data['cashflow.opt']								   =    hash_to_option($cashflow_option, 'option_bank_transaction_type_id', 'option_bank_transaction_type_name');
        $data['source.opt']								       =    hash_to_option($source_option, 'option_bank_transaction_category_id', 'option_bank_transaction_category_name');
        # VIEW - side nav 
        $side_nav['jv_adjustment.class']                       =    'bold';
        $side_nav['b_id']                                      =    $id;
        $data['side_nav']                                      =    view_get_template($parent->controller_id.'/template/side.bank_transaction', $side_nav);                 
        # VIEW
        $parent->_view('bank_transaction.adjustment', $data);        
    }
    
    public function deposit($parent)
    {          
        # DB
        $id                                                    =    $_GET['id']*1; 
        $data                                                  =    mvc_model('model.bank')->select_bank($id);
        $data['bank_balance']                             	   =    mvc_model('model.accounting_receive')->select_bank_balance($id);
        $source_option                                         =    mvc_model('model.option')->select_option('option_bank_transaction_category', " WHERE option_bank_transaction_type_id = 'in' AND option_bank_transaction_category_type_id = 'bt'");
        $data['source.opt']								       =    hash_to_option($source_option, 'option_bank_transaction_category_id', 'option_bank_transaction_category_name');
        # VIEW - side nav
        $side_nav['deposit.class']                             =    'bold';
        $side_nav['b_id']                                      =    $id;
        $data['side_nav']                                      =    view_get_template($parent->controller_id.'/template/side.bank_transaction', $side_nav);                 
        # VIEW
        $parent->_view('bank_transaction.deposit', $data);        
    }
    
    public function transfer($parent)
    {          
        # DB
        $id                                                    =    $_GET['id']*1; 
        $data                                                  =    mvc_model('model.bank')->select_bank($id);
        $data['bank_balance']                             	   =    mvc_model('model.accounting_receive')->select_bank_balance($id);
        $bank_opt	     									   =    mvc_model('model.bank')->select_all(" WHERE bank_id != {$id}");
        $data['bank.opt']	                                   =    hash_to_option($bank_opt, 'bank_id', 'bank_name');
        # VIEW - side nav
        $side_nav['transfer.class']                            =    'bold';
        $side_nav['b_id']                                      =    $id;
        $data['side_nav']                                      =    view_get_template($parent->controller_id.'/template/side.bank_transaction', $side_nav);                 
        # VIEW
        $parent->_view('bank_transaction.transfer', $data);        
    }
    
    public function remarks($parent)
    {          
        # DB
        $id                                                   =    $_GET['id']*1;
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row('bank', $id);
        $data['bank_id']                                      =    $id;
        # VIEW - side nav
        $side_nav['b_id']                                     =    $id;    
        $side_nav['remarks.class']                            =    'bold';
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.bank_transaction', $side_nav);                    
        # VIEW
        $parent->_view('bank_transaction.remarks', $data);        
    } 
    
//===============Form Operations==================================    

     public function submit_deposit($parent)
    {
	    $insert                                                    =  mvc_model('model.bank_transaction')->insert($_POST['trans']);
        header_location("/finance_accounting/bank_transaction/profile/&id=".$_POST['trans']['int']['bank_id']);
    }
    
    public function submit_jv_adjustment($parent)
    {
	        $insert                                 	=  mvc_model('model.bank_transaction')->insert($_POST['trans']);
	        $_POST['payable']['int']['request_amount']  =  $_POST['trans']['int']['bank_transaction_amount'];
	        $_POST['payable']['int']['request_amount']  =  $_POST['trans']['int']['request_approved_amount'];
			$insert_payable                         	=  mvc_model('model.account_payable')->insert_jv($_POST['payable']);
			$post['bank_transaction_id']				=  $insert['data']['data']['bank_transaction_id'];	
			$post['jv_type_id']							=  $_POST['bank_jv']['str']['jv_type_id'];
			$insert_bank_jv                         	=  mvc_model('model.bank_jv')->insert($post);
			$insert_items   							=  mvc_model('model.account_payable_item')->jv_insert($_POST['ticket_item'],$insert_payable['data']['data']['account_payable_id'],$_POST['detail'],$_POST['particulars'],$post['bank_transaction_id']);
        header_location("/finance_accounting/bank_transaction/profile/&id=".$_POST['trans']['int']['bank_id']);
    }
    
     public function submit_transfer($parent)
    {
	    $insert                                                    =  mvc_model('model.bank_transaction')->insert_transfer($_POST['trans']);
        header_location("/finance_accounting/bank_transaction/profile/&id=".$_POST['trans']['int']['bank_id']);
    }
    
    public function submit_remark($parent)
    {
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $_POST['bank_id'];
      // hash_dump($remark,true);
        mvc_model('model.remark')->insert($remark);                    
        header_location("/finance_accounting/bank_transaction/remarks/&id={$_POST['bank_id']}");
    }
    
    public function submit_transaction_remark($parent)
    {
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $_POST['bank_transaction_id'];
      // hash_dump($remark,true);
        mvc_model('model.remark')->insert($remark);                    
        header_location("/finance_accounting/bank_transaction/transaction_profile/&id={$_POST['bank_id']}&t_id={$_POST['bank_transaction_id']}");
    }   
//=====================AJAX=======================================
 public function get_source($parent)
    {
       if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
        {
            $condition					    	 =  " AND option_bank_transaction_category_type_id = 'jv'";
            $source_option                       =    mvc_model('model.option')->select_option('option_bank_transaction_category', " WHERE option_bank_transaction_type_id = '{$_POST['option_bank_transaction_type_id']}' {$condition}");
            $data                      			 =    hash_to_option($source_option, 'option_bank_transaction_category_id', 'option_bank_transaction_category_name');
            echo $data; exit();
        }
        else
        {
            echo '';
        }
    }  
    
    public function get_jv_type($parent)
    {
       if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
        {
            $source_option                       =    mvc_model('model.option')->select_option('jv_type');
            $data                      			 =    hash_to_option($source_option, 'jv_type_id', 'jv_type_name');
            echo $data; exit();
        }
        else
        {
            echo '';
        }
    } 
    
    public function get_balance($parent)
    {
       if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
        {
           
            $data                		=    mvc_model('model.accounting_receive')->select_bank_balance($_POST['bank_id']);
            
           
            echo string_amount($data['bank_balance']); exit();
        }
        else
        {
            echo '';
        }
    }   
    
}