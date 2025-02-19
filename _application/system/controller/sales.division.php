<?php
class sales_division
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'sales_division';
       	$this->user						=	mvc_model('model.user')->select($_SESSION['user_id']);     
         	
    }
    
    public function index($parent)
    {          
        # DB
        $data['row.division']          			 =    mvc_model('model.sales_network_division')->select_all_division();
        $side_nav['division.class']        		 =    'bold';  
        $data['side_nav']                		 =    view_get_template($parent->controller_id.'/template/side.old_scheme', $side_nav);                      
        # VIEW
        $parent->_view('division', $data);        
    }
    
     public function profile($parent)
    {          
        # DB
        $id                                      =    $_GET['id'];
        $data                                    =    mvc_model('model.sales_network_division')->select_division($id);
        $data['n_d']                			 =    mvc_model('model.sales_network_division')->select_division_network($data['sales_network_division_id']);
        $data['agent']                           =    mvc_model('model.sales_agent')->select_agent($data['sales_agent_id'],1);
         $data['details']						 =    mvc_model('model.sales_network_division')->select_all_division_counts($id);
        # VIEW - side nav
        $side_nav['profile.id']                  =    $id; 
        $side_nav['profile.class']               =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.division', $side_nav);                       
        # VIEW
        $parent->_view('division.profile', $data);        
    }
    
     public function agents($parent)
    {          
        # DB
        $id                                      =    $_GET['id'];
        $data                                    =    mvc_model('model.sales_network_division')->select_division($id);
        $data['row.agents']                      =    mvc_model('model.sales_agent')->select_all_agent_by_division($id);
        # VIEW - side nav
        $side_nav['profile.id']                  =    $id;
        $side_nav['agents.class']                =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.division', $side_nav);                       
        # VIEW
        $parent->_view('division.agents', $data);        
    }
    
     public function lots($parent)
    {          
        # DB
        $id                                      =    $_GET['id'];
        $data                                    =    mvc_model('model.sales_network_division')->select_division($id);
        $data['row.lots']                        =    mvc_model('model.lot')->select_division_lot_row($id);
        $data['nd_id']                        	 =    $id;
        # VIEW - side nav
        $side_nav['profile.id']                  =    $id;
        $side_nav['lots.class']                  =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.division', $side_nav);                       
        # VIEW
        $parent->_view('division.lots', $data);        
    }
    
     public function remarks($parent)
    {          
       # DB
        $id                                                   =    $_GET['id'];
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row('sales_network_division', $id);
        # VIEW - side nav
        $side_nav['remarks.class']                            =    'bold';
        $side_nav['profile.id']                               =    $id; 
        $data['a_id']                                         =    $id;            
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.division', $side_nav);                       
        # VIEW
        $parent->_view('division.remark', $data);        
    }
    
     public function add($parent)
    {          
        # DB
        $network                                 =    mvc_model('model.option')->select_option('sales_network', 'ORDER BY sales_network_name ASC');
        # VIEW - side nav
        $side_nav['profile.id']                  =    $id;
        $side_nav['lots.class']                  =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.division', $side_nav);                    
        # VIEW
        $data['network']                         =    hash_to_option($network, 'sales_network_id', 'sales_network_name');
        $parent->_view('division.add', $data);        
    }
    
 #----------------------- Form Actions

    public function submit_add_division($parent)
    {
        mvc_model('model.sales_network_division')->insert($_POST);
        header_location("/sales/division");
    }
    
     public function submit_remark($parent)
    {
        $id                                             =    $_POST['a_id'];
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $id;
        mvc_model('model.remark')->insert($remark);                    
        header_location("/sales/division/remarks/&id={$id}");
    } 
    
    
}