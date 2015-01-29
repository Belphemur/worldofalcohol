{assign var='site_link' value='http://worldofalcohols.com'}

<header class="top-margin-5 hide-all show-large show-xlarge">     
<nav class="ink-navigation">
	<ul class="breadcrumbs red flat rounded shadowed">
	<li><a href="{$site_link}/index.php">World</a></li>
	<li class="active"><a href="#"><b>{$country_infos.country}</b></a></li>
	</ul>
	</nav>
</header>
<header class="top-margin-gap hide-all show-medium show-small show-tiny">     
<nav class="ink-navigation">
	<ul class="breadcrumbs red flat rounded shadowed">
	<li><a href="{$site_link}/index.php">World</a></li>
	<li class="active"><a href="#"><b>{$country_infos.country}</b></a></li>
	</ul>
	</nav>
</header>
<!-- italy & belgium region-->
<style type="text/css">
/*#visualization path:nth-child(230),
#visualization path:nth-child(229),
#visualization path:nth-child(228),
#visualization path:nth-child(2) 
{
fill:yellow;
}*/
</style>
{literal} 
<script type="text/javascript" src="js/countrycodes.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<style type="text/css">
#visualization circle:not([fill^="#cccccc"]):hover {
fill:#ECBF4B;
cursor:pointer;
}
</style>
<script type="text/javascript">
$( document ).ready(function() {
	$('ul.submenu li').bind("mouseenter", (function(e){
		$(this).parent().siblings('a.item_link').addClass('fw-700');
	}));
	$('ul.submenu li').bind("mouseleave", (function(e){
		$(this).parent().siblings('a.item_link').removeClass('fw-700');
	}));
});

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function getJPEG(name) {
	var result = name.replace('.png', '.jpeg').replace('.gif', '.jpeg').replace('.jpg', '.jpeg');
	return result;
}	


google.load('visualization', '1', {
    'packages': ['geochart']
});
google.setOnLoadCallback(drawCitiesMap);

function drawCitiesMap() {
	//var country = getParameterByName("country");
	var country = $("#country_name").attr('rel');
	var countryCode = getCountryCode(country);
	var options = {
        region: countryCode,
		displayMode: 'markers',
        resolution: 'city',
		enableRegionInteractivity: 'true',
		backgroundColor: '#EDEDED',
		sizeAxis: { minValue: 1, maxValue: 1 },
		colorAxis: {colors: ['green', 'green']},
		datalessRegionColor: '#CCC'
    };
	var dimension = "alcohols";
	var req_alcByCountryCity_id = $("#country_name").attr("data-req-id");
	$.ajax({
		// param string @Country
		// returns string "@City, @Country"
		url: "req_alcByCountryCity.php?action=listByCity&req_alcByCountryCity_id="+req_alcByCountryCity_id+"&country=" + country,
		dataType: "JSON"
		}).done(function(data) {
			var countriesArray = [["City","color", dimension, {type:'string', role:'tooltip'}]];
			var ivalue = new Array();
			
			$.each(data.countries, function() {
				var countryitem = [this.city, 1, parseInt(this[dimension]), parseInt(this[dimension])+ " Alcohols"];
				countriesArray.push(countryitem);
				ivalue[this.city] = 'Alcohols from ' + this.city + ':</br></br><a href="' + this.name_code+ '_' + this.country_code+ '-' + this.type_code+ '"><img width="140" src="/mini/' + getJPEG(this.image) + '"/> <h6> ' + this.name+ '</h6></a>';
			});
			
			var statesData = google.visualization.arrayToDataTable(countriesArray);
			var chart = new google.visualization.GeoChart(document.getElementById('visualization'));
			
			google.visualization.events.addListener(chart, 'select', function() {
			  var selectedItem = chart.getSelection()[0];
			  if (selectedItem) {
				  var selectedRegion = statesData.getValue(selectedItem.row, 0);
				  if(ivalue[selectedRegion] != '') { document.getElementById('info_beer').innerHTML = ivalue[selectedRegion];  $('#country_details').hide(); }
			  }
			});
			chart.draw(statesData, options);
		});
}		
</script>
{/literal}
{dynamic}
<h2 id="country_name" rel="{$country_infos.country}" data-req-id="{$nonce.req_alcByCountryCity_id}">{$country_infos.country}</h2>
{/dynamic} 

<div class="column-group half-gutters">
	<div class="xlarge-15 large-15 medium-20 small-100"> 
		<a href="submit.php?country={$country_infos.country_code}" class="ink-button xlarge-100 large-100 medium-100 small-100 green">Share local alcohol</a>
			<nav class="ink-navigation half-top-space">
				<ul class="menu vertical black">
				<li class="heading active"><a href="#">Alcohol Types</a></li>
				{foreach $alc_per_type as $item}
					<li class="menu_id">
						<a href="#{$item.type}" class="item_link">{$item.type}</a>
						<ul class="submenu">
							{foreach $item.alcohols as $sub_item}
							<li><a href="{$sub_item.name|format_name}_{$country_infos.country_code}-{$item.type_code}">{$sub_item.name}</a></li>
							{/foreach}
						</ul>
					</li>
				{/foreach}
				</ul>
			</nav>
	</div>
	<div class="xlarge-60 large-60 medium-55 small-100" style="margin: 0.5em">
		<div id="visualization"></div>
	</div>
	<div class="xlarge-20 large-20 medium-20 small-100">
	<div id="info_beer"></div>
	<div class="ink-alert basic info">
<img src="flags_mini/{$country_infos.flag}" /><br>
Capital: <b>{$country_infos.capital}</b><br>
Population: <b>{$country_infos.population|number_format}</b><br>
<div id="country_details">
Surface: <b>{$country_infos.area|number_format} km²</b><br>
Currency: <b>{$country_infos.currencycode}</b><br>
Motto: <b>{$country_infos.motto}</b><br><br>
Drinking age: <b>{$country_infos.drinking_age}</b><br>
National Alcohols: <b>{$country_infos.national_alcohols}</b><br>
{if $country_infos.extra_info != "" }
	Other Infos: <b>{$country_infos.extra_info}</b>
{/if}
</div>
</div>
	</div>
</div>
<div class="ink-alert basic warning all-60 small-100">
<h5>Do you know any other local alcohol from {$country_infos.country} ? Feel free to share it with us </h5>
<a href="submit.php?country={$country_infos.country_code}" class="ink-button green"> Submit local alcohol </a><br>
</div>

{* Popular Alcohols *}
{if $country_alcohols|count > 0}
<h3 class="quarter-top-space"><i class='icon-trophy'></i>Popular Alcohols from {$country_infos.country} </h3>
<div class="column-group gutters"> 
	{foreach $country_alcohols as $alcohol_item}
		<div class="xlarge-10 large-10 medium-15 small-25">
		<a href="{$alcohol_item.name_code}_{$alcohol_item.country_code}-{$alcohol_item.type_code}">
		<figure class="ink-image">
		<img width="140" src="{$site_link}/mini/{$alcohol_item.image|getJPEG}" alt="" class="imagequery popular">
		<figcaption class="dark over-bottom">{$alcohol_item.name}</figcaption>
		</figure></a>                        
		</div>
	{/foreach}
</div>
{/if}
