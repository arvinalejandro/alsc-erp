<?php
class treasury_cheque_status
{
    
     public function __construct()
    {        
       $this->controller_id = 'treasury_cheque_status';             
    }
    
    public function index($parent)
    {   
        # DB 
		$data['row.cheq']                           		  =    mvc_model('model.account_payable_cheque')->get_cheque_status_row();
        # VIEW
        $parent->_view('cheque_status', $data);
    }
    
     public function profile($parent)
    {          
        # DB
        $id                                                   =    $_GET['id'];
        $data												  =    mvc_model('model.account_payable_cheque')->select_cheque($id);
        $data['account_payable']							  =    mvc_model('model.account_payable')->get_row($data['account_payable_id']);
       // hash_dump($data,1);
        # VIEW - side nav
        $side_nav['t_id']                                     =    $id;
        $side_nav['profile.class']                            =    'bold';
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.cheque_status', $side_nav);
        # VIEW
        $status_form                                    	  =    view_get_template($parent->controller_id.'/template/form.status', $side_nav);
        $data['row.status_form']							  =    ($data['is_encashed'] == 0 ? $status_form : 'Encashed ' . string_date($data['encashed_date']));
        $data['status_class']							      =    ($data['is_encashed'] == 0 ? '' : 'display_none');
        $parent->_view('cheque_status.profile', $data);        
    }
    
    
    public function remarks($parent)
    {          
         # DB
        $id                                                   =    $_GET['id'];
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row('account_payable_cheque', $id);
        $data['account_payable_cheque_id']                    =    $id;
        $data['remark.form.link']                             =    '/treasury/cheque_status/submit_remark';
        # VIEW - side nav
        $side_nav['t_id']                                     =    $id;
        $side_nav['remarks.class']                            =    'bold';             
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.cheque_status', $side_nav);                       
        # VIEW
        $parent->_view('cheque_status.remarks', $data);        
    }
#----------------------- Form Actions    
    
    public function submit_remark($parent)
    {
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $_POST['account_payable_cheque_id'];
      // hash_dump($remark,true);
        mvc_model('model.remark')->insert($remark);                    
        header_location("/treasury/cheque_status/remarks/&id={$_POST['account_payable_cheque_id']}");
    } 
    
     public function submit_update_cheque($parent)
    {
        #update account_payable_cheque
        $update_cheque                                              =  mvc_model('model.account_payable_cheque')->update_chq_status($_POST['account_payable_cheque']);
        $update_transaction                                         =  mvc_model('model.bank_transaction')->update_status($_POST['transaction_id']);
        $transaction_data											=  mvc_model('model.bank_transaction')->get_transaction($_POST['account_payable_id']);
       // hash_dump($transaction_data,true);
        if($transaction_data)
        {
			$update_transaction                                     =  mvc_model('model.bank_transaction')->update_status($transaction_data['bank_transaction_id']);
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
        #remark
        $remark                                                 	=  $_POST['remark'];
        $remark['int']['user_id']                               	=  $parent->user['user_id'];
        $remark['int']['remark_key_id']                         	=  $_POST['account_payable_cheque']['account_payable_cheque_id'];
        mvc_model('model.remark')->insert($remark); 
         
        header_location("/treasury/cheque_status/");
    }     
}