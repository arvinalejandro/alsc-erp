<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/edp_inventory/edp_inventory_house/submit" method="post" name="alsc_form">
           		<input type="hidden" value="<?=$_VIEW['house_id']?>" name="id" />
           		<input type="hidden" value="<?=$_VIEW['house_price']?>" name="house_price" />
	            <table class="mar_custom pad_standard" style="margin-bottom:20px;" width="80%" cellpadding="5" cellspacing="0" border="0">	                    
	                    <thead>
                            <tr>
                                <td colspan="4" align="center">Add House Model</td>
                            </tr>
                        </thead> 
	                    <tr valign="middle">
	                        <td width="20%">
	                            Project
	                        </td>
	                        <td> 
	                            <select name="int[project_id]">
	                            	<option value="0"></option>
	                            	<?=$_VIEW['project']?>
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
	                            Classification
	                        </td>
	                        <td>
	                            <select name="str[option_house_classification_id]">
	                        		<option value="0"></option>
	                            	<?=$_VIEW['option_house_classification']?>
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
	                            House Model Name
	                        </td>
	                        <td>
	                            <input type="text" name="str[house_name]" value="<?=$_VIEW['house_name']?>"  />
	                        </td>
	                        <td></td>
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>                    
	                    
	                    
	                    <tr valign="middle" class="display_none">
	                        <td width="20%">
	                            House Model Code
	                        </td>
	                        <td>
	                            <input type="text" name="str[house_code]" value="<?=$_VIEW['house_code']?>"  />
	                        </td>
	                        <td></td>
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
	                    
	                       
	                    
	                    <tr valign="middle">
	                        <td width="20%">
	                            Acronym
	                        </td>
	                        <td>
	                            <input type="text" name="str[house_acronym]" value="<?=$_VIEW['house_acronym']?>"  />
	                        </td>
	                        <td></td>
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
	                    	                     
	                    <tr valign="middle">
	                        <td width="20%">
	                            Floor Area
	                        </td>
	                        <td>
	                            <input type="text" name="str[house_area]" value="<?=$_VIEW['house_area']?>"  />
	                        </td>
	                        <td></td>
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>     
	                    
	                    <tr valign="middle">
	                        <td width="20%">
	                            House Contract Price (PHP)
	                        </td>
	                        <td>
	                            <input type="text" name="int[house_price]" value="<?=$_VIEW['house_price']?>"  />
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
                       					$id		=	$_VIEW['house_id'] * 1;
                       					$link	=	($id) ? "/edp_inventory/edp_inventory_house/profile/&id={$id}" : '/edp_inventory/edp_inventory_house';
                       					
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


