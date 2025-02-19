<div id="side_nav" style="width:180px;"> 
    <ul style="height:500px;"> <!--set height dynamic -->
         <li>
            <a href="/edp_client/edp_client_manage/profile/&id={client_id}">
                <span class="icon" id="edp_profile"></span>
                <span class="label {profile.class}">Profile</span>                
            </a>            
        </li>     
        
        <li>
            <a href="/edp_client/edp_client_manage/account/&id={client_id}">
                <span class="icon" id="edp_accounts"></span>
                <span class="label {account.class}">Accounts</span>                
            </a>            
        </li>
        
                                                                       
        <!--<li>
            <a href="#">
                <span class="icon one"></span>
                <span class="label {remark.class}">Remarks</span>                
            </a>            
        </li>-->
        
                                                
		
        <li class="{hidden}">
            <a  class="group">
                Actions
            </a>             
             <a href="/edp_client/edp_client_manage/account_profile/&id={client_account_id}&client_id={client_id}">
                <span class="icon" id="edp_account_profile"></span>
                <span class="label color_red">Account Profile</span>
            </a>  
            <a href="/edp_client/edp_client_manage/account_invoice/&id={client_account_id}&client_id={client_id}">
                <span class="icon" id="edp_amortization"></span>
                <span class="label color_red">Amortization</span>
            </a>           
            <a href="/edp_client/edp_client_manage/status/&id={client_account_id}&client_id={client_id}">
                <span class="icon" id="edp_amortization"></span>
                <span class="label color_red">Account Status</span>
            </a>  
            <a class="display_none" href="/edp_client/edp_client_manage/restructure/&id={client_account_id}&client_id={client_id}">
                <span class="icon" id="edp_amortization"></span>
                <span class="label color_red">Restructure Account</span>
            </a> 
        </li>
        
            
    </ul>
    
    <div class="align_center display_block" id="side_footer">
        
    </div>
</div>   