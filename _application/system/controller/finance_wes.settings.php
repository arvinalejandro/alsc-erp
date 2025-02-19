<?php
class finance_wes_settings
{
    
    public function __construct()
    {    	
       	$this->controller_id 			= 	'finance_wes_settings';
    }
 
   public function index($parent)
    {           
        # DB
        
        # VIEW
        $this->rates($parent);
    } 
    
    public function rates($parent)
    {      	
    	# DB
		$data['table_row']							=	mvc_model('model.option.wes.electric.rate')->select_all();
		$data['table_row']						   .=	mvc_model('model.option.wes.water.rate')->select_all();
        # VIEW - side nav
        $side_nav['rates.class']					=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);       
        # VIEW
        $parent->_view('settings.rates', $data);        
    } 
    
    public function other_charges($parent)
    {      	
    	# DB
		$data['table_row']							=	mvc_model('model.option.wes.charge')->select_all();
        # VIEW - side nav
        $side_nav['other_charges.class']			=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);       
        # VIEW
        $parent->_view('settings.other_charges', $data);        
    } 
    
    public function surcharge($parent)
    {      	
    	
    	# DB
		$data										=	mvc_model('model.sysglobal_wes')->select();
    	# VIEW - side nav
        $side_nav['surcharge.class']				=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);       
        # VIEW
        $parent->_view('settings.surcharge', $data);          
    } 
    
   
    
    public function remark($parent)
    {
    	# DB
       // $data										=	mvc_model('model.project')->select($_GET['id']);            
      //  $data['row.remark']						=	mvc_model('model.remark')->get_row('project', $_GET['id']);            
        # VIEW - side nav
        $side_nav['remark.class']					=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);           
        # VIEW
        $parent->_view('settings.remark', $data);      
	}
    
 //======================================FORMS
 
    public function add_new_rate($parent)
    {
    	# DB
       	$project									=	mvc_model('model.option')->select_option('project');
       	$data['p_id']								=   '<div style="border:none">
       													<input id="all_p"   style="width:20px;" type="checkbox" name="project_id[]" value="0" onclick="check_box()" />
														<span class="float_right" style="width:94%;margin-top: -5px;">All Projects</span></span><label></label>
														</div>';
       	foreach($project as $row)
       	{
			$data['p_id']						  .=   '<div class="projects_"  style="border:none">
														<input  style="width:20px;" class="check_projs"  type="checkbox" name="project_id[]" value="'.$row['project_id'].'" />
														<span class="float_right" style="width:94%;margin-top: -5px;">'.$row['project_name'].'</span><label></label>
														</div>';
       	}
        # VIEW - side nav
        $side_nav['rates.class']					=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.add.rates', $data);        
	}
	
	public function add_new_rate_child($parent)
    {
    	$id											=  $_GET['id']*1;
    	$type										=  $_GET['type'];
    	# DB
        $data['id']                               	=   $id;
        $data['type']                               =   $type;
        # VIEW - side nav
        $side_nav['rates.class']					=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.add.rates.child', $data);        
	}
	
	
	 public function add_group($parent)
    {
    	# DB
       	
        # VIEW - side nav
        $side_nav['other_charges.class']			=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.add.group', $data);        
	}
	
	
	 public function add_other_charge($parent)
    {
    	# DB
       	$group										=	mvc_model('model.option')->select_option('option_wes_charge_group');
       	$project									=	mvc_model('model.option')->select_option('project');
       	$data['p_id']								=   '<div style="border:none">
       													<input id="all_p"   style="width:20px;" type="checkbox" name="project_id[]" value="0" onclick="check_box()" />
														<span class="float_right" style="width:95%;margin-top: -5px;">All Projects</span></span><label></label>
														</div>';
       	foreach($project as $row)
       	{
			$data['p_id']						  .=   '<div class="projects_"  style="border:none">
														<input  style="width:20px;" class="check_projs"  type="checkbox" name="project_id[]" value="'.$row['project_id'].'" />
														<span class="float_right" style="width:95%;margin-top: -5px;">'.$row['project_name'].'</span><label></label>
														</div>';
       	}
       	
		$data['group']								=	hash_to_option($group, 'option_wes_charge_group_id', 'option_wes_charge_group_name');
        # VIEW - side nav
        $side_nav['other_charges.class']			=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.add.other_charges', $data);        
	}
	
	 public function edit_other_charge($parent)
    {
    	$id											=  $_GET['id']*1;
    	
    	$data										=  mvc_model('model.option.wes.charge')->select($id);
    	
    	# DB
       	$group										=	mvc_model('model.option')->select_option('option_wes_charge_group');
       	$project									=	mvc_model('model.option')->select_option('project');
       	$project_charge								=	mvc_model('model.option_wes_charge_project')->select_all($id);
		foreach($project_charge as $id_row)
		{
			$pc_id[]  = $id_row['project_id'];
		}
		
		$checked									=   (in_array(0,$pc_id)) ? 'checked="checked"' : '';
		
		$data['p_id']								=   '<div style="border:none">
       													<input id="all_p"  style="width:20px;" type="checkbox" name="project_id[]" value="0" '.$checked.' onclick="check_box()"/>
														<span class="float_right" style="width:95%;margin-top: -5px;" >All Projects</span></span><label></label>
														</div>';
       	foreach($project as $row)
       	{
			$checked							   =   (in_array($row['project_id'],$pc_id)) ? 'checked="checked"' : '';
			$data['p_id']						  .=   '<div class="projects_"  style="border:none">
														<input  style="width:20px;" class="check_projs" type="checkbox" name="project_id[]" value="'.$row['project_id'].'" '.$checked.'/>
														<span class="float_right" style="width:95%;margin-top: -5px;">'.$row['project_name'].'</span><label></label>
														</div>';
       	}
		
		$data['group']								=	hash_to_option($group, 'option_wes_charge_group_id', 'option_wes_charge_group_name',$data['option_wes_charge_group_id']);
        # VIEW - side nav
        $side_nav['other_charges.class']			=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.edit.other_charges', $data);        
	}
	
	
	public function edit_rate($parent)
    {
    	$id											=   $_GET['id']*1;
    	$type										=   $_GET['type'];
    	$project_charge								=   '';
    	# DB
    	if($type == 'water')
    	{
			$data 									= mvc_model('model.option.wes.water.rate')->select($id);
			$data['rate_name']						= $data['option_wes_water_rate_name'];
			$data['due_days']						= $data['option_wes_water_rate_due_day'];
			$data['due_days_disc']					= $data['option_wes_water_rate_day_limit'];
			$data['rate_row']						=	mvc_model('model.option.wes.water.rate.child')->select_by_rate_id($id);
			$project_charge							=	mvc_model('model.option.wes.water.rate.project')->select_all($id);
    	}
    	else
    	{
			$data 									= mvc_model('model.option.wes.electric.rate')->select($id);
			$data['rate_name']						= $data['option_wes_electric_rate_name'];
			$data['due_days']						= $data['option_wes_electric_rate_due_day'];
			$data['due_days_disc']					= $data['option_wes_electric_rate_day_limit'];
			$data['rate_row']						=	mvc_model('model.option.wes.electric.rate.child')->select_by_rate_id($id);
			$project_charge							=	mvc_model('model.option.wes.electric.rate.project')->select_all($id);
    	}
    	//--
    	$project									=	mvc_model('model.option')->select_option('project');
       	
		foreach($project_charge as $id_row)
		{
			$pc_id[]  = $id_row['project_id'];
		}
		
		$checked									=   (in_array(0,$pc_id)) ? 'checked="checked"' : '';
		
		$data['p_id']								=   '<div style="border:none">
       													<input id="all_p"  style="width:20px;" type="checkbox" name="project_id[]" value="0" '.$checked.' onclick="check_box()"/>
														<span class="float_right" style="width:94%;margin-top: -5px;" >All Projects</span></span><label></label>
														</div>';
       	foreach($project as $row)
       	{
			$checked							   =   (in_array($row['project_id'],$pc_id)) ? 'checked="checked"' : '';
			$data['p_id']						  .=   '<div class="projects_"  style="border:none">
														<input  style="width:20px;" class="check_projs" type="checkbox" name="project_id[]" value="'.$row['project_id'].'" '.$checked.'/>
														<span class="float_right" style="width:94%;margin-top: -5px;">'.$row['project_name'].'</span><label></label>
														</div>';
       	}
       	//--
       	$data['type']                               =   $type;
       	$data['id']                               	=   $id;
        # VIEW - side nav
        $side_nav['rates.class']					=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
     	# VIEW
        $parent->_view('settings.form.edit.rates', $data);        
	}
	
	public function edit_rate_child($parent)
    {
    	$id											=   $_GET['id']*1;
    	$rate_id									=   $_GET['rate']*1;
    	$type										=   $_GET['type'];
    	# DB
    	if($type == 'water')
    	{
			
			
			$data 									= mvc_model('model.option.wes.water.rate.child')->select($rate_id);
			$data['amount']							= $data['option_wes_water_rate_child_amount'];
			$data['min_reading']					= $data['option_wes_water_rate_child_min'];
			$data['max_reading']					= ($data['option_wes_water_rate_child_max'] == 999999999999) ? 'No Maximum' : $data['option_wes_water_rate_child_max'];
			$data['_checked_']						= ($data['option_wes_water_rate_child_max'] == 999999999999) ? 'checked="checked"' : '';
    	}
    	else
    	{
			$data 									= mvc_model('model.option.wes.electric.rate.child')->select($rate_id);
			$data['amount']							= $data['option_wes_electric_rate_child_amount'];
			$data['min_reading']					= $data['option_wes_electric_rate_child_min'];
			$data['max_reading']					= ($data['option_wes_electric_rate_child_max'] == 999999999999) ? 'No Maximum' : $data['option_wes_electric_rate_child_max'];
			$data['_checked_']						= ($data['option_wes_electric_rate_child_max'] == 999999999999) ? 'checked="checked"' : '';
    	}
    	
       	$data['type']                               =   $type;
       	$data['id']                               	=   $id;
       	$data['rate_id']                          	=   $rate_id;
        # VIEW - side nav
        $side_nav['rates.class']					=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
     	# VIEW
        $parent->_view('settings.form.edit.rates.child', $data);        
	}
	
	public function edit_surcharge($parent)
    {
    	# DB
       	$data										=	mvc_model('model.sysglobal_wes')->select();
        # VIEW - side nav
        $side_nav['rates.class']					=	'bold';         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.settings', $side_nav);         	          
       
     	# VIEW
        $parent->_view('settings.form.edit.surcharge', $data);        
	}
  
    
  #----------------------- Form Actions
  
  public function submit_add_rate($parent)
	{		
		$type										=   $_POST['type'];
		
		if($type == 'water')
		{
			$post['int']['option_wes_water_rate_due_day']					=	$_POST['due_days'];
			$post['int']['option_wes_water_rate_day_limit']					=	$_POST['due_days_disc'];
			$post['str']['option_wes_water_rate_name']						=	$_POST['rate_name'];
			$entry 															= mvc_model('model.option.wes.water.rate')->insert($post);
			
			if(count($_POST['project_id']) > 0)
			{
				foreach($_POST['project_id'] as $p_id)
				{
					$rate_post['option_wes_water_rate_id']    	      = $entry['data']['option_wes_water_rate_id'];
					$rate_post['project_id']    			 	 	  = $p_id;
					$entry_rate = mvc_model('model.option.wes.water.rate.project')->insert($rate_post);
				}
			}
		}
		else
		{
			$post['int']['option_wes_electric_rate_due_day']				=	$_POST['due_days'];
			$post['int']['option_wes_electric_rate_day_limit']				=	$_POST['due_days_disc'];
			$post['str']['option_wes_electric_rate_name']					=	$_POST['rate_name'];
			$entry 															= mvc_model('model.option.wes.electric.rate')->insert($post);
			
			if(count($_POST['project_id']) > 0)
			{
				foreach($_POST['project_id'] as $p_id)
				{
					$rate_post['option_wes_electric_rate_id']    = $entry['data']['option_wes_electric_rate_id'];
					$rate_post['project_id']    			 		= $p_id;
					$entry_rate = mvc_model('model.option.wes.electric.rate.project')->insert($rate_post);
				}
			}
		}
		
		header_location("/finance_wes/settings/rates/");
	}
	
	public function submit_add_rate_child($parent)
	{		
		$id											=   $_POST['id'];
		$type										=   $_POST['type'];
		$_POST['max']								=   (count($_POST['onwards']) > 0) ? 999999999999 : $_POST['max'];
		if($type == 'water')
		{
			$post['int']['option_wes_water_rate_id']						=	$id;
			$post['int']['option_wes_water_rate_child_amount']				=	$_POST['amount'];
			$post['int']['option_wes_water_rate_child_min']					=	$_POST['min'];
			$post['int']['option_wes_water_rate_child_max']					=	$_POST['max'];
			$entry 															=   mvc_model('model.option.wes.water.rate.child')->insert($post);
			
			
		}
		else
		{
			$post['int']['option_wes_electric_rate_id']						=	$id;
			$post['int']['option_wes_electric_rate_child_amount']			=	$_POST['amount'];
			$post['int']['option_wes_electric_rate_child_min']				=	$_POST['min'];
			$post['int']['option_wes_electric_rate_child_max']				=	$_POST['max'];
			$entry 															=   mvc_model('model.option.wes.electric.rate.child')->insert($post);
			
		}
		
		header_location("/finance_wes/settings/edit_rate/&id={$id}&type={$type}");
	}
	
	public function submit_edit_rate($parent)
	{		
		$type										=   $_POST['type'];
		$id											=   $_POST['id']*1;
		
		if($type == 'water')
		{
			$post['int']['option_wes_water_rate_due_day']					=	$_POST['due_days'];
			$post['int']['option_wes_water_rate_day_limit']					=	$_POST['due_days_disc'];
			$post['str']['option_wes_water_rate_name']						=	$_POST['rate_name'];
			$entry 															=   mvc_model('model.option.wes.water.rate')->update($post,$id);
			$delete_rate													=	mvc_model('model.option.wes.water.rate.project')->delete_entry($id);
			$c_project_id	= count($_POST['project_id']);
			if($c_project_id > 0)
			{
				foreach($_POST['project_id'] as $p_id)
				{
					$rate_post['option_wes_water_rate_id']       = $id;
					$rate_post['project_id']    			 	 = $p_id;
					$entry_rate = mvc_model('model.option.wes.water.rate.project')->insert($rate_post);
				}
			}
		}
		else
		{
			$post['int']['option_wes_electric_rate_due_day']				=	$_POST['due_days'];
			$post['int']['option_wes_electric_rate_day_limit']				=	$_POST['due_days_disc'];
			$post['str']['option_wes_electric_rate_name']					=	$_POST['rate_name'];
			$entry 															=   mvc_model('model.option.wes.electric.rate')->update($post,$id);
			$delete_rate													=	mvc_model('model.option.wes.electric.rate.project')->delete_entry($id);
			if(count($_POST['project_id']) > 0)
			{
				foreach($_POST['project_id'] as $p_id)
				{
					$rate_post['option_wes_electric_rate_id']       = $id;
					$rate_post['project_id']    			 		= $p_id;
					$entry_rate = mvc_model('model.option.wes.electric.rate.project')->insert($rate_post);
				}
			}
		}
		   
		header_location("/finance_wes/settings/rates/");
	}
	
	
	public function submit_edit_rate_child($parent)
	{		
		$id											=   $_POST['id'];
		$rate_id								    =   $_POST['rate_id'];
		$type										=   $_POST['type'];
		$_POST['max']								=   (count($_POST['onwards']) > 0) ? 999999999999 : $_POST['max'];
		if($type == 'water')
		{
			$post['int']['option_wes_water_rate_id']						=	$id;
			$post['int']['option_wes_water_rate_child_amount']				=	$_POST['amount'];
			$post['int']['option_wes_water_rate_child_min']					=	$_POST['min'];
			$post['int']['option_wes_water_rate_child_max']					=	$_POST['max'];
			$entry 															=   mvc_model('model.option.wes.water.rate.child')->update($post,$rate_id);
			
			
		}
		else
		{
			$post['int']['option_wes_electric_rate_id']						=	$id;
			$post['int']['option_wes_electric_rate_child_amount']			=	$_POST['amount'];
			$post['int']['option_wes_electric_rate_child_min']				=	$_POST['min'];
			$post['int']['option_wes_electric_rate_child_max']				=	$_POST['max'];
			$entry 															=   mvc_model('model.option.wes.electric.rate.child')->update($post,$rate_id);
			
		}
		
		header_location("/finance_wes/settings/edit_rate/&id={$id}&type={$type}");
	}
	
	public function submit_delete_rate_child($parent)
	{		
		$id											=   $_GET['id']*1;
    	$rate_id									=   $_GET['rate']*1;
    	$type										=   $_GET['type'];
		
		if($type == 'water')
		{
			$entry 															=   mvc_model('model.option.wes.water.rate.child')->delete_entry($rate_id);
		}
		else
		{
			$entry 															=   mvc_model('model.option.wes.electric.rate.child')->delete_entry($rate_id);
		}
		
		header_location("/finance_wes/settings/edit_rate/&id={$id}&type={$type}");
	}
	
	
	public function submit_edit_surcharge($parent)
	{		
		$entry = mvc_model('model.sysglobal_wes')->update($_POST['sys']);
		
		$post['water_announcement']				=  string_clean_textarea($_POST['ann']['water_announcement'],false);	
		$post['electric_announcement']			= string_clean_textarea($_POST['ann']['electric_announcement'],false);	
		$entry = mvc_model('model.sysglobal_wes')->update_textarea($post);
		header_location("/finance_wes/settings/surcharge/");
	}
	
	
	public function submit_add_group($parent)
	{		
		$entry = mvc_model('model.option.wes.charge.group')->insert($_POST['group']);
		header_location("/finance_wes/settings/other_charges/");
	}
	
	public function submit_add_other_charge($parent)
	{		
		$entry 			= 	mvc_model('model.option.wes.charge')->insert($_POST['other_charge']);
		
		if(count($_POST['project_id']) > 0)
		{
			foreach($_POST['project_id'] as $p_id)
			{
				$post['option_wes_charge_id']    = $entry['data']['option_wes_charge_id'];
				$post['project_id']    			 = $p_id;
				$entry = mvc_model('model.option_wes_charge_project')->insert($post);
			}
		}
		
		
		header_location("/finance_wes/settings/other_charges/");
	}
	
	public function submit_edit_other_charge($parent)
	{		
		$id	   			= $_POST['id']*1;
		$entry 			= mvc_model('model.option.wes.charge')->update($_POST['other_charge'],$id);
		$delete_charge	=	 mvc_model('model.option_wes_charge_project')->delete_entry($id);
		$c_project_id	= count($_POST['project_id']);
		if($c_project_id > 0)
		{
			foreach($_POST['project_id'] as $p_id)
			{
				$post['option_wes_charge_id']    = $id;
				$post['project_id']    			 = $p_id;
				$entry = mvc_model('model.option_wes_charge_project')->insert($post);
			}
		}
		
		header_location("/finance_wes/settings/other_charges/");
	}
	
	
    
}