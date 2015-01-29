<?php
require_once "basic_functions.php";
require('libs/wideimage/WideImage.php');
//TODO CHANGE IMAGES FOLDER

$jsonResponse = array();
if(isset($_GET['image_name']))
{
	$image_name = $_GET['image_name'];
	if(isset($_POST['upload_'.$image_name]) || isset($_FILES['upload_'.$image_name]))
	{
		$thumbnail = (empty($_FILES['upload_'.$image_name]) ? $_POST['upload_'.$image_name] : $_FILES['upload_'.$image_name]);
		
		// default file name
		$image_name_prefix = 'tmp_'.time();
		
		$time_suffix = substr(time(),-3);
		
		if(isset($_GET['time_suffix']) && $_GET['time_suffix']!="")
			$time_suffix = $_GET['time_suffix'];
		
		if(isset($_GET['new_image_prefix']) && $_GET['new_image_prefix']!="")
			$image_name_prefix = format_name(stripslashes($_GET['new_image_prefix'])).'_'.$time_suffix;
			
		//Upload thumbnail: response is already json format
		$new_thumbnail_name = "";
		if(empty($_FILES['upload_'.$image_name])) 
			$new_thumbnail_name = copy_file($thumbnail, "../images/", $image_name_prefix); 
		else
			$new_thumbnail_name = upload_image($thumbnail, $image_name_prefix, "../images/");
		
		print $new_thumbnail_name;
	}
	else {
		$jsonResponse['result'] = "KO";
		$jsonResponse['msg'] = "input image missing";
		print json_encode($jsonResponse);
	}
}
else {
	$jsonResponse['result'] = "KO";
	$jsonResponse['msg'] = "Missing GET parameter: 'image_name'";
	print json_encode($jsonResponse);
}
?>