<?php 
class edp_inventory_phase
{
    
    public function __construct()
    {    	
       $this->controller_id = 'edp_inventory_phase';
       
    }
    
    public function index($parent)
    {           
        # DB
       	#$data['row.user']	=	mvc_model('model.user')->get_row();
        # VIEW - header 
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';
        # VIEW
        $parent->_view('phase', $data);
    } 
    
    public function profile($parent)
    {      	
    	# DB 
        #$data									=	mvc_model('model.user')->select($_GET['id']);          
       # $data['option_user_status_bullet']		=	($data['option_user_status_id'] == 1) ? 'paid' : 'attention'; 
        #$data['option_user_status_font']		=	($data['option_user_status_id'] == 1) ? 'color_green' : 'color_red';  
        # VIEW - side nav
        $side_nav['profile.class']				=	'bold';         	
       	$side_nav['user_id']					=	$data['user_id'];         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.phase', $side_nav);    
        # VIEW - header      	       	
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';       
        # VIEW
        $parent->_view('phase.profile', $data);        
    }
       
    public function block($parent)
    {      	
    	# DB
        #$data	=	mvc_model('model.user')->select($_GET['id']);          
       # $data['option_user_status_bullet']		=	($data['option_user_status_id'] == 1) ? 'paid' : 'attention'; 
        #$data['option_user_status_font']		=	($data['option_user_status_id'] == 1) ? 'color_green' : 'color_red';  
        # VIEW - side nav
        $side_nav['block.class']				=	'bold';         	
       	$side_nav['user_id']					=	$data['user_id'];         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.phase', $side_nav);    
        # VIEW - header      	       	
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';       
        # VIEW
        $parent->_view('phase.block', $data);        
    }  
    
    public function lot($parent)
    {      	
    	# DB
        #$data									=	mvc_model('model.user')->select($_GET['id']);          
       # $data['option_user_status_bullet']		=	($data['option_user_status_id'] == 1) ? 'paid' : 'attention'; 
        #$data['option_user_status_font']		=	($data['option_user_status_id'] == 1) ? 'color_green' : 'color_red';  
        # VIEW - side nav
        $side_nav['lot.class']					=	'bold';         	
       	$side_nav['user_id']					=	$data['user_id'];         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.phase', $side_nav);    
        # VIEW - header      	       	
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';       
        # VIEW
        $parent->_view('phase.lot', $data);        
    }
    
    
    

#----------------------- Form Pages	

	 public function add($parent)
    {      	 
       	# DB
       	#$option_user_status					=	mvc_model('model.option')->select_option('option_user_status', 'ORDER BY option_user_status_name ASC');       	
       	#$option_department						=	mvc_model('model.option')->select_option('option_department', 'ORDER BY option_department_name ASC');       	
        # VIEW - db options
        #$data['option_user_status']			=	hash_to_option($option_user_status, 'option_user_status_id', 'option_user_status_name', 1);
        #$data['option_department']				=	hash_to_option($option_department, 'option_department_id', 'option_department_name');
        # VIEW - header
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';       
        # VIEW
        $parent->_view('phase.form', $data);        
    } 
    
    public function edit($parent)
    {
    	# DB
    	$data	=	mvc_model('model.user')->select($_GET['id']);   	
    	$option_user_status						=	mvc_model('model.option')->select_option('option_user_status', 'ORDER BY option_user_status_name ASC');       	
       	$option_department						=	mvc_model('model.option')->select_option('option_department', 'ORDER BY option_department_name ASC');       	
        # VIEW - db options
        $data['option_user_status']				=	hash_to_option($option_user_status, 'option_user_status_id', 'option_user_status_name', $data['option_user_status_id']);
        $data['option_department']				=	hash_to_option($option_department, 'option_department_id', 'option_department_name', $data['option_department_id']);
        # VIEW       
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';  
        # VIEW     
        $parent->_view('user.form', $data);    	
	}
    
    
    
#----------------------- Form Actions

	public function submit()
	{	
		$id 	=	string_clean_number($_POST['id']);		
		if($id) # Update
		{
			mvc_model('model.user')->update($_POST, $id);	
			header_location("/edp_cms/edp_cms_user/profile/&id={$id}");
		}
		else # Insert
		{
			mvc_model('model.user')->insert($_POST);
			header_location('/edp_cms/edp_cms_user');
		}		
	}
	
	public function delete()
	{	
		mvc_model('model.user')->delete($_GET['id']);
		header_location('/edp_cms/edp_cms_user');
	}
	
	public function module_add()
	{
		mvc_model('model.module')->insert_user_module($_POST);
		header_location("/edp_cms/edp_cms_user/module/&id={$_POST['user_id']}");
	}
	
	public function report_add()
	{		
		mvc_model('model.report')->insert_user_report($_POST);
		header_location("/edp_cms/edp_cms_user/report/&id={$_POST['user_id']}");
	}
	
	public function module_delete()
	{		
		mvc_model('model.module')->delete_user_module($_GET['id']);
		header_location("/edp_cms/edp_cms_user/module/&id={$_GET['user_id']}");
	}
	
	public function report_delete()
	{		
		mvc_model('model.report')->delete_user_report($_GET['id']);
		header_location("/edp_cms/edp_cms_user/report/&id={$_GET['user_id']}");
	}
   
}
