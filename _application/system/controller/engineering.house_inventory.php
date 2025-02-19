<?php 
class engineering_house_inventory
{
    
    public function __construct()
    {    	
       $this->controller_id = 'engineering_house_inventory';       
    }
    
    public function index($parent)
    {           
        # DB
       	$data['row.house']	=	mvc_model('model.house')->get_row();        
        # VIEW
        $parent->_view('house', $data); 
    } 
     
    public function profile($parent)
    {      	
    	# DB
       	$data									=	mvc_model('model.house')->select($_GET['id']);              
        # VIEW - side nav
        $side_nav['profile.class']				=	'bold';         	
       	$side_nav['house_id']					=	$data['house_id'];         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.house', $side_nav);            
        # VIEW
        $parent->_view('house.profile', $data);        
    }   
    
    public function pricing($parent)
    {      	
    	# DB
        $data							=	mvc_model('model.house')->select($_GET['id']);            
        $data['row.house.price']		=	mvc_model('model.house')->get_lot_price_row($_GET['id']);            
       
        # VIEW - side nav
        $side_nav['pricing.class']		=	'bold';         	
       	$side_nav['house_id']			=	$data['house_id'];         	
       	$data['side_nav']				=	view_get_template($parent->controller_id.'/template/side.house', $side_nav);           
        # VIEW
        $parent->_view('house.pricing', $data);
    }   
      

#----------------------- Form Pages	

	 public function add($parent)
    {      	 
       	# DB
       	$project								=	mvc_model('model.option')->select_option('project', 'ORDER BY project_name ASC');       	
       	$option_house_classification			=	mvc_model('model.option')->select_option('option_house_classification', 'ORDER BY option_house_classification_name ASC');       	
        # VIEW - db options
        $data['project']						=	hash_to_option($project, 'project_id', 'project_name');
        $data['option_house_classification']	=	hash_to_option($option_house_classification, 'option_house_classification_id', 'option_house_classification_name');
        # VIEW - header
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';       
        # VIEW
        $parent->_view('house.form', $data);        
    }
    
    public function edit($parent)
    {
    	# DB
    	$data								=	mvc_model('model.house')->select($_GET['id']);   	
    	$project							=	mvc_model('model.option')->select_option('project', 'ORDER BY project_name ASC');       	
       	$option_house_classification		=	mvc_model('model.option')->select_option('option_house_classification', 'ORDER BY option_house_classification_name ASC');       	
        # VIEW - db options
        $data['project']						=	hash_to_option($project, 'project_id', 'project_name', $data['project_id']);
        $data['option_house_classification']	=	hash_to_option($option_house_classification, 'option_house_classification_id', 'option_house_classification_name', $data['option_house_classification_id']);
        # VIEW     
        $parent->_view('house.form', $data);    	
	}
    
     
      
#----------------------- Form Actions

	public function submit($parent)
	{	
		$id 	=	string_clean_number($_POST['id']);		
		if($id) # Update
		{			
			mvc_model('model.house')->update($_POST, $id, $parent->user['user_id']);	
			header_location("/edp_inventory/edp_inventory_house/profile/&id={$id}");
		}
		else # Insert
		{
			mvc_model('model.house')->insert($_POST, $parent->user['user_id']);
			header_location('/edp_inventory/edp_inventory_house');
		}		
	}
	
	public function delete()
	{	
		mvc_model('model.user')->delete($_GET['id']);
		header_location('/edp_cms/edp_cms_user');
	}
	 
	
   
}
