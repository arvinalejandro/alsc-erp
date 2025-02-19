<div id="side_nav" style="width:180px;"> 
    <ul style="height:500px;"> <!--set height dynamic -->
         <li>
            <a href="/edp_inventory/edp_inventory_project/profile/&id={project_id}">
                <span class="icon" id="edp_project_profile"></span>
                <span class="label {profile.class}">Project Profile</span>                
            </a>            
        </li>
        
        <li>
            <a href="/edp_inventory/edp_inventory_project/site/&id={project_id}">
                <span class="icon" id="edp_site"></span>
                <span class="label {site.class}">Phase</span>                
            </a>            
        </li>
        
        <li>
            <a href="/edp_inventory/edp_inventory_project/block/&id={project_id}">
                <span class="icon" id="edp_block"></span>
                <span class="label {block.class}">Block</span>                
            </a>            
        </li>
        
        <li>
            <a href="/edp_inventory/edp_inventory_project/lot/&id={project_id}">
                <span class="icon" id="edp_lot"></span>
                <span class="label {lot.class}">Lot</span>                
            </a>            
        </li>
        <li>
            <a href="/edp_inventory/edp_inventory_project/price/&id={project_id}">
                <span class="icon" id="edp_price_history"></span>
                <span class="label {price.class}">Pricing History</span>                
            </a>            
        </li>
        
        <li>
            <a href="/edp_inventory/edp_inventory_project/remark/&id={project_id}">
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
             <a href="/edp_inventory/edp_inventory_project/edit/&id={project_id}">
                <span class="icon" id="edp_edit"></span>
                <span class="label color_red">Edit Project</span>
            </a>
            <a href="/edp_inventory/edp_inventory_project/edit_price/&id={project_id}">
                <span class="icon" id="edp_price_adjust"></span>
                <span class="label color_red">Price Adjustment</span>
            </a>
            <a href="/edp_inventory/edp_inventory_project/edit_code/&id={project_id}">
                <span class="icon" id="edp_project_codes"></span>
                <span class="label color_red">Phase Codes</span>
            </a>
        </li>
        
            
    </ul>
    
    <div class="align_center display_block" id="side_footer">
        
    </div>
</div>   