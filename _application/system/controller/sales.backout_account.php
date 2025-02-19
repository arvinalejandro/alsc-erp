<?php
class sales_backout_account
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'sales_backout_account';
       	$this->user						=	mvc_model('model.user')->select($_SESSION['user_id']);     
         	
    }
    
    public function index($parent)
    {          
        # DB
        $backout_data							  =	   mvc_model('model.client_account')->get_backout_row();
        $data['row.account']					  =	  $backout_data['rows'];
        $data['total_paidup']                    =    mvc_model('model.sales_commission_account')->get_total_paidup(0);
        $sales_cost                               =   mvc_model('model.sales_commission_account')->get_total_sales(0,"all");
        $backout_cost                             =   mvc_model('model.sales_commission_account')->get_total_sales(0,"ejected");
        $data['backout_cost']					  =   $backout_cost['sum'];
        $data['backout_count']					  =   $backout_cost['count'];
        $data['sales_cost']                       =   $sales_cost['sum'];
        # VIEW
        $parent->_view('backout_account', $data);        
    }
    
      public function profile($parent)
    {          
        $id                                      =    $_GET['id'];
        # DB
        $data                   				 =   mvc_model('model.client_account')->select($_GET['id']); 
        # VIEW - side nav
        $side_nav['profile.id']                  =    $id; 
        $side_nav['profile.class']               =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.backout_account', $side_nav);                       
        # VIEW
        $parent->_view('backout_account.profile', $data);        
    }
    
    public function remarks($parent)
    {          
        # DB
        $id                                                   =    $_GET['id'];
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row('client_account', $id);
        $data['client_account_id']                            =    $id;
        # VIEW - side nav
        $side_nav['remarks.class']                            =    'bold';
        $side_nav['ca_id']                              	  =    $id; 
        $data['side_nav']                       			  =    view_get_template($parent->controller_id.'/template/side.backout_account', $side_nav);                       
        # VIEW
        $parent->_view('backout_account.remark', $data);        
    }
    
 //======================
  public function submit_remark($parent)
    {
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $_POST['client_account_id'];
      // hash_dump($remark,true);
        mvc_model('model.remark')->insert($remark);                    
        header_location("/sales/backout_account/remarks/&id={$_POST['client_account_id']}");
    }  
    
}