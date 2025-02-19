
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
               <?=$_VIEW['account_receive_receipt']?>
            </b>

            <label></label>
        </div> 
        
        <!---------- CONTENT CONTROLLERS ----------->         
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
            	
                
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                    <thead>
                        <tr>                 
                            <td>Number of items</td>            
                            
                            <td>Gross Received Amount</td> 
                        	<td>Principal</td> 
                        	<td>Surcharge</td>          
                        	<td>Interest</td>          
                        	                                                                                              
                                                                                                             
                        </tr>
                    </thead>
                    
                    <tbody>                     	              
                    	
                    	<?=$_VIEW['row.invoice']?>     
                    	
                    	<?php
                    	  	
                    	  	
								$receive_amount				=	string_amount($_VIEW['account_receive_amount']);
								$net_amount					=	string_amount($_VIEW['account_receive_amount'] - $_VIEW['account_receive_vat_amount']);
                    	  		$receive_amount_principal	=	string_amount($_VIEW['account_receive_net_amount']);
                    	  		$receive_amount_surcharge	=	string_amount(0);
                    	  		$receive_amount_interest	=	string_amount(0);
                    	  		$receive_amount_vat			=	string_amount($_VIEW['account_receive_vat_amount']);
							
                    	  	
                    	?>  
                    	
                    	
                    	<tr class="selected">                    		                    		
                    		<td colspan="6" align="left"> <div class="">Date Received: <?=string_date_time($_VIEW['account_receive_timestamp'])?></div></td>
											 
                    	</tr>  
                              
                    </tbody>  
                </table>
                <label></label>               
                
                            
                      
                
            </div>  
        </div>    
    </div>
    <label></label>
</div>


<script type="text/javascript">

	    
    function compose()
    {
    	var pValue		=	$('#_letter_').val();    	
        var myWindow = window.open("/finance_billing/due/letter_print/&id=<?=$_VIEW['client_account_id']?>"+"&letter="+pValue, "_blank", "width=1000, height=600, toolbar=no, scrollbars=yes, resizable=no, resizable=yes, top=50, left=50, location=no");
    }
        

</script>