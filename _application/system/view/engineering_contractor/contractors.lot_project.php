
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
              Lot Projects
            </b>

            <label></label>
        </div> 
    	
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                    <thead>
                        <tr>   
                            <td>Project</td>
                            <td>Lot</td>
                            <td>Construction Type</td>
                            <td>Status</td> 
                            <td>Date Started</td>
                            <td>Date Completed</td>                        
                            <td>Estimated Cost</td>
                            <td>Actual Cost</td>              
                            <td width="10%"></td> 
                        </tr>    
                    </thead>
                    <tbody>
                        <?=$_VIEW['proj_list']?>                   
                    </tbody>  
                </table>
            <label></label>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


