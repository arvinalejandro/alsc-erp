<tr style="background-color:#ffffff;" id="{item_id}_{request_count}" class="_cdv_rows">
   
	<td>
		<input class="_cdv_net_amt" id="net_{request_count}" type="text" name="detail[{item_id}][{request_count}][item_net_amount]" value="0.00"  onkeyup="compute_total({request_count})" onfocus="selet_entry(this)" />
	</td>
	
	<td>
		<input class="_cdv_tax_pct" id="percent_{request_count}" type="text" name="detail[{item_id}][{request_count}][item_tax_percent]" value="12" onkeyup="compute_total({request_count})" onfocus="selet_entry(this)" />
	</td>
	
	
	<td>
		<select class="_cdv_parent" id="parent_{request_count}" name="detail[{item_id}][{request_count}][option_account_chart_parent_id]" onchange="get_c({request_count})">
			<option value="0"></option>
		   {parent_form}
		</select>
	</td>
	
	<td>
		<select class="_cdv_child" id="child_{request_count}" name="detail[{item_id}][{request_count}][option_account_chart_child_id]" onchange="display_cdv()">
		   <option value="0"></option>
		</select>
	</td>
	
	<td>
		<select class="_cdv_project" id="project_{request_count}" name="detail[{item_id}][{request_count}][project_id]" onchange="get_site({request_count})">
			<option value="0"></option>
			 {project_form}
		</select>
	</td>
	
	<td>
		<select class="_cdv_site" id="project_site_{request_count}" name="detail[{item_id}][{request_count}][project_site_id]" onchange="display_cdv()">
			<option value="0"></option>
		</select>
	</td>
	
	<td>
		<input class="_cdv_tax_amt" id="tax_amt_{request_count}" type="text" name="detail[{item_id}][{request_count}][item_tax_amount]" value="0.00"  readonly/>
	</td>
	<td>
		<input class="_cdv_gross_amt" id="gross_{request_count}" type="text" name="detail[{item_id}][{request_count}][item_gross_amount]" value="0.00"  readonly  />
	</td>
	
	
	
	<td align="center">
		<a class="link_button_inline red" onclick="del_row({request_count},{item_id})">X</a>
	</td>
	
</tr>