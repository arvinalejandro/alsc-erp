<thead>
                        <tr>
                            <td><h1>OFV</h1></td>
                            <td colspan="3"><h1>ID No. {ofv_request_id}</h1></td>
                        </tr>
                    </thead>

                    <tbody>
                       
                        <tr>                        
                            <td>Date Requested :</td>
                            <td><span>{ofv_request_timestamp}</span></td>
                            <td>Approved by :</td>
                            <td><span>*For Approval</span></td>
                        </tr>
                        <tr>
                            <td>Department : </td>
                            <td>{option_department_name}</td>
                            <td>Requested by :</td>    
                            <td>{ofv_request_by}</td>
                        </tr>
                        <tr>
                            <td>Amount Requested:</td>
                            <td>P {ofv_request_amount}</td>
                            <td>Current OFV Balance:</td>
                            <td>P {ofv_balance_amount}</td>
                        </tr>
                       				 
                       	<input type="hidden" value="{ofv_request_amount}" name="ofv_balance[ofv_request_amount]"/>
                       	<input type="hidden" value="{ofv_balance_amount}" name="ofv_balance[ofv_current_amount]"/>