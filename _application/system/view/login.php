<!DOCTYPE html> 
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" type="text/css" href="/_application/content/css/style.global.css" />
    <link rel="stylesheet" type="text/css" href="/_application/content/css/style.id.css" />
    <link rel="stylesheet" type="text/css" href="/_application/content/css/style.class.css" />
    <script type="text/javascript" src="/_application/content/js/jquery.js"></script>
    <script type="text/javascript" src="/_application/content/js/globals.js"></script> 
    <title>Control Panel</title>
   
</head>

<body style="background:url(/_application/content/images/login_bg2.jpg) no-repeat scroll center top #282f39;">

    <div id="login_body" class="pad_custom">  
        
        <div id="page_header">
            <div class="float_left">
                <div class="align_center pad_custom bg_fff" style="width:200px; height:100px; padding:10px 0;">
                    <img src="/_application/content/images/ALSC_logo.jpg" />
                </div>
            </div>
            <div class="float_left font_size_24 mar_custom" style="margin:49px 0 0 20px;">
                <b>Asian Land Strategies Corporation ERP</b> 
                <label></label>
                <span class="color_white font_size_12">Enterprise Resource Planning for Real Estate (version 1.10.26)</span>
            </div>
        </div>
        <label></label>
        
        <div id="left_container">
        	<form action="/login/enter" method="POST" name="alsc">
	            ACCOUNT LOGIN           
	            <input type="text" placeholder="Username *" id="username" mymessage="Please enter a valid email." autofocus name="username" />
	            <label></label>

	            <input type="password" placeholder="Password *" id="password" mymessage="You forgot to enter your password." name="password" /> 
	            <label></label> 
	            
	            <div id="msg" class="display_none"></div>
	            <i class="float_left color_red" id="login_message">* Do not share your account to anyone.</i>
	            <a class="link_button_inline blue float_right" style="padding:3px 50px;" id="sign_in" onclick="submit_form('alsc')">SIGN IN</a> 
	            <label></label>  
	        </form>
        </div>
        
        <div id="right_container">
            <div id="login_history">
                Last login as <span class="bold">Mizel delos Santos</span>
                <label></label>
                <span>August 5, 2014 - 5:23 PM</span>            
            </div>
            <label></label>
            <div id="help">
                Having trouble with your account?
                <label></label>
                <a href="/preview/template" class="link_button_block gray">Forgot password</a>
                <a class="link_button_block gray">Forgot username</a>
                <a class="link_button_block gray">Not a member yet</a>
            </div>
            
        </div>

        <label></label>
        <div id="login_footer">
            <div class="float_left font_size_12">
                Copyright <?php echo date ('Y');?> - All rights reserved.
            </div>
            <div class="float_right font_size_12">
                Powered by <a href="http://dlsmizel.com" target="_blank">DLSMIZEL</a>
            </div>
            <label></label>
        </div>
    </div>
    
    <script type="text/javascript">
       errorMessage ="";
       hasError = false;  
        
        function validate()
        {
            resetError();
            $('#username').each(
                function()
                {
                    myVal       =   $(this).val();
                    if (myVal   == "")
                    {
                        hasError        =   true
                        myMessage       =   $(this).attr('mymessage');
                        errorMessage    +=  '<span class="color_red">' + myMessage + '</span>';
                        $(this).addClass('error');
                    }             
                    
                    else
                    {
                        if(myVal.match(/[\w\d]+([\.\_\-]?[\w\d])*\@[\w\d]+([\.\_\-]?[\w\d])*\.\w{2,3}/g))
                        {
                            $(this).removeClass('error');
                        }
                        
                        else
                        {
                            hasError        =   true
                            errorMsg        =   $(this).attr('mymessage');
                            errorMessage    +=  '<span class="color_red">' + myMessage + '</span>';
                            $(this).addClass('error');
                        }
                    }
                    
                    if(hasError ==  true)
                    {
                        $('#msg').html(errorMessage);
                        $('#msg').removeClass('display_none');
                    }
                    
                    else
                    {
                        resetError();
                    }
                });
                
                if (!hasError)
                {
                    $('#sign_in').attr('href="/user"');    
                }
        } 
        
        function resetError()
        {
            errorMessage    =   "";
            hasError        =   false;
            $('#msg').html("");
            $('#msg').addClass('display_none');
        }
        
        $(document).ready
        (
            function()
            {
                $('#username', '#password').bind('focus', function()
                {
                    $(this).removeClass('error')
                })
            }
        )                          
    </script> 
 
</body> 
</html>  


