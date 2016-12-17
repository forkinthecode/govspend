<!--Budget Home-->
 <!DOCTYPE HTML>
<html lang="en">
  <head>
<meta charset="UTF-8">
    <title>Little Bird</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Rosie Williams">
    </head>
    <body>
<?php


include('login.php');
//include('../inclusions.php');

include('styles.php');


 
    

?>

  
        
                     
 
  <div class="jumbotron"> 
     
<?php
     include('nav.php');

     ?>
  
        </div>
          
       

          <div class='clear'></div>
<div class="page_width">


        <div class="left">

 


<?php
if ( isset($_GET['Council']) )
 {
$data = $_GET['Council']; 
$council=mysqli_real_escape_string ( $db , $data );
echo"<h3>Socio Economic (SEIFA) Data for LGA: $council</h3>
<table class='council'><tbody><tr><td>National Rank</td><td>National Decile</td><td>Usual Resident Pop</td></tr>";
$seifa = "SELECT * FROM SEIFA_LGA WHERE Council ='$council' ";
$result = mysqli_query($db, $seifa );
 while ($row = $result->fetch_assoc()) 
    {
      echo"<tr>
      <td>".$row['Nat_Rank']."/564</td><td>".$row['Nat_Decile']."/10 </td>
      <td>".number_format($row['URP'])."</td></tr>";

    }
  }

?>

<?php
if ( isset($_GET['Council']) )
 {
$data = $_GET['Council']; 
$council=mysqli_real_escape_string ( $db , $data );
echo"<tr><td></td><td>";
$seifa = "SELECT Nat_Decile FROM SEIFA_LGA WHERE Council ='$council' ";
$result = mysqli_query($db, $seifa );
 while ($row = $result->fetch_assoc()) 
    {
      $iterations=$row['Nat_Decile'];

    }

 $i=0;
while ($i <= $iterations-1)
{
 echo "<img height='15px' src='icon.png'></img>";
   $i++;
    }
  }echo"</td><td></td></tr></tbody></table>";

?>

<?php
 if ( !isset($_GET['Council']) )
 { 
echo"<h4>Total Commonwealth Grants by Council Area</h4>";
$total = "SELECT *,sum(Funding) FROM `grants` WHERE  Year='2014-15' && Council!=''
 GROUP BY Council ORDER BY sum(Funding) DESC ";
$result = mysqli_query($db, $total );
 while ($row = $result->fetch_assoc()) 
    {

echo"

<table class='basic' ><tbody>
 
  <tr><td><a href='council.php?Council=".$row['Council']."'>".$row['Council']."</a></td>
     <td><span style='float:right'>$".number_format($row['sum(Funding)'])."</span></td></tr>
 </tbody></table><br><hr class='short'><br> ";
    }
}
?>
 




  
           

      

 

 

 </div>
 <div class='right'>
  <?php
  echo" <h2>Council Search</h2>
  <div class='content'>
     <form action='council.php'  method='GET'>
    <lable for='council'>
      <select name='Council' >";
$seifa = "SELECT DISTINCT Council FROM grants where Council NOT LIKE'%,%' && Council !=''  ORDER BY Council";
$result = mysqli_query($db, $seifa );
 while ($row = $result->fetch_assoc()) 
    {
   
  echo"<option>  ".$row['Council']."  </option>";
}
echo"
        </select></lable> 
         <lable for='submit'><input type='submit' name='submit' value='Go' id='submit' /></lable>
   </p>
      </form>
  
    </div>";

    ?>
  



   <?php
 if ( isset($_GET['Electorate']) && isset($_GET['Program'])  )
 {
  
   $electorate = $_GET['Electorate']; 
   $program = $_GET['Program']; 
  echo"<h4>$program recpients in the Federal Electorate of $electorate</h4>";
$total = "SELECT *, DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term  FROM `grants` where 
          Year='2014-15' && Electorate like'%$electorate%' && Program like'%$program%'  ";
$result = mysqli_query($db, $total );
 while ($row = $result->fetch_assoc()) 
    {

echo"

<table class='basic' ><tbody>
 <tr><td>Portfolio:</td><td>".$row['Portfolio']."</td></tr>
 <tr><td>Agency:</td><td>".$row['Agency']."</td></tr>
  <tr><td>Program:</td><td><a href='electorate.php?Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
  <tr><td>Component:</td><td>".$row['Component']."</td></tr>
  <tr><td>Purpose:</td><td>".$row['Purpose']."</td></tr>

  <tr><td>Recipient:</td><td><a href='portfolio.php?Recipient=".$row['Recipient']."'>".$row['Recipient']."</a></td></tr>
  <tr><td>Address:</td><td>".$row['Locality'].", <a href='locality.php?Postcode=".$row['Postcode']."'>".$row['Postcode']."</a></td></tr>
  <tr><td>Dates:</td><td>".$row['Approved']."-".$row['End']." (".number_format($row['Term'])."months) <span style='float:right'>Month:$".number_format($row['Funding']/$row['Term'])."</span></td></tr>
  <tr><td></td><td><span style='float:right'>Total: $".number_format($row['Funding'])."</span></td></tr>
 </tbody></table><br><hr class='short'><br> ";
}
}
?>

 <script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?sensor=false'></script>
<script type='text/javascript'>


    <?php
      
 if (  isset($_GET['Electorate']) && !isset($_GET['Postcode'])  )
 {
$electorate=$_GET['Electorate'];
$map = "SELECT Lat, Lon, Pcode,State,Locality FROM postcodes_table where 
 Pcode IN (SELECT Postcode from grants where Electorate LIKE('%$electorate%') && Year='2014-15' ) ORDER BY Pcode ";
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
            zoom: 6,
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
<div id="Map" style="width: 500px; height: 500px">
</div><hr><br>
<div class='clear'></div>
         
        

  
   

</div></div>

 <?php 
    include('footer.php');?>

    </body>
</html>