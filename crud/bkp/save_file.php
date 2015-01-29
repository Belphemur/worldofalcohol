<?php
require_once "basic_functions.php";
//TODO CHANGE GAMES FOLDER

$jsonResponse = array();
if(isset($_GET['file_name']))
{
	$file_name = $_GET['file_name'];
	if(isset($_POST['upload_'.$file_name]) || isset($_FILES['upload_'.$file_name]))
	{
		$file = (empty($_FILES['upload_'.$file_name]) ? $_POST['upload_'.$file_name] : $_FILES['upload_'.$file_name]);
		
		// default file name
		$file_name_prefix = 'tmp_'.time();
		
		if(isset($_POST['name']) && $_POST['name']!="")
			$file_name_prefix = format_name(stripslashes($_POST['name']));
			
		//Upload thumbnail: response is already json format
		$new_file_name = "";
		if(empty($_FILES['upload_'.$file_name])) 
			$new_file_name = copy_file($file, "../games/", $file_name_prefix); 
		else
			$new_file_name = upload_flash_file($file, $file_name_prefix, "../games/");
		
		print $new_file_name;
	}
	else {
		$jsonResponse['result'] = "KO";
		$jsonResponse['msg'] = "input file missing";
		print json_encode($jsonResponse);
	}
}
else {
	$jsonResponse['result'] = "KO";
	$jsonResponse['msg'] = "Missing GET parameter: 'file_name'";
	print json_encode($jsonResponse);
}
?>