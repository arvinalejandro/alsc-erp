
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                Grand Royale
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
                            House Code/Type                   
                        </td>
                        <td>
                        	House Model Name
                        </td>                        
                        <td>
                            Acronym
                        </td> 
                        <td>
                            Floor Area
                        </td> 
                        <td>
                            Classification
                        </td>              
                    </tr>
                </thead>
                <tbody>
                	<?=$_VIEW['row.user.report']?>     
                	<tr>
					    <td width="10%">
					        <div class="details">
					            152
					        </div>
					    </td>
					    <td>
					        <div class="details">
					           Casa Amanda
					        </div>
					    </td> 
					    
					    <td align="">
					        <div class="details">
					            CSM
					        </div>
					    </td>
					    <td align="">                             
					        <div class="details">
					            134.5
					        </div>
					    </td>   
					    <td align="">                             
					        <div class="details">
					            Two-Storey
					        </div>
					    </td>                     
					</tr>
					<tr>
					    <td width="10%">
					        <div class="details">
					            158
					        </div>
					    </td>
					    <td>
					        <div class="details">
					            Casa Ana
					        </div>
					    </td> 
					    
					    <td align="">
					        <div class="details">
					            CSA
					        </div>
					    </td>
					    <td align="">                             
					        <div class="details">
					            156.5
					        </div>
					    </td>   
					    <td align="">                             
					        <div class="details">
					            Bungalow 
					        </div>
					    </td>                     
					</tr>  
                                 
                </tbody>  
            </table>
            <label></label>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


