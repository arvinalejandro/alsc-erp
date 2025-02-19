

<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
               Electric Account Reading Profile
            </b>

            <label></label>
        </div> 
    	 
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                <table width="100%" cellpadding="5" cellspacing="0" border="0" style="font-weight:normal; margin-top:10px;" class="mar_custom">                    
                    <thead><tr><td colspan="4"><b style="font-size: 12px;">Account Details</b></td></tr></thead>
                    <tr>
                        <td class="color_gray">Full Name:</td>
                        <td><?=$_VIEW['client_name']?>  <?=$_VIEW['client_surname']?></td>
                        <td class="color_gray">Account Number</td>
                        <td><?=$_VIEW['client_account_number']?></td>
                    </tr> 
                    <tr>
                        <td class="color_gray">
                            Account Status:
                        </td>
                        <td>
                            <?=$_VIEW['lot_wes_status_name']?>
                        </td>
                        <td class="color_gray">
                           
                        </td>
                        <td>
                           
                        </td>
                    </tr>
                      <tr>
                        <td class="color_gray">
                            Project:
                        </td>
                        <td>
                            <?=$_VIEW['project_name']?>
                        </td>
                        <td class="color_gray">
                            Phase:
                        </td>
                        <td>
                            <?=$_VIEW['project_name']?> - <?=$_VIEW['project_site_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Block:
                        </td>
                        <td>
                            <?=$_VIEW['project_site_block_name']?>
                        </td>
                        <td class="color_gray">
                            Lot Number:
                        </td>
                        <td>
                            <?=$_VIEW['lot_name']?>
                        </td>
                    </tr>   
                    <tr>
                        <td class="color_gray">
                            Meter Number:
                        </td>
                        <td>
                            <?=$_VIEW['lot_wes_meter_number']?>
                        </td>
                        <td class="color_gray">
                            SIN:
                        </td>
                        <td>
                            <?=$_VIEW['lot_wes_sin_number']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                           Previous Meter Reading:
                        </td>
                        <td>
                            <?=$_VIEW['lot_wes_prev_reading']?>
                        </td>
                        <td class="color_gray">
                            Current Meter Reading:
                        </td>
                        <td>
                            <?=$_VIEW['lot_wes_curr_reading']?>
                        </td>
                    </tr>
                    
                     <tr>
                        <td class="color_gray">
                            Reading Status:
                        </td>
                        <td>
                            <?=$_VIEW['lot_wes_reading_status_name']?>
                        </td>
                        <td class="color_gray">
                             Reading Date:
                        </td>
                        <td>
                            <?=string_date($_VIEW['lot_wes_reading_date'])?>
                        </td>
                    </tr>
                   
                       <thead><tr><td colspan="4"><b style="font-size: 12px;">Payment Details</b></td></tr></thead>
                   <tr>
                        <td class="color_gray">
                            Receipt Number:
                        </td>
                        <td>
                            <?=$_VIEW['lwar']['lot_wes_account_receive_receipt']?>
                        </td>
                        <td class="color_gray">
                             Payee:
                        </td>
                        <td>
                            <?=$_VIEW['lwar']['lot_wes_account_receive_payee']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Receipt Type:
                        </td>
                        <td>
                            <?=$_VIEW['lwar']['option_payment_receipt_name']?>
                        </td>
                        <td class="color_gray">
                             Payment Method:
                        </td>
                        <td>
                             <?=$_VIEW['lwar']['option_payment_method_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                           Status:
                        </td>
                        <td>
                             <?=$_VIEW['lwar']['option_payment_status_name']?>
                        </td>
                        <td class="color_gray">
                             Amount Received:
                        </td>
                        <td>
                            <?=$_VIEW['lwar']['amount_receive']?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                           Received By:
                        </td>
                        <td>
                            <?=$_VIEW['lwar']['user_']?>
                        </td>
                        <td class="color_gray">
                             Date Received:
                        </td>
                        <td>
                             <?=$_VIEW['lwar']['receive_date']?>
                        </td>
                    </tr>
                </table> 
            </div>  
        </div>    
    </div>
    <label></label>
</div>


