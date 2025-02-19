<!DOCTYPE html> 
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="/_application/content/plugins/jquery.ui/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="/_application/content/css/style.global.css" />
    <link rel="stylesheet" type="text/css" href="/_application/content/css/style.id.css" />
    <link rel="stylesheet" type="text/css" href="/_application/content/css/style.class.css" />
    
     <script type="text/javascript" src="/_application/content/js/jquery.js"></script>
    <script type="text/javascript" src="/_application/content/js/jquery.json.js"></script>
    <script type="text/javascript" src="/_application/content/js/globals.js"></script>
    <script type="text/javascript" src="/_application/content/js/chart/Chart.js"></script>
    <script type="text/javascript" src="/_application/content/plugins/jquery.ui/js/jquery-ui.js"></script>
    <script type="text/javascript" src="/_application/content/plugins/tinymce/tinymce.min.js"></script>
    <title><?="{$_VIEW['_user_']['user_name']} {$_VIEW['_user_']['user_surname']}"?></title>
</head>

<body>
    <!---------- HEADER ----------->   
    <div class="content_block bg_fff pad_standard" id="header">
        <a href="/user" class="icon">
            <span id="user" class="user"></span>
        </a>
        <h1 class="float_left">
            <a href="/user">My Dashboard<!-- change to user type. link to dashboard -->
        </h1>
        <div id="upper_right_nav" class="float_right">
            <span class="alsc_logo"></span>
            <span class="user float_left"><?="{$_VIEW['_user_']['user_name']} {$_VIEW['_user_']['user_surname']}"?></span>
            <div class="bg_gray float_right quick_group">
                <div class="float_left">
                    <a class="quick_but active" href="#">
                        <span class="icon notifications"></span>
                        <span>0</span>    <!-------------------------if value is 0, display_none -->
                    </a>
                    <div class="quick_drop display_none" style="left:-365px; width:400px;">
                        <a>
                            <span class="bold">Juan dela Cruz</span>
                            made changes to Client's Details:
                            <label></label>
                            <span class="bold">Federico C. Malicdem Jr</span>.
                            <label></label>
                            <span class="color_gray float_right">May 19, 2014 - 6:31PM</span>
                            <span class="color_gray float_left">5 mins ago</span>
                            <label></label>
                        </a>
                        <a>
                            <span class="bold">Juan dela Cruz</span>
                            is requesting for your approval for
                            <span class="bold">New Payment</span>.
                            <label></label>
                            <span class="color_gray float_right">May 19, 2014 - 2:31PM</span>
                            <span class="color_gray float_left">4 hours ago</span>
                            <label></label>
                        </a>
                        <a>
                            <span class="bold">Juan dela Cruz</span>
                            is requesting for your approval for
                            <span class="bold">New Payment</span>.
                            <label></label>
                            <span class="color_gray float_right">May 16, 2014 - 5:01PM</span>
                            <span class="color_gray float_left">3 days ago</span>
                            <label></label>
                        </a>
                        <label></label>
                        <a id="load_more">Load More</a>
                    </div>
                </div>
                <div class="float_left">
                    <a id="msg_icon" class="quick_but" href="/message">
                        <span class="icon messages"></span>
                        <span  id="msg_count" class="new_count">0</span>
                    </a>
                </div>
                <div class="float_left">
                    <a class="quick_but" href="#">
                        <span class="icon people"></span>
                        <span>0</span>
                    </a>                    
                </div>
                <div class="float_left">
                    <a class="quick_but" href="/user">
                        <span class="icon settings"></span>
                    </a>
                </div>
            </div>
            <label></label>
        </div>
        <label></label>
    </div>
    
    <!---------- MAIN NAVIGATION ----------->
    <div class="content_block" id="nav_body">
        <ul id="main_navi">           
            <li>
                <a href="/user/user_module" <?=$_VIEW['user_module_class']?>>
                    <span class="icon" id="modules"></span>
                    <span>My Systems</span>
                    <?=$_VIEW['user_module']?>
                </a>
                <div id="nav_drop" class="display_none">
                    <a>Option One afasdfa sdf</a>
                    <a>Option Two</a>
                    <a>Option Three</a>
                    <a>Option Four</a>
                    <a>Option Five</a>
                </div>
            </li>
            
            <li>
                <a href="/user/hr" <?=$_VIEW['user_hr_class']?>>
                    <span class="icon" id="modules"></span>
                    <span>HR</span>
                    <?=$_VIEW['user_hr']?>
                </a>
            </li>
            
            <li style="display: none;">
                <a href="/user/user_report" <?=$_VIEW['user_report_class']?>>
                    <span class="icon one"></span>
                    <span>My Reports</span>
                    <?=$_VIEW['user_report']?>
                </a>
                <div id="nav_drop" class="display_none">
                    <a>Option One afasdfa sdf</a>
                    <a>Option Two</a>
                    <a>Option Three</a>
                    <a>Option Four</a>
                    <a>Option Five</a>
                </div>
            </li>            
            
                      
        </ul>
    </div>
    <label></label>   
    
   
 

