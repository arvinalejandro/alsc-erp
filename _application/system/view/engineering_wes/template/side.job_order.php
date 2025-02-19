<div id="side_nav" style="width:180px;"> 
    <ul style="height:500px;"> <!--set height dynamic -->
         <li>
            <a href="/engineering_wes/job_order/profile/&id={jo_id}">
                <span class="icon" id="edp_project_profile"></span>
                <span class="label {profile.class}">Profile</span>                
            </a>            
        </li>
        
      
        <li>
            <a href="/engineering_wes/job_order/remark/&id={jo_id}">
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
            <a href="/engineering_wes/job_order/change_status/&id={jo_id}">
                <span class="icon" id="edp_edit"></span>
                <span class="label color_red {change_status.class}">Change Status</span>
            </a>
           
        </li>
        
            
    </ul>
    
    <div class="align_center display_block" id="side_footer">
        
    </div>
</div>   