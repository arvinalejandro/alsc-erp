<div id="content_body">    
    <?=$_VIEW['side_nav']?>   
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">     
         <form action="/finance_accounting/bank_transaction/submit_transfer" name="alsc_form" method="post">
        <table class="mar_custom" id="_account_" style="font-weight:normal; padding-top: 20px;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
           <thead>
                <tr>
                    <td colspan="4">Fund Transfer</td>
                </tr>
            </thead>
            <tbody>
               <tr>                        
                    <td>Date  :</td>
                    <td><span><?=string_date_time(time())?>  <input type="hidden" value="<?=time()?>" name="trans[int][bank_transaction_timestamp]"/></span></td>
                	<td>Handled by :</td>
                    <td><span><?=$_VIEW['_user_']['user_name']?> <?=$_VIEW['_user_']['user_surname']?><input type="hidden" value="<?=$_VIEW['_user_']['user_name']?> <?=$_VIEW['_user_']['user_surname']?>" name="trans[str][handled_by]"/></span></td>
                </tr>
               <tr>
                    <td>From :</td>
                    <td><?=$_VIEW['bank_name']?> (<?=$_VIEW['bank_branch']?>)</td>
                    <td>Running Balance  :</td>
                    <td>P <?=string_amount($_VIEW['bank_balance']['bank_balance'])?></td>
                    <input type="hidden" name="trans[int][bank_id]" value="<?=$_VIEW['bank_id']?>"/>
                    <input type="hidden" name="trans[str][option_bank_transaction_category_id]" value="fund_transfer_out"/>
                    <input type="hidden" name="trans[str][option_bank_transaction_type_id]" value="out"/>
                </tr>
                <tr>
                    <td>To :</td>
                    <td>
                        <select id="bank_" name="trans[int][bank_pair_id]" onchange="get_balance()">
                            <option></option>
                            <?=$_VIEW['bank.opt']?>
                        </select>
                    </td>
                    <td>Running Balance  :</td>
                    <td id="bank_balance">P 0.00</td>
                </tr>
                <tr>
                    <td><div class="details">Amount :</div></td>      
                    <td colspan="3" align="center"><div class="details"><input type="text" name="trans[int][bank_transaction_amount]" /></div></td>      
                
                </tr>
                <tr>
                    <td>Details :</td>
                    <td colspan="3"><textarea name="trans[str][bank_transaction_details]" style="height:100px; width: 100%;"></textarea></td>
                </tr>
                <tr>
                    <td colspan="4" align="center">
                        <div class="pad_standard">
                            <a class="link_button_inline gray" onclick="go_to('/finance_accounting/bank_transaction/profile/&id=<?=$_VIEW['bank_id']?>')" href="#">Cancel</a>
                            <a class="link_button_inline blue" onclick="submit_form('alsc_form')" href="#">Submit</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table> 
        <label style="padding-bottom:40px;"></label>
    </div>  

</div>

<script type="text/javascript">

function get_balance(pParameter, pSuccess)
	{
	    if(pSuccess)
	    {            
	        $('#bank_balance').html('P '+pParameter)
	    }
	    else
	    {            
	       
	        _par		 =    $('#bank_').val();
	        p_url        =    '/finance_accounting/bank_transaction/get_balance';
	        p_post       =    'bank_id=' + _par;
	        p_handler    =    get_balance;                                      
	        global_ajax_request(p_url, p_handler, p_post);
	    }
	}
</script>