<?php
class user_module
{
    
    public function __construct()
    {    	
       $this->controller_id = 'user_module';
       
    }
    
    public function index($parent)
    {      	
    	# DB       
        $data['row.user.module']		=	mvc_model('model.module')->get_user_module($parent->user['user_id'], $parent->controller_id);
        # View - header
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';        
        # View
        $parent->_view('module', $data);
    }      
    
    
}