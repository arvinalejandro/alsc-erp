<div id="content_body">    
       
       <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/engineering/lot/package_setting/&id=<?=$_VIEW['lot_id']?>" method="post" name="alsc_form">
           		<input type="hidden" value="<?=$_VIEW['']?>" name="id" />
                
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="2">Water Provision</td>
                        </tr>
                    </thead> 
                    
                    <tr>
                        <td class="color_gray">
                           Meter Number:
                        </td>
                        <td>
                        	<div class="details"><input type="text" name="" /></div>                    
                        </td>
                    </tr>       
                    
                     <tr>
                        <td class="color_gray">
                           Date Started:
                        </td>
                        <td>
                        	<div class="details"><input type="text" name="" /></div>                    
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                           Date Completed:
                        </td>
                        <td>
                        	<div class="details"><input type="text" name="" /></div>                    
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                           Meter Reading Date:
                        </td>
                        <td>
                        	<div class="details"><input type="text" name="" /></div>                    
                        </td>
                    </tr>
                    
                     <tr>
                        <td class="color_gray">
                           Status:
                        </td>
                        <td>
                        	<select name="" style="width: 100%;">
	                            <option value="0"></option>
	                            	                            	
	                        </select>                       
                        </td>
                    </tr>
                    
                    <tr>
                    <td>Comment :</td>
                    <td colspan="3"><textarea name="" style="height:100px; width: 100%;"></textarea></td>
                </tr>
                    
                    
                    
                    <tr valign="middle">
	                       <td colspan="2" align="center">                  		
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


