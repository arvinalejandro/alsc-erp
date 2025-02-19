<?php
class engineering_wes_zone
{
    
    public function __construct()
    {    	
       	$this->controller_id 			= 	'engineering_wes_zone';
    }
 
   public function index($parent)
    {           
        # DB
		$data['row.lot']				=	mvc_model('model.lot')->get_wes_zones();     
        # VIEW
        $parent->_view('zone', $data);
    } 
    
        public function profile($parent)
    {      	
    	# DB
		$data										=	mvc_model('model.lot')->select($_GET['id']);
        # VIEW - side nav
        $side_nav['profile.class']					=	'bold';         	
       	//$side_nav['project_id']					=	$data['project_id'];         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.zone', $side_nav);       
        # VIEW
        $parent->_view('zone.profile', $data);        
    } 
    
     public function water_account($parent)
    {      	
    	# DB

        # VIEW - side nav
        $side_nav['water_account.class']			=	'bold';         	
       	//$side_nav['project_id']					=	$data['project_id'];         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.zone', $side_nav);       
        # VIEW
        $parent->_view('zone.water_account', $data);        
    }
    
     public function electric_account($parent)
    {      	
    	# DB

        # VIEW - side nav
        $side_nav['electric_account.class']			=	'bold';         	
       	//$side_nav['project_id']					=	$data['project_id'];         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.zone', $side_nav);       
        # VIEW
        $parent->_view('zone.electric_account', $data);        
    }
    
    public function garbage_account($parent)
    {      	
    	# DB

        # VIEW - side nav
        $side_nav['garbage_account.class']			=	'bold';         	
       	//$side_nav['project_id']					=	$data['project_id'];         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.zone', $side_nav);       
        # VIEW
        $parent->_view('zone.garbage_account', $data);        
    }
    
    
    public function remark($parent)
    {
    	# DB
       // $data							=	mvc_model('model.project')->select($_GET['id']);            
      //  $data['row.remark']				=	mvc_model('model.remark')->get_row('project', $_GET['id']);            
        # VIEW - side nav
        $side_nav['remark.class']		=	'bold';         	
     //  	$side_nav['project_id']				=	$data['project_id'];         	
       	$data['side_nav']				=	view_get_template($parent->controller_id.'/template/side.zone', $side_nav);           
        # VIEW
        $parent->_view('zone.remark', $data);      
	}
    
 //======================================FORMS
   public function water_provision($parent)
    {      	
    	# DB

        # VIEW - side nav
        $side_nav['water_provision.class']			=	'bold';         	
       	//$side_nav['project_id']					=	$data['project_id'];         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.zone', $side_nav);       
        # VIEW
        $parent->_view('zone.form.water_provision', $data);        
    }
    
    public function electric_provision($parent)
    {      	
    	# DB

        # VIEW - side nav
        $side_nav['electric_provision.class']			=	'bold';         	
       	//$side_nav['project_id']					=	$data['project_id'];         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.zone', $side_nav);       
        # VIEW
        $parent->_view('zone.form.electric_provision', $data);        
    }
    
}