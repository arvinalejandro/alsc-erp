<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                 Casa Royale 1 - Block 1 Lot 1 
            </b>

            <label></label>
        </div> 
        
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
               <form action="/engineering_wes/lot/submit_add_electric_provision/" method="post" name="alsc_form">
                <input type="hidden" name="lot_wes[int][lot_id]" value="<?=$_VIEW['lot_id']?>">
                 <input type="hidden" name="lot_wes[str][lot_wes_type]" value="electric">
                 <input type="hidden" name="lot_wes[str][lot_wes_status_id]" value="pending">
                <table width="98%" cellpadding="5" cellspacing="0" border="0" style="font-weight:normal;" class="mar_standard">
                    <thead>
                        <tr>
                            <td colspan="5">Add New Electricity Details</td>
                        </tr>
                    </thead> 
                           
                    <tr>
                        <td>SIN:</td>
                        <td> <div class="details"><input type="text"name="lot_wes[str][lot_wes_sin_number]" /></div></td>
                        <td width="20"></td>
                        <td>Sub-meter Number:</td>
                        <td> <div class="details"><input type="text" name="lot_wes[str][lot_wes_meter_number]" /></div></td>                        
                    </tr> 
                    <tr>
                        <td>Reading Start Date:</td>
                        <td> <div class="details"><input type="text" class="_date_" name="lot_wes[int][lot_wes_date_start]" /></div></td>
                        <td width="20"></td>
                        <td>Initial Meter Reading:</td>
                        <td><input type="text" name="lot_wes[int][lot_wes_meter_reading]" /> </td>
                    </tr>
                    
                    <tr>
                        <td>Account Rate:</td>
                        <td> 
                          <select name="lot_wes[int][option_wes_electric_rate_id]">
                          	<?=$_VIEW['option_rate']?>
                          </select>
                        </td>
                        <td width="20"></td>
                       <td>Bill Duration:</td>
                        <td><select name="lot_wes[str][lot_wes_bill_duration_id]">
                          	<?=$_VIEW['bill_duration']?>
                          </select>
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
