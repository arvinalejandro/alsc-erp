
<div id="content_body">    
    
   
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                <?=$_VIEW['project_name']?> : Update Phase Codes
            </b> 

            <label></label>
        </div> 
    	
        <!---------- CONTENT CONTROLLERS ----------->        
        
       <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
	            <form action="/edp_inventory/edp_inventory_project/edit_code_submit" method="post" name="alsc_form">
	            	<input type="hidden" name="user_id" value="<?=$_VIEW['_user_']['user_id']?>" />
	            	<input type="hidden" name="project_id" value="<?=$_VIEW['project_id']?>" />
	                <table class="mar_custom" width="70%" cellpadding="5" cellspacing="0" border="0" align="center">
		                <thead>
		                    <tr>
		                        <td width="35%">Phase</td>                        
		                        <td width="65%">Phase Code</td>                                    
		                    </tr>
		                </thead>
		                <tbody>
                			<?=$_VIEW['row.form.project.site']?>    
                			<tr>
		                        <td colspan="2" align="center">
                        			<a class="link_button_inline red" href="/edp_inventory/edp_inventory_project/site/&id=<?=$_VIEW['project_id']?>">Close</a>
                        			<a class="link_button_inline blue" onclick="submit_form('alsc_form')">Save</a>
		                        </td>                       
		                                                     
		                    </tr>
                			                           
		                </tbody>  
	                 
            		</table>
	            </form>
            	<label></label>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


