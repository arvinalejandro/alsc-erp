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
		                            </tr>
		                             <tr id="_inp_head" style="background-color: #ffffff; color:#2D5788;">
		                                <td width="20%" align="center"><?=string_date($_VIEW['request_release_date'])?></td>
		                                <td width="25%"><?=$_VIEW['request_or_number']?></td>
		                                <td width="15%"><?=$_VIEW['request_po_number']?></td>
		                                <td width="15%"><?=$_VIEW['request_cov_number']?></td>
		                            </tr>
			                    </table>
                            </td>
                        </tr>
                        
                        <tr class="display_none">
                            <td colspan="4">
                                <table border="0" width="90%" class="mar_custom" cellpadding="5" cellspacing="0" style="font-weight: normal; margin:40px auto;">
                                    <thead>
                                        <tr>
                                            <td colspan="3" style="background-color: #2D5788; border: 0;">
                                                <div style="width: 100px;" class="float_left mar_h">Particulars :</div>
                                                <div class="float_left">
                                                    Payment for rentals of heavy equipment as of March 2014
                                                </div>
                                                <label></label>
                                            </td>
                                        </tr>
                                        <tr align="center">
                                            <td style="background-color:#888888; border: 0;">Account Name</td>
                                            <td colspan="2" style="background-color:#888888; border: 0;">Amount</td>
                                        </tr>
                                        <tr style="color:#282f39; background-color: #ffffff;" align="center">
                                            <td></td>
                                            <td style="border-left:1px solid #888888;">Debit</td>
                                            <td style="border-left:1px solid #888888;">Credit</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="color:#282f39; background-color: #ffffff;">
                                            <td>dc-land gr1 road preparation</td>
                                            <td align="right" style="border-left:1px solid #888888;">P2,000.00</td>
                                            <td align="right" style="border-left:1px solid #888888;"></td>
                                        </tr>
                                        <tr style="color:#282f39; background-color: #ffffff;">
                                            <td>dc-land dch1 road preparation</td>
                                            <td align="right" style="border-left:1px solid #888888;">P2,000.00</td>
                                            <td align="right" style="border-left:1px solid #888888;"></td>
                                        </tr>
                                        <tr style="color:#282f39; background-color: #ffffff;">
                                            <td>dc-land wgr2 road preparation</td>
                                            <td align="right" style="border-left:1px solid #888888;">P6,000.00</td>
                                            <td align="right" style="border-left:1px solid #888888;"></td>
                                        </tr>
                                        <tr style="color:#282f39; background-color: #ffffff;">       
                                            <td style="text-indent: 30px;">Cash in Bank</td>
                                            <td align="right" style="border-left:1px solid #888888;"></td>
                                            <td align="right" style="border-left:1px solid #888888;">P8,800.00</td>
                                        </tr>
                                        <tr style="color:#282f39; background-color: #ffffff;">        
                                            <td style="text-indent: 30px;">Tax</td>
                                            <td align="right" style="border-left:1px solid #888888;"></td>
                                            <td align="right" style="border-left:1px solid #888888;">1,200.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            
                            </td>
                        </tr>
                   
                   
                        <tr>
                            <td colspan="4" align="center">
                                <table width="40%" cellpadding="10" cellspacing="0">
                                    <tr class="selected">
                                        <td class="border_top_gray">Action :</td>
                                        <td class="border_top_gray">
                                            <select style="float:left;" name="payable[str][request_approval_status_id]">
                                                <option value="approved">Approve</option>
                                                <option value="declined">Decline</option>
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
                                    <a href="#" class="link_button_inline gray" onclick="go_to('/finance_accounting/reconciliation/')">Cancel</a>
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