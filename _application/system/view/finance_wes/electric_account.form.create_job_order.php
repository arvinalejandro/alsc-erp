<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                 Create Job Order
            </b>

            <label></label>
        </div> 
        
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
               <form action="/finance_wes/electric_account/submit_create_job_order/" method="post" name="alsc_form">
                <input type="hidden" name="lot_wes_job_order[int][lot_wes_id]" value="<?=$_VIEW['lot_wes_id']?>">
              
                <table width="98%" cellpadding="5" cellspacing="0" border="0" style="font-weight:normal;" class="mar_standard">
                    <thead>
                        <tr>
                            <td colspan="5">Job Order Details</td>
                        </tr>
                    </thead> 
                    <tr>
                        <td>Type</td>
                        <td> 
                          <select name="lot_wes_job_order[str][lot_wes_job_order_type_id]">
                          	<?=$_VIEW['job_type']?>
                          </select>
                        </td>
                        <td width="20"></td>
                        <td></td>
                        <td> 
                          
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
