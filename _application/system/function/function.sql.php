<?php
	
	$_date_format1_	=	"d.M.y";
	$_style_		=	'style="font-family:Arial; color:#999; font-size:12px; display:block; width:500px; padding-bottom:30px"';
	
	
			
	function sql_connect($host, $username, $password, $database) 
	{
		$db_result	=	new mysqli($host, $username, $password, $database);		
		
		if($db_result->connect_error) 
		{
			die($db_result->connect_error);			
		}
		else 
		{
			return $db_result;
		}
	}
	
	//sql_select($query = basic sql query, returns an array);
	function sql_select($query, $file = __FILE__, $line = __LINE__) 
	{		
		$_link_				=	$GLOBALS['DB'][DB_SYSTEM_KEY];
		$result				=	mysqli_query($_link_, $query)  or _get_error($file, $line, $query, mysqli_error($_link_));							
		$count				=	mysqli_num_rows($result);		
		if($count > 0) 
		{		
			$data	 	= 	mysqli_fetch_assoc($result);
			do
			{				
				$return[]	=	 $data;				
			}
			while($data = mysqli_fetch_assoc($result));
		}
		else
		{
			$return		=	 array();
		}
		return $return;	
	}
	
	function sql_query($query)
	{		
		$_link_				=	$GLOBALS['DB'][DB_SYSTEM_KEY];
		mysqli_query($_link_, $query) or _get_error(__FILE__, __LINE__, $query, mysqli_error($_link_));	
	}
	
	
	//sql_delete('table name', 'refrence column e.g. userid', 'value for the latter column');
	function sql_delete($table, $colref, $data, $additional_filter = '') 
	{	
		$_link_				=	$GLOBALS['DB'][DB_SYSTEM_KEY];	
		if(is_array($data))
		{
			foreach($data as $row)
			{
				$rows[]	=	"'{$row}'";
			}
			$data	=	(count($rows)) ? implode(',', $rows) : '';
		} 
		else
		{
			$data	=	"'{$data}'";
		}
		$query		=	"DELETE FROM {$table} WHERE {$colref} in ({$data}) {$additional_filter}";
		
		mysqli_query($_link_, $query) or _get_error(__FILE__, __LINE__, $query, mysqli_error($_link_));				
	}	
	//sql_insert('table name', $data['column_name'] = value);
	/*
	$max['max_col']			=	column of max value;	
	$max['ref_col']			=	reference column
	$max['ref_val']			=	reference value;
	SELECT MAX(max_col) AS (max_alias) FROM table WHERE ref_col = ref_val
	$unique['column']		=	value;
	*/
	function sql_insert($table, $data, $max = '', $unique = array())
	{	
		$_link_				=	$GLOBALS['DB'][DB_SYSTEM_KEY];
		foreach($data as $key => $value) 
		{
			$a_key[] 	= $key;	
			$a_value[]	= "'".$value."'";
			$max_pair[]	=	"{$key} = '{$value}'";
		}
				
		$csv_key	= implode(',', $a_key);	
		$csv_value 	= implode(',', $a_value);			
			
		 
		if($unique)
		{
			foreach($unique as $unique_key)
			{
				$unique_pair[]		=	" {$unique_key} = '{$data[$unique_key]}' ";
			}			
			$dual_filter		=	implode(' AND ', $unique_pair);			
			$query		=	
			"
			INSERT INTO {$table}
				({$csv_key}) 			    
			SELECT 	{$csv_value}

			FROM dual  WHERE NOT EXISTS (SELECT * FROM {$table}  WHERE {$dual_filter})
			";					
		}
		else
		{
			$query 		= 		"INSERT INTO {$table} ({$csv_key}) VALUES ({$csv_value})";
		}		
						
		mysqli_query($_link_, $query) or _get_error(__FILE__, __LINE__, $query, mysqli_error($_link_));	
			
		if($max)
		{
			
			$max_filter			=	implode(' AND ', $max_pair);
		    $select_query		=	"SELECT * FROM {$table} where {$max} = (select max({$max}) from {$table} where {$max_filter})";
			$rows				=	sql_select($select_query, __FILE__, __LINE__);	
			if(count($rows))
			{
				$data['data']		=	$rows[0];
				$data['result']		=	1;
				$data['message']	=	'Success';
				
			}
			if(count($unique) > 0 && count($rows) == 0)
			{
				$existing			=	sql_select("select * from {$table} where {$dual_filter}", __FILE__, __LINE__);
				$data['data']		=	$existing[0];
				$data['result']		=	0;
				$data['message']	=	'The entry is already existing';
				
			}		
		}
		else
		{			
			$data		=	array();
		}	
		
		return $data;	
	}
	
	// f_sql_update(table name, column(field) reference name eg: userid, value of the field, array['key'] = value where 'key' = field name and value is the value)
	function sql_update($sTable, $sIdColumn, $iIdValue, $aArray, $append='') 
	{		
		$_link_				=	$GLOBALS['DB'][DB_SYSTEM_KEY];
		$file	=	__FILE__;
		$line	=	__LINE__;
		foreach($aArray as $key  => $value ){
			$aSet[1] = $key;
			$aSet[2] = "'".$value."'";
			
			$sImplode = implode('=', $aSet);
			$aFset[] = $sImplode;				
		}	
		$sCsv = implode(',', $aFset);
		//fQuery($sTable, $sIdColumn, $iIdValue, $sCsv);
		$sQuery = 'UPDATE '.$sTable.' SET '.$sCsv.' WHERE '.$sIdColumn.'='."'".$iIdValue."' ".$append;
		mysqli_query($_link_, $sQuery) or die("<span {_style_}>MYSQL ERROR on {$file}: line {$line} <br /> QUERY>> {$sQuery} <br/><br /> SQL MESSAGE:" . mysqli_error($_link_) . '</span>');
		
	}
		
	function sql_column($table_name, $dump = false)
	{		
		$_link_				=	$GLOBALS['DB'][DB_SYSTEM_KEY];
		$result				=	mysqli_query($_link_, "show full columns in {$table_name}");		
		$count				=	mysqli_num_rows($result);
		if($count > 0)
		{
			$data	 	= 	mysqli_fetch_assoc($result);
			do 
			{
				$rows[]	= $data['Field'];
			}
			while($data  =	mysqli_fetch_assoc($result));
		}
		else
		{
			$rows	=	array();
		}		
		
		if($dump) hash_dump($rows, 1); 	else return $rows;		
		
	}
	
	function sql_parse_input($table, $post)
	{        
		$columns		=	sql_column($table);       
        $data_string	=	count($post['str']) ? $post['str'] : array() ;
        $data_integer	=	count($post['int']) ? $post['int'] : array() ;
        $data_textarea	=	count($post['textarea']) ? $post['textarea'] : array() ;
        $data_mce		=	count($post['mce']) ? $post['mce'] : array() ;
              
      
        foreach($data_string as $key => $value)
        {
        	if(in_array($key, $columns))
        	{        		
        		$data[$key]		=	string_clean($value);
			}
			else
			{				
				$message[]	=	"Invalid post column : STR - <b>{$key}</b>";
			}
		}		
		
		foreach($data_integer as $key => $value)
        {
        	if(in_array($key, $columns))
        	{
        		$data[$key]		=	string_clean_number($value);
			}
			else
			{
				$message[]	=	"Invalid post column : INT - <b>{$key}</b>";
			}
		}
		
		foreach($data_textarea as $key => $value)
        {
        	if(in_array($key, $columns))
        	{
        		$data[$key]		=	string_clean_textarea($value);
			}
			else
			{
				$message[]	=	"Invalid post column : INT - <b>{$key}</b>";
			}
		}
		
		foreach($data_textarea as $key => $value)
        {
        	if(in_array($key, $columns))
        	{
        		$data[$key]		=	string_clean_textarea($value);
			}
			else
			{
				$message[]	=	"Invalid post column : INT - <b>{$key}</b>";
			}
		}
		
		foreach($data_mce as $key => $value)
        {
        	if(in_array($key, $columns))
        	{
        		$data[$key]		=	string_clean_textarea($value, false);
			}
			else
			{
				$message[]	=	"Invalid post column : INT - <b>{$key}</b>";
			}
		}
        
        if(count($message))
        {
        	$errors['invalid']	=	$message;
        	$errors['valid']	=	$columns;
        	hash_dump($errors, 1);        	
		}
		else
		{
			return $data;
		}        
		
	}	
    
    
    function sql_populate()
    {
    	die('Database columns and table doen\'t match');
	}
    
    function _get_error($file, $line, $query, $msge)
	{
		$data	=	"<span {_style_}>MYSQL ERROR on {$file}: line {$line} <br /> QUERY>> <br /> <pre> {$query} </pre> <br/><br /> SQL MESSAGE: <br />" .$msge . '</span>';
		$data	=	(_SQLERROR_) ? $data : 'DB ERROR';
		$data	.=	"<br/><br/><br/><br/><pre>" . var_export($_SESSION, true) . "</pre>"; 
		
		$to[]	=	'arvin@i4technologiesinc.com';		
		$to[]	=	'arnie.c.alejandro@gmail.com';
		
		$header['subject']			=	"SQL ERROR ({$time})";
		$header['from']				=	"info@jobcentral.com.ph";
		$header['name_first']		=	"Jobcentral";
		$header['name_last']		=	"Admin";
		$header['content']			=	$data;	
			
		hash_dump($header['content'], true);
		
		return $data;
	}
	
	function _register_query($query, $file, $line)
	{
		global $_transaction_;
		$_transaction_[]	=	"<span {_style_}>" . "File: {$file} <br />Line: {$line} <br /> Query: <br /> {$query}" . '</span>' . '<br /><br /><br />';
	}
	
	