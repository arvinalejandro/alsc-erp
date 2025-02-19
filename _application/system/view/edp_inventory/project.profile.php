
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                <?=$_VIEW['project_name']?>
            </b>

            <label></label>
        </div> 
    	
        <!---------- CONTENT CONTROLLERS ----------->        
          
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                <table width="100%" cellpadding="3" cellspacing="0" border="0" style="font-weight:normal;">
                    <thead><tr><td colspan="4"><b style="font-size: 12px;">Project Details</b></td></tr></thead>
                    
                    <tr>
                        <td class="color_gray" width="15%">
                            Project Code:
                        </td>
                        <td width="25%">
                           	<?=$_VIEW['project_code']?>
                        </td>
                        <td class="color_gray" width="15%">
                            Project Name:
                        </td>
                        <td width="25%">
                            <?=$_VIEW['project_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Acronym:
                        </td>
                        <td>
                            <?=$_VIEW['project_acronym']?> 
                        </td>
                        <td class="color_gray">
                            
                        <td>
                            
                        </td>
                    </tr>
                         
                    
                    <thead><tr><td colspan="4"><b style="font-size: 12px;">Project Statistics</b></td></tr> </thead>
                    
                    <tr>
                        <td class="color_gray">
                            Total Phases
                        </td>
                        <td>
                            <?=$_VIEW['project_site_count']?>
                        </td>
                        <td class="color_gray">
                            Total Block
                        </td>
                        <td>
                            <?=$_VIEW['project_site_block_count']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Total Lot:       
                        </td>
                        <td>
                        	<?=$_VIEW['lot_count']?>
                        </td>
                        <td class="color_gray">
                            Unsold Lot :
                        </td>
                        <td>
                            <?=$_VIEW['lot_available_count']?>
                        </td>
                    </tr>                                     
                </table>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


