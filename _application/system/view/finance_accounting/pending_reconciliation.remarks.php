
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
    
        
        <div style="overflow: auto;" id="_right_content_">
        
          
            
            <table style="margin:10px auto;" width="80%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td>
                            <div class="float_left">Make a New Post</div>
                            <div class="float_right"><?php echo date ('m/d/Y');?></div>
                        </td>
                    </tr>
                </thead>
                <tr class="selected">
                    <td>
                        <div style="width:90%; margin:0 auto;">
                            <form name="alsc_form" method="post" action="/finance_accounting/reconciliation/submit_remark">
                            <input type="hidden" name="account_payable_id" value="<?=$_VIEW['account_payable_id']?>" />
                            <input type="hidden" name="remark[str][remark_key]" value="account_payable" />
                                <textarea style="width: 100%; height: 80px;" name="remark[str][remark_content]" id="remark_form"></textarea>
                                
                            </form>
                            <label style="margin-bottom:5px;"></label>
                            <span class="font_size_14" style="font-weight:normal;">
                                You are posting a remark as
                                 <b><?=$_VIEW['_user_']['user_name']?> <?=$_VIEW['_user_']['user_surname']?></b>
                            </span>
                             <div style="float:right;">
                                <a class="link_button_inline green" onclick="submit_form('alsc_form')">Post Remark</a>
                                <a class="link_button_inline gray" onclick="clear_form()">Clear</a>
                            </div>   
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                        
                        <div id="remarks_section">
                             <?=$_VIEW['row.remark']?>                                                
                        </div>
                    </td>
                </tr>
            </table>           
           
           
        </div>    
    </div>
    <label></label>
</div>
  

