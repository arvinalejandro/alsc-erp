<?php
	
	if($_VIEW['option_unit_id'] == 'lot_only') 
	{
		$option_unit_account_type_id = 'lot_only';
		$disable_house	=	'display_none';
	}
	else
	{
		$option_unit_account_type_id = 'package';		
		$disable_house	=	'';
	}	
?>
<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" > 
        
        <!---------- CONTENT CONTROLLERS ----------->
         
        <div class="border_bottom_gray" id="controls">
		    <div class="content_block_vpad align_center">			        
			    <div class="mar_custom" style="width:710px;">
                    <a class="link_button_inline float_left _control blue" id="_investment" style="border-radius:3px 0 0 3px;">
                        <span style="border: 1px solid #919296; border-radius:10px; padding:2px 6px; background-color:#fff; color:#919296;">1</span>
                        Investment Details
                    </a>
                    <a class="link_button_inline float_left _control gray" id="_client" style="border-radius:0;">
                        <span style="border: 1px solid #919296; border-radius:10px; padding:2px 6px; background-color:#fff; color:#919296;">2</span>
                        Client Profile
                    </a>        
                    <a class="link_button_inline float_left _control gray" id="_reservation" style="border-radius:0;">
                        <span style="border: 1px solid #919296; border-radius:10px; padding:2px 6px; background-color:#fff; color:#919296;">3</span>
                        Reservation/Earnest
                    </a>
                    <a class="link_button_inline float_left _control gray" id="_account_settings" style="border-radius:0;">
                        <span style="border: 1px solid #919296; border-radius:10px; padding:2px 6px; background-color:#fff; color:#919296;">4</span>
                        Account Settings
                    </a>
                    <a class="link_button_inline float_left _control gray" id="_account" style="border-radius:0;">
                        <span style="border: 1px solid #919296; border-radius:10px; padding:2px 6px; background-color:#fff; color:#919296;">5</span>
                        Computation
                    </a>            
                    <a class="link_button_inline gray float_left gray" style="border-radius:0 3px 3px 0;">
                        <span style="border: 1px solid #919296; border-radius:10px; padding:2px 6px; background-color:#fff; color:#919296;">6</span>    
                        Submit Form
                    </a>    
                    <label></label>
                </div>
                <label></label>
		    </div>   
		</div>         
        
           
        <div style="overflow: auto;" id="_right_content_">  <!--set max-height by making it dynamic -->       	
        	<br/>        	
        	<form action="/edp_client/edp_client_manage/account_submit/&id=<?=$_GET['id']?>" name="alsc_form" method="post">             		       		
        		<!-- investment -->
        		<?=$_VIEW['view']['client.investment']?>    
        			<input type="hidden" name="lot[str][option_availability_id]" value="sold" />        			 		        		
        		<!-- client -->
        		<?=$_VIEW['view']['client.create']?>       		  
        			<input type="hidden" name="client[int][user_id]" value="<?=$_VIEW['user_id']?>" />      
        		<!-- reservation -->
        		<?=$_VIEW['view']['client.reservation']?>
        		<!-- account_settings -->
        		<?=$_VIEW['view']['client.account.settings']?>
        		<!-- account -->        			  		      		
        		<?=$_VIEW['view']['client.account.computation']?>      		        		
        			<input type="hidden" name="client_account[int][lot_id]" value="<?=$_VIEW['lot_id']?>" />
        			<input type="hidden" name="client_account[int][user_id]" value="<?=$_VIEW['user_id']?>" />
        			<input type="hidden" name="client_account[str][option_unit_account_type_id]" value="<?=$option_unit_account_type_id?>" />
        			<!--
        			<input type="hidden" name="client_account[int][agent_id]" value="<?=$_VIEW['agent']['agent_id']?>" />
        			<input type="hidden" name="client_account[int][network_id]" value="<?=$_VIEW['network_id']?>" />
        			<input type="hidden" name="client_account[int][network_division_id]" value="<?=$_VIEW['network_division_id']?>" />    
        			-->
        			<input type="hidden" name="client_account_structure[int][user_id]" value="<?=$_VIEW['user_id']?>" />
        			<input type="hidden" name="client_account_structure[int][client_account_structure_active]" value="1" />
        		<?=$_VIEW['view']['client.account.commission']?>   
        					
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
	
	
	
		
	
	GLOBALS.events.add('onload', set_calendar);

</script>


<script type=" text/javascript">

	$('._compute_').keyup(function(){compute(this)});

	
	
	
	function dp_type(pObj)
	{
		var pVal	=	$(pObj).val();
		
		if(pVal == 'partial_dp')
		{			
			$('._dp_partial').removeClass('display_none');				
			compute();
		}
		else if(pVal == 'no_dp')
		{
			// upon setting this, the compute() part will fix the default	
			$('#client_account_dp_percent').val(0);					
			$('#client_account_reservation_paid').val(0);			
			$('#client_account_misc_fee').val(0);						
			$('#option_account_misc_id').val('full');		
			$('#client_account_dp_term').val(0);
			$('._dp_partial').addClass('display_none');			
			compute();
		}
		else 
		{		
			$('#option_account_misc_id').val('full');	// upon setting this, the compute() part will fix the default	
			$('#client_account_dp_term').val(1);		// upon setting this, the compute() part will fix the default	
			$('._dp_partial').addClass('display_none');			
			compute();
		}
	}
		
		
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
		
		/* Earnest
		var Pearnest_total						=		get_earnest();
			$('#earnest_amount').val(Pearnest_total);
			//Reservation
		var Preservation						=		get_reservation();
		 //Earnest Type			
		var Pearnest_type						=		$('#earnest_option').val();
			//Less Reservation
		var Pclient_account_reservation_paid	=		$("#client_account_reservation_paid").val();
		if(Pearnest_type == 'add')
		{
			Pclient_account_reservation_paid	=	Pearnest_total + Preservation;
			Pclient_account_reservation_paid	=	string_amount(Pclient_account_reservation_paid);
			$("#client_account_reservation_paid").val(Pclient_account_reservation_paid);
		}
		else
		{
			Pclient_account_reservation_paid	=	string_amount(Preservation);
			$("#client_account_reservation_paid").val(Pclient_account_reservation_paid);
		}	
		*/
		
		// Reservation
		var Pclient_account_reservation_paid	=	$("#client_account_reservation_paid").val();
			Pclient_account_reservation_paid	=	string_amount(Pclient_account_reservation_paid);
		
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
		
		// Staggard Misc Fee // - Start		
		var Poption_account_misc_id				=		$('#option_account_misc_id').val();	
		var Pclient_account_misc_fee_monthly	=		0.00;
		
		if(Poption_account_misc_id == 'partial')
		{
			 	Pclient_account_misc_fee_monthly	=	Pclient_account_misc_fee / Pclient_account_dp_term;			
				Pclient_account_misc_fee_monthly	=	string_amount(Pclient_account_misc_fee_monthly);			
		}
		else
		{
				Pclient_account_misc_fee_monthly	=	0.00;
		}
			
		var Pclient_account_dp_monthly_total	=	Pclient_account_dp_monthly + Pclient_account_misc_fee_monthly;
			Pclient_account_dp_monthly_total	=	string_amount(Pclient_account_dp_monthly_total, true);
			
			$('#client_account_misc_fee_monthly').val(Pclient_account_misc_fee_monthly);
			$('._client_account_misc_fee_monthly').html(string_amount(Pclient_account_misc_fee_monthly, true));
			$('._client_account_dp_monthly_total').html(Pclient_account_dp_monthly_total);
			
		// Staggard Misc Fee // - End		
		
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
			//Pclient_account_ma_interest			=		(Pclient_account_ma_interest > 0) ? Pclient_account_ma_interest : 1;
		// Rate Value
		var PrateValue							=		Pclient_account_ma_interest / 1200;
			PrateValue							=		string_amount(PrateValue, false, 10);					
		// Rate Terms
		var PrateTerms							=		1 - (Math.pow( (PrateValue + 1), (-1 * Pclient_account_ma_term)));
			PrateTerms							=		string_amount(PrateTerms, false, 10);
		// Fixed Factor
		var PfixedFactor						=		PrateValue / PrateTerms;
			PfixedFactor						=		string_amount(PfixedFactor, false, 8);
			PfixedFactor						=		(Pclient_account_ma_interest >= 1) ? PfixedFactor : string_amount(1/Pclient_account_ma_term, false, 8);
			
			$('._client_account_ma_factor').html(PfixedFactor);
			$('#client_account_ma_factor').val(PfixedFactor);
		// Monthly Payment
		var Pclient_account_ma_monthly			=		PfixedFactor * Pclient_account_ma_amount;
			Pclient_account_ma_monthly			=		Math.ceil(Pclient_account_ma_monthly);
			Pclient_account_ma_monthly			=		string_amount(Pclient_account_ma_monthly);
			$('#client_account_ma_monthly').val(Pclient_account_ma_monthly);
			$('._client_account_ma_monthly').html(string_amount(Pclient_account_ma_monthly, 1));	
		
		// Commmission
		var Pclient_account_agent_commission_percent	=	$('#client_account_agent_commission_percent').val();
			Pclient_account_agent_commission_percent	=	string_amount(Pclient_account_agent_commission_percent);
		
		var Pclient_account_agent_commission_amount		=	Pclient_account_tcp_net * Pclient_account_agent_commission_percent;
			Pclient_account_agent_commission_amount		=	Pclient_account_agent_commission_amount / 100;
			Pclient_account_agent_commission_amount		=	string_amount(Pclient_account_agent_commission_amount);
			$('#client_account_agent_commission_amount').val(Pclient_account_agent_commission_amount);
			$('._client_account_agent_commission_amount').html(string_amount(Pclient_account_agent_commission_amount, 1));
			
	}


</script>

