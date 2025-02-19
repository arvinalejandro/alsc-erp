        
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
               101-001-005-115 : 47/120 : Dela Cruz, Juan
            </b>

            <label></label>
        </div> 
        
        <!---------- CONTENT CONTROLLERS ----------->         
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">           	
                
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                    <thead>
                        <tr>                        	
                            <td>Demand Letter</td>                                                     
                        </tr>
                    </thead>
                    
                    <tbody>            
                    
                    	<tr>	
                    		<td>
                    			
                    				<div>                    					
                    					<?=$_VIEW['account_letter']['account_letter_content']?>                    				
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


<script type="text/javascript">
   
   GLOBALS.events.add('onload', function() { GLOBALS.mce() } )
    
</script>