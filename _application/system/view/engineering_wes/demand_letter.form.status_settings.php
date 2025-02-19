<div id="content_body">    
       
      <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/engineering_wes/demand_letter/submit_status_settings/" method="post" name="alsc_form">
           		<input type="hidden" value="<?=$_VIEW['lot_wes_reading_id']?>" name="lot_wes_reading_id" />
                
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="2">Set Demand Letter Status</td>
                        </tr>
                    </thead>        
                    <tr>
                        <td class="color_gray">
                            Status:
                        </td>
                        <td>
                        	<select id="c_status" name="lot_wes_reading[str][lot_wes_demand_letter_status_id]" style="width: 100%;">
	                            	 <?=$_VIEW['reading_status']?>                            	
	                        </select>                       
                        </td>
                    </tr>
                    
                    
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Remarks:</b></td>
                        </tr>
                    </thead>
                    
                    <tr>
                    	<td colspan="4">
                    		<input type="hidden" name="remark[str][remark_key]" value="lot_wes_reading" />	                              
                            <textarea id="remark_area" name="remark[textarea][remark_content]" style="height: 150px; width:100%;" ></textarea>
                    	</td>
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
