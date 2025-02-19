<?php

		
		
	function string_url_safe($str, $encode = true) {
		$search		=	array('&', '\\', '/', '=', '?');
		$replace	=	array('(and)', '(bslash)', '(fslash)', '(equal)', '(question)');
		if($encode) 
		{
			$data		=	str_replace($search, $replace, $str);
		}
		else 
		{
			$data		=	str_replace($replace, $search, $str);
		}		
		
		return $data;
	}
	
	function string_safe_file_name($p_filename, $append = '')
	 {
		$filename	=	str_replace(array(' ', "'", '"', '-', ','), array('_'), $p_filename);
		$filename	=	strtolower($filename);		
		$filename	=	($append) ? $append . '_' . time() . '_' . $filename : time() .'_'. $filename; 		
		return $filename;
	}
	
	function string_file_extension($str)
	{
		$str		=		strtolower($str);
		$str		=		trim($str);
		preg_match_all("/\.[a-z]*$/", $str, $match);
		$str		=		str_replace('.', '', $match[0][0]);
		return $str; 
	}
	
		
	function pr($data)
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
	
	function string_utf8_safe($string)
	{
		$string		=	utf8_encode($string);
		$string		=	utf8_decode($string);		
		return $string;
	}

#-----------------------------------------------------------------------------------------------------------------------
#---- parse input functions ----	
	
	function string_clean_textarea($str, $nl2br = true, $allowed_tags = '<label> <h1> <h2> <h3> <p> <span> <strong> <a> <ul> <li> <ol> <div> <table> <tr> <td> <b> <img> <br> <br />') 
	{
		$str	=	trim($str);
		$str	=	string_custom_decode($str);
		$str	=	strip_tags($str, $allowed_tags);
		$str	=	string_utf8_safe($str);
		if(!get_magic_quotes_gpc()) 
		{			
			$str	=	addslashes($str);
		}
		if($nl2br) {
			$str	=	nl2br($str);
		}		
		return $str;
	}
	
	function string_clean($str, $strip_tags = true) # this is default cleaner
	{		
		$data	=	trim($str);	
		$str	=	strip_tags($str);
		$str	=	string_utf8_safe($str);		
		if(!get_magic_quotes_gpc()) 
		{			
			$str	=	addslashes($str);
		}
		return $str;
	}		
	
	function string_clean_text($str, $strip_tags = true) # used only when cleaning ajax posted data
	{		
		$data	=	trim($str);
		$str	=	string_custom_decode($str);		
		$str	=	strip_tags($str);
		$str	=	string_utf8_safe($str);		
		if(!get_magic_quotes_gpc()) 
		{			
			$str	=	addslashes($str);
		}
		return $str;
	}				
		
	function string_clean_number($str) 
	{		
		$str	=	preg_replace("/[^\d\.]/", '', $str);
		$str	=	$str * 1;
		return $str;
	}		
	
	function string_echo_pr($data)
	{
		echo '<pre>';
		echo $data;
		echo '</pre>';
	}
	
	function string_custom_decode($pString)
	{
		return str_replace(array('_quote_', '_amp_', '_equal_', '_question_', '_bslash_', '_fslash_', '_plus_'), array('"', '&', '=', '?', '\\', '/', '+'), $pString);
	}
	
	function string_custom_encode($pString)
	{
		return str_replace(array('"', '&', '=', '?', '\\', '/', '+'), array('_quote_', '_amp_', '_equal_', '_question_', '_bslash_', '_fslash_', '_plus_'), $pString);
	}
	
	function string_amount($pValue)
	{
		$pValue		=	str_replace(",", '', $pValue);
		$pValue		=	$pValue * 1;		
		$pValue		=	number_format($pValue, 2, '.', ',');
		return $pValue;
	}
	
	function string_tx_id($pValue)
	{
		$prefix		=	substr($pValue, 0, 3);		
		$suffix		=	substr($pValue, -5);		
		$pValue		=	$prefix . '-' . $suffix;
		return $pValue;
	}

	function string_total_exp($wstart, $wend)
	{
		$wstart		=	explode(',', $wstart);
		$wend		=	explode(',', $wend);
		foreach($wend as $key => $value)
		{
			$end_sec	=	($value == 1) ? time() : $value;
			$diff		=	$end_sec	-	$wstart[$key];
			$total		+=	$diff;
		}
		$month	= 	2592000;
		$year	= 	31536000;
		
		if($total >= $year)
		{
			$total	=	round(($total / $year), 1);
			$total	=	($total > 1) ? "{$total} years" : "{$total} year";
		}
		else if($total >= $month)
		{
			$total	=	round(($total / $month), 1);
			$total	=	($total > 1) ? "{$total} months" : "{$total} month";
		}
		else if ($total > 0 && $total < $month || $wstart == $wend)
		{
			$total = '1 month';
		}
		else if ($total <= 0)
		{
			$total = 'n.a';
		}		
		return $total;
	}
#-----------------------------------------------------------------------------------------------------------------------
#---- customs ----	
	
	 function string_check_diff_date_current($date_stamp)
	 {
		$curr_stamp		 =  time();
		
		$year_len		 =  0;
		$month_len       =  0;
		while($curr_stamp >= $date_stamp)
		{
			//echo $date_stamp.'<br>';
			$date_stamp		=	date("F d, Y", $date_stamp);
			$date_stamp		=   strtotime($date_stamp."+1 month");
			$month_len++;
			if($month_len == 12)
			{
				$year_len++;
				$month_len=0;
			}
		}
	    $data['y']			 =	$year_len;
	    $data['m']			 =	$month_len;
	    return $data;
				
	}	
	
	function diff_date_to_current($string_date)
	 {
		$current_time    =  time();
		$diff_sec		 =	$current_time - $string_date;
		$day_to_sec	     =	3600*24;
	    $days_len		 =	floor($diff_sec / $day_to_sec);
	    return $days_len;
				
	}
	
	function diff_date_months_to_current($string_date)
	 {
		$current_time    =  time();
		$counter		 =  0;
		
		while($current_time >= $string_date)
		{
			$string_date	=	date("F d, Y", $string_date);
			$string_date	=   strtotime($string_date."+1 month");
			$counter++;
		}
		
		
	    return $counter;
	}
	
	function string_timestamp_to_age($value)
	{
		$curr_time	=	time();
		$curr_age	=	$curr_time - $value;
		$curr_age	=	$curr_age / 31536000;
		return floor($curr_age);
		
	}
	
	function string_time_remaining($timestamp, $control = 7776000) # 90 days default
	{
		$time_elapse		=		time() - $timestamp;
		$time_left			=		($control - $time_elapse) / 86400;	
		$time_left			=		ceil($time_left);
		
		if($time_left > 1)
		{
			$time_left	=	$time_left . ' days';
		}
		else if($time_left == 1)
		{
			$time_left	=	$time_left . ' day';
		}
		else
		{
			$time_left	=	'0 days';
		}
			
		return $time_left;
	}
	
	function string_timestamp_conditional($value)
	{
		$value = $value * 1;
		if($value)
		{
			return time();
		}
		else
		{
			return 0;
		}
		
	}
	
	function string_timestamp($any)
	{
		return time();
	}
	
	function string_crc($value)
	{
		$value	=	 md5(SITE_SALT . $value);
		$value	=	 $value . md5(SITE_SALT.$value);
		return $value;
	}
	
	function string_date($value)
	{			
		$value	=	date("F d, Y", $value);		
		return $value;
	}
	
	function string_date_short_month($value)
	{			
		$value	=	date("M d, Y", $value);		
		return $value;
	}
	
	function string_date_timestamp()
	{			
		$value	=	date("F d, Y");		
		$value	=	strtotime($value);
		return $value;
	}
	
	function string_date_time($value)
	{			
		$value	=	date("M.d.Y - h:i A", $value);		
		return $value;
	}
	
	function string_date_time_space($value)
	{			
		$value	=	date("n/j/Y G:i", $value);		
		return $value;
	}
	
	
	function string_date_day($value)
	{			
		$value	=	date("l - F.d.Y", $value);		
		return $value;
	}
	
	function string_date_day_enclosed($value)
	{			
		$value	=	date("M.d, Y (l)", $value);		
		return $value;
	}
	
	function string_date_time_slash($value)
	{			
		$value	=	date("n/j/Y | h:i A", $value);		
		return $value;
	}
	
	function string_time_colon($value)
	{			
		$value	=	date("h:i A", $value);		
		return $value;
	}
	
	function string_time_military($value)
	{			
		$value	=	date("H:i", $value);		
		return $value;
	}
	
	function string_time_single($value)
	{			
		$value	=	date("G", $value);		
		return $value;
	}
	
	function string_date_month($value)
	{
		return date("M", $value);
	}
	
	function string_date_month_numeric($value)
	{
		return date("n", $value);
	}
	
	function string_date_month_full($value)
	{
		return date("F", $value);
	}
	
	function string_year_month_full($value)
	{
		return date("Y-F", $value);
	}
	
	function string_date_year($value)
	{
		return date("Y", $value);
	}
	
	function string_day($value)
	{
		return date("j", $value);
	}
	
	function string_day_week($value)
	{
		return date("N", $value);
	}
	
	function crc_check_connection()
	{
		if(!$_GLOBALS['crc_verified'])
		{
			echo 'Connection to remote host refused. Data stream is null';
			die();
		}	
	}
	
	function crc_check($pCrc, $pRaw)
	{
		if($pCrc == string_crc($pRaw))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function string_date_y($value)
	{
		return date("y", $value);
	}
	
	function string_date_date($value)
	{
		return date("j", $value);
	}
	
	function string_excerp_60($value)
	{
		return substr(strip_tags($value), 0, 60) . "...";
	}
	
	function string_excerp_260($value)
	{
		return substr(strip_tags($value), 0, 260) . "...";
	}
	
	function string_space_underscore($value, $reverse=false)
	{
		if($reverse==false)
		{
		    $value		=	trim($value);	
		    $value		=	str_replace(' ', '_', $value);		
		}
		else
		{
			$value		=	trim($value);	
		    $value		=	str_replace('_', ' ', $value);
		}
		
		
		return $value;
	}
	
	function string_pr($string)
	{
		echo '<pre>';
		echo $string;
		echo '</pre>';
	}
	
	function string_trail($text, $prefix = '')
	{
		$text	=	(is_array($text)) ? print_r($text, true) : $text;
		$prefix	=	"\n\n-------------------------------------------------------------------------\n\n {$prefix} \n\n";		
		$text	=	$prefix . $text . "\n\n-------------------------------------------------------------------------\n\n";
		file_put_contents('trail.txt', $text, FILE_APPEND);
	}
		