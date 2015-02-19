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
$nonce = setNonceId($nonce, "req_rateAlcohol");

//Alcohol Info
$name = mysql_real_escape_string($_GET['name']);
$name_code = format_name($name);
$req = $sql->query("SELECT a.id, a.name,a.name_code,t.type,t.type_code,st.sub_type,a.degree,a.image,a.view,a.week_view,c.name as company_name,l.country,l.country_code,l.city FROM `alcohol` a 
JOIN alcohol_companies ac ON a.id=ac.alc_id 
JOIN company c ON ac.company_id=c.id
JOIN alcohol_locations al ON a.id=al.alc_id
JOIN location l ON al.location_id=l.id
JOIN alcohol_types at ON a.id=at.alc_id
JOIN alc_type t ON at.type_id=t.id
JOIN alcohol_sub_types ast ON a.id=ast.alc_id
JOIN alc_sub_type st ON ast.sub_type_id=st.id
WHERE a.name_code_crc='".u_crc32($name_code)."' AND a.name_code='".$name_code."'");
$alcohol = $sql->getResult();

// ++view, week_view
$sql->query("UPDATE alcohol SET view=".($alcohol['view']+1).", week_view=".($alcohol['week_view']+1)." WHERE id='".$alcohol['id']."'");

//$req = $sql->query("SELECT MAX(SUM(ar.value)) as max_value, MIN(SUM(ar.value)) as min_value FROM alcohol a 
//JOIN alcohol_ratings ar ON a.id=ar.alc_id GROUP BY alc_id");

// fetch rating infos
$req = $sql->query("SELECT SUM(ar.value) as value, COUNT(ar.alc_id) as total FROM alcohol a 
JOIN alcohol_ratings ar ON a.id=ar.alc_id
WHERE a.id='".$alcohol["id"]."'");
$rating = $sql->getResult();
$rating["percentage"] = $rating["total"] ?  ($rating["value"]/($rating["total"]*5))*100 : 0; 

// fetch country reference data
$country_code = $alcohol['country_code'];

$req = $sql->query("SELECT c.* FROM ref_countries c WHERE c.country_code_crc='".u_crc32($country_code)."' AND c.country_code='$country_code'");
$country_infos = $sql->getResult();

// fetch other alcohols from country per type
$req = $sql->query("SELECT t.id, t.type FROM alcohol a
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
	$type_infos["alcohols"] = $alcohols;
	$alc_types_str[] = $item["type"];
	$alc_per_type[] = $type_infos;
}

//TODO change query and do with JOINS fetch country alcohols 
$req = $sql->query("SELECT a.*, l.country_code, l.city, t.type_code FROM alcohol a
JOIN alcohol_locations al ON al.alc_id=a.id
JOIN location l ON al.location_id=l.id 
JOIN alcohol_types at ON a.id=at.alc_id
JOIN alc_type t ON at.type_id=t.id
WHERE a.id!='".$alcohol['id']."' AND l.id IN (SELECT id FROM location WHERE country_code_crc=".$country_infos['country_code_crc'].") ORDER BY a.week_view DESC LIMIT 0,10");
$country_alcohols = $sql->getResults();


//$smarty->force_compile = true;
//$smarty->debugging = true;
$smarty->caching = true;
$smarty->cache_lifetime = 1800;

$meta = array();
$meta['title']	=	"".$alcohol['name']." - ".$alcohol['type']." ".$alcohol['sub_type']." from ".$alcohol['city'].", ".$alcohol['country']."";
$meta['description'] = "".$alcohol['name'].", a ".$alcohol['sub_type']." ".$alcohol['type']." ".$alcohol['degree']."% ABV from ".$alcohol['country'].". Discover and share more ".implode(", ",$alc_types_str)." from ".$alcohol['country']."";
$meta['keywords'] = "".$alcohol['name'].", ".$alcohol['name']." ".$alcohol['company_name'].", ".$alcohol['country']." ".$alcohol['type'].", ".$alcohol['country']." ".$alcohol['sub_type']." ".$alcohol['type'].", ".$alcohol['name']." ".$alcohol['degree']." ABV,  World of alcohols, rate local alcohols, rate local beers, rate local wines, rate local whiskys";
$meta['robots'] = "index,follow,all";
$smarty->assign("meta", $meta);

$meta_property_og = array();
$meta_property_og['site_name'] = "http://worldofalcohols.com";
$meta_property_og['title'] = "".$alcohol['name']." ".$alcohol['type']." from ".$alcohol['city'].", ".$alcohol['country']." - WorldOfAlcohols.com";
$meta_property_og['image'] = "http://worldofalcohols.com/mini/".getJPEG($alcohol['image'])."";
$meta_property_og['description'] = $meta['description'];
$meta_property_og['url'] = "http://worldofalcohols.com/".$alcohol['name_code']."_".$alcohol['country_code']."-".$alcohol['type_code']."";
$meta_property_og['type'] = "image";

$smarty->assign("meta_property_og", $meta_property_og);

// handle caching & non-caching for {dynamic}{/dynamic} part
$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);						
function smarty_block_dynamic($param, $content, $smarty) {
    return $content;
}
$smarty->registerPlugin('block','dynamic', 'smarty_block_dynamic', false);

$smarty->assign("nonce", $nonce);
$smarty->assign("alcohol", $alcohol);
$smarty->assign("rating", $rating);
$smarty->assign("country_infos", $country_infos);
$smarty->assign("country_alcohols", $country_alcohols);
$smarty->assign("country_alc_types", $country_alc_types);
$smarty->assign("alc_per_type", $alc_per_type);
$smarty->registerPlugin("function","format_name", "format_name"); 
$smarty->assign("content_file", "alcohol_content.tpl");
$cacheID = "alcohol_".$alcohol["id"];
$smarty->display('index.tpl', $cacheID); 
?>
