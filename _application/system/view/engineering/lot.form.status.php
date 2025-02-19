<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/engineering/lot/submit_status" method="post" name="alsc_form">
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
	                          Lot Status
	                        </td>
	                        <td>
	                            <select id="l_status" name="str[option_availability_id]" onchange="h_form()">	                            	
	                            	<?=$_VIEW['option_availability']?>	                            	
	                            </select>
	                        </td>
	                        <td></td>
	                        <td>
	                            <span class="msg">
	                                
	                            </span>    
	                        </td>
	                    </tr>
	                    
	                     <tr id="sold_stat" class="display_none" valign="middle">
	                        <td width="20%">
	                          Sold Status
	                        </td>
	                        <td>
	                         For Assessment  <input value="for_ass"  <?=$_VIEW['for_ass']?>  type="radio" name="str[option_sold_status_id]"> <label></label> 
	                         Accepted & Occupied  <input value="acc_occ" <?=$_VIEW['acc_occ']?> type="radio" name="str[option_sold_status_id]"> <label></label> 
	                          Accepted & Not Occupied  <input value="acc_not_occ" <?=$_VIEW['acc_not_occ']?> type="radio" name="str[option_sold_status_id]"> <label></label> 
	                          Not Accepted & Occupied  <input value="not_acc_occ" <?=$_VIEW['not_acc_occ']?> type="radio" name="str[option_sold_status_id]"> <label></label> 
	                          Not  Accepted & Not Occupied  <input value="not_acc_not_occ" <?=$_VIEW['not_acc_not_occ']?> type="radio" name="str[option_sold_status_id]"> <label></label> 
	                        </td>
	                        <td></td>
	                        <td>
	                          
	                        </td>
	                    </tr>
	                    
	                     <tr valign="middle">
	                        <td width="20%">
	                            Property Status
	                        </td>
	                        <td>
	                            <select name="str[option_lot_property_status_id]">	                            	
	                            	<?=$_VIEW['option_prop_stat']?>	                            	
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
                       					$link	=	($id) ? "/engineering/lot/profile/&id={$id}" : '/engineering/lot';
                       					
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
<script type="text/javascript">
var param;	
	
    $(document).ready(function(){
	 h_form();
	});
    
    function h_form()
    {
        param  =   $('#l_status').val();
        if(param == 'sold')
        {
            $('#sold_stat').removeClass('display_none'); 
        }
        else 
        {
			$('#sold_stat').addClass('display_none'); 
        }
        
        
    }
</script>

 