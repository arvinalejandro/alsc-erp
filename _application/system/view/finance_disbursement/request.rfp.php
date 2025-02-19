<div id="content_body">    
       
   <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0;">    
        <div class="mar_custom align_center" style="padding-bottom: 5px;" id="controls">

            <span class="mar_h">Choose request type: </span>
            <a href="/finance_disbursement/request/tba" class="link_button_inline blue" >TBA</a>
            <a href="/finance_disbursement/request/request_for_payment" class="link_button_inline green" >RFP</a>
            <a href="/finance_disbursement/request/ofv" class="link_button_inline blue" >OFV</a>
        </div>  
     
        <div style="overflow: auto; padding-top: 20px;" id="_right_content_">  <!--set max-height by making it dynamic -->              
                                          
            <form action="/finance_disbursement/request/submit_add_ticket" name="alsc_form" method="post">
                <input type="hidden" value="rfp" name="payable[str][request_type_id]"/>
                <table class="mar_custom" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
                    <thead>
                        <tr>
                            <td><h1>Request For Payment</h1></td>
                            <td colspan="3"><h1>ID No. 15236</h1></td>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr>                        
                            <td>Date Requested :</td>
                            <td><span><?=string_date_time(time())?>  <input type="hidden" value="<?=time()?>" name="payable[int][account_payable_timestamp]"/></span></td>
                            <td>Recommended by :</td>
                            <td><span><?=$_VIEW['_user_']['user_name']?> <?=$_VIEW['_user_']['user_surname']?><input type="hidden" value="<?=$_VIEW['_user_']['user_name']?> <?=$_VIEW['_user_']['user_surname']?>" name="payable[str][request_recommended_by]"/></span></td>
                        </tr>
                        <tr>                        
                            <td>Department :</td>
                            <td> 
                                <select name="payable[str][option_department_id]">
                                    <option value="x" disabled selected>Choose department</option>
                                    <?=$_VIEW['dept_option']?>
                                </select>
                            </td>
                             <td width="15%">Requestor :</td>
                            <td><input type="text" name="payable[str][request_requestor]" /></td>
                        </tr>
                        <tr>                        
                            <td>Amount Requested :</td>
                            <td><input type="text" name="payable[int][request_amount]"/></td>                        
                            <td>Date Needed :</td>
                            <td><input id="_date" type="text" class="_date_" name="payable[str][request_date_needed]"/></td>  
                        </tr>
                        <tr>
                            <td>Purpose :</td>
                            <td colspan="3"><input type="text" name="payable[str][request_purpose]"/></td>
                        </tr>
                        <tr>                        
                            <td colspan="4">
                                <table class="mar_custom bg_fff" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">
                                    <tr id="_inp_head" style="background-color: #2D5788; color:#ffffff;">
                                        <td align="center" width="10%">Qty</td>
                                        <td width="50%">Item Description</td>
                                        <td>Price</td>
                                        <td colspan="2">Amount</td>
                                    </tr>

                                    <tr style="background-color:#ffffff;">
                                        <td id="_item_num" align="center">0</td>
                                        <td>item/s</td>
                                        <td align="right" class="bold color_green">TOTAL : </td>
                                        <td colspan="2" id="_total" class="bold color_green">P 0.00</td>
                                    </tr>    
                                </table>
                                <label class="mar_standard"></label>

                                <table class="mar_custom bg_fff" id="" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">
                                    <tr style="background-color: #888888; color:#ffffff;">
                                        <td align="center" width="10%">Qty</td>
                                        <td width="50%">Description</td>
                                        <td align="left">Price</td>
                                        <td align="left">Amount</td>
                                    </tr>
                                    <tr class="selected">
                                        <td ><input id="_qty" type="text" onfocus="selet_entry(this)" onchange="comp_amt()" onkeyup="comp_amt()" /></td>
                                        <td><input id="_desc" type="text" onfocus="selet_entry(this)" /></td>
                                        <td><input id="_price" type="text" onchange="comp_amt()" onfocus="selet_entry(this)" value="0.00" onkeyup="comp_amt()" /></td>
                                        <td><input id="_amt" type="text"  readonly/></td>
                                    </tr>
                                    <tr style="background-color:#ffffff;">
                                        <td colspan="4" align="center"><a href="#" class="link_button_inline green" onclick="add_row()">+ Add to List</a></td>
                                    </tr>                              
                                </table>
                            </td>
                        </tr>
                        <tr>                        
                            <td>Payable to :</td>
                            <td><span><input type="text" name="payable[str][request_payable_to]"/></span></td>                        
                            <td>Address :</td>
                            <td><input type="text" name="payable[str][request_address]"/></td>
                        </tr>
                        <tr>                        
                            <td>Accounted to :</td>
                            <td><input type="text" name="payable[str][request_accounted_to]"/></td> 
                            <td>TIN :</td>
                            <td><input type="text" name="payable[str][request_tin]"/></td>                       
                        </tr>
                        <tr>                        
                            <td>Payment Form:</td>
		                    <td colspan="3"> 
		                        <select id="_pmform" name="payable[str][option_payment_method_id]">
		                            <option value="x" disabled selected>Choose payment form</option>
		                            <?=$_VIEW['payment_option']?>
		                        </select>
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
    
    function selet_entry(pElem)
    {
        $(pElem).select();
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
        row_htm         = "  <tr id=\"r_"+cur_row+"\" style=\"background-color:#ffffff;\"><td align=\"center\">"+row_qty+"</td><td>"+row_desc+"</td> ";
        row_htm        += "<td>P "+row_price+"</td><td>P "+row_amt+"</td>";
        row_htm        += "<td align=\"center\"><a onclick=\"del_row("+cur_row+")\" class=\"link_button_inline red\">X</a></td>";
        row_htm        += "<input id=\""+cur_row+"_amt\" type=\"hidden\" value=\""+row_amt+"\" name=\"ticket_item["+cur_row+"][int][account_payable_item_amount]\"/>";
        row_htm        += "<input type=\"hidden\" value=\""+row_price+"\" name=\"ticket_item["+cur_row+"][int][account_payable_item_price]\"/>";
        row_htm        += "<input type=\"hidden\" value=\""+row_qty+"\" name=\"ticket_item["+cur_row+"][int][account_payable_item_qty]\"/>";
        row_htm        += "<input type=\"hidden\" value=\""+row_desc+"\" name=\"ticket_item["+cur_row+"][str][account_payable_item_desc]\"/> </tr>";
       
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