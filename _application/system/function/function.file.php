<?php

	function file_css_loader($files, $path = '_application/content/css/')
	{
		$files	=	str_replace(' ', '', $files);
		$files	=	explode(',', $files);
		foreach($files as $file)
		{
			$data	.=	file_get_contents($path . $file);
		}
		return $data;
	}  