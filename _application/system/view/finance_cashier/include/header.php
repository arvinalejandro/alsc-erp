<ul id="main_navi">            
    <li>
        <a href="/finance_cashier" {account_class}>
            <span class="icon" id="finance_accounts"></span>
            <span>Accounts</span>
            {due}
        </a>        
    </li>
    <li>
        <a href="/finance_cashier/transaction" {transaction_class}>
            <span class="icon" id="finance_transaction_history"></span>
            <span>Transaction History</span>
            {transaction}
        </a>
    </li> 
    <li class="display_none">
        <a href="/finance_cashier/collection" {collection_class}>
            <span class="icon" id="finance_collection_receipt"></span>
            <span>Collection Receipt Transactions</span>
            {collection}
        </a>
    </li>
    <li>
        <a href="/finance_cashier/reservation" {reservation_class}>
            <span class="icon" id="finance_lot_reservation_earnest"></span>
            <span>Lot Reservation / Earnest</span>
            {reservation}
        </a>
    </li>
    <li class="display_none">
        <a href="/finance_cashier/daily" {daily_class}>
            <span class="icon" id="finance_daily_reports"></span>
            <span>Daily Transaction Report</span>
            {daily}
        </a>
    </li>  
                        
</ul>