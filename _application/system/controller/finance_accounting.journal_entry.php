<?php
class finance_accounting_journal_entry
{
    
     public function __construct()
    {        
       $this->controller_id = 'finance_accounting_journal_entry';             
    }
    
    public function index($parent)
    {   
        # DB 
        $data['row.ticket']                                   =    mvc_model('model.account_payable')->select_all_ticket('journal_entry',0,'finance_accounting');
        # VIEW
        $parent->_view('pending_journal_entry', $data);
    }
    
     public function profile($parent)
    {          
        # DB
        $id                                                   =    $_GET['id']*1; 
        $data                                                 =    mvc_model('model.account_payable')->get_row($id);
        $item_row                                             =    '';
        if($data['request_type_id'] == 'rfp')
        {
            $fname       =    'journal_entry.profile_rfp';
            $item_row    =    mvc_model('model.account_payable_item')->get_journal_entry_row($id);
             $data['tba_class']  = '';
            //hash_dump($item_row,true);
        }
        else
        {
            $fname       =    'journal_entry.profile_tba';
             $data['tba_class']  = 'display_none';
        }
        
       $data['profile.ticket']                                =    mvc_model('model.account_payable')->select_ticket($fname,$id,$data['request_approval_level_id'],$data['request_approval_status_id'],'','finance_accounting');
        $data['item.ticket']                                  =   $item_row;
        # VIEW - side nav
        $side_nav['t_id']                                     =    $id;
        $side_nav['profile.class']                            =    'bold';
        $data['status_view']                                  =    ($data['request_approval_status_id'] == 'declined' ? 'display_none' : '');
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.pending_journal_entry', $side_nav);       
        # VIEW
        $parent->_view('pending_journal_entry.profile', $data);        
    }
     
     public function remarks($parent)
    {    
    	# DB
        $id                                                   =    $_GET['id']*1;
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row('account_payable', $id);
        $data['account_payable_id']                           =    $id;
        # VIEW - side nav
        $side_nav['t_id']                                     =    $id;
        $side_nav['remarks.class']                            =    'bold';            
        $data['side_nav']                        			  =    view_get_template($parent->controller_id.'/template/side.pending_journal_entry', $side_nav);                       
        # VIEW
        $parent->_view('pending_journal_entry.remarks', $data);        
    }
#----------------------- Form Actions    
     
     public function submit_update_ticket($parent)
    {          
        $_POST['payable']['str']['request_approval_level_id']       = ($_POST['payable']['str']['request_approval_status_id'] == 'approved' ? 'cheque_prep' : 'journal_entry');
        $_POST['payable']['int']['user_id']                         =  $parent->user['user_id']; 
      
        #insert ticket
        mvc_model('model.account_payable_ticket')->insert($_POST['payable']);
        
        #insert journal entry
        mvc_model('model.account_payable_item_detail')->insert($_POST['detail'],$_POST['payable']['int']['account_payable_id'],$_POST['particulars']);

        
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
        header_location("/finance_accounting/journal_entry");
    }
    
    
    public function submit_remark($parent)
    {
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $_POST['account_payable_id'];
      // hash_dump($remark,true);
        mvc_model('model.remark')->insert($remark);                    
        header_location("/finance_accounting/journal_entry/remarks/&id={$_POST['account_payable_id']}");
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
            $data                                =   mvc_model('model.account_payable_item_detail')->get_row($_POST,$parent_option,$project_option);
           
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