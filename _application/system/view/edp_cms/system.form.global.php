<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/edp_cms/edp_cms_system/submit" method="post" name="alsc_form">
           		<input type="hidden" value="<?=$_VIEW['sysglobal_id']?>" name="id" />
           		<input type="hidden" value="<?=$_VIEW['_user_']['user_id']?>" name="user_id" />
	            <table class="mar_custom pad_standard" style="margin-bottom:20px;" width="80%" cellpadding="5" cellspacing="0" border="0">
	                    <thead>
                            <tr valign="middle">
                               <td colspan="4">Surcharge</td>
                            </tr>
                        </thead>
                        
	                    <tr valign="middle">
	                        <td width="20%">
	                           Surcharge Rate  (%)
	                        </td>
	                        <td>
	                        	<span>( (Monthly Due * Surcharge Rate) / 360 ) * # of days</span>
	                            <input type="text" name="int[surcharge_rate]" value="<?=$_VIEW['surcharge_rate']?>"  />
	                        </td>
	                        <td></td>
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
                        
                        <thead>
                            <tr valign="middle">
                               <td colspan="4">Earnest</td>
                            </tr>
                        </thead>
	                    <tr valign="middle">
	                        <td width="20%">
	                           Earnest Duration (days)
	                        </td>
	                        <td>
	                        	<span># of days for earnest effectivity</span>
	                            <input type="text" name="int[earnest_duration]" value="<?=$_VIEW['earnest_duration']?>"  />
	                        </td>
	                        <td></td>
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
	                    
	                    <tr valign="middle">
	                        <td width="20%">
	                           Tax Rate
	                        </td>
	                        <td>
	                        	<span># Tax Multiplier</span>
	                            <input type="text" name="int[earnest_duration]" value="10.714"  />
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
                       				
                       				<a href="/edp_cms/edp_cms_system" class="link_button_inline red">Close</a>
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


