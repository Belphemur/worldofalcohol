<?php
	require_once "config/DB.class.php";
	require_once "basic_functions.php";
	try
	{
		//Open database connection
		$sql = DB::getInstance();
		$sql->query("SET NAMES 'utf8'");
	
		//Getting records (listAction)
		if($_GET["action"] == "list")
		{
			//Get record count
			$result = $sql->query("SELECT COUNT(*) AS RecordCount FROM location ");
			$data = $sql->getResult();
			$recordCount = $data["RecordCount"];
			
			if(!isset($_GET["jtSorting"]))
				$initial_order_field = "id DESC";
			else
				$initial_order_field = $_GET["jtSorting"];
				
			//Get records from database
			$result = $sql->query("SELECT * FROM location  ORDER BY " . $initial_order_field . "  LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . "");
			
			//Add all records to an array
			$rows = $sql->getResults();

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			$jTableResult["TotalRecordCount"] = $recordCount;
			$jTableResult["Records"] = $rows;
			print json_encode($jTableResult);
		}
		//Creating a new record (createAction)
		else if($_GET["action"] == "create")
		{
			$jTableResult = array();
			if($sql->numRows("SELECT * FROM location WHERE country_code_crc='".u_crc32(format_name($_POST['country']))."'  AND country_code='".format_name($_POST['country'])."' AND city_code='".format_name($_POST['city'])."'")==0) 
			{
				//Insert record into database
				$result = $sql->query("INSERT INTO location(country,countrycode,city) VALUES('".trim($_POST["country"])."','".trim($_POST["countrycode"])."','".trim(addslashes($_POST["city"]))."');");
			
				//Get last inserted record (to return to jTable)
				$result = $sql->query("SELECT * FROM location WHERE id = ".$sql->getLastId().";");
				$row = $sql->getResult();
				
				$jTableResult["Result"] = "OK";
				$jTableResult["Record"] = $row;
			}
			else 
			{
				$row = $sql->getResult();
				$jTableResult["Result"] = "OK";
				$jTableResult["Record"] = $row;
			}
			//Return result to jTable
			print json_encode($jTableResult);
		}
		//Updating a record (updateAction)
		else if($_GET["action"] == "update")
		{
			//Update record in database
			$result = $sql->query("UPDATE location SET country = '".trim($_POST["country"])."',countrycode = '".trim($_POST["countrycode"])."',city = '".trim(addslashes($_POST["city"]))."' WHERE id = " . $_POST["id"] . ";");

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			print json_encode($jTableResult);
		}
		//Deleting a record (deleteAction)
		else if($_GET["action"] == "delete")
		{
			//Delete from database
			$result = $sql->query("DELETE FROM location WHERE id = " . $_POST["id"] . ";");

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			print json_encode($jTableResult);
		}
	}
	catch(Exception $ex)
	{
		//Return error message
		$jTableResult = array();
		$jTableResult["Result"] = "ERROR";
		$jTableResult["Message"] = $ex->getMessage();
		print json_encode($jTableResult);
	}
	?>