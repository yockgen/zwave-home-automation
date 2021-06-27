<?php	

	$URL = "https://freedns.afraid.org/dynamic/update.php?VGRySURCa2M3aXVpY2ZYUlU1dnI6MTI5MDM3NTk=";
	echo "start<br>";
	$data = file_get_contents($URL);
	echo "<ACK>IP Refreshed ($data)</ACK>";

?>
