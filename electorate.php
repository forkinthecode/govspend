<?php
require'header.php';
?>



        <div class="left">

 

<?php
 if ( isset($_GET['Electorate']) )
 {
	 
$data = $_GET['Electorate']; 
$electorate=mysqli_real_escape_string ( $db , $data );
$total = "SELECT * FROM `lga_pcode_electorate`  where Electorate ='$electorate' GROUP BY Electorate ";
$result = mysqli_query($db, $total );

include'electorate_details.php';
}
?>
<div class='clear'></div>

<?php
 if ( isset($_GET['Electorate']) )
 {
	 
$data = $_GET['Electorate']; 
$electorate=mysqli_real_escape_string ( $db , $data );

echo"<h3>SEIFA scores for $electorate</h3><br><hr><table class='stats'>
<tbody>
<tr>
<th>National Rank</th>
<th>National Decile</th>
<th></th>
</tr>";
$seifa = "SELECT AVG(rank) AS rank,AVG(decile) AS decile FROM `lga_pcode_electorate` 
join seifa_by_postcode on lga_pcode_electorate.postcode=seifa_by_postcode.postcode where Electorate='$electorate'";
$result = mysqli_query($db, $seifa );

  @$num_results = mysqli_num_rows($result);
  while ($row = $result->fetch_assoc()) 
    {
      echo"<tr><th>".number_format($row['rank'])."</th><th>".number_format($row['decile'])."/10 </th>";
    }
}
?>
     
  <?php
  if ( isset($_GET['Electorate']) )
  {
	$data = $_GET['Electorate']; 
	$electorate=mysqli_real_escape_string ( $db , $data );

$seifa = "SELECT AVG(decile) as decile FROM seifa_by_postcode JOIN lga_pcode_electorate on 
	seifa_by_postcode.postcode=lga_pcode_electorate.postcode WHERE Electorate ='$electorate' ";
$result = mysqli_query($db, $seifa );
echo"<th>";
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
  }echo"</th></tr></tbody></table>";
?>



<?php
 if ( isset($_GET['Electorate']) )
 {
  
$electorate = $_GET['Electorate']; 
echo"<div class='clear'></div><hr>
<h4>Local Government Areas included in $electorate </h4>";
$total = "SELECT Distinct council FROM `lga_pcode_electorate`  where Electorate='$electorate' ";
$result = mysqli_query($db, $total );
echo"<p>";
 while ($row = $result->fetch_assoc()) 
    {

echo"<a href='council.php?Council=".$row['council']."'>".$row['council']."</a> | ";
}echo"</p><hr><br>";
}
?>

<?php
 if ( !isset($_GET['Electorate']) )
 {
  
$electorate = $_GET['Electorate']; 
echo"<h4>Total Commonwealth Grants by Electorate</h4>";
$total = "SELECT Electorate,sum(Funding) FROM `grants` where electorate !='' && Year='2015-16' Group by electorate ";
$result = mysqli_query($db, $total );
echo"<div class='expand'><table class='grants' ><tbody>";
 while ($row = $result->fetch_assoc()) 
    {

echo"


 
  <tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td><td><span style='float:right'>$".number_format($row['sum(Funding)'])."</span></td></tr>
 ";
}echo"</tbody></table><br></div> ";
}
?>
<?php
if ( isset($_GET['Electorate']) &&  !isset($_GET['Program']) )
 {
$data = $_GET['Electorate']; 
$electorate=mysqli_real_escape_string ( $db , $data );
$query="SELECT sum(Age_pension+PPP+PPS+Newstart+DSP+Austudy+Carer_Payment+YA_SA+YAO) as total
 FROM welfare_by_electorate where electorate='$electorate'";
$result = mysqli_query($db, $query);
 while ($row = $result->fetch_assoc())
 {
$total_on_welfare=$row['total'];
//echo"$total_on_welfare<br>";
  }

  echo"<br><table class='council'><tbody><tr><td><span class='tiny'>Population</span></td><td><span class='tiny'>Welfare Recipients</span></td><td><span class='tiny'>Perecentage</span></td></tr>";
  
  echo"<tr><td>150,000</td><td>".number_format($total_on_welfare)."</td><td>".number_format(($total_on_welfare/150000)*100/1)."%</td></tr>";

}
echo"</tbody></table><br>";

?>
 <?php
 if ( isset($_GET['Electorate']) )
 {
  
 $data = $_GET['Electorate']; 
$electorate=mysqli_real_escape_string ( $db , $data );
  echo"<h4>All Commonweatlh Grants for recpients in the Federal Electorate of $electorate</h4>";
$total = "SELECT Program,sum(Funding) FROM `grants` WHERE  Year='2015-16' && Electorate ='$electorate'  Group by Program  ";
$result = mysqli_query($db, $total );
echo"<table class='basic' ><tbody>";
 while ($row = $result->fetch_assoc()) 
    {

echo"<tr><td><span style='float:right'>$".number_format($row['sum(Funding)'])."</span></td>
	<td><a href='electorate.php?Electorate=$electorate&Program=".$row['Program']."'>".$row['Program']."</a></td>
  </tr>";
}echo" </tbody></table><br><p>Click on the Program name to see details of grants in $electorate for that Program</p>
	<hr class='short'><br> ";
}
?>



  
           

      

 

 

 </div>
 <div class='right'>
  

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
 
      </form>
  
    </div>
 

 <?php/*
 if ( isset($_GET['Electorate']) )
 {
  
  $electorate = $_GET['Electorate']; 
  echo"<h4>All Commonweatlh Grants for recpients in the Federal Electorate of $electorate</h4>";
$total = "SELECT *, DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term  FROM `grants` where  Year='2015-16' && Electorate ='$electorate'  ";
$result = mysqli_query($db, $total );
//echo"<table class='basic' ><tbody>";
 while ($row = $result->fetch_assoc()) 
    {

echo"<table class='basic'><tbody>
  <tr><td>Portfolio:</td>       <td>".$row['Portfolio']."</td></tr>
  <tr><td>Agency:</td>          <td>".$row['Agency']."</td></tr>
  <tr><td>Program:</td>         <td><a href='electorate.php?Program=".$row['Program']."&electorate=$electorate'>".$row['Program']."</a></td></tr>
  <tr><td>Component:</td>       <td>".$row['Component']."</td></tr>
  <tr><td>Purpose:</td>         <td>".$row['Purpose']."</td></tr>
  <tr><td>Recipient:</td>       <td><a href='recipient.php?Recipient=".$row['Recipient']."'>".$row['Recipient']."</a></td></tr>
  <tr><td>Address:</td>         <td>".$row['Locality'].", <a href='locality.php?Postcode=".$row['Postcode']."'>".$row['Postcode']."</a></td></tr>
  <tr><td>Dates:</td>           <td>".$row['Approved']."-".$row['End']." (".number_format($row['Term'])."months) <span style='float:right'>Month:$".number_format($row['Funding']/$row['Term'])."</span></td></tr>
  <tr><td></td>                 <td><span style='float:right'>Total: $".number_format($row['Funding'])."</span></td></tr>
  </tbody></table><br>
 ";
} //echo"</tbody></table><br><hr class='short'><br>";
}*/
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
          Year='2015-16' && Electorate ='$electorate'&& Program like'%$program%'  ";
$result = mysqli_query($db, $total );

 while ($row = $result->fetch_assoc()) 
    {
echo"<table class='basic'><tbody>";
echo"
 <tr><td>Portfolio:</td>    <td>".$row['Portfolio']."</td></tr>
 <tr><td>Agency:</td>       <td>".$row['Agency']."</td></tr>
  <tr><td>Program:</td>     <td><a href='electorate.php?Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
  <tr><td>Component:</td>   <td>".$row['Component']."</td></tr>
  <tr><td>Purpose:</td>     <td>".$row['Purpose']."</td></tr>
  <tr><td>Recipient:</td>   <td><a href='recipient.php?Recipient=".$row['Recipient']."'>".$row['Recipient']."</a></td></tr>
  <tr><td>Address:</td>     <td>".$row['Locality'].", <a href='locality.php?Postcode=".$row['Postcode']."'>".$row['Postcode']."</a></td></tr>
  <tr><td>Dates:</td>       <td>".$row['Approved']."-".$row['End']." (".number_format($row['Term'])."months) <span style='float:right'>Month:$".number_format($row['Funding']/$row['Term'])."</span></td></tr>
  <tr><td></td>             <td><span style='float:right'>Total: $".number_format($row['Funding'])."</span></td></tr>
  ";
  echo" </tbody></table><br>";
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
 Pcode IN (SELECT Postcode from grants where Electorate ='$electorate' && Year='2015-16' ) ORDER BY Pcode ";
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
            zoom: 10,
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
<div id="Map" style="width: 500px; height: 500px;background:#eee">
</div><hr><br>
<div class='clear'></div>
  



</div></div>
<div class='clear'></div>
<?php 
    include('footer.php');?>

    </body>
</html>