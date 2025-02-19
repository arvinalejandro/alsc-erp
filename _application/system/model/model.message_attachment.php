<?php
class model_message_attachment
{
    public function __construct()
	{
		$this->table_name		=	'message_attachment';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
	 public function select($id)
    {        
        $query     =    "
                           select * from message_attachment 
                           WHERE message_attachment_id  = {$id}
                        ";        
                                
        $rows                =    sql_select($query);  
        $row				 =    $rows[0];      
        return $row;
    }
    
     public function select_latest($id)
    {        
        $query     =    "
                           select * from message_attachment 
                           WHERE user_id  = {$id} 
                           ORDER BY message_attachment_id DESC
                        ";        
                                
        $rows                =    sql_select($query);  
        $row				 =    $rows[0];      
        return $row;
    }
	
	public function insert($post)
	{
		$sql							=	sql_insert($this->table_name, $post, 'message_attachment_id');				
		$return['result']				=	$sql['result'];
		$return['data']					=	$sql['data'];
		$return['message']				=	$sql['message'];		
		return $return;
	} 
	

	
}
?>
