<?php 
class edp_cms_system
{
    
    public function __construct()
    {    	
       $this->controller_id = 'edp_cms_system';
       
    }
    
    public function index($parent)
    {                   
        # VIEW
        $parent->_view('system', $data);
    }    
   
    

#----------------------- Form Pages	

	public function global_setting($parent)
    {      	
    	# DB
        $data	=	mvc_model('model.sysglobal')->select('global');          
        # VIEW
        $parent->_view('system.form.global', $data);        
    }
      
    
#----------------------- Form Actions

	public function submit()
	{		
		mvc_model('model.sysglobal')->update($_POST);      
		header_location('/edp_cms/edp_cms_system/global_setting');				
	}
	    
}