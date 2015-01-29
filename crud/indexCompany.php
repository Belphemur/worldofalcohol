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
		<div id="Company"></div><script type="text/javascript">
		$(document).ready(function () {
		    //Prepare jTable
			$('#Company').jtable({
				title: 'Company',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'name ASC',
				actions: {
					listAction: 'CompanyActions.php?action=list',
					createAction: 'CompanyActions.php?action=create',
					updateAction: 'CompanyActions.php?action=update',
					deleteAction: 'CompanyActions.php?action=delete'
				},
				fields: {
					id: { 
						key: true,title: 'id',create: false,edit: false,list: false,width: '10%'
					},
					id_location: { 
						title: 'id_location',create: false,list: false,width: '10%'
					},
					name: { 
						title: 'name',width: '10%'
					},
					name_code: { 
						title: 'name_code',create: false,width: '10%'
					},
					name_code_crc: { 
						title: 'name_code_crc',create: false,edit: false,list: false,width: '10%'
					},
					website: { 
						title: 'website',type: 'textarea',width: '10%'
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
			//Load Company list from server
			$('#Company').jtable('load');
		});</script>
	</body>
	</html>