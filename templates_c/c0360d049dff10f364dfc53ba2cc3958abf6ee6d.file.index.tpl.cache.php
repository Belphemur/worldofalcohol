<?php /* Smarty version Smarty-3.1.14, created on 2015-01-29 00:12:58
         compiled from "./templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:98325719754c7f5dadd5768-92691829%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0360d049dff10f364dfc53ba2cc3958abf6ee6d' => 
    array (
      0 => './templates/index.tpl',
      1 => 1422466954,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '98325719754c7f5dadd5768-92691829',
  'function' => 
  array (
  ),
  'cache_lifetime' => 3600,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54c7f5dae308d4_76997834',
  'variables' => 
  array (
    'meta' => 0,
    'meta_property_og' => 0,
    'row' => 0,
    'site_link' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54c7f5dae308d4_76997834')) {function content_54c7f5dae308d4_76997834($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['site_link'] = new Smarty_variable('http://worldOfalcohols.com', null, 0);?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $_smarty_tpl->tpl_vars['meta']->value['title'];?>
</title>
        <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['meta']->value['description'];?>
">
		<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['meta']->value['keywords'];?>
">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel="shortcut icon" href="img/favicon.ico">
        
		<link rel="stylesheet" type="text/css" href="css/ink-flex.min.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/docs.css">
        <?php if (isset($_smarty_tpl->tpl_vars['meta_property_og']->value)){?>
		<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['meta_property_og']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?> 
		<meta property="og:<?php echo $_smarty_tpl->tpl_vars['row']->key;?>
" content="<?php echo $_smarty_tpl->tpl_vars['row']->value;?>
"/>
		<?php } ?>
		<?php }?>
		
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
			<?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>
 
		</div>
		
		<div class="right-drawer">
			<nav class="ink-navigation top-margin-4">
				<ul class="menu vertical rounded black shadowed"> 
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/index.php">HOME</a></li>
					
				</ul>
			</nav>
		</div>
        <div id="main-content" class="content-drawer ink-grid">
            <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['content_file']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

        </div>
        <footer class="clearfix">
			<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

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
		
	</body>
</html><?php }} ?>