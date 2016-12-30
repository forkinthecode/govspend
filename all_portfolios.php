
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Portfolio');
        data.addColumn('number', 'Total');
        data.addRows([ <?php 
        


 {
  $sum="SELECT sum(current) FROM `budget_table15_16`";
  $result = mysqli_query($db, $sum);
   while ($row = $result->fetch_assoc())
   {
$sum=$row['sum(current)'];
   }

   $Portfolio_query="SELECT Portfolio,sum(current) FROM `budget_table15_16`
   group by Portfolio order by sum(current) DESC";
   $result = mysqli_query($db, $Portfolio_query);
   while ($row = $result->fetch_assoc())
  {

echo"
['".$row['Portfolio']."',     ".number_format(($row['sum(current)']/($sum)*100/1),2)."],
";
 }
 
}
echo"
   ]);
  var options = {
  'legend':'left',
  'title':'Breakdown by Portfolio budget_table15_16 FY',
  'is3D':true,
  'width':600,
  'height':600
}"
?>

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart'));
        chart.draw(data, options);
      }
    </script>
