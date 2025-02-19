<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                 Casa Royale 1 - Block 1 Lot 1 
            </b>

            <label></label>
        </div> 
        
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
               <form action="/finance_wes/water_reading/submit_payment/" method="post" name="alsc_form">
              <input type="hidden" name="id" value="<?=$_VIEW['lot_wes_reading_id']?>" />    
              <input type="hidden" name="lot_wes_id" value="<?=$_VIEW['lot_wes_id']?>" />
              <input type="hidden" name="lot_wes_account_receive[str][client_account_id]" value="<?=$_VIEW['invoice']['client_account_id']?>" />    
              <input type="hidden" name="lot_wes_account_receive[str][client_account_invoice_id]" value="<?=$_VIEW['invoice']['client_account_invoice_id']?>" /> 
                <table width="98%" cellpadding="5" cellspacing="0" border="0" style="font-weight:normal;" class="mar_standard">
                    <thead>
                        <tr>
                            <td colspan="8">Electric Cashier</td>
                        </tr>
                    </thead> 
                           
                   <tr>
                        <td class="color_gray">Date of Payment:</td>
                        <td><?php
                                 	echo string_date_time(time());
                                 ?></td>
                        <td colspan="6"></td>
                    </tr>
                    <tr>
                        <td class="color_gray">Bill Date:</td>
                        <td><?=string_date($_VIEW['lot_wes_reading_date'])?></td>
                        <td class="color_gray">Due Date:</td>
                        <td class="color_red"><?=string_date($_VIEW['lot_wes_reading_due_date'])?></td>  <!-- mark red if late -->
                        <td class="color_gray">Period: </td>
                        <td><?=string_date($_VIEW['lot_wes_reading_from_date'])?>  -  <?=string_date($_VIEW['lot_wes_reading_date'])?></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td class="color_gray">Pres. Reading:</td>
                        <td><?=$_VIEW['lot_wes_curr_reading']?></td>
                        <td class="color_gray">Prev. Reading:</td>
                        <td><?=$_VIEW['lot_wes_prev_reading']?></td>
                        <td class="color_gray">Consumption (Kw.h):</td>
                        <td><?=$_VIEW['lot_wes_curr_reading']-$_VIEW['lot_wes_prev_reading']?></td>
                        <td class="color_gray"> Price / Kw.h (Kw.h):</td>
                        <td><?=string_amount($_VIEW['lot_wes_reading_rate'])?></td>
                    </tr>
                </table>
                    
                   <table width="98%" cellpadding="5" cellspacing="0" border="0" style="font-weight:normal;" class="mar_standard"> 
                    <thead><tr><td colspan="6"><h1>Payment Details</h1></td></tr></thead>
        			<tr>        				
        				<td width="25%"><b>Payment Method : </b></td>
        				<td width="25%">
        					<select name="lot_wes_account_receive[str][option_payment_method_id]" >
        						<?=$_VIEW['option_payment_method']?>
        					</select>
        				</td>
        				<td width="25%"></td>
        				<td width="25%"></td>
        			</tr>
        		
        			<tr>        				
        				<td width="25%"><b>Receipt Type : </b></td>
        				<td width="25%">
        					<select name="lot_wes_account_receive[str][option_payment_receipt_id]">
        						<?=$_VIEW['option_payment_receipt']?>
        					</select>  
        				</td>
        				<td width="25%"><b>Payment Status : </b></td>
        				
        				<td width="25%">
        					  <select name="lot_wes_account_receive[str][option_payment_status_id]">
        						<?=$_VIEW['option_payment_status']?>
        					</select>   								
        				</td>
        			</tr>  
        			<tr>
        				<td><b>Payee : </b></td>
        				<td colspan="3">
        					<input type="text" name="lot_wes_account_receive[str][lot_wes_account_receive_payee]" value="<?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?>" />
        				</td>
        			</tr>   
        			<tr>
        				<td><b>Remarks : </b></td>
        				<td colspan="3">
        					<input type="hidden" name="remark[str][remark_key]" value="account_receive" />                                                 
                            <textarea id="remark_area" name="remark[textarea][remark_content]" style="height: 100px; width:100%;" ></textarea>        						
        				</td>
        			</tr> 
                    
                    
                    <tr>
                        <td colspan="8" style="background-color:#ffffff;" align="center">
                             <table width="70%" cellpadding="5" cellspacing="0" border="0" style="font-weight:normal;" class="mar_standard">
                                <thead>
                                    <tr style="background-color:#2D5788;">
                                        <td colspan="8">Payment Breakdown</td>
                                    </tr>
                                </thead>
                              
                                <tr>
                                    <td class="bold">Current Charge :</td>
                                    <td align="right" ><span id="current_charge">P <?=string_amount($_VIEW['lot_wes_reading_current_charge'])?></span></td>
                                    <input type="hidden"  name="lot_wes_account_receive[int][lot_wes_account_receive_current_charge]" value="<?=$_VIEW['lot_wes_reading_current_charge']?>">
                                    <td></td>
                                </tr>
                                
                                
                                 <tr>
                                    <td class="bold">VAT :</td>
                                   <td align="right">
        							 <span id="_vat">P <?=string_amount($_VIEW['lot_wes_reading_vat_total'])?></span>
        							<input type="hidden"  name="lot_wes_account_receive[int][lot_wes_account_receive_vat]" value="<?=$_VIEW['lot_wes_reading_vat_total']?>">
        							</td>
                                    <td></td>
                                </tr>
                            
                                <tr>
                                    <td class="bold">Surcharge :</td>
                                    <td align="right"><span >P <?=string_amount($_VIEW['lot_wes_reading_surcharge'])?></span></td>
                                     <input type="hidden"  name="lot_wes_account_receive[int][lot_wes_account_receive_surcharge]" value="<?=$_VIEW['lot_wes_reading_surcharge']?>">
                                    <td></td>
                                </tr>
                                <tr class="selected">
                                    <td class="bold">TOTAL AMOUNT DUE :</td>
                                    <td align="right" class="font_size_18 color_green" colspan="2">
                                       <div class="details"><input  type="text" id="i_actual" name="lot_wes_account_receive[int][lot_wes_account_receive_total_amount_due_actual]"  value="<?=$_VIEW['total_due']?>" onkeyup="check_cost()"/></div>
                                        <input type="hidden" id="i_real"  name="lot_wes_account_receive[int][lot_wes_account_receive_total_amount_due_real]" value="<?=$_VIEW['total_due']?>">
                                    </td>
                                  
                                </tr>
                                <tr>
                                    <td class="bold">Tendered :</td>
                                    <td align="right" class="font_size_18">
                                        <span id="tendered">P 0.00</span>
                                    </td>
                                    <td align="right"><div class="details"><input id="i_tendered" type="text" name="lot_wes_account_receive[int][lot_wes_account_receive_amount_gross]" onkeyup="comp_change()" /></div></td>
                                </tr>
                                <tr>
                                    <td class="bold">Change :</td>
                                    <td align="right" class="font_size_18 color_red">
                                        <span id="s_change">P 0.00</span>
                                        <input id="f_change" type="hidden" name="lot_wes_account_receive[int][lot_wes_account_receive_amount_change]" >
                                    </td>
                                    <td align="right"></td>
                                </tr>
                                <tr>
                                    <td class="bold">Receipt Number :</td>
                                    <td colspan="2"> <div class="details"><input type="text" name="lot_wes_account_receive[str][lot_wes_account_receive_receipt]" /></div></td>
                                </tr>
                                <tr>
                       
                        <td colspan="5" align="center">                		
                       			<div class="content_block_vpad">                       				
                       				<a class="link_button_inline blue" onclick="submit_form('alsc_form')" >Make Payment</a>
                       			</div>               
	                    </td>
                    </tr> 
                            </table>
                        </td>
                    </tr>
                    
                </table>  
                <label style="margin-top:40px;"></label>   
                
                
            </form>
            <label></label> 
      </div>    
    </div>
    <label></label>
</div>
<script type="text/javascript">
function comp_change()
    {
        total_change		=  string_amount( $('#i_tendered').val()) - string_amount( $('#i_actual').val())  ;
        
        
        if( string_amount( $('#i_tendered').val()) < string_amount( $('#i_actual').val()) || string_amount( $('#i_tendered').val()) < 1)
        {
			//alert('hey');
			$('#s_change').html("P "+string_amount(0,true));
			$('#f_change').val(0);
        }
        else
        {
			$('#s_change').html("P "+string_amount(total_change,true));
			$('#f_change').val(total_change);
        }
        $('#tendered').html("P "+string_amount($('#i_tendered').val(),true));
        
    }
    
    
    var param;	
var user_name = '<?=$_VIEW['user_full_name']?>';	
var r_cost;	
var a_cost;	
var string_date = '<?=string_date_time(time())?>';	
	
	
    function check_cost()
    {
		
		
		r_cost   = $("#i_real").val();
		a_cost   = $("#i_actual").val();
       
       if(a_cost != r_cost)
       {
		    param    = '-------------------Altered Total Cost-------------------\n';
	        param   += 'Computed Real Cost: '+r_cost+'\n';
	        param   += 'Altered Actual Cost: '+a_cost+'\n';
	        param   += 'Altered By: '+user_name+'\n';
	        param   += 'Date Altered: '+string_date+'\n';
	        param  += '---------------------------------------------------------\n\n';
		   $('#remark_area').html(param); 
       }
        else
       {
		   $('#remark_area').html(''); 
       }
        
        
        
        
    }
</script>