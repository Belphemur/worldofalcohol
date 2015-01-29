<?php
session_start();
require_once("config/DB.class.php");
require_once ("config/basic_functions.php");
if (isset($_POST['name']) AND isset($_POST['mail']) AND isset($_POST['code']) AND isset($_POST['subject']) AND isset($_POST['message']))
{	
	if (!empty($_POST['name']) AND !empty($_POST['mail']) AND !empty($_POST['code']) AND !empty($_POST['subject']) AND !empty($_POST['message']))	
	{			
		if($_SESSION['code'] != $_POST['code'])	
		{			
			die(msg(0,"Error, please copy the security code !")); 
		}							
		if(strlen($_POST['message'])<40) 
		{			
			die(msg(0,"Error, your message is too short!")); 
		}
			
		$name = $_POST['name'];			
		$mail = $_POST['mail'];			
		$subject = $_POST['subject'];			
		$message = $_POST['message'];						
		if(!isValidMail($mail))
		{				
			die(msg(0,"Your email address is not valid"));			
		}			
		
		$ip	= $_SERVER['REMOTE_ADDR'];			
		$message = stripslashes($message);	
		
		if(mail("worldofalcohols@gmail.com","Woa-Contact : $subject","From: $name ($ip)\nMessage : $message","From: $mail"))				
			echo msg(1,"Thanks, your message has been sent to our team !");			
		else				
			die(msg(0,"Error, Unable to send your message !"));			      	
	}	
	else 
	{
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
?>