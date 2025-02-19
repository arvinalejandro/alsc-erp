<div id="content_body">    

    <div id="side_listings" style="margin-left:0px;">  
        <div style="border-bottom:1px solid #eaeaea;">
            <div style="width: 290px; border-right:1px solid #eaeaea;" class="float_left">
                <div class="pad_standard" style="height:32px;">
                    
                </div>
            </div>
            
            <div style="min-width:592px; width:67%;" class="float_left">
                <b class="font_size_18 float_left" style="padding: 20px 20px 0 20px;">New Message</b>
                <div class="float_right" style="margin:20px 10px 0 0;"></div>
            </div>
            <label></label>
        </div>            
        <label></label>
        
        <div id="_right_content_">
            
            <div id="chat_list" style="height:500px;">   <!-- make height dynamic -->
            </div>
            
            
            
            <div id="chat_logs" style="height:400px;">  <!-- set height dynamic (100px less total height) -->
                <div style="padding:20px;">
                
                    <div id="new_msg_container">  <!-- this is when there's no name added yet -->                    
                        <div class="float_left">To:</div>
                        <div class="float_left" style="width: 94%;">   
                            <div id="dummy_div" class="participant display_none">X <a href="#">x</a></div><!-- dummy -->
                                                  
                            <input id="part_input" onkeyup="get_users()" value="search names here" onfocus="clear_search()" onblur="check_search()"/>    
                            <label></label>
                        </div>    
                        <label></label>                    
                    </div>
                    
                    <div id="new_grp_name">  <!-- this is when there's no name added yet -->                    
                        <div class="float_left">Chat Name:</div>
                        <div class="float_left" style="width: 94%;">   
                                                  
                            <input id="chat_name_input" value="enter chat name" onfocus="clear_name_input()" onblur="check_name_input()"/>    
                            <label></label>
                        </div>    
                        <label></label>                    
                    </div>
                    
                    
                    
                    
                </div>
            </div>
            <label></label>   
            
            <div id="chat_input">
                <div id="chat_box">
                    <textarea id="msg" onfocus="clear_text();" onblur="check_text()">Write your message here</textarea>
                    <a href="#" class="link_button_block green " style="padding:0;" onclick="send_message()">Send</a>
                    <a href="#" class="link_button_block gray " style="padding:0;">Attach File</a>
                </div>
            </div>         
            
        </div>    
    </div>
    <label></label>
</div>
<script type="text/javascript">
 var name_key; 
 var w_heigth;
var  recepientId = [];    
    recepientSet   = {};
    
    $( window ).load(function(){ adjust_size(); });  
    $( window ).resize(function(){ adjust_size(); });
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
    function adjust_size()
    {
        w_heigth =  $(window).height();
   		$('#chat_logs').height(w_heigth-250);
    }
    
    function clear_search()
    {
         if($('#part_input').val() == 'search names here')
         {
			 $('#part_input').val('');
         }
    }
    
    function clear_name_input()
    {
         if($('#chat_name_input').val() == 'enter chat name')
         {
			 $('#chat_name_input').val('');
         }
    }
    
    function check_search()
    {
        // alert('clear');
         
         if($('#part_input').val() == '')
         {
			 $('#part_input').val('search names here');
         }
         
    }
    
    function check_name_input()
    {
        // alert('clear');
         
         if($('#chat_name_input').val() == '')
         {
			 $('#chat_name_input').val('enter chat name');
         }
         
    }
    
    function check_text()
    {
        // alert('clear');
         
         if($('#msg').val() == '')
         {
			 $('#msg').val('Write your message here');
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
    
    function send_message(pParameter, pSuccess)
    {
        if(pSuccess)
        {            
            //alert(pParameter);
            if(pParameter == 1)
            {
				//alert('yes');
				go_to('/message/service/inbox');
            }
        }
        else
        {            
            var chat_name          =    $('#chat_name_input').val();
            
            if(chat_name == 'enter chat name')
            {
				chat_name  = 'none';
            }
            
            $('.new_search_result').remove();
            var msg          =    $('#msg').val();
            var rec			 =    $.toJSON(recepientId);
            p_url        	 =    '/message/service/submit_new_message';
            p_post       	 =    'msg=' + msg + '&rec='+rec + '&chat_name='+chat_name;
            p_handler    	 =    send_message;                                      
            global_ajax_request(p_url, p_handler, p_post);
        }
    }
    
    function get_users(pParameter, pSuccess)
    {
        if(pSuccess)
        {            
          
           	var set 							=   $.evalJSON(pParameter);
           	objSet   							= {};
          
            for(var x in set.tag)
			{
		        userSet	  		     					= {};
				userSet['html_string']      			= set.tag[x].html_string;
				userSet['user_id']	 					= set.tag[x].user_id;
				objSet['user_'+set.tag[x].user_id]		=  userSet;
			 //alert(objSet.toSource());
			}
            $('#new_msg_container').after(set.list);
            $.each( recepientId, function( key, value ) {
			  	$("#user_"+value).addClass("display_none")
			});
        }
        else
        {            
            $('.new_search_result').remove();
            name_key         =    $('#part_input').val();
            p_url        	 =    '/message/service/get_users';
            p_post       	 =    'user_name=' + name_key;
            p_handler    	 =    get_users;                                      
            global_ajax_request(p_url, p_handler, p_post);
        }
    }
    
    
    
    function add_recepient(userId)
    {
        var checkArray = recepientId.indexOf(userId);
        
       // alert(checkArray);
        if(checkArray < 0)
        {            
            $('#part_input').val('');
            recepientId.push(userId);
            $('#dummy_div').after(objSet['user_'+userId].html_string);
            $('.new_search_result').remove();
        }
       
    }
    
    function delete_recepient(userId)
    {
         var checkArray = recepientId.indexOf(userId);
        if(checkArray > -1)
        {            
           recepientId.splice(checkArray,1);
           $('#tag_'+userId).remove();
           
        }
    }
    
  
    
    
    
</script>