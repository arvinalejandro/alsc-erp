
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
            
            <div class="float_right mar_h">
                <form action="/finance_wes/electric_account/" method="post" name="alsc_form" class="float_left">
                    <select name="filter_type" style="height: 30px; width: 160px; padding: 0px;" onchange="submit_form('alsc_form')" >
                         <option value="all" <?=$_VIEW['all']?>>All</option>
                        <option value="installed" <?=$_VIEW['installed']?>>Installed</option>          
                        <option value="pending" <?=$_VIEW['pending']?>>Pending</option>          
                        <option value="suspended" <?=$_VIEW['suspended']?>>Suspended</option>          
                        <option value="test_begin" <?=$_VIEW['test_begin']?>>Test Begin</option>          
                        <option value="test_end" <?=$_VIEW['test_end']?>>Test End</option>          
                        <option value="disconnected" <?=$_VIEW['disconnected']?>>Disconnected</option>          
                        <option value="meralco" <?=$_VIEW['meralco']?>>Meralco</option>          
                                 
                    </select>
                </form>
                <label></label>
            </div>
            <label></label>
        </div> 

        <div style="overflow: auto; min-width:1000px;" id="_right_content_">
            <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                      <tr>   
                           <td>Account Number</td>
                            <td align="center">Meter Number</td>
                            <td align="center">SIN</td>
                            <td align="center">Phase</td> 
                            <td align="center">Block</td>
                            <td align="center">Lot</td>
                            <td align="center">Client Name</td>  
                            <td align="center">Account Status</td>                        
                            <td align="center">Balance Status</td> 
                            <td align="center">Billing Duration</td>                        
                            <td align="center">Next Reading Date</td>                        
                            <td width="10%"></td> 
                       </tr>  
                            
                    </thead>
                <tbody>
                   
                   <?=$_VIEW['row.account']?>
                </tbody>  
            </table>
            <label></label>
            
        </div>    
    </div>
    <label></label>
</div>


