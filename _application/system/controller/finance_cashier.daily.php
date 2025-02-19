<?php
class finance_cashier_daily
{
    

    
    public function __construct()
    {    	
       $this->controller_id = 'finance_cashier_daily';        
    }
    
   	
	public function index($parent)
    {      	
    	# DB    	
    	#$data['row.transaction']				=	mvc_model('model.account_receive')->get_cashier_row($_GET['id']);
    	           	          
        # VIEW       
        $parent->_view('daily', $data); 
	}
	
    
   
#----------------------- Form Pages	 
     
     
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
		header_location("/finance_billing/account/remark/&id={$_POST['client_account_id']}");
	}
	
	

	
	
	
	
	
	
   
}