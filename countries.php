<?php
include 'logic.php';
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

</head>
<body>
	<?php include('navabar.html');  ?>
	<div class="container-fluid bg-light p-5 text-center my-3">
		<h1>Covid-19 Tracker</h1>
	</div>

	<div class="container my-5">
		<div class="row text-center">
			<div class="col-4 text-danger">
				<h5>Confirmed</h5>
				<?php echo $totalconfirmedcases;?>
			</div>

			<div class="col-4 text-success">
				<h5>Recovered</h5>
				<?php echo $totalrecovered;?>
			</div>

			<div class="col-4 text-danger">
				<h5>Death</h5>
				<?php echo $totaldeath;?>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		
			<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Countires</th>
					<th scope="col">Confirmed</th>
					<th scope="col">Recovered</th>
					<th scope="col">Death</th>
				</tr>
			</thead>
			<tbody>
				<?php
					forEach($data as $key=>$value){
						$incresed=$value[$days_count]['confirmed'] - $value[$days_count_prev]['confirmed'] ?>
						<tr>
							<th>
								<?php echo $key;
								?>
							</th>
							<td><?php echo $value[$days_count]['confirmed']; ?>
								<?php if($incresed!=0)
									echo '<small class="text-danger pl-2"><i class="fas fa-arrow-up"></i>'.$incresed.'</small>';
									?>
								
							</td>
							<td><?php echo $value[$days_count]['recovered']; ?></td>
							<td><?php echo $value[$days_count]['deaths']; ?></td>
						</tr>
						
				<?php	}?>
				
				
			</tbody>
		</table>
		
	</div>
		
	<footer class="footer mt-auto py-3 bg-light">
		<div class="container text-center">
			<span class="text-dark">Designed and developed</span><br><span class="text-dark">By</span><br><span class="text-dark">Sushant Rokade</span>

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
		});
	});
</script>