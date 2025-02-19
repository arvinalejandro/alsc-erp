<div id="content_body">    
       
   <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:0;">    
        <div class="mar_custom align_center" style="padding-bottom: 5px;" id="controls">

            <span class="mar_h">Choose request type: </span>
            <a href="/finance_disbursement/request/tba" class="link_button_inline blue" >TBA</a>
            <a href="/finance_disbursement/request/request_for_payment" class="link_button_inline blue" >RFP</a>
            <a href="/finance_disbursement/request/ofv" class="link_button_inline blue" >OFV</a>
        </div>  
     
        <div style="overflow: auto; padding-top: 20px;" id="_right_content_">  <!--set max-height by making it dynamic -->              
                                          

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