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
 if ( isset($_GET['Electorate']) )
 {
  
$data = $_GET['Electorate']; 
$electorate=mysqli_real_escape_string ( $db , $data );
//echo"<h4>Federal Electorate details for $electorate </h4>";
$total = "SELECT * FROM `lga_pcode_electorate`  where Electorate ='$electorate' GROUP  by Electorate ";
$result = mysqli_query($db, $total );
include'electorate_details.php';
}
?>

<?php
 if ( isset($_GET['Electorate']) )
 {
  
$electorate = $_GET['Electorate']; 
echo"
<h4>Local Government Areas included in $electorate </h4>";
$total = "SELECT Distinct council FROM `lga_pcode_electorate`  where Electorate='$electorate' ";
$result = mysqli_query($db, $total );
echo"<p>";
 while ($row = $result->fetch_assoc()) 
    {

echo"


   <a href='council.php?Council=".$row['council']."'>".$row['council']."</a> |
   
 ";
}echo"</p><hr><br>";
}
?>

<?php
 if ( !isset($_GET['Electorate']) )
 {
  
$electorate = $_GET['Electorate']; 
echo"<h4>Total Commonwealth Grants by Electorate</h4>";
$total = "SELECT Electorate,sum(Funding) FROM `grants` where electorate !='' && Year='2014-15' Group by electorate ";
$result = mysqli_query($db, $total );
 while ($row = $result->fetch_assoc()) 
    {

echo"

<table class='basic' ><tbody>
 
  <tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td><td><span style='float:right'>$".number_format($row['sum(Funding)'])."</span></td></tr>
 </tbody></table><br><hr class='short'><br> ";
}
}
?>
 <?php
 if ( isset($_GET['Electorate']) )
 {
  
 $data = $_GET['Electorate']; 
$electorate=mysqli_real_escape_string ( $db , $data );
  echo"<h4>All Commonweatlh Grants for recpients in the Federal Electorate of $electorate</h4>";
$total = "SELECT Program,sum(Funding) FROM `grants` WHERE  Year='2014-15' && Electorate ='$electorate'  Group by Program  ";
$result = mysqli_query($db, $total );
 while ($row = $result->fetch_assoc()) 
    {

echo"

<table class='basic' ><tbody>

  <tr><td><span style='float:right'>$".number_format($row['sum(Funding)'])."</span></td><td><a href='electorate.php?Electorate=$electorate&Program=".$row['Program']."'>".$row['Program']."</a></td>
  </tr>
 </tbody></table><br><hr class='short'><br> ";
}
}
?>


 <?php
 if ( isset($_GET['Electorate']) )
 {
  
  $electorate = $_GET['Electorate']; 
  echo"<h4>All Commonweatlh Grants for recpients in the Federal Electorate of $electorate</h4>";
$total = "SELECT *, DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term  FROM `grants` where  Year='2014-15' && Electorate ='$electorate'  ";
$result = mysqli_query($db, $total );
 while ($row = $result->fetch_assoc()) 
    {

echo"

<table class='basic' ><tbody>
  <tr><td>Portfolio:</td><td>".$row['Portfolio']."</td></tr>
  <tr><td>Agency:</td><td>".$row['Agency']."</td></tr>
  <tr><td>Program:</td><td><a href='electorate.php?Program=".$row['Program']."&electorate=$electorate'>".$row['Program']."</a></td></tr>
  <tr><td>Component:</td><td>".$row['Component']."</td></tr>
  <tr><td>Purpose:</td><td>".$row['Purpose']."</td></tr>

  <tr><td>Recipient:</td><td><a href='recipient.php?Recipient=".$row['Recipient']."'>".$row['Recipient']."</a></td></tr>
  <tr><td>Address:</td><td>".$row['Locality'].", <a href='locality.php?Postcode=".$row['Postcode']."'>".$row['Postcode']."</a></td></tr>
  <tr><td>Dates:</td><td>".$row['Approved']."-".$row['End']." (".number_format($row['Term'])."months) <span style='float:right'>Month:$".number_format($row['Funding']/$row['Term'])."</span></td></tr>
  <tr><td></td><td><span style='float:right'>Total: $".number_format($row['Funding'])."</span></td></tr>
 </tbody></table><br><hr class='short'><br> ";
}
}
?>




  
           

      

 

 

 </div>
 <div class='right'>
  
<!--<div class='box'>
<p>Click on <a class='button' href='#popup_search'>Quick Search</a> to choose electorate <img src='outcome_search_large.png' height='40px'></img> </p> 
</div>
<div id='popup_search'  class='overlay'>
<div class='popup_search'>
<div class='content' >-->
    <h2>Electorate Search</h2>
  
    <div class='content'>
     <form action='electorate.php'  method='GET'>
    <lable for='electorate'>
      <select name='Electorate' >
    
      <option>  Adelaide  </option>
      <option>  Aston </option>
      <option>  Ballarat  </option>
      <option>  Banks </option>
      <option>  Barker  </option>
      <option>  Barton  </option>
      <option>  Bass  </option>
      <option>  Batman  </option>
      <option>  Bendigo </option>
      <option>  Bennelong </option>
      <option>  Berowra </option>
      <option>  Blair </option>
      <option>  Blaxland  </option>
      <option>  Bonner  </option>
      <option>  Boothby </option>
      <option>  Bowman  </option>
      <option>  Braddon </option>
      <option>  Bradfield </option>
      <option>  Brand </option>
      <option>  Brisbane  </option>
      <option>  Bruce </option>
      <option>  Calare  </option>
      <option>  Calwell </option>
      <option>  Canberra  </option>
      <option>  Canning </option>
      <option>  Capricornia </option>
      <option>  Casey </option>
      <option>  Charlton  </option>
      <option>  Chifley </option>
      <option>  Chisholm  </option>
      <option>  Cook  </option>
      <option>  Corangamite </option>
      <option>  Corio </option>
      <option>  Cowan </option>
      <option>  Cowper  </option>
      <option>  Cunningham  </option>
      <option>  Curtin  </option>
      <option>  Dawson  </option>
      <option>  Deakin  </option>
      <option>  Denison </option>
      <option>  Dickson </option>
      <option>  Dobell  </option>
      <option>  Dunkley </option>
      <option>  Durack  </option>
      <option>  Eden-Monaro </option>
      <option>  Fadden  </option>
      <option>  Fairfax </option>
      <option>  Farrer  </option>
      <option>  Fisher  </option>
      <option>  Flinders  </option>
      <option>  Flynn </option>
      <option>  Forde </option>
      <option>  Forrest </option>
      <option>  Fowler  </option>
      <option>  Franklin  </option>
      <option>  Fraser  </option>
      <option>  Fremantle </option>
      <option>  Gellibrand  </option>
      <option>  Gilmore </option>
      <option>  Gippsland </option>
      <option>  Goldstein </option>
      <option>  Gorton  </option>
      <option>  Grayndler </option>
      <option>  Greenway  </option>
      <option>  Grey  </option>
      <option>  Griffith  </option>
      <option>  Groom </option>
      <option>  Hasluck </option>
      <option>  Herbert </option>
      <option>  Higgins </option>
      <option>  Hindmarsh </option>
      <option>  Hinkler </option>
      <option>  Holt  </option>
      <option>  Hotham  </option>
      <option>  Hughes  </option>
      <option>  Hume  </option>
      <option>  Hunter  </option>
      <option>  Indi  </option>
      <option>  Isaacs  </option>
      <option>  Jagajaga  </option>
      <option>  Kennedy </option>
      <option>  Kingsford Smith </option>
      <option>  Kingston  </option>
      <option>  Kooyong </option>
      <option>  La Trobe  </option>
      <option>  Lalor </option>
      <option>  Leichhardt  </option>
      <option>  Lilley  </option>
      <option>  Lindsay </option>
      <option>  Lingiari  </option>
      <option>  Longman </option>
      <option>  Lyne  </option>
      <option>  Lyons </option>
      <option>  Macarthur </option>
      <option>  Mackellar </option>
      <option>  Macquarie </option>
      <option>  Makin </option>
      <option>  Mallee  </option>
      <option>  Maranoa </option>
      <option>  Maribyrnong </option>
      <option>  Mayo  </option>
      <option>  McEwen  </option>
      <option>  McMahon </option>
      <option>  McMillan  </option>
      <option>  McPherson </option>
      <option>  Melbourne </option>
      <option>  Melbourne Ports </option>
      <option>  Menzies </option>
      <option>  Mitchell  </option>
      <option>  Moncrieff </option>
      <option>  Moore </option>
      <option>  Moreton </option>
      <option>  Murray  </option>
      <option>  New England </option>
      <option>  Newcastle </option>
      <option>  North Sydney  </option>
      <option>  OConnor </option>
      <option>  Oxley </option>
      <option>  Page  </option>
      <option>  Parkes  </option>
      <option>  Parramatta  </option>
      <option>  Paterson  </option>
      <option>  Pearce  </option>
      <option>  Perth </option>
      <option>  Petrie  </option>
      <option>  Port Adelaide </option>
      <option>  Rankin  </option>
      <option>  Reid  </option>
      <option>  Richmond  </option>
      <option>  Riverina  </option>
      <option>  Robertson </option>
      <option>  Ryan  </option>
      <option>  Scullin </option>
      <option>  Shortland </option>
      <option>  Solomon </option>
      <option>  Stirling  </option>
      <option>  Sturt </option>
      <option>  Swan  </option>
      <option>  Sydney  </option>
      <option>  Tangney </option>
      <option>  Throsby </option>
      <option>  Wakefield </option>
      <option>  Wannon  </option>
      <option>  Warringah </option>
      <option>  Watson  </option>
      <option>  Wentworth </option>
      <option>  Werriwa </option>
      <option>  Wide Bay  </option>
      <option>  Wills </option>
      <option>  Wright  </option>
        </select></lable> 
         <lable for='submit'><input type='submit' name='submit' value='Go' id='submit' /></lable>
   </p>
      </form>
  
    </div>
    <!--  <a class='close' href='#'>Close</a>
  </div>
</div>-->



   <?php
 if ( isset($_GET['Electorate']) && isset($_GET['Program'])  )
 {
  
   $electorate = $_GET['Electorate']; 
   $program = $_GET['Program']; 
  echo"<h4>$program recpients in the Federal Electorate of $electorate</h4>";
$total = "SELECT *, DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term  FROM `grants` where 
          Year='2014-15' && Electorate ='$electorate'&& Program like'%$program%'  ";
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
<div class='clear'></div>

   <?php 
    include('footer.php');?>

    </body>
</html>