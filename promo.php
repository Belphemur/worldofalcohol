<?php
require_once 'config/DB.class.php';
require('libs/Smarty.class.php');

$smarty = new Smarty;

//$smarty->force_compile = true;
//$smarty->debugging = true; 
$smarty->caching = false;
//$smarty->merge_compiled_includes = true;
//$smarty->cache_lifetime = 120;


$meta = array();
$meta['title']	=	"World Of Alcohols - Discover the alcohols from the world";
$meta['description'] = "World Of Alcohols.Com : Discover and share local beers, wines, rums, whiskys, ... from all over the world";
$meta['keywords'] = "World Of Alcohols, World Of Beers, World Of Wines, local alcohols, local beers, local whisky, local wines";
$meta['robots'] = "index,follow,all";


$smarty->assign("meta", $meta);
$cat_infos = array("category" => "HOME");


/*$smarty->compile_id = 'index.tpl';  
$smarty->assign("content_file", "promo_content_ink.tpl");
//ob_start("ob_gzhandler"); // GZIP :D
$cacheID = "index_of_promo";*/
$cacheID = "index_of_promo";
$smarty->display('promo_content.tpl', $cacheID);
?>