<div id="content_body">    
       
   <?=$_VIEW['side_nav']?>
       
    <div id="side_listings" style="margin-left:180px;">     
     
        <div style="overflow: auto;" id="_right_content_">                  
                                          
                <table width="90%" cellpadding="3" cellspacing="0" border="0" style="font-weight:normal; margin:20px auto;">
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Lot Details</b></td>
                        </tr>
                    </thead>
                    <tr>
                        <td class="color_gray" width="15%">
                            Lot Status:
                        </td>
                        <td width="35%">
                            <?=$_VIEW['option_availability_name']?> 
                        </td>
                        <td class="color_gray" width="15%">
                            Project Address:
                        </td>
                        <td width="35%">
                            
                            <?=$_VIEW['project_address']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Project Province:
                        </td>
                        <td>    
                            <?=$_VIEW['project_province']?>
                        </td>
                        <td class="color_gray">
                            Project Name :
                        </td>
                        <td>
                            <?=$_VIEW['project_name']?>
                        </td>
                    </tr>
                   
                     <tr>
                        <td class="color_gray">
                            Phase:
                        </td>
                        <td>    
                            <?=$_VIEW['project_acronym']?> -  <?=$_VIEW['project_site_name']?>
                        </td>
                        <td class="color_gray">
                            Block :
                        </td>
                        <td>
                            <?=$_VIEW['project_site_block_name']?>
                        </td>
                    </tr>
                   
                    <tr>
                        <td class="color_gray">
                          Lot Price (per sqm.)
                        </td>
                        <td>
                            P <?=$_VIEW['lot_price']?>
                        </td>
                        <td class="color_gray">
                            Lot Area :
                        </td>
                        <td>    
                            <?=$_VIEW['lot_area']?> sqm.
                        </td>
                    </tr>
                           
                                         
                </table>
                <label style="margin-bottom:20px;"></label>
                
                
               
            
            <label></label>                 
            
        </div>    
    </div>
    <label></label>

</div>