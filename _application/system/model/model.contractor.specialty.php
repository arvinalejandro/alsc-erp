<?php
class model_contractor_specialty
{	
	
	public function __construct()
	{
		$this->table_name		=	'contractor_specialty';
		$this->message_insert	=	'A new entry has been successfully added.';
	}
	
# Data Select

	
	
	public function select_all_by_contractor_edit($id,$filter = '')
	{		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					contractor_specialty
					
					INNER JOIN option_contractor_specialization ON option_contractor_specialization.option_contractor_specialization_id = contractor_specialty.option_contractor_specialization_id
					
					WHERE 
					
					contractor_id = {$id}
					
					";							
		$rows	=	sql_select($query);	
		if(count($rows))
		{
			$land_  	 = 'display_none';
			$house_ 	 = 'display_none';
			$house_check = '';
			$land_check  = '';
			foreach($rows as $row)
			{		
				
				$land_								   				= ($row['option_contractor_specialization_category_id'] == 'land_development') ? '' : $land_ ;
				$land_check								   			= ($row['option_contractor_specialization_category_id'] == 'land_development') ? 'checked="checked"' : $land_check ;
				$house_									   			= ($row['option_contractor_specialization_category_id'] == 'housing') ? '' : $house_ ;
				$house_check							   			= ($row['option_contractor_specialization_category_id'] == 'housing') ? 'checked="checked"' : $house_check ;
				$list[$row['option_contractor_specialization_id']]  = 'checked="checked"';
			}
			$list['land_']  	 = $land_;
			$list['house_'] 	 = $house_;
			$list['house_check'] = $house_check;
			$list['land_check']  = $land_check;
			
		}
		else
		{
			$list	=	'';
		}
		return $list;
	}
	
	public function get_all_by_contractor_edit($id,$filter = '')
	{		
		$query	=	"SELECT 
						
						* 		
					
					FROM 
					
					contractor_specialty
					
					INNER JOIN option_contractor_specialization ON option_contractor_specialization.option_contractor_specialization_id = contractor_specialty.option_contractor_specialization_id
					
					WHERE 
					
					contractor_id = {$id}
					
					";							
		$rows	=	sql_select($query);	
		$ret	=	'';
		if(count($rows))
		{
			foreach($rows as $row)
			{		
				
				$land_								   				= ($row['option_contractor_specialization_category_id'] == 'land_development') ? '' : $land_ ;
				$land_check								   			= ($row['option_contractor_specialization_category_id'] == 'land_development') ? 'checked="checked"' : $land_check ;
				$house_									   			= ($row['option_contractor_specialization_category_id'] == 'housing') ? '' : $house_ ;
				$house_check							   			= ($row['option_contractor_specialization_category_id'] == 'housing') ? 'checked="checked"' : $house_check ;
				$list[$row['option_contractor_specialization_category_id']][]  = $row['option_contractor_specialization_name'];
			}
			if($list['housing'])
			{
				$h_count = count($list['housing']);
				$counter = 1;
				foreach($list['housing'] as $row_h)
				{
					$sep     =  ($counter < $h_count) ? ', ' : '';
					$h_list  .=  $row_h.$sep;
					$counter++;
				}
				
				$ret		.= ' <tr>
			                        <td class="color_gray">
			                           Housing :
			                        </td>
			                        <td class="color_gray" colspan="4">                           
			                            '.$h_list.'               
			                        </td>  
			                    </tr>';   
				
			}
			
			if($list['land_development'])
			{
				$l_count = count($list['land_development']);
				$counter = 1;
				foreach($list['land_development'] as $row_l)
				{
					$sep     =  ($counter < $l_count) ? ', ' : '';
					$l_list  .=  $row_l.$sep;
					$counter++;
				}
				
				$ret		.= ' <tr>
			                        <td class="color_gray">
			                           Land Development :
			                        </td>
			                        <td class="color_gray" colspan="4">                           
			                            '.$l_list.'               
			                        </td>  
			                    </tr>';   
				
			}
			
			
			
		}
		
		return $ret;
	}
	
	
# Modify

	public function insert($post,$id)
	{
		foreach($post as $specialty)
		{
			$data['contractor_id']									=     $id;
			$data['option_contractor_specialization_id']			=     $specialty;
			$sql													=	sql_insert($this->table_name, $data, 'contractor_specialty_id');				
			$return['result']										=	$sql['result'];
			$return['data']											=	$sql['data'];
			$return['message']										=	$sql['message'];	
		}
		return $return;
	}
	
	public function delete_entry($id)
	{
		sql_delete('contractor_specialty', 'contractor_id', $id);
	}
	
	
	
	
	 
	
}
 