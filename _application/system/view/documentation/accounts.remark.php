
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    
        
        <div style="overflow: auto;" id="_right_content_">
        
            <!--<table style="margin:10px auto;" width="80%" cellpadding="5" cellspacing="0" border="0">
                <tr>
                    <td colspan="5" style="font-weight:normal;"><span class="font_size_14">Post a Remark as <b>Mizel delos Santos</b></span></td>
                </tr>
                <tr class="selected <?=$_VIEW['module_empty']?>">
                    <td></td>
                    <td>
                        <form name="alsc_form" method="post" action="/edp_inventory/edp_inventory_lot/submit_remark">
                            <textarea style="width: 100%; height: 50px;" name="textarea[remark_content]"></textarea>
                               <input type="hidden" name="str[remark_key]" value="lot" />
                               <input type="hidden" name="int[remark_key_id]" value="<?=$_VIEW['lot_id']?>" />
                               <input type="hidden" name="lot_id" value="<?=$_VIEW['lot_id']?>" />
                       </form>
                    </td>
                    <td></td> 
                    <td align="center" width="20%">                   
                        <a class="link_button_block green" onclick="submit_form('alsc_form')">Post</a>
                    </td> 
                    <td></td>                                                                                    
                </tr>
                <tr>
                    <td colspan="5">                    	
                        <div id="remarks_section">
                            <?=$_VIEW['row.lot.remark']?>                                                   
                        </div>
                    </td>
                </tr>
            </table>-->
            
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
                            <form name="alsc_form" method="post" action="/documentation/lot/submit_remark">
                                <input type="hidden" name="remark[str][remark_key]" value="client_account" />
                                 <input type="hidden" name="client_account_id" value="<?=$_VIEW['client_account_id'];?>">
                                <textarea style="width: 100%; height: 200px;" name="remark[str][remark_content]"></textarea>
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
  

