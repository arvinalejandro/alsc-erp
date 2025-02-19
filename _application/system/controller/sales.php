<?php
class sales
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'sales';
       	$this->user						=	session_check();
         	
    }
    
    public function index()
    {      	
       	$this->agents();
    }
    
    public function agents()
    {   	
       	mvc_controller('sales.agents', $this->sub_method, $this); 
    }
    
    public function old_scheme()
    {       
           mvc_controller('sales.old_scheme', $this->sub_method, $this); 
    }
    
    public function new_scheme()
    {       
           mvc_controller('sales.new_scheme', $this->sub_method, $this); 
    }
    
    public function network_manager()
    {       
           mvc_controller('sales.network_manager', $this->sub_method, $this); 
    }
    
    public function commission()
    {       
           mvc_controller('sales.commission', $this->sub_method, $this); 
    }
    
     public function division()
    {       
           mvc_controller('sales.division', $this->sub_method, $this); 
    }
    
     public function sales_report()
    {       
           mvc_controller('sales.sales_report', $this->sub_method, $this); 
    }
    
    public function sales_manager()
    {       
           mvc_controller('sales.sales_manager', $this->sub_method, $this); 
    }
    
    public function sales_director()
    {       
           mvc_controller('sales.sales_director', $this->sub_method, $this); 
    }
    
     public function lot_hold()
    {       
           mvc_controller('sales.lot_hold', $this->sub_method, $this); 
    }
    
    public function backout_account()
    {       
           mvc_controller('sales.backout_account', $this->sub_method, $this); 
    }
  
		 
		 
	#----------------------- VIEW
	
	public function _view($view, $data = array())
    {    	
    	
    	$current						=	($_GET['application']) ? $_GET['application'] : 'agents';
    	$current						=	($_GET['application']=='sales_director') ? 'new_scheme' :  $current;
    	$current						=	($_GET['application']=='sales_manager') ? 'new_scheme' :  $current;
    	$current						=	($_GET['application']=='division') ? 'old_scheme' :  $current;
    	$current						=	($_GET['application']=='network_manager') ? 'old_scheme' :  $current;
    	$header[$current]				=	'<i></i>';
    	$header["{$current}_class"]		=	'class="active"';
    	$data['header.navigation']		=	view_get_template($this->controller_id."/include/header", $header, true);
    	$data['_user_']					=	$this->user;
    	$data['header_title']			=	"Sales";
    	$data['emblem']					=	view_get_template($this->controller_id."/include/emblem");
        
    	mvc_set_var($data);       
        mvc_view('_include/header');        
        mvc_view($this->controller_id."/{$view}");
        mvc_view('_include/footer');        
	}
    
    
}