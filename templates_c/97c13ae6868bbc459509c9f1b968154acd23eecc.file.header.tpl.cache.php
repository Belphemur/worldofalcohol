<?php /* Smarty version Smarty-3.1.14, created on 2015-01-28 21:37:32
         compiled from "./templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:69000227054c7f5dae37b08-19842357%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97c13ae6868bbc459509c9f1b968154acd23eecc' => 
    array (
      0 => './templates/header.tpl',
      1 => 1422477437,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69000227054c7f5dae37b08-19842357',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54c7f5dae58346_48097769',
  'variables' => 
  array (
    'site_link' => 0,
    'site_name' => 0,
    'site_name_bold' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54c7f5dae58346_48097769')) {function content_54c7f5dae58346_48097769($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['site_name'] = new Smarty_variable('World Of Alcohols', null, 0);?>
<?php $_smarty_tpl->tpl_vars['site_name_bold'] = new Smarty_variable('World Of Alcohols.com', null, 0);?>
<?php $_smarty_tpl->tpl_vars['site_link'] = new Smarty_variable('http://worldofalcohols.com', null, 0);?>
<?php $_smarty_tpl->tpl_vars['site_link_anchor'] = new Smarty_variable('World Of Alcohols.com', null, 0);?>
	
			<nav class="ink-navigation ink-grid ie7">
				<ul class="menu horizontal flat black shadowed">
					<li class="top_logo"><a class="logoPlaceholder" href="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/index.php" title="<?php echo $_smarty_tpl->tpl_vars['site_name']->value;?>
"><img src="img/logo_m.png" alt="<?php echo $_smarty_tpl->tpl_vars['site_name_bold']->value;?>
"/></a></li>
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
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/index.php">HOME</a></li>
					
				</ul>
			</nav>
			
			<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
			<script type="text/javascript">stLight.options({publisher: "a44e7371-9fb1-42ec-a79e-12dc34f6bb36", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
			
			<div class="border"></div><?php }} ?>