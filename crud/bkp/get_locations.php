<?php
	require_once "config/DB.class.php";
	require_once "basic_functions.php";
	//Open database connection
	$sql = DB::getInstance();
	
	$sql->query("SET NAMES 'utf8'");

	
			if(isset($_GET['id'])) {
				$result = $sql->query("SELECT * FROM location WHERE id = '".$_GET['id']."';");
			}
			else if(isset($_GET['country']) && isset($_GET['city'])) {
				$result = $sql->query("SELECT * FROM location WHERE country_code_crc = '".u_crc32(format_name(trim($_GET['country'])))."' AND country_code = '".format_name(trim($_GET['country']))."' AND city_code = '".format_name(trim($_GET['city']))."' ;");
			}
			else {
				$result = $sql->query("SELECT * FROM location;");
			}
	
	$rows = $sql->getResults();
	
	// outpur only the values of the array
	$values = array();
	foreach($rows as $row)
	{
		$values[] = array("Value" => $row["id"], "DisplayText" => $row["country"].", ".$row["city"]);
	}
	
	$jTableResult = array();
	$jTableResult["Result"] = "OK";
	$jTableResult["Options"] = $values;
	print json_encode($jTableResult);  
	?>