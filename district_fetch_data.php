<?php
$jsonData=file_get_contents("https://api.covid19india.org/data.json");
$districtdata=file_get_contents("https://api.covid19india.org/v2/state_district_wise.json");
$disdata=json_decode($districtdata,true);

$statedata=json_decode($jsonData,true);
$state=$_POST['state'];
$output='';
$output.='<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">District</th>
					<th scope="col">Confirmed</th>
					<th scope="col">Active</th>
					<th scope="col">Recovered</th>
					<th scope="col">Death</th>
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
				<th>'.$value['districtData'][$i]['district'].'</th>
				<td>'.$value['districtData'][$i]['confirmed'].'</td>
				<td>'.$value['districtData'][$i]['active'].'</td>
				<td>'.$value['districtData'][$i]['recovered'].'</td>
				<td>'.$value['districtData'][$i]['deceased'].'</td>
			</tr>';
			//print_r($value['districtData'][$i]['district']);
		}
		break;
		
	}
	
	//echo $value['active'];
	
	
	
	 
}
$output.='</tbody></table>';
echo $output;
//echo $days_count;
//echo $days_count_prev;
//$value['state']
//print_r($statedata['statewise'][1]['state']);

?>