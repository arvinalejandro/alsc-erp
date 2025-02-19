<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
                 Electric Reading
            </b>

            <label></label>
        </div> 
        
        <!---------- CONTENT CONTROLLERS ----------->        
        
        <div style="overflow: auto;" id="_right_content_">
               <form action="/engineering_wes/electric_reading/submit_input_reading/" method="post" name="alsc_form">
             <input id="current_charge" type="hidden" name="lot_wes_reading[int][lot_wes_reading_current_charge]">
             <input id="current_total" type="hidden" name="lot_wes_reading[int][lot_wes_reading_current_total]">
               <input id="surcharge" type="hidden" name="lot_wes_reading[int][lot_wes_reading_surcharge]">
               <input id="consumed" type="hidden" name="lot_wes_reading[int][lot_wes_reading_consumed]">
               <input id="tax_total" type="hidden" name="lot_wes_reading[int][lot_wes_reading_vat_total]">
               <input id="tax_rate" type="hidden" name="lot_wes_reading[int][lot_wes_reading_vat_rate]">
                <input id="reading_rate" type="hidden" name="lot_wes_reading[int][lot_wes_reading_rate]">
              <input  type="hidden" name="lot_wes_reading_id" value="<?=$_VIEW['lot_wes_reading_id']?>">
              <input  type="hidden" name="lot_wes_reading[str][lot_wes_reading_status_id]" value="for_billing">
                <table width="98%" cellpadding="5" cellspacing="0" border="0" style="font-weight:normal;" class="mar_standard">
                    <thead>
                        <tr>
                            <td colspan="8">Electric Reading Details</td>
                        </tr>
                    </thead> 
                           
                    <tr>
                        <td><b>Previous Reading:</b></td>
                        <td> <div class="details"><?=$_VIEW['lot_wes_prev_reading']?></div></td>
                        <td><b>Current Reading:</b></td>
                        <td> <div class="details"><input id="curr_read" value="<?=$_VIEW['lot_wes_curr_reading']?>" type="text" name="lot_wes_reading[int][lot_wes_curr_reading]" onkeyup="get_reading()" /></div></td>
                        <td><b>Consumption (KwH):</b></td>
                        <td> <div class="details" id="consumed_reading">0</div></td>
                        <td><b>Rate:</b></td>
                        <td> <div class="details"><span id="ppc">0.00</span> /KwH</div></td>
                    </tr> 
                    <tr>
                        <td><b>Bill Amt:</b></td>
                        <td> <div class="details" id="consumed_amount">P 0.00</div></td>
                        <td><b>VAT:</b></td>      <!-- can be negative amount-->
                         <td>  <div class="details" id="total_vat"></div></td>
                        <td><b></b></td>
                        <td> <div class="details"></div></td>
                        <td><b></b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>TOTAL AMOUNT DUE</b></td>
                        <td colspan="3"> <div class="details" id="total_bill">P 0.00</div></td>
                        <td colspan="4"></td>
                    </tr> 
                    <tr>
                       
                        <td colspan="8" align="center">                		
                       			<div class="content_block_vpad">                       				
                       				<a class="link_button_inline blue" onclick="submit_form('alsc_form')" >Submit</a>
                       			</div>               
	                    </td>
                    </tr> 
                </table>
                <label style="margin-top:40px;"></label>   
                
                
                
            </form>
            <label></label> 
      </div>    
    </div>
    <label></label>
</div>
<script type="text/javascript">
$( document ).ready(function() {
   comp_amt();
});

var vat_percent  			= 12;  
var previous_reading 		= <?=$_VIEW['lot_wes_prev_reading']?>;
var price_per_consumption 	= 0;
var total_due 				= 0;
var consumption_cost 		= 0;
var current_reading 		= 0;
var current_reading_holder  = 0;
var tax_multiplier			= 0;
var tax_total				= 0;
var current_total			= 0;
var rate_id					= <?=$_VIEW['option_wes_electric_rate_id']?>;

    function comp_amt()
    {
        tax_multiplier			=  string_amount(vat_percent)/100; 
        
        if($('#curr_read').val() < 1)
        {
			current_reading		= 0;
        }
        
        consumption_cost		=  current_reading*string_amount(price_per_consumption);
        tax_total				=  tax_multiplier*consumption_cost;
        current_total			=  string_amount(tax_total) + consumption_cost;
        
        $('#consumed_amount').html("P "+string_amount(consumption_cost,true));
        $('#total_vat').html("P "+string_amount(tax_total,true));
        $('#total_bill').html("P "+string_amount(current_total,true));
        $('#ppc').html(price_per_consumption);
        $('#consumed_reading').html(current_reading);
        $('#current_charge').val(consumption_cost);
        $('#surcharge').val(surcharge);
        $('#consumed').val(current_reading);
        $('#current_total').val(current_total);
        $('#tax_total').val(tax_total);
        $('#tax_rate').val(vat_percent);
        $('#reading_rate').val(price_per_consumption);
        
    }
    
    function get_reading()
	{
		current_reading     =  string_amount($('#curr_read').val()) -  string_amount(previous_reading);
		current_reading	    =  string_amount(current_reading);
		if(current_reading > 0)
		{
			if( current_reading != current_reading_holder)
			{
				current_reading_holder = current_reading;
				get_rate();
			}
			
		}
	}
    
	function get_rate(pParameter, pSuccess)
	{
	    
	    if(pSuccess)
	    {            
	        if(pParameter > 0)
	        {
				price_per_consumption = pParameter
				comp_amt();
	        }
	        else
	        {
				alert('Unavailable Rate for Current Reading')
	        }
	    }
	    else
	    {            
	        p_url        =    '/engineering_wes/electric_reading/get_rate';
	        p_post       =    'rate_id=' + rate_id + '&current_reading=' +current_reading;
	        p_handler    =    get_rate;                                      
	        global_ajax_request(p_url, p_handler, p_post);
	    }
	}
    
 

</script>