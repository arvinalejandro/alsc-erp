<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            <a class="link_button_inline float_left _control blue" id="_investment" style="margin-left:5px;">House Model ></a>
            <a class="link_button_inline float_left _control gray" id="_client" style="margin-left:5px;">Package Setting ></a>                 
            <a class="link_button_inline gray float_left gray" style="margin-left:5px;">Submit</a> 
            <label></label> 
        </div>
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/edp_inventory/edp_inventory_lot/package_setting/&id=<?=$_VIEW['lot_id']?>" method="post" name="alsc_form">
           		<input type="hidden" value="<?=$_VIEW['']?>" name="id" />
                
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="2">Set as Package</td>
                        </tr>
                    </thead>        
                    <tr>
                        <td class="color_gray">
                            House Model:
                        </td>
                        <td>
                        	<select name="int[house_id]" style="width: 100%;">
	                            <option value="0"></option>
	                            <?=$_VIEW['house']?>	                            	
	                        </select>                       
                        </td>
                    </tr> 
                    <!--
                    <tr>
                        <td class="color_gray">Location:</td>
                        <td><?=$_VIEW['project_name']?> <?=$_VIEW['project_site_name']?> - Block <?=$_VIEW['project_site_block_name']?> Lot <?=$_VIEW['lot_name']?></td>
                    </tr>  
                    <tr>
                        <td class="color_gray">
                            House Floor Area:
                        </td>
                        <td>
                            <?=string_amount($_VIEW['house_area'])?> sqm.                     
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            House Price / sqm:
                        </td>
                        <td>
                            P <?=string_amount($_VIEW['house_price'])?>                       
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            House Contract Price:
                        </td>
                        <td>
                            P <?=string_amount($_VIEW['house_price'])?>                          
                        </td>
                    </tr>  
                    <tr>
                        <td class="color_gray">
                            Classification:
                        </td>
                        <td>
                            <?=(($_VIEW['option_house_classification_name']) ? $_VIEW['option_house_classification_name'] : 'none')?>                     
                        </td>
                    </tr>   
                    -->
                                  
                    <tr valign="middle">
	                       <td colspan="2" align="center">                  		
                       			<div class="content_block_vpad">                       				
                       				<?php
                       					#$id		=	$_VIEW['lot_id'] * 1;
                       					$link	=	 "/edp_inventory/edp_inventory_lot";
                       					
                       				?>
                       				<a href="<?=$link?>" class="link_button_inline red">Cancel</a>
                       				<a class="link_button_inline blue" onclick="submit_form('alsc_form')" >Next</a>
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


