 <tr id="_inp_head" style="background-color: #ffffff; color:black;">
	<td width="15%" align="center">{account_payable_cheque_date}</td>
	<td width="30%" align="center">
	{account_payable_cheque_bank}
	
	</td>
	<td width="15%" align="center"><input type="text" name="account_payable_cheque[{account_payable_cheque_id}][str][account_payable_cheque_po_number]"/></td>
	<td width="15%" align="center"><input type="text" name="account_payable_cheque[{account_payable_cheque_id}][str][account_payable_cheque_ofv_number]"/></td>
	<td width="20%" align="center">P {account_payable_cheque_amount}</td>
	<td width="5%"></td>
	<input type="hidden" name="account_payable_cheque[{account_payable_cheque_id}][int][account_payable_cheque_id]" value="{account_payable_cheque_id}"/>
</tr>