<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                 Create Job Order
            </b>

            <label></label>
        </div> 
        
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
               <form action="/engineering_wes/electric_account/submit_create_job_order/" method="post" name="alsc_form">
                <input type="hidden" name="lot_wes_job_order[int][lot_wes_id]" value="<?=$_VIEW['lot_wes_id']?>">
              
                <table width="70%" cellpadding="5" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">
                    <thead>
                        <tr>
                            <td colspan="5">Job Order Details</td>
                        </tr>
                    </thead> 
                    <tr>
                        <td class="color_gray">Type:</td>
                        <td colspan="3"> 
                          <select name="lot_wes_job_order[str][lot_wes_job_order_type_id]" style="width: 100%;">
                          	<?=$_VIEW['job_type']?>
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
                    		<input type="hidden" name="remark[str][remark_key]" value="lot_wes_job_order" />	                              
                            <textarea id="remark_area" name="remark[textarea][remark_content]" style="height: 150px; width:100%;" ></textarea>
                    	</td>
                    </tr>
                    <tr>
                       
                        <td colspan="5" align="center">                		
                       			<div class="content_block_vpad">                       				
                       				<a class="link_button_inline blue" onclick="submit_form('alsc_form')" >Submit</a>
                       			</div>               
	                    </td>
                    </tr> 
                </table> 
                <label style="margin-top:40px;"></label>
                
            </form>
            <label></label> 
      </div>    
    </div>
    <label></label>
</div>
