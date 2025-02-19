
<input type="hidden" name="client[int][user_id]" value="{user_id}" />

<table class="_form mar_custom _form display_none" id="_client_" style="font-weight:normal;" width="90%" cellpadding="8" cellspacing="0" border="0">     
    <thead><tr><td colspan="3">Personal Details</td></tr></thead>
	<tr>                    
	    <td> 
	        <span class="font_size_10">Last Name</span>
	        <input type="text" name="client[str][client_surname]" value="" />
	    </td>
	    <td>
	        <span class="font_size_10">First Name</span>
	        <input type="text" name="client[str][client_name]" value="" />
	    </td>
	    <td>
	        <span class="font_size_10">Middle Name</span>
	        <input type="text" name="client[str][client_middle_name]" value="" />
	    </td>
	    
	</tr>
	
	<tr>                    
	    <td>
            <span class="font_size_10">Gender</span>
	        <select name="client[str][option_gender_id]">
                <option value="0"></option>
	           	{option_gender}
	        </select>
	    </td>
	    <td>
	        <span class="font_size_10">Civil Status</span>
	        <select  name="client[str][option_civil_status_id]">
                <option value="0"></option>
	           {option_civil_status}
	        </select>
	    </td>
	    <td>
	        <span class="font_size_10">Employment</span>
	        <select class="float_left" name="client[str][option_employment_id]">
                <option value="0"></option>
	           {option_employment}
	        </select>
	    </td>                    
	</tr>
	
	<tr>                    
	    <td>
	        <span class="font_size_10">Birthday</span>
	        <input type="text" name="client[str][client_birthday]" value="" class="_date_" />
	    </td>
	    <td>
	        <span class="font_size_10">Birth Place</span>
	        <input type="text" name="client[str][client_birth_place]" value="" />
	    </td>
	    <td>
	       
	    </td>                    
	</tr>
	
	<tr>                    
	    <td>
	        <span class="font_size_10">TIN</span>
	        <input type="text" name="client[str][client_tin]" value="" />
	    </td>
	    <td>
	        <span class="font_size_10">SSS</span>
	        <input type="text" name="client[str][client_sss]" value="" />
	    </td>
	    <td>
	        
	    </td>                    
	</tr>               
	
	<thead><tr><td colspan="3"><h1>Contact Details</h1></td></tr></thead>
	
	<tr>   
        <td>
	        <span class="font_size_10">Landline Number</span>
	         <input type="text" name="client[str][client_telephone]" value="" />
	    </td>                  
	    <td>
	        <span class="font_size_10">Mobile Number</span>
	        <input type="text" name="client[str][client_mobile]" value="" />
	    </td>                    
	    <td>
	        <span class="font_size_10">Email</span>
	         <input type="text" name="client[str][client_email]" value="" />
	    </td>                    
	</tr>
	
	<tr>                    
	    <td colspan="3">
	        <span class="font_size_10">Local Address</span>
	        <input type="text" name="client[str][client_address]" value="" />
	    </td>                    
	                       
	</tr>
	
	<tr>   
        <td>
	        <span class="font_size_10">City/Province</span>
	         <input type="text" name="client[str][client_city]" value="" />
	    </td>                  
	    <td>
	        <span class="font_size_10">Zip Code</span>
	        <input type="text" name="client[str][client_zip]" value="" />
	    </td>                    
	    <td>
	        <span class="font_size_10">Use Address</span>
	        <select name="client[str][option_client_address_id]">                        	
	          {option_client_address}
	        </select>
	    </td>                    
	</tr>
	
	<tr>                    
	    <td colspan="3">
	        <span class="font_size_10">International Address</span>
	        <input type="text" name="client[str][client_address_abroad]" value="" />
	    </td>                    
	                      
	</tr>
    
    <tr class="_clone_0">
        <td colspan="2"><h1>Additional Buyer Name</h1></td>
        <td align="right"><a class="link_button_inline green" onclick="add_member(this)">+</a></td>
    </tr>
    <tr>
        <td colspan="3" class="bg_fff">
            <div class="mar_custom" style="margin-top:10px; width:306px;">
                <a class="link_button_inline float_left blue" style="border-radius:3px 0 0 3px; width:80px;" onclick="next_form('investment')">Back</a>
                <a class="link_button_inline float_left gray" style="border-radius:0; width:80px;" href="/edp_client">Cancel</a>
                <a class="link_button_inline float_left blue" style="border-radius:0 3px 3px 0; width:80px;" onclick="next_form('reservation')">Next</a>
                <label style="margin-bottom: 8px;"></label>
            </div>
        </td>  
    </tr>   
</table>
        		
                
        		

