<?php
require'header.php';
?>



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
  @$num_results = mysqli_num_rows($result);
  if ($num_results >0)
{
  //echo"<tr><td>No SEIFA results</td><td>for $council</td><td></td></tr>";
 while ($row = $result->fetch_assoc()) 
    {
      echo"<tr>
      <td>".$row['Nat_Rank']."/564</td><td>".$row['Nat_Decile']."/10 </td>
      <td>".number_format($row['URP'])."</td></tr>";
    }
  }
     elseif ($num_results <1)
    
  echo"<h4>No SEIFA results for $council</h4>";
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
if ( isset($_GET['Council']) )
 {
$data = $_GET['Council']; 
$council=mysqli_real_escape_string ( $db , $data );
$query="SELECT sum(Age_pension+PPP+PPS+Newstart+DSP+Austudy+Carer_Payment+YA_SA+YAO) as total
 FROM lga_welfare where council='$council'";
$result = mysqli_query($db, $query);
 while ($row = $result->fetch_assoc())
 {
$total_on_welfare=$row['total'];
//echo"$total_on_welfare<br>";
  }
$query="SELECT URP FROM SEIFA_LGA
where council='$council'";
$result = mysqli_query($db, $query);
echo"<br><table class='council'><tbody><tr><td><span class='tiny'>Population</span></td><td><span class='tiny'>Welfare Recipients</span></td><td><span class='tiny'>Perecentage</span></td></tr>";
 while ($row = $result->fetch_assoc())
 {
$URP=$row['URP'];
//echo"$URP<br>";
  }
  echo"<tr><td>".number_format($URP)."</td><td>".number_format($total_on_welfare)."</td><td>".number_format($total_on_welfare/$URP*100/1)."%</td></tr>";
echo"</tbody></table><div class='source'><a href=http://www.abs.gov.au/AUSSTATS/abs@.nsf/DetailsPage/2033.0.55.0012011?OpenDocument'>SEIFA data</a> calculated by the ABS from 2011 Census data</div><br>";

}

?>
<?php
if ( isset($_GET['Council']) )
 {
$data = $_GET['Council']; 
$council=mysqli_real_escape_string ( $db , $data );
echo"<h3>Breakdown by Payment Type</h3> <div class='source'>Source: DSS Payment by Demographic published at 
	<a href='http://data.gov.au/dataset/dss-payment-demographic-data'>data.gov.au</a></div> 
<table class='council'><tbody><tr><td>Payment Name</td><td>Number in Receipt</td></tr>";
$seifa = "SELECT * FROM lga_welfare WHERE Council LIKE'%$council%' ";
$result = mysqli_query($db, $seifa );
  @$num_results = mysqli_num_rows($result);
  if ($num_results <1)
  echo"<tr><td>No SEIFA results</td><td>for $council</td><td></td></tr>";
 while ($row = $result->fetch_assoc()) 
    {
       echo"
      <tr><td>Age Pension</td><td>".number_format($row['Age_Pension'])." </td></tr>
      <tr><td>FTB A</td><td>".number_format($row['FTB_A'])." </td></tr>
      <tr><td>FTB B</td><td>".number_format($row['FTB_B'])." </td></tr>
      <tr><td>Parent Payment Partnered</td><td>".number_format($row['PPP'])." </td></tr>
      <tr><td>Parent Payment Single</td><td>".number_format($row['PPS'])." </td></tr>
      <tr><td>NewStart</td><td>".number_format($row['Newstart'])." </td></tr>
      <tr><td>Disability Pension</td><td>".number_format($row['DSP'])." </td></tr>
      <tr><td>Austudy</td><td>".number_format($row['Austudy'])." </td></tr>
      <tr><td>Carers Payment</td><td>".number_format($row['Carer_Payment'])." </td></tr>
      <tr><td>Youth Allowance</td><td>".number_format(($row['YA_SA']+$row['YAO']))." </td></tr>


      ";

    }
    echo"</tbody></table>";
  }

?>



<?php
 if ( !isset($_GET['Council']) )
 { 
echo"<h4>Total Commonwealth Grants by Council Area</h4><div class='source'>Source: Grants data published at agency websites</div><table class='basic' ><tbody> ";
$total = "SELECT *,sum(Funding) FROM `grants` WHERE  Year='2015-16' && Council!=''
 GROUP BY Council ORDER BY sum(Funding) DESC ";

$result = mysqli_query($db, $total );
 while ($row = $result->fetch_assoc()) 
    {

echo"
 

 
  <tr> <td><span style='float:right'>$".number_format($row['sum(Funding)'])."</span></td>
  <td ><a href='council.php?Council=".$row['Council']."'>".$row['Council']."</a></td>
    </tr>
 ";
    }echo"</tbody></table><br>";
}
?>
 
<?php
if ( isset($_GET['Council']) )
 {
$data = $_GET['Council']; 
$council=mysqli_real_escape_string ( $db , $data );
echo"<br><hr><h4>Commonwealth Grants totalled by Program</h4> 
	<div class='source'>Source: Grants data published at agency websites</div> ";

$council_result = "SELECT *,sum(Funding) FROM grants WHERE Council LIKE'%$council%' && Year='2015-16' GROUP BY Program ";
$result = mysqli_query($db, $council_result );
  @$num_results = mysqli_num_rows($result);
  if ($num_results <1)
  {
  echo"<h4>There are no Commonwealth grant recipients with addresses in the $council council area</h4>";
	  }

  if ($num_results >0)
	  echo"<table class='basic'><tbody>";
  {

 while ($row = $result->fetch_assoc()) 
    {

echo"<tr>
  <td>
       <img style='height:15px; opacity:0.4' src='images/chevron.png'></img>
  </td>
  <td>
      <a href='council.php?Council=$council&Program=".$row['Program']."'>".$row['Program']."</a>
  </td>
  <td>
        $".number_format($row['sum(Funding)'])."
  </td>
  </tr>
";
}echo" </tbody></table><br>";
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
$seifa = "SELECT DISTINCT Council FROM grants where Council NOT LIKE'%,%' && Council !=''  ORDER BY Council
";
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
 if ( isset($_GET['Council']) && isset($_GET['Program'])  )
 {
  
   $council = $_GET['Council']; 
   $program = $_GET['Program']; 
  echo"<h4>$program recpients in the Local Government Area of $council</h4>";
$total = "SELECT *,DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term  FROM `grants` 
         WHERE Program like'%$program%' && Year='2015-16' && Council ='$council'
            ";
$result = mysqli_query($db, $total );
echo" <div class='source'>Source: Grants data published at agency websites</div> ";
 while ($row = $result->fetch_assoc()) 
    {

include'grants_table.php';
}
}
?>
<?php
if ( !isset($_GET['Council']) )
 {



$welfare_total = "SELECT council,sum(Age_pension+PPP+PPS+Newstart+DSP+Austudy+Carer_Payment+YA_SA+YAO) as total 
FROM lga_welfare GROUP BY council ORDER BY 
 sum(Age_pension+PPP+PPS+Newstart+DSP+Austudy+Carer_Payment+YA_SA+YAO) DESC ";
$result = mysqli_query($db, $welfare_total );
echo"<table class='council'><tbody><tr><td>Council</td><td>Welfare Recipients</td></tr>";
  @$num_results = mysqli_num_rows($result);
  if ($num_results >0)
  
 while ($row = $result->fetch_assoc()) 
    {
      echo"
    
<tr><td><a href='council.php?Council=".$row['council']."'>".$row['council']."</a></td>
<td>".number_format($row['total'])."</td></tr>";

      

    }
    echo"</tbody></table>";
  }

?>
 <script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?sensor=false'></script>
<script type='text/javascript'>


    <?php
      
 if (  isset($_GET['Council']) && !isset($_GET['Program'])  )
 {

$map = "SELECT Lat, Lon, Pcode,State,Locality FROM coordinates where Pcode IN (SELECT Postcode from grants 
	where Council ='$council' && Year='2015-16' && Locality !=',') ORDER BY Pcode ";
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
            zoom: 7,
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