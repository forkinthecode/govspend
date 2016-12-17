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
echo"<h4>Federal Electorate details for $electorate </h4>";
$total = "SELECT * FROM `lga_pcode_electorate`  where Electorate LIKE'%$electorate%' group by Electorate ";
$result = mysqli_query($db, $total );
 echo"<div class='wide'>";
 while ($row = $result->fetch_assoc()) 
    {

    
echo"<div class='reps'><img src='".$row['url']."'></img></div>
<table><tbody>
<tr><td><h3>Electorate</h3></td><td><h3>".$row['electorate']."</h3></td></tr>
<tr><td><h3>Party</h3></td><td><h3>".$row['party']."</h3></td></tr>
<tr><td><h3>Name</h3></td><td><h3>".$row['name']."</h3></td></tr>
</tbody></table>";
    }
  echo"</div><br><hr>"; 
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


   <a href='council.php?council=".$row['council']."<'>".$row['council']."</a> |
   
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
$total = "SELECT Program,sum(Funding) FROM `grants` WHERE  Year='2014-15' && Electorate LIKE'%$electorate%'  Group by Program  ";
$result = mysqli_query($db, $total );
 while ($row = $result->fetch_assoc()) 
    {

echo"

<table class='basic' ><tbody>

  <tr><td><a href='electorate.php?Electorate=$electorate&Program=".$row['Program']."'>".$row['Program']."</a></td><td><span style='float:right'>$".number_format($row['sum(Funding)'])."</span></td></tr>
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
         DATEDIFF(END,APPROVED)/30 AS Term  FROM `grants` where  Year='2014-15' && Electorate like'%$electorate%'   ";
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




    <?php
       // if(isset($_GET['table']) && !isset($_GET['portfolio']) && !isset($_GET['agency']) && !isset($_GET['program']) && !isset($_GET['outcome'])  && !isset($_GET['search_term']))
        
        {
echo"<br>Commonwealth Grants & Tenders by Postcode
          <form action='' target='_blank' method='GET'>

            <input type='text'  id='postcode' name='postcode' value='postcode' />
              

        
             <input type='submit' name='submit' value='All Results' id='submit' />
 
  
   
          </form>Find agency by key word:
          <form action='' target='_blank' method='GET'>

            <input type='text'  id='agency' name='agency' value='health' />
              

        <input type='hidden'  id='table' name='table' value='FY2016-17' />
        
             <input type='submit' name='submit' value='Agency Results' id='submit' />
 
  
   
          </form>
          Find program by key word:
             <form action='' target='_blank' method='GET'>

            <input type='text'  id='program' name='program' value='health' />
              

        <input type='hidden'  id='table' name='table' value='FY2016-17' />
        
             <input type='submit' name='submit' value='Program Results' id='submit' />
 
  
   
          </form>";
     }

      ?>

  
           

      

 

 

 </div>
 <div class='right'>
  
<br><br><br><br>



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


    <?php //include('../scripts/footer.php');?>

    </body>
</html>