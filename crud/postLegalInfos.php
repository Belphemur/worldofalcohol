<?php
require_once "basic_functions.php";
displayErrors();

$SITE_PREFIX;
$SITE_PWD;

if(isset($_GET['site']))
{
    if($_GET['site']=='woa')
    {
	$SITE_PREFIX="worldofalcohols.com";
	$SITE_PWD="c3Bhc3NfYmlzOkhhbXJvUmF4aSUxNQ==";
    }
    else
    {
	echo "missing parameter 'site' !!!";
        exit;
    }
}
else
{
	echo "missing parameter 'site' !!!";
	exit;
}  

function httpGet($url)
{
	global $SITE_PWD;
    $ch = curl_init();  

    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch,CURLOPT_HEADER, false); 
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	//curl_setopt($ch, CURLOPT_USERPWD, "".$SITE_PWD."");
    
	$headers = array('Authorization: Basic '.$SITE_PWD.'');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}

function httpPost($url,$params)
{
global $SITE_PWD;
  $postData = '';
   //create name value pairs seperated by &
   foreach($params as $k => $v) 
   { 
      $postData .= $k . '='.$v.'&'; 
   }
   rtrim($postData, '&');
 
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    //curl_setopt($ch,CURLOPT_HEADER, false); 
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	//curl_setopt($ch, CURLOPT_USERPWD, "".$SITE_PWD."");
    curl_setopt($ch, CURLOPT_POST, count($postData));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);   
	
 	$headers = array('Authorization: Basic '.$SITE_PWD.'');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
 
}

// returns BE for Belgium
function getCountryIdCode($country) {
        global $SITE_PREFIX;
	$response = httpGet("http://".$SITE_PREFIX."/crud/Ref_countriesActions.php?action=list&jtStartIndex=0&jtPageSize=500");

	$respArray = json_decode($response, true);
	$countryid = "";
	$countrycode = "";
	foreach ($respArray["Records"] as $item) {
		if (stripAccents(strtolower($item['country'])) == stripAccents(strtolower($country))) {
			$countrycode = $item['countrycode'];
			$countryid = $item['id'];
			break;
		}
	}
	return array("id" => $countryid, "countrycode" => $countrycode);
}

function postLegalInfos($country, $legal_infos, $drinking_age, $national_alcohol, $extra_info) {
        global $SITE_PREFIX;
		
		$country_infos = getCountryIdCode($country);
		$params = array(
			"id" => "".$country_infos["id"]."",
			"countrycode" => "".$country_infos["countrycode"]."",
			"country" => "".$country."",
			"legal_info" => "".$legal_infos."",
			"drinking_age" => "".urlencode($drinking_age)."",
			"national_alcohols" => "".$national_alcohol."",
			"extra_info" => "".$extra_info.""
		);
		//print_r($params);
		echo "Inserting Legal Infos for '".$country."' ....";
		$response = httpPost("http://".$SITE_PREFIX."/crud/Ref_countriesActions.php?action=update_legal_info",$params);
		$result_json = json_decode($response, true);
		
		if($result_json["Result"]=="OK") {
			echo "insert <font color=green>OK</font><br><br>";
		}else {
			echo "insert <font color=red>fail</font><br><br>";
		}
}

function postCountryDetails($country, $population, $area, $currencycode, $capital, $flag, $motto) {
        global $SITE_PREFIX;
		
		$country_infos = getCountryIdCode($country);
		$params = array(
			"id" => "".$country_infos["id"]."",
			"countrycode" => "".$country_infos["countrycode"]."",
			"country" => "".$country."",
			"population" => "".$population."",
			"area" => "".$area."",
			"currencycode" => "".$currencycode."",
			"capital" => "".$capital."",
			"flag" => "".$flag."",
			"motto" => "".$motto.""
		);
		//print_r($params);
		echo "Inserting Legal Infos for '".$country."' ....";
		$response = httpPost("http://".$SITE_PREFIX."/crud/Ref_countriesActions.php?action=update_details",$params);
		$result_json = json_decode($response, true);
		
		if($result_json["Result"]=="OK") {
			echo "insert <font color=green>OK</font><br><br>";
		}else {
			echo "insert <font color=red>fail</font><br><br>";
		}
}

function readAlcoholFile($file_name) {
	$data = file($file_name);
	$out = array();
	$i = 0;
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
				$out[$i-1][$col] = str_replace('"', '', $col_values[$j]);
				$j++;
			}
		}
		$i++;
	}
	return $out;
}

$files = array();

// scan all files
//$files = glob('./*.{txt}', GLOB_BRACE);
// take file from url
if(isset($_GET['file']) && $_GET['file']!="")
{
	$files[] = $_GET['file'];
}
if(!isset($_GET['update_data']))
{
	echo "provide 'update_data' parameter 'legal_info' or 'country_details'";
	exit;
}

foreach($files as $file)
{
	$alcohol_info = readAlcoholFile($file);
	print_r($alcohol_info);
	echo "<b>Processing $file</b><br>";
	$start_line=0; // we start at the beginning of the file
	foreach($alcohol_info as $data)
	{
			if($start_line>=0) 
			{
				$country = trim($data['country']);
			
				if($_GET['update_data']=="legal_info") 
				{
					$legal_info = ucwords(trim($data['legal_info']));
					$drinking_age = ucfirst(strtolower(trim($data['drinking_age'])));
					$alcohols = explode(";", trim($data['national_alcohol']));
									
					$upper = function($value) {
						return ucwords(strtolower($value));
					};

					$national_alcohol  = implode(", ", array_map($upper, $alcohols));				
					$extra_info = ucfirst(strtolower(trim($data['extra_info'])));
					
					echo $country.' '.$legal_info.' <br>';
					postLegalInfos($country, $legal_info, $drinking_age, $national_alcohol, $extra_info);
					echo "<hr>";
				}
				else if ($_GET['update_data']=="country_details") 
				{
					$upper = function($value) {
						return ucwords(strtolower($value));
					};
					$population = trim($data['number_inhabitants']);
					$area = trim($data['surface_sq_km']);
					$currencycode = trim($data['currency']);
					$capital_array = explode(";", trim($data['capital']));
					$capital  = implode(", ", array_map($upper, $capital_array));
					$flag = trim($data['flag']);
					$motto = trim($data['motto']);
					
					echo $country.' '.$legal_info.' <br>';
					postCountryDetails($country, $population, $area, $currencycode, $capital, $flag, $motto);
					echo "<hr>";
				}				
			}
	}
}
?>