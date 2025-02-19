<?php
class finance_disbursement_liquidate
{
    public function __construct()
    {        
       $this->controller_id = 'finance_disbursement_liquidate';             
    }

    
    public function index($parent)
    {   
        # DB 
        $data['row.ticket']                                   =    mvc_model('model.account_payable')->select_all_ticket('liquidate',0);
        # VIEW
        $parent->_view('liquidate', $data);
    }
    
     public function profile($parent)
    {          
        # DB
        $id                                                   =    $_GET['id']*1; 
        $data                                                 =    mvc_model('model.account_payable')->get_row($id);
        $item_row                                             =    '';
        ($data['option_payment_method_id'] == 'cash' ? $data['chq_payment_class'] = 'display_none' : $data['cash_payment_class'] = 'display_none');
        if($data['request_type_id'] == 'tba')
        {
            $fname       =    'liquidate.profile';
        }
        else
        {
            header_location("/finance_disbursement/liquidate");
        }
       
        $data['profile.ticket']                               =    mvc_model('model.account_payable')->select_ticket($fname,$id,$data['request_approval_level_id'],$data['request_approval_status_id'],$item_row);
        $data['row.account_cheque']                           =    mvc_model('model.account_payable_cheque')->get_exec_row($id);
        $data['row.ofv_account_payable']                      =    mvc_model('model.account_payable_ofv')->get_rows_by_account_payable($id);
        # VIEW - side nav
        $side_nav['t_id']                                     =    $id;
        $side_nav['profile.class']                            =    'bold';
        $data['status_view']                                  =    ($data['request_approval_status_id'] == 'declined' ? 'display_none' : '');
        $data['side_nav']                       			  =    view_get_template($parent->controller_id.'/template/side.liquidate', $side_nav);                       
        # VIEW
        $parent->_view('liquidate.profile', $data);        
    }
    
    public function remarks($parent)
    {          
        # DB
        $id                                                   =    $_GET['id'];
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row('account_payable', $id);
        $data['account_payable_id']                           =    $id;
        $data['remark.form.link']                             =    '/finance_disbursement/liquidate/submit_remark';
        # VIEW - side nav
        $side_nav['t_id']                                     =    $id;
        $side_nav['remarks.class']                            =    'bold';             
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.liquidate', $side_nav);                       
        # VIEW
        $parent->_view('remarks', $data);        
    }
#----------------------- Form Actions 

	 public function submit_update_ticket($parent)
    {
        $_POST['payable']['str']['request_approval_level_id']       = ($_POST['payable']['str']['request_approval_status_id'] == 'approved' ? 'completed' : 'liquidate');
        $_POST['payable']['int']['user_id']                         =  $parent->user['user_id']; 
       //hash_dump($_POST);
        #item insert
        if($_POST['reimburse_amount'] > 0)
        {
			$_POST['payable']['str']['request_approval_level_id']   = ($_POST['payable']['str']['request_approval_status_id'] == 'approved' ? 'cheque_prep' : 'liquidate');
			$up_post['int']['is_reimbursement']						= 1;   
			$up_post['int']['reimbursement_amount']					= $_POST['reimburse_amount'];   
			$_POST['payable']['str']['request_approval_status_id'] =  'reimbursement';
        }
       
        $item_row   												=  mvc_model('model.account_payable_item')->liquidate_insert($_POST['ticket_item'],$_POST['payable']['int']['account_payable_id'],$_POST['detail'],$_POST['particulars']);
        
        #insert ticket
        mvc_model('model.account_payable_ticket')->insert($_POST['payable']);
        
        #update account_payable
        $up_post['str']['request_approval_level_id']                =  $_POST['payable']['str']['request_approval_level_id'];
        $up_post['str']['request_approval_status_id']               =  $_POST['payable']['str']['request_approval_status_id'];
        $up_post['str']['is_liquidated']               				=  1;
        $update_ticket                                              =  mvc_model('model.account_payable')->update($up_post,$_POST['payable']['int']['account_payable_id']);
        
        #remark
        $remark                                                 =  $_POST['remark'];
        $remark['int']['user_id']                               =  $parent->user['user_id'];
        $remark['int']['remark_key_id']                         =  $_POST['payable']['int']['account_payable_id'];
        mvc_model('model.remark')->insert($remark); 
        header_location("/finance_disbursement/liquidate");
    }   
       
    public function submit_remark($parent)
    {
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $_POST['account_payable_id'];
      // hash_dump($remark,true);
        mvc_model('model.remark')->insert($remark);                    
        header_location("/finance_disbursement/liquidate/remarks/&id={$_POST['account_payable_id']}");
    }
    
#---------------------------------Ajax		 
	
    public function get_detail_form($parent)
    {
       if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
        {
            $parent_option                       =    mvc_model('model.option')->select_option('option_account_chart_parent');
            $project_option                      =    mvc_model('model.option')->select_option('project');
            $parent_option                       =    hash_to_option($parent_option, 'option_account_chart_parent_id', 'option_account_chart_parent_name');
            $project_option                      =    hash_to_option($project_option, 'project_id', 'project_acronym');
            $data                                =   mvc_model('model.account_payable_item_detail')->get_row($_POST,$parent_option,$project_option,1);
           
            echo $data; exit();
        }
        else
        {
            echo '';
        }
    }
    
    
    public function get_child($parent)
    {
       if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
        {
            $child_option                        =    mvc_model('model.option')->select_option('option_account_chart_child', " WHERE option_account_chart_parent_id = '{$_POST['parent_id']}'");
            $data                      			 =    hash_to_option($child_option, 'option_account_chart_child_id', 'option_account_chart_child_name');
           
            echo $data; exit();
        }
        else
        {
            echo '';
        }
    }
    
    
    public function get_project_site($parent)
    {
       if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
        {
            $project_option                      =    mvc_model('model.option')->select_option('project_site', " WHERE project_id = '{$_POST['project_id']}'");
            $data                      			 =    hash_to_option($project_option, 'project_site_id', 'project_site_name');
           
            echo $data; exit();
        }
        else
        {
            echo '';
        }
    }    
   
     
}