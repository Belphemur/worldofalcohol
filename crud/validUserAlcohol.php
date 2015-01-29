<?php
require_once 'config/DB.class.php';
require_once "basic_functions.php";
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
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	//curl_setopt($ch,CURLOPT_HEADER, false); 
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

function getAlcTypeId($type_code) {
        global $SITE_PREFIX;
	$response = httpGet("http://".$SITE_PREFIX."/crud/get_alc_types.php?type=".urlencode($type_code)."");

	$respArray = json_decode($response, true);
	$alc_type_id = "";
	foreach ($respArray["Options"] as $item) {
		
		if (format_name($item['DisplayText']) == format_name($type_code)) {
			$alc_type_id = $item['Value'];
			break;
		}
	}
	return $alc_type_id;
}

function getAlcSubTypeId($alc_sub_type) {
        global $SITE_PREFIX;
	$response = httpGet("http://".$SITE_PREFIX."/crud/get_alc_sub_types.php?sub_type=".urlencode($alc_sub_type)."");

	$respArray = json_decode($response, true);
	$alc_sub_type_id = "";
	foreach ($respArray["Options"] as $item) {
		if (format_name($item['DisplayText']) == format_name($alc_sub_type)) {
			$alc_sub_type_id = $item['Value'];
			break;
		}
	}
	return $alc_sub_type_id;
}

function postAlcSubType($alc_sub_type) {
        global $SITE_PREFIX;
		$params = array(
			"sub_type" => "".$alc_sub_type.""
		);

		$response = httpPost("http://".$SITE_PREFIX."/crud/Alc_sub_typeActions.php?action=create",$params);
		$result_json = json_decode($response, true);
		
		return $result_json;
		/*if(is_numeric($result_json["Record"]["id"])) {
			return msg(1, "Alc Sub Type: ".$alc_sub_type." Created");
		}else {
			return msg(0, "Error Creating Alc Sub Type: ".$alc_sub_type."");
		}*/
}

function getCompanyId($company) {
        global $SITE_PREFIX;
	$response = httpGet("http://".$SITE_PREFIX."/crud/get_companies.php?name=".urlencode($company)."");

	$respArray = json_decode($response, true);
	$company_id = "";
	foreach ($respArray["Options"] as $item) {
		if ($item['DisplayText'] == $company) {
			$company_id = $item['Value'];
			break;
		}
	}
	return $company_id;
}

function postCompany($name, $website) {
        global $SITE_PREFIX;
		$params = array(
			"name" => "".urlencode($name)."",
			"website" => "".$website.""
		);

		$response = httpPost("http://".$SITE_PREFIX."/crud/CompanyActions.php?action=create",$params);
		$result_json = json_decode($response, true);
		
		return $result_json;
		
		/*if(is_numeric($result_json["Record"]["id"])) {
			return msg(1, "Company: ".$name." Created");
		}else {
			return msg(0, "Error Creating Company: ".$name."");
		}*/
}

function getLocationId($country, $city) {
        global $SITE_PREFIX;
	$response = httpGet("http://".$SITE_PREFIX."/crud/get_locations.php?country=".urlencode($country)."&city=".urlencode($city)."");

	$respArray = json_decode($response, true);
	$location_id = "";
	foreach ($respArray["Options"] as $item) {
		if (stripAccents(strtolower($item['DisplayText'])) == stripAccents(strtolower($country.", ".$city))) {
			$location_id = $item['Value'];
			break;
		}
	}
	return $location_id;
}

function postLocation($country, $city) {
        global $SITE_PREFIX;
		
		$countrycode = getCountryCode($country);
		$params = array(
			"country" => "".$country."",
			"countrycode" => "".$countrycode."",
			"city" => "".$city.""
		);

		$response = httpPost("http://".$SITE_PREFIX."/crud/LocationActions.php?action=create",$params);
		$result_json = json_decode($response, true);
		
		return $result_json;
		
		/*if(is_numeric($result_json["Record"]["id"])) {
			return msg(1, "Location: (".$country.", ".$city.") Created");
		}else {
			return msg(0, "Error Creating Location: (".$country.", ".$city.")");
		}*/
}
// returns BE for Belgium
function getCountryCode($country) {
        global $SITE_PREFIX;
	$response = httpGet("http://".$SITE_PREFIX."/crud/get_country_countrycode.php");

	$respArray = json_decode($response, true);
	$countrycode = "";
	foreach ($respArray["Options"] as $item) {
		if ($item['DisplayText'] == $country) {
			$countrycode = $item['Value'];
			break;
		}
	}
	return $countrycode;
}
// returns Belgium for belgium
function getCountryFromCountry_Code($country_code) {
        global $SITE_PREFIX;
	$response = httpGet("http://".$SITE_PREFIX."/crud/get_countries.php?country_code=".urlencode($country_code)."");

	$respArray = json_decode($response, true);
	$countrycode = "";
	foreach ($respArray["Options"] as $item) {
		if ($item['DisplayText'] == $country_code) {
			$countrycode = $item['Value'];
			break;
		}
	}
	return $countrycode;
}

function uploadImage($origin_url, $image_prefix) {
        global $SITE_PREFIX;
	$thumbnail_field = "image";
	$params = array(
		"origin_".$thumbnail_field."" => "url",
		"upload_".$thumbnail_field."" => $origin_url
	);
	$thumbnail = "";
	$response_save_image = httpPost("http://".$SITE_PREFIX."/crud/save_image.php?image_name=".$thumbnail_field."&new_image_prefix=".urlencode($image_prefix)."&time_prefix=",$params);
	$saved_image = json_decode($response_save_image, true);
	
	return $saved_image;
	
	/*if($saved_image["result"]=='OK') 
		return msg(1, $saved_image["msg"]);
	else
	{	
		return msg(0, json_encode($saved_image));
	}*/	
}

function updateImage($image_id, $width, $height, $align, $valign, $detination_dir) {
        global $SITE_PREFIX;

	$params = array(
				"key_name" => "id",
				"key_value" => $image_id,
				"col_thumbnail" => "image",
				"width" => $width,
				"height" => $height,
				"th_align" => $align,
				"th_valign" => $valign,
				"table_name" => "alcohol",
				"origin_img_folder" =>	"../images/",
				"thumbnail_folder" => $detination_dir
			);
	$response_update_thumb = httpPost("http://".$SITE_PREFIX."/crud/auto_resize_image.php",$params);
	$result = json_decode($response_update_thumb, true);
	
	return $result;
	/*if($result["result"]=='OK')
			return msg(1, "mini image_updated");
	else
		return msg(0,  json_encode($result));*/
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

function msg($status,$txt)
{
    return '{"status":'.$status.',"txt":"'.$txt.'"}';
}

function validUserAlcohol($id) {
	global $SITE_PREFIX;
	$sql = DB::getInstance();
    $sql->query("SET NAMES 'utf8'");
	
	$jTableResult = array();
	if($sql->numRows("SELECT * FROM user_submission WHERE id='".$id."'")!=0) 
	{
		$data = $sql->getResult();
		if($data['valid_id']!=0) {
			$jTableResult["Result"] = "KO";
			$jTableResult["Message"] = "Alcohol already validated ".$data['valid_id'];
		}
		else
		{
			$name = trim($data['alcohol_name']);
			$alc_type_code = trim($data['alcohol_type_code']);
			$alc_sub_type = trim($data['alcohol_sub_type']);
			$degree = str_replace(',', '.', $data['alcohol_degree']);
			$country_code = trim($data['country_code']);
			$city = trim($data['city']);
			$company = trim($data['company']);
			$website = "";
			
			$country = getCountryFromCountry_Code($country_code);
			
			$messages = array();
			$messages["add_sub_type"] = postAlcSubType($alc_sub_type);
			$messages["add_company"] = postCompany($company, $website);
			$messages["add_location"] = postLocation($country, $city);
			
			// Upload main image to ..images
			$origin_url = "http://".$SITE_PREFIX."/user_img/".$data['file']."";
			
			
			$thumbnail = "";
			if($data['file']=='NA')
				$thumbnail = "NA.png";
			else {
				$upload_result = uploadImage($origin_url, $name);
				$messages["upload_image"] = $upload_result;
				$thumbnail = $upload_result["msg"];
			}
			
			if($thumbnail!="")
			{				
				// Insert Alcohol
				// INSERT MODE
				$params = array(
				   "name" => "".$name."",
				   "degree" => "".$degree."",
				   "image" => "".$thumbnail."",
				   "description" => "",
				   "year" => "".$data['year']."",
				   "date" => "".date("Y-m-d")."",
				   "valid" => "1"
				);
				
				$response = httpPost("http://".$SITE_PREFIX."/crud/AlcoholActions.php?action=create",$params);
				$obj = json_decode($response, true);
				$messages["add_alcohol"] = $obj;
				
				// ADDING LINK mode
				if(is_numeric($obj["Record"]["id"])) 
				{
					// update the userSubmission alcohol and link it to the alcohol we just created !!
					$params = array(
						"id" => "".$id."",
						"valid_id" => "".$obj["Record"]["id"].""
					);
					$response2 = httpPost("http://".$SITE_PREFIX."/crud/User_submissionActions.php?action=update_valid_id",$params);
					$messages["link_user_alcohol"] = json_decode($response2, true);
					
					
					$type_id = getAlcTypeId($alc_type_code);
					$sub_type_id = getAlcSubTypeId($alc_sub_type);
					$company_id = getCompanyId($company);
					$location_id = getLocationId($country, $city);
					
					// Insert type of alcohol
					$params = array(
						"alc_id" => "".$obj["Record"]["id"]."",
						"type_id" => "".$type_id.""
					);
					$response2 = httpPost("http://".$SITE_PREFIX."/crud/Alcohol_typesActionsTest.php?action=create",$params);
					$messages["link_alcohol_type"] = json_decode($response2, true);
					
					// insert sub type
					$params = array(
						"alc_id" => "".$obj["Record"]["id"]."",
						"sub_type_id" => "".$sub_type_id.""
					);
					$response2 = httpPost("http://".$SITE_PREFIX."/crud/Alcohol_sub_typesActionsTest.php?action=create",$params);
					$messages["link_alcohol_sub_type"] = json_decode($response2, true);
					
					// insert company
					$params = array(
						"alc_id" => "".$obj["Record"]["id"]."",
						"company_id" => "".$company_id.""
					);
					$response2 = httpPost("http://".$SITE_PREFIX."/crud/Alcohol_companiesActionsTest.php?action=create",$params);
					$messages["link_alcohol_company"] = json_decode($response2, true);
					
					// insert location
					$params = array(
						"alc_id" => "".$obj["Record"]["id"]."",
						"location_id" => "".$location_id.""
					);
					$response2 = httpPost("http://".$SITE_PREFIX."/crud/Alcohol_locationsActionsTest.php?action=create",$params);
					$messages["link_alcohol_location"] = json_decode($response2, true);
				}	
				// OK Update mini
				$messages["resize_image"] = updateImage($obj["Record"]["id"], "160", "400", "center", "center", "../mini/");
				
			}
			
			$jTableResult["Message"] = $messages;
		}
	}
	else
	{
		$jTableResult["Result"] = "KO";
		$jTableResult["Message"] = "Invalid alcohol id";
	}
	
	print json_encode($jTableResult);  
}

$id = $_GET['id'];
if($id!="") {
	validUserAlcohol($id);
}
else
{
	$jTableResult = array();
	$jTableResult["Result"] = "KO";
	$jTableResult["Message"] = "Invalid alcohol id";
	print json_encode($jTableResult); 
}	
?>
