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
			if(!isset($_GET["filter_col"]) || !isset($_GET["filter_val"]) || $_GET["filter_col"]=="" || $_GET["filter_val"]=="") {
				$filter_part = "";
				//echo "ici";
			}
			else {
				if($_GET["filter_col"]=='type')
					$filter_part = " WHERE a.id IN (SELECT at.alc_id as id FROM alcohol_types at, alc_type t WHERE at.type_id=t.id AND at.alc_id=a.id AND t.type='".addslashes($_GET['filter_val'])."') ";
				else if($_GET["filter_col"]=='sub_type')
					$filter_part = " WHERE a.id IN (SELECT at.alc_id as id FROM alcohol_sub_types at, alc_sub_type t WHERE at.sub_type_id=t.id AND at.alc_id=a.id AND t.sub_type='".addslashes($_GET['filter_val'])."') ";
				else if($_GET["filter_col"]=='country')
					$filter_part = " WHERE a.id IN (SELECT at.alc_id as id FROM alcohol_locations at, location t WHERE at.location_id=t.id AND at.alc_id=a.id AND t.country='".addslashes($_GET['filter_val'])."') ";
				else if($_GET["filter_col"]=='id')
					$filter_part = " WHERE a.id = '".addslashes($_GET['filter_val'])."'";
				//echo $filter_part;
			}
			//Get record count
			$result = $sql->query("SELECT COUNT(*) AS RecordCount FROM alcohol a ".$filter_part." ");
			$data = $sql->getResult();
			$recordCount = $data["RecordCount"];
			
			if(!isset($_GET["jtSorting"]))
				$initial_order_field = "id DESC";
			else
				$initial_order_field = $_GET["jtSorting"];
				
			//Get records from database
			$result = $sql->query("SELECT * FROM alcohol a ".$filter_part." ORDER BY a." . $initial_order_field . "  LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . "");
			
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
			if($sql->numRows("SELECT * FROM alcohol WHERE name_code_crc='".u_crc32(format_name($_POST['name']))."' AND name_code='".format_name($_POST['name'])."'")==0) 
			{
				//Insert record into database
				$result = $sql->query("INSERT INTO alcohol(name,degree,image,description,year,valid) VALUES('".trim(addslashes($_POST["name"]))."','".trim(addslashes($_POST["degree"]))."','".trim($_POST["image"])."','".trim(addslashes($_POST["description"]))."','".trim(addslashes($_POST["year"]))."','".trim($_POST["valid"])."');");
			
				//Get last inserted record (to return to jTable)
				$result = $sql->query("SELECT * FROM alcohol WHERE id = ".$sql->getLastId().";");
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
			$result = $sql->query("UPDATE alcohol SET name = '".trim(addslashes($_POST["name"]))."',degree = '".trim(addslashes($_POST["degree"]))."',image = '".trim($_POST["image"])."',description = '".trim(addslashes($_POST["description"]))."',year = '".trim(addslashes($_POST["year"]))."',date = '".trim(addslashes($_POST["date"]))."',week_view = '".trim($_POST["week_view"])."',view = '".trim($_POST["view"])."',valid = '".trim($_POST["valid"])."' WHERE id = " . $_POST["id"] . ";");

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			print json_encode($jTableResult);
		}
		//Deleting a record (deleteAction)
		else if($_GET["action"] == "delete")
		{
			//Delete from database
			$result = $sql->query("DELETE FROM alcohol WHERE id = " . $_POST["id"] . ";");

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