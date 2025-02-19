
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
    
        
        <div style="overflow: auto;" id="_right_content_">
       <table class="mar_custom" id="_account_" style="font-weight:normal; padding-top: 20px;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
   
		    <thead>
		        <tr>
		            <td colspan="3"><h1>Project Time Table Entry</h1></td>
		            <td colspan="1" align="right"> <a href="/engineering/construction/timetable_edit/&id=<?=$_VIEW['lot_construction_time_table_id']?>" class="link_button_inline blue">Edit Entry</a></td>
		        </tr>
		    </thead>
		    <tbody>
		       
		        <tr>                        
		            <td>Task :</td>
		            <td colspan="3"><div class="details"><?=$_VIEW['lot_construction_time_table_task']?></div></td>
		            
		        </tr>
		        
		        <tr>                        
		            <td>Date Started :</td>
		            <td><div class="details"><?=$_VIEW['date_start']?></div></td>                        
		            <td>Date Completed :</td>
		            <td><div class="details"><?=$_VIEW['date_complete']?></div></td>
		        </tr>
		        <tr>                        
		            <td>Logged By :</td>
		            <td><div class="details"><?=$_VIEW['logged_by']?></div></td>                        
		            <td>Date Logged :</td>
		            <td><div class="details"><?=$_VIEW['date_log']?></div></td>
		        </tr>
		       
		        <tr>
		            <td colspan="4"> <a href="/engineering/construction/timetable/&id=<?=$_VIEW['lot_construction_id']?>" class="link_button_inline blue"><< Back To List</a></td>
		        </tr>
		        
		    </tbody>
		</table>
             
        <label class="mar_h"></label>
            
            <table style="margin:10px auto;" width="80%" cellpadding="5" cellspacing="0" border="0">
                <tr class="selected">
                    <td>
                        <div style="width:90%; margin:0 auto;">
                            <form name="alsc_form" method="post" action="/engineering/construction/submit_timetable_remark">
                            <input type="hidden" name="lot_construction_time_table_id" value="<?=$_VIEW['lot_construction_time_table_id']?>" />
                            <input type="hidden" name="remark[str][remark_key]" value="lot_construction_time_table" />
                                <textarea style="width: 100%; height: 80px;" name="remark[str][remark_content]" id="remark_form"></textarea>
                            </form>
                            <label style="margin-bottom:5px;"></label>
                            <span class="font_size_14" style="font-weight:normal;">
                                You are posting a remark as
                                 <b><?=$_VIEW['_user_']['user_name']?> <?=$_VIEW['_user_']['user_surname']?></b>
                            </span>
                             <div style="float:right;">
                                <a class="link_button_inline green" onclick="submit_form('alsc_form')">Post Remark</a>
                                <a class="link_button_inline gray" onclick="clear_form()">Clear</a>
                            </div>   
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                        
                        <div id="remarks_section">
                             <?=$_VIEW['row.remark']?>                                                
                        </div>
                    </td>
                </tr>
            </table>           
           
           
        </div>    
    </div>
    <label></label>
</div>
  

