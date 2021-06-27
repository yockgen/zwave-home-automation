
<?php

require_once ("common.php");

function GetStatusLogFileNm()
{
	return "/var/www/config/sensor_00001.txt";
}


function PerformAction($id)
{

	$URL = "http://".getIP("controller")."/server_action.php?action=trigger&id=".$id;
	$data = file_get_contents($URL);
	echo "<ACK>".$id."</ACK>";

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



/*main entry*/
for ($x=0; $x<=60; $x++)
{
	$arrStatus = explode(";",$data);
	$URL = "http://".getIP("controller")."/server_cam.php?action=get_status&id=cam01";

	$arrTime = explode("=",$arrStatus[4]);
	$hrs = intval(date("H", $arrTime[1]));


	$data = file_get_contents($URL);

	
	$motion = strpos($arrStatus[6], "alarm_status=1");

	if ($motion == true && ($hrs<=7 || $hrs>=22))
	{
		WriteStatusLog("cam01","1");
		PerformAction("SW_0003_1");
		break;

	}

	sleep(1);
}

$arrStatus = GetStatusLog("cam01");
$lastStatus = $arrStatus[1];
$lastTimestamp =$arrStatus[2];
$timestamp = date('Y-m-d H:i:s');
$diffMinutes= round(abs(strtotime($timestamp) - strtotime($lastTimestamp))/60,2);

if($lastStatus=="1")
{
	if ($diffMinutes>5)
	{
		WriteStatusLog("cam01","0");
		PerformAction("SW_0003_0");
		
	}
} 



?>