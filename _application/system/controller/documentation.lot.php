<?php
class documentation_lot
{
    
    public function __construct()
    {    	
       	$this->controller_id 			= 	'documentation_lot';
    }

    public function index($parent)
    {          
        # DB
        $data['row.lot']				         =	mvc_model('model.lot')->get_lots_row();
        # VIEW
        $parent->_view('lot', $data);        
    }
    
     public function profile($parent)
    {          
        $lot_id 								 =    $_GET['id'] * 1;
        # DB
         $data				         		     =	mvc_model('model.lot')->get_lots_profile($lot_id);
        # VIEW - side nav
        $side_nav['profile.class']               =    'bold';             
        $side_nav['lot_id']              	     =    $lot_id;             
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.lot', $side_nav);                       
        # VIEW
        $parent->_view('lot.profile', $data);        
    }
    
    public function remarks($parent)
    {          
        $lot_id 								 =    $_GET['id'] * 1;       
        # DB
    	$data['row.remark']              		 =    mvc_model('model.remark')->get_row('lot', $lot_id);
        # VIEW - side nav       
        $side_nav['remarks.class']               =    'bold';  
        $side_nav['lot_id']              	     =    $lot_id;           
        $data['side_nav']                        =    view_get_template($parent->controller_id.'/template/side.lot', $side_nav);                       
        # VIEW
        $data['lot_id']                          =    $lot_id;  
        $parent->_view('lot.remark', $data);        
    } 
    
     public function documents($parent)
    {          
        $lot_id 								   =    $_GET['id'] * 1;     
        # DB
        $data['row.documents']              	   =    mvc_model('model.document_lot')->select_all($lot_id);
        # VIEW - side nav
        $side_nav['documents.class']               =    'bold';  
        $side_nav['lot_id']              	       =    $lot_id;           
        $data['side_nav']                          =    view_get_template($parent->controller_id.'/template/side.lot', $side_nav);                       
        # VIEW
        $parent->_view('lot.documents', $data);        
    }
    
      public function document_status($parent)
    {          
        $lot_id 								   =    $_GET['id'] * 1;
        $doc_id 								   =    $_GET['d_id'] * 1;
        # DB
        $data 									   =    mvc_model('model.document_lot')->select_document($doc_id);
         # VIEW - side nav
        $side_nav['documents.class']               =    'bold';   
        $side_nav['lot_id']              	       =    $lot_id;          
        $data['side_nav']                          =    view_get_template($parent->controller_id.'/template/side.lot', $side_nav);                  
        # VIEW
        $parent->_view('lot.document_edit', $data);        
    }
#----------------------- Form Actions

     public function submit_remark($parent)
    {
        $id                                             =    $_POST['lot_id'];
        $remark                                         =    $_POST['remark'];
        $remark['int']['user_id']                       =    $parent->user['user_id'];
        $remark['int']['remark_key_id']                 =    $id;
        mvc_model('model.remark')->insert($remark);                    
        header_location("/documentation/lot/remarks/&id={$id}");
    }
    
    
     public function submit_update($parent)
    {
       
        mvc_model('model.document_lot')->update($_POST);                    
        header_location("/documentation/lot/documents/&id={$_POST['int']['lot_id']}");
    }
    
    
}
