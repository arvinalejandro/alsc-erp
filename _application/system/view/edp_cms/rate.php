
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
            
            <a href="/edp_cms/edp_cms_rate/add" class="link_button_inline blue float_right" style="margin-left:5px;">
	    		Add Interest Rate Profile
            </a>
            
            <label></label>
        </div> 
        
        
        
        <div style="overflow: auto;" id="_right_content_"> 
            <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td>
                            Interest Rate Structure
                        </td>
                        <td>
                        	Down Payment Option
                        </td>
                        <td align="center">
                        	Number of Clients in this Structure
                        </td>                        
                                              
                    </tr>
                </thead>
                <tbody>
                    <?=$_VIEW['row.rate']?>                  
                </tbody>  
            </table>
            <label></label>
            
        </div>    
    </div>
    <label></label>
</div>


