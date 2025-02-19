<table class="mar_custom _form display_none" id="_construction_computation_" style="font-weight:normal;" width="70%" cellpadding="8" cellspacing="0" border="0">
    <thead><tr><td colspan="4"><h1>Account Details</h1></td></tr></thead>
    <tr>        			
        <td><b>Account Number: </b></td>
        				
        <td>
        	<input type="text" name="client_account[str][client_account_number]" value="{client_account_number}"   />
        </td>  		
        	
        <td><b>Date of Sale: </b></td>        			
        <td>
        	<input type="text" name="client_account[str][client_account_date_sale]" class="_date_" />
        </td>
        
    </tr>
    <!--
    <thead><tr><td colspan="4"><h1>Lot Details</h1></td></tr></thead>
    <tr>        			
        <td><b>Project: </b></td>
        <td><span>{project_name}</span></td>
        <td><b>Phase: </b></td>        			
        <td><span>{project_site_name}</span></td>        			
    </tr>
    <tr>        			
        <td><b>Block: </b></td>
        <td><span>{project_site_block_name}</span></td>
        <td><b>Lot : </b></td>        			
        <td><span>{lot_name}</span> </td>        			
    </tr>
    <tr>        			
        <td><b>Lot Type: </b></td>
        <td><span>{option_unit_name}</span></td>
        <td></td>
        <td></td>
            			
    </tr>
    
    <thead class="display_none"><tr><td colspan="4"><h1>Lot Details</h1></td></tr></thead>      
  	
    <tr class="display_none">        			
        <td width="15%"><b>Lot Area: </b></td>
        <td width="20%"><span>{lot_area}</span> sqm.</td>
        <td width="15%"></td>
        <td width="20%"></td>
    </tr>
    <tr class="display_none">        			
        <td><b>Price/sqm. : </b> </td>
        <td>P <span>{_lot_price}</span> / sqm.</td>
        <td></td>
        <td></td>
    </tr> 
    <tr class="display_none">        			
        <td><b>LCP: </b> </td>
        <td>
        	P <span>{_lcp}</span> 
        	
        </td>
        <td></td>        			
        <td></td>        			
    </tr> 
    <tr class="display_none">        			
        <td>
        	<b>% Discount: </b>        				
        </td>
        <td></td>
        <td><b>Discounted Amount</b> :</td>
        <td>
        	P <span class="_client_account_discount_amount">0.00</span> 
        	
        </td>
    </tr>          		
    <tr class="display_none">
        <td></td>
        <td></td>
        <td><b>Net LCP: </b> </td>
        <td>
        	P <span class="_client_account_lcp_net">0</span>         	
        </td>
    </tr>    
    -->
           		
    <thead class="<?=$disable_house?>"><tr><td colspan="4"><h1>Investment Value</h1></td></tr></thead>      		
    
    <tr class="display_none">
  		<td colspan="4">
  			<input type="hidden" name="client_account[int][client_account_lcp]" value="0"  id="client_account_lcp"  />
  			<input type="text" name="client_account[int][client_account_discount]" value="0.00" id="client_account_discount" class="_compute_" />
  			<input type="hidden" name="client_account[int][client_account_discount_amount]" value="0.00" id="client_account_discount_amount" />
  			<input type="hidden" name="client_account[int][client_account_lcp_net]" value="0" id="client_account_lcp_net" />
  		</td>
  	</tr>  		
    
    
    <tr>        			
        <td><b>Construction Type : </b></td>
        <td><span class="__option_unit_construction_name"></span></td>
        <td><b>Contractor Name : </b> </td>
        <td><span class="__contractor_name"></span></td>
    </tr>    
    
    <!--
     
    <tr class="display_none">        			
        <td><b>Unit Status : </b> </td>
        <td><span>{option_availability_name}</span></td>
        <td><b>Floor Area : </b> </td>
        <td><span>{house_area}</span></td>        			
    </tr> 
    
    -->
        
    <tr> 
        <td><b>Contract Price : </b></td>
        <td><input type="text" value="{house_price}" name="client_account[int][client_account_hcp]" id="client_account_hcp" class="_compute_ lot_construction_cost_estimate__" /></td>
        <td></td>
        <td></td>
    </tr>    
    
             		        		
    <thead><tr><td colspan="4"><h1>Investment Computation</h1></td></tr></thead>
    
    <!--
    <tr class="display_none">
    	<td></td>
    	<td></td>
    	<td><b>Net LCP: </b></td>
    	<td>P <span class="_client_account_lcp_net">{_lcp}</span></td>
    </tr>
    <tr class="display_none">
    	<td></td>
    	<td></td>
    	<td><b>HCP: </b></td>
    	<td>P <span class="_client_account_hcp">{_house_price}</span></td>
    </tr>
    <tr class="display_none">
    	<td><b>Soil Poisoning : </b></td>
        <td></td>
    	<td><b>Soil Poisoning: </b></td>
    	<td>P <span class="_client_account_soil_poison">0.00</span></td>
    </tr>
    <tr class="display_none">
    	<td><b>Additional Cost : </b></td>
        <td></td>
    	<td><b>Added Cost: </b></td>
    	<td>P <span class="_client_account_added_cost">0.00</span></td>
    </tr>
    <tr class="display_none">
    	<td><b>Cost Description : </b></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>   
    -->
    <tr>
    	
    	<td><b>Net TCP:</b> </td>
    	<td>
        	<b class="color_green">P <span class="_client_account_tcp_net">{_tcp}</span></b>
        	<input type="hidden" name="client_account[int][client_account_tcp_net]" value="{tcp}" id="client_account_tcp_net" class="lot_construction_cost_estimate__"/>
        	<input type="hidden" name="client_account[int][client_account_soil_poison]" value="0.00" id="client_account_soil_poison" class="_compute_" />
        	<input type="hidden" name="client_account[int][client_account_added_cost]" value="0.00" id="client_account_added_cost" class="_compute_" />
        	<input type="hidden" name="client_account[str][client_account_added_cost_desc]" />
        	
        </td>
        <td></td>
    	<td></td>
    </tr>
       
    <thead><tr><td colspan="4"><h1>Down Payment Schedule</h1></td></tr></thead>
    <tr>        			
        <td><b>% Down Payment : </b></td>
        <td><input type="text" name="client_account[int][client_account_dp_percent]" value="0.00" id="client_account_dp_percent" class="_compute_" /></td>
        <td><b>Down Payment Amount : </b></td>
        <td>
        	P <span class="_client_account_dp_amount">0.00</span>
        	<input type="hidden" name="client_account[int][client_account_dp_amount]" value="0.00" id="client_account_dp_amount" />
        </td>
    </tr> 
    <tr>
        <td></td>
    	<td></td>            			
        <td><b>Less Reservation : </b></td>
        <td><input type="text" name="client_account[int][client_account_reservation_paid]" value="0.00" id="client_account_reservation_paid" class="_compute_" /></td>
                        				
    </tr> 
    <tr>
    	<td></td>
    	<td></td>                         
        <td><b>Net Down Payment : </b></td>
        <td class="color_green">
        	<b>P</b> <b class="_client_account_dp_net">0.00</b>
        	<input type="hidden" name="client_account[int][client_account_dp_net]" value="0.00" id="client_account_dp_net" />
        </td> 		
               				
    </tr>
    <tr>
    	<td></td>
    	<td></td>                         
        <td><b>Misc. Fee : </b></td>
        <td><input type="text" name="client_account[int][client_account_misc_fee]" value="0.00" id="client_account_misc_fee" class="_compute_" /></td>		
               				
    </tr>   
    <tr>
    	<td></td>
    	<td></td>
    	<td><b>Total Down Payment : </b></td>
        <td>
        	P <span class="_client_account_dp_total">0.00</span>
        	<input id="client_account_dp_total" type="hidden" name="client_account[int][client_account_dp_total]" value="0.00" />
        </td>                          
       
    </tr>
    
    
    <tr>        			
        <td><b>Down Payment Type: </b></td>
        <td><select name="client_account[str][option_account_p1_id]" onchange="dp_type(this)">{option_account_p1}</select></td> 
        <td><b>Due Date: </b></td>
        <td><input type="text" name="client_account[str][client_account_dp_due_date]" class="_date_" /></td>         			
    </tr>        	
    <tr class="_dp_partial display_none">        			
        <td><b>Months to Pay: </b></td>
        <td><input type="text" name="client_account[int][client_account_dp_term]" value="1" id="client_account_dp_term" class="_compute_" /></td>
        <td><b>Misc. Fee Payment: </b></td>
        <td>
        	<select name="client_account[str][option_account_misc_id]" id="option_account_misc_id" onchange="compute()">
        		<option value="full">Full</option>
        		<option value="partial">Partial</option>
        	</select>       	
        </td> 
    </tr>  
    <tr class="_dp_partial display_none">        			
        <td></td>
        <td></td>
        <td><b>Misc. Fee Partial Payment: </b></td>
        <td class="color_red">
        	<b>P</b> <b class="_client_account_misc_fee_monthly">0.00</b>
        	<input type="hidden" value="0" name="client_account[int][client_account_misc_fee_monthly]" id="client_account_misc_fee_monthly" />
        </td>
    </tr>
    <tr class="_dp_partial display_none">       
        <td></td>
        <td></td>
    	<td><b>Partial DP: </b></td>
        <td class="color_green"><b>P</b> <b class="_client_account_dp_monthly">0.00</b><input type="hidden" name="client_account[int][client_account_dp_monthly]" value="0.00" id="client_account_dp_monthly" /></td>
    </tr>    
    <tr class="_dp_partial display_none">        			
        <td></td>
        <td></td>
        <td><b>Total Partial DP: </b></td>
        <td class="color_green"><b>P</b> <b class="_client_account_dp_monthly_total">0.00</b></td>
    </tr>
    

    <thead><tr><td colspan="4"><h1>Monthly Amortization</h1></td></tr></thead>
    <tr>
    	<td><b>Payment Type : </b></td>
        <td><select name="client_account[str][option_account_p2_id]">{option_account_p2}</select></td>
        <td><b>Net TCP: </b></td>
        <td>P <span class="_client_account_tcp_net">{_tcp}</span></td>
    </tr>
    <tr>        			
        <td><b>Commence Date: </b></td>
        <td><input type="text" name="client_account_structure[str][client_account_ma_due_date]" class="_date_" /></td>
        <td><b>Down Payment : </b></td>
        <td><span>P</span> <span class="_client_account_dp_amount">0.00</span></td>
    </tr>
    <tr>        		
    	<td><b>Terms (Months): </b></td>
        <td><input type="text" name="client_account_structure[int][client_account_ma_term]" value="1" id="client_account_ma_term" class="_compute_" /></td>	
        <td><b>Amount to be Financed : </b></td>
        <td class="color_green">
        	<b>P</b> <b class="_client_account_ma_amount">{_tcp}</b>
        	<input type="hidden" name="client_account_structure[int][client_account_ma_amount]" value="{tc}" id="client_account_ma_amount" />
        </td>        
    </tr>
    
    <tr>        			
        <td><b>Interest Rate (%): </b></td>
        <td><input type="text" name="client_account_structure[int][client_account_ma_interest]" value="15" id="client_account_ma_interest" class="_compute_" /></td>
        <td><b>Fixed Factor: </b></td>
        <td><b class="color_green _client_account_ma_factor">1.00</b><input type="hidden" name="client_account_structure[int][client_account_ma_factor]" value="1.00" id="client_account_ma_factor" /></td>        			
    </tr> 
    <tr>
        <td><b>Rebate Rate (%): </b></td>
        <td><input type="text" name="client_account_structure[int][client_account_ma_rebate]" value="0" /></td>
        <td><b>Monthly Payment : </b></td>
        <td>
        	<b class="color_green">P<span class=" _client_account_ma_monthly">0.00 </span></b>
        	<input type="hidden" name="client_account_structure[int][client_account_ma_monthly]" value="0.00" id="client_account_ma_monthly" />
        </td>
    </tr> 
    
    <thead><tr><td colspan="4"><h1>Remarks</h1></td></tr></thead>
    <tr>
        <td>Remarks</td>
        <td colspan="3">
        	<input type="hidden" name="remark[str][remark_key]" value="client_account" />
        	<input type="hidden" name="remark[int][user_id]" value="{user_id}" />
        	<textarea style="width: 100%; height: 200px;" name="remark[textarea][remark_content]"></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="4" class="bg_fff">
            <div class="mar_custom" style="margin-top:10px; width:306px;">
                <a class="link_button_inline float_left blue" style="border-radius:3px 0 0 3px; width:80px;" onclick="next_form('construction_account_settings')">Back</a>
                <a class="link_button_inline float_left gray" style="border-radius:0; width:80px;" href="/edp_client">Cancel</a>
                <a class="link_button_inline float_left blue" style="border-radius:0 3px 3px 0; width:80px;" onclick="submit_form('alsc_form')">Submit</a>
                <label style="margin-bottom: 8px;"></label>
            </div>
        </td>  
    </tr>
</table>  

