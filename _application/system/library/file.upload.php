<?php
class file_upload
{
	
	# file					=	$_FILE['file_key']
	# path					=	desitination/of/file/
	# file_override			=	file.ext you want to replace by new upload
	# allowed_extension		=	comma saparated extensions i.e pdf,txt,xlsx,ds # null means all
	# max-size				=	max-limit : to follow
	
	public function upload($file, $path, $file_override = NULL, $allowed_exension = NULL, $max_size = 0,$id=0)
	{	
		$extension				=		string_file_extension($file['name']);				
		//die();
		if(!($this->_check_file_extension($extension, $allowed_exension)))
		{
			$return['result']	=	false;
			$return['message']	=	"{$file['name']} is a .{$extension} file which is not permitted to be uploaded <br/>";
			return $return;
		}
		if($file_override)
		{
			$file_to_remove		=	$path . $file_override;
			if(file_exists($file_to_remove))
			{
				unlink($file_to_remove);
			}
		}		
		$name					=	md5($id.'_'.$file['name']);
		$name					=	$name.'_'.$file['name'];
		$path					=	$path . $name;		
		move_uploaded_file($file['tmp_name'], $path);
		$return['result']		=	true;
		$return['message']		=	'Upload Successful';		
		$return['name']			=	$name;
		return $return;				
	}
	
	public function delete($path)
	{
		if(file_exists($path))
		{
			unlink($path);
		}		
	}	
	
	private function _check_file_extension($needle, $extensions)
	{
		$isvalid				=	false;
		if($extensions)
		{			
			$extensions			=	str_replace(' ', '', $extensions); # clean spaces
			$extensions			=	explode(',', $extensions);			
			if(in_array($needle, $extensions))
			{
				$isvalid		= 	true;
			}		
		}
		else # means no limitation.
		{
			$isvalid			= 	true;
		}		
		return $isvalid;
	}
	
}
?>
