<?php
class model_category
{
	var $database	=	'category';
		
	public function insert($post)
	{
		$columns 				=		sql_get_column($this->database);
		$data					=		sql_parse_input($post, $columns);		
		sql_insert($this->database, $data);
	}
	
	public function select($id)
	{
		$id						=	string_clean_number($id);
		$rows					=	sql_select("select * from category where category_id = '{$id}'");
		return $rows[0];
	}
	
	
	public function update($post)
	{
		$columns 				=		sql_get_column($this->database);
		$data					=		sql_parse_input($post, $columns);		
		$id						=		$data['category_id'];
		sql_update($this->database, 'category_id', $id, $data);
	}
	
	public function delete($post)
	{
		if(count($post))
		{
			sql_delete('category', 'category_id', $post);
		}
	}
	
	public function get_list($template, $category_type_id, $view_row_0_template)
	{
		$rows							=	sql_select("		
															select * from category where category_type_id = '{$category_type_id}' order by category_name ASC	
															
													 ");	
		
		$include['category_id']['crc']	=	'string_crc';							 		
		if(count($rows))
		{
			$list	=	view_templatize($template, $rows, null, $include);
		}
		else
		{
			$list	=	$view_row_0_template;
		}
		return $list;
	}
	
	public function get_list_option($table, $type, $id = null)
	{
		$rows							=	sql_select("select * from {$table} where category_type_id = '{$type}' order by category_name ASC");
		$column_name					=	$table . '_name';
		$column_id						=	$table . '_id';
		if(count($rows))
		{
            $default    =   '<option value="" selected="selected">--</option>'; # no use at the moment
			foreach($rows as $row)
			{
			    
                if($id == $row[$column_id]) 
                {
                    $selected       =  'selected="selected"';
                    $default        =   '';
                }
                else
                {
                    $selected   =   '';
                }
				$list		.=		'<option value="'.$row[$column_id].'" '.$selected.'>'.$row[$column_name].'</option>';
			}
            $list   .=     $default; 			
		}
		return $list;
	}
	   
	public function get_list_filter($template, $filters = array())
	{
		$category_type_rows     =   sql_select("select * from category_type");
        $f_head                 =   $template->filter_head;
        $f_body                 =   $template->filter_body;
        
        
        foreach($category_type_rows as $key => $category_type_row)
        {
            if($category_type_row['category_type_id'] == 'us_airport')
            {
            	/*
            	# Append two entries for us_airport
        		$departure['category_type_id']		=	'departure_us_airport';
        		$departure['category_type_name']	=	'US Airport Departure';        
        		$departure['share']					=	'us_airport';
        				
        		$arrival['category_type_id']		=	'arrival_us_airport';
        		$arrival['category_type_name']		=	'US Airport Arrival';        		
        		$arrival['share']					=	'us_airport';
            	
            	$category_type_rows[]				=	$arrival;
            	$category_type_rows[]				=	$departure;
            	*/
            	unset($category_type_rows[$key]);
            }
		}  
		  
		#hash_dump($category_type_rows, 1);
               	        
        foreach($category_type_rows as $category_type_row)
        {            
        	
            $category_id		=	($category_type_row['share']) ? $category_type_row['share'] : $category_type_row['category_type_id'];
            $category_rows      =   sql_select("select * from category where category_type_id = '{$category_id}' ORDER BY category_name ASC");
            
            foreach($category_rows as $row)
            {  
                $type           =   'category_'. $category_type_row['category_type_id'];
                $checked        =   '';
                $display		=	'display_none';
                if(is_array($filters[$type]))
                {
                    $display		=	'';
                    if(in_array($row['category_id'], $filters[$type]))
                    {
                        $checked        =   'checked="checked"';
                    } 
                }    
                if(!in_array($category_type_row['category_type_id'], array('us_airport', 'citizenship', 'country', 'bank', 'post_program')))
                {
                    $head		=   str_replace(array('{category_type_name}', '{category_type_id}'), array($category_type_row['category_type_name'], 'category_' . $category_type_row['category_type_id']), $f_head);
                    $list      .=  str_replace(array('{category_type_id}', '{category_id}', '{category_name}', '{checked}', '{_display_}'), array($type, $row['category_id'], $row['category_name'], $checked, $display), $f_body);
                }
                
            }
            
            $list			=	$this->overflow($list);
			
			$this->final_list[$category_type_row['category_type_name']]		=	$head.$list;
			
			$list			=	'';
			$head			=	'';
            
        }       
        
        return $final_list;      
	}
	
	
	
	
	public function generate_document_filter($template, $filters = array())
	{
		$documents				=	sql_select('select * from document');
		$label					=	"Uploaded Documents";
		$type					=	'document';
		$f_head                 =   $template->filter_head;
        $f_body                 =   $template->filter_body;
		
		$head					=   str_replace(array('{category_type_name}', '{category_type_id}'), array($label, $type), $f_head);
		
		foreach($documents as $document)
		{
			$checked        =   '';
			$display		=	'display_none';
			if(is_array($filters[$type]))
            {
            	$display		=	'';
                if(in_array($document['document_id'], $filters[$type]))
                {
                    $checked        =   'checked="checked"';
                } 
            }
            $list      .=  str_replace(array('{category_type_id}', '{category_id}', '{category_name}', '{checked}', '{_display_}'), array($type, $document['document_id'], $document['document_name'], $checked, $display), $f_body); 
			
		}
		
		$list			=	$this->overflow($list);
			
		$this->final_list[$label]		=	$head.$list;	
				
		return $final_list;		
	}
	
	
	
	
	private function overflow($list)
	{
		$data		=		'<tr>';
		$data		.=			'<td colspan="2">';
		$data		.=			'<div style="max-height:250px; overflow:auto">';					
		$data		.=			'<table width="95%" border="0" cellpadding="0" cellspacing="0">';
								
		$data		.=				$list;
		$data		.=			'</table>';
		$data		.=			'</div>';
		
		$data		.=			'</td>';
		$data		.=		'</tr>';
		return $data;
	}
	
	
}

