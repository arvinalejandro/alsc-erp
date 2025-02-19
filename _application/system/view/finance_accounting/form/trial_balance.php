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
    
	<div>
        <div id="print_controls" class="display_none">
            <div style="float:left; margin-left:20px;">
                <h3>File Name:</h3>              
                <h2>Cash Receipts / Cash Disbursement Journal Voucher Summary</h2>
            </div>
            <div style="float:left; margin-left:30px;">
                <h3>Date:</h3>
                <h2><?=string_date(time())?></h2>
            </div>
            
            <div style="float:right; margin-right:20px;">
                <span style="color:#ffffff; margin-right:20px;">Mizel delos Santos</span>
                <button class="gray" style="margin-right:10px;">Cancel</button>
                <button class="blue" onclick="window.print()"><span></span>Print</button>
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
                <label></label>
            </div>  
            
            <table class="mar_custom" width="100%" cellpadding="3" cellspacing="0" border="1" style="margin-top:20px;">
                <thead>
                    <tr>                          
                        <td>Asset Accounts</td>
                        <td align="right">DR</td>
                        <td align="right">CR</td>
                    </tr>
                </thead>
                
                <tbody align="right">    
                    <tr>
                        <td align="left">Cash on Hand</td>
                        <td style="border-bottom:1px solid gray;">1,234,567,890.00</td>
                        <td style="border-bottom:1px solid gray;">1,234,567,890.00</td>
                    </tr>      
                    <tr>
                        <td align="left">Cash in Bank</td>
                        <td style="border-bottom:1px solid gray;">12,234,567,890.00</td>
                        <td style="border-bottom:1px solid gray;">12,234,567,890.00</td>
                    </tr> 
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Far East/Bpi-Balintawak</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Security Bank-Malolos</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">RBSR</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">RBPI</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">PNP-Malolos</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Planters-Main</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left">Dollar Deposits</td>
                        <td style="border-bottom:1px solid gray;">100,000,000.55</td>
                        <td style="border-bottom:1px solid gray;">100,000,000.55</td>
                    </tr> 
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">PNB-$-SA</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">SBC -$-SA</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left">Other Expenses</td>
                        <td style="border-bottom:1px solid gray;">100,000,000.55</td>
                        <td style="border-bottom:1px solid gray;">100,000,000.55</td>
                    </tr> 
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Executive</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Admin</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Caloocan</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;"></div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">EDP</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;"></div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Engineering</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;"></div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Finance</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;"></div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Project Admin</div></td>
                        <td><div class="details" style="margin-left: 20px;"></div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Marketing</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    

                    <!-- last row -->
                    <tr class="selected">        
                        <td align="center" style="border-top:1px solid gray; border-bottom:2px solid gray;">GRAND TOTAL</td>
                        <td style="border-top:1px solid gray; border-bottom:2px solid gray;">145,593,695.87</td>
                        <td style="border-top:1px solid gray; border-bottom:2px solid gray;">145,593,695.87</t>
                    </tr>
                </tbody>  
            </table>
        </div>
        
	</div>
	
	</body>
	
</html>





