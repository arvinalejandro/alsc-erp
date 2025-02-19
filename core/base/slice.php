<?php

/*
|-----------------------------------------------------------------------------
|	Get the server URI
|-----------------------------------------------------------------------------
*/	
	$URI	=	$_SERVER['REQUEST_URI']; // This is the raw slash based URI request. This may vary depending on the platform or the presence of .htaccess. For future upgrade, i'll later put some conditional statements here.
	
	unset($_GET[$URI]);	 // because of my htaccesss, $_GET[the uri value]. Just unset this.
	
	$URI	=	explode('/', $URI); // Lets explode the URI and use each string 

	
/*
|-----------------------------------------------------------------------------
|	Lets clean the string and assign each to $_GET
|-----------------------------------------------------------------------------
*/
	
	//Assigning of controller
	if(trim($URI[1]) != '') 
	{
		$_GET[INDEX_CONTROLLER]		=	$URI[1]; // This is the controller name. For future upgarade, lets pregmatch this for increased security. I am too busy at the moment
	}
	
	if(trim($URI[2]) != '') 
	{
		$_GET[INDEX_METHOD]			=	$URI[2]; // This is the method name. For future upgarade, lets pregmatch this for increased security. I am too busy at the moment
	}

/*
|-------------------------------------------------------------------------------------------------------------
|	The succeeding uri ie : /controller/method/var/var/var ~ let's get those variable and assign it to $_GET
|-------------------------------------------------------------------------------------------------------------
*/	
	
	$VARRAYS		=	array_slice($URI, 3); // Lets slice the array, get only the variables. We already used the the first 2.
	
	$KEYCOUNT		=	1; // I prefer to start at 1.
	
	foreach($VARRAYS as $VAL) 
	{
		$_GET["_{$KEYCOUNT}"]  	=  $VAL; // Lets put each value on $_GET array. Good thing, its global =) 
		$KEYCOUNT ++;
	}	
	
	unset($VARRAYS, $URI, $KEYCOUNT);
