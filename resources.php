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
	<?php
	include 'navabar.html';
?>

<br>
<br>
<div class="container">
	<select name="state" id="state" class="form-control">
<option value="">Select State</option>		
<option value="Andhra Pradesh">Andhra Pradesh</option>
<option value="Andaman and Nicobar">Andaman and Nicobar</option>
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
<br><br>
<div class="container">
	<div id="output"></div>
</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$("#state").change(function(){
			var state=$("#state").val();
			var temp=[];
			//alert(state);
			$.getJSON("https://api.covid19india.org/resources/resources.json",function(data){
				console.log(data['resources'][0]['state']);
				for(var i=0;i<data['resources'].length;i++)
				{
					if(data['resources'][i]['state']==state)
					{
						temp.push(data['resources'][i])
						//console.log("success");
					}
				}
				

				
					$("#output").val=' ';
					for(var i=0;i<temp.length;i++)
				{
					$("#output").append(
	'<div class="card"><h5 class="card-header">'+temp[i]['city']+'</h5><div class="card-body"><h5 class="card-title">'+temp[i]['category']+'</h5><p class="card-text"><b>Description: </b>'+temp[i]['descriptionandorserviceprovided']+'</p><p class="card-text"><b>Name Of Organization: </b>'+temp[i]['nameoftheorganisation']+'</p><p class="card-text"><b>Phone No: </b>'+temp[i]['phonenumber']+'</p><p class="card-text"><b>Contact: </b><a href="'+temp[i]['contact']+'">'+temp[i]['contact']+'</a></p><a href=tel:'+temp[i]['phonenumber']+' class="btn btn-primary"><i class="fa fa-volume-control-phone" aria-hidden="true"></i>&nbsp;&nbsp;Call</a></div></div><br>'
)
				}	
			

				

			})
		}).change()
	});
</script>


