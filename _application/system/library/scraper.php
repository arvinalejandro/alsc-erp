<?php
class scraper
{
	
	public function __construct()
	{
			# - anti greed (.*?) - first occurence
		 $this->pattern['url_href']			=		"/\<a[^(\<a)]*href\=(\"|\')([^\s]){3,}(\"|\')/";		
	 	 $this->pattern['url_relative']		=		"/http(s)?\:\/\/\S+\//";		
	 	 $this->pattern['url_root']			=		"/http(s)?\:\/\/[\w\.\-\_]+\//";		
	 	# $this->pattern['content_email']	=		"/[\w\d]+\S*\@\S\d/";	
	 	 $this->pattern['content_email']	=		"/[\w\d]+([\.\_\-]?[\w\d])*\@[\w\d]+([\.\_\-]?[\w\d])*\.\w{2,3}/";	
	 	 
	 	 $this->pattern['js']['post']		=		"/\<h4\sclass\=\"rRowTitle\"\>.+srcr?\=11\"\s/";	
	 	 $this->pattern['js']['paging']		=		"/\<a\shref\=(\"|\')[^\"]*(\?fr\=J|\?[^\"\']*pg\=[^\"\']*)(\"|\')/";	
	 	 $this->pattern['js']['job_id']		=		"/\d+\.htm/";
	 	  	 
		 $this->strip['href'][]				=		'href=';
		 $this->strip['href'][]				=		"'";
		 $this->strip['href'][]				=		'"';
		 
		 # Accounting - Audit / Taxation / Compliance		 
		 $this->specialization['group']		=		'1';
		 $this->specialization['field']		=		'';
		 
		 
		 $this->filter['location']			=		'1'; # NCR
		 
		 #$this->filter['level']			=		'4'; # Junior/Associate Level
		 $this->filter['level']				=		'5'; # Entry Level / Fresh Graduate
		 
		 #180.191.30.132
		 
	}
	
	public function get_leads()
	{
		
		
	}
		
	public function jobstreet_leads($page)
	{
		$url			=	"http://job-search.jobstreet.com.ph/philippines/job-opening.php?area=1&option=1&job-source=1%2C64&classified=1&job-posted=0&sort=1&order=0&pg={$page}&src=16&srcr=11";
		$pattern_row	=	'/\<div\sclass\=\"rRowJob\"\>(.*?)\<div\sclass\=\"rRow\"\>/';		
		$pattern_loc	=	'/\<div\sclass\=\"rRowLoc\"(.*?)\<\/div\>/';		
		$pattern_title	=	'/\<h4(.*?)\<\/h4\>/';		
		$pattern_a		=	'/\<a(.*?)\<\/a\>/';		
		$pattern_span	=	'/\<span(.*?)\<\/span\>/';		
		$pattern_href	=	'/href\=\"(.*?)\"/';		
		$pattern_href	=	'/href\=\"(.*?)\"/';		
		$data			=	$this->get_curl($url);	
		$data			=	str_replace("\r\n", '', $data);		
		$rows			=	$this->extract_content($pattern_row, $data);	
		
		foreach($rows as $row)
		{
			# Row Elements			
			$layer			=	$this->get_and_replace($pattern_title, $row);
			
			# Title Elements
			$link			=	strip_tags($layer['extract'], '<a>');
			$link			=	$this->extract_content($pattern_href, $link, $this->strip['href']);
			$link_id		=	$this->extract_content('/\d+\.htm/', $link[0], array('.htm'));
			
			$job['bot_job_title']	=	strip_tags($layer['extract']);
			$job['bot_job_link']	=	$link[0];
			$job['bot_url_id']		=	$link_id[0];
			
			# Company Elements
			$layer					=	$this->get_and_replace($pattern_a, $layer['subject']);		
			$job['bot_job_company']			=	strip_tags($layer['extract']);
			
			# Company Elements
			$layer							=	$this->get_and_replace($pattern_span, $layer['subject']);		
			$job['bot_job_location']		=	strip_tags($layer['extract']);
			
			# Remaining Details
			$yrexp							=	$this->extract_content($pattern_loc, $layer['subject']);		
			$job['bot_job_experience']		=	strip_tags($yrexp[0]);
			
			# Specialization
			
			$specialization			=	$this->extract_content($pattern_a, $layer['subject']);		
			$job['bot_job_specialization']	=	strip_tags($specialization[0]);
									
			mvc_model('model.bot')->insert_job($job, $job['bot_url_id']);				
		}			
	}
	
	public function jobstreet_parse_company($url)
	{
		#$url							=	'http://siva-ph.jobstreet.com/_ads/ph/jobs/2013/6/new/c/80/4059373.htm?fr=21&src=12';
		$logo_link						=	'/src\=\"(.*?)\"/';
		$section						=	'/\<section\>(.*?)\<\/section\>/';
		$logo_div						=	'/\<div\sclass\=\"company\-logo\-preview\"\>(.*?)\<\/div\>/';
		$company						=	$this->get_curl($url);		
		$company						=	str_replace(array("\n"), '', $company);						
		$company						=	$this->get_and_replace($section, $company);		
		$logo							=	$this->extract_content($logo_link, $company['extract'], array('src', '"', '='));		
		$content['bot_content_logo']	=	$logo[0];
		$description					=	strip_tags($company['extract'], '<div> <strong> <br>');
		$description					=	str_replace('Company Overview', '', $description);
		$description					=	preg_replace($logo_div, '', $description);
		$content['bot_content_about']	=	$description;
		return $content;
	}
	
	public function jobstreet_parse_job($url, $job_id)
	{	
		#$url					=	'http://siva-ph.jobstreet.com/_ads/ph/jobs/2013/6/new/c/80/4059373.htm?fr=21&src=12';		
		$html5					=	'/\<\!doctype\shtml\>/';
		$pattern_company		=	'/\<span\sid\=\"company\-link\"(.*?)\<\/span\>/';
		$pattern_company_link	=	"/http:\/\/[^\,\']*/";		
		$pattern_job_resp		=	'/\<section\sid\=\"jobresp\"\>(.*?)\<\/section\>/';
		$pattern_job_req		=	'/\<section\sid\=\"jobreq\"\>(.*?)\<\/section\>/';
		$data					=	$this->get_curl($url);				
		$data					=	str_replace(array("\n"), '', $data);
		$return	=	false;
		$is_html5 				=	preg_match($html5, $data);
		$email					=	preg_match_all($this->pattern['content_email'], $data, $match);
		$email					=	trim($match[0][0]);
				
		if($is_html5 == true && strlen($email) != 0)
		{					 		
			$content['bot_url_id']					=		$job_id * 1;
						
			$content['f_specialization_id']			=	$this->specialization['group'];
			$content['f_specialization_field_id']	=	$this->specialization['field'];
			$content['f_region_id']					=	$this->filter['location'];
			$content['f_level_id']					=	$this->filter['level'];
			
			$content['bot_content_email']			=	$email;
			# Company
			$company_link							=	$this->extract_content($pattern_company, $data);
			$company_link							=	$this->extract_content($pattern_company_link, $company_link[0]);		
			$content['company_link']				=	$company_link[0];		
			# Responsiblities
			$job_resp								=	$this->extract_content($pattern_job_resp, $data, array('&nbsp;'));
			$job_resp								=	strip_tags($job_resp[0], "<h2> <ul> <li> <div> <strong>");
			$content['bot_content_responsibility']	=	$job_resp;
			# Requirement
			$job_req								=	$this->extract_content($pattern_job_req, $data, array('&nbsp;'));
			$job_req								=	strip_tags($job_req[0], "<h2> <ul> <li> <div> <strong>");		
			$content['bot_content_requirement']		=	$job_req;
			$company								=	$this->jobstreet_parse_company($content['company_link']);	
			$return	=	array_merge($company, $content);	
			
			if($company['bot_job_company'] != 'Login to view salary')
			{
				mvc_model('model.bot')->insert_content($return, $job_id * 1);
				return true;
			}		
			else
			{
				mvc_model('model.bot')->update_failed($job_id * 1);
			}				
		}		
		else
		{
			mvc_model('model.bot')->update_failed($job_id * 1);
			return false;
		}			
	}
			
	private function extract_content($pattern = "", $subject = "", $replace = array())
	{		
		$result			=		preg_match_all($pattern, $subject, $matches);
		if(count($matches[0]))
		{
			foreach($matches[0] as $string)
			{
				$value				=		str_replace($replace, "", $string);					
				$value				=		trim($value);
				$return[]			=		$value;
			}
		}
		return $return;
	}
	
	public function filter_link($url, $links, $domain_name)
	{		
		$relative	=	preg_match_all($this->pattern['url_relative'], $url, $match);
		$root		=	preg_match_all($this->pattern['url_root'], $url, $rt_match);
		$relative	=	$match[0][0];
		$root		=	$rt_match[0][0];	
		foreach($links as $link)
		{		
			if(!preg_match("/http(s)?\:\/\//", $link)) # if link doesn't have http prefix, we'll prepend the relative link to make it absolute.
			{				
				if(strpos($link, "/") === 0)
				{	
					# means the link starts with / hence relative to root				
					$link	=	$root. substr($link, 1);										
				}
				else
				{
					# means the link doesn't starts with / hence relative to folder
					$link	=	$relative.$link;
				}				
			}		
			
			if(strpos($link,$domain_name) > 0) # checks if the link is at the same domain name. to avoid external links
			{
				$return[]		=	$link;
			}						
		}
		return	$return;
	}
	
	private function get_curl($url)
	{
		# Start Curl
		$user_agent				=		'Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)'; //$_SERVER['HTTP_USER_AGENT']
		$curl					=		curl_init();
											curl_setopt($curl, CURLOPT_URL, $url);
											curl_setopt($curl, CURLOPT_HEADER, 0);
											curl_setopt($curl, CURLOPT_TIMEOUT,  0);
											curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
											curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); 
											curl_setopt($curl, CURLOPT_USERAGENT,  $user_agent);		
		# Run Curl
		return $contents 		=		curl_exec($curl);	
		
	}
		
	public function strip($key)
	{
		# Strips
		$strip['href'][]							=		'href=';
		$strip['href'][]							=		"'";
		$strip['href'][]							=		'"';
		$strip['href'][]							=		"<a";
		$strip['href'][]							=		" ";
		# Return
		return $strip[$key];
	}
	
	public function debug_get_pagination()
	{			
		$url		=	'http://job-search.jobstreet.com.ph/philippines/job-opening.php?key=&location=&specialization=&position=&ss=1&by=search&src=11';		
		$pattern	=	$this->pattern['js']['paging'];								
		$data		=	$this->get_curl($url);
		$links		=	$this->extract_content($pattern, $data, $this->strip['href']);
		$links		=	$this->filter_link($url, $links, "jobstreet.com.ph");
		
		hash_dump($links);
	}
	
	public function replace_strip($string, $replace = array(), $tags = "")
	{
		$string		=	strip_tags($string, $tags);
		$string		=	str_replace($replace, '', $string);
		
		return $string;
	}
	
	
	
	
	private function print_html($string)
	{
		hash_dump(htmlspecialchars($string));
	}
	
	
	private function get_and_replace($pattern, $data, $replace='', $limit = 2)
	{				
		preg_match_all($pattern, $data, $match);
		
		$return['subject']	=	preg_replace($pattern, $replace, $data, $limit);
		$return['extract']	=	$match[0][0];
		return $return;
	}
	
	
	public function test_run()
	{
		$rows	=	mvc_model('model.bot')->select_rows();
		
		foreach($rows as $row)
		{
			$this->jobstreet_parse_job($row['bot_job_link'], $row['bot_job_id']);
		}		
	}
	
	
	
			
}
?>
