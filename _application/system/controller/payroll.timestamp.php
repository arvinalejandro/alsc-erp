<?php
class payroll_timestamp
{
    
    public function __construct()
    {    	
       	$this->controller_id 							= 	'payroll_timestamp';
    }
 
   public function index($parent)
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
        $data['row.attendance']						 	=	mvc_model('model.user_payroll_attendance')->select_all($c_id);
        $option										=	mvc_model('model.option')->select_option('payroll_cutoff', 'WHERE sysglobal_payroll_id='.($acitve_fiscal['sysglobal_payroll_id']*1).' ORDER BY payroll_cutoff_id ASC');
    	$label[0]									=  'payroll_cutoff_date_start';
    	$label[1]									=  'payroll_cutoff_date_end';
    	$data['filter_type']						=	hash_cutoff($option, 'payroll_cutoff_id', $label,$c_id);
        # VIEW
         $parent->_view('timestamp', $data);  
    } 
    
     
    
    public function profile($parent)
    {      	
    	
    	# DB
    	# VIEW - side nav
        $side_nav['profile.class']					=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.timestamp', $side_nav);       
        # VIEW
        $parent->_view('timestamp.profile', $data);          
    } 
    
     public function payslip($parent)
    {      	
    	$id											= $_GET['id']*1;
    	$c_id										= $_GET['cutoff']*1;
    	# DB
    	$data 									 	=  mvc_model('model.user_payroll_cutoff')->select_by_user_cutoff($c_id,$id);
    	
    	$data['user']				 				=  mvc_model('model.user')->select($id);
    	$allowance									=  mvc_model('model.user_payroll_allowance')->select_all_by_user($id);
    	$deduction									=  mvc_model('model.user_payroll_deduction')->select_all_by_user($id);
    	$tax										=  mvc_model('model.payroll_tax')->select($user['payroll_tax_id']);
    	foreach($deduction as $d_row)
    	{
			
			$data['d_row']						    .=  '<tr>
									                        <td class="color_gray" colspan="2">
									                            '.$d_row['payroll_deduction_name'].':
									                        </td>
									                        <td colspan="2">'.
									                            string_amount($d_row['payroll_deduction_value']).'
									                        </td>
									                    </tr>';
    	}
    	
    	foreach($allowance as $a_row)
    	{
			
			$data['a_row']						   .=  '<tr>
									                        <td class="color_gray" colspan="2">
									                            '.$a_row['payroll_allowance_name'].':
									                        </td>
									                        <td colspan="2">'.
									                            string_amount($a_row['payroll_allowance_value']).'
									                        </td>
									                    </tr>';
    	}
    	# VIEW - side nav
        $side_nav['payslip.class']					=	'bold';         	
        $side_nav['id']								=	$id;         	
        $side_nav['cutoff_id']						=	$c_id;   
        //hash_dump($data,1);      	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.timestamp', $side_nav);       
        # VIEW
        $parent->_view('timestamp.payslip', $data);          
    } 
    
   
    
    public function remark($parent)
    {
    	//$id											=   $_GET['id']*1;
    	//$data['lot_wes_reading_id']					=	$id;
    	# DB
        //$data['row.remark']							=	mvc_model('model.remark')->get_row('lot_wes_reading', $_GET['id']);            
        # VIEW - side nav
        $side_nav['remark.class']					=	'bold';         	
     	$side_nav['lot_wes_reading_id']				=	$id;          	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.timestamp', $side_nav);           
        # VIEW
        $parent->_view('timestamp.remark', $data);      
	}
    
 //======================================FORMS
 
    public function edit_attendance($parent)
    {
    	$id											 =   $_GET['id']*1;
    	# DB
    	$data 										 =  mvc_model('model.user_payroll_attendance')->select($id);
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
     	# VIEW
        $parent->_view('timestamp.form.adjust', $data);        
	}
	
    
  #----------------------- Form Actions
  
 
 #actions=================================================================
 
   
	
    
}