<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link href="css/ui-lightness/jquery-ui-1.8.11.custom.css" rel="stylesheet" />
<script src="jquery-1.5.2.js" type="text/javascript"></script>
<script src="jquery-ui-1.8.11.custom.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(e) {
    $('#accordion').accordion({autoHeight:false});
});
</script>
</head>

<body>
<div id="accordion">
<h3><a href="#">Data Table</a></h3>
<div>
<table id="peaks">
<thead>
<th>ID</th><th>Name</th><th>Elevation</th><th>Longitude</th><th>Latitude</th><th>Prominence</th><th>Range Name</th><th>State</th><th>First Ascent</th>
</thead>
<tbody>
<?php


include_once('PeakService.php');

$peak_service = new PeaksService();

$peak_array = $peak_service->getAllPeaks();
$ranges = $peak_service->getDistinctRanges();
$states = $peak_service->getDistinctStates();

//print_r($peak_array);

foreach ($peak_array as $row)
{
	echo "<tr><td>".$row->id."</td><td>".$row->name."</td><td>".$row->elevation."</td><td>".$row->latitude."</td><td>".$row->longitude."</td><td>".$row->prominence."</td><td>".$row->range_name."</td><td>".$row->state."</td><td>".$row->first_ascent."</td></tr>";	
}

?>
</tbody>
</table>
</div>

<h3><a href="#">Add Item Form</a></h3>
<div>
<form id="update_form">
	ID: <input id="id" name="id" type="hidden" /><br />
    Name: <input id="name" name="name" type="text" /><br />
   	Elevation: <input id="elevation" name="elevation" type="number" min="0" max="16000" step="1" /><br />
    Latitude: <input id="latitude" name="latitude" type="number" step="0.0001" /><br />
    Longitude: <input id="longitude" name="longitude" type="number" step="0.0001" /><br />
    Prominence: <input id="prominence" name="prominence" type="number" step="1" /><br />
    Range Name: <input id="range_name" name="range_name" type="text" list="ranges" /><br />
    
    
    <datalist id="ranges">
<?php
	foreach($ranges as $row)
	{
		echo '<option value="'.$row['range_name'].'">';	
	}
?>
	</datalist>
    State: <input id="state" name="state" type="text" list="states" />
    <datalist id="states">
<?php
	foreach($states as $row)
	{
		echo '<option value="'.$row['state'].'">';	
	}
?>	
	</datalist>
    First Ascent: <input id="first_ascent" name="first_ascent" type="date" /><br />
    <input id="submit" name="submit" type="submit" value="Submit" />    
</form>
</div>
</div>
</body>
</html>