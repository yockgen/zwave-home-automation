<?php

function AutoAction($timestamp,$lastTimeStamp,$flag ,$lastFlag)
{
	$diffMinutes= round(abs(strtotime($timestamp) - strtotime($lastTimeStamp))/60,2);
	//echo "$timestamp - $lastTimeStamp = $diffMinutes";

	if ($flag == "<NACK/>" && $lastFlag=="<NACK/>" && ($diffMinutes>15 && $diffMinutes<17))  //control device off and idle for 15 minutes, and only trigger once
	{
      	
		$action = "http://192.168.0.103/server_action.php?action=test&id=z_Out";
		$data = file_get_contents($action);
		echo "$data";

	}
	
        elseif ($flag == "<ACK/>" && $lastFlag=="<NACK/>") //when i back home
	{
      	
		$action = "http://192.168.0.103/server_action.php?action=test&id=Home";
		$data = file_get_contents($action);
		echo "$data";

	}



}


$logFile= "/var/www/config/log.txt";

$host="192.168.0.8";

for ($x=0; $x<=60; $x++)
{

	exec("ping -c 4 " . $host, $output, $result);
	$flag = $result == 0? "<ACK/>": "<NACK/>";


	$file = fopen($logFile,"r");
	$arrTmp =fgetcsv($file);
	fclose($file);

	$lastFlag =$arrTmp[0];
	$lastTimeStamp =$arrTmp[1];


	$timestamp = date('Y-m-d H:i:s');

	if ($flag<>$lastFlag)
	{
  		$file = fopen($logFile,"w");
  		fwrite($file,$flag.",".$timestamp);
  		fclose($file);

	}

	//AutoAction($timestamp,$lastTimeStamp,$flag ,$lastFlag);

        sleep(5);

}

echo "$flag";


?>