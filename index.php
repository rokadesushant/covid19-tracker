

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
<body style="background:url("background.jpg");">
	<?php include('navabar.html');  ?>
	<div class="container-fluid bg-light p-5 text-center my-3">
		<h1>Covid-19 Tracker</h1>
	</div>

	<div class="container my-5">
		<div class="row text-center">
			<div class="col-3 text-dark">
				<h5>Confirmed</h5>
				<p id="confirmed"></p>
				<p id="diffcmd"></p>
				
			</div>

			<div class="col-3 text-info">
				<h5>Active</h5>
				<p id="active"></p>
				<p id="diffact"></p>
			</div>

			<div class="col-3 text-success">
				<h5>Recovered</h5>
				<p id="recovered"></p>
				<p id="diffrcv"></p>
			</div>

			<div class="col-3 text-danger">
				<h5>Death</h5>
				<p id="deaths"></p>
				<p id="diffdth"></p>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		
			<table class="table">
			<thead class="thead-dark">
				<tr>
					<th >States</th>
					<th >Confirmed</th>
					<th >Active</th>
					<th >Recovered</th>
					<th >Death</th>
				</tr>
			</thead>
			<tbody>
				<?php
				forEach(array_slice($statedata['statewise'],1) as $key=>$value)
				{
					echo '<tr>
							<th>'.$value['state'].'</th>
							<td>'.$value['confirmed'].'<br><small class="text-dark pl-1"><i class="fas fa-arrow-up text-danger"></i></small>'.$value['deltaconfirmed'].'</td>
							<td>'.$value['active'].'</td>
							<td>'.$value['recovered'].'<br><small class="text-dark pl-1"><i class="fas fa-arrow-up text-success"></i></small>'.$value['deltarecovered'].'</td>
							<td>'.$value['deaths'].'<br><small class="text-dark pl-1"><i class="fas fa-arrow-up text-danger"></i></small>'.$value['deltadeaths'].'</td>
						 </tr>';
					
	
				}
				?>				
			</tbody>
		</table>

			<!--<div id="visualization" style="margin: 1em"> </div>-->
			
		<hr>
		
	</div>
	<div class="container">
		
		
		
		
		<div class="col-md-6">
			<canvas id="piechart"></canvas>
		</div>

		<br>
		<br>
		
		
	<footer class="footer mt-auto py-3 bg-light">
		<div class="container text-center">
			<span class="text-dark">Stay Safe Stay Healthy</span>
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
			var increase_confirm;
			var increase_recovered;
			var increase_death;
			
			
			total_confirmed=data.statewise[0].confirmed;
			total_active=data.statewise[0].active;
			total_recovered=data.statewise[0].recovered;
			total_deaths=data.statewise[0].deaths;
			
			increase_confirm=data.statewise[0].deltaconfirmed;
			increase_recovered=data.statewise[0].deltarecovered;
			increase_death=data.statewise[0].deltadeaths;
			
			
			$("#confirmed").append('<h4>'+total_confirmed+'</h4>');
			$("#active").append('<h4>'+total_active+'</h4>');
			$("#recovered").append('<h4>'+total_recovered+'</h4>');
			$("#deaths").append('<h4>'+total_deaths+'</h4>');
			
			$("#confirmed").append('<h5 class="text-dark pl-1"><i class="fas fa-arrow-up text-danger"></i>'+increase_confirm+'</h5>');	
			$("#recovered").append('<h5 class="text-dark pl-2"><i class="fas fa-arrow-up text-success"></i>'+increase_recovered+'</h5>');
			$("#deaths").append('<h5 class="text-dark pl-2"><i class="fas fa-arrow-up text-danger"></i>'+increase_death+'</h5>');



			

	
		
			
		});
		
			
		
		
		
		
		
		
		
		
		
	});
	
</script>

