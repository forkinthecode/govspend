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

 


 </div>
 <div class='left'>
	   
<table class='stats'><tbody>
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
    $program_search = "SELECT id FROM budget_table15_16 where Program  like'%$program%' GROUP BY Program ";
    $result = mysqli_query($db, $program_search );

      @$num_results = mysqli_num_rows($result);
      //if ($num_results <1)
      {
    	  echo"<tr><td><a href='portfolio.php?Program=$program' target='_blank'>2015-16 budget data Programs matching $program</a></td><td> $num_results</td> </tr>";
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
 	  echo"<tr><td><a href='portfolio.php?Component=$program' target='_blank'>2015-16 budget data Components matching $program</a></td><td> $num_results</td> </tr>";
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
		 	  echo"<tr><td><a href='charities.php?Name=$name' target='_blank'>ACNC charities data for $name</a></td><td> $num_results</td> </tr>";
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
	 echo"<tr><td><a href='charities.php?Name=$ABN' target='_blank'>ACNC charities data for $ABN</a><td> $num_results</td> </tr>";
  
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
	 
		 	  echo"<tr><td><a href='grants.php?Recipient=$name' target='_blank'>Commonwealth Grants for $name</a></td><td> $num_results</td> </tr>";
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


		    { echo"<tr><td><a href='donations.php?Donor=$name' target='_blank'>AEC donations data for $name</a></td><td> $num_results</td> </tr>";
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


    { echo"<tr><td><a href='tax.php?Name=$name' target='_blank'>Tax Transparency data for $name</a></td><td> $num_results</td> </tr>";
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
		
		  echo"<tr><td><a href='tax.php?ABN=$ABN' target='_blank'>Tax Transparency data for $ABN</a></td><td> $num_results</td> </tr>";
 
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
         


		 		 echo"<tr><td><a href='tenders.php?Recipient=$name' target='_blank'>Commonwealth tenders for $name</a></td><td> $num_results</td> </tr>";
             
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
		  echo"<tr><td><a href='tenders.php?ABN=$ABN' target='_blank'>Commonwealth tenders for $ABN</a></td><td> $num_results</td> </tr>";

 
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
		  echo"<tr><td><a href='electorate.php?Electorate=$electorate' target='_blank'>Commonwealth Grants for $electorate</a></td><td> ".number_format($num_results)."</td> </tr>";

 
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
		  echo"<tr><td><a href='council.php?Council=$council' target='_blank'>Commonwealth Grants for $council</a></td><td> ".number_format($num_results)."</td> </tr>";

 
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
		  echo"<tr><td><a href='locality.php?Postcode=$postcode' target='_blank'>Commonwealth Grants for $postcode</a></td><td> ".number_format($num_results)."</td> </tr>";

 
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
		  echo"<tr><td><a href='locality.php?Postcode=$postcode' target='_blank'>Commonwealth Tenders for $postcode</a></td><td> ".number_format($num_results)."</td> </tr>";

 
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

   
</div></div>
<div class='clear'></div>

<div class='right'>
	
  
  



</div>
 <?php 
    include('footer.php');?>

    </body>
</html>