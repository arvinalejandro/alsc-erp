<?php
class engineering_construction
{
    
    public function __construct()
    {    	
       	$this->controller_id 			= 	'engineering_construction';
    }
 
   public function index($parent)
    {           
        # DB
			$data['con_list'] 						=   mvc_model('model.lot.construction')->select_all();
        # VIEW
        $parent->_view('construction', $data);
    } 
    
    public function profile($parent)
    {      	
    	# DB
		$lot_construction_id						=   $_GET['id']*1;
		$data										=	mvc_model('model.lot.construction')->select($lot_construction_id);
		$data['lot_construction_date_complete']		=   (($data['lot_construction_date_complete'] > 0) ? string_date($data['lot_construction_date_complete']) : 'N/A');
		$data['retention']							=   (($data['lot_construction_retention_timestamp'] > 0) ? diff_date_to_current(string_clean_number($data['lot_construction_retention_timestamp'])).' day/s' : 'N/A');
		$data['lot_construction_cost_actual']		=   (($data['lot_construction_cost_actual'] > 0) ? 'P '.string_amount($data['lot_construction_cost_actual']) : 'N/A');
		$data['retention_label']					=   (($data['lot_construction_retention_timestamp'] > 0) ? 'Reset Retention' : 'Start Retention');
        # VIEW - side nav
        $side_nav['profile.class']					=	'bold';         	
       	$side_nav['lot_construction_id']			=	$lot_construction_id;         	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.construction', $side_nav);       
        # VIEW
        $parent->_view('construction.profile', $data);        
    } 
    
    public function status_history($parent)
    {      	
    	# DB
		$lot_construction_id						=   $_GET['id']*1;
		$data['status_row']							=	mvc_model('model.lot.construction.status.history')->select_all_by_construction($lot_construction_id);
        # VIEW - side nav
        $side_nav['status_history.class']			=	'bold';         	
       	$side_nav['lot_construction_id']			=	$lot_construction_id;    	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.construction', $side_nav);       
        # VIEW
        $parent->_view('construction.status_history', $data);        
    } 
    
    public function timetable($parent)
    {      	
    	# DB
		$lot_construction_id						=   $_GET['id']*1;
		$data['lot_construction_id']				=	$lot_construction_id; 
		$data['table_row']							=	mvc_model('model.lot.construction.time.table')->select_all_by_construction($lot_construction_id);
        # VIEW - side nav
        $side_nav['timetable.class']				=	'bold';         	
       	$side_nav['lot_construction_id']			=	$lot_construction_id;    	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.construction', $side_nav);       
        # VIEW
        $parent->_view('construction.timetable', $data);        
    }
    
    public function timetable_profile($parent)
    {      	
    	# DB
		$timetable_id								=   $_GET['id']*1;
		$data										=	mvc_model('model.lot.construction.time.table')->select($timetable_id);
		$data['date_complete']    		 			=   ($data['lot_construction_time_table_date_complete'] > 0) ?string_date($data['lot_construction_time_table_date_complete']) : 'On-going';
    	$data['date_start']    		 				=   string_date($data['lot_construction_time_table_date_start']);
        $data['date_log']    		 				=   string_date($data['lot_construction_time_table_timestamp']);
        $data['logged_by']    		 				=   $data['user_name'].' '.$data['user_surname'];
		$data['row.remark']                         =    mvc_model('model.remark')->get_row('lot_construction_time_table', $timetable_id);
        # VIEW - side nav
        $side_nav['timetable.class']				=	'bold';         	
       	$side_nav['lot_construction_id']			=	$data['lot_construction_id'];    	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.construction', $side_nav);       
        # VIEW
        $parent->_view('construction.timetable.profile', $data);        
    }
    
     public function payment($parent)
    {      	
    	# DB
		$lot_construction_id						=   $_GET['id']*1;
		$data['pay_row']							=	mvc_model('model.lot.construction.payment')->select_all_by_construction($lot_construction_id);
        # VIEW - side nav
        $side_nav['payment.class']					=	'bold';         	
       	$side_nav['lot_construction_id']			=	$lot_construction_id;    	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.construction', $side_nav);       
        # VIEW
        $parent->_view('construction.payment.list', $data);        
    } 
    
    public function document_list($parent)
    {      	
    	# DB
		$lot_construction_id						=   $_GET['id']*1;
		$data['doc_list'] 							=   mvc_model('model.lot.construction.document')->select_all_by_construction($lot_construction_id);
		$data['lot_construction_id']	    		=	$lot_construction_id;
        # VIEW - side nav
        $side_nav['document_list.class']			=	'bold';         	
        $side_nav['lot_construction_id']			=	$lot_construction_id;       	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.construction', $side_nav);       
        # VIEW
        $parent->_view('construction.document.list', $data);        
    }
    
    
    public function remark($parent)
    {
    	# DB
        $lot_construction_id						=   $_GET['id']*1;
        $data['row.remark']							=	mvc_model('model.remark')->get_row('lot_construction', $_GET['id']);   
        $data['lot_construction_id'] 				=   $lot_construction_id;        
        # VIEW - side nav
        $side_nav['remark.class']					=	'bold';         	
     	$side_nav['lot_construction_id']			=	$lot_construction_id; 	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.construction', $side_nav);           
        # VIEW
        $parent->_view('construction.remark', $data);      
	}
    
 
  //==================================FORMS
  
    
    public function timetable_edit($parent)
    {      	
    	# DB
		$timetable_id								=   $_GET['id']*1;
		$data										=	mvc_model('model.lot.construction.time.table')->select($timetable_id);
		
		$data['date_complete']    		 			=   ($data['lot_construction_time_table_date_complete'] > 0) ?string_date($data['lot_construction_time_table_date_complete']) : '';
    	$data['date_start']    		 				=   string_date($data['lot_construction_time_table_date_start']);
        $data['date_log']    		 				=   string_date($data['lot_construction_time_table_timestamp']);
        $data['logged_by']    		 				=   $data['user_name'].' '.$data['user_surname'];
		$data['row.remark']                         =    mvc_model('model.remark')->get_row('lot_construction_time_table', $timetable_id);
		$data['tt_id']								=   $timetable_id; 
        # VIEW - side nav
        $side_nav['timetable.class']				=	'bold';         	
       	$side_nav['lot_construction_id']			=	$data['lot_construction_id'];    	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.construction', $side_nav);       
        # VIEW
        $parent->_view('construction.form.edit.timetable', $data);        
    }
    
    
    public function add_document($parent)
    {      	
        # VIEW
        $lot_construction_id						=   $_GET['id']*1;
        $data['lot_construction_id']				=   $lot_construction_id; 
        $doc_type									=	mvc_model('model.option')->select_option('lot_construction_document_type');
        $data['doc_type']							=	hash_to_option($doc_type, 'lot_construction_document_type_id', 'lot_construction_document_type_name');
        # VIEW - side nav
        $side_nav['document_list.class']			=	'bold';         	
        $side_nav['lot_construction_id']			=	$lot_construction_id;       	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.construction', $side_nav);
        $parent->_view('construction.document.form.add', $data);        
    }
    
    public function add_timetable($parent)
    {      	
        # VIEW
        $lot_construction_id						=   $_GET['id']*1;
        $data['lot_construction_id']				=   $lot_construction_id; 
        # VIEW - side nav
        $side_nav['timetable.class']				=	'bold';         	
        $side_nav['lot_construction_id']			=	$lot_construction_id;       	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.construction', $side_nav);
        $parent->_view('construction.form.add.timetable', $data);        
    }
    
    public function edit_document($parent)
    {      	
        # VIEW
        $doc_id										=   $_GET['id']*1;
        $data										=   mvc_model('model.lot.construction.document')->select($doc_id);
        $doc_type									=	mvc_model('model.option')->select_option('lot_construction_document_type');
        $data['date_submit']    		 			=  ($data['lot_construction_document_date_submit'] > 0) ?string_date($data['lot_construction_document_date_submit']) : 'N/A';
		$data['date_expire']    		 			=  ($data['lot_construction_document_date_expire'] > 0) ?string_date($data['lot_construction_document_date_expire']) : 'N/A';
        $data['doc_type']							=	hash_to_option($doc_type, 'lot_construction_document_type_id', 'lot_construction_document_type_name',$data['lot_construction_document_type_id']);
        # VIEW - side nav
        $side_nav['document_list.class']			=	'bold';         	
        $side_nav['lot_construction_id']			=	$data['lot_construction_id'];       	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.construction', $side_nav);
        $parent->_view('construction.document.form.edit', $data);        
    }
  
 
    public function change_status($parent)
    {      	
    	# DB
		$lot_construction_id						=   $_GET['id']*1;
		$data									    =	mvc_model('model.lot.construction')->select($lot_construction_id);
		$option_unit_status							=	mvc_model('model.option')->select_option('option_unit_status');
		$data['user_name_full']						=   $parent->user['user_name'] .' '. $parent->user['user_surname'];
		$data['unit_status']						=	hash_to_option($option_unit_status, 'option_unit_status_id', 'option_unit_status_name',$data['option_unit_status_id']);
        $data['lot_construction_date_complete']		=   (($data['lot_construction_date_complete'] > 0) ? string_date($data['lot_construction_date_complete']) : 'N/A');
		$data['lot_construction_cost_actual']		=   (($data['lot_construction_cost_actual'] > 0) ? string_amount($data['lot_construction_cost_actual']) : 'N/A');
        # VIEW - side nav
        $side_nav['change_status.class']			=	'bold'; 
        $side_nav['lot_construction_id']			=	$lot_construction_id;        	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.construction', $side_nav);       
        # VIEW
        $parent->_view('construction.form.change_status', $data);        
    } 
    
    public function add_payment($parent)
    {      	
    	# DB
		$lot_construction_id						=   $_GET['id']*1;
		$data									    =	mvc_model('model.lot.construction')->select($lot_construction_id);
        # VIEW - side nav
        $side_nav['add_payment.class']			=	'bold'; 
        $side_nav['lot_construction_id']			=	$lot_construction_id;        	
       	$data['side_nav']							=	view_get_template($parent->controller_id.'/template/side.construction', $side_nav);       
        # VIEW
        $parent->_view('construction.form.payment', $data);        
    }
    
 #----------------------- Form Actions
 
 	public function update_status($parent)
	{		
		$lot_con_id							=	$_POST['id'] * 1;
		$remark								=	$_POST['remark'];
		$remark['int']['user_id']			=	$parent->user['user_id'];
		$remark['int']['remark_key_id']		=	$lot_con_id;
		$_POST['lot_construction']['int']['lot_construction_date_complete'] = strtotime($_POST['lot_construction']['int']['lot_construction_date_complete']);
		$_POST['lot_construction']['int']['lot_construction_date_start'] 	= strtotime($_POST['lot_construction']['int']['lot_construction_date_start']);
		
		mvc_model('model.lot.construction')->update($_POST['lot_construction'], $lot_con_id);
		
		$post['str']['option_unit_status_id']					=	$_POST['lot_construction']['str']['option_unit_status_id'];
		$post['int']['lot_construction_cost_estimate']			=	$_POST['lot_construction']['int']['lot_construction_cost_estimate'];
		$post['int']['lot_construction_cost_actual']			=	$_POST['lot_construction']['int']['lot_construction_cost_actual'];
		$post['int']['lot_construction_id']						=	$lot_con_id;
		$post['int']['lot_construction_date_start']				=	$_POST['lot_construction']['int']['lot_construction_date_start'];
		$post['int']['lot_construction_date_complete']			=	$_POST['lot_construction']['int']['lot_construction_date_complete'];
		$post['int']['user_id']									=	$parent->user['user_id'];
		mvc_model('model.lot.construction.status.history')->insert($post);	
		mvc_model('model.remark')->insert($remark);		
			
		header_location("/engineering/construction/status_history/&id={$lot_con_id}");
		
		
	}
	
	public function submit_payment($parent)
	{		
		$lot_con_id							=	$_POST['id'] * 1;
		$remark								=	$_POST['remark'];
		$remark['int']['user_id']			=	$parent->user['user_id'];
		$remark['int']['remark_key_id']		=	$lot_con_id;
		$_POST['payment']['int']['lot_construction_payment_date_paid'] = strtotime($_POST['payment']['int']['lot_construction_payment_date_paid']);
		
		mvc_model('model.lot.construction.payment')->insert($_POST['payment']);
		mvc_model('model.remark')->insert($remark);		
		header_location("/engineering/construction/payment/&id={$lot_con_id}");
	}
	
	public function submit_add_timetable($parent)
	{		
		$lot_con_id							=	$_POST['id'] * 1;
		$_POST['timetable']['int']['lot_construction_time_table_date_start'] 	= strtotime($_POST['timetable']['int']['lot_construction_time_table_date_start']);
		$_POST['timetable']['int']['lot_construction_time_table_date_complete'] = strtotime($_POST['timetable']['int']['lot_construction_time_table_date_complete']);
		$_POST['timetable']['int']['user_id']									=	$parent->user['user_id'];
		
		$entry =  mvc_model('model.lot.construction.time.table')->insert($_POST['timetable']);
		$timetable_id	= $entry['data']['lot_construction_time_table_id'];
		
		$remark								=	$_POST['remark'];
		$remark['int']['user_id']			=	$parent->user['user_id'];
		$remark['int']['remark_key_id']		=	$timetable_id;
		mvc_model('model.remark')->insert($remark);		
		header_location("/engineering/construction/timetable/&id={$lot_con_id}");
	}
	
	public function submit_edit_timetable($parent)
	{		
		$timetable_id							=	$_POST['tt_id'] * 1;
		$_POST['timetable']['int']['lot_construction_time_table_date_start'] 	= strtotime($_POST['timetable']['int']['lot_construction_time_table_date_start']);
		$_POST['timetable']['int']['lot_construction_time_table_date_complete'] = strtotime($_POST['timetable']['int']['lot_construction_time_table_date_complete']);
		$_POST['timetable']['int']['user_id']									=	$parent->user['user_id'];
		
		$entry =  mvc_model('model.lot.construction.time.table')->update($_POST['timetable'],$timetable_id);
		
		$remark								=	$_POST['remark'];
		$remark['int']['user_id']			=	$parent->user['user_id'];
		$remark['int']['remark_key_id']		=	$timetable_id;
		mvc_model('model.remark')->insert($remark);		
		header_location("/engineering/construction/timetable_profile/&id={$timetable_id}");
	}
	
	public function submit_add_document($parent)
	{		
		
		$_POST['document']['int']['lot_construction_document_date_submit'] = strtotime($_POST['document']['int']['lot_construction_document_date_submit']);
		$_POST['document']['int']['lot_construction_document_date_expire'] = strtotime($_POST['document']['int']['lot_construction_document_date_expire']);
		mvc_model('model.lot.construction.document')->insert($_POST['document']);
		header_location("/engineering/construction/document_list/&id={$_POST['lot_construction_id']}");
	}
	
	public function submit_update_document($parent)
	{		
		$doc_id			=   $_POST['id'];
		$_POST['document']['int']['lot_construction_document_date_submit'] = strtotime($_POST['document']['int']['lot_construction_document_date_submit']);
		$_POST['document']['int']['lot_construction_document_date_expire'] = strtotime($_POST['document']['int']['lot_construction_document_date_expire']);
		mvc_model('model.lot.construction.document')->update($_POST['document'],$doc_id);
		header_location("/engineering/construction/document_list/&id={$_POST['lot_construction_id']}");
	}
	
	
	public function start_retention($parent)
	{		
		$lot_con_id							=	$_GET['id'] * 1;
		$_POST['lot_construction']['int']['lot_construction_retention_timestamp'] = time();
		mvc_model('model.lot.construction')->update($_POST['lot_construction'], $lot_con_id);
		header_location("/engineering/construction/profile/&id={$lot_con_id}");
	}
	
	
	public function submit_remark($parent)
	{
		$_POST['int']['user_id']	=	$parent->user['user_id'];
		mvc_model('model.remark')->insert($_POST);
		header_location("/engineering/construction/remark/&id={$_POST['lot_construction_id']}");
	}
	
	public function submit_timetable_remark($parent)
    {
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $_POST['lot_construction_time_table_id'];
        mvc_model('model.remark')->insert($remark);                    
        header_location("/engineering/construction/timetable_profile/&id={$_POST['lot_construction_time_table_id']}");
    }
    
}
