<tr class="{overdue}">       
    <td>
    	<input class="_invoice_" type="checkbox" onclick="select_invoice()" />
    	<input type="hidden" class="client_account_invoice_id" value="{client_account_invoice_id}" />
    </td>
    <td>
        <span class="details">{client_account_invoice_date_due}</span>
    </td>
    <td>
        <span class="details float_left" style="margin-right:10px;">{option_account_invoice_type_code} - </span>
        <div class="details float_left">{client_account_invoice_number} of {client_account_invoice_recurr_count}</div>
    </td> 

    <td>
    	<div class="details">P <span>{client_account_invoice_amount}</span></div>
    	<input type="hidden" class="client_account_invoice_amount" value="{client_account_invoice_amount}" />
    </td>   
    <!--     
    <td>
    	<div class="details">P <span>{client_account_invoice_rebate_amount}</span></div>
    	<input type="hidden" class="client_account_invoice_rebate_amount" value="{client_account_invoice_rebate_amount}" />
    </td>   
    -->
    <td>
    	<div class="details">P <span>{client_account_invoice_surcharge_amount}</span></div>
    	<input type="hidden" class="client_account_invoice_surcharge_amount" value="{client_account_invoice_surcharge_amount}" />
    </td>   
    <td>
    	<div class="details">P <span>{client_account_invoice_interest_amount}</span></div>
    	<input type="hidden" class="client_account_invoice_interest_amount" value="{client_account_invoice_interest_amount}" />
    </td>                           
    <td>
    	<div class="details">P <span>{client_account_invoice_principal_amount}</span></div>
    	<input type="hidden" class="client_account_invoice_principal_amount" value="{client_account_invoice_principal_amount}" />
    </td>                           
    <td>
    	P <span>{client_account_invoice_balance_amount}</span>
    </td>   
                             
</tr>   
