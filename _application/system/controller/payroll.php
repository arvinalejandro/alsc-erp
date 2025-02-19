<?php
class payroll
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'payroll';
        $this->user						=	mvc_model('model.user')->select($_SESSION['user_id']);
    }
    
    public function index()
    {      	
       	$this->timestamp();
    }
                       
     public function timestamp()
    {   	
       	mvc_controller('payroll.timestamp', $this->sub_method, $this);     
    }
    
     public function employees()
    {   	
       	mvc_controller('payroll.employees', $this->sub_method, $this); 
    }
 
     public function settings()
    {   	
       	mvc_controller('payroll.settings', $this->sub_method, $this); 
    }
    
     public function hr()
    {   	
       	mvc_controller('payroll.hr', $this->sub_method, $this); 
    }
    
     public function cutoff()
    {   	
       	mvc_controller('payroll.cutoff', $this->sub_method, $this); 
    }
    
  
   
	#----------------------- VIEW
	
	public function _view($view, $data = array())
    {    	
    	
    	$current						=	($_GET['application']) ? $_GET['application'] : 'timestamp';
    	$header[$current]				=	'<i></i>';
    	$header["{$current}_class"]		=	'class="active"';
    	$data['header.navigation']		=	view_get_template($this->controller_id."/include/header", $header, true);
    	$data['_user_']					=	$this->user;
    	$data['header_title']			=	"Payroll";
    	$data['emblem']					=	view_get_template($this->controller_id."/include/emblem");
    	mvc_set_var($data);       
        mvc_view('_include/header');        
        mvc_view($this->controller_id."/{$view}");
        mvc_view('_include/footer');        
	}
    
    
}