<div id="content_body">    
       
      <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/finance_wes/settings/submit_edit_rate_child/" method="post" name="alsc_form">
                <input type="hidden" name="type" value="<?=$_VIEW['type']?>">
                <input type="hidden" name="id" value="<?=$_VIEW['id']?>">
                <input type="hidden" name="rate_id" value="<?=$_VIEW['rate_id']?>">
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="2">Edit Rate</td>
                        </tr>
                    </thead>        
                    
                   
                    
                    
                    
                    <tr>
                        <td class="color_gray">
                            Price Per Reading:
                        </td>
                        <td>
                        	<input  type="text"  name="amount" value="<?=string_amount($_VIEW['amount'])?>">                      
                        </td>
                    </tr>
                    
                  
                     <tr>
                        <td class="color_gray">
                            Minimum Reading:
                        </td>
                        <td>
                        	<input  type="text" name="min" value="<?=$_VIEW['min_reading']?>">                      
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                            Maximum Reading:
                        </td>
                        <td>
                        	<input id="max"  type="text" name="max" value="<?=$_VIEW['max_reading']?>">  
                        	<br><br>
       						<input id="all_p"  style="width:20px;" type="checkbox" <?=$_VIEW['_checked_']?> name="onwards[]" value="1"  onclick="check_box()"/>
							<span class="float_right" style="width:94%; margin-top: -5px;" >Onwards<label></label>                    
                        </td>
                    </tr>
                    
                  
                    
                    <tr valign="middle">
	                       <td colspan="2" align="center">                  		
                       			<div class="content_block_vpad"> 
                       			    <a href="/finance_wes/settings/edit_rate/&id= <?=$_VIEW['id']?>&type= <?=$_VIEW['type']?>" class="link_button_inline red">Cancel</a>                      				
                       				<a class="link_button_inline blue" onclick="submit_form('alsc_form')" >Submit</a>
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

<script type="text/javascript">
$( document ).ready(function() {
   check_box();
});
    
var max_val;    
    function check_box()
    {
       test = $('#all_p').prop('checked');
       	if(test == true)
       {
		   $('#max').prop("disabled", true);
		   $('#max').val("No Maximum");
		  
       }
       else
       {
		    max_val = $('#max').val();
		    if(max_val > 0)
		    {
				$('#max').val(max_val);
		    }
		    else
		    {
				$('#max').val(0);
		    }
		   
		      
		    $('#max').prop("disabled", false);
		    
       }
       
    }
    

 

</script>
