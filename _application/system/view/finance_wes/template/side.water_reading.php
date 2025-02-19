<div id="side_nav" style="width:180px;"> 
    <ul style="height:500px;"> <!--set height dynamic -->
         <li>
            <a href="/finance_wes/water_reading/profile/&id={lot_wes_reading_id}">
                <span class="icon" id="edp_project_profile"></span>
                <span class="label {profile.class}">Profile</span>                
            </a>            
        </li>
        
     
        
        <li>
            <a href="/finance_wes/water_reading/remark/&id={lot_wes_reading_id}">
                <span class="icon" id="edp_remarks"></span>
                <span class="label {remark.class}">Remarks</span>                
            </a>            
        </li>
     
        <!--
        <li>
            <a href="/edp_inventory/edp_inventory_project/house/&id={project_id}">
                <span class="icon one"></span>
                <span class="label {house.class}">House Model</span>                
            </a>            
        </li>
        -->
        
        <li>
            <a href="#" class="group">
                Actions
            </a>             
            <a href="/finance_wes/water_reading/payment/&id={lot_wes_reading_id}">
                <span class="icon" id="edp_edit"></span>
                <span class="label color_red {payment.class}">Make Payment</span>
            </a>
            
             <a href="/finance_wes/water_reading/payment_status/&id={lot_wes_reading_id}">
                <span class="icon" id="edp_edit"></span>
                <span class="label color_red {payment_status.class}">Payment Status</span>
            </a>
            
        </li>
        
            
    </ul>
    
    <div class="align_center display_block" id="side_footer">
        
    </div>
</div>   