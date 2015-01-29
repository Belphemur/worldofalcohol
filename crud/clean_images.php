<?php
function customError($errno, $errstr) {
  echo "<b>Error:</b> [$errno] $errstr";
}
//set error handler
set_error_handler("customError");

	require_once "config/DB.class.php";
	require_once "basic_functions.php";
	
	function removeImages($folder, $db_img) 
	{
		foreach(glob($folder."*.jpeg") as $filename){
			$imag[] =  basename($filename);
		}
		
		foreach($imag as $img) 
		{
			if(in_array($img, $db_img))
			{
				//echo $img." existe DEJA";
			}
			else
			{
				echo $img." existe A VIRER";
				unlink($folder.$img);
			}
			echo "<br>";
		}
	}

	//Open database connection
	$sql = DB::getInstance();
	$sql->query("SET NAMES 'utf8'");
	
	$result = $sql->query("SELECT image FROM alcohol");
	//Add all records to an array
	$rows = $sql->getResults();
	$db_img = $simple = array_column($rows,'image');
	
	removeImages("../images/", $db_img);
	removeImages("../mini/", $db_img);
	
?>