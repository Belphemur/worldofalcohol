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
		<div id="Place"></div><script type="text/javascript">
		$(document).ready(function () {
		    //Prepare jTable
			$('#Place').jtable({
				title: 'Place',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'name ASC',
				actions: {
					listAction: 'PlaceActions.php?action=list',
					createAction: 'PlaceActions.php?action=create',
					updateAction: 'PlaceActions.php?action=update',
					deleteAction: 'PlaceActions.php?action=delete'
				},
				fields: {
			LOCATION: {
			title: 'Location',
			width: '5%',
			sorting: false,
			edit: false,
			create: false,
			display: function (placeData) {
				//Create an image that will be used to open child table
                var $img = $('<div id="loc-' + placeData.record.id + '"><b>LOCATION</b></div>');
                var request = $.ajax({
                    url: "Place-Place_locationsActions.php?action=list&place_id=" + placeData.record.id + "",
                    type: "GET",
                    dataType: 'json',
                    success: function (res) {
                        var name = res.Records[0].location;
                        $('#loc-' + placeData.record.id +'').html(name);
                    }
                });
				//Open child table when user clicks the image
				$img.click(function () {
					$('#Place').jtable('openChildTable',
						$img.closest('tr'),
						{
							title: placeData.record.name + ' - LOCATION',
							actions: {
								listAction: 'Place-Place_locationsActions.php?action=list&place_id=' + placeData.record.id,
								deleteAction: 'Place-Place_locationsActions.php?action=delete',
								updateAction: 'Place-Place_locationsActions.php?action=update',
								createAction: 'Place-Place_locationsActions.php?action=create'
							},
							fields: {
					id: { 
						key: true,title: 'id',create: false,edit: false,list: false,width: '10%'
					},
					place_id: { 
						type: 'hidden',create: true,defaultValue: placeData.record.id,title: 'place_id',edit: false,list: false,width: '10%'
					},
					location_id: { 
						title: 'location_id',options: 'get_locations.php',width: '10%'
					}
							}
						}, function (data) { //opened handler
							data.childTable.jtable("load");
						}
					);
				});
				//Return image to show on the person row
				return $img;
			}
			},
			ALCOHOLS: {
			title: 'Alcohols',
			width: '5%',
			sorting: false,
			edit: false,
			create: false,
			display: function (placeData) {
				//Create an image that will be used to open child table
                var $img = $('<div id="alc-' + placeData.record.id + '"><b>ALCOHOLS</b></div>');
                var request = $.ajax({
                    url: "Place-Place_alcoholsActions.php?action=list&place_id=" + placeData.record.id + "",
                    type: "GET",
                    dataType: 'json',
                    success: function (res) {
                        var count = res.TotalRecordCount;
                        $('#alc-' + placeData.record.id +'').html('<b>' + count + '</b> Alcohols');
                    }
                });
				//Open child table when user clicks the image
				$img.click(function () {
					$('#Place').jtable('openChildTable',
						$img.closest('tr'),
						{
							title: placeData.record.name + ' - ALCOHOLS',
							actions: {
								listAction: 'Place-Place_alcoholsActions.php?action=list&place_id=' + placeData.record.id,
								deleteAction: 'Place-Place_alcoholsActions.php?action=delete',
								updateAction: 'Place-Place_alcoholsActions.php?action=update',
								createAction: 'Place-Place_alcoholsActions.php?action=create'
							},
							fields: {
					id: { 
						key: true,title: 'id',create: false,edit: false,list: false,width: '10%'
					},
					place_id: { 
						type: 'hidden',create: true,defaultValue: placeData.record.id,title: 'place_id',edit: false,list: false,width: '10%'
					},
					alcohol_id: { 
						title: 'alcohol_id',options: 'get_alcohol_names.php',width: '10%'
					}
							}
						}, function (data) { //opened handler
							data.childTable.jtable("load");
						}
					);
				});
				//Return image to show on the person row
				return $img;
			}
			},
					id: { 
						key: true,title: 'id',create: false,edit: false,list: false,width: '10%'
					},
					type: { 
						title: 'type',options: 'get_place_types.php',width: '10%'
					},
					name: { 
						title: 'name',width: '10%'
					},
					name_code: { 
						title: 'name_code',create: false,list: false,width: '10%'
					},
					address: { 
						title: 'address',type: 'textarea',width: '10%'
					},
					telephone: { 
						title: 'telephone',type: 'textarea',width: '10%'
					},
					description: { 
						title: 'description',type: 'textarea',width: '10%'
					},
					opening_hours: { 
						title: 'opening_hours',type: 'textarea',width: '10%'
					},
					image: { 
						title: 'image',
						display: function (data) {
							return '<img src="../places_mini/' + data.record.image + '" width=150>';
						},
						input: function (data) {
							var update_field = '<input type="hidden" id="table_name" value="place"/>';
								update_field+= '<input type="hidden" id="key_name" value="id"/>';
								if(data.record) {
									update_field+= '<input type="hidden" id="key_value" value="' + data.record.id + '"/>';
								}
								else
								{
									update_field+= '<input type="hidden" id="key_value" value=""/>';
								}
								update_field+= 'Save Thumbnail in:<input type="text" id="thumbnail_folder" value="../places_mini/"/> OR IN';																update_field+= '<select id="choose_extra_folder\' name="choose_extra_folder">';																update_field+= '<option value="../places_mini/" onclick="$(\'#thumbnail_folder\').val(\'../places_mini/\'); $(\'#image_width\').val(\'250\'); $(\'#image_height\').val(\'250\');"> ../places_mini/ </option>'; update_field+= '</select><br>';												update_field+= '<input type="hidden" id="origin_img_folder" value="../places/"/>';
								update_field+= '<select id="image_align">';
								update_field+= '	<option value="left">left</option><option value="center" selected>center</option><option value="right">right</option>';
								update_field+= '</select>';
								update_field+= '<select id="image_valign">';
								update_field+= '	<option value="top">top</option><option value="center" selected>center</option><option value="bottom">bottom</option>';
								update_field+= '</select>';
								update_field+= 'W:<input type="text" id="image_width"  size="3" value="250"/>';
								update_field+= 'H:<input type="text" id="image_height"   size="3" value="250"/> ';
								update_field+= '<a href="javascript::void()" id="update_image"><b>Update Thumbnail</b></a>';
							
							var upload_field = '<input type="radio" name="origin_image" value="url" id="origin_image_url" checked> Internet	|';
								upload_field+= '<input type="radio" name="origin_image" value="local" id="origin_image_local"> Upload';
								upload_field+= '<div id="image_field" class="no-margin">';
								upload_field+= '	<input type="text" onclick="$(\'#Edit-name\').addClass(\'ui-state-error\');" id="upload_image" name="upload_image" size="50"/>';
								upload_field+= '</div>';
								upload_field+= '<a href="javascript::void()" id="send_image"><b>Send</b></a>';
								upload_field+= '<div id="loader_image" style="display:none">';
								upload_field+= '	<img src="loading_s.gif">';
								upload_field+= '</div>';
								upload_field+= '<br/>' + update_field + ' <br/>Fill here<font color=red>*</font>:<br/>';
								
							if(data.record) {
								return '' + upload_field + '<input type="text" name="image" value="' + data.record.image + '" id="Edit-image" class=""><div id="preview_image"><img src="../places_mini/' + data.record.image + '" width=75></div>'; 
							}
							else {
								return '' + upload_field + '<input type="text" name="image" id="Edit-image" class=""><div id="preview_image"></div>'; 
							}
						},width: '10%'
					}
				},
				//Initialize validation logic when a form is created + support file upload
				formCreated: function (event, data) {
					data.form.attr('enctype','multipart/form-data');
					data.form.validationEngine();
					
					$('#image_field').on('focusout', '#upload_image', function() {
						var image = $(this).val();
						if($('#origin_image_url').is(':checked')) {
							$('#preview_image').html('<img width="100" height="100" src="' + image + '" />');
						}
					});
					$('#origin_image_url').click(function() {
						$('#image_field').html('<input type="text" onclick="$(\'#Edit-name\').addClass(\'ui-state-error\');" id="upload_image" name="upload_image" size="50"/>');
					});
					$('#origin_image_local').click(function() {
						$('#image_field').html('<input type="file" onclick="$(\'#Edit-name\').addClass(\'ui-state-error\');" id="upload_image" name="upload_image" size="40"/>');
					});
					$('#send_image').on('click', function() {
						var formData = new FormData($('form')[0]);
						$('#loader_image').show();												var prefix_val = $('#Edit-name').val();						
						var request = $.ajax({							
							url: "save_image.php?image_name=image&new_image_prefix=" + prefix_val + "&target_folder=../places/",
							type: "POST",
							data: formData,
							processData: false,
							contentType: false,
							dataType: 'json',
							success: function (res) {
								$('#loader_image').hide();
								if(res.result == 'OK') {
									$('#image_field').html("<font color=green>Image Successfully uploaded</font>");
									$('#preview_image').html('<img width="100" height="100" src="../places_mini/' + res.msg + '?' + new Date().getTime() + '" />');
									$('#Edit-image').val('' + res.msg + '');
								}
								else
								{	
									$('#image_field').append('<font color=red>' + res.msg + '</font>');
								}
							}
						});
					});
					
					// Update thumbnail size
					$('#update_image').click(function() {
						var param_table_name=$('#table_name').val();
						var param_key_name=$('#key_name').val();
						var param_key_value=$('#key_value').val();
						var param_origin_img_folder=$('#origin_img_folder').val();
						var param_thumbnail_folder=$('#thumbnail_folder').val();
						var param_align=$('#image_align').val();
						var param_valign=$('#image_valign').val();
						var param_width=$('#image_width').val();
						var param_height=$('#image_height').val();
						var request = $.ajax({
							url: "auto_resize_image.php",
							type: "POST",
							data: { 'table_name': param_table_name, 'key_name': param_key_name, 'key_value': param_key_value, 'col_thumbnail': 'image', 'th_align': param_align, 'th_valign': param_valign, 'width': param_width, 'height': param_height, 'origin_img_folder': param_origin_img_folder, 'thumbnail_folder': param_thumbnail_folder},
							dataType: "json"
						});
						
						request.done(function( res ) {
							if(res.result == 'OK') {
								$('#preview_image').html('<font color=green>Thumbnail Successfully uploaded</font><br><img width="100" height="100" src="' + param_thumbnail_folder + '' + res.msg + '?' + new Date().getTime() + '" />');
							}
							else
							{
								$('#image_field').append('<font color=red>' + res.msg + '</font>');
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
			//Load Place list from server
			$('#Place').jtable('load');
		});</script>
	</body>
	</html>