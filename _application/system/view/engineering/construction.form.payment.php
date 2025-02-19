<div id="content_body">    
       
      <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/engineering/construction/submit_payment/&id=<?=$_VIEW['lot_construction_id']?>" method="post" name="alsc_form">
           		<input type="hidden" value="<?=$_VIEW['lot_construction_id']?>" name="id" />
           		<input type="hidden" value="<?=$_VIEW['lot_construction_id']?>" name="payment[int][lot_construction_id]" />
                
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="4">Release Contractor Payment</td>
                        </tr>
                    </thead>        
                    <tr>
                        <td class="color_gray">Contractor's Price:</td>
                        <td>1,000,000.00</td>
                        <td class="color_gray">Payment Percentage:</td>
                        <td>
                        	<select id="c_status" name="payment[int][lot_construction_payment_percent]" style="width: 100%;" >
	                            <option value="0">Choose one</option>
	                            <option value="25" selected="25">25%(Less 5%)</option>
	                            <option value="50">50%(Less 5%)</option>
	                            <option value="75">75%(Less 5%)</option>
	                            <option value="100">100%(Less 5%)</option>                     	
	                        </select>                       
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td class="color_gray">Amount Paid:</td>
                        <td>
                        	<input  type="text" name="payment[int][lot_construction_payment_amount]">                      
                        </td>
                        <td class="color_gray">Date Paid:</td>
                        <td>
                        	<input class="_date_" type="text" name="payment[int][lot_construction_payment_date_paid]">                      
                        </td>
                    </tr>
                    
                    <tr>
                        
                        <td colspan="2"></td>
                    </tr>
                    
                    <thead>
                        <tr>
                            <td colspan="4">Remarks</td>
                        </tr>
                    </thead>
                    
                    <tr>
                    	<td colspan="4">
                    		<input type="hidden" name="remark[str][remark_key]" value="lot_construction" />	                              
                            <textarea id="remark_area" name="remark[textarea][remark_content]" style="height: 150px; width:100%;" ></textarea>
                    	</td>
                    </tr>
                    
                    
                    <tr valign="middle">
	                       <td colspan="4" align="center">                  		
                       			<div class="content_block_vpad">                       				
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


