<?php
	require_once "config/DB.class.php";

	//Open database connection
	$sql = DB::getInstance();
	
	$sql->query("SET NAMES 'utf8'");

	$display_field = "country";
	
	if(isset($_GET['countrycode'])) {
		$result = $sql->query("SELECT * FROM ref_countries WHERE countrycode = '".$_GET['countrycode']."';");
	}
	else if(isset($_GET['country_code'])) {
		$result = $sql->query("SELECT * FROM ref_countries WHERE country_code = '".$_GET['country_code']."';");
		$display_field = "country_code";
	}
	else {
		$result = $sql->query("SELECT * FROM ref_countries;");
	}
	
	$rows = $sql->getResults();
	
	// outpur only the values of the array
	$values = array();
	foreach($rows as $row)
	{
		$values[] = array("Value" => $row["country"], "DisplayText" => $row["".$display_field.""]);
	}
	
	$jTableResult = array();
	$jTableResult["Result"] = "OK";
	$jTableResult["Options"] = $values;
	print json_encode($jTableResult);  
	?>