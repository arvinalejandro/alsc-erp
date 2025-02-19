<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
           <b class="font_size_18">
                 <?=$_VIEW['lot_wes_account_receive_receipt']?>
            </b>

            <label></label>
        </div> 
         
        <!---------- CONTENT CONTROLLERS ----------->         
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                
                <table class="_form " id="_investment_"  width="90%" align="center" cellpadding="3" cellspacing="0" border="0" style="font-weight:normal;">
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Client Details</b></td>
                        </tr>
                    </thead>
                    <tr>
                        <td class="color_gray" width="15%">
                            Full Name:
                        </td>
                        <td width="35%">
                          <?=$_VIEW['lot_wes_account_receive_payee']?>
                        </td>
                        <td class="color_gray" width="15%">
                            Marital Status:
                        </td>
                        <td width="35%">
                            <?=$_VIEW['option_civil_status_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Sex:
                        </td>
                        <td>
                            <?=$_VIEW['option_gender_name']?>
                        </td>
                        <td class="color_gray">
                            Home Address :
                        </td>
                        <td>
                           <?=$_VIEW['client_address']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                           Zip Code
                        </td>
                        <td>
                            
                            <?=$_VIEW['client_zip']?>

                        </td>
                        <td class="color_gray">
                            Address in-use :
                        </td>
                        <td>        
                            <?=$_VIEW['option_client_address_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                           Email:
                        </td>
                        <td>
                            
                            <?=$_VIEW['client_email']?>

                        </td>
                        <td class="color_gray">
                            Employment :
                        </td>
                        <td>        
                            <?=$_VIEW['option_employment_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                           Tel. No:
                        </td>
                        <td>                            
                            <?=$_VIEW['client_telephone']?>
                        </td>
                        <td class="color_gray">
                            Mobile Number :
                        </td>
                        <td>        
                            <?=$_VIEW['client_mobile']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                           TIN:
                        </td>
                        <td>
                            
                            <?=$_VIEW['client_tin']?>

                        </td>
                        <td class="color_gray">
                            SSS :
                        </td>
                        <td>        
                            <?=$_VIEW['client_sss']?>
                        </td>
                    </tr>  
                    
                     <thead><tr><td colspan="4"><b style="font-size: 12px;">Payment Details</b></td></tr></thead>
                   <tr>
                        <td class="color_gray">
                            Receipt Number:
                        </td>
                        <td>
                            <?=$_VIEW['lot_wes_account_receive_receipt']?>
                        </td>
                        <td class="color_gray">
                             Payee:
                        </td>
                        <td>
                            <?=$_VIEW['lot_wes_account_receive_payee']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Receipt Type:
                        </td>
                        <td>
                            <?=$_VIEW['option_payment_receipt_name']?>
                        </td>
                        <td class="color_gray">
                             Payment Method:
                        </td>
                        <td>
                             <?=$_VIEW['option_payment_method_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                           Status:
                        </td>
                        <td>
                             <?=$_VIEW['option_payment_status_name']?>
                        </td>
                        <td class="color_gray">
                             Amount Received:
                        </td>
                        <td>
                            <?=$_VIEW['amount_receive']?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                           Received By:
                        </td>
                        <td>
                            <?=$_VIEW['user_']?>
                        </td>
                        <td class="color_gray">
                             Date Received:
                        </td>
                        <td>
                             <?=$_VIEW['receive_date']?>
                        </td>
                    </tr>                    
                    
                           
                </table>      
                
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