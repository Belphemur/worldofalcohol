<?php
if (!function_exists('setNonceId')) {
function setNonceId($array, $id) {
	//start the user session (set session cookie)
	session_start();
	
	if(isset($_SESSION[''.$id.'']))
	{
		$array[''.$id.''] = $_SESSION[''.$id.''];
	}
	else
	{
		//generate nonce - this nonce will be used for this session only, using random values and the time
		$req_token=hash("md5",rand().time().rand()."My0WnS3cret!!");
		$_SESSION[''.$id.''] = $req_token;
		$array[''.$id.''] = $req_token;
	}

	return $array;
}
}

function Zip($source, $destination)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            $file = realpath($file);

            if (is_dir($file) === true)
            {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true)
            {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}

if (!function_exists('getJPEG')) {
	function getJPEG($string) {
		$string = str_replace(".png", ".jpeg", $string);
		$string = str_replace(".gif", ".jpeg", $string);
		$string = str_replace(".jpg", ".jpeg", $string);
		return $string;
	}
}
// fonction qui upload une image 
// $image = $_FILES envoyé par le form choisit par "Parcourir"
// 
function uploadImage($image, $new_name, $content_dir="../images/")
{
		// on créé un dossier pour le classement des images
		/*if(!file_exists("../images/".$dir_name))
			mkdir("../images/".$dir_name,0755,true); */

		//$content_dir = '../images/'; // dossier où sera déplacé l'image

		$tmp_file = $image['tmp_name'];

		if(!is_uploaded_file($tmp_file))
		{
			//exit("Le fichier est introuvable");
			switch ($_FILES['fichier'] ['error'])
			 {  case 1:
					   print '<p> The file is bigger than this PHP installation allows</p>';
					   break;
				case 2:
					   print '<p> The file is bigger than this form allows</p>';
					   break;
				case 3:
					   print '<p> Only part of the file was uploaded</p>';
					   break;
				case 4:
					   print '<p> No file was uploaded</p>';
					   break;
			 }
			 return false;
			 exit;
		}

		// on vérifie maintenant l'extension
		$type_file = $image['type'];

		$ext = '.'.substr($type_file, 6);

		if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') 
		 && !strstr($type_file, 'gif') && !strstr($type_file, 'png')) //&& !strstr($type_file, 'bmp')
		{
			echo "Le fichier n'est pas une image. Seul Format accepté JPG, JPEG, PNG OU GIF";
			return false;
		}
		$new_name = $new_name.$ext;
		// on copie le fichier dans le dossier de destination avec un nouveau nom	
		if( !move_uploaded_file($tmp_file, $content_dir.$new_name) )
		{
			//exit("Impossible de copier le fichier dans $content_dir");
			echo "Impossible de copier le fichier dans $content_dir";
			return false;
		}
		//echo $content_dir;
		
		/*if(strstr($content_dir, 'images')){
			// On cree 2 vignettes	
			if (!copy($content_dir.$new_name, "../mini/".$new_name)) {
			echo "La copie du fichier a échoué...\n";
			}
			if (!copy($content_dir.$new_name, "../tiny/".$new_name)) {
			echo "La copie du fichier a échoué...\n";
			}
			vignette($new_name, 100, 72, "../mini/",false); // Taille max de la vignette 100*72
			vignette($new_name, 45, 32, "../tiny/",false); // Taille max de la vignette 100*100
		}
		else
		{
			//if (!copy($content_dir.$new_name, $content_dir.$new_name)) {
			//echo "La copie du fichier a échoué...\n";
			//}
			//vignette($new_name, 200, 200, $content_dir,true); // Taille max de la vignette 100*72
		}*/

	return $new_name;
}


// Fonction qui cree une vignette en gardant la proportion et la TRANSPARENCE :D
function vignette($img_file, $img_max_width, $img_max_height, $content_dir="../images/",$proportion=true) {

	$img_infos = getimagesize($content_dir.$img_file); // Récupération des infos de l'image
	$img_width = $img_infos[0]; // Largeur de l'image
	$img_height = $img_infos[1]; // Hauteur de l'image
	$img_type = $img_infos[2]; // Type de l'image
	
	if($proportion) {
				// Détermination des dimensions de l'image
				if ($img_max_width > $img_width) {
				$img_max_width = $img_width; // Largeur de la vignette
				}
				
				if ($img_max_height > $img_height) {
				$img_max_height = $img_height; // Hauteur de la vignette
				}
				
				// Facteur largeur par hauteur des dimensions max de la vignette
				$img_thumb_fact_width_height = $img_max_width / $img_max_height;
				// Facteur largeur par hauteur de l'original
				$img_fact_width_height = $img_width / $img_height;
				
				// Détermination des dimensions de la vignette
				if ($img_thumb_fact_width_height < $img_fact_width_height) {
				$img_thumb_width  = $img_max_width; // Largeur de la vignette
				$img_thumb_height = $img_thumb_width / $img_fact_width_height; // Hauteur
				} else {
				$img_thumb_height = $img_max_height;  // Hauteur de la vignette
				$img_thumb_width  = $img_thumb_height * $img_fact_width_height; // Largeur
				}
		}
		else
		{
			$img_thumb_height = $img_max_height;
			$img_thumb_width = $img_max_width;
		}
	
	// Sélection des variables selon l'extension de l'image
	switch ($img_type) {
	case 1:
	  // Création d'une nouvelle image gif  à partir du fichier
	  $img = imagecreatefromgif($content_dir.$img_file);
	  $img_ext = '.gif'; // Extension de l'image
	  break;
	case 2:
	  // Création d'une nouvelle image jpeg à partir du fichier
	  $img = imagecreatefromjpeg($content_dir.$img_file);
	  $img_ext = '.jpg'; // Extension de l'image
	  break;
	case 3:
	  // Création d'une nouvelle image png à partir du fichier
	  $img = imagecreatefrompng($content_dir.$img_file);
	  $img_ext = '.png';  // Extension de l'image
	}
	
	// Création de la vignette
	$img_thumb = imagecreatetruecolor($img_thumb_width, $img_thumb_height);
	
	/* Check if this image is PNG or GIF, then set if Transparent*/  
	if(($img_type == 1) OR ($img_type==3)){
	imagealphablending($img_thumb, false);
	imagesavealpha($img_thumb,true);
	$transparent = imagecolorallocatealpha($img_thumb, 255, 255, 255, 127);
	imagefilledrectangle($img_thumb, 0, 0, $img_thumb_width, $img_thumb_height, $transparent);
	}


	// Insertion de l'image de base redimensionnée
	imagecopyresampled($img_thumb, $img, 0, 0, 0, 0, $img_thumb_width,
												 $img_thumb_height,
												 $img_width,
												 $img_height);

	/*$file_name = basename($img_file, $img_ext); //Nom du fichier sans son extension
	$file_name = basename($img_file, ".jpeg"); //Nom du fichier sans son extension
	$file_name = basename($img_file, ".jpg"); //Nom du fichier sans son extension
	$file_name = basename($img_file, ".gif"); //Nom du fichier sans son extension
	$file_name = basename($img_file, ".png"); //Nom du fichier sans son extension */
	// Chemin complet du fichier de la vignette
	$img_thumb_name = $img_file;
	
	// Sélection de la vignette créée
	switch($img_type){
	case 1:
	// Enregistrement d'une image gif avec une compression de 75 par défaut
	  imagegif($img_thumb, $content_dir.$img_thumb_name);
	  break;
	case 2:
	// Enregistrement d'une image jpeg avec une compression de 75 par défaut
	  imagejpeg($img_thumb, $content_dir.$img_thumb_name);
	  break;
	case 3:
	  imagepng($img_thumb, $content_dir.$img_thumb_name); // Enregistrement d'une image png
	}
  
  return $img_thumb_name; // Chemin de la vignette
}

function uploadFlashFile($game_name, $new_name, $content_dir="../jeux/")
{
		//$content_dir = '../jeux/'; // dossier où sera déplacé l'image

		$tmp_file = $game_name['tmp_name'];

		if(!is_uploaded_file($tmp_file))
		{
			//exit("Le fichier est introuvable");
			switch ($_FILES['fichier'] ['error'])
			 {  case 1:
					   print '<p> The file is bigger than this PHP installation allows</p>';
					   break;
				case 2:
					   print '<p> The file is bigger than this form allows</p>';
					   break;
				case 3:
					   print '<p> Only part of the file was uploaded</p>';
					   break;
				case 4:
					   print '<p> No file was uploaded</p>';
					   break;
			 }
			 exit;
		}

		// on vérifie maintenant l'extension
		$type_file = $game_name['type'];

		$ext = substr($game_name['name'], -4);

			if(!strstr($type_file, 'x-shockwave-flash') && ($ext!='.dcr' || $ext!='.dir')) 
		{
			echo "Le fichier n'est pas un fichier flash";
			return false;
		}
		$new_name = $new_name.$ext;
		// on copie le fichier dans le dossier de destination avec un nouveau nom	
		if( !move_uploaded_file($tmp_file, $content_dir.$new_name) )
		{
			//exit("Impossible de copier le fichier dans $content_dir");
			echo "Impossible de copier le fichier dans $content_dir";
			return false;
		}

	return $new_name;
}

function validNickname($string) {
	$accepted_char = array("0","1","2","3","4","5","6","7","8","9",
							"A","B","C","D","E","F","G","H","I","J","K","L","M","N",
							"O","P","Q","R","S","T","U","V","W","X","Y","Z",
							"a","b","c","d","e","f","g","h","i","j","k","l","m","n",
							"o","p","q","r","s","t","u","v","w","x","y","z","-","_");
							
	// on verifie si tous les caracteres sont bons
	for($i=0; $i<strlen($string); $i++)
		if(!in_array($string{$i}, $accepted_char))
			return false;
	return true;
}

function formatName($string) {
	$accepted_char = array("0","1","2","3","4","5","6","7","8","9",
							"a","b","c","d","e","f","g","h","i","j","k","l","m","n",
							"o","p","q","r","s","t","u","v","w","x","y","z","-", " ");
	
	$string = sans_accent($string);
	$string = strtolower($string);

	// on enleve les caracteres illegaux :p
	for($i=0; $i<strlen($string); $i++)
		if(!in_array($string{$i}, $accepted_char))
			$string = str_replace($string{$i}, "", $string);

	// on enleve toutes les espace en trop
	$string = trimAll($string);

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

	return $chaine;
}

function formatCat($string, $ss_cat=false) {
	$accepted_char = array("0","1","2","3","4","5","6","7","8","9",
							"a","b","c","d","e","f","g","h","i","j","k","l","m","n",
							"o","p","q","r","s","t","u","v","w","x","y","z","-", " ");
	
	$string = sans_accent($string);
	$string = strtolower($string);
	
	// si ss cat on laisse le jeux car code = [id_cat]-jeux-[code_ss_cat] :D
	if(!$ss_cat)
		$string = str_replace("jeux", "", $string);
	// on enleve les articles de, d', des la etc
	
	$string = str_replace(" de ", " ", $string);
	$string = str_replace(" d'", " ", $string);
	$string = str_replace(" la ", " ", $string);

	// on enleve les caracteres illegaux :p
	for($i=0; $i<strlen($string); $i++)
		if(!in_array($string{$i}, $accepted_char))
			$string = str_replace($string{$i}, "", $string);

	// on enleve toutes les espace en trop
	$string = trimAll($string);

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

	return $chaine;
}
/*function sans_accent($chaine) 
{ 
   $accent  ="ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ"; 
   $noaccent="aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyyby"; 
   return strtr(trim($chaine),$accent,$noaccent); 
}*/

function sans_accent($str) 
{ 
	$str = htmlentities($str, ENT_NOQUOTES, 'utf-8');
	$str = preg_replace('#\&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring)\;#', '\1', $str);
	$str = preg_replace('#\&([A-za-z]{2})(?:lig)\;#', '\1', $str);
	$str = preg_replace('#\&[^;]+\;#', '', $str);
	return $str;
}

function trimAll($input)
{
$input = trim($input);
// $output = ereg_replace('  +', ' ', $input ); // DEPRECTED
$output = preg_replace('/\s\s+/', ' ', $input);
return $output;
}

function copyFile($url,$dirname,$new_name){
    @$file = fopen ($url, "rb");
    if (!$file) {
        echo "<font color=red>Failed to copy $url!</font><br>";
        return false;
    }else {
    $filename = basename($url);
	
		$info = getimagesize($url);
		$ext = image_type_to_extension($info[2]);
		//echo $ext;
		
		if(strstr($dirname, 'images') || strstr($dirname, 'thumbnails') || strstr($dirname, 'mini') || strstr($dirname, 'chrome_apps'))
		{

				
			if($ext!='.jpeg' && $ext!='.jpg' && $ext!='.gif' && $ext!='.png'){
				echo "format d'image incompatible";
				return false;
			}
		}
		else if(strstr($dirname, 'games'))
		{
			$ext = ".".pathinfo($url, PATHINFO_EXTENSION);
			echo $ext;
			if($ext!='.swf' && $ext!='.dcr'){
				echo "format de fichier flash incompatible";
				return false;
			}
		}
		else
			return false;

        $fc = fopen($dirname.$new_name.$ext, "wb");
        while (!feof ($file)) {
           $line = fread ($file, 1028);
           fwrite($fc,$line);
        }
        fclose($fc);
		
		// si c'est une image on garde les 2 vignettes :)
		/*if(strstr($dirname, 'images')){
			if (!copy($dirname.$new_name.$ext, "../mini/".$new_name.$ext)) {
				echo "La copie du fichier a échoué...\n";
			}
			
			if (!copy($dirname.$new_name.$ext, "../tiny/".$new_name.$ext)) {
				echo "La copie du fichier a échoué...\n";
			}
			
			vignette($new_name.$ext, 100, 72, "../mini/",false); // Taille max de la vignette 100*100
			vignette($new_name.$ext, 45, 32, "../tiny/",false); // Taille max de la vignette 100*100
		}*/
        //echo "<font color=blue>File $url saved to PC!</font><br>";
        return $new_name.$ext;
    }
} 
// envoi crc32 unsigned
function u_crc32($string) {
	return sprintf("%u", crc32($string));
}

//return   boolean     Returns TRUE/FALSE
function isValidURL($url)
{
$pattern = '/^((http[s]?|ftp):\/)?\/?([^:\/\s]+)((\/\w+)*\/)([\w\-\.]+[^#?\s]+)(.*)?(#[\w\-]+)?$/i';
return preg_match($pattern, $url);
}

function isValidMail($adresse)
{
   $Syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
   if(preg_match($Syntaxe,$adresse))
      return true;
   else
     return false;
}

// function used by crc
function crcnifull ($dato, $byte)
{
  static $PolyFull=0x8c;

  for ($i=0; $i<8; $i++)
  {
    $x=$byte&1;
    $byte>>=1;
    if ($dato&1) $byte|=0x80;
    if ($x) $byte^=$PolyFull;
    $dato>>=1;
  }
  return $byte;
}
// CRC-8 of a string
function crc8 (array $ar,$n=false)
{
  if ($n===false) $n=count($ar);
  $crcbyte=0;
  for ($i=0; $i<$n; $i++) $crcbyte=crcnifull($ar[$i], $crcbyte);
  return $crcbyte;
}
// binary to array
function sbin2ar($sbin)
{
  $ar=array();
  $ll=strlen($sbin);
  for ($i=0; $i<$ll; $i++) $ar[]=ord(substr($sbin,$i,1));
  return $ar;
}

// crc-16 :D
function crc16($data)
{
  $crc = 0xFFFF;
  for ($i = 0; $i < strlen($data); $i++)
  {
    $x = (($crc >> 8) ^ ord($data[$i])) & 0xFF;
    $x ^= $x >> 4;
    $crc = (($crc << 8) ^ ($x << 12) ^ ($x << 5) ^ $x) & 0xFFFF;
  }
  return $crc;
}

?>