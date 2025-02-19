<div id="content_body">    
       
      <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/finance_wes/settings/submit_add_group/" method="post" name="alsc_form">
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="2">Add Charge Group</td>
                        </tr>
                    </thead>        
                    
                    <tr>
                        <td class="color_gray">
                            Group Name:
                        </td>
                        <td>
                        	<input  type="text"  name="group[str][option_wes_charge_group_name]" >                      
                        </td>
                    </tr>
                    
                  
                    
                    <tr valign="middle">
	                       <td colspan="2" align="center">                  		
                       			<div class="content_block_vpad"> 
                       			    <a href="/finance_wes/settings/other_charges/" class="link_button_inline red">Cancel</a>                      				
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


