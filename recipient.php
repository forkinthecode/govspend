<?php
require'header.php';
?>


        <div class="left">

 





<?php
 if ( !isset($_GET['Recipient']) )
 { 
echo"<h4>Total Commonwealth Grants by Recipient</h4>";
$total = "SELECT Recipient,sum(Funding),count(Funding) as counts FROM `grants` WHERE 
  Year='2014-15' && Recipient!='' GROUP BY Recipient ORDER BY sum(Funding) DESC ";
 echo"<div class='expand'>
 <table class='wide'>
 <tbody>
 <tr>
 <th>Total Value</th>
 <th>Number</th>
 <th>Recipient</th>
 </tr>";
$result = mysqli_query($db, $total );
 while ($row = $result->fetch_assoc()) 
    {

echo"
<tr> 
  <td>$".number_format($row['sum(Funding)'])."</td>
  <td>(".number_format($row['counts']).")</td>
  <td><a href='recipient.php?Recipient=".$row['Recipient']."'>".$row['Recipient']."</a></td>
</tr>
 ";
    }echo" </tbody></table><br></div>";
}
?>

 
<?php
if ( isset($_GET['Recipient']) )
 {
$data = $_GET['Recipient']; 
$recipient=mysqli_real_escape_string ( $db , $data );
echo"<h4>Statistics for Commonwealth Grants received by $recipient</h4>
	
";
$seifa = "SELECT sum(Funding),count(Funding) 
as count_ ,(sum(Funding)/count(Funding)) as Ave FROM grants WHERE Recipient ='$recipient'
 && Year='2014-15'  ";
$result = mysqli_query($db, $seifa );
  @$num_results = mysqli_num_rows($result);
  if ($num_results <1)
  {
  echo"<h4>There are no Commonwealth grant recipients named $recipient</h4>";
  }
else{
  echo"<table class='stats'><tbody><tr><th>Total value</th><th>Number</th><th>Average</th></tr>";
 while ($row = $result->fetch_assoc()) 
     {

     echo"<tr><th>$".number_format($row['sum(Funding)'])."</th><th>".$row['count_']."</th><th>".number_format($row['Ave'])."</th></tr>";
     }echo"  </tbody></table><p>*With approval dates during the 2014-15 FY</p><br> ";
    }
}

?>
<?php
if ( isset($_GET['Recipient']) )
 {
$data = $_GET['Recipient']; 
$recipient=mysqli_real_escape_string ( $db , $data );
$query="SELECT * FROM grants WHERE Recipient='$recipient' GROUP BY Recipient";

$result = mysqli_query($db, $query );
@$num_results = mysqli_num_rows($result);
  if ($num_results <1)
  {
  //echo"<h4>There are no Commonwealth grant recipients named $recipient</h4>";
  }
else{
  echo"<H4>Commonwealth Grants data information for $recipient</h4><table class='stats'><tbody>";
 while ($row = $result->fetch_assoc()) 
     {
echo"


  <tr><td>Recipient:</td><td><a href='recipient.php?Recipient=".$row['Recipient']."'>".trim($row['Recipient'])."</a></td></tr>
  <tr><td>Address:</td><td>".$row['Locality']." <a href='locality.php?Postcode=".$row['Postcode']."'>".$row['Postcode']."</a></td></tr>
  <tr><td>Electorate:</td><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td></tr>
  <tr><td>Council:</td><td> <a href='council.php?Council=".$row['Council']."'>".$row['Council']."</a></td></tr>";

     }echo"</tbody></table>";
   }

}
?>

<?php
if ( isset($_GET['Recipient']) )
 {
$data = $_GET['Recipient']; 
$recipient=mysqli_real_escape_string ( $db , $data );
$charities = "SELECT * FROM charities where Legal_Name LIKE'%$recipient%'";
$result = mysqli_query($db, $charities );
  @$num_results = mysqli_num_rows($result);
  if ($num_results <1)
  {
    echo"<p>There are no matches in ACNC charities data for $recipient</p>";
  }
  elseif ($num_results >0)
  {
     while ($row = $result->fetch_assoc())
           {
            echo"<h4>ACNC data for $recipient</h4>
          <table class='basic'><tbody>
               
        <tr><td>ABN </td><td>".$row['ABN']."</td></tr>       
         <tr>
        <td>Legal Name</td>     
        <td> ".$row['Legal_Name']."</td>
        </tr>
        <tr>
        <td>Other Names</td>     
        <td> ".$row['Other_Names']."</td>
        </tr>
        <tr>
        <td></td>     
        <td><a href='https://www.google.com.au/maps/search/".$row['Address1']."
         ".$row['Address2']." ".$row['Address3']."
          ".$row['Locality']." 
        ".$row['state']." ".$row['postcode']." Australia' 
        title='Locate in Google maps' target='_blank'><img src='map_icon.png'></img>
        ".$row['Address1']." ".$row['Address2']." ".$row['Address3']." 
        ".$row['Locality'].", ".$row['State']." ".$row['Postcode']."</a></td>
        </tr>
        <tr>
        <td>Size</td>    
        <td> ".$row['Size']."</td>
        </tr>
        <tr>
        <td>Operating Countries</td>     
        <td> ".$row['Countries']."</td>
        </tr>
        <tr>
        <td>Operating States</td>    
        <td> ".$row['NSW']." ".$row['QLD']." ".$row['VIC']." ".$row['SA']." ".$row['ACT']." ".$row['TAS']." 
        ".$row['NT']." ".$row['WA']."</td>
        </tr>
        <tr>
        <td>Issues</td>       <td>
       <div class='issues'>".$row['animals']."</div>
<div class='issues'>".$row['Culture']."</div>
<div class='issues'>".$row['Education']."</div>
<div class='issues'>".$row['Health']."</div>
<div class='issues'>".$row['Policy']."</div> 
<div class='issues'>".$row['Environment']."</div>
<div class='issues'>".$row['Rights']."</div> 
<div class='issues'>".$row['Misc']."</div> 
<div class='issues'>".$row['Reconciliation']."</div> 
<div class='issues'>".$row['Religion']."</div>
<div class='issues'>".$row['Social']."</div> 
<div class='issues'>".$row['Security']."</div>
<div class='issues'>".$row['General']."</div> 
<div class='issues'>".$row['Indigenous']."</div> 
<div class='issues'>".$row['Aged']."</div>
<div class='issues'>".$row['Children']."</div> 
<div class='issues'>".$row['Overseas']."</div>
<div class='issues'>".$row['Ethnicity']."</div>
<div class='issues'>".$row['LGBT']."</div> 
<div class='issues'>".$row['Public']."</div> 
<div class='issues'>".$row['Men']."</div> 
<div class='issues'>".$row['Migrants']."</div> 
<div class='issues'>".$row['Offenders']."</div>
<div class='issues'>".$row['Illness']."</div> 
<div class='issues'>".$row['Disabilities']."</div> 
<div class='issues'>".$row['Homelessness']."</div>
<div class='issues'>".$row['Unemployed']."</div> 
<div class='issues'>".$row['Veterans']."</div> 
<div class='issues'>".$row['Crime']."</div> 
<div class='issues'>".$row['Disasters']."</div> 
<div class='issues'>".$row['Women']."</div>
<div class='issues'>".$row['Youth']."</div> </td>
        </tr>
        </tbody>
        </table>";
        }

     }
}

?>
<?php
if ( isset($_GET['Recipient']) )
 {
$data = $_GET['Recipient']; 
$recipient=mysqli_real_escape_string ( $db , $data );
echo"<h4>Commonwealth Grants received by $recipient</h4>
<p>(With approval dates within the 2014-15 financial year)</p>";
$seifa = "SELECT *,sum(Funding) FROM grants WHERE Recipient ='$recipient' && Year='2014-15' GROUP BY Program ";
$result = mysqli_query($db, $seifa );
  @$num_results = mysqli_num_rows($result);
  if ($num_results <1)
  {
  echo"<h4>There are no Commonwealth grant recipients named $recipient</h4>";
}
else{
 while ($row = $result->fetch_assoc()) 
    {

echo"

<table class='wide' ><tbody>
 <tr><td>Program</td>         <td><a href='recipient.php?Recipient=".$row['Recipient']."&Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
 
  <tr><td>Portfolio:</td>         <td>".$row['Portfolio']."</td></tr>
  <tr><td>Agency:</td>            <td>".$row['Agency']."</td></tr>
 
  <tr><td>Total Value:</td>   <td><span style='float:right'>$".number_format($row['sum(Funding)'])."</span></td></tr>
 </tbody></table><br>
";
}echo" <p>Click on the Program name to display details of grants to $recipient for that program</p> ";
}
}

?>

  
           

 
 

 

 </div>
 <div class='right'>
  

  



   <?php
 if ( isset($_GET['Recipient']) && isset($_GET['Program'])  )
 {
  
   $recipient = $_GET['Recipient']; 
   $program = $_GET['Program']; 
  echo"<h4>$program grants for $recipient</h4>";
$total = "SELECT *,DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term  FROM `grants` 
         WHERE Program like'%$program%' && Year='2014-15' && Recipient ='$recipient'
            ";
$result = mysqli_query($db, $total );
 @$num_results = mysqli_num_rows($result);
echo"
<p>There are $num_results grants received by $recipient</p>";
 while ($row = $result->fetch_assoc()) 
    {

include'grants_table.php';
}
}
?>


         
        

   <script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?sensor=false'></script>
<script type='text/javascript'>


    <?php
      
 if (  isset($_GET['Recipient']) && !isset($_GET['Program'])  )
 {

$map = "SELECT Lat, Lon, Pcode,State,Locality FROM coordinates where Pcode IN 
(SELECT Postcode from grants where Recipient ='$recipient' && Year='2014-15' 
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
</div>
<div class='clear'></div>
   

</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>