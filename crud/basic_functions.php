<?php
function displayErrors() {
	ini_set('display_errors', 'On');
	function customError($errno, $errstr) {
	  echo "<b>Error:</b> [$errno] $errstr";
	}
	//set error handler
	set_error_handler("customError");
}
/*
copy a remote file given by $url in folder $dirname with name $new_name
*/
function copy_file($url, $dirname, $new_name)
{
	$json_response = array();
    @$file = fopen ($url, "rb");
    if (!$file) 
	{
		$json_response["result"] = "ERROR";
		$json_response["msg"] = "Failed to copy ".$url." !";
		return json_encode($json_response);
    }
	else 
	{
		/* !!!!!!!!!!!!! */
		$filename = basename($url);
		$info = getimagesize($url);
		$ext = image_type_to_extension($info[2]);
		
		// IF ERROR during upload uncomment the following line
		//$ext = ".".pathinfo($url, PATHINFO_EXTENSION);
		
		if(strstr($dirname, 'images') || strstr($dirname, 'places') || strstr($dirname, 'places_mini') || strstr($dirname, 'thumbnails') || strstr($dirname, 'mini'))
		{
			if($ext!='.jpeg' && $ext!='.jpg' && $ext!='.gif' && $ext!='.png'){
				$json_response["result"] = "ERROR";
				$json_response["msg"] = "Invalid image format ".$ext."!";
				return json_encode($json_response);
			}
		}
		else if(strstr($dirname, 'games'))
		{
			$ext = ".".pathinfo($url, PATHINFO_EXTENSION);

			if($ext!='.swf' && $ext!='.dcr' && $ext!='.dir'){
				$json_response["result"] = "ERROR";
				$json_response["msg"] = "Invalid flash file format ".$ext."!";
				return json_encode($json_response);
			}
		}
		else
		{
			$json_response["result"] = "ERROR";
			$json_response["msg"] = "Unknown file. Specify if it's an image or swf!";
			return json_encode($json_response);
		}
		
		// write the file in the new folder
        $fc = fopen($dirname.$new_name.$ext, "wb");
        while (!feof ($file)) {
           $line = fread ($file, 1028);
           fwrite($fc,$line);
        }
        fclose($fc);
		
		// finally everything was done send uploaded image name
		$json_response["result"] = "OK";
		$json_response["msg"] = $new_name.$ext;
		return json_encode($json_response);
    }
} 

/* uploads an image to the folder $content_dir with the name $new_name */
function upload_image($image, $new_name, $content_dir="../images/")
{
	$json_response = array();
	$tmp_file = $image['tmp_name'];

	if(!is_uploaded_file($tmp_file))
	{
		switch ($_FILES['fichier'] ['error'])
		{  
			case 1:
				$json_response["msg"] = 'The file is bigger than this PHP installation allows';
			break;
			case 2:
				$json_response["msg"] = 'The file is bigger than this form allows';
			break;
			case 3:
				$json_response["msg"] = 'Only part of the file was uploaded';
			break;
			case 4:
				$json_response["msg"] = 'No file was uploaded';
			break;
		}
		$json_response["result"] = "ERROR";
		$json_response["msg"] .= "Failed to copy file ".$tmp_file."!";
		return json_encode($json_response);
		exit;
	}

	// check extension
	$type_file = $image['type'];
	$ext = '.'.substr($type_file, 6);

	if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && 
		!strstr($type_file, 'gif') && !strstr($type_file, 'png'))
	{
		$json_response["result"] = "ERROR";
		$json_response["msg"] .= "Invalid format ".$ext.". Accepted Formats [JPG, JPEG, PNG, GIF]!";
		return json_encode($json_response);
	}
	
	// new name of the file
	$new_name = $new_name.$ext;
	
	// copy the file to the destination folder with new name
	if(!move_uploaded_file($tmp_file, $content_dir.$new_name))
	{
		$json_response["result"] = "ERROR";
		$json_response["msg"] .= "Cannot move file in folder ".$content_dir."";
		return json_encode($json_response);
	}
		
	//Finally everything ok send new file name
	$json_response["result"] = "OK";
	$json_response["msg"] = $new_name;
	return json_encode($json_response);
}



/* uploads an swf File to the folder $content_dir with the name $new_name */
function upload_flash_file($game_name, $new_name, $content_dir="../jeux/")
{
	$json_response = array();
	$tmp_file = $game_name['tmp_name'];

	if(!is_uploaded_file($tmp_file))
	{
		switch ($_FILES['fichier'] ['error'])
		{  
			case 1:
				$json_response["msg"] = 'The file is bigger than this PHP installation allows';
			break;
			case 2:
				$json_response["msg"] = 'The file is bigger than this form allows';
			break;
			case 3:
				$json_response["msg"] = 'Only part of the file was uploaded';
			break;
			case 4:
				$json_response["msg"] = 'No file was uploaded';
			break;
		}
		$json_response["result"] = "ERROR";
		$json_response["msg"] .= "Failed to copy file ".$tmp_file."!";
		return json_encode($json_response);
		exit;
	}

	// check extension
	$type_file = $game_name['type'];

	$ext = substr($game_name['name'], -4);
	if(!strstr($type_file, 'x-shockwave-flash') && !strstr($type_file, 'x-director') && $ext!='.swf' && $ext!='.dir' && $ext!='.dcr')
	{
		$json_response["result"] = "ERROR";
		$json_response["msg"] .= "Invalid Flash format. Type: ".$type_file." | ext: ".$ext." Accepted Formats [SWF, DIR, DCR]!";
		return json_encode($json_response);
	}
	
	// new name of the file
	$new_name = $new_name.$ext;
	
	// copy the file to the destination folder with new name
	if(!move_uploaded_file($tmp_file, $content_dir.$new_name))
	{
		$json_response["result"] = "ERROR";
		$json_response["msg"] .= "Cannot move file in folder ".$content_dir."";
		return json_encode($json_response);
	}
		
	//Finally everything ok send new file name
	$json_response["result"] = "OK";
	$json_response["msg"] = $new_name;
	return json_encode($json_response);
}

function format_name($string) {
	$accepted_char = array("0","1","2","3","4","5","6","7","8","9",
							"a","b","c","d","e","f","g","h","i","j","k","l","m","n",
							"o","p","q","r","s","t","u","v","w","x","y","z","-", " ");
	
	//OLD version 
	//$string = strip_accents($string);
	
	$string = stripAccents($string);
	$string = strtolower($string);

	// on enleve les caracteres illegaux :p
	for($i=0; $i<strlen($string); $i++)
		if(!in_array($string{$i}, $accepted_char))
			$string = str_replace($string{$i}, "", $string);

	// on enleve toutes les espace en trop
	$string = strip_spaces($string);

	// on separe en morceux
	$split = explode(" ", $string);

	$tiret = '';
	$chaine = "";
	for($i=0; $i<count($split); $i++)
	{
		$split_2 = explode('\'', $split[$i]);
		$tiret_2 = '';

		$split[$i]= "";
		for($j=0; $j<count($split_2); $j++) {
			$split[$i] .= $tiret_2.$split_2[$j];
			$tiret_2 = '-';
		}
		$chaine .= $tiret.$split[$i];
		$tiret = '-';
	}
	$chaine = str_replace('---', '-', $chaine);
	$chaine = str_replace('--', '-', $chaine);
	$chaine = str_replace(',', '', $chaine);
	return $chaine;
}
function stripAccents($str) {
	$str = str_replace('’', '-', $str);
	$str = str_replace('đ', 'd', $str); // viet
	$str = str_replace('ế', 'e', $str); // viet
	$str = str_replace('ợ', 'o', $str); // viet
	$str = str_replace('ư', 'u', $str); // viet
	$str = str_replace('ʻ', '-', $str);
	$str = str_replace('ă', 'a', $str); // roumain
	$str = str_replace('Ț', 't', $str); // roumain
	$str = str_replace('ț', 't', $str); // roumain
	$str = str_replace('ž', 'z', $str);
	$str = str_replace('ž', 'z', $str);
	$str = str_replace('Ž', 'z', $str);
	$str = str_replace('š', 's', $str);
	$str = str_replace('Š', 's', $str);
	$str = str_replace('Ð', 'd', $str);
	$str = str_replace('ð', 'o', $str);
	$str = str_replace('Ø', 'o', $str);
	$str = str_replace('ø', 'o', $str);
	$str = str_replace('Æ', "ae", $str);
	$str = str_replace('æ', "ae", $str);
	$str = str_replace('œ', "oe", $str);
	return strtr(utf8_decode($str), utf8_decode('àáâãäåçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 
												'aaaaaaceeeeiiiinooooouuuuyyAAAAAACEEEEIIIINOOOOOUUUUY');
}
function strip_accents($str) 
{ 
	$str = htmlentities($str, ENT_NOQUOTES, 'utf-8');
	$str = preg_replace('#\&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring)\;#', '\1', $str);
	$str = preg_replace('#\&([A-za-z]{2})(?:lig)\;#', '\1', $str);
	$str = preg_replace('#\&[^;]+\;#', '', $str);
	return $str;
}

function strip_spaces($input)
{
	$input = trim($input);
	// $output = ereg_replace('  +', ' ', $input ); // DEPRECTED
	$output = preg_replace('/\s\s+/', ' ', $input);
	return $output;
}

// envoi crc32 unsigned
function u_crc32($string) {
	return sprintf("%u", crc32($string));
}

?>