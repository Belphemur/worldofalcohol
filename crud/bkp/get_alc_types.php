<?php
	require_once "config/DB.class.php";
	require_once "basic_functions.php";
	//Open database connection
	$sql = DB::getInstance();
	
	$sql->query("SET NAMES 'utf8'");

	$display_field = "type";
	
	if(isset($_GET['id'])) {
		$result = $sql->query("SELECT * FROM alc_type WHERE id = ".$_GET['id'].";");
	}
	else if(isset($_GET['type'])) {
		$result = $sql->query("SELECT * FROM alc_type WHERE type_code_crc = '".u_crc32(format_name($_GET['type']))."' AND type_code = '".format_name($_GET['type'])."';");
	}
	else if(isset($_GET['type_code'])) {
		$result = $sql->query("SELECT * FROM alc_type WHERE type_code_crc = '".u_crc32($_GET['type_code'])."' AND type_code = '".$_GET['type_code']."';");
		$display_field = "type_code";
	}
	else {
		$result = $sql->query("SELECT * FROM alc_type;");
	}
	
	$rows = $sql->getResults();
	
	// outpur only the values of the array
	$values = array();
	foreach($rows as $row)
	{
		$values[] = array("Value" => $row["id"], "DisplayText" => $row["".$display_field.""]);
	}
	
	$jTableResult = array();
	$jTableResult["Result"] = "OK";
	$jTableResult["Options"] = $values;
	print json_encode($jTableResult);  
	?>