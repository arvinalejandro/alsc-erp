
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                <?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?> : <?=$_VIEW['client_account_number']?>
            </b>
            <span class="font_size_18 mar_h">
                - <?=$_VIEW['project_name']?> <?=$_VIEW['project_site_name']?> - Block <?=$_VIEW['project_site_block_name']?> Lot <?=$_VIEW['lot_name']?>
            </span>
            <label></label>
        </div> 
        
        <!---------- CONTENT CONTROLLERS ----------->         
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
            	
                
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                    <thead>
                        <tr>                 
                            <td>Receipt Number</td>      
                            <td>Payee</td>    
                            <td>Receipt Type</td>     
                                              	 
                        	<td>Payment Method</td>                          	          
                        	<td>Status</td>                                                  
                            <td>Amount Received</td>
                            <td>Received By</td>
                            <td>Date Received</td>                                                           
                        </tr>
                    </thead>
                    
                    <tbody>                     	              
                    	
                    	<?=$_VIEW['row.account.transaction']?>         
                              
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