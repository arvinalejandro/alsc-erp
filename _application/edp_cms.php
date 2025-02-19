<?php
class edp_cms
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'edp_cms';
       	$this->user						=	session_check(); 
    }
    
    public function index()
    {      	
       	$this->edp_cms_user();
    }
    
    public function edp_cms_user()
    {   	
    	mvc_controller('edp_cms.user', $this->sub_method, $this);    	    	
	}
	
	public function edp_cms_module()
    {    	
    	mvc_controller('edp_cms.module', $this->sub_method, $this);    	    	
	}
	
	public function edp_cms_report()
    {    	
    	mvc_controller('edp_cms.report', $this->sub_method, $this);    	    	
	}
	
	public function edp_cms_system()
    {    	
    	mvc_controller('edp_cms.system', $this->sub_method, $this);    	     	
	}
		 
	#----------------------- VIEW
	
	public function _view($view, $data = array())
    {    	
    	
    	$current						=	($_GET['application']) ? $_GET['application'] : 'edp_cms_user';
    	$header[$current]				=	'<i></i>';
    	$header["{$current}_class"]		=	'class="active"';
    	$data['header.navigation']		=	view_get_template($this->controller_id."/include/header", $header, true);
    	$data['_user_']					=	$this->user;
    	$data['header_title']			=	"EDP - Content Management System";
    	$data['emblem']					=	view_get_template($this->controller_id."/include/emblem");
    	mvc_set_var($data);       
        mvc_view('_include/header');        
        mvc_view($this->controller_id."/{$view}");
        mvc_view('_include/footer');        
	}
    
    
}