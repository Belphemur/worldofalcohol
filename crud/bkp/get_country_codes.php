<?php
	require_once "config/DB.class.php";

	//Open database connection
	$sql = DB::getInstance();
	
	$sql->query("SET NAMES 'utf8'");

	
			if(isset($_GET['country'])) {
				$result = $sql->query("SELECT * FROM ref_countries WHERE country = '".$_GET['country']."';");
			}
			else {
				$result = $sql->query("SELECT * FROM ref_countries;");
			}
	
	$rows = $sql->getResults();
	
	// outpur only the values of the array
	$values = array();
	foreach($rows as $row)
	{
		$values[] = array("Value" => $row["countrycode"], "DisplayText" => $row["countrycode"]);
	}
	
	$jTableResult = array();
	$jTableResult["Result"] = "OK";
	$jTableResult["Options"] = $values;
	print json_encode($jTableResult);  
	?>