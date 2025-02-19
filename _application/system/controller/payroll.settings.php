<?php
class payroll_settings
{
    
    public function __construct()
    {    	
       	$this->controller_id 			= 	'payroll_settings';
    }
 
   public function index($parent)
    {           
        # DB
        
        # VIEW
       $this->miscellaneous($parent);
    } 
    
    
    public function deductions($parent)
    {      	
    	
    	# DB
    	$data['table_row']						 	 =	mvc_model('model.payroll_deduction')->select_all();
    	# VIEW - side nav
        $side_nav['deductions.class']				 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);       
        # VIEW
        $parent->_view('settings.deductions', $data);          
    } 
    
    public function allowances($parent)
    {      	
    	
    	# DB
    	$data['table_row']						 	 =	mvc_model('model.payroll_allowance')->select_all();
    	# VIEW - side nav
        $side_nav['allowances.class']				 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);       
        # VIEW
        $parent->_view('settings.allowances', $data);          
    } 
    
    public function tax($parent)
    {      	
    	
    	# DB
    	$data['table_row']						 	 =	mvc_model('model.payroll_tax')->select_all();
    	# VIEW - side nav
        $side_nav['tax.class']						 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);       
        # VIEW
        $parent->_view('settings.tax', $data);          
    } 
    
    public function bonus($parent)
    {      	
    	
    	# DB
    	$data['table_row']						 	 =	mvc_model('model.payroll_bonus')->select_all();
    	# VIEW - side nav
        $side_nav['bonus.class']						 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);       
        # VIEW
        $parent->_view('settings.bonus', $data);          
    }
    
    public function schedules($parent)
    {      	
    	
    	# DB
    	$data['table_row']						 	 =	mvc_model('model.payroll_schedule')->select_all();
    	# VIEW - side nav
        $side_nav['schedules.class']				 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);       
        # VIEW
        $parent->_view('settings.schedules', $data);          
    }  
    
    
 
 //======================================FORMS
 	
 	public function miscellaneous($parent)
    {      	
    	
    	# DB
    	$data										=	mvc_model('model.sysglobal_payroll')->select_active();
    	$data['user_summary']						=	mvc_model('model.user')->select_all_summary();
    	$data['row.calendar']						=   mvc_model('model.sysglobal_payroll')->select_all();
    	# VIEW - side nav
        $side_nav['miscellaneous.class']			=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);       
        # VIEW
        $parent->_view('settings.miscellaneous', $data);          
    }
    
 	
 	
 	//*************************ADD
 	
 	
 	public function add_year($parent)
    {      	
    	
    	# DB
    	# VIEW - side nav
        $side_nav['miscellaneous.class']			=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);       
        # VIEW
        $parent->_view('settings.form.miscellaneous', $data);          
    }
 	
	public function attendance($parent)
    {
    	# DB
    
        # VIEW - side nav
        $side_nav['attendance.class']				=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.add.attendance', $data);        
	}
	
	
	
	public function add_deduction($parent)
    {
    	# DB
    	$value_type									=	mvc_model('model.option')->select_option('option_value_type');
    	$ded_type	    							=	mvc_model('model.option')->select_option('option_deduction_type');
    	$data['ded_type']							=	hash_to_option($ded_type, 'option_deduction_type_id', 'option_deduction_type_name');
    	$data['value_type']							=	hash_to_option($value_type, 'option_value_type_id', 'option_value_type_name');
    	
        # VIEW - side nav
        $side_nav['deductions.class']				=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.add.deduction', $data);        
	}
	
	public function add_allowance($parent)
    {
    	# DB
    	$value_type									=	mvc_model('model.option')->select_option('option_value_type');
    	$data['value_type']							=	hash_to_option($value_type, 'option_value_type_id', 'option_value_type_name');
        # VIEW - side nav
        $side_nav['allowances.class']				=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.add.allowance', $data);        
	}
	
	public function add_tax($parent)
    {
    	# DB
        # VIEW - side nav
        $side_nav['tax.class']						=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.add.tax', $data);        
	}
	
	public function add_bonus($parent)
    {
    	# DB
        # VIEW - side nav
        $side_nav['bonus.class']					=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.add.bonus', $data);        
	}
	
	
	public function add_schedule($parent)
    {
    	# DB
        # VIEW - side nav
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
        $side_nav['schedules.class']				=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.add.schedule', $data);        
	}
	
	 
	//*************************Edit
	
	public function edit_bonus($parent)
    {
    	$id											 =   $_GET['id']*1;
    	# DB
    	$data 										 =  mvc_model('model.payroll_bonus')->select($id);
        # VIEW - side nav
        $side_nav['bonus.class']					 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.edit.bonus', $data);        
	}
	
    public function edit_tax($parent)
    {
    	$id											 =   $_GET['id']*1;
    	# DB
    	$data 										 =  mvc_model('model.payroll_tax')->select($id);
        # VIEW - side nav
        $side_nav['tax.class']						 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.edit.tax', $data);        
	}
	
	
	public function edit_schedule($parent)
    {
    	$id											 =   $_GET['id']*1;
    	# DB
    	$data 										 =  mvc_model('model.payroll_schedule')->select($id);
    	
    	$data['m_check']							 =	($data['payroll_schedule_monday'] == 1) ? 'checked="checked"' : '';
    	$data['t_check']							 =	($data['payroll_schedule_tuesday'] == 1) ? 'checked="checked"' : '';
    	$data['w_check']							 =	($data['payroll_schedule_wednesday'] == 1) ? 'checked="checked"' : '';
    	$data['th_check']							 =	($data['payroll_schedule_thursday'] == 1) ? 'checked="checked"' : '';
    	$data['f_check']							 =	($data['payroll_schedule_friday'] == 1) ? 'checked="checked"' : '';
    	$data['sat_check']							 =	($data['payroll_schedule_saturday'] == 1) ? 'checked="checked"' : '';
    	$data['s_check']							 =	($data['payroll_schedule_sunday'] == 1) ? 'checked="checked"' : '';
    	
    	$s_time									     =  explode(':',$data['payroll_schedule_start']);
    	$e_time									     =  explode(':',$data['payroll_schedule_end']);
    	$bs_time									 =  explode(':',$data['payroll_schedule_break_start']);
    	$be_time									 =  explode(':',$data['payroll_schedule_break_end']);
    	for($i=0;$i<24;$i++)
        {
			$i					 	=  ($i == 0) ? '0'.$i : $i;
			$s_select			 	=  ($s_time[0] == $i) ? 'selected="selected"' : '';
			$e_select			 	=  ($e_time[0] == $i) ? 'selected="selected"' : '';
			$bs_select			 	=  ($bs_time[0] == $i) ? 'selected="selected"' : '';
			$be_select			 	=  ($be_time[0] == $i) ? 'selected="selected"' : '';
			$data['opt_hour_s']		.=  '<option '.$s_select.' value="'.$i.'">'.$i.'</option>';
			$data['opt_hour_e']		.=  '<option '.$e_select.' value="'.$i.'">'.$i.'</option>';
			$data['opt_hour_bs']	.=  '<option '.$bs_select.' value="'.$i.'">'.$i.'</option>';
			$data['opt_hour_be']	.=  '<option '.$be_select.' value="'.$i.'">'.$i.'</option>';
        }
        for($x=0;$x<60;$x++)
        {
			$x					 =  ($x < 10) ? '0'.$x : $x;
			$s_select			 =  ($s_time[1] == $x) ? 'selected="selected"' : '';
			$e_select			 =  ($e_time[1] == $x) ? 'selected="selected"' : '';
			$bs_select			 =  ($bs_time[1] == $x) ? 'selected="selected"' : '';
			$be_select			 =  ($be_time[1] == $x) ? 'selected="selected"' : '';
			$data['opt_min_s']	.=  '<option '.$s_select.' value="'.$x.'">'.$x.'</option>';
			$data['opt_min_e']	.=  '<option '.$e_select.' value="'.$x.'">'.$x.'</option>';
			$data['opt_min_bs']	.=  '<option '.$bs_select.' value="'.$x.'">'.$x.'</option>';
			$data['opt_min_be']	.=  '<option '.$be_select.' value="'.$x.'">'.$x.'</option>';
        }
        # VIEW - side nav
        $side_nav['schedules.class']				 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.edit.schedule', $data);        
	}
	
	public function edit_deduction($parent)
    {
    	$id											 =   $_GET['id']*1;
    	# DB
    	$data 										 =  mvc_model('model.payroll_deduction')->select($id);
    	$value_type									 =	mvc_model('model.option')->select_option('option_value_type');
    	$data['value_type']							 =	hash_to_option($value_type, 'option_value_type_id', 'option_value_type_name',$data['option_value_type_id']); 
       	$ded_type	    							=	mvc_model('model.option')->select_option('option_deduction_type');
    	$data['ded_type']							=	hash_to_option($ded_type, 'option_deduction_type_id', 'option_deduction_type_name',$data['option_deduction_type_id']);
       	if($data['payroll_deduction_trigger'] == 1)
       	{
			$data['f_check'] = 'checked="checked"';
       	}
       	elseif($data['payroll_deduction_trigger'] == 2)
       	{
			$data['s_check'] = 'checked="checked"';
       	}
       	else
       	{
			$data['b_check'] = 'checked="checked"';
       	}
       
        # VIEW - side nav
        $side_nav['deductions.class']				 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.edit.deduction', $data);        
	}
	
	public function edit_allowance($parent)
    {
    	$id											 =   $_GET['id']*1;
    	# DB
    	$data 										 =  mvc_model('model.payroll_allowance')->select($id);
    	$value_type									 =	mvc_model('model.option')->select_option('option_value_type');
    	$data['value_type']							 =	hash_to_option($value_type, 'option_value_type_id', 'option_value_type_name',$data['option_value_type_id']);
        # VIEW - side nav
        $side_nav['allowances.class']				 =	'bold';         	
       	$data['side_nav']							 =	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.edit.allowance', $data);        
	}
	
  
    
  #----------------------- Form Actions
  
 	public function submit_add_tax($parent)
	{		
		$entry 										 =  mvc_model('model.payroll_tax')->insert($_POST['tax']);
		header_location("/payroll/settings/tax/"); 
	}
	
	public function submit_edit_tax($parent)
	{		
		$id											 =  $_POST['id']*1;
		$update 									 =  mvc_model('model.payroll_tax')->update($_POST['tax'],$id);
		header_location("/payroll/settings/tax/");
	}
	
	public function submit_delete_tax($parent)
	{		
		$id											 =  $_GET['id']*1;
		$update 									 =  mvc_model('model.payroll_tax')->delete_entry($id);
		header_location("/payroll/settings/tax/");
	}
	
	public function submit_add_bonus($parent)
	{		
		$entry 										 =  mvc_model('model.payroll_bonus')->insert($_POST['bonus']);
		header_location("/payroll/settings/bonus/"); 
	}
	
	public function submit_edit_bonus($parent)
	{		
		$id											 =  $_POST['id']*1;
		$update 									 =  mvc_model('model.payroll_bonus')->update($_POST['bonus'],$id);
		header_location("/payroll/settings/bonus/");
	}
	
	public function submit_delete_bonus($parent)
	{		
		$id											 =  $_GET['id']*1;
		$update 									 =  mvc_model('model.payroll_bonus')->delete_entry($id);
		header_location("/payroll/settings/bonus/");
	}
	
	public function submit_add_deduction($parent)
	{		
		$entry 										 =  mvc_model('model.payroll_deduction')->insert($_POST['ded']);
		header_location("/payroll/settings/deductions/"); 
	}
	
	public function submit_edit_deduction($parent)
	{		
		$id											 =  $_POST['id']*1;
		$update 									 =  mvc_model('model.payroll_deduction')->update($_POST['ded'],$id);
		header_location("/payroll/settings/deductions/");
	}
	
	public function submit_delete_deduction($parent)
	{		
		$id											 =  $_GET['id']*1;
		$update 									 =  mvc_model('model.payroll_deduction')->delete_entry($id);
		header_location("/payroll/settings/deductions/");
	}
	
	public function submit_add_allowance($parent)
	{		
		$entry 										 =  mvc_model('model.payroll_allowance')->insert($_POST['all']);
		header_location("/payroll/settings/allowances/"); 
	}
	
	public function submit_edit_allowance($parent)
	{		
		$id											 =  $_POST['id']*1;
		$update 									 =  mvc_model('model.payroll_allowance')->update($_POST['all'],$id);
		header_location("/payroll/settings/allowances/");
	}
	
	public function submit_delete_allowance($parent)
	{		
		$id											 =  $_GET['id']*1;
		$update 									 =  mvc_model('model.payroll_allowance')->delete_entry($id);
		header_location("/payroll/settings/allowances/");
	}
	
	public function submit_add_schedule($parent)
	{		
		$curr							=  time();
		$year 							=	string_date_year($curr); 
		$month 							=	string_date_month_numeric($curr); 
		$day 							=	string_day($curr);
		
		$time_in						=  $_POST['sch']['str']['payroll_schedule_start'];
		$time_out						=  $_POST['sch']['str']['payroll_schedule_end'];
		$break_duration					=  $_POST['sch']['int']['payroll_schedule_break']; 
	   	$filler							=  (strtotime($time_in) > strtotime($time_out)) ? " +1 day" : "";
		$string_sched_start				=  strtotime($month.'/'.$day.'/'.$year . $time_in); 
		$string_sched_end				=  strtotime($month.'/'.$day.'/'.$year . $time_out . $filler); 
		
		$_POST['sch']['int']['payroll_schedule_work_hours']		=  ((($string_sched_end-$string_sched_start)/60)-$break_duration)/60;
		$entry 										 =  mvc_model('model.payroll_schedule')->insert($_POST['sch']);
		header_location("/payroll/settings/schedules/"); 
	}
	
	public function submit_edit_schedule($parent)
	{		
		$id								=  $_POST['id']*1;
		$curr							=  time();
		$year 							=	string_date_year($curr); 
		$month 							=	string_date_month_numeric($curr); 
		$day 							=	string_day($curr);
		$time_in						=  $_POST['sch']['str']['payroll_schedule_start'];
		$time_out						=  $_POST['sch']['str']['payroll_schedule_end'];
		$break_duration					=  $_POST['sch']['int']['payroll_schedule_break']; 
	   	$filler							=  (strtotime($time_in) > strtotime($time_out)) ? " +1 day" : "";
		$string_sched_start				=  strtotime($month.'/'.$day.'/'.$year . $time_in); 
		$string_sched_end				=  strtotime($month.'/'.$day.'/'.$year . $time_out . $filler); 
		
		
		$_POST['sch']['int']['payroll_schedule_work_hours']		=  ((($string_sched_end-$string_sched_start)/60)-$break_duration)/60;
	//	hash_dump($_POST['sch']['int']['payroll_schedule_work_hours'],1);
		$update 									 =  mvc_model('model.payroll_schedule')->update($_POST['sch'],$id);
		header_location("/payroll/settings/schedules/");
	}
	  
	public function submit_delete_schedule($parent)
	{		
		$id											 =  $_GET['id']*1;
		$update 									 =  mvc_model('model.payroll_schedule')->delete_entry($id);
		header_location("/payroll/settings/schedules/");
	}
	
	public function activate($parent)
	{		
		$id											 				 =  $_GET['id']*1;
		$acitve_fiscal												 =	mvc_model('model.sysglobal_payroll')->select_active();
		if($acitve_fiscal)
		{
			$fiscal_up['int']['is_active']							 =  0;
			$update													 =  mvc_model('model.sysglobal_payroll')->update($fiscal_up,$acitve_fiscal['sysglobal_payroll_id']);
		}
		$fiscal_up['int']['is_active']								 =  1;
		$update													 	=  mvc_model('model.sysglobal_payroll')->update($fiscal_up,$id);
		header_location("/payroll/settings/miscellaneous/");
	}
	
	
	public function submit_misc($parent)
	{		
		//deactivate existing fiscal
		$acitve_fiscal												 =	mvc_model('model.sysglobal_payroll')->select_active();
		if($acitve_fiscal)
		{
			$fiscal_up['int']['is_active']							 =  0;
			$update													 =  mvc_model('model.sysglobal_payroll')->update($fiscal_up,$acitve_fiscal['sysglobal_payroll_id']);
		}
		//hash_dump($_POST,1);
		$_POST['misc']['int']['payroll_fiscal_year_start']	 		 =	strtotime($_POST['misc']['int']['payroll_fiscal_year_start']);
		$_POST['misc']['int']['is_active']	 		 				 =	1;
		$insert_fiscal									 			 =  mvc_model('model.sysglobal_payroll')->insert($_POST['misc']);
		$fiscal_id													 =  $insert_fiscal['data']['sysglobal_payroll_id'];
		
		$cutoff_first												 =  $_POST['misc']['int']['payroll_cutoff_first'];
		$cutoff_second												 =  $_POST['misc']['int']['payroll_cutoff_second'];
		$cutoff_year_start 											 =	string_date_year($_POST['misc']['int']['payroll_fiscal_year_start']); 
		$cutoff_month_start 										 =	string_date_month_numeric($_POST['misc']['int']['payroll_fiscal_year_start']); 
		
		$cutoff_start_first											 =  string_date(strtotime($cutoff_month_start.'/'.$cutoff_first.'/'.$cutoff_year_start)); 									
		$cutoff_start_second										 =  string_date(strtotime($cutoff_month_start.'/'.$cutoff_second.'/'.$cutoff_year_start)); 	
		
		//echo 'first LOOP: ' . $cutoff_start_first . '<br>';
		//echo 'first LOOP: ' . $cutoff_start_second . '<br>';
		for($i=1;$i<=12;$i++)
		{
			
			//first cutoff 21-4
			$c_start	=	strtotime($cutoff_start_second. "-1 month +1 day");	
			$c_end		=	strtotime($cutoff_start_first);	
			
			//echo 'Start: ' . string_date($c_start) . '<br>';
			//echo 'End: ' . string_date($c_end) . '<br>';
			
			
			//echo 'IN LOOP: ' . $cutoff_start_first . '<br>';
			//echo 'IN LOOP: ' . $cutoff_start_second . '<br>';
			
			$c_post['int']['payroll_cutoff_pos'] 	 		 =  1;
			$c_post['int']['payroll_cutoff_date_start'] 	 =  $c_start;
			$c_post['int']['payroll_cutoff_date_end']  		 =  $c_end;
			$c_post['str']['option_payroll_status_id']  	 =  'pending';
			$c_post['str']['sysglobal_payroll_id']  	 	 =  $fiscal_id;
			$insert_cutoff									 =  mvc_model('model.payroll_cutoff')->insert($c_post);
			$cutoff_id										 =  $insert_cutoff['data']['payroll_cutoff_id'];
			
			for($x=0;$x<=15;$x++)
			{
				 
				if($c_start <= $c_end)
				{
					$d_stamp											= $c_start;
					$d_post['int']['payroll_attendance_timestamp']		= $d_stamp;
					$d_post['str']['option_payroll_attendance_type_id']	= 'regular';
					$d_post['int']['payroll_cutoff_id']					= $cutoff_id; 
					$insert_d_stamp									 	=  mvc_model('model.payroll_attendance')->insert($d_post);
				}
				
				$c_start	= string_date($c_start);
				$c_start	= strtotime($c_start. "+1 day");
					
			}//end for
			//==========================================================================================================
			//second cutoff 5-20
			$c_start_sec	=	strtotime($cutoff_start_first. "+1 day");	
			$c_end_sec		=	strtotime($cutoff_start_second);
			
			//echo 'S: ' . string_date($c_start_sec) . '<br>';
			//echo 'S: ' . string_date($c_end_sec) . '<br>';	
			
			$c_post['int']['payroll_cutoff_pos'] 	 		 =  2;
			$c_post['int']['payroll_cutoff_date_start'] 	 =  $c_start_sec;
			$c_post['int']['payroll_cutoff_date_end']  		 =  $c_end_sec;
			$c_post['str']['option_payroll_status_id']  	 =  'pending';
			$c_post['str']['sysglobal_payroll_id']  	 	 =  $fiscal_id;
			$insert_cutoff									 =  mvc_model('model.payroll_cutoff')->insert($c_post);
			$cutoff_id_sec									 =  $insert_cutoff['data']['payroll_cutoff_id'];
			
			for($x=0;$x<=15;$x++)
			{
				
				if($c_start_sec <= $c_end_sec)
				{
					$d_stamp_sec											= $c_start_sec;
					$d_post_sec['int']['payroll_attendance_timestamp']		= $d_stamp_sec;
					$d_post_sec['str']['option_payroll_attendance_type_id']	= 'regular';
					$d_post_sec['int']['payroll_cutoff_id']					= $cutoff_id_sec; 
					$insert_d_stamp_sec									 	=  mvc_model('model.payroll_attendance')->insert($d_post_sec);
				}
				
				$c_start_sec	= string_date($c_start_sec);
				$c_start_sec	= strtotime($c_start_sec. "+1 day");
					
			}//end for
			
			
			//echo 'x: ' . $cutoff_start_first . '<br>';
			//echo 'x: ' . $cutoff_start_second . '<br>';
			$cutoff_start_first		= strtotime($cutoff_start_first. "+1 month");
			$cutoff_start_second	= strtotime($cutoff_start_second. "+1 month");
			$cutoff_start_first		= string_date($cutoff_start_first);
			$cutoff_start_second	= string_date($cutoff_start_second);
			//echo 'After: ' . $cutoff_start_first . '<br>';
			//echo 'After: ' . $cutoff_start_second . '<br>';
		
		
		}//end cutoff for loop								
		
		
		
		header_location("/payroll/settings/miscellaneous/");
	}
	
	public function test($parent)
	{		
		$curr	=	time();
		
		$cutoff_first												 =  10;
		$cutoff_second												 =  22;
		
		$cutoff_year_start 											 =	string_date_year($curr); 
		$cutoff_month_start 										 =	string_date_month_numeric($curr); 
		$cutoff_day 											     =	string_day($curr); 
		
		$cutoff_start_first											 =  strtotime($cutoff_month_start.'/'.$cutoff_day.'/'.$cutoff_year_start . ' 24:25'); 									
		$cutoff_start_second										 =  strtotime($cutoff_month_start.'/'.$cutoff_second.'/'.$cutoff_year_start); 
		
		//echo string_date_time($cutoff_start_first) . '<br>';									
		//echo string_date($cutoff_start_second) . '<br>';									
		//echo $cutoff_year_start . '<br>';									
		//echo date("G:i", $curr) . '<br>';									
		//echo 10 % 3 . '<br>';	
		
	  echo round(1992.55);
	}
	
	//===============================================================attendance
	public function insert_attendance($parent)
    {
    	 $id																=   $_GET['id'];
    	 $acitve_fiscal												 		=	mvc_model('model.sysglobal_payroll')->select_active();
    	 $data																=  mvc_model('model.payroll_attendance')->select_all_by_fiscal($acitve_fiscal['sysglobal_payroll_id']); 
    	 $user																=  mvc_model('model.user')->select($id);
    	 //hash_dump($data,1);
    	 foreach($data as $row)
    	 {
				//Prep Insert
				 $post['payroll_attendance_id']								=	$row['payroll_attendance_id'];
				 $post['user_id']											=	$user['user_id'];
				 $post['payroll_schedule_id']								=	$user['payroll_schedule_id'];
				 $post['timestamp_in']										=	0;
				 $post['timestamp_out']										=	0;
				 $post['timestamp_break_in']								=	0;
				 $post['timestamp_break_out']								=	0;
				 $post['user_payroll_attendance_timestamp']					=	$row['payroll_attendance_timestamp'];;
				 $insert													=	mvc_model('model.user_payroll_attendance')->insert($post);
			
    	 }//end foreach	
    	 
    	 header_location("/payroll/employees/edit_details/&id={$id}");
     
	}
	
	public function delete_attendance($parent)
    {
    	 $id																=   $_GET['id'];
    	 $acitve_fiscal												 		=	mvc_model('model.sysglobal_payroll')->select_active();
    	 $data																=  mvc_model('model.payroll_attendance')->select_all_by_fiscal($acitve_fiscal['sysglobal_payroll_id']); 
    	 $user																=  mvc_model('model.user')->select($id);
    	 //hash_dump($data,1);
    	 foreach($data as $row)
    	 {
				//Prep Insert
				 $attendance_array[]										=	$row['payroll_attendance_id'];
				
			
    	 }//end foreach	
    	 $delete_entries	= mvc_model('model.user_payroll_attendance')->delete_entry($attendance_array,$id);
    	 header_location("/payroll/employees/edit_details/&id={$id}");
	}
	
	
	public function insert_bio($parent)
    {
				$schedule													=  mvc_model('model.payroll_schedule')->select($_POST['sched_id']);
				//Prep Insert
				$year														=	string_date_year($_POST['stamp']); 
    			$day														=	string_day($_POST['stamp']); 
				$month 														=	string_date_month_numeric($_POST['stamp']); 
				//compute late,ob,ut
	   			$filler											=  (strtotime($schedule['payroll_schedule_start']) > strtotime($schedule['payroll_schedule_end'])) ? " +1 day" : "";
				$string_sched_start								=  strtotime($month.'/'.$day.'/'.$year . $schedule['payroll_schedule_start']); 
				$string_sched_end								=  strtotime($month.'/'.$day.'/'.$year . $schedule['payroll_schedule_end'] . $filler); 
				$time_sched    									=  strtotime($month.'/'.$day.'/'.$year . $schedule['payroll_schedule_start']);
				
				
				 if($_POST['adj']['int']['timestamp_break_in'] == '00:00' && $_POST['adj']['int']['timestamp_break_out'] == '00:00')
				 {
					 $_POST['adj']['int']['timestamp_break_in']   = $schedule['payroll_schedule_break_end'];
					 $_POST['adj']['int']['timestamp_break_out']  = $schedule['payroll_schedule_break_start'];
				 }
				
				 
				 $post['user_payroll_attendance_id']						=	$_POST['id'];
				 $post['time_in']											=	strtotime($month.'/'.$day.'/'.$year . $_POST['adj']['int']['timestamp_in']);
				 $post['time_out']											=	strtotime($month.'/'.$day.'/'.$year . $_POST['adj']['int']['timestamp_out']);
				 $post['break_in']											=	strtotime($month.'/'.$day.'/'.$year . $_POST['adj']['int']['timestamp_break_in']);
				 $post['break_out']											=	strtotime($month.'/'.$day.'/'.$year . $_POST['adj']['int']['timestamp_break_out']);
				 $post['option_payroll_biometrics_status_id']				=	'pending';
				 $post['user_payroll_biometrics_timestamp']					=	time();
				 
				 
				 $seconds_late									=  ($post['time_in'] > $string_sched_start) ? $post['time_in'] - $string_sched_start : 0;
				 $seconds_under_time							=  ($string_sched_end >  $post['time_out']) ?  $string_sched_end -  $post['time_out'] : 0;
				 $break_duration								=  ($post['break_in'] - $post['break_out']); // for clarification
				 $round_break_duration							=  round($break_duration/60);//minute
				 $round_under_time								=  round($seconds_under_time/60);//minute
				 $round_late									=  round($seconds_late/60);//minute
				 $round_break_duration							=  ($round_break_duration > $schedule['payroll_schedule_break']) ? $round_break_duration - $schedule['payroll_schedule_break'] : 0;
				 $excess										=  ($post['time_out'] > $string_sched_end) ? round(($post['time_out'] - $string_sched_end)/60) : 0;
				 $early_start									=  ($post['time_in'] < $string_sched_start) ? round(($string_sched_start - $post['time_in'])/60) : 0;
				// $excess										=   $excess+$early_start;
				
				$post['is_late']								=   ($round_late > 0) ? 1 : 0;
				$post['is_ob']									=   ($round_break_duration > 0) ? 1 : 0;
				$post['is_ut']									=   ($round_under_time > 0) ? 1 : 0;
				$post['user_excess_minutes']					=   $excess;
				$post['user_excess_minutes_early']				=   $early_start;
				 
				 
				 
				 $insert													=	mvc_model('model.user_payroll_biometrics')->insert($post);
    		 header_location("/payroll/timestamp/");
	}
	
	
	//===============================================================attendance
	public function sync_biometrics($parent)
    {
         $data																=  mvc_model('model.user_payroll_biometrics')->select_all_pending();
    	 foreach($data as $row)
    	 {
					// hash_dump($row,1);
					 $post['int']['timestamp_in']						=	$row['time_in'];
					 $post['int']['timestamp_out']						=	$row['time_out'];
					 $post['int']['timestamp_break_in']					=	$row['break_in'];
					 $post['int']['timestamp_break_out']				=	$row['break_out'];
					 $post['int']['is_updated']							=	1;
					 $post['int']['is_late']							=   $row['is_late'];
					 $post['int']['is_ob']								=   $row['is_ob'];
					 $post['int']['is_ut']								=   $row['is_ut'];
					 $post['int']['user_excess_minutes']				=   $row['user_excess_minutes'];
					 $post['int']['user_excess_minutes_early']			=   $row['user_excess_minutes_early'];
					 $update											=	mvc_model('model.user_payroll_attendance')->update($post,$row['user_payroll_attendance_id']);
					$b_post['str']['option_payroll_biometrics_status_id']	=	'loaded';
					$up														=	mvc_model('model.user_payroll_biometrics')->update($b_post,$row['user_payroll_biometrics_id']);
    	 }//end foreach	
    	 header_location("/payroll/timestamp/");
     
	}
    
}