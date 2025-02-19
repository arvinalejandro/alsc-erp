<div id="content_body">    
       
      <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
          
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/user/hr/submit_leave_request/" method="post" name="alsc_form">
           	<input type="hidden" name="leave[int][user_id]" value="<?=$_VIEW['user_']['user_id']?>">
           	<input type="hidden" id="l_w" name="leave[int][user_payroll_leave_whole]" value="0">
           	<input type="hidden" name="leave[int][payroll_schedule_id]" value="<?=$_VIEW['user_']['payroll_schedule_id']?>">
           	<input type="hidden" name="leave[int][user_payroll_attendance_id]" value="<?=$_VIEW['user_payroll_attendance_id']?>">
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="2">Leave Request</td>
                        </tr>
                    </thead>        
                    
                    <tr>
                        <td class="color_gray">
                           Leave Date:
                        </td>
                        <td>
                        	 <?=string_date_day($_VIEW['user_payroll_attendance_timestamp'])?>
                        	             
                        </td>
                    </tr>
                    
                  
                     <tr>
                        <td class="color_gray">
                             Type:
                        </td>
                        <td>
                        	<select id="leave_type" name="leave[str][user_payroll_leave_type_id]" onchange="type_check()">
                        			<option></option>
                        		<?=$_VIEW['option_leave']?>
                        	</select>                  
                        </td>
                    </tr>
                    
                     <tr>
                        <td class="color_gray">
                             <input id="whole" type="checkbox" onclick="go_check()"> Whole Day
                        </td>
                        <td>
                        	<input id="hours" type="text" name="leave[int][user_payroll_leave_duration]"> (hrs.)               
                        </td>
                    </tr>
                    
                    
                    
                 
                    
                    <tr valign="middle">
	                       <td colspan="2" align="center">                  		
                       			<div class="content_block_vpad"> 
                       			    <a href="/user/hr/leaves/" class="link_button_inline red">Cancel</a>                      				
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


<script type="text/javascript">

var leave_type;

	function go_check()
	{
		
		if($('#whole').prop('checked'))
		{
			$('#hours').prop('disabled', true);
			$('#hours').val('');
			$('#l_w').val(1);
		}
		else
		{
			$('#hours').prop('disabled', false);
			$('#hours').val('');
			$('#l_w').val(0);
		}
		
	}
	
	
	function type_check()
	{
		leave_type = $('#leave_type').val();
		if(leave_type == 'payroll_leave_compensatory')
		{
			$('#whole').prop('checked', true);
		}
		else
		{
			$('#whole').prop('checked', false);
		}
		
		go_check();
		
	}
	
</script>