<?php
class message
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'message';
       	$this->user						=	session_check();
          
         
         	
    }
    
    public function index()
    {      	
       	$this->service();
    }
    
    public function service()
    {   	
       	mvc_controller('message.service', $this->sub_method, $this); 
    }
    
   
  
		 
		 
	#----------------------- VIEW
	
	public function _view($view, $data = array(),$current='')
    {    	
    	
    	$current						=	($current) ? $current : 'new_message';
    	$header[$current]				=	'<i></i>';
    	$header["{$current}_class"]		=	'class="active"';
    	$data['header.navigation']		=	view_get_template($this->controller_id."/include/header", $header, true);
    	$data['_user_']					=	$this->user;
    	$data['header_title']			=	"Message";
    	$data['emblem']					=	view_get_template($this->controller_id."/include/emblem");
    	mvc_set_var($data);       
        mvc_view('_include/header');        
        mvc_view($this->controller_id."/{$view}");
        mvc_view('_include/footer');        
	}
    
    
}