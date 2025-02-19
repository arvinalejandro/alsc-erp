<?php
class model_ofv_request
{	
	
	public function __construct()
	{
		$this->table_name		=	'ofv_request';
		$this->message_insert	=	'A new Request has been successfully added.';
	}
	
# Data Select
	public function get_profile_row($id,$filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           select 
                           
                           *
                           from ofv_request
                           
                           LEFT JOIN account_payable_ofv ON  ofv_request.account_payable_ofv_id = account_payable_ofv.account_payable_ofv_id
                          
                           LEFT JOIN account_payable ON  account_payable_ofv.account_payable_id = account_payable.account_payable_id
                           
                           
                           WHERE 
                           
                           ofv_request.account_payable_id = {$id}
                        ";        
                                
            $rows      			 =    sql_select($query);  
		    $template_row        =    'finance_disbursement/template/row.ofv';
		    $template_row        =    view_get_template($template_row);
		   # Parse
		    if($rows)
		    {
		        foreach($rows as $row)
		        {        
		            $row['account_payable_ofv_amount']        =    string_amount($row['account_payable_ofv_amount']);
		            $row['account_payable_ofv_release_date']  =    string_date($row['account_payable_ofv_release_date']);
		            $list['rows']                            .=    view_populate($row, $template_row);
		            $list['total']                           +=    string_clean_number($row['account_payable_ofv_amount']);
		        }   
		        $list['total']                          =    string_amount($list['total']);     
		    }
		    else
		    {
		        $list    =    '';
		    }
		    return $list;
    }



# Modify

	public function insert($post,$id)
	{
		
		
		if($post)
		{
			foreach($post as $row)
			{
				$up['account_payable_ofv_id']     =  $row;
				$up['account_payable_id']         =  $id;
			    $sql	                          =	 sql_insert($this->table_name, $up);		

			}
		}
		
		$return['result']									 =	true;
		$return['data']										 =	$sql;
		$return['message']									 =	$this->message_insert;	
		return	$return;
	}
    		
}
