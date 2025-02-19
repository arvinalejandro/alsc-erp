
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
               Project Time Table
            </b>
             <a href="/engineering/construction/add_timetable/&id=<?=$_VIEW['lot_construction_id']?>" class="link_button_inline blue float_right" style="margin-left:5px;">
                <span class="add"></span>
	    		Add Entry
            </a>

            <label></label>
        </div> 
    	
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td>
                            Task                 
                        </td>
                        <td>
                           Date Started
                        </td>
                        
                         <td>
                            Date Completed
                        </td>
                        
                        <td>
                        	Logged By
                        </td>                        
                        <td>
                            Date Logged
                        </td>   
                         <td width="10%"></td>                                  
                    </tr>
                </thead>
                <tbody>
                	<?=$_VIEW['table_row']?>
                </tbody>  
            </table>
            <label></label>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


