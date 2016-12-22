<?php
require'header.php';
?>

        <div class="left">
<?php
 if ( isset($_GET['Postcode']) )
 {

 $data = $_GET['Postcode']; 
$postcode=mysqli_real_escape_string ( $db , $data ); 
;
$total = "SELECT Distinct council,electorate FROM `lga_pcode_electorate`  where Postcode='$postcode' ";
$result = mysqli_query($db, $total );
echo"<h4>$postcode is in the";
 while ($row = $result->fetch_assoc()) 
    {

echo"<a href='council.php?Council=".$row['council']."'>".$row['council']."</a> council area which is in the Federal electorate of <a href='electorate.php?Electorate=".$row['electorate']."'>".$row['electorate']."</a></h4> ";
}echo"</p><hr><br>";
}
?>


      <?php
 if ( !isset($_GET['Postcode']) && !isset($_GET['Program']) )
 {
echo"<h3>Total value of 14-15FY Commonwealth grants by Postcode</h3>
<br><p>Top 15 Postcodes by value are below. Click on the electorate name to find details of all grants in that Postcode or enter postcode into the search box to find results
for other Postcodes.</p>";
$grants = "SELECT Locality,Postcode,sum(Funding) FROM grants
 WHERE Electorate!='' && Electorate NOT LIKE'%,%' && Postcode !='Multiple' && Year='2014-15' GROUP BY Postcode ORDER BY sum(Funding) DESC LIMIT 15 ";
$result = mysqli_query($db, $grants );

 echo"<table class='basic' ><tbody>
 <tr>
 <th>Postcode</th>
 <th>Total Value</th>
 </tr>";

 while ($row = $result->fetch_assoc()) 
    {
echo"<tr>
         <td><a href='locality.php?Postcode=".$row['Postcode']."'> ".$row['Postcode']."</a>
         </td><td>".$row['Locality']."</td>
         <td>$".number_format($row['sum(Funding)'])."
         </td>
         </tr>";
    }echo"</tbody></table>";
}
 ?>
  

 <?php
if ( isset($_GET['Postcode']) )
 {
$data = $_GET['Postcode']; 
$postcode=mysqli_real_escape_string ( $db , $data );
$seifa = "SELECT * FROM seifa_by_postcode WHERE Postcode ='$postcode' ";
$result = mysqli_query($db, $seifa );
  @$num_results = mysqli_num_rows($result);
   if ($num_results <1){
        echo"<h4>No SEIFA scores have been calculated by the ABS for $postcode</h4>";
      }

  elseif ($num_results >0)
      {
echo"<h3>Socio Economic (SEIFA) Data for postcode: $postcode</h3>
<table class='council'><tbody><tr><td>National Rank</td><td>National Decile</td><td>Usual Resident Pop</td></tr>";
$seifa = "SELECT * FROM seifa_by_postcode WHERE Postcode ='$postcode' ";
     while ($row = $result->fetch_assoc()) 
            {
              echo"<tr>
              <td style='text-align:right'>Ranked ".number_format($row['rank'])." </td><td>".$row['decile']."/10 </td>
              <td>".number_format($row['URP'])."</td></tr>";

              }
       

                echo"<tr><td tyle='text-align:right'>out of a possible 2,481</td><td>";
                $seifa = "SELECT decile FROM seifa_by_postcode WHERE Postcode ='$postcode' ";
                $result = mysqli_query($db, $seifa );
                 while ($row = $result->fetch_assoc()) 
                    {
                      $iterations=$row['decile'];

                    }

                 $i=0;
                while ($i <= $iterations-1)
                    {
                 echo "<img height='15px' src='icon.png'></img>";
                   $i++;
                    }
      }echo"</td><td></td></tr></tbody></table>";
    
}
?>


    <div class='clear'></div>
  <?php
 if ( isset($_GET['Postcode']) )
 {
  
 
 $data = $_GET['Postcode']; 
$postcode=mysqli_real_escape_string ( $db , $data );

        $test = "SELECT Postcode as test FROM grants 
         WHERE Postcode LIKE'%$postcode%'  ";
        $result = mysqli_query($db, $test );
        @$num_results = mysqli_num_rows($result);
         if ($num_results==0)
              { 
                echo"<h4>There are no Commonwealth grants recorded for the postcode $postcode.</h4>";

              }

  elseif ($num_results >0)

        {
        $grants = "SELECT sum(Funding) as total FROM grants 
         WHERE Postcode LIKE'%$postcode%'  ";
        $result = mysqli_query($db, $grants );
        @$num_results = mysqli_num_rows($result);
        
      
           echo"<br><h3>Statistics for 2014-15 Commonwealth Grants for $postcode</h3>
  <table class='stats'><tbody><tr><th>Total value</th><th>Number</th><th>Average</th></tr>";
               while ($row = $result->fetch_assoc()) 
                    {
                    echo"<th>$".number_format($row['total'])."</th>";
                    }
      
        


            $grant_number = "SELECT count(funding) as grant_number FROM grants 
             WHERE Postcode LIKE'%$postcode%'  ";
            $result = mysqli_query($db, $grant_number);
             while ($row = $result->fetch_assoc()) 
                  { 
                  echo"<th>".number_format($row['grant_number'])."</th>";
                  }
              

                $ave = "SELECT (sum(Funding)/count(funding)) as ave FROM grants 
                 WHERE Postcode LIKE'%$postcode%'  ";
                $result = mysqli_query($db, $ave );
                 while ($row = $result->fetch_assoc()) 
                      {
                      echo"<th>$".number_format($row['ave'])."</th></tr>";
                      }
                      echo"</tbody></table>
                      <br><h3>Breakdown of Commonwealth programs administering grants to $postcode</h3>
                 <p>Click on the program name to get the recipients for that program in $postcode</p>";
                $byprogram = "SELECT *,sum(Funding) FROM grants 
                 WHERE Postcode LIKE'%$postcode%' GROUP BY Program ";
                $result = mysqli_query($db, $byprogram );
                echo"<table style='basic'>
                <tbody>
                <tr><th>Program Name</th><th>Total Value</th></tr>";
                 while ($row = $result->fetch_assoc()) 
                    {
                      
                   
                echo"
                 <tr>
                  
                  <td><a href='locality.php?Program=".$row['Program']."&Postcode=".$row['Postcode']."'>".$row['Program']."</a></td>
                  <td>$".number_format($row['sum(Funding)'])."</td></tr>
                  ";

                   }echo"</tbody></table><br><hr class='short'><br>"; 
  }
            
            
    
}mysqli_free_result($result);

        ?>

       


 

 

 </div>
 <div class='right'>


 <?php
 if ( isset($_GET['Postcode']) && !isset($_GET['Program']) )
 {
  
  $postcode = $_GET['Postcode']; 
                   



$agor = "SELECT * FROM grants 
 WHERE Postcode LIKE'%$postcode%' order by Funding DESC";
$result = mysqli_query($db, $agor );
@$num_results = mysqli_num_rows($result);
         if ($num_results>0)
              { 
                 echo"<h4>Details of grant recipients in $postcode for all Commonwealth programs</h2>";
 while ($row = $result->fetch_assoc()) 
    {
      
   
include'grants_table.php';

}
}

    
}mysqli_free_result($result);

        ?>
  

 <?php
 if ( isset($_GET['Postcode']) && isset($_GET['Program']))
 {
  
  $postcode = $_GET['Postcode']; 
  $program = $_GET['Program']; 
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);

 echo"<h4>Grant recipients for $program in Postcode $postcode</h2>";
$agor = "SELECT * FROM grants 
 WHERE Postcode LIKE'%$postcode%' && Program LIKE'%$program%' ";
$result = mysqli_query($db, $agor );
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"<table class='basic' ><tbody>
 
 
  <tr><td>Program:</td><td><a href='locality.php?Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
  <tr><td>Recipient</td><td><a href='locality.php?Recipient=".$row['Recipient']."'>".$row['Recipient']."</a></td></tr>
  <tr><td>Component:</td><td>".$row['Component']."</td></tr>
  <tr><td>Purpose:</td><td>".$row['Purpose']."</td></tr>
  <tr><td>Dates:</td><td>".$row['Approved']."-".$row['End']." months</td></tr>
  <tr><td><td></td><td><span style='float:right'>$".number_format($row['Funding'])."</span></td></tr>
  

 </tbody></table><br>";

}

    
}mysqli_free_result($result);

        ?>

  

 
<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?sensor=false'></script>
<script type='text/javascript'>


    <?php
      
 if (  isset($_GET['Program']) && !isset($_GET['Postcode'])  )
 {
$program=$_GET['Program'];
$map = "SELECT Lat, Lon, Pcode,State,Locality FROM postcodes_table where 
 Pcode IN (SELECT Postcode from grants where Postcode LIKE('%$postcode%') && Year='2014-15' ) ORDER BY Pcode ";
       $result = mysqli_query($db, $map);
 
    echo" var markers = [";
      while ($row = $result->fetch_assoc())
          
 {
       echo
       " {
        \"title\": \"".$row['Locality']."\",
        \"lat\": \"".$row['Lat']."\",
        \"lng\": \"".$row['Lon']."\",
        \"description\": \"".$row['Locality']." <a href='locality.php?Program=".$_GET['Program']."&Postcode=".$row['Pcode']."'>".$row['Pcode']."</a> \"
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
            zoom: 4,
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
                    infoWindow.setContent("<div style = 'width:200px;min-height:40px'>" + data.description + "</div>");
                    infoWindow.open(map, marker);
                });
            })(marker, data);
        }
    }
</script>
<script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBi_5tk-gJ3wLBKhYh95OKsfTxWV-FOSnI&callback=initMap">
</script>
<div id="Map" style="width: 700px; height: 500px">
</div><hr><br>
<div class='clear'></div>
  
   

</div></div>
<div class='clear'></div>



    <?php 
    include('footer.php');?>

    </body>
</html>