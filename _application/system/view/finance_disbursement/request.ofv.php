<div id="content_body">    
       
   <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0;">    
        <div class="mar_custom align_center" style="padding-bottom: 5px;" id="controls">

            <span class="mar_h">Choose request type: </span>
            <a href="/finance_disbursement/request/tba" class="link_button_inline blue" >TBA</a>
            <a href="/finance_disbursement/request/request_for_payment" class="link_button_inline blue" >RFP</a>
            <a href="/finance_disbursement/request/ofv" class="link_button_inline green" >OFV</a>
        </div>  
     
        <div style="overflow: auto; padding-top: 20px;" id="_right_content_">  <!--set max-height by making it dynamic -->              
                                          
           <form action="/finance_disbursement/request/submit_add_ticket" name="alsc_form" method="post">
            <input type="hidden" value="ofv" name="payable[str][request_type_id]"/>
            <input type="hidden" value="N/A" name="payable[str][request_accounted_to]"/>
            <input type="hidden" value="check" name="payable[str][option_payment_method_id]"/>
            <input type="hidden" value="OFV - Replenishment" name="payable[str][request_purpose]"/>
            <input type="hidden" value="<?=$_VIEW['_user_']['user_name']?> <?=$_VIEW['_user_']['user_surname']?>" name="payable[str][request_recommended_by]"/>
                <table class="mar_custom" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
                    <thead>
                        <tr>
                            <td><h1>OFV</h1></td>
                            <td colspan="3"><h1>ID No. 15236</h1></td>
                        </tr>
                    </thead>

                    <tbody>
                       
                        <tr>                        
                            <td>Request Date:</td>
                            <td><span><?=string_date_time(time())?></span></td>
                            <td><input type="hidden" value="<?=time()?>" name="payable[int][account_payable_timestamp]"/></td>
                            <td><span></span></td>
                        </tr>
                        <tr>
                            <td>Department : </td>
                            <td>
                                <select name="payable[str][option_department_id]">
                                    <option value="x" disabled selected>Choose department</option>
                                    <?=$_VIEW['dept_option']?>
                                </select>
                            </td>
                            <td>Prepared by :</td>    
                            <td>
                               <input type="text" name="payable[str][request_requestor]" />
                            </td>
                        </tr>
                        <tr>
                            <td>Amount :</td>
                            <td><input type="text" name="payable[int][request_amount]" value="<?=$_VIEW['trans.total']?>"/></td>
                            <td></td>
                            <td>
                            </td>
                        </tr>
                        
                         <tr>                        
                            <td colspan="4">
                                <table class="mar_custom bg_fff" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">
                                    <tr style="background-color: #888888; color:#ffffff;">
                                        <td width="10%">OFV Number</td>
                                        <td width="50%">Requested by:</td>
                                        <td>Date Released</td>
                                        <td>Amount</td>
                                    </tr>
                                    <?=$_VIEW['trans.row']?>
                                     <tr style="background-color:#ffffff;">
                                        <td colspan="3" align="right" class="bold">TOTAL</td>
                                        <td class="bold">P  <?=$_VIEW['trans.total']?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="4" align="center">
                                <div class="pad_standard">
                                    <a href="#" class="link_button_inline gray" onclick="go_to('/finance_disbursement/request/')">Cancel</a>
                                    <a href="#" class="link_button_inline blue" onclick="submit_form('alsc_form')">Submit</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table> 
            </form>
           
            
            
            
            
            <label style="margin-bottom:20px;"></label>          
            
        </div>    
    </div>
    <label></label>

</div>

<script type="text/javascript">

var row_num  = 0;  
var item_num = 0;  
var row_htm;
var row_qty;
var row_desc;
var row_price;
var row_amt;
var cur_row;
var row_tot = 0;
var row_del_amt = 0;
var param;

    function show_req_menu()
    {
        $('#req_menu').removeClass('display_none');
    }
    
   
    
     function del_row(r_num)
    {
        item_num--;
        row_del_amt =   string_amount($('#'+r_num+'_amt').val());
        row_tot     =   row_tot - row_del_amt;
        $('#_total').html("P "+string_amount(row_tot,true));
        $('#_item_num').html(item_num);
        $('#r_'+r_num).remove();
    }
    
     function comp_amt()
    {
        row_qty         =  string_amount($('#_qty').val());
        row_price       =  string_amount($('#_price').val());
        $('#_amt').val(row_price*row_qty);
    }
    
    function add_row()
    {
        item_num++;
        row_qty         =  $('#_qty').val();
        row_desc        =  $('#_desc').val();
        row_price       =  string_amount($('#_price').val(),true);
        row_amt         =  string_amount($('#_amt').val(),true);
        cur_row         =  row_num+1;
        row_tot         =  string_amount(row_tot) + string_amount(row_amt);
        row_htm         = "  <tr id=\"r_"+cur_row+"\" style=\"background-color:#ffffff;\"><td align=\"center\">"+row_qty+"</td><td>"+row_desc+"</td><td>P "+row_price+"</td><td>P "+row_amt+"</td> <td align=\"center\"><a onclick=\"del_row("+cur_row+")\" class=\"link_button_inline red\">X</a></td><input id=\""+cur_row+"_amt\" type=\"hidden\" value=\""+row_amt+"\" name=\"ticket_item["+cur_row+"][int][account_payable_item_amount]\"/><input type=\"hidden\" value=\""+row_price+"\" name=\"ticket_item["+cur_row+"][int][account_payable_item_price]\"/><input type=\"hidden\" value=\""+row_qty+"\" name=\"ticket_item["+cur_row+"][int][account_payable_item_qty]\"/><input type=\"hidden\" value=\""+row_desc+"\" name=\"ticket_item["+cur_row+"][str][account_payable_item_desc]\"/> </tr>";
        $('#_total').html("P "+string_amount(row_tot,true));
        $('#_item_num').html(item_num);
        if($('#r_'+row_num).length)
        {
            $('#r_'+row_num).after(row_htm); 
        }
        else
        {
            $('#_inp_head').after(row_htm); 
        }
       
        $('#_qty').val('');
        $('#_desc').val('');
        $('#_price').val('');
        $('#_amt').val('');
        row_num         = cur_row;
    }

</script>