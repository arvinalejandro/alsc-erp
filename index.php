<?php

	$_start	=	microtime(1);
#---------------------------------------------------------------------[Definitions]

# Session

	session_start();
	$_DATA['static']	= true;
	$_SESSION['user_id']	=	7;
    #session_destroy();

# Error

  	$ERR_SET				=		E_PARSE | E_ERROR | E_COMPILE_ERROR;
 	define(ERR_VIEW, true);


# Benchmarking

	define(SHOW_MEM, false); # display peak memory usage
	define(SHOW_TIM, false); # display peak memory usage

# Directories

	define(DIR_LOGS, 		'core/x/logs/'); # display peak memory usage
	define(DIR_BASE, 		'core/base/'); # display peak memory usage
	define(DIR_CONFIG, 		'core/config/'); # display peak memory usage
	define(DIR_MODEL, 		'_application/system/model/'); # display peak memory usage
	define(DIR_VIEW, 		'_application/system/view/'); # display peak memory usage
	define(DIR_CONTROLLER, 	'_application/system/controller/'); # display peak memory usage
	define(DIR_LIBRARY, 	'_application/system/library/'); # display peak memory usage
	define(DIR_FUNCTION, 	'_application/system/function/'); # display peak memory usage






#---------------------------------------------------------------------[Load Settings and Config | Don't change anything below]

# Error

	ini_set('display_errors', ERR_VIEW);
	error_reporting($ERR_SET);

# Configuration

	$CONFIGS	=	scandir(DIR_CONFIG);

	if($CONFIGS)
	{
		foreach($CONFIGS as $CONFIG)
		{
			if(substr($CONFIG, -4) == '.php') require_once(DIR_CONFIG.$CONFIG);
		}
	}
	else
	{
		die('Configuration files unavailable');
	}

	unset($CONFIGS);

# Functions

	$FUNCTIONS		=	scandir(DIR_FUNCTION);

	foreach($FUNCTIONS as $FUNCTION)
	{
		if(substr($FUNCTION, -4) == '.php') require_once(DIR_FUNCTION.$FUNCTION);
	}

#---------------------------------------------------------------------[function modules]

/*
|-----------------------------------------------------------------------------
|	URL Slice [utilize the slash base url complimentary to the htaccess]
|-----------------------------------------------------------------------------
*/

	include(DIR_BASE.'slice.php');

/*
|-----------------------------------------------------------------------------
|	Initialize
|-----------------------------------------------------------------------------
*/

	include(DIR_BASE.'integrate.php');


if(SHOW_MEM) echo (memory_get_peak_usage(true) / 1000000) . ' Mb <br/><br/>';

if(SHOW_TIM) echo  microtime(1) - $_start ;

