<div id="content_body">    
       
      <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/finance_wes/settings/submit_add_other_charge/" method="post" name="alsc_form">
                
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="2">Add Other Charge</td>
                        </tr>
                    </thead>        
                    
                    <tr>
                        <td class="color_gray">
                            Name:
                        </td>
                        <td>
                        	<input  type="text"  name="other_charge[str][option_wes_charge_name]">                      
                        </td>
                    </tr>
                    
                  
                     <tr>
                        <td class="color_gray">
                            Amount:
                        </td>
                        <td>
                        	<input  type="text" name="other_charge[int][option_wes_charge_amount]" >                      
                        </td>
                    </tr>
                    
                     <tr>
                        <td class="color_gray">
                            Applicable to Project:
                        </td>
                        <td>
                        	  
                        	  <?=$_VIEW['p_id']?>
                        	  
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td class="color_gray">
                            Group:
                        </td>
                        <td>
                        	<select name="other_charge[str][option_wes_charge_group_id]">
                        	  <?=$_VIEW['group']?>
                        	</select>                    
                        </td>
                    </tr>
                    
                    <tr valign="middle">
	                       <td colspan="2" align="center">                  		
                       			<div class="content_block_vpad"> 
                       			    <a href="/finance_wes/settings/other_charges/" class="link_button_inline red">Cancel</a>                      				
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

    function check_box()
    {
       test = $('#all_p').prop('checked');
       	if(test == true)
       {
		   $('.check_projs').prop('checked',false);
		   $('.projects_').addClass('display_none');
		  
       }
       else
       {
		   
		   $('.projects_').removeClass('display_none');
		  
       }
       
    }
    

 

</script>


