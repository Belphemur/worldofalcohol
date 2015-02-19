<?php
require_once 'config/DB.class.php';
require_once 'config/basic_functions.php';
require('libs/Smarty.class.php');

//displayErrors();

$smarty = new Smarty;

$sql = DB::getInstance();
$sql->query("SET NAMES 'utf8'");

$nonce = array();
// will create a token named req_alcByCountryCity_id with random id for making GET request and save in session
$nonce = setNonceId($nonce, "req_alcByCountryCity_id");

// fetch country
$country = mysql_real_escape_string($_GET['country']);
$country_code = format_name($country);

$req = $sql->query("SELECT c.* FROM ref_countries c WHERE c.country_code_crc='".u_crc32($country_code)."' AND c.country_code='$country_code'");
$country_infos = $sql->getResult();

$req = $sql->query("SELECT t.id, t.type, t.type_code FROM alcohol a
JOIN alcohol_locations al ON a.id=al.alc_id 
JOIN location l ON al.location_id=l.id
JOIN alcohol_types at ON a.id=at.alc_id
JOIN alc_type t ON at.type_id=t.id
WHERE l.country_code_crc='".u_crc32($country_code)."'
GROUP BY t.type");
$country_alc_types = $sql->getResults();

$alc_per_type = array();
$alc_types_str = array();
foreach($country_alc_types as $item)
{
	$type_infos = array();
	//$type_infos["type"] = $item["type"];
	
	$req = $sql->query("SELECT a.name FROM alcohol a
		JOIN alcohol_locations al ON a.id=al.alc_id 
		JOIN location l ON al.location_id=l.id
		JOIN alcohol_types at ON at.alc_id=a.id
		WHERE at.type_id='".$item["id"]."' AND
		l.country_code_crc='".u_crc32($country_code)."'
		");
	$alcohols = array_values($sql->getResults());
	$type_infos["type"] = $item["type"]." (".count($alcohols).")";
	$type_infos["type_code"] = $item["type_code"];
	$type_infos["alcohols"] = $alcohols;
	$alc_types_str[] = $item["type"];
	$alc_per_type[] = $type_infos;
}

// fetch country alcohols
$req = $sql->query("SELECT a.*, l.country_code, l.city, t.type_code FROM alcohol a
JOIN alcohol_locations al ON al.alc_id=a.id
JOIN location l ON al.location_id=l.id 
JOIN alcohol_types at ON a.id=at.alc_id
JOIN alc_type t ON at.type_id=t.id
WHERE l.id IN (SELECT id FROM location WHERE country_code_crc=".$country_infos['country_code_crc'].") ORDER BY a.week_view DESC LIMIT 0,10");
$country_alcohols = $sql->getResults();


//$smarty->force_compile = true;
//$smarty->debugging = true;
$smarty->caching = true;
$smarty->cache_lifetime = 1800;

$meta = array();
$national_alcohol = ($country_infos['national_alcohols']=="None") ? "" : "(".$country_infos['national_alcohols'].")";
$meta['title']	=	"".$country_infos['country']." Alcohols: Discover the best alcohols ".$national_alcohol." from ".$country_infos['country']."";
$meta['description'] = "Discover and share local ".implode(", ",$alc_types_str)." from ".$country_infos['country']."";
$meta['keywords'] = "".$country_infos['country']." alcohols, alcohol ".$country_infos['country'].", ".implode(" ".$country_infos['country'].", ",$alc_types_str)." ".$country_infos['country'].", World of alcohols, rate local alcohols, rate local beers, rate local wines, rate local whiskys";
$meta['robots'] = "index,follow,all";
$smarty->assign("meta", $meta);

$meta_property_og = array();
$meta_property_og['site_name'] = "http://worldofalcohols.com";
$meta_property_og['title'] = "".$country_infos['country']." Alcohols: Discover best ".$country_infos['national_alcohols']." from ".$country_infos['country']." - WorldOfAlcohols.com";
$meta_property_og['image'] = "http://worldofalcohols.com/flags_mini/".$country_infos['flag']."";
$meta_property_og['description'] = $meta['description'];
$meta_property_og['url'] = "http://worldofalcohols.com/".$country_infos['country_code']."-alcohols";
$meta_property_og['type'] = "image";

$smarty->assign("meta_property_og", $meta_property_og);

// handle caching & non-caching for {dynamic}{/dynamic} part
$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);						
function smarty_block_dynamic($param, $content, $smarty) {
    return $content;
}
$smarty->registerPlugin('block','dynamic', 'smarty_block_dynamic', false);

$smarty->assign("nonce", $nonce);
$smarty->assign("country_infos", $country_infos);
$smarty->assign("country_alcohols", $country_alcohols);
$smarty->assign("country_alc_types", $country_alc_types);
$smarty->assign("alc_per_type", $alc_per_type);
$smarty->registerPlugin("function","format_name", "format_name"); 
$smarty->registerPlugin("function","nice_number", "nice_number"); 
$smarty->registerPlugin("function","number_format", "number_format"); 
$smarty->assign("content_file", "country_content.tpl");
$cacheID = "country_".$country_code;
$smarty->display('index.tpl', $cacheID);
?>
