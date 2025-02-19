<?php
class finance_billing
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'finance_billing';
       	$this->user						=	session_check();
       #	mvc_model('model.client_account_invoice')->update_due(); 
       	
    }
    
    public function index()
    {      	
       	$this->due();
    }
    
    public function due()
    {   	
       	mvc_controller('finance_billing.due', $this->sub_method, $this); 
    }
    
    public function retention()
    {   	
       	mvc_controller('finance_billing.retention', $this->sub_method, $this); 
    }
      
    
    public function account()
    {   	
       	mvc_controller('finance_billing.account', $this->sub_method, $this); 
    }
    
    public function report()
    {      	
    	
       	mvc_controller('finance_billing.report', $this->sub_method, $this); 
    }
      
	public function letter($letter, $data)
	{
		$data['_user_']				=		$this->user;
		$data['header_standard']	=		view_get_template($this->controller_id."/letter/_header_standard");		
		mvc_set_var($data);
		mvc_view($this->controller_id."/letter/{$letter}");
	}
		 
		  
	#----------------------- VIEW
	
	public function _view($view, $data = array())
    {    	
    	
    	$current						=	($_GET['application']) ? $_GET['application'] : 'due';
    	$header[$current]				=	'<i></i>';
    	$header["{$current}_class"]		=	'class="active"';
    	$data['header.navigation']		=	view_get_template($this->controller_id."/include/header", $header, true);
    	$data['_user_']					=	$this->user;
    	$data['header_title']			=	"Finance - Billing";
    	$data['emblem']					=	view_get_template($this->controller_id."/include/emblem");
    	mvc_set_var($data);       
        mvc_view('_include/header');        
        mvc_view($this->controller_id."/{$view}");
        mvc_view('_include/footer');        
	}
    
    
}