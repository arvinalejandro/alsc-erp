
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
        
        <!---------- CONTENT CONTROLLERS ----------->         
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
            	<table width="100%" cellspacing="0" cellpadding="5">
            		<tr>
                        <td style="border-left:0;"></td>
            			<td align="right">
            				<select name="letter" id="_letter_">
            					<option value="demand_first">First Demand Letter</option>            					       					
            					<option value="demand_final">Final Demand Letter</option>            					       					
                                <option value="cancellation_with_refund">Reservation Notice</option>                                                           
            					<option value="cancellation_with_refund">Cancellation Letter (w/ Refund)</option>            					       					
            					<option value="cancellation_without_refund">Cancellation Letter (w/o Refund)</option>            					       					
                                <option value="ejectment">Ejectment Letter</option>                                                           
                                <option value="ejectment">For Retention Notice</option>                                                           
                                <option value="ejectment">First Retention Notice</option>                                                           
                                <option value="ejectment">Retention Notice with Interest</option>                                                           
            					<option value="ejectment">Fully Paid Notice</option>            					       					
            				</select>           				
            			</td>
                        <td></td> 
            			<td width="20%"><a class="link_button_block blue" onclick="compose()">Compose</a></td>
                        <td style="border-right:0;"></td>          			
            		</tr>
            	</table>
                <label style="margin-bottom:20px;"></label>
            	
            	<div><h1>Pending Invoice</h1></div>
                
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                    <thead>
                        <tr>  
                        	<td>Due Date</td>               
                            <td>Period</td>
                            <td>Surcharge</td>
                            <td>Interest</td>
                            <td>Principal Amount</td>  
                            <td>Outstanding Balance</td>                           
                            <td>Amount Due</td>
                            <td>Days Overdue</td>                                                     
                            <td>Status</td>                            
                        </tr>
                    </thead>
                    
                    <tbody>           
                    
                    	<?=$_VIEW['row.due.invoice']?>         
                              
                    </tbody>  
                </table>
                <label></label>               
                
                <div><h1>Settled Invoice</h1></div>
                
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                    <thead>
                        <tr>                 
                            <td width="10%">
                                Invoice                           
                            </td>
                            
                            <td width="5%">
                            	Type
                            </td>
                            <td width="15%">
                            	Amount Due
                            </td>
                            <td width="15%">
                                Interest
                            </td>                    
                            <td width="15%">
                                Surcharge
                            </td>
                            <td width="15%">
                                Date Paid
                            </td>                            
                                         
                        </tr>
                    </thead>
                    
                    <tbody>           
                    
                    	<?=$_VIEW['row.due.invoice.settled']?>         
                              
                    </tbody>  
                </table>
                <label></label>               
                      
                
            </div>  
        </div>    
    </div>
    <label></label>
</div>


<script type="text/javascript">

	    
    function compose()
    {
    	var pValue		=	$('#_letter_').val();    	
        var myWindow = window.open("/finance_billing/due/letter_print/&id=<?=$_VIEW['client_account_id']?>"+"&letter="+pValue, "_blank", "width=1000, height=600, toolbar=no, scrollbars=yes, resizable=no, resizable=yes, top=50, left=50, location=no");
    }
        

</script>