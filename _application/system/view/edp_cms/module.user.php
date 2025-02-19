
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                 Module - <?="{$_VIEW['module_name']}"?>
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
                            Employee Name                           
                        </td>
                        <td>
                        	Granted By
                        </td>
                        <td>
                        	Date Granted
                        </td>
                        <td width="10%">                            
                        </td>
                                             
                    </tr>
                </thead>
                <tbody>                	
                    <?=$_VIEW['row.module.user']?>                  
                </tbody>  
            </table>
            <label></label>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


