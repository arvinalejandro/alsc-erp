<table class="mar_custom _form " id="_lot_list_" style="font-weight:normal;" width="100%" cellpadding="8" cellspacing="0" border="0">
      
	<thead>
		<tr><td colspan="10"><h1>Lot Inventory</h1></td></tr>
		<tr>   
            <td align="center">Phase</td> 
            <td align="center">Block</td>
            <td align="center">Lot</td>
            <td>Account Number</td>
            <td>Lot Area (sqm.)</td>
            <td>Lot Price / sqm.</td> 
            <td>LCP</td>                                   
            <td align="center">Type</td>              
            <td align="center">Lot Status</td>                        
            <td></td>
        </tr>                 
	   
	</thead>
	<tbody>   
	   
	   {row}
	   	
	   	<tr>
	   		<td colspan="10">
	   			<div class="mar_custom" style="margin-top:10px; width:204px;">
                	<a class="link_button_inline float_left gray" style="border-radius:3px 0 0 3px; width:80px;" href="/edp_client/account/profile/&id={client_id}">Cancel</a>
                </div>
	   		</td>
	   	</tr>			  
	</tbody>  
</table>


<script type="text/javascript">


	function get_profile(lot_id)
	{
		var p_url			=	'/edp_client/edp_client_manage/ajax_get_lot';
		var post_data	=	new Object;
		post_data.id		=	lot_id;
		
		//alert(lot_id);
		
		global_ajax_request(p_url, next_page, post_data);
		
		
	}
	
	function next_page(p_data)
	{
		var construction_data	=	 JSON.parse(p_data);
		
		for (var p_key in construction_data)
		{
			var p_id_html	=	'.__' +  p_key ; 
			var p_id_input	=	'.' +  p_key + '__'; 
			
			$(p_id_html).html(construction_data[p_key]);
			$(p_id_input).val(construction_data[p_key]);
									
		}
		GLOBALS.pr(construction_data);
		compute();
		next_form('lot_profile');
		
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