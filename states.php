<!DOCTYPE html>
<html>
<head>
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
<?php include 'navabar.html'; ?>
<div class="container">
	<select name="state" id="state" class="form-control">
<option value="">Select State</option>		
<option value="Andhra Pradesh">Andhra Pradesh</option>
<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
<option value="Arunachal Pradesh">Arunachal Pradesh</option>
<option value="Assam">Assam</option>
<option value="Bihar">Bihar</option>
<option value="Chandigarh">Chandigarh</option>
<option value="Chhattisgarh">Chhattisgarh</option>
<option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
<option value="Daman and Diu">Daman and Diu</option>
<option value="Delhi">Delhi</option>
<option value="Lakshadweep">Lakshadweep</option>
<option value="Puducherry">Puducherry</option>
<option value="Goa">Goa</option>
<option value="Gujarat">Gujarat</option>
<option value="Haryana">Haryana</option>
<option value="Himachal Pradesh">Himachal Pradesh</option>
<option value="Jammu and Kashmir">Jammu and Kashmir</option>
<option value="Jharkhand">Jharkhand</option>
<option value="Karnataka">Karnataka</option>
<option value="Kerala">Kerala</option>
<option value="Madhya Pradesh">Madhya Pradesh</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Manipur">Manipur</option>
<option value="Meghalaya">Meghalaya</option>
<option value="Mizoram">Mizoram</option>
<option value="Nagaland">Nagaland</option>
<option value="Odisha">Odisha</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
<option value="Sikkim">Sikkim</option>
<option value="Tamil Nadu">Tamil Nadu</option>
<option value="Telangana">Telangana</option>
<option value="Tripura">Tripura</option>
<option value="Uttar Pradesh">Uttar Pradesh</option>
<option value="Uttarakhand">Uttarakhand</option>
<option value="West Bengal">West Bengal</option>
</select>

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

	<div class="container">
		<div id="district"></div>
		
	</div>

	<footer class="footer mt-auto py-3 bg-light">
		<div class="container text-center">
			<span class="text-dark">Designed and developed</span><br><span class="text-dark">By</span><br><span class="text-dark">Sushant Rokade</span>

		</div>
	</footer>

</body>
</html>
<script type="text/javascript">
	
	$(document).ready(function(){
		$("#state").change(function(){
			$("#confirmed").text('');
					$("#active").text('');
					$("#recovered").text('');
					$("#deaths").text('');
			//alert("changed");
			var state=$('#state').val();
			//alert(state);
			$.getJSON("https://api.covid19india.org/data.json",function(data){
			var states=[];
			var confirmed=[];
			var recovered=[];
			var deaths=[];
			var val=[]; 
			var active=[]

			
			


			//console.log(data);
			$.each(data.statewise,function(id,obj){
				states.push(obj.state);
				confirmed.push(obj.confirmed);
				recovered.push(obj.recovered);
				deaths.push(obj.deaths);
				active.push(obj.active);
			});
			//console.log(states);
			states.shift();
			confirmed.shift();
			recovered.shift();
			deaths.shift();
			active.shift();

			for(i=0;i<states.length;i++)
			{
				//alert("hello");
				if(state==states[i])
				{
					//alert(states[i]);
					$("#confirmed").append(confirmed[i]);
					$("#active").append(active[i]);
					$("#recovered").append(recovered[i]);
					$("#deaths").append(deaths[i]);
					 $.ajax({
					 	type:"POST",
					 	url:"district_fetch_data.php",
					 	data:{state:state},
					 	success:function(data){
					 		$('#district').html(data);
					 	}
					 });
					//break;
	

				}
			}

		})

		}).change();
		
			//alert("clicked");
			//var state=$('#state').val();
			//alert(state);
			


			
		
});
	
</script>