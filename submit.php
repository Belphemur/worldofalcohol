<?php
require_once 'config/DB.class.php';
require_once 'config/basic_functions.php';
require('libs/Smarty.class.php');

//displayErrors();
$smarty = new Smarty;

$sql = DB::getInstance();
$sql->query("SET NAMES 'utf8'");

$req = $sql->query("SELECT c.country,c.country_code FROM ref_countries c ORDER BY c.country");
$countries = $sql->getResults();

$req = $sql->query("SELECT t.type,t.type_code FROM alc_type t ORDER BY t.type");
$types = $sql->getResults();

$req = $sql->query("SELECT s.sub_type,s.sub_type_code FROM alc_sub_type s ORDER BY s.sub_type");
$sub_types = $sql->getResults();

$smarty->caching = false;


$current_country_code = isset($_GET['country']) ? $_GET['country'] : "";

$meta = array();
$meta['title']	=	"Submit local alcohol - World of Alcohols.Com";
$meta['description'] = "World Of Alcohols.Com : Discover and share all the alcohols from the world";
$meta['keywords'] = "World Of Alcohols, World Of Beers, World Of Wines, local alcohols, local beers, local whisky, local wines";
$meta['robots'] = "noindex,follow,all";


$smarty->assign("meta", $meta);
$smarty->assign("countries", $countries);
$smarty->assign("types", $types);
$smarty->assign("sub_types", $sub_types);
$smarty->assign("current_country_code", $current_country_code);
$smarty->assign("content_file", "submit_content.tpl");
$smarty->display('index.tpl');
?>