<?php
	
	$hide_house		=	($_VIEW['option_unit_id'] == 1) ? '' : 'display_none';
	
?> 
<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" >
        
        <!---------- CONTENT CONTROLLERS ----------->
         
        <div class="border_bottom_gray" id="controls">
		    <div class="content_block_vpad">            	
			        
			        
			        
			        <a class="link_button_inline float_left _control blue" id="_investment" style="margin-left:5px;">
				        Investment Details >
				    </a>
				    
				    <a class="link_button_inline float_left _control gray" id="_client" style="margin-left:5px;">
				        Client Profile >
				    </a>	    
				    
				    <a class="link_button_inline float_left _control gray" id="_account" style="margin-left:5px;">
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
        	<form action="/edp_client/edp_client_manage/account_submit/&id=<?=$_GET['id']?>" name="alsc_form" method="post">
        		<input type="hidden" name="client[int][user_id]" value="<?=$_VIEW['user_id']?>" />
        		<input type="hidden" name="lot[int][option_availability_id]" value="2" />
        		<input type="hidden" name="client_account[int][user_id]" value="<?=$_VIEW['user_id']?>" />
        		<input type="hidden" name="client_account_structure[int][user_id]" value="<?=$_VIEW['user_id']?>" />
        		<input type="hidden" name="client_account[str][client_account_type]" value="<?=$_VIEW['option_unit_name']?>" />
        		<input type="hidden" name="client_account[int][agent_id]" value="<?=$_VIEW['agent']['agent_id']?>" />
        		<input type="hidden" name="client_account[int][network_id]" value="<?=$_VIEW['network_id']?>" />
        		<input type="hidden" name="client_account[int][network_division_id]" value="<?=$_VIEW['network_division_id']?>" />
        		
        		<!--Investment-->
        		<table class="_form " id="_investment_"  width="90%" align="center" cellpadding="3" cellspacing="0" border="0" style="font-weight:normal;">
                    <thead><tr><td colspan="4"><b style="font-size: 12px;">Lot Details</b></td></tr></thead>
                    
                    <tr>                        
                        <td class="color_gray" width="15%">
                            Phase:
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
                            Lot:
                        </td>
                        <td>
                            <?=$_VIEW['lot_name']?>
                        </td>
                    </tr>
                    <tr>
                    	<td class="color_gray">
                            Price per sqm.:
                        </td>
                        <td>
							P <?=string_amount($_VIEW['lot_price'])?> / sqm.
                        </td>
                        <td class="color_gray">
                            Lot Contract Price:
                        </td>
                        <td>P <?=string_amount($_VIEW['lot_price'] * $_VIEW['lot_area'])?></td>
                    </tr>     
                   
                    <thead><tr><td colspan="4"><b style="font-size: 12px;">House Details</b></td></tr></thead>
                    <tr>
                        <td class="color_gray">
                            House Model:
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
                            Floor Area:
                        </td>
                        <td>
							<?=string_amount($_VIEW['house_area'])?> sqm.
                        </td>
                        
                    	<td class="color_gray">
                            House Contract Price:
                        </td>
                        <td>
							P <?=string_amount($_VIEW['house_price'])?>
                        </td>              
                    </tr>            
                    
                    <thead><tr><td colspan="4"><b style="font-size: 12px;">Contract Details</b></td></tr></thead>
                    
                    <tr>
                    	
                    	<td class="color_gray">
                            Availability:
                        </td>
                        <td>                            
                           <?=$_VIEW['option_availability_name']?>                            
                        </td>  
                       <td class="color_gray" colspan="1">
                            Type: 
                        </td>
                        <td colspan="3">
                            <?=$_VIEW['option_unit_name']?>
                        </td>                   	
                    </tr> 
                    <tr>
                    	<td class="color_gray">
                            House/Unit Status:
                        </td>
                        <td>                            
                           <?=$_VIEW['option_unit_status_name']?>                            
                        </td> 
                        <td class="color_gray">
                            Contractor Type:
                        </td>
                        <td>                            
                           <?=$_VIEW['option_construction_name']?>                            
                        </td>                                           
                    </tr> 
                    <tr class="selected">                    	
                        <td class="color_gray">
                            TCP:
                        </td>
                        <td>                            
                          P <?=string_amount(($_VIEW['lot_price'] * $_VIEW['lot_area']) + $_VIEW['house_price'])?>                            
                        </td>                                          
                    </tr> 
                    
                    <thead><tr><td colspan="4"><b style="font-size: 12px;">Earnest Details</b></td></tr></thead> 
                    <tr>
                        <td class="color_gray">
                            Network:
                        </td>
                        <td><?=(($_VIEW['network_name']) ? $_VIEW['network_name'] : 'none')?></td>
                        
                        <td class="color_gray">
                            Division:
                        </td>
                        <td>
							<?=(($_VIEW['network_division_name']) ? $_VIEW['network_division_name'] : 'none')?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Agent:
                        </td>
                        <td><?=(($_VIEW['agent']['agent_name']) ? $_VIEW['agent']['agent_name'] : 'none')?></td>                        
                        
                    </tr>
                    <tr>
        				<td colspan="4">
        					<div class="align_center" style="margin-top:10px;">
				                 <a class="link_button_inline gray" href="/edp_client">Cancel</a>				               
				                <a class="link_button_inline blue" onclick="next_form('client')">Next</a>
				            </div> 
				            <br/> 
        				</td>
        			</tr>               
                </table>
        		
        		
        		
        		<!--Client Profile-->
        		<table class="_form mar_custom _form display_none" id="_client_" style="font-weight:normal;" width="90%" cellpadding="8" cellspacing="0" border="0">     
               		<thead><tr><td colspan="3"><h1>Personal Details</h1></td></tr></thead>
	                <tr>                    
	                    <td>
	                        <span class="font_size_10">Last Name</span>
	                        <input type="text" name="client[str][client_surname]" value="<?=$_VIEW['client_surname']?>" />
	                    </td>
	                    <td>
	                        <span class="font_size_10">First Name</span>
	                        <input type="text" name="client[str][client_name]" value="<?=$_VIEW['client_name']?>" />
	                    </td>
	                    <td>
	                        <span class="font_size_10">Middle Name</span>
	                        <input type="text" name="client[str][client_middle_name]" value="<?=$_VIEW['client_middle_name']?>" />
	                    </td>
	                    
	                </tr>
	                
	                <tr>                    
	                    <td>
                    		<span class="font_size_10">Gender</span>
	                        <select name="client[int][option_gender_id]">
                        		<option value="0"></option>
	                            <?=$_VIEW['option_gender']?>
	                        </select>
	                    </td>
	                    <td>
	                        <span class="font_size_10">Civil Status</span>
	                        <select  name="client[int][option_civil_status_id]">
                        		<option value="0"></option>
	                            <?=$_VIEW['option_civil_status']?>
	                        </select>
	                    </td>
	                    <td>
	                        <span class="font_size_10">Employment</span>
	                        <select class="float_left" name="client[int][option_employment_id]">
                        		<option value="0"></option>
	                            <?=$_VIEW['option_employment']?>
	                        </select>
	                    </td>                    
	                </tr>
	                
	                <tr>                    
	                    <td>
	                        <span class="font_size_10">Birthday</span>
	                        <input type="text" name="client[str][client_birthday]" value="<?=$_VIEW['client_birthday']?>" class="_date_" />
	                    </td>
	                    <td>
	                        <span class="font_size_10">Birth Place</span>
	                        <input type="text" name="client[str][client_birth_place]" value="<?=$_VIEW['client_birth_place']?>" />
	                    </td>
	                    <td>
	                       
	                    </td>                    
	                </tr>
	                
	                <tr>                    
	                    <td>
	                        <span class="font_size_10">TIN</span>
	                        <input type="text" name="client[str][client_tin]" value="<?=$_VIEW['client_tin']?>" />
	                    </td>
	                    <td>
	                        <span class="font_size_10">SSS</span>
	                        <input type="text" name="client[str][client_sss]" value="<?=$_VIEW['client_sss']?>" />
	                    </td>
	                    <td>
	                        
	                    </td>                    
	                </tr>               
	                
	                <thead><tr><td colspan="3"><h1>Contact Details</h1></td></tr></thead>
	                
	                <tr>   
                		<td>
	                        <span class="font_size_10">Landline Number</span>
	                         <input type="text" name="client[str][client_telephone]" value="<?=$_VIEW['client_telephone']?>" />
	                    </td>                  
	                    <td>
	                        <span class="font_size_10">Mobile Number</span>
	                        <input type="text" name="client[str][client_mobile]" value="<?=$_VIEW['client_mobile']?>" />
	                    </td>                    
	                    <td>
	                        <span class="font_size_10">Email</span>
	                         <input type="text" name="client[str][client_email]" value="<?=$_VIEW['client_email']?>" />
	                    </td>                    
	                </tr>
	                
	                <tr>                    
	                    <td colspan="3">
	                        <span class="font_size_10">Local Address</span>
	                        <input type="text" name="client[str][client_address]" value="<?=$_VIEW['client_tin']?>" />
	                    </td>                    
	                                       
	                </tr>
	                
	                <tr>   
                		<td>
	                        <span class="font_size_10">City/Province</span>
	                         <input type="text" name="client[str][client_city]" value="<?=$_VIEW['client_city']?>" />
	                    </td>                  
	                    <td>
	                        <span class="font_size_10">Zip Code</span>
	                        <input type="text" name="client[str][client_zip]" value="<?=$_VIEW['client_zip']?>" />
	                    </td>                    
	                    <td>
	                        <span class="font_size_10">Use Address</span>
	                        <select name="client[int][option_client_address_id]">                        	
	                            <?=$_VIEW['option_client_address']?>
	                        </select>
	                    </td>                    
	                </tr>
	                
	                <tr>                    
	                    <td colspan="3">
	                        <span class="font_size_10">International Address</span>
	                        <input type="text" name="client[str][client_address_abroad]" value="<?=$_VIEW['client_address_abroad']?>" />
	                    </td>                    
	                                      
	                </tr>
                    
                    <tr class="_clone_0">
               			<td colspan="2"><h1>Additional Buyer Name</h1></td>
               			<td align="right"><a class="link_button_inline green" onclick="add_member(this)">+</a></td>
               		</tr>
               		
	                <tr>
        				<td colspan="3">
        					<div class="align_center" style="margin-top:10px;">
        						<a class="link_button_inline blue" onclick="next_form('investment')">Back</a>
				                 <a class="link_button_inline gray" href="/edp_client">Cancel</a>		                
				                <a class="link_button_inline blue" onclick="next_form('account')">Next</a>
				            </div>  
				            <br/> 
        				</td>
        			</tr>
	            </table>
        		
        		<!--Account Profile-->
        		<table class="mar_custom _form display_none" id="_account_" style="font-weight:normal;" width="70%" cellpadding="8" cellspacing="0" border="0">
        			<thead><tr><td colspan="4"><h1>Account Settings</h1></td></tr></thead>
        			<tr>        			
        				<td><b>Transaction Type: </b></td>
        				<td><select name="client_account[int][option_transaction_type_id]"><?=$_VIEW['option_transaction_type']?></select></td>
        				<td><b>Account Type: </td>        			
        				<td><select name="client_account[int][option_account_type_id]"><?=$_VIEW['option_account_type']?></select></td>	
        			</tr>
        			<tr>        			
        				<td><b>Account Status: </b></td>
        				<td><select name="client_account[int][option_account_status_id]"><?=$_VIEW['option_account_status']?></select></td>
        				<td><b>Buyer Type: </td>        			
        				<td><select name="client_account[int][option_buyer_type_id]"><?=$_VIEW['option_buyer_type']?> </select></td>	
        			</tr>
        			<thead><tr><td colspan="4"><h1>Account Overview</h1></td></tr></thead>
        			<tr>        			
        				<td><b>Account Number: </b></td>
        				      			
        				<td colspan="3"><span class="color_green"><?=$_VIEW['project_site_code'].'-'.str_pad($_VIEW['project_site_block_name'], 3, '0', STR_PAD_LEFT).'-'.str_pad($_VIEW['lot_name'], 3, '0', STR_PAD_LEFT).'-'.$_VIEW['option_unit_code']?></span><input type="hidden" name="client_account[str][client_account_number]" value="<?=$_VIEW['project_site_code'].'-'.str_pad($_VIEW['project_site_block_name'], 3, '0', STR_PAD_LEFT).'-'.str_pad($_VIEW['lot_name'], 3, '0', STR_PAD_LEFT).'-'.$_VIEW['option_unit_code']?>"   /></td>    			
        			</tr>
        			<tr>        			
        				<td><b>Project: </b></td>
        				<td><span><?=$_VIEW['project_name']?></span></td>
        				<td><b>Phase: </td>        			
        				<td><span><?=$_VIEW['project_site_name']?></span></td>        			
        			</tr>
        			<tr>        			
        				<td><b>Block: </b></td>
        				<td><span><?=$_VIEW['project_site_block_name']?></span></td>
        				<td><b>Lot : </td>        			
        				<td><span><?=$_VIEW['lot_name']?></span> <input type="hidden" name="client_account[int][lot_id]" value="<?=$_GET['id']?>"  /></td>        			
        			</tr>
        			<tr>        			
        				<td><b>Type: </b></td>
        				<td><span><?=$_VIEW['option_unit_name']?></span></td>
        				<td><b>Date of Sale: </td>        			
        				<td><input type="text" name="client_account[str][client_account_date_sale]" class="_date_" /></td>    			
        			</tr>
        			
        			<thead><tr><td colspan="4"><h1>Investment Value - Lot</h1></td></tr></thead>        		
        			<tr>        			
        				<td width="15%"><b>Lot Area: </b></td>
        				<td width="20%"><span><?=$_VIEW['lot_area']?></span> sqm.</td>
        				<td width="15%"></td>
        				<td width="20%"></td>
        			</tr>
        			<tr>        			
        				<td><b>Price/sqm. : </b> </td>
        				<td>P <span><?=string_amount($_VIEW['lot_price'])?></span> / sqm.</td>
        				<td></td>
        				<td></td>
        			</tr> 
        			<tr>        			
        				<td><b>LCP: </b> </td>
        				<td>P <span><?=string_amount($lcp)?></span> <input type="hidden" name="client_account[int][client_account_lcp]" value="<?=$lcp?>"  id="client_account_lcp"  /></td>
        				<td></td>        			
        				<td></td>        			
        			</tr> 
        			<tr>        			
        				<td>
        					<b>% Discount: </b>        				
        				</td>
        				<td><input type="text" name="client_account[int][client_account_discount]" value="0.00" id="client_account_discount" class="_compute_" /></td>
        				<td><b>Discounted Amount</b> :</td>
        				<td>P <span class="_client_account_discount_amount">0.00</span> <input type="hidden" name="client_account[int][client_account_discount_amount]" value="0.00" id="client_account_discount_amount" /></td>
        			</tr>          		
        			<tr>
        				<td></td>
        				<td></td>
        				<td><b>Net LCP: </b> </td>
        				<td>P <span class="_client_account_lcp_net"><?=string_amount($lcp)?></span> <input type="hidden" name="client_account[int][client_account_lcp_net]" value="<?=$lcp?>" id="client_account_lcp_net" /></td>
        			</tr>       		
        			<tr class="<?=$hide_house?>" ><td colspan="4"><h1>Investment Value - HOuse</h1></td></tr>         		
        			<tr class="<?=$hide_house?>">        			
        				<td><b>House Model : </b></td>
        				<td><span><?=$_VIEW['house_name']?></span></td>
        				<td></td>
        				<td></td>
        			</tr>
        			<tr class="<?=$hide_house?>">        			
        				<td><b>Classification : </b> </td>
        				<td><span><?=$_VIEW['option_house_classification_name']?></span></td>
        				<td></td>
        				<td></td>
        			</tr> 
        			<tr class="<?=$hide_house?>">        			
        				<td><b>Unit Status : </b> </td>
        				<td><span><?=$_VIEW['option_availability_name']?></span></td>
        				<td></td>        			
        				<td></td>        			
        			</tr> 
        			<tr class="<?=$hide_house?>">        			
        				<td><b>Floor Area : </b> </td>
        				<td><span><?=$_VIEW['house_area']?></span></td>
        				<td></td>        			
        				<td></td>        			
        			</tr> 
        			<tr class="<?=$hide_house?>">        			
        				<td><b>House Price : </b></td>
        				<td><input type="text" value="<?=string_amount($_VIEW['house_price'])?>" name="client_account[int][client_account_hcp]" id="client_account_hcp" class="_compute_" /></td>
        				<td><b>Soil Poisoning : </b></td>
        				<td><input type="text" name="client_account[int][client_account_soil_poison]" value="0.00" id="client_account_soil_poison" class="_compute_" /></td>
        			</tr> 
        			<tr class="<?=$hide_house?>">        			
        				<td><b>Additional Cost : </b></td>
        				<td><input type="text" name="client_account[int][client_account_added_cost]" value="0.00" id="client_account_added_cost" class="_compute_" /></td>
        				<td><b>Cost Description : </b></td>
        				<td><input type="text" name="client_account[str][client_account_added_cost_desc]" /></td>
        			</tr>         		        		
        			<thead><tr><td colspan="4"><h1>Investment Computation</h1></td></tr></thead>
        			<tr>        			
        				<td><b>Net LCP: </b> P <span class="_client_account_lcp_net"><?=string_amount($lcp)?></span></td>
        				<td><b>HCP: </b> <span class="_client_account_hcp"><?=string_amount($_VIEW['house_price'])?></span></td>
        				<td><b>Soil Poisoning: </b> P <span class="_client_account_soil_poison">0.00</span></td>        			
        				<td><b>Added Cost: </b> P <span class="_client_account_added_cost">0.00</span></td>        			
        			</tr>
        			<tr>        			
        				<td></td>
        				<td></td>
        				<td></td> 
        				<td><b>Net TCP:</b> P <span class="_client_account_tcp_net"><?=string_amount($tcp)?></span><input type="hidden" name="client_account[int][client_account_tcp_net]" value="<?=$tcp?>" id="client_account_tcp_net" /></td>
        			</tr>
        			
                    <thead><tr><td colspan="4"><h1>Down Payment Schedule</h1></td></tr></thead>
        			<tr>        			
        				<td><b>% Down Payment : </b></td>
        				<td><input type="text" name="client_account[int][client_account_dp_percent]" value="0.00" id="client_account_dp_percent" class="_compute_" /></td>
        				<td><b>Down Payment Amount : </b></td>
        				<td>P <span class="_client_account_dp_amount">0.00</span><input type="hidden" name="client_account[int][client_account_dp_amount]" value="0.00" id="client_account_dp_amount" /></td>
        			</tr> 
        			<tr>
                        <td><b>Misc. Fee : </b></td>
                        <td><input type="text" name="client_account[int][client_account_misc_fee]" value="0.00" id="client_account_misc_fee" class="_compute_" /></td>            			
        				<td><b>Total Down Payment : </b></td>
                        <td>P <span class="_client_account_dp_total">0.00</span <input id="client_account_dp_total" type="hidden" name="client_account[int][client_account_dp_total]" value="0.00" /></td>        				
        			</tr>
        			<tr>
        				<td><b>Earnest Payment : </b><input type="hidden" value="0" name="earnest_amount" id="earnest_amount"></td>
        				<td colspan="3">
        					<div style="width: 100%;">
        						<table width="100%">
        							<thead>
        								<tr>
        									<td width="10px"></td>
				                            <td>Payee</td>
				                            <td>OR #</td>
				                            <td>Pay Date</td>                           
				                            <td>Amount</td>
				                            <td>Received By</td>                                                                
				                        </tr>
			                        </thead>
			                        <?=$_VIEW['row.earnest']?>
        						</table>
        					</div>
        				</td>
        			</tr>
        			<tr>
        				<td><b>Reservation Payment : </b></td>
        				<td colspan="3">
        					<div style="width: 100%;">
        						<table width="100%">
        							<thead>
        								<tr>
        									<td width="10px"></td>
				                            <td>Payee</td>
				                            <td>OR #</td>
				                            <td>Pay Date</td>                           
				                            <td>Amount</td>
				                            <td>Received By</td>                                                                
				                        </tr>
			                        </thead>
			                        <?=$_VIEW['row.reservation']?>
        						</table>
        					</div>
        				</td>
        			</tr>
        			<tr>
        				<td colspan="2"><b>Earnest Option : </b></td>
        				<td colspan="2">
        					<select name="earnest_option" id="earnest_option" onchange="compute()">
        						<option value=""></option>
        						<option value="add">Add to Reservation</option>
        						<option value="advance">Advance Pay</option>
        					</select>
        				</td>
        			</tr>
        			<tr>
        				<td colspan="2"><b>Calculate Reservation/Earnest : </b></td>
        				<td colspan="2"><a class="link_button_block green" onclick="compute();">Calculate</a></td>
        			</tr>
        			<tr>        	
        			    <td><b>Less Reservation : </b></td>
                        <td><input type="text" name="client_account[int][client_account_reservation_paid]" value="0.00" id="client_account_reservation_paid" class="_compute_" /></td>
                        <td><b>Subject to VAT : </b></td>
                        <td><input type="checkbox" name="client_account[int][client_account_is_vat]" value="1" /></td>
        			</tr>
        			<tr>                          
                        <td><b>Net Down Payment : </b></td>
                        <td class="color_green"><b>P</b> <b class="_client_account_dp_net">0.00</b></td> 		
                        <td></td>        				
                        <td></td>        				
        			</tr>
        			<tr class="display_none">        			
        				<td><b>Down Payment Date Paid : </b></td>
        				<td><input type="text" name="client_account[str][client_account_dp_paid_date]" class="_date_" /></td>
        				<td><b>Down Payment O.R # : </b></td>
        				<td><input type="text" name="client_account[str][client_account_dp_paid_receipt]" /></td>
        			</tr>
        			<tr class="display_none">        			
        				<td><b>Down Payment Amount Paid : </b></td> <!-- This is no longer applicable -->
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

        			<thead><tr><td colspan="4"><h1>Monthly Amortization</h1></td></tr></thead>
        			<tr>        			
        				<td><b>Net TCP: </b></td>
        				<td><span class="_client_account_tcp_net"><?=string_amount($tcp)?></span></td>
        				<td><b>Net Down Payment : </b></td>
        				<td><span>P</span> <span class="_client_account_dp_net">0.00</span></td>
        			</tr>
        			<tr>        			
        				<td><b>Amount to be Financed : </b></td>
        				<td class="color_green"><b>P</b> <b class="_client_account_ma_amount"><?=string_amount($tcp)?></b><input type="hidden" name="client_account[int][client_account_ma_amount]" value="<?=$tcp?>" id="client_account_ma_amount" /></td>
        				<td><b>Payment Type : </b></td>
        				<td colspan="3"><select name="client_account[int][option_account_p2_id]"><?=$_VIEW['option_account_p2']?></select></td>
        			</tr>
        			<tr>        			
        				<td><b>Terms (Months): </b></td>
        				<td><input type="text" name="client_account[int][client_account_ma_term]" value="1" id="client_account_ma_term" class="_compute_" /></td>
        				<td><b>Commence Date: </b></td>
        				<td><input type="text" name="client_account[str][client_account_ma_due_date]" class="_date_" /></td>
        			</tr> 
        			<tr>        			
        				<td><b>Interest Rate (%): </b></td>
        				<td><input type="text" name="client_account[int][client_account_ma_interest]" value="15" id="client_account_ma_interest" class="_compute_" /></td>
        				<td><b>Fixed Factor: </b></td>
        				<td><b class="color_green _client_account_ma_factor">1.00</b><input type="hidden" name="client_account[int][client_account_ma_factor]" value="1.00" id="client_account_ma_factor" /></td>        			
        			</tr> 
        			<tr>
        				<td><b>Rebate Rate (%): </b></td>
        				<td><input type="text" name="client_account[int][client_account_ma_rebate]" value="0" /></td>
        				<td><b>Monthly Payment : </b></td>
        				<td><b class="color_green _client_account_ma_monthly">P 0.00 </b><input type="hidden" name="client_account[int][client_account_ma_monthly]" value="0.00" id="client_account_ma_monthly" /></td>
        			</tr>
        			<!--
                    <thead><tr><td colspan="4"><h1>Marketing</h1></td></tr></thead>
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
        			-->
        			<thead><tr><td colspan="4"><h1>Remarks</h1></td></tr></thead>
        			<tr>
        				<td>Remarks</td>
        				<td colspan="3">
        					<input type="hidden" name="remark[str][remark_key]" value="client_account" />
        					<input type="hidden" name="remark[int][user_id]" value="<?=$_VIEW['_user_']['user_id']?>" />
        					<textarea style="width: 100%; height: 200px;" name="remark[textarea][remark_content]"></textarea>
        				</td>
        			</tr>
        			<tr>
        				<td colspan="4">
        					<div class="align_center" style="margin-top:10px;">				               
				                <a class="link_button_inline blue" onclick="next_form('client')">Back</a>
				                 <a class="link_button_inline gray" href="/edp_client">Cancel</a>
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
	
	function get_earnest()
	{
		var earnest_total	=	0;
		$('._earnest_:checked').each(			
			function()
			{
				var current_earnest		=	$(this).parent().find('._value_').html();
					current_earnest		=	string_amount(current_earnest);
				earnest_total	=	current_earnest + earnest_total; 
			}
		);		
		
		return earnest_total;
	}
	
	function get_reservation()
	{
		var earnest_total	=	0;
		$('._reservation_:checked').each(			
			function()
			{
				var current_earnest		=	$(this).parent().find('._value_').html();
					current_earnest		=	string_amount(current_earnest);
				earnest_total	=	current_earnest + earnest_total; 
			}
		);				
		return earnest_total;
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
		// Earnest
		var Pearnest_total						=		get_earnest();
			$('#earnest_amount').val(Pearnest_total);
		// Reservation
		var Preservation						=		get_reservation();
		// Earnest Type			
		var Pearnest_type						=		$('#earnest_option').val();
		// Less Reservation
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
			PfixedFactor						=		(Pclient_account_ma_interest > 1) ? PfixedFactor : 1;
			$('._client_account_ma_factor').html(PfixedFactor);
			$('#client_account_ma_factor').val(PfixedFactor);
		// Monthly Payment
		var Pclient_account_ma_monthly			=		PfixedFactor * Pclient_account_ma_amount;
			Pclient_account_ma_monthly			=		Math.ceil(Pclient_account_ma_monthly);
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

