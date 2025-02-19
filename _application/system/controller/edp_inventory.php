<?php
class edp_inventory
{
    
    public function __construct()
    {
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'edp_inventory';
       	$this->user						=	session_check();   
    }
    
    public function index()
    {      	
       	$this->edp_inventory_project();
    }
     
    public function edp_inventory_project()
    {    	
    	mvc_controller('edp_inventory.project', $this->sub_method, $this);    	    	
	}
	 
	public function edp_inventory_phase()
    {    	
    	mvc_controller('edp_inventory.phase', $this->sub_method, $this);    	    	
	}
	
	public function edp_inventory_block()
    {    	
    	mvc_controller('edp_inventory.block', $this->sub_method, $this);    	    	
	}
	
	public function edp_inventory_lot()
    {    	
    	mvc_controller('edp_inventory.lot', $this->sub_method, $this);    	    	
	}
	
	public function edp_inventory_house()
    {    	
    	mvc_controller('edp_inventory.house', $this->sub_method, $this);    	    	
	}
	
	public function edp_inventory_house_lot()
    {    	
    	mvc_controller('edp_inventory.house_lot', $this->sub_method, $this);    	    	
	}
	  
	public function edp_inventory_client()
    {    	
    	mvc_controller('edp_inventory.client', $this->sub_method, $this);     	    	
	}
	 
	#----------------------- VIEW
	
	public function _view($view, $data = array())
    {    	
    	$current						=	($_GET['application']) ? $_GET['application'] : 'edp_inventory_project';
    	$header[$current]				=	'<i></i>';
    	$header["{$current}_class"]		=	'class="active"';
    	$data['header.navigation']		=	view_get_template($this->controller_id."/include/header", $header, true);
    	$data['_user_']					=	$this->user;
    	$data['header_title']			=	"EDP - Inventory Management System";
    	$data['emblem']					=	view_get_template($this->controller_id."/include/emblem");
    	mvc_set_var($data);       
        mvc_view('_include/header');        
        mvc_view($this->controller_id."/{$view}");
        mvc_view('_include/footer');        
	}
    
    
}
