<?php
$jsonData=file_get_contents("https://api.covid19india.org/data.json");


$statedata=json_decode($jsonData,true);

forEach(array_slice($statedata['statewise'],1) as $key=>$value)
{
	//echo $value['active'];
}
//echo $days_count;
//echo $days_count_prev;
//$value['state']
//print_r($statedata['statewise'][1]['state']);

?>