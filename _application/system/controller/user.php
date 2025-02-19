<?php
class user
{
    
    public function __construct()
    {
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'user';      
       	$this->user						=	session_check();
       	#init_privilege();
    }
    
    public function index()
    {      	
       	$this->user_module();      
       	
    }
    
    
	
	public function user_report()
    {    	
    	mvc_controller('user.report', $this->sub_method, $this);    	    	
	}
	
	public function user_module()
    {    	
    	mvc_controller('user.module', $this->sub_method, $this);    	    	
	}
	
	public function hr()
    {    	
    	mvc_controller('user.hr', $this->sub_method, $this);    	    	
	}
	
	#----------------------- VIEW
	
	public function _view($view, $data = array())
    {    	
    	$data['_user_']		=	$this->user;  
    	mvc_set_var($data);
        mvc_view($this->controller_id.'/include/header');        
        mvc_view($this->controller_id."/{$view}");
        mvc_view($this->controller_id.'/include/footer');
	}
    
    
}