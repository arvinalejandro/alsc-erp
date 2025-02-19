<?php
class finance_cashier
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'finance_cashier';
       	$this->user						=	session_check();
       	$this->sysglobal				=	mvc_model('model.sysglobal')->select();
    	#mvc_model('model.client_account_invoice')->update_due();     	    	
    }
    
    public function index()
    {      	
       	$this->account();
    }
    
    public function account()
    {    	
       	mvc_controller('finance_cashier.account', $this->sub_method, $this); 
    }
     
    public function collection()
    {    	
       	mvc_controller('finance_cashier.collection', $this->sub_method, $this); 
    }
    
    public function reservation()
    {    	
       	mvc_controller('finance_cashier.reservation', $this->sub_method, $this); 
    }  
    
    public function transaction()
    {   	
       	mvc_controller('finance_cashier.transaction', $this->sub_method, $this); 
    }
    
    public function daily()
    {   	
       	mvc_controller('finance_cashier.daily', $this->sub_method, $this); 
    }
      		  
		    
	#----------------------- VIEW
	
	public function _view($view, $data = array())
    {    	
    	
    	$current						=	($_GET['application']) ? $_GET['application'] : 'account';
    	$header[$current]				=	'<i></i>';
    	$header["{$current}_class"]		=	'class="active"';
    	$data['header.navigation']		=	view_get_template($this->controller_id."/include/header", $header, true);
    	$data['_user_']					=	$this->user;
    	$data['header_title']			=	"Finance - Cashier";
    	$data['emblem']					=	view_get_template($this->controller_id."/include/emblem");
    	mvc_set_var($data);       
        mvc_view('_include/header');        
        mvc_view($this->controller_id."/{$view}");
        mvc_view('_include/footer');        
	}
    
    
} 