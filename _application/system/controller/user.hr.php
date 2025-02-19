<?php
class user_hr
{
    
    public function __construct()
    {    	
       	$this->controller_id 			= 	'user_hr';
    }
 
   public function index($parent)
    {           
        # DB
        
        # VIEW
       $this->attendance($parent);
    } 
    
    
    public function attendance($parent)
    {      	
    	$cut_off_id									=  $_GET['cutoff']*1;
    	$acitve_fiscal								=	mvc_model('model.sysglobal_payroll')->select_active();
    	if($cut_off_id >0)
    	{
			$c_id									=  $cut_off_id;
    	}
    	else
    	{
			$curr_time								=  time();
			$cutoff									=   mvc_model('model.payroll_cutoff')->get_current_cutoff($acitve_fiscal['sysglobal_payroll_id']*1,$curr_time);
    		$c_id									=   $cutoff['payroll_cutoff_id']*1;
    	}
    	
    	
    	# DB
    	$data['row.attendance']						 =	mvc_model('model.user_payroll_attendance')->select_all_by_user_attendance_adjustment($c_id,$parent->user['user_id']);
    	
    	$option										=	mvc_model('model.option')->select_option('payroll_cutoff', 'WHERE sysglobal_payroll_id='.($acitve_fiscal['sysglobal_payroll_id']*1).' ORDER BY payroll_cutoff_id ASC');
    	
    	$label[0]									=  'payroll_cutoff_date_start';
    	$label[1]									=  'payroll_cutoff_date_end';
    	$data['filter_type']						=	hash_cutoff($option, 'payroll_cutoff_id', $label,$c_id);
    	# VIEW - side nav
        $side_nav['attendance.class']				 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.hr', $side_nav);       
        # VIEW
        $data[$this->controller_id.'_class']		 =	'class="active"';  
        $data[$this->controller_id]					 =	'<i></i>';
        $parent->_view('hr.attendance', $data);          
    } 
    
    public function leaves($parent)
    {      	
    	$cut_off_id									=  $_GET['cutoff']*1;
    	$acitve_fiscal								=	mvc_model('model.sysglobal_payroll')->select_active();
    	if($cut_off_id >0)
    	{
			$c_id									=  $cut_off_id;
    	}
    	else
    	{
			$curr_time								=  time();
			$cutoff									=   mvc_model('model.payroll_cutoff')->get_current_cutoff($acitve_fiscal['sysglobal_payroll_id']*1,$curr_time);
    		$c_id									=   $cutoff['payroll_cutoff_id']*1;
    	}
    	# DB	
    	$data['row.daily_stamp']					=	mvc_model('model.user_payroll_attendance')->select_all_by_cutoff_leave($c_id,$parent->user['user_id']);
    	$option										=	mvc_model('model.option')->select_option('payroll_cutoff', 'WHERE sysglobal_payroll_id='.($acitve_fiscal['sysglobal_payroll_id']*1).' ORDER BY payroll_cutoff_id ASC');
    	$label[0]									=  'payroll_cutoff_date_start';
    	$label[1]									=  'payroll_cutoff_date_end';
    	$data['user']						 		=	mvc_model('model.user')->select($parent->user['user_id']);
    	$data['filter_type']						=	hash_cutoff($option, 'payroll_cutoff_id', $label,$c_id);
    	$data['fiscal']								=	$acitve_fiscal;
    	$counts										=   $this->leave_counts($data);
    	$data['counts']								=   $counts;
    	//hash_dump($data,1);
    	# VIEW - side nav
        $side_nav['leaves.class']				 	 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.hr', $side_nav);       
        # VIEW
        $data[$this->controller_id.'_class']		 =	'class="active"';
        $data[$this->controller_id]					 =	'<i></i>';
        $parent->_view('hr.leaves', $data);          
    } 
    
    public function ot($parent)
    {      	
    	
    	$cut_off_id									=  $_GET['cutoff']*1;
    	$acitve_fiscal								=	mvc_model('model.sysglobal_payroll')->select_active();
    	if($cut_off_id >0)
    	{
			$c_id									=  $cut_off_id;
    	}
    	else
    	{
			$curr_time								=  time();
			$cutoff									=   mvc_model('model.payroll_cutoff')->get_current_cutoff($acitve_fiscal['sysglobal_payroll_id']*1,$curr_time);
    		$c_id									=   $cutoff['payroll_cutoff_id']*1;
    	}
    	# DB	
    	$data['row.daily_stamp']					=	mvc_model('model.user_payroll_attendance')->select_all_by_cutoff_ot($c_id,$parent->user['user_id']);
    	
    	$option										=	mvc_model('model.option')->select_option('payroll_cutoff', 'WHERE sysglobal_payroll_id='.($acitve_fiscal['sysglobal_payroll_id']*1).' ORDER BY payroll_cutoff_id ASC');
    	$label[0]									=  'payroll_cutoff_date_start';
    	$label[1]									=  'payroll_cutoff_date_end';
    	$data['filter_type']						=	hash_cutoff($option, 'payroll_cutoff_id', $label,$c_id);
    	# VIEW - side nav
        $side_nav['ot.class']				 		 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.hr', $side_nav);       
        # VIEW
        $data[$this->controller_id.'_class']		 =	'class="active"';
        $data[$this->controller_id]					 =	'<i></i>';
        $parent->_view('hr.ot', $data);          
    } 
    
      
    
 
 //======================================FORMS
 	
 	
	public function adjustment_request($parent)
    {
    	$data['id'] 								 = $_GET['id']*1;
    	# DB
    	$data 										 =  mvc_model('model.user_payroll_attendance')->select($data['id']);
    	//hash_dump($data,1);
        for($i=0;$i<24;$i++)
        {
			$i					 =  ($i == 0) ? '0'.$i : $i;
			$data['opt_hour']	.=  '<option value="'.$i.'">'.$i.'</option>';
        }
        for($x=0;$x<60;$x++)
        {
			$x					 =  ($x < 10) ? '0'.$x : $x;
			$data['opt_min']	.=  '<option value="'.$x.'">'.$x.'</option>';
        }
        # VIEW - side nav
        $side_nav['attendance.class']			     =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.hr', $side_nav);         	          
       
     	# VIEW
     	$data[$this->controller_id.'_class']		 =	'class="active"';
        $data[$this->controller_id]					 =	'<i></i>';
        $parent->_view('hr.form.adjustment.request', $data);        
	}
	
	
	public function ot_request($parent)
    {
    	$data['id'] 								 = $_GET['id']*1;
    	# DB
    	$data 										 =  mvc_model('model.user_payroll_attendance')->select($data['id']);
    	//hash_dump($data,1);
		$total_minute								 =   $data['user_excess_minutes'];
		$total_minute_early							 =   $data['user_excess_minutes_early'];
		
		
		if($total_minute >= 60)
		{
			$data['ot_hour']						 =   floor($total_minute/60);
			$data['ot_minute']						 =   $total_minute%60;
			
		}
		else
		{
			$data['ot_hour']						 =   0;
			$data['ot_minute']						 =   $total_minute;
		}
		if($total_minute_early >= 60)
		{
			$data['early_ot_hour']						 =   floor($total_minute_early/60);
			$data['early_ot_minute']						 =   $total_minute_early%60;
			
		}
		else
		{
			$data['early_ot_hour']						 	=   0;
			$data['early_ot_minute']						 =   $total_minute_early;
		}
		
        # VIEW - side nav
        $side_nav['ot.class']					    =	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.hr', $side_nav);         	          
       
     	# VIEW
     	$data[$this->controller_id.'_class']		 =	'class="active"';
        $data[$this->controller_id]					 =	'<i></i>';
        $parent->_view('hr.form.ot.request', $data);        
	}
	
	public function leave_request($parent)
    {
    	$data['id'] 								 = $_GET['id']*1;
    	$data 								 		 =  mvc_model('model.user_payroll_attendance')->select($data['id']);
    	
    	# DB	
    	$data['user_']						 		=	mvc_model('model.user')->select($parent->user['user_id']);
    	$option_leave								=	mvc_model('model.option')->select_option('user_payroll_leave_type');
    	$data['option_leave']						=	hash_to_option($option_leave, 'user_payroll_leave_type_id', 'user_payroll_leave_type_name');
        # VIEW - side nav
        $side_nav['leaves.class']				    =	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.hr', $side_nav);         	          
       
     	# VIEW
     	$data[$this->controller_id.'_class']		 =	'class="active"';
        $data[$this->controller_id]					 =	'<i></i>';
        $parent->_view('hr.form.leave.request', $data);        
	}
  
    
  #----------------------- Form Actions
  
 	 public function leave_counts($data)
    {      	
    	//hash_dump($data,1);
    	$schedule										=  mvc_model('model.payroll_schedule')->select($data['user']['payroll_schedule_id']);
    	$return['vl_count']								=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user']['user_id'],'payroll_leave_vacation',$schedule);
    	$return['sl_count']								=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user']['user_id'],'payroll_leave_sick',$schedule);
    	$return['el_count']								=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user']['user_id'],'payroll_leave_emergency',$schedule);
    	$return['mln_count']							=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user']['user_id'],'payroll_leave_maternity_normal',$schedule);
    	$return['mlc_count']							=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user']['user_id'],'payroll_leave_maternity_cs',$schedule);
    	$return['npl_count']							=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user']['user_id'],'payroll_leave_no_pay',$schedule);
    	$return['bl_count']								=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user']['user_id'],'payroll_leave_bereavement',$schedule);
    	$return['pl_count']								=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user']['user_id'],'payroll_leave_paternity',$schedule);
    	$return['sp_count']								=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user']['user_id'],'payroll_leave_solo_parent',$schedule);
    	
    	//============================
    	$return['fiscal']['payroll_leave_vacation']			=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_vacation'],$return['vl_count'],$schedule['payroll_schedule_work_hours'],$data['fiscal']['sysglobal_payroll_id'],$data['user'],'payroll_leave_vacation');
    	$return['fiscal']['payroll_leave_sick']				=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_sick'],$return['sl_count'],$schedule['payroll_schedule_work_hours'],$data['fiscal']['sysglobal_payroll_id'],$data['user'],'payroll_leave_sick');
    	$return['fiscal']['payroll_leave_emergency']		=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_emergency'],$return['el_count'],$schedule['payroll_schedule_work_hours']);
    	$return['fiscal']['payroll_leave_maternity_normal']	=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_maternity_normal'],$return['mln_count'],$schedule['payroll_schedule_work_hours']);
    	$return['fiscal']['payroll_leave_maternity_cs']		=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_maternity_cs'],$return['mlc_count'],$schedule['payroll_schedule_work_hours']);
    	$return['fiscal']['payroll_leave_no_pay']			=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_no_pay'],$return['npl_count'],$schedule['payroll_schedule_work_hours']);
    	$return['fiscal']['payroll_leave_bereavement']		=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_bereavement'],$return['bl_count'],$schedule['payroll_schedule_work_hours']);
    	$return['fiscal']['payroll_leave_paternity']		=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_paternity'],$return['pl_count'],$schedule['payroll_schedule_work_hours']);
    	$return['fiscal']['payroll_leave_solo_parent']		=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_solo_parent'],$return['sp_count'],$schedule['payroll_schedule_work_hours']);
    	
    	//=============================
    	$return['npl_count']								=   $this->label_count($return['npl_count'],$schedule);
    	$return['bl_count']									=   $this->label_count($return['bl_count'],$schedule);
    	$return['pl_count']									=   $this->label_count($return['pl_count'],$schedule); 
    	$return['sp_count']									=   $this->label_count($return['sp_count'],$schedule);
    	$return['vl_count']									=   $this->label_count($return['vl_count'],$schedule,$data['fiscal']['sysglobal_payroll_id'],$data['user']['user_id'],'payroll_leave_vacation');
    	$return['sl_count']									=   $this->label_count($return['sl_count'],$schedule,$data['fiscal']['sysglobal_payroll_id'],$data['user']['user_id'],'payroll_leave_sick');
    	$return['el_count']									=   $this->label_count($return['el_count'],$schedule);
    	$return['mln_count']								=   $this->label_count($return['mln_count'],$schedule);
    	$return['mlc_count']								=   $this->label_count($return['mlc_count'],$schedule);
    	//hash_dump($return,1);
   		return $return;
   	}
   	private function get_days_hours_remain($fiscal_data_count,$leave_count_array,$work_hours,$fiscal_id=0,$user='',$leave_type='')
	{		
		if($fiscal_id > 0)
		{
			$check_tenure		=	$this->employee_leave_count_tenure($user);
			if($check_tenure == 1)
			{
				$check_converted		=   mvc_model('model.user_payroll_leave_convert')->select_by_fiscal_id_user($fiscal_id,$user['user_id'],$leave_type);
				if($check_converted)
				{
					$leave_count_array['whole_count'] += $check_converted['user_payroll_leave_count_day'];
					$leave_count_array['hour_count']  += $check_converted['user_payroll_leave_count_hour'];
					
					if($work_hours==$leave_count_array['hour_count'])
					{
						$leave_count_array['hour_count']   = 0;
						$leave_count_array['whole_count'] += 1;
					}
				}
			}
			else
			{
						$leave_count_array['hour_count']   = 0;
						$leave_count_array['whole_count']  = 0;
			}	
				
		}
		
		if($fiscal_data_count <= $leave_count_array['whole_count'])
    	{
			
			$hrs_remain 	= $work_hours - $leave_count_array['hour_count'];
			$fiscal_data_count	  = ($leave_count_array['hour_count'] > 0)?'0 day/s & '.$hrs_remain .' hr/s':'0 day/s';
    	}
    	else
    	{
			$leave_remain 	= $fiscal_data_count - $leave_count_array['whole_count'];
			$hrs_remain 	= $work_hours   - $leave_count_array['hour_count'];
			$fiscal_data_count	= ($leave_count_array['hour_count'] > 0)?($leave_remain-1).' day/s & '.$hrs_remain.' hr/s': $leave_remain.' day/s';
    	}
	
		return $fiscal_data_count;
	}
	
	private function label_count($leave_count_array,$schedule,$fiscal_id=0,$user_id=0,$leave_type='')
	{		
		if($fiscal_id > 0)
		{
			$check_converted		=   mvc_model('model.user_payroll_leave_convert')->select_by_fiscal_id_user($fiscal_id,$user_id,$leave_type);
			if($check_converted)
			{
				$leave_count_array['whole_count'] += $check_converted['user_payroll_leave_count_day'];
				$leave_count_array['hour_count']  += $check_converted['user_payroll_leave_count_hour'];
			}
		}
		
		if($schedule['payroll_schedule_work_hours']==$leave_count_array['hour_count'])
		{
			$leave_count_array['hour_count']   = 0;
			$leave_count_array['whole_count'] += 1;
		}
		$return		=   ($leave_count_array['hour_count'] > 0) ? $leave_count_array['whole_count'] .' day/s & '. $leave_count_array['hour_count'] . ' hr/s' : $leave_count_array['whole_count'] .' day/s  ';
		return $return;
	}
	
	//==================================Leave Policy
	private function employee_leave_count_tenure($user)
	{		
		$hire_stamp    		=   strtotime($user['user_hire_date']);
		$tenure				=   diff_date_months_to_current($hire_stamp);
		
		if($tenure >= 12)
		{
			$return=1;//update fiscal data
		}
		else
		{
			$return=0;
		}
		
		return $return;
	}
 	
 	
 	
	public function submit_adjustment_request($parent)
	{		
		$year														=	string_date_year($_POST['cur_date']); 
    	$day														=	string_day($_POST['cur_date']); 
		$month 														=	string_date_month_numeric($_POST['cur_date']); 
	    //hash_dump($_POST,1);
		 
		 if($_POST['adj']['int']['is_official_business'] == 1)
		 {
			 //adjust to official business
		 }
		  elseif($_POST['adj']['int']['user_payroll_attendance_adjustment_break_in'] == '00:00' && $_POST['adj']['int']['user_payroll_attendance_adjustment_break_out'] == '00:00')
		 {
			// hash_dump($_POST,1);
			  $_POST['adj']['int']['user_payroll_attendance_adjustment_break_in'] = strtotime($month.'/'.$day.'/'.$year . '13:00');
			  $_POST['adj']['int']['user_payroll_attendance_adjustment_break_out'] = strtotime($month.'/'.$day.'/'.$year . '12:00');
		 }
		 else
		 {
		     $_POST['adj']['int']['user_payroll_attendance_adjustment_break_in']  	= strtotime($month.'/'.$day.'/'.$year . $_POST['adj']['int']['user_payroll_attendance_adjustment_break_in']);
		     $_POST['adj']['int']['user_payroll_attendance_adjustment_break_out']  	= strtotime($month.'/'.$day.'/'.$year . $_POST['adj']['int']['user_payroll_attendance_adjustment_break_out']); 
		 }
		
		$_POST['adj']['int']['user_payroll_attendance_adjustment_time_in']  	= strtotime($month.'/'.$day.'/'.$year . $_POST['adj']['int']['user_payroll_attendance_adjustment_time_in']);
		$_POST['adj']['int']['user_payroll_attendance_adjustment_time_out']  	= strtotime($month.'/'.$day.'/'.$year . $_POST['adj']['int']['user_payroll_attendance_adjustment_time_out']);
		//hash_dump($_POST,1);
		$ticket 							     				=  mvc_model('model.user_payroll_attendance_adjustment')->insert($_POST['adj']);
		header_location("/user/hr/attendance/");
	}
	
	public function submit_ot_request($parent)
	{		
		$_POST['ot']['int']['user_payroll_ot_hour']				=	$_POST['ot']['int']['user_payroll_ot_hour'] + $_POST['early_ot_hour'];
		$_POST['ot']['int']['user_payroll_ot_minute']			=	$_POST['ot']['int']['user_payroll_ot_minute'] + $_POST['early_ot_minute'];
		$ticket 							     				=  mvc_model('model.user_payroll_ot')->insert($_POST['ot']);
		header_location("/user/hr/ot/");
	}
	
	
	public function submit_leave_request($parent)
	{		
		$user					 								=	mvc_model('model.user')->select($parent->user['user_id']);
		$schedule												=   mvc_model('model.payroll_schedule')->select($user['payroll_schedule_id']);
		$fiscal_data											=	mvc_model('model.sysglobal_payroll')->select_active();
		$leave_type												=	$_POST['leave']['str']['user_payroll_leave_type_id'];
    	$leave_count											=	mvc_model('model.user_payroll_leave')->get_count_user_type($user['user_id'],$leave_type,$schedule);
		
		
		if($_POST['leave']['int']['user_payroll_leave_whole'] == 0)
		{
			$leave_duration_array['whole'] = 0;
			$leave_duration_array['hrs']   = $_POST['leave']['int']['user_payroll_leave_duration'];
		}
		else
		{
			$leave_duration_array['whole'] = 1;
			$leave_duration_array['hrs']   = 0; 
		}
		
		$check													=   $this->get_days_hours_remain_numeric($fiscal_data,$leave_duration_array,$leave_count,$leave_type,$user);
		if($check==1 || $_POST['leave']['str']['user_payroll_leave_type_id'] == 'payroll_leave_compensatory')
		{
			$ticket 							     			=   mvc_model('model.user_payroll_leave')->insert($_POST['leave']);
		}
		
		header_location("/user/hr/leaves");
	}
	
	private function get_days_hours_remain_numeric($fiscal_data_count,$leave_duration_array,$leave_count_array,$leave_type,$user)
	{		
		if($leave_duration_array['whole'] == 1)
    	{
			
			 if($leave_count_array['whole_count'] < $fiscal_data_count[$leave_type])
			 {
				 $return = 1;
			 }
			 else
			 {
				 //check available leaves
				 if($leave_type == 'payroll_leave_sick')
				 {
					 if($user['available_sick_leave'] > 0)
					 {
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
			$hrs_remain  = $user['payroll_schedule_work_hours'] - $leave_count_array['hour_count'];
			if($leave_count_array['whole_count'] < $fiscal_data_count[$leave_type] || $leave_duration_array['hrs'] <=  $hrs_remain)
			 {
				 $return = 1;
			 }
			 else
			 {
			
				 if($leave_type == 'payroll_leave_sick')
				 {
					 if($user['available_sick_leave'] > 0)
					 {
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
	
		return $return;
	}
	
	
    
}