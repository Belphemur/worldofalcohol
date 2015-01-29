<?php /* Smarty version Smarty-3.1.14, created on 2015-01-28 20:14:56
         compiled from "./templates/submit_content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:36934604654c258b7c10d48-06835050%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9fa2156846211ea5ae1401a1f44ad3cd97d45f46' => 
    array (
      0 => './templates/submit_content.tpl',
      1 => 1422466839,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '36934604654c258b7c10d48-06835050',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54c258b7cba167_43215882',
  'variables' => 
  array (
    'site_link' => 0,
    'countries' => 0,
    'country' => 0,
    'current_country_code' => 0,
    'types' => 0,
    'type' => 0,
    'current_type' => 0,
    'sub_types' => 0,
    'sub_type' => 0,
    'current_sub_type' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54c258b7cba167_43215882')) {function content_54c258b7cba167_43215882($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['site_link'] = new Smarty_variable('http://worldofalcohols.com', null, 0);?>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/js/contact.js"></script>

<header class="top-margin-5 hide-all show-large show-xlarge">     
<nav class="ink-navigation">
	<ul class="breadcrumbs red flat rounded shadowed">
	<li><a href="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/index.php">World</a></li>
	<li class="active"><a href="#"><b>Submit alcohol</b></a></li>
	</ul>
	</nav>
</header>
<header class="top-margin-gap hide-all show-medium show-small show-tiny">     
<nav class="ink-navigation">
	<ul class="breadcrumbs red flat rounded shadowed">
	<li><a href="<?php echo $_smarty_tpl->tpl_vars['site_link']->value;?>
/index.php">World</a></li>
	<li class="active"><a href="#"><b>Submit alcohol</b></a></li>
	</ul>
	</nav>
</header>
<script type="text/javascript">
/*$('#i_submit').click( function() {
    //check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob)
    {
        //get the file size and file type from file input field
        var fsize = $('#i_file')[0].files[0].size;
        var ftype = $('#i_file')[0].files[0].type;
        var fname = $('#i_file')[0].files[0].name;
        
        if(fsize>1048576) //do something if file size more than 1 mb (1048576)
        {
            alert("Type :"+ ftype +" | "+ fsize +" bites\n(File: "+fname+") Too big!");
        }else{
            alert("Type :"+ ftype +" | "+ fsize +" bites\n(File :"+fname+") You are good to go!");
        }
    }else{
        alert("Please upgrade your browser, because your current browser lacks some new features we need!");
    }
});

$('#i_submit').click( function() {
    //check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob)
    {
        //get the file size and file type from file input field
        var fsize = $('#i_file')[0].files[0].size;
        var ftype = $('#i_file')[0].files[0].type;
        var fname = $('#i_file')[0].files[0].name;
        
       switch(ftype)
        {
            case 'image/png':
            case 'image/gif':
            case 'image/jpeg':
            case 'image/pjpeg':
                alert("Acceptable image file!");
                break;
            default:
                alert('Unsupported File!');
        }

    }else{
        alert("Please upgrade your browser, because your current browser lacks some new features we need!");
    }
});*/

function readURL(input) {
	//check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob)
    {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			var fsize = input.files[0].size;
			var ftype = input.files[0].type;
			var fname = input.files[0].name;
			
			reader.onload = function (e) {
				$('#img_preview').css("max-height", "200px");
				
				if(fsize>1048576) {
					$('#img_preview').attr('src', '');
					$('#preview_error').append('<p class="ink-alert basic error">Image too big (> 1MB) choose smaller image !!</p>');
				} else{
					$('#img_preview').attr('src', e.target.result);
				}
				
				switch(ftype)
				{
					case 'image/png':
					case 'image/gif':
					case 'image/jpeg':
					case 'image/pjpeg':
						$('#file_format').val("ok");
						break;
					default:
						$('#preview_error').append('<p class="ink-alert basic error">Unsupported file format. Please choose a jpg, png or gif image</p>');
						$('#file_format').val("error");
				}
			}
			
			reader.readAsDataURL(input.files[0]);
			
		}
	}else{
		$('#preview_div').html('<p class="ink-alert basic error">Preview not supported with your borwser !</p>');
    }
}
$( document ).ready(function() {

$("#inline-image").change(function(){
	readURL(this);
	$('#preview_error').html('');
});

$("#inline-alcohol_sub_type").change(function(){
	var selected_val = $(this).find(':selected').val();
	if(selected_val!=""){
		$("#inline-other_sub_type").val("");
	}
});

$("#inline-other_sub_type").change(function(){
	$("#inline-alcohol_sub_type").val("");
});


});	
</script>
<h5 id="submit_heading"> Share with us a local alcohol you have discovered in your region ! </h5>
<form id="submitForm" action="valid_submit.php" method="post" class="ink-form" enctype="multipart/form-data">	
	<fieldset>
    <legend>Your Info:</legend>
	<div class="column-group quarter-gutters">
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-name" class="all-35 align-right">Name</label>
				<div class="control all-65">
					<input type="text" name="name" id="inline-name">
				</div>
			</div>
		</div>
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-email" class="all-35 align-right">Email</label>
				<div class="control all-65">
					<input type="text" name="email" id="inline-email">
				</div>
			</div>
		</div>
	</div>
	</fieldset>
	<fieldset>
    <legend>Alcohol Info:</legend>
	<div class="column-group quarter-gutters">
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-country" class="all-35 align-right required">Country</label>
				<div class="control all-65">
					<select id="inline-country" name="country">
						<option value="">Choose one:</option> 
						<?php  $_smarty_tpl->tpl_vars['country'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['country']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['countries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['country']->key => $_smarty_tpl->tpl_vars['country']->value){
$_smarty_tpl->tpl_vars['country']->_loop = true;
?>
							<?php if (mb_strtolower($_smarty_tpl->tpl_vars['country']->value['country_code'], 'UTF-8')==$_smarty_tpl->tpl_vars['current_country_code']->value){?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['country']->value['country_code'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['country']->value['country'];?>
</option>
							<?php }else{ ?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['country']->value['country_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['country']->value['country'];?>
</option>
							<?php }?>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-city" class="all-35 align-right">City</label>
				<div class="control all-65">
					<input type="text" name="city" id="inline-city">
				</div>
			</div>
		</div>
	</div>
	<div class="column-group quarter-gutters">
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-alcohol_name" class="all-35 align-right">Alcohol Name</label>
				<div class="control all-65">
					<input type="text" name="alcohol_name" id="inline-alcohol_name">
				</div>
			</div>
		</div>		
		
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-alcohol_type" class="all-35 align-right required">Alcohol Type</label>
				<div class="control all-65">
					<select id="inline-alcohol_type" name="alcohol_type">
						<option value="">Choose one:</option> 
						<?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value){
$_smarty_tpl->tpl_vars['type']->_loop = true;
?>
							<?php if (mb_strtolower($_smarty_tpl->tpl_vars['type']->value['type_code'], 'UTF-8')==$_smarty_tpl->tpl_vars['current_type']->value){?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['type']->value['type_code'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['type']->value['type'];?>
</option>
							<?php }else{ ?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['type']->value['type_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['type']->value['type'];?>
</option>
							<?php }?>
						<?php } ?>
					</select>
					<p class="align-right tip">(Beer, Rum, Whisky, ..)</p>				
				</div>
			</div>
		</div>	
	</div>
	
	<div class="column-group quarter-gutters">
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-company" class="all-35 align-right">Company</label>
				<div class="control all-65">
					<input type="text" name="company" id="inline-company">
				</div>
			</div>
		</div>
	
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-alcohol_sub_type" class="all-45 align-right required">Alcohol Sub Type</label>
				<div class="control all-55">
					<select id="inline-alcohol_sub_type" name="alcohol_sub_type">
						<option value="">Choose one:</option> 
						<?php  $_smarty_tpl->tpl_vars['sub_type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sub_type']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sub_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sub_type']->key => $_smarty_tpl->tpl_vars['sub_type']->value){
$_smarty_tpl->tpl_vars['sub_type']->_loop = true;
?>
							<?php if (mb_strtolower($_smarty_tpl->tpl_vars['sub_type']->value['sub_type_code'], 'UTF-8')==$_smarty_tpl->tpl_vars['current_sub_type']->value){?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['sub_type']->value['sub_type_code'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['sub_type']->value['sub_type'];?>
</option>
							<?php }else{ ?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['sub_type']->value['sub_type_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['sub_type']->value['sub_type'];?>
</option>
							<?php }?>
						<?php } ?>
					</select>
					Other : <input type="text" name="other_sub_type" id="inline-other_sub_type">
					<p class="align-right tip">(Pale Lager, brown rum, ...)</p>				
				</div>
			</div>
		</div>
	</div>
	
	<div class="column-group quarter-gutters">
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-alcohol_degree" class="all-60 align-right">Alcohol Percentage (ABV)</label>
				<div class="control all-40">
					<input type="text" name="alcohol_degree" id="inline-alcohol_degree">
				</div>
			</div>
		</div>
		<div class="control-group all-33 small-100">
			<div class="column-group quarter-gutters">
				<label for="inline-year" class="all-35 align-right">Year</label>
				<div class="control all-65">
					<input type="text" name="year" id="inline-year">
				</div>
			</div>
		</div>
	</div>
	
	<div class="control-group all-33 small-100 required">
		<div class="column-group quarter-gutters">
			<label for="inline-image" class="all-35 align-right">Image</label>
			<div class="control all-65">
				<input type="file" name="image" id="inline-image">
				<input type="hidden" name="file_format" id="file_format" value="ok"/>
				<div id="preview_div"><img id="img_preview" width="200" src="#" alt="" /><div id="preview_error"></div></div>
			</div>
		</div>
	</div>
	
	<div class="control-group all-33 small-100 required">
		<div class="column-group quarter-gutters">
			<label for="inline-code" class="all-45 align-right">Captcha code <img title="Captcha" src="captcha.php" alt="Captcha" class="quarter-top-space"/></label>
			<div class="control all-55">
				<input type="text" name="code" id="inline-code">
				<p class="align-right tip">Please copy the Captcha code !</p>
			</div>
		</div>
	</div>
	
	<div class="control-group all-33 small-100">
		<div class="column-group quarter-gutters">
			<div class="control all-50">
				<input type="submit" class="ink-button blue" id="contactButton" value="Send" />
			</div>
			<div class="control all-50">
				<img id="loading" src="img/loading_s.gif" alt="working.." />
			</div>
		</div>
	</div>
	<div id="error" class="ink-alert basic error"></div>	
	</fieldset>
</form>

<?php }} ?>