<?php
class preview
{
    
    public function __construct()
    {
    }
    
    public function index()
    {
        mvc_view('login');
    }
     
    public function login()
    {
        mvc_view('preview/login');
    }
    
    public function dashboard()
    {
        mvc_view('preview/dashboard');
    }
    
        public function new_client()
        {
            mvc_view('preview/new_client');
        }
    
    
    /********************
        BUYER DETAILS
    ********************/
    
    public function buyer_details()
    {
        mvc_view('preview/buyer_details');
    }
    
        public function buyer_details_pop()
        {
            mvc_view('preview/buyer_details_pop');
        }
    
    public function buyer_details_account()
    {
        mvc_view('preview/buyer_details_account');
    }
    
        public function buyer_details_account_pop()
        {
            mvc_view('preview/buyer_details_account_pop');
        }
        
    public function buyer_details_payment_pop()
    {
        mvc_view('preview/buyer_details_payment_pop');
    }
        
    
    public function template()
    {
        mvc_view('preview/temp');
    }
    
    public function form_v()
    {
        mvc_view('preview/form_v');
    }
    
    public function form_h()
    {
        mvc_view('preview/form_h');
    }
    
    public function clients()
    {
        mvc_view('preview/clients_list');
    }
    
    public function client_a()
    {
        mvc_view('preview/client_a');
    }
    
    
    public function payment()
    {
        mvc_view('preview/payment');
    }
    
    public function soa()
    {
        mvc_view('preview/soa');
    }
    
    public function popup()
    {
        mvc_view('preview/popup');
    }
    
    public function mizel()
    {
        mvc_view('preview/mizel');
        
    }
    
    public function form()
    {    	
		 mvc_view('preview/form/form');
	}
	
        public function form_reservation_application()
        {        
             mvc_view('preview/form/reservation_application');
        }
        
	    public function form_thankyou()
        {    	
             $data['header_standard']     =   view_get_template('preview/form/_header_standard');
             $this->_view('/form/thankyou', $data);
	    }
        
        public function form_contract_to_sell()
        {        
             mvc_view('preview/form/contract_to_sell');
        }
        
        public function form_reservation_notice()
        {        
             $data['header_standard']     =   view_get_template('preview/form/_header_standard');
             $this->_view('/form/reservation_notice', $data);
        }
        
        public function form_demand_first()
        {        
             $data['header_standard']     =   view_get_template('preview/form/_header_standard');
             $this->_view('/form/demand_first', $data);
        }
    
        public function form_demand_final()
        {        
            $data['header_standard']     =   view_get_template('preview/form/_header_standard');
            $this->_view('/form/demand_final', $data);
        }
        
        public function form_cancellation_with_refund()
        {        
            $data['header_standard']     =   view_get_template('preview/form/_header_standard');
            $this->_view('/form/cancellation_with_refund', $data);
        }
        
        public function form_cancellation_without_refund()
        {        
            $data['header_standard']     =   view_get_template('preview/form/_header_standard');
            $this->_view('/form/cancellation_without_refund', $data);
        }
        
        public function form_ejectment()
        {        
            $data['header_standard']     =   view_get_template('preview/form/_header_standard');
            $this->_view('/form/ejectment', $data);
        }
        
        public function form_for_retention()
        {        
            $data['header_standard']     =   view_get_template('preview/form/_header_standard');
            $this->_view('/form/retention_for', $data);
        }
        
        public function form_first_retention()
        {        
            $data['header_standard']     =   view_get_template('preview/form/_header_standard');
            $this->_view('/form/retention_first', $data);
        }
        
        public function form_with_interest_retention()
        {        
            $data['header_standard']     =   view_get_template('preview/form/_header_standard');
            $this->_view('/form/retention_with_interest', $data);
        }
        
        public function form_fully_paid()
        {        
            $data['header_standard']     =   view_get_template('preview/form/_header_standard');
            $this->_view('/form/fully_paid', $data);
        }
        
        public function form_amendment()
        {        
            $data['header_standard']     =   view_get_template('preview/form/_header_standard');
            $this->_view('/form/amendment', $data);
        } 
        
        public function form_restructuring()
        {        
            $data['header_standard']     =   view_get_template('preview/form/_header_standard');
            $this->_view('/form/restructuring', $data);
        }
        
        public function form_amendment_contract_to_sell()
        {        
            mvc_view('preview/form/amendment_contract_to_sell', $data);
        }   
        
        public function form_deed_of_assignment()
        {        
            mvc_view('preview/form/deed_of_assignment', $data);
        }  
        
        public function form_application_voucher()
        {        
            $data['header_standard']     =   view_get_template('preview/form/_header_standard');
            $this->_view('/form/application_voucher', $data);
        }
        
        public function form_request_for_payment()
        {        
            $data['header_standard']     =   view_get_template('preview/form/_header_standard');
            $this->_view('/form/request_for_payment', $data);
        }
        
        public function form_statement_of_account()
        {        
            $data['header_standard']     =   view_get_template('preview/form/_header_standard');
            $this->_view('/form/statement_of_account', $data);
        }     
        
        public function receipt_authority_to_accept_payment()
        {  
            $data['header_standard']     =   view_get_template('preview/receipt/_header_standard');      
            $this->_view('/receipt/authority_to_accept_payment', $data);
        }
        
        public function form_or()
        {        
            mvc_view('preview/form/or', $data);
        }  
        
    public function updated_accounts_per_project()
    {
        mvc_view('preview/updated_accounts_per_project');
    }
    
    public function overdue_accounts_per_project()
    {
        mvc_view('preview/overdue_accounts_per_project');
    }
    
    public function overdue_accounts_per_network()
    {
        mvc_view('preview/overdue_accounts_per_network');
    }
    
    public function fully_paid_accounts()
    {
        mvc_view('preview/fully_paid_accounts');
    }
      
    public function retention_accounts()
    {
        mvc_view('preview/retention_accounts');
    }  
    
    public function ageing_thru_loan()
    {
        mvc_view('preview/ageing_thru_loan');
    }   
    
    public function ageing_of_retention()
    {
        mvc_view('preview/ageing_of_retention');
    }
    
    public function reopen_lots()
    {
        mvc_view('preview/reopen_lots');
    }
    
    public function ageing_of_receivables()
    {
        mvc_view('preview/ageing_of_receivables');
    }
    
    
    
    
    
    public function _view($view, $data = array())
    {      
        mvc_set_var($data);           
        mvc_view('preview/'.$view);
    }    

        
        
}