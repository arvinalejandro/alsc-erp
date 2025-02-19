<?php
class finance_accounting_add_chart
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'add_chart';
       	$this->user						=	mvc_model('model.user')->select($_SESSION['user_id']);     
         	
    }

    public function index($parent)
    {          
        
    }
    
    
    public function parent($parent)
    {          
        # DB
        # VIEW
        $parent->_view('create_chart_parent', $data);        
    }
    
     public function child($parent)
    {          
        # DB
        $parent_data                               				=     mvc_model('model.option')->select_option('option_account_chart_parent');
        $data['parent_opt']                         		    =    hash_to_option($parent_data, 'option_account_chart_parent_id','option_account_chart_parent_name');             
        # VIEW
        $parent->_view('create_chart_child', $data);        
    }
    
 
//===============Form Operations==================================    

     public function submit_child($parent)
    {
	    $insert                                                    =  mvc_model('model.option_account_chart_child')->insert($_POST);
        header_location("/finance_accounting/add_chart/child/");
    }
    
     public function submit_parent($parent)
    {
	    $insert                                                    =  mvc_model('model.option_account_chart_parent')->insert($_POST);
        header_location("/finance_accounting/add_chart/parent/");
    }
}    
  
