<?php
class finance_billing_due
{
    
    public function __construct()
    {    	
       $this->controller_id = 'finance_billing_due';       
       mvc_model('model.client_account')->update_focus();
           
    }
    
    public function index($parent)
    {        
        # DB       	     
       	$data['row.due']	=	 mvc_model('model.client_account')->get_billing_due();
        # VIEW
        $parent->_view('due', $data);
    } 
     
    
    public function profile($parent)
    {      	
    	# DB
        $data                                  =    mvc_model('model.client_account')->select($_GET['id']);
       	#$data['row.manage.account']			=	mvc_model('model.client_account')->get_row($_GET['id']);
        # VIEW - side nav
        $side_nav['profile.class']				=	'bold';         	
       	$side_nav['client_account_id']					=	$data['client_account_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.due', $side_nav);            
       	           
        # VIEW
        $parent->_view('_profile', $data);        
    }
    /*
    public function index()
    {
        $nav['contact_button']   	 =   'active';
        $nav['portfolio_button']     =   '';
        $nav['about_button']    	 =   '';
        $nav['freebies_button']      =   '';
        $nav['plans_button']    	 =   '';
        $nav['header_title']         =   "Contact ";
        $data['inline-nav']        =   view_get_template('/_include/nav',$nav);
        $this->_view('contact', $data);
    }  
    */
    public function invoice($parent)
    {      	
    	# DB
        $data                                  	=    mvc_model('model.client_account')->select($_GET['id']);
       	$data['row.due.invoice']				=	mvc_model('model.client_account_invoice')->get_row_invoice_due($_GET['id']);
       	$data['row.due.invoice.settled']		=	mvc_model('model.client_account_invoice')->get_row_invoice_due($_GET['id'], false, 'paid');
        # VIEW - side nav
        $side_nav['invoice.class']				=	'bold';         	
       	$side_nav['client_account_id']			=	$data['client_account_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.due', $side_nav);              
       	          
        # VIEW
        $parent->_view('due.invoice', $data);        
    } 
    
  
    
    public function letter_print($parent)
    {      	
    	# Allowed Letter
    	$valid						=	array('demand_first', 'demand_final', 'cancellation_with_refund', 'cancellation_without_refund', 'ejectment');
    	# DB
        $data                       =    	mvc_model('model.client_account')->select($_GET['id']);
       	$data['due']				=		mvc_model('model.client_account_invoice')->get_row_invoice_due($_GET['id'], 1);      
        $data['recent']				=		mvc_model('model.client_account_invoice')->select_recent_due($_GET['id']);        
       
        
        if(in_array($_GET['letter'], $valid))
        {        	
        	$parent->letter($_GET['letter'], $data);      
		}
		else
		{
			die("Invalid Letter : {$_GET['letter']}");
		}
         
    }  
    
    
    
    
    public function letter_history($parent)
    {      	
    	# DB
    	$data                                  	=    mvc_model('model.client_account')->select($_GET['id']);
    	$data['row.letter']						=	mvc_model('model.account_letter')->get_row($_GET['id']);
    	# VIEW - side nav
        $side_nav['letter_history.class']		=	'bold';         	
       	$side_nav['client_account_id']			=	$data['client_account_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.due', $side_nav);      
       	          
        # VIEW       
        $parent->_view('due.letter_history', $data); 
	}
    
    public function letter_view($parent)
    {      	
    	# DB
        $data                                  =    mvc_model('model.client_account')->select($_GET['account_id']);
        $data['account_letter']                =    mvc_model('model.account_letter')->select($_GET['id']);       	
        # VIEW - side nav
        $side_nav['letter_history.class']		=	'bold';         	
       	$side_nav['client_account_id']			=	$data['client_account_id'];  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.due', $side_nav);                 	          
        # VIEW
        mvc_set_var($data);
        mvc_view('finance_billing/due.letter_view_pop');        
    } 
    
    
    
    public function remark($parent)
    {
    	# DB
        $data                               =   mvc_model('model.client_account')->select($_GET['id']); 
        $data['row.remark']					=	mvc_model('model.remark')->get_row('client_account', $_GET['id']);            
       
        # VIEW - side nav
        $side_nav['remark.class']			=	'bold';         	
       	$side_nav['client_account_id']		=	$data['client_account_id'];  
       	$data['side_nav']					=	view_get_template($parent->controller_id.'/template/side.due', $side_nav);           
        # VIEW
        $parent->_view('due.remark', $data);      
	} 
    
    
        

#----------------------- Form Pages	
	     
       
    
    
    
#----------------------- Form Actions

	public function letter_submit()
	{
		mvc_model('model.account_letter')->insert($_POST);
		$invoice_id		=	mvc_model('model.client_account_invoice')->select_current_due($_POST['client_account_id']);
							mvc_model('model.client_account_invoice')->update_status($_POST['client_account_id'], $invoice_id, $_POST['option_invoice_status_id']);
		
		mvc_model('model.client_account')->update_un_focus($_POST['client_account_id']);
		header_close();
	}

	
	public function submit_remark($parent)
	{
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/finance_billing/due/remark/&id={$_POST['client_account_id']}");
	}

	
	

	
	

	
	
	
	
   
}