<?php
class engineering_lot
{
    
    public function __construct()
    {    	
       	$this->controller_id 			= 	'engineering_lot';
    }
 
   public function index($parent)
    {           
        # DB
       	$data['row.lot']				=	mvc_model('model.lot')->get_engineering_lot();        
        # VIEW
        $parent->_view('lot', $data);
    } 
    
    public function profile($parent)
    {      	
    	# DB
        $data							=	mvc_model('model.lot')->select($_GET['id']); 
        $data['title']					=	mvc_model('model.lot.title')->select($_GET['id']);   
        # VIEW - side nav
        $side_nav['profile.class']		=	'bold';         	
       	$side_nav['lot_id']				=	$data['lot_id'];         	
       	$data['side_nav']				=	view_get_template($parent->controller_id.'/template/side.lot', $side_nav);           
        # VIEW
        $parent->_view('lot.profile', $data);        
    } 
    
     public function status_history($parent)
    {      	
    	# DB
		$lot_id										=   $_GET['id']*1;
		$data['status_row']							=	mvc_model('model.lot.status.history')->select_all_by_lot($lot_id);
        # VIEW - side nav
        $side_nav['status_history.class']			=	'bold';         	
       	$side_nav['lot_id']							=	$lot_id;    	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.lot', $side_nav);       
        # VIEW
        $parent->_view('lot.status_history', $data);        
    }   
    
    public function pricing($parent)
    {      	
    	# DB
        $data							=	mvc_model('model.lot')->select($_GET['id']);            
        $data['row.lot.price']			=	mvc_model('model.lot')->get_lot_price_row($_GET['id']);            
       
        # VIEW - side nav
        $side_nav['pricing.class']		=	'bold';         	
       	$side_nav['lot_id']				=	$data['lot_id'];         	
       	$data['side_nav']				=	view_get_template($parent->controller_id.'/template/side.lot', $side_nav);           
        # VIEW
        $parent->_view('lot.pricing', $data);
    }    
    
    
      public function construction_list($parent)
    {      	
    	# DB
        $lot_id							        =	$_GET['id']*1; 
        $data['con_list'] 						=   mvc_model('model.lot.construction')->get($lot_id);
        # VIEW - side nav
        $side_nav['construction_list.class']	=	'bold';         	
       	$side_nav['lot_id']						=	$lot_id;         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.lot', $side_nav);           
        # VIEW
        $parent->_view('lot.construction_list', $data);
    }  
    
     public function water_provision_history($parent)
    {      	
    	# DB
        $lot_id							        =	$_GET['id']*1;
        # VIEW - side nav
        $side_nav['water_provision.class']		=	'bold';         	
       	$side_nav['lot_id']						=	$lot_id;         	
       	$data['side_nav']						=	view_get_template($parent->controller_id.'/template/side.lot', $side_nav);           
        # VIEW
        $parent->_view('lot.water_provision_history', $data);
    } 
    
      public function electric_provision_history($parent)
    {      	
    	# DB
      	$lot_id							        	=	$_GET['id']*1;
        # VIEW - side nav
        $side_nav['electric_provision.class']		=	'bold';         	
       	$side_nav['lot_id']							=	$data['lot_id'];         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.lot', $side_nav);           
        # VIEW
        $parent->_view('lot.electric_provision_history', $data);
    }   
    
    public function remark($parent)
    {      	
    	# DB
        $data							=	mvc_model('model.lot')->select($_GET['id']);            
        $data['row.lot.remark']			=	mvc_model('model.remark')->get_row('lot', $_GET['id']);            
       
        # VIEW - side nav
        $side_nav['remark.class']		=	'bold';         	
       	$side_nav['lot_id']				=	$data['lot_id'];         	
       	$data['side_nav']				=	view_get_template($parent->controller_id.'/template/side.lot', $side_nav);           
        # VIEW
        $parent->_view('lot.remark', $data);      
    }
    
    #----------------------- Form Pages	

	public function add_construction($parent)
    {      	
    	# DB
        # VIEW - side nav
        $side_nav['add_construction.class']		    =	'bold';         	
       	$side_nav['lot_id']							=	$data['lot_id'];         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.lot', $side_nav);           
        # VIEW
        $parent->_view('lot.form.construction', $data);
    }  
	 
	
	 public function add($parent)
    {      	 
       	# DB
       	$option_project						=	mvc_model('model.option')->select_option('project', 'ORDER BY project_name ASC');       	       	   	
       	$option_availability				=	mvc_model('model.option')->select_option('option_availability', 'ORDER BY option_availability_id ASC');
       	$option_lot_property_status			=	mvc_model('model.option')->select_option('option_lot_property_status', 'ORDER BY option_lot_property_status_id ASC');  	
        # VIEW - db options
       	$data['project']					=	hash_to_option($option_project, 'project_id', 'project_name');        
       	$data['option_availability']		=	hash_to_option($option_availability, 'option_availability_id', 'option_availability_name');     
       	$data['option_prop_stat']			=	hash_to_option($option_lot_property_status, 'option_lot_property_status_id', 'option_lot_property_status_name');   
        # VIEW
        $parent->_view('lot.form', $data);        
    }
    
   
    
    public function status($parent)
    {           
       	# DB
    	$data								=	mvc_model('model.lot')->select($_GET['id']);   	
       	$option_availability				=	mvc_model('model.option')->select_option('option_availability', 'ORDER BY option_availability_id ASC');  	
       	$option_lot_property_status			=	mvc_model('model.option')->select_option('option_lot_property_status', 'ORDER BY option_lot_property_status_id ASC');  	
        # VIEW - db options
       	$data['option_availability']		=	hash_to_option($option_availability, 'option_availability_id', 'option_availability_name', $data['option_availability_id']);       
       	$data['option_prop_stat']			=	hash_to_option($option_lot_property_status, 'option_lot_property_status_id', 'option_lot_property_status_name', $data['option_lot_property_status_id']);       
        
        if($data['option_sold_status_id'] == 'for_ass')
        {
			$data['for_ass'] = 'checked="checked"';
			// hash_dump($data,1);
        }
        if($data['option_sold_status_id'] == 'acc_occ')
        {
			$data['acc_occ'] = 'checked="checked"';
        }
        if($data['option_sold_status_id'] == 'acc_not_occ')
        {
			$data['acc_not_occ'] = 'checked="checked"';
        }
        if($data['option_sold_status_id'] == 'not_acc_occ')
        {
			$data['not_acc_occ'] = 'checked="checked"';
        }
        if($data['option_sold_status_id'] == 'not_acc_not_occ')
        {
			$data['not_acc_not_occ'] = 'checked="checked"';
        }
       
        # VIEW     
        $parent->_view('lot.form.status', $data);          
    }       
    
    public function marketing($parent)
    {           
       	# DB
    	$data					=	mvc_model('model.lot')->select($_GET['id']);   	
    	$network				=	mvc_model('model.option')->select_option('network', 'ORDER BY network_name ASC');       	       	   	
       	$network_division		=	mvc_model('model.option')->select_option('network_division', 'ORDER BY network_division_name ASC');
       	$option_availability	=	mvc_model('model.option')->select_option('option_availability', 'ORDER BY option_availability_id ASC');  	
        # VIEW - db options
       	$data['network']					=	hash_to_option($network, 'network_id', 'network_name', $data['network_id']);        
       	$data['network_division']			=	hash_to_option($network_division, 'network_division_id', 'network_division_name', $data['network_division_id']);        
       	$data['option_availability']		=	hash_to_option($option_availability, 'option_availability_id', 'option_availability_name', $data['option_availability_id']);       
        # VIEW     
        $parent->_view('lot.form.marketing', $data);          
    }        
    
    public function edit($parent)
    {
    	# DB
    	$id						=   $_GET['id']*1;
    	$data					=	mvc_model('model.lot')->select($id);   	
    	$title					=	mvc_model('model.lot.title')->select($id);   	
    	$option_project			=	mvc_model('model.option')->select_option('project', 'ORDER BY project_name ASC');       	       	   	
       	$option_availability	=	mvc_model('model.option')->select_option('option_availability', 'ORDER BY option_availability_id ASC');  	
       	$title_status			=	mvc_model('model.option')->select_option('option_lot_title_status', 'ORDER BY option_lot_title_status_id ASC');  	
       	$title_name				=	mvc_model('model.option')->select_option('option_lot_title_name', 'ORDER BY option_lot_title_name_id ASC');  	
       	
        # VIEW - db options
       	$data['project']					=	hash_to_option($option_project, 'project_id', 'project_name', $data['project_id']);        
       	$data['option_availability']		=	hash_to_option($option_availability, 'option_availability_id', 'option_availability_name', $data['option_availability_id']);       
       	$data['title_status']				=	hash_to_option($title_status, 'option_lot_title_status_id', 'option_lot_title_status_name', $title['option_lot_title_status_id']);       
       	$data['title_name']					=	hash_to_option($title_name, 'option_lot_title_name_id', 'option_lot_title_name_name', $title['option_lot_title_name_id']);       
        # VIEW     
        $parent->_view('lot.form.edit', $data);    	
	}
	
	public function package_house($parent)
	{
		# DB
    	$data					=	mvc_model('model.lot')->select_this($_GET['id']);     
    	
    	$project_id				=	$data['project_id'];
    	
    	if($data['option_unit_id'] == 'package')
    	{
			$filter = " AND option_unit_construction_id NOT IN('house')";
    	}
    	$house										=	mvc_model('model.option')->select_option('house', "WHERE project_id = '{$project_id}' ORDER BY house_name ASC");
    	$cons_type									=	mvc_model('model.option')->select_option('option_unit_construction',"WHERE option_unit_construction_unit = 'lot'");
    	
    	# VIEW - db options
       	$data['house']								=	hash_to_option($house, 'house_id', 'house_name');     
       	$data['con_type']							=	hash_to_option($cons_type, 'option_unit_construction_id', 'option_unit_construction_name');     
       	 
       
       	$side_nav['package_house.class']		    =	'bold';         	
       	$side_nav['lot_id']							=	$data['lot_id'];         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.lot', $side_nav);  
       	# View
       	 $parent->_view('lot.form.package.house', $data);
	}
	
	public function package_setting($parent)
	{
		# DB
    	$data					=	mvc_model('model.lot')->select($_GET['id']);  
    	$data['user_id']		=	$parent->user['user_id'];
    	$data['con_id']			= $_POST['str']['option_unit_construction_id'];
    	if($_POST['int']['house_id'] > 0)
    	{
			$data['house']				=	mvc_model('model.house')->select($_POST['int']['house_id']);    	
    		$data['tcp']				=	($data['lot_price'] * $data['lot_area']) + $data['house']['house_price'];
    		$file_name		       	    =   'lot.form.package';
    	}
    	else
    	{
			$data['house']['house_id']  = 0;
			$file_name		        	=   'lot.form.project';
    	}
    	    	
       	$option_construction_account				=	mvc_model('model.option')->select_option('option_construction_account');
       	$option_availability	=	mvc_model('model.option')->select_option('option_availability', 'ORDER BY option_availability_id ASC');
       	$option_unit_status		=	mvc_model('model.option')->select_option('option_unit_status');
        # VIEW - db options       
       	$data['option_availability']		=	hash_to_option($option_availability, 'option_availability_id', 'option_availability_name', $data['option_availability_id']);       
        $data['option_unit_status']			=	hash_to_option($option_unit_status, 'option_unit_status_id', 'option_unit_status_name');
        $data['option_construction_account']							=	hash_to_option($option_construction_account, 'option_construction_account_id', 'option_construction_account_name');    
        
       
        $data['esitmated_cost']                     =   ($data['con_id'] == 'house') ? $data['house']['house_price'] : 'no';
        $side_nav['package_house.class']		    =	'bold';         	
       	$side_nav['lot_id']							=	$data['lot_id'];         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.lot', $side_nav);
        # VIEW     
        $parent->_view($file_name, $data); 
	}
	
	
	#----------------------- Form Actions

	public function submit($parent)
	{	
		$id 				=	string_clean_number($_POST['id']);		
		$project_site		=	$_POST['project_site'];
		$block				=	$_POST['block'];
		$lot_post			=	$_POST['lot'];
		$remark				=	$_POST['remark'];
		$title				=   $_POST['lot_title'];
		$user_id			=	$parent->user['user_id'];
		if($id) # Update
		{			
			# model.lot								
			mvc_model('model.lot')->update($lot_post, $id,$parent->user['user_id']);
			# model.lot.title								
			mvc_model('model.lot.title')->update($title, $id);			
			
			# Lot Price
			$price['lot_id']			=	$id;
			$price['user_id']			=	$user_id;
			$price['lot_price']			=	$lot_post['int']['lot_price'];
			if($price['lot_price'] != $_POST['lot_price'])
			{
				mvc_model('model.lot')->insert_lot_price($price, $user_id);
			}			
			# model.remark			
			$remark['int']['user_id']			=	$user_id;
			$remark['int']['remark_key_id']		=	$id;
			mvc_model('model.remark')->insert($remark);	
					
			header_location("/engineering/lot/profile/&id={$id}");
		} 
		else # Insert
		{				
			# model.project_site			
			$project_site								=	mvc_model('model.project_site')->insert($project_site);			
			$project_site								=	$project_site['data'];	
			# model.project_site_block		
			$block_from			=	$block['int']['project_site_block_name'] * 1;
			$block_to			=	$_POST['project_site_block_name_to'] * 1;			
			if($block_to > 1)
			{
				do
				{
					$block['int']['project_site_block_name']	=	$block_from;			
					$block['int']['project_id']					=	$project_site['project_id'];			
					$block['int']['project_site_id']			=	$project_site['project_site_id'];
					$block										=	mvc_model('model.project_site_block')->insert($block);
					$block_batch[]								=	$block['data'];
					$block_from ++;
				}
				while($block_to >= $block_from);
			}
			else
			{
				$block['int']['project_site_block_name']	=	$block_from;			
				$block['int']['project_id']					=	$project_site['project_id'];			
				$block['int']['project_site_id']			=	$project_site['project_site_id'];
				$block										=	mvc_model('model.project_site_block')->insert($block);
				$block_batch[]								=	$block['data'];
			}			
									
			$lot_from				=	$lot_post['int']['lot_name'] * 1;
			$lot_to					=	$_POST['lot_name_to'] * 1;	
			
			foreach($block_batch as $block_data)
			{
				$lot_from_count	=	$lot_from;
				if($lot_to > 1)
				{
					do
					{
						$lot										=	$lot_post;
						$lot['int']['project_id']					=	$block_data['project_id'];
						$lot['int']['project_site_id']				=	$block_data['project_site_id'];	
						$lot['int']['project_site_block_id']		=	$block_data['project_site_block_id'];					
						$lot['int']['lot_name']						=	$lot_from_count;						
						$lot										=	mvc_model('model.lot')->insert($lot);	
						# Price					
						if($lot['result'] * 1)
						{							
							# FOR Documentation
							mvc_model('model.document_lot')->insert($lot['data']['lot_id']);
							# FOR Lot TItle
							mvc_model('model.lot.title')->insert($lot['data']['lot_id']);
							# Lot Price						
							mvc_model('model.lot')->insert_lot_price($lot['data'], $user_id);
							# history
							$history_post['lot_id']						=	$lot['data']['lot_id'];
							$history_post['option_availability_id']		=	$lot['str']['option_availability_id'];
							mvc_model('model.lot.availability.history')->insert($history_post);
							# Remark
							$remark['int']['user_id']					=	$user_id;
							$remark['int']['remark_key_id']				=	$lot['data']['lot_id'];
							mvc_model('model.remark')->insert($remark);	
						}
						$lot_from_count ++;
					}
					while($lot_to >= $lot_from_count);
				}
				else
				{
					$lot										=	$lot_post;
					$lot['int']['project_id']					=	$block_data['project_id'];
					$lot['int']['project_site_id']				=	$block_data['project_site_id'];	
					$lot['int']['project_site_block_id']		=	$block_data['project_site_block_id'];					
					$lot['int']['lot_name']						=	$lot_from_count;						
					$lot										=	mvc_model('model.lot')->insert($lot);	
					# Price					
					if($lot['result'] * 1)
					{						
						hash_dump($lot);
						# FOR Documentation
						mvc_model('model.document_lot')->insert($lot['data']['lot_id']);
						# Lot Price						
						mvc_model('model.lot')->insert_lot_price($lot['data'], $user_id);
						# FOR Lot TItle
						mvc_model('model.lot.title')->insert($lot['data']['lot_id']);
						# history
						$history_post['lot_id']						=	$lot['data']['lot_id'];
						$history_post['option_availability_id']		=	$lot['str']['option_availability_id'];
						mvc_model('model.lot.availability.history')->insert($history_post);
						# Remark
						$remark['int']['user_id']					=	$user_id;
						$remark['int']['remark_key_id']				=	$lot['data']['lot_id'];
						mvc_model('model.remark')->insert($remark);	
					}		
				} 
			}		
			header_location('/engineering/lot');
		}		
	} 
	
	public function submit_package($parent)
	{		
		$lot_id								=	$_POST['id'] * 1;
		$remark								=	$_POST['remark'];
		$remark['int']['user_id']			=	$parent->user['user_id'];
		$remark['int']['remark_key_id']		=	$lot_id;
		
		$_POST['lot_construction']['int']['lot_construction_date_start'] = strtotime($_POST['lot_construction_date_start']);
		if($_POST['req_type']=='house')
		{
			mvc_model('model.lot')->update($_POST['lot'], $_POST['id'],$parent->user['user_id']);	
		}
		
		mvc_model('model.lot.construction')->insert($_POST['lot_construction']);
		mvc_model('model.remark')->insert($remark);		
			
		header_location("/engineering/lot/construction_list/&id={$lot_id}");
	}
	
	public function submit_status($parent)
	{
		$id 	=	string_clean_number($_POST['id']);
					mvc_model('model.lot')->update_earnest($_POST, $id,$parent->user['user_id']); 
		
		
		$remark								=	$_POST['remark'];
		$remark['int']['user_id']			=	$parent->user['user_id'];		
		
		mvc_model('model.remark')->insert($remark);
		
		header_location("/engineering/lot/profile/&id={$id}");
	}
	
	public function submit_remark($parent)
	{
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/engineering/lot/remark/&id={$_POST['lot_id']}");
	}
    
  
 #---------------------------------Ajax		 
	
    public function get_contractor($parent)
    {
       if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
        {
            if($_POST['con_type'] == 'in_house')
            {
				$filter = "WHERE option_contractor_type_id = 'in_house'";
            }
            elseif($_POST['con_type'] == 'external')
            {
				$filter = "WHERE option_contractor_type_id = 'external'";
            }
            else
            {
				$filter = "WHERE option_contractor_type_id = 'none'";
            }
            $contractor                            	     =    mvc_model('model.option')->select_option('contractor', $filter.' ORDER BY contractor_name ASC');
            $data                                        =    hash_to_option($contractor, 'contractor_id', 'contractor_name');
            echo $data; exit();
        }
        else
        {
            echo '';
        }
    }   
    
}
