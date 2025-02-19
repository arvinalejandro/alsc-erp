
<tr {late_class}>
    <td>{user_}</td>
    <td>{user_number}</td>
    <td align="left">{user_payroll_attendance_timestamp}</td> 
    <td align="center">{payroll_schedule_start} - {payroll_schedule_end}</td>
  {timestamp_row}
   <td align="center">
        <div class="tooltip">
            <span class="tool_body">{late_min}</span>
            <span class="tooltiptext tooltip-top">Lates in mins</span>
        </div>
        <div class="tooltip">
            <span class="tool_body">{ovbr_min}</span>
            <span class="tooltiptext tooltip-top">Over Break in mins</span>
        </div>
        <div class="tooltip">
            <span class="tool_body">{untme_min}</span>
            <span class="tooltiptext tooltip-top">Under Time in mins</span>
        </div>
        <div class="tooltip">
            <span class="tool_body">{user_excess_minutes}</span>
            <span class="tooltiptext tooltip-top">Excess Time in mins</span>
        </div>
   </td>
    <td align="center">{ot_label}</td>
     <td align="center">{work_hours}</td>
     <td align="right"><a class="link_button_inline blue" href="/user/hr/ot_request/&id={user_payroll_attendance_id}">Request OT</a></td>                         
</tr>

