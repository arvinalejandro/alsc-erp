<?php
class model_file
{
	var $database	=	'file';
	
	public function insert($post)
	{
		$columns 						=		sql_get_column($this->database);
		$data							=		sql_parse_input($post, $columns);		
		$data['file_timestamp']			=		time();	
		sql_insert($this->database, $data);
	}
		
	public function select($id)
	{
		$id		=		string_clean_number($id);
		$rows							=	sql_select("		
															select * from file 																
															WHERE
																file_id	=	{$id}		
													 ");
		return $rows[0];											 
	}
	
	
	public function update($post)
	{
		$columns 				=		sql_get_column($this->database);
		$data					=		sql_parse_input($post, $columns);		
		$id						=		$post['company_id'];
		sql_update($this->database, 'company_id', $id, $data);
	}
	
	public function delete($id, $path)
	{
		$id		=	string_clean_number($id);
		$data	=	$this->select($id);
		$pathA	=	$path . $data['file_path'];
		$pathB	=	$path . 'thumb_' . $data['file_path'];
		if(file_exists($pathA))
					unlink($pathA);
		if(file_exists($pathB))
					unlink($pathB); 
		$id		=	array($id);
		sql_delete('file', 'file_id', $id);
	}
	
	public function get_list($template, $filter = '', $template_empty = '')
	{
		$query	=	($filter) ? " where file_type = '{$filter}' " : '';
		$rows							=	sql_select
											("		
												select * from file		
												
												{$query}
																										
												order by file_timestamp DESC		
											");		
		
		$format['file_timestamp']	=	'string_date';
		$add['index']   			=    'index_' . $filter;
		
		if(count($rows))
		{
			$list	=	view_templatize($template, $rows, $format, null, $add);
		}
		else
		{
			$list	=	$template_empty;
		}
		
		return $list;
	}
	
	public function get_gallery_photo()
	{
		$rows	=	sql_select("
								
									select * from file where file_type = 'photo' order by file_id DESC
								
								");
								
		foreach($rows as $row)
		{
			$list	.=	'<li onclick="view_photo(\''.$row['file_path'].'\')">
							<p>
								<a><img src="/fpi_assets/thumb_'.$row['file_path'].'" alt="" /></a>
							</p>
							<h2>
								<a>'.(($row['file_name']) ? $row['file_name'] : "FPI Photo").'</a>
							</h2>												
						</li>';
		}
		return $list;
	}
	
	public function get_gallery_photo_home()
	{
		$rows	=	sql_select("
								
									select * from file where file_type = 'photo' order by file_id DESC
								
								");
								
		/*foreach($rows as $row)
		{
			$list	.=	'<li><a onclick="carousel_photo(\''.$row['file_path'].'\', \''.$row['file_title'].'\')"><img src="/fpi_assets/thumb_'.$row['file_path'].'" alt="" /></a></li>';
		}*/
        
        shuffle($rows);
		return $rows;
	}
	
	
	
	 
	
	public function get_home_photo()
	{
		$rows		=		sql_select
							("
								select * from file where file_type = 'home' ORDER BY file_timestamp DESC
																
							");
		if(count($rows))
		{
			foreach($rows as $row)
			$list		.=		'<li><img src="/fpi_assets/'.$row['file_path'].'" alt=""></li>';
		}
		
		
		return $list;
		
	}	
	
	public function get_home_latest_gallery()
	{
		$photos		=		sql_select
							("
								select * from file where file_type = 'photo' ORDER BY file_timestamp DESC
																
							");
							
				
		
		return $photos[0];
		
	}
	
	
	
	public function get_home_flyer()
	{
		$rows		=		sql_select
							("
								select * from file where file_type = 'flyer' ORDER BY file_timestamp ASC
																
							");
		if(count($rows))
		{
			foreach($rows as $row)
			$list		.=		'<span><a href="/fpi_assets/'.$row['file_path'].'" target="_blank">'.$row['file_name'].'</a></span>			';
		}
		
		
		return $list;
		
		
		
	}	
	
	public function get_home_videos($default = false)
	{
		$rows	=	sql_select("select * from file where file_type = 'video' order by file_id DESC limit 0, 3");
		
		if($default) return $rows[0];
		
		foreach($rows as $row)
		{
			$list	.=	'<li><a onclick="carousel_video(\''.$row['file_name'].'\', \''.$row['file_path'].'\')"><img src="/images/ico.video.small.gif" alt="" /></a></li>';
		}
		
		return $list;
		
	}
	
	public function get_gallery_videos()
	{
		$rows	=	sql_select("select * from file where file_type = 'video' order by file_id DESC");		
		
		foreach($rows as $row)
		{
			$list	.=	'<li onclick="play(\''.$row['file_path'].'\')" >
							<p>
								<a><img src="/images/ico.video.small.gif" alt="" /></a>
							</p>
							<h2>
								<a>'.$row['file_name'].'</a>
							</h2>												
						</li>';
		}
		
		return $list;
		
	}
	
	
	
	public function get_site_images()
	{
		$rows		=		sql_select
							("
								select * from file where file_type = 'site' ORDER BY file_timestamp ASC
																
							");
		
		$list		=		'<table width="100%" border="0"><tr><td align="center"></td> <td align="center">Left</td> <td align="center">Justified</td> <td align="center">Right</td></tr>';
		if(count($rows))
		{
			foreach($rows as $row)
			$list		.=		'
									<tr>
										<td align="center"><img src="/fpi_assets/thumb_'.$row['file_path'].'" /></td>
										<td align="center">{'.$row['file_id'].'}</td>
										<td align="center">|'.$row['file_id'].'|</td>
										<td align="center">['.$row['file_id'].']</td>		
										
									</tr>
								';
		}
		
		$list		.=		'</table>';
		
		return $list;
		
		
		
	}	
	
	 
	
}
?>
