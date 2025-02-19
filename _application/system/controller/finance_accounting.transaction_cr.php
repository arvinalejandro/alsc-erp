<?php
class finance_accounting_transaction_cr
{
    
    public function __construct()
    {    	
       $this->controller_id = 'finance_accounting_transaction_cr';             
    }
    
    public function index($parent)
    {   
        # VIEW
        $parent->_view('transaction_cr', $data);
    } 
     
    
    public function profile($parent)
    {          
        # DB
        
        # VIEW - side nav
        $side_nav['profile.class']               =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.transaction_cr', $side_nav);                       
        # VIEW
        $parent->_view('transaction_cr.profile', $data);        
    } 
    
    public function breakdown($parent)
    {          
        # DB
        
        # VIEW - side nav
        $side_nav['invoice.class']               =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.transaction_cr', $side_nav);                       
        # VIEW
        $parent->_view('transaction_cr.breakdown', $data);        
    } 
    
    
    public function remark($parent)
    {
        # DB
       
        # VIEW - side nav
        $side_nav['remark.class']                =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.transaction_cr', $side_nav);             
        # VIEW
        $parent->_view('transaction_cr.remark', $data);      
    }
    
    
     public function settings($parent)
    {
        # DB
       
        # VIEW - side nav
        $side_nav['settings.class']                =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.transaction_cr', $side_nav);             
        # VIEW
        $parent->_view('transaction_cr.settings', $data);      
    }    
     
 

	
	

	 
	

	
	
	
	
   
}