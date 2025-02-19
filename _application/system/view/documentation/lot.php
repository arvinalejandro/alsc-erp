
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
            
         
            
            <label></label>
        </div> 

        <div style="overflow: auto; min-width:1000px;" id="_right_content_">
            <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                       <tr>   
                            <td>Project</td> 
                            <td>Phase</td> 
                            <td align="center">Block</td>
                            <td align="center">Lot</td>
                            <td>Account Number</td>
                            <td>Lot Area (sqm.)</td>
                            <td>Lot Price (per sqm.)</td> 
                            <td>LCP</td>                                   
                            <td>Type</td>              
                            <td>Lot Status</td>                        
                            <td width="10%"></td> 
                    </thead>
                <tbody>
                    <?=$_VIEW['row.lot']?>            
                </tbody>  
            </table>
            <label></label>
            
        </div>    
    </div>
    <label></label>
</div>


