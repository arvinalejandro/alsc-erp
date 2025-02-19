<div id="content_body">    
  
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0px;">     
         <form action="/finance_accounting/add_chart/submit_child" name="alsc_form" method="post">
        <table class="mar_custom" id="_account_" style="font-weight:normal; padding-top: 20px;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
          
            <tbody>
                <tr>
                    <td><div class="details">Child Code :</div></td>      
                    <td><div class="details"><input type="text" name="option_account_chart_child_code" /></div></td>  
                     <td><div class="details">Child ID :</div></td>      
                    <td><div class="details"><input type="text" name="option_account_chart_child_id" /></div></td>    
                   <td><div class="details">Child Name :</div></td>      
                    <td><div class="details"><input type="text" name="option_account_chart_child_name" /></div></td>  
                     <td><div class="details">Parent :</div></td>      
                    <td><div class="details">
                    <select name="option_account_chart_parent_id">
                    <?=$_VIEW['parent_opt']?>
                    </select></div></td>  
                </tr>
               <tr>
                    <td align="right" colspan="8">
                        <div class="pad_standard">
                            <a href="#" class="link_button_inline blue" onclick="submit_form('alsc_form')">Submit</a>
                        </div>
                    </td>
                </tr>
               
            </tbody>
        </table> 
        <label style="padding-bottom:40px;"></label>
    </div>  

</div>