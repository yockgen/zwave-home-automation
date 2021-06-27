<?php

function GetCredential($id)
{
	return "user=admin&pwd=760713";
}

function GetIP($id)
{
	$cam['cam01']="192.168.0.100:8090";
	$cam['cam02']="192.168.0.109:8090";

	return $cam[$id];
}

function GetParams($id)
{


	$camip = GetIP($id);
	$loginString = GetCredential($id);


	$data = "<NACK/>";

	$URL = "http://$camip/get_params.cgi?$loginString";
	$data = file_get_contents($URL);
	echo "<pre>$data</pre>";

}

function GetStatus($id)
{


	$camip = GetIP($id);
	$loginString = GetCredential($id);


	$data = "<NACK/>";

	$URL = "http://$camip/get_status.cgi?$loginString";
	$data = file_get_contents($URL);
	echo "$data";

}


function GetSnapshot($id)
{


	$content = file_get_contents('http://'.GetIP($id).'/snapshot.cgi?'.GetCredential($id).'&resolution=2');
	header('content-type: image/gif');
	echo $content; 

}

function SetAlarm($id,$armed)
{


	$content = file_get_contents('http://'.GetIP($id).'/set_alarm.cgi?'.GetCredential($id).'&motion_compensation=1&motion_armed='.$armed);
	echo "ACK VAL='".$armed."'"; 

}



$action = $_GET["action"];
$id = $_GET["id"];

if ($action == "get_params" || $action=="")
{
	GetParams($id);
	exit;
}

else if ($action == "get_status")
{
	
	GetStatus($id);
	exit;
}


else if ($action == "set_alarm")
{
	$armed = $_GET["armed"];	
	SetAlarm($id,$armed);
	exit;
}

else if ($action == "get_snapshot")
{
	GetSnapshot($id);
	exit;
}


?>