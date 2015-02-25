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
			$result = $sql->query("SELECT COUNT(*) AS RecordCount FROM place ");
			$data = $sql->getResult();
			$recordCount = $data["RecordCount"];
			
			if(!isset($_GET["jtSorting"]))
				$initial_order_field = "id DESC";
			else
				$initial_order_field = $_GET["jtSorting"];
				
			//Get records from database
			$result = $sql->query("SELECT * FROM place  ORDER BY " . $initial_order_field . "  LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . "");
			
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
			$result = $sql->query("INSERT INTO place(type,name,address,telephone,description,opening_hours,image) VALUES('".trim($_POST["type"])."','".trim(addslashes($_POST["name"]))."','".trim(addslashes($_POST["address"]))."','".trim(addslashes($_POST["telephone"]))."','".trim(addslashes($_POST["description"]))."','".trim(addslashes($_POST["opening_hours"]))."','".trim($_POST["image"])."');");
			
			//Get last inserted record (to return to jTable)
			$result = $sql->query("SELECT * FROM place WHERE id = ".$sql->getLastId().";");
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
			$result = $sql->query("UPDATE place SET type = '".trim($_POST["type"])."',name = '".trim(addslashes($_POST["name"]))."',name_code = '".trim(addslashes($_POST["name_code"]))."',address = '".trim(addslashes($_POST["address"]))."',telephone = '".trim(addslashes($_POST["telephone"]))."',description = '".trim(addslashes($_POST["description"]))."',opening_hours = '".trim(addslashes($_POST["opening_hours"]))."',image = '".trim($_POST["image"])."' WHERE id = " . $_POST["id"] . ";");

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			print json_encode($jTableResult);
		}
		//Deleting a record (deleteAction)
		else if($_GET["action"] == "delete")
		{
			//Delete from database
			$result = $sql->query("DELETE FROM place WHERE id = " . $_POST["id"] . ";");

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