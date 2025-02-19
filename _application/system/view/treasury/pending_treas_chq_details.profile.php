<div id="content_body">    
    <?=$_VIEW['side_nav']?>   
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">     
     
        <div style="overflow: auto; width:100%;" id="_right_content_">  <!--set max-height by making it dynamic -->                        
            <form action="/treasury/cheque_details/submit_update_ticket" name="alsc_form" method="post">
            <input type="hidden" name="payable_ticket[int][account_payable_id]" value="<?=$_VIEW['account_payable_id']?>" />
            <input type="hidden" name="payable_ticket[str][request_type_id]" value="<?=$_VIEW['request_type_id']?>" />
            <input type="hidden" name="option_payment_method_id" value="<?=$_VIEW['option_payment_method_id']?>" />
            <input type="hidden" name="is_reimbursement" value="<?=$_VIEW['is_reimbursement']?>" />
            <input type="hidden" name="reimbursement_amount" value="<?=$_VIEW['reimbursement_amount']?>" />
            <input type="hidden" name="remark[str][remark_key]" value="account_payable" />

            <?=$_VIEW['profile.ticket']?>
           <?=$_VIEW['profile.cdv']?>
            <table class="mar_custom <?=$_VIEW['status_view']?>" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
                <tr class="selected">
                    <td>Action :</td>
                    <td>
                        <select style="float:left;" name="payable_ticket[str][request_approval_status_id]">
                            <option value="ready">Ready</option>
                            <option value="revoked">Revoke</option>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                    <td> 
                        
                    </td>
                </tr>    
                <tr>
                    <td colspan="5" align="center">
                         <table class="mar_custom bg_fff" id="_account_" style="font-weight:normal;" width="100%" cellpadding="10" cellspacing="0" border="0">
                            <!-- use if CASH -->
                            <tr style="background-color:#ffffff;" class="_payment _cash <?=$_VIEW['cash_payment_class']?>">
                                <td class="border_top_gray">Release Date :</td>
                                <td class="border_top_gray"><input type="text" name="request_release_date" class="_date_"/></td>
                                <td class="border_top_gray"></td>
                                <td class="border_top_gray">OR No. :</td>
                                <td class="border_top_gray"><input type="text" name="account_payable_ofv[str][account_payable_ofv_or_number]"/></td>
                                <input type="hidden" name="account_payable_ofv[int][account_payable_ofv_amount]" value="<?=$_VIEW['request_approved_amount']?>">
                            </tr>
                            <tr style="background-color:#ffffff;" class="_payment _cash <?=$_VIEW['cash_payment_class']?>">
                                <td>PO No. :</td>
                                <td><input type="text" name="account_payable_ofv[str][account_payable_ofv_po_number]"/></td>
                                <td></td>
                                <td>COV No. :</td>
                                <td><input type="text" name="account_payable_ofv[str][account_payable_ofv_cov_number]"/></td>
                            </tr>
                             
                             <!-- use if CHEQUE -->
                             <tr id="_show_row" class="_payment _cheq <?=$_VIEW['chq_payment_class']?>">
		                        <td colspan="4" align="center">
                        			<table class="mar_custom bg_fff" id="_chq_tbl" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">
		                                <tr id="_inp_head" style="background-color: #2D5788; color:#ffffff;">
		                                    <td width="15%" align="center">Cheque Date</td>
		                                    <td width="30%" align="center">Bank</td>
		                                    <td width="15%" align="center">PO No.</td>
		                                    <td width="15%" align="center">OFV No.</td>
		                                    <td width="20%" align="center">Cheque Amount</td>
		                                    <td width="5%"></td>
		                                </tr>
		                                
		                                
		                               <?=$_VIEW['row.account_cheque']?>            
			                        </table>
		                            <label class="mar_standard"></label>
		                            
		                           
		                        </td>
		                    </tr><!-- end cheque row -->
                        </table>
                    
                    </td>
                </tr>
                <tr>
                    <td>Remarks :</td>
                    <td colspan="4"><textarea style="width:100%; height:100px;" name="remark[str][remark_content]"></textarea></td>
                </tr>  
                <tr>
                    <td colspan="5" align="center">
                        <div class="pad_standard">
                            <a href="#" class="link_button_inline gray" onclick="go_to('/treasury/cheque_details/')">Cancel</a>
                            <a href="#" class="link_button_inline blue" onclick="submit_form('alsc_form')">Submit</a>
                        </div>
                    </td>
                </tr>     
            </table>  

            </form>
            <label style="margin-bottom: 60px;"></label>                 
            
        </div>    
    </div>
    <label></label>

</div>
<script type="text/javascript">
var row_num = 0;  
var chq_num = 0;  
var row_htm;
var row_bank;
var row_date;
var row_amt;
var amt_tot = 0;
var row_po;
var row_ofv;
var cur_row;
var param;
var row_del_amt;

 
    
     function del_row(r_num)
    {
        chq_num--;
        row_del_amt =   string_amount($('#'+r_num+'_amt').val());
        amt_tot     =   amt_tot - row_del_amt;
        $('#_total').html("P "+string_amount(amt_tot,true));
        $('#_chq_num').html(chq_num);
        $('#r_'+r_num).remove();
    }
    
    function chq_add(r_num)
    {
        $('#_show_row').removeClass("display_none");
        $('#_add_chq').addClass("display_none");
    }
    

    
    function add_row()
    {
        chq_num++;
        row_date         =  $('#_date').val();
        row_bank         =  $('#_bank').val();
        row_po           =  $('#_po').val();
        row_amt          =  $('#_amt').val();
        row_ofv          =  $('#_ofv').val();
        cur_row          =  row_num+1;
        amt_tot          =  string_amount(amt_tot) + string_amount(row_amt);
        row_htm          = "  <tr id=\"r_"+cur_row+"\" style=\"background-color:#ffffff;\"><td align=\"center\">"+row_date+"</td><td>"+row_bank+"</td><td>"+row_po+"</td><td>"+row_ofv+"</td><td>P "+string_amount(row_amt,true)+"</td><td align=\"center\"><a class=\"link_button_inline red\" onclick=\"del_row("+cur_row+")\">X</a></td><input id=\""+cur_row+"_amt\" type=\"hidden\" value=\""+row_amt+"\" name=\"account_cheque["+cur_row+"][int][account_payable_cheque_amount]\"/><input type=\"hidden\" value=\""+row_bank+"\" name=\"account_cheque["+cur_row+"][str][account_payable_cheque_bank]\"/><input type=\"hidden\" value=\""+row_po+"\" name=\"account_cheque["+cur_row+"][str][account_payable_cheque_po_number]\"/><input type=\"hidden\" value=\""+row_ofv+"\" name=\"account_cheque["+cur_row+"][str][account_payable_cheque_ofv]\"/><input type=\"hidden\" value=\""+row_date+"\" name=\"account_cheque["+cur_row+"][str][account_payable_cheque_timestamp]\"/> </tr>";
        
        $('#_total').html("P "+string_amount(amt_tot,true));
        $('#_chq_num').html(chq_num);
        if($('#r_'+row_num).length)
        {
            $('#r_'+row_num).after(row_htm); 
        }
        else
        {
            $('#_inp_head').after(row_htm); 
        }
       
        $('#_date').val('');
        $('#_bank').val('');
        $('#_po').val('');
        $('#_ofv').val('');
        $('#_amt').val('');
        row_num         = cur_row;
    }   
    
    
    

</script>