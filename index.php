<?php
include 'statelogic.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Covid19-Tracker</title>
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

		<div class="container" style="height:80vh; width:100%">
			<canvas id="myChart"></canvas>
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
			var myChart=document.getElementById('myChart').getContext('2d');

			var chart = new Chart(myChart,{
				type:"line",
				data:{
					labels:states,
					datasets:[
						{
							label:"Confirmed",
							data:confirmed,
							backgroundColor:"#f1c40f",
							minBarLength:50,
						},
						{
							label:"recovered",
							data:recovered,
							backgroundColor:"#2ecc71",
							minBarLength:50,
						},
						{
							label:"Deaths",
							data:deaths,
							backgroundColor:"#e74c3c",
							minBarLength:50,
						}
					]
				},
				option:{responsive:true,
					maintainAspectRatio: false,
				},
			})
		});
	});
</script>