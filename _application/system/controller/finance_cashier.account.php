<?php
class finance_cashier_account
{
    
    public function __construct()
    {    	
       $this->controller_id = 'finance_cashier_account';        
    }
    
    public function index($parent)
    {           
        # DB    	
       	$data['row.account']	=	mvc_model('model.client_account')->get_cashier_row();        
        # VIEW
        $parent->_view('account', $data);
    } 
     
    
    public function profile($parent)
    {      	
    	# DB
        $data                   				=   mvc_model('model.client_account')->select($_GET['id']); 
        #hash_dump($data, 1);
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
	
	public function transaction($parent)
    {      	
    	# DB
    	$data                                  	=   mvc_model('model.client_account')->select($_GET['id']);
    	$data['row.account.transaction']		=	mvc_model('model.account_receive')->get_cashier_account_row($_GET['id']);
    	# VIEW - side nav
        $side_nav['transaction.class']				=	'bold';         	
       	$side_nav['client_account_id']			=	$data['client_account_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.account', $side_nav);      
       	          
        # VIEW       
        $parent->_view('account.transaction', $data); 
	}
    
    public function remark($parent)
    {
    	# DB
        $data                                  	=   mvc_model('model.client_account')->select($_GET['id']);
        $data['row.remark']						=	mvc_model('model.remark')->get_row('client_account', $_GET['id']);            
       
        # VIEW - side nav
        $side_nav['remark.class']				=	'bold';         	
       	$side_nav['client_account_id']			=	$data['client_account_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.account', $side_nav);        
        # VIEW
        $parent->_view('account.remark', $data);      
	} 
     
     
    
 
    

#----------------------- Form Pages	
	     
    
    public function payment_recurring($parent)
    {    	
    	# DB
		  
        $data                   				=   mvc_model('model.client_account')->select($_GET['id']); 
        $data['summary']						=	mvc_model('model.client_account_invoice')->select_cashier_summary($_GET['id']);
        $data['row.account.invoice']			=   mvc_model('model.client_account_invoice')->get_cashier_row($_GET['id']); 
        $data['progress']						=	mvc_model('model.client_account_invoice')->select_payment_progress($_GET['id']); 
        $data['sysglobal']						=	$parent->sysglobal;    
        $option_payment_method					=	mvc_model('model.option')->select_option('option_payment_method');       	       	     	
        $option_payment_receipt					=	mvc_model('model.option')->select_option('option_payment_receipt', "where option_payment_receipt_id IN ('or', 'cr')");                    	       	     	
        $option_payment_excess					=	mvc_model('model.option')->select_option('option_payment_excess', "where option_payment_excess_id IN ('return_change')");                    	       	     	
               	       	     	
        # VIEW - db options       	
       	$data['option_payment_method']			=	hash_to_option($option_payment_method, 'option_payment_method_id', 'option_payment_method_name', 'cash');
       	$data['option_payment_receipt']			=	hash_to_option($option_payment_receipt, 'option_payment_receipt_id', 'option_payment_receipt_name', 'or');
       	$data['option_payment_excess']			=	hash_to_option($option_payment_excess, 'option_payment_excess_id', 'option_payment_excess_name', 'return_change');
       	
        # VIEW - side nav
        $side_nav['profile.class']				=	'bold';         	
       	$side_nav['client_account_id']			=	$data['client_account_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.account', $side_nav);         	          
         
        #hash_dump($data['sysglobal'], 1); 
         
        # VIEW
        $parent->_view('account.form.recurring', $data);        
	}   
	
	public function condonation($parent)
    {
    	$data                   				=   mvc_model('model.client_account')->select($_GET['id']); 
        $data['row.account.invoice']			=   mvc_model('model.client_account_invoice')->get_cashier_row($_GET['id']); 
        	
       
        # VIEW - side nav
        $side_nav['condonation.class']			=	'bold';         	
       	$side_nav['client_account_id']			=	$data['client_account_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.account', $side_nav);         	          
       
        # VIEW
        $parent->_view('account.form.condonation', $data);        
	}
	
	public function payment_other($parent)
    {
    	$data                   				=   mvc_model('model.client_account')->select($_GET['id']); 
        $data['sysglobal']						=	$parent->sysglobal;    
        
        $option_payment_method					=	mvc_model('model.option')->select_option('option_payment_method');       	       	     	
        $option_payment_receipt					=	mvc_model('model.option')->select_option('option_payment_receipt');                    	       	     	
        $option_account_invoice_type			=	mvc_model('model.option')->select_option('option_account_invoice_type', "WHERE option_account_invoice_type_key = 'other'");                    	       	     	
              	     	
               	       	     	
        # VIEW - db options
       
       	$data['option_payment_method']			=	hash_to_option($option_payment_method, 'option_payment_method_id', 'option_payment_method_name', 'cash');
       	$data['option_payment_receipt']			=	hash_to_option($option_payment_receipt, 'option_payment_receipt_id', 'option_payment_receipt_name', 'or');
       	$data['option_account_invoice_type']	=	hash_to_option($option_account_invoice_type, 'option_account_invoice_type_id', 'option_account_invoice_type_name');
       	
       
        # VIEW - side nav
        $side_nav['profile.class']				=	'bold';         	
       	$side_nav['client_account_id']			=	$data['client_account_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.account', $side_nav);         	          
       
     	# VIEW
        $parent->_view('account.form.other', $data);        
	}
    
    
    
    
#----------------------- Form Actions 

	public function submit_payment($parent)
	{		
		# Select Account
		$account				=	mvc_model('model.client_account')->select($_POST['client_account_id']);
				
		# Excess Amount
		$excess_type			=	$_POST['account_receive']['int']['option_payment_excess_id'];		
		$excess_amount			=	$_POST['excess'];		
		# Insert Receipt		
		$account_receive		=	mvc_model('model.account_receive')->insert($_POST['account_receive']);
		$payment_method			=	$account_receive['option_payment_method_id'];
		# xtrigger
		
		if($payment_method == 'bank_transfer')
		{
			# xtrigger
			# jv to bank
			$insert_collection  =   mvc_model('model.bank_transaction')->insert_collections($account_receive['account_receive_amount_gross'],$account_receive['account_receive_id'],1);
		}
		else
		{ 
			# xtrigger
			# jv to collection
			$insert_collection  =   mvc_model('model.bank_transaction')->insert_collections($account_receive['account_receive_amount_gross'],$account_receive['account_receive_id']);
		}
		
		# Select account_invoice to be paid
		$invoice_payment		=	mvc_model('model.client_account_invoice')->select_invoice_payment($_POST['client_account_invoice_id']);
         #string_trail($_POST['client_account_invoice_id']);
		 #string_trail($invoice_payment);
        # Insert received invoice per account_invoice to be paid
        $vat_base		=	$this->_get_vat_base($parent);
		mvc_model('model.account_receive_invoice')->insert($account_receive, $invoice_payment, $account['client_account_is_vat'], $vat_base);
		#hash_dump($_POST, 1);
		
		if($excess_type == 'credit_to_principal')
		{
			if($excess_amount > 0)
			{				
				$next_invoice					=	mvc_model('model.client_account_invoice')->select_next_due($_POST['client_account_id']);		
				$sum_remaining					=	mvc_model('model.client_account_invoice')->select_sum_principal($_POST['client_account_id']);							
				mvc_model('model.client_account_invoice')->delete_due($_POST['client_account_id']);			
				$invoice	=	mvc_model('model.client_account_invoice')->insert_credit_principal($account, $next_invoice, $excess_amount, $sum_remaining['amount'] - $sum_remaining['paid']);				
				mvc_model('model.client_account_invoice')->restructure_credit_to_principal($account, $sum_remaining, $excess_amount, $next_invoice);		
				mvc_model('model.account_receive_invoice')->insert_cp_invoice($account_receive, $invoice);
			}			
		}
		
		# Update Account
		
		$progress			=	mvc_model('model.client_account_invoice')->select_payment_progress($_POST['client_account_id']);
		//hash_dump($progress,1);
		//$insert_commission  =   mvc_model('model.client_account_agent')->set_scheme($account, $progress);
		$insert_commission  =   mvc_model('model.client_account_agent')->trigger_commission($account, $progress,$parent->user['user_id']);
		header_location("/finance_cashier/account/payment_recurring/&id={$account_receive['client_account_id']}");
		
		
	}
	
		
	public function submit_payment_other($parent)
	{			
		$client_account				=	mvc_model('model.client_account')->select($_POST['client_account_id']);		
		$account_receive			=	mvc_model('model.account_receive')->insert($_POST['account_receive']);
		$client_account_invoice		=	mvc_model('model.client_account_invoice')->insert_other_payment($client_account, $account_receive, $_POST['option_account_invoice_type_id']);
		# Insert Receipt Breakdown	
		$vat_base					=	$this->_get_vat_base($parent);
		$account_receive			=	mvc_model('model.account_receive_invoice')->insert_other($account_receive, $client_account_invoice, $vat_base);
									
		hash_dump($_POST, 1);		
		header_location("/finance_cashier/account/payment_other/&id={$account_receive['client_account_id']}");
	}
	
	
	
	public function submit_remark($parent)
	{
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/finance_cashier/account/remark/&id={$_POST['client_account_id']}");
	}
	
	
	private function _get_vat_base($parent)
	{
		$vat_rate		=	$parent->sysglobal['vat_rate'];
		$vat_base		=	($vat_rate / 100) / (($vat_rate/100) + 1);
		$vat_base		=	round($vat_base, 5);
		
		return $vat_base;
	}
	
	

	
	 
	
	
	
	
   
}