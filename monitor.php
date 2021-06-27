<?php
require_once ("common.php");

?>

<!DOCTYPE html> 
<html> 

<?php
	echo jquery_header();
?>



<script>


$(function()
{

	$(document).ready(function() 
	{
		$(':button').button().on("click", function() 
		{ 
			var camid = this.id.substring(0, 5);
			var armed = this.id.substr(this.id.length - 1);
			setMotionAlarm(camid,armed);
					
					
		});
		

	 
		
		
		


	} );

	
} );


function getArrElement(arr,id)
{
	result = "<NACK/>";
	for (var i = 0; i < arr.length; i++) 
	{
		if (arr[i].search(id)>=0)
		{
			arrTmp =arr[i].split("=");
			result = arrTmp[1].slice(0, - 1);
		}
 	   
	}
	return result;
}



function setUIStatus(camid)
{
	
	 arrStatus = [];
 	 $.ajax({url:"server_cam.php?action=get_params&id="+camid,success:function(result)
	 {
    		arrStatus = result.split("\n");
		status=getArrElement(arrStatus,"alarm_motion_armed");
		
		$("#"+camid+"_motion_flg").html(status);
  	 }});

}


function getIPAddress()
{
	cam01LANIP = "192.168.0.100:8090";


	hostTmp = window.location.host+ ":8090";
	
	if (hostTmp.indexOf("192.168.") > -1)
	{
		hostTmp= cam01LANIP ;
	}

	return "http://" + hostTmp;
}



function setMotionAlarm(camid,val)
{

	tmpUrl = "server_cam.php?action=set_alarm&id="+camid + "&armed=" + val;
	$("#"+camid+"_console_panel").attr("src", tmpUrl);
	refreshStatus(camid);
	alert("SUCCESS: Motion Alarm set to (" +val + ") done! It might take 10-20 seconds to refresh to latest status.");

}

function refreshCam(camid)
{
	


	try
	{
	 	var rand = Math.random(); //need random figure to refresh the cache
		tmpUrl = "server_cam.php?action=get_snapshot&id="+camid+"&t=" + rand;
		$("#"+camid).attr("src",tmpUrl);
	}
	catch(error)
	{}


}


function refreshStatus(camid)
{

	try
	{
		setUIStatus(camid);
		

	}
	catch (error)
	{
	
	}

	

	

}

function showCamDetail (camid)
{

	hostTmp = getIPAddress();
	
	d = new Date();
	tmpUrl = hostTmp;	
	
	var win = window.open(tmpUrl , '_blank');
 	win.focus();

}

function refresh()
{
			window.location = "monitor.php";
}
</script>

<body>






<div data-role="header" data-theme="b"> 	
	<a href="#nav-panel" data-icon="bars" data-iconpos="notext">Menu</a>
	<h1>Monitoring</h1>
	<a data-role="button" href="#" onclick="javascript:refresh();return false;" rel="external" data-icon="gear" class="ui-btn-right">Refresh</a> 

</div> 


<?php
	echo menu();
?>




<div data-role="content"> 


<div data-role="collapsibleset" data-content-theme="">


<div data-role="collapsible" data-collapsed="false">
<h3>Live Camera (cam01)</h3>
<p align="center">

<div class="ui-grid-a">

    <div class="ui-block-a">
	<input type="button" data-theme="c" id="cam01_btn_motion01_1" name="btn_motion01_on" OnClick="javascript" value="Alarm On"/>
   </div>
   <div class="ui-block-b">
       <input type="button" data-theme="d" id="cam01_btn_motion01_0" name="btn_motion01_off" OnClick="javascript" value="Alarm Off"/>
   </div>

</div>


<div align="center"><img id="cam01" name="cam01" src="" title="loading..."/></div>


<div class="ui-grid-a">


<div class="ui-block-a">Alarm: <span id="cam01_motion_flg" name="cam01_motion_flg"></span></div>

<div class="ui-block-b">
<a data-role="button" href="#" onclick="javascript:showCamDetail('cam01');return false" data-icon="gear">Options</a> 
</div>


</div>
				
</p>

</div>

<div data-role="collapsible">
<h3>Console.</h3>
<p><iframe src="" id="cam01_console_panel" name="cam01_console_panel" width="100%" height="50"></iframe></p>
</div>
			
</div>

<script>

refreshCam("cam01");
refreshStatus("cam01");
setInterval(function(){refreshCam("cam01");},2000);
setInterval(function(){refreshStatus("cam01");},20000);

</script>


<div data-role="collapsibleset" data-content-theme="">


<div data-role="collapsible" data-collapsed="false">
<h3>Live Camera (cam02)</h3>
<p align="center">

<div class="ui-grid-a">

    <div class="ui-block-a">
	<input type="button" data-theme="c" id="cam02_btn_motion01_1" name="btn_motion01_on" OnClick="javascript" value="Alarm On"/>
   </div>
   <div class="ui-block-b">
       <input type="button" data-theme="d" id="cam02_btn_motion01_0" name="btn_motion01_off" OnClick="javascript" value="Alarm Off"/>
   </div>

</div>


<div align="center"><img id="cam02" name="cam02" src="" title="loading..."/></div>


<div class="ui-grid-a">


<div class="ui-block-a">Alarm: <span id="cam02_motion_flg" name="cam02_motion_flg"></span></div>

<div class="ui-block-b">
<a data-role="button" href="#" onclick="javascript:showCamDetail('cam02');return false" data-icon="gear">Options</a> 
</div>


</div>
				
</p>

</div>

<div data-role="collapsible">
<h3>Console.</h3>
<p><iframe src="" id="cam02_console_panel" name="cam02_console_panel" width="100%" height="50"></iframe></p>
</div>
			
</div>

<script>
refreshCam("cam02");
refreshStatus("cam02");
setInterval(function(){refreshCam("cam02");},2000);
setInterval(function(){refreshStatus("cam02");},20000);
</script>



</div>



<?php
	echo footer();
?>



</body>
</html>
