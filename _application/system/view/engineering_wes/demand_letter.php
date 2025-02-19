
<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS -----------> 
         
        <div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <a class="mar_custom float_left side_nav_switch hide" style="margin-right:10px;"></a>
            
            <div class="float_left" style="width: 50%;">                
                
                <div class="border_gray float_left" id="search_body">
                    <input />
                    <a class="mar_custom search_button" style="margin-left:10px;"></a>
                </div>                
                
            </div>
             
            <div class="float_right mar_h">
                <form action="" method="post" name="alsc_form" class="float_left">
                    <select id="filter_type" name="filter_type" style="height: 30px; width: 160px; padding: 0px;" onchange="go_filter()" >
                        <?=$_VIEW['option_filter']?>
                        
                    </select>
                </form>
                <label></label>
            </div>
            <label></label>
        </div> 

        <div style="overflow: auto; min-width:1000px;" id="_right_content_">
            <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                       <tr>   
                            <td>Account Number</td>
                            <td align="center">Client Name</td>
                            <td>Meter Number</td>
                            <td align="center">Phase</td> 
                            <td align="center">Block</td>
                            <td align="center">Lot</td>
                            <td>Reading Date</td> 
                            <td>Due Date</td> 
                            <td align="center">Reading Status</td>                       
                            <td align="center">Letter Status</td>                       
                            <td width="10%"></td> 
                       </tr>  
                            
                    </thead>
                <tbody>
                   
                  <?=$_VIEW['row.reading']?>    
                </tbody>  
            </table>
            <label></label>
            
        </div>    
    </div>
    <label></label>
</div>


<script type="text/javascript">


	function go_filter()
	{
		var filter   = $('#filter_type').val();
		
		go_to('/engineering_wes/demand_letter/&filter_type='+filter);
	}
	
</script>