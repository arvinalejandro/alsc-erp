<?php
class edp_inventory_project
{
     
    public function __construct()
    {    	
       $this->controller_id = 'edp_inventory_project';
       
    }
    
    public function index($parent)
    {           
        # DB
       	$data['row.project']	=	mvc_model('model.project')->get_row();         
        # VIEW
        $parent->_view('project', $data);
    } 
    
    public function profile($parent)
    {      	
    	# DB
        $data	=	mvc_model('model.project')->select($_GET['id']);          
       	#$data['option_user_status_bullet']		=	($data['option_user_status_id'] == 1) ? 'paid' : 'attention'; 
        #$data['option_user_status_font']		=	($data['option_user_status_id'] == 1) ? 'color_green' : 'color_red';  
        # VIEW - side nav
        $side_nav['profile.class']				=	'bold';         	
       	$side_nav['project_id']					=	$data['project_id'];         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.project', $side_nav);       
        # VIEW
        $parent->_view('project.profile', $data);        
    }
    
    public function site($parent)
    {      	
    	# DB
        $data	=	mvc_model('model.project')->select($_GET['id']);          
        $data['row.project.site']	=	mvc_model('model.project_site')->get_row($_GET['id']);          
       	#$data['option_user_status_bullet']		=	($data['option_user_status_id'] == 1) ? 'paid' : 'attention'; 
        #$data['option_user_status_font']		=	($data['option_user_status_id'] == 1) ? 'color_green' : 'color_red';  
        # VIEW - side nav
        $side_nav['site.class']					=	'bold';         	
       	$side_nav['project_id']					=	$data['project_id'];         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.project', $side_nav);       
        # VIEW
        $parent->_view('project.site', $data);                
    }
    
    public function block($parent)
    {      	
    	# DB
        $data	=	mvc_model('model.project')->select($_GET['id']);          
        $data['row.project.block']	=	mvc_model('model.project_site_block')->get_project_block_row($_GET['id']);          
       	#$data['option_user_status_bullet']		=	($data['option_user_status_id'] == 1) ? 'paid' : 'attention'; 
        #$data['option_user_status_font']		=	($data['option_user_status_id'] == 1) ? 'color_green' : 'color_red';  
        # VIEW - side nav
        $side_nav['block.class']					=	'bold';         	
       	$side_nav['project_id']					=	$data['project_id'];         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.project', $side_nav);       
        # VIEW
        $parent->_view('project.block', $data);                       
    }
    
    public function lot($parent)
    {      	
    	# DB
    	$project_id = $_GET['id'] * 1;
        $data	=	mvc_model('model.project')->select($_GET['id']);   
               
        $data['row.lot']	=	mvc_model('model.lot')->get_row(" where lot.project_id = '{$project_id}'");          
       	#$data['option_user_status_bullet']		=	($data['option_user_status_id'] == 1) ? 'paid' : 'attention'; 
        #$data['option_user_status_font']		=	($data['option_user_status_id'] == 1) ? 'color_green' : 'color_red';  
        # VIEW - side nav
        $side_nav['lot.class']					=	'bold';         	
       	$side_nav['project_id']					=	$data['project_id'];         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.project', $side_nav);       
        # VIEW
        $parent->_view('project.lot', $data);
    }
    
    public function house($parent)
    {      	
    	
    	# DB
        $data	=	mvc_model('model.project')->select($_GET['id']);          
        #$data['row.project.block']	=	mvc_model('model.project_site')->get_block_row($_GET['id']);          
       	#$data['option_user_status_bullet']		=	($data['option_user_status_id'] == 1) ? 'paid' : 'attention'; 
        #$data['option_user_status_font']		=	($data['option_user_status_id'] == 1) ? 'color_green' : 'color_red';  
        # VIEW - side nav
        $side_nav['house.class']					=	'bold';         	
       	$side_nav['project_id']					=	$data['project_id'];         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.project', $side_nav);       
        # VIEW
        $parent->_view('project.house', $data);                       
    	
    	
    }
    
    public function price($parent)
    {      	
    	
    	# DB
        $data						=	mvc_model('model.project')->select($_GET['id']);          
        $data['row.project.price']	=	mvc_model('model.project')->get_project_price($_GET['id']);          
        #$data['row.project.block']	=	mvc_model('model.project_site')->get_block_row($_GET['id']);          
       	#$data['option_user_status_bullet']		=	($data['option_user_status_id'] == 1) ? 'paid' : 'attention'; 
        #$data['option_user_status_font']		=	($data['option_user_status_id'] == 1) ? 'color_green' : 'color_red';  
        # VIEW - side nav
        $side_nav['price.class']				=	'bold';         	
       	$side_nav['project_id']					=	$data['project_id'];         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.project', $side_nav);       
        # VIEW
        $parent->_view('project.pricing', $data);     	
    }
    
    public function remark($parent)
    {
    	# DB
        $data							=	mvc_model('model.project')->select($_GET['id']);            
        $data['row.remark']				=	mvc_model('model.remark')->get_row('project', $_GET['id']);            
       
        # VIEW - side nav
        $side_nav['remark.class']		=	'bold';         	
       	$side_nav['project_id']				=	$data['project_id'];         	
       	$data['side_nav']				=	view_get_template($parent->controller_id.'/template/side.project', $side_nav);           
        # VIEW
        $parent->_view('project.remark', $data);      
	}

#----------------------- Form Pages	

	 public function add($parent)
    {      	 
       	# DB
       	$option_project_status						=	mvc_model('model.option')->select_option('option_project_status', 'ORDER BY option_project_status_id DESC');           	
        # VIEW - db options
        $data['option_project_status']				=	hash_to_option($option_project_status, 'option_project_status_id', 'option_project_status_name');             
        # VIEW
        $parent->_view('project.form', $data);        
    }
    
    public function edit($parent)
    {
    	# DB
    	$data						=	mvc_model('model.project')->select($_GET['id']);   	
    	$option_project_status		=	mvc_model('model.option')->select_option('option_project_status', 'ORDER BY option_project_status_id DESC');           	
        # VIEW - db options
       	$data['option_project_status']	=	hash_to_option($option_project_status, 'option_project_status_id', 'option_project_status_name', $data['option_project_status_id']);          
        # VIEW     
        $parent->_view('project.form', $data);    	
	}
	
	public function edit_price($parent)
    {
    	# DB
    	$data						=	mvc_model('model.project')->select($_GET['id']); 
    	$project_site				=	mvc_model('model.project_site')->select_row($_GET['id']);  	    	
    	$data['user_id']			=	$parent->user['user_id'];
    	 # VIEW - db options
       	$data['project_site']	=	hash_to_option($project_site, 'project_site_id', 'project_site_name');          
        # VIEW     
        $parent->_view('project.form.price', $data);    	
	}
	  
	public function edit_code($parent)
    {      	
    	# DB
        $data	=	mvc_model('model.project')->select($_GET['id']);          
        $data['row.form.project.site']	=	mvc_model('model.project_site')->get_row_edit($_GET['id']);          
       	#$data['option_user_status_bullet']		=	($data['option_user_status_id'] == 1) ? 'paid' : 'attention'; 
        #$data['option_user_status_font']		=	($data['option_user_status_id'] == 1) ? 'color_green' : 'color_red';         
        # VIEW
        $parent->_view('project.form.site', $data);                
    }
   
    
#----------------------- Form Actions

	public function edit_code_submit($parent)
    {      	
    	mvc_model('model.project_site')->update_code($_POST['project_site']);
    	header_location("/edp_inventory/edp_inventory_project/site/&id={$_POST['project_id']}");
    }
	
	public function submit()
	{	
		$id 	=	string_clean_number($_POST['id']);		
		if($id) # Update
		{			
			mvc_model('model.project')->update($_POST, $id);	
			mvc_model('model.remark')->insert($_POST['remark']);
			header_location("/edp_inventory/edp_inventory_project/profile/&id={$id}");
		}
		else # Insert
		{       			
			$project						=	mvc_model('model.project')->insert($_POST);
			$remark							=	$_POST['remark'];
			$remark['int']['remark_key_id']	=	$project['project_id'];
			mvc_model('model.remark')->insert($remark);
			header_location('/edp_inventory/edp_inventory_project');
		}		
	}
	 
	public function submit_price()
	{
						mvc_model('model.project')->insert_project_price($_POST);	
		$lot_rows	=	mvc_model('model.lot')->price_adjust($_POST);
		# Remark
		$remark						=	$_POST['remark'];			
										mvc_model('model.remark')->insert($_POST['remark']);
		foreach($lot_rows as $row)
		{
			$remark['int']['remark_key_id']	=	$row['lot_id'];
			$remark['str']['remark_key']	=	'lot';
			mvc_model('model.remark')->insert($remark);	
		}			
		header_location("/edp_inventory/edp_inventory_project/price/&id={$_POST['id']}");
	}
	
	public function submit_remark($parent)
	{
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/edp_inventory/edp_inventory_project/remark/&id={$_POST['project_id']}");
	}
	
	
	public function delete()
	{	
		mvc_model('model.user')->delete($_GET['id']);
		header_location('/edp_cms/edp_cms_user');
	}
	
	
   
}
