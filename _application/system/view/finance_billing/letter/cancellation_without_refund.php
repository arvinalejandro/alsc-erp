<!DOCTYPE html> 
<html>

	<head>
        <link rel="stylesheet" type="text/css" href="/_application/content/css/print_global.css" />
		<link rel="stylesheet" type="text/css" href="/_application/content/css/print_legal.css" />
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
            <input name="str[account_letter_name]" value="CANCELLATION LETTER WITHOUT REFUND" />
        </form>
    </div>
    
	<div>
        <div id="print_controls" class="display_none">
            <div style="float:left; margin-left:20px;">
                <h3>File Name:</h3>
                <h2>Cancellation Letter Without Refund</h2>
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
                <button class="blue" onclick="window.print()"><span></span>Print</button>
            </div>
            
            <label></label>
        </div>
        
        <label id="top_pad"></label>
        
        <div id="content">
            <!-- put this to template. just in-case they will change address, etc. -->
            <div style="margin:0 auto;">
                
                <?=$_VIEW['header_standard']?>
                
                <div id="document">CANCELLATION LETTER WITHOUT REFUND</div>
                
                <p>
                    <b id="output_date"><?=string_date(time())?></b><br/>
                    <b id="output_address"><?=$_VIEW['client_address']?>, <?=$_VIEW['client_city']?> <?=$_VIEW['client_zip']?></b><br/>
                </p>
                
                <p>
                    Subject:
                    <b id="output_subject"><?=$_VIEW['project_acronym']?>-<?=$_VIEW['project_site_name']?> B<?=$_VIEW['project_site_block_name']?> L<?=$_VIEW['lot_name']?> - <?=$_VIEW['client_account_type']?></b>
                </p>
                <p>Dear <b id="output_name"><?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?></b>,</p>
                
                <p>
                    We wish to inform you that despite repeated demands by the Corporation, you still failed to settle your accounts within the period stipulated. Much to our desire to accommodate you and understand your predicament, which we believe was not attributable to your negligence, your continued failure to comply with your obligation, however, adversely affects the operational activity and financial viability of the Corporation. The Corporation, therefore, is left without any other recourse except to cancel and terminate your
                    <b class="output_detail">Reservation Application</b>
                </p>
                <p>
                    Accordingly, it is with deep regret that your 
                    <b class="output_detail">Reservation Application</b>
                    for Block <b id="output_block"><?=$_VIEW['project_site_block_name']?></b> Lot <b id="output_lot"><?=$_VIEW['lot_name']?></b> 
                    <b id="output_alsc"><?=$_VIEW['project_name']?> <?=$_VIEW['project_site_name']?></b>
                    is hereby cancelled and terminated and all your payments made per your 
                    <b class="output_detail">Reservation Application</b> is hereby waived in favor of the Corporation as rental payment for the said property.
                </p>
                <p>We look forward to be of service to you in some future time</p>
                
                <div style="margin-top:20px; float:right;">
                    <p>Very truly yours,</p>
                    <p style="margin-top:50px;">
                        Celine Angelica B. Gonzales <br/>
                        AVP for Finance <br/>
                        ASIAN LAND STRATEGIES CORPORATION
                    </p>
                </div>
                <label></label>
                
                <p style="font-weight:bold;">REPUBLIC OF THE PHILIPPINES <br/>
                    MALOLOS CITY <span style="margin-left:75px;"> ) S.S.</span>
                </p>   
                <p>BEFORE ME, a Notary Public for and in MALOLOS BULACAN on 
                __________________, personally appeared CELINE ANGELICA B. GONZALES with Unified Multi-Purpose ID No. CRN-0111-0665913-4, personally known to me to the same person who executed the foregoing instrument and acknowledged to me that the same is of her own free act and deed.</p> 
                
                <p style="text-align:center; margin-top:40px;">WITNESS MY HAND AND NOTARIAL SEAL.</p>
                
                <table border="0" cellpadding="5" cellspacing="0" width="50%" style="float:left; margin-top:200px;">
                    <tr valign="bottom">
                        <td width="20%">Doc No</td>
                        <td><div style="border-top:1px solid black; padding-top:3px; margin-top:15px; width:80%;"></div></td>
                    </tr>
                    <tr valign="bottom">
                        <td width="20%">Page No</td>
                        <td><div style="border-top:1px solid black; padding-top:3px; margin-top:15px; width:80%;"></div></td>
                    </tr>
                    <tr valign="bottom">
                        <td width="20%">Book No</td>
                        <td><div style="border-top:1px solid black; padding-top:3px; margin-top:15px; width:80%;"></div></td>
                    </tr>
                    <tr valign="bottom">
                        <td width="20%">Series of</td>
                        <td><div style="border-top:1px solid black; padding-top:3px; margin-top:15px; width:80%;"></div></td>
                    </tr>
                </table>
                <label></label>
                
            </div>
            <label></label>
        </div>
        
        <div id="input_controls" class="display_none hidden">
            <div id="input_hider">
                <button id="hide_button" class="blue none" onclick="hide()">Hide</button>
                <button id="unhide_button" class="blue" onclick="unhide()">Show</button>
            </div>
            <div id="scroller">
                <div id="input_body">
                    <table width="100%" cellpadding="10" cellspacing="0" border="0" class="border">
                        <tr>
                            <td width="50%">
                                <span>Date Today</span>
                                <input type="text" value="<?=string_date(time())?>" id="input_date" onkeyup="type_date()" />
                            </td>
                            <td>
                                <span>Buyer's Address</span>
                                <input type="text" id="input_address" value="<?=$_VIEW['client_address']?>, <?=$_VIEW['client_city']?> <?=$_VIEW['client_zip']?>" onkeyup="type_address()" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Subject</span>
                                <input type="text" value="<?=$_VIEW['project_acronym']?>-<?=$_VIEW['project_site_name']?> B<?=$_VIEW['project_site_block_name']?> L<?=$_VIEW['lot_name']?> - <?=$_VIEW['client_account_type']?>" id="input_subject" onkeyup="type_subject()" />       
                            </td>
                            <td>
                                <span>Buyer's Full Name</span>
                                <input type="text" value="<?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?>" id="input_name" onkeyup="type_name()" /> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Detail</span>
                                <input type="text" value="Reservation Application" id="input_detail" onkeyup="type_detail()" />
                            </td>
                            <td>
                                <span>ALSC Address</span>
                                <input type="text" value="<?=$_VIEW['project_name']?> <?=$_VIEW['project_site_name']?>" id="input_alsc" onkeyup="type_alsc()" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Block</span>
                                <input type="text" value="<?=$_VIEW['project_site_block_name']?>" id="input_block" onkeyup="type_block()" />
                            </td>
                            <td>
                                <span>Lot</span>
                                <input type="text" value="<?=$_VIEW['lot_name']?>" id="input_lot" onkeyup="type_lot()" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><button class="blue" onclick="save_execute()">Save</button></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>           
        <script type="text/javascript">
            function hide()
            {
                $('#hide_button').addClass('none');    
                $('#unhide_button').removeClass('none'); 
                $('#input_controls').addClass('hidden'); 
                $('#content').css({"padding": "40px 80px 80px 50px"});                 
            }
            
            function unhide()
            {
                $('#hide_button').removeClass('none');    
                $('#unhide_button').addClass('none'); 
                $('#input_controls').removeClass('hidden'); 
                $('#content').css({"padding": "40px 80px 270px 50px"});  
            }
            
            function type_date()
            {
                value_date = $('#input_date').val();
                $('#output_date').html(value_date);
            } 
            
            function type_address()
            {
                value_address = $('#input_address').val();
                $('#output_address').html(value_address);
            } 
            
            function type_subject()
            {
                value_subject = $('#input_subject').val();
                $('#output_subject').html(value_subject);
            }
            
            function type_name()
            {
                value_name = $('#input_name').val();
                $('#output_name').html(value_name);
            }
            
            function type_detail()
            {
                value_detail = $('#input_detail').val();
                $('.output_detail').html(value_detail);
            }
            
            function type_block()
            {
                value_block = $('#input_block').val();
                $('#output_block').html(value_block);
            }
            
            function type_lot()
            {
                value_lot = $('#input_lot').val();
                $('#output_lot').html(value_lot);
            }
            
             function type_alsc()
            {
                value_alsc = $('#input_alsc').val();
                $('#output_alsc').html(value_alsc);
            }
        </script>       

	</div>
	
	</body>
	
</html>





