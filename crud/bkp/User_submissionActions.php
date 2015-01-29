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
			$result = $sql->query("SELECT COUNT(*) AS RecordCount FROM user_submission ");
			$data = $sql->getResult();
			$recordCount = $data["RecordCount"];
			
			if(!isset($_GET["jtSorting"]))
				$initial_order_field = "id DESC";
			else
				$initial_order_field = $_GET["jtSorting"];
				
			//Get records from database
			$result = $sql->query("SELECT * FROM user_submission  ORDER BY " . $initial_order_field . "  LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . "");
			
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
			$result = $sql->query("INSERT INTO user_submission(valid_id,user,email,country_code,city,alcohol_name,alcohol_type_code,alcohol_sub_type,company,alcohol_degree,year,file,ip) VALUES('".trim($_POST["valid_id"])."','".trim(addslashes($_POST["user"]))."','".trim(addslashes($_POST["email"]))."','".trim(addslashes($_POST["country_code"]))."','".trim(addslashes($_POST["city"]))."','".trim(addslashes($_POST["alcohol_name"]))."','".trim(addslashes($_POST["alcohol_type_code"]))."','".trim(addslashes($_POST["alcohol_sub_type"]))."','".trim(addslashes($_POST["company"]))."','".trim(addslashes($_POST["alcohol_degree"]))."','".trim(addslashes($_POST["year"]))."','".trim($_POST["file"])."','".trim(addslashes($_POST["ip"]))."');");
			
			//Get last inserted record (to return to jTable)
			$result = $sql->query("SELECT * FROM user_submission WHERE id = ".$sql->getLastId().";");
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
			$result = $sql->query("UPDATE user_submission SET valid_id = '".trim($_POST["valid_id"])."',user = '".trim(addslashes($_POST["user"]))."',email = '".trim(addslashes($_POST["email"]))."',country_code = '".trim(addslashes($_POST["country_code"]))."',city = '".trim(addslashes($_POST["city"]))."',alcohol_name = '".trim(addslashes($_POST["alcohol_name"]))."',alcohol_type_code = '".trim(addslashes($_POST["alcohol_type_code"]))."',alcohol_sub_type = '".trim(addslashes($_POST["alcohol_sub_type"]))."',company = '".trim(addslashes($_POST["company"]))."',alcohol_degree = '".trim(addslashes($_POST["alcohol_degree"]))."',year = '".trim(addslashes($_POST["year"]))."',file = '".trim($_POST["file"])."',ip = '".trim(addslashes($_POST["ip"]))."' WHERE id = " . $_POST["id"] . ";");

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			print json_encode($jTableResult);
		}
		else if($_GET["action"] == "update_valid_id")
		{
			//Update record in database
			$result = $sql->query("UPDATE user_submission SET valid_id = '".trim($_POST["valid_id"])."' WHERE id = " . $_POST["id"] . ";");

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			print json_encode($jTableResult);
		}
		//Deleting a record (deleteAction)
		else if($_GET["action"] == "delete")
		{
			//Delete from database
			$result = $sql->query("DELETE FROM user_submission WHERE id = " . $_POST["id"] . ";");

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