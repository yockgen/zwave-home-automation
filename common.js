function getLoc()
{

		return;
 	
 		if (navigator.geolocation) 
		{
			navigator.geolocation.getCurrentPosition(showPosition);
    		} 
		else 
		{
        		$("#STS_LOC").html("Geolocation is not supported.");
    		}	
}


function showPosition(position) 
{
	   return;	
	   loc = position.coords.latitude +  "," + position.coords.longitude;
           $("#STS_LOC").html(loc);  
}


function getHomeStatus()
{
	
 	 $.ajax({url:"eye.php",success:function(result)
	 {
		sts = result == "<NACK/>" ? "0": "1";    		
		$("#STS_HOME").html(sts);
  	 }});


}
