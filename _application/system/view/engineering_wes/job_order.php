
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
            
            <div class="float_right mar_h">
                <form action="#" class="float_left">
                    <select name="filter_type" style="height: 30px; width: 160px; padding: 0px;" >
                        <option>Grand Royale</option>          
                        <option>Casa Buena de Pulilan</option>          
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
                        <td align="center">ID</td>
                        <td>Account Number</td>
                        <td>Project-Phase</td>
                        <td>Blk-Lot</td>
                        <td>Client Name</td>
                        <td>Account Type</td>
                        <td align="center">Job Type</td>  
                        <td>Date Logged</td>                        
                        <td>Logged By</td>                        
                        <td align="center">Status</td>                        
                        <td width="10%"></td> 
                    </tr>       
                    </thead>
                <tbody>
                   
                  <?=$_VIEW['row.job_order']?>    
                </tbody>  
            </table>
            <label></label>
            
        </div>    
    </div>
    <label></label>
</div>


