<?php
//error handler function
/*function customError($errno, $errstr) {
  echo "<b>Error:</b> [$errno] $errstr";
}
//set error handler
set_error_handler("customError");
*/
require_once "../config/DB.class.php";
require_once "../basic_functions.php";
	

//Open database connection
$sql = DB::getInstance();
$sql->query("SET NAMES 'utf8'");

if($_GET["action"] == "listByCountry")
{
	$result = $sql->query("SELECT l.country,COUNT(l.country) as alcohols FROM alcohol_locations as al 
							JOIN alcohol as a on a.id=al.alc_id 
							JOIN location as l on l.id=al.location_id 
							GROUP BY l.country");
	//Add all records to an array
	$rows = $sql->getResults();
			
	//Return result to jTable
	$jTableResult = array();
	$jTableResult["countries"] = $rows;
	print json_encode($jTableResult);
}
else if($_GET["action"] == "listByCity")
{
	$country = $_GET["country"];
	$result = $sql->query("SELECT concat(l.city, ', ', l.country) as city, COUNT(l.city) as alcohols FROM alcohol_locations as al 
							JOIN alcohol as a on a.id=al.alc_id 
							JOIN location as l on l.id=al.location_id 
							WHERE l.country = '".trim($country)."'
							GROUP BY l.city");
	//Add all records to an array
	$rows = $sql->getResults();
			
	//Return result to jTable
	$jTableResult = array();
	$jTableResult["countries"] = $rows;
	print json_encode($jTableResult);
}
/*$countries[0]["country"] = "Australia";
$countries[0]["alcohols"] = 8;
$countries[1]["country"] = "Belgium";
$countries[1]["alcohols"] = 50;
$countries[2]["country"] = "France";
$countries[2]["alcohols"] = 15;
$countries[3]["country"] = "Congo";
$countries[3]["alcohols"] = 3;
$countries[4]["country"] = "Democratic Republic of the Congo";
$countries[4]["alcohols"] = 6;*/

//Getting records (listAction)
/*$table_name = "alcohols.txt";

function checkIfKeyExists(&$array, $key, $val) {
    foreach ($array as $k=>$item)
        if (isset($item[$key]) && $item[$key] == $val) {
			//echo $val. " existe deja - ";
			//echo $array[$k]['alcohols']. " <br>";
			$array[$k]['alcohols']++;
            return $item;
		}
    return null;
}

if($_GET["action"] == "listByCountry")
{
	//Get record count
	$data = file("../".$table_name);
	$out = array();
	$i = 0;
	$k = 0;
	$columns = array();
	foreach($data as $line) {
		if($i==0)
		{
			// store colums names
			$columns = explode(",", $line);
		}
		else
		{
			// separete row into columns
			$col_values = explode('","', $line);
			$j=0;
			
			foreach($columns as $col)
			{
				$col = str_replace("\n", "", $col);
				$col_values[$j] = str_replace("\n", "", $col_values[$j]);
				
				if($col=="country") {
					$country = str_replace('"', '', $col_values[$j]);
					if(!checkIfKeyExists($out, "country", $country))
					{
						$out[$k]["country"] = $country;
						$out[$k]["alcohols"] = 1;
						$k++;
					}
				}
				$j++;
			}
		}
		$i++;
	}
	
	//Return result to jTable
	$jTableResult = array();
	$jTableResult["countries"] = $out;
	print json_encode($jTableResult);
}
else if($_GET["action"] == "listByCity")
{
	$country = $_GET["country"];
	//Get record count
	$data = file("../".$table_name);
	$out = array();
	$i = 0;
	$k = 0;
	$columns = array();
	foreach($data as $line) {
		if($i==0)
		{
			// store colums names
			$columns = explode(",", $line);
		}
		else
		{
			// separete row into columns
			$col_values = explode('","', $line);
			$j=0;
			
			foreach($columns as $col)
			{
				$col = str_replace("\n", "", $col);
				$col_values[$j] = str_replace("\n", "", $col_values[$j]);
				if(str_replace('"', '', $col_values[0])==$country && $col=="location") {
					$location = str_replace('"', '', $col_values[$j]);
					if(!checkIfKeyExists($out, "location", $location))
					{
						$out[$k]["city"] = $location.", ".str_replace('"', '', $col_values[0]);
						$out[$k]["alcohols"] = 1;
						$k++;
					}
				}
				$j++;
			}
		}
		$i++;
	}
	
	//Return result to jTable
	$jTableResult = array();
	$jTableResult["countries"] = $out;
	print json_encode($jTableResult);
}*/
?>