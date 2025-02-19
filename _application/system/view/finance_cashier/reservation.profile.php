
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                <?=$_VIEW['project_name']?> <?=$_VIEW['project_site_name']?> - Block <?=$_VIEW['project_site_block_name']?> Lot <?=$_VIEW['lot_name']?>
            </b>

            <label></label>
        </div> 
    	
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                <table width="100%" cellpadding="3" cellspacing="0" border="0" style="font-weight:normal;">
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Lot Details</b></td>
                        </tr>
                    </thead>
                    <tr>
                        <td class="color_gray" width="15%">
                            Project:
                        </td>
                        <td width="35%">
                            <?=$_VIEW['project_name']?>
                        </td>
                        <td class="color_gray" width="15%">
                            Phase:
                        </td>
                        <td width="35%">
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
                            House Model:
                        </td>
                        <td>
                            <?=(($_VIEW['house_name']) ? $_VIEW['house_name'] : 'none')?> 
                        </td>
                        <td class="color_gray">
                            House Model Code:
                        </td>
                        <td>
                            <?=(($_VIEW['house_code']) ? $_VIEW['house_code'] : 'none')?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Lot Area:
                        </td>
                        <td><?=$_VIEW['lot_area']?> sqm.</td>
                        
                        <td class="color_gray">
                            Floor Area :
                        </td>
                        <td>
							<?=string_amount($_VIEW['house_area'])?> sqm.
                        </td>
                    </tr> 
                    
                    <tr>
                    	<td class="color_gray">
                            Price per sqm. :
                        </td>
                        <td>
							P <?=string_amount($_VIEW['lot_price'])?> / sqm.
                        </td>
                        <td class="color_gray">
                            Lot Contract Price:
                        </td>
                        <td>P <?=string_amount($_VIEW['lot_price'] * $_VIEW['lot_area'])?></td>
                        
                        
                    </tr>         
                    
                    <tr>
                    	<td class="color_gray">
                            House Contract Price :
                        </td>
                        <td>
							P <?=string_amount($_VIEW['house_price'])?>
                        </td>
                        
                        <td class="color_gray">
                            Classification:
                        </td>
                        <td>  <?=(($_VIEW['option_house_classification_name']) ? $_VIEW['option_house_classification_name'] : 'none')?></td>
                        
                        
                    </tr>  
                    <tr>
                        <td class="color_gray">
                            Lot Status :
                        </td>
                        <td>
                            <div class="status <?=$_VIEW['option_availability_bullet']?>" style="float:left; margin:5px 10px 0 0;"></div>
                            <span class="float_left <?=$_VIEW['option_availability_class']?>"><?=$_VIEW['option_availability_name']?></span>          <!-- options: available, sold, reserved, on-hold, earnest, packaged -->
                            <label></label>
                        </td>  
                       <td class="color_gray" colspan="1">
                            Unit Type : 
                        </td>
                        <td colspan="3">
                            <?=$_VIEW['option_unit_name']?>
                        </td>                         
                    </tr> 
                    
                                  
                    
                                  
                </table>
            </div>   
        </div>    
    </div>
    <label></label>
</div>


