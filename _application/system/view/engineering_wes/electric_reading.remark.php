
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
               Remarks
            </b>

            <label></label>
        </div> 
    	
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
        
            <!--<table style="margin:10px auto;" width="90%" cellpadding="5" cellspacing="0" border="0">
                <tr>
                    <td colspan="5" style="font-weight:normal;"><span class="font_size_14">Post a Remark as <b>Mizel delos Santos</b></span></td>
                </tr>
                <tr class="selected <?=$_VIEW['module_empty']?>">
                    <td></td>
                    <td>
                        <form name="alsc_form" method="post" action="/edp_inventory/edp_inventory_project/submit_remark">
                            	<textarea style="width: 100%; height: 50px;" name="textarea[remark_content]"></textarea>
                               <input type="hidden" name="str[remark_key]" value="project" />
                               <input type="hidden" name="int[remark_key_id]" value="<?=$_VIEW['project_id']?>" />                              
                               <input type="hidden" name="project_id" value="<?=$_VIEW['project_id']?>" />                              
                       </form>
                    </td>
                    <td></td> 
                    <td align="center" width="20%">                   
                        <a class="link_button_block green" onclick="submit_form('alsc_form')">Post</a>
                    </td> 
                    <td></td>                                                                                    
                </tr>
                <tr>
                    <td colspan="4">                    	
                        <div id="remarks_section">
                            <?=$_VIEW['row.remark']?>                                                   
                        </div>
                    </td>
                </tr>
            </table>--> 
            
            <table style="margin:10px auto;" width="90%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td>
                            <div class="float_left">Make a New Post</div>
                            <div class="float_right"><?php echo date ('m/d/Y');?></div>
                        </td>
                    </tr>
                </thead>
                <tr class="selected <?=$_VIEW['module_empty']?>">
                    <td>
                        <div style="width:90%; margin:0 auto;">
                            <form name="alsc_form" method="post" action="/engineering_wes/electric_reading/submit_remark">
                                <textarea style="width: 100%; height: 80px;" name="textarea[remark_content]" id="remark_form"></textarea>
                                <input type="hidden" name="str[remark_key]" value="lot_wes_reading" />
                                <input type="hidden" name="int[remark_key_id]" value="<?=$_VIEW['lot_wes_reading_id']?>" />                              
                                <input type="hidden" name="lot_wes_reading_id" value="<?=$_VIEW['lot_wes_reading_id']?>" />                              
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
<script type="text/javascript">
    function clear_form()
    {
        $('#remark_form').val('');    
    }
</script>

