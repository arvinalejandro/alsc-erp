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
            <input name="str[account_letter_name]" value="AMENDMENT FORM" />
        </form>
    </div>
	
	<div>
        <div id="print_controls" class="display_none">
            <div style="float:left; margin-left:20px;">
                <h3>File Name:</h3>
                <h2>Amendment Form</h2>
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
                
                <div id="document">AMENDMENT FORM</div>
                
                <table border="1" cellpadding="5" cellspacing="0" width="100%" style="border:1px solid #dddddd; font-size:10pt; margin-bottom: 20px;">
                    <tr style="background-color:#dddddd; font-size:10pt;" valign="top">
                        <td width="20%">Item</td>
                        <td>From</td>
                        <td>To</td>
                    </tr>
                    <tr id="row_name">
                        <td>Correction of Name</td>
                        <td><b id="output_name_from"><?=$_VIEW['client_name']?></b></td>
                        <td><b id="output_name_to"></b></td>
                    </tr>
                    <tr id="row_surname">
                        <td>Change of Surname</td>
                        <td><b id="output_surname_from"><?=$_VIEW['client_surname']?></b></td>
                        <td><b id="output_surname_to"></b></td>
                    </tr>
                    <tr id="row_address">
                        <td>Change of Address</td>
                        <td style="font-size:8pt;"><b id="output_address_from"><?=$_VIEW['project_site_block_name']?> <?=$_VIEW['lot_name']?> <?=$_VIEW['project_name']?> <?=$_VIEW['project_site_name']?></b></td>
                        <td style="font-size:8pt;"><b id="output_address_to"></b></td>
                    </tr>
                    <tr id="row_inclusion">
                        <td>Inclusion of Name/s</td>
                        <td colspan="2">
                            <ol>
                                <li>
                                    <b id="name_from">Arnie Alejandro</b>
                                    (<b>Brother</b>)
                                </li>
                                <li>
                                    <b id="name_from">Mizel delos Santos</b>
                                    (<b>Brother</b>)
                                </li>
                                <li>
                                    <b id="name_from">Arnie Alejandro</b>
                                    (<b>Brother</b>)
                                </li>
                                <li>
                                    <b id="name_from">Mizel delos Santos</b>
                                    (<b>Brother</b>)
                                </li>
                            </ol>
                        </td>
                    </tr>
                    <tr id="row_others">
                        <td>Others</td>
                        <td colspan="2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                    </tr>
                </table>
                <div style="float:left; width:50%;">
                    <div style="padding-bottom:40px;">REQUESTED BY:</div>
                    <div style="border-top:1px solid black; padding-top:3px; width:90%;">Buyer's Signature Over Printed Name</div>
                    <label></label> 
                    <div style="padding-top:40px;">REQUIREMENTS:</div>
                    <ol style="font-size:10pt;">
                        <li>Duly filled up Amendment Form</li>
                        <li>Photocopy of valid ID</li>
                        <li>Payment of P500.00 for every change<br/> (except for Change of Address)</li>
                        <li>Photocopy of Birth Certificate</li>
                        <li>Photocopy of Marriage Contract</li>
                    </ol>                        
                </div>
                <div style="float:right; width:50%;">
                    <div style="padding-bottom:40px;">VERIFIED BY:</div>
                    <div style="border-top:1px solid black; padding-top:3px; width:90%;">Mizel delos Santos</div>
                    Billing Staff
                    <label></label> 
                    
                    <div style="padding:60px 0 40px 0;">APPROVED BY:</div>
                    <div style="border-top:1px solid black; padding-top:3px; width:90%;">NAME</div>
                    Executive Office
                    <label></label>                    
                </div>
                
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
                                <span>Name (From)</span>
                                <input type="text" value="Mizl Migulo" id="input_name_from" onkeyup="type_name_from()" />
                            </td>
                            <td>
                                <span>Name (To)</span>
                                <input type="text" value="Mizel Miguelo" id="input_name_to" onkeyup="type_name_to()" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Surname (From)</span>
                                <input type="text" value="deloss Saantos" id="input_surname_from" onkeyup="type_surname_from()" /> 
                            </td>
                            <td>
                                <span>Surname (To)</span>
                                <input type="text" value="delos Santos" id="input_surname_to" onkeyup="type_surname_to()" /> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Address (From)</span>
                                <input type="text" value="B5 L3, DAISY ST., KSAPITOLYO HOMES, FF. MANALO, BAMBANGG, PPASIG" id="input_address_from" onkeyup="type_address_from()" />       
                            </td>
                            <td>
                                <span>Address (To)</span>
                                <input type="text" value="B5 L3, DAISY ST., KAPITOLYO HOMES, F. MANALO, BAMBANG, PASIG" id="input_address_to" onkeyup="type_address_to()" /> 
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" align="center">
                                <button class="blue" onclick="save_execute()">Save</button>
                            </td>
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
            
            function type_name_from()
            {
                value_name_from = $('#input_name_from').val();
                $('#output_name_from').html(value_name_from)
            }
            
            function type_name_to()
            {
                value_name_to = $('#input_name_to').val();
                $('#output_name_to').html(value_name_to)
            } 
            
            function type_surname_from()
            {
                value_surname_from = $('#input_surname_from').val();
                $('#output_surname_from').html(value_surname_from)
            }
            
            function type_surname_to()
            {
                value_surname_to = $('#input_surname_to').val();
                $('#output_surname_to').html(value_surname_to)
            }
            
            function type_address_from()
            {
                value_address_from = $('#input_address_from').val();
                $('#output_address_from').html(value_address_from)
            }
            
            function type_address_to()
            {
                value_address_to = $('#input_address_to').val();
                $('#output_address_to').html(value_address_to)
            }
                            
        </script>     

	</div>
	
	</body>
	
</html>





