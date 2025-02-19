<div id="side_nav" style="width:180px;"> 
    <ul style="height:500px;"> <!--set height dynamic -->
         <li>
            <a href="/edp_inventory/edp_inventory_house/profile/&id={house_id}">
                <span class="icon" id="edp_house_profile"></span>
                <span class="label {profile.class}">House Profile</span>                
            </a>            
        </li> 
        <li>
            <a href="/edp_inventory/edp_inventory_house/pricing/&id={house_id}">
                <span class="icon" id="edp_price_history"></span>
                <span class="label {pricing.class}">Price History</span>                
            </a>            
        </li>       

        <li>
            <a href="#" class="group">
                Actions
            </a>             
             <a href="/edp_inventory/edp_inventory_house/edit/&id={house_id}">
                <span class="icon" id="edp_edit"></span>
                <span class="label color_red">Edit Profile</span>
            </a>
        </li>        
            
    </ul>
    
    <div class="align_center display_block" id="side_footer">
        
    </div>
</div>   