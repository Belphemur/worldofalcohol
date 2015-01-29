{assign var='site_link' value='http://worldOfalcohols.com'}<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>{$meta['title']}</title>
        <meta name="description" content="{$meta['description']}">
		<meta name="keywords" content="{$meta['keywords']}">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel="shortcut icon" href="img/favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/new/ink-flex.min.css">
        <link rel="stylesheet" type="text/css" href="css/new/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/docs.css">
        {if isset($meta_property_og)}
		{foreach $meta_property_og as $row} 
		<meta property="og:{$row@key}" content="{$row}"/>
		{/foreach}
		{/if}
        <!--[if lt IE 9 ]>
            <link rel="stylesheet" href="../css/new/ink-ie.min.css" type="text/css" media="screen" title="no title" charset="utf-8">
        <![endif]-->
		<style type="text/css">
            body {
                background: #ededed;
            }
            header {
                padding: 2em 0;
                margin-bottom: 2em;
                border-bottom: 1px solid #cecece;
                overflow: hidden;
            }
            header h1 {
                font-size: 2em;
            }
            header h1 small:before  {
                content: "|";
                margin: 0 0.5em;
                font-size: 1.6em;
            }
            footer {
                background: #ccc;
                color: #000;
            }
            footer a {
                color: #000;
            }
            footer p {        
                padding: 0.5em 1em 0.5em 0;
                margin: 0;        
            }
            .bottom-border {
                border-bottom: 1px solid #cecece;
            }
			.panel {
                padding: 0.5em;
            }
			.center_pg {
				margin-left:45%;
			}
        </style>
		<script type="text/javascript" src="js/new/holder.js"></script>
		<script type="text/javascript" src="js/new/ink-all.min.js"></script>
        <script type="text/javascript" src="js/new/autoload.js"></script>
        <script type="text/javascript" src="js/new/html5shiv.js"></script>
		<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="js/new/modernizr.js"></script>
        <script type="text/javascript">
            Modernizr.load({
              test: Modernizr.flexbox,
              nope : 'css/new/ink-legacy.min.css'
            });
        </script>
    </head>
    <body class="ink-drawer">
		<div id="topbar">
			{include 'header.tpl'} {* before param passed:  'alc_types=$alc_types cat_infos=$cat_infos' *}
		</div>
		{* Right drawer for mobiles and small screens *}
		<div class="right-drawer">
			<nav class="ink-navigation top-margin-4">
				<ul class="menu vertical rounded black shadowed"> 
					<li><a href="{$site_link}">HOME</a></li>
					{* TODO top menu disabled
					{foreach from=$alc_types item=alc_type}
						{if $alc_type.type|@lower == $cat_infos.type|lower}
							<li class="active"><a href="{$alc_type.type|formatName}">{$alc_type.type|@upper}</a></li>
						{else}
							<li><a href="{$alc_type.type|formatName}">{$alc_type.type|@upper}</a></li>
						{/if}
					{/foreach}
					*}
				</ul>
			</nav>
		</div>
        <div id="main-content" class="content-drawer ink-grid">
<!--Content-->




{assign var='site_link' value='http://worldofalcohols.com'}
<div class="top-margin-5 hide-all show-large show-xlarge"></div>
<div class="top-margin-gap hide-all show-medium show-small show-tiny"></div>
<h1 class="top-margin-4 top-space align-center">Welcome to the world of Alcohols ! </h1>
<div class="carousel">
<div id="promo-carousel" class="ink-carousel align-center" data-pagination="#promo-carousel-pagination">
    <ul class="stage column-group">
		<li class="slide all-100 small-100 tiny-100">
            <div class="description">
                <h3>Welcome in a new world !</h3>
            </div>
			<img class="quarter-bottom-space" src="img/slides/slide_0.jpg">
		</li>
		<li class="slide all-100 small-100 tiny-100">
            <div class="description">
                <h3>Travelling is discovering. Discovering food, landscapes, people</h3>
            </div>
			<img class="quarter-bottom-space" src="img/slides/slide_4.jpg">
			<div class="description">
                <h3>but also alcohols...</h3>
            </div>
		</li>
		<li class="slide all-100 small-100 tiny-100">
            <div class="description">
                 <h3>Everywhere in the world, every day, people are creating, </h3>
            </div>
			<img class="quarter-bottom-space" src="img/slides/slide_3.jpg">
			<div class="description">
                 <h3>working with passion to produce joy and happiness.</h3>
            </div>
		</li>
		<li class="slide all-100 small-100 tiny-100">
            <div class="description">
                 <h3>Sick of always drinking the same booze? Want to try something different?</h3>
            </div>
			<img class="quarter-bottom-space" src="img/slides/slide_2.jpg">
			 <div class="description">
                 <h3>Want to impress your friends or your beloved ones with something new.</h3>
            </div>
		</li>
		<li class="slide all-100 small-100 tiny-100">
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
<nav id="promo-carousel-pagination" class="ink-navigation center_pg">
    <ul class="pagination dotted">
    </ul>
</nav>
</div>
<br>
<div class="align-center"><a href="index.php" class="ink-button large green">Enter to the <b>World of Alcohols</b></a></div><br>

<br> 
{literal}
<script>
    // Not required if you're using autoload.js
    Ink.requireModules(['Ink.UI.Carousel_1'], function (Carousel) {
        new Carousel('#promo-carousel', { autoAdvance: 5000, pagination: '#promo-carousel-pagination', nextLabel: '', previousLabel: ''} );
    });
</script>
{/literal}
<!--Content-->


        </div>
        <footer class="clearfix">
			{include file="footer.tpl"}
        </footer>
	        <script type="text/javascript">
			$(function() {	
			$('img').bind("mouseenter", (function(e){
				$(this).closest('figure').children('.more-info').toggleClass('onHover');
				$(this).closest('figure').children('.more-info-m').toggleClass('onHover');
				$(this).closest('figure').children('img').toggleClass('scale_1_img');
			}));
			$('img').bind("mouseleave", (function(e){
				$(this).closest('figure').children('.more-info').toggleClass('onHover');
				$(this).closest('figure').children('.more-info-m').toggleClass('onHover');
				$(this).closest('figure').children('img').toggleClass('scale_1_img');
			}));

		});
		</script>
		<script>
			Ink.requireModules(['Ink.UI.Drawer_1'], function (Drawer) {
				new Drawer();
			});
		</script>
		{* TODO Facebook plugin/comments disabled<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>*}
	</body>
</html>