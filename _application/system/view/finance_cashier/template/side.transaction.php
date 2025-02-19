<div id="side_nav" style="width:180px;"> 
    <ul style="height:500px;"> <!--set height dynamic -->
         <li>
            <a href="/finance_cashier/transaction/profile/&id={account_receive_id}">
                <span class="icon" id="finance_profile"></span>
                <span class="label {profile.class}">Profile</span>                
            </a>    
            <a href="/finance_cashier/transaction/invoice/&id={account_receive_id}">
                <span class="icon" id="finance_transactions"></span>
                <span class="label {invoice.class}">Breakdown</span>                
            </a> 
            <a href="/finance_cashier/transaction/remark/&id={account_receive_id}">
                <span class="icon" id="finance_remarks"></span>
                <span class="label {remark.class}">Remarks</span>                
            </a>         
        </li>     
            
		<!--
        <li>
            <a  class="group">
                Payments
            </a>             
              <a href="/finance_cashier/account/payment_recurring/&id={client_account_id}">
                <span class="icon" id="finance_recurring_payment"></span>
                <span class="label color_red">Recurring Payment</span>
            </a>  
             <a href="/finance_cashier/account/payment_other/&id={client_account_id}">
                <span class="icon" id="finance_others"></span>
                <span class="label color_red">Others</span>
            </a>           
        </li>
       	-->
            
    </ul>
    
    <div class="align_center display_block" id="side_footer">
        
    </div>
</div>   