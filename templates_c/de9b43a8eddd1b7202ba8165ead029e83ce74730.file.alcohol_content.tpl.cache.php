<?php /* Smarty version Smarty-3.1.14, created on 2015-01-28 22:19:18
         compiled from "./templates/alcohol_content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:44829867454c7f2a5c11f00-73435113%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de9b43a8eddd1b7202ba8165ead029e83ce74730' => 
    array (
      0 => './templates/alcohol_content.tpl',
      1 => 1422479937,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '44829867454c7f2a5c11f00-73435113',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54c7f2a5ca5545_53501094',
  'variables' => 
  array (
    'site_link' => 0,
    'alcohol' => 0,
    'nonce' => 1,
    'rating' => 1,
    'country_alcohols' => 0,
    'alcohol_item' => 0,
  ),
  'has_nocache_code' => true,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54c7f2a5ca5545_53501094')) {function content_54c7f2a5ca5545_53501094($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['site_link'] = new Smarty_variable('http://worldofalcohols.com', null, 0);?>

<header class="top-margin-5 hide-all show-large show-xlarge">     
<nav class="ink-navigation">
	<ul class="breadcrumbs red flat rounded shadowed">
	<li><a href="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/index.php">World</a></li>
	<li><a href="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['alcohol']->value['country_code'];?>
-alcohols"><?php echo $_smarty_tpl->tpl_vars['alcohol']->value['country'];?>
</a></li>
	
	<li class="active"><a href="#"><b><?php echo $_smarty_tpl->tpl_vars['alcohol']->value['name'];?>
</b></a></li>
	</ul>
	</nav>
</header>
<header class="top-margin-gap hide-all show-medium show-small show-tiny">     
<nav class="ink-navigation">
	<ul class="breadcrumbs red flat rounded shadowed">
	<li><a href="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/index.php">Home</a></li>
	<li><a href="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['alcohol']->value['country_code'];?>
-alcohols"><?php echo $_smarty_tpl->tpl_vars['alcohol']->value['country'];?>
</a></li>
	
	<li class="active"><a href="#"><b><?php echo $_smarty_tpl->tpl_vars['alcohol']->value['name'];?>
</b></a></li>
	</ul>
	</nav>
</header>


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



<div class="column-group gutters"> 
	<div class="xlarge-15 large-15 medium-25 small-30"> 
		<figure class="ink-image">
		<img width="140" src="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/mini/<?php echo getJPEG($_smarty_tpl->tpl_vars['alcohol']->value['image']);?>
" alt="" class="imagequery">
		<figcaption class="dark over-bottom"><?php echo $_smarty_tpl->tpl_vars['alcohol']->value['name'];?>
</figcaption>
		</figure>
	</div>
	<div class="xlarge-50 large-50 medium-65 small-65" style="margin: 0.5em">
		<?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php $_smarty_tpl->smarty->_tag_stack[] = array(\'dynamic\', array()); $_block_repeat=true; echo smarty_block_dynamic(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>

		<div class="small-100">
		<h3 id="country_name" rel="<?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php echo $_smarty_tpl->tpl_vars[\'alcohol\']->value[\'country\'];?>
/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>
" data="<?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php echo $_smarty_tpl->tpl_vars[\'alcohol\']->value[\'city\'];?>
/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>
, <?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php echo $_smarty_tpl->tpl_vars[\'alcohol\']->value[\'country\'];?>
/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>
" data-req-id="<?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php echo $_smarty_tpl->tpl_vars[\'nonce\']->value[\'req_alcByCountryCity_id\'];?>
/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>
"><?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php echo $_smarty_tpl->tpl_vars[\'alcohol\']->value[\'name\'];?>
/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>
</h3>
		<?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_dynamic(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>

		Type: <?php echo $_smarty_tpl->tpl_vars['alcohol']->value['type'];?>
<br>
		Genre: <?php echo $_smarty_tpl->tpl_vars['alcohol']->value['sub_type'];?>
<br>
		Brewery: <?php echo $_smarty_tpl->tpl_vars['alcohol']->value['company_name'];?>
<br>
		Brewed in: <?php echo $_smarty_tpl->tpl_vars['alcohol']->value['city'];?>
, <?php echo $_smarty_tpl->tpl_vars['alcohol']->value['country'];?>
<br><br>
		ABV: <b><?php echo $_smarty_tpl->tpl_vars['alcohol']->value['degree'];?>
</b> %
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
				<legend>Rate this <?php echo $_smarty_tpl->tpl_vars['alcohol']->value['type'];?>
</legend>
				<?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php $_smarty_tpl->smarty->_tag_stack[] = array(\'dynamic\', array()); $_block_repeat=true; echo smarty_block_dynamic(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>

				<div id="my-progress-bar" class="ink-progress-bar grey" data-req-id="<?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php echo $_smarty_tpl->tpl_vars[\'nonce\']->value[\'req_rateAlcohol\'];?>
/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>
" data-start-value="<?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php echo $_smarty_tpl->tpl_vars[\'rating\']->value[\'value\'];?>
/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>
">
				  <span class="caption"><?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php echo $_smarty_tpl->tpl_vars[\'rating\']->value[\'value\'];?>
/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>
 (<?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php echo $_smarty_tpl->tpl_vars[\'rating\']->value[\'total\'];?>
/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>
 Ratings)</span>
				  <?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php if ($_smarty_tpl->tpl_vars[\'rating\']->value[\'value\']>10){?>/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>

					<div class="bar green"></div>
				  <?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php }elseif($_smarty_tpl->tpl_vars[\'rating\']->value[\'value\']>0){?>/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>

					<div class="bar orange"></div>
				  <?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php }else{ ?>/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>

					<div class="bar red"></div>
				  <?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php }?>/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>

				</div>
				<?php echo '/*%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_dynamic(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
/*/%%SmartyNocache:44829867454c7f2a5c11f00-73435113%%*/';?>

				<div class="control-group">
					<p class="label">Have you tried this <?php echo $_smarty_tpl->tpl_vars['alcohol']->value['type'];?>
 already? Let us know your opinion</p>
					<div id="rating_options">
					<ul class="control unstyled">
						<li class="tip" data-tip-text="+2" data-tip-where="up" data-tip-color="green"><input type="radio" id="rb1" name="rb" rel="<?php echo $_smarty_tpl->tpl_vars['alcohol']->value['id'];?>
" value="2"><label for="rb1" class="rating_option"><b>A piece of art !</b> My dream is to have a pool filled with this alcohol !</label></li>
						<li class="tip" data-tip-text="+1" data-tip-where="up" data-tip-color="green"><input type="radio" id="rb2" name="rb" rel="<?php echo $_smarty_tpl->tpl_vars['alcohol']->value['id'];?>
" value="1"><label for="rb2" class="rating_option"><b>Better than average.</b> To discover with friends.</label></li>
						<li class="tip" data-tip-text="ok" data-tip-where="up" data-tip-color="orange"><input type="radio" id="rb3" name="rb" rel="<?php echo $_smarty_tpl->tpl_vars['alcohol']->value['id'];?>
" value="0"><label for="rb3" class="rating_option"><b>I don't remember</b>, but it was a legendary night !</label></li>
						<li class="tip" data-tip-text="-1" data-tip-where="up" data-tip-color="red"><input type="radio" id="rb4" name="rb" rel="<?php echo $_smarty_tpl->tpl_vars['alcohol']->value['id'];?>
" value="-1"><label for="rb4" class="rating_option"><b>Drinkable</b> when you are already drunk ! </label></li>
						<li class="tip" data-tip-text="-2" data-tip-where="up" data-tip-color="red"><input type="radio" id="rb5" name="rb" rel="<?php echo $_smarty_tpl->tpl_vars['alcohol']->value['id'];?>
" value="-2"><label for="rb5" class="rating_option"><b>I prefer water</b> !</label></li>
					</ul>
					</div>
				</div>
			</fieldset>
		</form>
		 <div class="ink-alert basic warning all-100">
		<h5>Do you know any other local alcohol from <?php echo $_smarty_tpl->tpl_vars['alcohol']->value['country'];?>
 ? Feel free to share it with us </h5>
		<a href="submit.php?country=<?php echo $_smarty_tpl->tpl_vars['alcohol']->value['country_code'];?>
" class="ink-button green">Submit local alcohol </a>
		</div>
	</div>
</div>


<?php if (count($_smarty_tpl->tpl_vars['country_alcohols']->value)>0){?>
<h3><i class='icon-trophy'></i> Popular Alcohols from <?php echo $_smarty_tpl->tpl_vars['alcohol']->value['country'];?>
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
" alt="" class="imagequery">
		<figcaption class="dark over-bottom"><?php echo $_smarty_tpl->tpl_vars['alcohol_item']->value['name'];?>
</figcaption>
		</figure></a>                        
		</div>
	<?php } ?>
</div>
<?php }?>


<script>
    Ink.requireModules( ['Ink.UI.ProgressBar_1'], function(ProgressBar){
        var myProgressBar = new ProgressBar( '#my-progress-bar' );
    });
</script>

<script>
Ink.requireModules( ['Ink.UI.Tooltip_1'], function( Tooltip ){
    var Tooltip = new Tooltip( '#rating_options .tip');
});
</script>
<?php }} ?>