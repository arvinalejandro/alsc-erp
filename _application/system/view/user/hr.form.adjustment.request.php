<div id="content_body">    
       
      <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
        
        <div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">Request For Time Adjustment</b>
            <label></label>
        </div> 
    
        <!---------- CONTENT CONTROLLERS ----------->        

        <div style="overflow: auto;" id="_right_content_">
           	<form action="/user/hr/submit_adjustment_request/" method="post" name="alsc_form">
           	<input type="hidden" name="adj[int][user_id]" value="<?=$_VIEW['user_id']?>">
           	<input type="hidden" name="adj[int][user_payroll_attendance_id]" value="<?=$_VIEW['user_payroll_attendance_id']?>">
           	<input type="hidden" name="cur_date" value="<?=$_VIEW['user_payroll_attendance_timestamp']?>">
	            <table width="98%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 10px;" align="center">                    
                    <thead>
                        <tr>
                            <td>Date</td>
                            <td>Time In</td>
                            <td>Time Out</td>
                            <td>Break Out</td>
                            <td>Break In</td>
                        </tr>
                    </thead> 
                     
                    
                        <input id="hidden_ti" value="00:00"  type="hidden" name="adj[int][user_payroll_attendance_adjustment_time_in]">
                        <input id="hidden_to" value="00:00"   type="hidden" name="adj[int][user_payroll_attendance_adjustment_time_out]">
                        <input id="hidden_bi" value="00:00"  type="hidden" name="adj[int][user_payroll_attendance_adjustment_break_in]">
                        <input id="hidden_bo" value="00:00"  type="hidden" name="adj[int][user_payroll_attendance_adjustment_break_out]">
                        <input id="hidden_ob" value="0"      type="hidden" name="adj[int][is_official_business]">
                  
                    <tr>
                            <td colspan="5"><input id="ob" type="checkbox" onclick="go_check()"> Official Business</td>
                           
                        </tr>
                    <tr>
                        <td><?=string_date_day($_VIEW['user_payroll_attendance_timestamp'])?></td>
                        <td>
                        	
	                        <select class="_time_drop" id="ti_hr" style="width: 60px;" onchange="go_set();">
	                        	 <?=$_VIEW['opt_hour']?>
	                        </select>
	                       <select class="_time_drop" id="ti_mn" style="width: 60px;" onchange="go_set();">
	                        	 <?=$_VIEW['opt_min']?>
	                        </select>
                        </td>
                        <td>
                        	
	                        <select class="_time_drop" id="to_hr" style="width: 60px;" onchange="go_set();">
	                        	 <?=$_VIEW['opt_hour']?>
	                        </select>
	                       <select class="_time_drop" id="to_mn" style="width: 60px;" onchange="go_set();">
	                        	 <?=$_VIEW['opt_min']?>
	                        </select>
                        </td>
                        <td>
                        	
	                        <select class="_time_drop" id="bo_hr" style="width: 60px;" onchange="go_set();">
	                        	 <?=$_VIEW['opt_hour']?>
	                        </select>
	                       <select class="_time_drop" id="bo_mn" style="width: 60px;" onchange="go_set();">
	                        	 <?=$_VIEW['opt_min']?>
	                        </select>
                        </td>
                        <td>
                        	
	                        <select class="_time_drop" id="bi_hr" style="width: 60px;" onchange="go_set();">
	                        	 <?=$_VIEW['opt_hour']?>
	                        </select>
	                       <select class="_time_drop" id="bi_mn" style="width: 60px;" onchange="go_set();">
	                        	 <?=$_VIEW['opt_min']?>
	                        </select>
                        </td>
                    </tr>  
                    <tr>
                        <td>Reason</td>
                        <td colspan="5"><textarea style="height: 150px; width:100%;" name="adj[str][user_payroll_attendance_adjustment_reason]"></textarea></td>
                    </tr>                         
                    <tr valign="middle">
	                   <td colspan="6" align="center">                  		
                       		<div class="content_block_vpad"> 
                       			<a href="/user/hr/attendance/" class="link_button_inline red">Cancel</a>                      				
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

var time_in;	
var time_out;	
var break_in;	
var break_out;	
	function go_set()
	{
		 time_in   = $('#ti_hr').val()+':'+$('#ti_mn').val();
		 time_out  = $('#to_hr').val()+':'+$('#to_mn').val();
		 break_in  = $('#bi_hr').val()+':'+$('#bi_mn').val();
		 break_out = $('#bo_hr').val()+':'+$('#bo_mn').val();
		
		 $('#hidden_ti').val(time_in);
		 $('#hidden_to').val(time_out);
		 $('#hidden_bi').val(break_in);
		 $('#hidden_bo').val(break_out);
	}
	
</script>
<script type="text/javascript">

	
	function go_check()
	{
		
		if($('#ob').prop('checked'))
		{
			//$('._time_drop').prop('disabled', true);
			$('#hidden_ob').val(1);
			//alert('yst');
		}
		else
		{
			//$('._time_drop').prop('disabled', false);
			$('#hidden_ob').val(0);
		}
		
	}
	
</script>