<?php
class finance_accounting
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'finance_accounting';
       	$this->user						=	session_check();
       
       	
    }
    
    public function index()
    {      	
       	$this->dashboard();
    }
    
    public function dashboard()
    {   	
       	mvc_controller('finance_accounting.dashboard', $this->sub_method, $this); 
    }
    
    public function transaction_or()
    {   	
       	mvc_controller('finance_accounting.transaction_or', $this->sub_method, $this); 
    }
    
    public function transaction_cr()
    {       
        mvc_controller('finance_accounting.transaction_cr', $this->sub_method, $this); 
    }
    
    
    public function journal_entry()
    {       
        mvc_controller('finance_accounting.journal_entry', $this->sub_method, $this); 
    }
    
    public function reconciliation()
    {       
        mvc_controller('finance_accounting.reconciliation', $this->sub_method, $this); 
    }
    
    public function transaction_car()
    {       
        mvc_controller('finance_accounting.transaction_car', $this->sub_method, $this); 
    }
     
    public function reporting_tool()
    {       
        mvc_controller('finance_accounting.reporting_tool', $this->sub_method, $this); 
    }
      
    public function accounting_report()
    {       
        mvc_controller('finance_accounting.accounting_report', $this->sub_method, $this); 
    } 
    
     public function bank_transaction()
    {       
        mvc_controller('finance_accounting.bank_transaction', $this->sub_method, $this); 
    }  
    
     public function add_chart()
    {       
        mvc_controller('finance_accounting.add_chart', $this->sub_method, $this); 
    } 
    
    
    public function accounting_report_form()
    {       
        mvc_controller('finance_accounting.accounting_report_form', $this->sub_method, $this); 
    }  

  
		 
	#----------------------- VIEW
	
	public function _view($view, $data = array())
    {    	
    	
    	$current						=	($_GET['application']) ? $_GET['application'] : 'dashboard';
    	$header[$current]				=	'<i></i>';
    	$header["{$current}_class"]		=	'class="active"';
    	$data['header.navigation']		=	view_get_template($this->controller_id."/include/header", $header, true);
    	$data['_user_']					=	$this->user;
    	$data['header_title']			=	"Finance - Accounting";
    	$data['emblem']					=	view_get_template($this->controller_id."/include/emblem");
    	mvc_set_var($data);       
        mvc_view('_include/header');        
        mvc_view($this->controller_id."/{$view}");
        mvc_view('_include/footer');        
	}
    
    
}