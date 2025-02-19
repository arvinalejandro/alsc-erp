<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            <a class="link_button_inline float_left _control gray" id="_investment" style="margin-left:5px;">House Model ></a>
            <a class="link_button_inline float_left _control blue" id="_client" style="margin-left:5px;">Package Setting ></a>                 
            <a class="link_button_inline gray float_left gray" style="margin-left:5px;">Submit</a> 
            <label></label> 
        </div> 
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/edp_inventory/edp_inventory_lot/submit_package" method="post" name="alsc_form">
           		<input type="hidden" name="id" value="<?=$_VIEW['lot_id']?>" />           		
           		<input type="hidden" name="lot[int][house_id]" value="<?=$_VIEW['house']['house_id']?>" />
           		<input type="hidden" name="lot[str][option_unit_id]" value="package" />          		
           		<input type="hidden" name="lot_construction[int][lot_id]" value="<?=$_VIEW['lot_id']?>" />
           		<input type="hidden" name="lot_construction[int][house_id]" value="<?=$_VIEW['house']['house_id']?>" />
           		<input type="hidden" name="lot_construction[str][option_unit_construction_id]" value="house" />
           		<input type="hidden" name="lot_construction[int][user_id]" value="<?=$_VIEW['user_id']?>" />
           		
           		
                
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top:20px;" align="center">
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
                            Project Site:
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
                            Lot Area:
                        </td>
                        <td><?=$_VIEW['lot_area']?> sqm.</td>                        
                        <td class="color_gray">
                            Price per sqm. :
                        </td>
                        <td>
							P <?=string_amount($_VIEW['lot_price'])?> / sqm.
                        </td>
                    </tr>
                    <tr>                    	
                        
                        <td class="color_gray">
                            Lot Contract Price:
                        </td>
                        <td>P <?=string_amount($_VIEW['lot_price'] * $_VIEW['lot_area'])?></td>
                        <Td></td>
                        <Td></td>
                    </tr>     
                    
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">House Details</b></td>
                        </tr>
                    </thead>
                    
                    <tr>
                        <td class="color_gray">
                            Project:       
                        </td>
                        <td>
                        	 <?=$_VIEW['project_name']?>
                        </td>         
                        <td></td>               
                        <td></td>               
                    </tr>
                    
                    <tr>
                    	<td class="color_gray" width="15%">
                            House Name:
                        </td>
                        <td width="25%">
                            <?=$_VIEW['house']['house_name']?>
                        </td>
                        <td class="color_gray">
                            Acronym:
                        </td>
                        <td>
                             <?=$_VIEW['house']['house_acronym']?>
                        </td>                        
                    </tr> 
                    <tr>
                       <td class="color_gray">
                            House Contract Price:
                        </td>
                        <td>
                            P  <?=string_amount($_VIEW['house']['house_price'])?>
                        </td>
                        <td class="color_gray">
                            Floor Area:
                        </td>
                        <td>
                             <?=$_VIEW['house']['house_area']?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                           Price / sqm. :
                        </td>
                        <td>
                            P  <?=string_amount($_VIEW['house']['house_price'] / $_VIEW['house']['house_area'])?> / sqm
                        </td>
                        <td class="color_gray">
                            Classification:
                        </td>
                        <td>
                             <?=$_VIEW['house']['option_house_classification_name']?>
                        </td>
                    </tr>                             
                    
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">House Settings</b></td>
                        </tr>
                    </thead>     
                    
                    <tr>
                        <td class="color_gray">
                            Contractor:
                        </td>
                        <td>
                        	<select name="lot_construction[str][option_unit_contractor_id]" style="width: 90%;">
	                            <option value="0"></option>
	                            <?=$_VIEW['option_unit_contractor']?>	                            	
	                        </select>
                        </td>
                        
                        <td class="color_gray">
                            Status :
                        </td>
                        <td>
							<select name="lot_construction[str][option_unit_status_id]" style="width: 90%;">
	                            <option value="0"></option>
	                            <?=$_VIEW['option_unit_status']?>                            		                            	
	                        </select>
                        </td>
                    </tr>
                    
                                        
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Availability Settings</b></td>
                        </tr>
                    </thead>
                                         
                    
                    <tr valign="middle">
	                   <td>Total Contract Price</td>
	                    <td>
	                        <span class="msg">
	                            <b>P <?=string_amount($_VIEW['tcp'])?>  </b> 
	                        </span>    
	                    </td>
	                    <td></td>
	                    <td></td>
	                </tr>
	                
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Remarks</b></td>
                        </tr>
                    </thead>
                    
                    <tr>
                    	<td colspan="4">
                    		<input type="hidden" name="remark[str][remark_key]" value="lot" />	                              
                            <textarea name="remark[textarea][remark_content]" style="height: 150px; width:100%;" ></textarea>
                    	</td>
                    </tr>
	                  
	                <tr valign="middle">
	                   <td colspan="4" align="center">                  		
                       		<div class="content_block_vpad">                       				
                       			<?php
                       				#$id		=	$_VIEW['lot_id'] * 1;
                       				$link	=	 "/edp_inventory/edp_inventory_lot/package_house/&id={$_GET['id']}";
                       				
                       			?>
                       			<a href="/edp_inventory/edp_inventory_lot" class="link_button_inline red">Cancel</a>
                       			<a href="<?=$link?>" class="link_button_inline gray">Back</a>
                       			<a class="link_button_inline blue" onclick="submit_form('alsc_form')" >Submit</a>
                       		</div>               
	                   </td>
	                </tr>                   
                </table>      
                
	            
            </form>
            <label></label>
                
            
            
        </div>    
    </div>
    <label></label>
</div>


