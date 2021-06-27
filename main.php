<?php
require_once ("common.php");


function genActionButtons()
{

	$directory= '/var/www/config/action/';	
	$arrFiles = getFiles($directory,"xml");

	$result = "";
	$cnt = 0;
	foreach ($arrFiles as &$file) 
   	{

		$pos = strripos($file,"/");
		$id = substr($file,$pos+1);
		$id = str_replace(".xml","",$id);

		if (substr($id,0,3)<>"SW_") //not switche config
		{

			$icon = "home";
			$theme = "d";
			if ($id =="z_Out")
			{

		 		$icon = "arrow-l";
		 		$theme = "c";
		
			}

			$class = $cnt%2>0 ? "ui-block-b":"ui-block-a";

			$cnt++;

			$result .= '
		      	<div class="'.$class.'" style="height:80px;padding:4px" align="center">
		      	<button  type="submit" data-icon="'.$icon.'" data-iconpos="top" data-theme="'.$theme.'" name="'.$id.'" id="'.$id.'" value="submit-value">'.$id.'</button>
  		      	</div>';




			
		}

	}

	return $result;

}


function MainEntry()
{


	$action = $_GET["action"];
	
	
	echo '<div class="ui-grid-a" align="center">';  	 
	$actionbtns = genActionButtons();	 
	echo $actionbtns ;
	echo '</div>';

	

}



?>

<!DOCTYPE html> 
<html> 

<?php
	echo jquery_header();
?>

<script src="common.js"></script>
<script>


        $(function() {
 
           	  


		$("button").on("click",function()
		{

			var id = $(this).attr("id");
  			performAction(id);

		});

		getLoc();getHomeStatus();
		setInterval(function(){getLoc();getHomeStatus();},20000);
 
            
        });
	
	function performAction(id)
	{


 	 $.ajax({url:"server_action.php?action=test&id="+id,success:function(result)
	 {
    		alert(result);
  	 }});


	}

	
	function refresh()
	{
		
		window.location = "main.php";
	}


    </script>
<body>



<div data-role="header" data-theme="b"> 	
	<a href="#nav-panel" data-icon="bars" data-iconpos="notext">Menu</a>
	<h1>Orchestra</h1>
	<a data-role="button" href="#" onclick="javascript:refresh();return false;" rel="external" data-icon="gear" class="ui-btn-right">Refresh</a> 
</div> 


<?php
	echo menu();
?>




<div data-role="content"> 

<?php
	MainEntry();

?>

<div style="font-size:8pt"><b>GPS:</b><span id="STS_LOC"></span></div>
<div style="font-size:8pt"><b>HOME:</b><span id="STS_HOME"></span></div>
</div>



<?php
	echo footer();

	
?>




</body>
</html>
