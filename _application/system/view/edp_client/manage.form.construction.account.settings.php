<table class="mar_custom _form display_none" id="_construction_account_settings_" style="font-weight:normal;" width="70%" cellpadding="8" cellspacing="0" border="0">
    <thead><tr><td colspan="4"><h1>Account Settings</h1></td></tr></thead>
    <tr>        			
        <td><b>Subject To Tax :</b></td>
        <td colspan="3">
        	<select name="client_account[int][client_account_is_vat]">
        		<option value="-"></option>
        		<option value="1">Yes</option>
        		<option value="0">No</option>
        	</select>        
        </td> 
        	
    </tr>
    <tr>        			
        <td><b>Account Unit Type :</b></td>
        <td colspan="3">
        	<select name="client_account[str][option_unit_account_type_id]">
        		{option_unit_account_type}
        	</select>        
        </td> 
        	
    </tr>
    <tr>        			
        <td width="20%"><b>Transaction Type: </b></td>
        <td width="30%"><select name="client_account[str][option_transaction_type_id]">{option_transaction_type}</select></td>
        <td width="20%"><b>Account Type: </b></td>        			
        <td width="30%"><select name="client_account[str][option_account_type_id]">{option_account_type}</select></td>	
    </tr>
    <tr>        			
        <td><b>Account Status: </b></td>
        <td><select name="client_account[str][option_account_status_id]">{option_account_status}</select></td>
        <td><b>Buyer Type: </b></td>        			
        <td><select name="client_account[str][option_buyer_type_id]">{option_buyer_type}</select></td>	
    </tr>    
    <tr>
        <td colspan="4" class="bg_fff">
            <div class="mar_custom" style="margin-top:10px; width:306px;">
                <a class="link_button_inline float_left blue" style="border-radius:3px 0 0 3px; width:80px;" onclick="next_form('construction_profile')">Back</a>
                <a class="link_button_inline float_left gray" style="border-radius:0; width:80px;" href="/edp_client">Cancel</a>
                <a class="link_button_inline float_left blue" style="border-radius:0 3px 3px 0; width:80px;" onclick="next_form('construction_computation')">Next</a>
                <label style="margin-bottom: 8px;"></label>
            </div>
        </td>  
    </tr> 
</table>