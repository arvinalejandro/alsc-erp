<table class="mar_custom _form " id="_construction_list_" style="font-weight:normal;" width="100%" cellpadding="8" cellspacing="0" border="0">
      
	<thead>
		<tr><td colspan="10"><h1>Engineering Projects</h1></td></tr>
		<tr>   
		    <td>Project</td>
		    <td align="center">Lot</td>
		    <td align="center">Construction Type</td>
		    <td>Contractor</td>
		    <td align="center">Status</td> 
		    <td>Date Started</td>
		    <td>Date Completed</td>                        
		    <td>Estimated Cost</td>
		    <td>Actual Cost</td>              
		    <td width="10%"></td> 
		</tr>
	                                     
	                          
	   
	</thead>
	<tbody>
	   
	   
	   {row}
	   
							  
	</tbody>  
</table>


<script type="text/javascript">


	function select_project(lot_construction_id)
	{
		var p_url			=	'/edp_client/edp_client_manage/ajax_get_construction';
		var post_data	=	new Object;
		post_data.id		=	lot_construction_id;
		
		global_ajax_request(p_url, next_page, post_data);
		
		
	}
	
	function next_page(p_data)
	{
		var construction_data	=	 JSON.parse(p_data);
		
		for (var p_key in construction_data)
		{
			var p_id_html	=	'.__' +  p_key; 
			var p_id_input	=	'.' +  p_key + '__'; 
			
			$(p_id_html).html(construction_data[p_key]);
			$(p_id_input).val(construction_data[p_key]);
			
		}
		GLOBALS.pr(construction_data);
		compute();
		next_form('construction_profile');
		
	}
	
	
	
/*

function global_ajax_request(p_url, p_handler, p_post) 
{
	if(AJAX_ALLOW)
	{
		AJAX_ALLOW	=	false;
		AJAX	=	$.ajax					
					({
						url 		: 	p_url,
						type 		: 	'POST',
						data 		: 	p_post,
						//beforeSend	:	_add_before_send,
						complete	: 	ajax_complete,
						success 	: 	p_handler
					});	
	}	
}

*/

</script>