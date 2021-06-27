<?php
require_once ("common.php");

function SysRestart()
{
	$result = shell_exec('sudo shutdown -r now');

	echo "<ACK/>";
}

function PerformAction($id)
{


	$path="/var/www/config/action/";
	$file=$path.$id.".xml";

	$xml=simplexml_load_file($file);
	$arrCmd = $xml->xpath('/actions/action/cmd');

	$output = "";
	foreach($arrCmd as $cmd) 
	{
        	$output.=$cmd."\n";
		$data = file_get_contents($cmd);
	}


	echo "<pre>$output</pre>";



}


function GetSwitchStatus()
{
	$url = "http://".getIP("controller").":8083/ZWaveAPI/Data/0";
	$json = file_get_contents($url);
	$obj = json_decode($json);
	echo json_encode($obj);
	
}


$action = $_GET["action"];
$id = $_GET["id"];

if ($action == "get_switches_status")
{
	GetSwitchStatus();
			
}
else if ($action == "sys_restart")
{
	SysRestart();	
	
}
else
{
	PerformAction($id);
}

?>