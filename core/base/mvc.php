<?php

$MVC_LIBRARY	=	array(); 	# Initialize
$MVC_MODEL		=	array();	# Initialize
	

//	Model Loader
	function mvc_model($name)	
	{				
		global $MVC_MODEL;
		$name			=	trim($name);
		$name_path		=	DIR_MODEL.$name.'.php';
		$name_class		=	$name	=	str_replace('.', '_', $name);		
		
		if(array_key_exists($name_class, $MVC_MODEL))
		{
			return $MVC_MODEL[$name_class];
		}
		else
		{
			if(file_exists($name_path))
			{				
				require_once($name_path);
				if(class_exists($name_class))
				{					
					$MVC_MODEL[$name_class]	= new $name_class;
					return $MVC_MODEL[$name_class];
				}
				else
				{
					die('Framwork Error: Class Name "'.$name.'" From "'.$name.'.php" file does not exists');
				}	
			}	
			else
			{
				die('Model File "'.$name.'" does not exist on the Model folder');
			}
		}
	}	
	
//	MVC Sub Controller Loader
	function mvc_controller($name, $method, $parent)	
	{		
		$name			=	trim($name);
		$method			=	trim($method);
		$name_path		=	DIR_CONTROLLER.$name.'.php';
		$name_class		=	str_replace('.', '_', $name);		
		# Include File
		
		if(file_exists($name_path))
		{				
			require_once($name_path);
		}			
		else
		{			
			die('Framwork Error: Controller File "'.$name.'" does not exist on the Controller folder');
		}		
		
		if(class_exists($name_class))
		{			
			$controller_object			=	new $name_class;			
			if(method_exists($controller_object, $method))
			{			
				$controller_object->$method($parent);
			}					
			else
			{			
				$controller_object->index($parent);
			}		
		}
		else
		{			
			die('Framwork Error: Class Name "'.$name.'" From "'.$name.'.php" file does not exists');
		}		
		
	}	
	
	
//	Library Loader
	function mvc_library($name) 
	{		
		global $MVC_LIBRARY;
		$name			=	trim($name);
		$name_path		=	DIR_LIBRARY.$name.'.php';
		$name_class		=	$name	=	str_replace('.', '_', $name);		
		
		if(array_key_exists($name_class, $MVC_MODEL))
		{
			return $MVC_LIBRARY[$name_class];
		}
		else
		{
			if(file_exists($name_path))
			{				
				require_once($name_path);
				if(class_exists($name_class))
				{					
					$MVC_LIBRARY[$name_class]	= new $name_class;
					return $MVC_LIBRARY[$name_class];
				}
				else
				{
					die('Framwork Error: Class Name "'.$name.'" From "'.$name.'.php" file does not exists');
				}	
			}	
			else
			{
				die('Library File "'.$name.'" does not exist on the Library folder');
			}
		}
	}

//	View Method	
	function mvc_view($view = '') 
	{
		global $_VIEW;			
		$path	=	DIR_VIEW.$view.'.php';		
		if(file_exists($path)) 
		{			
			include($path);
		}
		else 
		{
			die(DIR_VIEW.$view.'.php');
		}						
	}
	
//	Attach View
	function mvc_attach($view = '') 
	{
		global $_VIEW;			
		$path	=	DIR_VIEW.$view.'.php';		
		if(file_exists($path)) 
		{			
			include($path);
		}
		else 
		{
			die(DIR_VIEW.$view.'.php dont exists');
		}						
	}
	
// Update view file

	function mvc_set_var($view_data)
	{
		global $_VIEW;
		$_VIEW	=	$view_data;		
	}
	
//	Get View String
	function mvc_read_view($view = '', $content = '') 
	{		
		$path	=	DIR_VIEW.$view;					
		if(file_exists($path)) 
		{
			$data	=	file_get_contents($path);
			if(is_array($content)) 
			{
				foreach($content as $key => $value) 
				{
					$search[]	=	$key;
					$replace[]	=	$value;
				}				
				$data	=	str_replace($search, $replace, $data);
			}		
			return $data;
		}
		else
		{
			die('Unable to read View File:  Not exist');
		}						
	}	