

<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
              Contractor Profile
            </b>

            <label></label>
        </div> 
    	 
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                <table width="100%" cellpadding="3" cellspacing="0" border="0" style="font-weight:normal;">
                      <thead><tr><td colspan="4"><b style="font-size: 12px;">Contractor Details</b></td></tr></thead>
                    <tr>
                        <td class="color_gray" width="15%">
                            Conractor Name:
                        </td>
                        <td width="35%">
                           <?=$_VIEW['contractor_name']?>
                        </td>
                        <td class="color_gray" width="15%">
                            Owner Name:
                        </td>
                        <td width="35%">
                          <?=$_VIEW['contractor_owner']?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray" width="15%">
                            Conractor Type:
                        </td>
                        <td width="35%">
                           <?=$_VIEW['option_contractor_type_name']?>
                        </td>
                        <td class="color_gray" width="15%">
                            Status:
                        </td>
                        <td width="35%">
                          <?=$_VIEW['option_contractor_status_name']?>
                        </td>
                    </tr>
                    <tr>
                        
                        <td class="color_gray">
                            Business Address:
                        </td>
                        <td>
                          <?=$_VIEW['contractor_address']?>
                        </td>
                        <td class="color_gray">
                            Business Permit Number:
                        </td>
                        <td>
                            <?=$_VIEW['contractor_business_permit_number']?>
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td class="color_gray">
                            Phone Number :
                        </td>
                        <td>                           
                              <?=$_VIEW['contractor_landline']?>                     
                        </td>  
                       <td class="color_gray" colspan="1">
                            Mobile Number :
                        </td>
                        <td colspan="3">
                           <?=$_VIEW['contractor_mobile']?>
                        </td>                         
                    </tr>
                    
                     <tr>
                        <td class="color_gray">
                           Fax Number :
                        </td>
                        <td>                           
                              <?=$_VIEW['contractor_fax']?>                     
                        </td>  
                       <td class="color_gray" colspan="1">
                           Email Address:
                        </td>
                        <td colspan="3">
                           <?=$_VIEW['contractor_email']?>
                        </td>                         
                    </tr>
                    <thead><tr><td colspan="4"><b style="font-size: 12px;">Contractor Specialization</b></td></tr></thead>
                    
                    <?=$_VIEW['con_spec']?>
                    <thead><tr><td colspan="4"><b style="font-size: 12px;">Comment</b></td></tr></thead>
                    <tr>
                       <td class="color_gray" colspan="1">
                           Comment
                        </td>
                        <td colspan="3">
                           <?=$_VIEW['contractor_comment']?>
                        </td>                         
                    </tr>
                </table>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


