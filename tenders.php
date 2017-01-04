<?php
require'header.php';
?>


        <div class="left">


 <form action="tenders.php">
 
     <input type="text" id="ABN" name="ABN" placeholder="ABN" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>
     <form action="tenders.php">
     <input type="text" id="Recipient" name="Recipient" placeholder="name" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>

   
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
    	 echo"<tr><td><a href='tenders.php?Recipient=".$row['Name']."'>".$row['Name']."</a></td><td> (".$row['count'].")</td><td>$".number_format($row['sum(Value)'])."</td> </tr>";
           
 
  	       }echo"</table>";
  	   }
   elseif ($num_results>16)
   {
	  
		   echo"<h3>$num_results Names matching $name in Commonwealth Tenders</h3>
			   <p>Name (No. Tenders using that name)</p>
			   <div class='expand'><table class='grants'>"; 
		    while ($row = $result->fetch_assoc())
	      {
  	 echo"<tr><td><a href='tenders.php?Recipient=".$row['Name']."'>".$row['Name']."</a></td><td> (".$row['count'].")</td><td>$".number_format($row['sum(Value)'])."</td> </tr>";
           
 
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
    	 echo"<tr><td>".$row['Name']."</td><td><a href='tenders.php?Recipient=".$row['ABN']."'>".$row['ABN']."</a></td><td> (".$row['count'].")</td><td>$".number_format($row['sum(Value)'])."</td> </tr>";
           
 
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
  	 echo"<p><a href='tenders.php?Recipient=".$row['Name']."'>".$row['Name']."</a> (".$row['count'].") </p>";
           }
 
       }echo"</div>";
 
 }
   ?>
<?php
 //if ( isset($_GET['ABN']) || isset($_GET['Name']) || isset($_GET['Agency']) || isset($_GET['Recipient']) )
      {
	 echo"<h3>About Commonwealth Tenders data</h3>
		 
		 <p>The Commonwealth government has provided whole of government tender reporting for over a decade and a half at <a href='tenders.gov.au'>AusTender</a>.
	 <p>Commonwealth tenders data requires ABN (unless exempt) but this data is not broken down by the program that is administering the tender, only by the agency.</p>
	 <p>This means that while one can search Commonwealth grants by program, one can only search Commonwealth tenders by agency or other fields.</p>
	 <p>Without program information in Commonwealth tenders this dataset can not be matched with other datsets that contain Program name such as
	 Commonwealth budget data.</p>
	 <p>An additional problem is that tender applicants are not required to provide their business name exactly as it appears on the Australian Register
	 of Businesses. This results in multiple spellings & mis-spellings of the same company name. This makes totalling or searching by name difficult and can produce
	 inexact results.</p>
		 
		 ";
	  
	  }
	  
	  ?>

 </div>
 <div class='right'>
					
	
	
	    <?php/*
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
	 }*/
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
  }

  ?>
           

 
 
  



  
         
        


</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>