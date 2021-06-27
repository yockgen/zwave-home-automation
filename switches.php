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
	
	} );

	
	$("select").change(function(event) 
	{

   		id=event.target.id;
		val = $("#"+id).val();
		ToggleSwitch(id,val);
			
	});

} );


function ToggleSwitch(id,val)
{
	
	 actionid = id +"_" + val;
	 
 	 $.ajax({url:"server_action.php?action=test&id="+actionid,success:function(result)
	 {
    		alert(result);
  	 }});


}

function Refresh()
{
	window.location = "switches.php";
}
		

</script>

<body>






<div data-role="header" data-theme="b"> 	
	<a href="#nav-panel" data-icon="bars" data-iconpos="notext">Menu</a>
	<h1>Electrical Appliance</h1>
	<a data-role="button" href="#" onclick="javascript:Refresh();return false" rel="external" data-icon="gear" class="ui-btn-right">Refresh</a> 
</div> 


<?php
	echo menu();
?>




<div data-role="content"> 


<ul data-role="listview" data-inset="true">

		
	<li>	
	<label for="flip-1">Living Room - Air Cond:</label>	
	 
	<select name="SW_0002" id="SW_0002" data-role="slider" data-theme="a" data-track-theme="a">
	<option value="0">Off</option>
	<option value="1">On</option>
	</select>
	
	</li>

	<li>
	<label for="flip-2">Living Room - Central:</label>	
	
	<select name="SW_0004" id="SW_0004" data-role="slider" data-theme="a" data-track-theme="a">
	<option value="0">Off</option>
	<option value="1">On</option>
	</select>
	</li>
	
	<li>
	<label for="flip-2">Car Park - Central:</label>	
	
	<select name="SW_0006" id="SW_0006" data-role="slider" data-theme="a" data-track-theme="a">
	<option value="0">Off</option>
	<option value="1">On</option>
	</select>
	</li>
	

	
	<li>
	<label for="flip-2">Dinning Room - Dimmer:</label>	
	
	<select name="SW_0003" id="SW_0003" data-role="slider" data-theme="a" data-track-theme="a">
	<option value="0">Off</option>
	<option value="1">On</option>
	</select>
	</li>


	
	
</ul>			

</div>



<?php
	echo footer();
?>



</body>
</html>
