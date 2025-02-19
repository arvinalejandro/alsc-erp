
<div id="content_body">     
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" >
        
        <!---------- CONTENT CONTROLLERS ----------->
        
        <div class="border_bottom_gray" id="controls">
		    <div class="content_block_vpad">            	
			        
			        
			        
			        			    
				    <a class="link_button_inline float_left _control blue" id="_account" style="margin-left:5px;">
				        Account Profile >
				    </a>			   
				    
				    <a class="link_button_inline gray float_left gray" style="margin-left:5px;">
				        Submit
				    </a>
		       			        
			    
			    <label></label>
		    </div>   
		</div> 
        
        <?php
        	
        	$lcp	=	$_VIEW['lot_price'] * $_VIEW['lot_area'];
        	$tcp	=	$lcp + $_VIEW['house_price'];
        	
        ?>
           
        <div style="overflow: auto;" id="_right_content_">  <!--set max-height by making it dynamic -->       	
        	<br/>        	
        	<form action="/edp_client/edp_client_manage/account_add_other_submit/&id=<?=$_GET['id']?>" name="alsc_form" method="post">
        		<input type="hidden" name="client[int][user_id]" value="<?=$_VIEW['user_id']?>" />        		
        		<input type="hidden" name="client_account[int][user_id]" value="<?=$_VIEW['user_id']?>" />        		
        		<input type="hidden" name="client_account[int][agent_id]" value="<?=$_VIEW['agent']['agent_id']?>" />
        		<input type="hidden" name="client_account[int][network_id]" value="<?=$_VIEW['network_id']?>" />
        		<input type="hidden" name="client_account[int][network_division_id]" value="<?=$_VIEW['network_division_id']?>" />
        		
        		  
        		
        		<!--Account Profile-->
        		<table class="mar_custom _form " id="_account_" style="font-weight:normal;" width="70%" cellpadding="8" cellspacing="0" border="0">
        			<thead><tr ><td colspan="4"><h1>Account Settings</h1></td></tr></thead>
        			<tr>        			
        				<td><b>Transaction Type : </b></td>
        				<td><select name="client_account[int][option_transaction_type_id]"><?=$_VIEW['option_transaction_type']?></select></td>
        				<td><b>Account Type : </td>        			
        				<td><select name="client_account[int][option_account_type_id]"><?=$_VIEW['option_account_type']?></select></td>	
        			</tr>
        			<tr>        			
        				<td><b>Account Status : </b></td>
        				<td><select name="client_account[int][option_account_status_id]"><?=$_VIEW['option_account_status']?></select></td>
        				<td><b>Buyer Type : </td>        			
        				<td><select name="client_account[int][option_buyer_type_id]"><?=$_VIEW['option_buyer_type']?> </select></td>	
        			</tr>
        			
                    <thead><tr ><td colspan="4"><h1>Account Overview</h1></td></tr></thead>
        			<tr>        			
        				<td><b>Account Holder : </b></td>
        				<td><span><?=$_VIEW['client']['client_name']?> <?=$_VIEW['client']['client_surname']?></span></td>
        				<td><b>Account Number : </td>        			
        				<td><input type="text" name="client_account[str][client_account_number]"   /></td>    			
        			</tr> 			     			
        			<tr>        			
        				<td><b>Unit Type : </b></td>
        				<td><input type="text" name="client_account[str][client_account_type]" /></td>
        				<td><b>Date of Sale: </td>        			
        				<td><input type="text" name="client_account[str][client_account_date_sale]" class="_date_" /></td>    			
        			</tr>
        			
        			<thead><tr class="display_none" ><td colspan="4"><h1>Investment Value - Lot</h1></td></tr></thead>        		
        			<tr class="display_none">        			
        				<td width="15%"><b>Lot Area : </b></td>
        				<td width="20%"><span><?=$_VIEW['lot_area']?></span> sqm.</td>
        				<td width="15%"></td>
        				<td width="20%"></td>
        			</tr>
        			<tr class="display_none">        			
        				<td><b>Price/sqm. : </b> </td>
        				<td>P <span><?=string_amount($_VIEW['lot_price'])?></span> / sqm.</td>
        				<td></td>
        				<td></td>
        			</tr> 
        			<tr class="display_none">        			
        				<td><b>LCP : </b> </td>
        				<td>P <span><?=string_amount($lcp)?></span> <input type="hidden" name="client_account[int][client_account_lcp]" value="<?=$lcp?>"  id="client_account_lcp"  /></td>
        				<td></td>        			
        				<td></td>        			
        			</tr> 
        			<tr class="display_none">        			
        				<td>
        					<b>% Discount : </b>        				
        				</td>
        				<td><input type="text" name="client_account[int][client_account_discount]" value="0.00" id="client_account_discount" class="_compute_" /></td>
        				<td><b>Discounted Amount</b> :</td>
        				<td>P <span class="_client_account_discount_amount">0.00</span> <input type="hidden" name="client_account[int][client_account_discount_amount]" value="0.00" id="client_account_discount_amount" /></td>
        			</tr>          		
        			<tr class="display_none">
        				<td></td>
        				<td></td>
        				<td><b>Net LCP : </b> </td>
        				<td>P <span class="_client_account_lcp_net"><?=string_amount($lcp)?></span> <input type="hidden" name="client_account[int][client_account_lcp_net]" value="<?=$lcp?>" id="client_account_lcp_net" /></td>
        			</tr>       		
        			
                    <thead><tr ><td colspan="4"><h1>Investment Value</h1></td></tr></thead>        		
        			<tr class="display_none">        			
        				<td><b>House Model : </b></td>
        				<td><span><?=$_VIEW['house_name']?></span></td>
        				<td></td>
        				<td></td>
        			</tr>
        			<tr class="display_none">        			
        				<td><b>Classification : </b> </td>
        				<td><span><?=$_VIEW['option_house_classification_name']?></span></td>
        				<td></td>
        				<td></td>
        			</tr>         			
        			<tr class="display_none">        			
        				<td><b>Floor Area : </b> </td>
        				<td><span><?=$_VIEW['house_area']?></span></td>
        				<td></td>        			
        				<td></td>        			
        			</tr> 
        			<tr class="display_none">        			
        				<td><b>Investment Price : </b></td>
        				<td><input type="text" value="<?=string_amount($_VIEW['house_price'])?>" name="client_account[int][client_account_hcp]" id="client_account_hcp" class="_compute_" /></td>
        				<td><b>Soil Poisoning : </b></td>
        				<td><input type="text" name="client_account[int][client_account_soil_poison]" value="0.00" id="client_account_soil_poison" class="_compute_" /></td>
        			</tr> 
        			<tr>        			
        				<td><b>Contract Price : </b></td>
        				<td><input type="text" name="client_account[int][client_account_added_cost]" value="0.00" id="client_account_added_cost" class="_compute_" /></td>
        				<td><b>Description : </b></td>
        				<td><input type="text" name="client_account[str][client_account_added_cost_desc]" /></td>
        			</tr>         	
                    	        		
        			<thead><tr ><td colspan="4"><h1>Investment Computation</h1></td></tr></thead>
        			<tr class="display_none">        			
        				<td><b>Net LCP : </b> P <span class="_client_account_lcp_net"><?=string_amount($lcp)?></span></td>
        				<td><b>HCP : </b> <span class="_client_account_hcp"><?=string_amount($_VIEW['house_price'])?></span></td>
        				<td><b>Soil Poisoning : </b> P <span class="_client_account_soil_poison">0.00</span></td>        			
        				<td><b>Added Cost : </b> P <span class="_client_account_added_cost">0.00</span></td>        			
        			</tr>
        			<tr>        			
        				<td></td>
        				<td></td>
        				<td></td> 
        				<td><b>Net TCP : </b>P <span class="_client_account_tcp_net"><?=string_amount($tcp)?></span><input type="hidden" name="client_account[int][client_account_tcp_net]" value="<?=$tcp?>" id="client_account_tcp_net" /></td>
        			</tr>
        			
                    <thead><tr ><td colspan="4"><h1>Down Payment Schedule</h1></td></tr></thead>
                    <tr>                    
                        <td><b>% Down Payment: </b></td>
                        <td><input type="text" name="client_account[int][client_account_dp_percent]" value="0.00" id="client_account_dp_percent" class="_compute_" /></td>
                        <td><b>Down Payment Amount: </b></td>
                        <td>P <span class="_client_account_dp_amount">0.00</span><input type="hidden" name="client_account[int][client_account_dp_amount]" value="0.00" id="client_account_dp_amount" /></td>
                    </tr> 
                    <tr>
                        <td><b>Misc. Fee: </b></td>
                        <td><input type="text" name="client_account[int][client_account_misc_fee]" value="0.00" id="client_account_misc_fee" class="_compute_" /></td>                        
                        <td><b>Total Down Payment: </b></td>
                        <td>P <span class="_client_account_dp_total">0.00</span <input type="hidden" name="client_account[int][client_account_dp_total]" value="0.00" /></td>                        
                    </tr>
                    
                    <tr>            
                        <td><b>Less Reservation: </b></td>
                        <td><input type="text" name="client_account[int][client_account_reservation_paid]" value="0.00" id="client_account_reservation_paid" class="_compute_" /></td>
                        <td><b>Reservation Date Paid : </b></td>
                        <td><input type="text" name="client_account[str][client_account_reservation_date]" class="_date_" /></td>
                    </tr>
                    <tr>  
                        <td><b>Reservation O.R #: </b></td>
                        <td><input type="text" name="client_account[str][client_account_reservation_receipt]" /></td>  
                        <td><b>Net Down Payment: </b></td>
                        <td class="color_green"><b>P</b> <b class="_client_account_dp_net">0.00</b></td>                                 
                    </tr>
                    <tr class="display_none">                    
                        <td><b>Down Payment Date Paid : </b></td>
                        <td><input type="text" name="client_account[str][client_account_dp_paid_date]" class="_date_" /></td>
                        <td><b>Down Payment O.R #: </b></td>
                        <td><input type="text" name="client_account[str][client_account_dp_paid_receipt]" /></td>
                    </tr>
                    <tr class="display_none">                    
                        <td><b>Down Payment Amount Paid: </b></td>
                        <td colspan="3"><input type="text" name="client_account[int][client_account_dp_paid]" value="0.00" /></td> 
                        <td><b>Net Down Payment: </b></td>
                        <td class="color_green"><b>P</b> <b class="_client_account_dp_net"> 0.00</b> <input type="hidden" name="client_account[int][client_account_dp_net]" id="client_account_dp_net" value="0.00" /></td>                      
                    </tr>
                    <tr>                    
                        <td><b>Down Payment Type: </b></td>
                        <td><select name="client_account[int][option_account_p1_id]" onchange="dp_type(this)"><?=$_VIEW['option_account_p1']?></select></td> 
                        <td><b>Due Date: </b></td>
                        <td><input type="text" name="client_account[str][client_account_dp_due_date]" class="_date_" /></td>                     
                    </tr>                
                    <tr class="_dp_partial ">                    
                        <td><b>Months to Pay: </b></td>
                        <td><input type="text" name="client_account[int][client_account_dp_term]" value="1" id="client_account_dp_term" class="_compute_" /></td>
                        <td><b>Partial Down Payment: </b></td>
                        <td class="color_green"><b>P</b> <b class="_client_account_dp_monthly">0.00</b><input type="hidden" name="client_account[int][client_account_dp_monthly]" value="0.00" id="client_account_dp_monthly" /></td>
                    </tr>
                    
        			<thead><tr ><td colspan="4"><h1>Monthly Amortization</h1></td></tr></thead>
        			<tr>        			
        				<td><b>Net TCP: </b></td>
        				<td><span class="_client_account_tcp_net"><?=string_amount($tcp)?></span></td>
        				<td><b>Net Down Payment: </b></td>
        				<td><span>P</span> <span class="_client_account_dp_net">0.00</span></td>
        			</tr>
        			<tr>        			
        				<td><b>Amount to be Financed: </b></td>
        				<td class="color_green"><b>P</b> <b class="_client_account_ma_amount"><?=string_amount($tcp)?></b><input type="hidden" name="client_account[int][client_account_ma_amount]" value="<?=$tcp?>" id="client_account_ma_amount" /></td>
        				<td><b>Payment Type: </b></td>
        				<td colspan="3"><select name="client_account[int][option_account_p2_id]"><?=$_VIEW['option_account_p2']?></select></td>
        			</tr>
        			<tr>        			
        				<td><b>Terms: </b></td>
        				<td><input type="text" name="client_account[int][client_account_ma_term]" value="1" id="client_account_ma_term" class="_compute_" /></td>
        				<td><b>Commence Date: </b></td>
        				<td><input type="text" name="client_account[str][client_account_ma_due_date]" class="_date_" /></td>
        			</tr> 
        			<tr>        			
        				<td><b>Interest Rate: </b></td>
        				<td><input type="text" name="client_account[int][client_account_ma_interest]" value="15" id="client_account_ma_interest" class="_compute_" /></td>
        				<td><b>Fixed Factor: </b></td>
        				<td><b class="color_green _client_account_ma_factor">1.00</b><input type="hidden" name="client_account[int][client_account_ma_factor]" value="1.00" id="client_account_ma_factor" /></td>        			
        			</tr> 
        			<tr>
        				<td><b>Monthly Payment: </b></td>
        				<td colspan="3"><b class="color_green _client_account_ma_monthly">Arnie Alejandro</b><input type="hidden" name="client_account[int][client_account_ma_monthly]" value="0.00" id="client_account_ma_monthly" /></td>
        			</tr>
        			
                    <thead><tr ><td colspan="4"><h1>Marketing</h1></td></tr></thead>
                    <tr>                    
                        <td><b>Network: </b></td>
                        <td><span><?=(($_VIEW['network_name']) ? $_VIEW['network_name'] : 'none')?></span></td>
                        <td><b>Division: </b></td>
                        <td><span><?=(($_VIEW['network_division_name']) ? $_VIEW['network_division_name'] : 'none')?></span></td>
                    </tr>
                    <tr>                    
                        <td><b>Assistant Vice President: </b></td>
                        <td><span><?=(($_VIEW['agent']['agent_name']) ? $_VIEW['agent']['agent_name'] : 'none')?></span></td>
                        <td><b>Sales Manager: </b></td>
                        <td><span><?=(($_VIEW['agent']['agent_name']) ? $_VIEW['agent']['agent_name'] : 'none')?></span></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>                    
                        <td><b>Marketing Associate: </b></td>
                        <td><span><?=(($_VIEW['agent']['agent_name']) ? $_VIEW['agent']['agent_name'] : 'none')?></span></td>
                    </tr>
        			
                    <thead><tr ><td colspan="4"><h1>Remarks</h1></td></tr></thead>
        			<tr>
        				<td>Remarks</td>
        				<td colspan="3">
        					<input type="hidden" name="remark[remark_key]" value="client_account_id" />
        					<textarea style="width: 100%; height: 200px;" name="remark[str][remark_content]"></textarea>
        				</td>
        			</tr>
        			<tr>
        				<td colspan="4">
        					<div class="align_center" style="margin-top:10px;">			             
				                
				                <a class="link_button_inline gray" href="/edp_client/edp_client_manage/account/&id=<?=$_GET['id']?>">Cancel</a>
				                <a class="link_button_inline blue" onclick="submit_form('alsc_form')">Next</a>
				            </div>  
				            <br/> 
        				</td>
        			</tr>
        		</table>  
        		<br />
        		<br />
           	</form>
            
            <label></label>                 
            
        </div>    
    </div>
    <label></label>

</div>

<script type="text/javascript">

	pCloneCount		=	0;
	
	function add_member(pObj)
	{		
		var	prev_clone		=	String(pCloneCount);
		pCloneCount++;
		var next_clone		=	String(pCloneCount);
		
		var varTpl 		=	'<tr class="_clone_'+next_clone+'">'                    
		varTpl          +=        '<td colspan="2">'
		varTpl          +=              '<span class="font_size_10">Full Name</span>'
		varTpl          +=              '<input type="text" name="client_member['+next_clone+'][str][client_member_name]" />'
		varTpl          +=              '<input type="hidden" name="client_member['+next_clone+'][int][user_id]" value="<?=$_VIEW['user_id']?>" />'
		varTpl          +=          '</td>'                                        
		varTpl          +=          '<td>'
		varTpl          +=             ' <span class="font_size_10">Relationship to Primary Account Holder</span>'
		varTpl          +=              '<input type="text" name="client_member['+next_clone+'][str][client_member_relation]">'
		varTpl          +=          '</td>'	                                        
		varTpl          +=      '</tr>'
		
		
		$('._clone_'+prev_clone).after(varTpl);	
		
	}
	 
	
	function next_form(pId)
	{
		$('._form').addClass('display_none');
		$('._control').addClass('gray');
		
		$('#'+'_' + pId + '_').removeClass('display_none');
		$('#'+'_' + pId).removeClass('gray');
		$('#'+'_' + pId).addClass('blue');	
	}
	
	function set_calendar()
	{
		GLOBALS.calendar('._date_');	
		$('._amount_').bind('blur', function() 
		{			
			ptest	=	$(this).val();
			ptest	=	string_amount(ptest, true);			
			ptest	=	(isNaN(ptest)) ? '0.00' : ptest;
			$(this).val(ptest);
		}
		)	
	}
	
	$('._compute_').keyup(function(){compute(this)});
	
	function compute(pObj)
	{
		// LCP
		var Pclient_account_lcp					=	$("#client_account_lcp").val();
			Pclient_account_lcp					=	string_amount(Pclient_account_lcp);			
		// % Discount
		var Pclient_account_discount			=	$("#client_account_discount").val();	
			Pclient_account_discount			=	string_amount(Pclient_account_discount); 
		// Discount Amount
		var Pclient_account_discount_amount		=	(Pclient_account_lcp * Pclient_account_discount) / 100; 
			Pclient_account_discount_amount		=	string_amount(Pclient_account_discount_amount);
			$('#client_account_discount_amount').val(Pclient_account_discount_amount);
			$('._client_account_discount_amount').html(string_amount(Pclient_account_discount_amount, 1));			
		// Net LCP
		var Pclient_account_lcp_net				=	Pclient_account_lcp - Pclient_account_discount_amount;
			Pclient_account_lcp_net				=	string_amount(Pclient_account_lcp_net);
			$('#client_account_lcp_net').val(Pclient_account_lcp_net);
			$('._client_account_lcp_net').html(string_amount(Pclient_account_lcp_net, 1));		
		// Hcp
		var Pclient_account_hcp					=		$("#client_account_hcp").val();
			Pclient_account_hcp					=		string_amount(Pclient_account_hcp);
			$("._client_account_hcp").html(string_amount(Pclient_account_hcp, 1));			
		// Soil Poisoning
		var Pclient_account_soil_poison			=		$("#client_account_soil_poison").val();
			Pclient_account_soil_poison			=		string_amount(Pclient_account_soil_poison);
			$("._client_account_soil_poison").html(string_amount(Pclient_account_soil_poison, 1));
		// Added Cost
		var Pclient_account_added_cost			=		$("#client_account_added_cost").val();
			Pclient_account_added_cost			=		string_amount(Pclient_account_added_cost);
			$("._client_account_added_cost").html(string_amount(Pclient_account_added_cost, 1));
		// Net TCP
		var Pclient_account_tcp_net				=		Pclient_account_lcp_net + Pclient_account_hcp + Pclient_account_soil_poison + Pclient_account_added_cost;
			Pclient_account_tcp_net				=		string_amount(Pclient_account_tcp_net);
			$('#client_account_tcp_net').val(Pclient_account_tcp_net);
			$('._client_account_tcp_net').html(string_amount(Pclient_account_tcp_net, 1));
		// % DP
		var Pclient_account_dp_percent			=		$("#client_account_dp_percent").val();
			Pclient_account_dp_percent			=		string_amount(Pclient_account_dp_percent);			
		// DP Amount
		var Pclient_account_dp_amount			=		(Pclient_account_tcp_net * Pclient_account_dp_percent) / 100;
			Pclient_account_dp_amount			=		string_amount(Pclient_account_dp_amount);
			$('._client_account_dp_amount').html(string_amount(Pclient_account_dp_amount, 1));			
			$('#client_account_dp_amount').val(Pclient_account_dp_amount);			
		// Less Reservation								
		var Pclient_account_reservation_paid	=		$("#client_account_reservation_paid").val();
			Pclient_account_reservation_paid	=		string_amount(Pclient_account_reservation_paid);
		// Net DP
		var Pclient_account_dp_net				=		Pclient_account_dp_amount - Pclient_account_reservation_paid;
			Pclient_account_dp_net				=		string_amount(Pclient_account_dp_net);
			$('._client_account_dp_net').html(string_amount(Pclient_account_dp_net, 1));
			$('#client_account_dp_net').val(Pclient_account_dp_net);
		// Misc Fee
		var Pclient_account_misc_fee			=		$('#client_account_misc_fee').val();
			Pclient_account_misc_fee			=		string_amount(Pclient_account_misc_fee);			
		// Total DP
		var Pclient_account_dp_total			=		Pclient_account_dp_amount + Pclient_account_misc_fee;
			Pclient_account_dp_total			=		string_amount(Pclient_account_dp_total);
			$('#client_account_dp_total').val(Pclient_account_dp_total);
			$('._client_account_dp_total').html(string_amount(Pclient_account_dp_total, 1));
		// Months to pay
		var Pclient_account_dp_term				=		$('#client_account_dp_term').val();
			Pclient_account_dp_term				=		parseInt(Pclient_account_dp_term);
			Pclient_account_dp_term				=		(Pclient_account_dp_term > 0) ? Pclient_account_dp_term : 1;
		// Partial Down Payment
		var Pclient_account_dp_monthly			=		Pclient_account_dp_net / Pclient_account_dp_term;
			Pclient_account_dp_monthly			=		string_amount(Pclient_account_dp_monthly);
			$('#client_account_dp_monthly').val(Pclient_account_dp_monthly);
			$('._client_account_dp_monthly').html(string_amount(Pclient_account_dp_monthly, 1));
		// Amount to be financed
		var Pclient_account_ma_amount			=		Pclient_account_tcp_net - (Pclient_account_dp_net + Pclient_account_reservation_paid);			
			Pclient_account_ma_amount			=		string_amount(Pclient_account_ma_amount);			
			$('#client_account_ma_amount').val(Pclient_account_ma_amount);
			$('._client_account_ma_amount').html(string_amount(Pclient_account_ma_amount, 1));
		// MA Terms
		var Pclient_account_ma_term				=		$('#client_account_ma_term').val();
			Pclient_account_ma_term				=		parseInt(Pclient_account_ma_term);
			Pclient_account_ma_term				=		(Pclient_account_ma_term > 0) ? Pclient_account_ma_term : 1;
		// Interest Rate
		var Pclient_account_ma_interest			=		$('#client_account_ma_interest').val();
			Pclient_account_ma_interest			=		parseInt(Pclient_account_ma_interest);
			Pclient_account_ma_interest			=		(Pclient_account_ma_interest > 0) ? Pclient_account_ma_interest : 1;
		// Rate Value
		var PrateValue							=		Pclient_account_ma_interest / 1200;
			PrateValue							=		string_amount(PrateValue, false, 10);					
		// Rate Terms
		var PrateTerms							=		1 - (Math.pow( (PrateValue + 1), (-1 * Pclient_account_ma_term)));
			PrateTerms							=		string_amount(PrateTerms, false, 10);
		// Fixed Factor
		var PfixedFactor						=		PrateValue / PrateTerms;
			PfixedFactor						=		string_amount(PfixedFactor, false, 8);
			$('._client_account_ma_factor').html(PfixedFactor);
			$('#client_account_ma_factor').val(PfixedFactor);
		// Monthly Payment
		var Pclient_account_ma_monthly			=		PfixedFactor * Pclient_account_ma_amount;
			Pclient_account_ma_monthly			=		string_amount(Pclient_account_ma_monthly);
			$('#client_account_ma_monthly').val(Pclient_account_ma_monthly);
			$('._client_account_ma_monthly').html(string_amount(Pclient_account_ma_monthly, 1));
			
			
			
		
		
	}
	
	/*
		
		 	client_account_discount_amount		=	client_account_lcp 	*	client_account_discount
	 		client_account_lcp_net				=	client_account_lcp	-	client_account_dicount_amount
	 	
	*/
	
	function dp_type(pObj)
	{
		var pVal	=	$(pObj).val();
		
		if(pVal == '1')
		{			
			$('._dp_partial').removeClass('display_none');				
		}
		else
		{		
			$('._dp_partial').addClass('display_none');
		}
	}
	
	
	function string_amount(pValue, pGetString, pFixed)
	{
		pFixed	=	(pFixed) ? pFixed : '2';
		pFixed	=	parseInt(pFixed);
		pValue	=	String(pValue);		
		pValue	=	(pValue) ? pValue : '0.00'; 
		pValue	=	pValue.replace(/[^\d\.]/g, '');
		pValue	=	parseFloat(pValue);		
		
		if(pGetString)
		{			
			pValue	=	pValue.toFixed(pFixed).replace(/\d(?=(\d{3})+\.)/g, '$&,');					
		}
		else
		{			
			pValue	=	pValue.toFixed(pFixed);
			pValue	=	parseFloat(pValue);
		}		
		
		return pValue;				
	}
	
	
	
	
	
	//alert(Math.pow(1.0125, -60));
	
	
	
	/*
	var 
	var 
	var percent_dp				=	$('#_percent_dp').val().replace(/\,/g, '');
	var 
	
	var 
	var fixed_factor			=	$('#_fixed_factor').val().replace(/\,/g, '');
	
	var 
	var 
	
	var 
	var 
	var amount_for_finance			=	$('#_amount_for_finance').val().replace(/\,/g, '');
	var 
	var 
	var amount_total				=	$('#_amount_total').val().replace(/\,/g, '');
	var amount_monthly				=	$('#_amount_monthly').val().replace(/\,/g, '');
	var 
	*/
	
	
	
	
	//alert(varLotPrice.toFixed(2));
	
	
	//var varLotPrice	=	("9,320" *  1) + 1;
	
	//varLotPrice = parseFloat(varLotPrice) + 12345;
	
	
	
	GLOBALS.events.add('onload', set_calendar);

</script>

