<?php
class wes_account_client
{
    
    public function __construct()
    {    	
       $this->controller_id = 'wes_account_client';             
    }
    
    public function index($parent)
    {        
        # VIEW
        $parent->_view('client', $data);
    } 
    
    
     public function create_wes_account($parent)
    {        
        # VIEW - side nav
        $side_nav['cwa.class']                 =    'bold';             
        $side_nav['client_account_id']         =    5;                   
        $data['side_nav']                      =    view_get_template($parent->controller_id.'/template/side.client', $side_nav);          
        # VIEW
        $parent->_view('client.create_wes_account', $data);
    }
     


	
	

	
	

	
	
	
	
   
}