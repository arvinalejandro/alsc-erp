<div id="content_body">    
    <?=$_VIEW['side_nav']?>   
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">     
        <div style="overflow: auto; width:100%;" id="_right_content_">
        <table class="mar_custom" id="_account_" style="font-weight:normal; padding-top: 20px;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
            <thead>
                <tr>
                    <td colspan="2"><h1><?=$_VIEW['bank_name']?></h1></td>
                    <td>Branch: </td>
                    <td><?=$_VIEW['bank_branch']?></td>
                </tr>
            </thead>
            <tbody>
                <tr>                        
                    <td>Address :</td>
                    <td colspan="3"><div class="details"><?=$_VIEW['bank_address']?></div></td>
                </tr>
                <tr>                        
                    <td width="15%">Tel :</td>
                    <td><div class="details"><?=$_VIEW['bank_contact_number']?></div></td>                        
                    <td width="15%">Website :</td>
                    <td><div class="details"><?=$_VIEW['bank_website']?></div></td>
                </tr>
                <tr>                        
                    <td>Type :</td>
                    <td><div class="details"><?=$_VIEW['bank_account_type']?></div></td>                        
                    <td>Swift Code :</td>
                    <td><div class="details"><?=$_VIEW['bank_swift_code']?></div></td>
                </tr>
                 <tr class="selected">       
                    <td colspan="2"></td>                 
                    <td>Current Balance :</td>
                    <td><div class="details">P <?=string_amount($_VIEW['bank_balance']['bank_balance_current'])?></div></td>                        
                </tr>
                <tr class="selected">       
                    <td colspan="2"></td>                 
                    <td>Savings Balance :</td>
                    <td><div class="details">P <?=string_amount($_VIEW['bank_balance']['bank_balance'])?></div></td>                        
                </tr>
            </tbody>
        </table>  
        <label class="mar_h"></label>
      
	        <table class="mar_custom" id="_account_" style="font-weight:normal; padding-top: 20px;overflow: scroll;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
	            <thead>
	                <tr>
	                    <td><a href="#" class="color_yellow">Date</a></td>
	                    <td><a href="#" class="color_yellow">Transaction Status</a></td>
	                    <td align="center"><a href="#" class="color_white">Cashflow Type</a></td>
	                    <td align="center"><a href="#" class="color_white">Transaction Source</a></td>
	                    <td><a href="#" class="color_white">Bank (From/To)</a></td>
	                    <td><a href="#" class="color_white">Handled by</a></td>
	                    <td align="right"><a href="#" class="color_white">Amount-In</a></td>
	                    <td align="right"><a href="#" class="color_white">Amount-Out</a></td>
	                    
	                    <td width="10%"></td>
	                </tr>
	            </thead>
	            <tbody style="overflow: auto;" id="_right_content_">
	                 <?=$_VIEW['transaction.row']?>
	            </tbody>
	        </table> 
        
    </div>  
 </div>  
</div>