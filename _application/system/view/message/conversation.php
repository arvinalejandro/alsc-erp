<div id="content_body">

    <div id="side_listings" style="margin-left:0px;">
        <div style="border-bottom:1px solid #eaeaea;">
            <div style="width: 290px; border-right:1px solid #eaeaea;" class="float_left">
                <div class="pad_standard">
                    <div id="search_body" class="border_gray float_right">
                        <input id="search_box" value="Search Name" onkeyup="search_name()" onfocus="clear_input()" onblur="check_input()">
                        <a class="mar_custom search_button" style="margin-left:10px;"></a>
                    </div>
                    <label></label>
                </div>
            </div>

            <div style="min-width:592px; max-width: 890px; width:67%; overflow: none; padding:20px 0 0 20px;" class="float_left">
                <b class="font_size_18 float_left"><span id="convo_header"></span></b>
                <span id="span_party" class="font_size_18 float_left" style="margin:0 10px;"></span> 
                <div class="position_relative float_left">
                  <a class="float_left color_white participant_info" onclick="toggle_display()">i</a>
                  <div class="position_absolute display_none" id="participant_listbody" onmouseout="toggle_display()"> 
                    <ul id='convo_users_list'>
                      
                    </ul>
                  </div>
                </div>
            </div>
            <label></label>
        </div>
        <label></label>

        <div id="_right_content_">

            <div id="chat_list" style="height:500px;">   <!-- make height dynamic -->
                <?=$_VIEW['list']?>
            </div>



            <div id="chat_logs" style="height:570px;">
                <div id="msg_container" style="padding:20px; ">

                </div>
            </div>
            <label></label>

            <div id="chat_input" >
                <div id="chat_box">
                    <textarea id="msg" onfocus="clear_text();" onblur="check_text()">Write your message here</textarea>
                    <a href="#" class="link_button_block green " style="padding:0;" onclick="send_message()">Send</a>
                    <span id="attach_button"><a id="file_attachment" class="link_button_block gray" onclick="run_up_func_res()" style="padding:0;" >Attach File</a></span>
                    <form name="file_attach" action="/message/service/upload_attachment" method="post" target="attachment_upload" enctype="multipart/form-data">
                         <IFRAME id=attachment_upload name=attachment_upload src='' onload="parent.postMessage('up', '*')" class="display_none"></IFRAME>
			             <input name="fileAttachment" id="app_res" type="file" onchange="run_gif_submit_res()" style="visibility:hidden;" class="display_none" />
                    </form>
                </div>
            </div>

        </div>
    </div>
    <label></label>
</div>

<script type="text/javascript">

 //================================================================================
 
 	var attach_file_link = '';

 	
 	function toggle_display()
 	{
		$("#participant_listbody").toggleClass('display_none')
 	}
 	
 	function run_gif_submit_res()
	{
	   $("#attach_button").html('<img src="/_application/content/images/small.preloader.gif" />');
	   submit_form('file_attach');
	}//end functioin

	function refresh_app_res(pParameter, pSuccess)
	{
		if(pSuccess)
		{
			 attach_file_link = attach_file_link + pParameter;
			 $('#attach_button').html('<a id="file_attachment" class="link_button_block gray" onclick="run_up_func_res()" style="padding:0;" >Attach File</a>');
		}
		else
		{
			p_url		=	'/message/service/get_filename';
			p_post		=	'';
			p_handler	=	refresh_app_res;
			global_ajax_request(p_url, p_handler, p_post);
		}
	}//end functioin

	function run_up_func_res()
	{
		var up_switch_res = true;
		check_iframe_res(up_switch_res);
		$('#app_res').click();
		//alert('here');
	}//end functioin

	function check_iframe_res(up_switch_res)
	{
		if(up_switch_res == true)
		 {
		 	// alert('yes');
		  	 addEventListener('message', function(event) {
		    if (event.data == 'up' && up_switch_res == true) {
		       up_switch_res = false;
		        refresh_app_res();
		    }
		});
		 }
	}//end functioin


//==================================================================================
 var msg_grp_id = <?=$_VIEW['mg_id']?>;
 var participants_html;
 var f_id;
 var l_id;
 var w_heigth;
 var name_search;
 var scroll_trigger = 1;
 var convo_count = 0;

  $( window ).resize(function(){ adjust_size(); });
  $('#msg_icon').removeClass('new');
  $('#msg_count').html(0);
  adjust_size();
  get_message(msg_grp_id);
  detect_scroll();

 // $( document ).ready( clearInterval(check) )
  function adjust_size()
    {
        w_heigth =  $(window).height();
   		$('#chat_logs').height(w_heigth-250);
    }

    var ref_message =  setInterval(function(){ refresh_message(); }, 3500);
    var ref_convo   = setInterval(function(){ get_convo(); }, 5000);
    $( "#search_box" ).focus(function() {
  		clearInterval(ref_convo);
	});

	$( "#msg" ).focus(function() {
  		$('#msg').keypress(function (e) {
		 var key = e.which;
		 if(key == 13)  // the enter key code
		  {
		    send_message();
		    return false;

		  }
		});
	});


    function detect_scroll()
    {
      // alert($("#chat_logs")[0].scrollHeight);
	  $( "#chat_logs" ).scroll(function() {

		  if($("#chat_logs").scrollTop() == 0)
		  {
			//alert($("#chat_logs")[0].scrollHeight);//refresh top message
			refresh_top_message();
			scroll_trigger = 0;
		  }

		  if($("#chat_logs").scrollTop() <= ($("#chat_logs")[0].scrollHeight-385))
		  {
			//alert('low');//pause setinterval for refresh message
			scroll_trigger = 0;

		  }

		 if($("#chat_logs").scrollTop() >= ($("#chat_logs")[0].scrollHeight-385))
		 {
			scroll_trigger = 1;
			//alert('low');
		  }

	  });

		//alert($("#chat_logs").scrollTop()+'++'+$("#chat_logs")[0].scrollHeight);


    }

    function check_text()
    {
        // alert('clear');

         if($('#msg').val() == '')
         {
			 $('#msg').val('Write your message here');
         }

    }

    function scroll_to_bottom(pSwitch)
    {
       if(pSwitch == 1)
       {
		   $('#chat_logs').stop().animate({
			  scrollTop: $("#chat_logs")[0].scrollHeight
			}, 0);
       }
    }

    function clear_text()
    {
        // alert('clear');
         if($('#msg').val() == 'Write your message here')
         {
			 $('#msg').val('');
         }
    }

    function check_input()
    {
        // alert('clear');

         if($('#search_box').val() == '')
         {
			 $('#search_box').val('Search Name');
			 ref_convo   = setInterval(function(){ get_convo(); }, 5000);
         }

    }

    function clear_input()
    {
        // alert('clear');
         if($('#search_box').val() == 'Search Name')
         {
			 $('#search_box').val('');
         }
    }

    function search_name()
    {
        // alert('clear');
         name_search = $('#search_box').val().trim();
          $( ".list_body" ).addClass( "display_none" );
         if(name_search == "")
         {
			 $( ".list_body " ).removeClass( "display_none" );
         }
         else
         {
             $( "div:contains("+name_search+")" ).parent().removeClass( "display_none" );
         }

    }


    function get_convo(pParameter, pSuccess)
    {
        if(pSuccess)
        {
		    $('#chat_list').html(pParameter);
		    $('.list_body').removeClass('active');
            $('#conv_'+msg_grp_id).addClass('active');
        }
        else
        {
            var msg          =    $('#msg').val();
            p_url        	 =    '/message/service/get_convo_list';
            p_post       	 =    '';
            p_handler    	 =    get_convo;
            global_ajax_request(p_url, p_handler, p_post);
        }
    }

    function send_message(pParameter, pSuccess)
    {
        if(pSuccess)
        {
		    $('#msg').val('');
		    attach_file_link = '';
		    var set 		  =   $.evalJSON(pParameter);
            l_id              = set.l_id;
           	$('#msg_container').append(set.list);
		    scroll_to_bottom(1);
		  	ref_message =  setInterval(function(){ refresh_message(); }, 3500);
    	    ref_convo   = setInterval(function(){ get_convo(); }, 5000);
        }
        else
        {
            if(msg != 'Write your message here')
            {
				clearInterval(ref_message);
                clearInterval(ref_convo);
                var msg          =    $('#msg').val() + attach_file_link;
                p_url        	 =    '/message/service/submit_message';
                p_post       	 =    'msg=' + msg + '&message_group_id='+msg_grp_id + '&l_id='+l_id;;
            	p_handler    	 =    send_message;
           	    global_ajax_request(p_url, p_handler, p_post);
            }
            
        }
    }

    function get_message(pParameter, pSuccess)
    {

        if(pSuccess)
        {
            var set =   $.evalJSON(pParameter);
            f_id              = set.f_id;
            l_id              = set.l_id;
            convo_count		  = set.convo_count;
            participants_html = '('+set.participant+' participants)';
           	$('#msg_container').html(set.list);
           	$('#convo_header').html(set.con_label);
           	$('#convo_users_list').html(set.convo_users);
           	$('#convo_header').attr('title',set.label_title);
           	if(set.participant > 1)
           	{
				$('#span_party').html(participants_html);
           	}
           	else
           	{
				$('#span_party').html('');
           	}

            scroll_to_bottom(1);
            ref_message =  setInterval(function(){ refresh_message(); }, 3500);
    	    ref_convo   = setInterval(function(){ get_convo(); }, 5000);

        }
        else
        {
            clearInterval(ref_message);
            clearInterval(ref_convo);
            msg_grp_id	     =    pParameter;
            $('.list_body').removeClass('active');
            $('#conv_'+msg_grp_id).addClass('active');
            $('#count_'+msg_grp_id).html('');
            p_url        	 =    '/message/service/view_message';
            p_post       	 =    'message_group_id=' + msg_grp_id;
            p_handler    	 =    get_message;
            global_ajax_request(p_url, p_handler, p_post);
        }
    }


    function refresh_message(pParameter, pSuccess)
    {
        if(pSuccess)
        {
            var set =   $.evalJSON(pParameter);
            l_id              = set.l_id;
            convo_count		  = set.convo_count;
          	$('#msg_container').append(set.list);
           	scroll_to_bottom(convo_count);
        }
        else
        {
            p_url        	 =    '/message/service/view_message';
            p_post       	 =    'message_group_id=' + msg_grp_id + '&l_id='+l_id;
            p_handler    	 =    refresh_message;
            global_ajax_request(p_url, p_handler, p_post);
        }
    }

    function refresh_top_message(pParameter, pSuccess)
    {

        if(pSuccess)
        {
            var set =   $.evalJSON(pParameter);
            f_id              = set.f_id;
           	$('#msg_container').prepend(set.list);
        }
        else
        {
            p_url        	 =    '/message/service/view_message';
            p_post       	 =    'message_group_id=' + msg_grp_id + '&f_id='+f_id;
            p_handler    	 =    refresh_top_message;
            global_ajax_request(p_url, p_handler, p_post);
        }
    }






</script>
