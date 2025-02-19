<div id="content_body">    
       
   <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0;">    
        <div class="mar_custom align_center" style="padding-bottom: 5px;" id="controls">

            <span class="mar_h">Choose request type: </span>
            <a href="/finance_disbursement/request/tba" class="link_button_inline green" >TBA</a>
            <a href="/finance_disbursement/request/request_for_payment" class="link_button_inline blue" >RFP</a>
            <a href="/finance_disbursement/request/ofv" class="link_button_inline blue" >OFV</a>
        </div>  
     
        <div style="overflow: auto; padding-top: 20px;" id="_right_content_">  <!--set max-height by making it dynamic -->              
                                          
            <form action="/finance_disbursement/request/submit_add_ticket" name="alsc_form" method="post">
            <input type="hidden" value="tba" name="payable[str][request_type_id]"/>
                <table class="mar_custom" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0" >                  
                    <thead>
                        <tr>
                            <td><h1>TBA Form</h1></td>
                            <td colspan="3"><h1>ID No. 15236</h1></td>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr>                        
                            <td>Date Requested :</td>
                            <td><span><?=string_date_time(time())?>  <input type="hidden" value="<?=time()?>" name="payable[int][account_payable_timestamp]"/></span></td>
                            <td>Recommended by :</td>
                            <td><span><?=$_VIEW['_user_']['user_name']?> <?=$_VIEW['_user_']['user_surname']?><input type="hidden" value="<?=$_VIEW['_user_']['user_name']?> <?=$_VIEW['_user_']['user_surname']?>" name="payable[str][request_recommended_by]"/></span></td>
                        </tr>
                        <tr>                        
                            
                            <td><b>Department :</b></td>
                             <td> 
                                <select name="payable[str][option_department_id]">
                                    <option value="0" disabled selected>Choose department</option>
                                    <?=$_VIEW['dept_option']?>
                                </select>
                            </td>
                            <td width="15%">Requestor :</td>
                            <td>
                                <div class="position_relative">
                               <input type="text" name="payable[str][request_requestor]" />
                                    <div class="drop_menu_body display_none" id="req_menu">
                                        <div class="drop_menu" style="opacity:1;">
                                            <a href="#" class="_requestor">delos Santos, Mizel</a>
                                            <a href="#" class="_requestor">Alejandro, Arnie</a>
                                            <a href="#" class="_requestor">Alejandro, Arvin</a>
                                            <a href="#" class="_requestor">Buhain, Amando</a>
                                            <a href="#" class="_requestor">Caluag, Raymond</a>
                                            <a href="#" class="_requestor">Lawas, Leariza</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>                        
                            <td>Amount :</td>
                            <td><input type="text" name="payable[int][request_amount]"/></td>                        
                            <td>Purpose :</td>
                            <td><input type="text" name="payable[str][request_purpose]"/></td>
                        </tr>
                        <tr>                        
                            <td>Accounted to :</td>
                            <td><input type="text" name="payable[str][request_accounted_to]"/></td>
                            <td>Payment Form:</td>
                            <td> 
                                <select id="_pmform" name="payable[str][option_payment_method_id]">
                                    <option value="x" disabled selected>Choose payment form</option>
                                    <?=$_VIEW['payment_option']?>
                                </select>
                            </td>   
                        </tr>
                        <tr>
                            <td>Date Needed :</td>
                            <td><input id="_date" type="text" class="_date_" name="payable[str][request_date_needed]"/></td>  
                            <td>Status :</td>
                            <td class="color_gray bold">Pending</td>
                        </tr>
                        <tr>                        
                            <td>Details :</td>
                            <td colspan="3"><textarea style="height:100px; width: 100%;" name="payable[str][request_details]"></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="4" align="center">
                                <div class="pad_standard">
                                   <a href="#" class="link_button_inline gray" onclick="go_to('/finance_disbursement/request/')">Cancel</a>
                                    <a href="#" class="link_button_inline blue" onclick="submit_form('alsc_form')">Submit</a>
                                </div>
                            </td>
                        </tr>  
                    </tbody>
                </table>    
            </form>
            <script type="text/javascript">
                
                GLOBALS.events.add('ready', my_init);
                
                function my_init()
                {
                    $('._requestor').click(function()
                    {
                    
                       var myHtml   =    $(this).html();
                       $('#req_target').val(myHtml);
                       $('#req_menu').addClass('display_none');
                    
                    });
                }
                
                 function show_req(id)
                {
                    $(".req_f").addClass("display_none");
                    $('#'+id).removeClass("display_none");
                }
                
                
            
            </script>
            
            <label style="margin-bottom:20px;"></label>        
            
        </div>    
    </div>
    <label></label>

</div>

<script type="text/javascript">

    function show_req_menu()
    {
        $('#req_menu').removeClass('display_none');
    }

</script>