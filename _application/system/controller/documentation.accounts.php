<?php
class documentation_accounts
{
    
    public function __construct()
    {    	
       	$this->controller_id 			= 	'documentation_accounts';
    }
 
    public function index($parent)
    {          
        # DB
        $data['row.accounts']				     =	mvc_model('model.client_account')->select_accounts_row();
                             
        # VIEW
        $parent->_view('accounts', $data);        
    }
    
     public function profile($parent)
    {          
        $ca_id 								 	 =    $_GET['id'] * 1;
        # DB
         $data['profile.accounts']				 =	mvc_model('model.client_account')->get_account($ca_id);
        # VIEW - side nav
        $side_nav['ca_id']              	     =    $ca_id;
        $side_nav['profile.class']               =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.accounts', $side_nav);                       
        # VIEW
        $parent->_view('accounts.profile', $data);        
    }
    
    public function remarks($parent)
    {          
        $ca_id 								 	 =    $_GET['id'] * 1;
        # DB
     	$data['row.remark']              		 =    mvc_model('model.remark')->get_row('client_account', $ca_id);       
        # VIEW - side nav
        $side_nav['ca_id']              	     =    $ca_id;           
        $side_nav['remarks.class']               =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.accounts', $side_nav);                       
        # VIEW
        $parent->_view('accounts.remark', $data);        
    } 
    
     public function documents($parent)
    {          
        $ca_id 								 	 =    $_GET['id'] * 1;
        # DB
        $data['row.documents']              	 =    mvc_model('model.document_account')->select_all($ca_id);
        
        # VIEW - side nav
        $side_nav['ca_id']              	     =    $ca_id;           
        $side_nav['documents.class']             =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.accounts', $side_nav);                       
        # VIEW
        $parent->_view('accounts.documents', $data);        
    }
    
      public function document_status($parent)
    {          
        $ca_id 								 	 =    $_GET['id'] * 1;
        $doc_id 								 =    $_GET['d_id'] * 1;
        # DB
        $data 									 =    mvc_model('model.document_account')->select_document($doc_id);
        # VIEW - side nav
        $side_nav['ca_id']              	     =    $ca_id;           
        $side_nav['documents.class']             =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.accounts', $side_nav);                  
        # VIEW
        $parent->_view('accounts.document_edit', $data);        
    }
#----------------------- Form Actions

     public function submit_remark($parent)
    {
        $id                                             =    $_POST['client_account_id'];
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $id;
        mvc_model('model.remark')->insert($remark);                    
        header_location("/documentation/accounts/remarks/&id={$id}");
    }
    
     public function submit_update($parent)
    {
       
        mvc_model('model.document_account')->update($_POST);                    
        header_location("/documentation/accounts/documents/&id={$_POST['int']['client_account_id']}");
    }
    
    
}
