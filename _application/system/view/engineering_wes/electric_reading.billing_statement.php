

<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">ELECTRIC BILLING STATEMENT</b>

        </div> 
    	 
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">  
                <table width="100%" cellpadding="10" cellspacing="0" border="0" style="min-width: 1000px;">
                    <tr>
                        <td class="border_top_gray" style="font-weight:normal;" colspan="2">
                            <b class="font_size_14">Announcement:</b> <!-- dynamic -->
                            <label></label>
                           <?=$_VIEW['sys_wes']['electric_announcement']?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table width="100%" cellpadding="5" cellspacing="0" border="0">
                                <tr class="selected">
                                    <td class="color_white" style="background-color:#555;">Account Number:</td>
                                    <td class="bg_fff"><?=$_VIEW['client_account_number']?></td>
                                    <td class="color_white" style="background-color:#555;">Current Amt Due:</td>
                                    <td>P <?=string_amount($_VIEW['lot_wes_reading_surcharge']+$_VIEW['lot_wes_reading_current_total'])?></td>
                                </tr>
                                <tr>
                                    <td class="color_white" style="background-color:#555;">Name:</td>
                                    <td class="bg_fff"><?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?></td>
                                    <td class="color_white" style="background-color:#555;">Billing Period:</td>
                                    <td class="bg_fff"><?=string_date($_VIEW['lot_wes_reading_from_date'])?> to <?=string_date($_VIEW['lot_wes_reading_date'])?></td>
                                </tr>
                                <tr>
                                    <td class="color_white" style="background-color:#555;">Service Address:</td>
                                    <td class="bg_fff">B<?=$_VIEW['project_site_block_name']?> L<?=$_VIEW['lot_name']?> <?=$_VIEW['project_name']?></td>
                                    <td class="color_white" style="background-color:#555;">Due Date:</td>
                                    <td class="bg_fff"><?=string_date($_VIEW['lot_wes_reading_due_date'])?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <table width="100%" cellpadding="5" cellspacing="0" border="0">     
                                <tr><td align="center" class="color_white" style="background-color:#555;">METERING INFORMATION</td></tr>
                                <tr>
                                    <td style="background-color:#eaeaea;">
                                        <table width="100%" cellpadding="5" cellspacing="0" border="0">
                                            <tr align="center" style="background-color: #fff;">
                                                <td>Sub-meter No.</td>
                                                <td>Prev Rdg.</td>
                                                <td>Pres Rdg.</td>
                                                <td>Consumed</td>
                                            </tr>
                                            <tr align="center" style="background-color: #fff;font-weight:normal;">
                                               <td><?=$_VIEW['lot_wes_meter_number']?></td>
                                                <td><?=$_VIEW['lot_wes_prev_reading']?></td>
                                                <td><?=$_VIEW['lot_wes_curr_reading']?></td>
                                                <td><?=$_VIEW['lot_wes_reading_consumed']?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <label></label>
                            <table width="100%" cellpadding="5" cellspacing="0" border="0">     
                                <tr><td align="center" class="color_white" style="background-color:#555;" colspan="2">LAST PAYMENT RECORD</td></tr>
                                <tr>
                                    <td style="background-color:#eaeaea;">
                                        <table width="100%" cellpadding="5" cellspacing="0" border="0">
                                            <tr align="center" style="background-color: #fff;">
                                                <td>Period Covered</td>
                                                <td>OR Number</td>
                                                <td>Total Amt Paid</td>
                                                <td>Pay Date</td>
                                            </tr>
                                            <tr align="center" style="background-color: #fff;font-weight:normal;">
                                               <td><?=$_VIEW['prev_reading']['lot_wes_reading_from_date']?> to <br> <?=$_VIEW['prev_reading']['lot_wes_reading_date']?></td>
                                                <td><?=$_VIEW['prev']['lot_wes_account_receive_receipt']?></td>
                                                <td>P <?=$_VIEW['prev']['lot_wes_account_receive_receipt']?></td>
                                                <td><?=$_VIEW['prev']['lot_wes_account_receive_timestamp']?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>        
                        </td>
                        <td>
                            <table width="100%" cellpadding="5" cellspacing="0" border="0">     
                                <tr><td align="center" class="color_white" style="background-color:#555;" colspan="2">BILL INFORMATION</td></tr>
                                <tr>    
                                    <td class="bg_fff">Current Balance:</td>
                                    <td align="right" class="bg_fff"><?=string_amount($_VIEW['lot_wes_reading_current_total'])?></td>
                                </tr>
                                <tr>    
                                    <td class="bg_fff">12% VAT:</td>
                                    <td align="right" class="bg_fff">(<?=string_amount($_VIEW['lot_wes_reading_current_charge'])?> x <?=string_amount($_VIEW['lot_wes_reading_vat_rate'])?>%) = <?=string_amount($_VIEW['vat'])?></td>
                                </tr>
                                <tr>
                                    <td class="bg_fff">Total Balance:</td>
                                    <td align="right" class="bg_fff"><?=string_amount($_VIEW['lot_wes_reading_current_total']+$_VIEW['prev_reading']['lot_wes_reading_balance'])?></td>
                                </tr>
                                <tr>
                                    <td class="bg_fff">Surcharge:</td>
                                    <td align="right" class="bg_fff"><?=string_amount($_VIEW['lot_wes_reading_surcharge'])?></td>
                                </tr>
                                <tr class="selected">
                                    <td>TOTAL AMOUNT DUE:</td>
                                    <td align="right"><?=string_amount($_VIEW['lot_wes_reading_surcharge']+$_VIEW['lot_wes_reading_current_total'])?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="background-color: #fff;font-weight:normal;" class="font_size_10">NOTE: This billing statement shall be deemed correct unless an error is reported to us within 10 (10) days from receipt hereof.</td>
                                </tr>
                            </table>    
                        </td>
                    </tr>

                </table>    
            </div>  
        </div>    
    </div>
    <label></label>
</div>


