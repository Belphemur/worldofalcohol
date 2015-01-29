<?php
	require_once "config/DB.class.php";
	require_once "basic_functions.php";
	//Open database connection
	$sql = DB::getInstance();
	
	$sql->query("SET NAMES 'utf8'");

	
			if(isset($_GET['id'])) {
				$result = $sql->query("SELECT * FROM company WHERE id = '".$_GET['id']."';");
			}
			else if(isset($_GET['name'])) {
				$result = $sql->query("SELECT * FROM company WHERE name_code_crc = '".u_crc32(format_name(trim($_GET['name'])))."' AND name_code = '".format_name(trim($_GET['name']))."';");
			}
			else {
				$result = $sql->query("SELECT * FROM company;");
			}
	
	$rows = $sql->getResults();
	
	// outpur only the values of the array
	$values = array();
	foreach($rows as $row)
	{
		$values[] = array("Value" => $row["id"], "DisplayText" => $row["name"]);
	}
	
	$jTableResult = array();
	$jTableResult["Result"] = "OK";
	$jTableResult["Options"] = $values;
	print json_encode($jTableResult);  
	?>