                <table class="mar_custom" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
                    <thead>
                        <tr>
                            <td><h1>Tax - Payable</h1></td>
                            <td colspan="3"><h1>ID No. {account_payable_id}</h1></td>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr>   
                            <td>Date Requested :</td>
                            <td><span>{account_payable_timestamp}</span></td>
                            <td>Recommended by :</td>
                            <td><span>{request_recommended_by}</span></td>                     
                        </tr>
                        <tr>                        
                               
                            <td>Requested by :</td>
                            <td><span>{request_requestor}</span></td>
                            <td>Amount Requested :</td>
                            <td><span>P {request_amount}</span></td>   
                        </tr>
                        <tr>                        
                            <td>Status :</td>
                            <td colspan="3" class="color_blue bold">{request_approval_status_name}</td>
                        </tr>
                         <tr>                        
                            <td colspan="4">
                                <table class="mar_custom bg_fff" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">
                                    <tr style="background-color: #888888; color:#ffffff;">
                                        <td>Description</td>
                                        <td>Group</td>
                                        <td>Child</td>
                                        <td>Project</td>
                                        <td>Phase</td>
                                        <td>Gross Amount</td>
                                        <td>Net Amount</td>
                                        <td>Tax Percentage</td>
                                        <td>Tax Amount</td>
                                        
                                    </tr>
                                    {tax_row}
                                     <tr style="background-color:#F2F2F2;">
                                        <td  align="right" class="bold">Gross Total:</td>
                                        <td class="bold" colspan="2">P  {total_gross}</td>
                                        <td  align="right" class="bold">Net Total:</td>
                                        <td class="bold" colspan="2">P  {total_net}</td>
                                        <td  align="right" class="bold">Tax Total:</td>
                                        <td class="bold" colspan="2">P  {total_tax}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        
                       
                       
                    </tbody>
                </table>  