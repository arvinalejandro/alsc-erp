<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
      <div style="overflow: auto;" id="_right_content_"> 
           	<form action="/edp_cms/edp_cms_rate/submit" method="post" name="alsc_form">
           		<input type="hidden" value="<?=$_VIEW['rate_id']?>" name="id" />
	            <table class="mar_custom pad_standard" style="margin-bottom:20px;" width="80%" cellpadding="5" cellspacing="0" border="0">	                    
	                    <tr valign="middle">
	                        <td width="20%">
	                            Interest Structure Name
	                        </td>
	                        <td>
	                            <input type="text" name="str[rate_name]" value="<?=$_VIEW['rate_name']?>"  />
	                        </td>
	                        <td></td>
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
	                    
	                    <tr valign="middle">
	                        <td width="20%"> 
	                            Down Payment Options
	                        </td>
	                        <td>
	                          <select name="int[rate_dp_id]">
                           			<?=$_VIEW['rate_dp']?>                           		
	                           </select>
	                        </td>
	                        <td></td>
	                        <td>
	                            <span class="msg important">
	                               
	                            </span>    
	                        </td>
	                    </tr>       
	                    <tr valign="middle">
	                       <td colspan="4" align="center">                  		
                       			<div class="content_block_vpad">                       				
                       				<a href="/edp_cms/edp_cms_rate" class="link_button_inline red">Cancel</a>
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


