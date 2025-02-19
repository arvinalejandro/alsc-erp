<div id="content_body">    
       
      <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/engineering/construction/submit_add_timetable/" method="post" name="alsc_form">
           		<input type="hidden" value="<?=$_VIEW['lot_construction_id']?>" name="id" />
           		<input type="hidden" value="<?=$_VIEW['lot_construction_id']?>" name="timetable[int][lot_construction_id]" />
                
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="2">Time Table</td>
                        </tr>
                    </thead>        
                    
                    <tr>
                        <td class="color_gray">
                            Task:
                        </td>
                        <td>
                        	<input id="c_actual" type="text" name="timetable[str][lot_construction_time_table_task]">                      
                        </td>
                    </tr>
                    
                  
                     <tr>
                        <td class="color_gray">
                            Date Started:
                        </td>
                        <td>
                        	<input class="_date_"  type="text" name="timetable[int][lot_construction_time_table_date_start]">                      
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                            Date Completed:
                        </td>
                        <td>
                        	<input  class="_date_" type="text" name="timetable[int][lot_construction_time_table_date_complete]">                      
                        </td>
                    </tr>
                    
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Remarks:</b></td>
                        </tr>
                    </thead>
                    
                    <tr>
                    	<td colspan="4">
                    		<input type="hidden" name="remark[str][remark_key]" value="lot_construction_time_table" />	                              
                            <textarea id="remark_area" name="remark[textarea][remark_content]" style="height: 150px; width:100%;" ></textarea>
                    	</td>
                    </tr>
                    
                    
                    <tr valign="middle">
	                       <td colspan="2" align="center">                  		
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


