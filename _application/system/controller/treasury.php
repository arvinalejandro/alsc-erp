<?php
class treasury
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'treasury';
       	$this->user						=	session_check();
       
       	
    }
    
    public function index()
    {      	
       	$this->cheque_details();
    }
    
    public function cheque_details()
    {   	
       	mvc_controller('treasury.cheque_details', $this->sub_method, $this); 
    }
    
     public function cheque_release()
    {       
           mvc_controller('treasury.cheque_release', $this->sub_method, $this); 
    }
    
     public function cheque_status()
    {       
           mvc_controller('treasury.cheque_status', $this->sub_method, $this); 
    }
		 
	#----------------------- VIEW
	
	public function _view($view, $data = array())
    {    	
    	
    	$current						=	($_GET['application']) ? $_GET['application'] : 'cheque_details';
    	$header[$current]				=	'<i></i>';
    	$header["{$current}_class"]		=	'class="active"';
    	$data['header.navigation']		=	view_get_template($this->controller_id."/include/header", $header, true);
    	$data['_user_']					=	$this->user;
    	$data['header_title']			=	"Treasury";
    	$data['emblem']					=	view_get_template($this->controller_id."/include/emblem");
    	mvc_set_var($data);       
        mvc_view('_include/header');        
        mvc_view($this->controller_id."/{$view}");
        mvc_view('_include/footer');        
	}
    
    
}