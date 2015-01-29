<?php
session_start();
require_once 'config/DB.class.php';
require_once ("config/basic_functions.php");

//displayErrors();

if (isset($_POST['name']) AND isset($_POST['email']) AND isset($_POST['code']) AND isset($_POST['country']) AND isset($_POST['city']) AND
    isset($_POST['alcohol_name']) AND isset($_POST['alcohol_type']) AND isset($_POST['company']) AND isset($_POST['alcohol_degree']) AND 
	isset($_FILES['image'])) //isset($_POST['year']) AND
{
    if (!empty($_POST['name']) AND !empty($_POST['email']) AND !empty($_POST['code']) AND !empty($_POST['country']) AND !empty($_POST['city']) AND
        !empty($_POST['alcohol_name']) AND !empty($_POST['alcohol_type']) AND !empty($_POST['company']) AND !empty($_POST['alcohol_degree']) AND 
		!empty($_FILES['image'])) //!empty($_POST['year']) AND
    {
        if($_SESSION['code'] != $_POST['code'])
        {
            die(msg(0,"Error, please copy the security code !"));
        }
		
		$sql = DB::getInstance();
        $sql->query("SET NAMES 'utf8'");



        $name = mysql_real_escape_string($_POST['name']);
        $email = mysql_real_escape_string($_POST['email']);

        $country = mysql_real_escape_string($_POST['country']);
        $city = mysql_real_escape_string($_POST['city']);
        $alcohol_name = mysql_real_escape_string($_POST['alcohol_name']);
        $alcohol_type = mysql_real_escape_string($_POST['alcohol_type']);
        $alcohol_sub_type = mysql_real_escape_string($_POST['alcohol_sub_type']); // Optional
        $company = mysql_real_escape_string($_POST['company']);
        $alcohol_degree = mysql_real_escape_string($_POST['alcohol_degree']);
        $year = mysql_real_escape_string($_POST['year']);
        $file = $_FILES['image']; // optional
        $file_to_save = "";
		
		$country_name = str_replace('-', ' ', $country);
		$country_name = ucwords($country_name);
		
        if(!isValidMail($email))
        {
            die(msg(0,"Your email address is not valid"));
        }

		if($alcohol_sub_type=="" && isset($_POST['other_sub_type']) && !empty($_POST['other_sub_type']))
		{
			$alcohol_sub_type = mysql_real_escape_string($_POST['other_sub_type']);
		}

        $upload_result = json_decode(upload_image_php($file, format_name($alcohol_name), "../user_img/"), true);
        if($upload_result["status"]==0)
        {
            die(msg(0,$upload_result["txt"]));
        }
        else
        {
            $file_to_save = $upload_result["txt"];
        }
		$ip = getenv('HTTP_CLIENT_IP')?:
					getenv('HTTP_X_FORWARDED_FOR')?:
					getenv('HTTP_X_FORWARDED')?:
					getenv('HTTP_FORWARDED_FOR')?:
					getenv('HTTP_FORWARDED')?:
					getenv('REMOTE_ADDR');
       
        $result = $sql->query("INSERT INTO user_submission(user,email,country_code,city,alcohol_name,alcohol_type_code,alcohol_sub_type,company,alcohol_degree,year,file,ip)
		VALUES('".trim(addslashes($name))."', '".trim(addslashes($email))."', '".trim(addslashes($country))."', '".trim(addslashes($city))."', 
		'".trim(addslashes($alcohol_name))."', '".trim(addslashes($alcohol_type))."', '".trim(addslashes($alcohol_sub_type))."', '".trim(addslashes($company))."', 
		'".trim(addslashes($alcohol_degree))."', '".trim(addslashes($year))."', '".trim(addslashes($file_to_save))."', '".$ip."');");

        if(!$result) {
            die(msg(0,"Error while submitting your infos"));
        }
        else {
			$jTableResult = array();
			$jTableResult["status"] = 1;
			$jTableResult["txt"] = '<h4 class="align-center">Thank you '.$name.' for your contribution !</h4> 
			<p class="align-center">We are currently looking for contributors like you in <b>'.$country_name.', '.$city.'.</b> <br><br>
				Interested to become the <b>ambassador</b> of World of Alcohols in your area? Feel free to <a href=contact.php>Contact us !</a> 
				<br><br>
				Happy Drinking <br>
				World of Alcohols Team 
			</p>';
            //echo msg(1,json_encode($msg));
			print json_encode($jTableResult);
			
			send_email($name, $email, $country, $alcohol_type, $ip);
			send_promo($name, $email, $country, $alcohol_type, $ip);
            /*if(send_email($name, $email, $country, $alcohol_type, $ip)) {
                echo msg(1,"Thanks, your alcohol submission has been sent to our team !");
            }
            else {
                die(msg(0,"Error, Unable to send your submission !"));
            }*/
        }

    }
    else {
        die(msg(0,"Pleas fill all the fields"));
    }
}
else
{
    die(msg(0,"Pleas fill all the fields"));
}

function msg($status,$txt)
{
    return '{"status":'.$status.',"txt":"'.$txt.'"}';
}

function upload_image_php($file, $new_name) {
    $target_dir = "./user_img/";
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $error_msg = "";
	$final_name = "";
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $error_msg = msg(0, "File is not an image.");
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $error_msg = msg(0, "Sorry, file already exists.");
        $uploadOk = 0;
    }
    // Check file size 1MB
    if ($file["size"] > 1048576) {
        $error_msg = msg(0, "Sorry, your file is too large max size is 1MB");
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $error_msg = msg(0, "Sorry, only JPG, JPEG, PNG & GIF files are allowed."); //Target file: $target_file Invalid type: ".$imageFileType."
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
		if($error_msg=="")
			$error_msg = msg(0, "Sorry, your file was not uploaded");
        // if everything is ok, try to upload file
    } else {
        // new name of the file
		$time_suffix = substr(time(),-3);
        $final_name = $new_name."_".$time_suffix.".".$imageFileType;

        if (move_uploaded_file($file["tmp_name"], $target_dir.$final_name)) {
            //echo "The file ". basename( $file["name"]). " has been uploaded.";
            //$error_msg = msg(1, "The file ". basename( $file["name"]). " has been uploaded.");
        } else {
            $error_msg = msg(0, "Sorry, there was an error uploading your file");
            //echo "Sorry, there was an error uploading your file.";
        }
    }

    if($uploadOk)
        return msg(1, "".$final_name."");
	else
		return $error_msg;
}

function send_email($name, $email, $country, $alcohol_type, $ip)
{
    $subject = "".$country." - New ".$alcohol_type." submitted";
    $message = "".$name." just submitted an alcohol !";
    $message = stripslashes($message);
    if(mail("worldofalcohols@gmail.com","Woa-Submit : $subject","From: $name ($ip)\nMessage : $message","From: $email"))
        return true;
    else
        return false;
}
function send_promo($name, $email, $country, $alcohol_type, $ip)
{
    $subject = "Your Alcohol submission";
    $message = "Hi ".$name.",\n";
	$message .= "Thanks for submitting a $alcohol_type on WorldOfAlcohols. Our team will soon review your submission and valid it.\n";
	$message .= "\n";
	$message .= "We are currently giving a limited oppurtunity for contributors like you to become the ambassador of World of Alcohols in your area. If you are interested, please contact us via :\n";
	$message .= "http://worldofalcohols.com/contact.php";
	$message .= "\n\n";
	$message .= "Happy Drinking\n";
	$message .= "World Of Alcohols Team\n";
    $message = stripslashes($message);
    if(mail("$email","WorldOfAlcohols.com : $subject","$message","From: worldofalcohols@gmail.com"))
        return true;
    else
        return false;
}
?>