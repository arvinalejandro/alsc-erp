<?php
class model_accounting_receive 
{	
	
	public function __construct()
	{
		$this->table_name		=	'accounting_receive';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	public function select_bank_balance($bank_id, $filter = '')
	{		
		$bank_id		=	string_clean_number($bank_id);
		
		$query			=	"
								SELECT
								
								 *,
								 (SELECT SUM(bank_transaction_amount) FROM bank_transaction WHERE bank_id = {$bank_id} AND option_bank_transaction_type_id = 'in' AND is_pending=0) AS in_amount,
								 (SELECT SUM(bank_transaction_amount) FROM bank_transaction WHERE bank_id = {$bank_id} AND option_bank_transaction_type_id = 'in'  ) AS in_current,
								 (SELECT SUM(bank_transaction_amount) FROM bank_transaction WHERE bank_id = {$bank_id} AND option_bank_transaction_type_id = 'out' AND is_pending=0) AS out_amount,
								 (SELECT SUM(bank_transaction_amount) FROM bank_transaction WHERE bank_id = {$bank_id} AND option_bank_transaction_type_id = 'out'  ) AS out_current
								 
								FROM 
								
								bank
								
								WHERE 
								
								bank_id = {$bank_id}						
		
			
							";		
								
		$rows	=	sql_select($query);		
		$row	=	$rows[0];
		
		if($row)
		{
			$list['bank_balance']				=	string_clean_number($row['in_amount']) - string_clean_number($row['out_amount']);
			$list['bank_balance_current']	    =	string_clean_number($row['in_current']) - string_clean_number($row['out_current']);
			$list['in_amount']					=	string_amount($row['in_amount']);
			$list['out_amount']					=	string_amount($row['out_amount']);
			$list['bank_balance']				=   string_amount($list['bank_balance']);
		}
		else
		{
			$list			=   '';
		}
		
		
		return $list;
	}
	
	  
	
# Get Ouput

	
	
	
	
	
	 
	
}
