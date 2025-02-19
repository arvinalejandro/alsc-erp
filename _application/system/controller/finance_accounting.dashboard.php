<?php
class finance_accounting_dashboard
{
    
    public function __construct()
    {    	
       $this->controller_id = 'finance_accounting_dashboard';             
    }
    
    public function index($parent)
    {   
        # VIEW
        $this->overview($parent);
    }
    
    public function overview($parent)
    {   
        # VIEW
        $parent->_view('dashboard.overview', $data);
    } 
    
     public function official_receipt($parent)
    {   
        # VIEW
        $parent->_view('dashboard.official_receipt', $data);
    }
    
     public function collection_receipt($parent)
    {   
        # VIEW
        $parent->_view('dashboard.collection_receipt', $data);
    }
    
     public function ca_receipt($parent)
    {   
        # VIEW
        $parent->_view('dashboard.ca_receipt', $data);
    }
    
     
    
    
 
     


	 
	

	
	

	
	
	
	
   
}