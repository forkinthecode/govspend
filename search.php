<?php
require'header.php';
?>


        <div class="left">

 <form action="search.php">
 
     <input type="text" id="ABN" name="ABN" placeholder="ABN" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>
 
     <form action="search.php">
     <input type="text" id="Name" name="Name" placeholder="organisation key word eg woolworths" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>
 
      <form action="search.php">
	  <input type="text" id="Program" name="Program" placeholder="program key word eg health" > <button type="submit" id='submit' value="Submit"> Find </button>
  </form>
  
      <form action="search.php">
	  <input type="text" id="Electorate" name="Electorate" placeholder="Federal Electorate" > <button type="submit" id='submit' value="Submit"> Find </button>
  </form>
  
      <form action="search.php">
	  <input type="text" id="Council" name="Council" placeholder="Council" > <button type="submit" id='submit' value="Submit"> Find </button>
   </form>
      <form action="search.php">
	  <input type="text" id="Postcode" name="Postcode" placeholder="Postcode" > <button type="submit" id='submit' value="Submit"> Find </button>
   </form>
			<br>
<h3>Not sure of your council or federal electorate? </h3>

      <form action="search.php">
	  <input type="text" id="postcode" name="postcode" placeholder="Postcode" > <button type="submit" id='submit' value="Submit"> Find </button>
   </form>
      <form action="search.php">
	  <input type="text" id="Locality" name="Locality" placeholder="Suburb" > <button type="submit" id='submit' value="Submit"> Find </button>
   </form>
   <br>
<!--
<p>Click the button to use my geographical coordinates for results</p>

<button onclick="getLocation()">Locate</button>

<p id="demo"></p>

<script>
var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = "<h3><a href='search.php?lat="+position.coords.latitude+"&lon="+position.coords.longitude+"'>SEarch </a></h3>";
}
</script>

-->

</div>
 <div class='right'>
   	<?php
   	$Postcode = $_GET['Postcode']; 
   	$postcode= $_GET['postcode']; 
   	$program = $_GET['Program']; 
   	$name = $_GET['Name']; 
   	$recipient = $_GET['Recipient']; 
   	$ABN = $_GET['ABN']; 
	$locality = $_GET['Locality']; 
	$council = $_GET['Council']; 
	$council= $_GET['Electorate']; 
		//$lat = $_GET['lat']; 
   	echo"	
   	<h1>Results for: $program $name $recipient $ABN $postcode $Postcode $council $electorate $locality $lat $lon</h1>";
	
   	?>
<table class='stats'><tbody>
    <?php/*
    if ( isset($_GET['lat']) )
     {
    $lat=mysqli_real_escape_string ( $db , $_GET['lat'] );
    $lon=mysqli_real_escape_string ( $db , $_GET['lon'] );
	echo" ".number_format($lat,2)."";
		echo" ".number_format($lon,2)."";
    $program_search = "SELECT electorate FROM locality_CED where postcode IN (SELECT pcode FROM coordinates where lon like'%".number_format($lon,2)."%' && lat like'%".number_format($lat,1)."%'   GROUP BY pcode)  ";
    $result = mysqli_query($db, $program_search );

      @$num_results = mysqli_num_rows($result);
	  while ($row = $result->fetch_assoc()) 
		  
      {
    	  echo"<tr><td><a href='electorate.php?Electorate=".$row['electorate']."' target='_blank'> matching ".$row['electorate']."</a></td><td> $num_results</td> </tr>";
    }
    }
*/
    ?>
    <?php
    if ( isset($_GET['Program']) )
     {
    $data = $_GET['Program']; 
    $program=mysqli_real_escape_string ( $db , $data );
    $program_search = "SELECT id FROM budget_table15_16 where Portfolio  like'%$program%' GROUP BY Portfolio  ";
    $result = mysqli_query($db, $program_search );

      @$num_results = mysqli_num_rows($result);
      //if ($num_results <1)
      {
    	  echo"<tr><td><a href='portfolio.php?Portfolio=$program' target='_blank'>2015-16 budget data Portfolios matching $program</a></td><td> $num_results</td> </tr>";
    }
    }

    ?>
    <?php
    if ( isset($_GET['Program']) )
     {
    $data = $_GET['Program']; 
    $program=mysqli_real_escape_string ( $db , $data );
    $program_search = "SELECT id FROM budget_table15_16 where Agency  like'%$program%' GROUP BY Agency ";
    $result = mysqli_query($db, $program_search );

      @$num_results = mysqli_num_rows($result);
      //if ($num_results <1)
      {
    	  echo"<tr><td><a href='agency.php?Agency=$program' target='_blank'>2015-16 budget data Agencies matching $program</a></td><td> $num_results</td> </tr>";
    }
    }

    ?>
    <?php
    if ( isset($_GET['Program']) )
     {
    $data = $_GET['Program']; 
    $program=mysqli_real_escape_string ( $db , $data );
    $program_search = "SELECT id FROM budget_table15_16 where Program  like'%$program%'  GROUP BY Program ";
    $result = mysqli_query($db, $program_search );

      @$num_results = mysqli_num_rows($result);
      //if ($num_results <1)
      {
    	  echo"<tr><td><a href='program.php?Program=$program' target='_blank'>2015-16 budget data Programs matching $program</a></td><td> $num_results</td> </tr>";
    }
    }

    ?>

	
		
 <?php
 if ( isset($_GET['Program']) )
  {
 $data = $_GET['Program']; 
 $program=mysqli_real_escape_string ( $db , $data );
 $program_search = "SELECT id FROM budget_table15_16 where Component  like'%$program%'  ";
 $result = mysqli_query($db, $program_search );

   @$num_results = mysqli_num_rows($result);
   //if ($num_results <1)
   {
 	  echo"<tr><td><a href='program.php?Component=$program' target='_blank'>2015-16 budget data Components matching $program</a></td><td> $num_results</td> </tr>";
 }
 }

 ?> <?php
		 if ( isset($_GET['Name']) )
		  {
		 $data = $_GET['Name']; 
		 $name=mysqli_real_escape_string ( $db , $data );
		 $charities = "SELECT id FROM charities where Legal_Name like'%$name%'  ";
		 $result = mysqli_query($db, $charities );
		
		   @$num_results = mysqli_num_rows($result);
		   //if ($num_results <1)
		   {
		 	  echo"<tr><td><a href='charities.php?Name=$name' target='_blank'>ACNC charities data for matching charities</a></td><td> $num_results</td> </tr>";
		 }
		 }

		 ?>

		 <?php
		 if ( isset($_GET['ABN']) )
		  {
		 $data = $_GET['ABN']; 
		 $ABN=mysqli_real_escape_string ( $db , $data );
		 $charities = "SELECT id FROM charities where ABN ='$ABN'   ";
		 $result = mysqli_query($db, $charities );
		   @$num_results = mysqli_num_rows($result);
		   //if ($num_results <1)
		   {
	 echo"<tr><td><a href='charities.php?ABN=$ABN' target='_blank'>ACNC charities data for matching ABN</a><td> $num_results</td> </tr>";
  
		 }
		 }
		 ?>  
		 
		
		  <?php
		  if ( isset($_GET['Name']) )
		   {

			   $data = $_GET['Name']; 
			   $name=mysqli_real_escape_string ( $db , $data );

		  $query="SELECT id FROM `donations` WHERE Name like'%$name%'";

		  $result = mysqli_query($db, $query );
		    @$num_results = mysqli_num_rows($result);


		    { echo"<tr><td><a href='donations.php?Donor=$name' target='_blank'>Political donations data for matching donors </a></td><td> $num_results</td> </tr>";
		    }

		 }

		 ?>
		 
		
  <?php
  if ( isset($_GET['Name']) )
   {

	   $data = $_GET['Name']; 
	   $name=mysqli_real_escape_string ( $db , $data );

  $query="SELECT id FROM `tax` WHERE Name like'%$name%'";

  $result = mysqli_query($db, $query );
    @$num_results = mysqli_num_rows($result);


    { echo"<tr><td><a href='tax.php?Name=$name' target='_blank'>Tax Transparency data for matching companies</a></td><td> $num_results</td> </tr>";
    }

 }

 ?>

		     <?php
		   if ( isset($_GET['ABN'])  )
		   {
 
		     $name = $_GET['ABN']; 
			 $name=mysqli_real_escape_string ( $db , $data );
 
		   
		  $total = "SELECT id from tax where ABN  like'%$ABN%'
		              ";
		  $result = mysqli_query($db, $total );
		   @$num_results = mysqli_num_rows($result);
		   //if ($num_results >0)
		   {
		
		  echo"<tr><td><a href='tax.php?ABN=$ABN' target='_blank'>Tax Transparency data for matching ABN</a></td><td> $num_results</td> </tr>";
 
		  }
		  }
		  ?>
 		 <?php
 		 if ( isset($_GET['Name']) )
 		  {
 		 $data = $_GET['Name']; 
 		 $name=mysqli_real_escape_string ( $db , $data );
		 
 		 $test="SELECT id from grants where Recipient LIKE'%$name%' && Year='2015-16' ";
 		 $result = mysqli_query($db, $test );
 		   @$num_results = mysqli_num_rows($result);
 		   //if ($num_results >0)
 		   {
	 
 		 	  echo"<tr><td><a href='grants.php?Recipient=$name' target='_blank'>Commonwealth Grants for matching recipients</a></td><td> $num_results</td> </tr>";
 		 }
 		 }

 		 ?>
		      <?php
		     if ( isset($_GET['Name'])  )
		       {

		        $data = $_GET['Name']; 
		        $name=mysqli_real_escape_string ( $db , $data );
		    	$test="SELECT id FROM tenders  WHERE  Name like'%$name%'";
		        $result = mysqli_query($db, $test );
		          @$num_results = mysqli_num_rows($result);
		          //if ($num_results <0)
         


		 		 echo"<tr><td><a href='tenders.php?Recipient=$name' target='_blank'>Commonwealth Tenders received by matching suppliers</a></td><td> $num_results</td> </tr>";
             
		     }

		     ?>
 

		   <?php
		   if ( isset($_GET['ABN']) )
		    {

		     $data = $_GET['ABN']; 
		     $ABN=mysqli_real_escape_string ( $db , $data );
		 	$test="SELECT id FROM tenders where ABN='$ABN'";
		     $result = mysqli_query($db, $test );
		       @$num_results = mysqli_num_rows($result);
      
		       {
		  echo"<tr><td><a href='tenders.php?ABN=$ABN' target='_blank'>Commonwealth Tenders with matching suppliers</a></td><td> $num_results</td> </tr>";

 
		    }
		  }

		  ?>
		   <?php
		   if ( isset($_GET['Electorate']) )
		    {

		     $data = $_GET['Electorate']; 
		     $electorate=mysqli_real_escape_string ( $db , $data );
		 	$test="SELECT id FROM grants where Electorate ='$electorate' && Year='2015-16'";
		     $result = mysqli_query($db, $test );
		       @$num_results = mysqli_num_rows($result);
      
		       {
		  echo"<tr><td><a href='electorate.php?Electorate=$electorate' target='_blank'>Commonwealth Grants for matching federal electorates</a></td><td> ".number_format($num_results)."</td> </tr>";

 
		    }
		  }

		  ?>
		   <?php
		   if ( isset($_GET['Council']) )
		    {

		     $data = $_GET['Council']; 
		     $council=mysqli_real_escape_string ( $db , $data );
		 	$test="SELECT id FROM grants where Council ='$council' && Year='2015-16'";
		     $result = mysqli_query($db, $test );
		       @$num_results = mysqli_num_rows($result);
      
		       {
		  echo"<tr><td><a href='council.php?Council=$council' target='_blank'>Commonwealth Grants for matching councils</a></td><td> ".number_format($num_results)."</td> </tr>";

 
		    }
		  }

		  ?>
		   <?php
		   if ( isset($_GET['Postcode']) )
		    {

		     $data = $_GET['Postcode']; 
		     $postcode=mysqli_real_escape_string ( $db , $data );
		 	 $test="SELECT Postcode FROM grants where Postcode ='$postcode' && Year='2015-16'";
		     $result = mysqli_query($db, $test );
		       @$num_results = mysqli_num_rows($result);
      
		       {
		  echo"<tr><td><a href='locality.php?Postcode=$postcode' target='_blank'>Commonwealth Grants for matching postcode</a></td><td> ".number_format($num_results)."</td> </tr>";

 
		    }
		  }

		  ?>
		   <?php
		   if ( isset($_GET['Postcode']) )
		    {

		     $data = $_GET['Postcode']; 
		     $postcode=mysqli_real_escape_string ( $db , $data );
		 	 $test="SELECT id FROM tenders where Postcode ='$postcode'";
		     $result = mysqli_query($db, $test );
		       @$num_results = mysqli_num_rows($result);
      
		       {
		  echo"<tr><td><a href='locality.php?Postcode=$postcode' target='_blank'>Commonwealth Tenders for matching postcode</a></td><td> ".number_format($num_results)."</td> </tr>";

 
		    }
		  }

		  ?>
	   <?php
	   if ( isset($_GET['Locality']) )
	    {

	     $data = $_GET['Locality']; 
	     $locality=mysqli_real_escape_string ( $db , $data );
		 	 $test="SELECT Locality FROM grants where Locality LIKE'%$locality%' && Year='2015-16'";
		     $result = mysqli_query($db, $test );
		       @$num_results = mysqli_num_rows($result);
      
		       {
		  echo"<tr><td><a href='grants.php?Locality=$locality' target='_blank'>Commonwealth Grants for matching recipients</a></td><td> ".number_format($num_results)."</td> </tr>";

 
		    }
		  }

		  ?>
		   <?php
		   if ( isset($_GET['Locality']) )
		    {

		     $data = $_GET['Locality']; 
		     $locality=mysqli_real_escape_string ( $db , $data );
		 	 $test="SELECT id FROM tenders where Locality ='$locality'";
		     $result = mysqli_query($db, $test );
		       @$num_results = mysqli_num_rows($result);
      
		       {
		  echo"<tr><td><a href='locality.php?Locality=$locality' target='_blank'>Commonwealth Tenders for matching Locality</a></td><td> ".number_format($num_results)."</td> </tr>";

 
		    }
		  }

		  ?>
	  </tbody>
	  </table>


         <p>All results are for the 2015-16 year data only.</p>
        <p>Quick search shows matches across all datasets for your input.</p>
		<p>Searches are NOT case sensitive.</p>
		<p>Choose the appropriate search: either business name key word, program key word, ABN/ACN, Federal Electorate, a local council name or postcode. </p><p>Put in your serach term and any results will
			be displayed here. Click on the dataset name to see those results open in another page.</p>

	<br>
	
	  <?php
   if ( isset($_GET['postcode']) )
    {

     $data = $_GET['postcode']; 
     $postcode=mysqli_real_escape_string ( $db , $data );
 	 $test="SELECT * FROM locality_CED WHERE postcode ='$postcode' Group by Postcode";
     $result = mysqli_query($db, $test );
	
       @$num_results = mysqli_num_rows($result);
	   
	
 	  echo"
 <table class='stats'><tr><th>Electorate</th><th>State</th><th>Coverage</tr></tr>";
     while ($row = $result->fetch_assoc()) 
        {
		 
   		 echo"<tr><td><a href='search.php?Electorate=".$row['electorate']."' target='_blank'>  ".$row['electorate']."</a></td>
 			 <td> ".$row['state']."</td><td>".number_format($row['PERCENT'],2)."%</td></tr>";


         }echo"</table><p>Click on the Electorate or Council name for those results.</p>";
       

       


    
  }

  ?>
  <br>
     <?php
     if ( isset($_GET['postcode']) )
      {
	      $data = $_GET['postcode']; 
	      $postcode=mysqli_real_escape_string ( $db , $data );
    
  $test="SELECT * FROM LGA WHERE Postcode ='$postcode'";
  $result = mysqli_query($db, $test );
    @$num_results = mysqli_num_rows($result);


	  echo"
<table class='stats'><tr><th>LGA</th><th>Coverage</tr></tr>";
    while ($row = $result->fetch_assoc()) 
       {
		 
  		 echo"<tr><td><a href='search.php?Council=".$row['Council']."' target='_blank'>  ".$row['Council']."</a></td>
			<td>".number_format($row['Percent']*100,2)."%</td></tr>";


        }echo"</table><p>Click on the Electorate or Council name for those results.</p>";
      

      
    }

    ?>
       <?php
       if ( isset($_GET['Locality']) )
        {
  	      $data = $_GET['Locality']; 
  	      $locality=mysqli_real_escape_string ( $db , $data );
    
    $test="SELECT * FROM locality_CED WHERE locality ='$locality' GROUP BY ELECTORATE order by State";
    $result = mysqli_query($db, $test );
      @$num_results = mysqli_num_rows($result);
	  echo"
<table class='stats'><tr><th>Electorate</th><th>State</th><th>Coverage</tr></tr>";
    while ($row = $result->fetch_assoc()) 
       {
		 
  		 echo"<tr><td><a href='search.php?Electorate=".$row['electorate']."' target='_blank'>  ".$row['electorate']."</a></td>
			 <td> ".$row['state']."</td><td>".number_format($row['PERCENT'],2)."%</td></tr>";


        }echo"</table><p>Click on the Electorate or Council name for those results.</p>";
      }

      ?>
         <?php
         if ( isset($_GET['Locality']) )
          {
    	      $data = $_GET['Locality']; 
    	      $locality=mysqli_real_escape_string ( $db , $data );
    
      $test="SELECT council,Percent from LGA where  Postcode IN (SELECT pcode FROM coordinates WHERE locality ='$locality' && delivery_centre !='PO Box' )";
      $result = mysqli_query($db, $test );
        @$num_results = mysqli_num_rows($result);

  	  echo"
  <table class='stats'><tr><th>LGA</th><th>Coverage</tr></tr>";
      while ($row = $result->fetch_assoc()) 
         {
		 
    		 echo"<tr><td><a href='search.php?Council=".$row['council']."' target='_blank'>  ".$row['council']."</a></td>
  			<td>".number_format($row['Percent']*100,2)."%</td></tr>";


          }echo"</table><p>Click on the Electorate or Council name for those results.</p>";
      

      
      }

        ?>
	

   </div></div>
   <div class='clear'></div>
   <?php 
       include('footer.php');?>

       </body>
   </html>