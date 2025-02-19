<?php 
class edp_cms_rate
{
    
    public function __construct()
    {    	
       $this->controller_id = 'edp_cms_rate';
       
    }
    
    public function index($parent)
    {           
        # DB
       	$data['row.rate']	=	mvc_model('model.rate')->get_row();
        # VIEW - header 
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';
        # VIEW
        $parent->_view('rate', $data);
    }    
       
    public function profile($parent)
    {      	
    	# DB
        $data	=	mvc_model('model.rate')->select($_GET['id']);          
        $data['option_user_status_bullet']		=	($data['option_user_status_id'] == 1) ? 'paid' : 'attention'; 
        $data['option_user_status_font']		=	($data['option_user_status_id'] == 1) ? 'color_green' : 'color_red';  
        # VIEW - side nav
        $side_nav['profile.class']				=	'bold';         	
       	$side_nav['rate_id']					=	$data['rate_id'];         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.rate', $side_nav);    
        # VIEW - header      	       	
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';       
        # VIEW
        $parent->_view('rate.profile', $data);        
    }
    
    public function interest($parent)
    {      	
    	# DB
        $data						=	mvc_model('model.rate')->select($_GET['id']);          
        $data['row.rate.interest']	=	mvc_model('model.rate')->get_rate_interest($_GET['id']);        
        $option_dp		=	mvc_model('model.option')->select_option('option_dp');        
        # VIEW - side nav
        $data['option_dp']					=	($data['rate_dp_id']) ? '<option value="'.$data['rate_dp_id'].'">'.$data['rate_dp_name'].'</option>' : hash_to_option($option_dp, 'option_dp_id', 'option_dp_name');
        $side_nav['interest.class']				=	'bold';         	
       	$side_nav['rate_id']					=	$data['rate_id'];         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.rate', $side_nav);    
        # VIEW - header      	       	
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';       
        # VIEW
        $parent->_view('rate.interest', $data);        
    }  

#----------------------- Form Pages	

	 public function add($parent)
    {      	 
       	# DB       	       	
		$option_dp		=	mvc_model('model.option')->select_option('rate_dp');       
        # VIEW - db options         
        $data['rate_dp']				=	hash_to_option($option_dp, 'rate_dp_id', 'rate_dp_name');
        # VIEW - header
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';       
        # VIEW
        $parent->_view('rate.form', $data);        
    } 
    
    
#----------------------- Form Actions

	public function submit()
	{		
		mvc_model('model.rate')->insert($_POST); 
		header_location('/edp_cms/edp_cms_rate');				
	}
	
	public function delete()
	{	
		mvc_model('model.rate')->delete($_GET['id']);
		header_location('/edp_cms/edp_cms_rate');
	}
	
	public function rate_interest_add()
	{		
		mvc_model('model.rate')->insert_rate_interest($_POST);
		header_location("/edp_cms/edp_cms_rate/interest/&id={$_POST['rate_id']}");
	}
	
	public function rate_interest_delete()
	{		
		mvc_model('model.rate')->delete_rate_interest($_GET['id']);
		header_location("/edp_cms/edp_cms_rate/interest/&id={$_GET['user_id']}");
	}	
	
}