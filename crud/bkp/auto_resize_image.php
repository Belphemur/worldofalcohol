<?php
require_once 'config/DB.class.php';
require('libs/wideimage/WideImage.php');

$sql = DB::getInstance();
$sql->query("SET NAMES 'utf8'");

$jsonResponse = array();
if(isset($_POST['table_name']) && $_POST['table_name']!="" && isset($_POST['key_name']) && $_POST['key_name']!="" && 
	isset($_POST['key_value']) && $_POST['key_value']!="" && isset($_POST['col_thumbnail']) && $_POST['col_thumbnail']!="")
{
	$table_name = $_POST['table_name'];
	$key_name = $_POST['key_name'];
	$key_value = $_POST['key_value'];
	$col_thumbnail = $_POST['col_thumbnail'];

	if($sql->numrows("SELECT $col_thumbnail FROM $table_name WHERE $key_name='$key_value'")!=0)
	{
		$item = $sql->getResult();
		$origin_img_folder = $_POST['origin_img_folder'];
		$thumbnail_folder = $_POST['thumbnail_folder'];
		
		$origin_path = $origin_img_folder.$item["".$col_thumbnail.""];
		
		$align = isset($_POST['th_align']) ? $_POST['th_align'] : "center";
		$valign = isset($_POST['th_valign']) ? $_POST['th_valign'] : "top";
		
		$width = isset($_POST['width']) ? $_POST['width'] : "220";
		$height = isset($_POST['height']) ? $_POST['height'] : "140";
		
		$destination_folder = $thumbnail_folder;
		$quality=90;
			
		 // for gif/jpeg/jpg

		$item["".$col_thumbnail.""] = str_replace(".png", ".jpeg", $item["".$col_thumbnail.""]);
		$item["".$col_thumbnail.""] = str_replace(".gif", ".jpeg", $item["".$col_thumbnail.""]);
		$item["".$col_thumbnail.""] = str_replace(".jpg", ".jpeg", $item["".$col_thumbnail.""]);
		
		$photo = @WideImage::load($origin_path);
		$photo->resize($width+10,$height, 'outside', 'down')->crop(''.$align.'', ''.$valign.'', $width, $height)->saveToFile("".$destination_folder."/".$item["".$col_thumbnail.""]."", $quality); 
		
		$jsonResponse['result'] = "OK";
		$jsonResponse['msg'] = $item["".$col_thumbnail.""]; // send the name of new thumbnail
		print json_encode($jsonResponse); 
	}
	else
	{
		$jsonResponse['result'] = "KO";
		$jsonResponse['msg'] = "Unable to get thumbnail from Database ";
		print json_encode($jsonResponse);
	}
}
else
{
	$jsonResponse['result'] = "KO";
	$jsonResponse['msg'] = "Missing POST parameters";
	print json_encode($jsonResponse);
}
?>