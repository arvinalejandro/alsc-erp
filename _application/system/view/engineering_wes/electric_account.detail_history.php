
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                Details History
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
                            Meter Number                 
                        </td>
                        
                        <td align="center">
                           SIN Number
                        </td>
                         
                        <td align="center">
                            Account Status
                        </td>
                        
                         <td align="center">
                            Next Reading Date
                        </td>
                       
                        <td align="center">
                        	Changed By
                        </td>                        
                        <td align="center">
                            Date Changed
                        </td>                                    
                    </tr>
                </thead>
                <tbody>
                	   <?=$_VIEW['row.history']?>             
                </tbody>  
            </table>
            <label></label>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


