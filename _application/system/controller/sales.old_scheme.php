<?php
class sales_old_scheme
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'sales_old_scheme';
       	$this->user						=	mvc_model('model.user')->select($_SESSION['user_id']);     
         	
    }
    
    public function index($parent)
    {      	
       //	$this->agents();
      // $data['side_nav']                =    view_get_template($parent->controller_id.'/template/side.group', $side_nav);
      // $parent->_view('group', $data);
      header_location("/sales/network_manager/"); 
    }
    
 /*
    public function network_manager()
    {       
          header_location("/sales/network_manager/");
    }
    
  
     public function division()
    {       
           header_location("/sales/division/");
    }
        
    public function sales_manager()
    {       
            header_location("/sales/sales_manager/");
    }
    
    public function sales_director()
    {       
           header_location("/sales/sales_director/");
    }
    
   */
		 
		 
	
    
    
}