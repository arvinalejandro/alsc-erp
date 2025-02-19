

<div id="content_body">    

	<?=$_VIEW['side_nav']?>
   
    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
               <?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?> : <?=$_VIEW['client_account_number']?>
            </b>

            <label></label>
        </div> 
        
        <!---------- CONTENT CONTROLLERS ----------->         
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/edp_client/edp_client_manage/submit_member" method="post" name="alsc_form">
           	<input type="hidden" name="client_id" value="<?=$_GET['id']?>" />
           	<input type="hidden" name="int[user_id]" value="<?=$_VIEW['user_id']?>" />
            <div class="mar_custom" id="client_profile">
                <table class="_form " id="_investment_"  width="90%" align="center" cellpadding="3" cellspacing="0" border="0" style="font-weight:normal;">
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Account Settings</b></td>
                        </tr>
                    </thead>
                    <tr>
                        <td class="color_gray">
                           Transaction Type:
                        </td>
                        <td>
                            <?=$_VIEW['option_transaction_type_name']?>
                        </td>
                        <td class="color_gray">
                            Account Type:
                        </td>
                        <td>        
                            <?=$_VIEW['option_account_type_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                           Account Status:
                        </td>
                        <td>
                            <?=$_VIEW['option_account_status_name']?>
                        </td>
                        <td class="color_gray">
                            Buyer Type:
                        </td>
                        <td>        
                            <?=$_VIEW['option_buyer_type_name']?>
                        </td>
                    </tr>      
                     
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Lot Details</b></td>
                        </tr>
                    </thead>    
                    
                    <tr>                        
                        <td class="color_gray" width="15%">
                            Project Site:
                        </td>
                        <td width="35%">
                            <?=$_VIEW['project_name']?> - <?=$_VIEW['project_site_name']?>
                        </td>
                        <td class="color_gray">
                            Lot Area:
                        </td>
                        <td><?=$_VIEW['lot_area']?> sqm.</td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Block:
                        </td>
                        <td>
                            <?=$_VIEW['project_site_block_name']?>
                        </td>
                        <td class="color_gray">
                            Lot :
                        </td>
                        <td>
                            <?=$_VIEW['lot_name']?>
                        </td>
                    </tr>
                    <tr>
                    	<td class="color_gray">
                            Price per sqm. :
                        </td>
                        <td>
							P <?=string_amount($_VIEW['lot_price'])?> / sqm.
                        </td>
                        <td class="color_gray">
                            Lot Contract Price:
                        </td>
                        <td>P <?=string_amount($_VIEW['lot_price'] * $_VIEW['lot_area'])?></td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Date of Sale:
                        </td>
                        <td><?=string_date($_VIEW['client_account_date_sale'])?></td>
                        <td class="color_gray">Discount(%):</td>
                        <td><?=$_VIEW['client_account_discount']?> %</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="color_gray">Discounted Amount:</td>
                        <td>P <?=string_amount($_VIEW['client_account_discount_amount'])?></td>
                    </tr> 
                    
                    <thead>
                        <tr>
                    	    <td colspan="4"><b style="font-size: 12px;">House Details</b></td>
                        </tr>
                    </thead>    
                    <tr>
                        <td class="color_gray">
                            House Model/Code:
                        </td>
                        <td>
                            <?=(($_VIEW['house_name']) ? $_VIEW['house_name'] . '-' . $_VIEW['house_code']: 'none')?> 
                        </td>
                        <td class="color_gray">
                            Classification:
                        </td>
                        <td><?=(($_VIEW['option_house_classification_name']) ? $_VIEW['option_house_classification_name'] : 'none')?> </td>                    
                    </tr>
                    <tr>
                    	<td class="color_gray">
                            Floor Area :
                        </td>
                        <td>
							P <?=string_amount($_VIEW['house_area'])?> sqm.
                        </td>
                        
                    	<td class="color_gray">
                            House Contract Price :
                        </td>
                        <td>
							P <?=string_amount($_VIEW['client_account_hcp'])?>
                        </td>              
                    </tr>            
                    <tr>
                        <td class="color_gray">
                            House Price / sqm:
                        </td>
                        <td><?=$_VIEW['house_price_sqm']?></td>
                        <td class="color_gray">
                            House Price:
                        </td>  
                        <td>P <?=string_amount($_VIEW['house_price'])?></td>                  
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Soil Poisoning:
                        </td>
                        <td>P <?=string_amount($_VIEW['client_account_soil_poison'])?></td>
                        <td class="color_gray">
                            Additional Cost:
                        </td>
                        <td>P <?=string_amount($_VIEW['client_account_added_cost'])?></td>                 
                    </tr>
                   
                    <thead> 
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Down Payment Details</b></td>
                        </tr>
                    </thead>    
                    <tr>
                        <td class="color_gray">
                            % Down Payment:
                        </td>
                        <td><?=$_VIEW['client_account_dp_percent']?> %</td>
                        <td class="color_gray">
                            Down Payment Amount:
                        </td>
                        <td>P <?=string_amount($_VIEW['client_account_dp_amount'])?></td>                 
                    </tr>
                    <tr>
                    	 <td class="color_gray">
                            Reservation OR Number:
                        </td>
                         <td><?=$_VIEW['client_account_reservation_receipt']?></td>
                        <td class="color_gray">
                            Total Down Payment:
                        </td>
                        <td>P <?=string_amount($_VIEW['client_account_dp_total'])?></td>                 
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Less Reservation:
                        </td>
                        <td>P <?=string_amount($_VIEW['client_account_reservation_paid'])?></td>
                        <td class="color_gray">
                            Reservation Date Paid:
                        </td>
                        <td><?=string_date($_VIEW['client_account_reservation_date'])?></td>                 
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Misc. Fee:
                        </td>
                        <td>P <?=string_amount($_VIEW['client_account_misc_fee'])?></td>
                       
                        <td class="color_gray">
                            Net Down Payment:
                        </td>
                        <td>P <?=string_amount($_VIEW['client_account_dp_net'])?></td>                 
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Down Payment Type:
                        </td>
                        <td><?=$_VIEW['option_account_p1_name']?></td>
                        <td class="color_gray">
                            Due Date:
                        </td>
                        <td><?=string_date($_VIEW['client_account_dp_due_date'])?></td>                 
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Misc. Fee Terms:
                        </td>
                        <td><?=$_VIEW['option_account_misc_name']?></td>
                        <td class="color_gray">
                            Partial Misc Payment:
                        </td>
                        <td>P <?=string_amount($_VIEW['client_account_misc_fee_monthly'])?></td>                 
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Months to Pay:
                        </td>
                        <td><?=$_VIEW['client_account_dp_term']?></td>
                        <td class="color_gray">
                            Partial Down Payment:
                        </td>
                        <td>P <?=string_amount($_VIEW['client_account_dp_monthly'])?></td>                 
                    </tr>
                    <tr>
                        <td class="color_gray">
                           
                        </td>
                        <td></td>
                        <td class="color_gray">
                            Total Partial Down Payment:
                        </td>
                        <td>P <?=string_amount($_VIEW['client_account_dp_monthly'] + $_VIEW['client_account_misc_fee_monthly'])?></td>                 
                    </tr>
        
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Mothly Amortization Details</b></td>
                        </tr>
                    </thead>    
                    <tr>
                        <td class="color_gray">
                            Net TCP:
                        </td>
                        <td>P <?=string_amount($_VIEW['client_account_tcp_net'])?></td>
                        
                        <td class="color_gray" colspan="1">
                            Net Down Payment: 
                        </td>
                        <td>P <?=string_amount($_VIEW['client_account_dp_net'])?></td>                      
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Amount to be Financed:
                        </td>
                        <td>P <?=string_amount($_VIEW['client_account_ma_amount'])?></td>
                        
                        <td class="color_gray" colspan="1">
                            Payment Type: 
                        </td>
                        <td><?=$_VIEW['option_account_p2_name']?></td>                      
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Terms:
                        </td>
                        <td><?=$_VIEW['client_account_ma_term']?></td>
                        
                        <td class="color_gray" colspan="1">
                            Commence Date: 
                        </td>
                        <td><?=string_date($_VIEW['client_account_ma_due_date'])?></td>                      
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Interest Rate (%):
                        </td>
                        <td><?=$_VIEW['client_account_ma_interest']?></td>
                        
                        <td class="color_gray" colspan="1">
                            Fixed Factor: 
                        </td>
                        <td><?=$_VIEW['client_account_ma_factor']?></td>                      
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Rebate (%):
                        </td>
                        <td><?=$_VIEW['client_account_ma_rebate']?></td>
                        
                        <td class="color_gray" colspan="1">
                            Monthly Payment: 
                        </td>
                        <td>P <?=string_amount($_VIEW['client_account_ma_monthly'])?></td>                      
                    </tr>
                    
                    <thead>
                        <tr>
                    	    <td colspan="4"><b style="font-size: 12px;">Contract Details</b></td>
                        </tr>
                    </thead>    
                    <tr>
                    	<td class="color_gray" colspan="1">
                            Subject To Tax :
                        </td>
                        <td colspan="4">
                           <?=$_VIEW['client_account_vatable']?> 
                        </td>                   	
                    </tr> 
                    <tr>
                    	<td class="color_gray">
                            LCP :
                        </td>
                        <td>P <?=string_amount($_VIEW['lot_price'] * $_VIEW['lot_area'])?></td> 
                        
                       	<td class="color_gray" colspan="1">
                            Discount (%) : 
                        </td>
                        <td colspan="3">
                           <?=$_VIEW['client_account_discount']?> %
                        </td>                   	
                    </tr> 
                    <tr>
                    	<td class="color_gray">
                            Discount Amount :
                        </td>
                        <td>                            
                           P <?=string_amount($_VIEW['client_account_discount_amount'])?>                            
                        </td>  
                       <td class="color_gray" colspan="1">
                            Net DP : 
                        </td>
                        <td colspan="3">
                           P <?=string_amount($_VIEW['client_account_dp_net'])?>
                        </td>                   	
                    </tr>                                     
                    
                    <tr class="selected">                    	
                        <td class="color_gray">
                            Net TCP :
                        </td>
                        <td>                            
                          P <?=string_amount($_VIEW['client_account_tcp_net'])?>                            
                        </td>  
                        <td class="color_gray">
                            Amount to be financed :
                        </td>
                        <td>                            
                          P <?=string_amount($_VIEW['client_account_ma_amount'])?>                            
                        </td>                                        
                    </tr>    
                                          
                </table>
                </form>
            </div>           
    	</div>
    	<label></label>
</div>
<script type="text/javascript">

	var add_toggle = false;
	
	function toggle()
	{
		if(add_toggle)
		{			
			$('._add').addClass('display_none');
			add_toggle = false;
		}
		else
		{			
			$('._add').removeClass('display_none');
			add_toggle = true;
		}
	}
	
	
</script>

