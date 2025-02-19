<div id="content_body">    
    <?=$_VIEW['side_nav']?>   
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" class="pad_standard" style="margin-left:180px;">     
     
        <div style="overflow: auto; width:100%;" id="_right_content_">  <!--set max-height by making it dynamic -->                                             
            <form action="/finance_disbursement/department_head/submit_update_ticket" name="alsc_form" method="post">
            <input type="hidden" name="payable[int][account_payable_id]" value="<?=$_VIEW['account_payable_id']?>" />
            <input type="hidden" name="payable[str][request_type_id]" value="<?=$_VIEW['request_type_id']?>" />
            <input type="hidden" name="remark[str][remark_key]" value="account_payable" />
              <?=$_VIEW['profile.ticket']?>
              <table class="mar_custom <?=$_VIEW['status_view']?>" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
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
                                <a href="#" class="link_button_inline gray" onclick="go_to('/finance_disbursement/department_head/')">Cancel</a>
                                <a href="#" class="link_button_inline blue" onclick="submit_form('alsc_form')">Submit</a>
                            </div>
                        </td>
                    </tr>     
            </table>  
            </form>
            <label></label> 
            
                  
        </div>    
    </div>
    <label></label>

</div>