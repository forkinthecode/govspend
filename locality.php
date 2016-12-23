<?php
require'header.php';
?>

        <div class="left">
<?php
 if ( isset($_GET['Postcode']) )
 {

 $data = $_GET['Postcode']; 
$postcode=mysqli_real_escape_string ( $db , $data ); 
;
$total = "SELECT Distinct council,electorate FROM `lga_pcode_electorate`  where Postcode='$postcode' ";
$result = mysqli_query($db, $total );
echo"<h4>$postcode is in the";
 while ($row = $result->fetch_assoc()) 
    {

echo"<a href='council.php?Council=".$row['council']."'>".$row['council']."</a> council area which is in the Federal electorate of <a href='electorate.php?Electorate=".$row['electorate']."'>".$row['electorate']."</a></h4> ";
}echo"</p><hr><br>";
}
?>


      <?php
 if ( !isset($_GET['Postcode']) && !isset($_GET['Program']) )
 {
echo"<h3>Total value of 15-16FY Commonwealth grants by Postcode</h3>
<br><p>Top 15 Postcodes by value are below. Click on the electorate name to find details of all grants in that Postcode or enter postcode into the search box to find results
for other Postcodes.</p>";
$grants = "SELECT Locality,Postcode,sum(Funding) FROM grants
 WHERE Electorate!='' && Electorate NOT LIKE'%,%' && 
Postcode !='Multiple' && Year='2015-16' GROUP BY Postcode ORDER BY sum(Funding) DESC LIMIT 15 ";
$result = mysqli_query($db, $grants );

 echo"<table class='basic' ><tbody>
 <tr>
 <th>Postcode</th>
 <th>Total Value</th>
 </tr>";

 while ($row = $result->fetch_assoc()) 
    {
echo"<tr>
         <td><a href='locality.php?Postcode=".$row['Postcode']."'> ".$row['Postcode']."</a>
         </td><td>".$row['Locality']."</td>
         <td>$".number_format($row['sum(Funding)'])."
         </td>
         </tr>";
    }echo"</tbody></table>";
}
 ?>
  

 <?php
if ( isset($_GET['Postcode']) )
 {
$data = $_GET['Postcode']; 
$postcode=mysqli_real_escape_string ( $db , $data );
$seifa = "SELECT * FROM seifa_by_postcode WHERE Postcode ='$postcode' ";
$result = mysqli_query($db, $seifa );
  @$num_results = mysqli_num_rows($result);
   if ($num_results <1){
        echo"<h4>No SEIFA scores have been calculated by the ABS for $postcode</h4>";
      }

  elseif ($num_results >0)
      {
echo"<h3>Socio Economic (SEIFA) Data for postcode: $postcode</h3>
<table class='council'><tbody><tr><td>National Rank</td><td>National Decile</td><td>Usual Resident Pop</td></tr>";
$seifa = "SELECT * FROM seifa_by_postcode WHERE Postcode ='$postcode' ";
     while ($row = $result->fetch_assoc()) 
            {
              echo"<tr>
              <td style='text-align:right'>Ranked ".number_format($row['rank'])." </td><td>".$row['decile']."/10 </td>
              <td>".number_format($row['URP'])."</td></tr>";

              }
       

                echo"<tr><td tyle='text-align:right'>out of a possible 2,481</td><td>";
                $seifa = "SELECT decile FROM seifa_by_postcode WHERE Postcode ='$postcode' ";
                $result = mysqli_query($db, $seifa );
                 while ($row = $result->fetch_assoc()) 
                    {
                      $iterations=$row['decile'];

                    }

                 $i=0;
                while ($i <= $iterations-1)
                    {
                 echo "<img height='15px' src='icon.png'></img>";
                   $i++;
                    }
      }echo"</td><td></td></tr></tbody></table>";
    
}
?>
    <div class='clear'></div>
  <?php
 if ( isset($_GET['Program']) )
 {
	$program= $_GET['Program'];

	 $query="SELECT * from budget_table15_16 where Program like '%".$_GET['Program']."%' GROUP BY Program";
     $result = mysqli_query($db, $query );
	 echo"  <table class='basic'><tbody>";
	  while ($row = $result->fetch_assoc()) 
	     {
	    echo" 
  
	   <tr><td>Portfolio</td><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."' target='_blank'>".$row['Portfolio']."</a></td></tr>
	   <tr><td>Agency</td><td><a href='agency.php?Agency=".$row['Agency']."' target='_blank'>".$row['Agency']."</a></td></tr>
	   <tr><td>Program</td><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."&Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
	   <tr><td>Outcome</td><td>".$row['Outcome']."</td></tr>";

	 }echo"</tbody><table>";
	
}
 
 ?>

    <div class='clear'></div>
  <?php
 if ( isset($_GET['Postcode']) )
 {
  
 
 $data = $_GET['Postcode']; 
$postcode=mysqli_real_escape_string ( $db , $data );

        $test = "SELECT Postcode as test FROM grants 
         WHERE Postcode LIKE'%$postcode%'  ";
        $result = mysqli_query($db, $test );
        @$num_results = mysqli_num_rows($result);
         if ($num_results==0)
              { 
                echo"<h4>There are no Commonwealth grants recorded for the postcode $postcode.</h4>";

              }

  elseif ($num_results >0)

        {
        $grants = "SELECT sum(Funding) as total FROM grants 
         WHERE Postcode LIKE'%$postcode%'  ";
        $result = mysqli_query($db, $grants );
        @$num_results = mysqli_num_rows($result);
        
      
           echo"<br><h3>Statistics for 2015-16 Commonwealth Grants for $postcode</h3>
  <table class='stats'><tbody><tr><th>Total value</th><th>Number</th><th>Average</th></tr>";
               while ($row = $result->fetch_assoc()) 
                    {
                    echo"<th>$".number_format($row['total'])."</th>";
                    }
      
        


            $grant_number = "SELECT count(funding) as grant_number FROM grants 
             WHERE Postcode LIKE'%$postcode%'  ";
            $result = mysqli_query($db, $grant_number);
             while ($row = $result->fetch_assoc()) 
                  { 
                  echo"<th>".number_format($row['grant_number'])."</th>";
                  }
              

                $ave = "SELECT (sum(Funding)/count(funding)) as ave FROM grants 
                 WHERE Postcode LIKE'%$postcode%'  ";
                $result = mysqli_query($db, $ave );
                 while ($row = $result->fetch_assoc()) 
                      {
                      echo"<th>$".number_format($row['ave'])."</th></tr>";
                      }
                      echo"</tbody></table>
                      <br><h3>Breakdown of Commonwealth programs administering grants to $postcode</h3>
                 <p>Click on the program name to get the recipients for that program in $postcode</p>";
                $byprogram = "SELECT *,sum(Funding) FROM grants 
                 WHERE Postcode LIKE'%$postcode%' GROUP BY Program ";
                $result = mysqli_query($db, $byprogram );
                echo"<table style='basic'>
                <tbody>
                <tr><th>Program Name</th><th>Total Value</th></tr>";
                 while ($row = $result->fetch_assoc()) 
                    {
                      
                   
                echo"
                 <tr>
                  
                  <td><a href='locality.php?Program=".$row['Program']."&Postcode=".$row['Postcode']."'>".$row['Program']."</a></td>
                  <td>$".number_format($row['sum(Funding)'])."</td></tr>
                  ";

                   }echo"</tbody></table><br><hr class='short'><br>"; 
  }
            
            
    
}mysqli_free_result($result);

        ?>

       


    <?php
      
 if (  isset($_GET['Program']) && !isset($_GET['Postcode']))
 {
	$program=$_GET['Program'];
	$query="SELECT *,DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term from grants where Program like'%$program%' ORDER BY Postcode "; 
	$result = mysqli_query($db, $query );
	@$num_results = mysqli_num_rows($result);
	         if ($num_results<0)
	              {
					  echo"<h4>There are no grants administered under the $program Program</h4>"; 
				  }
				  else
				  {
	echo"<h4>There are ".number_format($num_results)." grants approved in the 2015-16 FY for $program</h4> <p>Click on the map icon to reveal postcode. Click on the Postcode to display grants for the program in that location</p> ";
    while ($row = $result->fetch_assoc()) 
       {
      
   
   include'grants_table.php';

   }
}
	
 }
 
 ?>

 

 </div>
 <div class='right'>


 <?php
 if ( isset($_GET['Postcode']) && !isset($_GET['Program']) )
 {
  
  $postcode = $_GET['Postcode']; 
                   



$agor = "SELECT *,DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term  FROM grants 
 WHERE Postcode LIKE'%$postcode%' order by Funding DESC";
$result = mysqli_query($db, $agor );
@$num_results = mysqli_num_rows($result);
         if ($num_results>0)
              { 
                 echo"<h4>Details of grant recipients in $postcode for all Commonwealth programs</h2>";
 while ($row = $result->fetch_assoc()) 
    {
      
   
include'grants_table.php';

}
}

    
}mysqli_free_result($result);

        ?>
  

 <?php
 if ( isset($_GET['Postcode']) && isset($_GET['Program']))
 {
  
  $postcode = $_GET['Postcode']; 
  $program = $_GET['Program']; 

 echo"<h4>Grant recipients for the $program  Program in Postcode $postcode</h2>";
$grants = "SELECT * FROM grants 
 WHERE Postcode LIKE'%$postcode%' && Program LIKE'%$program%' && Year='2015-16'";
$result = mysqli_query($db, $grants );
@$num_results = mysqli_num_rows($result);
         if ($num_results>0)
              { 
				  
				  
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"<table class='basic' ><tbody>
 
 
  <tr><td>Program:</td><td><a href='locality.php?Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
  <tr><td>Recipient</td><td><a href='recipient.php?Recipient=".$row['Recipient']."'>".$row['Recipient']."</a></td></tr>
  <tr><td>Component:</td><td>".$row['Component']."</td></tr>
  <tr><td>Purpose:</td><td>".$row['Purpose']."</td></tr>
  <tr><td>Dates:</td><td>".$row['Approved']."-".$row['End']." months</td></tr>
  <tr><td>Value<td></td><td><span style='float:right'>$".number_format($row['Funding'])."</span></td></tr>
  

 </tbody></table><br>";

}
}
else
{
	echo"No grants for $program in $postcode";
}

    
}mysqli_free_result($result);

        ?>

 <?php
 if ( !isset($_GET['Postcode']) && isset($_GET['Program']))
 {
	 include'locality_map.php';
 }
 

?>
 <?php
 if ( isset($_GET['Postcode']) && isset($_GET['Program']))
 {
	 include'postcode_map.php';
 }
 

?>

  
   

</div></div>
<div class='clear'></div>



    <?php 
    include('footer.php');?>

    </body>
</html>