<?php
class finance_cashier_reservation
{
    
    public function __construct()
    {    	
       $this->controller_id = 'finance_cashier_reservation';
       
    }
     
    public function index($parent)
    {           
        # DB
       	$data['row.lot']	=	mvc_model('model.lot')->get_reservation_row();        
        # VIEW
        $parent->_view('reservation', $data);
    } 
        
     
    public function profile($parent)
    {      	
    	# DB
        $data									=	mvc_model('model.lot')->select($_GET['id']);         
        $data['option_availability_class']		=	($data['option_availability_id'] == 1) ? 'color_green' : 'color_red';
        $data['option_availability_bullet']		=	($data['option_availability_id'] == 1) ? 'paid' : 'attention';
        #hash_dump($data, 1);
        # VIEW - side nav
        $side_nav['profile.class']		=	'bold';         	
       	$side_nav['lot_id']				=	$data['lot_id'];         	
       	$data['side_nav']				=	view_get_template($parent->controller_id.'/template/side.reservation', $side_nav);           
        # VIEW
        $parent->_view('reservation.profile', $data);        
    }   
     
                
     public function remark($parent)
    {      	
    	# DB
        $data							=	mvc_model('model.lot')->select($_GET['id']);            
        $data['row.remark']			=	mvc_model('model.remark')->get_row('lot', $_GET['id']);        
       
        # VIEW - side nav
        $side_nav['remark.class']		=	'bold';         	
       	$side_nav['lot_id']				=	$data['lot_id'];         	
       	$data['side_nav']				=	view_get_template($parent->controller_id.'/template/side.reservation', $side_nav);           
        # VIEW
        $parent->_view('reservation.remark', $data);      
    }   

#----------------------- Form Pages	

	 public function reservation($parent)
    {
    	$data									=	mvc_model('model.lot')->select($_GET['id']);
    	$data['sysglobal']						=	$parent->sysglobal;    
        
        $option_payment_method					=	mvc_model('model.option')->select_option('option_payment_method');       	       	     	
        $option_payment_receipt					=	mvc_model('model.option')->select_option('option_payment_receipt');                    	       	     	
        $option_account_invoice_type			=	mvc_model('model.option')->select_option('option_account_invoice_type', "WHERE option_account_invoice_type_key = 'rsv'");                    	       	     	
              	     	
               	       	     	
        # VIEW - db options
       
       	$data['option_payment_method']			=	hash_to_option($option_payment_method, 'option_payment_method_id', 'option_payment_method_name', 'cash');
       	$data['option_payment_receipt']			=	hash_to_option($option_payment_receipt, 'option_payment_receipt_id', 'option_payment_receipt_name', 'or');
       	$data['option_account_invoice_type']	=	hash_to_option($option_account_invoice_type, 'option_account_invoice_type_id', 'option_account_invoice_type_name');
       
        # VIEW - side nav
        $side_nav['reservation.class']			=	'bold';         	
       	$side_nav['lot_id']						=	$data['lot_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.reservation', $side_nav);      
      
        # VIEW
        $parent->_view('reservation.form', $data);        
	}
	
	
    
      
    
#----------------------- Form Actions

	public function submit_reservation($parent)
	{		
		$account_receive			=	mvc_model('model.account_receive')->insert($_POST['account_receive']);
		$client_account_invoice		=	mvc_model('model.client_account_invoice')->insert_rsv_earnest($account_receive, $_POST['option_account_invoice_type_id']);
		# Insert Receipt Breakdown	
		$vat_base					=	$this->_get_vat_base($parent);
										mvc_model('model.account_receive_invoice')->insert_rsv_earnest_invoice($account_receive, $client_account_invoice, $vat_base);
		
		
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
		
		
		$lot['str']['option_availability_id']	=	($_POST['option_account_invoice_type_id'] == 'reservation') ? 'reserved' : 'earnest';
		mvc_model('model.lot')->update($lot, $account_receive['lot_id'],$parent->user['user_id']);
		
		header_location("/finance_cashier/reservation/profile/&id={$account_receive['lot_id']}");
		
	}
	
	public function submit_remark($parent)
	{
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/finance_cashier/reservation/remark/&id={$_POST['lot_id']}");
	}
	
	private function _get_vat_base($parent)
	{
		$vat_rate		=	$parent->sysglobal['vat_rate'];
		$vat_base		=	($vat_rate / 100) / (($vat_rate/100) + 1);
		$vat_base		=	round($vat_base, 5);
		
		return $vat_base;
	}
	
	 
   
}