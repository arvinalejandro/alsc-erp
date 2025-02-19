
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
               <?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?>
            </b>

            <label></label>
        </div> 
        
        <!---------- CONTENT CONTROLLERS ----------->         
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/edp_client/edp_client_manage/submit_member" method="post" name="alsc_form">
           	<input type="hidden" name="client_id" value="<?=$_GET['id']?>" />
           	<input type="hidden" name="int[user_id]" value="<?=$_VIEW['user_id']?>" />
            <div class="mar_custom" id="client_profile">
                <table width="100%" cellpadding="3" cellspacing="0" border="0" style="font-weight:normal;">
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Personal Details</b></td>
                        </tr>
                    </thead>
                    <tr>
                        <td class="color_gray" width="15%">
                            Full Name:
                        </td>
                        <td width="35%">
                            <?=$_VIEW['client_name']?> <?=$_VIEW['client_middle_name']?> <?=$_VIEW['client_surname']?>
                        </td>
                        <td class="color_gray" width="15%">
                            Marital Status:
                        </td>
                        <td width="35%">
                            <?=$_VIEW['option_civil_status_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                            Sex:
                        </td>
                        <td>
                            <?=$_VIEW['option_gender_name']?>
                        </td>
                        <td class="color_gray">
                            Home Address :
                        </td>
                        <td>
                            <?=$_VIEW['client_address']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                           Zip Code
                        </td>
                        <td>
                            
                            <?=$_VIEW['client_zip']?>

                        </td>
                        <td class="color_gray">
                            Address in-use :
                        </td>
                        <td>        
                            <?=$_VIEW['option_client_address_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                           Email:
                        </td>
                        <td>
                            
                            <?=$_VIEW['client_email']?>

                        </td>
                        <td class="color_gray">
                            Employment :
                        </td>
                        <td>        
                            <?=$_VIEW['option_employment_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                           Tel. No:
                        </td>
                        <td>                            
                            <?=$_VIEW['client_telephone']?>
                        </td>
                        <td class="color_gray">
                            Mobile Number :
                        </td>
                        <td>        
                            <?=$_VIEW['client_mobile']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="color_gray">
                           TIN:
                        </td>
                        <td>
                            
                            <?=$_VIEW['client_tin']?>

                        </td>
                        <td class="color_gray">
                            SSS :
                        </td>
                        <td>        
                            <?=$_VIEW['client_sss']?>
                        </td>
                    </tr>        
                                         
                </table>
                <label style="margin-bottom:20px;"></label>
                
                <table width="100%" cellpadding="3" cellspacing="0" border="0" style="font-weight:normal;">
                    <thead>
                        <tr>                                                
                            <td>
                                Full Name                         
                            </td>                            
                            <td>
                                Relationship
                            </td>  
                            <td align="center">
                                <a class="link_button_inline green font_size_10" onclick="toggle()">+ Add</a>
                            </td>                                  
                        </tr>
                    </thead>
                    
                    <tbody>                                
                        <?=$_VIEW['row.manage.member']?>
                           
                        <tr class="_add display_none">                        	
                        	<td><span class="font_size_10">Full Name</span><input type="text" name="str[client_member_name]" /></td>
                        	<td><span class="font_size_10">Relation</span><input type="text" name="str[client_member_relation]" /></td>
                        	<td align="center">                               
                            </td>
                        </tr> 
                        <tr class="_add display_none">    
                        	<td colspan="2" align="center">
                                <a class="link_button_inline gray font_size_10" onclick="submit_form('alsc_form')">save</a>
                            </td>
                            <td></td>
                        </tr>                       
                        
                    </tbody>  
                </table>
                <label style="margin-bottom:20px;"></label>
                
                <table width="100%" cellpadding="3" cellspacing="0" border="0" style="font-weight:normal;">
                    <thead>
                        <tr>                                                
                            <td>Account Number</td>
                            <td>Account Type</td>
                            <td>Type</td>                        
                            <td>Account Status</td>
                            <td>TCP</td>                                                           
                            <td align="center">Actions</td>                                                           
                        </tr>
                    </thead>
                    
                    <tbody>           
                    
                    	<?=$_VIEW['row.manage.account']?>                     
                              
                    </tbody>  
                </table>
                <label></label> 
                
            </div>
            </form>
        </div>  
    </div>    
    
    <label></label>
</div>


<script type="text/javascript">

	var add_toggle = false;
	
	function toggle()
	{
		if(add_toggle)
		{			
			$('._add').addClass('display_none');
			add_toggle = false;
		}
		else
		{			
			$('._add').removeClass('display_none');
			add_toggle = true;
		}
	}
	
	
</script>

