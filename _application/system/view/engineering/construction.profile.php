

<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
               Construction Profile
            </b>

            <label></label>
        </div> 
    	 
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom pad_standard" id="client_profile">
                <table width="90%" cellpadding="6" cellspacing="0" border="0" style="font-weight:normal;">
                <thead><tr><td colspan="4"><b style="font-size: 12px;">Construction Details</b></td></tr></thead>
                    <tr>
                        <td class="color_gray">Project:</td>
                        <td>
                            <?=$_VIEW['project_name']?>
                        </td>
                        <td class="color_gray">Phase:</td>
                        <td>
                           <?=$_VIEW['project_acronym']?> - <?=$_VIEW['project_site_name']?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">Block:</td>
                        <td>
                            <?=$_VIEW['project_site_block_name']?>
                        </td>
                        <td class="color_gray">Lot:</td>
                        <td>
                          <?=$_VIEW['lot_name']?>
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td class="color_gray">Construction Type :</td>
                        <td>                           
                             <?=$_VIEW['option_unit_construction_name']?>                           
                        </td>  
                        <td class="color_gray">Contractor Name :</td>
                        <td>
                           <?=$_VIEW['contractor_name']?> 
                        </td>                         
                    </tr>
                    
                    <tr>
                        <td class="color_gray">Estimated Cost :</td>
                        <td>                           
                             P <?=string_amount($_VIEW['lot_construction_cost_estimate'])?>                         
                        </td>  
                        <td class="color_gray">Actual Cost : </td>
                        <td>
                           <?=$_VIEW['lot_construction_cost_actual']?> 
                        </td>                         
                    </tr>
                    
                    
                    <tr>
                        <td class="color_gray">Start Date :</td>
                        <td>                           
                             <?=string_date($_VIEW['lot_construction_date_start'])?>                             
                        </td>  
                        <td class="color_gray">Completion Date : </td>
                        <td>
                          <?=$_VIEW['lot_construction_date_complete']?>
                        </td>                         
                    </tr>
                    
                    <tr>
                        <td class="color_gray">Contractor Payment Retention :</td>
                        <td>                           
                             <?=$_VIEW['retention']?> 
                             <a class="link_button_inline blue" style="margin-left: 20%;" href="/engineering/construction/start_retention/&id=<?=$_VIEW['lot_construction_id']?>"><?=$_VIEW['retention_label']?></a>                          
                        </td>  
                        <td colspan="2"></td>                  
                    </tr>
                    
                    
                </table>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


