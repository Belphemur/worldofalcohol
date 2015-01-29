<?php /* Smarty version Smarty-3.1.14, created on 2015-01-28 18:40:53
         compiled from "./templates/index_content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:166872943654c7f8a1efd7d9-26353174%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ce920154005553a8b6b1fabe419abed1dacefa5' => 
    array (
      0 => './templates/index_content.tpl',
      1 => 1422466699,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166872943654c7f8a1efd7d9-26353174',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54c7f8a1f13618_18923465',
  'variables' => 
  array (
    'nonce' => 1,
    'countries' => 0,
    'country' => 0,
    'current_country_code' => 0,
  ),
  'has_nocache_code' => true,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54c7f8a1f13618_18923465')) {function content_54c7f8a1f13618_18923465($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['site_link'] = new Smarty_variable('http://worldofalcohols.com', null, 0);?>
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

$("#inline-country").change(function(){
	var selected_val = $(this).find(':selected').val();
	if(selected_val!=""){
		window.open('' +selected_val+ '-alcohols', '_self');
	}
});

});	
</script>

<?php echo '/*%%SmartyNocache:166872943654c7f8a1efd7d9-26353174%%*/<?php $_smarty_tpl->smarty->_tag_stack[] = array(\'dynamic\', array()); $_block_repeat=true; echo smarty_block_dynamic(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
/*/%%SmartyNocache:166872943654c7f8a1efd7d9-26353174%%*/';?>

<div class="mainMsg" rel="<?php echo '/*%%SmartyNocache:166872943654c7f8a1efd7d9-26353174%%*/<?php echo $_smarty_tpl->tpl_vars[\'nonce\']->value[\'req_alcByCountryCity_id\'];?>
/*/%%SmartyNocache:166872943654c7f8a1efd7d9-26353174%%*/';?>
"><h1 class="top-margin-4 half-top-space align-center">Welcome to the world of alcohols ! </h1></div>
<?php echo '/*%%SmartyNocache:166872943654c7f8a1efd7d9-26353174%%*/<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_dynamic(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
/*/%%SmartyNocache:166872943654c7f8a1efd7d9-26353174%%*/';?>

<div class="control-group all-33 small-100">
	<div class="column-group quarter-gutters">
		<div class="control all-65">
			<select id="inline-country" name="country">
				<option value="">Choose Country:</option> 
				<?php  $_smarty_tpl->tpl_vars['country'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['country']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['countries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['country']->key => $_smarty_tpl->tpl_vars['country']->value){
$_smarty_tpl->tpl_vars['country']->_loop = true;
?>
					<?php if (mb_strtolower($_smarty_tpl->tpl_vars['country']->value['country_code'], 'UTF-8')==$_smarty_tpl->tpl_vars['current_country_code']->value){?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['country']->value['country_code'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['country']->value['country'];?>
</option>
					<?php }else{ ?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['country']->value['country_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['country']->value['country'];?>
</option>
					<?php }?>
				<?php } ?>
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
<div id="msg"></div><br><?php }} ?>