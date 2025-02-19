<div id="content_body">  
    <?=$_VIEW['side_nav']?>  
    
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS -----------> 
         
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <div class="float_left" style="width: 50%;">                
                <b class="font_size_18">Cash Receipts / Cash Disbursement Journal Voucher Summary</b>            
            </div>
            
            <a href="#" class="float_right link_button_inline blue font_size_14 ">March 2015</a>
            <input type="text" class="_date_ float_right link_button_inline display_none" onchange="" name="report_date">
            
            <a href="#" class="float_right link_button_inline blue font_size_14" style="margin-right:10px;" onclick="open_form()">Print</a>
            <label></label>
        </div> 
        <div style="overflow: auto;" id="_right_content_">
            
            <table class="mar_custom" width="70%" cellpadding="3" cellspacing="0" border="0" style="margin-top:20px;">
                <thead>
                    <tr>                          
                        <td>Asset Accounts</td>
                        <td align="right">DR</td>
                        <td align="right">CR</td>
                    </tr>
                </thead>
                
                <tbody align="right"> 
                <!--
                <tr>
                        <td align="left">Unliquidated</td>
                        <td style="border-bottom:1px solid gray;">0.00</td>
                        <td style="border-bottom:1px solid gray;"><?=string_amount($_VIEW['row.report']['unliquidated_total'])?></td>
                    </tr>  
                <?=$_VIEW['row.report']['list']?>
                -->    
                
                    <tr>
                        <td align="left">Cash on Hand</td>
                        <td style="border-bottom:1px solid gray;">1,234,567,890.00</td>
                        <td style="border-bottom:1px solid gray;">1,234,567,890.00</td>
                    </tr>      
                    <tr>
                        <td align="left">Cash in Bank</td>
                        <td style="border-bottom:1px solid gray;">12,234,567,890.00</td>
                        <td style="border-bottom:1px solid gray;">12,234,567,890.00</td>
                    </tr> 
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Far East/Bpi-Balintawak</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Security Bank-Malolos</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">RBSR</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">RBPI</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">PNP-Malolos</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Planters-Main</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left">Dollar Deposits</td>
                        <td style="border-bottom:1px solid gray;">100,000,000.55</td>
                        <td style="border-bottom:1px solid gray;">100,000,000.55</td>
                    </tr> 
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">PNB-$-SA</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">SBC -$-SA</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left">Other Expenses</td>
                        <td style="border-bottom:1px solid gray;">100,000,000.55</td>
                        <td style="border-bottom:1px solid gray;">100,000,000.55</td>
                    </tr> 
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Executive</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Admin</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Caloocan</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;"></div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">EDP</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;"></div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Engineering</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;"></div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Finance</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;"></div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Project Admin</div></td>
                        <td><div class="details" style="margin-left: 20px;"></div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr>
                    <tr>
                        <td align="left"><div class="details" style="margin-left: 20px;">Marketing</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                        <td><div class="details" style="margin-left: 20px;">10,000,000.55</div></td>
                    </tr> 
                    

                    <!-- last row -->
                    <tr class="selected">        
                        <td align="center" style="border-top:1px solid gray; border-bottom:2px solid gray;">GRAND TOTAL</td>
                        <td style="border-top:1px solid gray; border-bottom:2px solid gray;"><?=string_amount($_VIEW['row.report']['dr_total'])?></td>
                        <td style="border-top:1px solid gray; border-bottom:2px solid gray;"><?=string_amount($_VIEW['row.report']['cr_total'])?> </t>
                    </tr>
                </tbody>  
            </table>
            <label style="margin-bottom: 100px;"></label>
            
            <script type="text/javascript">
                function open_form()
                {
                    var myWindow = window.open("http://alsc/finance_accounting/accounting_report_form/trial_balance", "_blank", "width=1000, height=600, toolbar=no, scrollbars=yes, resizable=no, resizable=yes, top=50, left=50, location=no");
                }    
            </script>
            
        </div>    
    </div>
    <label></label>
</div>