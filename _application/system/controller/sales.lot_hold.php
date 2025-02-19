<?php
class sales_lot_hold
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'sales_lot_hold';
       	$this->user						=	mvc_model('model.user')->select($_SESSION['user_id']);     
       	$this->check_expired_hold($parent);
         	
    }
    
    public function index($parent)
    {          
        # DB
		$data['row.lot']									  =	mvc_model('model.lot')->get_hold_row();         
		# VIEW
        $parent->_view('lot_hold', $data);        
    }
   
     public function profile($parent)
    {          
         $id                                                  =    $_GET['id']*1;
        # DB 
		$data												  =	   mvc_model('model.lot')->select($id);		    
		# VIEW - side nav
		$side_nav['c_id']                                     =    $id;
        $side_nav['profile.class']               			  =    'bold';             
        $data['side_nav']                        			  =    view_get_template($parent->controller_id.'/template/side.lot_hold', $side_nav);                       
        # VIEW
        $parent->_view('lot_hold.profile', $data);        
    }
    
     public function assign($parent)
    {           
       	$id                                                   =    $_GET['id']*1;
       	# DB
       	$data['indefinite_checked']							  =    '';
       	$data['standard_checked']                             =    '';
       	$data												  =	   mvc_model('model.lot')->select($id); 
    	$data['s_a_l']										  =	   mvc_model('model.sales_agent_lot')->check_active_hold($id);
    	$duration											  =    ($data['s_a_l'] != 0  ? diff_date_to_current($data['s_a_l']['sales_agent_lot_timestamp']) : 0  );
    	$data['duration']   								  =    ($data['s_a_l'] == 0  ? 'N/A' : $duration.' day/s');
    	$data['hold_class']     							  =    ($data['option_availability_id'] == 'sold'  ? 'color_red' : 'color_green');       	       	   	
    	$data['button_class']     							  =    ($data['option_availability_id'] == 'sold'  ? 'display_none' : '');       	       	   	
    	$data['sales_agent_lot_id']     					  =    ($data['s_a_l'] != 0  ? $data['s_a_l']['sales_agent_lot_id'] : 0);  
        $comm_schme                                 		  =    mvc_model('model.option')->select_option('sales_commission_scheme'); 
        $data['comm_schme']                         	  	  =    hash_to_option($comm_schme, 'sales_commission_scheme_id','sales_commission_scheme_key',$data['s_a_l']['sales_commission_scheme_id']);
        ($data['s_a_l']['hold_standard'] != 1 ? 	$data['indefinite_checked'] = 'checked="checked"' : $data['standard_checked'] = 'checked="checked"');  
        
        if($data['s_a_l']['sales_commission_scheme_id'] == 1)
            {
				$a_filter 						= 	"	WHERE sales_agent_position_old_id = 'avp' AND is_deleted=0 AND option_agent_status_id='active'  ";
				$sales_agent_id 				= 	$data['s_a_l']['old_sales_agent_id_avp'];
            }
            elseif($data['s_a_l']['sales_commission_scheme_id'] == 2)
            {
				$a_filter 						= 	"	WHERE sales_agent_position_old_id = 'sales_manager' AND is_deleted=0 AND option_agent_status_id='active'  ";
				$sales_agent_id 				= 	$data['s_a_l']['old_sales_agent_id_sm'];
            }
            elseif($data['s_a_l']['sales_commission_scheme_id'] == 3 || $data['s_a_l']['sales_commission_scheme_id'] == 4)
            {
				$a_filter 						= 	"	WHERE sales_agent_position_old_id = 'marketing_associate' AND is_deleted=0  AND option_agent_status_id='active' ";
				$sales_agent_id 				= 	$data['s_a_l']['old_sales_agent_id_ma'];
            }
            elseif($data['s_a_l']['sales_commission_scheme_id'] == 5)
            {
				$a_filter 						= 	"	WHERE sales_agent_position_old_id = 'broker' AND is_deleted=0  AND option_agent_status_id='active' ";
				$sales_agent_id 				= 	$data['s_a_l']['old_sales_agent_id_broker'];
            }
            elseif($data['s_a_l']['sales_commission_scheme_id'] == 6)
            {
				$a_filter 						= 	"	WHERE sales_agent_position_id = 'property_consultant' AND is_deleted=0 AND option_agent_status_id='active' ";
				$sales_agent_id 				= 	$data['s_a_l']['sales_agent_id_pc'];
            }
            elseif($data['s_a_l']['sales_commission_scheme_id'] == 7)
            {
				$a_filter 						= 	"	WHERE sales_agent_position_id = 'broker' AND is_deleted=0 AND option_agent_status_id='active'  ";
				$sales_agent_id 				= 	$data['s_a_l']['sales_agent_id_broker'];
            }
            else
            {
				$a_filter 						= 	"WHERE sales_agent_position_old_id = 'none' AND is_deleted=0 ";// get nothing
            }
            $get_agents                			=    mvc_model('model.option')->select_option('sales_agent', $a_filter);
            $label[0]						 	=    'sales_agent_last_name';
        	$label[1]						 	=    'sales_agent_first_name';
            $data['sales_agent']          		=    hash_to_option($get_agents, 'sales_agent_id', $label,$sales_agent_id);
        
          
          
        # VIEW     
        $parent->_view('lot_hold.edit', $data);          
    } 
   
    
     public function remarks($parent)
    {          
        $id                                                   =    $_GET['id']*1;
        # DB
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row('lot', $id);
        $data['lot_id']                            			  =    $id;
        # VIEW - side nav
        $side_nav['c_id']                                     =    $id;
        $side_nav['remarks.class']                            =    'bold';             
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.lot_hold', $side_nav);                       
        # VIEW
        $parent->_view('lot_hold.remark', $data);        
    }
      
 
#----------------------- Form Actions    

 	public function submit_status($parent)
    {
        
        $lot_id									=	$_POST['lot_hold']['int']['lot_id'];
        $comm_scheme_id							=	$_POST['lot_hold']['int']['sales_commission_scheme_id'];
        $sales_agent_id							=	$_POST['sales_agent_id'];
        if($comm_scheme_id == 1)
            {
				$_POST['lot_hold']['int']['old_sales_agent_id_avp'] 	= 	$sales_agent_id;
            }
            elseif($comm_scheme_id == 2)
            {
				$sm_data			 						           =  mvc_model('model.sales_agent')->select_agent($sales_agent_id,1);
				$div_data			 						           =  mvc_model('model.sales_network_division')->select_division_row($sm_data['sales_network_division_id']);
				$net_data			 						       	   =  mvc_model('model.sales_network')->select_network($div_data['sales_network_id']);
				$_POST['lot_hold']['int']['old_sales_agent_id_avp']    =  $net_data['sales_agent_id'];
				$_POST['lot_hold']['int']['old_sales_agent_id_sm']     =  $sales_agent_id;
            }
            elseif($comm_scheme_id == 3)
            {
				$ma_data			 						           =  mvc_model('model.sales_agent')->select_agent($sales_agent_id,1);
				$div_data			 						           =  mvc_model('model.sales_network_division')->select_division_row($ma_data['sales_network_division_id']);
				$net_data			 						           =  mvc_model('model.sales_network')->select_network($div_data['sales_network_id']);
				$_POST['lot_hold']['int']['old_sales_agent_id_avp']    =  $net_data['sales_agent_id'];
				$_POST['lot_hold']['int']['old_sales_agent_id_ma']     =  $sales_agent_id;
            }
            elseif($comm_scheme_id == 4)
            {
				$ma_data			 						           =  mvc_model('model.sales_agent')->select_agent($sales_agent_id,1);
				$div_data			 						           =  mvc_model('model.sales_network_division')->select_division_row($ma_data['sales_network_division_id']);
				$net_data			 						           =  mvc_model('model.sales_network')->select_network($div_data['sales_network_id']);
				
				$_POST['lot_hold']['int']['old_sales_agent_id_avp']    =  $net_data['sales_agent_id'];
				$_POST['lot_hold']['int']['old_sales_agent_id_ma']     =  $sales_agent_id;
				$_POST['lot_hold']['int']['old_sales_agent_id_sm']     =  $div_data['sales_agent_id'];
            }
            elseif($comm_scheme_id == 5)
            {
				$_POST['lot_hold']['int']['old_sales_agent_id_broker'] =  $sales_agent_id;
            }
            elseif($comm_scheme_id == 6)
            {
				$vp_data			 						           =  mvc_model('model.sales_agent')->select_vp();
				$get_manager_id		             					   =  mvc_model('model.sales_agent_agent')->select_by_under($sales_agent_id);
				$get_director_id		             				   =  mvc_model('model.sales_agent_agent')->select_by_under($get_manager_id['sales_agent_head_id']);
				$_POST['lot_hold']['int']['sales_agent_id_sd']         =  $get_director_id['sales_agent_head_id'];
				$_POST['lot_hold']['int']['sales_agent_id_vp']         =  $vp_data['sales_agent_id'];
				$_POST['lot_hold']['int']['sales_agent_id_sm']         =  $get_manager_id['sales_agent_head_id'];
				$_POST['lot_hold']['int']['sales_agent_id_pc']         =  $sales_agent_id;
            }
            elseif($comm_scheme_id == 7)
            {
				$_POST['lot_hold']['int']['sales_agent_id_broker']     =  $sales_agent_id;
            }
            else
            {
            }
        mvc_model('model.sales_agent_lot')->update_by_lot($lot_id);
        mvc_model('model.sales_agent_lot')->insert($_POST['lot_hold']);
        
        $lot['int']['agent_id']					=	$_POST['lot_hold']['int']['agent_id'];
        $lot['int']['sales_manager_id']			=	$_POST['lot_hold']['int']['sales_manager_id'];
        $lot['int']['sales_director_id']		=	$_POST['lot_hold']['int']['sales_director_id'];
        $lot['str']['option_availability_id']	=	'on_hold';
        mvc_model('model.lot')->update($lot, $lot_id,$parent->user['user_id']);
        
        #remark
        $remark                                                 =  $_POST['remark'];
        $remark['int']['user_id']                               =  $parent->user['user_id'];
        mvc_model('model.remark')->insert($remark);
        header_location("/sales/lot_hold/profile/&id={$_POST['lot_hold']['int']['lot_id']}");
    }
    
    
    public function check_expired_hold($parent)
    {
        $data						=	mvc_model('model.sales_agent_lot')->select_all_active_hold();
        //hash_dump($data,true);
        if($data)
        {
			$update_expired		    =   mvc_model('model.sales_agent_lot')->check_expiry($data);
        }
    }
 	
 	
 	 public function submit_remark($parent)
    {
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $_POST['lot_id'];
      // hash_dump($remark,true);
        mvc_model('model.remark')->insert($remark);                    
        header_location("/sales/lot_hold/remarks/&id={$_POST['lot_id']}");
    }   
 #---------------------------------Ajax		 
     public function get_agents($parent)
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
        {
            if($_POST['comm_schme_id'] == 1)
            {
				$filter = "WHERE sales_agent_position_old_id = 'avp' AND is_deleted=0 AND option_agent_status_id='active'  ";
            }
            elseif($_POST['comm_schme_id'] == 2)
            {
				$filter = "WHERE sales_agent_position_old_id = 'sales_manager' AND is_deleted=0 AND option_agent_status_id='active'  ";
            }
            elseif($_POST['comm_schme_id'] == 3 || $_POST['comm_schme_id'] == 4)
            {
				$filter = "WHERE sales_agent_position_old_id = 'marketing_associate' AND is_deleted=0  AND option_agent_status_id='active' ";
            }
            elseif($_POST['comm_schme_id'] == 5)
            {
				$filter = "WHERE sales_agent_position_old_id = 'broker' AND is_deleted=0  AND option_agent_status_id='active' ";
            }
            elseif($_POST['comm_schme_id'] == 6)
            {
				$filter = "WHERE sales_agent_position_id = 'property_consultant' AND is_deleted=0 AND option_agent_status_id='active' ";
            }
            elseif($_POST['comm_schme_id'] == 7)
            {
				$filter = "WHERE sales_agent_position_id = 'broker' AND is_deleted=0 AND option_agent_status_id='active'  ";
            }
            else
            {
				$filter = "WHERE sales_agent_position_old_id = 'none' AND is_deleted=0 ";// get nothing
            }
            
            $data                            =    mvc_model('model.option')->select_option('sales_agent', $filter);
            $label[0]						 =    'sales_agent_last_name';
        	$label[1]						 =    'sales_agent_first_name';
            $data          					 =    hash_to_option($data, 'sales_agent_id', $label);
            $data          					 =   '<option value="0"></option>'.$data;
            echo $data; exit();
        }
        else
        {
            echo '';
        }
    }
    
}