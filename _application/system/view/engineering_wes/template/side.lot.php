<div id="side_nav" style="width:180px;"> 
    <ul style="height:500px;"> <!--set height dynamic -->
         <li>
            <a href="/engineering_wes/lot/profile/&id={lot_id}">
                <span class="icon" id="edp_project_profile"></span>
                <span class="label {profile.class}">Profile</span>                
            </a>            
        </li>
        
         <li>
            <a href="/engineering_wes/lot/water_account/&id={lot_id}">
                <span class="icon" id="edp_project_profile"></span>
                <span class="label {water_account.class}">Water Account</span>                
            </a>            
        </li>
        
         <li>
            <a href="/engineering_wes/lot/electric_account/&id={lot_id}">
                <span class="icon" id="edp_project_profile"></span>
                <span class="label {electric_account.class}">Electric Account</span>                
            </a>            
        </li>
        
        
        <li>
            <a href="/engineering_wes/lot/remark/&id={lot_id}">
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
            <a href="/engineering_wes/lot/water_provision/&id={lot_id}">
                <span class="icon" id="edp_edit"></span>
                <span class="label color_red {water_provision.class}">Water Provision</span>
            </a>
            
            <a href="/engineering_wes/lot/electric_provision/&id={lot_id}">
                <span class="icon" id="edp_edit"></span>
                <span class="label color_red {electric_provision.class}">Electric Provision</span>
            </a>
            
        </li>
        
            
    </ul>
    
    <div class="align_center display_block" id="side_footer">
        
    </div>
</div>   