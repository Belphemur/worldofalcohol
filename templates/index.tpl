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
        {*TODO configure apple touch icons<link rel="apple-touch-icon-precomposed" href="img/touch-icon.57.png
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/touch-icon.72.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/touch-icon.114.png">
        <link rel="apple-touch-startup-image" href="img/splash.320x460.png"
        media="screen and (min-device-width: 200px) and (max-device-width: 320px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="img/splash.768x1004.png"
        media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="img/splash.1024x748.png"
        media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">*}
		<link rel="stylesheet" type="text/css" href="css/ink-flex.min.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/docs.css">
        {if isset($meta_property_og)}
		{foreach $meta_property_og as $row} 
		<meta property="og:{$row@key}" content="{$row}"/>
		{/foreach}
		{/if}
		{*<meta property="fb:admins" content="FB_PAGE_ID_FOR_FB_COMMENTS"/> *}
        <!--[if lt IE 9 ]>
            <link rel="stylesheet" href="../css/ink-ie.min.css" type="text/css" media="screen" title="no title" charset="utf-8">
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
        </style>
		<script type="text/javascript" src="js/holder.js"></script>
		<script type="text/javascript" src="js/ink-all.min.js"></script>
        <script type="text/javascript" src="js/autoload.js"></script>
        <script type="text/javascript" src="js/html5shiv.js"></script>
		<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="js/modernizr.js"></script>
        <script type="text/javascript">
            Modernizr.load({
              test: Modernizr.flexbox,
              nope : 'css/ink-legacy.min.css'
            });
        </script>
    </head>
    <body class="ink-drawer">
		<div id="topbar">
			{include 'header.tpl'} {* this is commented out. before param passed were:  'alc_types=$alc_types *}
		</div>
		{* Right drawer for mobiles and small screens *}
		<div class="right-drawer">
			<nav class="ink-navigation top-margin-4">
				<ul class="menu vertical rounded black shadowed"> 
					<li><a href="{$site_link}/index.php">HOME</a></li>
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
            {include file="$content_file"}
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