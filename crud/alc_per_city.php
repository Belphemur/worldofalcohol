<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/countrycodes.js"></script>
<script type="text/javascript">

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
		
google.load('visualization', '1', {
    'packages': ['geochart']
});
google.setOnLoadCallback(drawCitiesMap);

function drawVisualization() {
	var options = {
        region: 'world',
        displayMode: 'country',
        resolution: 'country',
        width: 800,
        height: 600
    };
	
	// field in json we are interested in
	var dimension = "alcohols";
	
	$.ajax({
		url: "geochart/getAlcPerCountry.php?action=listByCountry",
		dataType: "JSON"
		}).done(function(data) {
			var countriesArray = [["Country",dimension]];
			$.each(data.countries, function() {
				var countryitem = [this.country, parseInt(this[dimension])];
				countriesArray.push(countryitem);
			});
			
			var statesData = google.visualization.arrayToDataTable(countriesArray);
			var chart = new google.visualization.GeoChart(document.getElementById('visualization'));
			
			//listener
			google.visualization.events.addListener(chart, 'select', function() {
			var selectedItem = chart.getSelection()[0];
				if (selectedItem) {
					var country = statesData.getValue(selectedItem.row, 0);
					alert(country);
				}
			});
			
			chart.draw(statesData, options);
			
		});
};



function drawCitiesMap() {
	var country = getParameterByName("country");
	var countryCode = getCountryCode(country);
	console.log(countryCode);
	var options = {
        region: countryCode,
		displayMode: 'markers',
        resolution: 'city',
        width: 800,
        height: 600
    };
	var dimension = "alcohols";
	$.ajax({
		url: "geochart/getAlcPerCountry.php?action=listByCity&country=" + country,
		dataType: "JSON"
		}).done(function(data) {
			var countriesArray = [["City",dimension]];
			
			$.each(data.countries, function() {
				var countryitem = [this.city, parseInt(this[dimension])];
				countriesArray.push(countryitem);
			});
			
			var statesData = google.visualization.arrayToDataTable(countriesArray);
			var chart = new google.visualization.GeoChart(document.getElementById('visualization'));
			chart.draw(statesData, options);
		});
}

	

function getData() {															
	var request = $.ajax({							
		url: "geochart/getAlcPerCountry.php",
		type: "GET",
		processData: false,
		contentType: false,
		dataType: 'json',
		success: function (res) {
			if(res.result == 'OK') {
				$('#error_msg').html("<font color=green>GET Data Success</font>");
				$('#msg').val('' + res.msg + '');
			}
			else
			{		
				$('#error_msg').append('<font color=red>' + res.msg + '</font>');
			}
		}
	});
};
					
</script>
</head>
<body>
<div id="getData"></div>
<div id="visualization" style="margin: 1em"> </div>
<div id="msg"></div><br>
<div id="error_msg"></div>
</body>
</html>