<?php
class finance_accounting_accounting_report
{
    
    public function __construct()
    {    	
       $this->controller_id = 'finance_accounting_accounting_report';             
    }
    
    public function index($parent)
    {   
        # VIEW
        $parent->_view('accounting_report', $data);
    } 
    
    
    public function trial_balance_cr_disbursement($parent)
    {          
        # DB
        $data['row.report']									 =    mvc_model('model.account_payable_item_detail')->select_jv_summary();
        # VIEW - side nav
        $side_nav['trial_balance_cr_disbursement.class']     =    'bold';             
        $data['side_nav']                                    =    view_get_template($parent->controller_id.'/template/side.accounting_report.trial_balance_cr_disbursement', $side_nav);               
        # VIEW
        $parent->_view('accounting_report.trial_balance_cr_disbursement', $data);        
    }
    
    public function cash_flow_yearly($parent)
    {          
        # DB
        
        # VIEW - side nav
        $side_nav['cash_flow_yearly.class']     =    'bold';             
        $data['side_nav']                                    =    view_get_template($parent->controller_id.'/template/side.accounting_report.trial_balance_cr_disbursement', $side_nav);               
        # VIEW
        $parent->_view('accounting_report.cash_flow_yearly', $data);        
    }
    
    public function cash_flow_monthly($parent)
    {          
        # DB
        
        # VIEW - side nav
        $side_nav['cash_flow_monthly.class']     =    'bold';             
        $data['side_nav']                                    =    view_get_template($parent->controller_id.'/template/side.accounting_report.trial_balance_cr_disbursement', $side_nav);               
        # VIEW
        $parent->_view('accounting_report.cash_flow_monthly', $data);        
    }
     
    public function water_expenses($parent)
    {          
        # DB
        
        # VIEW - side nav
        $side_nav['water_expenses.class']     =    'bold';             
        $data['side_nav']                                    =    view_get_template($parent->controller_id.'/template/side.accounting_report.trial_balance_cr_disbursement', $side_nav);               
        # VIEW
        $parent->_view('accounting_report.water_expenses', $data);        
    }
	
    public function tax_commission($parent)
    {          
        # DB
        
        # VIEW - side nav
        $side_nav['tax_commission.class']     =    'bold';             
        $data['side_nav']                                    =    view_get_template($parent->controller_id.'/template/side.accounting_report.trial_balance_cr_disbursement', $side_nav);               
        # VIEW
        $parent->_view('accounting_report.tax_commission', $data);        
    }
    
    public function non_tax_commission($parent)
    {          
        # DB
        
        # VIEW - side nav
        $side_nav['non_tax_commission.class']     =    'bold';             
        $data['side_nav']                                    =    view_get_template($parent->controller_id.'/template/side.accounting_report.trial_balance_cr_disbursement', $side_nav);               
        # VIEW
        $parent->_view('accounting_report.non_tax_commission', $data);        
    }
	
    public function cash_receipt($parent)
    {          
        # DB
        
        # VIEW - side nav
        $side_nav['cash_receipt.class']     =    'bold';             
        $data['side_nav']                                    =    view_get_template($parent->controller_id.'/template/side.accounting_report.trial_balance_cr_disbursement', $side_nav);               
        # VIEW
        $parent->_view('accounting_report.cash_receipt', $data);        
    }
    
    

	                                                      
	
   
}