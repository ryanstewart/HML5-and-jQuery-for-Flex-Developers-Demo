<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	include_once('PeakService.php');
	include_once('MountainPeak.php');
	
	$service = new PeaksService();
	
	if($_POST)
	{
		
		$peak = new MountainPeak();
		$peak->id = $_POST["id"];
		$peak->name = $_POST["name"];
		$peak->elevation = $_POST["elevation"];
		$peak->latitude = $_POST["latitude"];
		$peak->longitude = $_POST["longitude"];
		$peak->prominence = $_POST["prominence"];
		$peak->range_name = $_POST["range_name"];
		$peak->state = $_POST["state"];
		$peak->first_ascent = $_POST["first_ascent"];
		
		$result = $service->updateForest($peak);
		
		print_r($result);
	}
?>
</body>
</html>