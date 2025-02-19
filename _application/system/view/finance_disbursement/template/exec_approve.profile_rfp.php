                <table class="mar_custom" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
                    <thead>
                        <tr>
                            <td><h1>Request For Payment</h1></td>
                            <td colspan="3"><h1>ID No. {account_payable_id}</h1></td>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr>                        
                            <td width="15%">Requested by : </td>
                            <td><span>{request_requestor}</span></td>
                            <td>Department :</td>
                            <td><span>{option_department_name}</span></td>
                        </tr>
                        <tr>                        
                            <td>Date Requested :</td>
                            <td><span>{account_payable_timestamp}</span></td>
                            <td>Recommended by :</td>
                            <td><span>{request_recommended_by}</span></td>
                        </tr>
                        <tr>                        
                            <td>Amount Requested :</td>
                            <td><span class="bold">P {request_amount}</span></td>                        
                            <td>Date Needed :</td>
                            <td><span>{request_date_needed}</span></td>
                        </tr>
                        <tr>
                            <td>Purpose :</td>
                            <td><span>{request_purpose}</span></td>
                            <td>Payment Form :</td>
                            <td><span>{option_payment_method_name}</span></td>
                        </tr>
                        <tr>                        
                            <td colspan="4">
                                <table class="mar_custom bg_fff" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">
                                    <tr style="background-color: #888888; color:#ffffff;">
                                        <td width="10%">Qty</td>
                                        <td width="50%">Description</td>
                                        <td>Price</td>
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
                            <td>Payable to :</td>
                            <td><span>{request_payable_to}</span></td>                        
                            <td>Address :</td>
                            <td><span>{request_address}</span></td>
                        </tr>
                        <tr>                        
                            <td>Accounted to :</td>
                            <td>{request_accounted_to}</td>
                            <td>TIN :</td>
                            <td>{request_tin}</td>
                        </tr> 
                        <tr>
                            <td>Status :</td>
                            <td class="color_green bold">{request_approval_status_name}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        
                    </tbody>
                </table>