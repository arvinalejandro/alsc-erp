
<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS -----------> 
         
        <div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <a class="mar_custom float_left side_nav_switch hide" style="margin-right:10px;"></a>
            
            <div class="float_left" style="width: 50%;">                
                
                <div class="border_gray float_left" id="search_body">
                    <input />
                    <a class="mar_custom search_button" style="margin-left:10px;"></a>
                </div>                
                
            </div>
            <a href="/engineering_contractor/contractors/add" class="link_button_inline blue float_right" style="margin-left:5px;">
                <span class="add"></span>
	    		Add Contractor
            </a>
            
            <label></label>
        </div> 

        <div style="overflow: auto; min-width:1000px;" id="_right_content_">
            <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                       <tr>   
                            <td>Contractor Name</td> 
                            <td>Status</td> 
                            <td>Address</td>
                            <td align="center">Ongoing Projects</td>              
                            <td align="center">Completed Projects</td>              
                            <td align="center">Total Projects</td>              
                            <td width="10%"></td> 
                    </thead>
                <tbody>
                   
                  <?=$_VIEW['con_list']?> 
                </tbody>  
            </table>
            <label></label>
            
        </div>    
    </div>
    <label></label>
</div>


