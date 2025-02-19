<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
     
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/edp_inventory/edp_inventory_lot/submit_status" method="post" name="alsc_form">
           		<input type="hidden" value="<?=$_VIEW['lot_id']?>" name="id" />
	            <table class="mar_custom pad_standard" style="margin-bottom:20px;" width="80%" cellpadding="5" cellspacing="0" border="0">	                    
	                    <thead>
	                        <tr valign="middle">
	                           <td colspan="4" align="center">  
	                       		    <h2><?=$_VIEW['project_name']?> <?=$_VIEW['project_site_name']?> - Block <?=$_VIEW['project_site_block_name']?> Lot <?=$_VIEW['lot_name']?></h2>
	                           </td>
	                        </tr>
                        </thead>    
	                    <tr valign="middle">
	                        <td width="20%">
	                            Status
	                        </td>
	                        <td>
	                            <select name="str[option_availability_id]">	                            	
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
                       					$link	=	($id) ? "/edp_inventory/edp_inventory_lot/profile/&id={$id}" : '/edp_inventory/edp_inventory_lot';
                       					
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


 