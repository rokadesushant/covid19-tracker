<?php
$jsonData=file_get_contents("https://api.covid19india.org/data.json");
$districtdata=file_get_contents("https://api.covid19india.org/v2/state_district_wise.json");
$disdata=json_decode($districtdata,true);

$statedata=json_decode($jsonData,true);
$state=$_POST['state'];
$output='';
$output.='<div class="table-responsive">
			<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col" class="text-center">District</th>
					<th scope="col" class="text-center">Confirmed</th>
					<th scope="col" class="text-center">Active</th>
					<th scope="col" class="text-center">Recovered</th>
					<th scope="col" class="text-center">Death</th>
				</tr>
			</thead>
			<tbody>';
forEach($disdata as $key=>$value)
{
	if($value['state']==$state)
	{
		//echo $state;
		for($i=0;$i<count($value['districtData']);$i++){
			$output.='<tr>
				<th class="text-center">'.$value['districtData'][$i]['district'].'</th>
				<td class="text-center">'.$value['districtData'][$i]['confirmed'].'<br><small class="text-dark pl-1"><i class="fas fa-arrow-up text-danger"></i></small>'.$value['districtData'][$i]['delta']['confirmed'].'</td>
				<td class="text-center">'.$value['districtData'][$i]['active'].'</td>
				<td class="text-center">'.$value['districtData'][$i]['recovered'].'<br><small class="text-dark pl-1"><i class="fas fa-arrow-up text-success"></i></small>'.$value['districtData'][$i]['delta']['recovered'].'</td>
				<td class="text-center">'.$value['districtData'][$i]['deceased'].'<br><small class="text-dark pl-1"><i class="fas fa-arrow-up text-danger"></i></small>'.$value['districtData'][$i]['delta']['deceased'].'</td>
			</tr>';
			//print_r($value['districtData'][$i]['district']);
		}
		break;
		
	}
	
	//echo $value['active'];
	
	
	
	 
}
$output.='</tbody></table></div>';
echo $output;
//echo $days_count;
//echo $days_count_prev;
//$value['state']
//print_r($statedata['statewise'][1]['state']);

?>