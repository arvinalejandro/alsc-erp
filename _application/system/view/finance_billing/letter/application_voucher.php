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
            <input name="str[account_letter_name]" value="APPLICATION VOUCHER" />
        </form>
    </div>
	
	<div>
        <div id="print_controls" class="display_none">
            <div style="float:left; margin-left:20px;">
                <h3>File Name:</h3>
                <h2>Application Voucher</h2>
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
                
                <div id="document" style="margin:30px 0 20px 0;">
                    <span style="float:left;">APPLICATION VOUCHER</span>
                    <span style="float:right; font-size:9pt; font-weight:normal;">No. AV: <b>123</b></span>
                    <span style="float:right; margin-right:20px; font-size:9pt; font-weight:normal;">Date: <b><?=string_date(time())?></b></span>
                    <label></label>
                </div>
                
                <div style="float:left; width:50%;">
                    <div style="margin:0 auto; width:50%;">
                        <a class="check_box active"></a>
                        Application of Payments
                        <label></label>
                        <a class="check_box"></a>
                        Refund-Apply
                        <label></label>
                        <a class="check_box"></a>
                        Refund-Reserve
                        <label></label>
                    </div>
                </div>
                <div style="float:right; width:50%; font-size:9pt;">
                    <table border="0" cellpadding="3" cellspacing="0" width="90%">
                        <tr>
                            <td colspan="2">Buyer's Full Name</td>
                            <td colspan="5"><b><?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?></b></td>
                        </tr>
                        <tr valign="top">
                            <td rowspan="3">FR:</td>
                            <td >Blk</td>
                            <td><b><?=$_VIEW['project_site_block_name']?></b></td>
                            <td rowspan="3" width="5%"></td>
                            <td rowspan="3">TO:</td>
                            <td>Blk</td>
                            <td><b></b></td>
                        </tr>
                        <tr>
                            <td>Lot</td>
                            <td><b><?=$_VIEW['lot_name']?></b></td>
                            <td>Lot</td>
                            <td><b></b></td>
                        </tr>
                        <tr>
                            <td>Project</td>
                            <td><b><?=$_VIEW['project_acronym']?> <?=$_VIEW['project_site_name']?></b></td>
                            <td>Project</td>
                            <td><b></b></td>
                        </tr>
                    </table>
                </div>
                <label style="margin-bottom:30px;"></label>
                
                <div style="float:left; width:50%; padding:10px; border:1px solid black;">
                    <table width="100%" cellpadding="2" cellspacing="0" border="0">
                        <tr>
                            <td>
                                <b>100</b>% of 
                                <b>Principal</b> Payments
                            </td>
                            <td align="right">P <b>113,745.89</b></td>
                        </tr>
                        <tr><td colspan="2">Deductions:</td></tr> 
                        <tr>
                            <td><b style="margin-left:20px;">Commission</b></td>
                            <td align="right"><b>18,433.80</b></td>
                        </tr>   
                        <tr>
                            <td><b style="margin-left:20px;">ORC</b></td>
                            <td align="right"><b>5,760.57</b></td>
                        </tr> 
                        <tr>
                            <td><b style="margin-left:20px;">Incentives</b></td>
                            <td align="right"><b>300.00</b></td>
                        </tr> 
                        <tr>
                            <td><b style="margin-left:20px;">Transfer Fee</b></td>
                            <td align="right"><b>500.00</b></td>
                        </tr> 
                        <tr>
                            <td>TOTAL DEDUCTIONS</td>
                            <td align="right"><b>-</b></td>
                        </tr>
                        <tr>
                            <td>NET AMOUNT TO BE APPLIED</td>
                            <td align="right">P <b>88,751.52</b></td>
                        </tr>  
                    </table>              
                </div>
                <div style="float:right; width:40%;">
                    <div style="padding:10px 10px 20px 10px;">
                        Remarks:<br/>
                        <a class="check_box"></a>
                        <span class="cb_label">Processing of Title</span>
                        <label></label>
                        <a class="check_box"></a>
                        <span class="cb_label">Breakdown</span>
                        <label></label>
                        
                        <span style="margin-right:10px; float:left;">Res.</span>
                        <div style="border-bottom:1px solid black; padding-top:15px; width:165px; float:right;"></div>
                        <label></label>
                        <span style="margin-right:10px; float:left;">DP/MA</span>
                        <div style="border-bottom:1px solid black; padding-top:15px; width:165px; float:right;"></div>
                        <label style="margin-bottom:10px;"></label>
                        
                        <a class="check_box"></a>
                        <span class="cb_label">Others</span>
                        <label></label>
                        <div style="border-bottom:1px solid black;"></div> 
                        <div style="border-bottom:1px solid black; padding-top:15px;"></div> 
                        <div style="border-bottom:1px solid black; padding-top:15px;"></div> 
                    </div>
                </div>
                <label style="margin-bottom:30px;"></label>
                
                
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td>
                            <div style="width:80%; float:left;">
                                Prepared by:<br/>
                                <div style="border-bottom:1px solid black; padding-top:15px;"></div> 
                            </div>
                        </td>
                        <td>
                            <div style="width:80%; margin:0 auto;">
                                Checked by:<br/>
                                <div style="border-bottom:1px solid black; padding-top:15px;"></div> 
                            </div>
                        </td>
                        <td>
                            <div style="width:80%; float:right;">
                                Approved by:<br/>
                                <div style="border-bottom:1px solid black; padding-top:15px;"></div> 
                            </div>
                        </td>
                    </tr>
                </table>
                
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
                            <td></td>
                            <td colspan="2">
                                <span>Date Today</span>
                                <input type="text" value="<?=string_date(time())?>" id="input_date" onkeyup="type_date()" />
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span>Assignor's Full Name</span>
                                <input type="text" value="Nerissa T. Barrientos" id="input_assignor_name" onkeyup="type_assignor_name()" />
                            </td>
                            <td colspan="2">
                                <span>Assignor's Address</span>
                                <input type="text" value="489 GUIDO 4 MAYPAJO CALOOCAN CITY" id="input_assignor_address" onkeyup="type_assignor_address()" /> 
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span>Assignee's Full Name</span>
                                <input type="text" value="BEATO B. JACINTO married to AGNES M. JACINTO" id="input_assignee_name" onkeyup="type_assignee_name()" />
                            </td>
                            <td colspan="2">
                                <span>Assignee's Address</span>
                                <input type="text" value="753 INT. 19B RAXABAGO ST., TONDO, MANILA" id="input_assignee_address" onkeyup="type_assignee_address()" /> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Block</span>
                                <input type="text" value="33" id="input_block" onkeyup="type_block()" />
                            </td>
                            <td>
                                <span>Lot</span>
                                <input type="text" value="07" id="input_lot" onkeyup="type_lot()" /> 
                            </td>
                            <td>
                                <span>Project</span>
                                <input type="text" value="GRAND ROYALE 5D" id="input_project" onkeyup="type_project()" />
                            </td>
                            <td>
                                <span>Area (sqm)</span>
                                <input type="text" value="96.00" id="input_sqm" onkeyup="type_sqm()" /> 
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" align="center">
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
            
            function type_date()
            {
                value_date = $('#input_date').val();
                $('.output_date').html(value_date)
            }
            
            function type_assignor_name()
            {
                value_assignor_name = $('#input_assignor_name').val();
                $('.output_assignor_name').html(value_assignor_name)
            }
            
            function type_assignor_address()
            {
                value_assignor_address = $('#input_assignor_address').val();
                $('#output_assignor_address').html(value_assignor_address)
            }
            
            function type_assignee_name()
            {
                value_assignee_name = $('#input_assignee_name').val();
                $('.output_assignee_name').html(value_assignee_name)
            }
            
            function type_assignee_address()
            {
                value_assignee_address = $('#input_assignee_address').val();
                $('#output_assignee_address').html(value_assignee_address)
            }
            
            function type_block()
            {
                value_block = $('#input_block').val();
                $('#output_block').html(value_block)
            }
            
            function type_lot()
            {
                value_lot = $('#input_lot').val();
                $('#output_lot').html(value_lot)
            }
            
            function type_project()
            {
                value_project = $('#input_project').val();
                $('#output_project').html(value_project)
            }
            
            function type_sqm()
            {
                value_sqm = $('#input_sqm').val();
                $('#output_sqm').html(value_sqm)
            }

        </script>     

	</div>
	
	</body>
	
</html>





