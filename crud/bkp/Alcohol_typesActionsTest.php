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
			$result = $sql->query("SELECT COUNT(*) AS RecordCount FROM alcohol_types  WHERE alc_id = " . $_GET["alc_id"] . "");
			$data = $sql->getResult();
			$recordCount = $data["RecordCount"];
			
			if(!isset($_GET["jtSorting"]))
				$initial_order_field = "alc_id DESC";
			else
				$initial_order_field = $_GET["jtSorting"];
				
			//Get records from database
			$result = $sql->query("SELECT at.*,t.type FROM alcohol_types at, alc_type t WHERE at.type_id=t.id AND at.alc_id= " . $_GET["alc_id"] . "  ");
			
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
			if($sql->numRows("SELECT * FROM alcohol_types WHERE alc_id='".trim($_POST['alc_id'])."' AND type_id='".trim($_POST['type_id'])."'")==0) 
			{
				//Insert record into database
				$result = $sql->query("INSERT INTO alcohol_types(alc_id,type_id) VALUES('".trim($_POST["alc_id"])."','".trim($_POST["type_id"])."');");
				
				//Get last inserted record (to return to jTable)
				$result = $sql->query("SELECT * FROM alcohol_types WHERE alc_id='".trim($_POST['alc_id'])."' AND type_id='".trim($_POST['type_id'])."';");
				$row = $sql->getResult();

				//Return result to jTable
				$jTableResult = array();
				$jTableResult["Result"] = "OK";
				$jTableResult["Record"] = $row;
			}
			else
			{
				$row = $sql->getResult();
				$jTableResult["Result"] = "OK";
				$jTableResult["Record"] = $row;
			}
			print json_encode($jTableResult);
		}
		//Updating a record (updateAction)
		else if($_GET["action"] == "update")
		{
			//Update record in database
			$result = $sql->query("UPDATE alcohol_types SET alc_id = '".trim($_POST["alc_id"])."',type_id = '".trim($_POST["type_id"])."' WHERE alc_id = " . $_POST["alc_id"] . ";");

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			print json_encode($jTableResult);
		}
		//Deleting a record (deleteAction)
		else if($_GET["action"] == "delete")
		{
			//Delete from database
			$result = $sql->query("DELETE FROM alcohol_types WHERE alc_id = " . $_POST["alc_id"] . ";");

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