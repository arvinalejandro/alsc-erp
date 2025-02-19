<div id="content_body">     
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/edp_client/edp_client_manage/account_add_house_compute/&id=<?=$_VIEW['client_id']?>" method="post" name="alsc_form">           		
	            <table width="70%" cellpadding="3" cellspacing="0" border="0" style="font-weight:normal;" align="center">
                   	<thead>
                        <tr valign="middle">
                           <td colspan="2" align="center" style="padding-top: 8px; padding-bottom: 8px;">                          
                                   <b style="font-size: 14px;">Add House only Account for : <?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?></b>          
                           </td>
                        </tr>
                    </thead>           
                    <tr>
                        <td class="color_gray">
                            House Model:
                        </td>
                        <td>
                        	<select name="house_id" style="width: 100%;">
	                            <option value="0"></option>
	                            <?=$_VIEW['house']?>	                            	
	                        </select>                       
                        </td>
                    </tr>  
                    <tr>
        				<td colspan="2">
        					<div class="align_center" style="margin-top:10px;">
				                 <a class="link_button_inline gray" href="/edp_client/edp_client_manage/account/&id=<?=$_VIEW['client_id']?>">Cancel</a>				               
				                <a class="link_button_inline blue" onclick="submit_form('alsc_form')">Next</a>
				            </div> 
				            <br/> 
        				</td>
        			</tr>   
                                                
                </table>      
                
	            
            </form>
            <label></label>
                
            
            
        </div>    
    </div>
    <label></label>
</div>


