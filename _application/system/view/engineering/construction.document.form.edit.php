<div id="content_body">    
       
  <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
        <!---------- CONTENT CONTROLLERS ----------->        
        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/engineering/construction/submit_update_document/" method="post" name="alsc_form">
           	<input type="hidden" name="lot_construction_id" value="<?=$_VIEW['lot_construction_id']?>"> 
           	<input type="hidden" name="id" value="<?=$_VIEW['lot_construction_document_id']?>"> 
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="2">Edit Document</td>
                        </tr>
                    </thead>        
                    
                     <tr>
                        <td class="color_gray">
                           Date Submitted:
                        </td>
                        <td>
                        	<div class="details"><input class="_date_" type="text" value="<?=$_VIEW['date_submit']?>" name="document[int][lot_construction_document_date_submit]" /></div>                    
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                           Expiry Date:
                        </td>
                        <td>
                        	<div class="details"><input class="_date_" type="text" value="<?=$_VIEW['date_expire']?>" name="document[int][lot_construction_document_date_expire]" /></div>                    
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                            Document Type:
                        </td>
                        <td>
                        	<select name="document[str][lot_construction_document_type_id]" style="width: 100%;">
	                            <?=$_VIEW['doc_type']?>	                            	
	                        </select>                       
                        </td>
                    </tr>
                                        
                    
                    
                    
                    
                    <tr>
                        <td class="color_gray">
                           Received By:
                        </td>
                        <td>
                        	<div class="details"><input type="text" value="<?=$_VIEW['lot_construction_document_received_by']?>" name="document[str][lot_construction_document_received_by]" /></div>                    
                        </td>
                    </tr>
                    
                    
                    <tr valign="middle">
	                       <td colspan="2" align="center">                  		
                       			<div class="content_block_vpad">                       				
                       				<a href="/engineering/construction/document_list/&id=<?=$_VIEW['lot_construction_id']?>" class="link_button_inline red">Cancel</a>
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


