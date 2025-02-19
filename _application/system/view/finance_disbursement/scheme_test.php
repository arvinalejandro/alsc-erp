<div id="content_body">    
    <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">     
     
        <div style="overflow: auto; width:100%;" id="_right_content_">  <!--set max-height by making it dynamic -->                        
            <form action="" name="alsc_form" method="post">
            <table class="mar_custom" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">                                                 <tr class="selected">
                   <tr class="selected" >                        
                        <td>Select Scheme:</td>
		                <td> 
		                    <select id="_scheme_type" name="comission_scheme_type" onchange="get_commission_seller()">
		                        <option></option>
		                        <option value="old">Old</option>
		                        <option value="new">New</option>
		                    </select>
		           
                        <td>Finance Type :</td>
                        <td>
                            <select id="" style="float:left;" name="client_scheme[option_scheme_finance_type_id]" >
                               <option></option>
                               <option value="in_house">In House</option>
                               <option value="bank">Bank</option>
                               
                            </select>
                        </td>
                   </tr>  
                   <tr>
                     <td>Seller Type :</td>
                        <td>
                            <select id="_commmission_scheme" style="float:left;" name="comission_scheme_id" onchange="get_agent_commission()">
                               <option></option>
                            </select>
                        </td>
                     <td>Select Agent:</td>
		                <td> 
		                    <select id="_scheme_agents" name="_scheme_agent" onchange="get_agent_list()">
		                       <option></option>
		                    </select>
		           
                        <td id="_hidden_cell"></td>
                        <td>
                        </td>
		               
		    	   </tr>
		              
                    
                   
                </table>  
            </form>
        
                
        </div>    
    </div>
    <label></label>

</div>


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
