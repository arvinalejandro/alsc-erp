<div id="content_body">    
    <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" class="pad_standard" style="margin-left:180px;">     
     
        <div style="overflow: auto; width:100%;" id="_right_content_">  <!--set max-height by making it dynamic -->                        
            <form action="/finance_disbursement/executive_approval/submit_update_ticket" name="alsc_form" method="post">
            <input type="hidden" name="payable[int][account_payable_id]" value="<?=$_VIEW['account_payable_id']?>" />
            <input type="hidden" id="_req_type_" name="payable[str][request_type_id]" value="<?=$_VIEW['request_type_id']?>" />
            <input type="hidden" name="remark[str][remark_key]" value="account_payable" />
            <input type="hidden" name="request_amount" value="<?=$_VIEW['request_amount']?>" />
            <?=$_VIEW['profile.ticket']?>
            <table class="mar_custom <?=$_VIEW['status_view']?>" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">                                                 <tr class="selected">
                   <tr class="selected <?=$_VIEW['ofv_class']?>" >                        
                        <td>Payment Form:</td>
		                <td> 
		                    <select id="_pmform" name="payment[str][option_payment_method_id]" onchange="p_form()">
		                        <option value="x"></option>
		                        <?=$_VIEW['payment_option']?>
		                    </select>
		                </td>                      
                    </tr>
                     <tr class="<?=$_VIEW['cash_payment_class']?> _payment_method _ofv_balance">                        
                        <td>OFV Balance:</td>
		                <td> 
		                      P  <?=$_VIEW['ofv_balance_amount']?>
		                </td>                      
                    </tr>
                    <tr class="<?=$_VIEW['tba_class']?>">                        
                        <td>Modify Amount:</td>
		                <td> 
		                    <input type="text" name="modified_amount">
		                </td>                      
                    </tr>
                   <tr class="selected">   
                        <td>Action :</td>
                        <td>
                            <select style="float:left;" name="payable[str][request_approval_status_id]">
                                <option value="approved">Approve</option>
                                <option value="declined">Decline</option>
                            </select>
                        </td>
                    </tr>  
                    <tr id="_show_row" class="">
		                <td align="center" colspan="2">
                        	<table class=" <?=$_VIEW['chq_payment_class']?> mar_custom bg_fff _payment_method _cheq_method" id="_chq_tbl" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">
		                        <tr id="_inp_head" style="background-color: #2D5788; color:#ffffff;" align="center">
		                            <td>Cheque Date</td>
		                            <td align="right">Cheque Amount</td>
                                    <td>Bank</td>
		                            <td width="40"></td>
		                        </tr>
		                        <tr style="background-color:#ffffff;">
		                            <td align="center"><span id="_chq_num" class="bold">0</span> Cheque/s</td>
		                            <td align="right" class="bold color_green">
                                        TOTAL :
                                        <span class="bold color_green" id="_total">P 0.00</span>
                                    </td>
                                    <td colspan="2"></td>
		                        </tr>               
			                </table>
		                    <label class="mar_standard"></label>
		                    
		                    <table class=" <?=$_VIEW['chq_payment_class']?> mar_custom bg_fff _payment_method _cheq_method" id="" style="font-weight:normal;" width="97%" cellpadding="5" cellspacing="0" border="0">
		                        <thead>
		                            <tr id="_inp_head" style="background-color: #888888; color:#ffffff;" align="center">
		                                <td>Cheque Date</td>
                                        <td>Cheque Amount</td>
		                                <td>Bank</td>
		                            </tr>
		                        </thead>
		                        <tr id="" class="selected _add_chq_btn">
		                             <td><input id="_date" type="text" class="_date_"/></td>
                               

                                    <td><input id="_amt" type="text" /></td>
		                            <td><select id="_bank">
		                            <option></option>
														<?=$_VIEW['bank_opt']?>
														</select></td>
		                        </tr>
		                        <tr  style="background-color:#ffffff;" class="_add_chq_btn">
		                            <td colspan="3" align="center"><a href="#" class="link_button_inline blue" onclick="add_row()">+ Add Cheque to List</a></td>
		                        </tr>                           
		                    </table>
		                    
		                    
		                    
		                </td>
		            </tr> 
                       
                    
                    <tr>
                        <td>Remarks :</td>
                        <td><textarea style="width:100%; height:100px;" name="remark[str][remark_content]"></textarea></td>
                    </tr>  
                    <tr>
                        <td colspan="4" align="center">
                            <div class="pad_standard">
                                <a href="#" class="link_button_inline gray" onclick="go_to('/finance_disbursement/executive_approval/')">Cancel</a>
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
var bank_name;
var bank_id;
var row_date;
var row_amt;
var amt_tot = 0;
var row_po;
var row_ofv;
var cur_row;
var param;
var row_del_amt;

    function p_form()
    {
        param  =   $('#_pmform').val();
        $('._payment_method').addClass('display_none');
        if(param == 'check')
        {
            $('._cheq_method').removeClass('display_none'); 
        }
        else
        {
			$('._ofv_balance').removeClass('display_none'); 
        }
        
    }
    
     function del_row(r_num)
    {
        chq_num--;
        row_del_amt =   string_amount($('#'+r_num+'_amt').val());
        amt_tot     =   amt_tot - row_del_amt;
        $('#_total').html("P "+string_amount(amt_tot,true));
        $('#_chq_num').html(chq_num);
        $('#r_'+r_num).remove();
        
        if($('#_req_type_').val() == 'tax' || $('#_req_type_').val() == 'ofv')
        {
			if(chq_num == 0)
			{
				$('._add_chq_btn').removeClass("display_none");
			}
        }
    }
    
    function chq_add(r_num)
    {
        $('#_show_row').removeClass("display_none");
        $('#_add_chq').addClass("display_none");
    }
    

    
    function add_row()
    {
        // row_po         =  $('#_po').val();
        // row_ofv          =  $('#_ofv').val();
        chq_num++;
        row_date         =  $('#_date').val();
        bank_id          =  $('#_bank').val();
        bank_name        =  $('#_bank option:selected').text();
        row_amt          =  $('#_amt').val();
        cur_row          =  row_num+1;
        amt_tot          =  string_amount(amt_tot) + string_amount(row_amt);
        row_htm          = "<tr id=\"r_"+cur_row+"\" style=\"background-color:#ffffff;\"><td align=\"center\">"+row_date+"</td>";
        row_htm         += "<td align=\"right\">P "+string_amount(row_amt,true)+"</td><td align=\"center\">"+bank_name+"</td>"; 
        row_htm         += "<td align=\"center\"><a class=\"link_button_inline red\" onclick=\"del_row("+cur_row+")\">X</a></td>"; 
        row_htm         += "<input id=\""+cur_row+"_amt\" type=\"hidden\" value=\""+row_amt+"\" name=\"account_cheque["+cur_row+"][int][account_payable_cheque_amount]\"/>"; 
        row_htm         += "<input type=\"hidden\" value=\""+row_date+"\" name=\"account_cheque["+cur_row+"][str][account_payable_cheque_date]\"/>"; 
        row_htm         += "<input type=\"hidden\" value=\""+bank_id+"\" name=\"account_cheque["+cur_row+"][int][bank_id]\"/> </tr>"; 
         
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
        
        if($('#_req_type_').val() == 'tax' || $('#_req_type_').val() == 'ofv')
        {
			if(chq_num ==1)
			{
				$('._add_chq_btn').addClass("display_none");
			}
        }
       
        $('#_date').val('');
        //$('#_bank').val('');
       // $('#_po').val('');
        //$('#_ofv').val('');
        $('#_amt').val('');
        row_num         = cur_row;
    }   
    
    

</script>
