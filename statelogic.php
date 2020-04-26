<?php
$jsonData=file_get_contents("https://api.covid19india.org/data.json");


$statedata=json_decode($jsonData,true);


//print_r($statedata['statewise'][1]['state']);

?>