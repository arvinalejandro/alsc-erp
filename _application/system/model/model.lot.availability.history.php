<?php
class model_lot_availability_history
{	
	
	public function __construct()
	{
		$this->table_name		=	'lot_availability_history';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	public function select($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_availability_history
					
					WHERE lot_id = {$id}
					";							
		$rows	=	sql_select($query);	

		return $rows;
	}
	
	
	
	public function check_availability($id,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_availability_history
					
					WHERE lot_id = {$id}
					
					AND option_availability_id = 'sold'
					";							
		$rows	=	sql_select($query);	
		$rows   =   count($rows);
		return $rows;
	}
	
	public function check_monthly_entry($id,$date_month,$filter = '')
	{		
		$id		=	string_clean_number($id);		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					lot_availability_history
					
					WHERE lot_id = {$id}
					
					AND DATE_FORMAT(FROM_UNIXTIME(`lot_availability_history_timestamp`), '%Y-%M') = '{$date_month}'
					";							
		$rows	=	sql_select($query);	
		$rows   =   count($rows);
		return $rows;
	}
	
	// engineering reports
	public function get_summary_inventory($year = 2015)
	{		
		
		# DB
		
		for($x=1;$x<=12;$x++)
			{
					switch ($x) 
					{
					     case 1:
					         $month  = 'January';
					         break;
					     case 2:
					         $month  = 'February';
					         break;
					     case 3:
					         $month  = 'March';
					         break;
					     case 4:
					         $month  = 'April';
					         break;
	                     case 5:
	                         $month  = 'May';
	                         break;  
	                     case 6:
	                         $month  = 'June';
	                         break;          
	                     case 7:
	                         $month  = 'July';
	                         break;    
	                     case 8:
	                         $month  = 'August';
	                         break;
	                     case 9:
	                         $month  = 'September';
	                         break;
	                     case 10:
	                         $month  = 'October';
	                         break;
	                     case 11:
	                         $month  = 'November';
	                         break;      
					     default:
					         $month  = 'December';
					}// end case
					
				$date_month  = $year.'-'.$month;	
				$query	=	"
					SELECT 
					SUM(CASE WHEN  lot_availability_history.option_availability_id = 'available' THEN lot.lot_area*lot.lot_price ELSE 0 END) AS lcp,
					SUM(CASE WHEN  lot_availability_history.option_availability_id = 'available' THEN house.house_price ELSE 0 END) AS hcp,
					SUM(CASE WHEN  lot_availability_history.option_availability_id != 'sold' THEN 1 ELSE 0 END) AS sold_uv,
					SUM(CASE WHEN  lot_availability_history.option_availability_id = 'available' THEN 1 ELSE 0 END) AS lot_uv,
					SUM(CASE WHEN  lot_availability_history.is_reopened = 1 AND lot_availability_history.option_availability_id = 'available' THEN 1 ELSE 0 END) AS re_opened_count

					FROM 

					lot_availability_history

					INNER join lot on lot.lot_id = lot_availability_history.lot_id 
					
					LEFT join house on house.house_id = lot.house_id 
									
					WHERE lot.option_unit_id = 'package'
					
				    AND DATE_FORMAT(FROM_UNIXTIME(`lot_availability_history_timestamp`), '%Y-%M') = '{$date_month}'
					
					ORDER BY lot_availability_history.lot_availability_history_timestamp DESC
					
					
					

					";
				$rows	=	sql_select($query);	
				
				foreach($rows as $row)
				{
					$lot_monthly[$month]['unit_inventory'] =  $row['lot_uv']*1;
					$lot_monthly[$month]['sold_count'] 	   =  $row['sold_uv']*1;
					$lot_monthly[$month]['lcp'] 		   =  string_amount($row['lcp']);
					$lot_monthly[$month]['hcp'] 	   	   =  string_amount($row['hcp']);
					$lot_monthly[$month]['tcp'] 	   	   =  string_amount($row['lcp']+$row['hcp']);
					$lot_monthly[$month]['reopened'] 	   =  $row['re_opened_count']*1;
				}
					
					
			}//end for loop
			
		return $lot_monthly;
	}// end get_summary_inventory()
	
	
	
# Modify

	public function insert($post)
	{
		$data['option_availability_id']								=	$post['option_availability_id'];
		$data['lot_id']												=	$post['lot_id'];
		$check_sold													=   $this->check_availability($data['lot_id']);
		$data['is_reopened']										=   ($check_sold > 0) ? 1 : 0;
		$data['is_reopened']										=   ($data['option_availability_id'] != 'available') ? 0 : $data['is_reopened'];
		$data['lot_availability_history_timestamp']					=	time();			
		$sql														=	sql_insert($this->table_name, $data, 'lot_availability_history_id');				
		$return['result']											=	$sql['result'];
		$return['data']												=	$sql['data'];
		$return['message']											=	$sql['message'];		
		return $return;
	}
	
	public function insert_monthly_status($post,$date_month)
	{
		$check_monthly_entry											=   $this->check_monthly_entry($post['lot_id'],$date_month);
		if($check_monthly_entry < 1)
		{
			$data['option_availability_id']								=	$post['option_availability_id'];
			$data['lot_id']												=	$post['lot_id'];
			$check_sold													=   $this->check_availability($data['lot_id']);
			$data['is_reopened']										=   ($check_sold > 0) ? 1 : 0;
			$data['is_reopened']										=   ($data['option_availability_id'] != 'available') ? 0 : $data['is_reopened'];
			$data['lot_availability_history_timestamp']					=	time();			
			$sql														=	sql_insert($this->table_name, $data, 'lot_availability_history_id');				
			$return['result']											=	$sql['result'];
			$return['data']												=	$sql['data'];
			$return['message']											=	$sql['message'];
		}	
		else
		{
			$return['result']											=	0;
			$return['data']												=	0;
			$return['message']											=	'Entry Exists';
		}	
				
		return $return;
	}
	
	
}
 