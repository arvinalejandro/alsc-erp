<table class="_form mar_custom _form display_none" id="_client_" style="font-weight:normal;" width="90%" cellpadding="8" cellspacing="0" border="0">     
    <thead><tr><td colspan="3"><h1>Personal Details</h1></td></tr></thead>
	<tr>                    
	    <td>
	        <span class="font_size_10">Last Name</span>
	        <input type="text" name="client[str][client_surname]" value="<?=$_VIEW['client_surname']?>" />
	    </td>
	    <td>
	        <span class="font_size_10">First Name</span>
	        <input type="text" name="client[str][client_name]" value="<?=$_VIEW['client_name']?>" />
	    </td>
	    <td>
	        <span class="font_size_10">Middle Name</span>
	        <input type="text" name="client[str][client_middle_name]" value="<?=$_VIEW['client_middle_name']?>" />
	    </td>
	    
	</tr>
	
	<tr>                    
	    <td>
            <span class="font_size_10">Gender</span>
	        <select name="client[int][option_gender_id]">
                <option value="0"></option>
	            <?=$_VIEW['option_gender']?>
	        </select> 
	    </td>
	    <td>
	        <span class="font_size_10">Civil Status</span>
	        <select  name="client[int][option_civil_status_id]">
                <option value="0"></option>
	            <?=$_VIEW['option_civil_status']?>
	        </select>
	    </td>
	    <td>
	        <span class="font_size_10">Employment</span>
	        <select class="float_left" name="client[int][option_employment_id]">
                <option value="0"></option>
	            <?=$_VIEW['option_employment']?>
	        </select>
	    </td>                    
	</tr>
	
	<tr>                    
	    <td>
	        <span class="font_size_10">Birthday</span>
	        <input type="text" name="client[str][client_birthday]" value="<?=$_VIEW['client_birthday']?>" class="_date_" />
	    </td>
	    <td>
	        <span class="font_size_10">Birth Place</span>
	        <input type="text" name="client[str][client_birth_place]" value="<?=$_VIEW['client_birth_place']?>" />
	    </td>
	    <td>
	       
	    </td>                    
	</tr>
	
	<tr>                    
	    <td>
	        <span class="font_size_10">TIN</span>
	        <input type="text" name="client[str][client_tin]" value="<?=$_VIEW['client_tin']?>" />
	    </td>
	    <td>
	        <span class="font_size_10">SSS</span>
	        <input type="text" name="client[str][client_sss]" value="<?=$_VIEW['client_sss']?>" />
	    </td>
	    <td>
	        
	    </td>                    
	</tr>               
	
	<thead><tr><td colspan="3"><h1>Contact Details</h1></td></tr></thead>
	
	<tr>   
        <td>
	        <span class="font_size_10">Landline Number</span>
	         <input type="text" name="client[str][client_telephone]" value="<?=$_VIEW['client_telephone']?>" />
	    </td>                  
	    <td>
	        <span class="font_size_10">Mobile Number</span>
	        <input type="text" name="client[str][client_mobile]" value="<?=$_VIEW['client_mobile']?>" />
	    </td>                    
	    <td>
	        <span class="font_size_10">Email</span>
	         <input type="text" name="client[str][client_email]" value="<?=$_VIEW['client_email']?>" />
	    </td>                    
	</tr>
	
	<tr>                    
	    <td colspan="3">
	        <span class="font_size_10">Local Address</span>
	        <input type="text" name="client[str][client_address]" value="<?=$_VIEW['client_tin']?>" />
	    </td>                    
	                       
	</tr>
	
	<tr>   
        <td>
	        <span class="font_size_10">City/Province</span>
	         <input type="text" name="client[str][client_city]" value="<?=$_VIEW['client_city']?>" />
	    </td>                  
	    <td>
	        <span class="font_size_10">Zip Code</span>
	        <input type="text" name="client[str][client_zip]" value="<?=$_VIEW['client_zip']?>" />
	    </td>                    
	    <td>
	        <span class="font_size_10">Use Address</span>
	        <select name="client[int][option_client_address_id]">                        	
	            <?=$_VIEW['option_client_address']?>
	        </select>
	    </td>                    
	</tr>
	
	<tr>                    
	    <td colspan="3">
	        <span class="font_size_10">International Address</span>
	        <input type="text" name="client[str][client_address_abroad]" value="<?=$_VIEW['client_address_abroad']?>" />
	    </td>                    
	                      
	</tr>
    
    <tr class="_clone_0">
        <td colspan="2"><h1>Additional Buyer Name</h1></td>
        <td align="right"><a class="link_button_inline green" onclick="add_member(this)">+</a></td>
    </tr>
    
	<tr>
        <td colspan="3">
        	<div class="align_center" style="margin-top:10px;">
        		<a class="link_button_inline blue" onclick="next_form('investment')">Back</a>
				 <a class="link_button_inline gray" href="/edp_client">Cancel</a>		                
				<a class="link_button_inline blue" onclick="next_form('account')">Next</a>
			</div>  
			<br/> 
        </td>
    </tr>
</table>
        		
        		

