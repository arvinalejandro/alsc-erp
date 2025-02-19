<?php
class finance_accounting_transaction_car
{
    
    public function __construct()
    {    	
       $this->controller_id = 'finance_accounting_transaction_car';             
    }
    
    public function index($parent)
    {   
        # VIEW
        $parent->_view('transaction_car', $data);
    } 
    
    public function profile($parent)
    {          
        # DB
        
        # VIEW - side nav
        $side_nav['profile.class']               =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.transaction_car', $side_nav);                       
        # VIEW
        $parent->_view('transaction_car.profile', $data);        
    } 
    
    public function breakdown($parent)
    {          
        # DB
        
        # VIEW - side nav
        $side_nav['invoice.class']               =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.transaction_car', $side_nav);                       
        # VIEW
        $parent->_view('transaction_car.breakdown', $data);        
    } 
    
    
    public function remark($parent)
    {
        # DB
       
        # VIEW - side nav
        $side_nav['remark.class']                =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.transaction_car', $side_nav);             
        # VIEW
        $parent->_view('transaction_car.remark', $data);      
    }
 
      


	
	

	
	 

	
	
	
	
   
}