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
			$result = $sql->query("SELECT COUNT(*) AS RecordCount FROM ref_countries ");
			$data = $sql->getResult();
			$recordCount = $data["RecordCount"];
			
			if(!isset($_GET["jtSorting"]))
				$initial_order_field = "id DESC";
			else
				$initial_order_field = $_GET["jtSorting"];
				
			//Get records from database
			$result = $sql->query("SELECT * FROM ref_countries  ORDER BY " . $initial_order_field . "  LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . "");
			
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
			$result = $sql->query("INSERT INTO ref_countries(countrycode,country,legal_info,drinking_age,national_alcohols,extra_info,population,area,currencycode,capital,flag,motto) VALUES('".trim(addslashes($_POST["countrycode"]))."','".trim(addslashes($_POST["country"]))."','".trim(addslashes($_POST["legal_info"]))."','".trim(addslashes($_POST["drinking_age"]))."','".trim(addslashes($_POST["national_alcohols"]))."','".trim(addslashes($_POST["extra_info"]))."','".trim($_POST["population"])."','".trim($_POST["area"])."','".trim(addslashes($_POST["currencycode"]))."','".trim(addslashes($_POST["capital"]))."','".trim($_POST["flag"])."','".trim(addslashes($_POST["motto"]))."');");
			
			//Get last inserted record (to return to jTable)
			$result = $sql->query("SELECT * FROM ref_countries WHERE id = ".$sql->getLastId().";");
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
			$result = $sql->query("UPDATE ref_countries SET countrycode = '".trim(addslashes($_POST["countrycode"]))."',country = '".trim(addslashes($_POST["country"]))."',legal_info = '".trim(addslashes($_POST["legal_info"]))."',drinking_age = '".trim(addslashes($_POST["drinking_age"]))."',national_alcohols = '".trim(addslashes($_POST["national_alcohols"]))."',extra_info = '".trim(addslashes($_POST["extra_info"]))."',population = '".trim($_POST["population"])."',area = '".trim($_POST["area"])."',currencycode = '".trim(addslashes($_POST["currencycode"]))."',capital = '".trim(addslashes($_POST["capital"]))."',flag = '".trim($_POST["flag"])."',motto = '".trim(addslashes($_POST["motto"]))."' WHERE id = " . $_POST["id"] . ";");

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			print json_encode($jTableResult);
		}
		//Updating a record (updateAction)
		else if($_GET["action"] == "update_legal_info")
		{
			//Update record in database
			$result = $sql->query("UPDATE ref_countries SET countrycode = '".trim(addslashes($_POST["countrycode"]))."',country = '".trim(addslashes($_POST["country"]))."',legal_info = '".trim(addslashes($_POST["legal_info"]))."',drinking_age = '".trim(addslashes($_POST["drinking_age"]))."',national_alcohols = '".trim(addslashes($_POST["national_alcohols"]))."',extra_info = '".trim(addslashes($_POST["extra_info"]))."' WHERE id = " . $_POST["id"] . ";");

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			print json_encode($jTableResult);
		}
		//Updating a record (updateAction)
		else if($_GET["action"] == "update_details")
		{
			//Update record in database
			$result = $sql->query("UPDATE ref_countries SET countrycode = '".trim(addslashes($_POST["countrycode"]))."',country = '".trim(addslashes($_POST["country"]))."',population = '".trim($_POST["population"])."',area = '".trim($_POST["area"])."',currencycode = '".trim(addslashes($_POST["currencycode"]))."',capital = '".trim(addslashes($_POST["capital"]))."',flag = '".trim($_POST["flag"])."',motto = '".trim(addslashes($_POST["motto"]))."' WHERE id = " . $_POST["id"] . ";");

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			print json_encode($jTableResult);
		}
		//Deleting a record (deleteAction)
		else if($_GET["action"] == "delete")
		{
			//Delete from database
			$result = $sql->query("DELETE FROM ref_countries WHERE id = " . $_POST["id"] . ";");

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