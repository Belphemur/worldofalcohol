<?php
	require_once "config/DB.class.php";
	
	//start session
	session_start();
	
	//get the GET nonce
	$get_nonce=$_GET['req_rateAlcohol'];
	//get the session nonce
	$session_nonce=$_SESSION['req_rateAlcohol'];
	//make sure to validate the get input to prevent other types of attacks! Not shown here for brevity
	if( $get_nonce !== $session_nonce) {
		echo "token error";
		exit;
	}
	
	try
	{
		//Open database connection
		$sql = DB::getInstance();
		$sql->query("SET NAMES 'utf8'");
	
		//Getting records (listAction)
		if($_GET["action"] == "list")
		{
			//Get record count
			$result = $sql->query("SELECT COUNT(*) AS RecordCount FROM alcohol_ratings ");
			$data = $sql->getResult();
			$recordCount = $data["RecordCount"];
			
			if(!isset($_GET["jtSorting"]))
				$initial_order_field = "id DESC";
			else
				$initial_order_field = $_GET["jtSorting"];
				
			//Get records from database
			$result = $sql->query("SELECT * FROM alcohol_ratings  ORDER BY " . $initial_order_field . "  LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . "");
			
			if(!$result)
				throw new Exception("Already noted !!");
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
			// ip in php > 5.3
			$ip = getenv('HTTP_CLIENT_IP')?:
					getenv('HTTP_X_FORWARDED_FOR')?:
					getenv('HTTP_X_FORWARDED')?:
					getenv('HTTP_FORWARDED_FOR')?:
					getenv('HTTP_FORWARDED')?:
					getenv('REMOTE_ADDR');
					
			$alc_id = mysql_real_escape_string($_POST['alc_id']);
			$value = mysql_real_escape_string($_POST['value']);
			
			if($value < -2 || $value > 2)
			{
				$jTableResult["result"] = "KO";
				$jTableResult["msg"] = "Invalid rating";
			}
			else
			{
				if($sql->numRows("SELECT * FROM alcohol_ratings WHERE alc_id='".$alc_id."' AND user_ip='".$ip."'")==0) 
				{						
					//Insert record into database
					$result = $sql->query("INSERT INTO alcohol_ratings(alc_id,user_ip,value) VALUES('".$alc_id."','".$ip."', '".$value."');");
					
					//Get last inserted record (to return to jTable)
					$result = $sql->query("SELECT * FROM alc_type WHERE id = ".$sql->getLastId().";");
					$row = $sql->getResult();
					
					$jTableResult["result"] = "OK";
					$jTableResult["msg"] = "Thanks, your rating has been saved.";
					//$jTableResult["Record"] = $row;
				}
				else 
				{
					$row = $sql->getResult();
					$jTableResult["result"] = "KO";
					$jTableResult["msg"] = "You've already rated this alcohol";
					//$jTableResult["Record"] = $row;
				}
			}
			//Return result to jTable
			print json_encode($jTableResult);
		}
		//Updating a record (updateAction)
		/*else if($_GET["action"] == "update")
		{
			//Update record in database
			$result = $sql->query("UPDATE alcohol_ratings SET alc_id = '".trim($_POST["alc_id"])."',user_ip = '".trim(addslashes($_POST["user_ip"]))."',value = '".trim($_POST["value"])."' WHERE id = " . $_POST["id"] . ";");

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			print json_encode($jTableResult);
		}
		//Deleting a record (deleteAction)
		else if($_GET["action"] == "delete")
		{
			//Delete from database
			$result = $sql->query("DELETE FROM alcohol_ratings WHERE id = " . $_POST["id"] . ";");

			//Return result to jTable
			$jTableResult = array();
			$jTableResult["Result"] = "OK";
			print json_encode($jTableResult);
		}*/
	}
	catch(Exception $ex)
	{
		//Return error message
		$jTableResult = array();
		$jTableResult["result"] = "ERROR";
		$jTableResult["msg"] = $ex->getMessage();
		print json_encode($jTableResult);
	}
?>
