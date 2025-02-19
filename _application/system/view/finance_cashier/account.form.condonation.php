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
        	       		        	
        		<table class="mar_custom" width="90%" cellpadding="5" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <td colspan="8">Condoned Dues</td>         
                            <td align="right"><b>show</b></td>                                                                          
                        </tr>
                    </thead>
                    <thead class="display_none">
                        <tr>
                            <td width="10px"></td>  
                            <td>Due Date</td> 
                            <td>Period</td>            	
                            <td>Monthly Due</td> 
                            <td>Days Due</td>
                            <td>Surcharge</td>
                            <td>Interest</td>                                              
                            <td>Principal Amount</td>
                            <td>Outstanding Balance</td>                                                           
                        </tr>
                    </thead>
                    <tbody class="display_none">
                        <?=$_VIEW['row.account.invoice']?>
						<!--
						<tr><td colspan="5" align="center"><a class="link_button_inline gray" href="#">Load More</a></td></tr>          
                    	-->
                    </tbody>  
                </table>
                
                
                <br/>
        		
        		<table class="mar_custom" width="90%" cellpadding="5" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <td colspan="9">Condonable Dues</td>                                                                                   
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <td width="10px"></td>  
                            <td>Due Date</td> 
                            <td>Period</td>            	
                            <td>Monthly Due</td> 
                            <td>Days Due</td>
                            <td>Surcharge</td>
                            <td>Interest</td>                                              
                            <td>Principal Amount</td>
                            <td>Outstanding Balance</td>                                                           
                        </tr>
                    </thead>
                    <tbody>
                        <?=$_VIEW['row.account.invoice']?>
						<!--
						<tr><td colspan="5" align="center"><a class="link_button_inline gray" href="#">Load More</a></td></tr>          
                    	-->
                    </tbody>  
                </table>	
                
                <br/>
                
                
        		
        		<form action="/finance_cashier/account/submit_payment" name="alsc_form" method="post">      		 
        		<table class="mar_custom" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">      			
        			<thead><tr><td colspan="4"><h1>Payment Details</h1></td></tr></thead>
        			 <tr>        				
        				<td width="25%"><b>Total Surcharge : </b></td>
        				<td width="25%"><span>P</span> <span>10,000.00</span></td>
        				<td width="25%"></td>
        				<td width="25%"></td>
        			</tr>
        			 <tr>        				
        				<td width="25%"><b>Surcharge Discount (%) : </b></td>
        				<td width="25%"><input type="text" /></td>
        				<td width="25%"></td>
        				<td width="25%"></td>
        			</tr>      			
        			<tr>        				
        				<td width="25%"><b>Discount Amount: </b></td>
        				<td width="25%"><span>P</span> <span>5,000.00</span></td>
        				<td width="25%"><b>Net Surcharge : </b></td>
        				<td width="25%"><span>P</span> <span>10,000.00</span></td>
        			</tr>
        			<tr>        				
        				<td width="25%"><b>Total Amount Due: </b></td>
        				<td width="25%"><span>P</span> <span>100,000.00</span></td>
        				<td width="25%"></td>
        				<td width="25%"></td>
        			</tr>   
        			<tr>
        				<td><b>Remarks : </b></td>
        				<td colspan="3">
        					<input type="hidden" name="remark[str][remark_key]" value="account_receive" />                                                 
                            <input type="hidden" name="remark[int][user_id]" value="<?=$_VIEW['_user_']['user_id']?>" />                      
                            <textarea name="remark[textarea][remark_content]" style="height: 100px; width:100%;" ></textarea>        						
        				</td>
        			</tr>      			
        			 			     			
        			<tr>
        				<td colspan="4">
        					<input type="hidden" name="account_receive[int][user_id]" value="<?=$_VIEW['_user_']['user_id']?>" />
        					<input type="hidden" name="account_receive[int][client_account_id]" value="<?=$_VIEW['client_account_id']?>" />        					
        					
        					<div class="align_right" style="margin-top:10px;">                
				            	<a class="link_button_inline gray" href="/finance_cashier/account/profile/&id=<?=$_GET['id']?>">Cancel</a>
				                <a class="link_button_inline blue" onclick="submit_form('alsc_form')">Submit</a>
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

	
	
	
	//GLOBALS.events.add('onload', run_ready);

</script>

