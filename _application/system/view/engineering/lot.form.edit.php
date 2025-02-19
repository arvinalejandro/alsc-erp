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
	                           Lot Title Status
	                        </td>
	                        <td  colspan="2">
	                            <select name="lot_title[str][option_lot_title_status_id]">
	                            	<?=$_VIEW['title_status']?>
	                            </select>
	                        </td>
	                        
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
	                    
	                     <tr valign="middle">
	                        <td width="20%">
	                          Name in Title
	                        </td>
	                        <td  colspan="2">
	                            <select name="lot_title[str][option_lot_title_name_id]">
	                            	<?=$_VIEW['title_name']?>
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
	                        	<?=$_VIEW['project_site_name']?>                       
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
                                <?=$_VIEW['project_site_code']?>                              
                            </td>
                            
                            <td colspan="2">
                                
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
	                          <?=$_VIEW['project_site_block_name']?>
	                        </td>
	                        <td></td>
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
                                <?=$_VIEW['lot_name']?>
                            </td>
                            <td>
                                
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
                       				
                       				<a href="/engineering/lot/profile/&id=<?=$_VIEW['lot_id']?>" class="link_button_inline red">Cancel</a>
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


 