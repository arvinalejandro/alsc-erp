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
                <h2>Juan dela Cruz</h2>
            </div>
            <div style="float:left; margin-left:30px;">
                <h3>Date of Printing:</h3>
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
            <?=$_VIEW['account_letter']['account_letter_content']?>
        </div>
        
         

    </div>
    
    </body>
    
</html>





