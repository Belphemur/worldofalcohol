<?php
	require_once "config/DB.class.php";

	//Open database connection
	$sql = DB::getInstance();
	
	$sql->query("SET NAMES 'utf8'");

	
			if(isset($_GET['id'])) {
				$result = $sql->query("SELECT * FROM alcohol WHERE id = '".$_GET['id']."' ORDER BY name ASC;");
			}
			else {
				$result = $sql->query("SELECT * FROM alcohol ORDER BY name ASC;");
			}
	
	$rows = $sql->getResults();
	
	// outpur only the values of the array
	$values = array();
	foreach($rows as $row)
	{
		$values[] = array("Value" => $row["id"], "DisplayText" => $row["name"].", ".$row["degree"]."% ABV");
	}
	
	$jTableResult = array();
	$jTableResult["Result"] = "OK";
	$jTableResult["Options"] = $values;
	print json_encode($jTableResult);  
	?>