<?php
class sales_sales_manager
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'sales_manager';
       	$this->user						=	mvc_model('model.user')->select($_SESSION['user_id']);     
         	
    }
    
    public function index($parent)
    {          
        # DB
        $data['row.manager']           			 =    mvc_model('model.sales_agent')->select_all_manager();  
        $side_nav['sales_manager.class']         =    'bold';  
        $data['side_nav']                		 =    view_get_template($parent->controller_id.'/template/side.new_scheme', $side_nav);                     
        # VIEW
        $parent->_view('sales_manager', $data);        
    }
    
     public function profile($parent)
    {          
        # DB
        $id                                      =    $_GET['id'];
        $data['profile.agent']                   =    mvc_model('model.sales_agent')->select_agent($id);
		$data['profile.director']                =    mvc_model('model.sales_agent_agent')->get_head_by_under($id);
		$data['count.agent']                     =    mvc_model('model.sales_agent_agent')->count_agents_by_head($id);
		$data['sales']						     =    mvc_model('model.sales_commission_account')->get_total_sales($id,"all");    
		$data['backout']                         =    mvc_model('model.sales_commission_account')->get_total_sales($id,"ejected");
		$data['paidup']			   	             =    mvc_model('model.sales_commission_account')->get_total_paidup($id,"all");
		$data['lot_count']			   	         =    mvc_model('model.sales_agent_lot')->count_hold_sold($id);
		//hash_dump($data['count.manager'] ,1);
		//hash_dump($data['lot_count'] ,1);
        # VIEW - side nav
        $side_nav['profile.id']                  =    $id; 
        $side_nav['profile.class']               =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.sales_manager', $side_nav);                       
        # VIEW
        $parent->_view('sales_manager.profile', $data);        
    }
    
    public function agents($parent)
    {          
        # DB
        $id                                      =    $_GET['id']*1;
        $data                                    =    mvc_model('model.sales_agent')->select_agent($id,1);
        $data['row.agent']                       =    mvc_model('model.sales_agent_agent')->select_agents_by_manager($id);
        # VIEW - side nav
        $side_nav['profile.id']                  =    $id;
        $side_nav['agents.class']        =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.sales_manager', $side_nav);                       
        # VIEW
        $parent->_view('sales_manager.agents', $data);        
    }
    
    public function remarks($parent)
    {          
        # DB
        $id                                                   =    $_GET['id'];
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row('sales_agent', $id);
        # VIEW - side nav
        $side_nav['remarks.class']                            =    'bold';
        $side_nav['profile.id']                               =    $id; 
        $data['a_id']                                         =    $id;             
        $data['side_nav']                       			  =    view_get_template($parent->controller_id.'/template/side.sales_manager', $side_nav);                       
        # VIEW
        $parent->_view('sales_manager.remark', $data);        
    }
    
   
 
  #----------------------- Form Actions

  
    public function remove_agent($parent)
    {
        $id                                              =    $_GET['id']*1;
        $a_id                                            =    $_GET['a_id']*1;
        mvc_model('model.agent_sales_manager')->delete($a_id);
		 //update manager quota
		$manager_quota    									  =  mvc_model('model.agent_sales_manager')->get_manager_quota($id);
		$update_manager_agent['int']['agent_monthly_quota']	  =  $manager_quota;
		$update_manager_quota			    				  =  mvc_model('model.agent')->update($update_manager_agent,$id);
        header_location("/sales/sales_manager/profile/&id={$id}");
    }
    
    
     public function submit_remark($parent)
    {
        $id                                             =    $_POST['a_id'];
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $id;
        mvc_model('model.remark')->insert($remark);                    
        header_location("/sales/sales_manager/remarks/&id={$id}");
    }
     
 
    
}