<?php
include'login.php';

 echo"
<html>
  <head>
    <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    <script type='text/javascript'>
      google.charts.load('current', {'packages':['treemap']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          [ 'Program',  'Value', 'Difference from last yr'],";
		  
				
			$query="SELECT Program, Portfolio, sum(last),sum(current) from budget_table15_16 where portfolio!='Prime Minister and Cabinet'
			Group by Portfolio,Program order by sum(current) DESC ";
			$result = mysqli_query($db, $query );
		    while ($row = $result->fetch_assoc()) 
		       {
echo"[ '".trim($row['Program'])."',    ".$row['sum(current)'].", ".$row['sum(last)'].",],";
			   }
			   
			   
			   echo"
        
        ]);

        tree = new google.visualization.TreeMap(document.getElementById('chart_div'));

        tree.draw(data, {
          minColor: '#f00',
          midColor: '#ddd',
          maxColor: '#0d0',
          headerHeight: 15,
          fontColor: 'black',
          showScale: true
        });

      }
    </script>
  </head>
  <body>
    <div id='chart_div' style='width: 1000px; height: 1000px;background:#eee'></div>
  </body>
</html>";

?>