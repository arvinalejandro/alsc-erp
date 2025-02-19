<?php
class finance_billing_report
{
    
    public function __construct()
    {    	
       $this->controller_id = 'finance_billing_report';        
    }
    
    public function index($parent)
    {           
        # DB
       	$data['row.manage']	=	mvc_model('model.client')->get_row();        
        # VIEW
        $parent->_view('report', $data);
    } 
        
    
    public function profile($parent)
    {      	
    	# DB
        #$data                                  =    mvc_model('model.client')->select($_GET['id']);
       	#$data['row.manage.account']			=	mvc_model('model.client_account')->get_row($_GET['id']);
        # VIEW - side nav
        $side_nav['profile.class']				=	'bold';         	
       	#$side_nav['client_id']					=	$data['client_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.account', $side_nav);            
       	          
        # VIEW
        $parent->_view('account.profile', $data);        
    } 
    
    public function remark($parent)
    {      	
    	# DB
        #$data                                  =    mvc_model('model.client')->select($_GET['id']);
       	#$data['row.manage.account']			=	mvc_model('model.client_account')->get_row($_GET['id']);
        # VIEW - side nav
        $side_nav['remark.class']				=	'bold';         	
       	#$side_nav['client_id']					=	$data['client_id'];         	  	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.account', $side_nav);            
       	          
        # VIEW
        $parent->_view('account.remark', $data);        
    } 
    
    
    
    
    
     
   
    

#----------------------- Form Pages	
	     
    public function add_client($parent)
    {      	 
       	# DB
       	$data									=	mvc_model('model.lot')->select($_GET['id']); 
       
       	$data['user_id']						=	$parent->user['user_id'];       	
       	
       	$option_transaction_type				=	mvc_model('model.option')->select_option('option_transaction_type', 'ORDER BY option_transaction_type_name ASC');       	
       	$option_account_type					=	mvc_model('model.option')->select_option('option_account_type', 'ORDER BY option_account_type_name ASC');       	
       	$option_account_status					=	mvc_model('model.option')->select_option('option_account_status', 'ORDER BY option_account_status_name ASC');       	
       	$option_buyer_type						=	mvc_model('model.option')->select_option('option_buyer_type', 'ORDER BY option_buyer_type_name ASC');         	     	
       	$option_account_p1						=	mvc_model('model.option')->select_option('option_account_p1');         	     	
       	$option_account_p2						=	mvc_model('model.option')->select_option('option_account_p2');     
       	$option_gender							=	mvc_model('model.option')->select_option('option_gender');     
       	$option_civil_status					=	mvc_model('model.option')->select_option('option_civil_status');     
       	$option_employment						=	mvc_model('model.option')->select_option('option_employment');     
       	$option_client_address					=	mvc_model('model.option')->select_option('option_client_address');     
    	
        # VIEW - db options
        $data['option_transaction_type']			=	hash_to_option($option_transaction_type, 'option_transaction_type_id', 'option_transaction_type_name');
        $data['option_account_type']				=	hash_to_option($option_account_type, 'option_account_type_id', 'option_account_type_name');
        $data['option_account_status']				=	hash_to_option($option_account_status, 'option_account_status_id', 'option_account_status_name');
        $data['option_buyer_type']					=	hash_to_option($option_buyer_type, 'option_buyer_type_id', 'option_buyer_type_name');
        $data['option_account_p1']					=	hash_to_option($option_account_p1, 'option_account_p1_id', 'option_account_p1_name');
        $data['option_account_p2']					=	hash_to_option($option_account_p2, 'option_account_p2_id', 'option_account_p2_name');
        $data['option_gender']						=	hash_to_option($option_gender, 'option_gender_id', 'option_gender_name');
        $data['option_civil_status']				=	hash_to_option($option_civil_status, 'option_civil_status_id', 'option_civil_status_name');
        $data['option_employment']					=	hash_to_option($option_employment, 'option_employment_id', 'option_employment_name');
        $data['option_client_address']				=	hash_to_option($option_client_address, 'option_client_address_id', 'option_client_address_name');
        
        # VIEW - control
        $control['control.investment']				=	'gray';             	
        $control['control.client']					=	'gray';             	
        $control['control.account_settings']		=	'gray';             	
        $control['control.account_profile']			=	'blue';             	
        $control['control.summary']					=	'gray';  	
       	$data['control']							=	view_get_template($parent->controller_id.'/template/control.client', $control);        
        # VIEW
        $parent->_view('manage.form.add_client', $data);        
    }
    
    public function account_add_house($parent)
    {      	 
       	# DB
       	$data									=	mvc_model('model.client')->select($_GET['id']);        
       	$data['user_id']						=	$parent->user['user_id'];      	       	
       	$project								=	mvc_model('model.option')->select_option('project');       	
       	$house									=	mvc_model('model.option')->select_option('house');           # VIEW - db options
        # DB Options
        $data['project']						=	hash_to_option($project, 'project_id', 'project_name');
        $data['house']							=	hash_to_option($house, 'house_id', 'house_name');         
        # VIEW
        $parent->_view('manage.form.account_add_house', $data);        
    }
    
    public function account_add_house_compute($parent)
    {      	
    	
       	# DB
       	$data									=	mvc_model('model.house')->select($_POST['house_id']);        
       	$data['client']							=	mvc_model('model.client')->select($_GET['id']);        
       	$data['user_id']						=	$parent->user['user_id'];           
       	$option_transaction_type				=	mvc_model('model.option')->select_option('option_transaction_type', 'ORDER BY option_transaction_type_name ASC');       	
       	$option_account_type					=	mvc_model('model.option')->select_option('option_account_type', 'ORDER BY option_account_type_name ASC');       	
       	$option_account_status					=	mvc_model('model.option')->select_option('option_account_status', 'ORDER BY option_account_status_name ASC');       	
       	$option_buyer_type						=	mvc_model('model.option')->select_option('option_buyer_type', 'ORDER BY option_buyer_type_name ASC');         	     	
       	$option_account_p1						=	mvc_model('model.option')->select_option('option_account_p1');         	     	
       	$option_account_p2						=	mvc_model('model.option')->select_option('option_account_p2');             
    	
        # VIEW - db options
        $data['option_transaction_type']			=	hash_to_option($option_transaction_type, 'option_transaction_type_id', 'option_transaction_type_name');
        $data['option_account_type']				=	hash_to_option($option_account_type, 'option_account_type_id', 'option_account_type_name');
        $data['option_account_status']				=	hash_to_option($option_account_status, 'option_account_status_id', 'option_account_status_name');
        $data['option_buyer_type']					=	hash_to_option($option_buyer_type, 'option_buyer_type_id', 'option_buyer_type_name');
        $data['option_account_p1']					=	hash_to_option($option_account_p1, 'option_account_p1_id', 'option_account_p1_name');
        $data['option_account_p2']					=	hash_to_option($option_account_p2, 'option_account_p2_id', 'option_account_p2_name');      	     	
       
        # VIEW
        $parent->_view('manage.form.account_add_house_compute', $data);        
    }
    
    
    public function account_add_house_submit($parent)
    {  	
    	
    	$user_id	=	$parent->user['user_id'];
    	# Client    	
    	$client						=	mvc_model('model.client')->select($_GET['id']);     	
    	# Client Account
    	$client_account				=	$_POST['client_account'];   	
    	$client_account				=	mvc_model('model.client_account')->insert($client_account, $client['client_id']);
    	$client_account				=	$client_account['data'];
    	# Client Account Invoice
    	mvc_model('model.client_account_invoice')->insert_dp_partial($client_account);
    	mvc_model('model.client_account_invoice')->insert_ma_partial($client_account);
    	# For Documentation
    	mvc_model('model.document_account')->insert($client_account['client_account_id']);   	
    	
    	header_location("/edp_client/edp_client_manage/account/&id={$client_account['client_id']}");
    	
	}
	
	public function account_add_other($parent)
    {      	
    	
       	# DB
       	$data									=	mvc_model('model.house')->select($_POST['house_id']);        
       	$data['client']							=	mvc_model('model.client')->select($_GET['id']);        
       	$data['user_id']						=	$parent->user['user_id'];           
       	$option_transaction_type				=	mvc_model('model.option')->select_option('option_transaction_type', 'ORDER BY option_transaction_type_name ASC');       	
       	$option_account_type					=	mvc_model('model.option')->select_option('option_account_type', 'ORDER BY option_account_type_name ASC');       	
       	$option_account_status					=	mvc_model('model.option')->select_option('option_account_status', 'ORDER BY option_account_status_name ASC');       	
       	$option_buyer_type						=	mvc_model('model.option')->select_option('option_buyer_type', 'ORDER BY option_buyer_type_name ASC');         	     	
       	$option_account_p1						=	mvc_model('model.option')->select_option('option_account_p1');         	     	
       	$option_account_p2						=	mvc_model('model.option')->select_option('option_account_p2');             
    	
        # VIEW - db options
        $data['option_transaction_type']			=	hash_to_option($option_transaction_type, 'option_transaction_type_id', 'option_transaction_type_name');
        $data['option_account_type']				=	hash_to_option($option_account_type, 'option_account_type_id', 'option_account_type_name');
        $data['option_account_status']				=	hash_to_option($option_account_status, 'option_account_status_id', 'option_account_status_name');
        $data['option_buyer_type']					=	hash_to_option($option_buyer_type, 'option_buyer_type_id', 'option_buyer_type_name');
        $data['option_account_p1']					=	hash_to_option($option_account_p1, 'option_account_p1_id', 'option_account_p1_name');
        $data['option_account_p2']					=	hash_to_option($option_account_p2, 'option_account_p2_id', 'option_account_p2_name');      	     	
       
        # VIEW
        $parent->_view('manage.form.account_add_other', $data);        
    }
    
    public function account_add_other_submit($parent)
    {  	
    	
    	$user_id					=	$parent->user['user_id'];
    	# Client    	
    	$client						=	mvc_model('model.client')->select($_GET['id']);     	
    	# Client Account
    	$client_account				=	$_POST['client_account'];   	
    	$client_account				=	mvc_model('model.client_account')->insert($client_account, $client['client_id']);
    	$client_account				=	$client_account['data'];
    	# Client Account Invoice
    	mvc_model('model.client_account_invoice')->insert_dp_partial($client_account);
    	mvc_model('model.client_account_invoice')->insert_ma_partial($client_account);   
    	# For Documentation
    	mvc_model('model.document_account')->insert($client_account['client_account_id']);	
    	
    	header_location("/edp_client/edp_client_manage/account/&id={$client_account['client_id']}");
    	
	}
    
    
    public function account_submit($parent)
    {
    	$user_id	=	$parent->user['user_id'];
    	# Client
    	$client		=	$_POST['client'];    	
    	$client		=	mvc_model('model.client')->insert($client);
    	$client		=	$client['data'];
    	# Client Member
    	$client_member						=	$_POST['client_member'];   	
    	$client_member						=	mvc_model('model.client_member')->insert_batch($client_member, $client['client_id']);
    	# Client Account
    	$client_account						=	$_POST['client_account'];   	
    	$client_account						=	mvc_model('model.client_account')->insert($client_account, $client['client_id']);
    	$client_account						=	$client_account['data'];
    	# Client Account Invoice
    	mvc_model('model.client_account_invoice')->insert_dp_partial($client_account);
    	mvc_model('model.client_account_invoice')->insert_ma_partial($client_account);
    	# For Documentation
    	mvc_model('model.document_account')->insert($client_account['client_account_id']);
    	# Lot
    	$lot	=	$_POST['lot'];    
    	mvc_model('model.lot')->update($lot, $client_account['lot_id'],$parent->user['user_id']);
    	
    	header_location("/edp_client/edp_client_manage/profile/&id={$client_account['client_id']}");
    	
	}
    
   
    
    
    
#----------------------- Form Actions

	public function delete_member()
	{	
		mvc_model('model.client_member')->delete($_GET['id']);
		header_location("/edp_client/edp_client_manage/profile/&id={$_GET['client_id']}");
	}
	
	

	public function submit()
	{	
		$id 	=	string_clean_number($_POST['id']);		
		if($id) # Update
		{			
			header_location("/edp_cms/edp_cms_user/profile/&id={$id}");
		}
		else # Insert
		{
			mvc_model('model.user')->insert($_POST);
			header_location('/edp_cms/edp_cms_user');
		}		
	}
	
	public function submit_member()
	{		
		mvc_model('model.client_member')->insert($_POST, $_POST['client_id']);
		header_location("/edp_client/edp_client_manage/profile/&id={$_POST['client_id']}");
	}
	
	
	
	public function module_add()
	{
		mvc_model('model.module')->insert_user_module($_POST);
		header_location("/edp_cms/edp_cms_user/module/&id={$_POST['user_id']}");
	}
	
	public function report_add()
	{		
		mvc_model('model.report')->insert_user_report($_POST);
		header_location("/edp_cms/edp_cms_user/report/&id={$_POST['user_id']}");
	}
	
	public function module_delete()
	{		
		mvc_model('model.module')->delete_user_module($_GET['id']);
		header_location("/edp_cms/edp_cms_user/module/&id={$_GET['user_id']}");
	}
	
	public function report_delete()
	{		
		mvc_model('model.report')->delete_user_report($_GET['id']);
		header_location("/edp_cms/edp_cms_user/report/&id={$_GET['user_id']}");
	}
   
}