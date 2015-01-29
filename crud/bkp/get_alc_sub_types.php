<?php
	require_once "config/DB.class.php";
	require_once "basic_functions.php";
	//Open database connection
	$sql = DB::getInstance();
	
	$sql->query("SET NAMES 'utf8'");

	
			if(isset($_GET['id'])) {
				$result = $sql->query("SELECT * FROM alc_sub_type WHERE id = ".$_GET['id'].";");
			}
			else if(isset($_GET['sub_type'])) {
				$result = $sql->query("SELECT * FROM alc_sub_type WHERE sub_type_code_crc = '".u_crc32(format_name($_GET['sub_type']))."' AND sub_type_code = '".format_name($_GET['sub_type'])."';");
			}
			else {
				$result = $sql->query("SELECT * FROM alc_sub_type;");
			}
	
	$rows = $sql->getResults();
	
	// outpur only the values of the array
	$values = array();
	foreach($rows as $row)
	{
		$values[] = array("Value" => $row["id"], "DisplayText" => $row["sub_type"]);
	}
	
	$jTableResult = array();
	$jTableResult["Result"] = "OK";
	$jTableResult["Options"] = $values;
	print json_encode($jTableResult);  
	?>