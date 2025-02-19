<?php 
class edp_cms_report
{
    
    public function __construct()
    {    	
       $this->controller_id = 'edp_cms_report';
       
    }
    
    public function index($parent)
    {      	
    	# DB
        $data['row.report']		=	mvc_model('model.report')->get_row();
        # View - header
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';        
        # View
        $parent->_view('report', $data);
    }
    
    public function user($parent)
    {
    	# DB
        $data			=	mvc_model('model.report')->select($_GET['id']);
        $report_user 	= 	mvc_model('model.report')->get_report_user($_GET['id']);	              
        # VIEW - db options
        $data['report']							=	hash_to_option($report, 'report_id', 'report_name');
        $data['report_empty']					=	(count($report)) ? '' : 'display_none';
        $data['row.report.user']				=	$report_user;
        # VIEW - side Nav
        $side_nav['report_id']					=	$data['report_id'];
       	$side_nav['user.class']					=	'bold';        		
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.report', $side_nav);
        # VIEW - header
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';             	
        # VIEW       
        $parent->_view('report.user', $data);
	}
	   
	public function report_log($parent) 
	{
		# DB
        $data									=	mvc_model('model.report')->select($_GET['id']);
		# VIEW - side Nav
        $side_nav['report_id']					=	$data['report_id'];
       	$side_nav['report_log.class']			=	'bold';        		
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.report', $side_nav);
        # VIEW - header
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';             	
        # VIEW       
        $parent->_view('report.report_log', $data);
	}
	
     
#----------------------- Form Actions

	public function user_delete()
	{		
		mvc_model('model.report')->delete_user_report($_GET['id']);
		header_location("/edp_cms/edp_cms_report/user/&id={$_GET['report_id']}");
	}
    
    
    
    
   
   
    
    
}