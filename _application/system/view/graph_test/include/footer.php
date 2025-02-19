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
	}
	
	window.onresize=function(){get_dimension()};
	
	GLOBALS.events.add('onload', get_dimension)
	
</script>
</body>
</html>