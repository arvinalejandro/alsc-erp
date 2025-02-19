<?php
class report_generator
{
    
    public function __construct()
    {
       
    }
    
    public function index()
    {		
    	$data	=	view_get_template('template');
		header_csv($data, $file_name = "Export");
    }
    
} 