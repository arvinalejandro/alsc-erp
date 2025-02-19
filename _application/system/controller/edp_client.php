<?php
class edp_client
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'edp_client';
       	$this->user						=	session_check(); 
    }
    
    public function index()
    {      	
       	$this->edp_client_inventory();
    }
      
    public function edp_client_inventory()
    { 	    	
       	mvc_controller('edp_client.inventory', $this->sub_method, $this); 
    }
    
    public function edp_client_manage()
    {   
    	
    	#mvc_model('model.client_account_invoice')->update_due();	
    	mvc_controller('edp_client.manage', $this->sub_method, $this);    	    	
	}
	  
	   
		
	#----------------------- VIEW
	
	public function _view($view, $data = array())
    {    	
    	
    	$current						=	($_GET['application']) ? $_GET['application'] : 'edp_client_inventory';
    	$header[$current]				=	'<i></i>';
    	$header["{$current}_class"]		=	'class="active"';
    	$data['header.navigation']		=	view_get_template($this->controller_id."/include/header", $header, true);
    	$data['emblem']					=	view_get_template($this->controller_id."/include/emblem");
    	$data['_user_']					=	$this->user;
    	$data['header_title']			=	"Client Management System";
    	mvc_set_var($data);       
        mvc_view('_include/header');        
        mvc_view($this->controller_id."/{$view}");
        mvc_view('_include/footer');         
	}
    
    
}
