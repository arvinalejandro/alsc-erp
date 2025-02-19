<div id="content_body">    
       
    <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS ----------->       
        
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            <a class="link_button_inline float_left _control gray" id="_investment" style="margin-left:5px;">House Model ></a>
            <a class="link_button_inline float_left _control blue" id="_client" style="margin-left:5px;">Package Setting ></a>                 
            <a class="link_button_inline gray float_left gray" style="margin-left:5px;">Submit</a> 
            <label></label> 
        </div> 
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/engineering/lot/submit_package" method="post" name="alsc_form">
           		<input type="hidden" name="id" value="<?=$_VIEW['lot_id']?>" />           		
           		<input type="hidden" name="req_type" value="zone" />          		
           		<input type="hidden" name="lot_construction[int][lot_id]" value="<?=$_VIEW['lot_id']?>" />
           		<input type="hidden" name="lot_construction[int][house_id]" value="<?=$_VIEW['house']['house_id']?>" />
           		<input type="hidden" name="lot_construction[str][option_unit_construction_id]" value="<?=$_VIEW['con_id']?>" />
           		<input type="hidden" name="lot_construction[int][user_id]" value="<?=$_VIEW['user_id']?>" />
           		
           		
                
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top:20px;" align="center">
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Lot Details</b></td>
                        </tr>    
                    </thead>
                    
                    <tr>
                        <td class="color_gray" width="15%">
                            Project:
                        </td>
                        <td width="35%">
                            <?=$_VIEW['project_name']?>
                        </td>
                        <td class="color_gray" width="15%">
                            Project Site:
                        </td>
                        <td width="35%">
                            <?=$_VIEW['project_name']?> - <?=$_VIEW['project_site_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Block:
                        </td>
                        <td>
                            <?=$_VIEW['project_site_block_name']?>
                        </td>
                        <td class="color_gray">
                            Lot Number:
                        </td>
                        <td>
                            <?=$_VIEW['lot_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Lot Area:
                        </td>
                        <td><?=$_VIEW['lot_area']?> sqm.</td>                        
                        <td class="color_gray">
                        </td>
                        <td>
                        </td>
                    </tr>
                   
                    
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Construction Details</b></td>
                        </tr>
                    </thead>     
                    
                    <tr>
                        <td class="color_gray">
                            Contractor Type:
                        </td>
                        <td>
                        	<select id="contractor_type" style="width: 90%;" onchange="get_contractor()">
	                            <option value="0"></option>
	                            <option value="in_house">In-House</option>
	                            <option value="external">External</option>
	                                                     	
	                        </select>
                        </td>
                        
                        <td class="color_gray">
                            Contractor :
                        </td>
                        <td>
							<select id="con_list" name="lot_construction[int][contractor_id]" style="width: 90%;">
	                                                  		                            	
	                        </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                            Status :
                        </td>
                        <td>
							<select name="lot_construction[str][option_unit_status_id]" style="width: 90%;">
	                            <option value="0"></option>
	                            <?=$_VIEW['option_unit_status']?>                            		                            	
	                        </select>
                        </td>
                        <td class="color_gray">
                            Estimated Cost :
                        </td>
                        <td>
							<input type="text" name="lot_construction[int][lot_construction_cost_estimate]" style="width: 90%;">
                        </td>
                    </tr>
                    
                     <tr>
                     	<td class="color_gray">
                            Construction Account :
                        </td>
                        <td>
							<select name="lot_construction[str][option_construction_account_id]" style="width: 90%;">
	                           
	                            <?=$_VIEW['option_construction_account']?>                            		                            	
	                        </select>
                        </td>
                        <td class="color_gray">
                             Start Date :
                        </td>
                        <td>
							<input class="_date_" type="text" name="lot_construction_date_start" style="width: 90%;">
                        </td>
                       
                    </tr>
	                
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Remarks</b></td>
                        </tr>
                    </thead>
                    
                    <tr>
                    	<td colspan="4">
                    		<input type="hidden" name="remark[str][remark_key]" value="lot" />	                              
                            <textarea name="remark[textarea][remark_content]" style="height: 150px; width:100%;" ></textarea>
                    	</td>
                    </tr>
	                  
	                <tr valign="middle">
	                   <td colspan="4" align="center">                  		
                       		<div class="content_block_vpad">                       				
                       			<?php
                       				#$id		=	$_VIEW['lot_id'] * 1;
                       				$link	=	 "/engineering/lot/package_house/&id={$_GET['id']}";
                       				
                       			?>
                       			<a href="<?=$link?>" class="link_button_inline gray">Back</a>
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
 var _net;   
    
    function get_contractor(pParameter, pSuccess)
    {
        if(pSuccess)
        {            
            $('#con_list').html(pParameter)
        }
        else
        {            
            
            _net         =    $('#contractor_type').val();
            p_url        =    '/engineering/lot/get_contractor';
            p_post       =    'con_type=' + _net ;
            p_handler    =    get_contractor;                                      
            global_ajax_request(p_url, p_handler, p_post);
        }
    }
    
  
    
   
    
</script>