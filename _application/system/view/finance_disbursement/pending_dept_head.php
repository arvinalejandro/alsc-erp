<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS -----------> 
         
        <div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <a class="mar_custom float_left side_nav_switch hide" style="margin-right:10px;"></a>
            
            <div class="float_left" style="width: 20%;">                
                
                <div class="border_gray float_left" id="search_body">
                    <input />
                    <a class="mar_custom search_button" style="margin-left:10px;"></a>
                </div>                
                
            </div>
            <div class="float_right mar_h">
                <form action="#" class="float_left">
                    <select name="filter_type" style="height: 30px; width: 160px; padding: 0px;" >
                        <option>Filter Type</option>         
                        <option>TBA Only</option>          
                        <option>RFP Only</option>          
                        <option>Liquidation Only</option>          
                        <option>Declined Only</option>          
                    </select>
                </form>
            </div>
            <label></label>
        </div> 
        
        
        
        <div style="overflow: auto;" id="_right_content_">
            <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                    <tr>                 
                        <td><a href="#" class="color_white">ID No.</a></td>     
                        <td><a href="#" class="color_white">Requestor</a></td>     
                        <td><a href="#" class="color_yellow">Type</a></td>   
                        <td><a href="#" class="color_white">Date Requested</a></td>  
                        <td><a href="#" class="color_white">Amount</a></td>     
                        <td><a href="#" class="color_white">Purpose</a></td> 
                        <td><a href="#" class="color_white">Recommended by</a></td>       
                        <td><a href="#" class="color_white">Accounted to</a></td>     
                        <td><a href="#" class="color_white">Status</a></td>  
                        <td></td>
                    </tr>
                </thead>
                
                <tbody>                      
                        
                        <?=$_VIEW['row.ticket']?>
                </tbody>  
            </table>
            <label style="margin-bottom:40px;"></label>  
            
            <!-- place all running requests here for Dept Head to track. Once a ticket is complete, remove it here and put to completed tab-->
            <div class="pad_standard mar_custom border_blue" style="width: 90%;">
                <h1 class="align_center">RUNNING REQUESTS</h1>
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                    <thead>
                        <tr>                 
                            <td><a href="#" class="color_white">ID No.</a></td>     
                            <td><a href="#" class="color_white">Requestor</a></td>     
                            <td><a href="#" class="color_yellow">Type</a></td>   
                            <td><a href="#" class="color_white">Date Requested</a></td>  
                            <td><a href="#" class="color_white">Amount</a></td>        
                            <td><a href="#" class="color_white">Purpose</a></td>        
                            <td><a href="#" class="color_white">Accounted to</a></td>     
                            <td><a href="#" class="color_white">Status</a></td>  
                            <td><a href="#" class="color_white">Next Lvl</a></td>  
                            <td></td>
                        </tr>
                    </thead>
                    
                    <tbody>     
                         <?=$_VIEW['row.ongoing']?>
                               
                    </tbody>  
                </table>        
            </div>
            <label></label>
            
        </div>    
    </div>
    <label></label>
</div>