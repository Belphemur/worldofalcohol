<?php /* Smarty version Smarty-3.1.14, created on 2014-12-28 18:32:08
         compiled from "crud_generator_content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:147455414054a03e98146807-33795893%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b4eb88fdeeab1e6d7d779decf6f41a1cfb465d6' => 
    array (
      0 => 'crud_generator_content.tpl',
      1 => 1418174332,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '147455414054a03e98146807-33795893',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'master_table_name' => 0,
    'error' => 0,
    'col_names' => 0,
    'col_infos' => 0,
    'col_itm' => 0,
    'col' => 0,
    '($_smarty_tpl->tpl_vars[\'col\']->value[\'name\']).\'_Key' => 0,
    '($_smarty_tpl->tpl_vars[\'col\']->value[\'name\']).\'_Int' => 0,
    '($_smarty_tpl->tpl_vars[\'col\']->value[\'name\']).\'_Varchar' => 0,
    '($_smarty_tpl->tpl_vars[\'col\']->value[\'name\']).\'_Textarea' => 0,
    '($_smarty_tpl->tpl_vars[\'col\']->value[\'name\']).\'_Date' => 0,
    '($_smarty_tpl->tpl_vars[\'col\']->value[\'name\']).\'_Create' => 0,
    '($_smarty_tpl->tpl_vars[\'col\']->value[\'name\']).\'_Edit' => 0,
    '($_smarty_tpl->tpl_vars[\'col\']->value[\'name\']).\'_List' => 0,
    'child_tables' => 0,
    'child_tables_ser' => 0,
    'child_tables_col_names' => 0,
    'child_table' => 0,
    'child_tables_col_infos' => 0,
    '($_smarty_tpl->tpl_vars[\'child_table\']->value).\'_\'.($_smarty_tpl->tpl_vars[\'col\']->value[\'name\']).\'_Key' => 0,
    '($_smarty_tpl->tpl_vars[\'child_table\']->value).\'_\'.($_smarty_tpl->tpl_vars[\'col\']->value[\'name\']).\'_Int' => 0,
    '($_smarty_tpl->tpl_vars[\'child_table\']->value).\'_\'.($_smarty_tpl->tpl_vars[\'col\']->value[\'name\']).\'_Varchar' => 0,
    '($_smarty_tpl->tpl_vars[\'child_table\']->value).\'_\'.($_smarty_tpl->tpl_vars[\'col\']->value[\'name\']).\'_Textarea' => 0,
    '($_smarty_tpl->tpl_vars[\'child_table\']->value).\'_\'.($_smarty_tpl->tpl_vars[\'col\']->value[\'name\']).\'_Date' => 0,
    '($_smarty_tpl->tpl_vars[\'child_table\']->value).\'_\'.($_smarty_tpl->tpl_vars[\'col\']->value[\'name\']).\'_Create' => 0,
    '($_smarty_tpl->tpl_vars[\'child_table\']->value).\'_\'.($_smarty_tpl->tpl_vars[\'col\']->value[\'name\']).\'_Edit' => 0,
    '($_smarty_tpl->tpl_vars[\'child_table\']->value).\'_\'.($_smarty_tpl->tpl_vars[\'col\']->value[\'name\']).\'_List' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54a03e98449e21_93416196',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a03e98449e21_93416196')) {function content_54a03e98449e21_93416196($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
            Responsive Tables
        </title>
        <meta name="description" content="">
        <meta name="author" content="ink, cookbook, recipes">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel="stylesheet" type="text/css" href="css/ink.css">
        <link rel="stylesheet" type="text/css" href="css/quick-start.css">
        
        <!--[if IE 7 ]>
            <link rel="stylesheet" href="css/ink-ie7.css" type="text/css" media="screen" title="no title" charset="utf-8">
        <![endif]-->
        
        <script type="text/javascript" src="js/holder.js"></script>
        <script type="text/javascript" src="js/ink.min.js"></script>
        <script type="text/javascript" src="js/ink-ui.min.js"></script>
        <script type="text/javascript" src="js/autoload.js"></script>
        <script type="text/javascript" src="js/html5shiv.js"></script>

        <style>
			body {
                background: #ededed;
            }
			header {
                padding: 2em 0;
                margin-bottom: 2em;
            }
            header h1 {
                font-size: 2em;
            }
            header h1 small:before  {
                content: "|";
                margin: 0 0.5em;
                font-size: 1.6em;
            }
            .screen-size-helper {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                width: 100%;
                line-height: 1.6em;
                font-size: 1em;
                padding: 0.5333333333333333em 0.8em;
                background: rgba(0, 0, 0, 0.7);
                z-index: 100;
            }
            .screen-size-helper .title,
            .screen-size-helper ul {
                color: white;
                text-shadow: 0 1px 0 #000000;
            }
            .screen-size-helper .title {
                font-size: inherit;
                line-height: inherit;
                float: left;
                text-transform: uppercase;
                font-weight: 500;
            }
            .screen-size-helper ul {
                float: right;
                margin: 0;
                padding: 0;
                line-height: inherit !important;
            }
            .screen-size-helper ul li {
                padding: 0;
                margin: 0;
                text-transform: uppercase;
                font-weight: bold;
                font-size: inherit !important;
            }
            .screen-size-helper ul li.small {
                color: #80c431;
            }
            .screen-size-helper ul li.medium {
                color: #80c431;
            }
            .screen-size-helper ul li.large {
                color: #80c431;
            }
            .screen-size-helper ul li.extra-large {
                color: #80c431;
            }
        </style>
		<script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		
		<!-- Import CSS file for validation engine (in Head section of HTML) -->
		<link href="scripts/validationEngine/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
		
		<!-- Import Javascript files for validation engine (in Head section of HTML) -->
		<script type="text/javascript" src="scripts/validationEngine/jquery.validationEngine-en.js"></script>
		<script type="text/javascript" src="scripts/validationEngine/jquery.validationEngine.js"></script>
		
		<script language="javascript" type="text/javascript">
				$(document).ready(function(){
				   // binds form submission and fields to the validation engine
				   $('#formID').validationEngine(); 
			   }); 
			   function show_field(field_id)
			   {
					$('#' + field_id + '').toggle();
			   }			   			   function extra_image_field()			   {					var val = parseInt($('#append_link').attr('rel'))+1;					$('#append_link').attr('rel', val);					$('#extra_image_folder').append('<br><br><b>Other image Folder (' + val + ')</b>: <input type="text" id="extra_img_folder_' + val + '" name="extra_img_folder_' + val + '" class="" value="" size="20"/> | Size: Width <input type="text" id="extra_img_folder_' + val + '_width" name="extra_img_folder_' + val + '_width" class="" value="" size="3"/>| Height <input type="text" id="extra_img_folder_' + val + '_height" name="extra_img_folder_' + val + '_height" class="" value="" size="3"/>');			   }
		</script>
    </head>

    <body>        
        <div class="ink-grid">
        <header>
            <h1><a href="index.php">Crud Generator</a><small>Master Table "<?php echo $_smarty_tpl->tpl_vars['master_table_name']->value;?>
"</small></h1>
		</header>
		<?php if ($_smarty_tpl->tpl_vars['error']->value!=''){?>
			<div class="ink-alert basic error"><p> <?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</p></div>
		<?php }?>
		<h5><a href="create_options_file.php">Click here to create OPTIONS File</a></h5>
		<form action="create_crud_files.php" method="POST" id="formID" class="ink-form column-group gutters">
				<input type='hidden' name='col_names' value="<?php echo $_smarty_tpl->tpl_vars['col_names']->value;?>
" />
				<input type='hidden' name='master_table_name' value="<?php echo $_smarty_tpl->tpl_vars['master_table_name']->value;?>
" />
				
				<fieldset class="large-100 medium-33 small-100">
				
				<fieldset class="large-100 medium-33 small-100">					<legend><span class="small">general options</span></legend>
					<p><b>Items per Page</b>: <input type="text" name="items_per_page"  value="10" size="5"/> 					| <b>File Folder</b>: <input type="text" id="file_folder" name="file_folder" class="" value="" size="20"/> (for .swf, .mp3, .doc ...) </p>										<fieldset class="large-100 medium-33 small-100">					<legend><span class="small">Image Folder options</span></legend>
					<p><b>Images Folder (MAIN)</b>: <input type="text" id="origin_img_folder" name="origin_img_folder" class="" value="" size="20"/> 
					| <b>New Image prefix</b>: 
					<select id='new_image_prefix' name='new_image_prefix'>
							<option value="">Choose</option>
							<?php  $_smarty_tpl->tpl_vars['col_itm'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['col_itm']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['col_infos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['col_itm']->key => $_smarty_tpl->tpl_vars['col_itm']->value){
$_smarty_tpl->tpl_vars['col_itm']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['col_itm']->value['name'];?>
" > <?php echo $_smarty_tpl->tpl_vars['col_itm']->value['name'];?>
 </option>
							<?php } ?>
					</select> (* title for new images)
					<br><br> <b>Thumbnail Folder (MINI)</b>: <input type="text" id="thumbnail_folder" name="thumbnail_folder" class="" value="" size="20"/> 						| Size: Width <input type="text" id="thumbnail_width" name="thumbnail_width" class="" value="" size="3"/>  						| Height <input type="text" id="thumbnail_height" name="thumbnail_height" class="" value="" size="3"/>					<div id="extra_image_folder"><b>Other image Folder (0) </b>: <input type="text" id="extra_img_folder_0" name="extra_img_folder_0" class="" value="" size="20"/> 						| Size: Width <input type="text" id="extra_img_folder_0_width" name="extra_img_folder_0_width" class="" value="" size="3"/>  						| Height <input type="text" id="extra_img_folder_0_height" name="extra_img_folder_0_height" class="" value="" size="3"/> 					</div> <a id='append_link' rel='0' href="javascript:void(0)" onclick="extra_image_field();">Add More</a>
					</p>					</fieldset>					
				</fieldset>
				
                <fieldset class="large-35 medium-33 small-100">
					<legend><span class="small">Table Columns:</span> <font color="green"><?php echo $_smarty_tpl->tpl_vars['master_table_name']->value;?>
</font></legend>
					<?php  $_smarty_tpl->tpl_vars['col'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['col']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['col_infos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['col']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['col']->key => $_smarty_tpl->tpl_vars['col']->value){
$_smarty_tpl->tpl_vars['col']->_loop = true;
 $_smarty_tpl->tpl_vars['col']->index++;
?>
						<?php if ($_smarty_tpl->tpl_vars['col']->value['key']==1){?>
							<?php $_smarty_tpl->tpl_vars[((string)$_smarty_tpl->tpl_vars['col']->value['name'])."_Key"] = new Smarty_variable("checked", null, 0);?> 
						<?php }?>
						
						<?php if ($_smarty_tpl->tpl_vars['col']->index==0){?>
							<p class="no-margin">
						<?php }else{ ?>
							<p style='line-height:2.5em'>
						<?php }?>
						<b><?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
</b>: <input type="text" name="<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_title"  value="<?php echo $_smarty_tpl->tpl_vars['col']->value['title'];?>
" size="20"/>
						<input type="radio" name="table_key" value="<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
" <?php echo $_smarty_tpl->tpl_vars[($_smarty_tpl->tpl_vars['col']->value['name']).'_Key']->value;?>
> Key
						</p>
					<?php } ?>
                </fieldset>
				
				<fieldset class="large-35 medium-33 small-100">
					<legend><span class="small">Choose Type:</span></legend>
					<?php  $_smarty_tpl->tpl_vars['col'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['col']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['col_infos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['col']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['col']->key => $_smarty_tpl->tpl_vars['col']->value){
$_smarty_tpl->tpl_vars['col']->_loop = true;
 $_smarty_tpl->tpl_vars['col']->index++;
?>				
						<?php if ($_smarty_tpl->tpl_vars['col']->value['type']=='mediumtext'||$_smarty_tpl->tpl_vars['col']->value['type']=='text'){?>
							<?php $_smarty_tpl->tpl_vars[((string)$_smarty_tpl->tpl_vars['col']->value['name'])."_Textarea"] = new Smarty_variable("selected", null, 0);?>
						<?php }elseif($_smarty_tpl->tpl_vars['col']->value['type']=='tinyint'||$_smarty_tpl->tpl_vars['col']->value['type']=='int'||$_smarty_tpl->tpl_vars['col']->value['type']=='bigint'){?>
							<?php $_smarty_tpl->tpl_vars[((string)$_smarty_tpl->tpl_vars['col']->value['name'])."_Int"] = new Smarty_variable("selected", null, 0);?>
						<?php }elseif($_smarty_tpl->tpl_vars['col']->value['type']=='date'){?>
							<?php $_smarty_tpl->tpl_vars[((string)$_smarty_tpl->tpl_vars['col']->value['name'])."_Date"] = new Smarty_variable("selected", null, 0);?>
						<?php }else{ ?>
							<?php $_smarty_tpl->tpl_vars[((string)$_smarty_tpl->tpl_vars['col']->value['name'])."_Varchar"] = new Smarty_variable("selected", null, 0);?>
						<?php }?>
						
						<?php if ($_smarty_tpl->tpl_vars['col']->index==0){?>
							<p class="no-margin">
						<?php }else{ ?>
							<p style='line-height:2.5em'>
						<?php }?>
						
						<select id="<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_Type" name="<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_Type">
							<option value="int" <?php echo $_smarty_tpl->tpl_vars[($_smarty_tpl->tpl_vars['col']->value['name']).'_Int']->value;?>
 > Int </option>
							<option value="varchar" <?php echo $_smarty_tpl->tpl_vars[($_smarty_tpl->tpl_vars['col']->value['name']).'_Varchar']->value;?>
 > Varchar </option>
							<option value="textarea" <?php echo $_smarty_tpl->tpl_vars[($_smarty_tpl->tpl_vars['col']->value['name']).'_Textarea']->value;?>
 > Textarea </option>
							<option value="date" <?php echo $_smarty_tpl->tpl_vars[($_smarty_tpl->tpl_vars['col']->value['name']).'_Date']->value;?>
 > Date </option>
							<option value="image" onclick="$('#thumbnail_folder').addClass('validate[required] text-input');$('#origin_img_folder').addClass('validate[required] text-input');"> Image </option>
							<option value="file" onclick="$('#file_folder').addClass('validate[required] text-input');"> File </option>
							<option value="options" onclick="$('#<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_file_name').show();$('#<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_dependsOn').show();"> Options </option>
						</select>
						<input style="display:none" type='text' id='<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_file_name' name='<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_file_name' size='10' value="" />
						<select style="display:none" id='<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_dependsOn' name='<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_dependsOn'>
							<option value="">Depends On</option>
							<?php  $_smarty_tpl->tpl_vars['col_itm'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['col_itm']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['col_infos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['col_itm']->key => $_smarty_tpl->tpl_vars['col_itm']->value){
$_smarty_tpl->tpl_vars['col_itm']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['col_itm']->value['name'];?>
" > <?php echo $_smarty_tpl->tpl_vars['col_itm']->value['name'];?>
 </option>
							<?php } ?>
						</select>
						</p>
					<?php } ?>
				</fieldset>
				 
				<fieldset class="large-10 medium-33 small-100">
					<legend><span class="small">Validation<font color="red">*</font></span></legend>
					<?php  $_smarty_tpl->tpl_vars['col'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['col']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['col_infos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['col']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['col']->key => $_smarty_tpl->tpl_vars['col']->value){
$_smarty_tpl->tpl_vars['col']->_loop = true;
 $_smarty_tpl->tpl_vars['col']->index++;
?>
						<?php if ($_smarty_tpl->tpl_vars['col']->index==0){?>
							<p class="no-margin">
						<?php }else{ ?>
							<p style='line-height:2.5em'>
						<?php }?>
						<input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_Required" value="true" id="<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_Required"> Required
						</p>
						<br/>
					<?php } ?>
				</fieldset>
				 
				<fieldset class="large-20 medium-33 small-100">
					<legend><span class="small">Show in :</span></legend>
					<?php  $_smarty_tpl->tpl_vars['col'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['col']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['col_infos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['col']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['col']->key => $_smarty_tpl->tpl_vars['col']->value){
$_smarty_tpl->tpl_vars['col']->_loop = true;
 $_smarty_tpl->tpl_vars['col']->index++;
?>					
							<?php if ($_smarty_tpl->tpl_vars['col']->value['create']){?>
								<?php $_smarty_tpl->tpl_vars[((string)$_smarty_tpl->tpl_vars['col']->value['name'])."_Create"] = new Smarty_variable("checked", null, 0);?>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['col']->value['edit']){?>
								<?php $_smarty_tpl->tpl_vars[((string)$_smarty_tpl->tpl_vars['col']->value['name'])."_Edit"] = new Smarty_variable("checked", null, 0);?>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['col']->value['list']){?>
								<?php $_smarty_tpl->tpl_vars[((string)$_smarty_tpl->tpl_vars['col']->value['name'])."_List"] = new Smarty_variable("checked", null, 0);?>
							<?php }?>
							
							<?php if ($_smarty_tpl->tpl_vars['col']->index==0){?>
								<p class="no-margin">
							<?php }else{ ?>
								<p style='line-height:2.5em'>
							<?php }?>
							
							<input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_Create" value="true" id="<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_Create" <?php echo $_smarty_tpl->tpl_vars[($_smarty_tpl->tpl_vars['col']->value['name']).'_Create']->value;?>
> Create
							| <input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_Edit" value="true" id="<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_Edit" <?php echo $_smarty_tpl->tpl_vars[($_smarty_tpl->tpl_vars['col']->value['name']).'_Edit']->value;?>
> Edit
							| <input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_List" value="true" id="<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_List" <?php echo $_smarty_tpl->tpl_vars[($_smarty_tpl->tpl_vars['col']->value['name']).'_List']->value;?>
> List
							</p>
							<br/>
					<?php } ?>
				 </fieldset>
				 
				</fieldset> 
				 
				 
				 
				<?php if (count($_smarty_tpl->tpl_vars['child_tables']->value)>0){?>
					<input type='hidden' name='child_tables' value="<?php echo $_smarty_tpl->tpl_vars['child_tables_ser']->value;?>
" />
					<input type='hidden' name='child_tables_col_names' value="<?php echo $_smarty_tpl->tpl_vars['child_tables_col_names']->value;?>
" />
					
					<fieldset class="large-100 medium-33 small-100">
					<legend><span class="medium">Child Tables linked to key!</span></legend>
					
						<?php  $_smarty_tpl->tpl_vars['child_table'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['child_table']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['child_tables']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['child_table']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['child_table']->key => $_smarty_tpl->tpl_vars['child_table']->value){
$_smarty_tpl->tpl_vars['child_table']->_loop = true;
 $_smarty_tpl->tpl_vars['child_table']->index++;
?>	
							<?php if ($_smarty_tpl->tpl_vars['child_table']->index==0){?>
								<p class="no-margin">
							<?php }else{ ?>
								<p style='line-height:2.5em'>
							<?php }?>
							<font color="blue"><b><?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
</b></font> Title (i.e CAT, SUBCAT, ...): <input type="text" id="<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_label" name="<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_label"  class="validate[required] text-input" value="" size="20"/><br>
								<font color='blue'>Choose Master Key:</font> 
								<select id="<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_master_key" name="<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_master_key">
									<?php  $_smarty_tpl->tpl_vars['col'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['col']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['child_tables_col_infos']->value[$_smarty_tpl->tpl_vars['child_table']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['col']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['col']->key => $_smarty_tpl->tpl_vars['col']->value){
$_smarty_tpl->tpl_vars['col']->_loop = true;
 $_smarty_tpl->tpl_vars['col']->index++;
?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
" > <?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
 </option>
									<?php } ?>
								</select>
							</p>
							
							
							<fieldset class="large-35 medium-33 small-100">
								<legend><span class="small">Table Columns:</span></legend>
								<?php  $_smarty_tpl->tpl_vars['col'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['col']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['child_tables_col_infos']->value[$_smarty_tpl->tpl_vars['child_table']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['col']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['col']->key => $_smarty_tpl->tpl_vars['col']->value){
$_smarty_tpl->tpl_vars['col']->_loop = true;
 $_smarty_tpl->tpl_vars['col']->index++;
?>
									<?php if ($_smarty_tpl->tpl_vars['col']->value['key']==1){?>
										<?php $_smarty_tpl->tpl_vars[((string)$_smarty_tpl->tpl_vars['child_table']->value)."_".((string)$_smarty_tpl->tpl_vars['col']->value['name'])."_Key"] = new Smarty_variable("checked", null, 0);?>
									<?php }?>
									
									<?php if ($_smarty_tpl->tpl_vars['col']->index==0){?>
										<p class="no-margin">
									<?php }else{ ?>
										<p style='line-height:2.5em'>
									<?php }?>
									<b><?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
</b>: <input type="text" name="<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_title"  value="<?php echo $_smarty_tpl->tpl_vars['col']->value['title'];?>
" size="20"/>
									<input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_table_key" value="<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
" <?php echo $_smarty_tpl->tpl_vars[($_smarty_tpl->tpl_vars['child_table']->value).'_'.($_smarty_tpl->tpl_vars['col']->value['name']).'_Key']->value;?>
> Key
									</p>
								<?php } ?>
							</fieldset>
							
							
							<fieldset class="large-35 medium-33 small-100">
								<legend><span class="small">Choose Type:</span></legend>
								<?php  $_smarty_tpl->tpl_vars['col'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['col']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['child_tables_col_infos']->value[$_smarty_tpl->tpl_vars['child_table']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['col']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['col']->key => $_smarty_tpl->tpl_vars['col']->value){
$_smarty_tpl->tpl_vars['col']->_loop = true;
 $_smarty_tpl->tpl_vars['col']->index++;
?>				
										<?php if ($_smarty_tpl->tpl_vars['col']->value['type']=='mediumtext'||$_smarty_tpl->tpl_vars['col']->value['type']=='text'){?>
											<?php $_smarty_tpl->tpl_vars[((string)$_smarty_tpl->tpl_vars['child_table']->value)."_".((string)$_smarty_tpl->tpl_vars['col']->value['name'])."_Textarea"] = new Smarty_variable("selected", null, 0);?>
										<?php }elseif($_smarty_tpl->tpl_vars['col']->value['type']=='tinyint'||$_smarty_tpl->tpl_vars['col']->value['type']=='int'||$_smarty_tpl->tpl_vars['col']->value['type']=='bigint'){?>
											<?php $_smarty_tpl->tpl_vars[((string)$_smarty_tpl->tpl_vars['child_table']->value)."_".((string)$_smarty_tpl->tpl_vars['col']->value['name'])."_Int"] = new Smarty_variable("selected", null, 0);?>
										<?php }elseif($_smarty_tpl->tpl_vars['col']->value['type']=='date'){?>
											<?php $_smarty_tpl->tpl_vars[((string)$_smarty_tpl->tpl_vars['child_table']->value)."_".((string)$_smarty_tpl->tpl_vars['col']->value['name'])."_Date"] = new Smarty_variable("selected", null, 0);?>
										<?php }else{ ?>
											<?php $_smarty_tpl->tpl_vars[((string)$_smarty_tpl->tpl_vars['child_table']->value)."_".((string)$_smarty_tpl->tpl_vars['col']->value['name'])."_Varchar"] = new Smarty_variable("selected", null, 0);?>
										<?php }?>
										
										<?php if ($_smarty_tpl->tpl_vars['col']->index==0){?>
											<p class="no-margin">
										<?php }else{ ?>
											<p style='line-height:2.5em'>
										<?php }?>
										<select id="<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_Type" name="<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_Type">
											<option value="int" onclick="$('#<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_file_name').hide();" <?php echo $_smarty_tpl->tpl_vars[($_smarty_tpl->tpl_vars['child_table']->value).'_'.($_smarty_tpl->tpl_vars['col']->value['name']).'_Int']->value;?>
 > Int </option>
											<option value="varchar" onclick="$('#<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_file_name').hide();" <?php echo $_smarty_tpl->tpl_vars[($_smarty_tpl->tpl_vars['child_table']->value).'_'.($_smarty_tpl->tpl_vars['col']->value['name']).'_Varchar']->value;?>
 > Varchar </option>
											<option value="textarea" onclick="$('#<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_file_name').hide();" <?php echo $_smarty_tpl->tpl_vars[($_smarty_tpl->tpl_vars['child_table']->value).'_'.($_smarty_tpl->tpl_vars['col']->value['name']).'_Textarea']->value;?>
 > Textarea </option>
											<option value="date" onclick="$('#<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_file_name').hide();" <?php echo $_smarty_tpl->tpl_vars[($_smarty_tpl->tpl_vars['child_table']->value).'_'.($_smarty_tpl->tpl_vars['col']->value['name']).'_Date']->value;?>
 > Date </option>
											<option value="image" onclick="$('#<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_file_name').hide();"> Image </option>
											<option value="file" onclick="$('#<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_file_name').hide();"> File </option>
											<option value="options" onclick="$('#<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_file_name').show();$('#<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_dependsOn').show();"> Options </option>
										</select>
										<input style="display:none" type='text' id='<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_file_name' size='10' name='<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_file_name' value="" />
										<select style="display:none" id='<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_dependsOn' name='<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_options_dependsOn'>
											<option value="">Depends On</option>
											<?php  $_smarty_tpl->tpl_vars['col_itm'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['col_itm']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['child_tables_col_infos']->value[$_smarty_tpl->tpl_vars['child_table']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['col_itm']->key => $_smarty_tpl->tpl_vars['col_itm']->value){
$_smarty_tpl->tpl_vars['col_itm']->_loop = true;
?>
												<option value="<?php echo $_smarty_tpl->tpl_vars['col_itm']->value['name'];?>
" > <?php echo $_smarty_tpl->tpl_vars['col_itm']->value['name'];?>
 </option>
											<?php } ?>
										</select>
										
										
								<?php } ?>
							</fieldset>
							
							
							<fieldset class="large-10 medium-33 small-100">
								<legend><span class="small">Validation <font color="red">*</font></span></legend>
								<?php  $_smarty_tpl->tpl_vars['col'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['col']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['child_tables_col_infos']->value[$_smarty_tpl->tpl_vars['child_table']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['col']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['col']->key => $_smarty_tpl->tpl_vars['col']->value){
$_smarty_tpl->tpl_vars['col']->_loop = true;
 $_smarty_tpl->tpl_vars['col']->index++;
?>
									<?php if ($_smarty_tpl->tpl_vars['col']->index==0){?>
										<p class="no-margin">
									<?php }else{ ?>
										<p style='line-height:2.5em'>
									<?php }?>
									<input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_Required" value="true" id="<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_Required"> Required
									</p>
									<br/>
								<?php } ?>
							</fieldset>
							
							
							<fieldset class="large-20 medium-33 small-100">
								<legend><span class="small">Show in :</span></legend>
								<?php  $_smarty_tpl->tpl_vars['col'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['col']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['child_tables_col_infos']->value[$_smarty_tpl->tpl_vars['child_table']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['col']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['col']->key => $_smarty_tpl->tpl_vars['col']->value){
$_smarty_tpl->tpl_vars['col']->_loop = true;
 $_smarty_tpl->tpl_vars['col']->index++;
?>					
										<?php if ($_smarty_tpl->tpl_vars['col']->value['create']){?>
											<?php $_smarty_tpl->tpl_vars[((string)$_smarty_tpl->tpl_vars['child_table']->value)."_".((string)$_smarty_tpl->tpl_vars['col']->value['name'])."_Create"] = new Smarty_variable("checked", null, 0);?>
										<?php }?>
										<?php if ($_smarty_tpl->tpl_vars['col']->value['edit']){?>
											<?php $_smarty_tpl->tpl_vars[((string)$_smarty_tpl->tpl_vars['child_table']->value)."_".((string)$_smarty_tpl->tpl_vars['col']->value['name'])."_Edit"] = new Smarty_variable("checked", null, 0);?>
										<?php }?>
										<?php if ($_smarty_tpl->tpl_vars['col']->value['list']){?>
											<?php $_smarty_tpl->tpl_vars[((string)$_smarty_tpl->tpl_vars['child_table']->value)."_".((string)$_smarty_tpl->tpl_vars['col']->value['name'])."_List"] = new Smarty_variable("checked", null, 0);?>
										<?php }?>
										
										<?php if ($_smarty_tpl->tpl_vars['col']->index==0){?>
											<p class="no-margin">
										<?php }else{ ?>
											<p style='line-height:2.5em'>
										<?php }?>
										
										<input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_Create" value="true" id="<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_Create" <?php echo $_smarty_tpl->tpl_vars[($_smarty_tpl->tpl_vars['child_table']->value).'_'.($_smarty_tpl->tpl_vars['col']->value['name']).'_Create']->value;?>
> Create
										| <input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_Edit" value="true" id="<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_Edit" <?php echo $_smarty_tpl->tpl_vars[($_smarty_tpl->tpl_vars['child_table']->value).'_'.($_smarty_tpl->tpl_vars['col']->value['name']).'_Edit']->value;?>
> Edit
										| <input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_List" value="true" id="<?php echo $_smarty_tpl->tpl_vars['child_table']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['col']->value['name'];?>
_List" <?php echo $_smarty_tpl->tpl_vars[($_smarty_tpl->tpl_vars['child_table']->value).'_'.($_smarty_tpl->tpl_vars['col']->value['name']).'_List']->value;?>
> List
										</p>
										<br/>
								<?php } ?>
							 </fieldset>
						<?php } ?>
						
					</fieldset>
				<?php }?>
				
				
				<input type='submit' class="ink-button blue" value='Generate CRUD' /><input type='hidden' value='1' name='submitted' /> 
		</form>
		</div>     
    </body>
</html>
<?php }} ?>