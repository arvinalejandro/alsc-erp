<?php
class wes_account_account
{
    
    public function __construct()
    {    	
       $this->controller_id = 'wes_account_account';             
    }
    
    public function index($parent)
    {   
        # VIEW
        $parent->_view('account', $data);
    } 
    
    
     public function emr($parent)
    {        
     
        # VIEW - side nav
        $side_nav['emr.class']                 =    'bold';             
        $side_nav['client_account_id']         =    5;                   
        $data['side_nav']                      =    view_get_template($parent->controller_id.'/template/side.account', $side_nav);          
        # VIEW
        $parent->_view('account.emr', $data);
    } 
    
    
    public function wmr($parent)
    {        
 
        # VIEW - side nav
        $side_nav['wmr.class']                =    'bold';             
        $side_nav['client_account_id']        =    5;                   
        $data['side_nav']                     =    view_get_template($parent->controller_id.'/template/side.account', $side_nav);          
        # VIEW
        $parent->_view('account.wmr', $data);
    }
    
    
     public function letter($parent)
    {        
        # VIEW - side nav
        $side_nav['letter.class']             =    'bold';             
        $side_nav['client_account_id']        =    5;                   
        $data['side_nav']                     =    view_get_template($parent->controller_id.'/template/side.account', $side_nav);          
        # VIEW
        $parent->_view('account.letter', $data);
    }  
    
     public function remark($parent)
    {        
        # VIEW - side nav
        $side_nav['remark.class']             =    'bold';             
        $side_nav['client_account_id']        =    5;                   
        $data['side_nav']                     =    view_get_template($parent->controller_id.'/template/side.account', $side_nav);          
        # VIEW
        $parent->_view('account.remark', $data);
    } 
     


	
	

	
	

	
	
	
	
   
}