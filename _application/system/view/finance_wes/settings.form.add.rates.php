<div id="content_body">    
       
      <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/finance_wes/settings/submit_add_rate/" method="post" name="alsc_form">
                
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="2">Add Rate Profile</td>
                        </tr>
                    </thead>        
                    
                    <tr>
                        <td class="color_gray">
                           Rate Name:
                        </td>
                        <td>
                        	<input  type="text"  name="rate_name">                      
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
                            Days Due after Reading:
                        </td>
                        <td>
                        	<input  type="text" name="due_days" >                      
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                            Days Due before Disconnection:
                        </td>
                        <td>
                        	<input  type="text" name="due_days_disc" >                      
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                            Account Type:
                        </td>
                        <td>
                        	<select name="type">
                        	 <option value="water">Water</option>
                        	 <option value="Electric">Electric</option>
                        	</select>                    
                        </td>
                    </tr>
                    
                    <tr valign="middle">
	                       <td colspan="2" align="center">                  		
                       			<div class="content_block_vpad"> 
                       			    <a href="/finance_wes/settings/rates/" class="link_button_inline red">Cancel</a>                      				
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