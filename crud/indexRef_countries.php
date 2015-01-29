<html>
	<head>
		<link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
		<link href="scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
		<script src="scripts/jtable/jquery.jtable.js" type="text/javascript"></script>

		<!-- Import CSS file for validation engine (in Head section of HTML) -->
		<link href="scripts/validationEngine/validationEngine.jquery.css" rel="stylesheet" type="text/css" />

		<!-- Import Javascript files for validation engine (in Head section of HTML) -->
		<script type="text/javascript" src="scripts/validationEngine/jquery.validationEngine.js"></script>
		<script type="text/javascript" src="scripts/validationEngine/jquery.validationEngine-en.js"></script>
	</head>
	<body>
		<div id="Ref_countries"></div><script type="text/javascript">
		$(document).ready(function () {
		    //Prepare jTable
			$('#Ref_countries').jtable({
				title: 'Ref_countries',
				paging: true,
				pageSize: 25,
				sorting: true,
				defaultSorting: 'name ASC',
				actions: {
					listAction: 'Ref_countriesActions.php?action=list',
					createAction: 'Ref_countriesActions.php?action=create',
					updateAction: 'Ref_countriesActions.php?action=update',
					deleteAction: 'Ref_countriesActions.php?action=delete'
				},
				fields: {
					id: { 
						key: true,title: 'id',create: false,edit: false,list: false,width: '10%'
					},
					countrycode: { 
						title: 'countrycode',width: '10%'
					},
					country: { 
						title: 'country',width: '10%'
					},
					country_code: { 
						title: 'country_code',create: false,edit: false,list: false,width: '10%'
					},
					country_code_crc: { 
						title: 'country_code_crc',create: false,edit: false,list: false,width: '10%'
					},
					legal_info: { 
						title: 'legal_info',type: 'textarea',width: '10%'
					},
					drinking_age: { 
						title: 'drinking_age',width: '10%'
					},
					national_alcohols: { 
						title: 'national_alcohols',type: 'textarea',width: '10%'
					},
					extra_info: { 
						title: 'extra_info',type: 'textarea',width: '10%'
					},
					population: { 
						title: 'population',width: '10%'
					},
					area: { 
						title: 'area',width: '10%'
					},
					currencycode: { 
						title: 'currencycode',width: '10%'
					},
					capital: { 
						title: 'capital',width: '10%'
					},
					flag: { 
						title: 'flag',
						display: function (data) {
							return '<img src="../flags_mini/' + data.record.flag + '" width=150>';
						},
						input: function (data) {
							var update_field = '<input type="hidden" id="table_name" value="ref_countries"/>';
								update_field+= '<input type="hidden" id="key_name" value="id"/>';
								if(data.record) {
									update_field+= '<input type="hidden" id="key_value" value="' + data.record.id + '"/>';
								}
								else
								{
									update_field+= '<input type="hidden" id="key_value" value=""/>';
								}
								update_field+= 'Save Thumbnail in:<input type="text" id="thumbnail_folder" value="../flags_mini/"/> OR IN';																update_field+= '<select id="choose_extra_folder\' name="choose_extra_folder">';																update_field+= '<option value="../flags_mini/" onclick="$(\'#thumbnail_folder\').val(\'../flags_mini/\'); $(\'#flag_width\').val(\'150\'); $(\'#flag_height\').val(\'100\');"> ../flags_mini/ </option>'; update_field+= '</select><br>';												update_field+= '<input type="hidden" id="origin_img_folder" value="../flags/"/>';
								update_field+= '<select id="flag_align">';
								update_field+= '	<option value="left">left</option><option value="center" selected>center</option><option value="right">right</option>';
								update_field+= '</select>';
								update_field+= '<select id="flag_valign">';
								update_field+= '	<option value="top">top</option><option value="center" selected>center</option><option value="bottom">bottom</option>';
								update_field+= '</select>';
								update_field+= 'W:<input type="text" id="flag_width"  size="3" value="150"/>';
								update_field+= 'H:<input type="text" id="flag_height"   size="3" value="100"/> ';
								update_field+= '<a href="javascript::void()" id="update_flag"><b>Update Thumbnail</b></a>';
							
							var upload_field = '<input type="radio" name="origin_flag" value="url" id="origin_flag_url" checked> Internet	|';
								upload_field+= '<input type="radio" name="origin_flag" value="local" id="origin_flag_local"> Upload';
								upload_field+= '<div id="flag_field" class="no-margin">';
								upload_field+= '	<input type="text" onclick="$(\'#Edit-\').addClass(\'ui-state-error\');" id="upload_flag" name="upload_flag" size="50"/>';
								upload_field+= '</div>';
								upload_field+= '<a href="javascript::void()" id="send_flag"><b>Send</b></a>';
								upload_field+= '<div id="loader_flag" style="display:none">';
								upload_field+= '	<img src="loading_s.gif">';
								upload_field+= '</div>';
								upload_field+= '<br/>' + update_field + ' <br/>Fill here<font color=red>*</font>:<br/>';
								
							if(data.record) {
								return '' + upload_field + '<input type="text" name="flag" value="' + data.record.flag + '" id="Edit-flag" class=""><div id="preview_flag"><img src="../flags_mini/' + data.record.flag + '" width=75></div>'; 
							}
							else {
								return '' + upload_field + '<input type="text" name="flag" id="Edit-flag" class=""><div id="preview_flag"></div>'; 
							}
						},width: '10%'
					},
					motto: { 
						title: 'motto',type: 'textarea',width: '10%'
					}
				},
				//Initialize validation logic when a form is created + support file upload
				formCreated: function (event, data) {
					data.form.attr('enctype','multipart/form-data');
					data.form.validationEngine();
					
					$('#flag_field').on('focusout', '#upload_flag', function() {
						var image = $(this).val();
						if($('#origin_flag_url').is(':checked')) {
							$('#preview_flag').html('<img width="100" height="100" src="' + image + '" />');
						}
					});
					$('#origin_flag_url').click(function() {
						$('#flag_field').html('<input type="text" onclick="$(\'#Edit-\').addClass(\'ui-state-error\');" id="upload_flag" name="upload_flag" size="50"/>');
					});
					$('#origin_flag_local').click(function() {
						$('#flag_field').html('<input type="file" onclick="$(\'#Edit-\').addClass(\'ui-state-error\');" id="upload_flag" name="upload_flag" size="40"/>');
					});
					$('#send_flag').on('click', function() {
						var formData = new FormData($('form')[0]);
						$('#loader_flag').show();												var prefix_val = $('#Edit-').val();						
						var request = $.ajax({							
							url: "save_image.php?image_name=flag&new_image_prefix=" + prefix_val + "",
							type: "POST",
							data: formData,
							processData: false,
							contentType: false,
							dataType: 'json',
							success: function (res) {
								$('#loader_flag').hide();
								if(res.result == 'OK') {
									$('#flag_field').html("<font color=green>Image Successfully uploaded</font>");
									$('#preview_flag').html('<img width="100" height="100" src="../flags_mini/' + res.msg + '?' + new Date().getTime() + '" />');
									$('#Edit-flag').val('' + res.msg + '');
								}
								else
								{	
									$('#flag_field').append('<font color=red>' + res.msg + '</font>');
								}
							}
						});
					});
					
					// Update thumbnail size
					$('#update_flag').click(function() {
						var param_table_name=$('#table_name').val();
						var param_key_name=$('#key_name').val();
						var param_key_value=$('#key_value').val();
						var param_origin_img_folder=$('#origin_img_folder').val();
						var param_thumbnail_folder=$('#thumbnail_folder').val();
						var param_align=$('#flag_align').val();
						var param_valign=$('#flag_valign').val();
						var param_width=$('#flag_width').val();
						var param_height=$('#flag_height').val();
						var request = $.ajax({
							url: "auto_resize_image.php",
							type: "POST",
							data: { 'table_name': param_table_name, 'key_name': param_key_name, 'key_value': param_key_value, 'col_thumbnail': 'flag', 'th_align': param_align, 'th_valign': param_valign, 'width': param_width, 'height': param_height, 'origin_img_folder': param_origin_img_folder, 'thumbnail_folder': param_thumbnail_folder},
							dataType: "json"
						});
						
						request.done(function( res ) {
							if(res.result == 'OK') {
								$('#preview_flag').html('<font color=green>Thumbnail Successfully uploaded</font><br><img width="100" height="100" src="' + param_thumbnail_folder + '' + res.msg + '?' + new Date().getTime() + '" />');
							}
							else
							{
								$('#flag_field').append('<font color=red>' + res.msg + '</font>');
							}
						});
						
						request.fail(function( jqXHR, textStatus ) {
							alert( "Update failed: " + textStatus );
						});
					});
		
					
				},
				//Validate form when it is being submitted
				formSubmitting: function (event, data) {
					return data.form.validationEngine('validate');
				},
				//Dispose validation logic when form is closed
				formClosed: function (event, data) {
					data.form.validationEngine('hide');
					data.form.validationEngine('detach');
				}
	
			});
			//Load Ref_countries list from server
			$('#Ref_countries').jtable('load');
		});</script>
	</body>
	</html>