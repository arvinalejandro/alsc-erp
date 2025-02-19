<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/edp_inventory/edp_inventory_project/submit" method="post" name="alsc_form">
           		<input type="hidden" value="<?=$_VIEW['project_id']?>" name="id" />
	            <table class="mar_custom pad_standard" style="margin-bottom:20px;" width="80%" cellpadding="5" cellspacing="0" border="0">	
                    <thead>
                        <tr>
                            <td colspan="4">Create New Project</td> 
                        </tr>
                    </thead>                    
	                    <tr valign="middle">
	                        <td width="20%">
	                            Project Code
	                        </td>
	                        <td>
	                            <input type="text" name="str[project_code]" value="<?=$_VIEW['project_code']?>"  />
	                        </td>
	                        <td></td>
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
	                    
	                    <tr valign="middle">
	                        <td width="20%">
	                            Project Name
	                        </td>
	                        <td>
	                            <input type="text" name="str[project_name]" value="<?=$_VIEW['project_name']?>"  />
	                        </td>
	                        <td></td>
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
	                    
	                    <tr valign="middle">
	                        <td width="20%">
	                            Acronym
	                        </td>
	                        <td>
	                            <input type="text" name="str[project_acronym]" value="<?=$_VIEW['project_acronym']?>"  />
	                        </td>
	                        <td></td>
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
                        
	                    <tr valign="middle">
                            <td width="20%">
                               Remarks
                            </td>
                            <td>
                              <input type="hidden" name="remark[str][remark_key]" value="project" />	        
                              <input type="hidden" name="remark[int][remark_key_id]" value="<?=$_VIEW['project_id']?>" />                      
                              <input type="hidden" name="remark[int][user_id]" value="<?=$_VIEW['_user_']['user_id']?>" />                      
                              <textarea name="remark[textarea][remark_content]" style="height: 150px; width:100%;" ></textarea>
                            </td>    
                            <td></td>                  
                            <td>
                                <span class="msg">
                                    
                                </span>    
                            </td>
                        </tr>
	                       
	                       
	                    <tr valign="middle">
	                       <td colspan="4" align="center">                  		
                       			<div class="content_block_vpad">                       				
                       				<a href="/edp_inventory/edp_inventory_project/profile/&id=<?=$_VIEW['project_id']?>" class="link_button_inline red">Cancel</a>
                       				<a class="link_button_inline blue" onclick="submit_form('alsc_form')">Save</a>
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


