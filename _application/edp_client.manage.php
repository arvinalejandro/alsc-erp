<?php 
class edp_client_manage
{
    
    public function __construct()
    {    	
       $this->controller_id = 'edp_client_manage';        
    }
    
    public function index($parent)
    {           
        # DB
       	$data['row.manage']	=	mvc_model('model.client')->get_row();
        # VIEW - header 
        $data[$this->controller_id]				=	'<i></i>';
        $data[$this->controller_id.'_class']	=	'class="active"';
        # VIEW
        $parent->_view('manage', $data);
    } 
     
    public function profile($parent)
    {      	
    	# DB
        $data                                   =    mvc_model('model.client')->select($_GET['id']);  
        $data['user_id']                        =  	 $parent->user['user_id'];
        $data['row.manage.member']			    =    mvc_model('model.client_member')->get_row($_GET['id']);  
        $data['row.manage.account']			    =    mvc_model('model.client_account')->get_row($_GET['id']);
        # VIEW - side nav
        $side_nav['profile.class']				=	'bold';         	
       	$side_nav['client_id']					=	$data['client_id'];         	
       	$side_nav['hidden']						=	'display_none';         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.manage', $side_nav); 
       	            
        # VIEW
       
        $parent->_view('manage.profile', $data);        
    }   
    
    public function account($parent)
    {      	
    	# DB
        $data                                   =    mvc_model('model.client')->select($_GET['id']);
       	$data['row.manage.account']				=	mvc_model('model.client_account')->get_row($_GET['id']);
        # VIEW - side nav
        $side_nav['account.class']				=	'bold';         	
       	$side_nav['client_id']					=	$data['client_id'];     
       	$side_nav['hidden']						=	'display_none';    	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.manage', $side_nav);            
       	          
        # VIEW
        $parent->_view('manage.account', $data);        
    }  
    
    
    public function account_profile($parent)
    {      	
    	# DB        
       	$data									=	mvc_model('model.client_account')->select($_GET['id']);       
        # VIEW - side nav
        $side_nav['account.class']				=	'bold';         	
       	$side_nav['client_id']					=	$data['client_id'];         	
       	$side_nav['client_account_id']			=	$data['client_account_id'];         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.manage', $side_nav);            
        # VIEW
        $parent->_view('manage.account.profile', $data);        
    }   
    
    public function account_invoice($parent)
    {      	
    	# DB        
       	$data									=	mvc_model('model.client_account')->select($_GET['id']);       
       	$data['row.manage.account_invoice']		=	mvc_model('model.client_account_invoice')->get_client_row($data['client_account_id']);       
        # VIEW - side nav
        $side_nav['account.class']				=	'bold';         	
       	$side_nav['client_id']					=	$data['client_id'];         	
       	$side_nav['client_account_id']			=	$data['client_account_id'];         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.manage', $side_nav);            
        # VIEW
        $parent->_view('manage.account_invoice', $data);        
    }   
    
    
    public function eject($parent)
    {      	
    	# DB        
       	$data												=	mvc_model('model.client_account')->select($_GET['id']);             	
       	$client_id											=	$data['client_id'];
       	$lot['str']['option_availability_id']				=	'available';
       	$account['str']['option_account_status_id']       	= 	'ejected';
		mvc_model('model.lot')->update($lot, $data['lot_id'],$parent->user['user_id']);
		mvc_model('model.client_account')->update($account, $data['client_account_id']);
		
       	
       	#hash_dump($data, 1);
       	header_location("http://alsc/edp_client/edp_client_manage/profile/&id={$client_id}");
       	       
    }   
    
    public function status($parent)
    {      	
    	# DB        
       	$data												=	mvc_model('model.client_account')->select($_GET['id']);    
       	$option_account_status								=	mvc_model('model.option')->select_option('option_account_status');        	       
       	$data['option_acccount_status']        				=	hash_to_option($option_account_status, 'option_account_status_id', 'option_account_status_name', $data['option_account_status_id']);
      	# VIEW
        $parent->_view('manage.account.form.status', $data);   
       	
       	       
    }   
    
    public function restructure($parent)
    {
    	# DB        
       	$data									=	mvc_model('model.client_account')->select($_GET['id']);  
       	
       	hash_dump($data, 1);     
        # VIEW - side nav
        $side_nav['account.class']				=	'bold';         	
       	$side_nav['client_id']					=	$data['client_id'];         	
       	$side_nav['client_account_id']			=	$data['client_account_id'];         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.manage', $side_nav);            
        # VIEW
        $parent->_view('manage.form.restructure', $data);     
	}
    
    public function status_submit($parent)
    {
    	$data												=	mvc_model('model.client_account')->select($_POST['id']);     
    	$account['str']['option_account_status_id']       	= 	$_POST['option_acccount_status_id'];
    	if($_POST['option_acccount_status_id'] == 'ejected')
    	{
    		$lot['str']['option_availability_id']				=	'available';
    		mvc_model('model.lot')->update($lot, $data['lot_id'],$parent->user['user_id']);
		}
    	mvc_model('model.client_account')->update($account, $data['client_account_id']);
    	header_location("/edp_client/edp_client_manage/account_profile/&id={$data['client_account_id']}&client_id={$data['client_id']}");
	}
    
     
   
    

#----------------------- Form Pages	
	     
    public function add_client($parent)
    {      	 
       	# DB
       	$data									=	mvc_model('model.lot')->select($_GET['id']);        
       	$data['user_id']						=	$parent->user['user_id'];       	
       
        #$data['row.earnest']					=	mvc_model('model.account_receive')->get_earnest_row_add_client($_GET['id']);
       	
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
        $option_transaction_type			=	hash_to_option($option_transaction_type, 'option_transaction_type_id', 'option_transaction_type_name');
        $option_account_type				=	hash_to_option($option_account_type, 'option_account_type_id', 'option_account_type_name');
        $option_account_status				=	hash_to_option($option_account_status, 'option_account_status_id', 'option_account_status_name');
        $option_buyer_type					=	hash_to_option($option_buyer_type, 'option_buyer_type_id', 'option_buyer_type_name');
        $option_account_p1					=	hash_to_option($option_account_p1, 'option_account_p1_id', 'option_account_p1_name');
        $option_account_p2					=	hash_to_option($option_account_p2, 'option_account_p2_id', 'option_account_p2_name');
        $option_gender						=	hash_to_option($option_gender, 'option_gender_id', 'option_gender_name');
        $option_civil_status				=	hash_to_option($option_civil_status, 'option_civil_status_id', 'option_civil_status_name');
       	$option_employment					=	hash_to_option($option_employment, 'option_employment_id', 'option_employment_name');
       	$option_client_address				=	hash_to_option($option_client_address, 'option_client_address_id', 'option_client_address_name');
        
        $data['house_price']				=	mvc_model('model.lot.construction')->select_accumulated_cost($data['lot_id']); # house price derived from the total construction done 
           
        # VIEW - Parts
        	
        	# Investment Details
        	$t_data								=	$data;
        	$t_data['lot_price']				=	string_amount($data['lot_price']);
        	$t_data['lcp']						=	string_amount($data['lot_price'] * $data['lot_area']);
        	$t_data['house_model']				=	($data['house_name']) ? $data['house_name'] : 'none';
        	$t_data['house_class']				=	($data['option_house_classification_name']) ? $data['option_house_classification_name'] : 'none';
        	$t_data['house_area']				=	string_amount($data['house_area']);
        	$t_data['house_price']				=	string_amount($data['house_price']);
        	$t_data['tcp']						=	string_amount(($data['lot_price'] * $data['lot_area']) + $data['house_price']);
        	#$t_data['network_name']			=	($data['network_name']) ? $data['network_name'] : 'none';
        	#$t_data['network_division_name']	=	($data['network_division_name']) ? $data['network_division_name'] : 'none';
        	$t_data['agent_name']				=	($data['agent']['agent_id']) ? "{$data['agent']['agent_first_name']} {$data['agent']['agent_last_name']}" : 'none';        	
        	$part['client.investment']			=	view_get_template($parent->controller_id . '/manage.form.client.investment', $t_data, true);
        	
        	# Client Profile        	
        	$t_data								=	$data;
        	$t_data['option_gender']			=	$option_gender;
        	$t_data['option_civil_status']		=	$option_civil_status;
        	$t_data['option_employment']		=	$option_employment;
        	$t_data['option_client_address']	=	$option_client_address;        	
        	$part['client.create']				=	view_get_template($parent->controller_id . '/manage.form.client.create', $t_data);
        	
        	# Reservation        	
        	$t_data								=	$data;
        	$t_data['row.reservation']			=	mvc_model('model.account_receive')->get_client_manage_reservation($_GET['id']);
        	$t_data['row.earnest']				=	mvc_model('model.account_receive')->get_client_manage_earnest($_GET['id']);
        	$part['client.reservation']			=	view_get_template($parent->controller_id . '/manage.form.client.reservation', $t_data);
        	
        	# Client Settings
        	
        	$t_data								=	$data;
        	$t_data['option_transaction_type']	=	$option_transaction_type;
        	$t_data['option_account_type']		=	$option_account_type;
        	$t_data['option_account_status']	=	$option_account_status;
        	$t_data['option_buyer_type']		=	$option_buyer_type;  
        	$part['client.account.settings']	=	view_get_template($parent->controller_id . '/manage.form.client.account.settings', $t_data);
        	
        	# Account Computation
        	$t_data								=	$data;
        	$lcp								=	$data['lot_price'] * $data['lot_area'];
			$tcp								=	$lcp + $data['house_price'];        	      	
        	$t_data['option_account_p1']		=	$option_account_p1;        	
        	$t_data['option_account_p2']		=	$option_account_p2;        	
        	$t_data['client_account_number']	=	$data['project_site_code']. '-' . str_pad($data['project_site_block_name'], 3, '0', STR_PAD_LEFT).'-'.str_pad($data['lot_name'], 3, '0', STR_PAD_LEFT).'-'. $data['option_unit_code'];
        	$t_data['_lot_price']				=	string_amount($data['lot_price']);
        	$t_data['_house_price']				=	string_amount($data['house_price']);
        	$t_data['lcp']						=	$lcp;  # unformatted value       	
        	$t_data['tcp']						=	$lcp;  # unformatted value           	
        	$t_data['_lcp']						=	string_amount($lcp);        	
        	$t_data['_tcp']						=	string_amount($tcp);        	
        	$part['client.account.computation']	=	view_get_template($parent->controller_id . '/manage.form.client.account.computation', $t_data);
        
        	# Account Commission
        	$t_data								=	$data;
        	$part['client.account.commission']	=	view_get_template($parent->controller_id . '/manage.form.client.commission', $t_data);
        
        # VIEW - DAta
        $data['view']							=	$part;
                
        # VIEW - Load
        $parent->_view('manage.form.client', $data);        
    }
    
       
	public function add_client_sub_account($parent)
    {      	
       	# DB
       	$data									=	mvc_model('model.client_account')->select($_GET['client_account_id']);   
       	       	       	     
       	$data['user_id']						=	$parent->user['user_id'];          	
       	
       	$option_transaction_type				=	mvc_model('model.option')->select_option('option_transaction_type', 'ORDER BY option_transaction_type_name ASC');       	
       	$option_account_type					=	mvc_model('model.option')->select_option('option_account_type', 'ORDER BY option_account_type_name ASC');       	
       	$option_account_status					=	mvc_model('model.option')->select_option('option_account_status', 'ORDER BY option_account_status_name ASC');       	
       	$option_buyer_type						=	mvc_model('model.option')->select_option('option_buyer_type', 'ORDER BY option_buyer_type_name ASC');         	     	
       	$option_account_p1						=	mvc_model('model.option')->select_option('option_account_p1');         	     	
       	$option_account_p2						=	mvc_model('model.option')->select_option('option_account_p2');     
       	$option_unit_account_type				=	mvc_model('model.option')->select_option('option_unit_account_type');     
       	     
    	
        # VIEW - db options
        $option_transaction_type			=	hash_to_option($option_transaction_type, 'option_transaction_type_id', 'option_transaction_type_name');
        $option_account_type				=	hash_to_option($option_account_type, 'option_account_type_id', 'option_account_type_name');
        $option_account_status				=	hash_to_option($option_account_status, 'option_account_status_id', 'option_account_status_name');
        $option_buyer_type					=	hash_to_option($option_buyer_type, 'option_buyer_type_id', 'option_buyer_type_name');
        $option_account_p1					=	hash_to_option($option_account_p1, 'option_account_p1_id', 'option_account_p1_name');
        $option_account_p2					=	hash_to_option($option_account_p2, 'option_account_p2_id', 'option_account_p2_name');
        $option_unit_account_type			=	hash_to_option($option_unit_account_type, 'option_unit_account_type_id', 'option_unit_account_type_name');
           
       	       	       	
       	# VIEW - Parts     	        	
        	
        	# construction_list
        	$t_data	=	array();
        	$t_data									=	$data;
        	$t_data['row']							=	mvc_model('model.lot.construction')->get_for_client_list($data['lot_id']);
        	$part['construction.list']				=	view_get_template($parent->controller_id . '/manage.form.construction.list', $t_data, true);
        	
        	# construction.profile
        	$t_data	=	array();       	
        	$part['construction.profile']			=	view_get_template($parent->controller_id . '/manage.form.construction.profile', $t_data, true);
        	
        	# construction.account.settings
        	$t_data	=	array();
        	$t_data								=	$data;
        	$t_data['option_transaction_type']	=	$option_transaction_type;
        	$t_data['option_account_type']		=	$option_account_type;
        	$t_data['option_account_status']	=	$option_account_status;
        	$t_data['option_buyer_type']				=	$option_buyer_type;  
        	$t_data['option_unit_account_type']		=	$option_unit_account_type;  
        	$part['construction.account.settings']	=	view_get_template($parent->controller_id . '/manage.form.construction.account.settings', $t_data, true);      
        	
        	
        	# construction.computation
        	$t_data								=	$data;
        	$lcp								=	0;
			$tcp								=	0;        	      	
        	$t_data['option_account_p1']		=	$option_account_p1;        	
        	$t_data['option_account_p2']		=	$option_account_p2;        	
        	$t_data['client_account_number']	=	$data['project_site_code']. '-' . str_pad($data['project_site_block_name'], 3, '0', STR_PAD_LEFT).'-'.str_pad($data['lot_name'], 3, '0', STR_PAD_LEFT).'-'. $data['option_unit_code'];
        	$t_data['_lot_price']				=	0;
        	$t_data['_house_price']				=	0;
        	$t_data['lcp']						=	0;  # unformatted value       	
        	$t_data['tcp']						=	0;  # unformatted value           	
        	$t_data['_lcp']						=	0;        	
        	$t_data['_tcp']						=	0;        	
        	       	  	
        	$part['construction.computation']		=	view_get_template($parent->controller_id . '/manage.form.construction.computation', $t_data, true);
       	
        # VIEW
        $data['view']	=	$part;
        
        $parent->_view('manage.form.construction', $data);   
           
    }
    
    public function add_client_lot_account($parent)
    {      	
       	# DB
       	$data									=	mvc_model('model.client')->select($_GET['client_id']);   
       	       	       	     
       	$data['user_id']						=	$parent->user['user_id'];          	
       	
       	$option_transaction_type				=	mvc_model('model.option')->select_option('option_transaction_type', 'ORDER BY option_transaction_type_name ASC');       	
       	$option_account_type					=	mvc_model('model.option')->select_option('option_account_type', 'ORDER BY option_account_type_name ASC');       	
       	$option_account_status					=	mvc_model('model.option')->select_option('option_account_status', 'ORDER BY option_account_status_name ASC');       	
       	$option_buyer_type						=	mvc_model('model.option')->select_option('option_buyer_type', 'ORDER BY option_buyer_type_name ASC');         	     	
       	$option_account_p1						=	mvc_model('model.option')->select_option('option_account_p1');         	     	
       	$option_account_p2						=	mvc_model('model.option')->select_option('option_account_p2');     
       	$option_unit_account_type				=	mvc_model('model.option')->select_option('option_unit_account_type');     
       	     
    	
        # VIEW - db options
        $option_transaction_type			=	hash_to_option($option_transaction_type, 'option_transaction_type_id', 'option_transaction_type_name');
        $option_account_type				=	hash_to_option($option_account_type, 'option_account_type_id', 'option_account_type_name');
        $option_account_status				=	hash_to_option($option_account_status, 'option_account_status_id', 'option_account_status_name');
        $option_buyer_type					=	hash_to_option($option_buyer_type, 'option_buyer_type_id', 'option_buyer_type_name');
        $option_account_p1					=	hash_to_option($option_account_p1, 'option_account_p1_id', 'option_account_p1_name');
        $option_account_p2					=	hash_to_option($option_account_p2, 'option_account_p2_id', 'option_account_p2_name');
        $option_unit_account_type			=	hash_to_option($option_unit_account_type, 'option_unit_account_type_id', 'option_unit_account_type_name');
           
       	       	       	
       	# VIEW - Parts     	        	
        	
        	# construction_list
        	$t_data	=	array();
        	$t_data									=	$data;
        	$t_data['row']							=	mvc_model('model.lot')->get_client_row('', $_GET['ajax']); 
        	
        	#hash_dump($data, 1);
        	
        	$part['lot.list']						=	view_get_template($parent->controller_id . '/manage.form.lot.list', $t_data, true);
        	
        	# construction.profile
        	$t_data	=	array();       	
        	$part['lot.profile']					=	view_get_template($parent->controller_id . '/manage.form.lot.profile', $t_data, true);
        	
        	# construction.account.settings
        	$t_data	=	array();
        	$t_data								=	$data;
        	$t_data['option_transaction_type']	=	$option_transaction_type;
        	$t_data['option_account_type']		=	$option_account_type;
        	$t_data['option_account_status']	=	$option_account_status;
        	$t_data['option_buyer_type']				=	$option_buyer_type;  
        	$t_data['option_unit_account_type']		=	$option_unit_account_type;  
        	$part['lot.account.settings']	=	view_get_template($parent->controller_id . '/manage.form.lot.account.settings', $t_data, true);      
        	
        	
        	# construction.computation
        	$t_data	=	array();
        	$t_data								=	$data;
        	$t_data['option_account_p1']		=	$option_account_p1;        	
        	$t_data['option_account_p2']		=	$option_account_p2;        	
        	#$t_data['client_account_number']	=	$data['project_site_code']. '-' . str_pad($data['project_site_block_name'], 3, '0', STR_PAD_LEFT).'-'.str_pad($data['lot_name'], 3, '0', STR_PAD_LEFT).'-'. $data['option_unit_code'];
        	    	
        	       	  	
        	$part['lot.computation']		=	view_get_template($parent->controller_id . '/manage.form.lot.account.computation', $t_data, true);
       	
       	#hash_dump($t_data, 1);
        # VIEW
        $data['view']	=	$part;
        $parent->_view('manage.form.lot', $data);   
           
    }
    
    public function ajax_get_construction()
    {    	
    	$data	=	mvc_model('model.lot.construction')->select($_POST['id']);
    	$data	=	json_encode($data);
    	echo $data;
	}
	
	public function ajax_get_lot()
    {    	
    	$data	=	mvc_model('model.lot')->select($_POST['id']);    
    	$t_data								=	$data;
        $lcp								=	$data['lot_price'] * $data['lot_area'];
		$tcp								=	$lcp + $data['house_price'];        	      	
        $t_data['option_account_p1']		=	$option_account_p1;        	
        $t_data['option_account_p2']		=	$option_account_p2;        	
        $t_data['client_account_number']	=	$data['project_site_code']. '-' . str_pad($data['project_site_block_name'], 3, '0', STR_PAD_LEFT).'-'.str_pad($data['lot_name'], 3, '0', STR_PAD_LEFT).'-'. $data['option_unit_code'];
        $t_data['_lot_price']				=	string_amount($data['lot_price']);
        $t_data['_house_price']				=	string_amount($data['house_price']);
        $t_data['lcp']						=	$lcp;  # unformatted value       	
        $t_data['tcp']						=	$lcp;  # unformatted value           	
        $t_data['_lcp']						=	string_amount($lcp);        	
        $t_data['_tcp']						=	string_amount($tcp);        	
       
    	$data	=	json_encode($t_data);
    	echo $data;
	}
    
    
    
#----------------------- Form Actions

	public function account_submit($parent)    
	{   	
		# Supply the values : client_account_reservation_date    	    	
    	$user_id	=	$parent->user['user_id'];        	
    	
    	# Client
    	
    	if($_POST['client_id'] > 0) # Existing Client
    	{
    		$client_id	=	$_POST['client_id'];
		}
		else # new client
		{
			# Create Client
			$client			=	$_POST['client'];    	
    		$client			=	mvc_model('model.client')->insert($client);
    		$client_id		=	$client['data']['client_id'];
    		
    		# Create Client Member    			
    		$client_member						=	$_POST['client_member'];   	
    		$client_member						=	mvc_model('model.client_member')->insert_batch($client_member, $client_id);
		}
    	  	
    	# Client Account
    	$client_account						=	$_POST['client_account'];   	
    	$client_account						=	mvc_model('model.client_account')->insert($client_account, $client_id);
    	$client_account_id					=	$client_account['data']['client_account_id'];      	 
    	
    	# Client Account Construction
    	if($_POST['client_account_construction']['int']['lot_construction_id']) mvc_model('model.client_account_construction')->insert($_POST['client_account_construction']['int']['lot_construction_id'], $client_account_id);
    	
    	# For Documentation
    	mvc_model('model.document_account')->insert($client_account_id);     	 
    	
    	# Client Account Structure
    	$client_account_structure			=	$_POST['client_account_structure']; 
    	$client_account_structure			=	mvc_model('model.client.account.structure')->insert($client_account_structure, $client_id, $client_account_id);
    	$client_account_structure_id		=	$client_account_structure['data']['client_account_structure_id'];      	    	
    	
    	
    	# Client Account Invoice    	   		
    	mvc_model('model.client_account_invoice')->insert_dp($client_account['data'], $client_account_structure_id);    	
    	mvc_model('model.client_account_invoice')->insert_ma($client_account['data'], $client_account_structure['data']);    	
		    	
    	/*
    	Lease-to-own
    	offsetting
    	regular
    	special account
    	Thru loan    	
    	
    	Partial DP
    	Full DP
    	No DP
    	Spot Cash    	
    	
    	Monthly Amortization
    	Deffered Cash Payment
    	*/
    	
    	# Update Lot
    	if($_POST['lot']) mvc_model('model.lot')->update($_POST['lot'], $client_account['data']['lot_id'],$parent->user['user_id']);        				
     	
    	# Update Client Account
    	$client_account_update		=	array();
    	$client_account_update['int']['client_account_structure_id']	=	$client_account_structure_id;   
    																		mvc_model('model.client_account')->update($client_account_update, $client_account_id, false);    
    	   	
    	# Set Commission
    	if($client_account['data']) mvc_model('model.sales_commission_account')->add_sales_commission_account($client_account['data']);
    	
    	
    	# Update receipt
    	if($_POST['account_receive_id']) mvc_model('model.account_receive')->update_to_client($client_account['data'], $_POST['account_receive_id']);
    	
    	# Remarks   	    	
    	$remark									=	$_POST['remark'];
    	$remark['int']['remark_key_id']			=	$client_account_id;	    	
    	
    	mvc_model('model.remark')->insert($remark);    	
    	
    	#hash_dump($client_account, 1);
    	#hash_dump($client_account_structure, 1);
    	#hash_dump($client_account_id);
    	#echo $client_account_id; die();
    	
    	header_location("/edp_client/edp_client_manage/profile/&id={$client_id}");
	}
	
	
	
	
	
	
	
	
	
	
	
# ---------------------------------------------
#	Account Insert
# ---------------------------------------------
	
	private function insert_client()
	{
	}
	
	private function insert_member()
	{
	}
	 
	private function insert_account()
	{
	}
	
	private function insert_structure()
	{
	}
	
	private function insert_invoice()
	{
	}
	
	

	public function account_submit_construction($parent)
    {  	
    	
    	hash_dump($_POST, 1);
    	
	}

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
	
	
	public function _reset_lot()
	{
		
	}
	
	
	
	
   
}