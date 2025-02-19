
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
               <?=$_VIEW['project_name']?> :  <?=$_VIEW['house_name']?>
            </b>

            <label></label>
        </div> 
    	
        <!---------- CONTENT CONTROLLERS ----------->         
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                <table width="100%" cellpadding="3" cellspacing="0" border="0" style="font-weight:normal;">
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
                            <?=$_VIEW['house_name']?>
                        </td>
                        <td class="color_gray">
                            Acronym:
                        </td>
                        <td>
                             <?=$_VIEW['house_acronym']?>
                        </td>                        
                    </tr> 
                    <tr>
                       <td class="color_gray">
                            House Contract Price:
                        </td>
                        <td>
                            P  <?=string_amount($_VIEW['house_price'])?>
                        </td>
                        <td class="color_gray">
                            Floor Area:
                        </td>
                        <td>
                             <?=$_VIEW['house_area']?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                           Price / sqm. :
                        </td>
                        <td>
                            P  <?=string_amount($_VIEW['house_price'] / $_VIEW['house_area'])?> / sqm
                        </td>
                        <td class="color_gray">
                            Classification:
                        </td>
                        <td>
                             <?=$_VIEW['option_house_classification_name']?>
                        </td>
                    </tr>           
                                                     
                     
                                                                          
                </table>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


