<div id="side_nav" style="width:180px;"> 
    <ul style="height:500px;"> <!--set height dynamic -->
         <li>
            <a href="/finance_accounting/bank_transaction/profile/&id={b_id}">
                <span class="icon" id="finance_accounting_reconciliation_profile"></span>
                <span class="label {profile.class}">Profile</span>                
            </a>            
        </li>     
        
         <li>
            <a href="/finance_accounting/bank_transaction/remarks/&id={b_id}">
                <span class="icon" id="finance_accounting_reconciliation_remarks"></span>
                <span class="label {remarks.class}">Remarks</span>                
            </a>            
        </li>
        <li>
            <a href="#" class="group">Actions</a>
            <a href="/finance_accounting/bank_transaction/jv_adjustment/&id={b_id}">
                <span id="" class="icon"></span>
                <span class="label color_red {jv_adjustment.class}">Journal Voucher</span>
            </a>
            <a href="/finance_accounting/bank_transaction/deposit/&id={b_id}">
                <span id="" class="icon"></span>
                <span class="label color_red {deposit.class}">Deposit</span>
            </a>
            <a href="/finance_accounting/bank_transaction/transfer/&id={b_id}">
                <span id="" class="icon"></span>
                <span class="label color_red {transfer.class}">Transfer</span>
            </a>
        </li>
                  
    </ul>
    
    <div class="align_center display_block" id="side_footer">
        
    </div>
</div>   