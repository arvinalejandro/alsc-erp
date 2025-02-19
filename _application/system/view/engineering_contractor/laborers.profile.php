

<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
              Laborer Profile
            </b>

            <label></label>
        </div> 
    	 
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                <table width="100%" cellpadding="3" cellspacing="0" border="0" style="font-weight:normal;">
                      <thead><tr><td colspan="4"><b style="font-size: 12px;">Laborer Details</b></td></tr></thead>
                    <tr>
                        <td class="color_gray" width="15%">
                            First Name:
                        </td>
                        <td width="35%">
                           <?=$_VIEW['contractor_laborer_first_name']?>
                        </td>
                        <td class="color_gray" width="15%">
                            Last Name:
                        </td>
                        <td width="35%">
                          <?=$_VIEW['contractor_laborer_last_name']?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray" width="15%">
                            Gender:
                        </td>
                        <td width="35%">
                           <?=$_VIEW['option_gender_name']?>
                        </td>
                        <td class="color_gray" width="15%">
                            Address:
                        </td>
                        <td width="35%">
                          <?=$_VIEW['contractor_laborer_address']?>
                        </td>
                    </tr>
                    <tr>
                        
                        <td class="color_gray">
                            Contact Number:
                        </td>
                        <td>
                          <?=$_VIEW['contractor_laborer_contact_number']?>
                        </td>
                        <td class="color_gray">
                            Status:
                        </td>
                        <td>
                            <?=$_VIEW['option_contractor_laborer_status_name']?>
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td class="color_gray">
                            Contractor Employer :
                        </td>
                        <td>                           
                              <?=$_VIEW['contractor_name']?>                     
                        </td>  
                       <td class="color_gray" colspan="1">
                        </td>
                        <td colspan="3">
                        </td>                         
                    </tr>
                    
                    
                </table>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


