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
		<div id="Location"></div><script type="text/javascript">
		$(document).ready(function () {
		    //Prepare jTable
			$('#Location').jtable({
				title: 'Location',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'name ASC',
				actions: {
					listAction: 'LocationActions.php?action=list',
					createAction: 'LocationActions.php?action=create',
					updateAction: 'LocationActions.php?action=update',
					deleteAction: 'LocationActions.php?action=delete'
				},
				fields: {
					id: { 
						key: true,title: 'id',create: false,edit: false,list: false,width: '10%'
					},
					country: { 
						title: 'country',options: 'get_countries.php',width: '10%'
					},
					countrycode: { 
						title: 'countrycode',
						dependsOn: 'country',
							options: function(data) {
								if(data.source == 'list') {
									return 'get_country_codes.php'
								}
								return 'get_country_codes.php?country=' + data.dependedValues.country;
							},width: '10%'
					},
					country_code: { 
						title: 'country_code',create: false,edit: false,width: '10%'
					},
					country_code_crc: { 
						title: 'country_code_crc',create: false,edit: false,width: '10%'
					},
					city: { 
						title: 'city',width: '10%'
					},
					city_code: { 
						title: 'city_code',create: false,edit: false,width: '10%'
					}
				},
				//Initialize validation logic when a form is created + support file upload
				formCreated: function (event, data) {
					data.form.attr('enctype','multipart/form-data');
					data.form.validationEngine();
					
					
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
			//Load Location list from server
			$('#Location').jtable('load');
		});</script>
	</body>
	</html>