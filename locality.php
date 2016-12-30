<?php
require'header.php';
?>

        <div class="left">
  

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
			echo"<h3>Socio Economic (SEIFA) Data for postcode: $postcode</h3><div class='source'>Source: SEIFA data published by ABS based on 2011 census data</div>
			<table class='council'><tbody><tr><td>National Rank</td><td>National Decile</td><td>Usual Resident Pop</td></tr>";
			$seifa = "SELECT * FROM seifa_by_postcode WHERE Postcode ='$postcode' ";
			     while ($row = $result->fetch_assoc()) 
			            {
			              echo"<tr>
			              <td>Ranked ".number_format($row['rank'])." </td><td>".$row['decile']."/10 </td>
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
			      }echo"</td><td></td></tr></tbody></table><br><br>";
    
			}
			?>
			    <div class='clear'></div>
			
<?php/*
 if ( isset($_GET['Postcode']) )
 {

	 $data = $_GET['Postcode']; 
	$postcode=mysqli_real_escape_string ( $db , $data );
	$total = "SELECT * FROM `coordinates`  where pcode='$postcode' ";
	$result = mysqli_query($db, $total );
	echo"<table border='1px'><tr><td><h3>Suburbs</h3></td><td>";
	 while ($row = $result->fetch_assoc()) 
	    {

	echo"".$row['locality'].", ".$row['state'].". ";

	    }
		
		
$lga = "SELECT Distinct council FROM `LGA`  where Postcode='$postcode' ORDER BY RATIO DESC LIMIT 1";
$result = mysqli_query($db, $lga );

 while ($row = $result->fetch_assoc()) 
    {

echo"</td></tr>
	<tr><td><h3>LGA</td><td><a href='council.php?Council=".$row['council']."'>".$row['council']."</a></td></tr>";
$council =$row['council'];
    }


	
	$pcode = "SELECT Distinct postcode FROM `LGA`  where council='$council' ";
	$result = mysqli_query($db, $pcode );
 echo"<tr><td><h3>LGA Postcodes</h3></td><td>";
	 while ($row = $result->fetch_assoc()) 
	    {

	echo"<a href='locality.php?Postcode=".$row['postcode']."'>".$row['postcode']."</a> | ";
	    }
$fed_electorate = "SELECT electorate FROM `locality_CED`  where postcode='$postcode' ORDER BY RATIO DESC LIMIT 1 ";
$result = mysqli_query($db, $fed_electorate );

 while ($row = $result->fetch_assoc()) 
    {

		echo"</td></tr>
	               <tr>
		<td><h3>Federal Electorate</h3></td>
		<td>
		 <a href='electorate.php?Electorate=".$row['electorate']."'>".$row['electorate']."</a></h3></td>
		           </tr>
	               <tr> ";
	$electorate =$row['electorate'];
    }
 $total_ = "SELECT DISTINCT postcode FROM locality_CED  where electorate='$electorate'  ";
 $result = mysqli_query($db, $total_ );
 echo"<td><h3>Electorate Postcodes</h3>
	 </td><td>test";
  while ($row = $result->fetch_assoc()) 
     {



 	 echo"
 		 <a href='locality.php?Postcode=".$row['postcode']."'>".$row['postcode']."</a> | ";
	 
     }
 

}         echo"</td>
	           </tr></table>";*/
?>


<?php
if ( isset($_GET['Postcode'])  )
{
$total = "SELECT * FROM `suburb_by_indigenous`  where postcode='$postcode'  ";
$result = mysqli_query($db, $total );
@$num_results = mysqli_num_rows($result);
 if ($num_results >0){
 while ($row = $result->fetch_assoc()) 
    {
		echo"<br><div class='source'>ABS figures from 2011 Census</div>
			<table class='stats'><tr><th>Non Indigenous</th><th>Indigenous & Torres Strait</th><th>Not Stated</th></tr>";
echo"<tr><th>".number_format($row['non_Indigenous'])."</th><th>".(number_format($row['Aboriginal']+$row['TSI']+$row['TSI_IND']))."</th><th>".number_format($row['not_stated'])."</th></tr>";
echo"<tr>
	<th>".number_format(
		($row['non_Indigenous']/$row['total'])
			     *100/1,2)."%</th>
				<th>".number_format(( ($row['Aboriginal']+$row['TSI']+$row['TSI_IND'])/$row['non_Indigenous'])*100.1,2)."%</th>
		<th>".number_format(($row['not_stated']/$row['total'])*100/1,2)."%</th></tr>";
		echo"</table><br>";
 
    }
                        }
	
}
?>


      <?php
 if ( !isset($_GET['Postcode']) && !isset($_GET['Program']) )
 {
echo"<h3>Total value of 15-16FY Commonwealth grants by Postcode</h3>
<br><p>Top 15 Postcodes by value are below. Click on the electorate name to find details of all grants in that Postcode or enter postcode into the search box to find results
for other Postcodes.</p><div class='source'>Source: Grants data published at agency websites</div>";
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
    if ( isset($_GET['Postcode']) && !isset($_GET['Program']) )
    {
	$charities="SELECT * FROM `charities` WHERE Postcode='$postcode'";
	$result = mysqli_query($db, $charities );
	 @$num_results = mysqli_num_rows($result);
	 echo"<div class='source'>Calculated based on ACNC data.</div><h3>There are ".number_format($num_results)." charities 
		 registered with the Australian Charities & Not for Profit Commission
		  using $postcode as their business address.</h3><div class='source'>Source: ACNC data published at <a href='http://data.gov.au/dataset/acnc-register'>data.gov.au</a></div><div class='expand'><table><tbody>";
	 
	 

	 while ($row = $result->fetch_assoc()) 
	    {


			include'charities_table.php';
		

	    }echo"</tbody></table></div>";
	
}
	
	?>
 
  	<?php/*
      if ( isset($_GET['Postcode']) && isset($_GET['Program']) )
      {
  	$charities="SELECT * FROM `charities` WHERE Postcode='$postcode' && Program LIKE'%$program%'";
  	$result = mysqli_query($db, $charities );
  	 @$num_results = mysqli_num_rows($result);
  	 echo"<div class='source'>Calculated based on ACNC data.</div><h3>There are ".number_format($num_results)." charities
		  registered with the Australian Charities & Not for Profit Commission
  		  using $postcode as their business address.</h3><div class='expand'><table><tbody>";
	 
	 

  	 while ($row = $result->fetch_assoc()) 
  	    {


  			include'charities_table.php';
		

  	    }echo"</tbody></table></div>";
	
  }*/
  ?>
    <div class='clear'></div>
  

       


    <?php
      
 if (  isset($_GET['Program']) && !isset($_GET['Postcode']))
 {
	$program=$_GET['Program'];
	$query="SELECT *,DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term from grants where Program like'%$program%' && Year='2015-16' ORDER BY Postcode "; 
	$result = mysqli_query($db, $query );
	@$num_results = mysqli_num_rows($result);
	         if ($num_results<0)
	              {
					  echo"<h4>There are no grants administered under the $program Program</h4>"; 
				  }
				  else
			
				  {
	echo"<h4>There are ".number_format($num_results)." grants approved in the 2015-16 FY for $program</h4> 
		
	 <div class='source'>Grants data published at agency websites</div>
	 <div class='expand'> ";
    while ($row = $result->fetch_assoc()) 
       {
      
   
   include'grants_table.php';

       }echo"</div>";
}
	
 }
 
 ?>
  <?php
 if ( isset($_GET['Postcode']) &&  isset($_GET['Program']))
 {
  $data = $_GET['Postcode']; 
 $postcode=mysqli_real_escape_string ( $db , $data );
 $data1 = $_GET['Program']; 
$program=mysqli_real_escape_string ( $db , $data1);
 
$grants = "SELECT *,DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term  
	
	
	 FROM grants WHERE Postcode LIKE'%$postcode%' && Program like'%$program%' && Year='2015-16'  ";
$result = mysqli_query($db, $grants );

@$num_results = mysqli_num_rows($result);
  while ($row = $result->fetch_assoc()) 
 {
	 include'grants_table.php';

 }
}
 ?>
   
 </div>
 <div class='right'>
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
	          WHERE Postcode LIKE'%$postcode%' && Year='2015-16' ";
	         $result = mysqli_query($db, $grants );
	         @$num_results = mysqli_num_rows($result);
        
      
	            echo"<br><hr><h3>Statistics for 2015-16 Commonwealth Grants for $postcode</h3>
	   <table class='stats'><tbody><tr><th>Total value</th><th>Number</th><th>Average</th></tr>";
	                while ($row = $result->fetch_assoc()) 
	                     {
	                     echo"<th>$".number_format($row['total'])."</th>";
	                     }
      
        


	             $grant_number = "SELECT count(funding) as grant_number FROM grants 
	              WHERE Postcode LIKE'%$postcode%' && Year='2015-16' ";
	             $result = mysqli_query($db, $grant_number);
	              while ($row = $result->fetch_assoc()) 
	                   { 
	                   echo"<th>".number_format($row['grant_number'])."</th>";
	                   }
              

	                 $ave = "SELECT (sum(Funding)/count(funding)) as ave FROM grants 
	                  WHERE Postcode LIKE'%$postcode%' && Year='2015-16' ";
	                 $result = mysqli_query($db, $ave );
	                  while ($row = $result->fetch_assoc()) 
	                       {
	                       echo"<th>$".number_format($row['ave'])."</th></tr>";
	                       }
	                       echo"</tbody></table><hr>";/*
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

	                    }echo"</tbody></table><br><hr class='short'><div class='source'>Grants data published at agency websites</div><br>"; */
	   }
            
            
    
	 }mysqli_free_result($result);

	         ?>

   <?php
  if ( isset($_GET['Postcode']) )
  {


  $data = $_GET['Postcode']; 
 $postcode=mysqli_real_escape_string ( $db , $data );

 echo"
	                       <br><h3>Breakdown of Commonwealth programs administering grants to $postcode</h3>
	                  <p>Click on the program name to get the recipients for that program in $postcode</p>";
	                 $byprogram = "SELECT *,sum(Funding) FROM grants 
	                  WHERE Postcode LIKE'%$postcode%' && Year='2015-16' GROUP BY Program ";
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

	                    }echo"</tbody></table><br><br>"; 
	   
            
            
    
	 }mysqli_free_result($result);

	         ?>
 <?php/*
 if ( isset($_GET['Postcode']) && !isset($_GET['Program']) )
 {
  
  $postcode = $_GET['Postcode']; 
                   



$agor = "SELECT *,DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term  FROM grants 
 WHERE Postcode LIKE'%$postcode%' && Year='2015-16' order by Funding DESC";
$result = mysqli_query($db, $agor );
@$num_results = mysqli_num_rows($result);
         if ($num_results>0)
              { 
                 echo"<h4>Details of grant recipients in $postcode for all Commonwealth programs</h2>
					 <div class='source'>Grants data published at agency websites</div>
					 <div class='expand'>";
 while ($row = $result->fetch_assoc()) 
    {
      
   
include'grants_table.php';

}echo"</div>Mouse/Scroll for more results.";
}

    
}mysqli_free_result($result);

        ?>
  

 <?php
 if ( isset($_GET['Postcode']) && isset($_GET['Program']))
 {
  
  $postcode = $_GET['Postcode']; 
  $program = $_GET['Program']; 

 echo"<h4>Grant recipients for the $program Program in Postcode $postcode</h2> <div class='source'>Grants data published at agency websites</div>";
$grants = "SELECT * FROM grants 
 WHERE Postcode LIKE'%$postcode%' && Program LIKE'%$program%' && Year='2015-16'";
$result = mysqli_query($db, $grants );
@$num_results = mysqli_num_rows($result);
         if ($num_results>0)
              { 
				  
				  
 while ($row = $result->fetch_assoc()) 
    {
      
   
  

include'grants_table.php';

}
}
else
{
	echo"No grants for $program in $postcode";
}

    
}mysqli_free_result($result);
*/
        ?>

 <?php
 if ( isset($_GET['Postcode']) && !isset($_GET['Program']))
 {
	// include'locality_map.php';
 }
 

?>
 <?php
 if ( isset($_GET['Postcode']) && isset($_GET['Program']))
 {
	include'postcode_map.php';
 }
 

?>

  <?php
  if ( isset($_GET['Postcode']) && !isset($_GET['Program']))
  {
	  $totals = "SELECT *,sum(Value),AVG(Value) as AVE FROM tenders 
	   WHERE Postcode ='$postcode'";
	  $result = mysqli_query($db, $totals );
	  @$num_results = mysqli_num_rows($result);
	  echo"<hr><h3>Statistics for Commonwealth tenders to $postcode</h3><table class='stats'><tbody>";
	     while ($row = $result->fetch_assoc()) 
		 {
			 echo"<tr><th>".number_format($num_results)." </th><th>$".number_format($row['AVE'])."</th><th>".number_format($row['sum(Value)'])."</th></tr>";
		 }echo"</tbody></table><hr><br>";
	  
	  $grants = "SELECT * FROM tenders 
	   WHERE Postcode ='$postcode'";
	  $result = mysqli_query($db, $grants );
	  echo"<div class='expand'>";
	
      if ($num_results>0)
              { 
	   while ($row = $result->fetch_assoc()) 
	                {
	          
						include'tenders_table.php';
					}
				}echo"</div>";
  }
 

 ?> 
   

</div></div>
<div class='clear'></div>



    <?php 
    include('footer.php');?>

    </body>
</html>