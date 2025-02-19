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
                <h2>Tax Witheld on Commisssion</h2>
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
              
            <table class="mar_standard" width="100%" cellpadding="3" cellspacing="0" border="1">
                <thead>
                    <tr>                          
                        <td>Name</td>
                        <td align="right">Amount</td>
                    </tr>
                </thead>
                
                <tbody> 
                    <tr>    
                        <td><div class="details">Abejo, Leonida</div></td>
                        <td align="right"><div class="details">2,318.21</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Abeleda, Nena</div></td>
                        <td align="right"><div class="details">323.41</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Ablanida, Novie Dream</div></td>
                        <td align="right"><div class="details">804.00</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Ablaza, Olivia</div></td>
                        <td align="right"><div class="details">717.11</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Ablin, Mary Grace</div></td>
                        <td align="right"><div class="details">170.66</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Agapinan, Anita</div></td>
                        <td align="right"><div class="details">2,694.79</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Abejo, Leonida</div></td>
                        <td align="right"><div class="details">2,318.21</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Abeleda, Nena</div></td>
                        <td align="right"><div class="details">323.41</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Ablanida, Novie Dream</div></td>
                        <td align="right"><div class="details">804.00</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Ablaza, Olivia</div></td>
                        <td align="right"><div class="details">717.11</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Ablin, Mary Grace</div></td>
                        <td align="right"><div class="details">170.66</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Agapinan, Anita</div></td>
                        <td align="right"><div class="details">2,694.79</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Abejo, Leonida</div></td>
                        <td align="right"><div class="details">2,318.21</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Abeleda, Nena</div></td>
                        <td align="right"><div class="details">323.41</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Ablanida, Novie Dream</div></td>
                        <td align="right"><div class="details">804.00</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Ablaza, Olivia</div></td>
                        <td align="right"><div class="details">717.11</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Ablin, Mary Grace</div></td>
                        <td align="right"><div class="details">170.66</div></td>
                    </tr>
                    <tr>    
                        <td><div class="details">Agapinan, Anita</div></td>
                        <td align="right"><div class="details">2,694.79</div></td>
                    </tr>

                    
                    <tr class="selected">                                  <!-- last row -->
                        <td align="left">NET CASH INFLOW (OUTFLOW)</td>
                        <td style="border-top: 1px solid gray;" align="right"><div class="details">1,234,567,890.00</div></td>

                    </tr>                    
                </tbody>  
            </table>
        </div>
            <script type="text/javascript">
                function open_form()
                {
                var myWindow = window.open("http://alsc/finance_accounting/accounting_report_form/tax_commission", "_blank", "width=1000, height=600, toolbar=no, scrollbars=yes, resizable=no, resizable=yes, top=50, left=50, location=no");
                }    
            </script>       
        
	</div>
	
	</body>
	
</html>





