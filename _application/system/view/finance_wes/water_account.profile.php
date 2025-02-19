

<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
               Water Account Profile
            </b>

            <label></label>
        </div> 
    	 
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                <table width="100%" cellpadding="5" cellspacing="0" border="0" style="font-weight:normal; margin-top:10px;" class="mar_custom">                    
                    <thead><tr><td colspan="4"><b style="font-size: 12px;">Account Details</b></td></tr></thead>
                    <tr>
                        <td class="color_gray">Full Name:</td>
                        <td><?=$_VIEW['client_name']?>  <?=$_VIEW['client_surname']?></td>
                        <td class="color_gray">Account Number</td>
                        <td><?=$_VIEW['client_account_number']?></td>
                    </tr> 
                      <tr>
                        <td class="color_gray">
                            Project:
                        </td>
                        <td>
                            <?=$_VIEW['project_name']?>
                        </td>
                        <td class="color_gray">
                            Phase:
                        </td>
                        <td>
                            <?=$_VIEW['project_name']?> - <?=$_VIEW['project_site_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Block:
                        </td>
                        <td>
                            <?=$_VIEW['project_site_block_name']?>
                        </td>
                        <td class="color_gray">
                            Lot Number:
                        </td>
                        <td>
                            <?=$_VIEW['lot_name']?>
                        </td>
                    </tr>   
                    <tr>
                        <td class="color_gray">
                            Meter Number:
                        </td>
                        <td>
                            <?=$_VIEW['lot_wes_meter_number']?>
                        </td>
                        <td class="color_gray">
                            
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Account Status:
                        </td>
                        <td>
                            <?=$_VIEW['lot_wes_status_name']?>
                        </td>
                        <td class="color_gray">
                            Next Reading Date:
                        </td>
                        <td>
                            <?=string_date($_VIEW['lot_wes_date_start'])?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                            Balance Status:
                        </td>
                        <td>
                            <?=$_VIEW['balance_status']?>
                        </td>
                        <td class="color_gray">
                            <?=$_VIEW['balance_link']?>
                        </td>
                        <td>
                           
                        </td>
                    </tr>
                   
                      
                </table> 
            </div>  
        </div>    
    </div>
    <label></label>
</div>


