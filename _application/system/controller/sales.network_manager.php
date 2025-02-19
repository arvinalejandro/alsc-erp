<?php
class sales_network_manager
{
    
    public function __construct()
    {    	
    	$this->sub_method				        =	$_GET['_1'];
       	$this->controller_id 			        = 	'sales_network_manager';
       	$this->user						        =	mvc_model('model.user')->select($_SESSION['user_id']);     
         	
    }
    
    public function index($parent)
    {          
        # DB
        $data['row.network']                      =    mvc_model('model.sales_network')->select_all_network();
        $side_nav['network_manager.class']        =    'bold';  
        $data['side_nav']                		  =    view_get_template($parent->controller_id.'/template/side.old_scheme', $side_nav);                  
        # VIEW
        $parent->_view('network_manager', $data);        
    }
    
    
    public function profile($parent)
    {          
        # DB
        $id                                      =    $_GET['id'];
        $data                                    =    mvc_model('model.sales_network')->select_network($id);
        $data['agent']                           =    mvc_model('model.sales_agent')->select_agent($data['sales_agent_id'],1);
        $data['details']						 =    mvc_model('model.sales_network')->select_all_network_counts($id);
        
        # VIEW - side nav
        $side_nav['profile.id']                  =    $id;
        $side_nav['profile.class']               =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.network_manager', $side_nav);                       
        # VIEW
        $parent->_view('network_manager.profile', $data);        
    }
    
    
    public function divisions($parent)
    {          
        # DB
        $id                                      =    $_GET['id'];
        $data                                    =    mvc_model('model.sales_network')->select_network($id);
        $data['row.division']					 =    mvc_model('model.sales_network_division')->select_all_division_by_network_id($id);
        # VIEW - side nav
        $side_nav['profile.id']                  =    $id;
        $side_nav['profile.class']               =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.network_manager', $side_nav);                       
        # VIEW
        $parent->_view('network_manager.divisions', $data);        
    }
    
 
    public function lots($parent)
    {          
        # DB
        $id                                      =    $_GET['id'];
        $data                                    =    mvc_model('model.sales_network')->select_network($id);
        $data['row.lots']                        =    mvc_model('model.lot')->select_network_lot_row($id);
        # VIEW - side nav
        $side_nav['profile.id']                  =    $id;
        $side_nav['lots.class']                  =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.network_manager', $side_nav);                       
        # VIEW
        $parent->_view('network_manager.lots', $data);        
    }
    
    
    public function remarks($parent)
    {          
        # DB
        $id                                                   =    $_GET['id'];
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row('sales_network', $id);
        # VIEW - side nav
        $side_nav['remarks.class']                            =    'bold';
        $side_nav['profile.id']                               =    $id; 
        $data['a_id']                                         =    $id;            
        $data['side_nav']                        			  =    view_get_template($parent->controller_id.'/template/side.network_manager', $side_nav);                       
        # VIEW
        $parent->_view('network_manager.remark', $data);        
    }
    
    
   
  
    
     public function add_network($parent)
    {          
        # VIEW
        $parent->_view('network_manager.add_network', $data);        
    }
    
     
    
    
#----------------------- Form Actions

   
    public function submit_add_network($parent)
    {
        mvc_model('model.sales_network')->insert($_POST);
        header_location("/sales/network_manager");
    }
    
     public function submit_remark($parent)
    {
        $id                                             =    $_POST['a_id'];
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $id;
        mvc_model('model.remark')->insert($remark);                    
        header_location("/sales/network_manager/remarks/&id={$id}");
    }
 
 
    
    
}