<?php
class edp_cms_user
{
    
    public function __construct()
    {    	
       $this->controller_id = 'edp_cms_user';
       
    } 
    
    public function index($parent)
    {           
        # DB
       	$data['row.user']	=	mvc_model('model.user')->get_row(); 
        # VIEW - header 
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';
        # VIEW
        $parent->_view('user', $data);
    }    
    
    public function profile($parent)
    {      	
    	# DB
    	$id										=   $_GET['id']*1;
        $data									=	mvc_model('model.user')->select($id);          
        $data['option_user_status_bullet']		=	($data['option_user_status_id'] == 1) ? 'paid' : 'attention'; 
        $data['option_user_status_font']		=	($data['option_user_status_id'] == 1) ? 'color_green' : 'color_red'; 
      // hash_dump($data); 
        # VIEW - side nav
        $side_nav['profile.class']				=	'bold';         	
       	$side_nav['user_id']					=	$id;  
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.user.profile', $side_nav);    
        # VIEW - header      	       	
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';       
        # VIEW
        $parent->_view('user.profile', $data);        
    }   
    
    public function module($parent)
    {      	
    	# DB
        $data	=	mvc_model('model.user')->select($_GET['id']);
        $module_user = mvc_model('model.module')->get_user_module($_GET['id']);	
        $module	=	mvc_model('model.module')->select_avail_row($_GET['id']);       
        # VIEW - db options
        $data['module']							=	hash_to_option($module, 'module_id', 'module_name');
        $data['module_empty']					=	(count($module)) ? '' : 'display_none';
        $data['row.user.module']				=	$module_user;
        # VIEW - side Nav
        $side_nav['user_id']					=	$data['user_id'];
       	$side_nav['module.class']				=	'bold';        		
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.user.profile', $side_nav);
        # VIEW - header
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';             	
        # VIEW       
        $parent->_view('user.module', $data);        
    }
    
    public function report($parent)
    {      	
    	# DB
        $data			=	mvc_model('model.user')->select($_GET['id']);
        $report_user 	= 	mvc_model('model.report')->get_user_report($_GET['id']);	
        $report			=	mvc_model('model.report')->select_avail_row($_GET['id']);       
        # VIEW - db options
        $data['report']							=	hash_to_option($report, 'report_id', 'report_name');
        $data['report_empty']					=	(count($report)) ? '' : 'display_none';
        $data['row.user.report']				=	$report_user;
        # VIEW - side Nav
        $side_nav['user_id']					=	$data['user_id'];
       	$side_nav['report.class']				=	'bold';        		
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.user.profile', $side_nav);
        # VIEW - header
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';             	
        # VIEW       
        $parent->_view('user.report', $data);        
    }
    
    public function user_log($parent)
    {      	
    	# DB
        $data	=	mvc_model('model.user')->select($_GET['id']);
        # VIEW - side Nav
        $side_nav['user_id']						=	$data['user_id'];
       	$side_nav['user_log.class']					=	'bold';       	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.user.profile', $side_nav);
        # VIEW - header
        $data[$this->controller_id]					=	'<i></i>';
        $data[$this->controller_id.'_class']		=	'class="active"';       
        # VIEW       
        $parent->_view('user.user_log', $data);        
    }   

#----------------------- Form Pages	

	 public function add($parent)
    {      	 
       	# DB
       	$option_user_status						=	mvc_model('model.option')->select_option('option_user_status', 'ORDER BY option_user_status_name ASC');       	
       	$option_department						=	mvc_model('model.option')->select_option('option_department', 'ORDER BY option_department_name ASC');  
    	$option_job_title						=	mvc_model('model.option')->select_option('option_user_job_title', 'ORDER BY option_user_job_title_name ASC');       	
       	$option_level							=	mvc_model('model.option')->select_option('option_user_level', 'ORDER BY option_user_level_name ASC');       	
        $option_schedule						=	mvc_model('model.option')->select_option('payroll_schedule', 'ORDER BY payroll_schedule_name ASC');
        $option_section							=	mvc_model('model.option')->select_option('option_department_section', 'ORDER BY option_department_section_name ASC');
        # VIEW - db options
        $data['option_user_status']				=	hash_to_option($option_user_status, 'option_user_status_id', 'option_user_status_name', 1);
        $data['option_department']				=	hash_to_option($option_department, 'option_department_id', 'option_department_name');
        $data['option_section']				    =	hash_to_option($option_section, 'option_department_section_id', 'option_department_section_name');
        $data['option_job_title']				=	hash_to_option($option_job_title, 'option_user_job_title_id', 'option_user_job_title_name');
        $data['option_user_level']				=	hash_to_option($option_level, 'option_user_level_id', 'option_user_level_name');
        $data['option_schedule']				=	hash_to_option($option_schedule, 'payroll_schedule_id', 'payroll_schedule_name');
        # VIEW - header
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';       
        # VIEW
        $parent->_view('user.form', $data);        
    }
    
    public function edit($parent)
    {
    	# DB
    	$data									=	mvc_model('model.user')->select($_GET['id']);   	
    	$option_user_status						=	mvc_model('model.option')->select_option('option_user_status', 'ORDER BY option_user_status_name ASC');       	
       	$option_department						=	mvc_model('model.option')->select_option('option_department', 'ORDER BY option_department_name ASC');       	
    	$option_job_title						=	mvc_model('model.option')->select_option('option_user_job_title', 'ORDER BY option_user_job_title_name ASC');       	
       	$option_level							=	mvc_model('model.option')->select_option('option_user_level', 'ORDER BY option_user_level_name ASC');   
       	$option_schedule						=	mvc_model('model.option')->select_option('payroll_schedule', 'ORDER BY payroll_schedule_name ASC');    	
        $option_section							=	mvc_model('model.option')->select_option('option_department_section', 'ORDER BY option_department_section_name ASC');
        # VIEW - db options
        $data['option_user_status']				=	hash_to_option($option_user_status, 'option_user_status_id', 'option_user_status_name', $data['option_user_status_id']);
        $data['option_department']				=	hash_to_option($option_department, 'option_department_id', 'option_department_name', $data['option_department_id']);
        $data['option_job_title']				=	hash_to_option($option_job_title, 'option_user_job_title_id', 'option_user_job_title_name', $data['option_user_job_title_id']);
        $data['option_user_level']				=	hash_to_option($option_level, 'option_user_level_id', 'option_user_level_name', $data['option_user_level_id']);
        $data['option_schedule']				=	hash_to_option($option_schedule, 'payroll_schedule_id', 'payroll_schedule_name', $data['payroll_schedule_id']);
        $data['option_section']				    =	hash_to_option($option_section, 'option_department_section_id', 'option_department_section_name', $data['option_department_section_id']);
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
			$_POST['det']['int']['user_hire_date']		=	strtotime($_POST['det']['int']['user_hire_date']);
			mvc_model('model.user')->update($_POST['det'], $id);	
			header_location("/edp_cms/edp_cms_user/profile/&id={$id}");
		}
		else # Insert
		{
			
			$_POST['det']['int']['user_hire_date']		=	strtotime($_POST['det']['int']['user_hire_date']);
			$insert										=   mvc_model('model.user')->insert($_POST['det']);
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