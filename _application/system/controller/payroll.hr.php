<?php
class payroll_hr
{
    
    public function __construct()
    {    	
       	$this->controller_id 			= 	'payroll_hr';
    }
 
   public function index($parent)
    {           
        # DB
         
        # VIEW
       $this->attendance($parent);
    } 
    
    
    public function attendance($parent)
    {      	
    	
    	# DB
    	$data['row.attendance']						 =	mvc_model('model.user_payroll_attendance_adjustment')->select_all();  
    	# VIEW - side nav
        $side_nav['attendance.class']				 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.hr', $side_nav);       
        # VIEW
        $parent->_view('hr.attendance', $data);          
    } 
    
    public function leaves($parent)
    {      	
    	
    	# DB
    	$data['row.leave']						 	=	mvc_model('model.user_payroll_leave')->select_all_by_hr();
    	# VIEW - side nav
        $side_nav['leaves.class']				 	 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.hr', $side_nav);       
        # VIEW
        $parent->_view('hr.leaves', $data);          
    } 
    
    public function ot($parent)
    {      	
    	
    	# DB
    	$data['row.ot']						 		  =	mvc_model('model.user_payroll_ot')->select_all();
    	# VIEW - side nav
        $side_nav['ot.class']				 		 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.hr', $side_nav);       
        # VIEW
        $parent->_view('hr.ot', $data);          
    } 
    
   
       
 
 //======================================FORMS
 	
 	public function adjustment_request($parent)
    {
    	$data['id'] 								 = $_GET['id']*1;
    	# DB
    	$data 										 =  mvc_model('model.user_payroll_attendance_adjustment')->select($data['id']);
    	
    	$status									 	 =	mvc_model('model.option')->select_option('option_payroll_status');
    	$data['status']							 	 =	hash_to_option($status, 'option_payroll_status_id', 'option_payroll_status_name',$data['option_payroll_status_id']);
        # VIEW - side nav
        $side_nav['attendance.class']			     =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.hr', $side_nav);         	          
       //hash_dump($data,1);
     	# VIEW
        $parent->_view('hr.form.adjustment.request', $data);        
	}
	
	
	public function ot_request($parent)
    {
    	$data['id'] 								 = $_GET['id']*1;
    	# DB
    	$data 										 =  mvc_model('model.user_payroll_ot')->select($data['id']);
    	$status									 	 =	mvc_model('model.option')->select_option('option_payroll_status');
    	$data['status']							 	 =	hash_to_option($status, 'option_payroll_status_id', 'option_payroll_status_name',$data['option_payroll_status_id']);
        # VIEW - side nav
        $side_nav['ot.class']			    		 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.hr', $side_nav);         	          
       
     	# VIEW
        $parent->_view('hr.form.ot.request', $data);        
	}
	
	public function leave_request($parent)
    {
    	$data['id'] 								 = $_GET['id']*1; 
    	# DB
    	$data 										 =  mvc_model('model.user_payroll_leave')->select($data['id']);
    	$status									 	 =	mvc_model('model.option')->select_option('option_payroll_status');
    	$data['status']							 	 =	hash_to_option($status, 'option_payroll_status_id', 'option_payroll_status_name',$data['option_payroll_status_id']);
        # VIEW - side nav
        $side_nav['leaves.class']			    	 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.hr', $side_nav);         	          
       
     	# VIEW
        $parent->_view('hr.form.leave.request', $data);        
	}
    
  #----------------------- Form Actions
  
 	public function submit_adjustment_request($parent)
	{		
    	
    	if($_POST['stat']['str']['option_payroll_status_id'] == 'approved')
    	{
			
			$data 					    				=  mvc_model('model.user_payroll_attendance_adjustment')->select($_POST['id']);
			
				$post['int']['is_official_business']		=  $data['is_official_business'];
				$post['int']['timestamp_in']				=  $data['user_payroll_attendance_adjustment_time_in'];
				$post['int']['timestamp_out']				=  $data['user_payroll_attendance_adjustment_time_out'];
				$post['int']['timestamp_break_in']			=  $data['user_payroll_attendance_adjustment_break_in'];
				$post['int']['timestamp_break_out']			=  $data['user_payroll_attendance_adjustment_break_out'];
			
			$update 									=  mvc_model('model.user_payroll_attendance')->update($post, $data['user_payroll_attendance_id']);
    	}
		$_POST['stat']['int']['user_payroll_attendance_adjustment_date_approved']	=  time();
		$ticket 							     					 				=  mvc_model('model.user_payroll_attendance_adjustment')->update($_POST['stat'],$_POST['id']);
		header_location("/payroll/hr/attendance/");
	}
	
	
	public function submit_ot_request($parent)
	{		
		$_POST['ot']['int']['user_payroll_ot_date_approved']						=  time();
		$ticket 							     					 				=  mvc_model('model.user_payroll_ot')->update($_POST['ot'],$_POST['id']);
		
		
		if($_POST['ot']['str']['option_payroll_status_id'] == 'approved')
		{
			$post['int']['user_excess_minutes']		=   0;
			$update									=	mvc_model('model.user_payroll_attendance')->update($post,$_POST['user_payroll_attendance_id']);
		}
		header_location("/payroll/hr/ot/");
	}
	
	public function submit_leave_request($parent)
	{		
		
		if($_POST['leave']['str']['option_payroll_status_id'] == 'approved')
		{
			// hash_dump($_POST,1);
			$user					 								=	mvc_model('model.user')->select($_POST['user_id']);
			$schedule												=   mvc_model('model.payroll_schedule')->select($user['payroll_schedule_id']);
			$fiscal_data											=	mvc_model('model.sysglobal_payroll')->select_active();
			$leave_type												=	$_POST['type'];
    		$leave_count											=	mvc_model('model.user_payroll_leave')->get_count_user_type($user['user_id'],$leave_type,$schedule);
			if($_POST['whole'] == 0)
			{
				$leave_duration_array['whole'] = 0;
				$leave_duration_array['hrs']   = $_POST['hrs'];
			}
			else
			{
				$leave_duration_array['whole'] = 1;
				$leave_duration_array['hrs']   = 0;
			}
			$check_update_available									=   $this->get_days_hours_remain_numeric($fiscal_data,$leave_duration_array,$leave_count,$leave_type,$user,$schedule);
			
		}
		else
		{
			$check_update_available									=	1;
		}
		
		$_POST['leave']['int']['user_payroll_leave_date_approved']	=  time();
		
		if($check_update_available == 1)
		{
			$ticket 							     				=  mvc_model('model.user_payroll_leave')->update($_POST['leave'],$_POST['id']);
		}
		
		header_location("/payroll/hr/leaves/");
	}
	
	
	private function get_days_hours_remain_numeric($fiscal_data_count,$leave_duration_array,$leave_count_array,$leave_type,$user,$sched)
	{		
		
		if($leave_duration_array['whole'] == 1)
    	{
			
			 $check_converted		=   mvc_model('model.user_payroll_leave_convert')->select_by_fiscal_id_user($fiscal_data_count['sysglobal_payroll_id'],$user['user_id'],$leave_type);
			if($check_converted)
			{
				$leave_count_array['whole_count'] += $check_converted['user_payroll_leave_count_day'];
				$leave_count_array['hour_count']  += $check_converted['user_payroll_leave_count_hour'];
				
				if($sched['payroll_schedule_work_hours']==$leave_count_array['hour_count'])
				{
					$leave_count_array['hour_count']   = 0;
					$leave_count_array['whole_count'] += 1;
				}
				
			}
			 
			 // hash_dump($leave_count_array,1);
			 
			 if($leave_count_array['whole_count'] < $fiscal_data_count[$leave_type])
			 {
				 $return = 1;
			 }
			 else
			 {
				// hash_dump($user,1);
				 //check available leaves
				 if($leave_type == 'payroll_leave_sick')
				 {
					 if($user['available_sick_leave'] > 0)
					 {
						 $post['int']['available_sick_leave']		=	$user['available_sick_leave']-1;
						 mvc_model('model.user')->update($post, $user['user_id']);	
						  $return = 1;
					 }
					 else
					 {
						  $return = 0;
					 }
				 }
				 elseif($leave_type == 'payroll_leave_vacation')
				 {
					 if($user['available_vacation_leave'] > 0)
					 {
						 $post['int']['available_vacation_leave']		=	$user['available_vacation_leave']-1;
						 mvc_model('model.user')->update($post, $user['user_id']);
						 $return = 1;
					 }
					  else
					 {
						  $return = 0;
					 }
				 }
				 else
				 {
					 $return = 0;
				 }
			 }
			
    	}
    	else
    	{
			 $return = 1;
    	}
    	
    	return $return;
	
	}
	
	
	
    
}