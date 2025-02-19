
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
               Juan Dela Cruz
            </b>

            <label></label>
        </div> 
        
        <!---------- CONTENT CONTROLLERS ----------->          
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                    <thead>
                        <tr>                                                
                            <td>Sub-Account Number</td>
                            <td>Transaction Type</td>                        
                            <td>Account Type</td>
                            <td>Account Status</td>  
                            <td>Item</td>
                            <td>TCP</td>
                            <td><a class="link_button_block green font_size_10">+ Add Sub Account</a></td>                                  
                        </tr>
                    </thead>
                    
                    <tbody>                                
                        <tr>
                            <td>201-1D-1-1</td>
                            <td>Lease-to-own</td>                        
                            <td>Local</td>
                            <td>Deferred Cash Payment</td>
                            <td>Package</td>
                            <td>P 1,700,000.00</td>
                            <td align="center"><a onclick="my_due('#_house')" class="link_button_inline gray font_size_10">View Details</a></td>  
                        </tr>    
                        <tr>
                            <td>201-1D-1-2</td>
                            <td>Lease-to-own</td>                        
                            <td>Local</td>
                            <td>Deferred Cash Payment</td>
                            <td>Fencing</td>
                            <td>P 500,000.00</td>
                            <td align="center"><a onclick="my_due('#_fence')" class="link_button_inline gray font_size_10">View Details</a></td>  
                        </tr>        
                    </tbody>  
                </table>
                <label></label>
                
                <div style="width:80%;" class="mar_custom display_none due" id="_house">
                    <h1 style="margin-top:40px;" class="bold">PACKAGE DETAILS</h1>
                    <table class="mar_standard" style="font-weight:normal;" width="98%" cellpadding="5" cellspacing="0" border="0">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Payment Number</td>                            
                                <td>Amount Due</td> 
                                <td>Amount Paid</td>                               
                                <td>Applicable Rebate</td>
                                <td>Date Due</td>
                                <td>Date Paid</td>
                            </tr>
                        </thead>
                        <tr>
                            <td width="15px" align="center"><div class="status paid"></div></td>
                            <td>Down Payment</td>
                            <td>P 200,000.00</td>
                            <td>P 200,000.00</td>
                            <td>N.A</td>
                            <td>06/30/2014</td>
                            <td>06/30/2014</td>
                        </tr>
                        <tr>
                            <td width="15px" align="center">
                                <div class="status paid"></div>
                            </td>
                            <td>
                                001 of 120
                            </td>
                            <td>
                                P 14,320.14
                            </td>
                            <td>
                                P 14,320.14
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            
                            <td>
                                07/30/2014                         
                            </td>
                            
                            <td>
                                07/30/2014                            
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="15px" align="center">
                                <div class="status paid"></div>   
                            </td>
                           <td>
                                001 of 120
                            </td>
                            <td>
                                P 14,320.14
                            </td>
                            <td>
                                P 14,320.14
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            
                            <td>
                                06/30/2014                         
                            </td>
                            
                            <td>
                                06/30/2014                   
                            </td>
                        </tr>
                        <tr>
                            <td width="15px" align="center">
                                >   
                            </td>
                           <td>
                                001 of 120
                            </td>
                            <td>
                                P 14,320.14
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                06/30/2014                           
                            </td>
                            <td>
                                06/30/2014                   
                            </td>
                        </tr>
                        <tr style="background: gray;">
                            <td width="15px" align="center">
                               
                            </td>
                           <td>
                                001 of 120
                            </td>
                            <td>
                                P 14,320.14
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                06/30/2014                        
                            </td>
                            <td>                          
                            </td>
                        </tr>     
                        <tr style="background: gray;">
                            <td width="15px" align="center">
                               
                            </td>
                           <td>
                                001 of 120
                            </td>
                            <td>
                                P 14,320.14
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                06/30/2014                         
                            </td>
                            <td>                      
                            </td>
                        </tr>
                        <tr style="background: gray;">
                            <td width="15px" align="center">
                               
                            </td>
                           <td>
                                001 of 120
                            </td>
                            <td>
                                P 14,320.14
                            </td>
                            <td>
                                P 785.15.00   
                            </td>
                            <td>
                                P 785.15.00   
                            </td>
                            <td>
                                <span class="mar_custom" style="margin-right:10px;">06/30/2014</span>                            
                            </td>
                            
                            <td>
                         
                            </td>
                        </tr>
                        <tr style="background: gray;">
                            <td width="15px" align="center">
                               
                            </td>
                           <td>
                                001 of 120
                            </td>
                            <td>
                                P 14,320.14
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                <span class="mar_custom" style="margin-right:10px;">06/30/2014</span>                            
                            </td>
                            
                            <td>
                                <span class="mar_custom" style="margin-right:10px;"></span>                            
                            </td>
                        </tr>
                        <tr style="background: gray;">
                            <td width="15px" align="center">
                               
                            </td>
                           <td>
                                001 of 120
                            </td>
                            <td>
                                P 14,320.14
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                <span class="mar_custom" style="margin-right:10px;">06/30/2014</span>                            
                            </td>
                            
                            <td>
                                <span class="mar_custom" style="margin-right:10px;"></span>                            
                            </td>
                        </tr>
                        <tr style="background: gray;">
                            <td width="15px" align="center">
                               
                            </td>
                           <td>
                                001 of 120
                            </td>
                            <td>
                                P 14,320.14
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                <span class="mar_custom" style="margin-right:10px;">06/30/2014</span>                            
                            </td>
                            
                            <td>
                                <span class="mar_custom" style="margin-right:10px;"></span>                            
                            </td>
                        </tr>
                        <tr style="background: gray;">
                            <td width="15px" align="center">
                               
                            </td>
                           <td>
                                001 of 120
                            </td>
                            <td>
                                P 14,320.14
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                <span class="mar_custom" style="margin-right:10px;">06/30/2014</span>                            
                            </td>
                            
                            <td>
                                <span class="mar_custom" style="margin-right:10px;"></span>                            
                            </td>
                        </tr>
                        <tr style="background: gray;">
                            <td width="15px" align="center">
                               
                            </td>
                           <td>
                                001 of 120
                            </td>
                            <td>
                                P 14,320.14
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                <span class="mar_custom" style="margin-right:10px;">06/30/2014</span>                            
                            </td>
                            
                            <td>
                                <span class="mar_custom" style="margin-right:10px;"></span>                            
                            </td>
                        </tr>
                    </table>        
                </div>
                
                
                <div style="width:80%;" class="mar_custom display_none due" id="_fence">
                    <h1 style="margin-top:40px;" class="bold">FENCING DETAILS</h1>
                    <table class="mar_standard" style="font-weight:normal;" width="98%" cellpadding="5" cellspacing="0" border="0">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Payment Number</td>                            
                                <td>Amount Due</td> 
                                <td>Amount Paid</td>                                
                                <td>Applicable Rebate</td>
                                <td>Date Due</td>
                                <td>Date Paid</td>
                            </tr>
                        </thead>
                        <tr>
                            <td width="15px" align="center">
                                <div class="status paid"></div>
                            </td>
                            <td>
                                Down Payment
                            </td>
                            <td>
                                P 200,000.00
                            </td>
                            <td>
                                P 200,000.00
                            </td>
                            <td>
                                N.A
                            </td>
                            
                            <td>
                                <span class="mar_custom" style="margin-right:10px;">06/30/2014</span>                            
                            </td>
                            
                            <td>
                                <span class="mar_custom" style="margin-right:10px;"></span>                            
                            </td>
                        </tr>
                        <tr>
                            <td width="15px" align="center">
                                <div class="status paid"></div>
                            </td>
                            <td>
                                001 of 120
                            </td>
                            <td>
                                P 14,320.14
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                <span class="mar_custom" style="margin-right:10px;">07/30/2014</span>                            
                            </td>
                            
                            <td>
                                <span class="mar_custom" style="margin-right:10px;"></span>                            
                            </td>
                        </tr>
                        
                        
                        <tr style="background: gray;">
                            <td width="15px" align="center">
                               
                            </td>
                           <td>
                                001 of 120
                            </td>
                            <td>
                                P 14,320.14
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                <span class="mar_custom" style="margin-right:10px;">06/30/2014</span>                            
                            </td>
                            
                            <td>
                                <span class="mar_custom" style="margin-right:10px;"></span>                            
                            </td>
                        </tr>
                        <tr style="background: gray;">
                            <td width="15px" align="center">
                               
                            </td>
                           <td>
                                001 of 120
                            </td>
                            <td>
                                P 14,320.14
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                P 785.15.00
                            </td>
                            <td>
                                <span class="mar_custom" style="margin-right:10px;">06/30/2014</span>                            
                            </td>
                            
                            <td>
                                <span class="mar_custom" style="margin-right:10px;"></span>                            
                            </td>
                        </tr>
                        
                    </table>        
                </div>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


<script type=text/javascript>
    function my_due(p_selector)
    {
        $('.due').addClass('display_none');
        $(p_selector).removeClass('display_none');
        
    }
    
</script>