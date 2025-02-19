<div id="content_body">    
    <?=$_VIEW['side_nav']?>    
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">     
     
        <div style="overflow: auto; width:100%;" id="_right_content_">  <!--set max-height by making it dynamic -->                        
           <form action="/treasury/cheque_release/submit_update_ticket" name="alsc_form" method="post">
           <input type="hidden" value="<?=$_VIEW['_user_']['user_name']?> <?=$_VIEW['_user_']['user_surname']?>" name="request_recommended_by"/>
            <input type="hidden" name="payable[int][account_payable_id]" value="<?=$_VIEW['account_payable_id']?>" />
            <input type="hidden" name="req_amount" value="<?=$_VIEW['request_approved_amount']?>" />
            <input type="hidden" name="caa_id" value="<?=$_VIEW['is_commission']?>" />
            <input type="hidden" name="caa_type" value="<?=$_VIEW['is_commission_group']?>" />
            <input type="hidden" name="option_payment_method_id" value="<?=$_VIEW['option_payment_method_id']?>" />
            <input type="hidden" name="is_reimbursement" value="<?=$_VIEW['is_reimbursement']?>" />
            <input type="hidden" name="account_payable_ofv_id" value="<?=$_VIEW['row.ofv_account_payable']['account_payable_ofv_id']?>" />
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
		                                    <td width="20%">Bank</td>
		                                    <td width="10%">PO No.</td>
		                                    <td width="10%">OFV No.</td>
		                                    <td width="20%">Cheque Amount</td>
		                                    <td width="20%">Status</td>
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
                        <tr class="<?=$_VIEW['cash_payment_class']?>">
                            <td align="center" colspan="4">
                                <table width="40%" cellspacing="0" cellpadding="10">
                                    <tbody>
                                        <tr class="selected">
                                            <td class="border_top_gray">Action :</td>
                                            <td class="border_top_gray">
                                                <select style="float:left;" name="cash_released">
                                                    <option value="released">Released</option>
                                                    <option value="hold">Hold</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
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
                                    <a href="#" class="link_button_inline gray" onclick="go_to('/treasury/cheque_release/')">Cancel</a>
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