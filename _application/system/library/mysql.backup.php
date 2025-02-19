<?php
class mysql_backup
{
	/*
	*	determine quoted/unquoted values 
	* 	mysql_restorer
	* 	output file type ? echo, text, sql etc
	*/
	
	
	public function __construct()
	{
		$this->string_create_db		=		'';
	}
	
	public function mysql_dump($database = null)
	{
		$tables					=	$this->show_tables();
		$query_string			=	$this->create_table_query($tables);
		$query_string			=	($database) ? "CREATE DATABASE `{$database}` DEFAULT CHARACTER SET utf8;\nUSE `{$database}`;\n\n" . $query_string : $query_string;				
		return $query_string;
	}
	
	public function mysql_restore()
	{
		
	}	
	
	private function create_table_query($rows)
	{
		foreach($rows as $row)
		{
			foreach($row as $table_name)
			{
				$query_string	.=	"DROP TABLE IF EXISTS `{$table_name}`;";
				$query_string	.=	"\n";
				$query_string	.=	$this->show_create_table($table_name);
				$query_string	.=	"\n\n";
				$query_string	.=	$this->build_table_data($table_name);
				$query_string	.=	"\n\n";
			}
		}
		return $query_string;
	}
	
	private function build_table_data($table_name)
	{
		$resource_id 	=	mysql_query("select * from {$table_name}");
		$rows			=	$this->parse_query($resource_id);	
		$data_field		=	array();	
		if(count($rows))
		{
			foreach($rows as $row)
			{
				$data_value	= array();
				foreach($row as $field => $value)
				{
					$quoted_field	=	"`" . $field . "`";
					if(!in_array($quoted_field, $data_field))
					{
						$data_field[]	=	$quoted_field;
					}					
					$data_value[]	=	(is_null($value)) ? 'NULL' : "'" . addslashes($value) . "'";
				}
				$value_query[]	=	'(' . implode(', ', $data_value) . ')';
			}			
			$fields			=	'(' . implode(', ', $data_field) . ')';		
			$values			=	implode(', ', $value_query);	
			$insert_query	=	"INSERT INTO `{$table_name}`  {$fields}  \nVALUES {$values};";
		}				
		return $insert_query;
	}
	
	private function analyze_value($type)
	{
		$integers	=	array();
		
	}
	
	private function show_tables()
	{
		$resource_id 	=	mysql_query("show tables");
		$data			=	$this->parse_query($resource_id);
		return $data;
	}
	
	private function show_create_table($table_name)
	{
		$resource_id 	=	mysql_query("show create table  {$table_name}");
		$data			=	$this->parse_query($resource_id);
		return	$data[0]['Create Table'] . ';';
	}
	
	private function describe_table($table_name)
	{
		$resource_id 	=	mysql_query("describe  {$table_name}");
		$data			=	$this->parse_query($resource_id);
		return $data;
	}
	
	private function get_column_type($table_name, $column_name)
	{
		$rows	=	$this->describe_table($table_name);
		foreach($rows as $row)
		{
			$field	=	$row['Field'];
			if($field == $column_name)
			{
				return $row['Type'];
			}
		}
		
	}
	
	private function parse_query($resource_id)
	{
		$data	=	mysql_fetch_assoc($resource_id);
		$count	=	mysql_num_rows($resource_id);
		if($count > 0)
		{
			do 
			{
				$rows[]	= $data;
			}
			while($data  =	mysql_fetch_assoc($resource_id));
		}
		else
		{
			$rows	=	array();
		}		
		return $rows;
	}
	
}

