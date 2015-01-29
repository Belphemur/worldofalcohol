<?php
require_once 'config/DB.class.php';
require('libs/Smarty.class.php');

$smarty = new Smarty;

$sql = DB::getInstance();
$sql->query("SET NAMES 'utf8'");


$smarty->caching = false;

$meta = array();
$meta['title']	=	"Contact Us - World of Alcohols.Com";
$meta['description'] = "World Of Alcohols.Com : Discover and review all the alcohols from the world";
$meta['keywords'] = "World Of Alcohols, World Of Beers, World Of Wines, local alcohols, local beers, local whisky, local wines";
$meta['robots'] = "noindex,follow,all";

$smarty->assign("meta", $meta);

$smarty->assign("content_file", "contact_content.tpl");
$smarty->display('index.tpl');
?>