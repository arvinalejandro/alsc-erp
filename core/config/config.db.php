<?php
#---------------------------------------------------------------------[Database Definition]
# Current Connection
$DB_MODE				   					=	'mode_bans'; # remote

// System

$DB['mode_local']['system']['host']			=	'127.0.0.1'; 
$DB['mode_local']['system']['username']		=	'root'; 
$DB['mode_local']['system']['password']		=	'';
$DB['mode_local']['system']['dbname']		=	'alsc';

$DB['mode_bans']['system']['host']          =    'localhost'; 
$DB['mode_bans']['system']['username']      =    'root'; 
$DB['mode_bans']['system']['password']      =    '';
$DB['mode_bans']['system']['dbname']        =    'alsc-local';

$DB['mode_remote']['system']['host']		=	'localhost'; #'178.238.232.208';
$DB['mode_remote']['system']['username']	=	'jobcentral'; #'root';
$DB['mode_remote']['system']['password']	=	'root';'jobcentral12345'; 
$DB['mode_remote']['system']['dbname']		=	'jobcentral_system';#'jobcentral_system';

#---------------------------------------------------------------------[Constant Transform. Dont change anything below]

define('DB_WEB_HOST',			$DB[$DB_MODE]['web']['host'], true);
define('DB_WEB_USERNAME',		$DB[$DB_MODE]['web']['username'], true);
define('DB_WEB_PASSWORD',		$DB[$DB_MODE]['web']['password'], true);
define('DB_WEB_DB',				$DB[$DB_MODE]['web']['dbname'], true);
define('DB_WEB_KEY',			'web', true);

define('DB_SYSTEM_HOST',		$DB[$DB_MODE]['system']['host'], true);
define('DB_SYSTEM_USERNAME',	$DB[$DB_MODE]['system']['username'], true);
define('DB_SYSTEM_PASSWORD',	$DB[$DB_MODE]['system']['password'], true);
define('DB_SYSTEM_DB',			$DB[$DB_MODE]['system']['dbname'], true);
define('DB_SYSTEM_KEY',			'system', true);
define('DB_SYSTEM_CONNECT',		true, true);

define('DB_LOGS_HOST',			$DB[$DB_MODE]['logs']['host'], true);
define('DB_LOGS_USERNAME',		$DB[$DB_MODE]['logs']['username'], true);
define('DB_LOGS_PASSWORD',		$DB[$DB_MODE]['logs']['password'], true);
define('DB_LOGS_DB',			$DB[$DB_MODE]['logs']['dbname'], true);
define('DB_LOGS_KEY',			'logs', true);

unset($DB); # $DB will no longer be used after define