<!DOCTYPE html> 
<html>
	<head>
        <link rel="stylesheet" type="text/css" href="/_application/content/css/print_global.css" />
		<link rel="stylesheet" type="text/css" href="/_application/content/css/print_legal_landscape.css" />
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
                <h2>Annual Cash Flow</h2>
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
              
            <table class="mar_custom" width="100%" cellpadding="1" cellspacing="0" border="1">
                <thead>
                    <tr align="right">                          
                        <td></td>
                        <td>January</td>
                        <td>February</td>
                        <td>March</td>
                        <td>April</td>
                        <td>May</td>
                        <td>June</td>
                        <td>July</td>
                        <td>August</td>
                        <td>September</td>
                        <td>October</td>
                        <td>November</td>
                        <td>December</td>
                    </tr>
                </thead>
                
                <tbody align="right"> 
                    <tr><td colspan="13" align="left">SOURCES OF CASH</td></tr>
                    <tr><td align="left" colspan="13"><div class="details" style="margin-left: 10px;">SALES</div></td></tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Reservation</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">12,234,567,890.00</div></td>
                        <td><div class="details">3,967,552,890.00</div></td>
                        <td><div class="details">1,234,890.00</div></td>
                        <td><div class="details">474,567,890.00</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">5,234,567,890.00</div></td>
                        <td><div class="details">1,774,123,890.00</div></td>
                        <td><div class="details">1,552,567,890.00</div></td>
                        <td><div class="details">1,123,567,890.00</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Downpayment</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">12,234,567,890.00</div></td>
                        <td><div class="details">3,967,552,890.00</div></td>
                        <td><div class="details">1,234,890.00</div></td>
                        <td><div class="details">474,567,890.00</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">5,234,567,890.00</div></td>
                        <td><div class="details">1,774,123,890.00</div></td>
                        <td><div class="details">1,552,567,890.00</div></td>
                        <td><div class="details">1,123,567,890.00</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Sale of Lot</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">12,234,567,890.00</div></td>
                        <td><div class="details">3,967,552,890.00</div></td>
                        <td><div class="details">1,234,890.00</div></td>
                        <td><div class="details">474,567,890.00</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">5,234,567,890.00</div></td>
                        <td><div class="details">1,774,123,890.00</div></td>
                        <td><div class="details">1,552,567,890.00</div></td>
                        <td><div class="details">1,123,567,890.00</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Surcharges</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">12,234,567,890.00</div></td>
                        <td><div class="details">3,967,552,890.00</div></td>
                        <td><div class="details">1,234,890.00</div></td>
                        <td><div class="details">474,567,890.00</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">5,234,567,890.00</div></td>
                        <td><div class="details">1,774,123,890.00</div></td>
                        <td><div class="details">1,552,567,890.00</div></td>
                        <td><div class="details">1,123,567,890.00</div></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,234,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">12,234,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">3,967,552,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,234,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">474,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,234,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">5,234,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,774,123,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,552,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,123,567,890.00</div></td>
                    </tr>
                    
                    
                    <tr><td align="left" colspan="13"><div class="details" style="margin-left: 10px;">OTHER CASH INPUTS</div></td></tr> 
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Interest Income on Bank Deposit</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">12,234,567,890.00</div></td>
                        <td><div class="details">3,967,552,890.00</div></td>
                        <td><div class="details">1,234,890.00</div></td>
                        <td><div class="details">474,567,890.00</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">5,234,567,890.00</div></td>
                        <td><div class="details">1,774,123,890.00</div></td>
                        <td><div class="details">1,552,567,890.00</div></td>
                        <td><div class="details">1,123,567,890.00</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Other Income</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">12,234,567,890.00</div></td>
                        <td><div class="details">3,967,552,890.00</div></td>
                        <td><div class="details">1,234,890.00</div></td>
                        <td><div class="details">474,567,890.00</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">5,234,567,890.00</div></td>
                        <td><div class="details">1,774,123,890.00</div></td>
                        <td><div class="details">1,552,567,890.00</div></td>
                        <td><div class="details">1,123,567,890.00</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Electric & Water Billing Deposit</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">12,234,567,890.00</div></td>
                        <td><div class="details">3,967,552,890.00</div></td>
                        <td><div class="details">1,234,890.00</div></td>
                        <td><div class="details">474,567,890.00</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">5,234,567,890.00</div></td>
                        <td><div class="details">1,774,123,890.00</div></td>
                        <td><div class="details">1,552,567,890.00</div></td>
                        <td><div class="details">1,123,567,890.00</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Contingent Account</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">12,234,567,890.00</div></td>
                        <td><div class="details">3,967,552,890.00</div></td>
                        <td><div class="details">1,234,890.00</div></td>
                        <td><div class="details">474,567,890.00</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">5,234,567,890.00</div></td>
                        <td><div class="details">1,774,123,890.00</div></td>
                        <td><div class="details">1,552,567,890.00</div></td>
                        <td><div class="details">1,123,567,890.00</div></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,234,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">12,234,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">3,967,552,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,234,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">474,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,234,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">5,234,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,774,123,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,552,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,123,567,890.00</div></td>
                    </tr>
                    
                    <tr>
                        <td align="left">TOTAL CASH FLOWS</td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">1,234,567,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">12,234,567,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">3,967,552,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">1,234,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">474,567,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">1,234,567,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">1,567,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">1,567,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">5,234,567,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">1,774,123,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">1,552,567,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">1,123,567,890.00</div></td>
                    </tr>
                    
                    
                    <tr><td align="left" colspan="13">USES OF CASH</td></tr> 
                    <tr><td align="left" colspan="13"><div class="details" style="margin-left: 10px;">DEVELOPMENT COSTS</div></td></tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Royale Estates</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">12,234,567,890.00</div></td>
                        <td><div class="details">3,967,552,890.00</div></td>
                        <td><div class="details">1,234,890.00</div></td>
                        <td><div class="details">474,567,890.00</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">5,234,567,890.00</div></td>
                        <td><div class="details">1,774,123,890.00</div></td>
                        <td><div class="details">1,552,567,890.00</div></td>
                        <td><div class="details">1,123,567,890.00</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Casa Royale</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">12,234,567,890.00</div></td>
                        <td><div class="details">3,967,552,890.00</div></td>
                        <td><div class="details">1,234,890.00</div></td>
                        <td><div class="details">474,567,890.00</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">5,234,567,890.00</div></td>
                        <td><div class="details">1,774,123,890.00</div></td>
                        <td><div class="details">1,552,567,890.00</div></td>
                        <td><div class="details">1,123,567,890.00</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Grand Royale</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">12,234,567,890.00</div></td>
                        <td><div class="details">3,967,552,890.00</div></td>
                        <td><div class="details">1,234,890.00</div></td>
                        <td><div class="details">474,567,890.00</div></td>
                        <td><div class="details">1,234,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">1,567,890.00</div></td>
                        <td><div class="details">5,234,567,890.00</div></td>
                        <td><div class="details">1,774,123,890.00</div></td>
                        <td><div class="details">1,552,567,890.00</div></td>
                        <td><div class="details">1,123,567,890.00</div></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,234,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">12,234,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">3,967,552,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,234,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">474,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,234,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">5,234,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,774,123,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,552,567,890.00</div></td>
                        <td style="border-bottom: 1px solid gray; border-top: 1px solid gray;"><div class="details">1,123,567,890.00</div></td>
                    </tr>
                    
                    <tr>
                        <td align="left">TOTAL CASH OUTFLOWS</td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">1,234,567,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">12,234,567,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">3,967,552,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">1,234,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">474,567,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">1,234,567,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">1,567,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">1,567,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">5,234,567,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">1,774,123,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">1,552,567,890.00</div></td>
                        <td style="border-bottom: 2px solid gray; border-top: 1px solid gray;"><div class="details">1,123,567,890.00</div></td>
                    </tr>
                    
                    <tr class="selected">                                  <!-- last row -->
                        <td align="left">NET CASH INFLOW (OUTFLOW)</td>
                        <td style="border-bottom: 4px solid gray; border-top: 1px solid gray;"><div class="details">1,234,567,890.00</div></td>
                        <td style="border-bottom: 4px solid gray; border-top: 1px solid gray;"><div class="details">12,234,567,890.00</div></td>
                        <td style="border-bottom: 4px solid gray; border-top: 1px solid gray;"><div class="details">3,967,552,890.00</div></td>
                        <td style="border-bottom: 4px solid gray; border-top: 1px solid gray;"><div class="details">1,234,890.00</div></td>
                        <td style="border-bottom: 4px solid gray; border-top: 1px solid gray;"><div class="details">474,567,890.00</div></td>
                        <td style="border-bottom: 4px solid gray; border-top: 1px solid gray;"><div class="details">1,234,567,890.00</div></td>
                        <td style="border-bottom: 4px solid gray; border-top: 1px solid gray;"><div class="details">1,567,890.00</div></td>
                        <td style="border-bottom: 4px solid gray; border-top: 1px solid gray;"><div class="details">1,567,890.00</div></td>
                        <td style="border-bottom: 4px solid gray; border-top: 1px solid gray;"><div class="details">5,234,567,890.00</div></td>
                        <td style="border-bottom: 4px solid gray; border-top: 1px solid gray;"><div class="details">1,774,123,890.00</div></td>
                        <td style="border-bottom: 4px solid gray; border-top: 1px solid gray;"><div class="details">1,552,567,890.00</div></td>
                        <td style="border-bottom: 4px solid gray; border-top: 1px solid gray;"><div class="details">1,123,567,890.00</div></td>
                    </tr>

                </tbody>  
            </table>
        </div>
        
	</div>
	
	</body>
	
</html>





