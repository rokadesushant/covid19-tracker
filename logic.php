<?php
$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  
$jsonData=file_get_contents("https://pomber.github.io/covid19/timeseries.json");


$data=json_decode($jsonData,true);

forEach($data as $key=>$value)
{
	$days_count=count($value)-1;
	$days_count_prev=$days_count-1;
}

$totalconfirmedcases=0;
$totalrecovered=0;
$totaldeath=0;

forEach($data as $key=>$value)
{
	$totalconfirmedcases=$totalconfirmedcases+$value[$days_count]['confirmed'];
	$totalrecovered=$totalrecovered+$value[$days_count]['recovered'];
	$totaldeath=$totaldeath+$value[$days_count]['deaths'];
}

?>