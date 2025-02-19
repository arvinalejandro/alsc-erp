<?php
class edp_client_inventory
{
    
    public function __construct()
    {    	
       $this->controller_id = 'edp_client_inventory';
       
    }
     
    public function index($parent)
    {           
        # DB
       	$data['row.lot']	=	mvc_model('model.lot')->get_client_row();        
        # VIEW
        $parent->_view('inventory', $data);
    } 
    
      
    public function client($parent)
    {           
    	# DB
    	$data					=	mvc_model('model.lot')->select($_GET['id']);   	
    	$data['row']			=	mvc_model('model.client_account')->get_lot_account($_GET['id']);
        # VIEW - side nav
        $side_nav['client.class']		=	'bold';         	
       	$side_nav['lot_id']				=	$data['lot_id'];         	
       	$data['side_nav']				=	view_get_template($parent->controller_id.'/template/side.inventory', $side_nav);       
        # VIEW
        $parent->_view('inventory.client', $data);
    } 
     
    public function profile($parent)
    {      	
    	# DB
        $data									=	mvc_model('model.lot')->select($_GET['id']);         
        $data['option_availability_class']		=	($data['option_availability_id'] == 1) ? 'color_green' : 'color_red';
        $data['option_availability_bullet']		=	($data['option_availability_id'] == 1) ? 'paid' : 'attention';
        #hash_dump($data, 1);
        # VIEW - side nav
        $side_nav['profile.class']		=	'bold';         	
       	$side_nav['lot_id']				=	$data['lot_id'];         	
       	$data['side_nav']				=	view_get_template($parent->controller_id.'/template/side.inventory', $side_nav);           
        # VIEW
        $parent->_view('inventory.profile', $data);  
 	}  
 

#----------------------- Form Pages	

	
	public function remark($parent)
    {      	
    	# DB
        $data							=	mvc_model('model.lot')->select($_GET['id']);            
        $data['row.lot.remark']			=	mvc_model('model.remark')->get_row('lot', $_GET['id']);            
       
        # VIEW - side nav
        $side_nav['remark.class']		=	'bold';         	
       	$side_nav['lot_id']				=	$data['lot_id'];         	
       	$data['side_nav']				=	view_get_template($parent->controller_id.'/template/side.inventory', $side_nav);           
        # VIEW
        $parent->_view('inventory.remark', $data);      
    }   
    
    
#----------------------- Form Actions

	public function submit_remark($parent)
	{
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/edp_inventory/edp_inventory_lot/remark/&id={$_POST['lot_id']}");
	} 
	
	
   
}