<?php
class sales_sales_report
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'sales_sales_report';
       	$this->user						=	mvc_model('model.user')->select($_SESSION['user_id']);     
         	
    }
    
    public function index($parent)
    {          
        # DB                 
        # VIEW
        $parent->_view('sales_report', $data);        
    }
    
    public function year_to_date($parent)
    {          
        # DB
        $data                                      		=    mvc_model('model.client_account')->get_year_to_date_report(2014);
        $data['lot']                              	    =    mvc_model('model.lot')->get_total_unsold_inventory();
        # VIEW - side nav
        $side_nav['year_to_date.class']            		=    'bold';             
        $data['side_nav']                          		=    view_get_template($parent->controller_id.'/template/side.sales_report', $side_nav);                      
        # VIEW
        $parent->_view('sales_report.year_to_date', $data);        
    }
    
    public function per_project($parent)
    {          
        # DB
        $data['row.project']                            =    mvc_model('model.project')->get_sales_distribution_per_project();
         # VIEW - side nav
        $side_nav['per_project.class']          	    =    'bold';             
        $data['side_nav']                               =    view_get_template($parent->controller_id.'/template/side.sales_report', $side_nav);                      
        # VIEW
        $parent->_view('sales_report.per_project', $data);        
    }
    
    public function per_transaction_type($parent)
    {          
        # DB
        $data                                      		=    mvc_model('model.project')->get_sales_distribution_per_transaction_type();
         # VIEW - side nav
        $side_nav['per_transaction_type.class']         =    'bold';             
        $data['side_nav']                        		=    view_get_template($parent->controller_id.'/template/side.sales_report', $side_nav);                      
        # VIEW
        $parent->_view('sales_report.per_transaction_type', $data);        
    }
    
    public function per_division($parent)
    {          
        # DB
        $data                            				=    mvc_model('model.sales_network_division')->get_production_report_per_division();
         # VIEW - side nav
        $side_nav['per_division.class']           		=    'bold';             
        $data['side_nav']                        		=    view_get_template($parent->controller_id.'/template/side.sales_report', $side_nav);                      
        # VIEW
        $parent->_view('sales_report.per_division', $data);        
    }
    
    public function unsold_inventories($parent)
    {          
        # DB
         $data                               			=    mvc_model('model.lot')->get_total_unsold_inventory_per_proj_site();
         # VIEW - side nav
        $side_nav['unsold_inventories.class']           =    'bold';             
        $data['side_nav']                        		=    view_get_template($parent->controller_id.'/template/side.sales_report', $side_nav);                      
        # VIEW
        $parent->_view('sales_report.unsold_inventories', $data);        
    }
    
    public function production_network($parent)
    {          
        # DB
        $data                            				=    mvc_model('model.sales_network')->get_production_report_per_network();
         # VIEW - side nav
        $side_nav['production_network.class']           =    'bold';             
        $data['side_nav']                        		=    view_get_template($parent->controller_id.'/template/side.sales_report', $side_nav);                      
        # VIEW
        $parent->_view('sales_report.production_network', $data);        
    }
    
    public function production_old_sales_manager($parent)
    {          
        # DB
         $data                            				=    mvc_model('model.sales_network_division')->get_production_report_per_sales_manager_old();
         # VIEW - side nav
        $side_nav['production_old_sales_manager.class']           =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.sales_report', $side_nav);                      
        # VIEW
        $parent->_view('sales_report.production_sales_manager_old', $data);        
    }
    
    public function production_associates($parent)
    {          
        # DB
         $data                            				=    mvc_model('model.sales_agent')->get_production_report_per_marketing_associate();
         # VIEW - side nav
        $side_nav['production_associates.class']           =    'bold';             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.sales_report', $side_nav);                      
        # VIEW
        $parent->_view('sales_report.production_associates', $data);        
    }
    
    public function old_daily_production($parent)
    {          
        if($_POST)
        {
			$rep_date  = date("Y-m-d", strtotime($_POST['report_date']));
        }
        else
        {
			$rep_date  			= date("Y-m-d", time());
        }
        # DB
        $data                            				=    mvc_model('model.sales_network_division')->get_production_report_daily_old_scheme($rep_date);
         # VIEW - side nav
        $side_nav['old_daily_production.class']         =    'bold';             
        $data['side_nav']                        		=    view_get_template($parent->controller_id.'/template/side.sales_report', $side_nav);  
        $data['rep_date'] 								=	date("M.d.Y", strtotime($rep_date));                    
        # VIEW
        $parent->_view('sales_report.daily_production_old', $data);        
    }
    
    public function production_sales_director($parent)
    {          
        if($_POST)
        {
			$rep_date  = string_clean_number($_POST['report_date']);
        }
        else
        {
			$rep_date  = 2015;
        }
        # DB
        $data                            				=    mvc_model('model.sales_commission_account')->get_production_report_per_director($rep_date);
         # VIEW - side nav
        $side_nav['production_sales_director.class']    =    'bold';             
        $data['side_nav']                        		=    view_get_template($parent->controller_id.'/template/side.sales_report', $side_nav);                      
        # VIEW
        $parent->_view('sales_report.sales_director', $data);        
    }
    
    public function production_sales_manager($parent)
    {          
        if($_POST)
        {
			$rep_date  = string_clean_number($_POST['report_date']);
        }
        else
        {
			$rep_date  = 2015;
        }
        # DB
        $data                            				=    mvc_model('model.sales_agent')->get_production_report_per_manager($rep_date);
         # VIEW - side nav
        $side_nav['production_sales_manager.class']     =    'bold';             
        $data['side_nav']                        		=    view_get_template($parent->controller_id.'/template/side.sales_report', $side_nav);                      
        # VIEW
        $parent->_view('sales_report.sales_manager', $data);        
    }
    
    public function production_property_consultant($parent)
    {         
        if($_POST)
        {
			$rep_date  = string_clean_number($_POST['report_date']);
        }
        else
        {
			$rep_date  = 2015;
        }
        # DB
        $data                            					=    mvc_model('model.sales_agent')->get_production_report_per_property_consultant($rep_date);
         # VIEW - side nav
        $side_nav['production_property_consultant.class']   =    'bold';             
        $data['side_nav']                        			=    view_get_template($parent->controller_id.'/template/side.sales_report', $side_nav);                      
        # VIEW
        $parent->_view('sales_report.property_consultant', $data);        
    }
    
    public function production_sales_daily($parent)
    {          
        if($_POST)
        {
			
			$rep_date  = date("Y-m-d", strtotime($_POST['report_date']));
			//hash_dump($rep_date,true);
        }
        else
        {
			$rep_date  			= date("Y-m-d", time());
        }
        
        # DB
        $data                            				=    mvc_model('model.sales_agent')->get_production_report_daily_new_scheme($rep_date);
        $data['rep_date'] 								=	date("M.d.Y", strtotime($rep_date));
         # VIEW - side nav
        $side_nav['production_sales_daily.class']       =    'bold';             
        $data['side_nav']                        		=    view_get_template($parent->controller_id.'/template/side.sales_report', $side_nav);                      
        # VIEW
        $parent->_view('sales_report.daily_production', $data);        
    }
    
}