<?php
require'header.php';
?>


        <div class="left">

 


	    
    



    <?php/*
  if ( !isset($_GET['Donor']) && !isset($_GET['Name']) &&  !isset($_GET['Party'])   )
  {

    $donor = $_GET['Donor']; 

   echo"<h4>Politial donations paid in 2015-16</h4>";
 $total = "SELECT *,sum(Value),count(Name) from donations GROUP BY name order by sum(Value) DESC
             ";
 $result = mysqli_query($db, $total );
  @$num_results = mysqli_num_rows($result);
 echo"
 <p>There are $num_results donations paid by organisations in the AEC data for 2015-16</p><div class='expand'><table class='wide'>";
  while ($row = $result->fetch_assoc()) 
     {

 echo"<tr><td><a href='donations.php?Donor=".trim($row['Name'])."'>".$row['Name']."</a></td><td><a href='donations.php?Party=".$row['Party']."'>".$row['Party']."</a></td><td>$".number_format($row['sum(Value)'])."</td></tr>";
     }echo"</table></div>";
 }*/
 ?>
 



	  
	    <?php
	  //if ( isset($_GET['Party'])  )
	  {
  
	    
  
	 
	 $total = "SELECT *,sum(Value),count(Name) as count from donations where party!='' GROUP BY Party ORDER BY  sum(Value) DESC
	             ";
	 $result = mysqli_query($db, $total );
	  @$num_results = mysqli_num_rows($result);
	 echo"<h3>Political Donations by Party for 2015-16 FY </h3>
	 <div class='expand'><table class='wide'>";
	  while ($row = $result->fetch_assoc()) 
	     {

	 echo"<tr><td><a href='donations.php?Party=".trim($row['Party'])."'>".$row['Party']."</a></td><td>".$row['count']."</td><td>$".number_format($row['sum(Value)'])."</td></tr>";
	     }echo"</table></div>Mouse/Scroll for more results<br>";
	 }
	 ?>
    
<h3>About AEC political donations data</h3>
<p>AEC donations data does not require ABN/ACN in declarations or does not publish it if it is collected from donors. </p>
<p>Without a unique identifier such as ABN or ACN it is difficult to match political donations data with other datasets. The use of name as an identifier which is
	often the subject of multiple spellings within each dataset (if free text input is used) limits the usability of this data 
	in transparency investigations (or makes it more onerous).</p>
	<p>The lack of standardisation of party names also makes the data more onerous to interact with as calculations based on inexact matches require follow up searches to get a proper
		total.</p>


   
 

 </div>
 <div class='right'>
	    <?php
	  if ( isset($_GET['Party'])  )
	  {
  
	    $party = $_GET['Party']; 
  
	   echo"<h4>Politial donations paid in 2015-16 to $party</h4>";
	 $total = "SELECT *,sum(Value),count(Value) as count,AVG(Value) 
		 from donations WHERE Party='$party' GROUP BY Party
	             ";
	 $result = mysqli_query($db, $total );
	  @$num_results = mysqli_num_rows($result);
	 echo"
	 <hr><div class='expand'><table class='stats'><tr><th>Number</th><th>Average Value</th><th>Total Value</th></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {

	 echo"<tr><th>".$row['count']."</a></th><th>$".number_format($row['AVG(Value)'])."</th>
		 <th>$".number_format($row['sum(Value)'])."</th></tr>";
	     }echo"</table><hr>";
	 }
	 ?>
	 
	    <?php
	  if ( isset($_GET['Name'])  )
	  {
  
	    $donor = $_GET['Name']; 
  
	   echo"<h4>Politial donations paid in 2015-16 by $donor</h4>";
	 $total = "SELECT *,sum(Value),count(Value) as count,AVG(Value) from donations WHERE Name='$donor' GROUP BY Name
	             ";
	 $result = mysqli_query($db, $total );
	  @$num_results = mysqli_num_rows($result);
	 echo"
	 <hr><div class='expand'><table class='stats'>";
	  while ($row = $result->fetch_assoc()) 
	     {

	 echo"<tr><th>".$row['count']."</a></th><th>$".number_format($row['AVG(Value)'])."</th><th>$".number_format($row['sum(Value)'])."</th></tr>";
	     }echo"</table><hr>";
	 }
	 ?>
	 
	 
	    <?php
	  if ( isset($_GET['Donor'])  )
	  {
  
	    $donor = $_GET['Donor']; 
  
	   echo"<h4>Politial donations paid by $donor</h4>";
	 $total = "SELECT * from donations where name  like'%$donor%'
	             ";
	 $result = mysqli_query($db, $total );
	  @$num_results = mysqli_num_rows($result);
	 echo"
	 <p>There are $num_results donations paid by organisations matching $donor</p><table class='stats'>";
	  while ($row = $result->fetch_assoc()) 
	     {

	 echo"<tr><td>".$row['Name']."</td><td>".$row['Party']."</td><td>$".number_format($row['Value'])."</td></tr>";
	     }echo"</table>";
	 }
	 ?>
    

  
  
	    <?php
	  if ( isset($_GET['Party'])  )
	  {
  
	    $party= $_GET['Party']; 
  
	   echo"<h4>Political donations paid to $party</h4>";
	 $total = "SELECT * from donations where Party  LIKE'%$party%'
	             ";
	 $result = mysqli_query($db, $total );
	  @$num_results = mysqli_num_rows($result);
	 echo"
	<table class='wide'><tr><th>Donor</th><th>Value</th></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {

	 echo"<tr><td><a href='donations.php?Name=".trim($row['Name'])."'>".$row['Name']."</a></td><td>$".number_format($row['Value'])."</td></tr>";
	     }echo"</table>";
	 }
	 ?>
    
	    <?php
	  if ( isset($_GET['Name'])  )
	  {
  
	    $name = $_GET['Name']; 
  
	   echo"<h4>Politial donations paid by $name</h4>";
	 $total = "SELECT * from donations where Name ='$name'
	             ";
	 $result = mysqli_query($db, $total );
	  @$num_results = mysqli_num_rows($result);
	 echo"
	<table class='wide'>";
	  while ($row = $result->fetch_assoc()) 
	     {

	 echo"<tr><td>".trim($row['Name'])."</td><td><a href='donations.php?Party=".$row['Party']."'>".$row['Party']."</a></td><td>$".number_format($row['Value'])."</td></tr>";
	     }echo"</table>";
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