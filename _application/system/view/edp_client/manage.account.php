
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
               <?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?>
            </b>
			<!--
            <a class="float_right link_button_inline blue" style="margin-left:20px;" href="/edp_client/edp_client_manage/account_add_other/&id=<?=$_VIEW['client_id']?>">Add Other Account</a>    
            <a class="float_right link_button_inline blue" href="/edp_client/edp_client_manage/account_add_house/&id=<?=$_VIEW['client_id']?>">Add House Only Account</a>  
            -->
              
            <a class="float_right link_button_inline blue" href="/edp_client/edp_client_manage/add_client_lot_account/&client_id=<?=$_VIEW['client_id']?>&ajax=1">Add Lot Account</a>  
            
            <label></label>
        </div> 
        
        <!---------- CONTENT CONTROLLERS ----------->         
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">                
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
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
        </div>    
    </div>
    <label></label>
</div>


<script type=text/javascript>
   
    
</script>