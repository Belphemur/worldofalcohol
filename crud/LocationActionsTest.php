<?php
	require_once "config/DB.class.php";

	try
	{
		//Open database connection
		$sql = DB::getInstance();
		$sql->query("SET NAMES 'utf8'");
	
		//Getting records (listAction)
		if($_GET["action"] == "list")
		{
			//Get record count
			$result = $sql->query("SELECT COUNT(*) AS RecordCount FROM location  WHERE id = " . $_GET["id"] . "");
			$data = $sql->getResult();
			$recordCount = $data["RecordCount"];
			
			if(!isset($_GET["jtSorting"]))
				$initial_order_field = "id DESC";
			else
				$initial_order_field = $_GET["jtSorting"];
				
			//Get records from database
			$result = $sql->query("SELECT * FROM location  WHERE id = " . $_GET["id"] . "  ");
			
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
			//Insert record into database
			$result = $sql->query("INSERT INTO location(country,countrycode,country_code,country_code_crc,city) VALUES('".trim(addslashes($_POST["country"]))."','".trim(addslashes($_POST["countrycode"]))."','".trim(addslashes($_POST["country_code"]))."','".trim($_POST["country_code_crc"])."','".trim(addslashes($_POST["city"]))."');");
			
			//Get last inserted record (to return to jTable)
			$result = $sql->query("SELECT * FROM location WHERE id = ".$sql->getLastId().";");
			$row = $sql->getResult();

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			$jTableResult["Record"] = $row;
			print json_encode($jTableResult);
		}
		//Updating a record (updateAction)
		else if($_GET["action"] == "update")
		{
			//Update record in database
			$result = $sql->query("UPDATE location SET country = '".trim(addslashes($_POST["country"]))."',countrycode = '".trim(addslashes($_POST["countrycode"]))."',country_code = '".trim(addslashes($_POST["country_code"]))."',country_code_crc = '".trim($_POST["country_code_crc"])."',city = '".trim(addslashes($_POST["city"]))."' WHERE id = " . $_POST["id"] . ";");

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