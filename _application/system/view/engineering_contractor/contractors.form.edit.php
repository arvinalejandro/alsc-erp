<div id="content_body">    
       
     <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/engineering_contractor/contractors/submit_update/" method="post" name="alsc_form">
           	<input type="hidden" name="id" value="<?=$_VIEW['contractor_id']?>">
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                   
                   <thead>
                        <tr>
                            <td colspan="4">Contractor Specialization</td>
                        </tr>
                    </thead>        
                    
                     <tr>
                        <td class="color_gray" width="40%">
                            Specialization Type:
                        </td>
                        <td colspan="3">
                        	<table cellpadding="0" cellspacing="0" border="0" style="font-weight:normal; margin-top: 0px;margin-left: 0px;border-spacing: 10px 0;" align="center">
                        	 <tr>
                        	 	<td> <input <?=$_VIEW['con_spec']['house_check']?> id="_housing_check" type="checkbox" style="margin-top: 5px;" onchange="s_form()"> <span style="margin-left: 10px;">  Housing </span> </td>
                        	 	<td> <input <?=$_VIEW['con_spec']['land_check']?> id="_land_check" type="checkbox" style="margin-top: 5px;" onchange="s_form()"> <span style="margin-left: 10px;">  Land Development</span></td>
                        	 </tr>
                        	 </table>
                        </td>
                    </tr>
                    
                    
                    <tr class="_housing  <?=$_VIEW['con_spec']['house_']?>">
                        <td colspan="4" align="center" height="10" colspan="2" style="background-color: #4E82AD;">
                          <span><b>Housing</b></span>
                        </td>
                    </tr>
                    
                    <tr class="_housing <?=$_VIEW['con_spec']['house_']?>">
                        <td colspan="4">
                        	 
                        	 <table cellpadding="0" cellspacing="0" border="0" style="font-weight:normal; margin-top: 0px;margin-left: 0px;border-spacing: 10px 0;" align="center">
                        	 <tr>
                        	 	<td> <input value="interior" <?=$_VIEW['con_spec']['interior']?> type="checkbox" style="margin-top: 5px;" name="specs[]"> <span style="margin-left: 10px;">Interior</span> </td>
                        	 	<td> <input value="exterior" <?=$_VIEW['con_spec']['exterior']?> type="checkbox" style="margin-top: 5px;" name="specs[]"><span style="margin-left: 10px;">Exterior</span></td>    
                        	 </tr>
                        	 </table>
                        </td>
                    </tr>   
                    
                     <tr class="_land <?=$_VIEW['con_spec']['land_']?>">
                        <td align="center" colspan="4" style="background-color: #4E82AD;">
                          <span><b>Land Development</b></span>
                        </td>
                    </tr>
                    
                    <tr class="_land <?=$_VIEW['con_spec']['land_']?>">
                        <td colspan="2">
                        	 
                        	 <table cellpadding="0" cellspacing="0" border="0" style="font-weight:normal; margin-top: 0px;margin-left: 0px;border-spacing: 10px 0;" align="center">
                        	 <tr>
                        	 	<td> <input value="land_embankment" <?=$_VIEW['con_spec']['land_embankment']?> type="checkbox" style="margin-top: 5px;" name="specs[]"><span style="margin-left: 10px;">Land Embankment</span>   </td>
                        	 	<td> <input value="road_prep_concrete" <?=$_VIEW['con_spec']['road_prep_concrete']?> type="checkbox" style="margin-top: 5px;" name="specs[]"><span style="margin-left: 10px;">Road Preparation & Concreting</span></td>
                        	 <tr>
                        	 	<td> <input value="water_line" <?=$_VIEW['con_spec']['water_line']?> type="checkbox" style="margin-top: 5px;" name="specs[]"><span style="margin-left: 10px;">Water Line</span></td>
                        	 	<td> <input value="deep_well_drill" <?=$_VIEW['con_spec']['deep_well_drill']?> type="checkbox" style="margin-top: 5px;" name="specs[]"><span style="margin-left: 10px;">Deep Well Drilling</span></td>
                        	 </tr>
                        	 <tr>
                        	 	<td> <input value="pressurized_water_tank" <?=$_VIEW['con_spec']['pressurized_water_tank']?> type="checkbox" style="margin-top: 5px;" name="specs[]"><span style="margin-left: 10px;">Pressurized Water Tank</span></td>
                        	 	<td> <input value="amenities" <?=$_VIEW['con_spec']['amenities']?> type="checkbox" style="margin-top: 5px;" name="specs[]"><span style="margin-left: 10px;">Amenities</span></td>
                        	 </tr>
                        	 </table>
                        </td>
                        <td colspan="2">
                        	 
                        	 <table cellpadding="0" cellspacing="0" border="0" style="font-weight:normal; margin-top: 0px;margin-left: 0px;border-spacing: 10px 0;" align="center">
                        	 <tr>
                        	 	<td> <input value="sidewalk_curbs_gutter" <?=$_VIEW['con_spec']['sidewalk_curbs_gutter']?> type="checkbox" style="margin-top: 5px;" name="specs[]"><span style="margin-left: 10px;">Sidewalk, Curbs & Gutter</span>   </td>
                        	 	<td> <input value="electricity" <?=$_VIEW['con_spec']['electricity']?> type="checkbox" style="margin-top: 5px;" name="specs[]"><span style="margin-left: 10px;">Electricity</span></td>
                        	 <tr>
                        	 	<td> <input value="drainage_system" <?=$_VIEW['con_spec']['drainage_system']?> type="checkbox" style="margin-top: 5px;" name="specs[]"><span style="margin-left: 10px;">Drainiage System</span></td>
                        	 	<td> <input value="fencing" <?=$_VIEW['con_spec']['fencing']?> type="checkbox" style="margin-top: 5px;" name="specs[]"><span style="margin-left: 10px;">Fencing</span></td>
                        	 </tr>
                        	 <tr>
                        	 	<td> <input value="others" <?=$_VIEW['con_spec']['others']?> type="checkbox" style="margin-top: 5px;" name="specs[]"><span style="margin-left: 10px;">Others</span></td>
                        	 	<td> </td>
                        	 </tr>
                        	 </table>
                        </td>
                    </tr>

                    <thead>
                        <tr>
                            <td colspan="4">Contractor Details</td>
                        </tr>
                    </thead>        
                    <tr>
                        <td class="color_gray">Contractor Type:</td>
                        <td>
                        <select name="contractor[str][option_contractor_type_id]" style="width: 100%;">
                          <?=$_VIEW['contractor_type']?>
	                            	                            
                        </select>                       
                        </td>
                        <td class="color_gray">Status:</td>
                        <td>
                        <select name="contractor[str][option_contractor_status_id]" style="width: 100%;">
                           <?=$_VIEW['contractor_status']?>
                        </select>                       
                        </td>
                    </tr>

                    <tr>
                        <td class="color_gray">Contractor Name:</td>
                        <td>
                        <div class="details"><input type="text" name="contractor[str][contractor_name]" value="<?=$_VIEW['contractor_name']?>" /></div>                    
                        </td>
                        <td class="color_gray">Business Permit Number:</td>
                        <td>
                        <div class="details"><input type="text" name="contractor[str][contractor_business_permit_number]" value="<?=$_VIEW['contractor_business_permit_number']?>" /></div>                    
                        </td>
                    </tr>

                    <tr>
                        <td class="color_gray">Owner:</td>
                        <td>
                        <div class="details"><input type="text" name="contractor[str][contractor_owner]" value="<?=$_VIEW['contractor_owner']?>" /></div>                    
                        </td>
                        <td class="color_gray">Business Address:</td>
                        <td>
                        <div class="details"><input type="text" name="contractor[str][contractor_address]" value="<?=$_VIEW['contractor_address']?>" /></div>                    
                        </td>
                    </tr>

                    <tr>
                        <td class="color_gray">Email Address:</td>
                        <td>
                        <div class="details"><input type="text" name="contractor[str][contractor_email]" value="<?=$_VIEW['contractor_email']?>" /></div>                    
                        </td>
                        <td class="color_gray">Phone Number:</td>
                        <td>
                        <div class="details"><input type="text" name="contractor[str][contractor_landline]" value="<?=$_VIEW['contractor_landline']?>" /></div>                    
                        </td>
                    </tr>

                    <tr>
                        <td class="color_gray">Fax Number:</td>
                        <td>
                        <div class="details"><input type="text" name="contractor[str][contractor_fax]" value="<?=$_VIEW['contractor_fax']?>" /></div>                    
                        </td>
                        <td class="color_gray">Mobile Number:</td>
                        <td>
                        <div class="details"><input type="text" name="contractor[str][contractor_mobile]" value="<?=$_VIEW['contractor_mobile']?>" /></div>                    
                        </td>
                    </tr>


                    <tr>
                        <td>Comment :</td>
                        <td colspan="3"><textarea name="contractor[str][contractor_comment]" style="height:100px; width: 100%;"><?=$_VIEW['contractor_comment']?></textarea></td>
                    </tr>


                    <tr valign="middle">
                        <td colspan="4" align="center">                  		
                            <div class="content_block_vpad">                       				
                                <a class="link_button_inline blue" onclick="submit_form('alsc_form')" >Update</a>
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
var _h;	
var _l;	

	$(document).ready(function(){
	 s_form();
	});
	
    function s_form()
    {
		_h   	 = $('#_housing_check').prop('checked');
		_l   	 = $('#_land_check').prop('checked');
		
		if(_h)
		{
			$('._housing').removeClass('display_none');
		}
		else
		{
			$('._housing').addClass('display_none');
		}
		
		if(_l)
		{
			$('._land').removeClass('display_none');
		}
		else
		{
			$('._land').addClass('display_none');
		}
    }
</script>

