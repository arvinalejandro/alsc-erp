<?php

if($_VIEW['lot_id'])
{
	$display	=	'disabled="disabled"';
}
	
?>


<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
       
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/engineering/lot/submit" method="post" name="alsc_form">
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
	                            Project
	                        </td>
	                        <td colspan="2" width="60%">
	                            <select name="project_site[int][project_id]">
	                            	<?=$_VIEW['project']?>
	                            </select>
	                        </td>
	                        
	                        <td width="20%">
	                               
	                        </td>
	                    </tr>
	                    
	                    <tr valign="middle">
	                        <td width="20%">
	                            Lot Status
	                        </td>
	                        <td  colspan="2">
	                            <select name="lot[str][option_availability_id]">
	                            	<?=$_VIEW['option_availability']?>
	                            </select>
	                        </td>
	                        
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
	                    
	                    <tr valign="middle">
	                        <td width="20%">
	                            Lot Property Status
	                        </td>
	                        <td  colspan="2">
	                            <select name="lot[str][option_lot_property_status_id]">
	                            	<?=$_VIEW['option_prop_stat']?>
	                            </select>
	                        </td>
	                        
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
	                    
	                    <tr valign="middle">
	                        <td width="20%">
	                            Phase
	                        </td>
	                        <td  colspan="2">	                        
	                        	<input type="text" name="project_site[str][project_site_name]" value="<?=$_VIEW['project_site_name']?>" />	                            
	                        </td>
	                        
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
	                    
                        <tr valign="middle">
                            <td width="20%">
                                Phase Code
                            </td>
                            <td>                            
                                <input type="text" name="project_site[int][project_site_code]" value="<?=$_VIEW['project_site_code']?>" />  <!-- phase code -->                              
                            </td>
                            
                            <td colspan="2">
                                <span class="msg">
                                    If the phase number provided above doesn't exist, a new entry for that phase will be created using the phase code you supply here. If the phase number already exist, the system will tag this lot using the existing phase and will disregard the values you provided for the Phase and Phase code. This form is not intended to edit the phase code.
                                </span>    
                            </td>
                        </tr>
                           
	                 
                        
                        <tr valign="middle">
                            <td>
                                Address
                            </td>
                            <td colspan="2">
                                <input type="text" name="lot[str][lot_address]" value="<?=$_VIEW['lot_address']?>"  />
                            </td>
                            <td>
                                <span class="msg">
   
                                </span>    
                            </td>
                        </tr>
                        
                        <tr valign="middle">
                            <td>
                                City / Province
                            </td>
                            <td colspan="2">
                                <input type="text" name="lot[str][lot_city]" value="<?=$_VIEW['lot_city']?>"  />
                            </td>
                            <td>
                                <span class="msg">
                                    
                                </span>    
                            </td>
                        </tr>  
                        
                        <tr valign="middle">
                            <td>
                                Zip Code
                            </td>
                            <td colspan="2">
                                <input type="text" name="lot[str][lot_zip]" value="<?=$_VIEW['lot_zip']?>"  />
                            </td>
                            <td>
                                <span class="msg">
                                    
                                </span>    
                            </td>
                        </tr> 
                        <!--
                        <tr valign="middle">
                            <td width="20%">
                                Status
                            </td>
                            <td colspan="2">
                                <select name="int[option_project_status_id]">
                                    <?=$_VIEW['option_project_status']?>
                                </select>
                            </td>
                            <td>
                                <span class="msg">
                                    
                                </span>    
                            </td>
                        </tr>  
	                    -->
	                    <tr valign="middle">
	                        <td width="20%">
	                            Block
	                        </td>
	                        <td>
	                           From :  <input type="text" name="block[int][project_site_block_name]" value="<?=$_VIEW['project_site_block_name']?>"  />
	                        </td>
	                        <td> To :  <input type="text" name="project_site_block_name_to" value="0" <?=$display?> /></td>
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
	                    
                         <tr valign="middle">
                            <td width="20%">
                                Lot Number
                            </td>
                            <td>
                                From : <input type="text" name="lot[int][lot_name]" value="<?=$_VIEW['lot_name']?>" />
                            </td>
                            <td>
                                To : <input type="text" name="lot_name_to" value="0" <?=$display?> />
                            </td>
                            <td>
                                <span class="msg">
                                    
                                </span>    
                            </td>
                        </tr>
                        
	                    <tr valign="middle">
	                        <td width="20%">
	                            Lot Area (sqm.)
	                        </td>
	                        <td colspan="2">
	                            <input type="text" name="lot[int][lot_area]" value="<?=$_VIEW['lot_area']?>" />
	                        </td>
	                        
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
	                    
	                    <tr valign="middle">
	                        <td width="20%">
	                            Price per sqm. (PHP)
	                        </td>
	                        <td  colspan="2">
	                            <input type="text" name="lot[int][lot_price]" value="<?=$_VIEW['lot_price']?>" />
	                            <input type="hidden" name="lot_price" value="<?=$_VIEW['lot_price']?>" />
	                        </td>
	                        
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>   
                        
                        <tr valign="middle">
                            <td width="20%">
                               Remarks
                            </td>
                            <td  colspan="2">
                              <input type="hidden" name="remark[str][remark_key]" value="lot" />	                              
                              <textarea name="remark[textarea][remark_content]" style="height: 150px; width:100%;" ></textarea>
                            </td>                            
                            <td>
                                <span class="msg">
                                    
                                </span>    
                            </td>
                        </tr>   
	                    
	                     
	                       
	                    <tr valign="middle">
	                       <td colspan="4" align="center">                  		
                       			<div class="content_block_vpad">                       				
                       				<?php                       					
                       					$link	=	'/engineering/lot';                       					
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


 