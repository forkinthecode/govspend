<?php
require'header.php';
?>


        <div class="left">

 <form action="search.php">
 
     <input type="text" id="ABN" name="ABN" placeholder="ABN" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>
     <form action="search.php">
     <input type="text" id="Name" name="Name" placeholder="name" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>
      <form action="search.php">
	  <input type="text" id="Program" name="Program" placeholder="program key word eg health" > <button type="submit" id='submit' value="Submit"> Find </button>
    

  
   </form>

			<br>

 


 </div>
 <div class='right'>
	   
<table class='stats'><tbody>
 <?php
 if ( isset($_GET['Program']) )
  {
 $data = $_GET['Program']; 
 $program=mysqli_real_escape_string ( $db , $data );
 $program_search = "SELECT id FROM budget_table15_16 where Program  like'%$program%'  ";
 $result = mysqli_query($db, $program_search );

   @$num_results = mysqli_num_rows($result);
   //if ($num_results <1)
   {
 	  echo"<tr><td><a href='Portfolio.php?Program=$program' target='_blank'>2015-16 budget data</a></td><td> $num_results</td> </tr>";
 }
 }

 ?>
	
		 <?php
		 if ( isset($_GET['Name']) )
		  {
		 $data = $_GET['Name']; 
		 $name=mysqli_real_escape_string ( $db , $data );
		 $charities = "SELECT id FROM charities where Legal_Name like'%$name%'  ";
		 $result = mysqli_query($db, $charities );
		
		   @$num_results = mysqli_num_rows($result);
		   //if ($num_results <1)
		   {
		 	  echo"<tr><td><a href='charities.php?Name=$name' target='_blank'>ACNC charities data</a></td><td> $num_results</td> </tr>";
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
	 echo"<tr><td><a href='charities.php?Name=$ABN' target='_blank'>ACNC charities data</a><td> $num_results</td> </tr>";
  
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
	 
		 	  echo"<tr><td><a href='grants.php?Recipient=$name' target='_blank'>Commonwealth Grants</a></td><td> $num_results</td> </tr>";
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
 
 
		     { echo"<tr><td><a href='tax.php?Name=$name' target='_blank'>Tax Transparency</a></td><td> $num_results</td> </tr>";
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


    { echo"<tr><td><a href='tax.php?Name=$name' target='_blank'>ATO Tax Transparency</a></td><td> $num_results</td> </tr>";
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
		
		  echo"<tr><td><a href='tax.php?ABN=$ABN' target='_blank'>ATO Tax Transparency</a></td><td> $num_results</td> </tr>";
 
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
         


		 		 echo"<tr><td><a href='tenders.php?Recipient=$name' target='_blank'>Commonwealth tenders</a></td><td> $num_results</td> </tr>";
             
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
		  echo"<tr><td><a href='tenders.php?ABN=$ABN' target='_blank'>Commonwealth tenders</a></td><td> $num_results</td> </tr>";

 
		    }
		  }

		  ?>
	  </tbody>
	  </table>


         
        

   
</div></div>
<div class='clear'></div>

<div class='left'>
	<?php/*
	if ( isset($_GET['Name'])  ||  isset($_GET['Legal_Name']) ||   isset($_GET['ABN']))
	 {
	$data = $_GET['Name']; 
	$recipient=mysqli_real_escape_string ( $db , $data );

	$charities = "SELECT * FROM charities where Legal_Name LIKE'%$recipient%'  ";
	$result = mysqli_query($db, $charities );
	  @$num_results = mysqli_num_rows($result);
	  if ($num_results <17)
	  {
		  echo"<table class='grants'>";
	     while ($row = $result->fetch_assoc())
	           {
				   echo"<tr><td><a href='search.php?Name=$recipient&Legal_Name=".$row['Legal_Name']."'>".$row['Legal_Name']."</a></td><td><a href='search.php?Name=$recipient&Legal_Name=".$row['Legal_Name']."&ABN=".$row['ABN']."'>".$row['ABN']."</a><td></tr>";

	          }echo"</table>";
	   }
	  elseif ($num_results >16)
	  {
		  echo"<h3>Results from the ACNC database for $recipient</h3><div class='expand'><table class='grants'>";
	     while ($row = $result->fetch_assoc())
	           {
				   echo"<tr><td><a href='search.php?Name=$recipient&Legal_Name=".$row['Legal_Name']."'>".$row['Legal_Name']."</a></td><td><a href='search.php?Name=$recipient&Legal_Name=".$row['Legal_Name']."&ABN=".$row['ABN']."'>".$row['ABN']."</a><td></tr>";

	            }echo"</table></div>Mouse/Scroll for more results";
	     }
    
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
      if ($num_results >0)
      {
	
 
 $tenders = "SELECT *,sum(Value),count(Value) as count,AVG(Value)  FROM tenders WHERE ABN ='$ABN'   ";
 $result = mysqli_query($db, $tenders );
  

	 
	 echo"<h3>Commonwealth Tenders received by $ABN</h3>
 <p>(With approval dates within the 2015-16 financial year)</p>
 <div class='source'>Source: Calculated using Historical Tenders data published at data.gov.au </div>
<hr><table class='stats' ><tbody><tr><th>Number</th><th>Ave Value</th><th>Total Value</th></tr>";
  while ($row = $result->fetch_assoc()) 
     {

 echo"
 
<tr><th>".number_format($row['count'])."</th><th>".number_format($row['AVG(Value)'])."</th>  
   <th>$".number_format($row['sum(Value)'])."</th></tr>";
     }echo" </tbody></table><hr><br>";
   }
 }

 ?>
 <?php
 if ( isset($_GET['Recipient']) )
  {
	
   $data = $_GET['Recipient']; 
   $name=mysqli_real_escape_string ( $db , $data );
   $query="SELECT  Name,count(Name) as count,sum(Value) FROM tenders 
	    WHERE Name LIKE '%$name%' GROUP BY Name ORDER BY count(Name) DESC";
   $result = mysqli_query($db, $query );
     @$num_results = mysqli_num_rows($result);
     if ($num_results <1)
     {
     echo"<h4>There are no Commonwealth Tender received by organisations matching $name</h4>";
     }
     elseif ($num_results<16)
	 {
	  
  		   echo"<h3>$num_results Names matching $name in Commonwealth Tenders</h3>
  			   <p>Name (No. Tenders using that name)</p>
  			<table class='grants'>"; 
  		    while ($row = $result->fetch_assoc())
  	      {
    	 echo"<tr><td><a href='search.php?Recipient=".$row['Name']."'>".$row['Name']."</a></td><td> (".$row['count'].")</td><td>$".number_format($row['sum(Value)'])."</td> </tr>";
           
 
  	       }echo"</table>";
  	   }
   elseif ($num_results>16)
   {
	  
		   echo"<h3>$num_results Names matching $name in Commonwealth Tenders</h3>
			   <p>Name (No. Tenders using that name)</p>
			   <div class='expand'><table class='grants'>"; 
		    while ($row = $result->fetch_assoc())
	      {
  	 echo"<tr><td><a href='search.php?Recipient=".$row['Name']."'>".$row['Name']."</a></td><td> (".$row['count'].")</td><td>$".number_format($row['sum(Value)'])."</td> </tr>";
           
 
	       }echo"</table></div>Mouse/Scroll for more results";
	   }
	   
 }
   ?>
   <?php
   if ( isset($_GET['Recipient']) )
    {

     $data = $_GET['Recipient']; 
     $name=mysqli_real_escape_string ( $db , $data );
     $query="SELECT  ABN,Name,count(Name) as count,sum(Value) FROM tenders  WHERE Name like'%$name%' 
		GROUP BY Name,ABN ORDER BY count(ABN) DESC";
     $result = mysqli_query($db, $query );
       @$num_results = mysqli_num_rows($result);
       if ($num_results <1)
       {
       echo"<h4>There are no Commonwealth Tender received by organisations matching $name</h4>";
       }
     else{
	  
  		   echo"<h3>ABN's for companies matching $name in Commonwealth Tenders</h3>
  			   <p>ABN(No. Tenders for that ABN & Name combination)</p>
  			   <div class='expand'><table class='grants'>"; 
  		    while ($row = $result->fetch_assoc())
  	      {
    	 echo"<tr><td>".$row['Name']."</td><td><a href='search.php?Recipient=".$row['ABN']."'>".$row['ABN']."</a></td><td> (".$row['count'].")</td><td>$".number_format($row['sum(Value)'])."</td> </tr>";
           
 
  	       }echo"</table></div>";
  	   }
	   
   }
     ?>
 <?php
 if ( isset($_GET['ABN']) )
  {

   $data = $_GET['ABN']; 
   $ABN=mysqli_real_escape_string ( $db , $data );
   $query="SELECT  Name,count(Name) as count FROM tenders where ABN='$ABN' GROUP BY Name ORDER BY count(Name) DESC";
   $result = mysqli_query($db, $query );
     @$num_results = mysqli_num_rows($result);
     if ($num_results <1)
     {
     echo"<h4>There are no Commonwealth Tender recipients named $ABN</h4>";
     }
   else{
	  
		   echo"<h3>Names used by $ABN in Commonwealth Tenders</h3>
			   <p>Name (No. Tenders using that name)</p>
			   <div class='expand'>"; 
		    while ($row = $result->fetch_assoc())
	      {
  	 echo"<p><a href='search.php?Recipient=".$row['Name']."'>".$row['Name']."</a> (".$row['count'].") </p>";
           }
 
       }echo"</div>";
 
 }
   ?>

	
	</div>

</div class='right'>

	  <?php
	  if ( isset($_GET['ABN']) )
	   {
	  $data = $_GET['ABN']; 
	  $ABN=mysqli_real_escape_string ( $db , $data );

	  $charities = "SELECT * FROM charities where ABN LIKE'%$ABN%'  ";
	  $result = mysqli_query($db, $charities );
	    @$num_results = mysqli_num_rows($result);
	    if ($num_results <1)
	    {
	      echo"<h4>There are no exact matches in ACNC charities data for $ABN</h4>";
	    }
	    elseif ($num_results >0)
	    {echo"<div class='expand'>";
	       while ($row = $result->fetch_assoc())
	             {
	           	include'charities_table.php';

	            }
	  }echo"</div>";
	  }

	  ?>
	  
  <?php
  if ( isset($_GET['Legal_Name']) && !isset($_GET['ABN']))
   {
  $data = $_GET['Legal_Name']; 
  $recipient=mysqli_real_escape_string ( $db , $data );

  $charities = "SELECT * FROM charities where Legal_Name LIKE'%$recipient%'  ";
  $result = mysqli_query($db, $charities );
    @$num_results = mysqli_num_rows($result);
    if ($num_results <1)
    {
      echo"<h4>There are no exact matches in ACNC charities data for $recipient</h4>";
    }
    elseif ($num_results >0)
    {echo"<div class='expand'>";
       while ($row = $result->fetch_assoc())
             {
           	include'charities_table.php';

            }
  }echo"</div>";
  }

  ?>
 
	    <?php
	  if ( isset($_GET['Recipient'])  )
	  {
  
	    $recipient = $_GET['Recipient']; 
  
	   echo"<h4>Politial donations paid by  $recipient</h4>";
	 $total = "SELECT * from donations where name  like'%$recipient%'
	             ";
	 $result = mysqli_query($db, $total );
	  @$num_results = mysqli_num_rows($result);
	 echo"
	 <p>There are $num_results donations paid by organisations matching $name</p><table class='basic'>";
	  while ($row = $result->fetch_assoc()) 
	     {

	 echo"<tr><td>".$row['Name']."</td><td>".$row['Party']."</td><td>$".number_format($row['Value'])."</td></tr>";
	     }echo"</table>";
	 }
	 ?>
      <?php
      if ( isset($_GET['Recipient']) && !isset($_GET['Program']) )
       {
 
        $data = $_GET['Recipient']; 
        $name=mysqli_real_escape_string ( $db , $data );
    	$test="SELECT id FROM tenders  WHERE  Name like'%$name%'";
        $result = mysqli_query($db, $test );
          @$num_results = mysqli_num_rows($result);
          if ($num_results <4)
          {
	

     echo"<h4>Commonwealth Tenders received by $name</h4>
     <p>(With approval dates within the 2015-16 financial year)</p>
  
  
     <div class='source'>Source: Historical Tenders data published at data.gov.au </div>";
     $seifa = "SELECT *  FROM tenders  WHERE Name LIKE'%$name%'  ";
     $result = mysqli_query($db, $seifa );
   

      while ($row = $result->fetch_assoc()) 
             {
   		  include'tenders_table.php';
  
              }echo" <p>Click on the Agency name to display details of all Tenders to $name for that Agency</p> ";
          }
  
   	   elseif ($num_results >3)
   	   {
   		   echo"<h4>Commonwealth Tenders received by $name</h4>
     <p>(With approval dates within the 2015-16 financial year)</p>
     <div class='source'>Source: Historical Tenders data published at data.gov.au </div><div class='expand'>";
     $seifa = "SELECT *  FROM tenders  WHERE MATCH(Name) AGAINST('$name')   ";
     $result = mysqli_query($db, $seifa );
   
   

      while ($row = $result->fetch_assoc()) 
             {
   		  include'tenders_table.php';
  
              }echo"</div>Mouse over/Scroll for more results <p>Click on the Agency name to display details of all Tenders to $name for that Agency</p> ";
          }
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
       if ($num_results <4)
       {
	

  echo"<h4>Commonwealth Tenders received by $ABN</h4>
  <p>(With approval dates within the 2015-16 financial year)</p>
  
  
  <div class='source'>Source: Historical Tenders data published at data.gov.au </div>";
  $seifa = "SELECT *  FROM tenders WHERE ABN ='$ABN'   ";
  $result = mysqli_query($db, $seifa );
   

   while ($row = $result->fetch_assoc()) 
          {
		  include'tenders_table.php';
  
           }echo" <p>Click on the Agency name to display details of all Tenders to $ABN for that Agency</p> ";
       }
  
	   elseif ($num_results >3)
	   {
		   echo"<h4>Commonwealth Tenders received by $ABN</h4>
  <p>(With approval dates within the 2015-16 financial year)</p>
  <div class='source'>Source: Historical Tenders data published at data.gov.au </div><div class='expand'>";
  $seifa = "SELECT *  FROM tenders WHERE ABN ='$ABN'   ";
  $result = mysqli_query($db, $seifa );
   
   

   while ($row = $result->fetch_assoc()) 
          {
		  include'tenders_table.php';
  
           }echo"</div>Mouse over/Scroll for more results <p>Click on the Agency name to display details of all Tenders to $ABN for that Agency</p> ";
       }
  }*/

  ?>
           

 
 
  
  



</div>
 <?php 
    include('footer.php');?>

    </body>
</html>