<?php
class image_upload
{

	# file					=	$_FILE['file_key']
	# path					=	desitination/of/file/filename.jpg , filename ex: images/folder/dsc_oo1.jpg
	# dimension				=	MAX width,height,[aspect_ratio] (px) ex: 35,50 (force)  35,50,1 (aspect_ratio)
	# allowed_extension		=	comma saparated extensions i.e pdf,txt,xlsx,ds # null means all
	# max-size				=	max-limit : to follow
	
	public function upload($file, $name, $dimension = '200,200,1', $allowed_extension = 'jpg,gif,png,jpeg', $string_append='', $max_size = null)
	{
		$return['result']	=	false;		
		if($allowed_extension)
		{
			$result	=	$this->_validate_extension($file, $allowed_extension);
			if(!$result)
			{
				$result		=	false;
				$message	=	'Invalid file type';
			}			
		}
		
		if($result)
		{			
			$dimension		=	$this->_dimension_aspect_ratio($file, $dimension);
			$this->_create_image($file, $dimension, $name);
		}
				
		$return['result']	=	$result;	
		$return['message']	=	$message;
		$return['name']		=	$name;		
		
		return $return;
	}
	
	private function _validate_extension($file, $allowed_extension)
	{		
		$extension		=	string_file_extension($file['name']);
		$allowed_extension	=	explode(',', str_replace(' ','', $allowed_extension));
		if(in_array($extension, $allowed_extension))		
			return true;		
		else		
			return false;		
	}
		
	function _create_image($file, $dimension, $path) {
		$tmp_file 			= 	$file['tmp_name'];		
		$full_path			=	$path;
		$extension			=	string_file_extension($file['name']);		
		$extension			=	($extension == 'jpeg') ? 'jpg' : $extension;
		if($extension == 'jpg') 
		{
			$source_id		= 	imagecreatefromjpeg($tmp_file);			
		}
		if($extension == 'gif') 
		{
			$source_id 		= 	imagecreatefromgif($tmp_file);			
		}
		if($extension == 'png') 
		{
			$source_id 		= 	imagecreatefrompng($tmp_file);			
		}	
		
		$gd_tmp	=	imagecreatetruecolor($dimension['_w'], $dimension['_h']);
		imagecopyresampled($gd_tmp, $source_id, 0, 0, 0, 0, $dimension['_w'], $dimension['_h'], $dimension['w'], $dimension['h']);	
				
		
		if($extension == 'jpg') 
		{			
			imagejpeg($gd_tmp, $path, 100);				
		}
		if($extension == 'gif') 
		{
			imagegif($gd_tmp, $path, 100);			
		}
		if($extension == 'png') 
		{
			imagepng($gd_tmp, $path, 9);			
		}			
		imagedestroy($source_id);
		imagedestroy($gd_tmp);			
		
		/* For Cropping
		
		if($dimension['_h'] < $dimension['h_'])
		{
			$gd_tmp	=	imagecreatetruecolor($dimension['w_'], $dimension['h_']);
			$y		=	($dimension['h_'] - $dimension['_h']) / 2;		
			$x		=	($dimension['w_'] - $dimension['_w']) / 2;
			imagecopyresampled($gd_tmp, $source_id, $x/2, 0, $x/2, 0, $dimension['w_'], $dimension['h_'], $dimension['w'], $dimension['h']);
			#imagecopyresampled($gd_tmp, $source_id, 0, 0, 0, 0, $dimension['w_'], $dimension['h_'], $dimension['w'], $dimension['h']);
		}
			
		
		if($this->crop) 
		{		
			$gd_tmp	=	imagecreatetruecolor($cropX, $cropY);		
			imagecopyresampled($gd_tmp, $source_id, 0, 0, $x, $y, $dimension['new_width'], $dimension['new_height'], $dimension['original_width'], $dimension['original_height']);	
		}
		
		header('Content-Type: image/jpeg');
        imagejpeg($gd_tmp, NULL, 100);
		
		die();
		
		*/						
		
		
		
			
			
			
	}
	
	private function _dimension_aspect_ratio($file, $dimension)
	{		
		$dimension				=		str_replace(' ', '', $dimension);
		$dimension				=		explode(',', $dimension);
		$tmp					=		$file['tmp_name'];
		$size 					= 		getimagesize($tmp);
		$width					=		$size[0];
		$height 				=		$size[1];		
		$new_width				= 		$dimension[0];
		$new_height				=		$dimension[1];		
		
		if($new_width != '' && new_height != '') 
		{			
			if($dimension[2]) 
			{
				$comp_height	=		($height/$width) * $new_width;
				$comp_width		=		($width/$height) * $new_height;
				
				if($comp_width > $new_width) 
				{
					$final_width	=	round($new_width);
					$final_height	=	round($comp_height);	
					
					$rev_width	=	round($comp_width);
					$rev_height	=	round($new_height);
																	
				}
				else 
				{					
					$final_width	=	round($comp_width);
					$final_height	=	round($new_height);
					
					$rev_width		=	round($new_width);
					$rev_height		=	round($comp_height);
				}
			}
			else 
			{
				$final_width	=	$new_width;
				$final_height	=	$new_height;
			}			
		}
		else 
		{
			$final_width	=	$size[0];;
			$final_height	=	$size[1];
		}
		$data['w_']			=	$rev_width;
		$data['h_']			=	$rev_height;
		$data['_w']			=	$final_width;
		$data['_h']			=	$final_height;
		$data['w']			=	$size[0];
		$data['h']			=	$size[1];
		$data['crop']		=	$dimension[2];
			
		return $data;
	}
	
	
	
}
?>
