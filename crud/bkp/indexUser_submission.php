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
		<div id="User_submission"></div><script type="text/javascript">
		function validAlcohol(id) {
			var request = $.ajax({
				url: "validUserAlcohol.php?id="+id+"&site=woa",
				type: "GET",
				dataType: "json"
			});
			
			request.done(function( res ) {
				if(res.result == 'KO') {
					$('#valid_result_'+id).append('<font color=red>' + res.Message + '</font>');
				}
				else
				{
					var added_alcohol = "";
					var added_location = "";
					$.each(res.Message, function(key,val){
						$('#valid_result_'+id).append('' + key + ':');
						if(val != null)
						{
							var color = "green";
							// do something with key and val
							if(val.Result !== undefined) {
								if(val.Result== "KO")
									color = "red";

								$('#valid_result_'+id).append('<font color='+color+'><b>' + val.Result + '</b></font><br>');
								if(key == "add_alcohol")
									added_alcohol = val.Record;
								if(key == "add_location")
									added_location = val.Record;	
							}
							else if(val.result !== undefined) {
								if(val.result== "KO")
									color = "red";

								$('#valid_result_'+id).append('<font color='+color+'><b>' + val.result + '</b></font><br>');
							}
						}
						else
						{
							$('#valid_result_'+id).append('<font color=red><b>error</b></font><br>');
						}
					});
					// when alcohol is added change the "valid it" and put the link to the site
					if(added_alcohol !="") {
						$('#valid_button_'+id).html('<a href="http://worldofalcohols.com/'+added_alcohol.name_code+'_'+added_location.country_code+'-beer" target="_blank"><b>Valid</b>! visit page</font></a><br>');
					}
					
				}
			});
			
			request.fail(function( jqXHR, textStatus ) {
				alert( "Update failed: " + textStatus );
			});
		}
		
		$(document).ready(function () {
		    //Prepare jTable
			$('#User_submission').jtable({
				title: 'User_submission',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'name ASC',
				actions: {
					listAction: 'User_submissionActions.php?action=list',
					createAction: 'User_submissionActions.php?action=create',
					updateAction: 'User_submissionActions.php?action=update',
					deleteAction: 'User_submissionActions.php?action=delete'
				},
				fields: {
					id: { 
						key: true,title: 'id',create: false,edit: false,list: false,width: '10%'
					},
					valid_id: { 
						title: 'Valid',
						display: function (data) {
							if(data.record.valid_id==0)
								return '<div id="valid_button_' + data.record.id + '"><font color=red>Not Valid </font><a href="javascript::void()" onclick="validAlcohol(' + data.record.id + ');">Valid it</a></div><div id="valid_result_' + data.record.id + '"></div>';
							else {
								var alc_name_code = "";
								var request = $.ajax({					
									url: "AlcoholActions.php?action=list&filter_col=id&filter_val="+data.record.valid_id+"&jtStartIndex=0&jtPageSize=10",
									type: "GET",
									dataType: 'json',
									success: function (res) {
										alc_name_code = res.Records[0].name_code;
										$('#valid_button_' + data.record.id + '').html('<font color=green><b>Validated </b></font><a href="http://worldofalcohols.com/'+alc_name_code+'_'+data.record.country_code+'-beer" target="_blank">visit page</font></a>');
									}
								});
								return '<div id="valid_button_' + data.record.id + '"><a href="http://worldofalcohols.com/'+data.record.alcohol_name+'_'+data.record.country_code+'-beer" target="_blank"><b>Valid</b>! visit page</font></a>';
							}
						},
						width: '10%'
					},
					user: { 
						title: 'user',width: '10%'
					},
					email: { 
						title: 'email',width: '10%'
					},
					country_code: { 
						title: 'country_code',width: '10%'
					},
					city: { 
						title: 'city',width: '10%'
					},
					alcohol_name: { 
						title: 'alcohol_name',width: '10%'
					},
					alcohol_type_code: { 
						title: 'alcohol_type_code',width: '10%'
					},
					alcohol_sub_type: { 
						title: 'alcohol_sub_type',width: '10%'
					},
					company: { 
						title: 'company',width: '10%'
					},
					alcohol_degree: { 
						title: 'alcohol_degree',width: '10%'
					},
					year: { 
						title: 'year',width: '10%'
					},
					file: { 
						title: 'file',
						display: function (data) {
							return '<img src="../user_img/' + data.record.file + '" width=150>';
						},
						input: function (data) {
							var update_field = '<input type="hidden" id="table_name" value="user_submission"/>';
								update_field+= '<input type="hidden" id="key_name" value="id"/>';
								if(data.record) {
									update_field+= '<input type="hidden" id="key_value" value="' + data.record.id + '"/>';
								}
								else
								{
									update_field+= '<input type="hidden" id="key_value" value=""/>';
								}
								update_field+= 'Save Thumbnail in:<input type="text" id="thumbnail_folder" value="../user_img/"/> OR IN';																update_field+= '<select id="choose_extra_folder\' name="choose_extra_folder">';																update_field+= '<option value="../user_img/" onclick="$(\'#thumbnail_folder\').val(\'../user_img/\'); $(\'#file_width\').val(\'160\'); $(\'#file_height\').val(\'400\');"> ../user_img/ </option>'; update_field+= '</select><br>';												update_field+= '<input type="hidden" id="origin_img_folder" value="../user_img/"/>';
								update_field+= '<select id="file_align">';
								update_field+= '	<option value="left">left</option><option value="center" selected>center</option><option value="right">right</option>';
								update_field+= '</select>';
								update_field+= '<select id="file_valign">';
								update_field+= '	<option value="top">top</option><option value="center" selected>center</option><option value="bottom">bottom</option>';
								update_field+= '</select>';
								update_field+= 'W:<input type="text" id="file_width"  size="3" value="160"/>';
								update_field+= 'H:<input type="text" id="file_height"   size="3" value="400"/> ';
								update_field+= '<a href="javascript::void()" id="update_file"><b>Update Thumbnail</b></a>';
							
							var upload_field = '<input type="radio" name="origin_file" value="url" id="origin_file_url" checked> Internet	|';
								upload_field+= '<input type="radio" name="origin_file" value="local" id="origin_file_local"> Upload';
								upload_field+= '<div id="file_field" class="no-margin">';
								upload_field+= '	<input type="text" onclick="$(\'#Edit-alcohol_name\').addClass(\'ui-state-error\');" id="upload_file" name="upload_file" size="50"/>';
								upload_field+= '</div>';
								upload_field+= '<a href="javascript::void()" id="send_file"><b>Send</b></a>';
								upload_field+= '<div id="loader_file" style="display:none">';
								upload_field+= '	<img src="loading_s.gif">';
								upload_field+= '</div>';
								upload_field+= '<br/>' + update_field + ' <br/>Fill here<font color=red>*</font>:<br/>';
								
							if(data.record) {
								return '' + upload_field + '<input type="text" name="file" value="' + data.record.file + '" id="Edit-file" class=""><div id="preview_file"><img src="../user_img/' + data.record.file + '" width=75></div>'; 
							}
							else {
								return '' + upload_field + '<input type="text" name="file" id="Edit-file" class=""><div id="preview_file"></div>'; 
							}
						},width: '10%'
					},
					ip: { 
						title: 'ip',width: '10%'
					}
				},
				//Initialize validation logic when a form is created + support file upload
				formCreated: function (event, data) {
					data.form.attr('enctype','multipart/form-data');
					data.form.validationEngine();
					
					$('#file_field').on('focusout', '#upload_file', function() {
						var image = $(this).val();
						if($('#origin_file_url').is(':checked')) {
							$('#preview_file').html('<img width="100" height="100" src="' + image + '" />');
						}
					});
					$('#origin_file_url').click(function() {
						$('#file_field').html('<input type="text" onclick="$(\'#Edit-alcohol_name\').addClass(\'ui-state-error\');" id="upload_file" name="upload_file" size="50"/>');
					});
					$('#origin_file_local').click(function() {
						$('#file_field').html('<input type="file" onclick="$(\'#Edit-alcohol_name\').addClass(\'ui-state-error\');" id="upload_file" name="upload_file" size="40"/>');
					});
					$('#send_file').on('click', function() {
						var formData = new FormData($('form')[0]);
						$('#loader_file').show();												var prefix_val = $('#Edit-alcohol_name').val();						
						var request = $.ajax({							
							url: "save_image.php?image_name=file&new_image_prefix=" + prefix_val + "",
							type: "POST",
							data: formData,
							processData: false,
							contentType: false,
							dataType: 'json',
							success: function (res) {
								$('#loader_file').hide();
								if(res.result == 'OK') {
									$('#file_field').html("<font color=green>Image Successfully uploaded</font>");
									$('#preview_file').html('<img width="100" height="100" src="../user_img/' + res.msg + '?' + new Date().getTime() + '" />');
									$('#Edit-file').val('' + res.msg + '');
								}
								else
								{	
									$('#file_field').append('<font color=red>' + res.msg + '</font>');
								}
							}
						});
					});
					
					// Update thumbnail size
					$('#update_file').click(function() {
						var param_table_name=$('#table_name').val();
						var param_key_name=$('#key_name').val();
						var param_key_value=$('#key_value').val();
						var param_origin_img_folder=$('#origin_img_folder').val();
						var param_thumbnail_folder=$('#thumbnail_folder').val();
						var param_align=$('#file_align').val();
						var param_valign=$('#file_valign').val();
						var param_width=$('#file_width').val();
						var param_height=$('#file_height').val();
						var request = $.ajax({
							url: "auto_resize_image.php",
							type: "POST",
							data: { 'table_name': param_table_name, 'key_name': param_key_name, 'key_value': param_key_value, 'col_thumbnail': 'file', 'th_align': param_align, 'th_valign': param_valign, 'width': param_width, 'height': param_height, 'origin_img_folder': param_origin_img_folder, 'thumbnail_folder': param_thumbnail_folder},
							dataType: "json"
						});
						
						request.done(function( res ) {
							if(res.result == 'OK') {
								$('#preview_file').html('<font color=green>Thumbnail Successfully uploaded</font><br><img width="100" height="100" src="' + param_thumbnail_folder + '' + res.msg + '?' + new Date().getTime() + '" />');
							}
							else
							{
								$('#file_field').append('<font color=red>' + res.msg + '</font>');
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
			//Load User_submission list from server
			$('#User_submission').jtable('load');
		});</script>
	</body>
	</html>