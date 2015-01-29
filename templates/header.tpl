{assign var='site_name' value='World Of Alcohols'}
{assign var='site_name_bold' value='World Of Alcohols.com'}
{assign var='site_link' value='http://worldofalcohols.com'}
{assign var='site_link_anchor' value='World Of Alcohols.com'}
	
			<nav class="ink-navigation ink-grid ie7">
				<ul class="menu horizontal flat black shadowed">
					<li class="top_logo"><a class="logoPlaceholder" href="{$site_link}/index.php" title="{$site_name}"><img src="img/logo_m.png" alt="{$site_name_bold}"/></a></li>
					<li class="hide-all show-tiny show-small push-right"><button class="fa fa-bars right-drawer-trigger"></button></li>				
					<li class="hide-small hide-tiny push-right">
						<span class='st_pinterest_large' displayText='Pinterest'></span>
						<span class='st_twitter_large' displayText='Tweet'></span>
						<span class='st_facebook_large' displayText='Facebook'></span>
						<span class='st_googleplus_large' displayText='Google +'></span>
						<span class='st_reddit_large' displayText='Reddit'></span>
					</li>
				</ul>
				<ul class="menu horizontal rounded black shadowed hide-small hide-tiny" id="topbar_menu">   
					<li><a href="{$site_link}/index.php">HOME</a></li>
					{* TODO TOP menu disabled
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
			{literal}
			<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
			<script type="text/javascript">stLight.options({publisher: "a44e7371-9fb1-42ec-a79e-12dc34f6bb36", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
			{/literal}
			<div class="border"></div>