
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    	     
        
        <div style="overflow: auto;" id="_right_content_">
           
            <div class="pad_standard">            	
                <form name="alsc_form" method="post" action="/documentation/lot/submit_update">
                <input type="hidden" name="int[document_lot_id]" value=" <?=$_VIEW['document_lot_id']?>">
                <input type="hidden" name="int[lot_id]" value=" <?=$_VIEW['lot_id']?>">
                <table class="mar_custom" width="70%" cellpadding="5" cellspacing="0" border="0">
                
                    <thead>
                        <tr ><td colspan="2" align="center">Document Profile</td></tr>
                    </thead>                
                <tbody>                        
                    <tr >
            
                        <td>Document Type:</td>
                        <td >                            	                            
		                       
		                     <?=$_VIEW['document_type_name']?>
		                      	                       
                        </td>   
                    </tr>
                    
                     <tr >
            
                        <td>Date Submitted:</td>
                        <td >                                                            
                               
                            <input type="text" class="_date_" name="str[document_lot_date_submit]">
                                                         
                        </td>   
                    </tr>
                    
                      <tr >
            
                        <td>Date Cleared:</td>
                        <td >                                                            
                               
                            <input type="text" class="_date_" name="str[document_lot_date_cleared]">
                                                         
                        </td>   
                    </tr>
                    
                      <tr >
            
                        <td colspan="2" align="center">Received by:</td>
                         
                    </tr>
                      <tr >
            
                        <td>First Name:</td>
                        <td >                                                            
                               
                            <input type="text" name="str[document_lot_received_by_firstname]">
                                                         
                        </td>   
                    </tr>
                      <tr >
            
                        <td>Last Name:</td>
                        <td >                                                            
                               
                            <input type="text" name="str[document_lot_received_by_lastname]">
                                                         
                        </td>   
                    </tr>
                    
                    <tr >
            
                        <td>Status:</td>
                        <td >                                                             
                           <select name="int[document_lot_status]">
                           <option value="1">Cleared</option>
                           <option value="0">Pending</option>
                           </select>                         
                        </td>   
                    </tr>
                    
                 
                    <tr>                                          
                        <td align="center" width="30%" colspan="2">                             
                            <div class="content_block_vpad"><a class="link_button_inline green" onclick="submit_form('alsc_form')">Update</a></div>
                        </td>                        
                    </tr>            	
                    
                	                          
                </tbody>  
            </table>
            </form>
            <label></label>
            </div>  
        </div>    
    </div>
    <label></label>
</div> 


