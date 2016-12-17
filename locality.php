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
     

  
        </div>
          
       

          <div class='clear'></div>
<div class="page_width">


        <div class="left">

<h2><a href='index.php'>Home</a><span style='float:right'>Budget FY2014-15</span></h2>
        <br>Commonwealth Grants & Tenders by Postcode
          <form action='' target='_blank' method='GET'>

            <input type='text'  id='postcode' name='Postcode' value='postcode' />
              

        
             <input type='submit' name='submit' value='Show' id='submit' />
 
  
   
          </form>
 <div class='clear'></div>

 <?php
 if ( isset($_GET['Postcode']) )
 {
  
 $agor = "SELECT * FROM electorate_party 
 WHERE postcode ='$postcode'  ";
$result = mysqli_query($db, $agor );
 echo"<table><tbody><tr><td> </td>";
 while ($row = $result->fetch_assoc()) 
    {
echo"<tr><td>Electorate:</td><td>".$row['electorate']."</td></tr>
<tr><td>Party:</td><td>".$row['party']."</td></tr>
<tr><td>Representative</td><td>".$row['name']."</td></tr>
";
    }
    echo"</tbody></table>";

  }

    ?>
  <?php
 if ( isset($_GET['Postcode']) )
 {
  
  $postcode = $_GET['Postcode']; 

  echo"<h2>2014-15 Commonwealth Grants for $postcode</h2>";
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);

 echo"<table><tbody><tr><td>Total value </td>";
$agor = "SELECT sum(Funding) as total FROM grants 
 WHERE Postcode LIKE'%$postcode%'  ";
$result = mysqli_query($db, $agor );
 while ($row = $result->fetch_assoc()) 
    {
      echo"<td class='right'>$".number_format($row['total'])."</td></tr>";
      }
    }

      ?>
       <?php
 if ( isset($_GET['Postcode']) )
 {
  
  $postcode = $_GET['Postcode']; 
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);

 echo"<tr><td>Number </td>";
$agor = "SELECT count(funding) as grant_number FROM grants 
 WHERE Postcode LIKE'%$postcode%'  ";
$result = mysqli_query($db, $agor );
 while ($row = $result->fetch_assoc()) 
    {
      echo"<td class='right'>".number_format($row['grant_number'])."</td></tr>";
      }
    }

      ?>
       <?php
 if ( isset($_GET['Postcode']) )
 {
  
  $postcode = $_GET['Postcode']; 
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);

 echo"<tr><td>Average value </td>";
$agor = "SELECT (sum(Funding)/count(funding)) as ave FROM grants 
 WHERE Postcode LIKE'%$postcode%'  ";
$result = mysqli_query($db, $agor );
 while ($row = $result->fetch_assoc()) 
    {
      echo"<td class='right'>$".number_format($row['ave'])."</td></tr>";
      }
      echo"</tbody></table>";
    }

      ?>

 <?php
 if ( isset($_GET['Postcode']) )
 {
  
  $postcode = $_GET['Postcode']; 
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);

 echo"<h4>Breakdown of grant recipients for $postcode</h2>";
$agor = "SELECT *,sum(Funding) FROM grants 
 WHERE Postcode LIKE'%$postcode%' GROUP BY Program ";
$result = mysqli_query($db, $agor );
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"<table class='basic' ><tbody>
 
  <tr><td><a href='locality.php?Program=".$row['Program']."&Postcode=".$row['Postcode']."'>".$row['Program']."</a></td>
  <td><span style='float:right'>$".number_format($row['sum(Funding)'])."</span></td></tr>
  

 </tbody></table><br><hr class='short'><br> ";

}

    
}mysqli_free_result($result);

        ?>

       


 

 <?php
 if ( isset($_GET['Program']) && isset($_GET['Postcode']) )
 {
  
                   $program = $_GET['Program']; 
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);

 echo"<h4>All recipients of grants for $program</h2>";
$agor = "SELECT * FROM `grants`
 WHERE Program LIKE'%$program%' ";
$result = mysqli_query($db, $agor );
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"<table class='basic'><tbody>
 
  <tr><td><a href='locality.php?Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
  <tr><td><a href='recipient.php?recipient=".$row['']."' target='_blank'>".$row['Recipient']."</a></td></tr>
  <tr><td>".$row['Locality'].",".$row['Postcode']."</a></td></tr>
  <tr><td><span style='float:right'>$".number_format($row['Funding'])."</span></td></tr>
  

 </tbody></table><br><hr class='short'><br> ";

}

    
}mysqli_free_result($result);

        ?>

  
           

      

 

 

 </div>
 <div class='right'>
<br><br><br><br>

 <?php
 if ( isset($_GET['Postcode']) && !isset($_GET['Program']) )
 {
  
  $postcode = $_GET['Postcode']; 
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);

 echo"<h4>Breakdown of grant recipients for $postcode</h2>";
$agor = "SELECT * FROM grants 
 WHERE Postcode LIKE'%$postcode%' order by Funding DESC";
$result = mysqli_query($db, $agor );
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"<table class='basic' ><tbody>
  <tr><td>".$row['Component']."</td></tr>
  <tr><td>".$row['Purpose']."</td></tr>

  <tr><td><a href='portfolio.php?Recipient=".$row['Recipient']."'>".$row['Recipient']."</a></td></tr>
  <tr><td>".$row['Locality'].", <a href='locality.php?Postcode=".$row['Postcode']."'>".$row['Postcode']."</a></td></tr>
  <tr><td><span style='float:right'>$".number_format($row['Funding'])."</span></td></tr>
  

 </tbody></table><br><hr class='short'><br> ";

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
  

 </tbody></table><br><hr class='short'><br> ";

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
 Pcode IN (SELECT Postcode from grants where Program LIKE('%$program%') && Year='2014-15' ) ORDER BY Pcode ";
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


    <?php //include('../scripts/footer.php');?>

    </body>
</html>