<?php 
class edp_cms_module
{
    
    public function __construct()
    {    	
       $this->controller_id = 'edp_cms_module';
       
    }
    
    public function index($parent)
    {       
        # DB
        $data['row.module']		=	mvc_model('model.module')->get_row();
        # View - header
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';        
        # View
        $parent->_view('module', $data);
    }
      
    public function user($parent)  
    {
    	# DB
        $data			=	mvc_model('model.module')->select($_GET['id']);
        $module_user 	= 	mvc_model('model.module')->get_module_user($_GET['id']);	              
        # VIEW - db options
        $data['module']							=	hash_to_option($module, 'module_id', 'module_name');
        $data['module_empty']					=	(count($module)) ? '' : 'display_none';
        $data['row.module.user']				=	$module_user;
        # VIEW - side Nav
        $side_nav['module_id']					=	$data['module_id'];
       	$side_nav['user.class']					=	'bold';        		
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.module', $side_nav);
        # VIEW - header
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';             	
        # VIEW       
        $parent->_view('module.user', $data);
	}
	
	public function module_log($parent)
	{
		# DB
        $data									=	mvc_model('model.module')->select($_GET['id']);
		# VIEW - side Nav
        $side_nav['module_id']					=	$data['module_id'];
       	$side_nav['module_log.class']			=	'bold';        		
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.module', $side_nav);
        # VIEW - header
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';             	
        # VIEW       
        $parent->_view('module.module_log', $data);
	}
   

#----------------------- Form Actions

	public function user_delete()
	{		
		mvc_model('model.module')->delete_user_module($_GET['id']);
		header_location("/edp_cms/edp_cms_module/user/&id={$_GET['module_id']}");
	}
    
    
    
    
    
   
   
    
    
}
