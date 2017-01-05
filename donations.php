<?php
require'header.php';
?>


        <div class="left">

 


	    
    



    <?php/*
  if ( !isset($_GET['Donor']) && !isset($_GET['Name']) &&  !isset($_GET['Party'])   )
  {

    $donor = $_GET['Donor']; 

   echo"<h4>Politial donations paid in 2015-16</h4>";
 $total = "SELECT *,sum(Value),count(Name) from donations GROUP BY name order by sum(Value) DESC
             ";
 $result = mysqli_query($db, $total );
  @$num_results = mysqli_num_rows($result);
 echo"
 <p>There are $num_results donations paid by organisations in the AEC data for 2015-16</p><div class='expand'><table class='wide'>";
  while ($row = $result->fetch_assoc()) 
     {

 echo"<tr><td><a href='donations.php?Donor=".trim($row['Name'])."'>".$row['Name']."</a></td><td><a href='donations.php?Party=".$row['Party']."'>".$row['Party']."</a></td><td>$".number_format($row['sum(Value)'])."</td></tr>";
     }echo"</table></div>";
 }*/
 ?>
 



	  
	    <?php
	  //if ( isset($_GET['Party'])  )
	  {
  
	    
  
	 
	 $total = "SELECT *,sum(Value),count(Name) as count from donations where party!='' GROUP BY Party ORDER BY  sum(Value) DESC
	             ";
	 $result = mysqli_query($db, $total );
	  @$num_results = mysqli_num_rows($result);
	 echo"<h3>Political Donations by Party for 2015-16 FY </h3>
	 <div class='expand'><table class='wide'>";
	  while ($row = $result->fetch_assoc()) 
	     {

	 echo"<tr><td><a href='donations.php?Party=".trim($row['Party'])."'>".$row['Party']."</a></td><td>".$row['count']."</td><td>$".number_format($row['sum(Value)'])."</td></tr>";
	     }echo"</table></div><br>
			 Mouse/Scroll for more results. Click on Party name to drill down.
			 
			 <br>";
	 }
	 ?>
    
<h3>About AEC political donations data</h3>
<p>AEC donations data does not require ABN/ACN in declarations or does not publish it if it is collected from donors. </p>
<p>Without a unique identifier such as ABN or ACN it is difficult to match political donations data with other datasets. 
	The use of name as an identifier which is
	often the subject of multiple spellings within each dataset (if free text input is used) limits the usability of this data 
	in transparency investigations (or makes invegigation more onerous).</p>
	<p>The lack of standardisation of party names also makes the data more onerous to interact with as calculations based on inexact matches require follow up searches to get a proper
		total.</p>
<p>Other siginficant issues with AEC political donations data are timeliness and exhaustiveness.</p>
<p>Charlie Pickering presents a very good analysis of the problems in this episode of <a href='https://www.youtube.com/watch?v=80ds5fXdLWE'>The Weekly</a>.</p>

   
 

 </div>
 <div class='right'>
	    <?php
	  if ( !isset($_GET['Party']) &&  !isset($_GET['Donor']))
	  {
  
	    
		
	 
	 $total = "SELECT *,sum(Value),count(Name) as count from donations  GROUP BY Name ORDER BY  sum(Value) DESC";
	 $result = mysqli_query($db, $total );
	  @$num_results = mysqli_num_rows($result);
	 echo"<h3>Political Donations by Donor for 2015-16 FY </h3>
	 <div class='expand'><table class='wide'>";
	  while ($row = $result->fetch_assoc()) 
	     {

	 echo"<tr><td><a href='donations.php?Donor=".trim($row['Name'])."'>".$row['Name']."</a></td>
		 <td>".$row['count']."</td><td>$".number_format($row['sum(Value)'])."</td></tr>";
	     }echo"</table></div><br>
			 Mouse/Scroll for more results. Click on Party name to drill down.
			 
			 <br>";
	 }
	 ?>
	 
	    <?php
	  if ( isset($_GET['Party'])  )
	  {
  
	    $party = $_GET['Party']; 
  
	   echo"<h4>Politial donations paid in 2015-16 to $party</h4>";
	 $total = "SELECT *,sum(Value),count(Value) as count,AVG(Value) 
		 from donations WHERE Party='$party' GROUP BY Party
	             ";
	 $result = mysqli_query($db, $total );
	  @$num_results = mysqli_num_rows($result);
	 echo"
	 <hr><table class='stats'><tr><th>Number</th><th>Average Value</th><th>Total Value</th></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {

	 echo"<tr><th>".$row['count']."</a></th><th>$".number_format($row['AVG(Value)'])."</th>
		 <th>$".number_format($row['sum(Value)'])."</th></tr>";
	     }echo"</table><hr>";
	 }
	 ?>
	 
	    <?php
	  if ( isset($_GET['Name'])  )
	  {
  
	    $donor = $_GET['Name']; 
  
	   echo"<h4>Politial donations paid in 2015-16 by $donor</h4>";
	 $total = "SELECT *,sum(Value),count(Value) as count,AVG(Value) from donations WHERE Name='$donor' GROUP BY Name
	             ";
	 $result = mysqli_query($db, $total );
	  @$num_results = mysqli_num_rows($result);
	 echo"
	 <hr><table class='stats'>";
	  while ($row = $result->fetch_assoc()) 
	     {

	 echo"<tr><th>".$row['count']."</a></th><th>$".number_format($row['AVG(Value)'])."</th><th>$".number_format($row['sum(Value)'])."</th></tr>";
	     }echo"</table><hr>";
	 }
	 ?>
	    <?php
	  if ( isset($_GET['Donor'])  )
	  {
  
	    $donor = $_GET['Donor']; 
  
	   echo"<h4>Politial donations paid in 2015-16 by $donor</h4>";
	 $total = "SELECT *,sum(Value),count(Value) as count,AVG(Value) from donations WHERE Name='$donor' GROUP BY Name
	             ";
	 $result = mysqli_query($db, $total );
	  @$num_results = mysqli_num_rows($result);
	 echo"
	 <hr><table class='stats'>";
	  while ($row = $result->fetch_assoc()) 
	     {

	 echo"<tr><th>".$row['count']."</a></th><th>$".number_format($row['AVG(Value)'])."</th><th>$".number_format($row['sum(Value)'])."</th></tr>";
	     }echo"</table><hr>";
	 }
	 ?>
	 
	 
	    <?php
	  if ( isset($_GET['Donor'])  )
	  {
  
	    $donor = $_GET['Donor']; 
  
	   echo"<h4>Politial donations paid by $donor</h4>";
	 $total = "SELECT * from donations where name  like'%$donor%'
	             ";
	 $result = mysqli_query($db, $total );
	  @$num_results = mysqli_num_rows($result);
	 echo"
	 <p>There are $num_results donations paid by organisations matching $donor</p><table class='stats'>";
	  while ($row = $result->fetch_assoc()) 
	     {

	 echo"<tr><td>".$row['Name']."</td><td><a href='donations.php?Party=".$row['Party']."'>".$row['Party']."</a></td><td>$".number_format($row['Value'])."</td></tr>";
	     }echo"</table>";
	 }
	 ?>
    

  
  
	    <?php
	  if ( isset($_GET['Party'])  )
	  {
  
	    $party= $_GET['Party']; 
  
	   echo"<h4>Political donations paid to $party</h4>";
	 $total = "SELECT * from donations where Party  LIKE'%$party%'
	             ";
	 $result = mysqli_query($db, $total );
	  @$num_results = mysqli_num_rows($result);
	 echo"<div class='expand'>
	<table class='wide'><tr><th>Donor</th><th>Value</th></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {

	 echo"<tr><td><a href='donations.php?Name=".trim($row['Name'])."'>".$row['Name']."</a></td><td>$".number_format($row['Value'])."</td></tr>";
	     }echo"</table></div>";
	 }
	 ?>
    
	    <?php
	  if ( isset($_GET['Name'])  )
	  {
  
	    $name = $_GET['Name']; 
  
	   echo"<h4>Politial donations paid by $name</h4>";
	 $total = "SELECT * from donations where Name ='$name'
	             ";
	 $result = mysqli_query($db, $total );
	  @$num_results = mysqli_num_rows($result);
	 echo"
	<table class='wide'>";
	  while ($row = $result->fetch_assoc()) 
	     {

	 echo"<tr><td>".trim($row['Name'])."</td><td><a href='donations.php?Party=".$row['Party']."'>".$row['Party']."</a></td><td>$".number_format($row['Value'])."</td></tr>";
	     }echo"</table>";
	 }
	 ?>
    


  
  
         
        

  
   

</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>