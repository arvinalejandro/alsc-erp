
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
              Earnest : Block <?=$_VIEW['project_site_block_name']?> Lot <?=$_VIEW['lot_name']?>, <?=$_VIEW['project_name']?> <?=$_VIEW['project_site_name']?> 
            </b>

            <label></label>
        </div> 
        
        <!---------- CONTENT CONTROLLERS ----------->         
        
        <div style="overflow: auto;" id="_right_content_">
           	
            	
            	            	
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <td>Client Name</td>
                            <td>Unit Type</td>
                            <td>Account Type</td>
                            <td>Account Status</td>
                            <td>TCP Amount</td>                           
                            <td>Paid-up Amount</td>
                            <td>Date of Sale</td>                                                                
                                                                                 
                        </tr>
                    </thead>
                    <tbody>
                        <?=$_VIEW['row']?>                       
                    </tbody>  
                </table>
               
        </div>
            
    </div>
    <label></label>
</div>


