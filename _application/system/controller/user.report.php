<?php
class user_report
{
    
    public function __construct()
    {    	
       $this->controller_id = 'user_report';
       
    }
    
    public function index($parent)
    {      	
    	# DB       
        $data['row.user.report']		=	mvc_model('model.report')->get_user_report($parent->user['user_id'], $parent->controller_id);
        # View - header
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';        
        # View
        $parent->_view('report', $data);
    }   
    
    
}   