<?php
	require_once "config/DB.class.php";

	//Open database connection
	$sql = DB::getInstance();
	
	$sql->query("SET NAMES 'utf8'");

	
			if(isset($_GET['place_type'])) {
				$result = $sql->query("SELECT * FROM ref_place_types WHERE place_type = '".$_GET['place_type']."';");
			}
			else {
				$result = $sql->query("SELECT * FROM ref_place_types;");
			}
	
	$rows = $sql->getResults();
	
	// outpur only the values of the array
	$values = array();
	foreach($rows as $row)
	{
		$values[] = array("Value" => $row["place_type"], "DisplayText" => $row["place_type"]);
	}
	
	$jTableResult = array();
	$jTableResult["Result"] = "OK";
	$jTableResult["Options"] = $values;
	print json_encode($jTableResult);  
	?>