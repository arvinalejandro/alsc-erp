<div id="content_body">  
    <?=$_VIEW['side_nav']?>  
    
    <div id="side_listings" style="margin-left:180px;">
    
        <!---------- CONTENT CONTROLLERS -----------> 
         
        <div class="mar_custom" style="border:10px solid #eaeaea; border-bottom:10px solid #eaeaea; border-top:0; padding-bottom: 5px;" id="controls">
            
            <div class="float_left" style="width: 50%;">                
                <b class="font_size_18">Sales Distribution Report per Transaction Type</b>            
            </div>
            
            <a href="#" class="float_right link_button_inline blue font_size_14">March 2015</a>
            <a href="#" class="float_right link_button_inline blue font_size_14" style="margin-right:10px;" onclick="open_form()">Print</a>
            <label></label>
        </div> 
        <div style="overflow: auto;" id="_right_content_">
            
            <table class="mar_standard" width="98%" cellpadding="3" cellspacing="0" border="0">
                <thead  align="center">
                    <tr align="right">                 
                        <td align="center" rowspan="2">ALSC</td>            
                        <td rowspan="2">CDV#</td>
                        <td rowspan="2">Gross Amnt</td>
                        <td rowspan="2">Input VAT/Other Inc.</td>
                        <td rowspan="2">Cheque Amnt</td>
                        <td align="center" colspan="2" style="background-color:#527fb2;">Tax Base</td>
                        <td rowspan="2">Cheque Date</td>                
                    </tr>
                    <tr align="right">
                        <td style="background-color:#527fb2;">( 1% )</td>
                        <td style="background-color:#527fb2;">( 2% )</td>
                    </tr>
                </thead>
                
                <tbody align="right">                      
                    <tr>        
                        <td align="left"><div class="details">Commonwealth Insurance</div></td>
                        <td><div class="details">12-554</div></td>
                        <td><div class="details">2,900.91</div></td>
                        <td><div class="details">309.12</div></td>
                        <td><div class="details">3,159.51</div></td>
                        <td><div class="details"></div></td>
                        <td><div class="details">51.5</div></td>
                        <td><div class="details">02/04/15</div></td>
                    </tr>
                    <tr>        
                        <td align="left"><div class="details">Commonwealth Insurance</div></td>
                        <td><div class="details">12-555</div></td>
                        <td><div class="details">2,900.91</div></td>
                        <td><div class="details">309.12</div></td>
                        <td><div class="details">3,159.51</div></td>
                        <td><div class="details"></div></td>
                        <td><div class="details">51.5</div></td>
                        <td><div class="details">02/04/15</div></td>
                    </tr>
                    <tr>        
                        <td align="left"><div class="details">Jeca Gasoline</div></td>
                        <td><div class="details">12-556</div></td>
                        <td><div class="details">2,900.91</div></td>
                        <td><div class="details">309.12</div></td>
                        <td><div class="details">3,159.51</div></td>
                        <td><div class="details">31.41</div></td>
                        <td><div class="details"></div></td>
                        <td><div class="details">02/04/15</div></td>
                    </tr>
                    <tr>        
                        <td align="left"><div class="details">Emerigold Shell</div></td>
                        <td><div class="details">12-557</div></td>
                        <td><div class="details">111,985.04</div></td>
                        <td><div class="details">13,438.21</div></td>
                        <td><div class="details">124,303.40</div></td>
                        <td><div class="details">1,119.85</div></td>
                        <td><div class="details"></div></td>
                        <td><div class="details">02/04/15</div></td>
                    </tr>
                    <tr>        
                        <td align="left"><div class="details">Commonwealth Insurance</div></td>
                        <td><div class="details">12-554</div></td>
                        <td><div class="details">2,900.91</div></td>
                        <td><div class="details">309.12</div></td>
                        <td><div class="details">3,159.51</div></td>
                        <td><div class="details"></div></td>
                        <td><div class="details">51.5</div></td>
                        <td><div class="details">02/04/15</div></td>
                    </tr>
                    <tr>        
                        <td align="left"><div class="details">Commonwealth Insurance</div></td>
                        <td><div class="details">12-555</div></td>
                        <td><div class="details">2,900.91</div></td>
                        <td><div class="details">309.12</div></td>
                        <td><div class="details">3,159.51</div></td>
                        <td><div class="details"></div></td>
                        <td><div class="details">51.5</div></td>
                        <td><div class="details">02/04/15</div></td>
                    </tr>
                    <tr>        
                        <td align="left"><div class="details">Jeca Gasoline</div></td>
                        <td><div class="details">12-556</div></td>
                        <td><div class="details">2,900.91</div></td>
                        <td><div class="details">309.12</div></td>
                        <td><div class="details">3,159.51</div></td>
                        <td><div class="details">31.41</div></td>
                        <td><div class="details"></div></td>
                        <td><div class="details">02/04/15</div></td>
                    </tr>
                    <tr>        
                        <td align="left"><div class="details">Emerigold Shell</div></td>
                        <td><div class="details">12-557</div></td>
                        <td><div class="details">111,985.04</div></td>
                        <td><div class="details">13,438.21</div></td>
                        <td><div class="details">124,303.40</div></td>
                        <td><div class="details">1,119.85</div></td>
                        <td><div class="details"></div></td>
                        <td><div class="details">02/04/15</div></td>
                    </tr>

                    
                    <!-- last rows -->
                    <tr class="selected bold">        
                        <td align="center">Totals</td>
                        <td></td>
                        <td style="border-top:1px solid gray;">328,136.79</td>
                        <td style="border-top:1px solid gray;">36,435.07</td>
                        <td style="border-top:1px solid gray;">350,616.67</td>
                        <td style="border-top:1px solid gray;">1,546.17</td>
                        <td style="border-top:1px solid gray;">4,496.72</td>
                        <td></td>
                    </tr>    
                </tbody>  
            </table>
            <label></label>
            <script type="text/javascript">
                function open_form()
                {
                var myWindow = window.open("http://alsc/finance_accounting/accounting_report_form/non_tax_commission", "_blank", "width=1000, height=600, toolbar=no, scrollbars=yes, resizable=no, resizable=yes, top=50, left=50, location=no");
                }    
            </script>                     
        </div>    
    </div>
    <label></label>
</div>