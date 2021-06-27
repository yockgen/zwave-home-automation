<?php

echo "<h1>Mah's PI server is working</h1>";
 
$result = shell_exec('sudo ifconfig');
 
 
echo "<pre>$result</pre>";

?>
