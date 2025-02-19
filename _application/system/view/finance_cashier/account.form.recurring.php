<?php
	
	# VAT
	if($_VIEW['client_account_is_vat'] > 0)
	{
		$vat_class		=	'';
		$vat_rate		=	$_VIEW['sysglobal']['vat_rate'];
		$vat_base		=	($vat_rate / 100) / (($vat_rate/100) + 1);
		$vat_base		=	round($vat_base, 5);
		
			
	}
	else
	{
		$vat_rate		=	'0';
		$vat_base		=	'0';
		$vat_class		=	'display_none';
	}
	
	
?>

<div id="content_body">    
       
   <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">     
        
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                <?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?> : <?=$_VIEW['client_account_number']?>
            </b>
            <span class="font_size_18 mar_h">
                - <?=$_VIEW['project_name']?> <?=$_VIEW['project_site_name']?> - Block <?=$_VIEW['project_site_block_name']?> Lot <?=$_VIEW['lot_name']?>
            </span>
            <label></label>
        </div>
           
        <div style="overflow: auto;" id="_right_content_">  <!--set max-height by making it dynamic -->       	
        	
        		<br/>
        		<table class="mar_custom display_none" width="90%" cellpadding="5" cellspacing="0" border="0">                   
                    <thead class="">
                        <tr>
                        	<td colspan="8">Overdue Summary </td>                                                
                        </tr>
                    </thead>
                    <!--<tbody>
	                    <tr>
                    		<td><b>Total Surcharge:</b></td> 
	                        <td><div class="details">P <?=string_amount($_VIEW['summary']['surcharge'])?></div></td> 
	                        <td><b>Total Interest</b></td> 
	                        <td><div class="details">P <?=string_amount($_VIEW['summary']['interest'])?></div></td> 
	                        <td><b>Total Principal</b></td> 
	                        <td><div class="details">P <?=string_amount($_VIEW['summary']['principal'])?></div></td> 
	                    </tr> 
	                    <tr>                        
	                        <td><b>Number of overdues: </b></td> 
	                        <td><div class="details"><?=$_VIEW['summary']['count']?></div></td> 
	                        <td><b>Total Amount Due: </b></td> 
	                        <td colspan="3"><div class="details">P <?=string_amount($_VIEW['summary']['amount'])?></div></td>                                               
	                    </tr>     
                    </tbody>-->
                    <tbody class="">
                        <tr>
                            <td><b>Overdue Amount:</b></td> 
                            <td><div class="details">P <?=$_VIEW['client_account_invoice_amount']?></div></td>
                            <td></td> 
                            <td><b>Basic Amount:</b></td>
                            <td><div class="details">P c/o Arnie</div></td>
                            <td></td>  
                            <td><b>Surcharges:</b></td> 
                            <td><div class="details">P c/o Arnie</div></td> 
                        </tr> 
                        <tr>                        
                            <td><b>Basic Interest:</b></td> 
                            <td><div class="details">P c/o Arnie</div></td>
                            <td></td> 
                            <td><b>Basic Principal:</b></td> 
                            <td><div class="details">P c/o Arnie</div></td> 
                            <td></td> 
                            <td><b>Outstanding Balance:</b></td> 
                            <td><div class="details">P c/o Arnie</div></td>                                              
                        </tr>     
                    </tbody>                          
                </table>  	
        	       		        	
        		<table class="mar_custom" width="90%" cellpadding="5" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <td width="10px"></td>  
                            <td>Due Date</td> 
                            <td>Period</td>            	
                            <td>Monthly Due</td> 
                            <!--<td>Rebate</td>-->
                            <td>Surcharge</td>
                            <td>Interest</td>                                              
                            <td>Principal Amount</td>
                            <td>Outstanding Balance</td>                                                           
                        </tr>
                    </thead>
                    <tbody>
                    	<tr>
                    		<td colspan="9">% Paid : <?=$_VIEW['progress']?> %</td>
                    	</tr>
                        <?=$_VIEW['row.account.invoice']?>
						<!--
						<tr><td colspan="5" align="center"><a class="link_button_inline gray" href="#">Load More</a></td></tr>          
                    	-->
                    </tbody>  
                </table>	
                
                <br/>
        		
        		<form action="/finance_cashier/account/submit_payment" name="alsc_form" method="post">
        		<input type="hidden" name="client_account_id" value="<?=$_GET['id']?>" />
        		<input type="hidden" name="client_account_invoice_id" id="client_account_invoice_id" value="" />
        		<input type="hidden" name="account_receive[int][lot_id]"  value="<?=$_VIEW['lot_id']?>" />
        		<input type="hidden" name="account_receive[int][project_site_id]"  value="<?=$_VIEW['project_site_id']?>" />
        		<input type="hidden" name="account_receive[str][option_income_type_id]"  value="sale_of_lot" />
        		 
        		<table class="mar_custom" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">      			
        			<thead><tr><td colspan="4"><h1>Payment Details <?=$vat_base?></h1></td></tr></thead>
        			<tr>        				
        				<td width="25%"><b>Payment Method : </b></td>
        				<td width="25%">
        					<select name="account_receive[str][option_payment_method_id]" onchange="payment_method(this)">
        						<?=$_VIEW['option_payment_method']?>
        					</select>
        				</td>
        				<td width="25%"></td>
        				<td width="25%"></td>
        			</tr>
        			<tr class="display_none _payment">
        				<td width="25%"><b>Clearance Date : </b></td>
        				<td width="25%">
        					<input type="text" name="" />
        				</td>
        				<td width="25%"><b>Check #: </b></td>
        				<td width="25%"><input type="text" name="account_receive[str][account_receive_name]" /></td>
        			</tr>
        			<tr>        				
        				<td width="25%"><b>Receipt Type : </b></td>
        				<td width="25%">
        					<select name="account_receive[str][option_payment_receipt_id]">
        						<?=$_VIEW['option_payment_receipt']?>
        					</select>  
        				</td>
        				<td width="25%"><b>Excess Amount: </b></td>
        				<td width="25%">
        					<select name="account_receive[str][option_payment_excess_id]" onchange="select_invoice()" id="option_payment_excess_id">
        						<?=$_VIEW['option_payment_excess']?>
        					</select>        								
        				</td>
        			</tr>  
        			<tr>
        				<td><b>Payee : </b></td>
        				<td colspan="3">
        					<input type="text" name="account_receive[str][account_receive_payee]" value="<?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?>" />
        				</td>
        			</tr>   
        			<tr>
        				<td><b>Remarks : </b></td>
        				<td colspan="3">
        					<input type="hidden" name="remark[str][remark_key]" value="account_receive" />                                                 
                            <input type="hidden" name="remark[int][user_id]" value="<?=$_VIEW['_user_']['user_id']?>" />                      
                            <textarea name="remark[textarea][remark_content]" style="height: 100px; width:100%;" ></textarea>        						
        				</td>
        			</tr>     			
        			<thead><tr><td colspan="4"><h1>Payment Breakdown</h1></td></tr></thead>
        			<tr>        			
        				<td></td>        				
        				<td><b>Principal : </b></td>
        				<td>
        					<span>P</span> <span id="_principal">0.00</span>
        				</td>
        				<td></td>
        			</tr>
        			<tr>      
        				<td></td>  			
        				<td><b>Surcharge : </b></td>
        				<td>
        					<span>P</span> <span id="_surcharge">0.00</span>
        				</td>        				
        				<td></td>
        			</tr>    
        			<tr>      
        				<td></td>       				
        				<td><b>Interest : </b></td>
        				<td>
        					<span>P</span> <span id="_interest">0.00</span>
        				</td>
        				<td></td>
        			</tr> 
        			
        			<tr class="display_none">      
        				<td></td>       				
        				<td><b>Rebate : </b></td>
        				<td>
        					P <span id="_rebate">0.00</span>
        				</td>
        				<td></td>
        			</tr>  
        			
        			<tr class="selected">        			
        				<td></td>        				
        				<td><b>Amount: </b></td>
        				<td style="font-size: 18px;">        					
        					<span class="color_green bold">P</span> <span class="color_green bold" id="_total_balance">0.00</span>         		
        					<input type="hidden" value="0.00" id="_total_balance_">							     				
        				</td>
        				<td></td>
        			</tr>
        			
        			<tr>      
        				<td></td>       				
        				<td><b>Net Amount : </b></td>
        				<td>
        					P <span id="_net">0.00</span>
        					<input type="hidden" name="account_receive[int][account_receive_amount_net]" id="_net_">
        				</td>
        				<td></td>
        			</tr>  
        			
        			<tr>      
        				<td></td>       				
        				<td><b>12% VAT : </b></td>
        				<td>
        					P <span id="_vat">0.00</span>
        					<input type="hidden" value="0.00" name="account_receive[int][account_receive_amount_vat]" id="_vat_">
        				</td>
        				<td></td>
        			</tr> 
        			
        			
        			
        			<tr class="selected">       				
        				<td></td>
        				<td><b>Amount Paid (P): </b></td>
        				<td style="font-size: 18px;">P <span id="_paid">0.00</span></td>
        				<td>        					
        					<input type="text"  onkeyup="select_invoice()" class="_paid_" id="_paid_" />    
        					<input type="hidden" name="account_receive[int][account_receive_amount_gross]" value="0.00" id="_gross_received_">				    	
        								
        				</td>
        			</tr> 
        			
        			<tr class="">        				
        				<td></td>
        				<td><b>Change (P): </b></td>
        				<td style="font-size: 18px;" class="color_red">
        					<span>P</span> <span  id="_change">0.00</span>
        					<input type="hidden" id="_change_" name="excess" value="0" />
        				</td>
        				<td></td>
        			</tr>        			
        			
        			<tr class="">        			
        				<td></td>
        				<td></td>
        				<td><b>Receipt Number: </b></td>
        				<td><input type="text" name="account_receive[str][account_receive_receipt]" /></td>
        			</tr> 
        			        
        			<tr class="">        				
        				<td></td>
        				<td><b>Date of Payment: </b></td>
        				<td><span><?=string_date_time(time())?></span></td>
        				<td></td>
        			</tr> 
        			 			     			
        			<tr>
        				<td colspan="4">
        					<input type="hidden" name="account_receive[int][user_id]" value="<?=$_VIEW['_user_']['user_id']?>" />
        					<input type="hidden" name="account_receive[int][client_account_id]" value="<?=$_VIEW['client_account_id']?>" />        					
        					
        					<div class="align_right" style="margin-top:10px;">                
				            	<a class="link_button_inline gray" href="/finance_cashier/account/profile/&id=<?=$_GET['id']?>">Cancel</a>
				                <a class="link_button_inline blue" onclick="submit_form('alsc_form')">Make Payment</a>
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


<!--

	client_account_id
	item_type_id
	user_id
	option_payment_method_id
	account_receive_name
	account_receive_receipt
	account_receive_amount
	account_receive_amount_paid
	account_receive_amount_surcharge
	account_receive_amount_interest
	account_receive_amount_principal
	account_receive_amount_rebate
	account_receive_amount_vat
	account_receive_amount_waive_surcharge
	account_receive_remark
	
-->

<script type="text/javascript">

	var total_balance		=	0;
	var invoice_id			=	[];
	var total_principal		=	0;
	var total_interest		=	0;
	var total_surcharge		=	0;
	var total_rebate		=	0;
	var total_net			=	0;
	var invoice_rows		=	{};
	var vat_base			=	string_amount('<?=$vat_base?>', false, 5);
	var total_vat			=	0;
	var total_change		=	0;
	var total_paid			=	0;
	var total_gross			=	0
	
	//alert(vat_base);
	
	function payment_method(pObj)
	{
		var varPayment	=	$(pObj).val();
		if(varPayment == '0')
		{
			$('._payment').removeClass('display_none');
		}
		else
		{
			$('._payment').addClass('display_none');
		}
	}
	
	function select_invoice()
	{		
		clear_amount();		
		change_option		=	$('#option_payment_excess_id').val();		
		
		$('input._invoice_:checked ').each(function()
		{		
			// Principal
			p_principal			=	$(this).parent().parent().find('.client_account_invoice_principal_amount').val();
			total_principal		=	total_principal + string_amount(p_principal);	
			// Interest
			p_interest			=	$(this).parent().parent().find('.client_account_invoice_interest_amount').val();
			total_interest		=	total_interest + string_amount(p_interest);	
			// Surcharge
			p_surcharge			=	$(this).parent().parent().find('.client_account_invoice_surcharge_amount').val();	
			total_surcharge		=	total_surcharge + string_amount(p_surcharge);
			// Rebate
			p_rebate			=	$(this).parent().parent().find('.client_account_invoice_rebate_amount').val();	
			total_rebate		=	total_rebate + string_amount(p_rebate);				
			// Total
			total_balance		=	total_principal + total_interest + total_surcharge;			
			total_balance		=	string_amount(total_balance);					
			var	i_id			=	$(this).parent().parent().find('.client_account_invoice_id').val();							
			invoice_id.push(i_id);			
		});	
		invoice_id				=	invoice_id.join(',');						
				 
		// Change 		
		var var_paid		=	$('#_paid_').val();
			var_paid		=	string_amount(var_paid);	
								$('#_paid').html(string_amount(var_paid, 1));
		
		if(total_balance <= var_paid)
		{
			total_change				=	var_paid - total_balance;			
			total_change				=	string_amount(total_change);			
			
			if(change_option == 'return_change')
			{			
				total_gross		=	total_balance;
			}
			else
			{			
				total_balance	=	total_balance + total_change;
				total_gross		=	total_balance;
				total_change	=	0;				
			}			
		}	
		
		else
		{
			total_gross		=	var_paid;
			total_change	=	0;	
		}
		
		
		
			
		// Vat		
		total_vat				=	total_gross * vat_base;			
		total_vat				=	string_amount(total_vat);
		// Net
		total_net				=	total_gross - total_vat;			
		total_net				=	string_amount(total_net);	
		update_breakdown();								
	}	
	
	function update_breakdown()
	{		
		$('#_surcharge').html(string_amount(total_surcharge, 1));
		$('#_interest').html(string_amount(total_interest, 1));
		$('#_principal').html(string_amount(total_principal, 1));
		$('#_rebate').html(string_amount(total_rebate, 1));		
		$('#_vat').html(string_amount(total_vat,1));		
		$('#_net').html(string_amount(total_net,1));		
		$('#_total_balance').html(string_amount(total_balance,1));			
		$('#_change').html(string_amount(total_change, true));	
		
		$('#_change_').val(total_change);		
		$('#_vat_').val(total_vat);
		$('#_net_').val(total_net);
		$('#_gross_received_').val(total_gross);
		
				
		$('#client_account_invoice_id').val(invoice_id);		
	}
	

	function clear_amount()
	{
		total_principal		=	0;
		total_interest		=	0;
		total_surcharge		=	0;
		total_rebate		=	0;
		total_balance		=	0;
		total_vat			=	0;	
		total_change		=	0;	
		total_gross			=	0;
		invoice_id			=	[];
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
	
	
	
	//GLOBALS.events.add('onload', run_ready);

</script>