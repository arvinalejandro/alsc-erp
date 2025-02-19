<?php
class model_tax_request
{	
	
	public function __construct()
	{
		$this->table_name		=	'tax_request';
		$this->message_insert	=	'A new Request has been successfully added.';
	}
	
# Data Select
	public function get_profile_row($id,$filter = '')
    {        
        $id        =    string_clean_number($id);
        
        $query     =    "
                           select 
                           
                           *,
        					(SELECT option_account_chart_child_name FROM option_account_chart_child WHERE option_account_chart_child_id = account_payable_item_detail.option_account_chart_child_id) AS option_account_chart_child_name,
        					(SELECT option_account_chart_parent_name FROM option_account_chart_parent WHERE option_account_chart_parent_id = account_payable_item_detail.option_account_chart_parent_id) AS option_account_chart_parent_name,
        					(SELECT project_name FROM project WHERE project_id = account_payable_item_detail.project_id) AS project_name,
        					(SELECT project_site_name FROM project_site WHERE project_site_id = account_payable_item_detail.project_site_id) AS project_site_name
                           
                           from 
                           
                           tax_request
                           
                           LEFT JOIN account_payable_item_detail ON  tax_request.account_payable_item_detail_id = account_payable_item_detail.account_payable_item_detail_id
                           
                           LEFT JOIN account_payable_item ON account_payable_item.account_payable_item_id = account_payable_item_detail.account_payable_item_id
                           
                           WHERE 
                           
                           tax_request.account_payable_id = {$id}
                        ";        
                                
            $rows      			 =    sql_select($query);  
		    $template_row        =    'finance_disbursement/template/row.tax_item_details';
		    $template_row        =    view_get_template($template_row);
		   # Parse
		    if($rows)
		    {
		             
		            foreach($rows as $row)
               {
				    $row['item_net_amount']       	    =    string_amount($row['item_net_amount']);
	                $row['item_tax_amount']       	    =    string_amount($row['item_tax_amount']);
	                $row['item_gross_amount']       	=    string_amount($row['item_gross_amount']);
	                $list['row']                       .=    view_populate($row, $template_row);
	                $list['total_net']                 +=    string_clean_number($row['item_net_amount']);
	                $list['total_gross']               +=    string_clean_number($row['item_gross_amount']);
	                $list['total_tax']                 +=    string_clean_number($row['item_tax_amount']);
               }
               		$list['total_net']       	    	=    string_amount($list['total_net']);
	                $list['total_gross']       	    	=    string_amount($list['total_gross']);
	                $list['total_tax']       			=    string_amount($list['total_tax']);
		        
		    }
		    else
		    {
		            $list['row']                       =    '';
	                $list['total_net']                 =    '';
	                $list['total_gross']               =    '';
	                $list['total_tax']                 =    '';
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
				$up['account_payable_item_detail_id']     =  $row;
				$up['account_payable_id']         		  =  $id;
			    $sql	                                  =	 sql_insert($this->table_name, $up);		

			}
		}
		
		$return['result']									 =	true;
		$return['data']										 =	$sql;
		$return['message']									 =	$this->message_insert;	
		return	$return;
	}
    		
}
