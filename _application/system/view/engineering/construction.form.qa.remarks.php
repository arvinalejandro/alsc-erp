<div id="content_body">    
       
      <?=$_VIEW['side_nav']?>
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS ----------->        
        
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/engineering/construction/update_status/&id=<?=$_VIEW['lot_construction_id']?>" method="post" name="alsc_form">
           		<input type="hidden" value="<?=$_VIEW['lot_construction_id']?>" name="id" />
                
	            <table width="70%" cellpadding="10" cellspacing="0" border="0" style="font-weight:normal; margin-top: 20px;" align="center">                    
                    <thead>
                        <tr>
                            <td colspan="2">Construction Status</td>
                        </tr>
                    </thead>        
                    <tr>
                        <td class="color_gray">
                            Status:
                        </td>
                        <td>
                        	<select id="c_status" name="lot_construction[str][option_unit_status_id]" style="width: 100%;" onchange="h_form()">
	                            <option value="0"></option>
	                            	 <?=$_VIEW['unit_status']?>                            	
	                        </select>                       
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                            Estimated Cost:
                        </td>
                        <td>
                        	P <?=string_amount($_VIEW['lot_construction_cost_estimate'])?>     
                        	<input id="c_estimate" type="hidden" value="<?=$_VIEW['lot_construction_cost_estimate']?>" name="lot_construction[int][lot_construction_cost_estimate]" />                
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                            Actual Cost:
                        </td>
                        <td>
                        	<input id="c_actual" type="text" onchange="h_form()" value=" <?=$_VIEW['lot_construction_cost_actual']?> " name="lot_construction[int][lot_construction_cost_actual]">                      
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="color_gray">
                            Date Started:
                        </td>
                        <td>
                        	<?=string_date($_VIEW['lot_construction_date_start'])?>    
                        	<input id="c_start" type="hidden" onchange="h_form()" value="<?=string_date($_VIEW['lot_construction_date_start'])?>" name="lot_construction[int][lot_construction_date_start]" />                    
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td class="color_gray">
                            Date Completed:
                        </td>
                        <td>
                        	<input id="c_complete" onchange="h_form()" class="_date_" value=" <?=$_VIEW['lot_construction_date_complete']?> " type="text" name="lot_construction[int][lot_construction_date_complete]">                      
                        </td>
                    </tr>
                    
                    <thead>
                        <tr>
                            <td colspan="4"><b style="font-size: 12px;">Remarks:</b></td>
                        </tr>
                    </thead>
                    
                    <tr>
                    	<td colspan="4">
                    		<input type="hidden" name="remark[str][remark_key]" value="lot_construction" />	                              
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
<script type="text/javascript">
var param;	
var stat;	
var e_cost;	
var a_cost;	
var s_date;	
var c_date;	
	
    function h_form()
    {
		stat   	 = $("#c_status option:selected").text();
		e_cost   = $("#c_estimate").val();
		a_cost   = $("#c_actual").val();
		s_date   = $("#c_start").val();
		c_date   = $("#c_complete").val();
        param    = '\n\n\n\n\n-------------------Project QA Remark-------------------\n\n';
        
        param   += 'Construction Staus: '+stat+'\n';
        param   += 'Estimated Cost: '+e_cost+'\n';
        param   += 'Actual Cost: '+a_cost+'\n';
        param   += 'Date Started: '+s_date+'\n';
        param   += 'Date Completed: '+c_date+'\n';
       
	   $('#remark_area').html(param); 
        
        
        
    }
</script>

