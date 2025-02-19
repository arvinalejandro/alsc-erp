<?php
class finance_cashier_collection
{
    
    public function __construct()
    {    	
       $this->controller_id = 'finance_cashier_collection';        
    }
    
    public function index($parent)
    {      	
    	# DB    	
    	$data['row.transaction']	=	mvc_model('model.account_receive')->get_row(0);
    	# VIEW - side nav 
       	          
        # VIEW       
        $parent->_view('transaction', $data); 
	}
     
    
    public function profile($parent)
    {      	
    	# DB
        $data                   =   mvc_model('model.client_account')->select($_GET['id']); 
        # VIEW - side nav
        $side_nav['profile.class']				=	'bold';         	
       	$side_nav['client_account_id']			=	$data['client_account_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.account', $side_nav);         	          
        # VIEW
        $parent->_view('account.profile', $data);        
    } 
        
    public function document($parent)
    {      	
    	# DB
    	$data                                  	=   mvc_model('model.client_account')->select($_GET['id']);
    	$data['row.letter']						=	mvc_model('model.account_letter')->get_row($_GET['id']);
    	# VIEW - side nav
        $side_nav['document.class']				=	'bold';         	
       	$side_nav['client_account_id']			=	$data['client_account_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.account', $side_nav);      
       	          
        # VIEW       
        $parent->_view('account.document', $data); 
	}
    
     public function remark($parent)
    {
    	# DB
        $data                               =   mvc_model('model.client_account')->select($_GET['id']); 
        $data['row.remark']					=	mvc_model('model.remark')->get_row('client_account', $_GET['id']);            
       
        # VIEW - side nav
        $side_nav['remark.class']				=	'bold';         	
       	$side_nav['client_account_id']			=	$data['client_account_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.account', $side_nav);             
        # VIEW
        $parent->_view('account.remark', $data);      
	} 
     
     
     
 
    

#----------------------- Form Pages	
	     
    
    
   public function letter($parent)
    {      	
    	# DB
        $data                       =    	mvc_model('model.client_account')->select($_GET['id']);
       	$data['due']				=		mvc_model('model.client_account_invoice')->get_row_invoice_due($_GET['id'], 1);      
        $data['recent']				=		mvc_model('model.client_account_invoice')->select_recent_due($_GET['id']);   
		$parent->letter($_GET['letter'], $data);      
    } 
    
    
    
#----------------------- Form Actions

	public function submit_remark($parent)
	{
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/finance_billing/account/remark/&id={$_POST['client_account_id']}");
	}
	
	

	
	
	
	
	
	
   
}