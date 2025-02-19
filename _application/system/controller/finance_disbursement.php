<?php
class finance_disbursement
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'finance_disbursement';
       	$this->user						=	session_check();
       
       	
    }
    
    public function index()
    {      	
       	$this->completed();
    }
    
    public function accounting_categorize()
    {   	
       	mvc_controller('finance_disbursement.accounting_categorize', $this->sub_method, $this); 
    }
    
     public function accounting_reconciliation()
    {       
           mvc_controller('finance_disbursement.accounting_reconciliation', $this->sub_method, $this); 
    }
    
    public function treasury_cheque_details()
    {   	
       	mvc_controller('finance_disbursement.treasury_cheque_details', $this->sub_method, $this); 
    }
    
    public function treasury_cheque_release()
    {       
           mvc_controller('finance_disbursement.treasury_cheque_release', $this->sub_method, $this); 
    }
    
    public function department_head()
    {       
        mvc_controller('finance_disbursement.department_head', $this->sub_method, $this); 
    }
    
     public function executive_approval()
    {       
        mvc_controller('finance_disbursement.executive_approval', $this->sub_method, $this); 
    }
    
     public function executive_signatory()
    {       
        mvc_controller('finance_disbursement.executive_signatory', $this->sub_method, $this); 
    }
    
     public function request()
    {       
        mvc_controller('finance_disbursement.request', $this->sub_method, $this); 
    }
    
     public function completed()
    {       
        mvc_controller('finance_disbursement.completed', $this->sub_method, $this); 
    }
    
      public function audit()
    {       
        mvc_controller('finance_disbursement.audit', $this->sub_method, $this); 
    }
    
     public function marketing_commission()
    {       
        mvc_controller('finance_disbursement.marketing_commission', $this->sub_method, $this); 
    }
    
    public function liquidate()
    {       
        mvc_controller('finance_disbursement.liquidate', $this->sub_method, $this); 
    }
    
    public function ofv()
    {       
        mvc_controller('finance_disbursement.ofv', $this->sub_method, $this); 
    }
    
   
    
  
		 
		 
	#----------------------- VIEW
	
	public function _view($view, $data = array())
    {    	
    	
    	$current						=	($_GET['application']) ? $_GET['application'] : 'completed';
    	$header[$current]				=	'<i></i>';
    	$header["{$current}_class"]		=	'class="active"';
    	$data['header.navigation']		=	view_get_template($this->controller_id."/include/header", $header, true);
    	$data['_user_']					=	$this->user;
    	$data['header_title']			=	"Finance - Disbursement";
    	$data['emblem']					=	view_get_template($this->controller_id."/include/emblem");
    	mvc_set_var($data);       
        mvc_view('_include/header');        
        mvc_view($this->controller_id."/{$view}");
        mvc_view('_include/footer');        
	}
    
    
}