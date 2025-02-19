<?php
class message_service
{
	var $allow_ext		   =	'pdf,doc,docx,jpg,jpeg,png';
	var $allow_size		   =	500000;

    public function __construct()
    {
       	$this->controller_id 			= 	'message_service';
    }

    public function index($parent)
    {

        $this->inbox($parent);
    }

     public function new_message($parent)
    {

        $parent->_view('new_message', $data);
    }

    public function inbox($parent)
    {
         $msg_grp		 		 =    mvc_model('model.message_group')->select_all_group_user($parent->user['user_id']);
         //hash_dump($msg_grp,true);
         $counter				 =   1;
         if(count($msg_grp))
         {
			 foreach($msg_grp as $row)
			 {
				 if($counter == 1)
				 {
					 $class = 'active';
					 $mg_id	= $row['message_group_id'];
				 }
				 else
				 {
					 $class = '';
				 }

				 $last_view        =  mvc_model('model.message_group_user')->select_row($parent->user['user_id'],$row['message_group_id']);
				 $unread_message   =  mvc_model('model.message_user')->count_unread($row['message_group_id'],$last_view['last_view_timestamp']);

				$unread_count	   =  ($unread_message['msg_count'] > 0) ? $unread_message['msg_count'] : '';
				 $latest_msg	   =  (strlen($unread_message['message']) > 30) ? substr($unread_message['message'],0,30) .'...' : $unread_message['message'];
				 $chat_users	   =  (strlen($row['con_label']) > 100) ? substr($row['con_label'],0,100) .'...' : $row['con_label'];

				 $data['list']	   .=   '<div id="conv_'.$row['message_group_id'].'" class="'.$class.' list_body" title="'.$row['con_label'].'" onclick="get_message('.$row['message_group_id'].')">
						                    <a href="#" class="photo"></a>
						                    <div class="info">
						                        <b>'.$chat_users.'</b><label></label>
						                        <span>'.$latest_msg.'</span>
						                    </div>
						                    <div class="time">'.string_time_colon($unread_message['message_time']).'</div>
						                    <div id="count_'.$row['message_group_id'].'" class="new_count">'.$unread_count.'</div>
						                    <label></label>
						                </div>';
				 $counter++;
			 }

         }
        $data['mg_id']	=	$mg_id;
        $parent->_view('conversation', $data,'inbox');
    }

     public function search_user($parent)
    {

        $parent->_view('search_user', $data);
    }




  #---------------------------------Ajax
     public function get_users($parent)
    {
         if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
        {

            if($_POST['user_name'] != '')
            {
				$data                                  =    mvc_model('model.user')->select_user($_POST['user_name'],$parent->user['user_id']);
            }
            else
            {
				$data = null;
            }

           	if(count($data))
           	{
				foreach($data as $row)
				{
					$name					 			=    $row['user_name'].$row['user_surname'];

				    $user['list']              		   .= ' <div id="user_'.$row['user_id'].'" class="new_search_result"  onclick="add_recepient('.$row['user_id'].')">
										                        <a href="#" class="photo"></a>
										                        <div class="float_left">
										                            <b>'.$row['user_name'].' '.$row['user_surname'].'</b>
										                            <label></label>
										                            <span>'.$row['option_department_name'].'</span>
										                        </div>
										                        <label></label>
									                    	</div>';
					$user['tag'][$row['user_id']]['html_string'] =  '<div id="tag_'.$row['user_id'].'" class="participant">'.$row['user_name'].' '.$row['user_surname'].'<a onclick="delete_recepient('.$row['user_id'].')">x</a></div>';
				    $user['tag'][$row['user_id']]['user_id']	 =  $row['user_id'];
				}

           	}
           	else
           	{
				$user['list'] = '';
				$user['tag'][0]['html_string'] = '';
				$user['tag'][0]['user_id'] = '';
           	}

           	$user = json_encode($user);
            echo $user; exit();
		}
    }


     public function submit_new_message($parent)
    {
         if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
        {
            $recepient						 =    json_decode($_POST['rec']);
            $chat_name						 = ($_POST['chat_name'] == 'none') ? null : $_POST['chat_name'];
            if(count($recepient)<2)
            {
				 $get_recepient   	 	=    mvc_model('model.message_group_user')->select_by_user($recepient[0]);
				 $group_id				=    0;
				 foreach($get_recepient as $row)
				 {
					  $check_group   	 =    mvc_model('model.message_group_user')->select_row($parent->user['user_id'],$row['message_group_id']);
					  if($check_group)
					  {
						  $get_group   	 =    mvc_model('model.message_group_user')->select_by_message_group($row['message_group_id']);
						  $counter       =    $counter.'++'.count($get_group);
						  if(count($get_group)<3)
						  {
							   $group_id 						 = $row['message_group_id'];
						  }
					  }
				 }//end check loop

				 if($group_id == 0) // no match found create new conversation
				 {
					  $insert_group			 		 =    mvc_model('model.message_group')->insert($parent->user['user_id'],$chat_name);
                	  $insert_group_user_sender   	 =    mvc_model('model.message_group_user')->insert($parent->user['user_id'],$insert_group['data']['message_group_id'],1);
                	  $insert_group_user   	         =    mvc_model('model.message_group_user')->insert($recepient[0],$insert_group['data']['message_group_id']);
                	  $group_id = $insert_group['data']['message_group_id'];
				 }

            }
            else
            {
				$insert_group			 		 =    mvc_model('model.message_group')->insert($parent->user['user_id'],$chat_name);
                $insert_group_user_sender   	 =    mvc_model('model.message_group_user')->insert($parent->user['user_id'],$insert_group['data']['message_group_id'],1);
				foreach($recepient as $id)
	            {
					$insert_group_user   	     =    mvc_model('model.message_group_user')->insert($id,$insert_group['data']['message_group_id']);
	            }
	             $group_id = $insert_group['data']['message_group_id'];
            }
            $post['textarea']['message_user_content']	 =    $_POST['msg'];
	        $post['int']['user_id']	 					 =    $parent->user['user_id'];
	        $post['int']['message_group_id']	 	 	 =    $group_id;
            $insert_message                  			 =    mvc_model('model.message_user')->insert($post);
            $update_message_group_user   	 		     =    mvc_model('model.message_group_user')->update_read($group_id,$parent->user['user_id']);
            $update_message_group			 		     =    mvc_model('model.message_group')->new_message_update($group_id);

           	if($insert_message)
           	{
				$data = 1;
           	}
           	else
           	{
				$data = 0;
           	}
            echo $data; exit();
		}
    }


     public function submit_message($parent)
    {
         if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
        {
            $update_message_group			 =    mvc_model('model.message_group')->new_message_update($_POST['message_group_id']);
            $update_message_group_user   	 =    mvc_model('model.message_group_user')->update_unread($_POST['message_group_id'],$parent->user['user_id']);

            $post['textarea']['message_user_content']	 =    $_POST['msg'];
            $post['int']['user_id']	 					 =    $parent->user['user_id'];
            $post['int']['message_group_id']	 	 	 =    $_POST['message_group_id'];
            $insert_message                  			 =    mvc_model('model.message_user')->insert($post);
			$list['list'] 	   		   = '';
           	if($insert_message)
           	{
			    $filter 				         =   " AND message_user_id > ".$_POST['l_id'];
			    $update_message_group_user   	 =    mvc_model('model.message_group_user')->update_read($_POST['message_group_id'],$parent->user['user_id']);
			    $conversation					 =    mvc_model('model.message_user')->select_all_message_group($_POST['message_group_id'],$filter,'LIMIT 15');

			    if(count($conversation))
           		{
					$item_num  				   = count($conversation)-1;
					$counter				   = 0;
					$cont					   = '';
					foreach($conversation as $row)
					{
						$list['l_id']					=  ($counter==0)? $row['message_user_id'] : $list['l_id'];
						$cont	                        =    '<div id="msg_u_'.$row['message_user_id'].'" class="message">
								                        <a href="#" class="photo"></a>
								                        <div class="info">
								                            <b>'.$row['user_name'].' '.$row['user_surname'].'</b>
								                            <div class="time">'.string_date_time_slash($row['message_user_timestamp']).'</div><label></label>
								                            <span>'.$row['message_user_content'].'</span>
								                            <label></label>
								                        </div>
								                    </div>
								                    <label id="l_'.$row['message_user_id'].'"></label>';

						$list['list']					=  $cont.$list['list'];
						$counter++;

					}
           		}
           	}
            $list = json_encode($list);
            echo $list; exit();
		}


    }


    public function view_message($parent)
    {
         if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
        {
            $list['f_id']			   = 0;
			$list['l_id']			   = 0;
			$list['con_label'] 	       = '';
			$list['list'] 	   		   = '';
			$list['participant'] 	   = '';
            if($_POST['message_group_id'] > 0)
            {
				$filter='';
				if($_POST['l_id'] > 0)
				{
					$filter 				     = " AND message_user_id > ".$_POST['l_id'];
					$list['l_id']			   	 = $_POST['l_id'];
				}
				if($_POST['f_id'] > 0)
				{
					$filter                      = " AND message_user_id < ".$_POST['f_id'];
					$list['f_id']			     = $_POST['f_id'];
				}

				$update_message_group_user   	 =    mvc_model('model.message_group_user')->update_read($_POST['message_group_id'],$parent->user['user_id']);
	            $conversation					 =    mvc_model('model.message_user')->select_all_message_group($_POST['message_group_id'],$filter,'LIMIT 15');
	            $message_group					 =     mvc_model('model.message_group')->select_all_user_by_group_id($_POST['message_group_id']);
	            $convo_label					 =    mvc_model('model.user')->select_convo_label($parent->user['user_id'],$_POST['message_group_id']);
	            $user_list					     =    mvc_model('model.user')->select_convo_users($_POST['message_group_id']);
	            
	            foreach($user_list as $user_full) 
	            {
					$convo_users .= '<li>'.$user_full['user_full'].'</li>';
	            }
	            
	            $list['convo_users']			 =  $convo_users;
           		$list['con_label']	   			 =   (strlen($convo_label['con_label']) > 50) ? substr($convo_label['con_label'],0,50) .'...' : $convo_label['con_label'];
            	$list['con_label']	             =  (isset($message_group['message_group_name'])) ? $message_group['message_group_name'] : $list['con_label'];
            	$list['label_title']	         =  $convo_label['con_label'];
            	$list['participant'] 	   		 =   $convo_label['participant_count'];
            }
            else
            {
				$conversation = null;
            }

           	if(count($conversation))
           	{
				$item_num  				   = count($conversation)-1;
				$counter				   = 0;
				$cont					   = '';
				foreach($conversation as $row)
				{
					$list['l_id']					=  ($counter==0)? $row['message_user_id'] : $list['l_id'];
					$list['f_id']					=  ($counter==$item_num)? $row['message_user_id'] : $list['f_id'];
					$cont	                        =    '<div id="msg_u_'.$row['message_user_id'].'" class="message">
							                        <a href="#" class="photo"></a>
							                        <div class="info">
							                            <b>'.$row['user_name'].' '.$row['user_surname'].'</b>
							                            <div class="time">'.string_date_time_slash($row['message_user_timestamp']).'</div><label></label>
							                            <span>'.$row['message_user_content'].'</span>
							                            <label></label>
							                        </div>
							                    </div>
							                    <label id="l_'.$row['message_user_id'].'"></label>';

					$list['list']					=  $cont.$list['list'];
					$counter++;

				}
           	}
           	$list['convo_count'] = count($conversation);
           	$list = json_encode($list);
            echo $list; exit();
		}
    }



    public function get_convo_list($parent)
    {
         if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
        {
             $msg_grp		 		 =    mvc_model('model.message_group')->select_all_group_user($parent->user['user_id']);
	         //hash_dump($msg_grp,true);
	         $list='';
	         if(count($msg_grp))
	         {
				 foreach($msg_grp as $row)
				 {
					 $last_view        =  mvc_model('model.message_group_user')->select_row($parent->user['user_id'],$row['message_group_id']);
					 $unread_message   =  mvc_model('model.message_user')->count_unread($row['message_group_id'],$last_view['last_view_timestamp']);

					$unread_count	   =  ($unread_message['msg_count'] > 0) ? $unread_message['msg_count'] : '';
					 $latest_msg	   =  (strlen($unread_message['message']) > 30) ? substr($unread_message['message'],0,30) .'...' : $unread_message['message'];
					 $chat_users	   =  (strlen($row['con_label']) > 100) ? substr($row['con_label'],0,100) .'...' : $row['con_label'];
					 $chat_users	   =  (isset($row['message_group_name'])) ? $row['message_group_name'] : $chat_users;

					 $list	   		  .=   '<div id="conv_'.$row['message_group_id'].'" class="list_body" title="'.$row['con_label'].'" onclick="get_message('.$row['message_group_id'].')">
							                   <div class="s_tag display_none">'.$row['con_label'].'</div>
							                    <a href="#" class="photo"></a>
							                    <div class="info">
							                        <b class="list_bold">'.$chat_users.'</b><label></label>
							                        <span>'.$latest_msg.'</span>
							                    </div>
							                    <div class="time">'.string_time_colon($unread_message['message_time']).'</div>
							                    <div id="count_'.$row['message_group_id'].'" class="new_count">'.$unread_count.'</div>
							                    <label></label>
							                </div>';

				 }

	         }
            echo $list; exit();
		}
    }


    public function get_count_unread_convo($parent)
    {

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
        {
             $count 				 = 0;
             $msg_grp		 		 =    mvc_model('model.message_group')->select_all_group_user($parent->user['user_id']);
	         if(count($msg_grp))
	         {
				 foreach($msg_grp as $row)
				 {
					 $last_view        =  mvc_model('model.message_group_user')->select_row($parent->user['user_id'],$row['message_group_id']);
					 $unread_message   =  mvc_model('model.message_user')->count_unread($row['message_group_id'],$last_view['last_view_timestamp']);
					 $count	          +=  ($unread_message['msg_count'] > 0) ? 1 : 0;
				 }

	         }
	         else
	         {
				 $count = 0;
	         }
	        echo $count; exit();

		}
    }

    public function get_filename($parent)
    {

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
        {
            $attachment             = mvc_model('model.message_attachment')->select_latest($parent->user['user_id']);
            $file_link = '<a href="/message/service/download_attachment/'.$attachment['message_attachment'].'" class="file_uploaded" style="padding:0;" target="_blank"><span class="filename">'.$attachment['message_attachment'].'</span></a>';

	        echo $file_link; exit();

		}
    }

    public function upload_attachment($parent)
	{
		$attachment_upload 			= 	mvc_library('file.upload')->upload($_FILES['fileAttachment'],'files/attachment/','',$this->allow_ext,$this->allow_size);
		if($attachment_upload['result'] == true)
		{
			$data['attachment_name']	   = $attachment_upload['name'];
			$post['message_attachment']    = $attachment_upload['name'];
			$post['user_id'] 			   = $parent->user['user_id'];
			$insert_attachment             = mvc_model('model.message_attachment')->insert($post);

		}
		else
		{
			$data = false;
		}
		return $data;
	}

	public function download_attachment($id)
	{
		$file       =   $_GET['_2'];
		if(isset($file))
		{

			$ext		=	string_file_extension($file);
			$fname		=	'http://alsc/files/attachment/'.$file;

			//echo $ext;
			//die();

			if($ext == 'doc' || $ext == 'docx')
			{
				$mime_type = 'application/msword';
			}
			elseif($ext == 'gif')
			{
				$mime_type = 'image/gif';
			}
			elseif($ext == 'png')
			{
				$mime_type = 'image/png';
			}
			elseif($ext == 'jpg' || $ext == 'jpeg')
			{
				$mime_type = 'image/jpeg';
			}
			else
			{
				$mime_type = 'application/pdf';
			}

			//header('Content-Type: ' . 'image/jpeg');
			//header('Content-Disposition: attachment; filename="'.$fname.'"');

			//$file_name = 'file.png';
		   // $file_url = 'http://www.myremoteserver.com/' . $file;
		    header('Content-Type: application/octet-stream');
		    header("Content-Transfer-Encoding: Binary");
		    header("Content-disposition: attachment; filename=\"".$file."\"");
		    readfile($fname);

			/*
			header('Content-Description: Attachment Download');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename="'.basename($file).'"');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($file));
		    readfile($fname);
		    exit;*/

		}

	}

}
