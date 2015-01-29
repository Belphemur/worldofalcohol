<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1', {
    'packages': ['geochart']
});
google.setOnLoadCallback(drawVisualization, "world");

function drawVisualization(region) {
	var options = {
        region: region,
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
			var sum = 0;
			$.each(data.countries, function() {
				var countryitem = [this.country, parseInt(this[dimension])];
				countriesArray.push(countryitem);
				$('#data').append('<li>' + countryitem[0] + ': ' + countryitem[1] + '</li>');
				sum += countryitem[1];
			});
			$('#data').append('<b>Total</b>: ' + sum + ' ');
			var statesData = google.visualization.arrayToDataTable(countriesArray);
			var chart = new google.visualization.GeoChart(document.getElementById('visualization'));
			
			//listener
			google.visualization.events.addListener(chart, 'select', function() {
			var selectedItem = chart.getSelection()[0];
				if (selectedItem) {
					var country = statesData.getValue(selectedItem.row, 0);
					
					window.open('alc_per_city.php?country=' +country);
				}
			});
			
			chart.draw(statesData, options);
			
		});
};


/*function drawCitiesMap() {
	var options = {
        region: 'AU',
		displayMode: 'markers',
        resolution: 'provinces',
        width: 800,
        height: 600
    };
	var dimension = "alcohols";
	
	$.ajax({
		url: "geochart/getAlcPerCountry.php?action=listByCountry&country=Australia",
		dataType: "JSON"
		}).done(function(data) {
			var countriesArray = [["City",dimension]];
			
			$.each(data.countries, function() {
				var countryitem = [this.city, this[dimension]];
				countriesArray.push(countryitem);
			});
			
			var statesData = google.visualization.arrayToDataTable(countriesArray);
			var chart = new google.visualization.GeoChart(document.getElementById('visualization'));
			chart.draw(statesData, options);
		});
}*/

$( document ).ready(function() {

$('#showRegion li').click( function (e) { 
	var id = $(this).attr("id");
	drawVisualization(id);
}); 

});

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
<ul id="showRegion">
<li id="002"><a href="#">Africa</a></li>
<li id="142"><a href="#">Asia</a></li>
<li id="150"><a href="#">Europe</a></li>
<li id="019"><a href="#">Americas</a></li>
<li id="009"><a href="#">Oceania</a></li>
<li id="world"><a href="#">World</a></li>
</ul>
<div id="visualization" style="margin: 1em"> </div>
<div id="msg"></div><br>
<div id="error_msg"></div>
<div id="data"></div>
</body>
</html>