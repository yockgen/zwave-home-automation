<?php

function getIP($id)
{
	return "192.168.0.103";
}


function getMasterDBXml()
{
	$file="/var/www/config/master.xml";
	$xml=simplexml_load_file($file);
	return $xml;
}

function jquery_header()
{

	$result = '
   <head> 
   <meta name=viewport content="user-scalable=no,width=device-width" />
   <link rel="stylesheet" href="./jquery/mobile/1.4.3/yockgen.css" />
   <link rel="stylesheet" href="./jquery/mobile/1.4.3/jquery.mobile.icons.min.css" />
   <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.3/jquery.mobile.structure-1.4.3.min.css" /> 
   <!--<link rel="stylesheet" href="./jquery/mobile/1.4.3/jquery.mobile-1.4.3.min.css" />-->
   <script src="./jquery/jquery-1.11.1.min.js"></script>
   <script src="./jquery/mobile/1.4.3/jquery.mobile-1.4.3.min.js"></script>
   </head>';

   return $result;

}


function menu()
{
	$result = '

	<div data-role="panel" data-position="left" data-position-fixed="false" data-display="reveal" id="nav-panel" data-theme="a">

	<ul data-role="listview" data-theme="a" data-divider-theme="a" style="margin-top:-16px;" class="nav-search">
	<li>
	<a href="#" onclick="javascript:window.location = \'main.php\';return false;">Orchestra</a>
	</li>	
	<li>
	<a href="#" onclick="javascript:window.location = \'monitor.php\';return false;">Monitoring</a>
	</li>
	<li>
	<a href="#" onclick="javascript:window.location = \'media.php\';return false;">Media Player</a>
	</li>
	<li>
	<a href="#" onclick="javascript:window.location = \'iptv.php\';return false;">TV Channels</a>
	</li>

	<li>
	<a href="#" onclick="javascript:window.location = \'electrical.php\';return false;">Electrical Appliance</a>
	</li>

	<li>
	<a href="#" onclick="javascript:window.location = \'admin.php\';return false;">Admin</a>
	</li>


	</ul>
	</div>';

	return $result;
}

function footer()
{


	$result ='<div data-role="footer" data-theme="a"> 
		  <h4>Copyright Mah Yock Gen 2014 </h4> 
		  </div>';

	return $result; 


}


function showStatusMsg($msg)
{
	 echo "<label data-theme='a'>System:$msg</label>";

}

function startPlaying($fName,$fSubtitle,$fpos)
{
	
	//$result = shell_exec('sudo -u pi omxplayer -p -o hdmi /var/www/media/test.avi > /dev/null 2>&1 &');
	//$result = shell_exec('sudo -u pi omxplayer -p -o hdmi "'.$fName.'" > /dev/null 2>&1 &');   
	//echo "<pre>1. $result</pre>";



	stopPlaying();

	$subtitleCmd = $fSubtitle ==""? '': ' -l subtitles "'.$fSubtitle.'" ';
	$cmd = 'sudo -u pi omxplayer -p -l '.$fpos.' -o hdmi "'.$fName.'"'.$subtitleCmd.' > /dev/null 2>&1 &';
        //echo "$cmd"; 
	$result = shell_exec($cmd);

}

function stopPlaying()
{
	$result = shell_exec('sudo pgrep omxplayer');

	$arrProcessID = explode("\n",$result);
	
	foreach ($arrProcessID as &$value) 
        {
		if ($value<>"")
		{
			$result = shell_exec('sudo kill '.$value);

		}
		

	}


		

}

function getFiles($directory,$type)

{

	$arrFiles = glob($directory.'*.{'.$type.'}', GLOB_BRACE);	
	return $arrFiles;

} 


?>