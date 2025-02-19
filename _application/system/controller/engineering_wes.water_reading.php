<?php
class engineering_wes_water_reading
{
    
    public function __construct()
    {    	
       	$this->controller_id 			= 	'engineering_wes_water_reading';
    }
 
   public function index($parent)
    {           
        $filter										 =  $_GET['filter_type'];
        $opt 						     			 = "'for_billing','for_delivery','pending'";
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
   		$data['row.reading']						 =	mvc_model('model.lot_wes_reading')->select_all('water','engineering',$filter_cond);
        # VIEW
        $parent->_view('water_reading', $data);
    } 
    
        public function profile($parent)
    {      	
    	$id											=   $_GET['id']*1;
    	# DB
		$data										=	mvc_model('model.lot_wes_reading')->select($id);
		$data['lot_wes_curr_reading']    			=  ($data['lot_wes_curr_reading'] > 0) ?  $data['lot_wes_curr_reading'] : 'N/A';
        # VIEW - side nav
        $side_nav['profile.class']					=	'bold';         	
       	$side_nav['lot_wes_reading_id']				=	$id;         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.water_reading', $side_nav);       
        # VIEW
        $parent->_view('water_reading.profile', $data);        
    } 
    
    
    public function billing_statement($parent)
    {      	
    	$id											=   $_GET['id']*1;
    	# DB
    	$id						    				=   $_GET['id']*1;
    	# DB
       	$data										=	mvc_model('model.lot_wes_reading')->select($id);
		$data['prev_reading']						=   mvc_model('model.lot_wes_reading')->get_by_lot_wes_id($data['lot_wes_id']," AND lot_wes_reading_id !={$id}");
		$data['sys_wes']							=	mvc_model('model.sysglobal_wes')->select();
		if($data['prev_reading'])
		{
			
			$data['prev']															 =	 mvc_model('model.lot_wes_account_receive')->select($id);
			$data['prev_reading']['lot_wes_reading_from_date']               		 =   ($data['prev_reading']['lot_wes_reading_from_date']) ? string_date($data['prev_reading']['lot_wes_reading_from_date']) : 'N/A';
			$data['prev_reading']['lot_wes_reading_date']               			 =   ($data['prev_reading']['lot_wes_reading_date']) ? string_date($data['prev_reading']['lot_wes_reading_date']) : 'N/A';
			$data['prev']['lot_wes_account_receive_total_amount_due_actual'] 		 =   ($data['prev_reading']['lot_wes_account_receive_total_amount_due_actual']) ? string_amount($data['prev_reading']['lot_wes_account_receive_total_amount_due_actual']) : '0.00';
			$data['prev']['lot_wes_account_receive_timestamp']               		 =   ($data['prev_reading']['lot_wes_account_receive_timestamp']) ? string_date($data['prev_reading']['lot_wes_account_receive_timestamp']) : 'N/A';		
			$data['prev']['lot_wes_account_receive_receipt']               		 	 =   ($data['prev_reading']['lot_wes_account_receive_receipt']) ? string_date($data['prev_reading']['lot_wes_account_receive_receipt']) : 'N/A';
		}
		else
		{
			$data['prev_reading']['lot_wes_reading_from_date']               		 =   'N/A';
			$data['prev_reading']['lot_wes_reading_date']               			 =   'N/A';
			$data['prev']['lot_wes_account_receive_receipt']              			 =   'N/A';
			$data['prev']['lot_wes_account_receive_total_amount_due_actual'] 		 =   '0.00';
			$data['prev']['lot_wes_account_receive_timestamp']                       =   'N/A';
		}	
		
		$data['vat']								=  $data['lot_wes_reading_current_charge'] *($data['lot_wes_reading_vat_rate']/100);
		
		$misc										=   mvc_model('model.lot_wes_reading_other_fee')->select_all($id);
		
		$data['misc_total']							=	0;
		$data['misc_row']							=	'';
		foreach($misc as $row)
		{
			$data['misc_total']					   +=  $row['option_wes_charge_amount'];
			$data['misc_row']					   .=	' <tr>
						                                    <td class="bg_fff">'.$row['option_wes_charge_name'].':</td>
						                                    <td align="right" class="bg_fff">'.string_amount($row['option_wes_charge_amount']).'</td>
						                                </tr>';
		}
		
        # VIEW - side nav
        $side_nav['billing_statement.class']		=	'bold';         	
       	$side_nav['lot_wes_reading_id']				=	$id;         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.water_reading', $side_nav);       
        # VIEW
        $parent->_view('water_reading.billing_statement', $data);        
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
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.water_reading', $side_nav);           
        # VIEW
        $parent->_view('water_reading.remark', $data);      
	}
    
 //======================================FORMS
 
  
    public function letter($parent)
    {      	
    	$id						    				=   $_GET['id']*1;
    	# DB
       	$data										=	mvc_model('model.lot_wes_reading')->select($id);
		$data['prev_reading']						=   mvc_model('model.lot_wes_reading')->get_by_lot_wes_id($data['lot_wes_id']," AND lot_wes_reading_id !={$id}");
		$data['sys_wes']							=	mvc_model('model.sysglobal_wes')->select();
		if($data['prev_reading'])
		{
			
			$data['prev']															 =	 mvc_model('model.lot_wes_account_receive')->select($id);
			$data['prev_reading']['lot_wes_reading_from_date']               		 =   ($data['prev_reading']['lot_wes_reading_from_date']) ? string_date($data['prev_reading']['lot_wes_reading_from_date']) : 'N/A';
			$data['prev_reading']['lot_wes_reading_date']               			 =   ($data['prev_reading']['lot_wes_reading_date']) ? string_date($data['prev_reading']['lot_wes_reading_date']) : 'N/A';
			$data['prev']['lot_wes_account_receive_total_amount_due_actual'] 		 =   ($data['prev_reading']['lot_wes_account_receive_total_amount_due_actual']) ? string_amount($data['prev_reading']['lot_wes_account_receive_total_amount_due_actual']) : '0.00';
			$data['prev']['lot_wes_account_receive_timestamp']               		 =   ($data['prev_reading']['lot_wes_account_receive_timestamp']) ? string_date($data['prev_reading']['lot_wes_account_receive_timestamp']) : 'N/A';		
			$data['prev']['lot_wes_account_receive_receipt']               		 	 =   ($data['prev_reading']['lot_wes_account_receive_receipt']) ? string_date($data['prev_reading']['lot_wes_account_receive_receipt']) : 'N/A';
		}
		else
		{
			$data['prev_reading']['lot_wes_reading_from_date']               		 =   'N/A';
			$data['prev_reading']['lot_wes_reading_date']               			 =   'N/A';
			$data['prev']['lot_wes_account_receive_receipt']              			 =   'N/A';
			$data['prev']['lot_wes_account_receive_total_amount_due_actual'] 		 =   '0.00';
			$data['prev']['lot_wes_account_receive_timestamp']                       =   'N/A';
		}	
		
		$data['vat']								=  $data['lot_wes_reading_current_charge'] *($data['lot_wes_reading_vat_rate']/100);
		
		$misc										=   mvc_model('model.lot_wes_reading_other_fee')->select_all($id);
		
		$data['misc_total']							=	0;
		$data['misc_row']							=	'';
		foreach($misc as $row)
		{
			$data['misc_total']					   +=  $row['option_wes_charge_amount'];
			$data['misc_row']					   .=	' <tr>
						                                    <td class="bg_fff">'.$row['option_wes_charge_name'].':</td>
						                                    <td align="right" class="bg_fff">'.string_amount($row['option_wes_charge_amount']).'</td>
						                                </tr>';
		}
		
                   
		$parent->letter($_GET['letter'], $data);      
    }
    
     public function report($parent)
    {      	
    	# DB
    	if($_GET['report'] == 'water_meter_reading')
    	{
			$data['row.list'] =	mvc_model('model.lot_wes_reading')->select_reading_due_accounts('water');
    	}
    	else
    	{
			
    	}
      
                   
		$parent->report($_GET['report'], $data);      
    }
  
     public function input_reading($parent)
    {      	
    	$id											=   $_GET['id']*1;
    	# DB
		$data										=   mvc_model('model.lot_wes_reading')->select_by_type($id,'water');
		$misc										=   mvc_model('model.lot_wes_reading_other_fee')->select_all($id);
		$data['misc_total']							=	0;
		foreach($misc as $row)
		{
			$data['misc_total']					   +=  $row['option_wes_charge_amount'];
		}
		
        # VIEW - side nav
        $side_nav['input_reading.class']			=	'bold'; 
        $side_nav['lot_wes_reading_id']				=	$id;         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.water_reading', $side_nav);       
        # VIEW
        $parent->_view('water_reading.form.input_reading', $data);        
    }
    
    
     public function status_settings($parent)
    {      	
    	$id											=   $_GET['id']*1;
    	# DB
    	$data										=   mvc_model('model.lot_wes_reading')->select($id); 
		$reading_status								=	mvc_model('model.option')->select_option('lot_wes_reading_status');
		$data['reading_status']						=	hash_to_option($reading_status, 'lot_wes_reading_status_id', 'lot_wes_reading_status_name',$data['lot_wes_reading_status_id']);
        # VIEW - side nav
        $side_nav['status_settings.class']			=	'bold'; 
        $side_nav['lot_wes_reading_id']				=	$id;         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.water_reading', $side_nav);       
        # VIEW
        $parent->_view('water_reading.form.status_settings', $data);        
    }
    
   //===============================Form Action=========================
    
     public function submit_input_reading($parent)
    {
    	 $id									        					=  	$_POST['lot_wes_reading_id'];
    	# DB
        $update_reading 													=  	mvc_model('model.lot_wes_reading')->update($_POST['lot_wes_reading'],$id);
        $data																=   mvc_model('model.lot_wes_reading')->select($id); 
        $invoice_payment													=	mvc_model('model.client_account_invoice')->insert_utilities($data);
  
        $post['int']['lot_wes_reading_id']									=	$id;
        $post['int']['client_account_invoice_id']							=	$invoice_payment['client_account_invoice_id'];
       
        $invoice_reading													=	mvc_model('model.lot_wes_reading_invoice')->insert($post);
        header_location("/engineering_wes/water_reading/profile/&id={$id}");    
	}
	
	
	 public function submit_status_settings($parent)
    {
    	 $id									        					=  	$_POST['lot_wes_reading_id'];
    	# DB
        $update_reading 													=  	mvc_model('model.lot_wes_reading')->update($_POST['lot_wes_reading'],$id);
        
        //remarks
        $remark								=	$_POST['remark'];
		$remark['int']['user_id']			=	$parent->user['user_id'];
		$remark['int']['remark_key_id']		=	$id;
		mvc_model('model.remark')->insert($remark);
        
        header_location("/engineering_wes/water_reading/profile/&id={$id}");    
	}
	
	 public function check_insert($parent)
    {
    	 $acc_data															=  	mvc_model('model.lot_wes')->select_all_unsorted('water');
    	 foreach($acc_data as $row)
    	 {
			 $read_date														=	$row['lot_wes_date_start'];
			 $read_year 													=	string_date_year($read_date); 
			 $read_month 													=	string_date_month_numeric($read_date); 
			 $read_day 														=	string_date_date($read_date);
			// $read_date														=	$read_year.$read_month.$read_day;
			 
			 $curr_date														=	time();
			 $curr_year 													=	string_date_year($curr_date); 
			 $curr_month 													=	string_date_month_numeric($curr_date); 
			 $curr_day 														=	string_date_date($curr_date);
			// $curr_date														=	$curr_year.$curr_month.$curr_day;
			
			 if($read_date <= $curr_date)
			 {
				 $prev_data														=	mvc_model('model.lot_wes_reading')->get_by_lot_wes_id($row['lot_wes_id']);
				 
				 $prev_reading													=  ($prev_data) ? $prev_data['lot_wes_curr_reading'] : $row['lot_wes_meter_reading'] ;
				
				 $reading_date											    	=	string_date($row['lot_wes_date_start']);
				 $date_timestamp_reading_from 									=  strtotime($reading_date . "+1 day"); // Set Reading From Date
				//set due date
				$due_days														=  $row['option_wes_water_rate_due_day']*1;
				$disc_days														=  $row['option_wes_water_rate_day_limit']*1; //get days before disconnection
				$due_days														=  $due_days*86400;
				$disc_days														=  $disc_days*86400;
				 
					if($row['lot_wes_bill_duration_id'] == 'monthly')
					{
						 $date_timestamp_reading_next 							=  strtotime($reading_date . "+1 month");//for update on lot_wes for next reading triggger
						 $misc_multiplier										=  1; //multiplier for other charges	
					}
					if($row['lot_wes_bill_duration_id'] == 'quarterly')
					{
						 $date_timestamp_reading_next 							=  strtotime($reading_date . "+3 month");
						 $misc_multiplier										=  3;
					}
					if($row['lot_wes_bill_duration_id'] == 'biannually')
					{
						 $date_timestamp_reading_next 							=  strtotime($reading_date . "+6 month");
						 $misc_multiplier										=  6;
					}
					if($row['lot_wes_bill_duration_id'] == 'annually')
					{
						 $date_timestamp_reading_next 							=  strtotime($reading_date . "+12 month");
						 $misc_multiplier										=  12;
					}
					
				//Prep Insert
				 $reading_post['int']['lot_wes_reading_due_date']				=	$row['lot_wes_date_start'] + $due_days;
				 $reading_post['int']['lot_wes_reading_disc_date']				=	$reading_post['int']['lot_wes_reading_due_date'] + $disc_days;
				 $reading_post['int']['lot_wes_reading_from_date']				=	$date_timestamp_reading_from;
				 $reading_post['int']['lot_wes_reading_date']				    =	$row['lot_wes_date_start'];
				 $reading_post['int']['lot_wes_id']				    			=	$row['lot_wes_id'];
				 $reading_post['str']['lot_wes_type']				    		=	'water';
				 $reading_post['int']['lot_wes_prev_reading']				    =	$prev_reading;
				 $reading_post['int']['lot_wes_curr_reading']				    =	0;
				 $reading_post['int']['lot_wes_reading_vat_rate']				=	12;
				 $reading_post['int']['client_account_id']						=	$row['client_account_id'];
				 $reading_post['str']['lot_wes_reading_status_id']				=	'pending';
				 $insert														=	mvc_model('model.lot_wes_reading')->insert($reading_post);
				 $reading_id													=   $insert['data']['lot_wes_reading_id'];
				 
			 	// Add other Charges	
			 		$other_fee_data												=  	mvc_model('model.option_wes_charge_project')->select_all_by_project($row['project_id']);
			 		foreach($other_fee_data as $fee_row)
			 		{
						$fee_post['int']['lot_wes_reading_id']					=	$reading_id;
				 		$fee_post['int']['option_wes_charge_id']				=	$fee_row['option_wes_charge_id'];
				 		$fee_post['int']['option_wes_charge_amount']		    =	$fee_row['option_wes_charge_amount']*$misc_multiplier;
				 		$insert_entry 											= 	mvc_model('model.lot_wes_reading_other_fee')->insert($fee_post);
			 		}
			 		
			 	 //set trigger of reading for next month
			     $post['int']['lot_wes_date_start']								=	$date_timestamp_reading_next;
			     $update_entry								    				=  	mvc_model('model.lot_wes')->update($post,$row['lot_wes_id']);
			 }//end if
    	 }//end foreach	
     
	}
	
	 public function submit_remark($parent)
	{
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/engineering_wes/water_reading/remark/&id={$_POST['lot_wes_reading_id']}");
	}
	
	
	public function test($parent)
	{
		$curr_time = string_date(time());
		$curr_time = strtotime($curr_time. "-4 month +5 day");
		
		echo 'UNIX TIME:'. time().'<br>';
		echo 'TIME:'. string_date($curr_time).'<br>' ;
	}
	
//=====================AJAX=======================================
 public function get_rate($parent)
    {
       if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
        {
            $rate             			=    mvc_model('model.option.wes.water.rate.child')->select_by_range($_POST['rate_id'],$_POST['current_reading']);
            if($rate)
            {
				 $data                  =   $rate['option_wes_water_rate_child_amount'] ;
            }
            else
            {
				$data 					=   0;
            }
           
            echo $data; exit();
        }
        else
        {
            echo '';
        }
    }  
    
    public function update_bill($parent)
    {
       if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
        {
            
            $id									        						=  	$_POST['id'];
    		# DB
	        $post['str']['lot_wes_reading_status_id']							=   'for_delivery';
	        $update_reading 													=  	mvc_model('model.lot_wes_reading')->update($post,$id);
            echo 1; exit();
        }
        else
        {
            echo '';exit();
        }
    }	
	
}