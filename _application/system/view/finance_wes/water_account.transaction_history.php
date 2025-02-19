
<div id="content_body">  
<?=$_VIEW['side_nav']?>  
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
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
               
                <label></label>
            </div>
            <label></label>
        </div> 

        <div style="overflow: auto; min-width:1000px;" id="_right_content_">
            <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                       <tr>   
                            
                            <td align="center">Receipt Number</td>  
                            <td align="center">Payee</td> 
                            <td align="center">Receipt Type</td>
                            <td align="center">Payment Method</td>
                            <td align="center">Status</td>
                            <td align="center">Amount Received</td>  
                            <td align="center">Received By</td>  
                            <td align="center">Date Received</td>                        
                       </tr>  
                            
                    </thead>
                <tbody>
                   
                  <?=$_VIEW['row.transaction']?>    
                </tbody>  
            </table>
            <label></label>
            
        </div>    
    </div>
    <label></label>
</div>


