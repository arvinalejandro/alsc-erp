<?php
class model_document_type
{    
    
    public function __construct()
    {
        $this->table_name        =    'document_type';
    }
    
# Data Select

    public function select($id,$filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           select * from document_type WHERE document_type_id = {$id}
                        ";        
                                
        $rows                =    sql_select($query);        
       
        return $list;
    }
    
 
            
}
