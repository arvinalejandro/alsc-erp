<?php
class model_payroll_cutoff
{	
	
	public function __construct()
	{
		$this->table_name		=	'payroll_cutoff';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 	, (SELECT COUNT(payroll_attendance_id) FROM payroll_attendance WHERE payroll_attendance.payroll_cutoff_id = {$id}) AS stamp_count	
					
					FROM 
					
					payroll_cutoff
					
					INNER JOIN option_payroll_status ON option_payroll_status.option_payroll_status_id = payroll_cutoff.option_payroll_status_id
					
					WHERE 
					
					payroll_cutoff_id = {$id}
					";							
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		return $list;
	}
	
	public function get_current_cutoff($id,$curr_time)
	{		
		
		$curr_time	=   string_date($curr_time);
		$curr_time	=   strtotime($curr_time);
		$id			=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					payroll_cutoff
					
					INNER JOIN option_payroll_status ON option_payroll_status.option_payroll_status_id = payroll_cutoff.option_payroll_status_id
					
						
					WHERE 
					
					sysglobal_payroll_id = {$id}
					
					AND
					
					payroll_cutoff_date_start <= {$curr_time}
					
					AND
					
					payroll_cutoff_date_end >= {$curr_time}
					
					";		
		//echo $query;
		//die();								
		$rows	=	sql_select($query);	
		$list	=	$rows[0];
		//hash_dump($list,1);
		return $list;
	}
	
	
	
	public function select_all($id,$curr_time=1)
	{
		
		if($curr_time > 1)
		{
			$filter = " AND payroll_cutoff_date_start <=". $curr_time;
		}
		
		# DB
		$query	=	"
					SELECT 
						
						* 	, (SELECT COUNT(payroll_attendance_id) FROM payroll_attendance WHERE payroll_attendance.payroll_cutoff_id = payroll_cutoff.payroll_cutoff_id) AS stamp_count	
					
					FROM 
					
					payroll_cutoff 
					
					INNER JOIN option_payroll_status ON option_payroll_status.option_payroll_status_id = payroll_cutoff.option_payroll_status_id
					
					
					WHERE sysglobal_payroll_id = {$id}
						
					{$filter}	
					
					ORDER BY 	payroll_cutoff_id DESC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.cutoff';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.empty_cutoff';
		$template_row_empty	=	view_get_template($template_row_empty); 
		
		if(count($rows))
		{
			foreach($rows as $row)
			{		
                $row['payroll_cutoff_date_start']    			=  string_date_day_enclosed($row['payroll_cutoff_date_start']);
                $row['payroll_cutoff_date_end']    				=  string_date_day_enclosed($row['payroll_cutoff_date_end']);
                $row['payroll_cutoff_approver']    				=  ($row['payroll_cutoff_approver']) ? $row['payroll_cutoff_approver'] : 'N/A';
                $row['days_count']    							=  ($row['stamp_count']) ? $row['stamp_count'] : 'N/A';
				$list				   						   .=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	} 
	
	
	
	public function select_all_current($id,$user_id)
	{
		
	
		# DB
		$query	=	"
					SELECT 
						
						* 		
					
					FROM 
					
					payroll_cutoff 
					
					
					WHERE sysglobal_payroll_id = {$id}
						
					{$filter}	
					
					ORDER BY 	payroll_cutoff_id ASC		
					
					";
		$rows	=	sql_select($query);
		# Template
		$template_row		=	'payroll/template/row.annual_report';
		$template_row		=	view_get_template($template_row);
		$template_row_empty	=	'payroll/template/row.empty_annual_report';
		$template_row_empty	=	view_get_template($template_row_empty); 
		
		if(count($rows))
		{
			$tax_withheld	=  0;
			foreach($rows as $row)
			{		
               
                $user_cutoff 									=  mvc_model('model.user_payroll_cutoff')->select_by_user_cutoff_report($row['payroll_cutoff_id'],$user_id);
                if($user_cutoff)
                {
					$salary								 		=  mvc_model('model.user_salary')->select($user_cutoff['user_salary_id']);
					$tax									    =  mvc_model('model.payroll_tax')->select($user_cutoff['payroll_tax_id']);
					$sss										=  mvc_model('model.payroll_deduction')->select($user_cutoff['payroll_deduction_id_sss']);
					$philhealth									=  mvc_model('model.payroll_deduction')->select($user_cutoff['payroll_deduction_id_philhealth']);
					$pagibig									=  mvc_model('model.payroll_deduction')->select($user_cutoff['payroll_deduction_id_pagibig']);
					$row['salary']								=  $salary['user_basic_salary']* 12;		
					$row['ot']									=  $user_cutoff['salary_gross_ot']+$user_cutoff['salary_gross_night_diff'];		
					$row['gross']								=  $row['salary']+$row['ot']+$user_cutoff['salary_conversion']+$user_cutoff['salary_bonus'];		
					$row['sss']									=  ($sss) ? ($sss['payroll_deduction_value']+$sss['payroll_deduction_value_employee'])*12 : 0;		
					$row['phealth']								=  ($philhealth) ? ($philhealth['payroll_deduction_value']+$philhealth['payroll_deduction_value_employee'])*12 : 0;
					$row['pagibig']								=  ($pagibig) ? ($row['salary']*($pagibig['payroll_deduction_value']/100)) + ($pagibig['payroll_deduction_value_employee']*12) : 0;
					$row['lates']								=  $user_cutoff['deduction_late']+$user_cutoff['deduction_under_time']+$user_cutoff['deduction_over_break']+($user_cutoff['payroll_absent']*$salary['user_daily_salary']);		
                	$row['exemption']							=  $tax['payroll_tax_discount'];
                	$row['total_deduction']						=  $row['sss']+$row['phealth']+$row['pagibig']+$row['lates']+$row['exemption'];
                	$row['taxable_income']						=  $row['gross'] - $row['total_deduction'];
                	$row['tax_due']								=  $this->get_tax($row['taxable_income']);
                	$row['tax_withheld']						=  $tax_withheld;
                	$row['tax_still_due']						=  $row['tax_due'] - $tax_withheld;
                	$row['tax_payday']							=  $row['tax_due']/24;
                	$tax_withheld							   +=  $row['tax_payday'];
                }
                
                $row['salary']									=  ($row['salary']) ? string_amount($row['salary']) : 'N/A';
                $row['ot']										=  ($row['ot']) ? string_amount($row['ot']) : '0.00';
                $row['gross']									=  ($row['gross']) ? string_amount($row['gross']) : 'N/A';
                $row['sss']										=  ($row['sss']) ? string_amount($row['sss']) : 'N/A';
                $row['phealth']									=  ($row['phealth']) ? string_amount($row['phealth']) : 'N/A';
                $row['pagibig']									=  ($row['pagibig']) ? string_amount($row['pagibig']) : 'N/A';
                $row['lates']									=  ($row['lates']) ? string_amount($row['lates']) : 'N/A';
                $row['exemption']								=  ($row['exemption']) ? string_amount($row['exemption']) : 'N/A';
                $row['total_deduction']							=  ($row['total_deduction']) ? string_amount($row['total_deduction']) : 'N/A';
                $row['taxable_income']							=  ($row['taxable_income']) ? string_amount($row['taxable_income']) : 'N/A';
                $row['tax_due']									=  ($row['tax_due']) ? string_amount($row['tax_due']) : 'N/A';
                $row['tax_withheld']							=  ($row['tax_withheld']) ? string_amount($row['tax_withheld']) : '0.00';
                $row['tax_still_due']							=  ($row['tax_still_due']) ? string_amount($row['tax_still_due']) : 'N/A';
                $row['tax_payday']								=  ($row['tax_payday']) ? string_amount($row['tax_payday']) : 'N/A';
                $row['payroll_cutoff_date_end']    				=  string_date_day_enclosed($row['payroll_cutoff_date_end']);
				$list				   						   .=	view_populate($row, $template_row);
			}			
		}
		else
		{
			$list	=	$template_row_empty;
		}
		return $list;
	} 
	
	
   private function get_tax($taxable_annual_income)
	{
		$total										=  0;
		if($taxable_annual_income > 0)
		{
			//echo $taxable_annual_income;
			//die();
		}
		
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
		
		//$payday_tax									=   $tax/24;		
		//$total										=   round($payday_tax,2);
		
		
		return $tax;
		
	}
	
	
# Modify
	
	
	public function insert($post)
	{
		$data														=	sql_parse_input('payroll_cutoff', $post);	
		$sql														=	sql_insert($this->table_name, $data, 'payroll_cutoff_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function update($post, $id)
	{
		$data					=	sql_parse_input('payroll_cutoff', $post);			
									sql_update($this->table_name, 'payroll_cutoff_id', $id, $data);	
		$return['result']		=	true;
		$return['data']			=	'';
		$return['message']		=	$this->message_update;
		
	}
	
	public function delete_entry($id)
	{
		sql_delete('payroll_cutoff', 'payroll_cutoff_id', $id);
	}
	
	
	 
	
}
 