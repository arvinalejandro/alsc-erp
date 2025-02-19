<?php
class finance_accounting_transaction_or
{
    
    public function __construct()
    {    	
       $this->controller_id = 'finance_accounting_transaction_or';             
    }
    
    public function index($parent)
    {   
        # VIEW
        $parent->_view('transaction_or', $data);
    } 
    
    public function profile($parent)
    {          
        # DB
        
        # VIEW - side nav
        $side_nav['profile.class']               =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.transaction_or', $side_nav);                       
        # VIEW
        $parent->_view('transaction_or.profile', $data);        
    } 
    
    public function breakdown($parent)
    {          
        # DB
        
        # VIEW - side nav
        $side_nav['invoice.class']               =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.transaction_or', $side_nav);                       
        # VIEW
        $parent->_view('transaction_or.breakdown', $data);        
    } 
    
    
    public function remark($parent)
    {
        # DB
       
        # VIEW - side nav
        $side_nav['remark.class']                =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.transaction_or', $side_nav);             
        # VIEW
        $parent->_view('transaction_or.remark', $data);      
    } 
 
     


	
	

	 
	

	
	 
	
	
   
}