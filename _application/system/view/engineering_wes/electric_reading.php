
<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS -----------> 
         
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <a class="mar_custom float_left side_nav_switch hide" style="margin-right:10px;"></a>
            
            <div class="float_left" style="width: 50%;">                
                
                <div class="border_gray float_left" id="search_body">
                    <input />
                    <a class="mar_custom search_button" style="margin-left:10px;"></a>
                </div>      
                    
                
            </div>
            <a href="http://alsc/engineering_wes/electric_reading/check_insert" class="link_button_inline green float_right " style="margin-left:5px;">
                +
            </a> <!-- check insert. to be removed -->
                 
            <a onclick="open_letter('electric_meter_reading')" class="link_button_inline blue float_right" style="margin-left:5px;">
                <span class="add"></span>
	            Reading Report
            </a>
             <a onclick="open_letter('electric_billing_report')" class="link_button_inline blue float_right" style="margin-left:5px;">
                <span class="add"></span>
	            Billing Report
            </a> 
            
            
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
                            <td>Client Name</td>
                            <td>Meter Number</td>
                            <td>SIN Number</td>
                            <td align="center">Phase</td> 
                            <td align="center">Block</td>
                            <td align="center">Lot</td>
                            <td align="center">Last Reading</td>
                            <td align="center">Current Reading</td>
                            <td>Reading Date</td>
                            <td align="center">Status</td>                         
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

	function open_letter(pLetter)
	{
		var myWindow = window.open("/engineering_wes/electric_reading/report/&report=" + pLetter, "_blank", "width=1000, height=600, toolbar=no, scrollbars=yes, resizable=no, resizable=yes, top=50, left=50, location=no");
	}
	
	function go_filter()
	{
		var filter   = $('#filter_type').val();
		
		go_to('/engineering_wes/electric_reading/&filter_type='+filter);
	}
	
</script>