{assign var='site_link' value='http://worldofalcohols.com'}
<div class="top-margin-5 hide-all show-large show-xlarge"></div>
<div class="top-margin-gap hide-all show-medium show-small show-tiny"></div>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js"></script>

<!-- Custom Styles for Interactive World Maps -->
<style type="text/css">
#visualization path:not([fill^="#ffffff"]):hover {
fill:#ECBF4B;
cursor:pointer;
}
</style>

{literal}
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1', {
    'packages': ['geochart']
});
google.setOnLoadCallback(drawVisualization, "world");

/*window.onresize = function(){
	drawVisualization();
};*/
	
function drawVisualization(region) {
	var options = {
        region: region,
        displayMode: 'country',
        resolution: 'country',
		backgroundColor: '#EDEDED',
		datalessRegionColor: '#FFFFFF'

    };
	
	// field in json we are interested in
	var dimension = "alcohols"; 
	var req_alcByCountryCity_id = $(".mainMsg").attr("rel");
	$.ajax({
		url: "req_alcByCountryCity.php?action=listByCountry&req_alcByCountryCity_id="+req_alcByCountryCity_id+"",
		dataType: "JSON"
		}).done(function(data) {
			var countriesArray = [["Country",dimension]];
			var country_codes = new Array();
			var sum = 0;
			$.each(data.countries, function() {
				var countryitem = [this.country, parseInt(this[dimension])];
				countriesArray.push(countryitem);
				$('#data').append('<li>' + countryitem[0] + ': ' + countryitem[1] + '</li>');
				sum += countryitem[1];
				country_codes[this.country] = this.country_code;
			});
			$('#data').append('<b>Total</b>: ' + sum + ' ');
			var statesData = google.visualization.arrayToDataTable(countriesArray);
			var chart = new google.visualization.GeoChart(document.getElementById('visualization'));
			
			//listener
			google.visualization.events.addListener(chart, 'select', function() {
			var selectedItem = chart.getSelection()[0];
				if (selectedItem) {
					var country = statesData.getValue(selectedItem.row, 0);
					window.open('' +country_codes[country]+ '-alcohols', '_self');
				}
			});
			
			chart.draw(statesData, options);
			
		});
};
$( document ).ready(function() {

$('#showRegion button').click( function (e) { 
	var id = $(this).attr("id");
	drawVisualization(id);
}); 

$("#inline-country").change(function(){
	var selected_val = $(this).find(':selected').val();
	if(selected_val!=""){
		window.open('' +selected_val+ '-alcohols', '_self');
	}
});

$("#inline-country").select2({
    placeholder: "Choose a Country",
    allowClear: true
});
});	
</script>
{/literal}
{dynamic}
<div class="mainMsg" rel="{$nonce.req_alcByCountryCity_id}"><h1 class="top-margin-4 half-top-space align-center">Welcome to the world of alcohols ! </h1></div>
{/dynamic}
<div class="control-group all-33 small-100">
	<div class="column-group quarter-gutters">
		<div class="control all-65">
			<select id="inline-country" name="country">
				<option value="">Choose Country:</option> 
				{foreach $countries as $country}
					{if $country.country_code|lower == $current_country_code}
						<option value="{$country.country_code}" selected>{$country.country}</option>
					{else}
						<option value="{$country.country_code}">{$country.country}</option>
					{/if}
				{/foreach}
			</select>
		</div>
	</div>
</div>
<div class="column-group half-gutters">
	<div class="xlarge-15 large-15 medium-30 small-100"> 
		<div class="column-group top-space" id="showRegion">
			<h5>Choose a continent : </h5>
			<div class="all-100 half-top-space"><button class="ink-button green" id="002">Africa</button></div>
			<div class="all-100 half-top-space"><button class="ink-button orange" id="142">Asia</button></div>
			<div class="all-100 half-top-space"><button class="ink-button blue" id="150">Europe</button></div>
			<div class="all-100 half-top-space"><button class="ink-button red" id="019">Americas</button></div>
			<div class="all-100 half-top-space"><button class="ink-button black" id="009">Oceania</button></div>
			<div class="all-100 half-top-space"><button class="ink-button grey" id="world">World</button></div>
		</div>
	</div>
	<div class="xlarge-80 large-80 medium-70 small-100" style="margin: 0.5em">
		<div id="visualization"></div>
	</div>
</div>
<div id="msg"></div><br>