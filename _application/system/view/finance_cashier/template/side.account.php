<div id="side_nav" style="width:180px;"> 
    <ul style="height:500px;"> <!--set height dynamic -->
         <li>
            <a href="/finance_cashier/account/profile/&id={client_account_id}">
                <span class="icon" id="finance_profile"></span>
                <span class="label {profile.class}">Profile</span>                
            </a>    
            <a href="/finance_cashier/account/transaction/&id={client_account_id}">
                <span class="icon" id="finance_transactions"></span>
                <span class="label {transaction.class}">Transactions</span>                
            </a> 
            <a onclick="open_letter('statement_of_account')" class="display_none">
                <span class="icon one"></span>
                <span class="label">Statment of Account</span>
            </a>
            <a onclick="open_letter('statement_of_account')" class="display_none">
                <span class="icon one"></span>
                <span class="label">Running Balance</span>
            </a>
            <a href="/finance_cashier/account/remark/&id={client_account_id}">
                <span class="icon" id="finance_remarks"></span>
                <span class="label {remark.class}">Remarks</span>                
            </a>  
            
                   
        </li>     
            
		
        <li>
            <a  class="group">
                Payments
            </a>    
                     
            <a href="/finance_cashier/account/payment_recurring/&id={client_account_id}">
                <span class="icon" id="finance_recurring_payment"></span>
                <span class="label color_red">Recurring Payment</span>
            </a>  
            
            <a  href="/finance_cashier/account/condonation/&id={client_account_id}" class="display_none"> 
                <span class="icon" id=""></span>
                <span class="label color_red {condonation.class}">Condonation</span>
            </a>
            
             <a href="/finance_cashier/account/payment_other/&id={client_account_id}">
                <span class="icon" id="finance_others"></span>
                <span class="label color_red">Others</span>
            </a>           
        </li>
       
            
    </ul>
    
    <div class="align_center display_block" id="side_footer">
        
    </div>
</div>   

<script type="text/javascript">

	function open_letter(pLetter)
	{
		var myWindow = window.open("/finance_billing/account/letter/&id={client_account_id}&letter=" + pLetter, "_blank", "width=1000, height=600, toolbar=no, scrollbars=yes, resizable=no, resizable=yes, top=50, left=50, location=no");
	}
	
</script>