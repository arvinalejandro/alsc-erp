<?php
class finance_cashier_transaction
{
    
    public function __construct()
    {    	
       $this->controller_id = 'finance_cashier_transaction';        
    }
    
   	
	public function index($parent)
    {      	
    	# DB    	
    	$data['row.transaction']	=	mvc_model('model.account_receive')->get_cashier_transaction_row();
    	# VIEW - side nav 
       	          
        # VIEW       
        $parent->_view('transaction', $data); 
	}
	
	
      
    public function invoice($parent)
    {      	
    	# DB
        $data                   				=   mvc_model('model.account_receive')->select($_GET['id']); 
        $data['row.invoice']                   	=   mvc_model('model.account_receive_invoice')->get_transaction_invoice($_GET['id']); 
		# VIEW - side nav
        $side_nav['invoice.class']				=	'bold';         	
       	$side_nav['account_receive_id']			=	$data['account_receive_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.transaction', $side_nav);         	          
        # VIEW
        $parent->_view('transaction.invoice', $data);        
    } 
	
    
    public function remark($parent)
    {
    	# DB
        $data                   				=   mvc_model('model.account_receive')->select($_GET['id']); 
        $data['row.remark']					=	mvc_model('model.remark')->get_row('account_receive', $_GET['id']);            
       
        # VIEW - side nav
        $side_nav['remark.class']				=	'bold';         	
       	$side_nav['account_receive_id']			=	$data['account_receive_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.transaction', $side_nav);             
        # VIEW
        $parent->_view('transaction.remark', $data);      
	}    
    
    public function profile($parent)
    {      	
    	# DB
        $data                   				=   mvc_model('model.account_receive')->select($_GET['id']); 
		
		# VIEW - side nav
        $side_nav['profile.class']				=	'bold';         	
       	$side_nav['account_receive_id']			=	$data['account_receive_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.transaction', $side_nav);         	          
        # VIEW
        $parent->_view('transaction.profile', $data);        
    } 

#----------------------- Form Pages	
	     
    
        
    
    
#----------------------- Form Actions

	public function submit_payment($parent)
	{
		$data	=	mvc_model('model.account_receive')->insert($_POST['account_receive']);
					mvc_model('model.account_receive')->insert_invoice($data['data']['account_receive_id'], $_POST['client_account_invoice_id']);
					mvc_model('model.client_account_invoice')->update_status($_POST['client_account_id'], $_POST['client_account_invoice_id'], 1);
					
		header_location("/finance_cashier/account/transaction/&id={$data['data']['client_account_id']}");
	}
	
	public function submit_remark($parent)
	{
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/finance_cashier/transaction/remark/&id={$_POST['account_receive_id']}");
	}
	
	

	
	
	
	
	
	
   
}