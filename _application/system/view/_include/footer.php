<script type="text/javascript">
	function get_dimension()
	{
		
		var varWidth	=	$(window).width();
		var varHeight	=	$(window).height() - 180;			
				
		var varPoperty	=	
		{	
			'width' 		: '100%',	
			'height' 		: varHeight + 'px'		
		}		
		$("#_right_content_").css(varPoperty);
		GLOBALS.calendar('._date_');
	}	
	
	
	window.onresize=function(){get_dimension()};
	
	GLOBALS.events.add('onload', get_dimension);
	GLOBALS.events.add('onload', check_msg);
	
	 var check =   setInterval(function(){ check_msg(); }, 4000);
 
 function check_msg(pParameter, pSuccess)
    {
        if(pSuccess)
        {            
		    if(pParameter > 0)
		    {
				$('#msg_icon').addClass('new');
		    }
		    else
		    {
				$('#msg_icon').removeClass('new');
		    }
		    $('#msg_count').html(pParameter);
        }
        else
        {            
            var msg          =    $('#msg').val();
            p_url        	 =    '/message/service/get_count_unread_convo';
            p_post       	 =    '';
            p_handler    	 =    check_msg;                                      
            global_ajax_request(p_url, p_handler, p_post);
        }
    }
	
</script>
</body>
</html>