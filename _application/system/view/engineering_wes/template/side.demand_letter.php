<div id="side_nav" style="width:180px;"> 
    <ul style="height:500px;"> <!--set height dynamic -->
         <li>
            <a href="/engineering_wes/demand_letter/profile/&id={lot_wes_reading_id}">
                <span class="icon" id="edp_project_profile"></span>
                <span class="label {profile.class}">Profile</span>                
            </a>            
        </li>
        
     
        
        <li>
            <a href="/engineering_wes/demand_letter/remark/&id={lot_wes_reading_id}">
                <span class="icon" id="edp_remarks"></span>
                <span class="label {remark.class}">Remarks</span>                
            </a>            
        </li>
     
     
        
        <li>
            <a href="#" class="group">
                Actions
            </a>             
          
            
            <a href="/engineering_wes/demand_letter/status_settings/&id={lot_wes_reading_id}">
                <span class="icon" id="edp_edit"></span>
                <span class="label color_red {status_settings.class}">Status Settings</span>
            </a>
            
            
            
        </li>
        
     <li style="margin-bottom: 100px;">
            <a  class="group">
                Letters
            </a> 
            <a onclick="open_letter('demand_letter')">
                <span class="icon" id="edp_edit"></span>
                <span class="label color_red">Demand Letter</span>
            </a>
            
     </li>
        
            
    </ul>
    
    <div class="align_center display_block" id="side_footer">
        
    </div>
</div>   

<script type="text/javascript">

	function open_letter(pLetter)
	{
		var myWindow = window.open("/engineering_wes/demand_letter/letter/&id={lot_wes_reading_id}&letter=" + pLetter, "_blank", "width=1000, height=600, toolbar=no, scrollbars=yes, resizable=no, resizable=yes, top=50, left=50, location=no");
	}
	
</script>