<?php
class finance_wes
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'finance_wes';
        $this->user						=	mvc_model('model.user')->select($_SESSION['user_id']);
    }
    
    public function index()
    {      	
       	$this->water_account();
    }
    
     public function water_account()
    {   	
       	mvc_controller('finance_wes.water_account', $this->sub_method, $this); 
    }
    
     public function water_reading()
    {   	
       	mvc_controller('finance_wes.water_reading', $this->sub_method, $this); 
    }
 
     public function electric_account()
    {   	
       	mvc_controller('finance_wes.electric_account', $this->sub_method, $this); 
    }
    
       public function electric_reading()
    {   	
       	mvc_controller('finance_wes.electric_reading', $this->sub_method, $this); 
    }
    
    public function settings()
    {   	
       	mvc_controller('finance_wes.settings', $this->sub_method, $this); 
    }
    
     public function transaction_history()
    {   	
       	mvc_controller('finance_wes.transaction_history', $this->sub_method, $this); 
    }
    
  
	#----------------------- VIEW
	
	public function _view($view, $data = array())
    {    	

    	$current						=	($_GET['application']) ? $_GET['application'] : 'water_account';
    	$header[$current]				=	'<i></i>';
    	$header["{$current}_class"]		=	'class="active"';
    	$data['header.navigation']		=	view_get_template($this->controller_id."/include/header", $header, true);
    	$data['_user_']					=	$this->user;
    	$data['header_title']			=	"Finance - WES";
    	$data['emblem']					=	view_get_template($this->controller_id."/include/emblem");
    	mvc_set_var($data);       
        mvc_view('_include/header');        
        mvc_view($this->controller_id."/{$view}");
        mvc_view('_include/footer');        
	}
    
    
}