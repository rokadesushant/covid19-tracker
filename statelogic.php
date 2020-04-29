<?php
$jsonData=file_get_contents("https://api.covid19india.org/data.json");
$districtdata=file_get_contents("https://api.covid19india.org/v2/state_district_wise.json");
$disdata=json_decode($districtdata,true);
$resourcedata=file_get_contents("https://api.covid19india.org/resources/resources.json");
$resdata=json_decode($resourcedata,true);
$statedata=json_decode($jsonData,true);



//echo $days_count;
//echo $days_count_prev;
//$value['state']
//print_r($statedata['statewise'][1]['state']);

?>