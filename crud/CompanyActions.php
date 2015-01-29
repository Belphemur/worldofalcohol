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
			$result = $sql->query("SELECT COUNT(*) AS RecordCount FROM company ");
			$data = $sql->getResult();
			$recordCount = $data["RecordCount"];
			
			if(!isset($_GET["jtSorting"]))
				$initial_order_field = "id DESC";
			else
				$initial_order_field = $_GET["jtSorting"];
				
			//Get records from database
			$result = $sql->query("SELECT * FROM company  ORDER BY " . $initial_order_field . "  LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . "");
			
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
			if($sql->numRows("SELECT * FROM company WHERE name_code_crc = '".u_crc32(format_name(trim($_POST['name'])))."'")==0) 
			{
				//Insert record into database
				$result = $sql->query("INSERT INTO company(name,website) VALUES('".trim(addslashes($_POST["name"]))."','".trim(addslashes($_POST["website"]))."');");			
				
				//Get last inserted record (to return to jTable)
				$result = $sql->query("SELECT * FROM company WHERE id = ".$sql->getLastId().";");
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
			$result = $sql->query("UPDATE company SET id_location = '".trim($_POST["id_location"])."',name = '".trim(addslashes($_POST["name"]))."',name_code = '".trim(addslashes($_POST["name_code"]))."',website = '".trim(addslashes($_POST["website"]))."' WHERE id = " . $_POST["id"] . ";");

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			print json_encode($jTableResult);
		}
		//Deleting a record (deleteAction)
		else if($_GET["action"] == "delete")
		{
			//Delete from database
			$result = $sql->query("DELETE FROM company WHERE id = " . $_POST["id"] . ";");

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