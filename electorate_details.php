 <?php


 while ($row = $result->fetch_assoc()) 
    {
echo" <div class=''><div class='reps'><img src='".$row['url']."'></img></div>
<table><tbody>
<tr><td><h3>Electorate</h3></td><td><h3>".$row['electorate']."</h3></td></tr>
<tr><td><h3>Party</h3></td><td><h3>".$row['party']."</h3></td></tr>
<tr><td><h3>Name</h3></td><td><h3>".$row['name']."</h3></td></tr>
</tbody></table></div><br><div class='clear></div>";
    }
  echo"<div class='clear></div><br><hr>"; 

  ?>