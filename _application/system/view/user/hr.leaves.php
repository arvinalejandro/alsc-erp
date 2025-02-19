
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
              Leaves
            </b>
             <div class="float_right mar_h">
                <form method="post" name="alsc_form" class="float_left">
                    <select id="filter_type" name="filter_type" style="height: 30px; width: 160px; padding: 0px;" onchange="go_filter()" >
                         <?=$_VIEW['filter_type']?>
                    </select>
                </form>
                <label></label>
            </div>
            <label></label>
        </div> 
    	
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
            
            	<table width="100%" cellpadding="5" cellspacing="0" border="0" style="font-weight:normal; margin-top:10px;" class="mar_custom">                    
                    <thead><tr><td colspan="5"><b style="font-size: 12px;">Leaves Summary</b></td></tr></thead>
                   
                      <tr>
                        <td align="center" class="color_gray"><b>Leave Type</b></td>
                        <td align="center"  class="color_gray">Available Leave/s</td>
                        <td align="center"  class="color_gray">Current Leave/s</td>
                        <td align="center"  class="color_gray">Consumed Leave/s:</td>
                    </tr>
                    
                   <tr>
                        <td align="center" >Sick Leave</td>
                        <td align="center" ><?=string_clean_number($_VIEW['user']['available_sick_leave'])?></td>
                        <td align="center" ><?=$_VIEW['counts']['fiscal']['payroll_leave_sick']?></td>
                        <td align="center" ><?=$_VIEW['counts']['sl_count']?> </td>
                    </tr>
                    <tr>
                        <td align="center" >Vacation Leave</td>
                        <td align="center" ><?=string_clean_number($_VIEW['user']['available_vacation_leave'])?></td>
                        <td align="center" ><?=$_VIEW['counts']['fiscal']['payroll_leave_vacation']?></td>
                        <td align="center" ><?=$_VIEW['counts']['vl_count']?></td>
                    </tr>
                    <tr>
                        <td align="center" >Emergency Leave</td>
                        <td align="center">N/A</td>
                        <td align="center" ><?=$_VIEW['counts']['fiscal']['payroll_leave_emergency']?></td>
                        <td align="center" ><?=$_VIEW['counts']['el_count']?></td>
                    </tr>
                    <tr>
                        <td align="center" >Bereavement Leave</td>
                         <td align="center">N/A</td>
                        <td align="center" ><?=$_VIEW['counts']['fiscal']['payroll_leave_bereavement']?></td>
                        <td align="center" ><?=$_VIEW['counts']['bl_count']?></td>
                    </tr>
                    <tr>
                        <td align="center" >Leave Without Pay</td>
                         <td align="center">N/A</td>
                        <td align="center" ><?=$_VIEW['counts']['fiscal']['payroll_leave_no_pay']?></td>
                        <td align="center" ><?=$_VIEW['counts']['npl_count']?> </td>
                    </tr>
                    <tr>
                        <td align="center" >Solo Parent Leave Leave</td>
                         <td align="center">N/A</td>
                        <td align="center" ><?=$_VIEW['counts']['fiscal']['payroll_leave_solo_parent']?></td>
                        <td align="center" ><?=$_VIEW['counts']['sp_count']?></td>
                    </tr>
                    <tr>
                        <td align="center" >Paternity Leave</td>
                         <td align="center">N/A</td>
                        <td align="center" ><?=$_VIEW['counts']['fiscal']['payroll_leave_paternity']?></td>
                        <td align="center" ><?=$_VIEW['counts']['pl_count']?></td>
                    </tr>
                    <tr>
                        <td align="center" >Maternity Leave(CS)</td>
                         <td align="center">N/A</td>
                        <td align="center" ><?=$_VIEW['counts']['fiscal']['payroll_leave_maternity_cs']?></td>
                        <td align="center" ><?=$_VIEW['counts']['mlc_count']?></td>
                    </tr>
                     <tr>
                        <td align="center" >Maternity Leave(Normal)</td>
                         <td align="center">N/A</td>
                        <td align="center" ><?=$_VIEW['counts']['fiscal']['payroll_leave_maternity_normal']?></td>
                        <td align="center" ><?=$_VIEW['counts']['mln_count']?></td>
                    </tr>
                    
                    
                    
                </table> 
            
            
            
            <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                       <tr>   
                       <td>Name</td>
                        <td>Employee #</td>
                        <td align="left">Date</td>
                        <td align="center">Schedule</td>
                        <td align="center">Time In</td> 
                        <td align="center">Break Start</td> 
                        <td align="center">Break End</td>
                        <td align="center">Time Out</td>
                        <td align="center">
                            <div class="tooltip">
                                <span class="tool_body">L</span>
                                <span class="tooltiptext tooltip-top">Lates in mins</span>
                            </div>
                            <div class="tooltip">
                                <span class="tool_body">OB</span>
                                <span class="tooltiptext tooltip-top">Over Break in mins</span>
                            </div>
                            <div class="tooltip">
                                <span class="tool_body">UT</span>
                                <span class="tooltiptext tooltip-top">Under Time in mins</span>
                            </div>
                            <div class="tooltip">
                                <span class="tool_body">ET</span>
                                <span class="tooltiptext tooltip-top">Excess Time in mins</span>
                            </div>
                        </td>
                        <td align="center">Overtime</td>
                        <td align="center">Total Hours</td>
                        <td></td>    
                       </tr>  
                            
                    </thead>
                <tbody>
                   
                  <?=$_VIEW['row.daily_stamp']?>    
                </tbody>  
            </table>
            
            <label></label>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


<script type="text/javascript">

	
	function go_filter()
	{
		var filter   = $('#filter_type').val();
		
		go_to('/user/hr/leaves/&cutoff='+filter);
	}
	
</script>