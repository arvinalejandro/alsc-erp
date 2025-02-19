<?php
class model_bank
{    
    
    public function __construct()
    {
        $this->table_name        =    'bank';
        $this->message_insert    =    'A new bank has been successfully added.';
    }
    
# Data Select

    
    public function get_rows($bank_balance)
    {        
        $query     =    "
                           select * from bank 
                           ORDER BY bank_name ASC
                        ";        
        $rows      			 =    sql_select($query);  
        $template_row        =    'finance_accounting/template/row.bank';
        $template_row        =    view_get_template($template_row);       
       # Parse
        if($rows)
        {
            foreach($rows as $row)
            {        
                $bank_balance                             =    mvc_model('model.accounting_receive')->select_bank_balance($row['bank_id']);
                $row['bank_balance']        			  =    string_amount($bank_balance['bank_balance']);
                $row['bank_balance_current']        	  =    string_amount($bank_balance['bank_balance_current']);
                $list                      				 .=    view_populate($row, $template_row);
            }   
        }
        else
        {
            $list    =    '';
        }
        return $list;
    }
    
    
    
    
 //===================================================
 
 	 public function select_bank($id)
    {        
        $query     =    "
                           select * from bank 
                           WHERE bank_id  = {$id}
                        ";        
                                
        $rows                =    sql_select($query);  
        $row				 =    $rows[0];      
        return $row;
    }
 	   
    public function select_all($filter='')
    {        
        $query     =    "
                           select * from bank 
                           
                           {$filter}
                           
                           ORDER BY bank_name ASC
                        ";        
                                
        $rows                =    sql_select($query);        
        return $rows;
    }
    
            
}
