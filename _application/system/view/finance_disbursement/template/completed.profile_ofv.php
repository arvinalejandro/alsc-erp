                <table class="mar_custom" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
                    <thead>
                        <tr>
                            <td><h1>OFV - Replenish</h1></td>
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
                            <td>Department :</td>
                            <td><span>{option_department_name}</span></td>    
                            <td>Requested by :</td>
                            <td><span>{request_requestor}</span></td>
                        </tr>
                        <tr>                        
                            <td>Amount Requested :</td>
                            <td><span>P {request_amount}</span></td>                        
                          
                        </tr>
                        
                        
                         <tr>                        
                            <td colspan="4">
                                <table class="mar_custom bg_fff" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">
                                    <tr style="background-color: #888888; color:#ffffff;">
                                        <td width="10%">OFV Number</td>
                                        <td width="50%">Requested by:</td>
                                        <td>Date Released</td>
                                        <td>Amount</td>
                                    </tr>
                                    {items}
                                     <tr style="background-color:#ffffff;">
                                        <td colspan="3" align="right" class="bold">TOTAL</td>
                                        <td class="bold">P {total}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        
                        <tr>                        
                            <td>Status :</td>
                            <td colspan="3" class="color_blue bold">{request_approval_status_name}</td>
                        </tr>
                       
                    </tbody>
                </table>  