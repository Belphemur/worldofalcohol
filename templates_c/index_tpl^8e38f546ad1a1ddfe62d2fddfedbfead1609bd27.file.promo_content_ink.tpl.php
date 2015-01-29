<?php /* Smarty version Smarty-3.1.14, created on 2015-01-26 22:02:08
         compiled from "./templates/promo_content_ink.tpl" */ ?>
<?php /*%%SmartyHeaderCode:88339543854c6a2601f2476-32242755%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e38f546ad1a1ddfe62d2fddfedbfead1609bd27' => 
    array (
      0 => './templates/promo_content_ink.tpl',
      1 => 1422306112,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '88339543854c6a2601f2476-32242755',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54c6a26020ad98_01217762',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54c6a26020ad98_01217762')) {function content_54c6a26020ad98_01217762($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['site_link'] = new Smarty_variable('http://worldofalcohols.com', null, 0);?>
<div class="top-margin-5 hide-all show-large show-xlarge"></div>
<div class="top-margin-gap hide-all show-medium show-small show-tiny"></div>


<h1 class="top-margin-4 half-top-space align-center">Welcome to the world of Alcohols ! </h1>



<div class="carousel">
<div id="promo-carousel" class="ink-carousel align-center" data-pagination="#promo-carousel-pagination">
    <ul class="stage column-group">
		<li class="slide all-100 small-50 tiny-100">
            <div class="description">
                <h3>Welcome in a new world !</h3>
            </div>
			<img class="quarter-bottom-space" src="img/slides/slide_0.jpg">
		</li>
		<li class="slide all-100 small-50 tiny-100">
            <div class="description">
                <h3>Travelling is discovering. Discovering food, landscapes, people</h3>
            </div>
			<img class="quarter-bottom-space" src="img/slides/slide_4.jpg">
			<div class="description">
                <h3>but also alcohols...</h3>
            </div>
		</li>
		<li class="slide all-100 small-50 tiny-100">
            <div class="description">
                 <h3>Everywhere in the world, every day, people are creating, </h3>
            </div>
			<img class="quarter-bottom-space" src="img/slides/slide_3.jpg">
			<div class="description">
                 <h3>working with passion to produce joy and happiness.</h3>
            </div>
		</li>
		<li class="slide all-100 small-50 tiny-100">
            <div class="description">
                 <h3>Sick of always drinking the same booze? Want to try something different?</h3>
            </div>
			<img class="quarter-bottom-space" src="img/slides/slide_2.jpg">
			 <div class="description">
                 <h3>Want to impress your friends or your beloved ones with something new.</h3>
            </div>
		</li>
		<li class="slide all-100 small-50 tiny-100">
            <div class="description">
                 <h3>Get in to discover new alcohol from all around the world.</h3>
            </div>
			<img class="quarter-bottom-space" src="img/slides/slide_1.jpg">
			<div class="description">
                 <h3>and don't hesitate to share your own experience.</h3>
            </div>
		</li>
	</ul>
</div>
			
<nav id="promo-carousel-pagination" class="ink-navigation">
    <ul class="pagination dotted">
    </ul>
</nav>

</div>

<script>
    // Not required if you're using autoload.js
    Ink.requireModules(['Ink.UI.Carousel_1'], function (Carousel) {
        new Carousel('#promo-carousel', { autoAdvance: 5000, pagination: '#promo-carousel-pagination', nextLabel: '', previousLabel: ''} );
    });
</script>
<?php }} ?>