<?php
class finance_wes_electric_reading
{
    
    public function __construct()
    {    	
       	$this->controller_id 			= 	'finance_wes_electric_reading';
    }
 
   public function index($parent)
    {           
        $filter										 =  $_GET['filter_type'];
        $opt 						     			 = "'bill_delivered','overdue'";
        $opt_cond						     		 =  " WHERE lot_wes_reading_status_id IN({$opt})";
        if($filter != 'all' && !empty($filter))
        {
			$filter_cond						     =  " AND lot_wes_reading.lot_wes_reading_status_id ='{$filter}'";
			$all								 	 =  '<option value="all">All</option>';
        }
        else
        {
			$all								 	 =   '<option value="all" selected="selected">All</option>';
			$filter_cond							 =   " AND lot_wes_reading.lot_wes_reading_status_id IN({$opt})";;
        }
        # DB
        $option_filter								=	mvc_model('model.option')->select_option('lot_wes_reading_status',$opt_cond);
		$data['option_filter']						=	hash_to_option($option_filter, 'lot_wes_reading_status_id', 'lot_wes_reading_status_name',$filter);
		$data['option_filter']						=	$data['option_filter'].$all;
   		$data['row.reading']						 =	mvc_model('model.lot_wes_reading')->select_all('electric','finance',$filter_cond);
        # VIEW
        $parent->_view('electric_reading', $data);
    } 
    
    public function profile($parent)
    {      	
    	$id											=   $_GET['id']*1;
    	# DB
		$data										=	mvc_model('model.lot_wes_reading')->select($id);
		$data['lot_wes_curr_reading']    			=  ($data['lot_wes_curr_reading'] > 0) ?  $data['lot_wes_curr_reading'] : 'N/A';
       
       	$data['lwar']							    =   mvc_model('model.lot_wes_account_receive')->select($id);
       	if($data['lwar'])
       	{
			 	$data['lwar']['user_']    		 	=  $data['lwar']['user_name'] .' '. $data['lwar']['user_surname'] ;
                $data['lwar']['receive_date']    	=  string_date($data['lwar']['lot_wes_account_receive_timestamp']);
                $data['lwar']['amount_receive']    	=  'P '.string_amount($data['lwar']['lot_wes_account_receive_amount_gross']);
       	}
       	else
       	{
				$data['lwar']['user_']    		 					=  'N/A';
                $data['lwar']['receive_date']    					=  'N/A';
                $data['lwar']['amount_receive']    					=  'N/A';
                $data['lwar']['lot_wes_account_receive_receipt']    =  'N/A';
                $data['lwar']['lot_wes_account_receive_payee']    	=  'N/A';
                $data['lwar']['option_payment_receipt_name']    	=  'N/A';
                $data['lwar']['option_payment_method_name']    		=  'N/A';
                $data['lwar']['option_payment_status_name']    		=  'N/A';
       	}
        # VIEW - side nav
        $side_nav['profile.class']					=	'bold';         	
       	$side_nav['lot_wes_reading_id']				=	$id;         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.electric_reading', $side_nav);       
        # VIEW
        $parent->_view('electric_reading.profile', $data);        
    }  
    
    
    public function remark($parent)
    {
    	$id											=   $_GET['id']*1;
    	$data['lot_wes_reading_id']					=	$id;
    	# DB
        $data['row.remark']							=	mvc_model('model.remark')->get_row('lot_wes_reading', $_GET['id']);            
        # VIEW - side nav
        $side_nav['remark.class']					=	'bold';         	
     	$side_nav['lot_wes_reading_id']				=	$id;          	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.electric_reading', $side_nav);           
        # VIEW
        $parent->_view('electric_reading.remark', $data);      
	}
    
 //======================================FORMS
  
      public function payment($parent)
    {
    	
    	$id											=   $_GET['id']*1;
        #DB
        $data										=   mvc_model('model.lot_wes_reading')->select($id);
		$data['invoice']							=	mvc_model('model.lot_wes_reading_invoice')->select_by_reading_id($id);
		$data['total_due']							=	$data['lot_wes_reading_current_total'] + $data['lot_wes_reading_surcharge'];
		
		$data['user_full_name']						=   $parent->user['user_name'] . ' ' . $parent->user['user_surname'];
        # VIEW - db options
         $option_payment_method						=	mvc_model('model.option')->select_option('option_payment_method');       	       	     	
        $option_payment_receipt						=	mvc_model('model.option')->select_option('option_payment_receipt');
        $option_payment_status						=	mvc_model('model.option')->select_option('option_payment_status');
       	$data['option_payment_status']				=	hash_to_option($option_payment_status, 'option_payment_status_id', 'option_payment_status_name', 'valid');
       	$data['option_payment_method']				=	hash_to_option($option_payment_method, 'option_payment_method_id', 'option_payment_method_name', 'cash');
       	$data['option_payment_receipt']				=	hash_to_option($option_payment_receipt, 'option_payment_receipt_id', 'option_payment_receipt_name', 'or');
       	
       
        # VIEW - side nav
        $side_nav['payment.class']					=	'bold';         	
       	$side_nav['lot_wes_reading_id']				=	$id;     	  	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.electric_reading', $side_nav);         	          
       
     	# VIEW
        $parent->_view('electric_reading.form.payment', $data);        
	}
	
	
	  public function payment_status($parent)
    {
    	
    	$id											=   $_GET['id']*1;
        #DB
        $data										=   mvc_model('model.lot_wes_account_receive')->select($id);
		if($data)
		{
			
		}
		else
		{
			 header_location("/finance_wes/electric_reading/profile/&id={$id}");    
		}
		
        # VIEW - db options
     
        $option_payment_status						=	mvc_model('model.option')->select_option('option_payment_status');
       	$data['option_payment_status']				=	hash_to_option($option_payment_status, 'option_payment_status_id', 'option_payment_status_name', $data['option_payment_status_id']);
      
       	
        # VIEW - side nav
        $side_nav['payment_status.class']			=	'bold';         	
       	$side_nav['lot_wes_reading_id']				=	$id;     	  	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.electric_reading', $side_nav);         	          
       
     	# VIEW
        $parent->_view('electric_reading.form.payment_status', $data);        
	}
	
	
  #----------------------- Form Actions
  
	 public function submit_payment($parent)
    {
       $id                                         			    			=   $_POST['id']*1;
       $lot_wes_id                                         			    	=   $_POST['lot_wes_id']*1;
    	# DB
       $_POST['lot_wes_account_receive']['int']['lot_wes_account_receive_amount_net'] 	= $_POST['lot_wes_account_receive']['int']['lot_wes_account_receive_amount_gross']-$_POST['lot_wes_account_receive']['int']['lot_wes_account_receive_amount_change'];
       $_POST['lot_wes_account_receive']['int']['user_id']								=	$parent->user['user_id'];
       $_POST['lot_wes_account_receive']['int']['lot_wes_reading_id']					=	$id;
	   
	   $entry =  mvc_model('model.lot_wes_account_receive')->insert($_POST['lot_wes_account_receive']);     
	   
	   //update reading status
	   $post['str']['lot_wes_reading_status_id']				=	'paid';
	   $update_reading 											=  	mvc_model('model.lot_wes_reading')->update($post,$id);
	   
	   
	   if($_POST['lot_wes_account_receive']['int']['lot_wes_account_receive_total_amount_due_actual'] != $_POST['lot_wes_account_receive']['int']['lot_wes_account_receive_total_amount_due_real'])
	   {
		   $log_post['int']['user_id']														=	$_POST['lot_wes_account_receive']['int']['user_id'];
		   $log_post['int']['lot_wes_account_receive_id']									=	$entry['data']['lot_wes_account_receive_id'];
		   $log_post['int']['lot_wes_account_receive_total_amount_due_real']				=	$_POST['lot_wes_account_receive']['int']['lot_wes_account_receive_total_amount_due_real'];
		   $log_post['int']['lot_wes_account_receive_total_amount_due_actual']				=	$_POST['lot_wes_account_receive']['int']['lot_wes_account_receive_total_amount_due_actual'];
		   $insert_log 																		=  	mvc_model('model.lot_wes_amount_log')->insert($log_post);
	   }
	   //update invoice
	   $in_post['int']['client_account_invoice_surcharge_amount']				=	$_POST['lot_wes_account_receive']['int']['lot_wes_account_receive_surcharge'];
	   $in_post['int']['client_account_invoice_surcharge_amount_collected']		=	$_POST['lot_wes_account_receive']['int']['lot_wes_account_receive_surcharge'];
	   $in_post['int']['client_account_invoice_amount_collected']				=	$_POST['lot_wes_account_receive']['int']['lot_wes_account_receive_amount_net'];
	   $in_post['str']['option_invoice_status_id']								=	'settled';    
	   $update_invoice															=	mvc_model('model.client_account_invoice')->update_utilities($in_post,$data['invoice']['client_account_invoice_id']);	
     
       //check pending disconnection
       $check_job_order 														=  	mvc_model('model.lot_wes_job_order')->select_job_order($lot_wes_id);
       if($check_job_order)
       {
		   $post_job['str']['lot_wes_job_order_status_id'] 		= 	'cancelled';
		   $update_job											=  	mvc_model('model.lot_wes_job_order')->update($post_job,$check_job_order['lot_wes_job_order_id']); 
       }
       
       //remarks
        $remark								=	$_POST['remark'];
		$remark['int']['user_id']			=	$parent->user['user_id'];
		$remark['int']['remark_key_id']		=	$id;
		mvc_model('model.remark')->insert($remark);
       
       header_location("/finance_wes/electric_reading/profile/&id={$id}");    
	}  
	
	 public function submit_change_status($parent)
    {
    	 $id									        				=  	$_POST['lot_wes_reading_id']*1;
    	 $lwar_id									        			=  	$_POST['lwar_id'];
    	# DB
        $update_status 													=  	mvc_model('model.lot_wes_account_receive')->update($_POST['lot_wes_account_receive'],$lwar_id);
        
        //remarks
        $remark								=	$_POST['remark'];
		$remark['int']['user_id']			=	$parent->user['user_id'];
		$remark['int']['remark_key_id']		=	$id;
		mvc_model('model.remark')->insert($remark);
       
        header_location("/finance_wes/electric_reading/profile/&id={$id}");    
	}
	
	public function submit_remark($parent)
	 {
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/finance_wes/electric_reading/remark/&id={$_POST['lot_wes_reading_id']}");
	}
    
}