
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
              Test123
            </b>

            <label></label>
        </div> 
        
        <!---------- CONTENT CONTROLLERS ----------->         
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
            	
                
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                    <thead>
                        <tr>                 
                            <td>Period</td>            
                            <td>Amount Paid</td> 
                            <td>Excess Amount</td> 
                        	<td>Amount Received</td> 
                        	<td>Principal</td>          
                        	<td>Surcharge</td>          
                        	<td>Interest</td>          
                            <td>VAT</td>                                                                                       
                            <td>Date</td>                                                                                       
                        </tr>
                    </thead>
                    
                    <tbody>                     	              
                    	
                    	     
                    	
                    	<?php
                    	  	
                    	  	
								$receive_amount				=	string_amount($_VIEW['account_receive_amount']);
                    	  		$receive_amount_principal	=	string_amount($_VIEW['account_receive_net_amount']);
                    	  		$receive_amount_surcharge	=	string_amount(0);
                    	  		$receive_amount_interest	=	string_amount(0);
                    	  		$receive_amount_vat			=	string_amount($_VIEW['account_receive_vat_amount']);
							
                    	  	
                    	?>  
                    	
                    	<tr class="selected">                    		                    		
                    		<td align="right" colspan="3">TOTAL: </td>
							<td><div class="color_green">P <?=$receive_amount?></div></a></td>
							<td><div class="">P <?=$receive_amount_principal?></div></td>
							<td><div class="">P <?=$receive_amount_surcharge?></div></td>
							<td><div class="">P <?=$receive_amount_interest?></div></td>  
							<td><div class="">P <?=$receive_amount_vat?></div></td>      
                    		<td></td>
                    	</tr>  
                              
                    </tbody>  
                </table>
                <label></label>               
                
                            
                      
                
            </div>  
        </div>    
    </div>
    <label></label>
</div>


