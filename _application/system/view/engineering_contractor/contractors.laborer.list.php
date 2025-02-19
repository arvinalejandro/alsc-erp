
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
              Laborer List
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
                            Name                 
                        </td>
                        <td>
                            Gender              
                        </td>
                        <td>
                           Contact Number                 
                        </td>
                        <td>
                            Address                 
                        </td>
                         <td>
                            Status
                        </td> 
                                     
                        <td width="10%"></td> 
                       </tr>
                    </thead>
                <tbody>
                	<?=$_VIEW['laborer_list']?>                   
                </tbody>  
            </table>
            <label></label>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


