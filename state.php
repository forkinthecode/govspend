<?php
require'header.php';
?>



<div class='left'>


<?php
{
$query="SELECT *,sum(actual) FROM vicbudgetall GROUP BY agency";
$result = mysqli_query($db, $query);
echo"
<h4>Details</h4><table class='grants'><tbody>";
while ($row = $result->fetch_assoc()) 
{
echo"
 
  <tr><td>".$row['agency']."</td><td>$".number_format($row['sum(actual)'])."</td></tr>
 
  

";

}echo" </tbody></table><br><br> ";
}mysqli_free_result($result);
	
?>

 </div>
 <div class='right'>

<?php
{
$query="SELECT * from vicbudgetall";
$result = mysqli_query($db, $query);
echo"
<h4>Details</h4><table class='basic'><tbody>";
while ($row = $result->fetch_assoc()) 
{
echo"
 
  <tr><td>Agency</td><td>".$row['agency']."</td></tr>
 
  <tr><td>Appropriation Type</td><td> ".$row['appropriation_type']."</td></tr>
  <tr><td>Cost</td><td>$".number_format($row['estimate'])."</td></tr>
  <tr><td></td><td> ".$row['actual']."</td></tr>
  

";

}echo" </tbody></table><br><br> ";
}mysqli_free_result($result);
	
?>

  
   

</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>