<?php /* Smarty version Smarty-3.1.14, created on 2015-01-27 21:42:04
         compiled from "./templates/index_content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23766017254c7f81c311af3-71814053%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ce920154005553a8b6b1fabe419abed1dacefa5' => 
    array (
      0 => './templates/index_content.tpl',
      1 => 1422309266,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23766017254c7f81c311af3-71814053',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'nonce' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54c7f81c31b879_09080595',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54c7f81c31b879_09080595')) {function content_54c7f81c31b879_09080595($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['site_link'] = new Smarty_variable('http://worldofalcohols.com', null, 0);?>
<div class="top-margin-5 hide-all show-large show-xlarge"></div>
<div class="top-margin-gap hide-all show-medium show-small show-tiny"></div>



<!-- Custom Styles for Interactive World Maps -->
<style type="text/css">
#visualization path:not([fill^="#ffffff"]):hover {
fill:#ECBF4B;
cursor:pointer;
}
</style>


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

});	
</script>

<div class="mainMsg" rel="<?php echo $_smarty_tpl->tpl_vars['nonce']->value['req_alcByCountryCity_id'];?>
"><h1 class="top-margin-4 half-top-space align-center">Welcome to the world of alcohols ! </h1></div>
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
<div id="msg"></div><br><?php }} ?>