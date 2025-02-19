<?php
class sales_sales_director
{
    
    public function __construct()
    {    	
    	$this->sub_method				        =	$_GET['_1'];
       	$this->controller_id 			        = 	'sales_director';
       	$this->user						        =	mvc_model('model.user')->select($_SESSION['user_id']);     
         	
    }
    
    public function index($parent)
    {          
        # DB
        $data['row.director']                    =    mvc_model('model.sales_agent')->select_all_director();
        $side_nav['sales_director.class']        =    'bold';  
        $data['side_nav']                		 =    view_get_template($parent->controller_id.'/template/side.new_scheme', $side_nav);
        # VIEW
        $parent->_view('sales_director', $data);        
    }
    
    
    public function profile($parent)
    {          
        # DB
        $id                                      =    $_GET['id']*1;
		$data['profile.agent']                   =    mvc_model('model.sales_agent')->select_agent($id);
		$data['count.agent']                     =    mvc_model('model.sales_agent_agent')->count_agents_by_director($id);
		$data['count.manager']                   =    mvc_model('model.sales_agent_agent')->count_agents_by_head($id);
		$data['sales']						     =    mvc_model('model.sales_commission_account')->get_total_sales($id,"all");    
		$data['backout']                         =    mvc_model('model.sales_commission_account')->get_total_sales($id,"ejected");
		$data['paidup']			   	             =    mvc_model('model.sales_commission_account')->get_total_paidup($id,"all");
		$data['lot_count']			   	         =    mvc_model('model.sales_agent_lot')->count_hold_sold($id);
		//hash_dump($data['lot_count'] ,1);
        # VIEW - side nav
        $side_nav['profile.id']                  =    $id;
        $side_nav['profile.class']               =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.sales_director', $side_nav);                       
        # VIEW
        $parent->_view('sales_director.profile', $data);        
    }
    
    public function sales_managers($parent)
    {          
        # DB
        $id                                      =    $_GET['id']*1;
        $data                                    =    mvc_model('model.sales_agent')->select_agent($id,1);
        $data['row.sales_man']                   =    mvc_model('model.sales_agent_agent')->select_managers_by_sales_director($id);
        # VIEW - side nav
        $side_nav['profile.id']                  =    $id;
        $side_nav['sales_managers.class']        =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.sales_director', $side_nav);                       
        # VIEW
        $parent->_view('sales_director.managers', $data);        
    }
    
     public function remarks($parent)
    {          
        # DB
        $id                                                   =    $_GET['id']*1;
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row('sales_agent', $id);
        //hash_dump($id,true);
        # VIEW - side nav
        $side_nav['remarks.class']                            =    'bold';
        $side_nav['profile.id']                               =    $id; 
        $data['a_id']                                         =    $id;             
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.sales_director', $side_nav);                       
        # VIEW
        $parent->_view('sales_director.remark', $data);        
    }
    
	
 #----------------------- Form Actions

  
     public function remove_sales_manager($parent)
    {
        $id                                              =    $_GET['id']*1;
        $sm_id                                           =    $_GET['sm_id']*1;
         mvc_model('model.agent_sales_manager')->delete($sm_id,'sales_manager_id');
		 mvc_model('model.agent_sales_director')->delete($sm_id);
		//update director quota
		$director_quota    									  =  mvc_model('model.agent_sales_manager')->get_director_quota($id);
		$update_director_agent['int']['agent_monthly_quota']  =  $director_quota;
		$update_director_quota			    				  =  mvc_model('model.agent')->update($update_director_agent,$id);
        header_location("/sales/sales_manager/profile/&id={$id}");
    }
    
    
 	
     public function submit_remark($parent)
    {
        $id                                             =    $_POST['a_id'];
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $id;
        mvc_model('model.remark')->insert($remark);                    
        header_location("/sales/sales_director/remarks/&id={$id}");
    }
   
 
    
    
}