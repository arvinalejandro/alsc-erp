<?php
class finance_accounting_accounting_report_form
{
    
    public function __construct()
    {    	
       $this->controller_id = 'finance_accounting_accounting_report_form';             
    }
    
    public function index($parent)
    {   
        # VIEW
        $parent->_view('accounting_report', $data);
    } 
    
    public function trial_balance()
    {
        mvc_view('finance_accounting/form/trial_balance');
    }
    
    public function cash_flow_yearly()
    {
        mvc_view('finance_accounting/form/cash_flow_yearly');
    }
  
	public function cash_flow_monthly()
    {
        mvc_view('finance_accounting/form/cash_flow_monthly');
    }         
    
    public function water_expenses()
    {
        mvc_view('finance_accounting/form/water_expenses');
    }      
    
    public function tax_commission()
    {
        mvc_view('finance_accounting/form/tax_commission');
    }           
    
    public function non_tax_commission()
    {
        mvc_view('finance_accounting/form/non_tax_commission');
    }                                    
	
    public function cash_receipt()
    {
        mvc_view('finance_accounting/form/cash_receipt');
    }   
}