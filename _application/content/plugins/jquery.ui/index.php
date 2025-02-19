<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Untitled Document</title>
<link href="css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="/_jquery/jquery.js" type="text/javascript"></script>
<script src="js/jquery-ui.js"></script>
  
  <script>
  $(document).ready(function() {
    $("#dialog").dialog({ draggable: true, resizable: false, width: 320, height: 250 });
  });
  </script>
</head>
<body style="font-size:62.5%;">
  
<div id="dialog" title="Dialog Title">
<div style="height:180px; overflow:auto; border:1px solid #000; width:300px">
<table cellspacing="1" cellpadding="3">
	<tr>
    	<td width="130">New patient</td>
        <td><input type="checkbox" /></td>
    </tr>
    <tr>
    	<td>New York</td>
        <td><input type="checkbox" /></td>
    </tr>
    <tr>
    	<td>Conecticut</td>
        <td><input type="checkbox" /></td>
    </tr>
    <tr>
    	<td>Male group</td>
        <td><input type="checkbox" /></td>
    </tr>
    <tr>
    	<td>Female Group</td>
        <td><input type="checkbox" /></td>
    </tr>
    <tr>
    	<td>New patient</td>
        <td><input type="checkbox" /></td>
    </tr>
    <tr>
    	<td>New York</td>
        <td><input type="checkbox" /></td>
    </tr>
    <tr>
    	<td>Conecticut</td>
        <td><input type="checkbox" /></td>
    </tr>
    <tr>
    	<td>Male group</td>
        <td><input type="checkbox" /></td>
    </tr>
    <tr>
    	<td>Female Group</td>
        <td><input type="checkbox" /></td>
    </tr>    
</table>
</div>
<div><input type="button" value="Save" onclick="$('#dialog').dialog('close')" /></div>
</div>

</body>
</html>
