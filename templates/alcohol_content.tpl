{assign var='site_link' value='http://worldofalcohols.com'}

<header class="top-margin-5 hide-all show-large show-xlarge">     
<nav class="ink-navigation">
	<ul class="breadcrumbs red flat rounded shadowed">
	<li><a href="index.php">World</a></li>
	<li><a href="{$alcohol.country_code}-alcohols">{$alcohol.country}</a></li>
	{* <li><a href="{$site_link}">{$alcohol.type}</a></li> *}
	<li class="active"><a href="#"><b>{$alcohol.name}</b></a></li>
	</ul>
	</nav>
</header>
<header class="top-margin-gap hide-all show-medium show-small show-tiny">     
<nav class="ink-navigation">
	<ul class="breadcrumbs red flat rounded shadowed">
	<li><a href="index.php">Home</a></li>
	<li><a href="{$alcohol.country_code}-alcohols">{$alcohol.country}</a></li>
	{* <li><a href="{$site_link}">{$alcohol.type}</a></li> *}
	<li class="active"><a href="#"><b>{$alcohol.name}</b></a></li>
	</ul>
	</nav>
</header>

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
function getJPEG(name) {
	var result = name.replace('.png', '.jpeg').replace('.gif', '.jpeg').replace('.jpg', '.jpeg');
	return result;
}	

google.load('visualization', '1', {
    'packages': ['geochart']
});
google.setOnLoadCallback(drawCitiesMap);

function drawCitiesMap() {
	var country = $("#country_name").attr('rel');
	var city_country = $("#country_name").attr('data');
	var countryCode = getCountryCode(country);
	console.log(countryCode);
	var options = {
        region: countryCode,
		displayMode: 'markers',
        resolution: 'city',
		backgroundColor: '#EDEDED',
		datalessRegionColor: '#CCC',
		sizeAxis: { minValue: 1, maxValue: 1 },
		colorAxis: {colors: ['green', 'orange']},
		width: 400,
		tooltip: {textStyle: {color: '#444444'}, trigger:'focus', isHtml: false},
		height: 400
		
    };
	var dimension = "alcohols";
	var req_alcByCountryCity_id = $("#country_name").attr("data-req-id");
	$.ajax({
		// param string @Country
		// returns string "@City, @Country"
		url: "req_alcByCountryCity.php?action=listByCity&req_alcByCountryCity_id="+req_alcByCountryCity_id+"&country=" + country,
		dataType: "JSON"
		}).done(function(data) {
			var countriesArray = [["City","Mark", dimension, {type:'string', role:'tooltip'}]];
			var ivalue = new Array();
			var name_codes = new Array();
			var country_codes = new Array();
			var type_codes = new Array();
			
			$.each(data.countries, function() {
				var countryitem = [this.city, 0, parseInt(this[dimension]), parseInt(this[dimension])+ " Alcohols"];
				
				if(this.city==city_country)
					countryitem = [this.city, 1, parseInt(this[dimension]), parseInt(this[dimension])+ " Alcohols"];
				
				countriesArray.push(countryitem);
				ivalue[this.city] = 'Alcohols from ' + this.city + ':</br><b> ' + this.name+ '</b><br> <img width="140" src="/mini/' + getJPEG(this.image) + '"/>';
				name_codes[this.city] = this.name_code;
				country_codes[this.city] = this.country_code;
				type_codes[this.city] = this.type_code;
			});
			
			var statesData = google.visualization.arrayToDataTable(countriesArray);
			var chart = new google.visualization.GeoChart(document.getElementById('visualization'));
			
			google.visualization.events.addListener(chart, 'select', function() {
			  var selectedItem = chart.getSelection()[0];
			  if (selectedItem) {
				  var selectedRegion = statesData.getValue(selectedItem.row, 0);
				  if(ivalue[selectedRegion] != '') { 
					//location.href = alcohol.php?name=' +names[selectedRegion];
					window.open('' +name_codes[selectedRegion]+ '_' +country_codes[selectedRegion]+ '-' +type_codes[selectedRegion]+ '', '_self');				  
				  }
			  }
			});
			chart.draw(statesData, options);
		});
}

$( document ).ready(function() {

$("#rating_options input[name='rb']").click(function () {
	$("#rating_options input[name='rb']").each(function(i) {
		$(this).attr('disabled', 'disabled');
	});
	rateAlcohol($(this).attr("rel"), $(this).attr("value"));
});

function rateAlcohol(alc_id, value) {
	var req_rateAlcohol = $("#my-progress-bar").attr("data-req-id");
	var request = $.ajax({							
		url: "req_rateAlcohol.php?action=create&req_rateAlcohol="+req_rateAlcohol+"",
		type: "POST",
		data: { 'alc_id': alc_id, 'value': value },
		dataType: 'json',
		success: function (res) {
			if(res.result == "OK") {
				$('#rating_options').html("<div class='ink-alert basic success'>Thanks for rating! </div>");
			}
			else
			{		
				$('#rating_options').html("<div class='ink-alert basic error'>" + res.msg + "</div>");
			}
		}
	});
};

});		

</script>
{/literal}


<div class="column-group gutters"> 
	<div class="xlarge-15 large-15 medium-25 small-30"> 
		<figure class="ink-image">
		<img width="140" src="{$site_link}/mini/{$alcohol.image|getJPEG}" alt="" class="imagequery">
		<figcaption class="dark over-bottom">{$alcohol.name}</figcaption>
		</figure>
	</div>
	<div class="xlarge-50 large-50 medium-65 small-65" style="margin: 0.5em">
		{dynamic}
		<div class="small-100">
		<h3 id="country_name" rel="{$alcohol.country}" data="{$alcohol.city}, {$alcohol.country}" data-req-id="{$nonce.req_alcByCountryCity_id}">{$alcohol.name}</h3>
		{/dynamic}
		Type: {$alcohol.type}<br>
		Genre: {$alcohol.sub_type}<br>
		Brewery: {$alcohol.company_name}<br>
		Brewed in: {$alcohol.city}, {$alcohol.country}<br><br>
		ABV: <b>{$alcohol.degree}</b> %
		</div>
		<br>
		<span class='st_pinterest_hcount' displayText='Pinterest'></span>
		<span class='st_twitter_hcount' displayText='Tweet'></span>
		<span class='st_googleplus_hcount' displayText='Google +'></span>
		<span class='st_facebook_hcount' displayText='Facebook'></span>
		<span class='st_reddit_hcount' displayText='Reddit'></span>
		<div class="small-100" id="visualization"></div>
	</div>
	<div class="xlarge-30 large-30 medium-50 small-100"> 
		<form class="ink-form">
			<fieldset>
				<legend>Rate this {$alcohol.type}</legend>
				{dynamic}
				<div id="my-progress-bar" class="ink-progress-bar grey" data-req-id="{$nonce.req_rateAlcohol}" data-start-value="{$rating.value}">
				  <span class="caption">{$rating.value} ({$rating.total} Ratings)</span>
				  {if $rating.value > 10 }
					<div class="bar green"></div>
				  {elseif $rating.value > 0}
					<div class="bar orange"></div>
				  {else}
					<div class="bar red"></div>
				  {/if}
				</div>
				{/dynamic}
				<div class="control-group">
					<p class="label">Have you tried this {$alcohol.type} already? Let us know your opinion</p>
					<div id="rating_options">
					<ul class="control unstyled">
						<li class="tip" data-tip-text="+2" data-tip-where="up" data-tip-color="green"><input type="radio" id="rb1" name="rb" rel="{$alcohol.id}" value="2"><label for="rb1" class="rating_option"><b>A piece of art !</b> My dream is to have a pool filled with this alcohol !</label></li>
						<li class="tip" data-tip-text="+1" data-tip-where="up" data-tip-color="green"><input type="radio" id="rb2" name="rb" rel="{$alcohol.id}" value="1"><label for="rb2" class="rating_option"><b>Better than average.</b> To discover with friends.</label></li>
						<li class="tip" data-tip-text="ok" data-tip-where="up" data-tip-color="orange"><input type="radio" id="rb3" name="rb" rel="{$alcohol.id}" value="0"><label for="rb3" class="rating_option"><b>I don't remember</b>, but it was a legendary night !</label></li>
						<li class="tip" data-tip-text="-1" data-tip-where="up" data-tip-color="red"><input type="radio" id="rb4" name="rb" rel="{$alcohol.id}" value="-1"><label for="rb4" class="rating_option"><b>Drinkable</b> when you are already drunk ! </label></li>
						<li class="tip" data-tip-text="-2" data-tip-where="up" data-tip-color="red"><input type="radio" id="rb5" name="rb" rel="{$alcohol.id}" value="-2"><label for="rb5" class="rating_option"><b>I prefer water</b> !</label></li>
					</ul>
					</div>
				</div>
			</fieldset>
		</form>
		 <div class="ink-alert basic warning all-100">
		<h5>Do you know any other local alcohol from {$alcohol.country} ? Feel free to share it with us </h5>
		<a href="submit.php?country={$alcohol.country_code}" class="ink-button green">Submit local alcohol </a>
		</div>
	</div>
</div>

{* Popular Alcohols *}
{if $country_alcohols|count > 0}
<h3><i class='icon-trophy'></i> Popular Alcohols from {$alcohol.country} </h3>
<div class="column-group gutters"> 
	{foreach $country_alcohols as $alcohol_item}
		<div class="xlarge-10 large-10 medium-15 small-25">
		<a href="{$alcohol_item.name_code}_{$alcohol_item.country_code}-{$alcohol_item.type_code}">
		<figure class="ink-image">
		<img width="140" src="{$site_link}/mini/{$alcohol_item.image|getJPEG}" alt="" class="imagequery">
		<figcaption class="dark over-bottom">{$alcohol_item.name}</figcaption>
		</figure></a>                        
		</div>
	{/foreach}
</div>
{/if}

{* Needed for the Rating bar*}
<script>
    Ink.requireModules( ['Ink.UI.ProgressBar_1'], function(ProgressBar){
        var myProgressBar = new ProgressBar( '#my-progress-bar' );
    });
</script>
{* Needed for tooltip*}
<script>
Ink.requireModules( ['Ink.UI.Tooltip_1'], function( Tooltip ){
    var Tooltip = new Tooltip( '#rating_options .tip');
});
</script>
