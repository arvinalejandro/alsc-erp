
<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS -----------> 
         
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <a class="mar_custom float_left side_nav_switch hide" style="margin-right:10px;"></a>
            
            <div class="float_left" style="width: 50%;">                
                
                <div class="border_gray float_left" id="search_body">
                    <input />
                    <a class="mar_custom search_button" style="margin-left:10px;"></a>
                </div>                
                
            </div>
            
            <a href="/edp_inventory/edp_inventory_house/add" class="link_button_inline blue float_right" style="margin-left:5px;">
                <span class="add"></span>
	    		Add House Model 
            </a>
            
            <label></label>
        </div> 
        
        
        
        <div style="overflow: auto;" id="_right_content_">
            <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                    <tr>                        
                        <td>
                        	House Model
                        </td>
                        <td>
                        	Acronym
                        </td>
                        <td>
                            Project
                        </td> 
                        <td>
                            Floor Area
                        </td>
                        <td>
                            HCP
                        </td> 
                        <td>
                            Classification
                        </td>     
                                                           
                    </tr>
                </thead>
                <tbody>
                    <?=$_VIEW['row.house']?>
  			               
                </tbody>  
            </table>
            <label></label>
            
        </div>    
    </div>
    <label></label>
</div>

 
