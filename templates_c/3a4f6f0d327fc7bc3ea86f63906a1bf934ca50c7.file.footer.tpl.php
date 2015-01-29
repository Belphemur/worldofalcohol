<?php /* Smarty version Smarty-3.1.14, created on 2015-01-28 23:46:07
         compiled from "./templates/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:45439839554c258b7ccc2e6-86200885%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a4f6f0d327fc7bc3ea86f63906a1bf934ca50c7' => 
    array (
      0 => './templates/footer.tpl',
      1 => 1422484477,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45439839554c258b7ccc2e6-86200885',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54c258b7cdb914_81283709',
  'variables' => 
  array (
    'site_link' => 0,
    'site_link_anchor' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54c258b7cdb914_81283709')) {function content_54c258b7cdb914_81283709($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['site_name'] = new Smarty_variable('World Of Alcohols', null, 0);?>
<?php $_smarty_tpl->tpl_vars['site_name_bold'] = new Smarty_variable('World Of Alcohols.com', null, 0);?>
<?php $_smarty_tpl->tpl_vars['site_link'] = new Smarty_variable('http://worldOfalcohols.com', null, 0);?>
<?php $_smarty_tpl->tpl_vars['site_link_anchor'] = new Smarty_variable('World Of Alcohols.com', null, 0);?>
        <div class="ink-grid">
            <nav class="ink-navigation push-left small-100 small-push-left">
                <ul class="menu horizontal">
                    <li class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
">Home</a></li>
					<li><a href="/contact.php">Contact</a></li>
					
					
                </ul>
            </nav>
			<div class="align-center"><p class="push-left fw-700">Drink Responsibly</p></div>
            <p class="push-right small-100">Copyright © 2015 <?php echo $_smarty_tpl->tpl_vars['site_link_anchor']->value;?>
<br>
			<span class="push-right small small-100">All images on this site are copyrighted or <br> trademarked by their respective owners or authors.</span>
			</p>
        </div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58993513-1', 'auto');
  ga('send', 'pageview');

</script>

<?php }} ?>