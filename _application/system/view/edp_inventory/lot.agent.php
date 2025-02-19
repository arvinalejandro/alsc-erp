<!--file_delete-->
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                <?=$_VIEW['project_name']?> <?=$_VIEW['project_site_name']?> - Block <?=$_VIEW['project_site_block_name']?> Lot <?=$_VIEW['lot_name']?>
            </b>

            <label></label>
        </div> 
    	
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">            	
                <form name="alsc_form" method="post" action="/edp_inventory/edp_inventory_lot/submit_agent">
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                <thead>                    
                    <tr>
                    	<td>
                            Sequence                          
                        </td>
                        <td>
                            Agent Name                          
                        </td>
                        <td>
                            Effective Days Left       
                        </td>
                        <td>
                            Days Before Effectivity
                        </td> 
                        <td>
                            Closed Commission
                        </td>
                        <td></td>                                                                 
                    </tr>
                </thead>                
                <tbody>    
                	<tr class="selected <?=$_VIEW['module_empty']?>">
                        <td><input type="text" name="str[agent_sequence]" /> </td>
                        <td>Agent Name:</td>
                        <td colspan="3">                            	                            
		                       
		                       <input type="text" name="str[agent_name]" />
		                       <input type="hidden" name="int[lot_id]" value="<?=$_GET['id']?>" />	                       
		                       <input type="hidden" name="lot_id" value="<?=$_GET['id']?>" />	                       
                        </td>   
                                                                
                        <td align="center" width="10%">                             
                            <div class="content_block_vpad"><a class="link_button_inline green" onclick="submit_form('alsc_form')">Add</a></div>
                        </td>                        
                    </tr>            	
                    
                	<?=$_VIEW['row.agent']?>                           
                </tbody>  
            </table>
            </form>
            <label></label>
            </div>  
        </div>    
    </div>
    <label></label>
</div>  


