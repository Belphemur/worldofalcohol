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
			$result = $sql->query("SELECT COUNT(*) AS RecordCount FROM place_alcohols  WHERE place_id = " . $_GET["place_id"] . "");
			$data = $sql->getResult();
			$recordCount = $data["RecordCount"];
			
			if(!isset($_GET["jtSorting"]))
				$initial_order_field = "id DESC";
			else
				$initial_order_field = $_GET["jtSorting"];
				
			//Get records from database
			$result = $sql->query("SELECT * FROM place_alcohols  WHERE place_id = " . $_GET["place_id"] . "  ");
			
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
			$result = $sql->query("INSERT INTO place_alcohols(place_id,alcohol_id) VALUES('".trim($_POST["place_id"])."','".trim($_POST["alcohol_id"])."');");
			
			//Get last inserted record (to return to jTable)
			$result = $sql->query("SELECT * FROM place_alcohols WHERE id = ".$sql->getLastId().";");
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
			$result = $sql->query("UPDATE place_alcohols SET alcohol_id = '".trim($_POST["alcohol_id"])."' WHERE id = " . $_POST["id"] . ";");

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			print json_encode($jTableResult);
		}
		//Deleting a record (deleteAction)
		else if($_GET["action"] == "delete")
		{
			//Delete from database
			$result = $sql->query("DELETE FROM place_alcohols WHERE id = " . $_POST["id"] . ";");

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