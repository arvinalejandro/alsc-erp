
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
               Other Fees
            </b>
             
            
            <a href="/finance_wes/settings/add_group/" class="link_button_inline blue float_right" style="margin-left:5px;">
                <span class="add"></span>
	    		Add Charge Group
            </a>
            <a href="/finance_wes/settings/add_other_charge/" class="link_button_inline blue float_right" style="margin-left:5px;">
                <span class="add"></span>
	    		Add Other Charge
            </a>

            <label></label>
        </div> 
    	
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td>
                            Name                 
                        </td>
                        <td align="center">
                           Amount
                        </td>
                        
                        <td align="center">
                        	Project
                        </td>                        
                        <td align="center">
                            Group
                        </td>   
                         <td align="center" width="10%"></td>                                  
                    </tr>
                </thead>
                <tbody>
                	<?=$_VIEW['table_row']?>
                </tbody>  
            </table>
            <label></label>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


