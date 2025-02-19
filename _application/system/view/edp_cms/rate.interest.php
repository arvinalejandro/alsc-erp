
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                <?=$_VIEW['rate_name']?>
            </b>

            <label></label>
        </div> 
    	
        <!---------- CONTENT CONTROLLERS ----------->        
        
       <div style="overflow: auto;" id="_right_content_"> 
           
            <div class="mar_custom" id="client_profile">
                <form name="alsc_form" method="post" action="/edp_cms/edp_cms_rate/rate_interest_add">
                <input type="hidden" name="rate_id" value="<?=$_VIEW['rate_id']?>" />
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td>
                            Minimum Terms (Months)                   
                        </td>
                        <td>
                        	Maximum Terms (Months)
                        </td>
                        <td>
                        	Down Payment (%)
                        </td>
                        <td>
                            Rate (%)
                        </td>
                        <td>
                            Rebate (%)
                        </td>
                        <td></td>                
                    </tr>
                </thead>
                <tbody>
                	<tr class="selected <?=$_VIEW['module_empty']?>">
                        <td><input type="text" name="int[rate_interest_min]" /></td>                                  
                        <td><input type="text" name="int[rate_interest_max]" /></td>                                  
                        <td><select name="int[option_dp_id]"><?=$_VIEW['option_dp']?></select></td>                                  
                        <td><input type="text" name="int[rate_interest_value]" /></td>                                  
                        <td><input type="text" name="int[rate_interest_rebate]" /></td>                                  
                        <td align="center" width="10%">                             
                            <div class="content_block_vpad"><a class="link_button_inline green" onclick="submit_form('alsc_form')">Add</a></div>
                        </td>                        
                    </tr>                    
                    <?=$_VIEW['row.rate.interest']?>                                   
                </tbody>  
            </table>
            </form>
            <label></label>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


