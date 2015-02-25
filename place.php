<?php
/**
 * Created by PhpStorm.
 * User: Bishesh
 * Date: 23-02-15
 * Time: 22:59
 */
require_once 'config/DB.class.php';
require_once 'config/basic_functions.php';
require('libs/Smarty.class.php');

$smarty = new Smarty;

$sql = DB::getInstance();
$sql->query("SET NAMES 'utf8'");

$nonce = array();
// will create a token named req_alcByCountryCity_id with random id for making GET request and save in session
$nonce = setNonceId($nonce, "req_alcByCountryCity_id");
$nonce = setNonceId($nonce, "req_ratePlace");

//Alcohol Info
$name = mysql_real_escape_string($_GET['name']);
$name_code = format_name($name);
//TODO add id or other info in query
//$place_id = mysql_real_escape_string($_GET['id']);

$req = $sql->query("SELECT p.id, p.type, p.name, p.name_code, p.address, p.telephone, p.description, p.opening_hours, p.image, l.country, l.country_code, l.city FROM `place` as p
JOIN place_locations pl ON p.id=pl.place_id
JOIN location l ON pl.location_id=l.id
WHERE  p.type='BAR' AND p.name_code='".$name_code."'"); //p.id='".$place_id."' AND
$place = $sql->getResult();


// fetch rating infos
$req = $sql->query("SELECT SUM(pr.value) as value, COUNT(pr.place_id) as total FROM place p
JOIN place_ratings pr ON p.id=pr.place_id
WHERE p.id='".$place["id"]."'");
$rating = $sql->getResult();
$rating["percentage"] = $rating["total"] ?  ($rating["value"]/($rating["total"]*5))*100 : 0;


// fetch other alcohols from country per type
$req = $sql->query("SELECT a.*,  l.country_code, l.city, t.type, t.type_code FROM alcohol a
JOIN alcohol_locations al ON al.alc_id=a.id
JOIN location l ON al.location_id=l.id
JOIN place_alcohols pa ON a.id=pa.alcohol_id
JOIN place p ON p.id='".$place["id"]."'
JOIN alcohol_types at ON a.id=at.alc_id
JOIN alc_type t ON at.type_id=t.id");
$place_alcohols = $sql->getResults();


$smarty->caching = false;
$smarty->cache_lifetime = 1800;

$meta = array();
$meta['title']	=	"".$place['name']." - ".ucfirst(strtolower($place['type']))." from ".$place['city'].", ".$place['country']."";
$meta['description'] = "".$place['name'].", ".ucfirst(strtolower($place['type']))." located at ".str_replace(array("\r", "\n"), "", $place['address'])." ".$place['country'].". Discover more ".ucfirst(strtolower($place['type']))." from ".$place['city']."";
$meta['keywords'] = "".$place['name'].", ".ucfirst(strtolower($place['type']))." ".$place['name'].", ".$place['city']." ".ucfirst(strtolower($place['type'])).",  ".$place['city']." ".$place['country']." ".ucfirst(strtolower($place['type'])).", bars, restuarants, stores,  World of alcohols, rate local alcohols, rate local beers, rate local wines, rate local whiskys";
$meta['robots'] = "index,follow,all";
$smarty->assign("meta", $meta);

$meta_property_og = array();
$meta_property_og['site_name'] = "http://worldofalcohols.com";
$meta_property_og['title'] = "".$place['name']." ".ucfirst(strtolower($place['type']))." from ".$place['city'].", ".$place['country']." - WorldOfAlcohols.com";
$meta_property_og['image'] = "http://worldofalcohols.com/places_mini/".getJPEG($place['image'])."";
$meta_property_og['description'] = $meta['description'];
$meta_property_og['url'] = "http://worldofalcohols.com/".$place['name_code']."_".$place['country_code']."-".strtolower($place['type'])."";
$meta_property_og['type'] = "image";

$smarty->assign("meta_property_og", $meta_property_og);

// handle caching & non-caching for {dynamic}{/dynamic} part
$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
function smarty_block_dynamic($param, $content, $smarty) {
    return $content;
}
$smarty->registerPlugin('block','dynamic', 'smarty_block_dynamic', false);

$smarty->assign("nonce", $nonce);
$smarty->assign("place", $place);
$smarty->assign("rating", $rating);
$smarty->assign("place_alcohols", $place_alcohols);
$smarty->registerPlugin("function","format_name", "format_name");
$smarty->assign("content_file", "place_content.tpl");
$cacheID = "bar_".$place["id"];
$smarty->display('index.tpl', $cacheID);
?>