<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                Block <?=$_VIEW['project_site_block_name']?> Lot <?=$_VIEW['lot_name']?>, <?=$_VIEW['project_name']?> <?=$_VIEW['project_site_name']?> 
            </b>

            <label></label>
        </div> 
    	
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                <table width="100%" cellpadding="3" cellspacing="0" border="0" style="font-weight:normal;">
                    <thead><tr><td colspan="4"><b style="font-size: 12px;">Lot Details</b></td></tr></thead>
                    <tr>
                        <td class="color_gray" width="15%">
                            Project - Phase:
                        </td>
                        <td width="35%">
                            <?=$_VIEW['project_name']?> - <?=$_VIEW['project_site_name']?>
                        </td>
                        <td class="color_gray" width="15%">
                            Block - Lot:
                        </td>
                        <td width="35%">
                            B<?=$_VIEW['project_site_block_name']?> - L<?=$_VIEW['lot_name']?>    
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            House Model:
                        </td>
                        <td>
                            <?=(($_VIEW['house_name']) ? $_VIEW['house_name'] : 'none')?> 
                        </td>
                        <td class="color_gray">
                            House Model Code:
                        </td>
                        <td>
                            <?=(($_VIEW['house_code']) ? $_VIEW['house_code'] : 'none')?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Lot Area:
                        </td>
                        <td><?=$_VIEW['lot_area']?> sqm.</td>
                        
                        <td class="color_gray">
                            Floor Area :
                        </td>
                        <td>
							<?=string_amount($_VIEW['house_area'])?> sqm.
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
                            House Contract Price :
                        </td>
                        <td>
							P <?=string_amount($_VIEW['house_price'])?>
                        </td>
                        
                        <td class="color_gray">
                            Classification:
                        </td>
                        <td>  <?=(($_VIEW['option_house_classification_name']) ? $_VIEW['option_house_classification_name'] : 'none')?></td>
                    </tr>  
                    <tr>
                        <td class="color_gray">
                            Lot Status :
                        </td>
                        <td>
                            <div class="status <?=$_VIEW['option_availability_bullet']?>" style="float:left; margin:5px 10px 0 0;"></div>
                            <span class="float_left <?=$_VIEW['option_availability_class']?>"><?=$_VIEW['option_availability_name']?></span>          <!-- options: available, sold, reserved, on-hold, earnest, packaged -->
                            <label></label>
                        </td>  
                       <td class="color_gray" colspan="1">
                            Type : 
                        </td>
                        <td colspan="3">
                            <?=$_VIEW['option_unit_name']?>
                        </td>                         
                    </tr> 
                    
                    <?php if ($_VIEW['client_id']) { ?>
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Client Personal Details</b></td>
                        </tr>
                    </thead>
                    <tr>
                        <td class="color_gray" width="15%">
                            Full Name:
                        </td>
                        <td width="35%">
                            <?=$_VIEW['client_name']?> <?=$_VIEW['client_middle_name']?> <?=$_VIEW['client_surname']?>
                        </td>
                        <td class="color_gray" width="15%">
                            Marital Status:
                        </td>
                        <td width="35%">
                            <?=$_VIEW['option_civil_status_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Sex:
                        </td>
                        <td>
                            <?=$_VIEW['option_gender_name']?>
                        </td>
                        <td class="color_gray">
                            Home Address :
                        </td>
                        <td>
                            <?=$_VIEW['client_address']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                           Zip Code
                        </td>
                        <td>
                            
                            <?=$_VIEW['client_zip']?>

                        </td>
                        <td class="color_gray">
                            Address in-use :
                        </td>
                        <td>        
                            <?=$_VIEW['option_client_address_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                           Email:
                        </td>
                        <td>
                            
                            <?=$_VIEW['client_email']?>

                        </td>
                        <td class="color_gray">
                            Employment :
                        </td>
                        <td>        
                            <?=$_VIEW['option_employment_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                           Tel. No:
                        </td>
                        <td>                            
                            <?=$_VIEW['client_telephone']?>
                        </td>
                        <td class="color_gray">
                            Mobile Number :
                        </td>
                        <td>        
                            <?=$_VIEW['client_mobile']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                           TIN:
                        </td>
                        <td>
                            
                            <?=$_VIEW['client_tin']?>

                        </td>
                        <td class="color_gray">
                            SSS :
                        </td>
                        <td>        
                            <?=$_VIEW['client_sss']?>
                        </td>
                    </tr>  
                    
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
	                    <?php } ?>                             
                </table>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


