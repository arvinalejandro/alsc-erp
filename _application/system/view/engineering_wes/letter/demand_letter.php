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
    <div style="display: none;">
        <form action="/finance_billing/due/letter_submit" method="POST" name="alsc_form">
            <textarea id="_letter_content_" name="mce[account_letter_content]"></textarea>
            <input name="client_account_id" value="<?=$_VIEW['client_account_id']?>" />
            <input name="option_invoice_status_id" value="2" />
            <input name="int[client_account_id]" value="<?=$_VIEW['client_account_id']?>" />
            <input name="int[user_id]" value="<?=$_VIEW['_user_']['user_id']?>" />
            <input name="str[account_letter_type]" value="<?=$_GET['letter']?>" />
            <input name="str[account_letter_name]" value="Water - Notice of Disconnection" />
        </form>
    </div>
    
    <div>
        <div id="print_controls" class="display_none">
            <div style="float:left; margin-left:20px;">
                <h3>File Name:</h3>
                <h2>Water - Disconnection</h2>
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
                <button class="blue" onclick="letter_update()"><span></span>Print</button>
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
            <table width="100%" cellpadding="10" cellspacing="0" border="0" style="font-size:9px;">
                <tr>
                    <td colspan="2">
                        <table width="100%" cellpadding="5" cellspacing="0" border="1">    
                            <tr>
                                <td style="background-color:#ddd;">Account Number:</td>
                                <td class="bg_fff"><?=$_VIEW['client_account_number']?></td>
                                <td style="background-color:#ddd;">Current Amt Due:</td>
                                <td>P <?=string_amount($_VIEW['lot_wes_reading_surcharge']+$_VIEW['lot_wes_reading_current_total'])?></td>
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
                                <td style="background-color:#ddd;">Statement Date:</td>
                                <td class="bg_fff"><?=string_date(time())?></td>
                            </tr>
                        </table>
                    </td>
                </tr>    
                <tr>
                    <td class="border_top_gray" style="font-weight:normal;" colspan="2">
                        <h1>Disconnection Notice</h1> <!-- dynamic -->
                        <label></label>
                        <p>We regret to inform you that we cannot continue serving you unless the overdue account stated above is paid within five (5) days from receipt of this notice. If no payment is received within the grace period, we will be compelled to discontinue your service. Please pay the amount stated above direct to Asian Land Strategies Office to avoid delay in the posting of your payment.</p>
                        <p>Please call the telephone numbers specified above if you have any inquiries or service requirements.</p>
                        <p>Please disregard this notice if full payment of this account has already been made.</p>
                        <p>This is a computer generated letter. No signature is required.</p>
                        </br>
                        <p>
                            <b>Jennifer Torres</b></br>
                            Utility Supervisor
                        </p>
                        
                    </td>
                </tr>
            </table>  
          
          
        </div>
        

    </div>
    
    </body>
    
</html>
<script type="text/javascript">
	
var lwr_id 		= <?=$_VIEW['lot_wes_reading_id']?>;	
	function letter_update(pParameter, pSuccess)
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
	        p_url        =    '/engineering_wes/demand_letter/update_entry';
	        p_post       =    'id=' + lwr_id;
	        p_handler    =    letter_update;                                      
	        global_ajax_request(p_url, p_handler, p_post);
	    }
	}
    
 

</script>




