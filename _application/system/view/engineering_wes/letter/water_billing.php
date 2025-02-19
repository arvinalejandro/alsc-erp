<!DOCTYPE html> 
<html>

	<head>
        <link rel="stylesheet" type="text/css" href="/_application/content/css/print_global.css" />
		<link rel="stylesheet" type="text/css" href="/_application/content/css/print_letter.css" />
        <script type="text/javascript" src="/_application/content/js/jquery.js"></script>
        <script type="text/javascript" src="/_application/content/js/globals.js"></script>
        <script type="text/javascript" src="/_application/content/plugins/jquery.ui/js/jquery-ui.js"></script>
        <script type="text/javascript" src="/_application/content/plugins/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="/_application/content/js/letter.js"></script>
	</head>
	<body>
	
    
	<div>
        <div id="print_controls" class="display_none">
            <div style="float:left; margin-left:20px;">
                <h3>File Name:</h3>
                <h2>Water Bill</h2>
            </div>
            <div style="float:left; margin-left:30px;">
                <h3>Client Name:</h3>
                <h2><?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?></h2>
            </div>
            <div style="float:left; margin-left:30px;">
                <h3>Date of Printing:</h3>
                <h2><?=string_date(time())?></h2>
            </div>
            
            <div style="float:right; margin-right:20px;">
                <span style="color:#ffffff; margin-right:20px;"><?=$_VIEW['_user_']['user_name']?> <?=$_VIEW['_user_']['user_surname']?></span>
                <button class="gray" style="margin-right:10px;">Cancel</button>
                <button class="blue" onclick="bill_update()"><span></span>Print</button>
            </div>
            
            <label></label>
        </div>
        
        <label id="top_pad"></label>
        
        <div id="content">
            <div style="margin:0 auto; width:500px;">
                <img src="/_application/content/images/ALSC_logo_bnw.jpg" style="margin-right:20px; float:left;" width="80px" />
                <div style="float:left; line-height: 8pt;">
                    <h1>ASIAN LAND STRATEGIES CORPORATION</h1>
                    <span style="font-size:7pt;">Asian Land Corporate Center, Grand Royale Subdivision, Bulihan, Malolos City, Bulacan</span><br/>
                    <span style="font-size:7pt;">Asian Land Branch Office, No. 490, EDSA, Barangay 95, Zone 9, District 2, Caloocan City</span>
                    
                    <table border="0" cellpadding="0" cellspacing="0" style="font-size:7pt; margin-top:10px;" width="100%">
                        <tr align="center">
                            <td>+63 44 791-2508 to 09</td>
                            <td>info@asianland.com.ph</td>
                            <td>www.asianland.com.ph</td>    
                        </tr>
                    </table>
                </div>
                <label style="margin-bottom:20px;"></label>
            </div>
            <table width="100%" cellpadding="10" cellspacing="0" border="0" style="font-size: 9px;">
                    <tr>
                        <td class="border_top_gray" style="font-weight:normal;" colspan="2">
                            <h1>Announcement:</h1> <!-- dynamic -->
                            <label></label>
                            <?=$_VIEW['sys_wes']['water_announcement']?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td colspan="2">
                            <table width="100%" cellpadding="5" cellspacing="0" border="1">    
                                <tr><td colspan="4" align="center" style="background-color:#ddd;">WATER BILLING STATEMENT</td></tr>
                                <tr>
                                    <td style="background-color:#ddd;">Account Number:</td>
                                    <td class="bg_fff"><?=$_VIEW['client_account_number']?></td>
                                    <td style="background-color:#ddd;">Current Amt Due:</td>
                                    <td>P <?=string_amount($_VIEW['lot_wes_reading_current_total']+$_VIEW['lot_wes_reading_surcharge'])?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:#ddd;">Name:</td>
                                    <td class="bg_fff"><?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?></td>
                                    <td style="background-color:#ddd;">Billing Period:</td>
                                    <td class="bg_fff"><?=string_date($_VIEW['lot_wes_reading_from_date'])?> to <?=string_date($_VIEW['lot_wes_reading_date'])?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:#ddd;">Service Address:</td>
                                    <td class="bg_fff">B<?=$_VIEW['project_site_block_name']?> L<?=$_VIEW['lot_name']?> <?=$_VIEW['project_name']?></td>
                                    <td style="background-color:#ddd;">Due Date:</td>
                                    <td class="bg_fff"><?=string_date($_VIEW['lot_wes_reading_due_date'])?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <table width="100%" cellpadding="5" cellspacing="0" border="1">     
                                <tr><td align="center" style="background-color:#ddd;">METERING INFORMATION</td></tr>
                                <tr>
                                    <td style="background-color:#eaeaea;">
                                        <table width="100%" cellpadding="5" cellspacing="0" border="0">
                                            <tr align="center" style="background-color: #fff;">
                                                <td>Meter No.</td>
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
                            <table width="100%" cellpadding="5" cellspacing="0" border="1">     
                                <tr><td align="center" style="background-color:#ddd;" colspan="2">LAST PAYMENT RECORD</td></tr>
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
                                                <td>P <?=$_VIEW['prev']['lot_wes_account_receive_total_amount_due_actual']?></td>
                                                <td><?=$_VIEW['prev']['lot_wes_account_receive_timestamp']?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr> 
                            </table>        
                        </td>
                        <td>
                            <table width="100%" cellpadding="5" cellspacing="0" border="1">     
                                <tr><td align="center" style="background-color:#ddd;" colspan="2">BILL INFORMATION</td></tr>
                                
                                <tr style="background-color: #EAEAEA;">
                                    <td colspan="2">
                                        <table width="100%" cellpadding="5" cellspacing="0" border="0" style="font-weight: normal;"> 
                                            <tr style="background-color: #fff;"><td colspan="2"><span style="font-weight:bold;">CURRENT CHARGES</span></td></tr>
                                            <tr style="background-color: #fff;">
                                                <td><span class="mar_h">Water bill</span></td>
                                                <td align="right"><?=string_amount($_VIEW['lot_wes_reading_current_charge'])?></td>
                                            </tr>
                                            <tr style="background-color: #fff;">
                                                <td><span class="mar_h">12% VAT</span></td>
                                                <td align="right">(<?=string_amount($_VIEW['lot_wes_reading_current_charge'])?> x <?=string_amount($_VIEW['lot_wes_reading_vat_rate'])?>%) = <?=string_amount($_VIEW['vat'])?></td>
                                            </tr>
                                            <?=$_VIEW['misc_row']?>
                                             <tr>
			                                    <td class="bg_fff">Surcharge:</td>
			                                    <td align="right" class="bg_fff"><?=string_amount($_VIEW['lot_wes_reading_surcharge'])?></td>
			                                </tr>
                                            <tr style="background-color: #fff;">
                                                <td><span class="mar_h">Total</span></td>
                                                <td align="right"><?=string_amount($_VIEW['lot_wes_reading_current_total']+$_VIEW['lot_wes_reading_surcharge'])?></td>
                                            </tr>
                                            <tr class="selected">
                                                <td><span style="font-weight:bold;">TOTAL CURRENT CHARGES</span></td>
                                                <td align="right"><?=string_amount($_VIEW['lot_wes_reading_current_total'])?></td>
                                            </tr>    
                                        </table> 
                                    </td>    
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
	
	</body>
	
</html>

<script type="text/javascript">
	
var lwr_id 		= <?=$_VIEW['lot_wes_reading_id']?>;	
	function bill_update(pParameter, pSuccess)
	{
	    
	    if(pSuccess)
	    {            
	        if(pParameter == 1)
	        {
				window.print()
	        }
	        else
	        {
				alert('Unable to update Entry')
	        }
	    }
	    else
	    {            
	        p_url        =    '/engineering_wes/water_reading/update_bill';
	        p_post       =    'id=' + lwr_id;
	        p_handler    =    bill_update;                                      
	        global_ajax_request(p_url, p_handler, p_post);
	    }
	}
    
 

</script>



