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


      
 <div class='clear'></div>
  <?php
 if ( !isset($_GET['Postcode']) && !isset($_GET['Program']) )
 {
echo"<h3>Total value of 14-15FY Commonwealth grants by Federal Electorate</h3><br><p>Click on the electorate name to find details of all grants in that electorate</p>";
$grants = "SELECT Electorate,sum(Funding) FROM grants
 WHERE Electorate!='' && Electorate NOT LIKE'%,%' GROUP BY Electorate  ";
$result = mysqli_query($db, $grants );

 echo"<table class='basic' ><tbody>
 <tr>
 <td>Postcode</td>
 <td>Total Value</td>
 </tr>";

 while ($row = $result->fetch_assoc()) 
    {
echo"<tr>
         <td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a>
         </td>
         <td>$".number_format($row['sum(Funding)'])."
         </td>
         </tr>";
    }echo"</tbody></table>";
}
 ?>

 <?php
 if ( isset($_GET['Postcode']) )
 {
 $postcode= trim($_GET['Postcode']);
 
$agor = "SELECT * FROM electorate_party
 WHERE Postcode ='$postcode' GROUP BY electorate  ";
$result = mysqli_query($db, $agor );

include'electorate_details.php';

  }

    ?>
    <div class='clear'></div>
  <?php
 if ( isset($_GET['Postcode']) )
 {
  
  $postcode = $_GET['Postcode']; 

  echo"<br><hr><h4>Statistics for 2014-15 Commonwealth Grants for $postcode</h4>";
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);

 echo"<table class='stats'><tbody><tr><td>Total value</td><td>Number</td><td>Average</td></tr>";
$agor = "SELECT sum(Funding) as total FROM grants 
 WHERE Postcode LIKE'%$postcode%'  ";
$result = mysqli_query($db, $agor );
 while ($row = $result->fetch_assoc()) 
    {
      echo"<td>$".number_format($row['total'])."</td>";
      }
    }

      ?>
       <?php
 if ( isset($_GET['Postcode']) )
 {
  
  $postcode = $_GET['Postcode']; 
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);


$agor = "SELECT count(funding) as grant_number FROM grants 
 WHERE Postcode LIKE'%$postcode%'  ";
$result = mysqli_query($db, $agor );
 while ($row = $result->fetch_assoc()) 
    {
      echo"<td>".number_format($row['grant_number'])."</td>";
      }
    }

      ?>
       <?php
 if ( isset($_GET['Postcode']) )
 {
  
  $postcode = $_GET['Postcode']; 
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);


$agor = "SELECT (sum(Funding)/count(funding)) as ave FROM grants 
 WHERE Postcode LIKE'%$postcode%'  ";
$result = mysqli_query($db, $agor );
 while ($row = $result->fetch_assoc()) 
    {
      echo"<td>$".number_format($row['ave'])."</td></tr>";
      }
      echo"</tbody></table>";
    }

      ?>

 <?php
 if ( isset($_GET['Postcode']) )
 {
  
  $postcode = $_GET['Postcode']; 
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);

 echo"<br><h4>Breakdown of Commonwealth programs administering grants to $postcode</h2>";
$agor = "SELECT *,sum(Funding) FROM grants 
 WHERE Postcode LIKE'%$postcode%' GROUP BY Program ";
$result = mysqli_query($db, $agor );
echo"<table style='width:95%'><tbody><tr><td>Total Value</td><td>Program Name</td></tr></tbody></table><br><p>Click on the program name to get the recipients for that program in $postcode</p>";
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"<table class='basic' ><tbody>
 
  <tr> <td><span style='float:right'>$".number_format($row['sum(Funding)'])."</span></td><td><a href='locality.php?Program=".$row['Program']."&Postcode=".$row['Postcode']."'>".$row['Program']."</a></td>
 </tr>
  

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
<form class='overlaid' action='locality.php' target='_blank' method='GET'>
                                <input type="text" name='Postcode' id='Postcode' placeholder="Search..." required>
                                <button type="submit" value="Submit">Go</button>

</form><br>
          <hr>

 <?php
 if ( isset($_GET['Postcode']) && !isset($_GET['Program']) )
 {
  
  $postcode = $_GET['Postcode']; 
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);

 echo"<h4>Detials of grant recipients in $postcode for all Commonwealth programs</h2>";
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