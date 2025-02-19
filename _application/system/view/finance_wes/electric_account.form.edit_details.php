<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                 Edit Account Details
            </b>

            <label></label>
        </div> 
        
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
               <form action="/finance_wes/electric_account/submit_edit_account_details/" method="post" name="alsc_form">
                <input type="hidden" name="lot_wes_id" value="<?=$_VIEW['lot_wes_id']?>">
              
                <table width="98%" cellpadding="5" cellspacing="0" border="0" style="font-weight:normal;" class="mar_standard">
                    <thead>
                        <tr>
                            <td colspan="5">Account Details</td>
                        </tr>
                    </thead> 
                           
                    <tr>
                        <td>SIN:</td>
                        <td> <div class="details"><input type="text"name="lot_wes[str][lot_wes_sin_number]" value="<?=$_VIEW['lot_wes_sin_number']?>" /></div></td>
                        <td width="20"></td>
                        <td>Sub-meter Number:</td>
                        <td> <div class="details"><input type="text" name="lot_wes[str][lot_wes_meter_number]" value="<?=$_VIEW['lot_wes_meter_number']?>" /></div></td>                        
                    </tr> 
                    <tr>
                        <td>Reading Start Date:</td>
                        <td> <div class="details"><input type="text" class="_date_" name="lot_wes[int][lot_wes_date_start]" value="<?=string_date($_VIEW['lot_wes_date_start'])?>" /></div></td>
                        <td width="20"></td>
                        
                        <td>Initial Meter Reading:</td>
                        <td><input type="text" name="lot_wes[int][lot_wes_meter_reading]" value="<?=$_VIEW['lot_wes_meter_reading']?>" /> </td>
                    </tr>
                    <tr>
                       
                         <td>Account Status:</td>
                        <td> 
                          <select name="lot_wes[str][lot_wes_status_id]">
                          	<?=$_VIEW['status_list']?>
                          </select>
                        </td>
                        <td width="20"></td>
                       
                         <td>Account Rate:</td>
                        <td><select name="lot_wes[int][option_wes_electric_rate_id]">
                          	<?=$_VIEW['option_rate']?>
                          </select></td>
                    </tr>
                     <tr>
                       
                        <td>Bill Duration:</td>
                        <td><select name="lot_wes[str][lot_wes_bill_duration_id]">
                          	<?=$_VIEW['bill_duration']?>
                          </select>
                        </td>
                        <td width="20"></td>
                       
                         <td></td>
                        <td></td>
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
