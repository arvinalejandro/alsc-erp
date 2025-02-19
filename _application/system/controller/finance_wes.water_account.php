<?php
class finance_wes_water_account
{
    
    public function __construct()
    {    	
       	$this->controller_id 			= 	'finance_wes_water_account';
    }
 
   public function index($parent)
    {           
        $filter										 =  $_POST['filter_type'];
        $data[$filter]								 =  'selected="selected"';
        if($filter != 'all' && !empty($filter))
        {
			$filter									 =  " AND lot_wes.lot_wes_status_id='".$filter."'";
        }
        else
        {
			$filter									=   '';
        }
        # DB
		$data['row.account']						 =	mvc_model('model.lot_wes')->select_all_by_type('water','finance',$filter);
        # VIEW
        $parent->_view('water_account', $data);
    }
    
    public function profile($parent)
    {      	
    	$id											=   $_GET['id']*1;
    	# DB
		$data										=	mvc_model('model.lot_wes')->select($id); 
		$balance                     				=   mvc_model('model.lot_wes_reading_invoice')->check_unsettled($id);
		if($balance)
		{
			$data['balance_status']    = 'Unsettled';
			$data['balance_link']      = '<a target="_new" class="link_button_inline blue" href="/finance_wes/water_reading/profile/&id='.$balance['lot_wes_reading_id'].'">View Pending Balance</a>';
		} 
		else
		{
			$data['balance_status']    = 'Settled';
			$data['balance_link']      = '';
		}
        # VIEW - side nav
        $side_nav['profile.class']					=	'bold';         	
       	$side_nav['lot_wes_id']						=	$id;         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.water_account', $side_nav);       
        # VIEW
        $parent->_view('water_account.profile', $data);        
    } 
    
   public function transaction_history($parent)
    {      	
    	$id											=   $_GET['id']*1;
    	# DB
		$data['row.transaction']					=	mvc_model('model.lot_wes_account_receive')->select_all($id);
        # VIEW - side nav
        $side_nav['transaction_history.class']		=	'bold';         	
       	$side_nav['lot_wes_id']						=	$id;         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.water_account', $side_nav);       
        # VIEW
        $parent->_view('water_account.transaction_history', $data);        
    } 
	
	 public function reading_history($parent)
    {      	
    	$id											=   $_GET['id']*1;
    	# DB
    	$data['row.reading']						=	mvc_model('model.lot_wes_reading')->select_all_by_account($id,'water');
    	# VIEW - side nav
        $side_nav['reading_history.class']			=	'bold';         	
       	$side_nav['lot_wes_id']						=	$id;         	  	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.water_account', $side_nav);      
        # VIEW       
        $parent->_view('water_account.reading_history', $data); 
	}
    
    public function remark($parent)
    {
    	$id											=   $_GET['id']*1;
    	$data['lot_wes_id']							=   $id;
    	# DB
         $data['row.remark']						=	mvc_model('model.remark')->get_row('lot_wes', $_GET['id']);            
        # VIEW - side nav
        $side_nav['remark.class']					=	'bold';         	
        $side_nav['lot_wes_id']						=	$id;         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.water_account', $side_nav);           
        # VIEW
        $parent->_view('water_account.remark', $data);      
	}
//======================================FORMS
  
     public function edit_details($parent)
    {      	
    	$id											=   $_GET['id']*1;
    	# DB
		$data										=	mvc_model('model.lot_wes')->select($id); 
		$acc_status									=	mvc_model('model.option')->select_option('lot_wes_status', "WHERE lot_wes_status_id !='meralco'");
		$option_rate								=	mvc_model('model.option.wes.water.rate.project')->select_all_by_project($data['project_id']);
		$bill_duration								=	mvc_model('model.option')->select_option('lot_wes_bill_duration');
       	$data['bill_duration']						=	hash_to_option($bill_duration, 'lot_wes_bill_duration_id', 'lot_wes_bill_duration_name', $data['lot_wes_bill_duration_id']);
       	$data['option_rate']						=	hash_to_option($option_rate, 'option_wes_water_rate_id', 'option_wes_water_rate_name', $data['option_wes_water_rate_id']);
		$data['status_list']						=	hash_to_option($acc_status, 'lot_wes_status_id', 'lot_wes_status_name',$data['lot_wes_status_id']);
        # VIEW - side nav
        $side_nav['edit_details.class']				=	'bold';
        $side_nav['lot_wes_id']						=	$id;         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.water_account', $side_nav);       
        # VIEW
        $parent->_view('water_account.form.edit_details', $data);        
    }
    
     public function create_job_order($parent)
    {      	
    	$id											=   $_GET['id']*1;
    	# DB
    	$data['lot_wes_id']							=   $id;
		$j_t										=	mvc_model('model.option')->select_option('lot_wes_job_order_type');
		$data['job_type']							=	hash_to_option($j_t, 'lot_wes_job_order_type_id', 'lot_wes_job_order_type_name');
        # VIEW - side nav
        $side_nav['create_job_order.class']			=	'bold'; 
        $side_nav['lot_wes_id']						=	$id;        	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.water_account', $side_nav);       
        # VIEW
        $parent->_view('water_account.form.create_job_order', $data);        
    }
    
    
    
    //===============================Form Action=========================
    
     public function submit_create_job_order($parent)
    {
    	# DB
        $id									        						=  	$_POST['lot_wes_job_order']['int']['lot_wes_id'];
        $_POST['lot_wes_job_order']['int']['user_id']						=	$parent->user['user_id'];
        $_POST['lot_wes_job_order']['str']['lot_wes_job_order_status_id']	=	'pending';
        $jo 																=  	mvc_model('model.lot_wes_job_order')->insert($_POST['lot_wes_job_order']);
        header_location("/finance_wes/water_account/job_order_history/&id={$id}");    
	}
	
	 public function submit_edit_account_details($parent)
    {
    	# DB
        $id									        	=  	$_POST['lot_wes_id'];
        $data											=	mvc_model('model.lot_wes')->select($id);
		//insert old data from lot_wes
		$post['int']['user_id']							=	$parent->user['user_id'];
        $post['int']['lot_wes_id']						=	$id;
        $post['int']['lot_wes_sin_number']				=	'';
        $post['int']['lot_wes_meter_number']			=	$data['lot_wes_meter_number'];
        $post['int']['lot_wes_date_start']				=	$data['lot_wes_date_start'];
        $post['str']['lot_wes_status_id']				=	$data['lot_wes_status_id'];
        $post['int']['option_wes_water_rate_id']		=	$data['option_wes_water_rate_id'];
        $log 											=  	mvc_model('model.lot_wes_log')->insert($post);
		
		
		$_POST['lot_wes']['int']['lot_wes_date_start'] 	=  	strtotime($_POST['lot_wes']['int']['lot_wes_date_start']);
		$update_entry								    =  	mvc_model('model.lot_wes')->update($_POST['lot_wes'],$id);
     
        
        header_location("/finance_wes/water_account/profile/&id={$id}");    
	}
	
	 public function submit_payment($parent)
    {
       $id                                         			    			=   $_POST['id']*1;
       $data																=	mvc_model('model.lot_wes')->select($id);	
    	# DB
           
	   
	   //update reading status
	   $post['str']['lot_wes_reading_status_id']				=	'paid';
	   $update_reading 											=  	mvc_model('model.lot_wes_reading')->update($post,$id);
	   
	 
	   //update invoice
	   $in_post['int']['client_account_invoice_surcharge_amount']				=	$_POST['lot_wes_account_receive']['int']['lot_wes_account_receive_surcharge'];
	   $in_post['int']['client_account_invoice_surcharge_amount_collected']		=	$_POST['lot_wes_account_receive']['int']['lot_wes_account_receive_surcharge'];
	   $in_post['int']['client_account_invoice_amount_collected']				=	$_POST['lot_wes_account_receive']['int']['lot_wes_account_receive_amount_net'];
	   $in_post['str']['option_invoice_status_id']								=	'settled';    
	   $update_invoice															=	mvc_model('model.client_account_invoice')->update_utilities($in_post,$data['invoice']['client_account_invoice_id']);	
       
       //insert account receive
       $_POST['lot_wes_account_receive']['int']['lot_wes_account_receive_amount_net'] 	= $_POST['lot_wes_account_receive']['int']['lot_wes_account_receive_amount_gross']-$_POST['lot_wes_account_receive']['int']['lot_wes_account_receive_amount_change'];
       $_POST['lot_wes_account_receive']['int']['user_id']								=	$parent->user['user_id'];
       $_POST['lot_wes_account_receive']['int']['lot_wes_reading_id']					=	$id;
	   $entry =  mvc_model('model.lot_wes_account_receive')->insert($_POST['lot_wes_account_receive']);
       
       //remarks
        $remark								=	$_POST['remark'];
		$remark['int']['user_id']			=	$parent->user['user_id'];
		$remark['int']['remark_key_id']		=	$id;
		mvc_model('model.remark')->insert($remark);
       
       header_location("/finance_wes/water_account/profile/&id={$id}");    
	}
	
	 public function submit_remark($parent)
	{
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/finance_wes/water_account/remark/&id={$_POST['lot_wes_id']}");
	}
    
    
}