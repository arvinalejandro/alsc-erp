<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS -----------> 
         
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
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
                        <option>All</option>         
                        <option>In-transit</option>          
                        <option>Encashed</option>          
                              
                    </select>
                </form>
                <label></label>
            </div>
            <label></label>
        </div> 
        
        
        
        <div style="overflow: auto;" id="_right_content_">
            <table class="mar_standard" width="100%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                    <tr>                 
                        <td><a href="#" class="color_white">ID No.</a></td>     
                        <td><a href="#" class="color_white">Cheque Date</a></td>     
                        <td><a href="#" class="color_white">Release Date</a></td>   
                        <td><a href="#" class="color_white">Cheque Amount</a></td>  
                        <td><a href="#" class="color_white">Bank</a></td>  
                        <td><a href="#" class="color_yellow">PO Number</a></td>     
                        <td><a href="#" class="color_white">OFV Number</a></td>       
                        <td><a href="#" class="color_white">Status</a></td>  
                        <td></td>
                    </tr>
                </thead>
                
                <tbody>                      
                   <?=$_VIEW['row.cheq']?>
                </tbody>  
            </table>
            <label></label>  
                
            <label></label>
            
        </div>    
    </div>
    <label></label>
</div>