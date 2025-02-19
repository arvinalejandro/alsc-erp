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
                <h2>Electric Meter Reading</h2>
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
            <div style="margin:0 auto; width:500px;">
                <img src="/_application/content/images/ALSC_logo_bnw.jpg" style="margin-right:20px; float:left;" width="80px" />
                <div style="float:left; line-height: 14pt;">
                    <h1>ASIAN LAND STRATEGIES CORPORATION</h1>    
                    <span style="font-size:9pt;">ELECTRIC ACCOUNTS FOR READING LIST As Of <?=string_date(time())?></span><br/>
                    
                </div>
                <label style="margin-bottom:20px;"></label>
            </div>
            <table width="100%" cellpadding="10" cellspacing="0" border="0" style="font-size: 9px;">
                <tr style="background-color:#ddd;">     
                    <td style="font-weight:normal;">No.</td>   
                    <td style="font-weight:normal;">SIN #</td>
                    <td style="font-weight:normal;">Sub Meter #</td>
                    <td style="font-weight:normal;">Account #</td>
                    <td style="font-weight:normal;">Address</td>
                    <td style="font-weight:normal;">Name</td>
                    <td style="font-weight:normal;">Previous Read</td>
                    <td style="font-weight:normal;">Present Read</td>
                    <td style="font-weight:normal;">Printed Name</td>
                </tr>
               <?=$_VIEW['row.list']?>
                
            </table>    
          
          
        </div>
 
            

	</div>
	
	</body>
	
</html>





