
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
    	
    	<div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
              Document List
            </b>
             <a href="/engineering/construction/add_document/&id=<?=$_VIEW['lot_construction_id']?>" class="link_button_inline blue float_right" style="margin-left:5px;">
                <span class="add"></span>
	    		Add Document
            </a> 

            <label></label>
        </div>
        
        
    	
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="mar_custom" id="client_profile">
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                 <thead>
                       <tr>   
                        <td>
                            Document Type                 
                        </td>
                        <td>
                            Received By              
                        </td>
                        <td>
                           Date Submitted                
                        </td>
                        <td>
                            Expiry Date                 
                        </td>
                        <td width="10%"></td> 
                       </tr>
                    </thead>
                <tbody>
                	<?=$_VIEW['doc_list']?>                   
                </tbody>  
            </table>
            <label></label>
            </div>  
        </div>    
    </div>
    <label></label>
</div>


