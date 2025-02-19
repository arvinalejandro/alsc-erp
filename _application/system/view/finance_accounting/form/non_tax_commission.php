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
                <h2>Sales Distribution Report per Transaction Type</h2>
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
                <thead  align="center">
                    <tr align="right">                 
                        <td align="center" rowspan="2">ALSC</td>            
                        <td rowspan="2">CDV#</td>
                        <td rowspan="2">Gross Amnt</td>
                        <td rowspan="2">Input VAT/Other Inc.</td>
                        <td rowspan="2">Cheque Amnt</td>
                        <td align="center" colspan="2">Tax Base</td>
                        <td rowspan="2">Cheque Date</td>                
                    </tr>
                    <tr align="right">
                        <td>( 1% )</td>
                        <td>( 2% )</td>
                    </tr>
                </thead>
                
                <tbody align="right">                      
                    <tr>        
                        <td align="left"><div class="details">Commonwealth Insurance</div></td>
                        <td><div class="details">12-554</div></td>
                        <td><div class="details">2,900.91</div></td>
                        <td><div class="details">309.12</div></td>
                        <td><div class="details">3,159.51</div></td>
                        <td><div class="details"></div></td>
                        <td><div class="details">51.5</div></td>
                        <td><div class="details">02/04/15</div></td>
                    </tr>
                    <tr>        
                        <td align="left"><div class="details">Commonwealth Insurance</div></td>
                        <td><div class="details">12-555</div></td>
                        <td><div class="details">2,900.91</div></td>
                        <td><div class="details">309.12</div></td>
                        <td><div class="details">3,159.51</div></td>
                        <td><div class="details"></div></td>
                        <td><div class="details">51.5</div></td>
                        <td><div class="details">02/04/15</div></td>
                    </tr>
                    <tr>        
                        <td align="left"><div class="details">Jeca Gasoline</div></td>
                        <td><div class="details">12-556</div></td>
                        <td><div class="details">2,900.91</div></td>
                        <td><div class="details">309.12</div></td>
                        <td><div class="details">3,159.51</div></td>
                        <td><div class="details">31.41</div></td>
                        <td><div class="details"></div></td>
                        <td><div class="details">02/04/15</div></td>
                    </tr>
                    <tr>        
                        <td align="left"><div class="details">Emerigold Shell</div></td>
                        <td><div class="details">12-557</div></td>
                        <td><div class="details">111,985.04</div></td>
                        <td><div class="details">13,438.21</div></td>
                        <td><div class="details">124,303.40</div></td>
                        <td><div class="details">1,119.85</div></td>
                        <td><div class="details"></div></td>
                        <td><div class="details">02/04/15</div></td>
                    </tr>
                    <tr>        
                        <td align="left"><div class="details">Commonwealth Insurance</div></td>
                        <td><div class="details">12-554</div></td>
                        <td><div class="details">2,900.91</div></td>
                        <td><div class="details">309.12</div></td>
                        <td><div class="details">3,159.51</div></td>
                        <td><div class="details"></div></td>
                        <td><div class="details">51.5</div></td>
                        <td><div class="details">02/04/15</div></td>
                    </tr>
                    <tr>        
                        <td align="left"><div class="details">Commonwealth Insurance</div></td>
                        <td><div class="details">12-555</div></td>
                        <td><div class="details">2,900.91</div></td>
                        <td><div class="details">309.12</div></td>
                        <td><div class="details">3,159.51</div></td>
                        <td><div class="details"></div></td>
                        <td><div class="details">51.5</div></td>
                        <td><div class="details">02/04/15</div></td>
                    </tr>
                    <tr>        
                        <td align="left"><div class="details">Jeca Gasoline</div></td>
                        <td><div class="details">12-556</div></td>
                        <td><div class="details">2,900.91</div></td>
                        <td><div class="details">309.12</div></td>
                        <td><div class="details">3,159.51</div></td>
                        <td><div class="details">31.41</div></td>
                        <td><div class="details"></div></td>
                        <td><div class="details">02/04/15</div></td>
                    </tr>
                    <tr>        
                        <td align="left"><div class="details">Emerigold Shell</div></td>
                        <td><div class="details">12-557</div></td>
                        <td><div class="details">111,985.04</div></td>
                        <td><div class="details">13,438.21</div></td>
                        <td><div class="details">124,303.40</div></td>
                        <td><div class="details">1,119.85</div></td>
                        <td><div class="details"></div></td>
                        <td><div class="details">02/04/15</div></td>
                    </tr>

                    
                    <!-- last rows -->
                    <tr class="selected bold">        
                        <td align="center">Totals</td>
                        <td></td>
                        <td style="border-top:1px solid gray;">328,136.79</td>
                        <td style="border-top:1px solid gray;">36,435.07</td>
                        <td style="border-top:1px solid gray;">350,616.67</td>
                        <td style="border-top:1px solid gray;">1,546.17</td>
                        <td style="border-top:1px solid gray;">4,496.72</td>
                        <td></td>
                    </tr>    
                </tbody>  
            </table>
        </div>
        

        
	</div>
	
	</body>
	
</html>





