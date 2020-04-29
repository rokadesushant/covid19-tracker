<?php
include 'statelogic.php';
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/hanna.css">
	<title>Covid19-Tracker</title>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Baloo+Tamma+2:wght@500&display=swap" rel="stylesheet">

<script src="https://kit.fontawesome.com/a03f199d35.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- chart.js-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js

"></script>

</head>
<body>
	<?php include('navabar.html');  ?>
	<div class="container-fluid bg-light p-5 text-center my-3">
		<h1>Covid-19 Tracker</h1>
	</div>

	<div class="container my-5">
		<div class="row text-center">
			<div class="col-3 text-dark">
				<h5>Confirmed</h5>
				<p id="confirmed"></p>
				
			</div>

			<div class="col-3 text-warning">
				<h5>Active</h5>
				<p id="active"></p>
			</div>

			<div class="col-3 text-success">
				<h5>Recovered</h5>
				<p id="recovered"></p>
			</div>

			<div class="col-3 text-danger">
				<h5>Death</h5>
				<p id="deaths"></p>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		
			<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">States</th>
					<th scope="col">Confirmed</th>
					<th scope="col">Active</th>
					<th scope="col">Recovered</th>
					<th scope="col">Death</th>
				</tr>
			</thead>
			<tbody>
				<?php
				forEach(array_slice($statedata['statewise'],1) as $key=>$value)
				{
					echo '<tr>
							<th>'.$value['state'].'</th>
							<td>'.$value['confirmed'].'</td>
							<td>'.$value['active'].'</td>
							<td>'.$value['recovered'].'</td>
							<td>'.$value['deaths'].'</td>
						 </tr>';
					
	
				}
				?>				
			</tbody>
		</table>

			<!--<div id="visualization" style="margin: 1em"> </div>-->
			
		
		
	</div>
	<div class="container">
		<div class="col-md-6">
			<div id="regions_div" style="width: 100%; min-height: 450px;"></div>
		</div>

		<div class="col-md-6">
		<div id="chart_div" style="width: 100%; min-height: 450px;"></div>	
		</div>
			
		</div>
		
		
	<footer class="footer mt-auto py-3 bg-light">
		<div class="container text-center">
			<span class="text-muted">Designed and developed</span><br><span class="text-muted">By</span><br><span class="text-muted">Sushant Rokade</span>

		</div>
	</footer>

</body>
</html>

<script>
	$(document).ready(function(){

	

		$.getJSON("https://api.covid19india.org/data.json",function(data){
			var states=[];
			var confirmed=[];
			var recovered=[];
			var deaths=[];
			var val=[]; 

			var total_confirmed;
			var total_active;
			var total_recovered;
			var total_deaths;
			total_confirmed=data.statewise[0].confirmed;
			total_active=data.statewise[0].active;
			total_recovered=data.statewise[0].recovered;
			total_deaths=data.statewise[0].deaths;

			$("#confirmed").append(total_confirmed);
			$("#active").append(total_active);
			$("#recovered").append(total_recovered);
			$("#deaths").append(total_deaths);



			//console.log(data);
			$.each(data.statewise,function(id,obj){
				states.push(obj.state);
				confirmed.push(obj.confirmed);
				recovered.push(obj.recovered);
				deaths.push(obj.deaths);
			});
			//console.log(states);
			states.shift();
			confirmed.shift();
			recovered.shift();
			deaths.shift();

			//console.log(states[0]);
			//console.log(confirmed[0]);
			//console.log(typeof confirmed[0]);
			//val=parseInt(confirmed[0]);
			//console.log(typeof val);
			for(i=0;i<confirmed.length;i++)
				val[i]=parseInt(confirmed[i]);

			

			google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
       // 'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['State','Confirmed'],
          [states[0],val[0]],
          [states[1],val[1]],
          [states[2],val[2]],
          [states[3],val[3]],
          [states[4],val[4]],
          [states[5],val[5]],
          [states[6],val[6]],
          [states[7],val[7]],
          [states[8],val[8]],
          [states[9],val[9]],
          [states[10],val[10]],
          [states[11],val[11]],
          [states[12],val[12]],
          [states[13],val[13]],
          [states[14],val[14]],
          [states[15],val[15]],
          ['Orissa',val[16]],
          [states[17],val[17]],
          [states[18],val[18]],
          [states[19],val[19]],
          [states[20],val[20]],
          [states[21],val[21]],
          [states[22],val[22]],
          [states[23],val[23]],
          [states[24],val[24]],
          [states[25],val[25]],
          [states[26],val[26]],
          [states[27],val[27]],
          [states[28],val[28]],
          [states[29],val[29]],
          [states[30],val[30]],
          [states[31],val[31]],
          [states[32],val[32]],
          [states[33],val[33]],
          [states[34],val[34]],
          [states[35],val[35]],
          [states[36],val[36]],
          [states[37],val[37]]
          
          
        ]);

        var options = {
          title: "Confirmed Cases",
          region:'IN',
          displayMode:'regions',
          resolution:'provinces',
          chartArea: {width: '100%'},
          colors: ['#b3b3ff','#9999ff','#8080ff','#6666ff','#4d4dff','#3333ff','#1a1aff','#0000ff','#0000e6','#0000cc','#0000b3']
        };




        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
			
		});

		$.getJSON("https://api.covid19india.org/data.json",function(data){
			var totalconfirmed=[];
			var date=[];
			var totalrecovered=[];
			var totaldeath=[];
			//console.log(data.cases_time_series);
			$.each(data.cases_time_series,function(id,obj){
				totalconfirmed.push(obj.totalconfirmed);
				totalrecovered.push(obj.totalrecovered);
				date.push(obj.date);
				totaldeath.push(obj.totaldeceased);

		
	   //console.log(d.date);
				
			});
			total_confirmed=data.statewise[0].confirmed;
			total_active=data.statewise[0].active;
			total_recovered=data.statewise[0].recovered;
			total_deaths=data.statewise[0].deaths;

			var increase_confirm=total_confirmed-totalconfirmed[totalconfirmed.length-1];
			var increase_recovered=total_recovered-totalrecovered[totalrecovered.length-1];
			var increase_death=total_deaths-totaldeath[totaldeath.length-1];


			$("#confirmed").append('<small class="text-danger pl-2"><i class="fas fa-arrow-up"></i>'+increase_confirm+'</small>');
			
			$("#recovered").append('<small class="text-danger pl-2"><i class="fas fa-arrow-up"></i>'+increase_recovered+'</small>');
			$("#deaths").append('<small class="text-danger pl-2"><i class="fas fa-arrow-up"></i>'+increase_death+'</small>');


			console.log(increase_confirm);
			//console.log(lastconfirmed);
					var d=[['date','cmd','rcvd','dths']];
			j=1;
			for(i=0;i<date.length;i++)
			{
				d[[j]]=[date[i],parseInt(totalconfirmed[i]),parseInt(totalrecovered[i]),parseInt(totaldeath[i])];
				j++;
			}	    
	    //console.log(d);

			google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBackgroundColor);

function drawBackgroundColor() {



      var data = new google.visualization.arrayToDataTable(d)
      //console.log(data);
      
      

      var options = {
        hAxis: {
          title: 'Date'
        },
        vAxis: {
          title: 'Cases'
        },
        backgroundColor: '#ffffff'
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
			
		});
	});
</script>