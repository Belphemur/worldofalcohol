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
			$result = $sql->query("SELECT COUNT(*) AS RecordCount FROM alc_type ");
			$data = $sql->getResult();
			$recordCount = $data["RecordCount"];
			
			if(!isset($_GET["jtSorting"]))
				$initial_order_field = "id DESC";
			else
				$initial_order_field = $_GET["jtSorting"];
				
			//Get records from database
			$result = $sql->query("SELECT * FROM alc_type  ORDER BY " . $initial_order_field . "  LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . "");
			
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
			if($sql->numRows("SELECT * FROM alc_type WHERE type_code_crc='".u_crc32(format_name($_POST['type']))."' AND type_code='".format_name($_POST['type'])."'")==0) 
			{
				//Insert record into database
				$result = $sql->query("INSERT INTO alc_type(type) VALUES('".trim(addslashes($_POST["type"]))."');");
				
				//Get last inserted record (to return to jTable)
				$result = $sql->query("SELECT * FROM alc_type WHERE id = ".$sql->getLastId().";");
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
			$result = $sql->query("UPDATE alc_type SET type = '".trim(addslashes($_POST["type"]))."',type_code = '".trim(addslashes($_POST["type_code"]))."' WHERE id = " . $_POST["id"] . ";");

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			print json_encode($jTableResult);
		}
		//Deleting a record (deleteAction)
		else if($_GET["action"] == "delete")
		{
			//Delete from database
			$result = $sql->query("DELETE FROM alc_type WHERE id = " . $_POST["id"] . ";");

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