
<table class="mar_custom" id="_account_" style="font-weight:normal; padding-top: 20px;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
   
    <thead>
        <tr>
            <td colspan="2"><h1>{bank_name}</h1></td>
            <td>Branch: </td>
            <td>{bank_branch}</td>
        </tr>
    </thead>
    <tbody>
       
        <tr>                        
            <td>Date :</td>
            <td><div class="details">{bank_transaction_timestamp}</div></td>
             <td>Transaction Status :</td>
            <td><div class="details">{transaction_status}</div></td>
        </tr>
        <tr>                        
            <td width="15%">Amount :</td>
            <td><div class="details">P {bank_transaction_amount}</div></td>                        
            <td width="15%"></td>
            <td><div class="details"></div></td>
        </tr>
        <tr>                        
            <td>Cashflow :</td>
            <td><div class="details">{option_bank_transaction_type_name}</div></td>                        
            <td>Transaction :</td>
            <td><div class="details">{option_bank_transaction_category_name}</div></td>
        </tr>
        <tr>                        
            <td>Bank(From/To) :</td>
            <td><div class="details">{bank_destination}</div></td>                        
            <td>Handled by :</td>
            <td><div class="details">{handled_by}</div></td>
        </tr>
        <tr>                        
            <td>Depositor :</td>
            <td><div class="details">{bank_transaction_depositor}</div></td>                        
            <td>Details :</td>
            <td><div class="details">{bank_transaction_details}</div></td>
        </tr>
        <tr>
            <td colspan="4"> <a href="/finance_accounting/bank_transaction/profile/&id={bank_id}" class="link_button_inline blue">Back to Profile</a></td>
        </tr>
        
    </tbody>
</table>  