<div id="content_body">    
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/engineering_contractor/contractors/submit_add/" method="post" name="alsc_form">
	            <table width="70%" cellpadding="8" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="4">Contractor Specialization</td>
                        </tr>
                    </thead>        
                    <tr>
                        <td colspan="4" style="background-color: #D8DFEA;">
                            <div class="float_left width_half border_gray border_box pad_standard bg_fff ">
                                <div class="checkbox_group" style="float:none;">
                                    <input class="checkbox _housing_check" id="housing" onchange="s_form()" type="checkbox" />
                                    <label for="housing">Housing</label>
                                </div>
                                <div class="_housing display_none" style="margin-top:45px; padding-left: 30px;">
                                    <div class="checkbox_group" style="float: none;">
                                        <input class="checkbox" id="interior" onchange="s_form()" type="checkbox" value="Interior" name="specs[]" />
                                        <label for="interior">Interior</label>
                                    </div> 
                                    <div class="checkbox_group" style="float: none;">
                                        <input class="checkbox" id="exterior" onchange="s_form()" type="checkbox" value="Exterior" name="specs[]" />
                                        <label for="exterior">Exterior</label>
                                    </div>
                                </div>
                            </div> 
                            <div class="float_left width_half border_gray border_box pad_standard bg_fff">
                                <div class="checkbox_group" style="float:none;">
                                    <input class="checkbox _land_check" id="landdev" onchange="s_form()" type="checkbox" />
                                    <label for="landdev">Land Development</label>
                                </div>
                                <div class="_land display_none" style="margin-top:45px; padding-left: 30px;">   
                                    <div class="checkbox_group" style="float:none;">
                                        <input value="amenities" class="checkbox" id="amenities" type="checkbox" name="specs[]" />
                                        <label for="amenities">Amenities</label>
                                    </div> 
                                    <div class="checkbox_group" style="float:none;">
                                        <input value="deep_well_drill" class="checkbox" id="deep_well_drill" type="checkbox" name="specs[]" />
                                        <label for="deep_well_drill">Deep Well Drilling</label>
                                    </div>
                                    <div class="checkbox_group" style="float:none;">
                                        <input value="drainage_system" class="checkbox" id="drainage_system" type="checkbox" name="specs[]" />
                                        <label for="drainage_system">Drainage System</label>
                                    </div>
                                    <div class="checkbox_group" style="float:none;">
                                        <input value="electricity" class="checkbox" id="electricity" type="checkbox" name="specs[]" />
                                        <label for="electricity">Electricity</label>
                                    </div>
                                    <div class="checkbox_group" style="float:none;">
                                        <input value="fencing" class="checkbox" id="fencing" type="checkbox" name="specs[]" />
                                        <label for="fencing">Fencing</label>
                                    </div>
                                    <div class="checkbox_group" style="float:none;">
                                        <input value="land_embankment" class="checkbox" id="land_embankment" type="checkbox" name="specs[]" />
                                        <label for="land_embankment">Land Embankment</label>
                                    </div>
                                    <div class="checkbox_group" style="float:none;">
                                        <input value="pressurized_water_tank" class="checkbox" id="pressurized_water_tank" type="checkbox" name="specs[]" />
                                        <label for="pressurized_water_tank">Pressurized Water Tank</label>
                                    </div>
                                    <div class="checkbox_group" style="float:none;">
                                        <input value="road_prep_concrete" class="checkbox" id="road_prep_concrete" type="checkbox" name="specs[]" />
                                        <label for="road_prep_concrete">Road Preparation & Concerting</label>
                                    </div>
                                    <div class="checkbox_group" style="float:none;">
                                        <input value="sidewalk_curbs_gutter" class="checkbox" id="sidewalk_curbs_gutter" type="checkbox" name="specs[]" />
                                        <label for="sidewalk_curbs_gutter">Sidewalk, Curbs & Gutter</label>
                                    </div>
                                    <div class="checkbox_group" style="float:none;">
                                        <input value="water_line" class="checkbox" id="water_line" type="checkbox" name="specs[]" />
                                        <label for="water_line">Water Line</label>
                                    </div>
                                    <div class="checkbox_group" style="float:none;">
                                        <input value="others" class="checkbox" id="others" type="checkbox" name="specs[]" />
                                        <label for="others">Others</label>
                                    </div>
                                </div>
                            </div>                
                        </td>
                    </tr>
                    
                    <thead>
                        <tr>
                            <td colspan="4">Contractor Details</td>
                        </tr>
                    </thead> 
                    
                    <tr>
                        <td>Contractor Type:</td>
                        <td>
                            <select name="contractor[str][option_contractor_type_id]" style="width: 100%;">
	                          <option value="in_house">In-house</option>
	                          <option value="external">External</option>                            	
	                        </select>                       
                        </td>
                        <td>Status:</td>
                        <td>
                            <select name="contractor[str][option_contractor_status_id]" style="width: 100%;">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>                       
                        </td>
                    </tr>                    
                    <tr>
                        <td>Company Name:</td>
                        <td>
                            <div class="details"><input type="text" name="contractor[str][contractor_name]" /></div>                    
                        </td>
                        <td>Business Permit Number:</td>
                        <td>
                            <div class="details"><input type="text" name="contractor[str][contractor_business_permit_number]" /></div>                    
                        </td>
                    </tr>
                    <tr>
                        <td>Owner:</td>
                        <td>
                            <div class="details"><input type="text" name="contractor[str][contractor_owner]" /></div>                    
                        </td>
                        <td>Business Address:</td>
                        <td>
                            <div class="details"><input type="text" name="contractor[str][contractor_address]" /></div>                    
                        </td>
                    </tr>
                    <tr>
                        <td>Email Address:</td>
                        <td>
                            <div class="details"><input type="text" name="contractor[str][contractor_email]" /></div>                    
                        </td>
                        <td>Phone Number:</td>
                        <td>
                            <div class="details"><input type="text" name="contractor[str][contractor_landline]" /></div>                    
                        </td>
                    </tr>
                    <tr>
                        <td>Fax Number:</td>
                        <td>
                            <div class="details"><input type="text" name="contractor[str][contractor_fax]" /></div>                    
                        </td>
                        <td>Mobile Number:</td>
                        <td>
                            <div class="details"><input type="text" name="contractor[str][contractor_mobile]" /></div>                    
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Comment :</td>
                        <td colspan="3"><textarea name="contractor[str][contractor_comment]" style="height:100px; width: 100%;"></textarea></td>
                    </tr>


                    <tr valign="middle">
                       <td colspan="4" align="center">                  		
                            <div class="content_block_vpad">                       				
                                <a href="/engineering_contractor/contractors/" class="link_button_inline red">Cancel</a>
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
var _h;	
var _l;	

	
    function s_form()
    {
		_h   	 = $('._housing_check').prop('checked');
		_l   	 = $('._land_check').prop('checked');
		
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