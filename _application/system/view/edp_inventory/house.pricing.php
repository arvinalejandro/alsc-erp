
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                <?=$_VIEW['house_name']?> - <?=$_VIEW['house_code']?>
            </b>

            <label></label>
        </div> 
    	
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                    <tr> 
                        <td>
                            House Contract Price                          
                        </td>
                        <td>
                            Floor Area 
                        </td>                        
                        <td>
                        	Changed By
                        </td>                        
                        <td>
                            Date Changed
                        </td>                                    
                    </tr>
                </thead>
                <tbody>
                	<?=$_VIEW['row.house.price']?>                           
                </tbody>  
            </table>
            <label></label>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


 