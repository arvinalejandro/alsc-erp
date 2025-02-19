<div id="side_nav" style="width:180px;"> 
    <ul style="height:500px;"> <!--set height dynamic -->
         <li>
            <a href="/edp_inventory/edp_inventory_lot/profile/&id={lot_id}">
                <span class="icon" id="edp_lot"></span>
                <span class="label {profile.class}">Lot Profile</span>                
            </a>            
        </li>
        
        <li>
            <a href="/edp_inventory/edp_inventory_lot/pricing/&id={lot_id}">
                <span class="icon" id="edp_price_history"></span>
                <span class="label {pricing.class}">Pricing History</span>                
            </a>            
        </li>
        
       
        
        <li>
            <a href="/edp_inventory/edp_inventory_lot/remark/&id={lot_id}">
                <span class="icon" id="edp_remarks"></span>
                <span class="label {remark.class}">Remarks</span>                
            </a>            
        </li>
        
        

        <li>
            <a href="#" class="group">
                Actions
            </a>             
             <a href="/edp_inventory/edp_inventory_lot/edit/&id={lot_id}">
                <span class="icon" id="edp_edit"></span>
                <span class="label color_red">Edit Profile</span>
            </a>  
            <a href="/edp_inventory/edp_inventory_lot/status/&id={lot_id}">
                <span class="icon" id="edp_status"></span>
                <span class="label color_red">Status Settings</span>
            </a> 
            <a href="/edp_inventory/edp_inventory_lot/marketing/&id={lot_id}">
                <span class="icon" id="edp_hold"></span>
                <span class="label color_red">Hold</span>
            </a>  
        </li>       
            
    </ul>
    
    <div class="align_center display_block" id="side_footer">
        
    </div>
</div>   