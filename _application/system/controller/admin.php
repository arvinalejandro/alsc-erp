<?php
class admin
{
    
    public function __construct()
    {
    	session_check();
    }
    
    public function index()
    {      	
       
       	
    }
    
    public function update_svn()
    {
		echo '<pre>';
		echo shell_exec("svn update --username arnie --password arnie12481632alejandro /content/web/alsc");
		echo '</pre>';
       	
    }
	
	
    
    
}
