<?php
class documentation
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'documentation';
       	$this->user					    =	mvc_model('model.user')->select($_SESSION['user_id']);
    }
    
    public function index()
    {      	
       	$this->accounts();
    }
    
    public function accounts()
    {   	
       	mvc_controller('documentation.accounts', $this->sub_method, $this); 
    }
    
     public function lot()
    {   	
       	mvc_controller('documentation.lot', $this->sub_method, $this); 
    }
    
  
    
   
    
  
		 
		 
	#----------------------- VIEW
	
	public function _view($view, $data = array())
    {    	
    	
    	$current						=	($_GET['application']) ? $_GET['application'] : 'accounts';
    	$header[$current]				=	'<i></i>';
    	$header["{$current}_class"]		=	'class="active"';
    	$data['header.navigation']		=	view_get_template($this->controller_id."/include/header", $header, true);
    	$data['_user_']					=	$this->user;
    	$data['header_title']			=	"Documentation";
    	$data['emblem']					=	view_get_template($this->controller_id."/include/emblem");
    	mvc_set_var($data);       
        mvc_view('_include/header');        
        mvc_view($this->controller_id."/{$view}");
        mvc_view('_include/footer');        
	}
    
    
}
