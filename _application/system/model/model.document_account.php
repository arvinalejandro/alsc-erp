<?php
class model_document_account
{    
    
    public function __construct()
    {
        $this->table_name        =    'document_account';
        $this->message_insert    =    'A new document has been successfully added.';
    }
    
# Data Select

    public function select_all($id,$filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           select 
                           
                           * ,
                           (select document_type_name from document_type where document_type_id = document_account.document_type_id) as document_type_name
                           
                           from document_account WHERE client_account_id = {$id}
                        ";        
                                
        $rows                =    sql_select($query);    
        $template_row        =    'documentation/template/row.account_document';
        $template_row        =    view_get_template($template_row);
        # Parse
        if(count($rows))
        {
            foreach($rows as $row)
            {        
                $row['document_account_date_submit']               =  (isset($row['document_account_date_submit']) ? string_date($row['document_account_date_submit']) : 'N/A' );
                $row['document_account_date_cleared']      		   =  (isset($row['document_account_date_cleared']) ? string_date($row['document_account_date_cleared']) : 'N/A' );
                $row['document_account_received_by_firstname']     =  (isset($row['document_account_received_by_firstname']) ? $row['document_account_received_by_firstname'] : 'N/A' );
                $row['status']      				   	   		   =  ($row['document_account_status'] == 1 ? 'Cleared' : 'Pending');
                $row['status_class']      				           =  ($row['document_account_status'] == 1 ? 'color_green' : 'color_red');
                $list                                             .=  view_populate($row, $template_row);
            }            
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }
    
     public function select_document($id,$filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           select 
                           
                           * ,
                           (select document_type_name from document_type where document_type_id = document_account.document_type_id) as document_type_name
                           
                           from document_account 
                           
                           WHERE document_account_id = {$id}
                        ";        
                                
        $rows      =    sql_select($query);   
        $row	   =    $rows[0];         
        return $row;
    }
    
    
     public function check_document($id)
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           select 
                           
                           * 
                           
                           from document_account 
                           
                           WHERE client_account_id = {$id}
                        ";        
                                
        $rows      =    sql_select($query);   
        if(count($rows))
        {
			return true;
        }
        else
        {
			return null;
        }
        
    }
    
     //=========================for sales commission
 public function select_docs($id,$filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           select 
                           
                           * ,
                           (select document_type_name from document_type where document_type_id = document_account.document_type_id) as document_type_name
                           
                           from 
                           
                           document_account 
                           
                           LEFT JOIN client_account
							ON client_account.client_account_id = document_account.client_account_id
							
							LEFT JOIN client
							ON client.client_id =  client_account.client_id
                           
                           
                           WHERE document_account.client_account_id = {$id}
                        ";        
                                
        $rows                =    sql_select($query);        
        $template_row        =    'sales/template/row.account_document';
        $template_row        =    view_get_template($template_row);
       // hash_dump($rows,true);
        # Parse
        if(count($rows))
        {
            foreach($rows as $row)
            {        
                $row['document_account_date_submit']       		=    (isset($row['document_account_date_submit']) ? string_date($row['document_account_date_submit']) : 'N/A' );
                $row['document_account_date_cleared']      		=    (isset($row['document_account_date_cleared']) ? string_date($row['document_account_date_cleared']) : 'N/A' );
                $row['document_account_received_by_firstname']  =    (isset($row['document_account_received_by_firstname']) ? $row['document_account_received_by_firstname'] : 'N/A' );
                $row['status']      				   			=    ($row['document_account_status'] == 1 ? 'Cleared' : 'Pending');
                $row['status_class']      				   		=    ($row['document_account_status'] == 1 ? 'color_green' : 'color_red');
                $list                                 		   .=    view_populate($row, $template_row);
            }
            
                 $template_row        							=    'sales/template/profile.document';
        	     $template_row        							=    view_get_template($template_row);
        	     $row['doc_list']								=    $list;
        	     $list                                		    =    view_populate($row, $template_row);          
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }  
    
   

# Modify

    public function insert($id)
    {
        //hash_dump($id,true);
         $id = $id *1;
        $check					=	$this->check_document($id);
        
        if(!$check)
        {
			for ($i=1;$i<4;$i++)
	         {
	                 $data['document_account_timestamp']         =    time();
	                 $data['document_account_status']         	 =    0;
	                 $data['client_account_id']            		 =    $id;
	                 $data['document_type_id']            	 	 =    $i;
	                 $sql                                    	 =    sql_insert($this->table_name, $data);
	         }
        }
               
        $return['result']                =    true;
        $return['data']                  =    $sql;
        $return['message']               =    $this->message_insert;        
    }
    
    public function update($post)
    {
        $data                           					=    sql_parse_input('document_account', $post);
        $data['document_account_date_submit']		    	=   strtotime($data['document_account_date_submit']);                    
        $data['document_account_date_cleared']		    	=   strtotime($data['document_account_date_cleared']);                    
        sql_update($this->table_name, 'document_account_id', $data['document_account_id'], $data);        
        $return['result']              						=    true;
        $return['data']                 					=    '';
        $return['message']             						=    $this->message_update;
        
    }
            
}
