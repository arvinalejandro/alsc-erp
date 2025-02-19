<div id="content_body">    
       
      <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/finance_wes/settings/submit_edit_rate/" method="post" name="alsc_form">
                <input type="hidden" name="type" value="<?=$_VIEW['type']?>">
                <input type="hidden" name="id" value="<?=$_VIEW['id']?>">
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="2">Edit Rate Profile</td>
                        </tr>
                    </thead>        
                    
                     <tr>
                        <td class="color_gray">
                            Account Type:
                        </td>
                        <td>
                        	<?=ucfirst($_VIEW['type'])?>             
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                           Rate Name:
                        </td>
                        <td>
                        	<input  type="text"  name="rate_name" value="<?=$_VIEW['rate_name']?>">                      
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
                        	<input  type="text" name="due_days" value="<?=$_VIEW['due_days']?>">                      
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                            Days Due before Disconnection:
                        </td>
                        <td>
                        	<input  type="text" name="due_days_disc" value="<?=$_VIEW['due_days_disc']?>">                      
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
	                    <tr>
                    <td colspan="4" align="center">
                           <a class="link_button_inline blue" href="/finance_wes/settings/add_new_rate_child/&id=<?=$_VIEW['id']?>&type=<?=$_VIEW['type']?>" >Add New Rate</a>
                        </td>
                        
                                              
                    </tr>                              
                </table>      
                
	            
            </form>
            <label></label>
             <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
               
                <thead>
                    <tr>
                        <td align="center">
                           Price per reading
                        </td>
                        
                        <td align="center">
                        	Minimum Reading
                        </td>                        
                        <td align="center">
                            Maximum Reading
                        </td>  
                       
                         <td width="10%" align="center"></td>                                  
                         <td width="10%" align="center"></td>                                  
                    </tr>
                </thead>
                <tbody>
                	<?=$_VIEW['rate_row']?>
                </tbody>  
            </table>
                
            
            
        </div>    
    </div>
    <label></label>
</div>

<script type="text/javascript">
$( document ).ready(function() {
   check_box();
});
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
