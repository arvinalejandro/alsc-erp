<?php
class finance_wes_transaction_history
{
    
    public function __construct()
    {    	
       	$this->controller_id 			= 	'finance_wes_transaction_history';
    }
 
  	 public function index($parent)
    {           
        # DB    	
    	$data['row.transaction']	=	mvc_model('model.lot_wes_account_receive')->get_cashier_transaction_row();
    	# VIEW - side nav 
       	          
        # VIEW       
        $parent->_view('transaction_history', $data);
    }
    
    public function profile($parent)
    {      	
    	$id													=   $_GET['id']*1;
    	# DB
        $data                   							=   mvc_model('model.lot_wes_account_receive')->select($id); 
       	if($data)
       	{
			 	$data['user_']    		 					=  $data['user_name'] .' '. $data['user_surname'] ;
                $data['receive_date']    					=  string_date($data['lot_wes_account_receive_timestamp']);
                $data['amount_receive']    					=  'P '.string_amount($data['lot_wes_account_receive_amount_gross']);
       	}
       	else
       	{
				$data['user_']    		 					=  'N/A';
                $data['receive_date']    					=  'N/A';
                $data['amount_receive']    					=  'N/A';
                $data['lot_wes_account_receive_receipt']    =  'N/A';
                $data['lot_wes_account_receive_payee']    	=  'N/A';
                $data['option_payment_receipt_name']    	=  'N/A';
                $data['option_payment_method_name']    		=  'N/A';
                $data['option_payment_status_name']    		=  'N/A';
       	}
		
		# VIEW - side nav
        $side_nav['profile.class']				=	'bold';         	
       	$side_nav['account_receive_id']			=	$data['account_receive_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.transaction_history', $side_nav);         	          
        # VIEW
        $parent->_view('transaction_history.profile', $data);        
    } 
    
  
    
    public function remark($parent)
    {
    	$id											=   $_GET['id']*1;
    	# DB
        //$data['row.remark']						=	mvc_model('model.remark')->get_row('wes_account', $_GET['id']);            
        # VIEW - side nav
        $side_nav['remark.class']					=	'bold';         	
      	$side_nav['lot_wes_id']						=	$id;          	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.transaction_history', $side_nav);           
        # VIEW
        $parent->_view('transaction_history.remark', $data);      
	}
 
    
}