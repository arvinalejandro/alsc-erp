<table class="mar_custom _form display_none" id="_reservation_" style="font-weight:normal;" width="90%" cellpadding="8" cellspacing="0" border="0">
    <thead>
    	<tr>
    		<td colspan="9"><h2>Earnest Transaction</h2></td>
    	</tr>
    </thead>
    <tr style="font-size: 11px; background-color:#DBEAF9; color: #gray;">
    	<td width="10px"></td>
    	<td><b>OR #</b></td>
    	<td><b>Paid By</b></td>
    	<td><b>Phase</b></td>
    	<td><b>Block</b></td>
    	<td><b>Lot</b></td>    	
    	<td><b>Amount</b></td>
    	<td><b>Received By</b></td>
    	<td><b>Date Paid</b></td>
    </tr>
    {row.earnest} 
    
    
    <thead>
    	<tr>
    		<td colspan="9"><h2>Reservation Transaction</h2></td>    	
    	</tr>
    </thead>
    <tr style="font-size: 11px; background-color:#DBEAF9; color: #gray;">
    	<td width="10px"></td>
    	<td><b>OR #</b></td>
    	<td><b>Paid By</b></td>
    	<td><b>Phase</b></td>
    	<td><b>Block</b></td>
    	<td><b>Lot</b></td>    	
    	<td><b>Amount</b></td>
    	<td><b>Received By</b></td>
    	<td><b>Date Paid</b></td>
    </tr>
   
   {row.reservation}
   
    <tr>
        <td colspan="9" class="bg_fff">
            <div class="mar_custom" style="margin-top:10px; width:306px;">
                <a class="link_button_inline float_left blue" style="border-radius:3px 0 0 3px; width:80px;" onclick="next_form('client')">Back</a>
                <a class="link_button_inline float_left gray" style="border-radius:0; width:80px;" href="/edp_client">Cancel</a>
                <a class="link_button_inline float_left blue" style="border-radius:0 3px 3px 0; width:80px;" onclick="next_form('account_settings')">Next</a>
                <label style="margin-bottom: 8px;"></label>
            </div>
        </td>  
    </tr>  
</table>

<input type="hidden" value="" name="account_receive_id" id="account_receive_id" />

<script type="text/javascript">

var receipt_amount_total	=	0;
var account_receive_id	=	[];


function update_account_receive()
{
	receipt_amount_total	=	0;
	account_receive_id		=	[];
	$('._account_receive_id:checked').each(function()
	{
			
		var receipt_amount	=	$(this).val();
		receipt_amount	=	string_amount(receipt_amount);
		var receipt_id		=	$(this).attr('xvalue');
		
		receipt_amount_total	=	receipt_amount_total + receipt_amount;
		account_receive_id.push(receipt_id);		
			
	});	
	account_receive_id		=	account_receive_id.join(',');
	
	$('#client_account_reservation_paid').val(receipt_amount_total);
	$('#account_receive_id').val(account_receive_id);	
}	
</script>