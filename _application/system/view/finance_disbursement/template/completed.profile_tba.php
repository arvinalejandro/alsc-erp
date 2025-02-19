                <table class="mar_custom" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">                  
                    <thead>
                        <tr>
                            <td><h1>TBA</h1></td>
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
                            <td>Purpose :</td>
                            <td><span>{request_purpose}</span></td>
                        </tr>
                        <tr>                        
                            <td>Accounted to :</td>
                            <td>{request_accounted_to}</td>
                            <td></td>
                            <td></td>
                        </tr> 
                        <tr>
                            <td>Date Needed :</td>
                            <td>{request_date_needed}</td>
                            <td>Date Approved :</td>
                            <td><span>{request_approved_date}</span></td>
                        </tr>
                        <tr>                        
                            <td>Actual Amount :</td>
                            <td><span class="bold">P {request_approved_amount}</span></td>   
                            <td>Approved by :</td>
                            <td><span class="bold">{request_approved_by}</span></td>                        
                        </tr>
                        <tr>                        
                            <td>Details :</td>
                            <td colspan="3">{request_details}</td>
                        </tr>
                        <tr>                        
                            <td>Status :</td>
                            <td colspan="3" class="color_blue bold">{request_approval_status_name}</td>
                        </tr>
                        {reimbursement_row}
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
                            <td colspan="4">
                                <table class="mar_custom bg_fff" id="_account_" style="font-weight:normal;" width="90%" cellpadding="5" cellspacing="0" border="0">
                                    <tr style="background-color: #888888; color:#ffffff;">
                                        <td>Description</td>
                                        <td>Group</td>
                                        <td>Child</td>
                                        <td>Project</td>
                                        <td>Phase</td>
                                        <td>Gross Amount</td>
                                        <td>Tax Percentage</td>
                                        <td>Tax Amount</td>
                                        <td>Net Amount</td>
                                    </tr>
                                    {item_details}
                                    
                                </table>
                            </td>
                        </tr>
                       
                    </tbody>
                </table>  