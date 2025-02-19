<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/engineering/lot/submit_earnest" method="post" name="alsc_form">
           		<input type="hidden" value="<?=$_VIEW['lot_id']?>" name="id" />
	            <table class="mar_custom pad_standard" style="margin-bottom:20px;" width="80%" cellpadding="5" cellspacing="0" border="0">	                    
	                    
	                    <tr valign="middle">
	                        <td width="20%">
	                            Network
	                        </td>
	                        <td>
	                            <select name="int[network_id]">
	                            	<option value="0"></option>
	                            	<?=$_VIEW['network']?>	                            	
	                            </select>
	                        </td>
	                        <td></td>
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
	                       
	                    <tr valign="middle">
	                        <td width="20%">
	                            Division
	                        </td>
	                        <td>
	                            <select name="int[network_division_id]">
	                            	<option value="0"></option>
	                            	<?=$_VIEW['network_division']?>                            		                            	
	                            </select>
	                        </td>
	                        <td></td>
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
	                    
	                    
	                    
	                    <tr valign="middle">
	                        <td width="20%">
	                            Status
	                        </td>
	                        <td>
	                            <select name="int[option_availability_id]">
	                            	<option value="0"></option>
	                            	<?=$_VIEW['option_availability']?>                            		                            	
	                            </select>
	                        </td>
	                        <td></td>
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>   
                        
                        
	                    
	                     
	                       
	                    <tr valign="middle">
	                       <td colspan="4" align="center">                  		
                       			<div class="content_block_vpad">                       				
                       				<?php
                       					$id		=	$_VIEW['lot_id'] * 1;
                       					$link	=	($id) ? "/engineering/lot/profile/&id={$id}" : '/edp_inventory/edp_inventory_lot';
                       					
                       				?>
                       				<a href="<?=$link?>" class="link_button_inline red">Cancel</a>
                       				<a class="link_button_inline blue" onclick="submit_form('alsc_form')" >Save</a>
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


