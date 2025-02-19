<div id="content_body">    
    <?=$_VIEW['side_nav']?>   
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">     
     
        <div style="overflow: auto; width:100%;" id="_right_content_">  <!--set max-height by making it dynamic -->                        
            <form action="/finance_accounting/journal_entry/submit_update_ticket" name="alsc_form" method="post">
            <input type="hidden" name="payable[int][account_payable_id]" value="<?=$_VIEW['account_payable_id']?>" />
            <input type="hidden" name="payable[str][request_type_id]" value="<?=$_VIEW['request_type_id']?>" />
            <input type="hidden" name="remark[str][remark_key]" value="account_payable" />
           <?=$_VIEW['profile.ticket']?>
            <table class="mar_custom <?=$_VIEW['status_view']?>" id="_account_" style="font-weight:normal; margin-top: 20px;" width="97%" cellpadding="5" cellspacing="0" border="0">                  
                <thead>    
                    <tr class="<?=$_VIEW['tba_class']?>">
                        <td align="center">Qty</td>    
                        <td>Description</td>    
                        <td align="right">Price</td>    
                        <td align="right">Amount</td>
                        <td></td> 
                    </tr>
                </thead> 
                <?=$_VIEW['item.ticket']?> 
                <tr class="selected">
                    <td class="border_top_gray" align="center">Action :</td>
                    <td class="border_top_gray" colspan="3">
                        <select style="float:left;" name="payable[str][request_approval_status_id]">
                            <option value="approved">Approve</option>
                            <option value="declined">Decline</option>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr class="selected <?=$_VIEW['tba_class']?>">
                    <td class="border_top_gray" align="center">Particulars :</td>
                    <td class="border_top_gray" colspan="3">
                        <input type="text" id="_particulars" value="" onkeyup="disp_particulars()" onchange="disp_particulars()" name='particulars'>
                    </td>
                    <td></td>
                </tr>
                <tr class=" <?=$_VIEW['tba_class']?>">
                    <td colspan="5">
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
                    <td align="center">Remarks :</td>
                    <td colspan="3"><textarea style="width:100%; height:100px;" name="remark[str][remark_content]"></textarea></td>
                    <td></td>
                </tr>  
                <tr>
                    <td align="center" colspan="5">
                        <div class="pad_standard">
                            <a href="#" class="link_button_inline red" onclick="go_to('/finance_accounting/journal_entry/')">Cancel</a>
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
	        p_url        =    '/finance_accounting/journal_entry/get_child';
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
	        p_url        =    '/finance_accounting/journal_entry/get_project_site';
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
				
            }
            else
            {
				
				$('#r_'+it_id).after(pParameter);
            }
           // alert($('#detail_parent_row_'+it_id).length);
           display_cdv();
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
            
            p_url        =    '/finance_accounting/journal_entry/get_detail_form';
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