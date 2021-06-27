
<?php

require_once ("common.php");

function GetStatusLogFileNm()
{
	return "/var/www/config/sensor_yockgencam01.txt";
}


function PerformAction($id)
{

	$URL = "http://".getIP("controller")."/server_action.php?action=trigger&id=".$id;
	$data = file_get_contents($URL);
	echo "<ACK>SWITCH 06 ".$id."</ACK>";

}


function WriteStatusLog($camid,$motion_status)
{

	$logFile= GetStatusLogFileNm();

	$timestamp = date('Y-m-d H:i:s');
  	
	$file = fopen($logFile,"w");
  	$content = "$camid,$motion_status,$timestamp";
	fwrite($file,$content);
  	fclose($file);

}


function GetStatusLog($camid)
{

	$logFile= GetStatusLogFileNm();
	
	$file = fopen($logFile,"r");
	$arrResult =fgetcsv($file);
	fclose($file);
	return $arrResult;  
}


echo "test<br>";

 $timestamp = date('Y-m-d H:i:s');
echo "$timestamp";

exit;

/*main entry*/

for ($x=0; $x<=1; $x++)
{
	$arrStatus = explode(";",$data);
	$URL = "http://".getIP("controller")."/server_cam.php?action=get_status&id=cam01";

	$arrTime = explode("=",$arrStatus[4]);
	$hrs = date("H", $arrTime[1]);

	echo "test= $hrs<br>";
	$data = file_get_contents($URL);

	sleep(1);
}




?>