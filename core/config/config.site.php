<?php

#---------------------------------------------------------------------[URL defaults]

# Query String Base
define('INDEX_CONTROLLER', 				'controller', true);
define('INDEX_METHOD', 					'application', true);
	
# Default Controller
define('DF_CONTROLLER', 				'login', true);
define('DF_METHOD', 					'index', true);

#---------------------------------------------------------------------[SITE]
define('SITE_TITLE', 					'Asian Land', true);
define('SITE_SALT', 					'ALSC', true);

#---------------------------------------------------------------------[GLOBAL]

#dump	:	will hash dump the message 
#live	:	will send the email normally, 
#route	:	will send the email to email route

define('EMAIL_MODE',					'dump', 	true); 
define('EMAIL_ROUTE',					'arnie.c.alejandro@gmail.com'	, 	true);





