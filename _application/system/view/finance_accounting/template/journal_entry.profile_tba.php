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
                            <td>Payment Form :</td>
                            <td><span>{option_payment_method_name}</span></td>
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
                       
                    </tbody>
                </table>  