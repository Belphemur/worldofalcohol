<?php
require_once '../config/DB.class.php';
include '../config/fonctions.php';

$sitename = "http://worldofalcohols.com";
$sql = DB::getInstance();
$sql->query("SET NAMES 'utf8'");

/* alcohol pages */
$data = $sql->getResults("SELECT a.name_code, t.type_code,l.country_code FROM alcohol a
JOIN alcohol_types at ON a.id=at.alc_id
JOIN alc_type t ON at.type_id=t.id
JOIN alcohol_locations al ON a.id=al.alc_id
JOIN location l ON al.location_id=l.id
 ORDER by a.id desc");
$date_pour_xml = date("Y-m-d");
$freq_pour_xml='weekly';

$xml = '<?xml version="1.0" encoding="UTF-8"?>';
$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$xml .= '<url>';
$xml .= '<loc>'.$sitename.'</loc>';
$xml .= '<lastmod>'.$date_pour_xml.'</lastmod>';
$xml .= '<changefreq>daily</changefreq>';
$xml .= '<priority>1</priority>';
$xml .= '</url>';

foreach($data as $entry)
{
    echo $entry['name_code'].'_'.$entry['country_code'].'-'.$entry['type_code'].'<br>';

    $xml .= '<url>';
    $xml .= '<loc>'.$sitename.'/'.$entry['name_code'].'_'.$entry['country_code'].'-'.$entry['type_code'].'</loc>';
    $xml .= '<lastmod>'.$date_pour_xml.'</lastmod>';
    $xml .= '<changefreq>'.$freq_pour_xml.'</changefreq>';
    $xml .= '<priority>0.8</priority>';
    $xml .= '</url>';
}
$xml .= '</urlset>';
// écriture dans le fichier
$fp = fopen("../alcohols_sitemap.xml", 'w+');
fputs($fp, $xml);
fclose($fp);
/*
echo '<hr>';
// pages cats 
$data = $sql->getResults("SELECT category_codename FROM categories WHERE id IN (SELECT id_category FROM image_categories) ORDER By category");

$freq_pour_xml='weekly';

$xml = '<?xml version="1.0" encoding="UTF-8"?>';
$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

foreach($data as $entry)
{
	echo $entry['category_codename'].'<br>';

	$xml .= '<url>';
	$xml .= '<loc>'.$sitename.'/'.$entry['category_codename'].'-wallpapers</loc>';
	$xml .= '<lastmod>'.$date_pour_xml.'</lastmod>';
	$xml .= '<changefreq>'.$freq_pour_xml.'</changefreq>'; 
	$xml .= '<priority>0.9</priority>';
	$xml .= '</url>';
}

$xml .= '</urlset>';
// écriture dans le fichier
$fp = fopen("../cats_sitemap.xml", 'w+');
fputs($fp, $xml);
fclose($fp);

// pages sub cats 
$data = $sql->getResults("SELECT sub_category_codename FROM sub_categories WHERE id IN (SELECT id_sub_category FROM image_sub_categories) ORDER By sub_category");

$freq_pour_xml='weekly';

$xml = '<?xml version="1.0" encoding="UTF-8"?>';
$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

foreach($data as $entry)
{
	echo $entry['sub_category_codename'].'<br>';

	$xml .= '<url>';
	$xml .= '<loc>'.$sitename.'/'.$entry['sub_category_codename'].'-uhd-wallpapers</loc>';
	$xml .= '<lastmod>'.$date_pour_xml.'</lastmod>';
	$xml .= '<changefreq>'.$freq_pour_xml.'</changefreq>'; 
	$xml .= '<priority>0.9</priority>';
	$xml .= '</url>';
}

$xml .= '</urlset>';
// écriture dans le fichier
$fp = fopen("../sub_cats_sitemap.xml", 'w+');
fputs($fp, $xml);
fclose($fp);
*/
?>