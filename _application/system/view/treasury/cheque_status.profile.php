<div id="content_body">    
    <?=$_VIEW['side_nav']?>    
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">     
     
        <div style="overflow: auto; width:100%;" id="_right_content_">  <!--set max-height by making it dynamic -->                        
            <form action="/treasury/cheque_status/submit_update_cheque" name="alsc_form" method="post">
            <input type="hidden" name="remark[str][remark_key]" value="account_payable_cheque" />
            <input type="hidden" name="account_payable_cheque[account_payable_cheque_id]" value="<?=$_VIEW['account_payable_cheque_id']?>" />
            <input type="hidden" name="transaction_id" value="<?=$_VIEW['bank_transaction_id']?>" />
            <input type="hidden" name="caa_id" value="<?=$_VIEW['account_payable']['is_commission']?>" />
            <input type="hidden" name="caa_type" value="<?=$_VIEW['account_payable']['is_commission_group']?>" />
            <input type="hidden" name="account_payable_id" value="<?=$_VIEW['account_payable_id']?>" />
              <table class="mar_custom <?=$_VIEW['status_view']?>" id="_account_" style="font-weight:normal; margin-top:40px;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
                       <tr>
                            <td colspan="4" align="center" style="border-top:1px solid #eaeaea;">
                                <table class="mar_custom bg_fff" id="_chq_tbl" style="font-weight:normal;" width="100%" cellpadding="5" cellspacing="0" border="0">
		                                <tr style="background-color: #2D5788; color:#ffffff;">
		                                    <td width="20%">Cheque Date</td>
		                                    <td width="20%">Release Date</td>
		                                    <td width="20%">Bank</td>
		                                    <td width="10%">PO No.</td>
		                                    <td width="10%">OFV No.</td>
		                                    <td width="20%">Cheque Amount</td>
		                                   
		                                </tr>
		                                 <tr style="background-color: #ffffff; color:black;">
								            <td width="15%"><?=string_date($_VIEW['account_payable_cheque_date'])?></td>
								            <td width="15%"><?=string_date($_VIEW['released_date'])?></td>
								            <td width="20%"><?=$_VIEW['account_payable_cheque_bank']?></td>
								            <td width="15%"><?=$_VIEW['account_payable_cheque_po_number']?></td>
								            <td width="15%"><?=$_VIEW['account_payable_cheque_ofv_number']?></td>
								            <td width="20%">P <?=string_amount($_VIEW['account_payable_cheque_amount'])?></td>
							            </tr>
							            <tr  style="background-color: #ffffff; color:black;" class="selected <?=$_VIEW['status_class']?>">
                                            <td>Encashed Date:</td>
								            <td colspan="5" align="center" width="40%"><input  type="text" class="_date_"  name="account_payable_cheque[encashed_date]"/>    </td>
							            </tr>
							            <tr  style="background-color: #ffffff; color:black;" class="selected">
                                            <td>Action:</td>
								            <td colspan="5" align="center" width="40%"><?=$_VIEW['row.status_form']?>   </td>
							            </tr>
							            
		                                        
			                        </table>
                            </td>
                        </tr>
                        <tr class="<?=$_VIEW['status_class']?>">
                            <td>Remarks :</td>
                            <td colspan="3"><textarea style="width:100%; height:100px;" name="remark[str][remark_content]"></textarea></td>
                        </tr>  
                        <tr>
                            <td colspan="4" align="center">
                                <div class="pad_standard">
                                    <a href="#" class="link_button_inline gray <?=$_VIEW['status_class']?> " onclick="go_to('/finance_disbursement/cheque_status/')">Cancel</a>
                                    <a href="#" class="link_button_inline blue <?=$_VIEW['status_class']?>" onclick="submit_form('alsc_form')">Submit</a>
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