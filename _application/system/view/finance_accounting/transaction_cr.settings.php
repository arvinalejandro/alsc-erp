
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                Test123
            </b>

            <label></label>
        </div> 
    	
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
        
            <!--<table style="margin:10px auto;" width="90%" cellpadding="5" cellspacing="0" border="0">
                <tr>
                    <td colspan="4" style="font-weight:normal;"><span class="font_size_14">Post a Remark as <b><?=$_VIEW['_user_']['user_name']?> <?=$_VIEW['_user_']['user_surname']?></b></span></td>
                </tr>
                <tr class="selected <?=$_VIEW['module_empty']?>">
                    <td></td>
                    <td>
                        <form name="alsc_form" method="post" action="/finance_cashier/transaction/submit_remark">
                            	<textarea style="width: 100%; height: 50px;" name="textarea[remark_content]"></textarea>
                               <input type="hidden" name="str[remark_key]" value="account_receive" />
                               <input type="hidden" name="int[remark_key_id]" value="<?=$_VIEW['account_receive_id']?>" />
                               <input type="hidden" name="account_receive_id" value="<?=$_VIEW['account_receive_id']?>" />
                       </form>
                    </td>
                    <td></td> 
                    <td align="center" width="20%">                   
                        <a class="link_button_block green" onclick="submit_form('alsc_form')">Post</a>
                    </td>                                                                                   
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#ffffff">                    	
                        <div id="remarks_section">
                            <?=$_VIEW['row.remark']?>                                                   
                        </div>
                    </td>
                </tr>
            </table>-->
            
            <table style="margin:10px auto;" width="90%" cellpadding="5" cellspacing="0" border="0">
                <tr class="selected">
                    <td>
                        <div style="width:30%; margin:0 auto;">
                            <form name="alsc_form" method="post">
                               
                              <select>
                                <option>Approved</option>
                                <option>Bounced</option>
                              </select>
                            </form>
                            <label style="margin-bottom:5px;"></label>
                           
                            <div style="float:right;">
                                <a class="link_button_inline green" onclick="submit_form('alsc_form')">Change Status</a>
                               
                            </div>    
                        </div>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff">                        
                        <div id="remarks_section">
                                                                             
                        </div>
                    </td>
                </tr>
            </table>           
           
           
        </div>    
    </div>
    <label></label>
</div>
<script type="text/javascript">
    function clear_form()
    {
        $('#remark_form').val('');    
    }
</script>

 