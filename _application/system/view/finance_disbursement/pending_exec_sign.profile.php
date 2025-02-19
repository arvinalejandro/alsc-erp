<div id="content_body">    
    <?=$_VIEW['side_nav']?>    
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" class="pad_standard" style="margin-left:180px;">     
        </br>
        <div style="overflow: auto; width:100%;" id="_right_content_">  <!--set max-height by making it dynamic -->                        
           <form action="/finance_disbursement/executive_signatory/submit_update_ticket" name="alsc_form" method="post">
            <input type="hidden" name="payable[int][account_payable_id]" value="<?=$_VIEW['account_payable_id']?>" />
            <input type="hidden" name="payable[str][request_type_id]" value="<?=$_VIEW['request_type_id']?>" />
            <input type="hidden" name="remark[str][remark_key]" value="account_payable" />
              <?=$_VIEW['profile.ticket']?>
              <table class="mar_custom " id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
                   
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
                   
                   
                    <tr class="<?=$_VIEW['status_view']?>">
                            <td colspan="4" align="center">
                                <table width="40%" cellpadding="10" cellspacing="0">
                                    <tr class="selected">
                                        <td class="border_top_gray">Action :</td>
                                        <td class="border_top_gray">
                                            <select style="float:left;" name="payable[str][request_approval_status_id]">
                                                <option value="signed">Signed</option>
                                                <option value="revoked">Revoked</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Remarks :</td>
                            <td colspan="3"><textarea style="width:100%; height:100px;" name="remark[str][remark_content]"></textarea></td>
                        </tr>  
                        <tr>
                            <td colspan="4" align="center">
                                <div class="pad_standard">
                                    <a href="#" class="link_button_inline gray" onclick="go_to('/finance_disbursement/executive_signatory/')">Cancel</a>
                                    <a href="#" class="link_button_inline blue" onclick="submit_form('alsc_form')">Submit</a>
                                </div>
                            </td>
                        </tr>     
                </table>  
            </form>
            <label style="margin-bottom:60px;"></label> 
                

        </div>    
    </div>
    <label></label>

</div>