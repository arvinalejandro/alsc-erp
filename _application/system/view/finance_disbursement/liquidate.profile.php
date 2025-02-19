<div id="content_body">    
       
   <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" class="pad_standard" style="margin-left:180px;">     
    
        <div style="overflow: auto; width:100%;" id="_right_content_">  <!--set max-height by making it dynamic -->           
            <br/>            
                                          
            <form action="/finance_disbursement/liquidate/submit_update_ticket" name="alsc_form" method="post">
            <input type="hidden" name="payable[int][account_payable_id]" value="<?=$_VIEW['account_payable_id']?>" />
            <input type="hidden" name="payable[str][request_type_id]" value="<?=$_VIEW['request_type_id']?>" />
            <input type="hidden" name="remark[str][remark_key]" value="account_payable" />
            <?=$_VIEW['profile.ticket']?>
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

                <tr>
                    <td colspan="4" align="center">
                        <table class="mar_custom bg_fff" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">
                            <tr style="background-color: #888888; color:#ffffff;">
                                <td align="center" width="10%">Qty</td>
                                <td width="50%">Description</td>
                                <td align="left">Price</td>
                                <td align="left">Amount</td>
                            </tr>
                            <tr class="selected">
                                <td ><input id="_qty" type="text" onkeyup="comp_amt()" onfocus="selet_entry(this)" onchange="comp_amt()" value="0"/></td>
                                <td><input id="_desc" type="text" onfocus="selet_entry(this)" /></td>
                                <td><input id="_price" type="text" onkeyup="comp_amt()" value="0.00" onfocus="selet_entry(this)" onchange="comp_amt()"/></td>
                                <td><input id="_amt" type="text" value="0.00" readonly/></td>
                            </tr>
                            <tr style="background-color:#ffffff;">
                                <td colspan="4" align="center"><a href="#" class="link_button_inline green" onclick="add_row()">+ Add to List</a></td>
                            </tr>                              
                        </table>
                    </td>
                </tr>
                        
                        
                <tr>
                    <td colspan="4" align="center">
                        <table id="_inp_head_table" class="mar_custom bg_fff" id="" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">
					        <tr id="_inp_head" style="background-color: #2D5788; color:#ffffff;">
                                <td align="center" width="10%">Qty</td>
                                <td width="50%">Item Description</td>
                                <td width="15%" align="right">Price</td>
                                <td width="15%" align="right">Amount</td>
                                <td width="5%"></td>
                                <td width="5%"></td>
                            </tr>   
					    </table>

                        <table class="mar_custom bg_fff" id="" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">   
                            <tr style="background-color:#ffffff;">
                                <td id="_item_num" align="center" width="10%">0</td>
                                <td>item/s</td>
                                <td align="right" class="bold color_green font_size_18">TOTAL : </td>
                                <td colspan="3" id="_total" class="bold color_green font_size_18">P 0.00</td>
                            </tr>  
                        </table>
                        
                        <table class="mar_custom" id="" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">
                            <tr style="background-color:#ffffff;">
                                <td width="20%">Set Reimbursement :</td>
                                <td>
                                    <div class="radio_group">
                                        <input type="radio" class="radio" name="set_reimburse" id="radio1" value="1" onclick="show_reimburse()" />
                                        <label for="radio1">Yes</label>
                                    </div>
                                    <div class="radio_group">
                                        <input type="radio" class="radio" name="set_reimburse" id="radio2" value="0" checked="checked" onclick="show_reimburse()" />
                                        <label for="radio2">No</label>
                                    </div>
                                </td>
                                <td class="dummy_"></td>
                                <td align="right" class="reimburse_ display_none">Amount:</td>
                                <td colspan="2" class="reimburse_ display_none"><input type="text" name="reimburse_amount" value="0" /></td> 
                            </tr>

                            <tr class="selected">
                                <td>Action :</td>
                                <td align="center" colspan="3">
                                    <select style="float:left;" name="payable[str][request_approval_status_id]">
                                        <option selected="" disabled="" value="0">Choose Action</option>
                                        <option value="approved">Approve</option>
                                        <option value="declined">Decline</option>
                                    </select>
                                </td>
                            </tr> 
                            <tr class="selected">
                                <td class="border_top_gray">Particulars :</td>
                                <td class="border_top_gray" colspan="3">
                                    <input type="text" id="_particulars" value="" onkeydown="disp_particulars()" onchange="disp_particulars()" name='particulars'>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="bg_fff">
                                    <table border="0" width="90%" class="mar_custom" cellpadding="5" cellspacing="0" style="font-weight: normal; margin:40px auto;">
                                        <thead>
                                            <tr>
                                                <td colspan="3" style="background-color: #2D5788; border: 0;">
                                                    <div style="width: 100px;" class="float_left mar_h">Particulars :</div>
                                                    <div class="float_left" id="_display_particulars">
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
                                            <tr id="cdv_form" style="color:#282f39; background-color: #ffffff;" class="display_none">
                                                <td>dc-land gr1 road preparation</td>
                                                <td align="right" style="border-left:1px solid #888888;">P2,000.00</td>
                                                <td align="right" style="border-left:1px solid #888888;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg_fff">Remarks :</td>
                                <td colspan="3" class="bg_fff"><textarea style="width:100%; height:100px;" name="remark[str][remark_content]"></textarea></td>
                            </tr> 
                        <tr>
                            <td colspan="4" align="center">
                                <div class="pad_standard">
                                    <a href="#" class="link_button_inline gray" onclick="go_to('/finance_disbursement/liquidate/')">Cancel</a>
                                    <a href="#" class="link_button_inline blue" onclick="submit_form('alsc_form')">Submit</a>
                                </div>
                            </td>
                        </tr>
                        </table> 
                    </td>
                </tr>
                </table>            
            </form>
            
            <label></label>                 
            
        </div>    
    </div>
    <label></label>

</div>

<script type="text/javascript">

 function show_reimburse()
    {
        sc_val		    =  $( "input:radio[name=set_reimburse]:checked" ).val();
        if(sc_val ==1)
        {            
            $('.reimburse_').removeClass("display_none");
             $('.dummy_').addClass("display_none");
           
        }
        else
        {            
           $('.reimburse_').addClass("display_none");
            $('.dummy_').removeClass("display_none");
        }
    }
//==================================================================
//for ITEM functions
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

     function del_item(r_num)
    {
        item_num--;
        row_del_amt =   string_amount($('#'+r_num+'_amt').val());
        row_tot     =   row_tot - row_del_amt;
        $('#_total').html("P "+string_amount(row_tot,true));
        $('#_item_num').html(item_num);
        $('#item_table_'+r_num).remove();
        $('#detail_parent_row_'+r_num).remove();
        display_cdv();
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
        row_htm         = "<table id=\"item_table_"+cur_row+"\" class=\"mar_custom bg_fff\" width=\"90%\" cellpadding=\"5\" cellspacing=\"0\" border=\"0\">";
        row_htm        += " <tr  id=\"r_"+cur_row+"\" style=\"background-color:#ffffff;\">";
        row_htm        += " <td align=\"center\" width=\"10%\">"+row_qty+"</td>";
        row_htm        += " <td width=\"50%\">"+row_desc+"</td>";
        row_htm        += " <td width=\"15%\" align=\"right\">P "+row_price+"</td>";
        row_htm        += " <td width=\"15%\" align=\"right\">P "+row_amt+"</td> ";
        row_htm        += " <td width=\"5%\" align=\"right\"><a onclick=\"get_detail_row("+cur_row+")\" class=\"link_button_inline green\">+</a></td>";
        row_htm        += " <td width=\"5%\"><a onclick=\"del_item("+cur_row+")\" class=\"link_button_inline red\">X</a></td>";
        row_htm        += " <input id=\""+cur_row+"_amt\" type=\"hidden\" value=\""+row_amt+"\" name=\"ticket_item["+cur_row+"][int][account_payable_item_amount]\"/>";
        row_htm        += " <input type=\"hidden\" value=\""+row_price+"\" name=\"ticket_item["+cur_row+"][int][account_payable_item_price]\"/>";
        row_htm        += " <input type=\"hidden\" value=\""+row_qty+"\" name=\"ticket_item["+cur_row+"][int][account_payable_item_qty]\"/>";
        row_htm        += " <input type=\"hidden\" value=\""+row_desc+"\" name=\"ticket_item["+cur_row+"][str][account_payable_item_desc]\"/>";
        row_htm        += " <input type=\"hidden\" value=\""+cur_row+"\" name=\"ticket_item["+cur_row+"][int][item_number]\"/> ";
         row_htm        += "</tr></table>";
        // alert(row_htm);
        $('#_total').html("P "+string_amount(row_tot,true));
        $('#_item_num').html(item_num);
        if($('#item_table_'+row_num).length)
        {
            $('#item_table_'+row_num).after(row_htm); 
        }
        else
        {
            $('#_inp_head_table').after(row_htm); 
        }
        $('#_qty').val(0);
        $('#_desc').val('');
        $('#_price').val(0.00);
        $('#_amt').val(0.00);
        row_num         = cur_row;
    }
//==============for Item Details==================================================

 var _par;   
 var r_id;    
 var request_count = 1;
 var percent_factor;
 var net_total;
 var tax_total;
 var gross_total;
 var row_exist; //1or2  switch if make table for details or just add row
 
 function selet_entry(pElem)
    {
        $(pElem).select();
    }
 
 
  function compute_total(r_num)
    {
       percent_factor = string_amount($('#percent_'+r_num).val()) / 100;
       tax_total      = string_amount($('#net_'+r_num).val()) * percent_factor;
       gross_total	  = string_amount($('#net_'+r_num).val()) + tax_total;
       $('#tax_amt_'+r_num).val(string_amount(tax_total,true));
       $('#gross_'+r_num).val(string_amount(gross_total,true));
       display_cdv();
       
    }
  
  function get_c(pParameter, pSuccess)
	{
	    if(pSuccess)
	    {            
	        $('#child_'+r_id).html(pParameter);
	        display_cdv();
	    }
	    else
	    {            
	        r_id	     =    pParameter;
	        _par		 =    $('#parent_'+r_id).val();
	        p_url        =    '/finance_disbursement/liquidate/get_child';
	        p_post       =    'parent_id=' + _par;
	        p_handler    =    get_c;                                      
	        global_ajax_request(p_url, p_handler, p_post);
	    }
	}
	
	function get_site(pParameter, pSuccess)
	{
	    if(pSuccess)
	    {            
	        $('#project_site_'+r_id).html(pParameter);
	        display_cdv();
	    }
	    else
	    {            
	        r_id	     =    pParameter;
	         _par		 =    $('#project_'+r_id).val();
	        p_url        =    '/finance_disbursement/liquidate/get_project_site';
	        p_post       =    'project_id=' + _par;
	        p_handler    =    get_site;                                      
	        global_ajax_request(p_url, p_handler, p_post);
	    }
	}
  
  function get_detail_row(pParameter, pSuccess)
    {
        if(pSuccess)
        {            
            
            //alert(it_id+'_'+request_count);
            if(row_exist == 1)
            {
				$('#detail_row_'+it_id).append(pParameter);
				display_cdv();
				
            }
            else
            {
				
				$('#r_'+it_id).after(pParameter);
            }
           // alert($('#detail_parent_row_'+it_id).length);
            request_count++;
        }
        else
        {            
            //alert(request_count);
            it_id	     =    pParameter;            
            if($("#detail_parent_row_"+it_id).length == 0) 
            {
			 row_exist   =    0;
			}
			else
			{
			 row_exist   =    1;	
			}
            
            p_url        =    '/finance_disbursement/liquidate/get_detail_form';
            p_post       =    'item_id=' + it_id + '&request_count=' + request_count + '&row_exist=' + row_exist;
            p_handler    =    get_detail_row;                                      
            global_ajax_request(p_url, p_handler, p_post);
        }
    }
    
     function del_row(detail_r_num, item_id)
    {
       
         $('#'+item_id+'_'+detail_r_num).remove();
        // alert($("#detail_row_"+item_id).length);
	    if( !$.trim( $("#detail_row_"+item_id).html() ).length )
	     {
			//alert('hey');
			 $('#detail_parent_row_'+item_id).remove();
		 }
		 display_cdv();
    }
    
    
 //====================================================CDV
var is_cash = '<?=$_VIEW['option_payment_method_id']?>'; 
var total_tax = 0; 
var total_net = 0; 
var total_gross = 0;
var counter_row = 0;
var cdv_row;
var parent_;  
var child_;  
var project_;  
var site_;
  

var cash_row  = '<tr style="color:#282f39; background-color: #ffffff;" class="_cdv_form_row"> ';      
     cash_row        += '<td style="text-indent: 30px;">{cash_desc}</td>';                        
    cash_row         += '<td align="right" style="border-left:1px solid #888888;"></td>';                        
      cash_row       += '<td align="right" style="border-left:1px solid #888888;">{cash_amt}</td>';                  
		cash_row	 += '</tr>';        
                                
var tax_row  = '<tr style="color:#282f39; background-color: #ffffff;" class="_cdv_form_row">';        
     tax_row       += '<td style="text-indent: 30px;">Tax</td>';                     
      tax_row      += '<td align="right" style="border-left:1px solid #888888;"></td>';                       
     tax_row       += '<td align="right" style="border-left:1px solid #888888;">{tax_amt}</td>';                        
     tax_row       += '</tr>  ';                    
 
var var_row  = '<tr style="color:#282f39; background-color: #ffffff;" class="_cdv_form_row">';
var_row 	+= '<td>{account_name}</td>';
var_row     += '<td align="right" style="border-left:1px solid #888888;">{debit}</td>';
var_row     += '<td align="right" style="border-left:1px solid #888888;"></td>';
var_row     += '</tr>';
                 		
	function disp_particulars()
	{
		$('#_display_particulars').html($('#_particulars').val());
	}
                 		
     function display_cdv()
    {
        
          $('._cdv_form_row').remove();
          cdv_row 		=	'';
          total_tax 	= 	0;
          total_gross 	= 	0;
          total_net 	= 	0;
          counter_row   = 0;
          parent_ 		= 	'';
          child_ 		= 	'';
          project_ 		= 	'';
          site_ 		= 	'';
          
         $( "._cdv_rows" ).each(function( index ) {
			 total_tax     +=  string_amount($(this).find('._cdv_tax_amt').val());
			  total_gross  +=  string_amount($(this).find('._cdv_gross_amt').val());
			  total_net    +=  string_amount($(this).find('._cdv_net_amt').val());
			  parent_       =  $(this).find('._cdv_parent option:selected').text();
			  child_        =  $(this).find('._cdv_child option:selected').text();
			  project_      =  $(this).find('._cdv_project option:selected').text();
			  site_         =  $(this).find('._cdv_site option:selected').text();
			  
			  cdv_row      +=  var_row.replace(/{account_name}/g, parent_+' '+project_+' '+site_+' '+' '+child_);
			  cdv_row       =  cdv_row.replace(/{debit}/g, 'P '+ string_amount($(this).find('._cdv_net_amt').val(),true));
			  counter_row++;
		});
		//
		if(counter_row > 0)
		{
			 if(is_cash == 'cash')
			 {
				  cdv_row      +=   cash_row.replace(/{cash_desc}/g, 'Cash on Hand');
			 }
			 else
			 {
				 cdv_row      +=   cash_row.replace(/{cash_desc}/g, 'Cash in Bank');
			 }
			     cdv_row       =   cdv_row.replace(/{cash_amt}/g,'P '+ string_amount(total_net,true));
			     
			 if(total_tax > 0)
			 {
				 cdv_row      +=   tax_row.replace(/{tax_amt}/g, 'P '+ string_amount(total_tax,true));
			 }
			 else
			 {
				 cdv_row      +=   tax_row.replace(/{tax_amt}/g, 'P 0.00');
			 }
			  
		}
		$('#cdv_form').after(cdv_row);
		 
		 
		
    } 

</script>