<?php


function view_populate($data, $template, $clear = false)
{	
	foreach($data as $key => $value)
	{
		$key			=	'{' . $key . '}';
		$value			=	$value;
		$template		=	str_replace($key, $value, $template);
	}
	if($clear)
	{
		# empties the unreplaced place holder
		$template 	= 	preg_replace("/\{(.*?)\}/", '', $template);
	}
	return $template;
}



function view_get_template($file_name, $data = array(), $clear = false)
{	
	$path	=	DIR_VIEW.$file_name.'.php';					
	if(file_exists($path)) 
	{
		$template	=	file_get_contents($path);		
		if($data)
		{
			$template	=	view_populate($data, $template, $clear);
		}		
		return $template;
	}
	else
	{
		die('Unable to read "'.$path.'":  missing template file');
	}
}

function view_get_template_xml($file_name)
{	
	$path	=	DIR_VIEW.$file_name.'.xml';					
	if(file_exists($path)) 
	{
		$data	=	simplexml_load_file($path, 'SimpleXMLElement', LIBXML_NOCDATA);		
		return $data;
	}
	else
	{
		die('Unable to read template:  Not exist');
	}					


}

function view_to_xml($string)
{	
	echo $string		=	'<?xml version="1.0" encoding="ISO-8859-1"?>' . $string;		
	$data		=	simplexml_load_string($string);		
	return $data;
		


}
	
	
	
	