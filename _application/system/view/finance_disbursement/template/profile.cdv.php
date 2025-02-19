<table border="0" width="90%" class="mar_custom" cellpadding="5" cellspacing="0" style="font-weight: normal; margin:40px auto;">
                            <thead>
                                <tr>
                                    <td colspan="3" style="background-color: #2D5788; border: 0;">
                                        <div style="width: 100px;" class="float_left mar_h">Particulars :</div>
                                        <div class="float_left" id="_display_particulars">
                                            {particulars}
                                        </div>
                                        <label></label>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td style="background-color:#888888; border: 0;">Account Name</td>
                                    <td colspan="2" style="background-color:#888888; border: 0;">Amount</td>
                                </tr>
                                <tr style="color:#282f39; background-color: #ffffff;" align="center">
                                    <td></td>
                                    <td style="border-left:1px solid #888888;">Debit</td>
                                    <td style="border-left:1px solid #888888;">Credit</td>
                                </tr>
                            </thead>
                            <tbody>
                               
                                {rows.cdv}
                                
                                <tr style="color:#282f39; background-color: #ffffff;" class="_cdv_form_row">     
 								<td style="text-indent: 30px;">{cash_desc}</td>                 
    							<td align="right" style="border-left:1px solid #888888;"></td>                       
      							<td align="right" style="border-left:1px solid #888888;">P {cash_amt}</td>                  
		                        </tr>
		                        
		                        <tr style="color:#282f39; background-color: #ffffff;" class="_cdv_form_row">    
					     		<td style="text-indent: 30px;">Tax</td>                   
					      		<td align="right" style="border-left:1px solid #888888;"></td>                      
					     		<td align="right" style="border-left:1px solid #888888;">P {tax_amt}</td>                        
					     		</tr>    
                               
                            </tbody>
                        </table>