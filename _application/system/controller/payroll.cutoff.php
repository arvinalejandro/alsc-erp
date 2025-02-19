<?php
class payroll_cutoff
{
    
    public function __construct()
    {    	
       	$this->controller_id 							= 	'payroll_cutoff';
    }
 
   public function index($parent)
    {           
        $type											=   $_GET['type'];
        if($type != 'all')
        {
			$curr_time									=   time();
        	$date										=   string_date($curr_time);
        	$curr_date									=   strtotime($date);
        	$data['default']							=   'selected="selected"';
        }
        else
        {
			$curr_date                                  =  1;
			$data['all']								=   'selected="selected"';
        }
        
        # DB
       	 $acitve_fiscal								    =	mvc_model('model.sysglobal_payroll')->select_active();
         $data['row.cutoff']						 	=	mvc_model('model.payroll_cutoff')->select_all($acitve_fiscal['sysglobal_payroll_id']*1,$curr_date);
        # VIEW
         $parent->_view('cutoff', $data); 
    } 
    
     
    
    public function profile($parent)
    {      	
    	$id											=   $_GET['id']*1;
    	# DB
    	$data					 					=	mvc_model('model.payroll_cutoff')->select($id);
    	$data['total_amt']							=   0;
    	$data['payroll_cutoff_approver']    	    =  ($data['payroll_cutoff_approver']) ? $data['payroll_cutoff_approver'] : 'N/A';
    	$cutoff_user					 		    =	mvc_model('model.user_payroll_cutoff')->select_by_cutoff($id);
    	foreach($cutoff_user as $row)
    	{
    		$data['total_amt']     				   		+= $row['salary_gross_total'] ;
    		$data['total_tax']     				   		+= $row['deduction_tax'] ;
    		$data['total_disbursed_loan']     	   		+= $row['salary_loan'] ;
    		$data['total_paid_loan']     		   		+= $row['deduction_loan'] ;
    		$salary								 		=  mvc_model('model.user_salary')->select($row['user_salary_id']);
    		$allowance									=  mvc_model('model.user_payroll_allowance')->select_all_by_user($row['user_id']);
			$deduction									=  mvc_model('model.user_payroll_deduction')->select_all_by_user($row['user_id']);
			$conversion									=  mvc_model('model.user_payroll_leave_convert')->select_by_cutoff_id_user($id,$row['user_id']);
    		foreach($conversion as $c_row)
    		{
				
				$data['c_row']						    .=  '<tr>
										                        <td class="color_gray" colspan="2">
										                            '.$c_row['conversion_type'].':
										                        </td>
										                        <td colspan="2">'.
										                            string_amount($c_row['user_payroll_leave_convert_amount']).'
										                        </td>
										                    </tr>';
				$conversion_list[$c_row['conversion_type']]	+=  $c_row['user_payroll_leave_convert_amount'];
    		}
			
			foreach($allowance as $a_row)
			{
				$allowance_list[$a_row['payroll_allowance_name']]	+=  $a_row['payroll_allowance_value'];
			}
			foreach($deduction as $d_row)
			{
				if($d_row['payroll_deduction_trigger'] == $row['payroll_cutoff_pos'] || $d_row['payroll_deduction_trigger'] == 0 ) 
				{
					if($d_row['option_value_type_id'] == 'fixed')
					{
						$total				=  ($d_row['payroll_deduction_value']+$d_row['payroll_deduction_value_employee']);
					}
					else
					{
						$total				=  $salary['user_basic_salary']*($d_row['payroll_deduction_value']/100);
					}
					
					
					$deduction_list[$d_row['payroll_deduction_name']]	+=  $total;
				}
			}
			
			foreach($deduction as $d_row)
			{
				if($d_row['payroll_deduction_trigger'] == $row['payroll_cutoff_pos'] || $d_row['payroll_deduction_trigger'] == 0 ) 
				{
					$emp_cont[$d_row['payroll_deduction_name']]	+=  $d_row['payroll_deduction_value_employer'];
					
				}
			}
			
			
			
    	}
    	
    	foreach($conversion_list as $key => $value)
    		{
				
				$data['c_list']					.= '<tr>
							                        <td class="color_gray" colspan="3">
							                            '.$key.':
							                        </td>
							                        <td>
							                           '.string_amount($value).'
							                        </td>
							                    </tr>';
			$data['tot_conversion']		       +=  $value;
    		}
    	foreach($allowance_list as $key => $value)
    	{
			$data['a_list']					.= '<tr>
							                        <td class="color_gray" colspan="3">
							                            '.$key.':
							                        </td>
							                        <td>
							                           '.string_amount($value).'
							                        </td>
							                    </tr>';
			$data['tot_allowance']		   +=  $value;
    	}
    	
    	foreach($deduction_list as $d_key => $d_value)
    	{
			$data['d_list']					.= '<tr>
							                        <td class="color_gray" colspan="3">
							                            '.$d_key.':
							                        </td>
							                        <td>
							                           '.string_amount($d_value).'
							                        </td>
							                    </tr>';
			$data['tot_deduction']		   +=  $d_value;
    	}
    	
    	
    	foreach($emp_cont as $ec_key => $ec_value)
    	{
			$data['ec_list']					.= '<tr>
							                        <td class="color_gray" colspan="3">
							                            '.$ec_key.':
							                        </td>
							                        <td>
							                           '.string_amount($ec_value).'
							                        </td>
							                    </tr>';
			$data['ec_contribution']		   +=  $ec_value;
    	}
    	
    	
    	# VIEW - side nav
    	$side_nav['payroll_cutoff_id']				=	$id; 
        $side_nav['profile.class']					=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.cutoff', $side_nav);       
        # VIEW
        $parent->_view('cutoff.profile', $data);          
    }
    
    
    public function daily_stamp($parent)
    {      	
    	$id											=   $_GET['id']*1;
    	# DB
    	$data['row.daily_stamp']					=	mvc_model('model.payroll_attendance')->select_all_by_cutoff($id);
    	
    	
    	# VIEW - side nav
    	$side_nav['payroll_cutoff_id']				=	$id; 
        $side_nav['daily_stamp.class']				=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.cutoff', $side_nav);       
        # VIEW
        $parent->_view('cutoff.daily_stamp', $data);          
    } 
    
    
    
     public function payslip($parent)
    {      	
    	$id											 	=   $_GET['id']*1;
    	# DB
    	$data['row.payslip']							=   mvc_model('model.user_payroll_cutoff')->select_by_cutoff_list($id);
    	# VIEW - side nav
    	$side_nav['payroll_cutoff_id']					=	$id; 
        $side_nav['payslip.class']						=	'bold';         	
       	$data['side_nav']								=	view_get_template($parent->controller_id.'/template/side.cutoff', $side_nav);       
        # VIEW
        $parent->_view('cutoff.payslip', $data);          
    } 
    
   
    
    public function remark($parent)
    {
    	$id											=   $_GET['id']*1;
    	$data['payroll_cutoff_id']					=	$id;  
    	# DB
        $data['row.remark']							=	mvc_model('model.remark')->get_row('payroll_cutoff', $_GET['id']);            
        # VIEW - side nav
        $side_nav['remark.class']					=	'bold';         	
     	$side_nav['payroll_cutoff_id']				=	$id;          	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.cutoff', $side_nav);           
        # VIEW
        $parent->_view('cutoff.remark', $data);      
	}
	
	
	
	public function view_payslip($parent)
    {      	
    	$id											= $_GET['id']*1;
    	$c_id										= $_GET['cutoff']*1;
    	$upid										= $_GET['upid']*1;
    	# DB
    	$data 									 	=  mvc_model('model.user_payroll_cutoff')->select_by_user_cutoff($c_id,$id);
    	
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
					$total				=  ($d_row['payroll_deduction_value']+$d_row['payroll_deduction_value_employee']);
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
        $parent->_view('cutoff.view_payslip', $data);          
    } 
    
 //======================================FORMS
 
    public function edit_day($parent)
    {      	
    	$id											=   $_GET['id']*1;
    	# DB
    	$data										=	mvc_model('model.payroll_attendance')->select($id);
    	$option										=	mvc_model('model.option')->select_option('option_payroll_attendance_type', 'ORDER BY option_payroll_attendance_type_name ASC');
    	$data['option_type']						=	hash_to_option($option, 'option_payroll_attendance_type_id', 'option_payroll_attendance_type_name', $data['option_payroll_attendance_type_id']);
    	# VIEW - side nav
    	$side_nav['payroll_cutoff_id']				=	$id; 
        $side_nav['daily_stamp.class']				=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.cutoff', $side_nav);       
        # VIEW
        $parent->_view('cutoff.form.edit.daily_stamp', $data);          
    } 
  
    
  #----------------------- Form Actions
  
  	
  	public function submit_edit_day($parent)
	{		
		$id											 =  $_POST['id']*1;
		$cutoff_id									 =  $_POST['cutoff_id']*1;
		$update 									 =  mvc_model('model.payroll_attendance')->update($_POST['day'],$id);
		header_location("/payroll/cutoff/daily_stamp/&id=".$cutoff_id);
	}
	
	public function submit_remark($parent)
	 {
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/payroll/cutoff/remark/&id={$_POST['payroll_cutoff_id']}");
	}
  
 
 #actions=================================================================
   
    public function tesst($parent)
	{
		$day 									=	string_day_week(1450627200);
		echo $day;
	}
   
   
    public function compute_cutoff($parent)
	{		
		$id											 =  $_GET['id']*1;// cutoff id
		$employees									 =  mvc_model('model.user')->select_all_payroll(); 
		$cutoff										 =  mvc_model('model.payroll_cutoff')->select($id);
		foreach($employees as $user)
		{
			//hash_dump($user,1);
			$stamp 									 	=  mvc_model('model.user_payroll_attendance')->select_by_user_cutoff($user['user_id'],$id);
			$salary								 		=  mvc_model('model.user_salary')->select($user['user_salary_id']);
			//echo $user['user_name'] . '<br>';
			$total_basic								= 0;
			$total_ot									= 0;
			$total_night_diff							= 0;
			$total_ot_hours								= 0;
			$total_nd_hours								= 0;
			
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
						
						$comp_stamp								= $this->get_total_per_timestamp($user,$row,$salary);
						
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
					
					$loan_row									=  $this->get_loan_deduction($user['user_id']);
					$conversion_pay								=  $this->get_conversion_pay($id,$user);
					$backpay									=  $this->get_backpay($id,$user);
					$bonus										=  $this->get_bonus($id,$user);
					$deduction 									=  $this->get_deduction($user['user_id'],$cutoff['payroll_cutoff_pos'],$salary);
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
					$total_bonus	   =  $taxable_bonus+$non_tax_bonus;
					
					$total_deduction 							=  $deduction['total'];
					$employer_contribution 						=  $deduction['emp_total'];
					$total_loan_deduction 						=  $loan_row['total'];
					$total_allowance 							=  $this->get_allowance_pay($user['user_id']);
					$gross_total								=  $total_basic+$total_ot+$total_night_diff-$total_late-$total_over_break-$total_under_time;
					$total_taxable								=  ($gross_total > $total_deduction) ? $gross_total - $total_deduction : 0;
					$late_deduction								=  $total_late + $total_over_break + $total_under_time +($total_absent*$salary['user_daily_salary']);
					//=============
					$total_tax									=  $this->get_tax($user,$late_deduction,$total_deduction,$total_ot,$total_night_diff,$conversion_pay,$taxable_bonus,$salary);
					$total_addon								=  $conversion_pay+$total_allowance+$total_bonus;
					$salary_net									=   (($total_taxable+$total_addon) > ($total_tax + $total_loan_deduction)) ? ($total_taxable+$total_addon) - $total_tax - $total_loan_deduction : 0;
					
					
					$c_post['int']['user_id']								=  $user['user_id'];
					$c_post['int']['user_salary_id']						=  $user['user_salary_id'];
					$c_post['int']['payroll_tax_id']						=  $user['payroll_tax_id'];
					$c_post['int']['payroll_cutoff_id']						=  $id;
					$c_post['int']['ot_hours']								=  $total_ot_hours;
					$c_post['int']['nd_hours']								=  $total_nd_hours;
					$c_post['int']['salary_gross_basic']					=  string_amount($total_basic);
					$c_post['int']['salary_gross_ot']						=  string_amount($total_ot);
					$c_post['int']['salary_gross_taxable']					=  string_amount($total_taxable);
					$c_post['int']['salary_gross_night_diff']				=  string_amount($total_night_diff);
					$c_post['int']['salary_gross_total']					=  string_amount($gross_total);
					$c_post['int']['salary_net']							=  string_amount($salary_net);
					$c_post['int']['salary_allowance']						=  string_amount($total_allowance);
					$c_post['int']['salary_bonus']							=  string_amount($total_bonus);
					$c_post['int']['salary_conversion']						=  string_amount($conversion_pay);
					$c_post['int']['salary_addon']							=  string_amount($total_addon);
					$c_post['int']['salary_loan']							=  string_amount(0);
					$c_post['int']['deduction_loan']						=  string_amount($total_loan_deduction);
					$c_post['int']['deduction_non_tax']						=  string_amount($total_deduction);
					$c_post['int']['deduction_tax']							=  string_amount($total_tax);
					$c_post['int']['payday_tax']							=  string_amount($payday_tax);
					$c_post['int']['deduction_late']						=  string_amount($total_late);
					$c_post['int']['deduction_over_break']					=  string_amount($total_over_break);
					$c_post['int']['deduction_under_time']					=  string_amount($total_under_time);
					$c_post['int']['deduction_employer_contribution']		=  string_amount($employer_contribution);
					$c_post['int']['user_payroll_cutoff_timestamp']			=  time();
					$c_post['int']['payroll_absent']						=  $total_absent;
					$c_post['int']['payroll_deduction_id_sss']				=  $deduction['ded_array']['sss'];
					$c_post['int']['payroll_deduction_id_philhealth']		=  $deduction['ded_array']['philhealth'];
					$c_post['int']['payroll_deduction_id_pagibig']			=  $deduction['ded_array']['pagibig'];
					//hash_dump($deduction['ded_array']);
					//hash_dump($c_post,1);
					//hash_dump($c_post,1);	
					$check_user_cutoff										=  mvc_model('model.user_payroll_cutoff')->select_by_user_cutoff($id,$user['user_id']);
					if(empty($check_user_cutoff))
					{
						$insert												=  mvc_model('model.user_payroll_cutoff')->insert($c_post);
					}
					
						 						
					if($total_loan_deduction > 0)
					{
						foreach($loan_row['loan_id'] as $l_id)
						{
							$l_post['user_payroll_cutoff_id']					=  	$insert['data']['user_payroll_cutoff_id'];
							$l_post['user_payroll_loan_id']						=  	$l_id;
							$loan_cutoff_insert									=  mvc_model('model.user_payroll_loan_cutoff')->insert($l_post);
						}
					}
			}//end if stamp
			
		}//end foreach user
		$cutoff_post['str']['option_payroll_status_id']			    =  'ready';
		$update_cutoff											    =  mvc_model('model.payroll_cutoff')->update($cutoff_post,$id);
		
		 header_location("/payroll/cutoff/profile/&id=".$id);
		
	}
	
	private function get_tax($user,$late_deduction,$deduction,$total_ot,$night_diff,$conversion,$bonus,$salary)
	{
		$total										=  0;
		$tax										=  mvc_model('model.payroll_tax')->select($user['payroll_tax_id']);
		if($tax)
		{
					$annual_income								=   (string_clean_number($salary['user_basic_salary']) * 12) + $total_ot + $night_diff+$conversion+$bonus;
					$taxable_annual_income						=   $annual_income - string_clean_number($tax['payroll_tax_discount']) - ($deduction*12) - $late_deduction;	
					
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
	
	private function get_deduction($id,$cutoff_trigger,$salary)
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
		$return['emp_total']    = $emp_cont;
		
		return $return;
	}
	
	
	private function get_loan_deduction($id)
	{
		$total['total']								=  0;
		$loan										=  mvc_model('model.user_payroll_loan')->select_user_active($id);
		//hash_dump($loan,1);
		if(count($loan))
		{
			foreach($loan as $row)
			{
			$total['total']						   += $row['user_payroll_loan_cutoff_payment'];
			$total['loan_id'][]						= $row['user_payroll_loan_id']; 
			$post['int']['user_payroll_loan_paid']	= $row['user_payroll_loan_paid'] + $row['user_payroll_loan_cutoff_payment'];
			$post['str']['user_payroll_loan_status']= (round($post['int']['user_payroll_loan_paid']) >= $row['user_payroll_loan_amount']) ? 'inactive' : 'active';
			$update_loan							=  mvc_model('model.user_payroll_loan')->update($post,$row['user_payroll_loan_id']);
			}
		}
		
		return $total;
	}
	
	private function get_total_per_timestamp($user,$stamp,$salary)
	{
				$total_ot_hours							= 0;
				$total_night_diff						= 0;
				$schedule								=  mvc_model('model.payroll_schedule')->select($stamp['payroll_schedule_id']);
				$ot										=  mvc_model('model.user_payroll_ot')->select_approve_timestamp_id($user['user_id'],$stamp['user_payroll_attendance_id']);
				$leave									=  mvc_model('model.user_payroll_leave')->select_approve_timestamp_id($user['user_id'],$stamp['user_payroll_attendance_id']);
				$sched_array							=  $this->schedule_array($schedule);
				$stamp_day								= date("l", $stamp['user_payroll_attendance_timestamp']);
				$return['leave_app']					=  0;
				$absent 								= 0;
			
					//echo 'GOOOOOD'.'<br>';
					if($stamp['timestamp_in'] > 50000 || in_array($stamp_day,$sched_array)  && !($leave) && $stamp['is_official_business'] == 0)
					{
						//hash_dump($sched_array,1);
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
						//$break_duration_min_excess	    =  round((($stamp['timestamp_break_in'] - $stamp['timestamp_break_out']) % 3600)/60);//minute
						//$work_duration_min_excess	    =  round((($stamp['timestamp_out'] - $stamp['timestamp_in']) % 3600)/60);//minute
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
						//$round_late 			= 0;
						//$round_under_time 		= 0;
						//$round_break_duration 	= 0;
						//$round_working_time 	= 0;
						$s_post['int']['is_undertime'] = 1;
					}
					$return['total_absent']					=  $absent;
					$return['total_ot']						=  0;
					$return['total_ot_hours']				=  0;
					$return['total_ot_minutes']				=  0;
					$return['total_late']					=  $round_late * $salary['user_minute_salary'];
					$return['total_over_break']				=  $round_break_duration * $salary['user_minute_salary'];
					$return['total_under_time']				= 0; //$round_under_time * $salary['user_minute_salary'];
					if($ot)
					{
						$total_ot_hours						=  $ot['user_payroll_ot_hour'];
						$total_ot_minutes					=  $ot['user_payroll_ot_minute'];
						$return['total_ot']					=  ($total_ot_hours*$salary['user_hourly_salary']) + ($total_ot_minutes*$salary['user_minute_salary']);
						$return['total_ot_hours']			=  $total_ot_hours;
						$return['total_ot_minutes']			=  $total_ot_minutes;
					}
					$return['total_basic']					= ($round_working_time * $salary['user_hourly_salary']) ;
					$return['total_night_diff']				=  $total_night_diff*($salary['user_hourly_salary']*(.1));
					$return['total_nd_hours']				=  $total_night_diff;
					$return['total_basic']					=  ($return['total_basic'] < 0) ?  0 : $return['total_basic'];
					
					$s_post['int']['user_salary_id']		=  $user['user_salary_id'];
					$update_stamp 							=  mvc_model('model.user_payroll_attendance')->update($s_post,$stamp['user_payroll_attendance_id']);
		return $return;	
		
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
	
	
	
	private function check_night_diff($sched,$curr_time_stamp)
	{		
	   // hash_dump($curr_time_stamp,1);
	   	$night_diff_hour									 =  0;
	   	$year 											 	 =	string_date_year($curr_time_stamp); 
		$month 										 		 =	string_date_month_numeric($curr_time_stamp); 
		$day 											     =	string_day($curr_time_stamp); 
	    $night_start										 = 	strtotime($month.'/'.$day.'/'.$year . ' 22:00'); 
	    $night_end											 =  strtotime($month.'/'.$day.'/'.$year . ' 6:00'); 
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
   
	
    
}