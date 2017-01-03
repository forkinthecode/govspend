<?php
require'header.php';
?>


        <div class="left">

 












  <?php
  if ( !isset($_GET['Name']) )
   {
  
	   $data = $_GET['Name']; 
	   $name=mysqli_real_escape_string ( $db , $data );
	   
  $query="SELECT * FROM `tax` order by Tax";
  
  $result = mysqli_query($db, $query );
    @$num_results = mysqli_num_rows($result);
 
  $num_results = mysqli_num_rows($result);
    if ($num_results <1)
    {
    echo"<h4>The ATO has not provided Tax Transparency data for the companies matching $name</h4>";
    }
  else
  { echo"<h3>All ATO Tax Transparency results by tax paid (least paid first)</h3><div class='source'>Source: From Tax Transparency data published at data.gov.au </div><div class='expand'>";
   while ($row = $result->fetch_assoc()) 
      {

  echo"
   
 <table class='wide' border='0'><tbody>
 <tr><td width='150px'>Name            </td><td><a href='tax.php?Recipient=".$row['Name']."'>".$row['Name']."</td></tr>
 <tr><td>ABN             </td><td><a href='tax.php?ABN=".$row['ABN']."'>".$row['ABN']."</td></tr>
 <tr><td>Total Income    </td><td>$".number_format($row['Total_Income'])."</td></tr>
 <tr><td>Taxable Income  </td><td>$".number_format($row['Taxable_Income'])."</td></tr>
 <tr><td>Tax             </td><td>$".number_format($row['Tax'])."</td></tr>
  </tbody></table><br> ";
     }echo"</div>Mouse/Scroll for more results";
   }
 }
 
 ?>
 

    
 
 </div>
 <div class='right'>
	    <?php
	    if ( isset($_GET['Name']) )
	     {
  
	  	   $data = $_GET['Name']; 
	  	   $name=mysqli_real_escape_string ( $db , $data );
	   
	    $query="SELECT * FROM `tax` WHERE Name like'%$name%'";
  
	    $result = mysqli_query($db, $query );
	      @$num_results = mysqli_num_rows($result);
 
	    $num_results = mysqli_num_rows($result);
	      if ($num_results <1)
	      {
	      echo"<h4>The ATO has not provided Tax Transparency data for the companies matching $name</h4>";
	      }
	    else
	    { echo"<div class='source'>Source: From Tax Transparency data published at data.gov.au </div><div class='expand'>";
	     while ($row = $result->fetch_assoc()) 
	        {

	    echo"
   
	   <table class='wide' border='0'><tbody>
	   <tr><td width='150px'>Name            </td><td><a href='tax.php?Recipient=".$row['Name']."'>".$row['Name']."</td></tr>
	   <tr><td>ABN             </td><td><a href='tax.php?ABN=".$row['ABN']."'>".$row['ABN']."</td></tr>
	   <tr><td>Total Income    </td><td>$".number_format($row['Total_Income'])."</td></tr>
	   <tr><td>Taxable Income  </td><td>$".number_format($row['Taxable_Income'])."</td></tr>
	   <tr><td>Tax             </td><td>$".number_format($row['Tax'])."</td></tr>
	    </tbody></table><br> ";
	       }echo"</div>";
	     }
	   }
 
	   ?>
	    <?php
	    if ( isset($_GET['ABN']) && !isset($_GET['Name']) )
	     {
  
	  	   $data = $_GET['ABN']; 
	  	   $ABN=mysqli_real_escape_string ( $db , $data );
	   
	    $query="SELECT * FROM `tax` where ABN='$ABN'";
  
	    $result = mysqli_query($db, $query );
	      @$num_results = mysqli_num_rows($result);
 
	    $num_results = mysqli_num_rows($result);
	      if ($num_results <1)
	      {
	      echo"<h4>The ATO has not provided Tax Transparency data for the ABN $ABN</h4>";
	      }
	    else
	    { echo"<div class='source'>Source: From Tax Transparency data published at data.gov.au </div>";
	     while ($row = $result->fetch_assoc()) 
	        {

	    echo"
   
	   <table class='wide' border='0'><tbody>
	   <tr><td width='150px'>Name            </td><td><a href='tax.php?Recipient=".$row['Name']."'>".$row['Name']."</td></tr>
	   <tr><td>ABN             </td><td><a href='tax.php?ABN=".$row['ABN']."'>".$row['ABN']."</td></tr>
	   <tr><td>Total Income    </td><td>$".number_format($row['Total_Income'])."</td></tr>
	   <tr><td>Taxable Income  </td><td>$".number_format($row['Taxable_Income'])."</td></tr>
	   <tr><td>Tax             </td><td>$".number_format($row['Tax'])."</td></tr>
	    </tbody></table><br> ";
	       }
	     }
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