<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?sensor=false'></script>
<script type='text/javascript'>
    <?php
      
 if (  isset($_GET['Electorate']) && isset($_GET['Program'])  )
 {
$electorate=$_GET['Electorate'];
$map = "SELECT Lat, Lon, Pcode,State,Locality FROM coordinates where 
 Pcode IN (SELECT Postcode from grants where Electorate ='$electorate' && Program LIKE'%$program%' && Year='2015-16' ) 
Group by Pcode ORDER BY Pcode ";
       $result = mysqli_query($db, $map);
 
    echo" var markers = [";
      while ($row = $result->fetch_assoc())
          
 {
       echo
       " {
        \"title\": \"".$row['Locality']."\",
        \"lat\": \"".$row['Lat']."\",
        \"lng\": \"".$row['Lon']."\",
        \"description\": \"".$row['Locality']." <a href='locality.php?Program=".$_GET['Program']."&Postcode=".$row['Pcode']."'>".$row['Pcode']."</a> Click on
		the postcode for all grants to that postcode \"
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