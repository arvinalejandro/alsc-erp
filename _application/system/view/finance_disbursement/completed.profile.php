<div id="content_body">    
    <?=$_VIEW['side_nav']?>    
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">     
     
        <div style="overflow: auto; width:100%;" id="_right_content_">  <!--set max-height by making it dynamic -->                        
           <form action="/finance_accounting/reconciliation/submit_update_ticket" name="alsc_form" method="post">
            <input type="hidden" name="payable[int][account_payable_id]" value="<?=$_VIEW['account_payable_id']?>" />
            <input type="hidden" name="payable[str][request_type_id]" value="<?=$_VIEW['request_type_id']?>" />
            <input type="hidden" name="remark[str][remark_key]" value="account_payable" />
              <?=$_VIEW['profile.ticket']?>
               <?=$_VIEW['profile.cdv']?>
              <table class="mar_custom <?=$_VIEW['status_view']?>" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
                   
                        <tr class="<?=$_VIEW['chq_payment_class']?>">
                            <td colspan="4" align="center">
                                <table class="mar_custom bg_fff" id="_chq_tbl" style="font-weight:normal;" width="100%" cellpadding="5" cellspacing="0" border="0">
		                                <tr id="_inp_head" style="background-color: #2D5788; color:#ffffff;">
		                                    <td width="20%" align="center">Cheque Date</td>
		                                    <td width="25%">Bank</td>
		                                    <td width="15%">PO No.</td>
		                                    <td width="15%">OFV No.</td>
		                                    <td width="20%">Cheque Amount</td>
		                                </tr>
		                                
		                               <?=$_VIEW['row.account_cheque']?>            
			                        </table>
                            </td>
                        </tr>
                        
                        <tr class="<?=$_VIEW['cash_payment_class']?>">
                            <td colspan="4" align="center">
                                <table class="mar_custom bg_fff" id="_chq_tbl" style="font-weight:normal;" width="100%" cellpadding="5" cellspacing="0" border="0">
		                                <tr id="_inp_head" style="background-color: #2D5788; color:#ffffff;">
		                                    <td width="20%" align="center">Release Date :</td>
		                                    <td width="25%">OR No. :</td>
		                                    <td width="15%">PO No.</td>
		                                    <td width="15%">COV No. :</td>
		                                    <td width="15%">Amount :</td>
		                                </tr>
		                                  <?=$_VIEW['row.ofv_account_payable']['row']?>   
		                               
			                        </table>
                            </td>
                            
                        </tr>
                   
                           
                </table>  
            </form>
            <label style="margin-bottom:60px;"></label> 
                

        </div>    
    </div>
    <label></label>

</div>