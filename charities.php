<?php
require'header.php';
?>


        <div class="left">
     <form action="charities.php">
     <input type="text" id="ABN" name="ABN" placeholder="ABN without spaces" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>
     <form action="charities.php">
     <input type="text" id="Name" name="Name" placeholder="organisation key word eg catholic" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>


<?php
if ( isset($_GET['Name'])  ||  isset($_GET['Legal_Name']) &&   !isset($_GET['ABN']))
 {
$data = $_GET['Name']; 
$recipient=mysqli_real_escape_string ( $db , $data );

$charities = "SELECT * FROM charities where Legal_Name LIKE'%$recipient%'  ";
$result = mysqli_query($db, $charities );
  @$num_results = mysqli_num_rows($result);
  if ($num_results <17)
  {
	  echo"<h3>Results from the ACNC database for $recipient</h3>
		    <h4>".number_format($num_results)." Results for $recipient</h4>
		  <table class='grants'>";
     while ($row = $result->fetch_assoc())
           {
			   echo"<tr><td><a href='charities.php?Name=$recipient&Legal_Name=".$row['Legal_Name']."'>".$row['Legal_Name']."</a></td><td><a href='charities.php?Name=$recipient&Legal_Name=".$row['Legal_Name']."&ABN=".$row['ABN']."'>".$row['ABN']."</a><td></tr>";

          }echo"</table>";
   }
  elseif ($num_results >16)
  {
	  echo"<h3>Results from the ACNC database for $recipient</h3>
		  <h4>".number_format($num_results)." Results for $recipient</h4>
		  <div class='expand'><table class='grants'>";
     while ($row = $result->fetch_assoc())
           {
			   echo"<tr><td><a href='charities.php?Name=$recipient&Legal_Name=".$row['Legal_Name']."'>".$row['Legal_Name']."</a></td><td><a href='charities.php?Name=$recipient&Legal_Name=".$row['Legal_Name']."&ABN=".$row['ABN']."'>".$row['ABN']."</a><td></tr>";

            }echo"</table></div>Mouse/Scroll for more results";
     }
    
}

?>


<h3>About ACNC charities data</h3>

<p>There are over 50,000 registered charities in Australia. The dataset used in the GovSpend prototype is not currently up to date. For up to the week 
	information on a particular charity please search the Australian Charities and Not for Profit Commission site.</p>
	
 

  
 </div>
 <div class='right'>
	  <?php
	  if ( isset($_GET['ABN']) )
	   {
	  $data = $_GET['ABN']; 
	  $ABN=mysqli_real_escape_string ( $db , $data );

	  $charities = "SELECT * FROM charities where ABN LIKE'%$ABN%'  ";
	  $result = mysqli_query($db, $charities );
	    @$num_results = mysqli_num_rows($result);
	    if ($num_results <1)
	    {
	      echo"<h4>There are no exact matches in ACNC charities data for $ABN</h4>";
	    }
	    elseif ($num_results >0)
	    {echo"<div class='expand'>";
	       while ($row = $result->fetch_assoc())
	             {
	           	include'charities_table.php';

	            }
	  }echo"</div>";
	  }

	  ?>
	  
  <?php
  if ( isset($_GET['Legal_Name']) && !isset($_GET['ABN']))
   {
  $data = $_GET['Legal_Name']; 
  $recipient=mysqli_real_escape_string ( $db , $data );

  $charities = "SELECT * FROM charities where Legal_Name LIKE'%$recipient%'  ";
  $result = mysqli_query($db, $charities );
    @$num_results = mysqli_num_rows($result);
    if ($num_results <1)
    {
      echo"<h4>There are no exact matches in ACNC charities data for $recipient</h4>";
    }
    elseif ($num_results >0)
    {echo"<div class='expand'>";
       while ($row = $result->fetch_assoc())
             {
           	include'charities_table.php';

            }
  }echo"</div>";
  }

  ?>
 
  



  
         
        

   <script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?sensor=false'></script>
<script type='text/javascript'>


    <?php
      
 if (  isset($_GET['Recipient']) && !isset($_GET['Program'])  )
 {

$map = "SELECT Lat, Lon, Pcode,State,Locality FROM coordinates where Pcode IN 
(SELECT Postcode from grants where Recipient ='$recipient' && Year='2015-16' 
  && Locality !=',') ORDER BY Pcode ";
       $result = mysqli_query($db, $map);
 
    echo" var markers = [";
      while ($row = $result->fetch_assoc())
          
 {
       echo
       " {
        \"title\": \"".$row['Locality']."\",
        \"lat\": \"".$row['Lat']."\",
        \"lng\": \"".$row['Lon']."\",
        \"description\": \"".$row['Locality']." <a href='locality.php?Postcode=".$row['Pcode']."'>".$row['Pcode']."</a> \"
      },
       ";
}
   echo"];";
   mysqli_free_result($result);
}
?>


    window.onload = function () {
        LoadMap();
    }


     



    function LoadMap() {
        var mapOptions = {
            center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
            zoom: 14,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("Map"), mapOptions);
 
        //Create and open InfoWindow.
        var infoWindow = new google.maps.InfoWindow();
 
        for (var i = 0; i < markers.length; i++) {
            var data = markers[i];
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.title,

                icon:'map_icon.png'
            });
 
            //Attach click event to the marker.

         
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                    infoWindow.setContent("<div style = 'width:px;min-height:40px'>" + data.description + "</div>");
                    infoWindow.open(map, marker);
                });
            })(marker, data);
        }
    }
</script>
<script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBi_5tk-gJ3wLBKhYh95OKsfTxWV-FOSnI&callback=initMap">
</script>
<div id="Map" style="width: 500px; height: 500px">
</div>
<div class='clear'></div>
   

</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>