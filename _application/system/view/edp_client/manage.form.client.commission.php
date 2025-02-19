<table class="mar_custom _form display_none" id="_commission_" style="font-weight:normal;" width="70%" cellpadding="8" cellspacing="0" border="0">
    <thead><tr><td colspan="4"><b style="font-size: 12px;">Commission Details</b></td></tr></thead>      
    <tr>
        <td class="color_gray" width="255">
            Scheme:
        </td>
        <td width="255">
        	<select id="_scheme_type" name="comission_scheme_type" onchange="get_commission_seller()">
		        <option></option>
		        <option value="old">Old</option>
		        <option value="new">New</option>
		    </select>
		</td>
        
         <td width="255">Finance Type :</td>
        <td width="255">
            <select id="" style="float:left;" name="client_account[str][option_scheme_finance_type_id]" >
               <option></option>
               <option value="in_house">In House</option>
               <option value="bank">Bank</option>
               
            </select>
        </td>
    </tr> 
    <tr>
	    <td>Seller Type :</td>
    	<td>
		    <select id="_commmission_scheme" style="float:left;" name="client_account[str][commission_scheme_id]" onchange="get_agent_commission()">
		       <option></option>
		    </select>
		</td>
        <td>Select Agent:</td>
		<td> 
			<select id="_scheme_agents" name="_scheme_agent" onchange="get_agent_list()">
			   <option></option>
			</select>
		</td>         
    </tr> 
    <tr>
    	<td colspan="4" id="_hidden_cell"></td>
    </tr>
    
    <tr>
        <td colspan="4">
        	<div class="align_center" style="margin-top:10px;">				               
				<a class="link_button_inline blue" onclick="next_form('account')">Back</a>
				 <a class="link_button_inline gray" href="/edp_client">Cancel</a>
				<a class="link_button_inline blue" onclick="submit_form('alsc_form')">Next</a>
			</div>  
			<br/> 
        </td>
    </tr>
        
</table>


        	
        	
<script type="text/javascript">
var _par;
var a_id;
	
	function get_commission_seller(pParameter, pSuccess)
	{
	    if(pSuccess)
	    {            
	         $('#_hidden_cell').html('');
	          $('#_scheme_agents').html('');
	        $('#_commmission_scheme').html(pParameter);
	    }
	    else
	    {            
	        _par		 =    $('#_scheme_type').val();
	        p_url        =    '/sales/commission/get_commission_seller';
	        p_post       =    'scheme_type=' + _par;
	        p_handler    =    get_commission_seller;                                      
	        global_ajax_request(p_url, p_handler, p_post);
	    }
	}
	
	
	function get_agent_commission(pParameter, pSuccess)
	{
	    if(pSuccess)
	    {            
	        $('#_hidden_cell').html('');
	        $('#_scheme_agents').html(pParameter);
	    }
	    else
	    {            
	        _par		 =    $('#_commmission_scheme').val();
	        p_url        =    '/sales/commission/get_agent_commission';
	        p_post       =    'commission_scheme_id=' + _par;
	        p_handler    =    get_agent_commission;                                      
	        global_ajax_request(p_url, p_handler, p_post);
	    }
	}
	
	
	function get_agent_list(pParameter, pSuccess)
	{
	    if(pSuccess)
	    {            
	       // alert(pParameter);
	        $('#_hidden_cell').html(pParameter);
	    }
	    else
	    {            
	        _par		 =    $('#_commmission_scheme').val();
	        a_id		 =    $('#_scheme_agents').val();
	        p_url        =    '/sales/commission/get_agent_list';
	        p_post       =    'commission_scheme_id=' + _par + '&agent_id=' + a_id;
	        p_handler    =    get_agent_list;                                      
	        global_ajax_request(p_url, p_handler, p_post);
	    }
	}
    
    

</script>