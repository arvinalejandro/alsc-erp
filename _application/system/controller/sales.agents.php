<?php
class sales_agents
{
    
    public function __construct()
    {    	
    	$this->sub_method				=	$_GET['_1'];
       	$this->controller_id 			= 	'sales_agents';
       	$this->user						=	mvc_model('model.user')->select($_SESSION['user_id']);     
         	
    }

    public function index($parent)
    {          
        # DB
         $data												  =    mvc_model('model.sales_agent')->select_count();
         $data['row.agent']                                   =    mvc_model('model.sales_agent')->select_all_agent();
        # VIEW
        $parent->_view('agents', $data);        
    }
    
     public function profile($parent)
    {          
        # DB
        $id                                                   =    $_GET['id']; 
        $data				                                  =    mvc_model('model.sales_agent')->select_agent($id,1);
        $data['profile.agent']                                =    mvc_model('model.sales_agent')->select_agent($id);
        
        if($data['sales_network_division_id'] > 0)
        {
			$data['network_division']                  		  =    mvc_model('model.sales_network_division')->select_division_network($data['sales_network_division_id']);
			$data['n_d']									  =   $data['network_division']['sales_network_name'].' / '.$data['network_division']['sales_network_division_name'];	
        }
        else
        {
			$data['n_d']									  =   'N/A';
        }
        # VIEW - side nav
        $side_nav['profile.class']                            =    'bold';             
        $side_nav['profile.id']                               =    $id;           
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.agents', $side_nav);                       
        # VIEW
        $parent->_view('agents.profile', $data);        
    }
    
    public function sales_history($parent)
    {          
        $id                                                   =    $_GET['id'];
        # DB
        $data                               			  	  =    mvc_model('model.sales_agent')->select_agent($id,1); 
        $row_accounts                                         =    mvc_model('model.client_account')->get_agent_sales_row($id);
        $backout_cost                                		  =    mvc_model('model.sales_commission_account')->get_total_sales($id,"ejected");  
        $fully_paid_cost                                      =    mvc_model('model.sales_commission_account')->get_total_sales($id,"fully_paid");  
        $sales_cost                                	  		  =    mvc_model('model.sales_commission_account')->get_total_sales($id,"all");  
        $data['backout_cost']								  =    $backout_cost['sum'];
        $data['backout_count']								  =    $backout_cost['count'];
        $data['sales_cost']                                   =    $sales_cost['sum'];
        $data['fully_paid_count']                             =    $fully_paid_cost['count'];
        $data['backout_percent']                              =    round(($data['backout_cost'] / $data['sales_cost']) * 100,2); 
        $data['row.accounts']                                 =    $row_accounts['rows']; 
        $data['total_paidup']                                 =    $row_accounts['total_paidup']; 
        $data['paidup_percent']                               =    round(($data['total_paidup'] / $data['sales_cost']) * 100,2);
        
        # VIEW - side nav
        $side_nav['sales_history.class']                      =    'bold'; 
        $side_nav['profile.id']                               =    $id;            
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.agents', $side_nav);                       
        # VIEW
        $parent->_view('agents.sales_history', $data);        
    }
   
    public function remarks($parent)
    {          
        # DB
        $id                                                   =    $_GET['id'];
        $data['row.remark']                                   =    mvc_model('model.remark')->get_row('sales_agent', $id);
        # VIEW - side nav
        $side_nav['remarks.class']                            =    'bold';
        $side_nav['profile.id']                               =    $id; 
        $data['a_id']                                         =    $id;         
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.agents', $side_nav);                       
        # VIEW
        $parent->_view('agents.remark', $data);        
    } 

    
    public function commission_history($parent)
    {          
        # DB
        $id                                                   =    $_GET['id']; 
        $data                               			  	  =    mvc_model('model.sales_agent')->select_agent($id,1); 
        $commission_data	                                  =    mvc_model('model.client_account_agent')->select_commissions_by_agent($id);
        $total_accounts                                       =    mvc_model('model.sales_commission_account')->get_total_sales($id,"all");  
        $commission_accounts                                  =    mvc_model('model.sales_commission_account')->get_total_sales($id," AND client_account.option_account_status_id!='fully_paid'  AND client_account.option_account_status_id!='ejected'");
        $data['total_paidup']                                 =    mvc_model('model.sales_commission_account')->get_total_paidup($id);
        $data['count_accounts']								  =    $total_accounts['count'];	
        $data['count_comm_acct']						      =    $commission_accounts['count'];	
        $data['row.commission']								  =    $commission_data['rows'];	
        $data['total.commission']							  =    $commission_data['total'];
        # VIEW - side nav
        $side_nav['commission_history.class']                 =    'bold';
        $side_nav['profile.id']                               =    $id;             
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.agents', $side_nav);                       
        # VIEW
        $parent->_view('agents.commission_history', $data);        
    }
    
    
    public function backout_account($parent)
    {          
        # DB
        $id                                                   =    $_GET['id']; 
        $backout_data								          =	   mvc_model('model.client_account')->get_backout_row($id);
        $backout_cost                                		  =    mvc_model('model.sales_commission_account')->get_total_sales($id,"ejected"); 
        $sales_cost                                	  		  =   mvc_model('model.sales_commission_account')->get_total_sales($id,"all"); 
        $data['row.account']								  =    $backout_data['rows'];
        $data['total_paidup']                                 =    mvc_model('model.sales_commission_account')->get_total_paidup($id);
        $data['backout_cost']								  =    $backout_cost['sum'];
        $data['backout_count']								  =    $backout_cost['count'];
        $data['sales_cost']                                   =    $sales_cost['sum'];
        # VIEW - side nav
        $side_nav['backout_account.class']                    =    'bold';
        $side_nav['profile.id']                               =    $id;             
        $data['side_nav']                                     =    view_get_template($parent->controller_id.'/template/side.agents', $side_nav);                       
        # VIEW
        $parent->_view('agents.backout', $data);        
    }
    
    public function add($parent)
    {          
        # DB
        $sales_director                                 =    mvc_model('model.option')->select_option('sales_agent', "WHERE sales_agent_position_id = 'sales_director'");                             
        $sales_manager                                  =    mvc_model('model.option')->select_option('sales_agent', "WHERE sales_agent_position_id = 'sales_manager'");                            
        $civil_status                                   =    mvc_model('model.option')->select_option('option_civil_status');                             
        $gender                                         =    mvc_model('model.option')->select_option('option_gender');                             
        $agent_status                                   =    mvc_model('model.option')->select_option('option_agent_status', 'ORDER BY option_agent_status_id ASC');                             
        $agent_position                                 =    mvc_model('model.option')->select_option('sales_agent_position');                             
        $agent_position_old                             =    mvc_model('model.option')->select_option('sales_agent_position_old');                             
        $network                                        =    mvc_model('model.option')->select_option('sales_network', 'ORDER BY sales_network_name ASC');                             
        # VIEW
        $label[0]									    =    'sales_agent_last_name';
        $label[1]										=    'sales_agent_first_name';
        $data['sales_director']                         =    hash_to_option($sales_director, 'sales_agent_id', $label);
        $data['sales_manager']                          =    hash_to_option($sales_manager, 'sales_agent_id', $label);
        $data['network']                                =    hash_to_option($network, 'sales_network_id', 'sales_network_name');        
        $data['civil_status']                           =    hash_to_option($civil_status, 'option_civil_status_id', 'option_civil_status_name');
        $data['gender']                                 =    hash_to_option($gender, 'option_gender_id', 'option_gender_name');
        $data['agent_status']                           =    hash_to_option($agent_status, 'option_agent_status_id', 'option_agent_status_name');
        $data['sales_agent_position']                   =    hash_to_option($agent_position, 'sales_agent_position_id', 'sales_agent_position_name');
        $data['sales_agent_position_old']               =    hash_to_option($agent_position_old, 'sales_agent_position_old_id', 'sales_agent_position_old_name');
        $parent->_view('agents.add', $data);        
    }
    
     public function edit_profile($parent)
    {          
        # DB
        $id                                             =    $_GET['id']; 
        $data['row.agent']                              =    mvc_model('model.sales_agent')->select_agent($id,1);
        $direcor_id = '';
        $manager_id = '';
        $network_id = '';
        $network_filter = '';
		$sales_manager           						=  mvc_model('model.option')->select_option('sales_agent', "WHERE sales_agent_position_id = 'sales_manager' AND is_deleted=0  AND option_agent_status_id='active' ");                             
		$sales_director          						=  mvc_model('model.option')->select_option('sales_agent', "WHERE sales_agent_position_id = 'sales_director' AND is_deleted=0  AND option_agent_status_id='active' ");                             
		if($data['row.agent']['sales_agent_position_id'] == 'property_consultant')
        {
			//hash_dump($data['row.agent'],true);
			$get_id		             					=  mvc_model('model.sales_agent_agent')->select_by_under($id);
			$manager_data			 					=  mvc_model('model.sales_agent')->select_agent($get_id['sales_agent_head_id'],1);
			$manager_id				 					=  $manager_data['sales_agent_id'];  
        }
        if($data['row.agent']['sales_agent_position_id'] == 'sales_manager')
        {
			$director_data			 					=  mvc_model('model.sales_agent_agent')->select_by_under($id);
			$director_id				 					=  $director_data['sales_agent_head_id'];    
			//hash_dump($direcor_id,true);
        }
        if($data['row.agent']['sales_network_division_id'] > 0)
        {
			$data['network_division']                   =    mvc_model('model.sales_network_division')->select_division_network($data['row.agent']['sales_network_division_id']);
			$network_id									=    $data['network_division']['sales_network_id'];
			//$network_filter 							=    " WHERE sales_network_id=".$network_id;
			
        }
       
        $civil_status                                   =    mvc_model('model.option')->select_option('option_civil_status');                             
        $gender                                         =    mvc_model('model.option')->select_option('option_gender');                             
        $agent_status                                   =    mvc_model('model.option')->select_option('option_agent_status', 'ORDER BY option_agent_status_id ASC');                             
        $agent_position                                 =    mvc_model('model.option')->select_option('sales_agent_position', 'ORDER BY sales_agent_position_id ASC');                             
        $agent_position_old                             =    mvc_model('model.option')->select_option('sales_agent_position_old', 'ORDER BY sales_agent_position_old_id ASC');                             
        $network                                        =    mvc_model('model.option')->select_option('sales_network', $network_filter);                            
        $network_division                               =    mvc_model('model.option')->select_option('sales_network_division', 'WHERE sales_network_division_id = '.$data['row.agent']['sales_network_division_id'].' ORDER BY sales_network_division_name ASC');
        # VIEW - side nav
        $side_nav['add.class']                          =    'bold';
        $side_nav['profile.id']                         =    $id;             
        $data['side_nav']                               =    view_get_template($parent->controller_id.'/template/side.agents', $side_nav);
        # VIEW
        $data['network']                                =    hash_to_option($network, 'sales_network_id', 'sales_network_name',$network_id);        
        $data['network_division']                       =    hash_to_option($network_division, 'sales_network_division_id', 'sales_network_division_name',$data['row.agent']['sales_network_division_id']);
        $label[0]									    =    'sales_agent_last_name';
        $label[1]										=    'sales_agent_first_name';
        $data['sales_director']                         =    hash_to_option($sales_director, 'sales_agent_id', $label,$director_id);
        $data['sales_manager']                          =    hash_to_option($sales_manager, 'sales_agent_id', $label,$manager_id);
        $data['civil_status']                           =    hash_to_option($civil_status, 'option_civil_status_id', 'option_civil_status_name', $data['row.agent']['option_civil_status_id']);
        $data['gender']                                 =    hash_to_option($gender, 'option_gender_id', 'option_gender_name', $data['row.agent']['option_gender_id']);
        $data['agent_status']                           =    hash_to_option($agent_status, 'option_agent_status_id', 'option_agent_status_name', $data['row.agent']['option_agent_status_id']);
        $data['sales_agent_position']                   =    hash_to_option($agent_position, 'sales_agent_position_id', 'sales_agent_position_name', $data['row.agent']['sales_agent_position_id']);
        $data['sales_agent_position_old']               =    hash_to_option($agent_position_old, 'sales_agent_position_old_id', 'sales_agent_position_old_name', $data['row.agent']['sales_agent_position_old_id']);
        $parent->_view('agents.edit', $data);        
    }
    
    
#----------------------- Form Actions

     public function submit_remark($parent)
    {
        $id                                             =    $_POST['a_id'];
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $id;
        mvc_model('model.remark')->insert($remark);                    
        header_location("/sales/agents/remarks/&id={$id}");
    }
   
   
   
    public function submit_add_agent($parent)
    {
        
        $agent_data												    =	mvc_model('model.sales_agent')->insert($_POST['agent']);
        
        if($_POST['agent']['str']['sales_agent_position_id'] == 'property_consultant')
        {
			$post['sales_agent_head_id']   							=  $_POST['sales_manager_id'];  
			$post['sales_agent_id']    						        =  $agent_data['data']['data']['sales_agent_id'];  
			mvc_model('model.sales_agent_agent')->insert($post);
			
        }
        if($_POST['agent']['str']['sales_agent_position_id'] == 'sales_manager')
        {
			$post['sales_agent_head_id']   						  	=  $_POST['sales_director_id'];  
			$post['sales_agent_id']    						  		=  $agent_data['data']['data']['sales_agent_id'];  
			mvc_model('model.sales_agent_agent')->insert($post);
        }
        //add sales agent id to network or division depending on position
		if($_POST['agent']['int']['sales_network_division_id'] > 0 || $_POST['agent']['str']['sales_agent_position_old_id']=='sales_manager')
	    {
			if($_POST['agent']['str']['sales_agent_position_old_id']=='avp')
			{
				$nd_post['sales_agent_id']			   =    $id;
				mvc_model('model.sales_network')->update($nd_post,$_POST['agent_network_id']);
			}
			if($_POST['agent']['str']['sales_agent_position_old_id']=='sales_manager')
			{
				$nd_post['sales_agent_id']			   =    $id;
				mvc_model('model.sales_network_division')->update($nd_post,$data['network_division']['sales_network_division_id']);
			}
	    }
		//update manager quota
		$this->update_all_manager_quota($parent);
		//update director quota
		$this->update_all_director_quota($parent);
        header_location("/sales/agents");
    }
    
    public function delete_agent($parent)
    {
        $id                                              =    $_GET['id'];
        $data                                            =    mvc_model('model.sales_agent')->select_agent($id,1);
        if($data['sales_agent_position_id'] == 'property_consultant')
        {
			 mvc_model('model.sales_agent_agent')->delete($id);
			
        }
        elseif($data['sales_agent_position_id'] == 'sales_manager')
        {
			 mvc_model('model.sales_agent_agent')->delete($id,'sales_agent_head_id');
			 mvc_model('model.sales_agent_agent')->delete($id);
        }
        else
        {
			mvc_model('model.sales_agent_agent')->delete($id,'sales_agent_head_id');
        }
        
        //update manager quota
		$this->update_all_manager_quota($parent);
		//update director quota
		$this->update_all_director_quota($parent);
        mvc_model('model.sales_agent')->delete_agent($id);
        header_location("/sales/agents");
    }
    
    public function submit_update_agent($parent)
    {
        $id                                              		  =    $_POST['a_id'];
        $data				                                      =    mvc_model('model.sales_agent')->select_agent($id,1);
       // hash_dump($_POST,true);
        //if($data['sales_agent_position_id'] != $_POST['str']['sales_agent_position_id'])
       // {
			//add sales agent id to network or division depending on position
			
			if($_POST['agent']['str']['sales_agent_position_old_id']=='avp')
			{
				$_POST['agent']['int']['sales_network_division_id'] = 0;
				$nd_post['sales_agent_id']			   =    $id;
				mvc_model('model.sales_network')->update($nd_post,$_POST['agent_network_id']);
			}
			if($_POST['agent']['str']['sales_agent_position_old_id']=='sales_manager')
			{
				$nd_post['sales_agent_id']			   =    $id;
				mvc_model('model.sales_network_division')->update($nd_post,$data['network_division']['sales_network_division_id']);
			}
	        
			
			if($data['sales_agent_position_id'] == 'property_consultant')
	        {
				 mvc_model('model.sales_agent_agent')->delete($id);
				
	        }
	        elseif($data['sales_agent_position_id'] == 'sales_manager')
	        {
				 //mvc_model('model.sales_agent_agent')->delete($id,'sales_agent_head_id');
				 mvc_model('model.sales_agent_agent')->delete($id);
	        }
	        else
	        {
				mvc_model('model.sales_agent_agent')->delete($id,'sales_agent_head_id');
	        }
	        
	        if($_POST['agent']['str']['sales_agent_position_id'] == 'property_consultant')
	        {
				$post['sales_agent_head_id']   						=  $_POST['sales_manager_id'];  
				$post['sales_agent_id']    						    =  $id;  
				mvc_model('model.sales_agent_agent')->insert($post);
				
	        }
	        if($_POST['agent']['str']['sales_agent_position_id'] == 'sales_manager')
	        {
				$post['sales_agent_head_id']   						  =  $_POST['sales_director_id'];  
				$post['sales_agent_id']    						  =  $id;  
				mvc_model('model.sales_agent_agent')->insert($post);
	        }
	        
	        
        //}
        mvc_model('model.sales_agent')->update_agent($_POST['agent'], $id);
		//update manager quota
		$this->update_all_manager_quota($parent);
		//update director quota
		$this->update_all_director_quota($parent);
        header_location("/sales/agents/profile/&id=".$id);
    }
    
    
    
  //=======================================internal process
  
     private function update_all_director_quota($parent)
    {
        $director_data                                            =    mvc_model('model.sales_agent')->select_all_by_position_id('sales_director');
       // hash_dump($director_data);
       foreach($director_data as $row)
       {
		   $quota    											  =  mvc_model('model.sales_agent_agent')->get_head_quota($row['sales_agent_id']);
		   $update_agent['int']['sales_agent_monthly_quota']	  =  $quota;
		    hash_dump($update_agent);
		   $update_quota			    						  =  mvc_model('model.sales_agent')->update($update_agent,$row['sales_agent_id']);
       }
      // die();
      
    }
    
     private function update_all_manager_quota($parent)
    {
        $manager_data                                             =    mvc_model('model.sales_agent')->select_all_by_position_id('sales_manager');
       foreach($manager_data as $row)
       {
		   $quota    											  =  mvc_model('model.sales_agent_agent')->get_head_quota($row['sales_agent_id']);
		   $update_agent['int']['sales_agent_monthly_quota']	  =  $quota;
		   $update_quota			    						  =  mvc_model('model.sales_agent')->update($update_agent,$row['sales_agent_id']);
       }
      
    }
 #---------------------------------Ajax		 
	
    public function get_division($parent)
    {
       if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
        {
            if($_POST['all'] == 1)
            {
				$filter = '';
            }
            else
            {
				$filter = 'WHERE sales_network_id = '.$_POST['network_id'];
            }
            $network_division                            =    mvc_model('model.option')->select_option('sales_network_division', $filter.' ORDER BY sales_network_division_name ASC');
            $data                                        =    hash_to_option($network_division, 'sales_network_division_id', 'sales_network_division_name');
            echo $data; exit();
        }
        else
        {
            echo '';
        }
    }
    
 
    
}