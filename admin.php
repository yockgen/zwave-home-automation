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

			sysrestart();	
					
		});
		

	 
		
		
		


	} );

	
} );


function sysrestart()
{

	pwd = "qwert";
	keyedinPwd = prompt("Please enter password", "");

	if (pwd != keyedinPwd) 
	{
		alert("Sorry! Wrong Password, no access.");
		return;
    
	}


 	 $.ajax({url:"server_action.php?action=sys_restart",success:function(result)
	 {
    		alert(result);
  	 }});

}


function refresh()
{
			window.location = "admin.php";
}
</script>

<body>






<div data-role="header" data-theme="b"> 	
	<a href="#nav-panel" data-icon="bars" data-iconpos="notext">Menu</a>
	<h1>Admin</h1>
	<a data-role="button" href="#" onclick="javascript:refresh();return false;" rel="external" data-icon="gear" class="ui-btn-right">Refresh</a> 

</div> 


<?php
	echo menu();
?>




<div data-role="content"> 

<input type="button" data-icon="home" data-iconpos="top" data-theme="c" id="cam01_btn_motion01_1" name="btn_motion01_on" OnClick="javascript" value="Restart System"/>

</div>



<?php
	echo footer();
?>



</body>
</html>
