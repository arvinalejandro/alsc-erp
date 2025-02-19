<tr id="detail_parent_row_{item_id}">
    <td colspan="5" align="center">
        <table id="detail_table_{item_id}" cellpadding="5" cellspacing="0" border="0" width="95%" class="font_size_10">
            <thead>
                <tr style="background-color:#888888;">
                    <td>Taxable Amount</td>
                    <td>Tax%</td>
                    <td>Group</td>
                    <td>Item</td>
                    <td>Project</td>
                    <td>Phase</td>
                    <td>Tax Amt</td>
                    <td>Gross Amt</td>
                    <td></td>
                </tr>
            </thead>
            <tbody id="detail_row_{item_id}">
                   
                   <tr style="background-color:#ffffff;" id="{item_id}_{request_count}" class="_cdv_rows">
					    <input type="hidden" name="detail[{request_count}][int][account_payable_item_id]" value="{item_id}">
   
	
						<td>
							<input class="_cdv_net_amt" id="net_{request_count}" type="text" name="detail[{request_count}][int][item_net_amount]" value="0.00" onkeyup="compute_total({request_count})" onfocus="selet_entry(this)"  />
						</td>
						
						<td>
							<input class="_cdv_tax_pct" id="percent_{request_count}" type="text" name="detail[{request_count}][int][item_tax_percent]" value="12" onkeyup="compute_total({request_count})" onfocus="selet_entry(this)" />
						</td>
						
						<td>
							<select class="_cdv_parent" id="parent_{request_count}" name="detail[{request_count}][str][option_account_chart_parent_id]" onchange="get_c({request_count})">
								<option value="0"></option>
							   {parent_form}
							</select>
						</td>
						
						<td>
							<select class="_cdv_child" id="child_{request_count}" name="detail[{request_count}][str][option_account_chart_child_id]" onchange="display_cdv()">
							   <option value="0"></option>
							</select>
						</td>
						
						<td>
							<select class="_cdv_project" id="project_{request_count}" name="detail[{request_count}][int][project_id]" onchange="get_site({request_count})">
								<option value="0"></option>
								 {project_form}
							</select>
						</td>
						
						<td>
							<select class="_cdv_site" id="project_site_{request_count}" name="detail[{request_count}][int][project_site_id]" onchange="display_cdv()">
								<option value="0"></option>
							</select>
						</td>
							
						<td>
							<input class="_cdv_tax_amt" id="tax_amt_{request_count}" type="text" name="detail[{request_count}][int][item_tax_amount]" value="0.00"  readonly/>
						</td>
						
						<td>
							<input class="_cdv_gross_amt" id="gross_{request_count}" type="text" name="detail[{request_count}][int][item_gross_amount]" value="0.00"  readonly />
						</td>
						
						<td align="center">
							<a class="link_button_inline red" onclick="del_row({request_count},{item_id})">X</a>
						</td>
					    
					</tr>
            </tbody>
        </table>
    </td>
</tr>