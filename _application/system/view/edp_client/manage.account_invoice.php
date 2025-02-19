
<div id="content_body">    
    
    <?=$_VIEW['side_nav']?>
       
    <!---------- MAIN CONTENT ----------->
    <div id="side_listings" style="margin-left:180px;">
    
        
        <div class="mar_custom" style="padding-bottom: 5px;" id="controls">
            
            <b class="font_size_18">
               <?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?> :  <?=$_VIEW['client_account_number']?>
            </b>

            <label></label>
        </div> 
        
        <!---------- CONTENT CONTROLLERS ----------->         
        
        <div style="overflow: auto;" id="_right_content_">
           	<form action="/edp_client/edp_client_manage/submit_member" method="post" name="alsc_form">
           	<input type="hidden" name="client_id" value="<?=$_GET['id']?>" />
           	<input type="hidden" name="int[user_id]" value="<?=$_VIEW['user_id']?>" />
            	
            	<table class="mar_standard display_none" width="98%" cellpadding="5" cellspacing="0" border="0">                   
                    <tr>                        
                        <td width="10%"><b>Account Status</b></td> 
                        <td width="15%"><div class="details">TEST</div></td> 
                        <td width="10%"><b>Payment Type 1</b></td> 
                        <td width="15%"><div class="details">TEST</div></td> 
                        <td width="10%"><b>Payment Type 2</b></td> 
                        <td width="15%"><div class="details">TEST</div></td>                                                              
                    </tr>  
                    <tr>                        
                        <td><b>Paid Principal</b></td> 
                        <td><div class="details">TEST</div></td> 
                        <td><b>Paid Interest</b></td> 
                        <td><div class="details">TEST</div></td> 
                        <td><b>Paid Surcharge</b></td> 
                        <td><div class="details">TEST</div></td>                                                              
                    </tr>
                    <tr>                        
                        <td><b>Total Outstanding Balance</b></td> 
                        <td colspan="2"><div class="details">TEST</div></td>                          
                        <td><b>Total Paid Balance</b></td> 
                        <td colspan="2"><div class="details">TEST</div></td>                                                              
                    </tr> 
                     
                </table>
            	
                <table class="mar_standard" width="98%" cellpadding="5" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <td>Date Due</td>
                            <td>Pay Date</td>                           
                            <td width="180px">Period</td>                    
                            <td>Monthly Amortization</td>                               
                            <td>Rebate</td>
                            <td>Surcharge</td>
                            <td>Interest</td>
                            <td>Principal Amount</td>
                            <td>Outstanding Balance</td>                                               
                        </tr>
                    </thead>
                    <tbody>
                        <?=$_VIEW['row.manage.account_invoice']?>                       
                    </tbody>  
                </table>
                </form>
             
           
    </div>
    <label></label>
</div>
<script type="text/javascript">

	var add_toggle = false;
	
	function toggle()
	{
		if(add_toggle)
		{			
			$('._add').addClass('display_none');
			add_toggle = false;
		}
		else
		{			
			$('._add').removeClass('display_none');
			add_toggle = true;
		}
	}
	
	
</script>

