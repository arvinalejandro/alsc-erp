<?php

# prevent null view output

function hash_dump($data, $die = false)
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
	if($die) die();
}

function hash_get_csv($rows, $head = array())
{
	$fp		= 	fopen('_temp_.csv', 'w');

     if($head) fputcsv($fp, $head);

    foreach($rows as $row)
    {
       fputcsv($fp, $row);
    }

    $data	=	file_get_contents('_temp_.csv');

    return $data;

}

function hash_get_csv_array()
{
	$fp		= 	fopen('backup.csv', 'r');


    do
    {
    	$rows[]	=	fgetcsv($fp);
	}
	while($data = fgetcsv($fp));


    return $rows;

}

function hash_global_push($data)
{
	global $DATA;
	$DATA = $data;
}


function hash_prepare($data, $function = 'string_clean', $var_give = '$data', $var_receive = '$post' )
{
	foreach($data as $key => $row)
	{

		$entity		=	($function) ? "{$function}({$var_give}['{$key}'])" : "{$var_give}['{$key}']";

		if($temporary)
		{
			$list	.=		"\t{$var_receive}['{$key}']\t\t=\t'';#{$entity};\n";
		}
		else
		{
			$list	.=		"\t{$var_receive}['{$key}']\t\t=\t{$entity};\n";
		}

	}

	echo '<pre>';
	echo $list;
	echo '</pre>';
	die();
}


function hash_to_option($data, $valueKey, $labelKey, $selectedValue = '', $labelSeparator=' ')
{
	foreach($data as $row)
	{
		$label		=	(is_array($labelKey)) ? $row[$labelKey[0]] . $labelSeparator . $row[$labelKey[1]] : $row[$labelKey]; # label is limitted to 2 array entries. 0 and 1
		$selected	=	($selectedValue == $row[$valueKey]) ? 'selected="selected"' : '';
		$list		.=	'<option value="'.$row[$valueKey].'" '.$selected.'>' . $label . '</option>';
	}
	return $list;
}


function hash_cutoff($data, $valueKey, $labelKey, $selectedValue = '', $labelSeparator='-')
{
	foreach($data as $row)
	{
		$label		=	(is_array($labelKey)) ? string_date_short_month($row[$labelKey[0]]).' '.$labelSeparator.' '.string_date_short_month($row[$labelKey[1]]) : $row[$labelKey]; # label is limitted to 2 array entries. 0 and 1
		$selected	=	($selectedValue == $row[$valueKey]) ? 'selected="selected"' : '';
		$list		.=	'<option value="'.$row[$valueKey].'" '.$selected.'>' . $label . '</option>';
	}
	return $list;
}




function hash_to_ams_checkbox($data, $table, $valueKey, $labelKey, $value = 0)
{
	foreach($data as $row)
	{
		if($value)
		{
			$checked = ($value == $row[$valueKey]) ? 'checked="checked"' : '';
		}
		$list		.=	'<div class="content_block fixed '.$table.'_id_ " style="border:none">
							<a class="tick"><input type="checkbox" name="'.$table.'_id[]" value="'.$row[$valueKey].'" class="_limit_'.$table.'_" '.$checked.' /></a>
							<span class="label">'.$row[$labelKey].'</span>
						</div>';
	}
	return	$list;
}

function hash_to_job_pref_checkbox($data,$table ,$valueKey, $labelKey, $value = array(), $check_class='')
{
	foreach($data as $row)
	{
		if($value)
		{
			$checked = (in_array($row[$valueKey],$value)) ? 'checked="checked"' : '';
		}
		$list		.=	'<div class="content_block fixed" style="border:none">
							<input  style="width:20px;" class="float_left check '.$check_class.'" type="checkbox" name="'.$table.'_id[]" value="'.$row[$valueKey].'"  '.$checked.' />
							<span class="float_right" style="width:79%;">'.$row[$labelKey].'</span>
						</div>';
	}
	return	$list;
}

function hash_collected_values($rows, $valueKey)
	{
		if(count($rows))
		{
			foreach($rows as $row)
			{
				$data[]		=		$row[$valueKey];
			}
		}
		else
		{
			$data	=	array();
		}
		return $data;
	}

function hash_to_json($rows = array(), $valuekey)
{
	if(count($rows))
	{
		foreach($rows as $row)
		{
			$data[]	=	$row[$valuekey];
		}
	}
	else
	{
		$data = array();
	}
	return json_encode($data);
}