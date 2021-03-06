<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link href="css/ui-lightness/jquery-ui-1.8.11.custom.css" rel="stylesheet" />
<style>
.row_selected 
{
	background-color: #B0BED9;
}
</style>
<script src="jquery-1.5.2.js" type="text/javascript"></script>
<script src="jquery-ui-1.8.11.custom.min.js" type="text/javascript"></script>
<script src="plugins/jquery.dataTables.js" type="text/javascript"></script>
<script>
var oTable;
var giRedraw = false;

$(document).ready(function(e) {
    $('#accordion').accordion({autoHeight:false});
	
	oTable = $('#peaks').dataTable({"bJQueryUI":true});	

	$('.ui-accordion').bind('accordionchange', function(event, ui) {
		var row = fnGetSelected(oTable);
		if(row)
		{
			var peak = $('td',row);
			var id = $(peak[0]).text();
			$('#id').val(id);
			
			$('#name').val($(peak[1]).text());
			$('#elevation').val($(peak[2]).text());
			$('#latitude').val($(peak[3]).text());
			$('#longitude').val($(peak[4]).text());
			$('#prominence').val($(peak[5]).text());
			$('#range_name').val($(peak[6]).text());
			$('#state').val($(peak[7]).text());
			$('#first_ascent').val($(peak[8]).text());
			
		}
	});
	
	
	/* Add a click handler to the rows */
	$("#peaks tbody").click(function(event) {
		$(oTable.fnSettings().aoData).each(function (){
			$(this.nTr).removeClass('row_selected');
		});
		$(event.target.parentNode).addClass('row_selected');
	});

	$("#update_form").submit(function(e) {
		
		$.post('add_item.php',$('#update_form').serialize(),function(data){
			alert(data);
		});
		
		return false;
	});	
		
});


/* Get the rows which are currently selected */
function fnGetSelected( oTableLocal )
{
	var aReturn = new Array();
	var aTrs = oTableLocal.fnGetNodes();
	
	for ( var i=0 ; i<aTrs.length ; i++ )
	{
		if ( $(aTrs[i]).hasClass('row_selected') )
		{
			aReturn.push( aTrs[i] );
		}
	}
	return aReturn;
}
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