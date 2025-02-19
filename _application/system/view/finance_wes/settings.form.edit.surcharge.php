<div id="content_body">    
       
      <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/finance_wes/settings/submit_edit_surcharge/" method="post" name="alsc_form">
              
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="2">Edit Surcharge</td>
                        </tr>
                    </thead>        
                    
                    <tr>
                        <td class="color_gray">
                            Surcharge Amount:
                        </td>
                        <td>
                        	<input  type="text"  name="sys[int][surcharge]" value="<?=string_amount($_VIEW['surcharge'])?>">                      
                        </td>
                    </tr>
                    
                  
                     <tr>
                        <td class="color_gray">
                            Vat Rate:
                        </td>
                        <td>
                        	<input  type="text" name="sys[int][vat_rate]" value="<?=string_amount($_VIEW['vat_rate'])?>">                      
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td class="color_gray" colspan="2" align="left">
                            Water Billing Announcement:
                        </td>
                      
                    </tr>
                    
                     <tr>
                        <td class="color_gray" colspan="2" >
                           <textarea style="width: 100%; height: 180px;" name="ann[water_announcement]"><?=$_VIEW['water_announcement']?></textarea>
                        </td>
                       
                    </tr>
                    
                    <tr>
                        <td class="color_gray" colspan="2" align="left">
                            Electric Billing Announcement:
                        </td>
                      
                    </tr>
                    
                     <tr>
                        <td class="color_gray" colspan="2" >
                           <textarea style="width: 100%; height: 180px;" name="ann[electric_announcement]" ><?=$_VIEW['electric_announcement']?></textarea>
                        </td>
                       
                    </tr>
                    
                    
                    
                    <tr valign="middle">
	                       <td colspan="2" align="center">                  		
                       			<div class="content_block_vpad"> 
                       			    <a href="/finance_wes/settings/surcharge/" class="link_button_inline red">Cancel</a>                      				
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


