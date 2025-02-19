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
            <input name="str[account_letter_name]" value="AMENDMENT TO CONTRACT TO SELL" />
        </form>
    </div>
	
	<div>
        <div id="print_controls" class="display_none">
            <div style="float:left; margin-left:20px;">
                <h3>File Name:</h3>
                <h2>Amendment to Contract to Sell</h2>
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
                

                <div style="margin:0 auto; width:520px;">
                    <img src="/_application/content/images/ALSC_logo_bnw.jpg" style="margin-right:10px; float:left;" width="80px" />
                    <div style="float:left; line-height: 12pt; margin-left: 25px;">
                        <h1>ASIAN LAND STRATEGIES CORPORATION</h1>
                        <span style="font-size:12pt; font-weight:bold;">AMENDMENT TO CONTRACT TO SELL (ACTS)</span><br/>
                        <span style="font-size:10pt;">No: <b>1024-1234</b></span>
                    </div>
                    <label></label>
                </div>  
                
                
                <p>
                    This Contract is made and executed this
                    <b class="output_date"><?=string_date(time())?></b> in Malolos City by:
                </p>
                
                <p>ASIAN LAND STRATEGIES CORPORATION, a corporation duly organized and existing under the laws of the Republic of the Philippines, with office and business address at Asian Land Corporate Center, Grand Royale Subdivision, MacArthur Highway, City of Malolos, Bulacan, represented herein by its President, Amando M. Buhain, and hereinafter referred to as the OWNER;</p>
                <div style="text-align:center;">and</div>
                
                <p>
                    <b id="output_name"><?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?></b>, of legal age, Filipino/s, resident of
                    <b id="output_address"><?=$_VIEW['client_address']?>, <?=$_VIEW['client_city']?> <?=$_VIEW['client_zip']?></b>, and hereinafter referred to as the PURCHASER; 
                </p>
                <div style="text-align:center;">WITNESSETH:</div>
                
                <ul style="list-style: upper-alpha;">
                    <li>
                        That the parties executed a Contract to Sell dated <b class="output_date"><?=string_date(time())?></b> covering the property more particularly described as follows:<br/>
                        <div style="text-align:center; padding:5px 0;">
                            Block: <b style="margin-right:20px;" id="output_block"><?=$_VIEW['project_site_block_name']?></b>
                            Lot: <b style="margin-right:20px;" id="output_lot"><?=$_VIEW['lot_name']?></b>
                            Project: <b id="output_project"><?=$_VIEW['project_name']?> <?=$_VIEW['project_site_name']?></b>
                        </div>
                        A copy of the Contract to Sell dated <b class="output_cts_date"><?=string_date(time())?></b> is attached hereto and made an integral part hereof as Annex "A".<br/>    
                    </li>
                    <li>
                        That the PURCHASER has applied for restructuring of his/her account, as set forth in the Application for Account Restructuring executed by the PURCHASER and dated
                        <b class="output_date"><?=string_date(time())?></b>, which application has been approved by the OWNER. A copy of the Application for Account Restructuring dated
                        <b class="output_date"><?=string_date(time())?></b> is attached hereto and made an integral part hereof as Annex ?B?.
                    </li>
                </ul>
                
                <p>
                    NOW, THEREFORE, the parties agree that the relevant provisions of the Contract to Sell dated
                    <b class="output_date"><?=string_date(time())?></b> shall be deemed amended by the Application for Account Restructuring dated
                    <b class="output_date"><?=string_date(time())?></b>. All other provisions of the Contract to Sell dated 
                    <b class="output_date"><?=string_date(time())?></b> shall remain valid and subsisting.       
                </p>
                
                <p>
                    IN WITNESS WHEREOF, the parties hereto affixed their signatures this
                    <b class="output_date"><?=string_date(time())?></b> in Malolos City.     
                </p>
                
                <div style="width:50%; float:left;">
                    <div style="border-top:1px solid black; padding-top:3px; margin-top:40px; width:65%;">
                        AMANDO M. BUHAIN<br/>
                        President<br/>
                        <span style="font-size:8pt">ASIAN LAND STRATEGIES CORPORATION</span>
                    </div>
                </div>
                
                <div style="width:50%; float:right;">
                    <div style="border-top:1px solid black; padding-top:3px; margin-top:40px; width:65%;">
                        Purchaser<br/>
                    </div>
                </div>
                <label></label>
                
                <div style="text-align:center; padding:10px 0;">signed in the presence of:</div>
                
                <div style="width:50%; float:left;">
                    <div style="border-top:1px solid black; padding-top:3px; margin-top:40px; width:65%;">
                    </div>
                </div>
                <div style="width:50%; float:right;">
                    <div style="border-top:1px solid black; padding-top:3px; margin-top:40px; width:65%;">
                    </div>
                </div>
                <label></label>
               
                <div style="text-align:center; font-weight:bold; padding-top:40px;">A C K N O W L E D G E M E N T</div>
                <p style="font-weight:bold;">
                    REPUBLIC OF THE PHILIPPINES) <br/>
                    MALOLOS CITY <span style="margin-left:100px;"> ) S.S.</span>
                </p>
                <p>
                    BEFORE ME, a Notary Public for and in ____________ this
                    ____________ in Malolos City personally appeared:
                </p>
                
                <div style="width:50%; float:left;">
                    <div style="text-align:center; font-style: italic;">Name</div>
                    <div>AMANDO M. BUHAIN</div>
                    <div style="border-top:1px solid black; margin-top:20px;; width:80%;"></div>
                    <div style="border-top:1px solid black; margin-top:20px;; width:80%;"></div>
                </div>
                <div style="width:50%; float:right;">
                    <div style="text-align:center; font-style: italic;">Competent Evidence of Identity</div>
                    <div>Unified Multi-Purpose ID No. CRN-0003-0691881-2</div>
                    <div style="border-top:1px solid black; margin-top:20px;; width:80%;"></div>
                    <div style="border-top:1px solid black; margin-top:20px;; width:80%;"></div>
                </div>
                <label></label>
                
                <p style="margin-top:20px;">They are known to me to be the same persons who executed the foregoing instrument, and they acknowledged to me that the same is of their own free and voluntary act and deed.</p>
                    
                    
                <div style="text-align:center; font-weight:bold; margin-bottom:20px;">
                    WITNESS MY HAND AND SEAL on this 
                    ____________ in Malolos City.
                </div>
                
                <table border="0" cellpadding="5" cellspacing="0" width="50%" style="float:left; margin-bottom:200px;">
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
                                <span>Full Name</span>
                                <input type="text" value="Leariza C. Lawas" id="input_name" onkeyup="type_name()" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Address</span>
                                <input type="text" value="76 J. GALANG ST., POBLACION, CALUMPIT, BULACAN 3003" id="input_address" onkeyup="type_address()" /> 
                            </td>
                            <td>
                                <span>Block</span>
                                <input type="text" value="5" id="input_block" onkeyup="type_block()" /> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Lot</span>
                                <input type="text" value="3" id="input_lot" onkeyup="type_lot()" />       
                            </td>
                            <td>
                                <span>Project</span>
                                <input type="text" value="Casabuen de Pulilan" id="input_project" onkeyup="type_project()" /> 
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
            
            function type_date()
            {
                value_date = $('#input_date').val();
                $('.output_date').html(value_date)
            }

            function type_name()
            {
                value_name = $('#input_name').val();
                $('#output_name').html(value_name)
            }          
            
            function type_address()
            {
                value_address = $('#input_address').val();
                $('#output_address').html(value_address)
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
        </script>       

	</div>
	
	</body>
	
</html>





