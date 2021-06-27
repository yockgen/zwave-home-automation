<?php
require_once ("common.php");

function MainEntry()
{


	$action = $_GET["action"];
	$fName = $_GET["file"];
	$fSubtitle = $_GET["subtitle"];
	$fpos = $_GET["pos"];	


	$directory= '/var/www/media/';
	
	$arrFiles = getFiles($directory,"avi,mp4,flv,mkv,mov");
	echo genSelector("media_lst","Media File",$arrFiles,$fName);

	$arrSubTitleFiles = getFiles($directory,"srt");
	echo genSelector("subtitle_lst","Subtitle",$arrSubTitleFiles,$fSubtitle);



	if ($action=="play")
	{

		
		showStatusMsg("Playing...");
		startPlaying($fName,$fSubtitle,$fpos);
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

function genSelector($id,$title,$arrFiles,$default)
{

   natcasesort($arrFiles);
			
   $result ='	
   <div data-role="fieldcontain">'.$title.'
   <select name="'.$id.'" id="'.$id.'" data-theme="a"><option value="">--please select a media--</option>';
	

   foreach ($arrFiles as &$value) 
   {

	$selected = "";
	if ($default==$value)
	{
		$selected = "selected";
	}
        
	$arrTmp = explode("/",$value);
	$fileDesc = array_pop($arrTmp);
	
    	$result .="<option value='$value' $selected>$fileDesc</option>";

	
   }

 


   $result .='</select></div>';

	
   return $result;	
	
}





?>


<!DOCTYPE html> 
<html> 

<?php
	echo jquery_header();
?>

<script>
        $(function() {
 
            $("#play").click(function() 
	    {
		fName = $("#media_lst").val();	
		
		fpos = $("#pos").val();
		if (isNaN(fpos) ==true){
			$("#pos").val("0");
			fpos = "0";
		}
                


		if (fName=="")
		{
			alert("Please pick a media file!");
			return;
		}
	
		fSubtitle = $("#subtitle_lst").val();
		window.location = "media.php?action=play&file=" +fName+"&subtitle="+fSubtitle+"&pos="+fpos; 
           	
	    
	    });

	  
            $("#stop").click(function() 
	    {
		fName = $("#media_lst").val();	
		fSubtitle = $("#subtitle_lst").val();

		window.location = "media.php?action=stop&file=" +fName+"&subtitle="+fSubtitle;  
           	
	    
	    });


	    $("#fwd").click(function() 
	    {

		
		fSubtitle = $("#subtitle_lst").val();	
		
		//this line not working for safari browser, need to use old way as below
		//$('#media_lst option:selected').next().attr('selected', 'selected');
		
		
		var selectobject=document.getElementById("media_lst")
		iSelected=selectobject.selectedIndex;
		for (var i=0; i<selectobject.length; i++)
		{
			
			if(i==iSelected)
			{
				idx = 0;
				if (i+1<selectobject.length-1)
				{
					idx = i+1;
				}
	
				selectobject.options[idx].selected="true";
							
			}
		}


		fName = $('#media_lst').val(); 
		window.location = "media.php?action=play&file=" +fName+"&subtitle="+fSubtitle;  
           	
	    
	    });


	    $("#bwd").click(function() 
	    {
		fSubtitle = $("#subtitle_lst").val();	
		
		var selectobject=document.getElementById("media_lst")
		iSelected=selectobject.selectedIndex;
		for (var i=0; i<selectobject.length; i++)
		{
			
			if(i==iSelected)
			{
				idx = selectobject.length-1;
				if (i-1>0)
				{
					idx = i-1;
				}
	
				selectobject.options[idx].selected="true";
							
			}
		}


		fName = $('#media_lst').val(); 
		window.location = "media.php?action=play&file=" +fName+"&subtitle="+fSubtitle;  
           	
           	
	    
	    });



 
            
        });


	function refresh()
	{
		window.location = "media.php";
	}


    </script>
<body>





<div data-role="header" data-theme="b"> 	
	<a href="#nav-panel" data-icon="bars" data-iconpos="notext">Menu</a>
	<h1>Media Player</h1>
	<a data-role="button" href="#" onclick="javascript:refresh();return false;" rel="external" data-icon="gear" class="ui-btn-right">Refresh</a> 
</div> 


<?php
	echo menu();
?>


<div data-role="content"> 


<?php

 MainEntry();


?>

<div class="ui-grid-a">
    <input type="text" id="pos" value="0"/>
</div>

<div class="ui-grid-a">

  <div class="ui-block-a">
	<button type="submit" data-icon="arrow-l" data-theme="d" name="bwd" id="bwd" value="submit-value">Previous</button>
  </div>
  
  <div class="ui-block-b">
	<button type="submit" data-icon="arrow-r" data-theme="d" name="fwd" id="fwd" value="submit-value">Next</button>
  </div>  

  <div class="ui-block-a">
	<button type="submit" data-icon="arrow-r" data-theme="d" name="play" id="play" value="submit-value">Play</button>
  </div>
  <div class="ui-block-b">
	<button type="submit" data-icon="delete" data-theme="c" name="stop" id="stop" value="submit-value">Stop</button>
  </div>

  
</div>


</div>



<?php
	echo footer();
?>




</body>
</html>
