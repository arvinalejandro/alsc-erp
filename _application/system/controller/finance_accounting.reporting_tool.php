<?php
class finance_accounting_reporting_tool
{
    
    public function __construct()
    {    	
       $this->controller_id = 'finance_accounting_reporting_tool';             
    }
    
    public function index($parent)
    {   
        # VIEW
        $parent->_view('reporting_tool', $data);
    } 
    
    
    public function monthly_statement($parent)
    {          
        # DB
        
                         
        # VIEW
        $parent->_view('reporting_tool.monthly_statement', $data);        
    }
    
    
    public function annual_statement($parent)
    {          
        # DB
        
                         
        # VIEW
        $parent->_view('reporting_tool.annual_statement', $data);        
    }
     

     public function journal_voucher($parent)
    {          
        # DB
        
                         
        # VIEW
        $parent->_view('reporting_tool.journal_voucher', $data);        
    }
	
	 

	
	 

	
	
	
	
   
}