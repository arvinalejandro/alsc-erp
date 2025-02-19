<div id="content_body">    
       
      <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/user/hr/submit_ot_request/" method="post" name="alsc_form">
           	<input type="hidden" name="ot[int][user_id]" value="<?=$_VIEW['user_id']?>">
           	<input type="hidden" name="ot[int][user_payroll_attendance_id]" value="<?=$_VIEW['user_payroll_attendance_id']?>">
           	<input type="hidden" name="ot[int][user_payroll_ot_date]" value="<?=$_VIEW['user_payroll_attendance_timestamp']?>">
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="2">Overtime Request</td>
                        </tr>
                    </thead>        
                    
                     
                    <tr>
                        <td class="color_gray">
                            Attendance Date:
                        </td>
                        <td>
                        	<?=string_date_day_enclosed($_VIEW['user_payroll_attendance_timestamp'])?>                   
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">Schedule:</td>
                        <td><?=$_VIEW['payroll_schedule_start']?> - <?=$_VIEW['payroll_schedule_end']?></td>
                        
                    </tr>
                    <tr>
                        <td class="color_gray">Actual:</td>
                        <td><?=string_time_military($_VIEW['timestamp_in'])?> - <?=string_time_military($_VIEW['timestamp_out'])?></td>
                    </tr>
                  
                    <tr>
                        <td class="color_gray">
                              OT (hours/minutes):
                        </td>
                        <td>
                            <input type="text" value=" <?=$_VIEW['ot_hour']?>"  name="ot[int][user_payroll_ot_hour]" style="width:30%;" class="float_left"> 
                            <span class="mar_h float_left" style="line-height: 40px;">:</span>  
                            <input type="text" value=" <?=$_VIEW['ot_minute']?>" name="ot[int][user_payroll_ot_minute]" style="width:30%;" class="float_left">                     
                        </td>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                            Early OT (hours/minutes):
                        </td>
                        <td>
                            <input type="text" value=" <?=$_VIEW['early_ot_hour']?>"  name="early_ot_hour" style="width:30%;" class="float_left"> 
                            <span class="mar_h float_left" style="line-height: 40px;">:</span>  
                            <input type="text" value=" <?=$_VIEW['early_ot_minute']?>" name="early_ot_minute" style="width:30%;" class="float_left">                     
                        </td>
                        </td>
                    </tr>

                    
                    <tr valign="middle">
	                       <td colspan="2" align="center">                  		
                       			<div class="content_block_vpad"> 
                       			    <a href="/user/hr/ot/" class="link_button_inline red">Cancel</a>                      				
                       				<a class="link_button_inline blue" onclick="submit_form('alsc_form')" >Submit</a>
                       			</div>               
	                       </td>
	                    </tr>                               
                </table>      
                
	            
            </form>
            <label></label>
                
            
            
        </div>    
    </div>
    <label></label>
</div>
