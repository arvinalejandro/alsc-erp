

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
                
            	
            	<table class="mar_custom _form" id="_account_" style="font-weight:normal;" width="70%" cellpadding="8" cellspacing="0" border="0">
				    <thead><tr><td colspan="4"><h1>Downpayment Structure</h1></td></tr></thead>
				    
				    <tr>        			
				        <td><b>DP Amount: </b></td>
				        <td><span><?=$_VIEW['project_name']?></span></td>
				        <td><b>Pay Period: </b></td>        			
				        <td><span><?=$_VIEW['project_site_name']?></span></td>        			
				    </tr>
				    <tr>        			
				        <td><b>DP Calendar Date: </b></td>
				        <td><span><?=$_VIEW['client_account_dp_due_date']?></span></td>
				        <td></td>        			
				        <td></td>        			
				    </tr>
				   			    
				    <thead><tr><td colspan="4"><h1>MA Structure</h1></td></tr></thead>        		
				    <tr>			       
				        <td width="15%">Amount Financed (Principal)</td>
				        <td width="20%">P <?=$_VIEW['client_account_ma_amount']?></td>
				        <td width="15%"><b>Interest: </b></td>        			
				        <td width="20%">P <?=$_VIEW['client_account_ma_interest']?></td> 
				    </tr>
				    <tr>        			
				        <td><b>Outstanding Balance: </b> </td>
				        <td>P <span><?=$_VIEW['']?></span> / sqm.</td>
				        <td><b>Outstanding Principal</b></td>
				        <td>P <span><?=$_VIEW['']?></span></td>
				    </tr> 
				    <tr>        			
				        <td><b>Rebate: </b> </td>
				        <td>P <?=$_VIEW['']?></td>
				               			
				    </tr> 
				    <tr>        			
				        <td><b>MA Amount: </b> </td>
				        <td>P <?=$_VIEW['']?></td>
				        <td><b>MA Calendar Date: </b></td>        			
				        <td>P <?=$_VIEW['']?></td>        			
				    </tr> 
				    <tr>        			
				        <td><b>Fixed Factor: </b> </td>
				        <td>P <?=$_VIEW['']?></td>
				       	<td></td>    			
				    </tr> 
				    
				  				    
				    <tr class="display_none">        			
				        <td><b>LCP: </b> </td>
				        <td>
        					P <span>{_lcp}</span> 
        					<input type="hidden" name="client_account[int][client_account_lcp]" value="0"  id="client_account_lcp"  />
        					<input type="text" name="client_account[int][client_account_discount]" value="0.00" id="client_account_discount" class="_compute_" />
        					<input type="hidden" name="client_account[int][client_account_discount_amount]" value="0.00" id="client_account_discount_amount" />
        					<input type="hidden" name="client_account[int][client_account_lcp_net]" value="0" id="client_account_lcp_net" />
        					<input type="text" value="{house_price}" name="client_account[int][client_account_hcp]" id="client_account_hcp" class="_compute_" />
        					<input type="text" name="client_account[int][client_account_soil_poison]" value="0.00" id="client_account_soil_poison" class="_compute_" />
        					<input type="text" name="client_account[int][client_account_added_cost]" value="0.00" id="client_account_added_cost" class="_compute_" />
        					<input type="hidden" name="client_account[int][client_account_tcp_net]" value="0" id="client_account_tcp_net" />
        					<input type="text" name="client_account[str][client_account_added_cost_desc]" />
        					<input type="text" name="client_account[int][client_account_dp_percent]" value="0.00" id="client_account_dp_percent" class="_compute_" />
        					<input type="hidden" name="client_account[int][client_account_dp_amount]" value="0.00" id="client_account_dp_amount" />
        					<input type="text" name="client_account[int][client_account_reservation_paid]" value="0.00" id="client_account_reservation_paid" class="_compute_" />
        					<input type="hidden" name="client_account[int][client_account_dp_net]" value="0.00" id="client_account_dp_net" />
        					<input type="text" name="client_account[int][client_account_misc_fee]" value="0.00" id="client_account_misc_fee" class="_compute_" />
        					<input id="client_account_dp_total" type="hidden" name="client_account[int][client_account_dp_total]" value="0.00" />4
        					<select name="client_account[str][option_account_p1_id]" onchange="dp_type(this)">{option_account_p1}</select>
        					<input type="text" name="client_account[str][client_account_dp_due_date]" class="_date_" />
        					<input type="text" name="client_account[int][client_account_dp_term]" value="1" id="client_account_dp_term" class="_compute_" />
        					<select name="client_account[str][option_account_misc_id]" id="option_account_misc_id" onchange="compute()">
        						<option value="full">Full</option>
        						<option value="partial">Partial</option>
        					</select>   
        					<input type="hidden" value="0" name="client_account[int][client_account_misc_fee_monthly]" id="client_account_misc_fee_monthly" />
        					<input type="hidden" name="client_account[int][client_account_dp_monthly]" value="0.00" id="client_account_dp_monthly" />
        					<input type="hidden" name="client_account_structure[int][client_account_ma_amount]" value="0" id="client_account_ma_amount" />
				        </td>
				        <td>
				        
				        
				        </td>        			
				           			
				    </tr> 
				    
				    <thead><tr><td colspan="4"><h1>Monthly Amortization</h1></td></tr></thead>
				    
				    <tr>
    					<td><b>Payment Type : </b></td>
				        <td><select name="client_account[str][option_account_p2_id]">{option_account_p2}</select></td>
				        <td><b>Remaining Principal: </b></td>
				        <td>P <span class="_client_account_tcp_net">{_tcp}</span></td>
				    </tr>
				    <tr>        			
				        <td><b>Commence Date: </b></td>
				        <td><input type="text" name="client_account_structure[str][client_account_ma_due_date]" class="_date_" /></td>
				        <td><b>Fixed Factor: </b></td>
				        <td><b class="color_green _client_account_ma_factor">1.00</b><input type="hidden" name="client_account_structure[int][client_account_ma_factor]" value="1.00" id="client_account_ma_factor" /></td>  
				    </tr>
				    <tr>        		
    					<td><b>Terms (Months): </b></td>
				        <td><input type="text" name="client_account_structure[int][client_account_ma_term]" value="1" id="client_account_ma_term" class="_compute_" /></td>	
				        <td><b>Monthly Payment : </b></td>
				        <td>
        					<b class="color_green">P<span class=" _client_account_ma_monthly">0.00 </span></b>
        					<input type="hidden" name="client_account_structure[int][client_account_ma_monthly]" value="0.00" id="client_account_ma_monthly" />
				        </td>		
				    </tr>
				    
				    <tr>        			
				        <td><b>Interest Rate (%): </b></td>
				        <td><input type="text" name="client_account_structure[int][client_account_ma_interest]" value="15" id="client_account_ma_interest" class="_compute_" /></td>
				       	<td></td>
				        <td></td>
				    </tr> 
				    <tr>
				        <td><b>Rebate Rate (%): </b></td>
				        <td><input type="text" name="client_account_structure[int][client_account_ma_rebate]" value="0" /></td>
				        <td></td>
				        <td></td>
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
				                <a class="link_button_inline float_left blue" style="border-radius:3px 0 0 3px; width:80px;" onclick="next_form('account_settings')">Back</a>
				                <a class="link_button_inline float_left gray" style="border-radius:0; width:80px;" href="/edp_client">Cancel</a>
				                <a class="link_button_inline float_left blue" style="border-radius:0 3px 3px 0; width:80px;" onclick="submit_form('alsc_form')">Submit</a>
				                <label style="margin-bottom: 8px;"></label>
				            </div>
				        </td>  
				    </tr>
				</table>  


            </div>   
            </form>        
    	</div>
    	<label></label>
</div>


