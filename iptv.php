<?php
require_once ("common.php");



function MainEntry()
{


	$action = $_GET["action"];
	$channel = $_GET["channel"];

	echo genSelector("iptv_lst","Channel",$channel);

	


	if ($action=="play")
	{
		
		showStatusMsg("Playing...");
		startPlaying($channel,"");
	}
	else if ($action=="stop")
	{

		showStatusMsg("Stop player");
		stopPlaying();
		
	}
	else
	{
		showStatusMsg("Player is ready.");

	}



}


function genSelector($id,$title,$default)
{
	$grpBtn = '<div class="ui-grid-a">';

  
	$file = fopen("/var/www/config/iptv.lst","r");

	$counter = 0;
	$size = 3;
	while(!feof($file))
  	{
  		$arrTmp = fgetcsv($file);
		$val = $arrTmp[0];
		$text = $arrTmp[1];
		$control=$arrTmp[2];

		if ($val=="") continue; 		

		$sTmpTheme = "d";
		$sTmpIcon = "video";		
		
		if ($val<>"")
		{
			

			if ($default==$val)
			{
				$sTmpTheme = "c";
				$sTmpIcon = "star";
			}
		

		}
   		
		$sTmp = $counter%2>0? "b":"a";	
		
		$grpBtn .= '<div id="grp_channels" class="ui-block-'.$sTmp.'">';
		$btnid = "btn_tv_".$counter;
		$grpBtn .= '<a id="'.$btnid.'" href="#" onclick="javascript:playChannel(\''.$val.'\',\''.$control.'\',\''.$btnid.'\');" 
			      data-role="button" data-icon="'.$sTmpIcon.'" data-theme="'.$sTmpTheme.'" 
			      data-iconpos="top" data-mini="true">'.str_replace(" "," ",$text).'</a>';
	
		$grpBtn .= '</div>';
		$counter++;
  	}

	fclose($file);
			
	$grpBtn .= "</div>";

 
   
	
   return $grpBtn;	
	
}





?>

<!DOCTYPE html> 
<html> 

<?php
	echo jquery_header();
?>


<script>
        $(function() {
 
           	  
            $("#stop").click(function() 
	    {
		window.location = "iptv.php?action=stop&channel=";  
           	
	    
	    });

 
            
        });
	
	function resetChannelButtons()
	{
		$("a[id*='btn_tv']").each(function()
		{
		
		  id = $(this).attr("id");
		  $(this).buttonMarkup({theme: 'd'});
		  
	
		});	
        }



	function playChannel(url_channel,control,id)
	{

		

		if (control=="1")
		{
			
			pwd = "qwert";
			keyedinPwd = prompt("Please enter password", "");

			if (pwd != keyedinPwd) 
			{
				alert("Sorry! Wrong Password, no access.");
				return;
    
			}
		} 



		isTV=$('input[name=checkbox-mini]:checked', '').val();
		
		cmd = "iptv.php?action=play&channel=" +url_channel;

		if (isTV != "on")
		{
			resetChannelButtons();
			objTarget = $("#"+id);
			objTarget.buttonMarkup({theme: 'b'});	
  			objTarget.attr('data-icon', 'star');	
			cmd = url_channel;
		}
		
		window.location = cmd;
	}

	function refresh()
	{
		window.location = "iptv.php";
	}


    </script>
<body>





<div data-role="header" data-theme="b"> 	
	<a href="#nav-panel" data-icon="bars" data-iconpos="notext">Menu</a>
	<h1>TV channels</h1>
	<a data-role="button" href="#" onclick="javascript:refresh();return false;" rel="external" data-icon="gear" class="ui-btn-right">Refresh</a> 
</div> 



<?php
	echo menu();
?>




<div data-role="content"> 

<div class="ui-grid-a">
  <div class="ui-block-a" align="center">
	<button type="submit" data-icon="delete" data-theme="c" name="stop" id="stop" value="submit-value">Stop Playing</button>
  </div>

  <div class="ui-block-b" align="bottom">
	<input type="checkbox" name="checkbox-mini" id="checkbox-mini-0" class="custom" data-mini="true" checked="true"/>
	<label for="checkbox-mini-0">Play on TV</label>  
  </div>  
  
</div>




<?php

 MainEntry();


?>


</div>



<?php
	echo footer();
?>




</body>
</html>
