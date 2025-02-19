<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/engineering/projects/submit_price" method="post" name="alsc_form">
           		<input type="hidden" value="<?=$_VIEW['project_id']?>" name="id" />
           		<input type="hidden" value="<?=$_VIEW['project_id']?>" name="int[project_id]" />
           		<input type="hidden" value="<?=$_VIEW['user_id']?>" name="int[user_id]" />
	            <table class="mar_custom pad_standard" style="margin-bottom:20px;" width="80%" cellpadding="5" cellspacing="0" border="0">	                    
	                <thead>
                        <tr>
                            <td colspan="4"><h1>Price Adjustment - <?=$_VIEW['project_name']?></h1></td>
                        </tr>
                    </thead>    
                    <tbody>
	                    <tr valign="middle">
	                        <td width="20%">
	                            Phase
	                        </td>
	                        <td>
	                            <select  name="int[project_site_id]">
	                            	<?=$_VIEW['project_site']?>
	                            </select>
	                        </td>
	                        <td></td>
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>       
                        
                        
                        
                        <tr valign="middle">
                            <td width="20%">
                                Operation
                            </td>
                            <td>
                                <select name="int[project_price_adjustment]">
                                    <option value="1">Increase Price</option>
                                    <option value="0">Decrease Price</option>
                                </select>
                            </td>
                            <td></td>
                            <td>
                                <span class="msg">
                                    
                                </span>    
                            </td>
                        </tr>
	                    
	                    <tr valign="middle">
	                        <td width="20%">
	                            Amount (PHP)
	                        </td>
	                        <td>
	                            <input type="text" name="int[project_price_value]"   />
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
                              <input type="hidden" name="remark[int][user_id]" value="<?=$_VIEW['user_id']?>" />	                              
                              <input type="hidden" name="remark[int][remark_key_id]" value="<?=$_VIEW['project_id']?>" />	                              
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
                       				<a href="/engineering/projects/profile/&id=<?=$_VIEW['project_id']?>" class="link_button_inline red">Cancel</a>
                       				<a class="link_button_inline blue" onclick="submit_form('alsc_form')">Save</a>
                       			</div>               
	                       </td>
	                    </tr>
                    </tbody>                  
	            </table>
            </form>
            <label></label>
                
            
            
        </div>    
    </div>
    <label></label>
</div>


