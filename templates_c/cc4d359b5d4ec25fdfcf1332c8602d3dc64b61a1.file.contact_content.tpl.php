<?php /* Smarty version Smarty-3.1.14, created on 2015-01-28 22:43:15
         compiled from "./templates/contact_content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:164313168254c25add0a3987-48567149%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc4d359b5d4ec25fdfcf1332c8602d3dc64b61a1' => 
    array (
      0 => './templates/contact_content.tpl',
      1 => 1422481378,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '164313168254c25add0a3987-48567149',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54c25add2902d2_67762634',
  'variables' => 
  array (
    'site_link' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54c25add2902d2_67762634')) {function content_54c25add2902d2_67762634($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['site_link'] = new Smarty_variable('http://worldofalcohols.com', null, 0);?>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/js/contact.js"></script>

<header class="top-margin-5 hide-all show-large show-xlarge">     
<nav class="ink-navigation">
	<ul class="breadcrumbs red flat rounded shadowed">
	<li><a href="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/index.php">World</a></li>
	<li class="active"><a href="#"><b>Contact</b></a></li>
	</ul>
	</nav>
</header>
<header class="top-margin-gap hide-all show-medium show-small show-tiny">     
<nav class="ink-navigation">
	<ul class="breadcrumbs red flat rounded shadowed">
	<li><a href="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/index.php">World</a></li>
	<li class="active"><a href="#"><b>Contact</b></a></li>
	</ul>
	</nav>
</header>

<h5> Please fill the following form to contact us! </h5>
<form id="contactForm" action="valid_contact.php" method="post" class="ink-form">	
	<div class="control-group all-50 small-100 required">
		<div class="column-group quarter-gutters">
			<label for="inline-name" class="all-35 align-right">Name</label>
			<div class="control all-65">
				<input type="text" name="name" id="inline-name">
			</div>
		</div>
	</div>	
	<div class="control-group all-50 small-100 required">
		<div class="column-group quarter-gutters">
			<label for="inline-mail" class="all-35 align-right">Email</label>
			<div class="control all-65">
				<input type="text" name="mail" id="inline-mail">
			</div>
		</div>
	</div>		
	<div class="control-group all-50 small-100 required">
		<div class="column-group quarter-gutters">
			<label for="inline-subject" class="all-35 align-right">Subject</label>
			<div class="control all-65">
				<input type="text" name="subject" id="inline-subject">
			</div>
		</div>
	</div>
	<div class="control-group all-50 small-100 required">
		<div class="column-group quarter-gutters">
			<label for="inline-message" class="all-35 align-right">Message</label>
			<div class="control all-65">
				<textarea name="message" id="inline-message" rows="7" cols="50"></textarea>
			</div>
		</div>
	</div>	
	<div class="control-group all-50 small-100 required">
		<div class="column-group quarter-gutters">
			<label for="inline-code" class="all-45 align-right">Captcha code <img title="Captcha" src="captcha.php" alt="Captcha" class="quarter-top-space"/></label>
			<div class="control all-55">
				<input type="text" name="code" id="inline-code">
				<p class="align-right tip">Please copy the Captcha code !</p>
			</div>
		</div>
	</div> 
	<div class="control-group all-50 small-100">
		<div class="column-group quarter-gutters">
			<div class="control all-50">
				<input type="submit" class="ink-button blue" id="contactButton" value="Send" />
			</div>
			<div class="control all-50">
				<img id="loading" src="img/loading_s.gif" alt="working.." />
			</div>
		</div>
	</div>
</form>

<div id="error" class="ink-alert basic error"></div><?php }} ?>