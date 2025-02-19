<?php
class graph_test
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'graph_test';
       	//$this->user						=	mvc_model('model.user')->select($_SESSION['user_id']);     
       
       	
    }
    
  
   
    public function bar()
    {      	
       mvc_view('_include/header');        
        mvc_view($this->controller_id."/bar");
        mvc_view('_include/footer');
    }
    
     public function pie()
    {          
       mvc_view('_include/header');        
        mvc_view($this->controller_id."/pie");
        mvc_view('_include/footer');
    }
    
     public function line()
    {          
       mvc_view('_include/header');        
        mvc_view($this->controller_id."/line");
        mvc_view('_include/footer');
    }
   
    
}