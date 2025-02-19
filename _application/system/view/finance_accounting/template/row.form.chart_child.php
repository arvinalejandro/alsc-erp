<tr>
    <td align="center">{account_payable_item_qty}</td>
    <td>{account_payable_item_desc}</td>
    <td>P {account_payable_item_price}</td>
    <td>P {account_payable_item_amount}</td>
    <td width="20%">
            <select id="chart_parent_{account_payable_item_id}" name="account_item_chart[{account_payable_item_id}][int][account_chart_parent]" style="height: 30px; padding: 0px;" >
                {parent_option}        
            </select>
    </td>
    <td width="20%">
            <select id="chart_child_{account_payable_item_id}" name="account_item_chart[{account_payable_item_id}][int][account_chart_parent]" style="height: 30px; padding: 0px;" >
                       
            </select>
    </td>
</tr>