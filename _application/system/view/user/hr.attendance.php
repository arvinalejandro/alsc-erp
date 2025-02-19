
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
              Attendance
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
                        <td align="center">Total Hrs</td>
                        <td></td> 
                    </tr>  

                </thead>
                <tbody>
                    <tr>
                        <?=$_VIEW['row.attendance']?>                  
                    </tr>      
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
		
		go_to('/user/hr/attendance/&cutoff='+filter);
	}
	
</script>
