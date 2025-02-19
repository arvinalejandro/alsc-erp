<div id="content_body">    
       
    <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/engineering_contractor/laborers/submit_update_laborer/" method="post" name="alsc_form">
           	<input type="hidden" name="id" value="<?=$_VIEW['contractor_laborer_id']?>" />
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="4">Edit Laborer</td>
                        </tr>
                    </thead>        
                   <tr>
                        <td>First Name:</td>
                        <td>
                        	<div class="details"><input type="text" value="<?=$_VIEW['contractor_laborer_first_name']?>" name="laborer[str][contractor_laborer_first_name]" /></div>                    
                        </td>
                        <td>Last Name:</td>
                        <td>
                            <div class="details"><input type="text" value="<?=$_VIEW['contractor_laborer_last_name']?>" name="laborer[str][contractor_laborer_last_name]" /></div>                    
                        </td>
                    </tr>                  
                     <tr>
                        <td>Gender:</td>
                        <td>
                        	<select name="laborer[str][option_gender_id]" style="width: 100%;">
	                            <?=$_VIEW['laborer_gender']?>
	                        </select>                       
                        </td>
                        <td>Address:</td>
                        <td>
                            <div class="details"><input type="text" value="<?=$_VIEW['contractor_laborer_address']?>" name="laborer[str][contractor_laborer_address]" /></div>                    
                        </td>
                    </tr>
                    <tr>
                        <td>Contact Number:</td>
                        <td>
                        	<div class="details"><input type="text" value="<?=$_VIEW['contractor_laborer_contact_number']?>" name="laborer[str][contractor_laborer_contact_number]" /></div>                    
                        </td>
                        <td>Status:</td>
                        <td>
                        	<select name="laborer[str][option_contractor_laborer_status_id]" style="width: 100%;">
	                            <?=$_VIEW['laborer_status']?>
	                        </select>                       
                        </td>
                    </tr>
                     
                    
                    <tr valign="middle">
	                       <td colspan="4" align="center">                  		
                       			<div class="content_block_vpad">                       				
                       				<a class="link_button_inline blue" onclick="submit_form('alsc_form')" >Submit</a>
                       			</div>               
	                       </td>
	                    </tr>                             
                </table>      
                
	            
            </form>
            <label></label>
                
            
            
        </div>    
    </div>
    <label></label>
</div>


