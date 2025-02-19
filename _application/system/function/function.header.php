<?php

# prevent null view output

function header_location($value)
{
	header("Location: {$value}");
	exit();
}

function header_close()
{
	echo '<script type="text/javascript">window.close()</script>';
	exit();
}

function header_location_validate($value, $required)
{
	if(!($required))
	{
		header("Location: {$value}");
		exit();
	}
	 
}

function header_csv($csv_data, $file_name = "")
{
	 $file_name		=	time() . "_{$file_name}.csv";
	 header("Content-type: application/csv");
     header("Content-disposition: attachment; filename={$file_name}");
     print($csv_data);
     exit();
}