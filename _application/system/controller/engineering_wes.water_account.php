<?php
class engineering_wes_water_account
{
    
    public function __construct()
    {    	
       	$this->controller_id 			= 	'engineering_wes_water_account';
    }
 
   public function index($parent)
    {           
        $filter										 =  $_GET['filter_type'];
        if($filter != 'all' && !empty($filter))
        {
			$filter_cond							 =  " AND lot_wes.lot_wes_status_id='".$filter."'";
			$all								 	 =  '<option value="all">All</option>';
        }
        else
        {
			$filter_cond							=   '';
			$all								 	=  '<option value="all" selected="selected">All</option>';
        }
        # DB
        $option_filter								=	mvc_model('model.option')->select_option('lot_wes_status', "WHERE lot_wes_status_id !='meralco'");
		$data['option_filter']						=	hash_to_option($option_filter, 'lot_wes_status_id', 'lot_wes_status_name',$filter,'/');
		$data['option_filter']						=	$data['option_filter'].$all;
		$data['row.account']						=	mvc_model('model.lot_wes')->select_all_by_type('water','engineering',$filter_cond); 
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
    
     public function detail_history($parent)
    {      	
    	$id											=   $_GET['id']*1;
    	# DB
		$data['row.history']						=	mvc_model('model.lot_wes_log')->select_all($id,'water'); 
        # VIEW - side nav
        $side_nav['detail_history.class']			=	'bold';         	
        $side_nav['lot_wes_id']						=	$id;      	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.water_account', $side_nav);       
        # VIEW
        $parent->_view('water_account.detail_history', $data);        
    }
    
     public function job_order_history($parent)
    {      	
    	$id											=   $_GET['id']*1;
    	# DB
		$data['row.job_order']						=	mvc_model('model.lot_wes_job_order')->select_all('WHERE lot_wes_job_order.lot_wes_id='.$id); 
        # VIEW - side nav
        $side_nav['job_order_history.class']		=	'bold';         	
        $side_nav['lot_wes_id']						=	$id;      	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.water_account', $side_nav);       
        # VIEW
        $parent->_view('water_account.job_order_history', $data);        
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
        
        //remarks
        $remark								=	$_POST['remark'];
		$remark['int']['user_id']			=	$parent->user['user_id'];
		$remark['int']['remark_key_id']		=	$id;
		mvc_model('model.remark')->insert($remark);
		
        header_location("/engineering_wes/water_account/job_order_history/&id={$id}");    
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
     
        
        header_location("/engineering_wes/water_account/profile/&id={$id}");    
	}
	
	 public function submit_remark($parent)
	{
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/engineering_wes/water_account/remark/&id={$_POST['lot_wes_id']}");
	}
    
 
    
}