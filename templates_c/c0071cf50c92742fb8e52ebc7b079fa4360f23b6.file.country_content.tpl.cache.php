<?php /* Smarty version Smarty-3.1.14, created on 2015-01-28 23:51:35
         compiled from "./templates/country_content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:57801676854c7f5dae5d0b7-63467538%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0071cf50c92742fb8e52ebc7b079fa4360f23b6' => 
    array (
      0 => './templates/country_content.tpl',
      1 => 1422485466,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '57801676854c7f5dae5d0b7-63467538',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54c7f5daf21673_66969708',
  'variables' => 
  array (
    'site_link' => 0,
    'country_infos' => 0,
    'nonce' => 1,
    'alc_per_type' => 0,
    'item' => 0,
    'sub_item' => 0,
    'country_alcohols' => 0,
    'alcohol_item' => 0,
  ),
  'has_nocache_code' => true,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54c7f5daf21673_66969708')) {function content_54c7f5daf21673_66969708($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['site_link'] = new Smarty_variable('http://worldofalcohols.com', null, 0);?>

<header class="top-margin-5 hide-all show-large show-xlarge">     
<nav class="ink-navigation">
	<ul class="breadcrumbs red flat rounded shadowed">
	<li><a href="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/index.php">World</a></li>
	<li class="active"><a href="#"><b><?php echo $_smarty_tpl->tpl_vars['country_infos']->value['country'];?>
</b></a></li>
	</ul>
	</nav>
</header>
<header class="top-margin-gap hide-all show-medium show-small show-tiny">     
<nav class="ink-navigation">
	<ul class="breadcrumbs red flat rounded shadowed">
	<li><a href="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/index.php">World</a></li>
	<li class="active"><a href="#"><b><?php echo $_smarty_tpl->tpl_vars['country_infos']->value['country'];?>
</b></a></li>
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

<?php echo '/*%%SmartyNocache:57801676854c7f5dae5d0b7-63467538%%*/<?php $_smarty_tpl->smarty->_tag_stack[] = array(\'dynamic\', array()); $_block_repeat=true; echo smarty_block_dynamic(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
/*/%%SmartyNocache:57801676854c7f5dae5d0b7-63467538%%*/';?>

<h2 id="country_name" rel="<?php echo '/*%%SmartyNocache:57801676854c7f5dae5d0b7-63467538%%*/<?php echo $_smarty_tpl->tpl_vars[\'country_infos\']->value[\'country\'];?>
/*/%%SmartyNocache:57801676854c7f5dae5d0b7-63467538%%*/';?>
" data-req-id="<?php echo '/*%%SmartyNocache:57801676854c7f5dae5d0b7-63467538%%*/<?php echo $_smarty_tpl->tpl_vars[\'nonce\']->value[\'req_alcByCountryCity_id\'];?>
/*/%%SmartyNocache:57801676854c7f5dae5d0b7-63467538%%*/';?>
"><?php echo '/*%%SmartyNocache:57801676854c7f5dae5d0b7-63467538%%*/<?php echo $_smarty_tpl->tpl_vars[\'country_infos\']->value[\'country\'];?>
/*/%%SmartyNocache:57801676854c7f5dae5d0b7-63467538%%*/';?>
</h2>
<?php echo '/*%%SmartyNocache:57801676854c7f5dae5d0b7-63467538%%*/<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_dynamic(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
/*/%%SmartyNocache:57801676854c7f5dae5d0b7-63467538%%*/';?>
 

<div class="column-group half-gutters">
	<div class="xlarge-15 large-15 medium-20 small-100"> 
			<nav class="ink-navigation">
				<ul class="menu vertical black">
				<li class="heading active"><a href="#">Alcohol Types</a></li>
				<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['alc_per_type']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
					<li class="menu_id">
						<a href="#<?php echo $_smarty_tpl->tpl_vars['item']->value['type'];?>
" class="item_link"><?php echo $_smarty_tpl->tpl_vars['item']->value['type'];?>
</a>
						<ul class="submenu">
							<?php  $_smarty_tpl->tpl_vars['sub_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sub_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['alcohols']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sub_item']->key => $_smarty_tpl->tpl_vars['sub_item']->value){
$_smarty_tpl->tpl_vars['sub_item']->_loop = true;
?>
							<li><a href="<?php echo format_name($_smarty_tpl->tpl_vars['sub_item']->value['name']);?>
_<?php echo $_smarty_tpl->tpl_vars['country_infos']->value['country_code'];?>
-<?php echo $_smarty_tpl->tpl_vars['item']->value['type_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['sub_item']->value['name'];?>
</a></li>
							<?php } ?>
						</ul>
					</li>
				<?php } ?>
				</ul>
			</nav>
	</div>
	<div class="xlarge-60 large-60 medium-55 small-100" style="margin: 0.5em">
		<div id="visualization"></div>
	</div>
	<div class="xlarge-20 large-20 medium-20 small-100">
	<div id="info_beer"></div>
	<div class="ink-alert basic info">
<img src="flags_mini/<?php echo $_smarty_tpl->tpl_vars['country_infos']->value['flag'];?>
" /><br>
Capital: <b><?php echo $_smarty_tpl->tpl_vars['country_infos']->value['capital'];?>
</b><br>
Population: <b><?php echo number_format($_smarty_tpl->tpl_vars['country_infos']->value['population']);?>
</b><br>
<div id="country_details">
Surface: <b><?php echo number_format($_smarty_tpl->tpl_vars['country_infos']->value['area']);?>
 km²</b><br>
Currency: <b><?php echo $_smarty_tpl->tpl_vars['country_infos']->value['currencycode'];?>
</b><br>
Motto: <b><?php echo $_smarty_tpl->tpl_vars['country_infos']->value['motto'];?>
</b><br><br>
Drinking age: <b><?php echo $_smarty_tpl->tpl_vars['country_infos']->value['drinking_age'];?>
</b><br>
National Alcohols: <b><?php echo $_smarty_tpl->tpl_vars['country_infos']->value['national_alcohols'];?>
</b><br>
<?php if ($_smarty_tpl->tpl_vars['country_infos']->value['extra_info']!=''){?>
	Other Infos: <b><?php echo $_smarty_tpl->tpl_vars['country_infos']->value['extra_info'];?>
</b>
<?php }?>
</div>
</div>
	</div>
</div>
<div class="ink-alert basic warning all-60 small-100">
<h5>Do you know any other local alcohol from <?php echo $_smarty_tpl->tpl_vars['country_infos']->value['country'];?>
 ? Feel free to share it with us </h5>
<a href="submit.php?country=<?php echo $_smarty_tpl->tpl_vars['country_infos']->value['country_code'];?>
" class="ink-button green"> Submit local alcohol </a><br>
</div>


<?php if (count($_smarty_tpl->tpl_vars['country_alcohols']->value)>0){?>
<h3 class="quarter-top-space"><i class='icon-trophy'></i>Popular Alcohols from <?php echo $_smarty_tpl->tpl_vars['country_infos']->value['country'];?>
 </h3>
<div class="column-group gutters"> 
	<?php  $_smarty_tpl->tpl_vars['alcohol_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['alcohol_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country_alcohols']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['alcohol_item']->key => $_smarty_tpl->tpl_vars['alcohol_item']->value){
$_smarty_tpl->tpl_vars['alcohol_item']->_loop = true;
?>
		<div class="xlarge-10 large-10 medium-15 small-25">
		<a href="<?php echo $_smarty_tpl->tpl_vars['alcohol_item']->value['name_code'];?>
_<?php echo $_smarty_tpl->tpl_vars['alcohol_item']->value['country_code'];?>
-<?php echo $_smarty_tpl->tpl_vars['alcohol_item']->value['type_code'];?>
">
		<figure class="ink-image">
		<img width="140" src="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/mini/<?php echo getJPEG($_smarty_tpl->tpl_vars['alcohol_item']->value['image']);?>
" alt="" class="imagequery popular">
		<figcaption class="dark over-bottom"><?php echo $_smarty_tpl->tpl_vars['alcohol_item']->value['name'];?>
</figcaption>
		</figure></a>                        
		</div>
	<?php } ?>
</div>
<?php }?><?php }} ?>