
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
              Surcharge
            </b>
           

            <label></label>
        </div> 
    	
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td align="center">
                            Surcharge Rate                 
                        </td>
                        <td align="center">
                           Vat Rate
                        </td>
                        
                         <td width="10%" align="center"></td>                                  
                    </tr>
                </thead>
                <tbody>
                	<tr>
                        <td align="center">
                            <?=string_amount($_VIEW['surcharge'])?>%           
                        </td>
                        <td align="center">
                         <?=string_amount($_VIEW['vat_rate'])?>%      
                        </td>
                        
                         <td align="center">
							<a class="link_button_inline blue"  href="/finance_wes/settings/edit_surcharge/">Edit Details</a>
						</td>                         
                    </tr>
                </tbody>  
            </table>
            <label></label>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


