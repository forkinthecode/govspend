 <?php


 while ($row = $result->fetch_assoc()) 
    {
echo" <div class='mps'>
	    <div class='reps'><img height='150px;'  src='".$row['url']."'></img>
<div class='source' width='100px'><span class='right'>Source:APH</span></div>
        </div>
<table><tbody>
<tr><td><h2>Electorate: ".$row['electorate']."</h2></td></tr>
<tr><td><h2>Party: ".$row['party']."</h2></td></tr>
<tr><td><h2>Name: ".$row['name']."</h2></td></tr>
</tbody></table>";
    }
  echo"</div><div class='clear></div><br>"; 

  ?>