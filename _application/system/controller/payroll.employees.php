<?php
class payroll_employees
{
    
    public function __construct()
    {    	
       	$this->controller_id 							= 	'payroll_employees';
       	$this->check_effective_salary($parent);
    }
 
   public function index($parent)
    {           
        # DB
        $data['row.employee']						 	=	mvc_model('model.user')->get_all_employee();
        # VIEW
        $parent->_view('employees', $data); 
    } 
    
     
    
    public function profile($parent)
    {      	
    	$id											 	=   $_GET['id']*1;
    	# DB
    	$data						 				 	=	mvc_model('model.user')->select($id);
    	$data['salary']						 			=	mvc_model('model.user_salary')->select($data['user_salary_id']);
    	$active_fiscal						 			=	mvc_model('model.user_payroll_attendance')->check_if_active_fiscal($id);
		$data['payroll_status']							=  ($active_fiscal) ? 'Payroll Ready' : 'No Daily Stamp Records';
    	$tenure											=  string_check_diff_date_current($data['user_hire_date']);
    	if($data['user_hire_date'] > 500000)
    	{
    		$data['user_hire_date']	= string_date_day_enclosed($data['user_hire_date']);
    		if($tenure['y'] > 0)
    		{
				if($tenure['m'] > 0)
				{
					$data['tenure']	 = $tenure['y'].' year/s &'.$tenure['m'].' month/s';
				}
				else
				{
					$data['tenure']	 = $tenure['y'].' year/s';
				}
    		}
    		else
    		{
					$data['tenure']	 = $tenure['m'].' month/s';
    		}
		}
		else
		{
			$data['user_hire_date'] = 'N/A';
			$data['tenure']			- 'N/A';
		}
    	# VIEW - side nav
        $side_nav['user_id']						 	=	$id;         	
        $side_nav['profile.class']					 	=	'bold';         	
       	$data['side_nav']							 	=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);       
        # VIEW
        $parent->_view('employees.profile', $data);          
    } 
    
     public function attendance_history($parent)
    {      	
    	$id											 	=   $_GET['id']*1;
    	$cut_off_id_f									=  $_GET['cutoff_f']*1;
    	$cut_off_id_s									=  $_GET['cutoff_s']*1;
    	$acitve_fiscal									=	mvc_model('model.sysglobal_payroll')->select_active();
    	if($cut_off_id_f >0 && $cut_off_id_s >0)
    	{
			if($cut_off_id_f > $cut_off_id_s)
			{
				$f										=  $cut_off_id_f;
				$cut_off_id_f							=  $cut_off_id_s;
				$cut_off_id_s							=  $f;
			}
    	}
    	else
    	{
			$curr_time									=  time();
			$cutoff										=  mvc_model('model.payroll_cutoff')->get_current_cutoff($acitve_fiscal['sysglobal_payroll_id']*1,$curr_time);
    		$cut_off_id_s								=  $cutoff['payroll_cutoff_id']*1;
    		$cut_off_id_f								=  $cut_off_id_s;
    	}
    	
    	# DB
    	$data						 				 	=	mvc_model('model.user')->select($id);
    	$range_f						 				=	mvc_model('model.payroll_cutoff')->select($cut_off_id_f);
    	$range_s						 				=	mvc_model('model.payroll_cutoff')->select($cut_off_id_s);
    	$schedule										=  mvc_model('model.payroll_schedule')->select($data['payroll_schedule_id']);
    	$sched_array									=  $this->schedule_array($schedule);
    	$data['row.attendance']						 	=	mvc_model('model.user_payroll_attendance')->select_all_by_user($id,$cut_off_id_f,$cut_off_id_s,$sched_array);
    	$data['fiscal_year']							=   string_date_year($acitve_fiscal['payroll_fiscal_year_start']);
    	
    	$option											=	mvc_model('model.option')->select_option('payroll_cutoff', 'WHERE sysglobal_payroll_id='.($acitve_fiscal['sysglobal_payroll_id']*1).' ORDER BY payroll_cutoff_id ASC');
    	$label[0]										=  'payroll_cutoff_date_start';
    	$label[1]										=  'payroll_cutoff_date_end';
    	$data['filter_type_f']							=	hash_cutoff($option, 'payroll_cutoff_id', $label,$cut_off_id_f);
    	$data['filter_type_s']							=	hash_cutoff($option, 'payroll_cutoff_id', $label,$cut_off_id_s);
    	$data['summary']								=	mvc_model('model.user_payroll_attendance')->select_user_summary($id,$sched_array);
    	
    	if($cut_off_id_s != $cut_off_id_f)
    	{
			$data['a_range']								=   '<td>'.string_date_day_enclosed($range_f['payroll_cutoff_date_start']).' - '.string_date_day_enclosed($range_f['payroll_cutoff_date_end']).' to '.string_date_day_enclosed($range_s['payroll_cutoff_date_start']).' - '.string_date_day_enclosed($range_s['payroll_cutoff_date_end']).'</td>';
    	}
    	else
    	{
			$data['a_range']								=   '<td>'.string_date_day_enclosed($range_f['payroll_cutoff_date_start']).' - '.string_date_day_enclosed($range_f['payroll_cutoff_date_end']).'</td>';
    	}
    	
    	
    	 
    	//hash_dump($data['summary'],1);
    	if(count($data['summary']['id_late']) > 0)
    	{
			if(count($data['summary']['id_late']) > 1)
			{
				$id_array								=  implode(',',$data['summary']['id_late']);
			}
			else
			{
				$id_array								=  $data['summary']['id_late'][0];
			}
			
			$data['late_row']							=	mvc_model('model.user_payroll_attendance')->select_all_by_stamp_id($id_array);
    	}
    	else
    	{
			$template_row_empty							=	'payroll/template/row.empty_attendance_late';
			$template_row_empty							=	view_get_template($template_row_empty);
			
			$data['late_row']							=   $template_row_empty;
    	}
    	# VIEW - side nav
    	$side_nav['user_id']							=	$id;  
        $side_nav['attendance_history.class']			=	'bold';         	
       	$data['side_nav']								=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);       
        # VIEW
        $parent->_view('employees.attendance_history', $data);          
    } 
    
    public function payslip_history($parent)
    {      	
    	$id											 	=   $_GET['id']*1;
    	# DB
    	$data						 				 	=	mvc_model('model.user')->select($id);
    	$data['row.payslip']							=   mvc_model('model.user_payroll_cutoff')->select_by_user($id);
    	# VIEW - side nav
    	$side_nav['user_id']						 	=	$id;  
        $side_nav['payslip_history.class']				=	'bold';         	
       	$data['side_nav']								=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);       
        # VIEW
        $parent->_view('employees.payslip_history', $data);          
    } 
    
    
    public function annual_report($parent)
    {      	
    	$id											 	=   $_GET['id']*1;
    	$acitve_fiscal									=	mvc_model('model.sysglobal_payroll')->select_active();
    	# DB
    	$data						 				 	=	mvc_model('model.user')->select($id);
    	$data['report']									=   mvc_model('model.payroll_cutoff')->select_all_current($acitve_fiscal['sysglobal_payroll_id'],$id);
    	# VIEW - side nav
    	$side_nav['user_id']						 	=	$id;  
        $side_nav['annual_report.class']				=	'bold';         	
       	$data['side_nav']								=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);       
        # VIEW
        $parent->_view('employees.annual_report', $data);          
    } 
    
    
    public function leaves($parent)
    {      	
    	$id											 	=   $_GET['id']*1;
    	# DB
    	$data						 				 	=	mvc_model('model.user')->select($id);
    	$data['row.leave']						 	 	=	mvc_model('model.user_payroll_leave')->select_all_by_user($id);
    	$data['fiscal']									=	mvc_model('model.sysglobal_payroll')->select_active();
    	$counts											=   $this->leave_counts($data);
    	$data['counts']									=   $counts;
    	//hash_dump($data['counts']['fiscal'],1);
    	# VIEW - side nav
    	$side_nav['user_id']						 	=	$id;  
        $side_nav['leaves.class']						=	'bold';         	
       	$data['side_nav']								=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);       
        # VIEW
        $parent->_view('employees.leaves', $data);          
    } 
    
    public function loans($parent)
    {      	
    	$id											 	=   $_GET['id']*1;
    	# DB
    	$data						 				 	=	mvc_model('model.user')->select($id);
    	$data['row.loan']						 	 	=	mvc_model('model.user_payroll_loan')->select_all($id);
    	$data['id']										=	$id;
    	# VIEW - side nav
    	$side_nav['user_id']						 	=	$id;  
        $side_nav['loans.class']					 	=	'bold';         	
       	$data['side_nav']							 	=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);       
        # VIEW
        $parent->_view('employees.loans', $data);          
    }
    
    public function memo($parent)
    {      	
    	$id											 	=   $_GET['id']*1;
    	# DB
    	$data						 				 	=	mvc_model('model.user')->select($id);
    	$data['row.memo']						 	 	=	mvc_model('model.user_payroll_memo')->select_all($id);
    	$option_memo						 	 		=	mvc_model('model.option.payroll_memo')->select_all();
    	$data['id']										=	$id;
    	$data['row.remark']						    	=	mvc_model('model.remark')->get_indep_row('payroll_memo', $id);   
    	foreach($option_memo as $row)
    	{
			$summary									=	mvc_model('model.user_payroll_memo')->get_summary($id,$row['option_payroll_memo_id']);
			
			$last_date								 	=   ($summary['memo_count'] < 1) ? 'N/A' : string_date_day_enclosed($summary['latest_memo']);
			$data['row.memo_summary']			       .=   '<tr>
									                        <td class="color_gray" align="center">'.$row['option_payroll_memo_name'].'</td>
									                        <td class="color_gray" align="center">'.$summary['memo_count'].'</td>
									                        <td class="color_gray" align="center">'.$last_date.'</td>
									                    </tr>';
			
    	}
    	
    	# VIEW - side nav
    	$side_nav['user_id']						 	=	$id;  
        $side_nav['late_memo.class']					=	'bold';         	
       	$data['side_nav']							 	=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);       
        # VIEW
        $parent->_view('employees.memo', $data);          
    }
    
    
    public function loan_payslips($parent)
    {      	
    	$id											 	=   $_GET['id']*1;
    	$loan_id										=   $_GET['loan_id']*1;
    	# DB
    	$data						 				 	=	mvc_model('model.user')->select($id);
    	$data['row.payslip']							=   mvc_model('model.user_payroll_loan_cutoff')->select_by_user_loan_id($loan_id);
    	# VIEW - side nav
    	$side_nav['user_id']						 	=	$id;  
        $side_nav['loans.class']						=	'bold';         	
       	$data['side_nav']								=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);       
        # VIEW
        $parent->_view('employees.loan_payslip', $data);           
    } 
    
   
    
    public function remark($parent)
    {
  	 	$id												=   $_GET['id']*1;
    	$data						 				 	=	mvc_model('model.user')->select($id);
    	# DB
        $data['row.remark']						    	=		mvc_model('model.remark')->get_employee_row('user', $id);            
        # VIEW - side nav
        $side_nav['remark.class']						=	'bold';  
        $side_nav['user_id']						 	=	$id;         	
       	$data['side_nav']								=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);           
        # VIEW
        $parent->_view('employees.remark', $data);      
	}
	
	
	 public function view_payslip($parent)
    {      	
    	$id											= $_GET['id']*1;
    	$c_id										= $_GET['cutoff']*1;
    	$upid										= $_GET['upid']*1;
    	# DB
    	$data 									 	=  mvc_model('model.user_payroll_cutoff')->select_by_user_cutoff($c_id,$id);
    	//hash_dump($data,1);
    	$data['user']				 				=  mvc_model('model.user')->select($id);
    	
    	$schedule									=  mvc_model('model.payroll_schedule')->select($data['user']['payroll_schedule_id']);
    	$sched_array								=  $this->schedule_array($schedule);
    	$data['row.attendance']						=	mvc_model('model.user_payroll_attendance')->select_all_by_user_payslip($id,$c_id,$sched_array,$upid);
    	$salary								 		=  mvc_model('model.user_salary')->select($data['user_salary_id']);
    	$allowance									=  mvc_model('model.user_payroll_allowance')->select_all_by_user($id);
    	$deduction									=  mvc_model('model.user_payroll_deduction')->select_all_by_user($id);
    	$loans										=  mvc_model('model.user_payroll_loan_cutoff')->select_all_by_user_cutoff($upid);
    	$conversion									=  mvc_model('model.user_payroll_leave_convert')->select_by_cutoff_id_user($c_id,$id);
    	$salary_addition							=  mvc_model('model.user_salary_addition')->select_by_cutoff_id_user($c_id,$id);
    	$salary_deduction							=  mvc_model('model.user_salary_deduction')->select_by_cutoff_id_user($c_id,$id);
    	$bonus									    =  mvc_model('model.user_salary_deduction')->select_by_cutoff_id_user($c_id,$id);
    	foreach($bonus as $bb_row)
    	{
		 	
			$data['bb_row']						    .=  '<tr>
									                        <td class="color_gray">
									                            '.$bb_row['payroll_bonus_name'].':
									                        </td>
									                        <td>'.
									                            string_amount($bb_row['user_payroll_bonus_amount']).'
									                        </td>
									                    </tr>';
    	}
    	foreach($salary_deduction as $sd_row)
    	{
		 	
			$data['sd_row']						    .=  '<tr>
									                        <td class="color_gray">
									                            '.$sd_row['user_salary_deduction_name'].':
									                        </td>
									                        <td>'.
									                            string_amount($sd_row['user_salary_deduction_amount']).'
									                        </td>
									                    </tr>';
    	}
    	foreach($salary_addition as $sa_row)
    	{
			
			$data['sa_row']						    .=  '<tr>
									                        <td class="color_gray">
									                            '.$sa_row['user_salary_addition_name'].':
									                        </td>
									                        <td>'.
									                            string_amount($sa_row['user_salary_addition_amount']).'
									                        </td>
									                    </tr>';
    	}
    	foreach($conversion as $c_row)
    	{
			
			$data['c_row']						    .=  '<tr>
									                        <td class="color_gray">
									                            '.$c_row['conversion_type'].':
									                        </td>
									                        <td>'.
									                            string_amount($c_row['user_payroll_leave_convert_amount']).'
									                        </td>
									                    </tr>';
    	}
    	foreach($loans as $l_row)
    	{
			
			$data['l_row']						    .=  '<tr">
									                        <td class="color_gray">
									                            '.$l_row['user_payroll_loan_name'].':
									                        </td>
									                        <td>'.
									                            string_amount($l_row['user_payroll_loan_cutoff_payment']).'
									                        </td>
									                    </tr>';
    	}
    	foreach($deduction as $d_row)
    	{
			$total=0;
			if($d_row['payroll_deduction_trigger'] == $data['payroll_cutoff_pos'] || $d_row['payroll_deduction_trigger'] == 0 ) 
			{
				
				if($d_row['option_value_type_id'] == 'fixed')
				{
					$total				=   ($d_row['payroll_deduction_value']+$d_row['payroll_deduction_value_employee']);
				}
				else
				{
					$total				=  $salary['user_basic_salary']*($d_row['payroll_deduction_value']/100);
				}
				
				$data['d_row']						    .=  '<tr>
									                            <td class="color_gray">
									                                '.$d_row['payroll_deduction_name'].':
									                            </td>
									                            <td>'.
									                                string_amount($total).'
									                            </td>
									                        </tr>';
			}
			
    	}
    	
    	foreach($allowance as $a_row)
    	{
			
			$data['a_row']						   .=  '<tr>
									                        <td class="color_gray">
									                            '.$a_row['payroll_allowance_name'].':
									                        </td>
									                        <td>'.
									                            string_amount($a_row['payroll_allowance_value']).'
									                        </td>
									                    </tr>';
    	}
    	# VIEW - side nav
        # VIEW
        $parent->_view('employees.view_payslip', $data);          
    } 
    
    
    
     public function view_loan_payslip($parent)
    {      	
    	$id											= $_GET['id']*1;
    	$c_id										= $_GET['cutoff']*1;
    	$l_id						    			= $_GET['loan_id']*1;
    	$upid										= $_GET['upid']*1;
    	//hash_dump($data,1);
    	# DB
    	$data 									 	=  mvc_model('model.user_payroll_cutoff')->select_by_user_cutoff($c_id,$id);
    	$data['loan_id']						    = $l_id;
    	$data['cutoff']						    	= $c_id;
    	//hash_dump($data,1);
    	$data['user']				 				=  mvc_model('model.user')->select($id);
    	$salary								 		=  mvc_model('model.user_salary')->select($data['user_salary_id']);
    	$allowance									=  mvc_model('model.user_payroll_allowance')->select_all_by_user($id);
    	$deduction									=  mvc_model('model.user_payroll_deduction')->select_all_by_user($id);
    	$loans										=  mvc_model('model.user_payroll_loan_cutoff')->select_all_by_user_cutoff($upid);
    	$conversion									=  mvc_model('model.user_payroll_leave_convert')->select_by_cutoff_id_user($c_id,$id);
    	$salary_addition							=  mvc_model('model.user_salary_addition')->select_by_cutoff_id_user($c_id,$id);
    	$salary_deduction							=  mvc_model('model.user_salary_deduction')->select_by_cutoff_id_user($c_id,$id);
    	$bonus									    =  mvc_model('model.user_salary_deduction')->select_by_cutoff_id_user($c_id,$id);
    	foreach($bonus as $bb_row)
    	{
		 	
			$data['bb_row']						    .=  '<tr>
									                        <td class="color_gray">
									                            '.$bb_row['payroll_bonus_name'].':
									                        </td>
									                        <td>'.
									                            string_amount($bb_row['user_payroll_bonus_amount']).'
									                        </td>
									                    </tr>';
    	}
    	foreach($salary_deduction as $sd_row)
    	{
			
			$data['sd_row']						    .=  '<tr>
									                        <td class="color_gray">
									                            '.$sd_row['user_salary_deduction_name'].':
									                        </td>
									                        <td>'.
									                            string_amount($sd_row['user_salary_deduction_amount']).'
									                        </td>
									                    </tr>';
    	}
    	foreach($salary_addition as $sa_row)
    	{
			
			$data['sa_row']						    .=  '<tr>
									                        <td class="color_gray">
									                            '.$sa_row['user_salary_addition_name'].':
									                        </td>
									                        <td>'.
									                            string_amount($sa_row['user_salary_addition_amount']).'
									                        </td>
									                    </tr>';
    	}
    	
    	foreach($conversion as $c_row)
    	{
			
			$data['c_row']						    .=  '<tr>
									                        <td class="color_gray">
									                            '.$c_row['conversion_type'].':
									                        </td>
									                        <td>'.
									                            string_amount($c_row['user_payroll_leave_convert_amount']).'
									                        </td>
									                    </tr>';
    	}
    	foreach($loans as $l_row)
    	{
			
			$data['l_row']						    .=  '<tr">
									                        <td class="color_gray">
									                            '.$l_row['user_payroll_loan_name'].':
									                        </td>
									                        <td>'.
									                            string_amount($l_row['user_payroll_loan_cutoff_payment']).'
									                        </td>
									                    </tr>';
    	}
    	foreach($deduction as $d_row)
    	{
			$total=0;
			if($d_row['payroll_deduction_trigger'] == $data['payroll_cutoff_pos'] || $d_row['payroll_deduction_trigger'] == 0 ) 
			{
				
				if($d_row['option_value_type_id'] == 'fixed')
				{
					$total				=   ($d_row['payroll_deduction_value']+$d_row['payroll_deduction_value_employee']);
				}
				else
				{
					$total				=  $salary['user_basic_salary']*($d_row['payroll_deduction_value']/100);
				}
				
				$data['d_row']						    .=  '<tr>
									                            <td class="color_gray">
									                                '.$d_row['payroll_deduction_name'].':
									                            </td>
									                            <td>'.
									                                string_amount($total).'
									                            </td>
									                        </tr>';
			}
			
    	}
    	
    	foreach($allowance as $a_row)
    	{
			
			$data['a_row']						   .=  '<tr>
									                        <td class="color_gray">
									                            '.$a_row['payroll_allowance_name'].':
									                        </td>
									                        <td>'.
									                            string_amount($a_row['payroll_allowance_value']).'
									                        </td>
									                    </tr>';
    	}
    	# VIEW - side nav
        # VIEW
        $parent->_view('employees.view_loan_payslip', $data);          
    }
    
 //======================================FORMS
 
  
	public function add_loan($parent)
    {
    	$id											 	=   $_GET['id']*1;
    	$data['id']										=	$id;
    	# DB
        # VIEW - side nav
        $side_nav['loans.class']						=	'bold'; 
         $side_nav['user_id']						 	=	$id;        	
       	$data['side_nav']								=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);         	          
      
     	# VIEW
        $parent->_view('employees.form.add.loan', $data);        
	}
	
	public function add_memo($parent)
    {
    	$id											 	=   $_GET['id']*1;
    	$data['id']										=	$id;
    	$memo_type	    								=	mvc_model('model.option')->select_option('option_payroll_memo', 'ORDER BY option_payroll_memo_name ASC');
    	$data['memo_type']								=	hash_to_option($memo_type, 'option_payroll_memo_id', 'option_payroll_memo_name');
    	# DB
        # VIEW - side nav
        $side_nav['late_memo.class']					=	'bold'; 
         $side_nav['user_id']						 	=	$id;        	
       	$data['side_nav']								=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);         	          
      
     	# VIEW
        $parent->_view('employees.form.add.memo', $data);        
	}
	
	public function edit_loan($parent)
    {
    	$id											 	=   $_GET['id']*1;
    	$l_id											=   $_GET['loan_id']*1;
    	$data											=	mvc_model('model.user_payroll_loan')->select($l_id);
    	$data['id']										=	$id;
    	$data['loan_id']								=	$l_id;
    	if($data['user_payroll_loan_status'] == 'active')
    	{
			$data['back_cancel']		= 'Cancel';
			
    	}
    	else
    	{
			$data['back_cancel']		= 'Back To Loan List';
			$data['submit_view']		= 'display_none';
    	}
    	# DB
        # VIEW - side nav
        $side_nav['loans.class']						=	'bold'; 
         $side_nav['user_id']						 	=	$id;        	
       	$data['side_nav']								=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);         	          
      
     	# VIEW
        $parent->_view('employees.form.edit.loan', $data);        
	}
	
	public function add_backpay($parent)
    {
    	$id											 	=   $_GET['id']*1;
    	$data['id']										=	$id;
    	$fiscal_data									=	mvc_model('model.sysglobal_payroll')->select_active();
    	$data['row.backpay']						 	 =	mvc_model('model.user_payroll_backpay')->select_all_by_fiscal_id_user($fiscal_data['sysglobal_payroll_id'],$id);
    	$backpay_type	    							=	mvc_model('model.option')->select_option('payroll_backpay', 'ORDER BY payroll_backpay_name ASC');
    	$data['backpay_type']							=	hash_to_option($backpay_type, 'payroll_backpay_id', 'payroll_backpay_name');
    	$data['row.remark']						    	=	mvc_model('model.remark')->get_indep_row('payroll_backpay', $id);   
    	# DB
        # VIEW - side nav
        $side_nav['add_backpay.class']					=	'bold';      
         $side_nav['user_id']						 	=	$id;    	
       	$data['side_nav']								=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);         	          
       
     	# VIEW
        $parent->_view('employees.form.add.backpay', $data);        
	}
	
	public function salary_addition($parent)
    {
    	$id											 	=   $_GET['id']*1;
    	$c_id											= 	$_GET['cutoff']*1;
    	$upid											= 	$_GET['upid']*1;
    	$data['id']										=	$id;
    	$data['cutoff']									=	$c_id;
    	$data['upid']									=	$upid;
    	# DB
        # VIEW - side nav
        $side_nav['view_payslip.class']					=	'bold';      
        $side_nav['user_id']						 	=	$id;    	
       	$data['side_nav']								=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);         	          
       
     	# VIEW
        $parent->_view('employees.form.add.salary_addition', $data);        
	}
	
	public function salary_deduction($parent)
    {
    	$id											 	=   $_GET['id']*1;
    	$c_id											= 	$_GET['cutoff']*1;
    	$upid											= 	$_GET['upid']*1;
    	$data['id']										=	$id;
    	$data['cutoff']									=	$c_id;
    	$data['upid']									=	$upid;
    	# DB
        # VIEW - side nav
        $side_nav['view_payslip.class']					=	'bold';      
        $side_nav['user_id']						 	=	$id;    	
       	$data['side_nav']								=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);         	          
       
     	# VIEW
        $parent->_view('employees.form.add.salary_deduction', $data);        
	}
	
	public function add_bonus($parent)
    {
    	$id											 	=   $_GET['id']*1;
    	$data['id']										=	$id;
    	$bonus_type	    								=	mvc_model('model.option')->select_option('payroll_bonus', 'ORDER BY payroll_bonus_name ASC');
    	$data['bonus_type']								=	hash_to_option($bonus_type, 'payroll_bonus_id', 'payroll_bonus_name');
    	$acitve_fiscal									=	mvc_model('model.sysglobal_payroll')->select_active();
    	$option											=	mvc_model('model.option')->select_option('payroll_cutoff', 'WHERE sysglobal_payroll_id='.($acitve_fiscal['sysglobal_payroll_id']*1).' ORDER BY payroll_cutoff_id ASC');
    	$label[0]										=  'payroll_cutoff_date_start';
    	$label[1]										=  'payroll_cutoff_date_end';
    	$data['filter_type']							=	hash_cutoff($option, 'payroll_cutoff_id', $label);
    	
    	$data['row.bonus']						 	=	mvc_model('model.user_payroll_bonus')->select_all_by_fiscal_id_user($acitve_fiscal['sysglobal_payroll_id'],$id);
    	# DB
        # VIEW - side nav
        $side_nav['add_bonus.class']					=	'bold';
        $side_nav['user_id']						 	=	$id;          	
       	$data['side_nav']								=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);         	          
       
     	# VIEW
        $parent->_view('employees.form.add.bonus', $data);        
	}
	
	public function add_leave($parent)
    {
    	$id											 	=   $_GET['id']*1;
    	# DB
        # VIEW - side nav
        $side_nav['user_id']						 	=	$id; 
        $side_nav['add_leave.class']					=	'bold';         	
       	$data['side_nav']								=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);         	          
       
     	# VIEW
        $parent->_view('employees.form.add_leave', $data);        
	}
	
	public function edit_details($parent)
    {
    	$id									    =   $_GET['id']*1;
    	# DB
    	$data									=	mvc_model('model.user')->select($id);  
    	$data['id']								=   $id;	
    	$data['salary']							=	mvc_model('model.user_salary')->select($data['user_salary_id']);
    	$data['salary']['user_salary_date_effect'] = ($data['salary']['user_salary_date_effect']) ? $data['salary']['user_salary_date_effect'] : time();
    	$user_allowance							=	mvc_model('model.user_payroll_allowance')->select_all_by_user($id);   	
    	$user_deduction							=	mvc_model('model.user_payroll_deduction')->select_all_by_user($id);   	
    	$option_job_title						=	mvc_model('model.option')->select_option('option_user_job_title', 'ORDER BY option_user_job_title_name ASC');       	
    	$option_user_status						=	mvc_model('model.option')->select_option('option_user_status', 'ORDER BY option_user_status_name ASC');       	
       	$option_department						=	mvc_model('model.option')->select_option('option_department', 'ORDER BY option_department_name ASC');       	
       	$option_tax								=	mvc_model('model.option')->select_option('payroll_tax', 'ORDER BY payroll_tax_name ASC');       	
       	$option_schedule						=	mvc_model('model.option')->select_option('payroll_schedule', 'ORDER BY payroll_schedule_name ASC');       	
       	$option_level							=	mvc_model('model.option')->select_option('option_user_level', 'ORDER BY option_user_level_name ASC');       	
       	$option_sss								=	mvc_model('model.option')->select_option('payroll_deduction', " WHERE option_deduction_type_id='sss'");       	
       	$option_phealth							=	mvc_model('model.option')->select_option('payroll_deduction', " WHERE option_deduction_type_id='philhealth'"); 
       	$option_section							=	mvc_model('model.option')->select_option('option_department_section', 'ORDER BY option_department_section_name ASC');      	
      // 	$option_sss								=	mvc_model('model.option')->select_option('user_payroll_deduction', 'ORDER BY option_user_level_name ASC');       	
        #check box ids
        $sss_id = 0;
        $phealth_id = 0;
        foreach($user_allowance as $x)
        {
			$a_id[] = $x['payroll_allowance_id'];
        }
       
        foreach($user_deduction as $x)
        {
			if($x['option_deduction_type_id'] == 'sss')
			{
				
				$sss_id 		= $x['payroll_deduction_id'];
			}
			elseif($x['option_deduction_type_id'] == 'philhealth')
			{
				
				$phealth_id 	= $x['payroll_deduction_id'];
			}
			else
			{
				$d_id[] = $x['payroll_deduction_id'];
			}
			
        }
        
        
        $active_fiscal						 	=	mvc_model('model.user_payroll_attendance')->check_if_active_fiscal($id);
		$data['payroll_up_button']				=  ($active_fiscal) ? '<a href="/payroll/settings/delete_attendance/&id='.$id.'" class="link_button_inline green">Remove Daily Stamp</a>' : '<a href="/payroll/settings/insert_attendance/&id='.$id.'" class="link_button_inline green">Create Daily Stamp</a>';
        
        
        $data['allowance']						=  mvc_model('model.payroll_allowance')->select_all_check_box($a_id); 
        $data['deduction']						=  mvc_model('model.payroll_deduction')->select_all_check_box($d_id); 
        
        # VIEW - db options
        $data['option_user_status']				=	hash_to_option($option_user_status, 'option_user_status_id', 'option_user_status_name', $data['option_user_status_id']);
        $data['option_department']				=	hash_to_option($option_department, 'option_department_id', 'option_department_name', $data['option_department_id']);
        $data['option_tax']						=	hash_to_option($option_tax, 'payroll_tax_id', 'payroll_tax_name', $data['payroll_tax_id']);
        $data['option_schedule']				=	hash_to_option($option_schedule, 'payroll_schedule_id', 'payroll_schedule_name', $data['payroll_schedule_id']);
        $data['option_job_title']				=	hash_to_option($option_job_title, 'option_user_job_title_id', 'option_user_job_title_name', $data['option_user_job_title_id']);
        $data['option_user_level']				=	hash_to_option($option_level, 'option_user_level_id', 'option_user_level_name', $data['option_user_level_id']);
        $data['option_sss']						=	hash_to_option($option_sss, 'payroll_deduction_id', 'payroll_deduction_name', $sss_id);
        $data['option_phealth']					=	hash_to_option($option_phealth, 'payroll_deduction_id', 'payroll_deduction_name', $phealth_id);
        $data['option_section']				    =	hash_to_option($option_section, 'option_department_section_id', 'option_department_section_name', $data['option_department_section_id']);
        # VIEW - side nav
        $side_nav['user_id']					=	$id; 
        $side_nav['edit_details.class']			=	'bold';         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.employees', $side_nav);
        # VIEW     
        $parent->_view('employees.form.edit.details', $data);    	
	}
	
    
  #----------------------- Form Actions
  
  public function leave_counts($data)
    {      	
    	$schedule										=  mvc_model('model.payroll_schedule')->select($data['payroll_schedule_id']);
    	$return['vl_count']								=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user_id'],'payroll_leave_vacation',$schedule);
    	$return['sl_count']								=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user_id'],'payroll_leave_sick',$schedule);
    	$return['el_count']								=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user_id'],'payroll_leave_emergency',$schedule);
    	$return['mln_count']							=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user_id'],'payroll_leave_maternity_normal',$schedule);
    	$return['mlc_count']							=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user_id'],'payroll_leave_maternity_cs',$schedule);
    	$return['npl_count']							=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user_id'],'payroll_leave_no_pay',$schedule);
    	$return['bl_count']								=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user_id'],'payroll_leave_bereavement',$schedule);
    	$return['pl_count']								=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user_id'],'payroll_leave_paternity',$schedule);
    	$return['sp_count']								=	mvc_model('model.user_payroll_leave')->get_count_user_type($data['user_id'],'payroll_leave_solo_parent',$schedule);
    	
    	
    	//=============================
    	
    	$return['fiscal']['payroll_leave_vacation']			=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_vacation'],$return['vl_count'],$schedule['payroll_schedule_work_hours'],$data['fiscal']['sysglobal_payroll_id'],$data,'payroll_leave_vacation');
    	$return['fiscal']['payroll_leave_sick']				=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_sick'],$return['sl_count'],$schedule['payroll_schedule_work_hours'],$data['fiscal']['sysglobal_payroll_id'],$data,'payroll_leave_sick');
    	$return['fiscal']['payroll_leave_emergency']		=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_emergency'],$return['el_count'],$schedule['payroll_schedule_work_hours']);
    	$return['fiscal']['payroll_leave_maternity_normal']	=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_maternity_normal'],$return['mln_count'],$schedule['payroll_schedule_work_hours']);
    	$return['fiscal']['payroll_leave_maternity_cs']		=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_maternity_cs'],$return['mlc_count'],$schedule['payroll_schedule_work_hours']);
    	$return['fiscal']['payroll_leave_no_pay']			=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_no_pay'],$return['npl_count'],$schedule['payroll_schedule_work_hours']);
    	$return['fiscal']['payroll_leave_bereavement']		=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_bereavement'],$return['bl_count'],$schedule['payroll_schedule_work_hours']);
    	$return['fiscal']['payroll_leave_paternity']		=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_paternity'],$return['pl_count'],$schedule['payroll_schedule_work_hours']);
    	$return['fiscal']['payroll_leave_solo_parent']		=  $this->get_days_hours_remain($data['fiscal']['payroll_leave_solo_parent'],$return['sp_count'],$schedule['payroll_schedule_work_hours']);
    	//hash_dump($return['fiscal'],1);
    	//=============================
    	$return['npl_count']								=   $this->label_count($return['npl_count'],$schedule);
    	$return['bl_count']									=   $this->label_count($return['bl_count'],$schedule);
    	$return['pl_count']									=   $this->label_count($return['pl_count'],$schedule); 
    	$return['sp_count']									=   $this->label_count($return['sp_count'],$schedule);
    	$return['vl_count']									=   $this->label_count($return['vl_count'],$schedule,$data['fiscal']['sysglobal_payroll_id'],$data['user_id'],'payroll_leave_vacation');
    	$return['sl_count']									=   $this->label_count($return['sl_count'],$schedule,$data['fiscal']['sysglobal_payroll_id'],$data['user_id'],'payroll_leave_sick');
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
			
			$hrs_remain 			= $work_hours - $leave_count_array['hour_count'];
			$fiscal_data_count	  	= ($leave_count_array['hour_count'] > 0)?'0 day/s & '.$hrs_remain .' hr/s':'0 day/s';
			
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
	
	
	
   private function check_effective_salary($parent)
	{		
		
		$curr							=	time();
		$year 							=	string_date_year($curr); 
		$month 							=	string_date_month_numeric($curr); 
		$day 							=	string_day($curr);
		$curr							=   strtotime($month.'/'.$day.'/'.$year); 
		$salary							=	mvc_model('model.user_salary')->select_all_by_date($curr);
		if($salary)
		{
			foreach($salary as $row)
			{
				$post['int']['user_salary_id']		=   $row['user_salary_id'];
				mvc_model('model.user')->update($post, $row['user_id']);
				if($row['generated'] == 0)
				{
					$this->generate_remark($row['handler_id'],$row['user_id']);
				}
				
			}
		}
	} 
	
	 private function generate_remark($handler_id,$id)
	{		
		//set computer generated
			$user										=	mvc_model('model.user')->select($id);
			$deduction									=   mvc_model('model.user_payroll_deduction')->select_all_by_user($id);
			$allowance									=   mvc_model('model.user_payroll_allowance')->select_all_by_user($id);
			$tax										=   mvc_model('model.payroll_tax')->select($user['payroll_tax_id']);
			$salary								 		=  mvc_model('model.user_salary')->select($user['user_salary_id']);
			$schedule									=   mvc_model('model.payroll_schedule')->select($user['payroll_schedule_id']);
			$d_list										=  '';
			$a_list										=  '';
			$remark_content								=  '===================================<br>';
			$remark_content								.=  'Computer Generated<br>';
			$remark_content								.=  '===================================<br>';
			foreach($deduction as $d_row)
			{
				$d_list	 .= $d_row['payroll_deduction_name'].'<br>';
			}
			foreach($allowance as $a_row)
			{
				$a_list	 .= $a_row['payroll_allowance_name'].'<br>';
			}
			
			$remark_content							   .=   '<b>First Name:</b> '.$user['user_name'].'<br>';
			$remark_content							   .=   '<b>Last Name:</b> '.$user['user_surname'].'<br>';
			$remark_content							   .=   '<b>Email Address:</b> '.$user['user_email'].'<br>';
			$remark_content							   .=   '<b>Mobile Number:</b> '.$user['user_contact'].'<br>';
			$remark_content							   .=   '<b>Home Address:</b> '.$user['user_address'].'<br>';
			$remark_content							   .=   '<b>Basic Salary:</b> '.string_amount($salary['user_basic_salary']).'<br>';
			$remark_content							   .=   '<b>Salary Effective Date:</b> '.string_date($salary['user_salary_date_effect']).'<br>';
			$remark_content							   .=   '<b>Schedule:</b> '.$schedule['payroll_schedule_name'].'<br>';
			$remark_content							   .=   '<b>Tax Profile:</b> '.$tax['payroll_tax_name'].'<br>';
			$remark_content							   .=   '<b>Allowances:</b> <br>'.$a_list;
			$remark_content							   .=   '<b>Deductions:</b> <br>'.$d_list;
			
			$remark_post['user_id']						=	$handler_id;
			$remark_post['remark_key_id']				=	$id;
			$remark_post['remark_key']					=	'user';
			$remark_post['remark_content']				=	$remark_content;
			mvc_model('model.remark')->insert_no_parse($remark_post);
	}  
  
   public function submit_edit($parent)
	{	
		$id 	=	string_clean_number($_POST['id']);		
		//hash_dump($_POST,1);
		if($id) # Update
		{
			$user										=	mvc_model('model.user')->select($id);
			//hash_dump($user,1);
			$salary								 		=	mvc_model('model.user_salary')->select($user['user_salary_id']);
			$curr										=	time();
			$year 										=	string_date_year($curr); 
			$month 										=	string_date_month_numeric($curr); 
			$day 										=	string_day($curr);
			$curr										=   strtotime($month.'/'.$day.'/'.$year); 
			$next										=   $curr+86400;
			$generated									=   0;
			if($salary)
			{
				if(string_clean_number($_POST['us']['int']['user_basic_salary']) != string_clean_number($salary['user_basic_salary']))
				{
					$_POST['us']['int']['user_daily_salary']	=	(string_clean_number($_POST['us']['int']['user_basic_salary']) / 22);
					$_POST['us']['int']['user_hourly_salary']	=	(string_clean_number($_POST['us']['int']['user_basic_salary']) / 22) / 8;
					$_POST['us']['int']['user_minute_salary']	=	($_POST['us']['int']['user_hourly_salary'] / 60);
					$_POST['us']['int']['user_id']				=	$id;
					$_POST['us']['int']['user_salary_date_effect']		=	strtotime($_POST['us']['int']['user_salary_date_effect']);
					$_POST['us']['int']['user_salary_timestamp']		=	time();
					$_POST['us']['int']['handler_id']					=	$parent->user['user_id'];
					
					if($_POST['us']['int']['user_salary_date_effect'] >= $curr || $_POST['us']['int']['user_salary_date_effect'] < $next)
					{
						$generated								=   1;
					}
					$_POST['us']['int']['generated']			=	$generated;
					$insert_salary								=	mvc_model('model.user_salary')->insert($_POST['us']);
					$salary_row									=   mvc_model('model.user_salary')->select_by_user_latest($id);
					$salary_id									=   $salary_row['user_salary_id'];
					$this->check_effective_salary();
				}
				else
				{
					$salary_id									=	$user['user_salary_id'];
				}
			}
			else
			{
					$_POST['us']['int']['user_daily_salary']	=	(string_clean_number($_POST['us']['int']['user_basic_salary']) / 22);
					$_POST['us']['int']['user_hourly_salary']	=	(string_clean_number($_POST['us']['int']['user_basic_salary']) / 22) / 8;
					$_POST['us']['int']['user_minute_salary']	=	($_POST['us']['int']['user_hourly_salary'] / 60);
					$_POST['us']['int']['user_id']				=	$id;
					$_POST['us']['int']['user_salary_date_effect']		=	strtotime($_POST['us']['int']['user_salary_date_effect']);
					$_POST['us']['int']['user_salary_timestamp']		=	time();
					$_POST['us']['int']['handler_id']					=	$parent->user['user_id'];
					
					if($_POST['us']['int']['user_salary_date_effect'] >= $curr || $_POST['us']['int']['user_salary_date_effect'] < $next)
					{
						$generated								=   1;
					}
					$insert_salary								=	mvc_model('model.user_salary')->insert($_POST['us']);
					$salary_row									=   mvc_model('model.user_salary')->select_by_user_latest($id);
					$salary_id									=   $salary_row['user_salary_id'];
					$this->check_effective_salary();
			}
			
			//$_POST['det']['int']['user_salary_id']				=   $salary_id;
			$_POST['det']['int']['user_hire_date']				=	strtotime($_POST['det']['int']['user_hire_date']);
			mvc_model('model.user')->update($_POST['det'], $id);	
			//
			if($_POST['sss_id'] > 0)
			{
				array_push($_POST['payroll_deduction'],$_POST['sss_id']);
			}
			if($_POST['phealth_id'] > 0)
			{
				array_push($_POST['payroll_deduction'],$_POST['phealth_id']);
			}
			
			$delete															=	mvc_model('model.user_payroll_allowance')->delete_entry($id);
			$delete															=	mvc_model('model.user_payroll_deduction')->delete_entry($id);
			$c_pa_id														= 	count($_POST['payroll_allowance']);
			$c_da_id														= 	count($_POST['payroll_deduction']);
			
			
			if($c_pa_id > 0)
			{
				foreach($_POST['payroll_allowance'] as $p_id)
				{
					$allowance_post['user_id']       						 = $id;
					$allowance_post['payroll_allowance_id']    			 	 = $p_id;
					$entry_rate = mvc_model('model.user_payroll_allowance')->insert($allowance_post);
				}
			}
			
			if($c_da_id > 0)
			{
				foreach($_POST['payroll_deduction'] as $d_id)
				{
					$deduction_post['user_id']       						 = $id;
					$deduction_post['payroll_deduction_id']    			 	 = $d_id;
					$entry_rate = mvc_model('model.user_payroll_deduction')->insert($deduction_post);
				}
			}
			$this->generate_remark($parent->user['user_id'],$id);
			header_location("/payroll/employees/edit_details/&id={$id}");
		}
		else # Insert
		{
			header_location('/payroll/employees');
		}		
	}
	
	public function submit_add_backpay($parent)
	{		
		$id 								=	$_POST['id']*1;		
		$user					 			=	mvc_model('model.user')->select($id);
		$fiscal_data						=	mvc_model('model.sysglobal_payroll')->select_active();
		$curr_time							=  time();
		
		$_POST['bp']['int']['user_payroll_backpay_timestamp']		=   time();
		$_POST['bp']['int']['sysglobal_payroll_id']					=   $fiscal_data['sysglobal_payroll_id'];
		$_POST['bp']['int']['user_payroll_backpay_date_approved']	=   strtotime($_POST['bp']['int']['user_payroll_backpay_date_approved']);
		$_POST['bp']['int']['user_payroll_backpay_release_date']	=   strtotime($_POST['bp']['int']['user_payroll_backpay_release_date']);
		$insert														=   mvc_model('model.user_payroll_backpay')->insert($_POST['bp']);
		header_location("/payroll/employees/add_backpay/&id={$id}"); 
	}
	
	public function submit_update_salary($parent)
	{		
		$id 			=	$_POST['id'];		
		$c_id 			=	$_POST['cutoff'];		
		$upid			=	$_POST['upid'];	
		$stamp_id		=	$_POST['timestamp_id'];	
		//hash_dump($_POST,1);
		$udpate 		=  mvc_model('model.user_payroll_attendance')->update($_POST['us'],$stamp_id);
		header_location("/payroll/employees/view_payslip/&cutoff={$c_id}&id={$id}&upid={$upid}#stamp"); 
	}
	
	
	public function submit_salary_deduction($parent)
	{		
		$id 								=	$_POST['id']*1;		
		$user					 			=	mvc_model('model.user')->select($id);
		$fiscal_data						=	mvc_model('model.sysglobal_payroll')->select_active();
		$curr_time							=  time();
		$cutoff_id							=   $_POST['cutoff']*1;		
		
		$_POST['sd']['int']['payroll_cutoff_id']					=   $cutoff_id;
		$_POST['sd']['int']['user_salary_deduction_timestamp']		=   time();
		$_POST['sd']['int']['sysglobal_payroll_id']					=   $fiscal_data['sysglobal_payroll_id'];
		$insert														=   mvc_model('model.user_salary_deduction')->insert($_POST['sd']);
		header_location("/payroll/employees/salary_deduction/&id={$id}&cutoff={$cutoff_id}"); 
	}
	
	public function submit_salary_addition($parent)
	{		
		$id 								=	$_POST['id']*1;		
		$user					 			=	mvc_model('model.user')->select($id);
		$fiscal_data						=	mvc_model('model.sysglobal_payroll')->select_active();
		$curr_time							=  time();
		$cutoff_id							=   $_POST['cutoff']*1;		
		$upid								=   $_POST['upid']*1;		
		
		$_POST['sd']['int']['payroll_cutoff_id']					=   $cutoff_id;
		$_POST['sd']['int']['user_salary_addition_timestamp']		=   time();
		$_POST['sd']['int']['sysglobal_payroll_id']					=   $fiscal_data['sysglobal_payroll_id'];
		$insert														=   mvc_model('model.user_salary_addition')->insert($_POST['sd']);
		header_location("/payroll/employees/salary_addition/&id={$id}&cutoff={$cutoff_id}&upid={$upid}"); 
	}
	
	
	public function submit_add_bonus($parent)
	{		
		
		$id 								=	$_POST['id']*1;		
		$user					 			=	mvc_model('model.user')->select($id);
		$fiscal_data						=	mvc_model('model.sysglobal_payroll')->select_active();
		$salary								=  mvc_model('model.user_salary')->select($user['user_salary_id']);
		$bonus					 			=	mvc_model('model.payroll_bonus')->select($_POST['bonus']['int']['payroll_bonus_id']);
		$month_count						=   count($_POST['month_count']);
		//$month_percent						=   round(($month_count/12));
		
		$bonus_rate							=   round(($bonus['payroll_bonus_rate']/100));
		
		$retro								=   $salary['user_basic_salary']/12;
		$bonus_pay	 						=   round($retro*$month_count);
		$bonus_pay	 						=   round($bonus_pay*$bonus_rate);
		
		
		//insert computation for amount
		
		$_POST['bonus']['int']['user_payroll_bonus_amount']				=   $bonus_pay;
		$_POST['bonus']['int']['user_payroll_basic_pay']				=   $salary['user_basic_salary'];
		$_POST['bonus']['int']['user_payroll_bonus_month_count']		=   $month_count;
		$_POST['bonus']['int']['user_payroll_bonus_timestamp']			=   time();
		$_POST['bonus']['int']['sysglobal_payroll_id']					=   $fiscal_data['sysglobal_payroll_id'];
		$_POST['bonus']['int']['user_payroll_bonus_date_approved']		=   strtotime($_POST['bonus']['int']['user_payroll_bonus_date_approved']);
		$insert															=   mvc_model('model.user_payroll_bonus')->insert($_POST['bonus']);
		header_location("/payroll/employees/add_bonus/&id={$id}"); 
	}
	
	
	
	public function submit_convert($parent)
	{		
		$id 								=	$_GET['id']*1;		
		$type   							=   $_GET['type'];
		$user					 			=	mvc_model('model.user')->select($id);
		$schedule							=   mvc_model('model.payroll_schedule')->select($user['payroll_schedule_id']);
		$fiscal_data						=	mvc_model('model.sysglobal_payroll')->select_active();
		$leave_type							=	$type;
    	$leave_count						=	mvc_model('model.user_payroll_leave')->get_count_user_type($id,$leave_type,$schedule);
    	$leave_remain						=   $this->get_days_hours_remain_count($fiscal_data[$leave_type],$leave_count,$schedule['payroll_schedule_work_hours']);
		$conversion_type					=   ($type == 'payroll_leave_sick')	? 'SL Conversion' : 'VL Conversion';
		$curr_time							=  time();
		$cutoff								=   mvc_model('model.payroll_cutoff')->get_current_cutoff($fiscal_data['sysglobal_payroll_id']*1,$curr_time);
		
		$post['payroll_cutoff_id']						=   $cutoff['payroll_cutoff_id'];
		$post['user_payroll_leave_count_day']			=   $leave_remain['days'];
		$post['user_payroll_leave_count_hour']			=   $leave_remain['hrs'];
		$post['user_payroll_leave_convert_timestamp']	=   time();
		$post['user_payroll_leave_convert_amount']		=   ($leave_remain['hrs']*$user['user_hourly_salary']) + ($leave_remain['days']*$user['user_daily_salary']);
		$post['user_payroll_leave_type_id']				=   $type;
		$post['user_id']								=   $id;
		$post['sysglobal_payroll_id']					=   $fiscal_data['sysglobal_payroll_id'];
		$post['conversion_type']						=   $conversion_type;
		//hash_dump($post,1);
		
		$check											=   mvc_model('model.user_payroll_leave_convert')->select_by_fiscal_id_user($fiscal_data['sysglobal_payroll_id'],$id,$type);
		if(!$check)
		{
			$insert										=   mvc_model('model.user_payroll_leave_convert')->insert($post);
		}
		
		header_location("/payroll/employees/leaves/&id={$id}"); 
	}
	
	private function get_days_hours_remain_count($fiscal_data_count,$leave_count_array,$work_hours)
	{		
		if($fiscal_data_count <= $leave_count_array['whole_count'])
    	{
			
			$hrs_remain 		  = $work_hours - $leave_count_array['hour_count'];
			$return['hrs']		  = $hrs_remain;
			$return['days']		  = 0;
    	}
    	else
    	{
			$leave_remain 	= $fiscal_data_count - $leave_count_array['whole_count'];
			$hrs_remain 	= $work_hours   - $leave_count_array['hour_count'];
			$return['days']	= ($leave_count_array['hour_count'] > 0)?$leave_remain-1: $leave_remain;
			$return['hrs']	= ($leave_count_array['hour_count'] > 0)?$hrs_remain: 0;
    	}
	
		return $return;
	}
	
	
	public function submit_add_loan($parent)
	{		
		$id 	=	string_clean_number($_POST['id']);		
		//$deactivate_other_loan										=  mvc_model('model.user_payroll_loan')->deactivate_by_user($id);
		$_POST['loan']['int']['user_payroll_loan_date_approved']	= strtotime($_POST['loan']['int']['user_payroll_loan_date_approved']);
		$_POST['loan']['int']['user_payroll_loan_cutoff_payment']	=  $_POST['loan']['int']['user_payroll_loan_amount'] / $_POST['loan']['int']['user_payroll_loan_cutoff_count'];
		$entry 										 				=  mvc_model('model.user_payroll_loan')->insert($_POST['loan']);
		header_location("/payroll/employees/loans/&id={$id}"); 
	}
	
	public function submit_add_memo($parent)
	{		
		$id 	=	string_clean_number($_POST['id']);		
		$_POST['memo']['int']['user_payroll_memo_date_sent']			= strtotime($_POST['memo']['int']['user_payroll_memo_date_sent']);
		$entry 										 					=  mvc_model('model.user_payroll_memo')->insert($_POST['memo']);
		header_location("/payroll/employees/memo/&id={$id}"); 
	}
	
	public function submit_edit_loan($parent)
	{		
		$id 			=	string_clean_number($_POST['id']);		
		$l_id 			=	string_clean_number($_POST['loan_id']);		
		$loan			=	mvc_model('model.user_payroll_loan')->select($l_id);
		$amount_remain  =   $loan['user_payroll_loan_amount'] - $loan['user_payroll_loan_paid'];
		
		$post['int']['user_payroll_loan_cutoff_payment']				=  $amount_remain / $_POST['loan']['int']['user_payroll_loan_cutoff_count'];
		$post['int']['user_payroll_loan_cutoff_count']					=  $_POST['loan']['int']['user_payroll_loan_cutoff_count'];
		//hash_dump($post,1);
		$udpate 										 				=  mvc_model('model.user_payroll_loan')->update($post,$l_id);
		header_location("/payroll/employees/edit_loan/&loan_id={$l_id}&id={$id}"); 
	}
	
	
	 public function submit_remark($parent)
	{
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/payroll/employees/remark/&id={$_POST['user_id']}");
	}
	
	 public function submit_memo_remark($parent)
	{
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/payroll/employees/memo/&id={$_POST['id']}#remarks");
	}
	
	public function submit_backpay_remark($parent)
	{
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/payroll/employees/add_backpay/&id={$_POST['id']}#remarks");
	}
	
	
	public function insert_employee($parent)
	{
		$e_string	=	'1+20046+BONDOC+WILFREDO +engineering+const_impln+04/12/76+PARAAN ST., STO. NINO, PLARIDEL, BULACAN=
						2+10006+CLEMENTE+MANUEL +engineering+const_impln+06/17/66+DAKILA, MALOLOS, BULACAN=
						3+10054+LOBEDERIO+MARK+engineering+const_impln+11/01/85+085 STA INES PLARIDEL, BULACAN=
						4+20137+MAPUE+RODALISA+engineering+const_impln+05/04/75+#354 BOROL 2ND, BALAGTAS, BUL.=
						5+10027+RAMOS+EMMANUEL +engineering+const_impln+06/17/75+#1273 PACO, OBANDO, BULACAN=
						6+10034+SALCEDO JR.+FERNANDO +engineering+const_impln+12/17/72+170 LAGUNDI, PLARIDEL, BULACAN=
						7+20050+SANTOS+ROMMEL+engineering+const_impln+05/17/70+0125 TIAONG, BALIUAG, BUL.=
						8+20115+SANTOS+SANTIAGO+engineering+const_impln+12/29/66+#542 STO. NINO, PLARIDEL, BUL.=
						9+20071+FERRERAS+MARILYN+engineering+cont_doc+08/31/83+274 BANGA 1ST PLARIDEL BULACAN=
						10+20158+GONZALES+VERLYN+engineering+cont_doc+11/20/92+MALAMIG, BUSTOS, BULACAN=
						11+10026+GUELAS+MAYLENE +engineering+cont_doc+08/21/77+1450 PARULAN, PLARIDEL, BUL.=
						12+20171+ROSAL+MARYEN JANELLE+engineering+cont_doc+03/25/92+18 E. DEL ROSARIO ST., TAAL, BOCAUE, BULACAN=
						13+20159+COLLADO+LOUIE+engineering+design_dev+07/20/79+PH2 B29 L2 LA RESIDENCIA SUBD., PIO CRUZCOSA, CALUMPIT, BULACAN=
						14+20032+CRUZ+MARILOU +engineering+design_dev+08/07/76+400 P. DAMASO ST., CONCEPCION, BALIUAG, BUL.=
						15+10023+DE BORJA+DENNIS +engineering+design_dev+02/04/75+856 F.T.REYES ST.STO. ROSARIO, MAL. BUL.=
						16+20128+GONZALES+CENETTE+engineering+design_dev+03/16/74+47 SAN VICENTE, APALIT, PAMP.=
						17+20155+JAVIER+SHEILA MAY+engineering+design_dev+02/16/91+MALAMIG, BUSTOS, BULACAN=
						18+20192+ABERGAS+MA. LULUBELLE+engineering+electrical+09/26/84+352 NIA ROAD, BARIHAN, MALOLOS CITY, BULACAN=
						19+10038+ADAON+PREDY+engineering+electrical+01/03/79+BOCAUE, BULACAN=
						20+20062+DE GUZMAN+ERNESTO+engineering+electrical+10/12/72+0378 RIVERSIDE, BULIHAN, MALOLOS CITY=
						21+20126+MARTIN+MAY ANDREA+engineering+electrical+05/30/82+57 LUWASAN BATA, BOCAUE, BUL=
						22+20156+MATIAS+HAIVELL JOY+engineering+electrical+05/18/92+380 TABING ILOG, BULIHAN, MALOLOS CITY, BULACAN=
						23+20104+ALVAREZ+JUDERICK+engineering+engineering+06/05/87+B1 L 1 PH2 GR SUBD. BULIHAN, MALOLOS CITY=
						24+10004+CAPARAS+AGAPITO+engineering+engineering+08/18/63+SAN PABLO MALOLOS, BULACAN=
						25+20015+CENSON+JOEL +engineering+engineering+10/07/66+146 SAN JOSE ST., BINANG 2ND, BOCAUE BUL=
						26+20078+DAYRIT+EBENIZER+engineering+engineering+11/10/81+4495 POBLACION, PLARIDEL, BULACAN=
						27+20038+DE JESUS+VICTOR+engineering+engineering+07/28/72+SAN AGUSTIN, HAGONOY, BULACAN=
						28+20053+DELA CRUZ+RUEL+engineering+engineering+10/02/84+#160 CAPIHAN, SAN RAFAEL, BULACAN=
						29+20024+DONATO+RODERICK +engineering+engineering+10/22/68+92 A. MABINI ST., BARIHAN, MALOLOS CITY, BULACAN=
						30+20058+LOPEZ+LIEZL+engineering+engineering+05/09/81+318 PULO, BARIHAN, MALOLOS CITY=
						31+10051+MADRID+PIA MARIE ISABELLE+engineering+engineering+01/22/89+4024 TABANG PLARIDEL BULACAN=
						32+20131+POSILLO+MA. LOURDES+engineering+engineering+11/19/73+6772 DAMPOL, PLARIDEL, BUL.=
						33+20001+RUSTIA+RUEL +engineering+engineering+12/14/64+#222 RIZAL ST., STA BARBARA, BALIUAG, BULACAN=
						34+20133+BELVEZ+MARY ANN NINA+engineering+permits_license+11/04/83+803 RIZAL ST., STA. BARBARA, BALIUAG, BULACAN=
						35+20051+CORTEZ+ROMIL+engineering+permits_license+05/28/70+BLK 5 LOT 19 PHASE 6B GRAND ROYALE SUBD., PINAGBAKAHAN, MALOLOS CITY=
						36+20069+DE GUZMAN+RICHIE+engineering+permits_license+03/11/80+2002 PUROK 2 SAN FRANCISCO BULACAN, BULACAN=
						37+20168+LEONCIO+JESSA+engineering+permits_license+05/15/90+207 STO. NINO, PLARIDEL, BULACAN=
						38+10028+LUCES+REYNALDO +engineering+permits_license+06/22/68+SAN NICOLAS, BULACAN, BULACAN=
						39+20003+NAVIA+IMELDA +engineering+permits_license+09/11/78+#130 STA. INES, PLARIDEL, BULACAN=
						40+20170+SOMBILLO+GLYZA SHANE+engineering+permits_license+10/14/93+0381 CONTROL, COLGANTE, APALIT, PAMPANGA=
						41+20099+ARCEO JR.+ISIDRO+engineering+project_admin+07/06/77+#201 ST. JUDE ST., TENEJERO, PULILAN, BULACAN=
						42+10071+BARANDA+CHRISTIAN+engineering+project_admin+11/06/81+254 BARIHAN, MALOLOS CITY, BULACAN=
						43+20160+CAPULE+ROSE ANNE+engineering+project_admin+12/11/90+L4 B33 109 ST. RUFINA GOLDEN VILLAGE, STO. CRISTO, MALOLOS CITY, BULACAN=
						44+10013+IRIOLA+DON +engineering+project_admin+12/18/59+B37 L7 PH2 GRAND ROYALE SUBD., BULIHAN, MALOLOS CITY=
						45+20019+MARANON+DON REY +engineering+project_admin+12/05/79+BLK 28 LOT 16 ST. JUDE VILLAGE SAN FERNANDO CITY, PAMPANGA=
						46+20090+NAVARRO+JONEL+engineering+project_admin+11/07/67+B38 L48 NORTHVILLE 5 BATIA, BOCAUE, BULACAN =
						47+10068+SANTOS+RENZ JOSEPH+engineering+project_admin+04/20/89+1431 BANTAYAN 2ND, BULIHAN, MALOLOS CITY, BULACAN=
						48+10073+SANTOS JR.+RAMON+engineering+project_admin+01/26/81+51 L E PUROK 1, LOOK 1, MALOLOS CITY, BULACAN=
						49+20091+SIAPCO+ROMEO+engineering+project_admin+06/04/76+#208 CAINGIN, SAN RAFAEL, BULACAN=
						50+20169+AGUSTIN+YVAN+engineering+tech_plan+10/24/90+218 GITNA ST., PITPITAN BULAKAN, BULACAN=
						51+20190+DAVID+GLADYS ANNE+engineering+tech_plan+02/26/87+960/E ENRIQUEZ ST., CAINIGN, MALOLOS CITY=
						52+20186+FRANCISCO JR.+ERNESTO+engineering+tech_plan+11/04/84+BLK77 LOT41 LA RESIDENCIA SUBD., SERGIO BAYAN, CALUMPIT, BULACAN=
						53+20191+MORATA+GARY+engineering+tech_plan+08/21/89+0369 NIA ROAD, BARIHAN, MALOLOS CITY, BULACAN=
						54+20172+VIRTUDEZ+JOAN+engineering+tech_plan+09/13/86+B33 L25 ORCHIDS ST., STA MONICA SUBD., SAN NICOLAS, SAN FERNANDO CITY, PAMPANGA=
						55+10085+ADANA+LESLIE ANN+executive+doc_loan+05/11/84+B 69 L 21 PH 9 GRAND ROYALE SUBD., BULIHAN, MAL. CITY=
						56+20020+CASTILLO+SONNY +executive+doc_loan+01/14/77+MABABANG PARANG, STA. MARIA, BULACAN=
						57+20002+DABON+ADA +executive+doc_loan+01/17/73+B78 L13 P4,ROCKAVILLAGE,TABANG,PLA.,BUL.=
						58+20076+DELA CRUZ+JAJETH+executive+doc_loan+10/09/74+141 STA. INES PLARIDEL, BULACAN=
						59+20098+DELLOTA+RIZZA LYN+executive+doc_loan+03/08/88+307 PADILLA ST., BANGA I, PLARIDEL, BULACAN=
						60+20088+FRANCISCO+ANGELITO+executive+doc_loan+05/25/65+#571 CAINGIN, BOCAUE, BULACAN=
						61+20054+GUTIERREZ+CONNIE+executive+doc_loan+09/10/81+217 PUROK 6 DAMPOL, PLARIDEL, BUL.=
						62+10087+MANANSALA+ETCHEL KING+executive+doc_loan+04/18/92+PRK 4 FRANCES, CALUMPIT., BULACAN=
						63+20084+PASCUAL+MARY ANN+executive+doc_loan+11/05/78+262 PULO BARIHAN, MALOLOS CITY=
						64+20066+SANTOS+TERESITA+executive+doc_loan+10/15/67+134 STA ISABEL MALOLOS CITY=
						65+20113+TAMAYO+JOZALYN+executive+doc_loan+11/16/91+#328 STO. NINO, PLARIDEL, BULACAN=
						66+20025+CALUAG+EMMELINE +executive+edp+09/08/80+POBLACION PLARIDEL, BULACAN=
						67+20057+CALUAG+RAYMOND+executive+edp+03/07/84+#34 BANTAYAN II, BULIHAN, MALOLOS CITY, BULACAN=
						68+20177+DEL ROSARIO+JOHN AEROLLE+executive+edp+05/14/95+B21 L13 PERSHING COURT ST., MC ARTHUR VILLAGE, LONGOS, MALOLOS CITY, BULACAN=
						69+20064+DELA CRUZ+VERNIE+executive+edp+09/15/85+111 ENRIQUEZ ST. CAINGIN MALOLOS CITY=
						70+20181+DIAZ+FRANCIS LORENZO+executive+edp+08/10/95+1604 NIA ROAD, BAMBANG, BOCAUE, BULACAN=
						71+20080+FLORENCIO+DANILO+executive+edp+11/24/74+B 65 L 15 WOODBRIDGE SUBD., POBLACION, PANDI, BULACAN=
						72+20085+JACINTO+CHRISTOPHER+executive+edp+12/03/86+PUROK 4 ENRIQUEZ ST., CAINGIN, MALOLOS CITY, BULACAN=
						73+30065+LAQUINDANUM+ABEGAIL+executive+edp+08/19/90+0284 SAN MIGUEL, HAGONOY, BUL.=
						74+20178+MANAHAN+ANNE JELINE+executive+edp+12/09/94+186 MABALAS BALAS, SAN RAFAEL, BULACAN=
						75+20029+MANANGUIT+MA. MIRASOL +executive+edp+07/30/80+#444 BANGA 2ND, PLARIDEL, BULACAN=
						76+20087+SANCHEZ+LIEZL+executive+edp+12/02/83+#165 STO. CRISTO, PULILAN, BULACAN=
						77+20017+BAUTISTA+ROMEO +executive+executive+09/30/78+#022 MABALAS-BALAS SAN RAFAEL, BULACAN=
						78+10080+BUHAIN+CONSUELO MARIE+executive+executive+02/19/67+4024 TABANG, PLARIDEL, BULACAN=
						79+20048+CORONEL+JASMIN +executive+executive+07/26/78+SAN JUAN, MALOLOS CITY=
						80+10009+DEPALOBOS+PRISCILA +executive+executive+12/06/71+#397 MALAMIG , BUSTOS, BUL.=
						81+40085+FAJADA+FRANCISCO+executive+executive+11/24/79+P3 STO. NINO, PLARIDEL, BULACAN=
						82+40081+FAJARDO+JEFFREE+executive+executive+01/28/86+0236 P. CRUZ ST., TARCAN, BALIUAG, BULACAN=
						83+10075+GARALDE+ALLAN+executive+executive+08/26/87+835 DULATRE ST., TABANG, GUIGUINTO, BULACAN=
						84+10081+GONZALES+CAROLYN+executive+executive+10/02/62+4024 TABANG, PLARIDEL, BULACAN=
						85+10030+GUIAO+GIEZL ANN+executive+executive+01/12/81+STA. INES, PLARIDEL, BUL.=
						86+20124+JAVIER+MARIA RACHEL+executive+executive+01/10/89+#0152 LUMANG BAYAN, PLARIDEL, BUL.=
						87+40082+LOGADA JR.+CARLITO+executive+executive+05/07/85+B62 L14 CACARONG MATANDA, PANDI, BULACAN=
						88+10072+LUIS+NAZZAR+executive+executive+01/09/53+UNIT 321 PRINCEVILLE COND., LAUREL ST., MANDALUYONG, METRO MANILA=
						89+10079+MADRID+MARIA CECILIA+executive+executive+07/21/60+4024 TABANG, PLARIDEL, BULACAN=
						90+10070+MANALO+MA. SHEILA+executive+executive+02/12/76+10 DONA JUSTINA AVE., FILINVEST SOUTH, TUBIGAN, BINAN, LAGUNA=
						91+40068+NAVIA+EDGARDO+executive+executive+10/23/46+0445 LEONARDO ST., PARULAN, PLARIDEL, BULACAN
						92+10069+QUINTOS+JAVIER FELIPE+executive+executive+08/23/60+11 VIOLETA PERSA LOOP, VERDANA HOMES, MOLINO, BACOOR, CAVITE=
						93+40083+RONQUILLO+JUNE+executive+executive+04/07/88+353 SITIO PULO, SAN ROQUE, PAOMBONG, BULACAN=
						94+10082+TENORIO+AIRENE+executive+executive+04/15/90+172 HANGGA 2, LONGOS, MALOLOS CITY, BULACAN=
						95+40086+VALENCIA+VREYNOLD+executive+executive+12/06/88+247 PUROK4 TAMPOK, HAGONOY, BULACAN=
						96+20119+ALCANTARA+MELVIC+executive+gen_service+06/05/91+B59 L8 PHASE 4 DCH SUBD., LONGOS, MAL. CITY=
						97+20123+ALCARAZ+FERNANDO+executive+gen_service+12/03/67+B6 L4 LAPID VILLE SUBD., TAMBUBONG, SAN RAFAEL, BUL.=
						98+20082+BAUTISTA+FERDINAND+executive+gen_service+09/11/80+630 LONGOS HI-WAY, MALOLOS CITY=
						99+20030+BENEDICTOS+MICHAEL +executive+gen_service+11/03/76+278 PULO BARIHAN, MALOLOS, BULACAN=
						100+20035+BERNARDINO+PABLITO+executive+gen_service+01/15/72,MALOLOS, BULACAN=
						101+20044+CATINDIG+CIELITO+executive+gen_service+10/12/74+SAN NICOLAS, BULACAN, BULACAN=
						102+20004+CLEMENTE+ARNULFO +executive+gen_service+09/15/65+237 WAKAS, BOCAUE, BULACAN=
						103+10077+CO+ROLAND+executive+gen_service+02/17/85+11 VIOLETA PERSA LOOP, VERDANA HOMES, MOLINO, BACOOR, CAVITE=
						104+20112+CRUZ+BABY BOY+executive+gen_service+07/25/89+#266 LONGOS, MALOLOS CITY=
						105+20102+DELIUPA JR.+WILLIAM+executive+gen_service+03/11/74+#25 ALANGANIN ST., SITIO 1 SAN JOSE, PAOMBONG, BUL.=
						106+10083+DIEGO+MARK ANTHONY+executive+gen_service+11/14/87+PUROK2, GUGO, CALUMPIT, BULACAN=
						107+10008+DIZON+MINETTE +executive+gen_service+04/15/73+SAN RAFAEL, BULACAN=
						108+20043+FAUSTINO+TEODULO +executive+gen_service+09/12/76+SAN ISIDRO 1ST, PAOMBONG, BULACAN=
						109+20121+FERNANDEZ+RONEL+executive+gen_service+06/26/77+0579 PARULAN, PLARIDEL, BUL.=
						110+20060+FONBUENA+PACIFICO+executive+gen_service+09/25/76+#14 CANLAPAN ST., SAN JUAN, MALOLOS CITY=
						111+20151+GANELO+JERSON+executive+gen_service+04/30/91+862 LONGOS, MALOLOS CITY, BULACAN=
						112+20152+LAO+JOSEPH+executive+gen_service+01/14/79+279 STO. CRISTO, PULILAN, BULACAN=
						113+20097+NUQUE+MARLON+executive+gen_service+10/04/80+PUROK 4 GATBUCA, CALUMPIT, BULACAN=
						114+20153+PEREZ+JESSIE+executive+gen_service+06/01/72+445 PARULAN, PLARIDEL, BULACAN=
						115+20042+REYES+MARIO +executive+gen_service+09/25/77+BANGONGON, SAN ISIDRO II PAOMBONG, BUL.=
						116+20009+RODIL+CELSO +executive+gen_service+09/15/72+SAN PABLO, MALOLOS, BULACAN=
						117+10086+RUBIO+MA. ANGELA+executive+gen_service+11/19/83+BUROL ST., SAN JUAN, MALOLOS CITY, BULACAN=
						118+20132+SANTIAGO+JOELITO+executive+gen_service+01/05/79+BANGA 2ND, PLARIDEL, BULACAN=
						119+20036+SANTOS+ARNEL +executive+gen_service+09/07/73+PLARIDEL, BULACAN=
						120+20059+SANTOS+ORLANDO+executive+gen_service+02/04/76+STO NINO PLARIDEL, BULACAN=
						121+20013+SULIT+RAMONA+executive+gen_service+08/09/76+208 SAN ISIDRO 1ST, PAOMBONG BUL.=
						122+20006+VASQUEZ+ROMEO +executive+gen_service+03/08/65+STA. RITA, GUIGUINTO, BULACAN=
						123+10084+ANGELES+ALMA+executive+personnel+01/28/76+LONGOS, PULILAN, BULACAN=
						124+20134+ARELLANO+JILEN+executive+personnel+08/09/81+B41 L2&4 PHASE 3 DCH SUBD., LONGOS, MALOLOS CITY=
						125+20034+BAYA+JENNIFER+executive+personnel+06/17/79+#74 CALAWITAN, SAN ILDEFONSO, BULACAN=
						126+20007+CABAL+ELEONOR +executive+personnel+01/15/75+36 DOMSAL SUBD., BULIHAN, MALOLOS, BUL.=
						127+10041+CASTRO+LIZETH+executive+personnel+11/24/82+B1 L1 PHASE II GRAND ROYALE SUBD., BULIHAN, MALOLOS CITY=
						128+30008+DELOS SANTOS+MERLYN+executive+personnel+07/10/78+BLK3 LT10 PH5A DREAMCREST HOMES, LONGOS, MALOLOS CITY, BULACAN=
						129+20140+MARTIN+KATHREENE+executive+personnel+08/30/92+SABANA SUBD., CAINGIN, BOCAUE, BULACAN=
						130+30051+OCAMPO+NELVIE+executive+personnel+06/16/85+#234 DEL PILAR ST., LUMBAC, PULILAN, BULACAN=
						131+10021+SASPA JR.+RAMON +executive+personnel+07/06/73+B58 LT4 BRGY DATU ISMAEL DASMA I DASMARINAS CAVITE=
						132+30006+SEBASTIAN+RHEA ELIZ +executive+personnel+09/16/81+099 BAGONG SILANG, PLARIDEL, BULACAN=
						133+10022+BORLONGAN+VINCENT +finance+accounting+02/12/75+910 FT. REYES ST., SAN JUAN, MAL., BUL.=
						134+20063+CRUZ III+EUSEBIO+finance+accounting+04/11/74+B87 L12 PHASE 5 DREAMCREST HOMES SUBD. BULIHAN, MALOLOS CITY=
						135+20109+DE GUZMAN+MARY ANN+finance+accounting+04/02/77+B4 L7 PHASE 2C DREAMCREST HOMES SUBD., LONGOS, MALOLOS CITY=
						136+20175+DELIUPA+CINDERELLA+finance+accounting+10/24/84+02 PUROK 5, KAPITANGAN, PAOMBONG, BULACAN=
						137+20139+GERON+SHEREE ANN+finance+accounting+09/20/78+13 TAMBUBONG, LONGOS, MAL. CITY=
						138+20100+PASCUAL+MARIE KRIS+finance+accounting+07/14/86+#40 STO. NINO, PLARIDEL, BULACAN=
						139+20182+CRUZ+TERESITA+finance+billing+06/13/87+PUROK4, BUGUION, CALUMPIT, BULACAN=
						140+20173+DE CASTRO+MARY JOY+finance+billing+12/17/92+629 LIBO ST., SAN NICOLAS, BULAKAN, BULACAN=
						141+30011+DELA CRUZ+ETHELMAE CRYSYL+finance+billing+07/12/79+111 ENRIQUEZ ST. CAINGIN MALOLOS CITY=
						142+20010+MARANON+JULIE +finance+billing+02/16/77+15 SANDOVAL IBA HAGONOY BUL=
						143+20086+RODRIGUEZ+WENDY+finance+billing+12/31/85+B34 L17 PH8D GRAND ROYALE SUBD. BULIHAN, MALOLOS CITY=
						144+20165+SAN PEDRO+ROSALYN+finance+billing+07/26/75+395 BALITE, MALOLOS CITY, BULACAN=
						145+20179+SANTIAGO+RHODA+finance+billing+12/01/80+502 CAINGIN, BOCAUE, BULACAN=
						146+20107+SANTOS+MARIA CITA+finance+billing+11/25/74+#169 TAAL, PULILAN, BULACAN=
						147+20110+SANTOS+MICHELLE+finance+billing+03/09/85+PUROK 1 LAGUNDI, PLARIDEL, BULACAN=
						148+20106+SIAPCO+MARIEJANE+finance+billing+01/28/72+208 VICEO ST. CAINGIN, SAN RAFAEL, BULACAN=
						149+20056+VASQUEZ+ANTONIO+finance+billing+10/20/74+24 DE AGUSTO, CAINGIN, MALOLOS CITY=
						150+10076+ENRIQUEZ+ROSITA+finance+finance+11/18/53+061RUEDA, PLARIDEL, BULACAN=
						151+10055+GONZALES+CELINE ANGELICA+finance+finance+10/09/88+4024 TABANG, PLARIDEL, BULACAN=
						152+10078+LIM+MA. CONCEPCION+finance+finance+12/08/77+PUROK4, FRANCES, CALUMPIT, BULACAN=
						153+20018+PERALTA+MARIA ELOIZA +finance+finance+01/02/79+#40 CUPANG ST., SAN NICOLAS, BULAKAN, BULACAN=
						154+10015+DELA PENA+MARIA TERESA+finance+purchasing+03/28/77+444 BANGA II, PLARIDEL, BULACAN=
						155+10035+MERCADO+LHARA+finance+purchasing+10/17/80+BOCAUE, BULACAN=
						156+20189+BAUTISTA+RHODORA+finance+treasury+08/04/85+B23 L9 P5 GRAND ROYALE SUBD., BULIHAN, MALOLOS CITY, BULACAN=
						157+20161+CALAPATI+MARJORIE ANN+finance+treasury+11/11/81+77 FT REYES ST., SAN JUAN, MALOLOS CITY, BULACAN=
						158+20023+FAUSTINO+EDGARDO +finance+treasury+12/29/59+46 SIKATUNA ST., CATMON, MAL. BUL.=
						159+20074+FIGUEROA+ELIZA+finance+treasury+11/10/80+#1545 GULOD, PULONG BUHANGIN, STA. MARIA, BULACAN=
						160+20012+FRANCISCO+EDUARDO +finance+treasury+04/14/60+291 CAINGIN, BOCAUE, BUL.=
						161+30010+GRAFE+RIZA +finance+treasury+06/13/82+137 SAN MIGUEL, HAGONOY, BULACAN=
						162+20136+LAO+ANALIZA+finance+treasury+09/11/77+#279 STO. CRISTO, PULILAN, BUL.=
						163+20093+MARTIN+GLAIZA+finance+treasury+05/26/86+56 ULI-ULI IBA, HAGONOY, BULACAN=
						164+20008+MILLO+ELENA +finance+treasury+03/31/76+NILASIN 2ND, PURA, TARLAC=
						165+10007+RABULAN+MA. THERESA +finance+treasury+04/11/72+#310 WAWA IBA, HAGONOY, BULACAN=
						166+20122+ROSALES+AGNES+finance+treasury+02/26/77+217 PUROK 6 DAMPOL, PLARIDEL, BULACAN=
						167+10017+SAN PEDRO+ARLENE +finance+treasury+06/29/73+#128 PUROK 2 BALITE, MAL., BUL.=
						168+20016+SORIAGA+JENNIFER+finance+treasury+10/24/74+375 CALLE BIGA ST. SAN PABLO MALOLOS BUL=
						169+30004+TOLOSA+IRENE +finance+treasury+08/26/78+82 MABIYAYA ST., MASAGANA HOMES, STA. RITA, GUIGUINTO, BUL.=
						170+20101+BITOIN+CHRISTIAN+finance+wes+08/08/81+409 NAVARRO SUBD MAKINABANG BALIUAG, BULACAN=
						171+20118+BUHAIN+LAWRENCE+finance+wes+10/29/80+#300 STA. INES, PLARIDEL, BULACAN=
						172+30003+CAJUCOM+MARY GRACE +finance+wes+07/07/76+BLK61 LT5 PH5 DREAMCREST HOMES, LONGOS, MALOLOS CITY, BULACAN=
						173+10012+CRUZ+JANINE +finance+wes+06/11/77+5613 STO. NINO PLARIDEL, BULACAN=
						174+20167+DELA CRUZ+ANN KATHLEEN+finance+wes+11/21/93+024 MANGGAHAN ST., IGULOT, BOCAUE, BULACAN=
						175+20163+DELA CRUZ JR.+ANTONIO+finance+wes+07/05/88+RIVERSIDE, LONGOS, MALOLOS CITY, BULACAN=
						176+20117+GODAY+CRISANTO+finance+wes+09/08/77+BLK 7 LOT 2 PHASE 7B GRAND ROYALE SUBD., PINAGBAKAHAN, MAL. CITY=
						177+20096+MARTINEZ+OSCAR+finance+wes+08/29/66+DAANG BAKAL, BULIHAN, MALOLOS CITY=
						178+20041+NUQUE+CYNTHIA+finance+wes+06/20/80+GATBUCA, CALUMPIT, BULACAN=
						179+20073+PERALTA+CHRISTIAN+finance+wes+01/07/79+#40 CUPANG ST., SAN NICOLAS, BULAKAN, BULACAN=
						180+30002+TORRES+JENNIFER +finance+wes+05/08/78+30 KAPITAN KIKO ST.,SAN AGUSTIN,MAL.BUL.=
						181+20033+ALVARO+CLARISA+marketing+marketing+11/13/78+PLARIDEL, BULACAN=
						182+30093+AMURAO+MARISSA+marketing+marketing+11/10/67+B5 L3 ROCKA VILLAGE III STA. RITA GUIGUINTO, BULACAN=
						183+30005+BORLONGAN+VIOLETA +marketing+marketing+06/01/80+910 FT REYES ST., SAN JUAN, MALOLOS CITY, BULACAN=
						184+30095+CASTILLO+MAY KATHYRINE+marketing+marketing+01/26/93+PH5 B26 L17 MAIN ROAD, CORONELLA ST., GRAND ROYALE SUBD., BULIHAN, MALOLOS CITY, BULACAN=
						185+30077+DOMINGO+DIANA+marketing+marketing+02/28/85+268 STMA. TRINIDAD, MAL. CITY=
						186+30087+HERNANDEZ+JENINE+marketing+marketing+04/05/94+BARIHAN, MALOLOS CITY, BULACAN=
						187+10062+MADRID+GIA MARIE ANNIELLE+marketing+marketing+02/09/90+4024 TABANG, PLARIDEL, BULACAN=
						188+30094+RIVERA+ROSENDA+marketing+marketing+03/01/75+#856 ESGUERRA ST., POBLACION, PULILAN, BULACAN';
		
		$e_string	= explode('=',$e_string);
		//hash_dump($e_string,1);
		
		foreach($e_string as $row)
		{
			$e_row = explode('+',$row);
			
			$insert['str']['user_name']							=	$e_row[3];
			$insert['str']['user_surname']						=	$e_row[2];
			$insert['str']['user_number']						=	$e_row[1];
			$insert['str']['user_address']						=	$e_row[7];
			$insert['str']['option_department_id']				=	$e_row[4];
			$insert['str']['option_department_section_id']		=	$e_row[5];
			$insert['str']['user_birthdate']					=	strtotime($e_row[6]);
			
			$insert['str']['user_username']						=	$e_row[1];
			$insert['str']['user_password']						=	'pass'.$e_row[1];
			
			$insert['str']['option_user_status_id']				=	'enabled';
			$insert['str']['option_user_level_id']				=	'mancom';
			$insert['int']['payroll_schedule_id']				=	1;
			$insert['str']['option_user_job_title_id']			=	'n_a';
			//$insert												=   mvc_model('model.user')->insert($insert);
		}
		
		
	}
	
 
	
	//------------------------------------------
	private function schedule_array($sched)
	{		
		if($sched['payroll_schedule_monday'] == 1)
		{
			$ret_sched[]	= 'Monday';
		}
		if($sched['payroll_schedule_tuesday'] == 1)
		{
			$ret_sched[]	= 'Tuesday';
		}
		if($sched['payroll_schedule_wednesday'] == 1)
		{
			$ret_sched[]	= 'Wednesday';
		}
		if($sched['payroll_schedule_thursday'] == 1)
		{
			$ret_sched[]	= 'Thursday';
		}
		if($sched['payroll_schedule_friday'] == 1)
		{
			$ret_sched[]	= 'Friday';
		}
		if($sched['payroll_schedule_saturday'] == 1)
		{
			$ret_sched[]	= 'Saturday';
		}
		if($sched['payroll_schedule_sunday'] == 1)
		{
			$ret_sched[]	= 'Sunday';
		}
		
		return $ret_sched;
	}
	
	
	
	//user  cutoff compute
	
	
	public function compute_user_cutoff($parent)
	{		
		$id											 =  $_GET['id']*1;// user id
		$upid										 =  $_GET['upid']*1;// user payroll id
		$c_id										 =  $_GET['cutoff_id']*1;// cutoff id
		$user									 	 =  mvc_model('model.user')->select($id);
		$stamp 									 	 =  mvc_model('model.user_payroll_attendance')->select_by_user_cutoff($id,$c_id);
		$cutoff										 =  mvc_model('model.payroll_cutoff')->select($c_id);
		$salary								 		 =	mvc_model('model.user_salary')->select($user['user_salary_id']);
		//echo time();
		//hash_dump($salary,1);
			//echo $user['user_name'] . '<br>';
			$total_basic								= 0;
			$total_ot									= 0;
			$total_night_diff							= 0;
			$total_ot_hours								= 0;
			if($stamp)
			{
				
					foreach($stamp as $row)
					{
						$sat_holiday = 0;
						$day 									=	string_day_week($row['user_payroll_attendance_timestamp']);
						if($day == 5)// if friday, check if saturday is holiday
						{
							$saturday							=  mvc_model('model.payroll_attendance')->select($row['payroll_attendance_id']+1);
							if($saturday != 'regular' || $saturday != 'typhoon')
							{
								$sat_holiday = 1;
							}
						}
						
						$comp_stamp								= $this->get_total_per_timestamp($user,$row);
						
						if($sat_holiday == 1 && $comp_stamp['leave_app'] == 0)
						{
							$total_basic						+= $comp_stamp['total_basic']*$saturday['option_payroll_attendance_type_multiplier'];
						}
						else
						{
							$total_basic						+= $comp_stamp['total_basic']*$row['option_payroll_attendance_type_multiplier'];
						}
						$total_absent						   += $comp_stamp['total_absent'];
						$total_ot						   	   += $comp_stamp['total_ot'];
						$total_ot_hours						   += $comp_stamp['total_ot_hours'];
						$total_nd_hours						   += $comp_stamp['total_nd_hours'];
						$total_night_diff					   += $comp_stamp['total_night_diff'];
						$total_late					   		   += $comp_stamp['total_late'];
						$total_over_break					   += $comp_stamp['total_over_break'];
						$total_under_time					   += $comp_stamp['total_under_time'];
				
					}// end foreach STAMP
					//hash_dump($total_basic);
					//die();
					//die();
					$upcutoff									=  mvc_model('model.user_payroll_cutoff')->select($upid);
					$loan_row									=  $this->get_loan_deduction($user['user_id'],$upid);
					//hash_dump($loan_row,1);
					$conversion_pay								=  $this->get_conversion_pay($c_id,$user);
					$salary_deduction							=  $this->get_salary_deduction($c_id,$user);
					$salary_addition							=  $this->get_salary_addition($c_id,$user);
					$bonus										=  $this->get_bonus($c_id,$user);
					$deduction 									=  $this->get_deduction($user['user_id'],$cutoff['payroll_cutoff_pos'],$salary,$upcutoff);
					//hash_dump($deduction);
					if($bonus > 82000)
					{
						$taxable_bonus = $bonus - 82000;
						$non_tax_bonus = 82000;
					}
					else
					{
						$taxable_bonus = 0;
						$non_tax_bonus = $bonus;
					}
					$total_bonus	   							=  $taxable_bonus+$non_tax_bonus;
					$total_allowance 							=  $this->get_allowance_pay($user['user_id']);
					$total_deduction 							=  $deduction['total'];
					$employer_contribution 						=  $deduction['emp_total'];
					$total_loan_deduction 						=  $loan_row['total'];
					$total_deduction							=  $total_deduction+$salary_deduction['total'];
					$gross_total								=  $total_basic+$total_ot+$total_night_diff-$total_late-$total_over_break-$total_under_time;
					$total_taxable								=  ($gross_total > $total_deduction) ? $gross_total - $total_deduction : 0;
					$late_deduction								=  $total_late + $total_over_break + $total_under_time +($total_absent*$salary['user_daily_salary']);
					//=============
					$total_tax									=  $this->get_tax($user,$late_deduction,$total_deduction,$total_ot,$total_night_diff,$conversion_pay,$taxable_bonus,$salary);
					$total_tax									=  $total_tax  + $salary_addition['tax'];
					$total_addon								=  $conversion_pay+$total_allowance+$salary_addition['total']+$total_bonus;
					$salary_net									=  (($total_taxable+$total_addon) > ($total_tax + $total_loan_deduction + $salary_deduction['total'])) ? ($total_taxable+$total_addon) - $total_tax - $total_loan_deduction - $salary_deduction['total'] : 0;
					
					$c_post['int']['ot_hours']								=  $total_ot_hours;
					$c_post['int']['nd_hours']								=  $total_nd_hours;
					$c_post['int']['payroll_tax_id']						=  $user['payroll_tax_id'];
					$c_post['int']['salary_gross_basic']					=  string_amount($total_basic);
					$c_post['int']['salary_gross_ot']						=  string_amount($total_ot);
					$c_post['int']['salary_gross_taxable']					=  string_amount($total_taxable);
					$c_post['int']['salary_gross_night_diff']				=  string_amount($total_night_diff);
					$c_post['int']['salary_gross_total']					=  string_amount($gross_total);
					$c_post['int']['salary_net']							=  string_amount($salary_net);
					$c_post['int']['deduction_tax']							=  string_amount($total_tax);
					$c_post['int']['payday_tax']							=  string_amount($payday_tax);
					$c_post['int']['deduction_non_tax']						=  string_amount($total_deduction);
					$c_post['int']['deduction_loan']						=  string_amount($total_loan_deduction);
					$c_post['int']['salary_allowance']						=  string_amount($total_allowance);
					$c_post['int']['salary_bonus']							=  string_amount($total_bonus);
					$c_post['int']['salary_conversion']						=  string_amount($conversion_pay);
					$c_post['int']['salary_addon']							=  string_amount($total_addon);
					$c_post['int']['deduction_late']						=  string_amount($total_late);
					$c_post['int']['deduction_over_break']					=  string_amount($total_over_break);
					$c_post['int']['deduction_under_time']					=  string_amount($total_under_time);
					$c_post['int']['deduction_employer_contribution']		=  string_amount($employer_contribution);
					$c_post['int']['payroll_absent']						=  $total_absent;
					$c_post['int']['payroll_deduction_id_sss']				=  $deduction['ded_array']['sss'];
					$c_post['int']['payroll_deduction_id_philhealth']		=  $deduction['ded_array']['philhealth'];
					$c_post['int']['payroll_deduction_id_pagibig']			=  $deduction['ded_array']['pagibig'];
					$update													=  mvc_model('model.user_payroll_cutoff')->update($c_post,$upid);
					if(count($loan_row['loan_id']) > 0)
					{
						foreach($loan_row['loan_id'] as $l_id)
						{
							$l_post['user_payroll_cutoff_id']					=  	$upid;
							$l_post['user_payroll_loan_id']						=  	$l_id;
							$loan_cutoff_insert									=  mvc_model('model.user_payroll_loan_cutoff')->insert($l_post);
						}
					}
												
					
			}//end if stamp
			
		
		
		header_location("/payroll/employees/view_payslip/&id=".$id."&cutoff=".$c_id."&upid=".$upid);
		
	}
	
	private function get_tax($user,$late_deduction,$deduction,$total_ot,$night_diff,$conversion,$bonus,$salary)
	{
		$total										=  0;
		$tax										=  mvc_model('model.payroll_tax')->select($user['payroll_tax_id']);
		if($tax)
		{
					$annual_income								=   (string_clean_number($salary['user_basic_salary']) * 12) + $total_ot + $night_diff+$conversion+$bonus;
					$taxable_annual_income						=   $annual_income - $tax['payroll_tax_discount'] - ($deduction*12)- $late_deduction;	
					if($taxable_annual_income <= 10000)
					{
						$tax = $taxable_annual_income*(.05);
					}
					elseif($taxable_annual_income > 10000 && $taxable_annual_income <= 30000)
					{
						$taxable = $taxable_annual_income - 10000;
						$tax 	 = $taxable  *(.1);
						$tax	 = $tax+500;
					}
					elseif($taxable_annual_income > 30000 && $taxable_annual_income <= 70000)
					{
						$taxable = $taxable_annual_income - 30000;
						$tax 	 = $taxable  *(.15);
						$tax	 = $tax+2500;
					}
					elseif($taxable_annual_income > 70000 && $taxable_annual_income <= 140000)
					{
						$taxable = $taxable_annual_income - 70000;
						$tax 	 = $taxable  *(.20);
						$tax	 = $tax+8500;
					}
					elseif($taxable_annual_income > 140000 && $taxable_annual_income <= 250000)
					{
						$taxable = $taxable_annual_income - 140000;
						$tax 	 = $taxable  *(.25);
						$tax	 = $tax+22500;
					}
					elseif($taxable_annual_income > 250000 && $taxable_annual_income <= 500000)
					{
						$taxable = $taxable_annual_income - 250000;
						$tax 	 = $taxable  *(.30);
						$tax	 = $tax+50000;
					}
					elseif($taxable_annual_income > 500000 )
					{
						$taxable = $taxable_annual_income - 500000;
						$tax 	 = $taxable  *(.32);
						$tax	 = $tax+125000;
					}
					else
					{
						$tax = 0;
					}
					
					
					$payday_tax									=   $tax/24;		
					$total										=   round($payday_tax,2);
		}
		
		return $total;
		
	}
	
	private function get_deduction($id,$cutoff_trigger,$salary,$user_cutoff)
	{
		$total										=  0;
		$emp_cont									=  0;
		$deduction									=  mvc_model('model.user_payroll_deduction')->select_all_by_user($id);
		if($deduction)
		{
			foreach($deduction as $row)
			{
				if($row['payroll_deduction_trigger'] == 0 || $row['payroll_deduction_trigger'] == $cutoff_trigger)
				{
					
					if($row['option_deduction_type_id'] == 'philhealth')
					{
						if($row['payroll_deduction_id'] != $user_cutoff['payroll_deduction_id_philhealth'])
						{
							$pd								         =  mvc_model('model.payroll_deduction')->select($user_cutoff['payroll_deduction_id_philhealth']);
							$row['payroll_deduction_value'] 		 = $pd['payroll_deduction_value'];
							$row['payroll_deduction_value_employer'] = $pd['payroll_deduction_value_employer'];
							$row['payroll_deduction_value_employe'] = $pd['payroll_deduction_value_employe'];
							$row['payroll_deduction_id']			 = $user_cutoff['payroll_deduction_id_philhealth'];
						}
					}
					if($row['option_deduction_type_id'] == 'sss')
					{
						if($row['payroll_deduction_id'] != $user_cutoff['payroll_deduction_id_sss'])
						{
							$pd								         =  mvc_model('model.payroll_deduction')->select($user_cutoff['payroll_deduction_id_sss']);
							$row['payroll_deduction_value'] 		 = $pd['payroll_deduction_value'];
							$row['payroll_deduction_value_employer'] = $pd['payroll_deduction_value_employer'];
							$row['payroll_deduction_value_employe'] = $pd['payroll_deduction_value_employe'];
							$row['payroll_deduction_id']			 = $user_cutoff['payroll_deduction_id_sss'];
						}
					}
					if($row['option_deduction_type_id'] == 'pagibig')
					{
						if($row['payroll_deduction_id'] != $user_cutoff['payroll_deduction_id_pagibig'])
						{
							$pd								         =  mvc_model('model.payroll_deduction')->select($user_cutoff['payroll_deduction_id_pagibig']);
							$row['payroll_deduction_value'] 		 = $pd['payroll_deduction_value'];
							$row['payroll_deduction_value_employer'] = $pd['payroll_deduction_value_employer'];
							$row['payroll_deduction_value_employe'] = $pd['payroll_deduction_value_employe'];
							$row['payroll_deduction_id']			 = $user_cutoff['payroll_deduction_id_pagibig'];
						}
					}
					
					if($row['option_value_type_id'] == 'fixed')
					{
						$total				+=  $row['payroll_deduction_value']+$row['payroll_deduction_value_employee'];
						$emp_cont			+=  $row['payroll_deduction_value_employer'];
					}
					else
					{
						$total				+=  $salary['user_basic_salary']*($row['payroll_deduction_value']/100)+$row['payroll_deduction_value_employee'];
						$emp_cont			+=  $row['payroll_deduction_value_employer'];
						 
					}
					$ded_array[$row['option_deduction_type_id']]  = $row['payroll_deduction_id'];
					
					
				}
				
			}
		}
		
		$return['ded_array']   	= $ded_array;
		$return['total']   		= $total;
		$return['emp_total']   = $emp_cont;
		//hash_dump($return,1);
		return $return;
	}
	
	
	private function get_bonus($cutoff_id,$user)
	{
		$total											=  0;
		$backpay_rows									=  mvc_model('model.user_payroll_bonus')->select_by_cutoff_id_user($cutoff_id,$user['user_id']);
		if($backpay_rows)
		{
			foreach($backpay_rows as $row)
			{
				$total				    				+=  $row['user_payroll_bonus_amount'];
			}
			
		}
		
		return $total;
		
	}
	
	private function get_conversion_pay($cutoff_id,$user)
	{
		$total											=  0;
		$convert_rows									=  mvc_model('model.user_payroll_leave_convert')->select_by_cutoff_id_user($cutoff_id,$user['user_id']);
		if($convert_rows)
		{
			foreach($convert_rows as $row)
			{
				$total				    				+=  $row['user_payroll_leave_convert_amount'];
			}
			
		}
		
		return $total;
		
	}
	
	
	private function get_allowance_pay($id)
	{
		$total										=  0;
		$allowance									=  mvc_model('model.user_payroll_allowance')->select_all_by_user($id);
		if($allowance)
		{
			foreach($allowance as $row)
			{
				$total			+=  $row['payroll_allowance_value'];
			}
		}
		
		return $total;
		
	}
	
	private function get_salary_addition($cutoff_id,$user)
	{
		$return['total']								=  0;
		$return['tax']									=  0;
		$sa_rows									=  mvc_model('model.user_salary_addition')->select_by_cutoff_id_user($cutoff_id,$user['user_id']);
		if($sa_rows)
		{
			foreach($sa_rows as $row)
			{
				$return['total']				    				+=  $row['user_salary_addition_amount'];
				$return['tax']				    					+=  $row['user_salary_addition_amount_tax'];
			}
			
		}
		
		return $return;
		
	}
	
	private function get_salary_deduction($cutoff_id,$user)
	{
		$return['total']								=  0;
		$sd_rows									=  mvc_model('model.user_salary_deduction')->select_by_cutoff_id_user($cutoff_id,$user['user_id']);
		if($sd_rows)
		{
			foreach($sd_rows as $row)
			{
				$return['total']				    				+=  $row['user_salary_deduction_amount'];
			}
			
		}
		
		return $return;
		
	}
	
	private function get_total_per_timestamp($user,$stamp)
	{
				//hash_dump($stamp);
				$total_ot_hours							= 0;
				$total_night_diff						= 0;
				$schedule								=  mvc_model('model.payroll_schedule')->select($stamp['payroll_schedule_id']);
				$ot										=  mvc_model('model.user_payroll_ot')->select_approve_timestamp_id($user['user_id'],$stamp['user_payroll_attendance_id']);
				$leave									=  mvc_model('model.user_payroll_leave')->select_approve_timestamp_id($user['user_id'],$stamp['user_payroll_attendance_id']);
				$sched_array							=  $this->schedule_array($schedule);
				$salary								 	=	mvc_model('model.user_salary')->select($stamp['user_salary_id']);
				$stamp_day								= date("l", $stamp['user_payroll_attendance_timestamp']);
				$return['leave_app']					=  0;
				 $absent 							    =  0;
			
					if($stamp['timestamp_in']>50000 || in_array($stamp_day,$sched_array) && !($leave) && $stamp['is_official_business'] == 0)
					{
						//echo $stamp['timestamp_in'].'<br>';
						
						$year 							=	string_date_year($stamp['user_payroll_attendance_timestamp']); 
						$month 							=	string_date_month_numeric($stamp['user_payroll_attendance_timestamp']); 
						$day 							=	string_day($stamp['user_payroll_attendance_timestamp']);
						$time_in						=  $schedule['payroll_schedule_start'];
	   					$filler							=  (strtotime($schedule['payroll_schedule_start']) > strtotime($schedule['payroll_schedule_end'])) ? " +1 day" : "";
					    $string_sched_start				=  strtotime($month.'/'.$day.'/'.$year . $schedule['payroll_schedule_start']); 
					    $string_sched_end				=  strtotime($month.'/'.$day.'/'.$year . $schedule['payroll_schedule_end'] . $filler); 
					    $time_sched    					=  strtotime($month.'/'.$day.'/'.$year . $time_in);
					   
						$seconds_late					=  ($stamp['timestamp_in'] > $string_sched_start) ? $stamp['timestamp_in'] - $string_sched_start : 0;
						$seconds_under_time				=  ($string_sched_end > $stamp['timestamp_out']) ?  $string_sched_end - $stamp['timestamp_out'] : 0;
						$break_duration					=  ($stamp['timestamp_break_in'] - $stamp['timestamp_break_out']); // for clarification
						$working_time					=  ($stamp['timestamp_out'] - $stamp['timestamp_in']) / 3600;
						$round_break_duration			=  round($break_duration/60);//minute
						$round_working_time				=  round($working_time);//hour
						$round_late						=  round($seconds_late/60);//minute
						$round_under_time				=  round($seconds_under_time/60);//minute
						$round_break_duration			=  ($round_break_duration > $schedule['payroll_schedule_break']) ? $round_break_duration - $schedule['payroll_schedule_break'] : 0;
						if($round_working_time < $schedule['payroll_schedule_work_hours'] && !empty($leave))
						{
							$round_working_time         =  $round_working_time + $leave['user_payroll_leave_duration'];
						}
						$round_working_time				=  ($round_working_time > $schedule['payroll_schedule_work_hours']) ? $schedule['payroll_schedule_work_hours'] : $round_working_time;
						$total_night_diff 				=  $this->check_night_diff($schedule,$stamp['user_payroll_attendance_timestamp']);	
						if(!(in_array($stamp_day,$sched_array)))
						{
							$round_late 			= 0;
							$round_under_time 		= 0;
							$round_break_duration 	= 0;
						}
						
						if(in_array($stamp_day,$sched_array) && $stamp['timestamp_in']< 1)
						{
							$absent 				= 1;
							$round_late 			= 0;
							$round_under_time 		= 0;
							$round_break_duration 	= 0;
							$round_working_time 	= 0;
						}
						
					
					}
					elseif($leave && in_array($stamp_day,$sched_array))//get leaved if approve
					{
						$round_working_time				    =  ($leave['user_payroll_leave_whole'] == 1) ? $schedule['payroll_schedule_work_hours'] : $leave['user_payroll_leave_duration'];
						$round_working_time					=  ($leave['user_payroll_leave_type_id'] == 'payroll_leave_no_pay') ? 0 : $round_working_time;
						$round_late 						= 0;
						$round_under_time 					= 0;
						$round_break_duration 				= 0;
						$return['leave_app']				=  1;
					}
					else
					{
						$round_working_time				    = 0;
					}
					if($round_under_time > 0)//tatangalin na to
					{
						//$round_late 					= 0;
						//$round_under_time 				= 0;
						//$round_break_duration 			= 0;
						//$round_working_time 			= 0;
					}
					$return['total_absent']					=  $absent;
					$return['total_ot']						=  0;
					$return['total_ot_hours']				=  0;
					$return['total_late']					=  $round_late * $salary['user_minute_salary'];
					$return['total_over_break']				=  $round_break_duration * $salary['user_minute_salary'];
					$return['total_under_time']				=  $round_under_time * $salary['user_minute_salary'];
					if($ot)
					{
						$total_ot_hours						=  $ot['user_payroll_ot_hour'];
						$return['total_ot']					=  $total_ot_hours*$salary['user_hourly_salary'];
						$return['total_ot_hours']			=  $total_ot_hours;
					}
					$return['total_basic']					= ($round_working_time * $salary['user_hourly_salary']) ;
					$return['total_night_diff']				=  $total_night_diff*($salary['user_hourly_salary']*(.1));
					$return['total_nd_hours']				=  $total_night_diff;
					$return['total_basic']					=  ($return['total_basic'] < 0) ?  0 : $return['total_basic'];
					//hash_dump($return);
		return $return;	
		
	}
	
	
	private function check_night_diff($sched,$curr_time_stamp)
	{		
	   // hash_dump($curr_time_stamp,1);
	   	$night_diff_hour									 =  0;
	   	$year 											 	 =	string_date_year($curr_time_stamp); 
		$month 										 		 =	string_date_month_numeric($curr_time_stamp); 
		$day 											     =	string_day($curr_time_stamp); 
	    $night_start										 = 	strtotime($month.'/'.$day.'/'.$year . ' 19:00'); 
	    $night_end											 =  strtotime($month.'/'.$day.'/'.$year . ' 4:00'); 
	   	$filler												 =  (strtotime($sched['payroll_schedule_start']) > strtotime($sched['payroll_schedule_end'])) ? " +1 day" : "";
	    $string_sched_end									 =  strtotime($month.'/'.$day.'/'.$year . $sched['payroll_schedule_end'] . $filler); 
	    $time_in									 		 =  strtotime($month.'/'.$day.'/'.$year . $sched['payroll_schedule_start'] ); 
	      
	    for($i=0;$i<12;$i++)
	    {
			if($time_in <= $string_sched_end)
			{
				
				$current_time 	= date("G:i", $time_in);
				$current_time	= strtotime($month.'/'.$day.'/'.$year . $current_time);
				if($current_time >= $night_start || $current_time <= $night_end )
				{
					if($current_time < ($night_start+3600))
					{
						$night_diff_seconds		=  $current_time - $night_start;
						$nd_hr					=  round($night_diff_seconds/3600,1);
						$night_diff_hour 	   +=  $nd_hr;
					}
					elseif($current_time < ($night_end+3600))
					{
						$night_diff_seconds     = 3600 - ($current_time - $night_end);
						$nd_hr					=  round($night_diff_seconds/3600,1);
						$night_diff_hour 	   +=  $nd_hr;
					}
					else
					{
						$night_diff_hour += 1;
					}
					
				}
				$time_in		=	string_date_time_space($time_in);
				$time_in		=	strtotime($time_in . "+1 hour");
				//$time_in		=	string_date_time($time_in);
			}
	    }
		
		return $night_diff_hour;
	}
	
	
	
	private function get_loan_deduction($id,$upcid)
	{
		$total['total']								=  0;
		$loan										=  mvc_model('model.user_payroll_loan')->select_user_active($id);
		//hash_dump($loan,1);
		if(count($loan))
		{
			foreach($loan as $row)
			{
				$check_loan_payment							 =   mvc_model('model.user_payroll_loan_cutoff')->select_by_upcid_uplid($row['user_payroll_loan_id'],$upcid);
				$total['total']						   		+= $row['user_payroll_loan_cutoff_payment'];
				if(empty($check_loan_payment))
				{
					
					$total['loan_id'][]						 = $row['user_payroll_loan_id']; 
					$post['int']['user_payroll_loan_paid']	 = $row['user_payroll_loan_paid'] + $row['user_payroll_loan_cutoff_payment'];
					$post['str']['user_payroll_loan_status'] = (round($post['int']['user_payroll_loan_paid']) >= $row['user_payroll_loan_amount']) ? 'inactive' : 'active';
					$update_loan							 =  mvc_model('model.user_payroll_loan')->update($post,$row['user_payroll_loan_id']);
				}
			
			}
		}
		//hash_dump($total['loan_id'],1);
		return $total;
	}
    
}