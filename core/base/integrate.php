<?php	
#---------------------------------------------------------------------[Parse URL and get the controller/method]
	
$CONTROLLER		=		($_GET[INDEX_CONTROLLER]) ? 	$_GET[INDEX_CONTROLLER] : DF_CONTROLLER;
$CONTROLLER		=		str_replace('.', '_', $CONTROLLER); # make sure child controllers binded by . are not loaded
$CMETHOD		=		($_GET[INDEX_METHOD]) ?		 	$_GET[INDEX_METHOD] : DF_METHOD;


#----------------------------------------------------------------------[DB Connection]

if(DB_SYSTEM_CONNECT) 
{
	$DB[DB_SYSTEM_KEY]	= sql_connect(DB_SYSTEM_HOST, DB_SYSTEM_USERNAME, DB_SYSTEM_PASSWORD, DB_SYSTEM_DB);
}

#---------------------------------------------------------------------[Include controller file if existing]

if(file_exists(DIR_CONTROLLER.$CONTROLLER.'.php'))
{		
	include(DIR_BASE.'mvc.php');				
	include(DIR_CONTROLLER.$CONTROLLER.'.php');	
	# Instatiate controller
	$CCALL	=	new $CONTROLLER;
}
else 
{
	die('Invalid Controller');	
}

#---------------------------------------------------------------------[Check if method exist]

if(method_exists($CCALL, $CMETHOD)) 
{
	$CCALL->$CMETHOD();
}
else 
{
	die('Invalid Method');
};

