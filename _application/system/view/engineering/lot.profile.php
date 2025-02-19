

<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                <?=$_VIEW['project_name']?> <?=$_VIEW['project_site_name']?> - Block <?=$_VIEW['project_site_block_name']?> Lot <?=$_VIEW['lot_name']?>
            </b>

            <label></label>
        </div> 
    	 
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                <table width="100%" cellpadding="3" cellspacing="0" border="0" style="font-weight:normal;">
                    <thead><tr><td colspan="4"><b style="font-size: 12px;">Lot Details</b></td></tr></thead>
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
                            Lot:
                        </td>
                        <td>
                            <?=$_VIEW['lot_name']?>
                        </td>
                    </tr>
                    
                     <tr>
                        <td class="color_gray">
                            Lot Title Status:
                        </td>
                        <td>
                            <?=$_VIEW['title']['option_lot_title_status_name']?>
                        </td>
                        <td class="color_gray">
                             Name in Title:
                        </td>
                        <td>
                            <?=$_VIEW['title']['option_lot_title_name_name']?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                            Lot Status :
                        </td>
                        <td>                           
                            <?=$_VIEW['option_availability_name']?>                                 
                        </td>  
                       <td class="color_gray" colspan="1">
                            Type : 
                        </td>
                        <td colspan="3">
                            <?=$_VIEW['option_unit_name']?>
                        </td>                         
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Lot Area:
                        </td>
                        <td><?=$_VIEW['lot_area']?> sqm.</td>
                         <td class="color_gray">
                            Price per sqm.:
                        </td>
                        <td>
                            P <?=string_amount($_VIEW['lot_price'])?> / sqm.
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">Lot Property Status:</td>
                        <td><?=$_VIEW['option_lot_property_status_name']?></td>
                        <td class="color_gray">
                            Lot Contract Price:
                        </td>
                        <td>P <?=string_amount($_VIEW['lot_price'] * $_VIEW['lot_area'])?></td>
                    </tr>  
                    
                    

                    <thead><tr><td colspan="4"><b style="font-size: 12px;">House Details</b></td></tr></thead>
                    <tr>
                        <td class="color_gray">
                            House Model:
                        </td>
                        <td>
                            <?=(($_VIEW['house_name']) ? $_VIEW['house_name'] : 'none')?> 
                        </td>
                        <td class="color_gray">
                            Classification:
                        </td>
                        <td>  <?=(($_VIEW['option_house_classification_name']) ? $_VIEW['option_house_classification_name'] : 'none')?></td>
                    </tr>
                    <!--<tr>
                        <td class="color_gray">
                            House Status:
                        </td>
                        <td>
                            c/o Arnie
                        </td>
                        <td class="color_gray">
                            House Price per sqm:
                        </td>
                        <td><?=string_amount($_VIEW['house_price']) / ($_VIEW['house_area'])?></td>
                    </tr>--> 
                    <tr>
                        <td class="color_gray">
                            Floor Area :
                        </td>
                        <td>
                            <?=string_amount($_VIEW['house_area'])?> sqm.
                        </td>
                        <td class="color_gray">
                            House Contract Price :
                        </td>
                        <td>
                            P <?=string_amount($_VIEW['house_price'])?>
                        </td>
                    </tr>

                    
                    
                                           
                                    
                </table>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


