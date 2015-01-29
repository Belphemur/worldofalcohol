<?php
require_once "config/DB.class.php";
require_once "config/basic_functions.php";
	
//Open database connection
$sql = DB::getInstance();
$sql->query("SET NAMES 'utf8'");

//start session
session_start();
	
//get the POST nonce
$get_nonce=$_GET['req_alcByCountryCity_id'];
//get the session nonce
$session_nonce=$_SESSION['req_alcByCountryCity_id'];
//make sure to validate the get input to prevent other types of attacks! Not shown here for brevity
if( $get_nonce !== $session_nonce) {
echo "token error";
exit;
}

if($_GET["action"] == "listCountries")
{
	$query = mysql_real_escape_string($_GET['query']);
	$result = $sql->query("SELECT rc.country, rc.country_code FROM ref_countries rc WHERE country_code LIKE '%".$query."%'");
	//Add all records to an array
	$rows = $sql->getResults();
			
	//Return result to jTable
	$jTableResult = array();
	$jTableResult["suggestions"] = $rows;
	print json_encode($jTableResult);
}
else if($_GET["action"] == "listByCountry")
{
	$result = $sql->query("SELECT l.country, l.country_code, COUNT(l.country) as alcohols FROM alcohol_locations as al 
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
	$country = mysql_real_escape_string($_GET['country']);
	$result = $sql->query("SELECT concat(l.city, ', ', l.country) as city, COUNT(l.city) as alcohols, a.name, a.name_code, l.country_code, t.type_code, a.image FROM alcohol_locations as al 
							JOIN alcohol as a on a.id=al.alc_id 
							JOIN location as l on l.id=al.location_id 
							JOIN alcohol_types as at ON a.id=at.alc_id
							JOIN alc_type as t ON at.type_id=t.id
							WHERE l.country_code = '".format_name(trim($country))."'
							GROUP BY l.city");
	//Add all records to an array
	$rows = $sql->getResults();
			
	//Return result to jTable
	$jTableResult = array();
	$jTableResult["countries"] = $rows;	
	print json_encode($jTableResult);
}
?>
