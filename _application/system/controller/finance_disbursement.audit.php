<?php
class finance_disbursement_audit
{
    
     public function __construct()
    {        
       $this->controller_id = 'finance_disbursement_audit';             
    }
    
    public function index($parent)
    {   
        # VIEW
        $parent->_view('pending_audit', $data);
    }
    
     public function test($parent)
    {   
        # VIEW
        $parent->_view('scheme_test', $data);
    }
    
     public function profile($parent)
    {          
        # DB
        
        # VIEW - side nav
        $side_nav['profile.class']               =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.pending_audit', $side_nav);                       
        # VIEW
        $parent->_view('pending_audit.profile', $data);        
    }
    
     public function remarks($parent)
    {          
        # DB
        
        # VIEW - side nav
        $side_nav['profile.class']               =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.pending_audit', $side_nav);                       
        # VIEW
        $parent->_view('remarks', $data);        
    }
    
    
}