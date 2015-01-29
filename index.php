<?php
require_once 'config/DB.class.php';
require_once 'config/basic_functions.php';
require('libs/Smarty.class.php');

$smarty = new Smarty;

$nonce = array();
// will create a token named req_alcByCountryCity_id with random id for making GET request and save in session
$nonce = setNonceId($nonce, "req_alcByCountryCity_id");

$sql = DB::getInstance();
$sql->query("SET NAMES 'utf8'");

$req = $sql->query("SELECT * FROM alc_type WHERE id IN (SELECT type_id FROM alcohol_types GROUP BY type_id HAVING COUNT(*) > 1) ORDER By type LIMIT 0,10");
$alc_types = $sql->getResults();
	
//$smarty->force_compile = true;
//$smarty->debugging = true; 
$smarty->caching = true;
//$smarty->merge_compiled_includes = true;
$smarty->cache_lifetime = 600; 

// Countries
$req = $sql->query("SELECT rc.country, rc.country_code FROM ref_countries rc WHERE rc.country_code_crc IN (SELECT DISTINCT(country_code_crc) FROM location)");
$countries = $sql->getResults();


// handle caching & non-caching for {dynamic}{/dynamic} part
$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);						
function smarty_block_dynamic($param, $content, $smarty) {
    return $content;
}
$smarty->registerPlugin('block','dynamic', 'smarty_block_dynamic', false);


$meta = array();
$meta['title']	=	"World Of Alcohols - Discover the alcohols from the world";
$meta['description'] = "World Of Alcohols.Com : Discover and share local beers, wines, rums, whiskys, ... from all over the world";
$meta['keywords'] = "World Of Alcohols, World Of Beers, World Of Wines, local alcohols, local beers, local whisky, local wines";
$meta['robots'] = "index,follow,all";

$smarty->assign("meta", $meta);

$meta_property_og = array();
$meta_property_og['site_name'] = "http://worldofalcohols.com";
$meta_property_og['title'] = "World Of Alcohols.Com - Discover the alcohols from the world";
$meta_property_og['image'] = "http://worldofalcohols.com/img/logo_m.png";
$meta_property_og['description'] = $meta['description'];
$meta_property_og['url'] = "http://worldofalcohols.com";
$meta_property_og['type'] = "image";

$smarty->assign("meta_property_og", $meta_property_og);


$cat_infos = array("category" => "HOME");
$smarty->assign("cat_infos", $cat_infos);
$smarty->assign("alc_types", $alc_types);
$smarty->assign("countries", $countries);
$smarty->registerPlugin("function","getJPEG", "getJPEG"); 
$smarty->registerPlugin("function","format_name", "format_name"); 

$smarty->assign("nonce", $nonce); // secured random token for GET request
$smarty->compile_id = 'index.tpl';  
$smarty->assign("content_file", "index_content.tpl");
//ob_start("ob_gzhandler"); // GZIP :D
$cacheID = "index_of_woa";
$smarty->display('index.tpl', $cacheID);
//ob_end_flush();
?>
