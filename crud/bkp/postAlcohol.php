<?php
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

function getAlcTypeId($alc_type) {
        global $SITE_PREFIX;
	$response = httpGet("http://".$SITE_PREFIX."/crud/get_alc_types.php?type=".urlencode($alc_type)."");

	$respArray = json_decode($response, true);
	$alc_type_id = "";
	foreach ($respArray["Options"] as $item) {
		echo $item['DisplayText'];
		if ($item['DisplayText'] == $alc_type) {
			$alc_type_id = $item['Value'];
			break;
		}
	}
	return $alc_type_id;
}

function postAlcType($alc_type) {
        global $SITE_PREFIX;
		$params = array(
			"type" => "".$alc_type.""
		);
		echo "Inserting Alc Sub Type for '".$alc_type."' ....";
		$response = httpPost("http://".$SITE_PREFIX."/crud/Alc_typeActions.php?action=create",$params);
		$result_json = json_decode($response, true);

		if(is_numeric($result_json["Record"]["id"])) {
			echo "insert <font color=green>OK</font><br><br>";
		}else {
			echo "insert <font color=red>fail</font><br><br>";
		}
}

function getAlcSubTypeId($alc_sub_type) {
        global $SITE_PREFIX;
	$response = httpGet("http://".$SITE_PREFIX."/crud/get_alc_sub_types.php?sub_type=".urlencode($alc_sub_type)."");

	$respArray = json_decode($response, true);
	$alc_sub_type_id = "";
	foreach ($respArray["Options"] as $item) {
		if ($item['DisplayText'] == $alc_sub_type) {
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
		echo "Inserting Alc Sub Type for '".$alc_sub_type."' ....";
		$response = httpPost("http://".$SITE_PREFIX."/crud/Alc_sub_typeActions.php?action=create",$params);
		$result_json = json_decode($response, true);
		
		if(is_numeric($result_json["Record"]["id"])) {
			echo "insert <font color=green>OK</font><br><br>";
		}else {
			echo "insert <font color=red>fail</font><br><br>";
		}
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
		echo "Inserting Company for '".$name."' ....";
		$response = httpPost("http://".$SITE_PREFIX."/crud/CompanyActions.php?action=create",$params);
		$result_json = json_decode($response, true);
		
		if(is_numeric($result_json["Record"]["id"])) {
			echo "insert <font color=green>OK</font><br><br>";
		}else {
			echo "insert <font color=red>fail</font><br><br>";
		}
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
		echo "Inserting Location for '".$country."' ....";
		$response = httpPost("http://".$SITE_PREFIX."/crud/LocationActions.php?action=create",$params);
		$result_json = json_decode($response, true);
		
		if(is_numeric($result_json["Record"]["id"])) {
			echo "insert <font color=green>OK</font><br><br>";
		}else {
			echo "insert <font color=red>fail</font><br><br>";
		}
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


/*function getImageTagArray($tags) {
        global $SITE_PREFIX;

	$tags_array = array();
	$tag_info = explode("-", $tags);
	foreach ($tag_info as $tag) {

		$tag_data = explode(":", $tag);
		$tag_name = $tag_data[0];
		$tag_weight =  $tag_data[1];
		
		$params = array(
			"sub_category" => "".$tag_name."",
			"sub_category_codename" => ""
		);
		echo "getting id for ".$tag_name."<br>";
		$response = httpPost("http://".$SITE_PREFIX."/crud/Sub_categoriesActions.php?action=create",$params);
		$result_json = json_decode($response, true);
		
		if(is_numeric($result_json["Record"]["id"])) {
			$tags_array[] = array("tag_id" => $result_json["Record"]["id"],
								"weight" => $tag_weight);
		}
	}
	return $tags_array;
}*/

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
	if($saved_image["result"]=='OK')
		$thumbnail = $saved_image["msg"];
	else
	{	
		echo "error uploading image<br>";
		print_r($saved_image);
	}	
	return $thumbnail;
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
	if($result["result"]=='OK')
	{
		"<br>update Image OK <br>";
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


foreach($files as $file)
{
	$alcohol_info = readAlcoholFile($file);
	echo "<b>Processing $file</b><br>";
	$start_line=0; // we start at the beginning of the file
	foreach($alcohol_info as $data)
	{
		//echo "Reading ".$data['file'].' - ';
		
		if($start_line>=0) 
		{
			$name = trim($data['alcohol_name']);
			$alc_type = trim($data['alcohol_type']);
			$alc_sub_type = trim($data['type']);
			$degree = str_replace(',', '.', $data['alcohol_degree']);
			$country = trim($data['country']);
			$city = trim($data['location']);
			$company = trim($data['company']);
			$website = trim($data['website']);
			
			echo $name.' '.$alc_type.' '.$degree.' <br>';
			
			postAlcType($alc_type);
			postAlcSubType($alc_sub_type);
			postCompany($company, $website);
			postLocation($country, $city);
			
			
			// Upload main image to ..images
			$origin_url = "http://".$SITE_PREFIX."/Beers/".$data['file']."";
			
			if($data['file']=='NA')
				$thumbnail = "NA.png";
			else {
				//$thumbnail = "ok";
				// Decomment line in INSERT Mode
				$thumbnail = uploadImage($origin_url, $data['alcohol_name']);
			}
			
			if($thumbnail != "")
			{
				// Insert Alcohol
				// INSERT MODE
				$params = array(
				   "name" => "".$name."",
				   "degree" => "".$degree."",
				   "image" => "".$thumbnail."",
				   "description" => "".$data['description']."",
				   "year" => "".$data['year']."",
				   "date" => "".date("Y-m-d")."",
				   "valid" => "1"
				);
				
				$response = httpPost("http://".$SITE_PREFIX."/crud/AlcoholActions.php?action=create",$params);
				$obj = json_decode($response, true);
				//print_r($response);
				
				// ADDING LINK mode
				if(is_numeric($obj["Record"]["id"])) 
				{
					$type_id = getAlcTypeId($alc_type);
					$sub_type_id = getAlcSubTypeId($alc_sub_type);
					$company_id = getCompanyId($company);
					$location_id = getLocationId($country, $city);
					// Insert type of alcohol
					$params = array(
						"alc_id" => "".$obj["Record"]["id"]."",
						"type_id" => "".$type_id.""
					);
					$response2 = httpPost("http://".$SITE_PREFIX."/crud/Alcohol_typesActionsTest.php?action=create",$params);
					print_r($response2);
					
					// insert sub type
					$params = array(
						"alc_id" => "".$obj["Record"]["id"]."",
						"sub_type_id" => "".$sub_type_id.""
					);
					$response2 = httpPost("http://".$SITE_PREFIX."/crud/Alcohol_sub_typesActionsTest.php?action=create",$params);
					print_r($response2);
					
					// insert company
					$params = array(
						"alc_id" => "".$obj["Record"]["id"]."",
						"company_id" => "".$company_id.""
					);
					$response2 = httpPost("http://".$SITE_PREFIX."/crud/Alcohol_companiesActionsTest.php?action=create",$params);
					print_r($response2);
					
					// insert location
					$params = array(
						"alc_id" => "".$obj["Record"]["id"]."",
						"location_id" => "".$location_id.""
					);
					$response2 = httpPost("http://".$SITE_PREFIX."/crud/Alcohol_locationsActionsTest.php?action=create",$params);
					print_r($response2);
					
				}
				
				// OK Update mini
				updateImage($obj["Record"]["id"], "160", "400", "center", "center", "../mini/");

			}
			else
			{
				echo "<font color=red>Upload Alcohol failed</font>";
			}
		}
		$start_line++;
	}
	
	echo "<hr>";
}

?>
